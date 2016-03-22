<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */
$classesplus = array(
    'content-no-results-page',
    'not-found',
);

$classes = get_post_class($classesplus, get_the_ID());
$classes = implode(" ", $classes);
?>

<article id="post-<?php the_ID(); ?>" class="<?php echo $classes; ?>">

    <header class="page-header">

        <h2 class="page-title"><?php _e('Nothing Found', 'understrap'); ?></h2>

    </header><!-- .page-header -->

    <div class="page-content">

        <?php if (is_home() && current_user_can('publish_posts')) : ?>

            <p><?php printf(__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'understrap'), esc_url(admin_url('post-new.php'))); ?></p>

        <?php elseif (is_search()) : ?>

            <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'understrap'); ?></p>
            <?php //get_search_form(); ?>
            <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="row">
                <div class="col-sm-9">
                    <label for="searchbox"
                           class="sr-only"><?php echo __('Search for:', 'understrap') ?></label>
                    <input type="search" placeholder="<?php echo __('Search ..', 'understrap') ?>"
                           value="<?php echo get_search_query() ?>" name="s"
                           title="<?php echo __('Search for:', 'understrap') ?>" class="form-control">
                </div>
                <div class="col-sm-3">
                    <button type="submit"
                            class="submit btn btn-raised"><?php echo __('Search', 'understrap') ?></button>
                </div>
            </form>

        <?php else : ?>

            <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'understrap'); ?></p>

            <?php // get_search_form(); ?>
            <form role="search" method="get" action="<?php echo home_url('/'); ?>" class="row">
                <div class="col-sm-9">
                    <label for="searchbox"
                           class="sr-only"><?php echo __('Search for:', 'understrap') ?></label>
                    <input type="search" placeholder="<?php echo __('Search ..', 'understrap') ?>"
                           value="<?php echo get_search_query() ?>" name="s"
                           title="<?php echo __('Search for:', 'understrap') ?>" class="form-control">
                </div>
                <div class="col-sm-3">
                    <button type="submit"
                            class="submit btn btn-raised"><?php echo __('Search', 'understrap') ?></button>
                </div>
            </form>

        <?php endif; ?>

    </div><!-- .page-content -->

</article><!-- .no-results -->
