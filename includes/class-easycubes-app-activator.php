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


	    self::EasyCubesApp_create_tables();
	}

	private static  function EasyCubesApp_create_tables( )
    {
        require_once (ABSPATH. "wp-admin/includes/upgrade.php"); 

        global $wpdb;

        if (count($wpdb->get_var("Show tables like '".
                self::EasyCubesApp_articles_table()."';")) == 0)
        {
            $query = "CREATE TABLE `".self::EasyCubesApp_articles_table()."` (
                         `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `author` bigint(20) NOT NULL,
                         `posted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `post_title` varchar(40) NOT NULL,
                         `post_subtitle` text NOT NULL,
                         `post_icon` varchar(191) NOT NULL,
                         UNIQUE KEY `ID` (`ID`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            dbDelta($query);
        }


        if (count($wpdb->get_var("Show tables like '".
            self::EasyCubesApp_articles_meta_table()."';")) == 0)
        {
            $query = "CREATE TABLE `".self::EasyCubesApp_articles_meta_table()."` (
                     `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                     `article_id` bigint(20) NOT NULL,
                     `meta_key` varchar(128) NOT NULL,
                     `meta_value` varchar(255) NOT NULL,
                     UNIQUE KEY `meta_id` (`meta_id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            dbDelta($query);
        }

        if (count($wpdb->get_var("Show tables like '".
            self::EasyCubesApp_articles_tabs_table()."';")) == 0)
        {
            $query = "CREATE TABLE `".self::EasyCubesApp_articles_tabs_table()."` (
                     `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                     `article_id` bigint(20) NOT NULL,
                     `title` varchar(30) NOT NULL,
                     `tab_type` int(11) NOT NULL,
                     `tab_content` varchar(2048) NOT NULL,
                     UNIQUE KEY `id` (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            dbDelta($query);
        }
        if (count($wpdb->get_var("Show tables like '".
            self::EasyCubesApp_folders_table()."';")) == 0)
        {
            $query = "CREATE TABLE `".self::EasyCubesApp_folders_table()."` (
                         `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                         `title` varchar(20) NOT NULL,
                         `icon` bigint(20) NOT NULL,
                         UNIQUE KEY `id` (`id`)
                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            dbDelta($query);
        }

        if (count($wpdb->get_var("Show tables like '".
            self::EasyCubesApp_galleries_table()."';")) == 0)
        {
            $query = "CREATE TABLE `".self::EasyCubesApp_galleries_table()."` (
                     `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                     `author` bigint(20) NOT NULL,
                     `posted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                     `title` varchar(30) NOT NULL,
                     `content` varchar(2048) NOT NULL,
                     UNIQUE KEY `id` (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            dbDelta($query);
        }
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
