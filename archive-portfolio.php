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

            <div class="controls">
                <?php
                    // See http://wordpress.stackexchange.com/questions/13485/list-all-subcategories-from-category on how to select cats and it´s children.
                    //$category_id = get_cat_ID('Portfolio');
                    $args = array('child_of' => get_cat_ID('Portfolio'));
                    $categories = get_categories( $args );

                    echo '<span class="btn btn-ghost btn-raised filter" data-filter="all"><a>' . __( "View all" ) . '</a></span>' ;

                    foreach($categories as $category) {
                        echo '<span class="btn btn-ghost btn-raised filter" data-filter=".category-' . $category->slug /* get_category_link( $category->term_id ) */ . '"><a>' . $category->name.' <span class="badge">' . $category->count . '</span></a></span>';
                    }
                ?>
            </div>
        </div>

        <div id="primary" class="content-area col-md-12">

            <main id="main" class="site-main masonry" role="main" tabindex="-1">

                <?php if (have_posts()) : ?>
                    <?php /* Start the Loop */ ?>
                    <?php
                    $counter = 1;
                    while (have_posts()) : the_post();

                        ?>

                        <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('loop-templates/portfolio', get_post_format());

                        $counter = $counter+1;
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
