<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.facebook.com/llxx.lord.xxll
 * @since      1.0.0
 *
 * @package    Easycubes_App
 * @subpackage Easycubes_App/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Easycubes_App
 * @subpackage Easycubes_App/includes
 * @author     Arifuzzaman Pranto <zamanpranto@gmail.com>
 */
class Easycubes_App_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

	    self::EasyCubesApp_DropTables();
	}

    public static function EasyCubesApp_DropTables()
    {
        require_once EASYCUBES_APP_PLUGIN_DIR . "includes/class-easycubes-app-tables.php";


        global $wpdb;
        $wpdb->query("Drop table if exists " . Easycubes_App_Tables::articles_table());
        $wpdb->query("Drop table if exists " . Easycubes_App_Tables::articles_meta_table());
        $wpdb->query("Drop table if exists " . Easycubes_App_Tables::articles_tabs_table());
        $wpdb->query("Drop table if exists " . Easycubes_App_Tables::folders_table());
        $wpdb->query("Drop table if exists " . Easycubes_App_Tables::galleries_table());



    }


}
