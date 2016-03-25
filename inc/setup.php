<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 * @package understrap
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'understrap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function understrap_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on understrap, use a find and replace
	 * to change 'understrap' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'understrap', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'understrap' ),
		'footer'  => __( 'Short Footer Menu', 'understrap'),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

    /*
	 * Adding Thumbnail basic support
	 */
    add_theme_support( "post-thumbnails" );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'understrap_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );
}
endif; // understrap_setup
add_action( 'after_setup_theme', 'understrap_setup' );

/**
 * Integrate Custom metaboxes.
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * Integrate Custom Post Types.
 */
require get_template_directory() . '/inc/custom_posttypes.php';


/**
* Adding the Read more link to excerpts
*/
/*function new_excerpt_more( $more ) {
	return ' <p><a class="read-more btn btn-default" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'understrap') . '</a></p>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );*/
/* Removes the ... from the excerpt read more link */
function custom_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

/* Adds a custom read more link to all excerpts, manually or automatically generated */

function all_excerpts_get_more_link($post_excerpt) {

    return $post_excerpt . ' <br><span class="btn btn-xs btn-ghost btn-raised"><b><a class="understrap-read-more-link" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More...', 'understrap')  . '</a></b></span>';
}
add_filter('wp_trim_excerpt', 'all_excerpts_get_more_link');


/*
 * Alternate button for masonry layout
 */

function limit_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
/**
 * Attach a class to linked images' parent anchors
 * e.g. a img => a.img img
 * http://stackoverflow.com/questions/24042890/add-class-to-wordpress-image-a-anchor-elements
 * http://wordpress.stackexchange.com/questions/155438/how-to-add-a-class-to-the-attachment-images
 */
function add_data_attributes_to_linked_images($html) {
    $dataattributes = ''; // can do multiple classes, separate with space
    //$dataattributes = '';
    $generateRandomString = generateRandomString(5);
    $patterns = array();
    $replacements = array();

    $patterns[0] = '/<a(?![^>]*class)([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor tag where anchor has no existing classes
    $replacements[0] = '<a\1 ' . $dataattributes . ' data-gallery><img\2></a>';

    $patterns[1] = '/<a([^>]*)class="([^"]*)"([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor has existing classes contained in double quotes
    $replacements[1] = '<a\1class="\2"\3 ' . $dataattributes . ' data-gallery><img\4></a>';

    $patterns[2] = '/<a([^>]*)class=\'([^\']*)\'([^>]*)>\s*<img([^>]*)>\s*<\/a>/'; // matches img tag wrapped in anchor tag where anchor has existing classes contained in single quotes
    $replacements[2] = '<a\1class="\2"\3 ' . $dataattributes . ' data-gallery><img\4></a>';

    $html = preg_replace($patterns, $replacements, $html);

    return $html;
}

add_filter('the_content', 'add_data_attributes_to_linked_images', 100, 1);

function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


/*===================================================================================
 * Add Author Links
 * =================================================================================*/
function add_to_author_profile( $contactmethods ) {

	$contactmethods['rss_url'] = 'RSS URL';
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
	$contactmethods['xing_profile'] = 'Xing Profile URL';

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);


add_filter('get_avatar','add_gravatar_class');

function add_gravatar_class($class) {
	$addclass = get_theme_mod( 'comment_avater_config', 'img-circle');
    $class = str_replace("class='avatar", "class='avatar $addclass btn-raised", $class);
    return $class;
}

/*===================================================================================
 * Custom Password-protected Post Form
 * =================================================================================*/

function custom_password_form ( $form ) {
global $post;
$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
$form =
    '<p>' .
        __( "To view this protected post, enter the password below:" ) .
    '</p>' .
    '<form class="form-inline" action="' .
    esc_url( site_url( 'wp-login.php?action=postpass',
                      'login_post' ) ) .
    '" method="post">' .
        '<div class="form-group"> ' .
            '<label class="sr-only" for="' .
            $label .
            '">' .
                __('Password') .
            ' :</label>' .
            '<input placeholder="'.
            __('Password') .
            '" class="form-control" name="post_password" id="' .
            $label .
            '" type="password" size="20" maxlength="20" />'.

        	'<input class="btn btn-lg btn-ghost btn-raised" type="submit" name="Submit" value="' .
            esc_attr__( "Submit" ) . '" />' .
        '</div>' .
    '</form>';
return $form;
}
// if (! is_admin()) {
    add_filter('the_password_form','custom_password_form');
// }

// add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

// function my_post_image_html( $html, $post_id, $post_image_id ) {

//   $html = '<img src="'.get_permalink( $post_id ).'" source="'.get_permalink( $post_id ).'" data-gallery/>';
//   return $html;

// }
