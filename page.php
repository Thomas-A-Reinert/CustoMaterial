<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header(); ?>

<div class="wrapper" id="page-wrapper">

    <div  id="content" class="container">

	   <div id="primary" class="<?php echo $contentwidth ?> content-area">

            <main id="main" class="site-main" role="main" tabindex="-1">

                <?php if ( function_exists('yoast_breadcrumb') ) {
                    $yoast_links_options = get_option( 'wpseo_internallinks' );
                    $yoast_bc_enabled=$yoast_links_options['breadcrumbs-enable'];
                        if ($yoast_bc_enabled) { ?>
                            <div class="breadcrumb">
                                <?php yoast_breadcrumb('<p id="breadcrumbs"> <i class="fa fa-home"></i> ','</p>'); ?>
                            </div>
                    <?php }
                } ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'loop-templates/content', 'page' ); ?>

                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>

                <?php endwhile; // end of the loop. ?>

            </main><!-- #main -->

	    </div><!-- #primary -->

        <?php if ( get_theme_mod( 'show_sidebar', 'true') ) : get_template_part('sidebar'); endif; ?>

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
