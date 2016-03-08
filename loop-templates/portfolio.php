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
?>

<figure id="post-<?php the_ID(); ?>" class="<?php echo $classes; ?>">
    <a href="<?php echo esc_url(get_permalink()); ?>">
        <?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
    </a>
    <!-- <a href="<?php echo esc_url(get_permalink()); ?>">
		<?php //the_post_thumbnail( 'medium', array( 'class' => 'img-responsive' ) ); ?>
		<?php //print_r(wp_get_attachment_image_src ( $thumb_id, 'medium', false )); ?>
		<?php $image_info = wp_get_attachment_image_src('medium', false);
    // echo 'height:' .$image_info[1];
    // echo 'width:' .$image_info[2];?>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/empty.png" width="<?php echo $thumb_url[2]; ?>" height="<?php echo $thumb_url[1]; ?>" class="img-responsive"  style="background-image: url('<?php echo $thumb_url[0]; ?>'); background-repeat:no-repeat; background-position: right top; background-size: cover; width: <?php echo $thumb_url[2]; ?>px;height: auto;">
	</a> -->


    <figcaption>
        <?php $project_title = get_post_meta(get_the_ID(), '_lathom_project_title', true);
        echo '<h2 class="entry-title h3" data-toggle="collapse" href="#portfolioitem' . get_the_ID() . '"><a href="' . esc_url(get_permalink()) . '">' . $project_title . '</a></h2>'; ?>

        <?php // the_title( sprintf( '<h2 class="entry-title" data-toggle="collapse" href="#portfolioitem' . get_the_ID() .'"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <div class="collapse" id="portfolioitem<?php echo get_the_ID(); ?>">
            <?php //get_excerpt(); ?>
            <?php echo limit_excerpt(25); ?>
            <?php echo '<br><a class="btn btn-default btn-sm btn-raised understrap-read-more-link" href="' . esc_url(get_permalink()) . '">' . __('Read More...', 'understrap') . '</a>'; ?>
        </div>
    </figcaption><!-- .entry-header -->
</figure><!-- #post-## -->
