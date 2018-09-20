<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.facebook.com/llxx.lord.xxll
 * @since      1.0.0
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/public
 * @author     Arifuzzaman Pranto <zamanpranto@gmail.com>
 */
class Easycubes_App_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easycubes-app-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easycubes-app-public.js', array( 'jquery' ), $this->version, false );

	}

	public function define_page_template()
    {

        $post = get_post();
        $app_page_id = get_option("easycubes_app_page");
        if (!empty($app_page_id))
        {
            if ($app_page_id == $post->ID)
            {
                $page_template = EASYCUBES_APP_PLUGIN_DIR . "/public/partials/easycubes-app-public-display.php";

            }
        }
        return $page_template;
    }

    public function easycubes_app_partner_generate()
    {
        ?>

        <script type="text/javascript">
            var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
        </script>

        <?php
    }


    public function get_eaarticle()
    {
        if (isset($_POST['url']))
        {
            $post_id = str_replace('#post_',"",$_POST['url']);
            $post = get_post( $post_id );

            if (!empty($post))
            {

                $thumbnail = get_the_post_thumbnail_url($post,'thumbnail');
                $post = (array)$post;
                $subtitle =  get_post_meta( $post_id, 'eaarticles_subtitle', true ) ;
                $tabcount = intval( get_post_meta( $post_id, 'eaarticles_tabcount', true ) );
                $post['subtitle'] = $subtitle;
                $post['tabcount'] = $tabcount;
                $post['thumbnail'] = $thumbnail;
                $post['post_date'] = date("d M, Y", strtotime($post['post_date']));

                $tabs = array();

                for ($i=1;$i<=$tabcount; $i++) {
                    $tab_title = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_title", true );
                    $tab_state = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_state", true );
                    $tab_type = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_type", true );
                    $tab_down_page = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_dpage", true );
                    $tab_down_url = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_durl", true );
                    $tab_val = get_post_meta( $post_id, 'eaarticles_tab'. $i . "_val", true );

                    if ($tab_state=="on")
                    {
                        array_push($tabs,array(
                            'id'  => $i,
                            'title' => $tab_title,
                            'type' => $tab_type,
                            'dpage' => $tab_down_page,
                            'durl' => $tab_down_url,
                            'content' => $tab_val
                        ));
                    }
                }

                $post['tabs'] = $tabs;

                echo json_encode($post);
            }


        }

    }

    public function get_eagallery_contents()
    {
        if (isset($_POST['url']))
        {
            $term_id = $_POST['url'];
            $term_meta = get_option( "eagallery_taxonomy_$term_id" . "_media");
            $term_meta = json_decode($term_meta);
            echo json_encode($term_meta);
        }

    }
}
