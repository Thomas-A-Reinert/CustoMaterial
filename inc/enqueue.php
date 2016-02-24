<?php
/**
 * understrap enqueue scripts
 *
 * @package understrap
 */
function understrap_scripts() {
    wp_enqueue_style( 'understrap-theme', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), '0.3.7', false );
    //wp_enqueue_style( 'tar_ripple', get_stylesheet_directory_uri() . '/css/ripple.min.css', array(), '1.2.1', false );
    //
    wp_register_style( 'fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'fontawesome');

    wp_enqueue_script('jquery');
	wp_enqueue_script( 'understrap-navigation', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20120206', true );

    //wp_enqueue_script( 'understrap-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    wp_enqueue_script( 'tar-init', get_template_directory_uri() . '/js/theme.min.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    if ( is_active_sidebar( 'hero' ) ) {
        wp_enqueue_style( 'understrap-carousel-style', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '20024', false );
        wp_enqueue_style( 'understrap-carousel-style-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css', array(), '20024', false );
        wp_enqueue_script( 'understrap-carousel-script', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), '20024', true );}
    }

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );
