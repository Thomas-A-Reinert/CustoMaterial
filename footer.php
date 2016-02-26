<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */
?>
<?php if (get_theme_mod( 'toggle_footer_widgets', 'true') == true) {

    $col_counter = 0;
    if (is_active_sidebar( 'footer-widget-1' )) {
        $col_counter = $col_counter+1;
    }
    if (is_active_sidebar( 'footer-widget-2' )) {
        $col_counter = $col_counter+1;
    }
    if (is_active_sidebar( 'footer-widget-3' )) {
        $col_counter = $col_counter+1;
    }
    if (is_active_sidebar( 'footer-widget-4' )) {
        $col_counter = $col_counter+1;
    }
    if ($col_counter != 0) {
        $col_width = 12 / $col_counter;
    }
     if ($col_counter != 0) {
?>
<section id="footer-widgets">
<h1 class="sr-only"><?php echo esc_html__( 'Footer Widgets', 'lathom' ) ?></h1>
    <div class="container-fluid">

        <?php if ( is_active_sidebar( 'footer-widget-1' ) ) { ?>
            <div class="col-sm-6 col-md-<?php echo $col_width; ?>">
                <aside class="footer-widget widget-area" role="complementary">
                    <?php dynamic_sidebar( 'footer-widget-1' ); ?>
                </aside>
            </div><!-- .footer-widget-1 -->
        <?php } ?>

        <?php if ( is_active_sidebar( 'footer-widget-2' ) ) { ?>
            <div class="col-sm-6 col-md-<?php echo $col_width; ?>">
                <aside class="footer-widget widget-area" role="complementary">
                    <?php dynamic_sidebar( 'footer-widget-2' ); ?>
                </aside>
            </div><!-- .footer-widget-2 -->
        <?php } ?>

        <?php if ( is_active_sidebar( 'footer-widget-3' ) ) { ?>
            <div class="col-sm-6 col-md-<?php echo $col_width; ?>">
                <aside class="footer-widget widget-area" role="complementary">
                    <?php dynamic_sidebar( 'footer-widget-3' ); ?>
                </aside>
            </div><!-- .footer-widget-2 -->
        <?php } ?>

        <?php if ( is_active_sidebar( 'footer-widget-4' ) ) { ?>
            <div class="col-sm-6 col-md-<?php echo $col_width; ?>">
                <aside class="footer-widget widget-area" role="complementary">
                    <?php dynamic_sidebar( 'footer-widget-4' ); ?>
                </aside>
            </div><!-- .footer-widget-2 -->
        <?php } ?>

    </div>
</section><!-- #footer-widgets -->
<?php }
}?>


<div class="" id="wrapper-footer">

    <footer id="colophon" class="container-fluid site-footer" role="contentinfo">

        <div class="pull-left">
        <?php if ( get_theme_mod( 'footer_show_wp_credits', 'true') == 'true' )  { ?>
                <img src="<?php echo get_template_directory_uri(); ?>/imgs/wordpress-icon.png" height="16" width="16" alt="<?php printf( esc_html__( 'Proudly powered by %s', 'lathom' ), 'WordPress' ); ?>"> <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'lathom' ) ); ?>" target="_blank"><?php printf( esc_html__( 'Proudly powered by %s', 'lathom' ), 'WordPress' ); ?></a><?php
        } ?>

        <?php if ( get_theme_mod( 'footer_show_custom_footer_text', 'true') =='true' )  { // Is Footer text activated?

                if ( get_theme_mod( 'footer_show_wp_credits') == 'true' )  { ?><span class="sep"> | </span><?php } ?>
                <span>
                    &copy;  <?php echo date('Y');
                    if ( get_theme_mod( 'footer_custom_footer_text_link', 'http://tarcgn.de/portfolio/') !='' )  { ?>
                        <a href="<?php echo get_theme_mod( 'footer_custom_footer_text_link'); ?>" target="_blank">
                    <?php } ?>
                            <?php echo get_theme_mod( 'footer_custom_footer_text', 'Theme by Thomas A. Reinert | TAR MediaDesign'); ?>
                    <?php if ( get_theme_mod( 'footer_custom_footer_text_link', 'http://tarcgn.de/portfolio/') !='' )  { ?>
                        </a>
                    <?php } ?>
                </span>
            <?php
            } ?>
        </div>

        <?php if( has_nav_menu( 'footer' ) ) { ?>
            <nav id="footer-menu" class="pull-right">
            <h1 class="sr-only"><?php echo esc_html__( 'Secondary Navigation', 'lathom' ) ?></h1>
            <?php
                $footer_menu_parameters = array(
                    'theme_location'  => 'footer',
                    'echo'            => false,
                    'items_wrap'      => '%3$s',
                    'depth'           => 1,
                );

                echo strip_tags(wp_nav_menu( $footer_menu_parameters ), '<a>' );?>
            </nav>
        <?php } ?>

    </footer><!-- #colophon -->

