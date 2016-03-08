<?php
/**
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">

        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

        <?php if ('post' == get_post_type()) : ?>

            <div class="entry-meta">
                <small><?php understrap_posted_on(); ?></small>
            </div><!-- .entry-meta -->

        <?php endif; ?>

    </header><!-- .entry-header -->

    <section>
        <?php //echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

        <?php if (has_post_thumbnail()) { ?>
            <figure class="attachment-header-image">
                <?php
                if ((get_theme_mod('show_sidebar') != 'true') || (get_theme_mod('content_width') == 'fullwidth')) {
                    the_post_thumbnail('header-image-large', array('class' => 'img-responsive'));
                } else {
                    the_post_thumbnail('header-image-medium', array('class' => 'img-responsive'));
                }
                ?>
                <figcaption class="attachment-header-image-caption">
                    <?php
                    // See http://www.bobz.co/how-to-get-attachment-image-caption-alt-or-description/
                    // and http://codex.wordpress.org/Function_Reference/wp_get_attachment_metadata#Usage
                    $thumb_img = get_post(get_post_thumbnail_id()); // Get post by ID
                    ?>
                    <div class="h2"><?php echo $thumb_img->post_title; // Display Caption ?></div>
                    <p><?php echo $thumb_img->post_excerpt; // Display Description ?></p>
                </figcaption>
            </figure>
            <?php
        } ?>

        <div class="entry-content">
            <?php
            the_excerpt();
            ?>

            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', 'understrap'),
                'after' => '</div>',
            ));
            ?>

        </div><!-- .entry-content -->
    </section>

    <footer class="entry-footer">

        <?php understrap_entry_footer(); ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
