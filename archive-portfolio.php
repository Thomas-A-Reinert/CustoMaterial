<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header(); ?>

<div class="wrapper" id="archive-wrapper">

    <div id="content" class="container<?php echo $postfix; ?>">
        <div class="col-md-12">
            <header class="page-header">
                <?php
                echo '<h1 class="page-title">' . __('Portfolio', 'understrap') . '</h1>';
                the_archive_description('<div class="taxonomy-description">', '</div>');
                ?>
            </header><!-- .page-header -->
        </div>

        <div id="primary" class="content-area col-md-12">

            <main id="main" class="site-main masonry" role="main" tabindex="-1">
                <?php if (have_posts()) : ?>

                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>

                        <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('loop-templates/portfolio', get_post_format());
                        ?>

                    <?php endwhile; ?>

                    <?php understrap_paging_nav(); ?>

                <?php else : ?>

                    <?php get_template_part('loop-templates/portfolio', 'none'); ?>

                <?php endif; ?>

            </main><!-- #main -->

        </div><!-- #primary -->

        <?php //if ( get_theme_mod( 'show_sidebar', 'true') ) : get_template_part('sidebar'); endif; ?>

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
