<?php

/**
 * Theme helpers
 */

/**Clean up the_excerpt() */
function tt_excerpt_more() {
    #return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
    return '... ';
}

add_filter('excerpt_more', 'tt_excerpt_more');

/*Common Function For Get CPT*/

function getCustomPosts($postType = false, $num = '-1', $postParent = '') {
    $posts = false;

    if ($postType && $num) {
        $args = array(
            'post_type' => $postType,
            'posts_per_page' => $num,
            'post_parent' => $postParent,
            'suppress_filters' => false
        );

        $posts = get_posts($args);
    }

    return $posts;
}

/*Set Limit For Custom Excerpt*/
function customExcerpt($content = '', $size = 20, $append = '') {

    $customExcerpt = wp_trim_words($content, $size, $append);

    return $customExcerpt;
}

/* Get Page Title*/

function tt_title() {
    if (is_home()) {
        if (get_option('page_for_posts', true)) {
            return get_the_title(get_option('page_for_posts', true));
        } else {
            return __('Latest Posts');
        }
    } elseif (is_category()) {
        //return sprintf( __( 'Category: %s' ), single_cat_title( '', false ) );
        return single_cat_title('', false);
    } elseif (is_archive()) {
        return get_the_archive_title();
    } elseif (is_search()) {
        return sprintf(__('Search Results for %s'), get_search_query());
    } elseif (is_404()) {
        return __('Not Found');
    } else {
        return get_the_title();
    }
}

/* Add Page Slug To Body Class If Not Added*/
function tt_body_class($classes) {
    // Add post/page slug
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    return $classes;
}

add_filter('body_class', 'tt_body_class');

/*Debugging Function*/

function debugP($debug = false) {
    echo '<pre>';
    print_r($debug);
    echo '</pre>';
}
