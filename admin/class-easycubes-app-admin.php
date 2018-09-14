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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easycubes-app-admin.js', array( 'jquery' ), $this->version, false );

	}

    function eapp_menu_sections()
    {
        add_menu_page("Partner Articles","Easycubes App","manage_options","easycubes_app","easycubes_app_list","dashicons-images-alt");
        add_submenu_page("easycubes_app","Artciles","Artciles","manage_options","easycubes_app","easycubes_app_list");
        add_submenu_page("easycubes_app","Add New Article","Add New Article","manage_options","easycubes_app_add_articles","easycubes_app_add_articles");
        add_submenu_page("easycubes_app","Folders","Folders","manage_options","easycubes_app_folders","easycubes_app_folders");
        add_submenu_page("easycubes_app","Access Security","Access Security","manage_options","easycubes_app_security","easycubes_app_security");
    }

}
