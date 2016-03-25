<?php
/**
 * The template for displaying archive pages.
 *
 * @package understrap
 */

get_header(); ?>

<div class="wrapper" id="archive-wrapper">

    <div id="content" class="container<?php echo $postfix; ?>">

        <div class="<?php echo $contentwidth ?>">
            <?php if (function_exists('yoast_breadcrumb')) {
                $yoast_links_options = get_option('wpseo_internallinks');
                $yoast_bc_enabled = $yoast_links_options['breadcrumbs-enable'];
                if ($yoast_bc_enabled) { ?>
                    <div class="breadcrumb">
                        <small><?php yoast_breadcrumb('<p id="breadcrumbs"> <i class="fa fa-home"></i> ', '</p>'); ?></small>
                    </div>
                <?php }
            } ?>
        </div>

        <header class="page-header <?php echo $contentwidth ?>">
            <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

	   <div id="primary" class="content-area <?php echo $contentwidth ?>">

            <main id="main" class="site-main" role="main" tabindex="-1">

                  <?php if ( have_posts() ) : ?>

                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'loop-templates/content', get_post_format() );
                        ?>

                    <?php endwhile; ?>

                        <?php tarthemes_numeric_posts_nav(); ?>

                    <?php else : ?>

                        <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                    <?php endif; ?>

              </main><!-- #main -->

        </div><!-- #primary -->

        <?php if (get_theme_mod('show_sidebar', 'true')) : get_template_part('sidebar'); endif; ?>

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
