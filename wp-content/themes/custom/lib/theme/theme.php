<?php


if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'General Settings',
        'menu_title' => 'Site Settings',
        'menu_slug' => 'theme-settings',
        'capability' => 'create_users',
        'redirect' => false
    ));


    acf_add_options_sub_page(array(
        'page_title' => 'Site Header Settings',
        'menu_title' => 'Header',
        'parent_slug' => 'theme-settings',
    ));


    acf_add_options_sub_page(array(
        'page_title' => 'Site Footer Settings',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-settings',
    ));
}

/*Required Below Files For The Setup*/

require_once( 'helpers.php' );
require_once( 'config.class.php' );
require_once( 'setup.php' );
require_once( 'scripts.php' );
require_once( 'cpt.php' );
require_once( 'pagination.php' );