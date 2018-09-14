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
        global $wpdb;
        $wpdb->query("Drop table if exists " . self::EasyCubesApp_articles_table());
        $wpdb->query("Drop table if exists " . self::EasyCubesApp_articles_meta_table());
        $wpdb->query("Drop table if exists " . self::EasyCubesApp_articles_tabs_table());
        $wpdb->query("Drop table if exists " . self::EasyCubesApp_folders_table());
        $wpdb->query("Drop table if exists " . self::EasyCubesApp_galleries_table());
    }

    public static function EasyCubesApp_articles_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_articles';
    }

    public static function EasyCubesApp_articles_meta_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_articles_meta';
    }

    public static function EasyCubesApp_articles_tabs_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_articles_tabs';
    }

    public static function EasyCubesApp_folders_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_folders';
    }

    public static function EasyCubesApp_galleries_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_galleries';
    }

}
