<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.facebook.com/llxx.lord.xxll
 * @since      1.0.0
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/admin
 * @author     Arifuzzaman Pranto <zamanpranto@gmail.com>
 */
class Easycubes_App_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


    function wpdocs_codex_eaarticles_init() {

        $labels = array(
            'name'                  => _x( 'Articles', 'Post type general name', 'textdomain' ),
            'singular_name'         => _x( 'Article', 'Post type singular name', 'textdomain' ),
            'menu_name'             => _x( 'Easycubes App', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar'        => _x( 'Article', 'Add New on Toolbar', 'textdomain' ),
            'add_new'               => __( 'Add New', 'textdomain' ),
            'add_new_item'          => __( 'Add New Article', 'textdomain' ),
            'new_item'              => __( 'New Article', 'textdomain' ),
            'edit_item'             => __( 'Edit Article', 'textdomain' ),
            'view_item'             => __( 'View Article', 'textdomain' ),
            'all_items'             => __( 'All Articles', 'textdomain' ),
            'search_items'          => __( 'Search Articles', 'textdomain' ),
            'parent_item_colon'     => __( 'Parent Articles:', 'textdomain' ),
            'not_found'             => __( 'No Articles found.', 'textdomain' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
            'featured_image'        => _x( 'Article Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'archives'              => _x( 'Article archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
            'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
            'items_list_navigation' => _x( 'Articles list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
            'items_list'            => _x( 'Articles list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'ea-article' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_icon'          => 'dashicons-images-alt',
            'menu_position'      => null,
            'supports'           => array( 'title', 'author', 'thumbnail','page-attributes' ),
        );

        register_post_type( 'eaarticles', $args );


        $labels = array(
            'name'              => _x( 'Folders', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Folder', 'taxonomy singular name', 'textdomain' ),
            'menu_name'         => _x( 'Folders', 'Admin Menu text', 'textdomain' ),
            'search_items'      => __( 'Search Folder', 'textdomain' ),
            'all_items'         => __( 'All Folders', 'textdomain' ),
            'parent_item'       => __( 'Parent Folder', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Folder:', 'textdomain' ),
            'edit_item'         => __( 'Edit Folder', 'textdomain' ),
            'update_item'       => __( 'Update Folder', 'textdomain' ),
            'add_new_item'      => __( 'Add New Folder', 'textdomain' ),
            'new_item_name'     => __( 'New Genre Folder', 'textdomain' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'sort'              => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'eafolders' ),
        );

        register_taxonomy( 'eafolders', array( 'eaarticles' ), $args );


        $labels = array(
            'name'              => _x( 'Galleries', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Gallery', 'taxonomy singular name', 'textdomain' ),
            'menu_name'         => _x( 'Galleries', 'Admin Menu text', 'textdomain' ),
            'search_items'      => __( 'Search Gallery', 'textdomain' ),
            'all_items'         => __( 'All Galleries', 'textdomain' ),
            'parent_item'       => __( 'Parent Gallery', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Gallery:', 'textdomain' ),
            'edit_item'         => __( 'Edit Gallery', 'textdomain' ),
            'update_item'       => __( 'Update Gallery', 'textdomain' ),
            'add_new_item'      => __( 'Add New Gallery', 'textdomain' ),
            'new_item_name'     => __( 'New Genre Gallery', 'textdomain' ),
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'sort'              => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'eagallery' ),
        );

        register_taxonomy( 'eagallery', array( 'eaarticles' ), $args );



        add_action( 'eafolders_edit_form_fields', array($this,'display_ea_folders_img'), 10, 2);
        add_action( 'eagallery_edit_form_fields', array($this,'display_eagallery_images'), 10, 2);
        //add_action( 'eafolders_add_form_fields', array($this,'display_ea_folders_img'), 10, 2);

        add_action( 'edited_eafolders', array($this,'save_ea_folders_img'), 10, 2);
        add_action( 'edited_eagallery', array($this,'save_eagallery_media'), 10, 2);
        //add_action( 'save_eafolders', array($this,'save_ea_folders_img'), 10, 2);
        flush_rewrite_rules();
    }

    function save_ea_folders_img( $term_id ) {
        if ( isset( $_POST['eafolder_image_path'] ) ) {
            $t_id = $term_id;
            //save the option array
            update_option( "eafolder_taxonomy_$t_id" . "_fimg", $_POST['eafolder_image_path'] );
        }

    }

    function save_eagallery_media( $term_id ) {
        if ( isset( $_POST['eagallery_media'] ) ) {
            $t_id = $term_id;
            //save the option array
            update_option( "eagallery_taxonomy_$t_id" . "_media", json_encode($_POST['eagallery_media']) );
        }

    }

    function remove_gallery_metabox() {
        remove_meta_box( 'tagsdiv-eagallery', 'eaarticles', 'side' );
    }

    function display_eagallery_images($folder){
        $t_id = $folder->term_id;
        $term_meta = get_option( "eagallery_taxonomy_$t_id" . "_media");

        // Media Init
        wp_enqueue_media();
        //The media upload path is changed to a custom folder

        if (get_class($folder) == "WP_Term")
        {
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="eagallery_image_path"><?php _e('Gallery Items'); ?></label></th>
                <td>

                    <div id="eagallery_image_paths">
                        <?php
                            if (!empty($term_meta))
                            {
                                $medias = json_decode($term_meta);

                                foreach ($medias as $media)
                                {
                                    ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="eagallery_media[]" value="<?php echo $media; ?>"/>
                                        <span class="dashicons dashicons-trash eagallery-media-close"></span>
                                    </div>
                                    <?php
                                }

                            }
                        ?>

                    </div>
                    <input type="button" value="Add media" class="button-primary" id="eagallery_upload_image"/>
                    <input type="button" value="Add media url" class="button-primary" id="eagallery_add_url"/>
                    <br />
                    <span class="description"><?php _e('Add images or videos '); ?></span>
                </td>

            </tr>

            <?php
        }

    }

    function display_ea_folders_img($folder)
    {

        $t_id = $folder->term_id;
        $term_meta = get_option( "eafolder_taxonomy_$t_id" . "_fimg");
        // Media Init
        wp_enqueue_media();
        //The media upload path is changed to a custom folder

        if (get_class($folder) == "WP_Term")
        {
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="eafolder_image_path"><?php _e('Featured Image'); ?></label></th>
                <td>
                    <input type="hidden" name="eafolder_image_path" value="<?php echo $term_meta; ?>" id="eafolder_image_path">

                    <div id="eafolder_show_upload_preview">
                        <?php
                            if (isset($term_meta))
                            {
                                ?>
                                <img src="<?php echo $term_meta ?>" height="100">
                                <?php
                            }
                        ?>
                    </div>
                    <input type="button" value="Upload Image" class="button-primary" id="eafolder_upload_image"/>
                        <br />
                    <span class="description"><?php _e('Image for Term: use full url with '); ?></span>
                </td>

            </tr>

            <?php
        }

    }

    function display_ea_article_detals( $articles , $box) {
        wp_enqueue_media();

        // Retrieve current name of the Director and Movie Rating based on review ID
        $subtitle =  get_post_meta( $articles->ID, 'eaarticles_subtitle', true ) ;
        $tabcount = intval( get_post_meta( $articles->ID, 'eaarticles_tabcount', true ) );
        ?>
            <div style="display: block; padding: 5px 0">
                <div style="width: 50%; display: block;">
                    <label style="width: 50%; display: block; padding:10px 0px; font-weight: bold" for="ea_article_detail_sub">Subtitle</label>
                    <textarea style="width: 100%;" id="ea_article_detail_sub" name="ea_article_detail_sub" ><?php echo $subtitle ?></textarea>

                </div>
            </div>
            <div style="display: block; padding: 5px 0">
                <div style="width: 50%; display: block;">
                    <label style="width: 50%; display: block; padding:10px 0px; font-weight: bold" for="ea_article_detail_tabcount">Tabs Used</label>
                    <select style="width: 65px" name="ea_article_detail_tabcount" id="ea_article_detail_tabcount">
                        <?php
                        for ($i=1;$i<20;$i++)
                        {
                            ?>
                            <option value="<?php echo $i; ?>" <?php if ($tabcount == $i) {echo " selected";}  ?>><?php echo $i; ?></option>
                            <?php
                        }

                        ?>
                    </select>
                </div>
            </div>
        <?php

    }

    function display_ea_article_tabs( $articles , $box) {

        // Retrieve current name of the Director and Movie Rating based on review ID
        $tabcount = intval( get_post_meta( $articles->ID, 'eaarticles_tabcount', true ) );
        ?>
        <div class="bootstrap-wrapper">
             <ul class="nav nav-tabs">
        <?php
        for ($i=1;$i<=$tabcount; $i++) {
            ?>
            <li class="<?php if ($i==1){echo 'active'; } ?>"><a data-toggle="tab" href="#tab_<?php echo $i ; ?>">Tab <?php echo $i; ?></a></li>
           <?php
        }

        ?>
             </ul>
            <div class="tab-content">
        <?php
        for ($i=1;$i<=$tabcount; $i++) {
            $tab_title = get_post_meta( $articles->ID, 'eaarticles_tab'. $i . "_title", true );
            $tab_state = get_post_meta( $articles->ID, 'eaarticles_tab'. $i . "_state", true );
            $tab_type = get_post_meta( $articles->ID, 'eaarticles_tab'. $i . "_type", true );
            $tab_down_page = get_post_meta( $articles->ID, 'eaarticles_tab'. $i . "_dpage", true );
            $tab_down_url = get_post_meta( $articles->ID, 'eaarticles_tab'. $i . "_durl", true );
            $tab_val = get_post_meta( $articles->ID, 'eaarticles_tab'. $i . "_val", true );

            if (empty($tab_down_page)) $tab_down_page = "#";
            if (empty($tab_down_url)) $tab_down_url = "#";
            ?>
            <div id="tab_<?php echo $i ; ?>" class="tab-pane fade <?php if ($i==1){echo 'in active'; } ?>">
                <div class="container-fluid">
                    <div class="form-group">
                        <div class="row" style="padding-top: 10px">
                            <div class="col-lg-6">
                                <label for="eaarticles_tab<?php echo $i;?>_state">Visibility</label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" id="eaarticles_tab<?php echo $i;?>_state" name="eaarticles_tab<?php echo $i;?>_state" type="checkbox" data-toggle="toggle" <?php if ($tab_state=="on") echo "checked"?> >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="padding-top: 10px">
                            <div class="col-lg-6">
                                <label for="eaarticles_tab<?php echo $i;?>_title">Title</label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" id="eaarticles_tab<?php echo $i;?>_title" name="eaarticles_tab<?php echo $i;?>_title" type="text" value="<?php echo  $tab_title ; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="padding-top: 10px">
                            <div class="col-lg-6">
                                <label for="eaarticles_tab<?php echo $i;?>_durl">Download Source URL</label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" id="eaarticles_tab<?php echo $i;?>_durl" name="eaarticles_tab<?php echo $i;?>_durl" type="text"  value="<?php echo  $tab_down_url ; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="padding-top: 10px">
                            <div class="col-lg-6">
                                <label for="eaarticles_tab<?php echo $i;?>_dpage">Download Page URL</label>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" id="eaarticles_tab<?php echo $i;?>_dpage" name="eaarticles_tab<?php echo $i;?>_dpage" type="text"  value="<?php echo  $tab_down_page ; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="padding-top: 10px">
                            <div class="col-lg-6">
                                <label for="eaarticles_tab<?php echo $i;?>_type">Content Type</label>
                            </div>
                            <div class="col-lg-6">
                                <select  class="form-control ea_articles_tab_type" id="eaarticles_tab<?php echo $i;?>_type" name="eaarticles_tab<?php echo $i;?>_type">
                                    <option value="pdf" <?php if ($tab_type=="pdf") echo "selected"?>>PDF</option>
                                    <option value="gallery" <?php if ($tab_type=="gallery") echo "selected"?> >Gallery</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="padding-top: 10px">
                            <div class="col-lg-6">
                                <label for="eaarticles_tab<?php echo $i;?>_val">Content</label>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if ($tab_type=="pdf")
                                {
                                 ?>
                                    <button type="button" class="btn btn-primary ea_articles_tab_content_upload" id="eaarticles_tab<?php echo $i; ?>_upload">Upload PDF</button>
                                    <button type="button" class="btn btn-primary ea_articles_tab_content_url" id="eaarticles_tab<?php echo $i; ?>_url">Insert URL</button>
                                    <?php
                                    if (!empty($tab_val))
                                    {
                                        $tab_val_url = parse_url($tab_val, PHP_URL_PATH);
                                        $tab_val_fname = basename($tab_val_url);
                                    ?>
                                    <div id="eaarticles_tab<?php echo $i; ?>_preview" style="padding: 20px">
                                        <span style="font-size: 50px" class="dashicons dashicons-book"></span>
                                        <a target="_blank" href="<?php echo $tab_val;?>" style="padding-top:28px; display:block; "><?php echo  $tab_val_fname ?></a>
                                    </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div id="eaarticles_tab<?php echo $i; ?>_preview" style="padding: 20px;display: none;">
                                            <span style="font-size: 50px" class="dashicons dashicons-book"></span>
                                            <a target="_blank" href="#" style="padding-top:28px; display:block; "></a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <input class="ea_articles_tab_content" id="eaarticles_tab<?php echo $i;?>_val" name="eaarticles_tab<?php echo $i;?>_val" type="hidden"  value="<?php echo $tab_val; ?>">
                                    <?php
                                }
                                elseif ($tab_type=="gallery")
                                {
                                    ?>
                                    <select class="form-control ea_articles_tab_content" id="eaarticles_tab<?php echo $i;?>_val" name="eaarticles_tab<?php echo $i;?>_val">
                                        <?php
                                            $galleries = get_terms( array(
                                                'taxonomy' => 'eagallery',
                                                'hide_empty' => false,
                                            ));
                                                if ( ! empty( $galleries ) && ! is_wp_error( $galleries ) ){
                                                    foreach ( $galleries as $gallery ) {
                                                        ?>

                                                        <option value="<?php echo $gallery->term_id; ?>"  <?php if ($tab_val==$gallery->term_id)echo "selected"?>><?php echo $gallery->name; ?></option>
                                                     <?php
                                                    }
                                                }
                                        ?>
                                    </select>


                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="button" class="btn btn-primary ea_articles_tab_content_upload" id="eaarticles_tab<?php echo $i; ?>_upload">Upload PDF</button>
                                    <button type="button" class="btn btn-primary ea_articles_tab_content_url" id="eaarticles_tab<?php echo $i; ?>_url">Insert URL</button>
                                    <?php
                                    if (!empty($tab_val))
                                    {
                                        $tab_val_url = parse_url($tab_val, PHP_URL_PATH);
                                        $tab_val_fname = basename($tab_val_url);
                                        ?>
                                        <div id="eaarticles_tab<?php echo $i; ?>_preview" style="padding: 20px">
                                            <span style="font-size: 50px" class="dashicons dashicons-book"></span>
                                            <a target="_blank" href="<?php echo $tab_val;?>" style="padding-top:28px; display:block; "><?php echo  $tab_val_fname ?></a>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div id="eaarticles_tab<?php echo $i; ?>_preview" style="padding: 20px;display: none;">
                                            <span style="font-size: 50px" class="dashicons dashicons-book"></span>
                                            <a target="_blank" href="#" style="padding-top:28px; display:block; "></a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <input class="ea_articles_tab_content" id="eaarticles_tab<?php echo $i;?>_val" name="eaarticles_tab<?php echo $i;?>_val" type="hidden"  value="<?php echo $tab_val; ?>">
                                    <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
            </div>
        </div>
        <?php
    }

    function save_eaarticle(){
        global $post;

        $tabcount = intval( get_post_meta( $post->ID, 'eaarticles_tabcount', true ) );

        for($i=1;$i<=$tabcount; $i++) {
            update_post_meta($post->ID, 'eaarticles_tab'. $i . "_title", $_POST['eaarticles_tab'. $i . "_title"]);
            update_post_meta($post->ID, 'eaarticles_tab'. $i . "_state", $_POST['eaarticles_tab'. $i . "_state"]);
            update_post_meta($post->ID, 'eaarticles_tab'. $i . "_type", $_POST['eaarticles_tab'. $i . "_type"]);
            update_post_meta($post->ID, 'eaarticles_tab'. $i . "_dpage", $_POST['eaarticles_tab'. $i . "_dpage"]);
            update_post_meta($post->ID, 'eaarticles_tab'. $i . "_durl", $_POST['eaarticles_tab'. $i . "_durl"]);
            update_post_meta($post->ID, 'eaarticles_tab'. $i . "_val", $_POST['eaarticles_tab'. $i . "_val"]);
        }

        update_post_meta($post->ID, "eaarticles_subtitle", $_POST["ea_article_detail_sub"]);
        update_post_meta($post->ID, "eaarticles_tabcount", $_POST["ea_article_detail_tabcount"]);


    }

    function populate_ea_article_metas() {

        //add_action( 'admin_enqueue_scripts', array($this,'enqueue_styles') );
        //add_action( 'admin_enqueue_scripts', array($this,'enqueue_scripts') );

        //wp_enqueue_style( "bootstrap.min.css", plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
        add_action( 'add_meta_boxes_eaarticles' , array($this,'remove_gallery_metabox') );

        add_meta_box( 'eaarticles_meta_details',
            'Article details',
            array($this,"display_ea_article_detals"),
            'eaarticles', 'normal', 'high'
        );

        add_meta_box( 'eaarticles_meta_tab',
            'Article Tabs',
            array($this,"display_ea_article_tabs"),
            'eaarticles', 'normal', 'high'
        );


    }


    function get_eagallery()
    {
        $galleries = get_terms( array(
            'taxonomy' => 'eagallery',
            'hide_empty' => false,
        ));
        $arr = array();
        if ( ! empty( $galleries ) && ! is_wp_error( $galleries ) ){
            foreach ( $galleries as $gallery ) {
                array_push($arr,array('id'=>$gallery->term_id,'name'=>$gallery->name));
            }
        }

        echo json_encode($arr);
    }
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Easycubes_App_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easycubes_App_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easycubes-app-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( "bootstrapmincss", plugin_dir_url( __FILE__ ) . 'css/bootstrap-wrapper.less', array(), $this->version, 'all' );
		//wp_enqueue_style( "jquery.dataTables.min.css", plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Easycubes_App_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easycubes_App_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */


		wp_enqueue_script( "bootstrap.min.js", plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "bootstrap-hack.js", plugin_dir_url( __FILE__ ) . 'js/bootstrap-hack.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( "bootstrap-toggle.min.js", plugin_dir_url( __FILE__ ) . 'js/bootstrap-toggle.min.js', array( 'jquery' ), $this->version, false );
		//wp_enqueue_script( "jquery.dataTables.min.js", plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
		//wp_enqueue_script( "jquery.validate.min.js", plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );
		//wp_enqueue_script( "jquery.notifyBar.js", plugin_dir_url( __FILE__ ) . 'js/jquery.notifyBar.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easycubes-app-admin.js', array( 'jquery' ), $this->version, false );

	}

    function eapp_menu_sections()
    {
       // add_menu_page("Partner Articles","Easycubes App","manage_options","easycubes_app",array($this,"easycubes_app_list"),"dashicons-images-alt");
       // add_submenu_page("easycubes_app","Artciles","Artciles","manage_options","easycubes_app",array($this,"easycubes_app_list"));
        //add_submenu_page("easycubes_app","Add New Article","Add New Article","manage_options","easycubes_app_add_articles",array($this,"easycubes_app_add_articles"));
        //add_submenu_page("easycubes_app","Folders","Folders","manage_options","easycubes_app_folders",array($this,"easycubes_app_folders"));
        add_submenu_page('edit.php?post_type=eaarticles', "Easycubes App Management", 'Manage', 'manage_options',"easycubes_app_management", array($this, 'easycubes_app_manage'));
    }


    public function easycubes_app_manage()
    {
        include_once EASYCUBES_APP_PLUGIN_DIR . "/admin/partials/easycubes-app-admin-manage.php";
    }


}
