<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package understrap
 */

$classes = get_post_class('content-page-item', get_the_ID());
$classes = implode(" ", $classes);
?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $classes; ?>">

    <header class="entry-header">

        <?php the_title('<h2 class="entry-title">', '</h2>'); ?>

    </header><!-- .entry-header -->

    <section>
        <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>

        <div class="entry-content">
            <?php the_content(); ?>

            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
                'after' => '</div>',
            ));
            ?>

        </div><!-- .entry-content -->
    </section>

    <footer class="entry-footer">

        <small><?php edit_post_link(__('Edit', 'understrap'), '<span class="fa fa-pencil"></span><span class="edit-link">', '</span>'); ?></small>

    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
