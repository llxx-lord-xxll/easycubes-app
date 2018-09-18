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
 * It contains the definition of the tables
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Easycubes_App
 * @subpackage Easycubes_App/includes
 * @author     Arifuzzaman Pranto <zamanpranto@gmail.com>
 *
 */


class Easycubes_App_Tables{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */

    public static function articles_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_articles';
    }

    public static function articles_meta_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_articles_meta';
    }

    public static function articles_tabs_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_articles_tabs';
    }

    public static function folders_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_folders';
    }

    public static function galleries_table()
    {
        global $wpdb;
        return $wpdb->prefix . 'easycubes_app_galleries';
    }
}