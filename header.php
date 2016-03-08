<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if (get_theme_mod('content_width') == 'fullwidth') {
    $postfix = "-fluid";
} else {
    $postfix = "";
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <style>
        <?php if (get_theme_mod( 'toggle_topbar_shadow', 'true') == true) {
                // Topbar Dropshadow
                $topbar_dropshadow_color = get_theme_mod( 'topbar_dropshadow_color');
                $topbar_dropshadow_size = get_theme_mod( 'topbar_dropshadow_size');
                $topbar_dropshadow_options = '0 ' . $topbar_dropshadow_size . 'px ' . $topbar_dropshadow_size*2 . 'px ' . $topbar_dropshadow_color;
                ?>
        .topbar {
            box-shadow: <?php echo $topbar_dropshadow_options; ?>;
        }

        <?php   }
        if (get_theme_mod( 'toggle_menu_shadow', 'true') == true) {
            // Offcanbas Dropshadow
            $menu_dropshadow_color = get_theme_mod( 'menu_dropshadow_color');
            $menu_dropshadow_size = get_theme_mod( 'menu_dropshadow_size');
            $menu_dropshadow_options = '-' . $menu_dropshadow_size . 'px ' . '0 ' . $menu_dropshadow_size*2 . 'px ' . $menu_dropshadow_color;
        ?>
        #site-navigation {
            box-shadow: <?php echo $menu_dropshadow_options; ?>;
        }

        <?php   }
        if (get_theme_mod( 'toggle_article_shadow', 'true') == true) {
            // Offcanbas Dropshadow
            $article_dropshadow_color = get_theme_mod( 'article_dropshadow_color', 'rgba(0,0,0,0.5)');
            $article_dropshadow_size = get_theme_mod( 'article_dropshadow_size', '3');
            $article_dropshadow_options = '' .$article_dropshadow_size . 'px ' . $article_dropshadow_size . 'px ' . $article_dropshadow_size*2 . 'px ' . $article_dropshadow_color;
        ?>
        article, .author-bio, .breadcrumb {
            box-shadow: <?php echo $article_dropshadow_options; ?>;
        }

        <?php   }
        if (get_theme_mod( 'toggle_searchbox_pointer', 'true') == true ) {  // Searchbox Pointer ?>
        .form-wrapper button:before {
            border-color: transparent <?php echo get_theme_mod( 'menu_searchbutton_color'); ?> transparent;
        }

        .form-wrapper button:hover:before {
            border-color: transparent <?php echo get_theme_mod( 'menu_searchbutton_hover_color'); ?> transparent;
        }

        <?php
        } else { ?>
        .form-wrapper button:before, .form-wrapper button:hover:before {
            border-color: transparent transparent transparent;
        }

        <?php   }

        if ((get_theme_mod( 'display_background_image', 'false') == 'true' ) && (get_theme_mod( 'bg_image', 'false') != '')) {  ?>
        body {
            background-image: url("<?php echo get_theme_mod( 'bg_image'); ?>");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        <?php
        }
        if (!ctype_space(get_theme_mod('css_code') ) ) {
            echo get_theme_mod('css_code');
        }   ?>
    </style>
    <?php if (!ctype_space(get_theme_mod('javascript_header_code'))) { ?>
        <script>
            /* <![CDATA[ */
            <?php echo get_theme_mod('javascript_header_code'); ?>
            /* ]]> */
        </script>
    <?php } ?>
</head>

<body <?php body_class(); ?> id="top">

<nav id="site-navigation" class="main-navigation" role="navigation" style="z-index: 999">
    <h2 class="sr-only">Main Navigation</h2>
    <a class="skip-link sr-only" href="#content"><?php echo __('Skip to content', 'understrap'); ?></a>

    <ul class="main-menu">
        <li class="text-right closebutton"><a href="#" id="nav-close" class="withripple">X</a></li>
    </ul>

    <?php if (is_active_sidebar('off-canvas-top-widget')) : ?>
        <aside id="off-canvas-top-widget" class="off-canvas-top-widget widget-area" role="complementary">
            <?php dynamic_sidebar('off-canvas-top-widget'); ?>
        </aside><!-- #off-canvas-top-widget-sidebar -->
    <?php endif; ?>

    <ul class="main-menu">
        <?php if (has_nav_menu('primary')) :
            wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 0,
                    'walker' => new Lathom_Offcanvas_NavWalker(),
                    'fallback_cb' => null,
                    'items_wrap' => '%3$s',// skip the containing <ul>
                )
            );
        else :
            wp_list_pages(array(
                    'menu_class' => 'nav navbar-nav',//  'nav navbar-right'
                    'walker' => new Bootstrap_Page_Menu(),
                    'title_li' => null,
                )
            );
        endif; ?>
    </ul>

    <form role="search" method="get" class="form-wrapper cf" action="<?php echo home_url('/'); ?>">
        <label for="searchbox" class="sr-only"><?php echo __('Search for:', 'understrap') ?></label>
        <input type="search" placeholder="<?php echo __('Search ..', 'understrap') ?>"
               value="<?php echo get_search_query() ?>" name="s" id="searchbox"
               title="<?php echo __('Search for:', 'understrap') ?>">
        <button type="submit" class="submit" id="search-submit"><?php echo __('Search', 'understrap') ?></button>
    </form>

    <?php if (is_active_sidebar('off-canvas-bottom-widget')) : ?>
        <aside id="off-canvas-bottom-widget" class="off-canvas-bottom-widget widget-area" role="complementary">
            <?php dynamic_sidebar('off-canvas-bottom-widget'); ?>
        </aside><!-- #off-canvas-top-widget-sidebar -->
    <?php endif; ?>

</nav>
<div class="navbar navbar-fixed-top topbar">
    <?php // Display Site Description ?!
    if (get_theme_mod('display_brand_image') == true) { ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="navbar-brand"><img
                src="<?php echo get_theme_mod('brand_image'); ?>"
                alt="<?php bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?>"></a>
    <?php } ?>

    <h1 class="navbar-brand site-title">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
        <?php // Display Site Description ?!
        if (get_theme_mod('display_blog_slug') == true) { ?>
            <span class="site-description hidden-xs"><?php echo get_bloginfo('description'); ?></span>
        <?php } ?>
    </h1>

    <a id="nav-expander" class="nav-expander fixed withripple"><span
            class="menutext"><?php echo get_theme_mod('topbar_menu_text', 'MENU'); ?></span> &nbsp;<span
            class="fa fa-align-left fa-lg menuicon"></span></a>
</div>
<!-- End Navigation -->

<div id="page" class="hfeed site">
