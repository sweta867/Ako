<?php

function tt_scripts() {

    /* jQuery CDN */
    if (!is_admin() && current_theme_supports('jquery-cdn') && Config::get_script('jquery')) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . Config::get_script('jquery'), array(), null, false);
        
        
    }
    
     
    

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('jquery');

    /* Call ALL CSS Files */
    $scripts = Config::get_scripts('css');
    if ($scripts) {
        foreach ($scripts as $name => $script) {
            //debugP($name);
            wp_enqueue_style(Config::get('prefix') . '_' . $name, get_template_directory_uri() . $script, false, null);
        }
    }

    /* Call ALL JS Files */
    $scripts = Config::get_scripts('js');
    if ($scripts) {
        foreach ($scripts as $name => $script) {
            wp_enqueue_script(Config::get('prefix') . '_' . $name, get_template_directory_uri() . $script, array(), null, true);
        }
    }
}

add_action('wp_enqueue_scripts', 'tt_scripts', 100);


/**
 * DNS prefetch
 */
function tt_resource( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		$dns = Config::get_scripts( 'dns_prefetch' );
		if ( $dns ) {
			foreach ( $dns as $value ) {
				$hints[] = $value;
			}
		}
	}

	return $hints;
}

add_filter( 'wp_resource_hints', 'tt_resource', 10, 2 );