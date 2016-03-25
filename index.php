<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();

?>

<?php get_template_part('hero'); ?>

<?php get_template_part('statichero'); ?>

<div class="wrapper" id="wrapper-index">

    <div id="content" class="container<?php echo $postfix; ?>">

        <?php if (function_exists('yoast_breadcrumb')) { ?>
            <div class="<?php echo $contentwidth ?>">
                <?php
                    $yoast_links_options = get_option('wpseo_internallinks');
                    $yoast_bc_enabled = $yoast_links_options['breadcrumbs-enable'];
                    if ($yoast_bc_enabled) { ?>
                        <div class="breadcrumb">
                            <?php yoast_breadcrumb('<p id="breadcrumbs"><small> <i class="fa fa-home"></i> ', '</small></p>'); ?>
                        </div>
                    <?php } ?>
            </div>
        <?php } ?>

        <div id="primary" class="<?php echo $contentwidth ?> content-area">

            <main id="main" class="site-main" role="main" tabindex="-1">

                <?php if (have_posts()) : ?>

                    <?php /* Start the Loop */ ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('loop-templates/content', get_post_format());
                        ?>

                    <?php endwhile; ?>

                    <?php tarthemes_numeric_posts_nav(); ?>

                <?php else : ?>

                    <?php get_template_part('loop-templates/content', 'none'); ?>

                <?php endif; ?>

            </main><!-- #main -->

        </div><!-- #primary -->

        <?php if (get_theme_mod('show_sidebar', 'true')) : get_template_part('sidebar'); endif; ?>

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
