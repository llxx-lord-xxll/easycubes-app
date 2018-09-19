<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.facebook.com/llxx.lord.xxll
 * @since      1.0.0
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Easycubes_App
 * @subpackage Easycubes_App/includes
 * @author     Arifuzzaman Pranto <zamanpranto@gmail.com>
 */
class Easycubes_App_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	    self::create_public_page();
	}

    public static function create_public_page()
    {
        global $wpdb;
       $slug_exist =  $wpdb->get_row(
            $wpdb->prepare('SELECT * from '. $wpdb->prefix.'posts where post_name= %s',"easycubes-app-public-page")
        );

       if (empty($slug_exist))
       {
           $the_page = array(
               'post_title' => 'The Partner Page',
               'post_content' => '',
               'post_status' => 'publish',
               'post_slug' => 'easycubes-app-public-page',
               'post_type' => 'page'
           );
           $page_id = wp_insert_post($the_page);
           update_option('easycubes_app_page', $page_id);

       }
       else
       {
           $the_page = get_page_by_path("easycubes-app-public-page");
           if ($the_page) {
               update_option('easycubes_app_page', $the_page->ID);
           }
       }
    }
}
