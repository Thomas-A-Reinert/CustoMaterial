<?php
/**
 * understrap functions and definitions
 *
 * @package understrap
 */

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

require get_template_directory() . '/inc/widgets.php';


/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
include_once( dirname( __FILE__ ) . '/inc/kirki/kirki.php' );
// include_once( dirname( __FILE__ ) . '/inc/fontawesome_json.php' );
// function kirki_update_url( $config ) {
//     $config['url_path'] = get_stylesheet_directory_uri() . '/inc/kirki/';
//     return $config;
// }
// add_filter( 'kirki/config', 'kirki_update_url' );
if ( ! function_exists( 'my_theme_kirki_update_url' ) ) {
    function my_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_stylesheet_directory_uri() . '/inc/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'my_theme_kirki_update_url' );

function kirki_configuration_styling( $config ) {
    $config['logo_image']   = get_stylesheet_directory_uri() .'/imgs/logo.png';
    $config['description']  = __( 'The theme description.', 'understrap' );
    $config['color_accent'] = '#8bc34a';
    $config['color_back']   = '#607D8B';
    return $config;
}
add_filter( 'kirki/config', 'kirki_configuration_styling' );

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-functions.php';
require get_template_directory() . '/inc/customizer-options.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/bootstrap-comment-walker.php';
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Load custom WordPress nav walker.
*/
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

class Lathom_Offcanvas_NavWalker extends wp_bootstrap_navwalker {
  function start_lvl(&$output, $depth = 1, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"list-unstyled\" data-index=\"0\" style=\"display: none;\">\n";
  }
}

// function add_menuclass($ulclass) { // Add custom class to link in navmenu
//    return preg_replace('/<a /', '<a class="withripple" ', $ulclass);
// }
// add_filter('wp_nav_menu','add_menuclass');

/**
* Load WooCommerce functions.
*/
require get_template_directory() . '/inc/woocommerce.php';


if ( get_theme_mod( 'content_width') == 'fullwidth') {
    $postfix = "-fluid";
} else {
    $postfix = "";
}

if ( ( is_active_sidebar( 'sidebar-1' ) ) && (get_theme_mod( 'show_sidebar', 'true')) ) {

    if ($postfix =="-fluid") {
        $contentwidth = "col-md-9";
    } else {
        $contentwidth = "col-md-8";
    }
} else {
    $contentwidth = "col-md-12";
}
