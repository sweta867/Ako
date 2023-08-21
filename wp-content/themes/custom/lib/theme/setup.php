<?php

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function tt_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
}

add_action('after_setup_theme', 'tt_setup');
add_theme_support('jquery-cdn');





/* Register Nav Menus */
$navs = Config::get('nav_menus');
if ($navs) {
    register_nav_menus($navs);
}

/* Calling AJAX URL */

function tt_ajaxurl() {
    ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}

add_action('wp_head', 'tt_ajaxurl');


/* Remove Emoji styles For Site Speed */

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

/* Add SVG Upload Support */

function tt_mime_types($file_types) {
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}

add_filter('upload_mimes', 'tt_mime_types');


/* Clean WordPress Header */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wlwmanifest_link');
    



/* Calling Cutom Widgets */
add_action('widgets_init', 'tt_widgets_init');

function tt_widgets_init() {
    $widgets = Config::get('widgets');
    if (is_array($widgets)) {
        foreach ($widgets as $key => $name) {
            register_sidebar(array(
                'name' => $name,
                'id' => $key,
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h3>',
                'after_title' => '</h3>',
            ));
        }
    }
}

/* Remove WordPress Widgets from Dashboard Area */
if (Config::get('clean_dashboard')) {

    function remove_wp_dashboard_widgets() {
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
        remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
        remove_meta_box('dashboard_primary', 'dashboard', 'side');
        remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    }

    add_action('wp_dashboard_setup', 'remove_wp_dashboard_widgets');
    remove_action('welcome_panel', 'wp_welcome_panel');
}

function awesome_acf_hide_acf_admin() {
    
    $site_url = get_bloginfo('url');
    $protected_urls = get_bloginfo('url');
    if ($site_url == $protected_urls) {
        //if (in_array($userID, $allowedUsers)) {
        // hide the acf menu item
        return true;
    } else {
        // show the acf menu item
        return true;
    }
}

add_filter('acf/settings/show_admin', 'awesome_acf_hide_acf_admin');




function add_favicon()
{
    $favicon_url = get_stylesheet_directory_uri() . '/assets/images/favicon-32x32.png';
    echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
}
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');
add_action('wp_head', 'add_favicon');


function loadmore_enqueue_script_style() {

    wp_register_script('custom-script', get_template_directory_uri() . '/myloadmore.js', array('jquery'), false, true);

    $script_data_array = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('load_more_courses'),
    );
    wp_localize_script('custom-script', 'blog', $script_data_array);

    wp_enqueue_script('custom-script');
}

add_action('wp_enqueue_scripts', 'loadmore_enqueue_script_style');




function replace_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/', '/ class="dropdown-menu dropdown-menu-center" /', $menu);
   
    return $menu;
}

add_filter('wp_nav_menu', 'replace_submenu_class');


add_filter('nav_menu_link_attributes', 'nav_menu_link_class', 10, 2);

function nav_menu_link_class($atts, $item) {
    if (!$item->has_children && $item->menu_item_parent > 0) {
        $class = 'dropdown-item';
        $atts['class'] = $class;
    } else {
        $class = 'nav-link';
        $atts['class'] = $class;
    }

    return $atts;
}


add_filter( 'nav_menu_link_attributes', 'add_class_to_items_link', 10, 3 );

function add_class_to_items_link( $atts, $item, $args ) {
  // check if the item has children
  $hasChildren = (in_array('menu-item-has-children', $item->classes));
  if ($hasChildren) {
      
    //debugP($atts);
      
    // add the desired attributes:
    $atts['class'] = 'nav-link dropdown-toggle';
    $atts['data-bs-toggle'] = 'dropdown';
    $atts['href'] = '#';
  }
  return $atts;
}

class MY_Menu_Walker extends Walker_Nav_Menu {

  public function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
  }   

}

function special_nav_class($classes, $item){
     if( in_array('.current-menu-parent', $classes) || in_array('current-menu-ancestor', $classes) ){
             $classes[] = 'active ';
     }
     return $classes;
}



