<?php
/**
 * @package understrap
 */

$classesplus = array(
    'col-md-6',
);

$classes = get_post_class($classesplus, get_the_ID());
$classes = implode(" ", $classes);

$thumb_id = get_post_thumbnail_id();
$thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true);
global $counter;
//echo $counter;
?>

<figure id="post-<?php the_ID(); ?>" class="mix <?php echo $classes; ?>" data-name="id-<?php echo $counter; ?>"  data-myorder="<?php echo $counter; ?>">

    <a href="<?php echo esc_url(get_permalink()); ?>">
        <?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
    </a>

    <figcaption>
        <?php $project_title = get_post_meta(get_the_ID(), '_lathom_project_title', true);
        echo '<h2 class="entry-title h3" data-toggle="collapse" href="#portfolioitem' . get_the_ID() . '"><a href="' . esc_url(get_permalink()) . '">' . $project_title . '</a></h2>'; ?>

        <div class="collapse" id="portfolioitem<?php echo get_the_ID(); ?>">
            <?php //get_excerpt(); ?>
            <?php echo limit_excerpt(25); ?>
            <?php echo '<br><a class="btn btn-default btn-sm btn-raised understrap-read-more-link" href="' . esc_url(get_permalink()) . '">' . __('Read More...', 'understrap') . '</a>'; ?>
        </div>
    </figcaption><!-- .entry-header -->
</figure><!-- #post-## -->
