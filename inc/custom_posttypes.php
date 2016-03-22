<?php
/**
 * @package Custom Post Types
 * @version 1.0
 */
/*
Plugin Name: Custom Post Types
Plugin URI: http://wordpress.org/extend/plugins/#
Description: This enables custom Post types for the CustoMaterial theme
Author: Thomas A. Reinert
Version: 1.0
Author URI: http://tarcgn.de/portfolio/
*/

/**
 * Plugin setup
 * Register portfolio post type
 */
if ( ! function_exists('register_portfolio_posttype') ) {

// Register Custom Post Type
function register_portfolio_posttype() {

	$labels = array(
		'name'                  => _x( 'Portfolio items', 'Post Type General Name', 'understrap' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'understrap' ),
		'menu_name'             => __( 'Portfolio Items', 'understrap' ),
		'name_admin_bar'        => __( 'Portfolio Items', 'understrap' ),
		'archives'              => __( 'Portfolio Items', 'understrap' ),
		'parent_item_colon'     => __( 'Portfolio', 'understrap' ),
		'all_items'             => __( 'Portfolio Items', 'understrap' ),
		'add_new_item'          => __( 'Add New Portfolio Item', 'understrap' ),
		'add_new'               => __( 'Add Item', 'understrap' ),
		'new_item'              => __( 'New Portfolio Item', 'understrap' ),
		'edit_item'             => __( 'Edit Portfolio Item', 'understrap' ),
		'update_item'           => __( 'Update Portfolio Item', 'understrap' ),
		'view_item'             => __( 'View Portfolio Item', 'understrap' ),
		'search_items'          => __( 'Search Portfolio Item', 'understrap' ),
		'not_found'             => __( 'Not found', 'understrap' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'understrap' ),
		'featured_image'        => __( 'Featured Image', 'understrap' ),
		'set_featured_image'    => __( 'Set featured image', 'understrap' ),
		'remove_featured_image' => __( 'Remove featured image', 'understrap' ),
		'use_featured_image'    => __( 'Use as featured image', 'understrap' ),
		'insert_into_item'      => __( 'Insert into Portfolio item', 'understrap' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Portfolio item', 'understrap' ),
		'items_list'            => __( 'Portfolio Items list', 'understrap' ),
		'items_list_navigation' => __( 'Portfolio Items list navigation', 'understrap' ),
		'filter_items_list'     => __( 'Filter Portfolio items list', 'understrap' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio Item', 'understrap' ),
		'description'           => __( 'Set up your Portfolio items easily to display them in an unusual way.', 'understrap' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array('category'),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-images-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'register_portfolio_posttype', 0 );

}


/**
 * Register taxonomies
 */
// function portfolio_register_taxonomies(){

// 	$labels = array(
// 		'name' => __( 'Portfolio Taxonomy', 'understrap' ),
// 		'label' => __( 'Portfolio Taxonomy', 'understrap' ),
// 		'add_new_item' => __( 'Add Portfolio Taxonomy', 'understrap' ),
// 	);

// 	$args = array(
// 		'labels' => $labels,
// 		'label' => __( 'Portfolio Taxonomy', 'understrap' ),
// 		'show_ui' => true,
// 		'show_admin_column' => true
// 	);
// 	register_taxonomy( 'portfolio-taxonomy', array( 'portfolio' ), $args );
// }
// add_action( 'init', 'portfolio_register_taxonomies' );

