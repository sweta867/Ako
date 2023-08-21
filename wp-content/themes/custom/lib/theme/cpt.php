<?php 

/*
* Creating a function to create our CPT
*/
  
function custom_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Projects', 'Post Type General Name', 'twentytwentyone' ),
        'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'twentytwentyone' ),
        'menu_name'           => __( 'Projects', 'twentytwentyone' ),
        'parent_item_colon'   => __( 'Parent Project', 'twentytwentyone' ),
        'all_items'           => __( 'All Projects', 'twentytwentyone' ),
        'view_item'           => __( 'View Project', 'twentytwentyone' ),
        'add_new_item'        => __( 'Add New Project', 'twentytwentyone' ),
        'add_new'             => __( 'Add New', 'twentytwentyone' ),
        'edit_item'           => __( 'Edit Project', 'twentytwentyone' ),
        'update_item'         => __( 'Update Project', 'twentytwentyone' ),
        'search_items'        => __( 'Search Project', 'twentytwentyone' ),
        'not_found'           => __( 'Not Found', 'twentytwentyone' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
    );
      
// Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'projects', 'twentytwentyone' ),
        'description'         => __( 'Project news and reviews', 'twentytwentyone' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'projects', $args );
  
}
  
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
  
add_action( 'init', 'custom_post_type', 0 );

function create_project_tax() {

    $labels = array(
        'name'              => _x( 'Custom Taxonomies', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Project', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Custom Project', 'textdomain' ),
        'all_items'         => __( 'All Custom Project', 'textdomain' ),
        'parent_item'       => __( 'Parent Project', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Project:', 'textdomain' ),
        'edit_item'         => __( 'Edit Project', 'textdomain' ),
        'update_item'       => __( 'Update Project', 'textdomain' ),
        'add_new_item'      => __( 'Add New Project', 'textdomain' ),
        'new_item_name'     => __( 'New Project Name', 'textdomain' ),
        'menu_name'         => __( 'Project', 'textdomain' ),
    );
    $args = array(
        'labels' => $labels,
        'description' => __( '', 'textdomain' ),
        'hierarchical' => true,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_quick_edit' => true,
        'show_admin_column' => false,
        'show_in_rest' => true,
    );
    register_taxonomy( 'project_category', array('projects'), $args );

}
add_action( 'init', 'create_project_tax' );

/*
* Creating a function to create our CPT
*/
  
function custom_testimonial_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Testimonial', 'Post Type General Name', 'twentytwentyone' ),
        'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'twentytwentyone' ),
        'menu_name'           => __( 'Testimonial', 'twentytwentyone' ),
        'parent_item_colon'   => __( 'Parent Testimonial', 'twentytwentyone' ),
        'all_items'           => __( 'All Testimonial', 'twentytwentyone' ),
        'view_item'           => __( 'View Testimonial', 'twentytwentyone' ),
        'add_new_item'        => __( 'Add New Testimonial', 'twentytwentyone' ),
        'add_new'             => __( 'Add New', 'twentytwentyone' ),
        'edit_item'           => __( 'Edit Testimonial', 'twentytwentyone' ),
        'update_item'         => __( 'Update Testimonial', 'twentytwentyone' ),
        'search_items'        => __( 'Search Testimonial', 'twentytwentyone' ),
        'not_found'           => __( 'Not Found', 'twentytwentyone' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
    );
      
// Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'testimonial', 'twentytwentyone' ),
        'description'         => __( 'Testimonial news and reviews', 'twentytwentyone' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'testimonial', $args );
  
}
  
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
  
add_action( 'init', 'custom_testimonial_post_type', 0 );


/*
* Creating a function to create our CPT
*/
  
function custom_Team_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Teams', 'Post Type General Name', 'twentytwentyone' ),
        'singular_name'       => _x( 'Team', 'Post Type Singular Name', 'twentytwentyone' ),
        'menu_name'           => __( 'Teams', 'twentytwentyone' ),
        'parent_item_colon'   => __( 'Parent Team', 'twentytwentyone' ),
        'all_items'           => __( 'All Teams', 'twentytwentyone' ),
        'view_item'           => __( 'View TeamTeam', 'twentytwentyone' ),
        'add_new_item'        => __( 'Add New Team', 'twentytwentyone' ),
        'add_new'             => __( 'Add New', 'twentytwentyone' ),
        'edit_item'           => __( 'Edit Team', 'twentytwentyone' ),
        'update_item'         => __( 'Update Team', 'twentytwentyone' ),
        'search_items'        => __( 'Search Team', 'twentytwentyone' ),
        'not_found'           => __( 'Not Found', 'twentytwentyone' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
    );
      
// Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'teams', 'twentytwentyone' ),
        'description'         => __( 'Team news and reviews', 'twentytwentyone' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'teams', $args );
  
}
  
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
  
add_action( 'init', 'custom_Team_post_type', 0 );


