<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.facebook.com/llxx.lord.xxll
 * @since      1.0.0
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Easycubes_App
 * @subpackage Easycubes_App/includes
 * @author     Arifuzzaman Pranto <zamanpranto@gmail.com>
 */
class Easycubes_App {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Easycubes_App_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
            $this->version = PLUGIN_NAME_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'easycubes-app';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Easycubes_App_Loader. Orchestrates the hooks of the plugin.
     * - Easycubes_App_i18n. Defines internationalization functionality.
     * - Easycubes_App_Admin. Defines all hooks for the admin area.
     * - Easycubes_App_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easycubes-app-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easycubes-app-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-easycubes-app-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-easycubes-app-public.php';

        $this->loader = new Easycubes_App_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Easycubes_App_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new Easycubes_App_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new Easycubes_App_Admin( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        //Define menu and submenu
        $this->loader->add_action( 'init', $plugin_admin ,'wpdocs_codex_eaarticles_init' );
        $this->loader->add_action( 'admin_init', $plugin_admin ,'populate_ea_article_metas' );
        $this->loader->add_action( 'save_post', $plugin_admin ,'save_eaarticle' );

        $this->loader->add_action( 'wp_ajax_reset_upload_dir', $plugin_admin ,'reset_upload_dir' );
        $this->loader->add_action( 'wp_ajax_modify_upload_dir', $plugin_admin ,'modify_upload_dir' );
        $this->loader->add_action( 'wp_ajax_get_eagallery', $plugin_admin ,'get_eagallery' );

        $this->loader->add_action( 'admin_post_eapartner_app_backup', $plugin_admin ,'eapartner_app_backup' );
        $this->loader->add_action( 'admin_post_eapartner_app_accesskey', $plugin_admin ,'eapartner_app_accesskey' );
        $this->loader->add_action( 'admin_post_eapartner_app_restore', $plugin_admin ,'eapartner_app_restore' );


        $this->loader->add_action( 'admin_menu', $plugin_admin, 'eapp_menu_sections' );
        $this->loader->add_action( 'tgmpa_register', $plugin_admin ,'Easycubes_App_register_required_plugins' );

        //$this->loader->add_action( 'admin_init', $plugin_admin, 'eapp_update_access_key' );
        //




    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new Easycubes_App_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        $this->loader->add_filter( 'template_include', $plugin_public, 'define_page_template' );

        add_shortcode('easycubes_app_partner_generate',array($plugin_public,"easycubes_app_partner_generate"));
        add_shortcode('easycubes_app_partner_products',array($plugin_public,"ea_partner_product"));

        $this->loader->add_action( 'wp_ajax_nopriv_get_eaarticle', $plugin_public ,'get_eaarticle' );
        $this->loader->add_action( 'wp_ajax_get_eaarticle', $plugin_public ,'get_eaarticle' );

        $this->loader->add_action( 'wp_ajax_get_eagallery_contents', $plugin_public ,'get_eagallery_contents' );
        $this->loader->add_action( 'wp_ajax_nopriv_get_eagallery_contents', $plugin_public ,'get_eagallery_contents' );

        $this->loader->add_action( 'wp_ajax_nopriv_earticle_search', $plugin_public ,'earticle_search' );
        $this->loader->add_action( 'wp_ajax_earticle_search', $plugin_public ,'earticle_search' );
        $this->loader->add_action( 'wp_ajax_partner_app_contact', $plugin_public ,'partner_app_contact' );
        $this->loader->add_action( 'wp_ajax_nopriv_partner_app_contact', $plugin_public ,'partner_app_contact' );

        $this->loader->add_action( 'wp_ajax_partner_app_accesskey_auth', $plugin_public ,'partner_app_accesskey_auth' );
        $this->loader->add_action( 'wp_ajax_nopriv_partner_app_accesskey_auth', $plugin_public ,'partner_app_accesskey_auth' );

        $this->loader->add_action( 'wp_ajax_partner_app_webaccesskey_auth', $plugin_public ,'partner_app_webaccesskey_auth' );
        $this->loader->add_action( 'wp_ajax_nopriv_partner_app_webaccesskey_auth', $plugin_public ,'partner_app_webaccesskey_auth' );

        $this->loader->add_action( 'wp_ajax_nopriv_get_eaaddresses', $plugin_public ,'get_eaaddresses' );
        $this->loader->add_action( 'wp_ajax_get_eaaddresses', $plugin_public ,'get_eaaddresses' );

        $this->loader->add_action( 'wp_ajax_nopriv_get_eaproducts', $plugin_public ,'get_eaproducts' );
        $this->loader->add_action( 'wp_ajax_get_eaproducts', $plugin_public ,'get_eaproducts' );

    }




    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Easycubes_App_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}
