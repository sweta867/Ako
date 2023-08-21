<?php

$themeConfigDefault = array(
    'prefix' => 'theme',
    'admin_bar' => true,
    'output_buffer' => false,
    'ajax' => true,
    'remove_emoji' => true,
    'remove_recent_comments_style' => true,
    'enable_svg_upload' => true,
    'json_api' => true,
    'clean_header' => true,
    'disable_comments' => true,
    'disable_search' => false,
    'custom_login_logo' => false,
    #default post thumbnail size
    'image_post_thumbnail' => array(
        #width / height / crop
        '337',
        '224',
        true
    ),
    #image sizes
    'image_sizes' => array(
    #name / width / height / crop
    ),
    #navigation menus
    'nav_menus' => array(
        'primary_navigation' => 'Primary Navigation',
    //'footer_navigation'  => 'Footer Navigation',
    ),
    #active menu classes
    'active_menu_classes' => array(
    //'menu-test'
    ),
    #widget areas
    'widgets' => array(
        #widget id / widget name
        'widget-footer' => 'Footer copyright',
    ),
    #remove dashboard common widget
    'clean_dashboard' => true,
    'custom_welcome_dashboard' => false,
    #custom widgets
    'custom_widgets_support' => true,
    'custom_widgets_news' => false,
);

/**
 * Class Config - manipulate with configs
 */
class Config {

    public static $config = false;
    public static $scripts = false;

    public function __construct($defaultConfig = false) {

        if ($defaultConfig) {
            self::$config = $defaultConfig;
        }

        #load config.file.php
        if (file_exists(get_template_directory() . '/lib/config.file.php')) {
            include get_template_directory() . '/lib/config.file.php';
            if (isset($themeConfig)) {
                self::$config = self::array_merge_recursive2(self::$config, $themeConfig);
            }
            if (isset($themeScripts)) {
                self::$scripts = $themeScripts;
            }
        }
    }

    public static function debug() {
        debugP(self::$config);
    }

    public static function get($key = false) {
        if (isset(self::$config[$key])) {
            return self::$config[$key];
        } else {
            return false;
        }
    }

    public static function get_script($key) {
        if (isset(self::$scripts[$key])) {
            return self::$scripts[$key];
        } else {
            return false;
        }
    }

    public static function get_scripts($key = false) {
        if (isset(self::$scripts[$key])) {
            return self::$scripts[$key];
        }

        return false;
    }

    public static function array_merge_recursive2($paArray1, $paArray2) {
        if (!is_array($paArray1) or ! is_array($paArray2)) {
            return $paArray2;
        }
        foreach ($paArray2 AS $sKey2 => $sValue2) {
            $paArray1[$sKey2] = self::array_merge_recursive2(@$paArray1[$sKey2], $sValue2);
        }

        return $paArray1;
    }

}

new Config($themeConfigDefault);