</div><!-- wrapper end -->

</div><!-- #page -->

<?php if (get_theme_mod('display_to_top_button') == true) { // To Top Button ?>
    <a href="#top" class="page-scroll" id="topbutton"><span class="fa fa-arrow-circle-o-up"></span><span class="sr-only"><?php echo __( 'To Top', 'lathom' ); ?></span></a>
<?php } ?>

<?php wp_footer(); ?>

<!-- Loads slider script and settings if a widget on pos hero is published -->
<?php if ( is_active_sidebar( 'hero' ) ): ?>

<script>
    jQuery(document).ready(function() {
        var owl = jQuery('.owl-carousel');
        owl.owlCarousel({
            items:<?php echo get_theme_mod( 'understrap_theme_slider_count_setting', 1 );?>,
            loop:<?php echo get_theme_mod( 'understrap_theme_slider_loop_setting', true );?>,
            autoplay:true,
            autoplayTimeout:<?php echo get_theme_mod( 'understrap_theme_slider_time_setting', 5000 );?>,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            nav: false,
            dots: true,
            autoplayHoverPause:true,
            margin:0,
            autoHeight:true,
            video: true
        });

        jQuery('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        });
        jQuery('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        });
    });
</script>
<?php endif; ?>
<script>
// Off Canvas Nav Menu

  jQuery(document).ready(function(){

    //Navigation Menu Slider
    jQuery('#nav-expander').on('click',function(e){
        e.preventDefault();
        jQuery('body').toggleClass('nav-expanded');
      });
      jQuery('#nav-close').on('click',function(e){
        e.preventDefault();
        jQuery('body').removeClass('nav-expanded');
      });

      // Initialize navgoco with default options
    jQuery(".main-menu").navgoco({
        caret: '',
        accordion: false,
        openClass: 'open',
        save: true,
        cookie: {
            name: 'navgoco',
            expires: false,
            path: '/'
        },
        slide: {
            duration: 300,
            easing: 'swing'
        }
    });

  });


jQuery(document).keyup(function(e) {
    if (e.keyCode == 27) {
        if (jQuery('body').hasClass('nav-expanded')) {
            e.preventDefault();
            jQuery('body').removeClass('nav-expanded');
        }
    }
});


jQuery(document).ready(function(){
    jQuery('a').click(function(){
         var href = jQuery(this).attr("href");
         jQuery('body').animate({
            scrollTop: jQuery(href).offset().top
         }, 1000);
    });
});



jQuery(document).scroll(function() {
    var y = jQuery(this).scrollTop();
    if (y > 800) {
        jQuery('#topbutton').fadeIn();
    } else {
        jQuery('#topbutton').fadeOut();
    }
});

jQuery.material.init();
jQuery.material.options = {
    "withRipples": "a, .submit,input[type=submit], .btn"
}
jQuery.material.ripples()
</script>
<?php if (!ctype_space(get_theme_mod('javascript_footer_code', 'false') ) ) {
        echo get_theme_mod('javascript_footer_code');
} ?>
</body>

</html>
