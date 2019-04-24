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
            'name'                  => _x( 'Easycubes Partner App Articles', 'Post type general name', 'textdomain' ),
            'singular_name'         => _x( 'Easycubes Partner App Article', 'Post type singular name', 'textdomain' ),
            'menu_name'             => _x( 'Easycubes App', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar'        => _x( 'Easycubes Partner App Article', 'Add New on Toolbar', 'textdomain' ),
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


        $labels = array(
            'name'              => _x( 'Addresses', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Address', 'taxonomy singular name', 'textdomain' ),
            'menu_name'         => _x( 'Addresses', 'Admin Menu text', 'textdomain' ),
            'search_items'      => __( 'Search Address', 'textdomain' ),
            'all_items'         => __( 'All Addresses', 'textdomain' ),
            'parent_item'       => __( 'Parent Address', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Address:', 'textdomain' ),
            'edit_item'         => __( 'Edit Address', 'textdomain' ),
            'update_item'       => __( 'Update Address', 'textdomain' ),
            'add_new_item'      => __( 'Add New Address', 'textdomain' ),
            'new_item_name'     => __( 'New Genre Address', 'textdomain' ),
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'sort'              => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'eaaddresses' ),
        );

        register_taxonomy( 'eaaddresses', array( 'eaarticles' ), $args );


        $labels = array(
            'name'              => _x( 'Products', 'taxonomy general name', 'textdomain' ),
            'singular_name'     => _x( 'Product', 'taxonomy singular name', 'textdomain' ),
            'menu_name'         => _x( 'Products', 'Admin Menu text', 'textdomain' ),
            'search_items'      => __( 'Search Products', 'textdomain' ),
            'all_items'         => __( 'All Products', 'textdomain' ),
            'parent_item'       => __( 'Parent Product', 'textdomain' ),
            'parent_item_colon' => __( 'Parent Product:', 'textdomain' ),
            'edit_item'         => __( 'Edit Product', 'textdomain' ),
            'update_item'       => __( 'Update Product', 'textdomain' ),
            'add_new_item'      => __( 'Add New Product', 'textdomain' ),
            'new_item_name'     => __( 'New Genre Product', 'textdomain' ),
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'sort'              => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'eaproducts' ),
        );

        register_taxonomy( 'eaproducts', array( 'eaarticles' ), $args );

        add_action( 'eafolders_edit_form_fields', array($this,'display_ea_folders_img'), 10, 2);
        add_action( 'eagallery_edit_form_fields', array($this,'display_eagallery_images'), 10, 2);
        add_action( 'eaaddresses_edit_form_fields', array($this,'display_eaaddress_locations'), 10, 2);
        add_action( 'eaproducts_edit_form_fields', array($this,'display_product_attributes'), 10, 2);
        //add_action( 'eafolders_add_form_fields', array($this,'display_ea_folders_img'), 10, 2);

        add_action( 'edited_eafolders', array($this,'save_ea_folders_img'), 10, 2);
        add_action( 'edited_eagallery', array($this,'save_eagallery_media'), 10, 2);
        add_action( 'edited_eaaddresses', array($this,'save_eaaddress_locations'), 10, 2);
        add_action( 'edited_eaproducts', array($this,'save_eaproducts_attrs'), 10, 2);
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

    function save_eaaddress_locations( $term_id ) {
        if ( isset( $_POST['eaaddresses_json'] ) ) {
            $t_id = $term_id;
            //save the option array
            update_option( "eaaddress_taxonomy_$t_id" . "_locs", $_POST['eaaddresses_json'] );
        }

    }

    function save_eaproducts_attrs( $term_id ) {
        $t_id = $term_id;

        if ( isset( $_POST['eaproduct_price'] ) ) {
            //save the option array

            update_option( "eaproducts_taxonomy_$t_id" . "_price", $_POST['eaproduct_price'] );
        }

        if ( isset( $_POST['eaproduct_item_in_pack'] ) ) {
            //save the option array
            update_option( "eaproducts_taxonomy_$t_id" . "_itempack", $_POST['eaproduct_item_in_pack'] );
        }

        if ( isset( $_POST['eaproduct_size'] ) ) {
            //save the option array
            update_option( "eaproducts_taxonomy_$t_id" . "_size", $_POST['eaproduct_size'] );
        }

        if ( isset( $_POST['eaproduct_weight'] ) ) {
            //save the option array
            update_option( "eaproducts_taxonomy_$t_id" . "_weight", $_POST['eaproduct_weight'] );
        }

        if ( isset( $_POST['eaproduct_url'] ) ) {
            //save the option array
            update_option( "eaproducts_taxonomy_$t_id" . "_url", $_POST['eaproduct_url'] );
        }

    }

    function remove_gallery_metabox() {
        remove_meta_box( 'tagsdiv-eagallery', 'eaarticles', 'side' );
    }

    function display_product_attributes($product){
        $t_id = $product->term_id;

        $product_price = get_option( "eaproducts_taxonomy_$t_id" . "_price");
        $product_itempack = get_option( "eaproducts_taxonomy_$t_id" . "_itempack");
        $product_size = get_option( "eaproducts_taxonomy_$t_id" . "_size");
        $product_weight = get_option( "eaproducts_taxonomy_$t_id" . "_weight");
        $product_url = get_option( "eaproducts_taxonomy_$t_id" . "_url");

        $product_price = doubleval($product_price);
        $product_itempack = intval($product_itempack);

        // Media Init
        wp_enqueue_media();
        //The media upload path is changed to a custom folder

        if (get_class($product) == "WP_Term")
        {
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="eagallery_image_path"><?php _e('Attributes'); ?></label></th>
                <td>
                    <div class="bootstrap-wrapper">
                        <div class="form-group">
                            <div class="row" style="padding-top: 10px">
                                <div class="col-lg-12">
                                    <div class="col-lg-3">
                                        <label for="eaproduct_price">
                                            Price (&euro;):
                                            <input id="eaproduct_price" class="form-control"  name="eaproduct_price" type="number" min="0" step="0.01" max="99999" value="<?php echo $product_price ?>" />

                                        </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="eaproduct_item_in_pack">
                                            Item in package:
                                            <input id="eaproduct_item_in_pack" class="form-control"  name="eaproduct_item_in_pack" type="number" min="0" step="1" max="999999999" value="<?php echo  $product_itempack; ?>" />
                                        </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="eaproduct_size">
                                            Size (cm):
                                            <input id="eaproduct_size" class="form-control"  name="eaproduct_size" type="text"  value="<?php echo $product_size; ?>" />
                                        </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="eaproduct_weight">
                                            Weight (g):
                                            <input id="eaproduct_weight" class="form-control"  name="eaproduct_weight" type="number" min="0" step="0.01" max="99999" value="<?php echo  $product_weight; ?>" />
                                        </label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="eaproduct_url" style="width:100%;">
                                            Product Link (g):
                                            <input style="width: 100%;" id="eaproduct_url" class="form-control" name="eaproduct_url" type="text" placeholder="http://" value="<?php echo $product_url; ?>" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>




            <?php
        }


    }
    function display_eaaddress_locations($address){
        $t_id = $address->term_id;
        $term_meta_locs = get_option( "eaaddress_taxonomy_$t_id" . "_locs");
        $term_meta_locs = urldecode($term_meta_locs);
        // Media Init
        wp_enqueue_media();
        //The media upload path is changed to a custom folder


        if (get_class($address) == "WP_Term")
        {
            ?>
            <div class="bootstrap-wrapper">


                <div class="row">
                        <table class="table loc-table">
                            <caption>
                                <div class="bootstrap-wrapper">
                                    <div class="row">
                                        <button class="loc-add-btn btn btn-primary col-lg-3" id="loc-add-btn" type="button"> <span class="glyphicon glyphicon-plus-sign"></span> Add </button>
                                        <button class="loc-rmv-btn btn btn-danger col-lg-3 col-lg-offset-6" id="loc-rmv-btn" type="button"> <span class="glyphicon glyphicon-remove-sign"></span> Remove Selected</button>
                                    </div>
                                </div>
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col">Locations</th>
                                    <th scope="col">Prices</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>

                </div>


                <input type="hidden" name="eaaddresses_json" id="eaaddresses-json" value='<?php echo stripslashes($term_meta_locs); ?>'/>

            </div>

            <?php
        }

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

                    <div id="eagallery_image_paths" class="bootstrap-wrapper">
                        <?php
                        if (!empty($term_meta))
                        {
                            $medias = json_decode($term_meta);

                            foreach ($medias as $media)
                            {
                                ?>
                                <div class="form-group ui-state-default">
                                    <input type="hidden" class="form-control" name="eagallery_media[]" value="<?php echo $media; ?>"/>
                                    <?php

                                    if (strpos($media, 'https://www.youtube.com/embed/') !== false) {
                                        $arr = explode('https://www.youtube.com/embed/', $media);
                                        $ytid = $arr[1];
                                        $ytthumb = "http://img.youtube.com/vi/$ytid/0.jpg";
                                        ?>
                                        <div class="">
                                            <span class="dashicons dashicons-trash eagallery-media-close"></span>
                                            <div class="thumbnail-overlay-vid">
                                                <i class="dashicons dashicons-video-alt3"></i>
                                            </div>
                                            <img height="200px" width="200px" src="<?php echo $ytthumb; ?>">


                                        </div>

                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="">
                                            <span class="dashicons dashicons-trash eagallery-media-close"></span>
                                            <img height="200px" width="200px"  src="<?php echo $media; ?>">
                                        </div>
                                        <?php
                                    }

                                    ?>


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
        $tags =  get_post_meta( $articles->ID, 'eaarticles_tags', true ) ;
        $product_type =  get_post_meta( $articles->ID, 'eaarticles_product_type', true ) ;
        $product_type_buyable =  get_post_meta( $articles->ID, 'eaarticles_product_type_buyable', true ) ;
        $tabcount = intval( get_post_meta( $articles->ID, 'eaarticles_tabcount', true ) );
        $product_price = doubleval(get_post_meta( $articles->ID, 'eaarticles_price', true )) ;
        $product_itempack = intval(get_post_meta( $articles->ID, 'eaarticles_item_pack', true )) ;
        $product_size = get_post_meta( $articles->ID, 'eaarticles_prodsize', true ) ;
        $product_weight = doubleval(get_post_meta( $articles->ID, 'eaarticles_weight', true )) ;
        $product_url = get_post_meta( $articles->ID, 'eaarticles_produrl', true ) ;

        if (empty($product_type_buyable))
        {
            $product_type_buyable = 'yes';
        }

        ?>
        <div style="display: block; padding: 5px 0">
            <div style="width: 50%; display: block;">
                <label style="width: 50%; display: block; padding:10px 0px; font-weight: bold" for="ea_article_detail_sub">Subtitle</label>
                <textarea style="width: 100%;" id="ea_article_detail_sub" name="ea_article_detail_sub" ><?php echo $subtitle ?></textarea>

            </div>
        </div>
        <div class="form-group">
            <div class="row" style="padding-top: 10px">
                <div class="col-lg-6">
                    <label for="eaarticles_product_type">Product Type</label>
                </div>
                <div class="col-lg-6">
                    <select  class="form-control eaarticles_product_type" id="eaarticles_product_type" name="eaarticles_product_type">
                        <option value="digital" <?php if ($product_type=="digital") echo "selected"?>>Digital Product</option>
                        <option value="physical" <?php if ($product_type=="physical") echo "selected"?> >Physical Goods</option>
                    </select>
                </div>
            </div>
        </div>

        <?php if ($product_type=="physical"){  ?>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-6">
                    <label for="eaarticles_product_type_buyable">Product Buyable?</label>
                </div>
                <div class="col-lg-6">
                    <select  class="form-control eaarticles_product_type_buyable" id="eaarticles_product_type_buyable" name="eaarticles_product_type_buyable">
                        <option value="yes" <?php if ($product_type_buyable=="yes") echo "selected"?>>Yes</option>
                        <option value="no" <?php if ($product_type_buyable=="no") echo "selected"?> >No</option>
                    </select>
                </div>
            </div>
        </div>

            <?php if ($product_type_buyable=="yes"){  ?>
                <div class="form-group">
                    <div class="row" style="padding-top: 10px">
                        <div class="col-lg-6">
                            <label>Product Attributes</label>
                        </div>
                        <div class="col-lg-6 bootstrap-wrapper">
                            <div class="col-lg-3">
                                <label for="eaarticles_product_price">
                                    Price (&euro;):
                                    <input id="eaarticles_product_price" class="form-control"  name="eaarticles_product_price" type="number" min="0" step="0.01" max="99999" value="<?php echo $product_price ?>" />

                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label for="eaarticles_product_item_in_pack">
                                    Item in package:
                                    <input id="eaarticles_product_item_in_pack" class="form-control"  name="eaarticles_product_item_in_pack" type="number" min="0" step="1" max="999999999" value="<?php echo  $product_itempack; ?>" />
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label for="eaarticles_product_size">
                                    Size (cm):
                                    <input id="eaarticles_product_size" class="form-control"  name="eaarticles_product_size" type="text"  value="<?php echo $product_size; ?>" />
                                </label>
                            </div>
                            <div class="col-lg-3">
                                <label for="eaarticles_product_weight">
                                    Weight (g):
                                    <input id="eaarticles_product_weight" class="form-control"  name="eaarticles_product_weight" type="number" min="0" step="0.01" max="99999" value="<?php echo  $product_weight; ?>" />
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label for="eaarticles_product_url">
                                    Product Link (g):
                                    <input id="eaarticles_product_url" class="form-control" name="eaarticles_product_url" type="text" placeholder="http://" value="<?php echo $product_url; ?>" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        <?php } ?>
        <div style="display: block; padding: 5px 0">
            <div style="width: 50%; display: block;">
                <label style="width: 50%; display: block; padding:10px 0px; font-weight: bold" for="ea_article_detail_tags">Tags ( Comma[,] delimited )</label>
                <input style="width: 100%;" class="form-control" type="text" name="ea_article_detail_tags" id="ea_article_detail_tags" placeholder="Tags seperated by comma" value="<?php echo  $tags;?>"/>

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
                                    <div class="col-lg-6 tab-title-inputwrap">
                                        <input autocomplete="off" class="form-control" id="eaarticles_tab<?php echo $i;?>_title" name="eaarticles_tab<?php echo $i;?>_title" type="text" value="<?php echo  $tab_title ; ?>" >
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
                                        <button type="button" class="btn btn-primary pull-right ea_articles_tab_content_upload_getUrl">Upload</button>
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
                                        <button type="button" class="btn btn-primary pull-right ea_articles_tab_content_upload_getUrl">Upload</button>
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
                                            <option value="urlembed" <?php if ($tab_type=="urlembed") echo "selected"?> >Embeded URL Frames</option>
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

                                                        <option value="<?php echo $gallery->slug; ?>"  <?php if ($tab_val==$gallery->slug)echo "selected"?>><?php echo $gallery->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>


                                            <?php
                                        }
                                        elseif ($tab_type=="urlembed")
                                        {
                                            ?>
                                            <input class="ea_articles_tab_content form-control" id="eaarticles_tab<?php echo $i;?>_val" name="eaarticles_tab<?php echo $i;?>_val" type="text"  value="<?php echo $tab_val; ?>">

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
        update_post_meta($post->ID, "eaarticles_tags", $_POST["ea_article_detail_tags"]);
        update_post_meta($post->ID, "eaarticles_tabcount", $_POST["ea_article_detail_tabcount"]);
        update_post_meta($post->ID, "eaarticles_product_type", $_POST["eaarticles_product_type"]);
        update_post_meta($post->ID, "eaarticles_product_type_buyable", $_POST["eaarticles_product_type_buyable"]);

        update_post_meta($post->ID, "eaarticles_price", $_POST["eaarticles_product_price"]);
        update_post_meta($post->ID, "eaarticles_item_pack", $_POST["eaarticles_product_item_in_pack"]);
        update_post_meta($post->ID, "eaarticles_prodsize", $_POST["eaarticles_product_size"]);
        update_post_meta($post->ID, "eaarticles_weight", $_POST["eaarticles_product_weight"]);
        update_post_meta($post->ID, "eaarticles_produrl", $_POST["eaarticles_product_url"]);


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
        wp_enqueue_style( "jquerycontextMenumincss", 'https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css', array(), $this->version, 'all' );
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
        wp_enqueue_script( $this->plugin_name, 'https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name, 'https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js', array( 'jquery' ), $this->version, false );

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
    public function eapartner_app_accesskey()
    {
        if (isset($_POST['akeys']))
        {
            update_option("easycubes_app_accesskeys",json_encode($_POST['akeys']));
        }

        if (isset($_POST['akeysType']))
        {
            update_option("easycubes_app_accesskeysType",json_encode($_POST['akeysType']));
        }

        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
            header("location: $previous");
        }
    }

    public function eapartner_app_backup()
    {

        $importer = array();

        $wp_content_importer = array();
        $wp_content_importer_counter = 0;

        $eafolders = get_terms( array(
            'taxonomy' => 'eafolders',
            'orderby' => 'parent',
            'order' => 'ASC',
        ));

        if (!empty($eafolders)){
            $eafolders_array = array();
            foreach ($eafolders as $eafolder)
            {
                $t_id = $eafolder->term_id;
                $eafolder = (array) $eafolder;
                $eafolder['img'] =  get_option( "eafolder_taxonomy_$t_id" . "_fimg");
                if (!empty($eafolder['img']))
                {
                    $wp_content_importer[$wp_content_importer_counter++] = str_replace(get_site_url().'/wp-content','',$eafolder['img']);
                }

                $eafolder['img'] = str_replace(get_site_url().'/wp-content','{WP_CONTENT_PATH}',$eafolder['img']);

                array_push($eafolders_array,$eafolder);
            }
            $importer['eafolders'] = $eafolders_array;
        }


        $eagalleries = get_terms( array(
            'taxonomy' => 'eagallery',
            'hide_empty' => false
        ));


        if (!empty($eagalleries)){
            $eagalleries_array = array();
            foreach ($eagalleries as $eagallery)
            {
                $t_id = $eagallery->term_id;
                $eagallery = (array) $eagallery;
                $eagallery['media'] =  get_option( "eagallery_taxonomy_$t_id" . "_media");

                $medias = json_decode($eagallery['media']);

                foreach ($medias as $key => $media)
                {
                    if (strpos($media, get_site_url().'/wp-content') !== false) {
                        if (!empty($media))
                        {
                            $wp_content_importer[$wp_content_importer_counter++] = str_replace(get_site_url().'/wp-content','',$media);
                            $medias[$key] = str_replace(get_site_url().'/wp-content','{WP_CONTENT_PATH}',$media);
                        }
                    }
                }
                $eagallery['media'] = $medias;

                array_push($eagalleries_array,$eagallery);
            }
            $importer['eagalleries'] = $eagalleries_array;
        }

        $the_query = new WP_Query( array(
            'post_type' => 'eaarticles',
            'posts_per_page' => -1
        ));

        if ($the_query->have_posts()) {
            $posts = array();
            while ($the_query->have_posts())
            {
                $the_query->the_post();
                $post = $the_query->post;
                $tabcount = intval( get_post_meta( $post->ID, 'eaarticles_tabcount', true ));
                $tabs = array();
                $thumbnail = get_the_post_thumbnail_url($post,'full');
                if (!empty($thumbnail))
                {
                    if (strpos($thumbnail, get_site_url().'/wp-content') !== false) {
                        $wp_content_importer[$wp_content_importer_counter++] = str_replace(get_site_url().'/wp-content','',$thumbnail);
                        $thumbnail = str_replace(get_site_url().'/wp-content','{WP_CONTENT_PATH}',$thumbnail);
                    }
                }

                for($i=1;$i<=$tabcount; $i++) {

                    $title = get_post_meta($post->ID,'eaarticles_tab'. $i . "_title");
                    $state = get_post_meta($post->ID,'eaarticles_tab'. $i . "_state");
                    $type = get_post_meta($post->ID,'eaarticles_tab'. $i . "_type");
                    $dpage = get_post_meta($post->ID,'eaarticles_tab'. $i . "_dpage");
                    $durl = get_post_meta($post->ID,'eaarticles_tab'. $i . "_durl");
                    $val = get_post_meta($post->ID,'eaarticles_tab'. $i . "_val");

                    if ($title) $title = $title[0];
                    if ($state) $state = $state[0];
                    if ($type) $type = $type[0];
                    if ($dpage) $dpage = $dpage[0];
                    if ($durl) $durl = $durl[0];
                    if ($val) $val = $val[0];

                    if (strpos($dpage, get_site_url().'/wp-content') !== false) {
                        if (!empty($dpage) && $dpage !== "#")
                        {
                            $wp_content_importer[$wp_content_importer_counter++] = str_replace(get_site_url().'/wp-content','',$dpage);
                            $dpage = str_replace(get_site_url().'/wp-content','{WP_CONTENT_PATH}',$dpage);
                        }
                    }

                    if (strpos($durl, get_site_url().'/wp-content') !== false) {
                        if (!empty($durl) && $durl !== "#")
                        {
                            $wp_content_importer[$wp_content_importer_counter++] = str_replace(get_site_url().'/wp-content','',$durl);
                            $durl = str_replace(get_site_url().'/wp-content','{WP_CONTENT_PATH}',$durl);
                        }
                    }

                    if (strpos($val, get_site_url().'/wp-content') !== false) {
                        if (!empty($val))
                        {
                            $wp_content_importer[$wp_content_importer_counter++] = str_replace(get_site_url().'/wp-content','',$val);
                            $val = str_replace(get_site_url().'/wp-content','{WP_CONTENT_PATH}',$val);
                        }
                    }

                    array_push($tabs,array('title'=>$title,'state'=>$state,'type'=>$type,'dpage'=>$dpage,'durl'=>$durl,'val'=>$val));
                }

                $subtitle = get_post_meta($post->ID,"eaarticles_subtitle");
                $tags = get_post_meta($post->ID,"eaarticles_tags");
                $tabcount = get_post_meta($post->ID,"eaarticles_tabcount");
                $product_type = get_post_meta($post->ID,"eaarticles_product_type");
                if ($subtitle) $subtitle = $subtitle[0];
                if ($tags) $tags = $tags[0];
                if ($tabcount) $tabcount = $tabcount[0];
                if ($product_type) $product_type = $product_type[0];


                $post = (array) $post;
                $post['subtitle'] = $subtitle;
                $post['tags'] = $tags;
                $post['tabcount'] = $tabcount;
                $post['product_type'] = $product_type;
                $post['tabs'] = $tabs;
                $post['thumbnail'] = $thumbnail;
                $term_list = get_the_terms($the_query->post, 'eafolders');

                if (!is_wp_error($term_list))
                {
                    $term_list = (array) $term_list;
                    $eafolder_slugs = array();
                    foreach ($term_list as $k => $term)
                    {
                        $eafolder_slugs[$k] = $term->slug;
                    }
                    $post['eafolders'] = $eafolder_slugs;
                }

                array_push($posts,$post);
                //echo $the_query->post->post_title . "</br>";
            }
            $importer['eaarticles'] = $posts;
        }

        $wp_content_importer = array_unique($wp_content_importer);


        $zipname = WP_CONTENT_DIR . '/backup/eapartnerapp/partner-app-backup-'. date('Y-m-d') .'.zip';

        if (PHP_OS == "Windows" || PHP_OS == "WINNT" )
        {
            $zipname = str_replace('/','\\',$zipname);
        }

        if (!file_exists(dirname(($zipname)))) {
            mkdir(dirname($zipname), 0777, true);
        }

        if (!empty($wp_content_importer))
        {
            $importer['content'] = $wp_content_importer;
            $za = new ZipArchive;
            $zipOpen = $za->open($zipname,ZipArchive::CREATE|ZipArchive::OVERWRITE);
            if ($zipOpen)
            {
                $za->addFromString('contents.json',json_encode($importer));
            }

            foreach ($wp_content_importer as $item)
            {
                if ($item)
                {
                    $item = ltrim($item,'/');
                    if (PHP_OS == "Windows" || PHP_OS == "WINNT" )
                    {
                        $file_path =  WP_CONTENT_DIR . '\\' . str_replace('/','\\',$item);
                    }
                    else
                    {
                        $file_path =  WP_CONTENT_DIR . '/' . $item;
                    }



                    $add_to_zip = $za->addFile($file_path,'backup/'.$item);
                }
            }
        }



        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.basename($zipname));
        header('Content-Length: ' . filesize($zipname));

        readfile($zipname);

    }

    public function eapartner_app_restore()
    {
        ini_set('display_errors','off');
        error_reporting(E_ALL);
        if (isset($_FILES['eapartnerapp_restore_file']))
        {
            $backup_file = $_FILES['eapartnerapp_restore_file'];
            if ($backup_file['type'] == 'application/x-zip-compressed')
            {
                $store_dir = WP_CONTENT_DIR . '/backup/eapartnerapp';
                if (!file_exists($store_dir))
                {
                    mkdir($store_dir, 0777, true);
                }
                if(file_exists($store_dir. '/'. basename($backup_file['name']))) unlink($store_dir. '/'. basename($backup_file['name']));

                move_uploaded_file($backup_file['tmp_name'],$store_dir. '/'. basename($backup_file['name']) );
                $zip = new ZipArchive;
                $res = $zip->open($store_dir. '/'. basename($backup_file['name']));
                if ($res)
                {
                    $exporter_json = $zip->getFromName('contents.json');
                    if ($exporter_json)
                    {
                        $exporter_array = json_decode($exporter_json);

                        if ($exporter_array)
                        {

                            $pathinfo  = pathinfo($store_dir. '/'. basename($backup_file['name']));
                            $filepath = $store_dir. '/'. $pathinfo['filename'];
                            $zip->extractTo( $filepath);
                            $the_files = scandir($filepath.'/backup/uploads');

                            $this->rmove($filepath.'/backup/uploads',WP_CONTENT_DIR . '/uploads');
                            if (PHP_OS == "Windows" || PHP_OS == "WINNT" )
                            {
                                $filepath = str_replace('/','\\',$filepath);
                            }
                            else
                            {
                                $filepath = str_replace('\\','/',$filepath);
                            }

                            $this->rmdir_recursive($filepath);

                            $exporter_array= get_object_vars($exporter_array);

                            $content_tracker = array();
                            $content_tracker_counter = 0;

                            if (isset($exporter_array['eafolders']))
                            {
                                if (!empty($exporter_array['eafolders']))
                                {
                                    $eafolders = $exporter_array['eafolders'];
                                    $eafolder_id_tracker = array();
                                    foreach ($eafolders as $key => $eafolder)
                                    {
                                        $eafolder= get_object_vars($eafolder);
                                        $term = get_term_by('slug', $eafolder['slug'], 'eafolders');

                                        if ($eafolder['parent']!==0)
                                        {
                                            if (isset($eafolder_id_tracker[$eafolder['parent']]))
                                            {
                                                $eafolder['parent'] = $eafolder_id_tracker[$eafolder['parent']];
                                            }
                                        }

                                        if (!$term)
                                        {
                                            $term = wp_insert_term($eafolder['name'],'eafolders',array(
                                                'description' => $eafolder['description'],
                                                'slug'        => $eafolder['slug'],
                                                'parent'      => $eafolder['parent'],
                                            ));
                                            if ($term && is_wp_error($term) == false)
                                            {
                                                $eafolder_id_tracker[$eafolder['term_id']] = $term['term_id'];
                                                $img = $eafolder['img'];
                                                if (!in_array($eafolder['img'],$content_tracker))
                                                {
                                                    $content_tracker[$content_tracker_counter++] = $eafolder['img'];
                                                    $this->Generate_Featured_Image($eafolder['img']);
                                                }

                                                update_option( "eafolder_taxonomy_" . $term['term_id'] . "_fimg",str_replace('{WP_CONTENT_PATH}',get_site_url().'/wp-content',$eafolder['img']));
                                            }

                                        }

                                    }

                                }
                            }
                            if (isset($exporter_array['eagalleries'])) {
                                if (!empty($exporter_array['eagalleries']))
                                {
                                    $eagalleries = $exporter_array['eagalleries'];
                                    foreach ($eagalleries as $key => $eagallery)
                                    {
                                        $eagallery= get_object_vars($eagallery);
                                        $term = get_term_by('slug', $eagallery['slug'], 'eagallery');
                                        if (!$term)
                                        {
                                            $term = wp_insert_term($eagallery['name'],'eagallery',array(
                                                'description' => $eagallery['description'],
                                                'slug'        => $eagallery['slug'],
                                                'parent'      => $eagallery['parent'],
                                            ));

                                            if ($term && is_wp_error($term) == false)
                                            {
                                                $medias = $eagallery['media'];
                                                if (!empty($medias))
                                                {
                                                    $medias = $eagallery['media'];

                                                    foreach ($medias as $key1 => $media)
                                                    {
                                                        if (!in_array($media,$content_tracker))
                                                        {
                                                            $content_tracker[$content_tracker_counter++] = $media;
                                                            $this->Generate_Featured_Image($media);
                                                        }

                                                        $medias[$key1] = str_replace('{WP_CONTENT_PATH}',get_site_url().'/wp-content',$media);
                                                    }
                                                    $medias = json_encode($medias);
                                                    update_option( "eagallery_taxonomy_".$term['term_id'] . "_media",$medias);

                                                }
                                            }
                                        }
                                    }

                                }




                            }

                            if (isset($exporter_array['eaarticles'])) {
                                if (!empty($exporter_array['eaarticles'])) {
                                    $eaarticles = $exporter_array['eaarticles'];



                                    foreach ($eaarticles as $key => $eaarticle)
                                    {
                                        $eaarticle = get_object_vars($eaarticle);
                                        $args = array(
                                            'name'        => $eaarticle['post_name'],
                                            'post_type'   => 'eaarticles',
                                            'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash'),
                                            'numberposts' => 1
                                        );

                                        $my_posts = new WP_Query($args);
                                        if ( !$my_posts->have_posts() )
                                        {
                                            $the_post = $eaarticle;
                                            unset(
                                                $the_post['ID'],
                                                $the_post['post_author'],
                                                $the_post['guid'],
                                                $the_post['subtitle'],
                                                $the_post['tags'],
                                                $the_post['tabcount'],
                                                $the_post['tabs'],
                                                $the_post['thumbnail'],
                                                $the_post['product_type'],
                                                $the_post['eafolder']

                                            );

                                            $post_id = wp_insert_post($the_post);

                                            if ($post_id!==0)
                                            {
                                                if (!in_array($eaarticle['thumbnail'],$content_tracker))
                                                {
                                                    $content_tracker[$content_tracker_counter++] = $eaarticle['thumbnail'];
                                                    $this->Generate_Featured_Image($eaarticle['thumbnail'],$post_id);

                                                    if (!empty($eaarticle['subtitle'])) update_post_meta($post_id, "eaarticles_subtitle", $eaarticle['subtitle']);
                                                    if (!empty($eaarticle['tags'])) update_post_meta($post_id, "eaarticles_tags", $eaarticle['tags']);
                                                    if (!empty($eaarticle['tabcount'])) update_post_meta($post_id, "eaarticles_tabcount", $eaarticle['tabcount']);
                                                    if (!empty($eaarticle['product_type'])) update_post_meta($post_id, "eaarticles_product_type", $eaarticle['product_type']);
                                                    if (!empty($eaarticle['eafolders']))
                                                    {
                                                        foreach ($eaarticle['eafolders'] as $eafolder_term)
                                                        {
                                                            $term_slug = get_term_by('slug', $eafolder_term, 'eafolders');
                                                            if ($term_slug)
                                                            {
                                                                wp_set_object_terms( $post_id, array($term_slug->term_id), 'eafolders',true );
                                                            }
                                                        }
                                                    }

                                                    $tabcount = intval($eaarticle['tabcount']);
                                                    $tabs = $eaarticle['tabs'];
                                                    for($i=1;$i<=$tabcount; $i++) {
                                                        $tab = $tabs[$i - 1];
                                                        $tab = (array)$tab;
                                                        if (!empty($tab['title'])) update_post_meta($post_id, 'eaarticles_tab'. $i . "_title", $tab['title']);
                                                        if (!empty($tab['state'])) update_post_meta($post_id, 'eaarticles_tab'. $i . "_state",$tab['state']);
                                                        if (!empty($tab['type'])) update_post_meta($post_id, 'eaarticles_tab'. $i . "_type", $tab['type']);
                                                        if (!empty($tab['dpage'])) update_post_meta($post_id, 'eaarticles_tab'. $i . "_dpage", $tab['dpage']);
                                                        if (!empty($tab['durl'])) update_post_meta($post_id, 'eaarticles_tab'. $i . "_durl", $tab['durl']);
                                                        if (!empty($tab['val'])) update_post_meta($post_id, 'eaarticles_tab'. $i . "_val", $tab['val']);


                                                        if (!in_array($tab['val'],$content_tracker))
                                                        {
                                                            $content_tracker[$content_tracker_counter++] = $tab['val'];
                                                            $this->Generate_Featured_Image($tab['val']);
                                                        }
                                                    }



                                                }


                                                //Set post metas
                                            }

                                        }
                                    }


                                }
                            }


                        }

                        if(isset($_SERVER['HTTP_REFERER'])) {
                            $previous = $_SERVER['HTTP_REFERER'];
                            header("location: $previous");
                        }

                    }
                    else
                    {
                        if(isset($_SERVER['HTTP_REFERER'])) {
                            $previous = $_SERVER['HTTP_REFERER'];
                            header("location: $previous");
                        }
                    }

                }

            }
            else
            {
                if(isset($_SERVER['HTTP_REFERER'])) {
                    $previous = $_SERVER['HTTP_REFERER'];
                    header("location: $previous");
                }
            }
        }
        else
        {
            if(isset($_SERVER['HTTP_REFERER'])) {
                $previous = $_SERVER['HTTP_REFERER'];
                header("location: $previous");
            }
        }
    }

    private function rmove($src, $dest){
        if (PHP_OS == "Windows" || PHP_OS == "WINNT" )
        {
            $src = str_replace('/','\\',$src);
            $dest = str_replace('/','\\',$dest);
        }
        else
        {
            $src = str_replace('\\','/',$src);
            $dest = str_replace('\\','/',$dest);
        }

        // If source is not a directory stop processing
        if(!is_dir($src)) return false;

        // If the destination directory does not exist create it
        if(!is_dir($dest)) {
            if(!mkdir($dest)) {
                // If the destination directory could not be created stop processing
                return false;
            }
        }

        // Open the source directory to read in files
        $i = new DirectoryIterator($src);
        foreach($i as $f) {
            if($f->isFile()) {
                rename($f->getRealPath(), "$dest/" . $f->getFilename());
            } else if(!$f->isDot() && $f->isDir()) {
                $this->rmove($f->getRealPath(), "$dest/$f");
                unlink($f->getRealPath());
            }
        }
        unlink($src);
    }

    private function rmdir_recursive($dir) {
        $it = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
        foreach($it as $file) {
            if ($file->isDir()) rmdir($file->getPathname());
            else unlink($file->getPathname());
        }
        rmdir($dir);
    }

    private function cvf_convert_object_to_array($data) {

        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        if (is_array($data)) {
            return array_map(__FUNCTION__, $data);
        }
        else {
            return $data;
        }
    }

    private function Generate_Featured_Image( $src_file_path, $post_id = null){

        if (strpos($src_file_path, '{WP_CONTENT_PATH}') !== false) {
            $file = str_replace("{WP_CONTENT_PATH}",WP_CONTENT_DIR,$src_file_path);
            $filename = basename($src_file_path);

            if (PHP_OS == "Windows" || PHP_OS == "WINNT" )
            {
                $file = str_replace('/','\\',$file);
            }
            else
            {
                $file = str_replace('\\','/',$file);
            }

            $wp_filetype = wp_check_filetype($filename, null );
            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name($filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
            $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
            if ($post_id)
            {
                set_post_thumbnail( $post_id, $attach_id );
            }
        }
    }

    public function Easycubes_App_register_required_plugins() {
        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(

            // This is an example of how to include a plugin from an arbitrary external source in your theme.
            array(
                'name'         => 'WP Term Order', // The plugin name.
                'slug'         => 'wp-term-order', // The plugin slug (typically the folder name).
                'required'     => true, // If false, the plugin is only 'recommended' instead of required.
            ),

        );

        /*
         * Array of configuration settings. Amend each line as needed.
         *
         * TGMPA will start providing localized text strings soon. If you already have translations of our standard
         * strings available, please help us make TGMPA even better by giving us access to these translations or by
         * sending in a pull-request with .po file(s) with the translations.
         *
         * Only uncomment the strings in the config array if you want to customize the strings.
         */
        $config = array(
            'id'           => 'easycubes-app',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'plugins.php',            // Parent menu slug.
            'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.

            /*
            'strings'      => array(
                'page_title'                      => __( 'Install Required Plugins', 'easycubes-app' ),
                'menu_title'                      => __( 'Install Plugins', 'easycubes-app' ),
                /* translators: %s: plugin name. * /
                'installing'                      => __( 'Installing Plugin: %s', 'easycubes-app' ),
                /* translators: %s: plugin name. * /
                'updating'                        => __( 'Updating Plugin: %s', 'easycubes-app' ),
                'oops'                            => __( 'Something went wrong with the plugin API.', 'easycubes-app' ),
                'notice_can_install_required'     => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'This theme requires the following plugin: %1$s.',
                    'This theme requires the following plugins: %1$s.',
                    'easycubes-app'
                ),
                'notice_can_install_recommended'  => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'This theme recommends the following plugin: %1$s.',
                    'This theme recommends the following plugins: %1$s.',
                    'easycubes-app'
                ),
                'notice_ask_to_update'            => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'easycubes-app'
                ),
                'notice_ask_to_update_maybe'      => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'easycubes-app'
                ),
                'notice_can_activate_required'    => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'easycubes-app'
                ),
                'notice_can_activate_recommended' => _n_noop(
                    /* translators: 1: plugin name(s). * /
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'easycubes-app'
                ),
                'install_link'                    => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'easycubes-app'
                ),
                'update_link' 					  => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'easycubes-app'
                ),
                'activate_link'                   => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'easycubes-app'
                ),
                'return'                          => __( 'Return to Required Plugins Installer', 'easycubes-app' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'easycubes-app' ),
                'activated_successfully'          => __( 'The following plugin was activated successfully:', 'easycubes-app' ),
                /* translators: 1: plugin name. * /
                'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'easycubes-app' ),
                /* translators: 1: plugin name. * /
            0

                'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'easycubes-app' ),
                /* translators: 1: dashboard link. * /
                'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'easycubes-app' ),
                'dismiss'                         => __( 'Dismiss this notice', 'easycubes-app' ),
                'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'easycubes-app' ),
                'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'easycubes-app' ),

                'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
            ),
            */
        );

        tgmpa( $plugins, $config );
    }

}
