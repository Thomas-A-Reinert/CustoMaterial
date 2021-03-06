<?php
/**
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="content-single-item">

	<header class="entry-header">

		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

     <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<!--BEGIN .author-bio-->
<div class="author-bio">
	<h3 class="author-title"><?php echo __('Author Info:', 'understrap'); ?> <?php the_author_link(); ?></h3>
	<div  class="author-description">
		<div class="author-content">
			<div class="pull-left author-avatar">
				<?php $website_url = get_the_author_meta( 'user_url' );
				if ( $website_url && $website_url != '' ) {
						echo '<a href="' . esc_url($website_url) . '" target="_blank">';
						echo get_avatar( get_the_author_meta('email') , 90 ) .'</a>';
				} ?>
			</div>
			<p><?php
				echo nl2br(get_the_author_meta('description'));
			?></p>

		</div>
	</div>
	<div class="author-contact">
			<?php echo __('Contact', 'understrap') . ' ' . get_the_author_meta('display_name') . ':'; ?>
			<ul class="icons">
			<?php
				if ( $website_url && $website_url != '' ) {
					echo '<li class="rss btn-xs btn-ghost"><a href="' . esc_url($website_url) . '" target="_blank"><span class="fa fa-link"></span></a></li>';
				}

				$rss_url = get_the_author_meta( 'rss_url' );
				if ( $rss_url && $rss_url != '' ) {
					echo '<li class="rss btn-xs btn-ghost"><a href="' . esc_url($rss_url) . '" target="_blank"><span class="fa fa-rss"></span></a></li>';
				}

				$google_profile = get_the_author_meta( 'google_profile' );
				if ( $google_profile && $google_profile != '' ) {
					echo '<li class="google btn-xs btn-ghost"><a href="' . esc_url($google_profile) . '" rel="author" target="_blank"><span class="fa fa-google-plus"></span></a></li>';
				}

				$twitter_profile = get_the_author_meta( 'twitter_profile' );
				if ( $twitter_profile && $twitter_profile != '' ) {
					echo '<li class="twitter btn-xs btn-ghost"><a href="' . esc_url($twitter_profile) . '" target="_blank"><span class="fa fa-twitter"></span></a></li>';
				}

				$facebook_profile = get_the_author_meta( 'facebook_profile' );
				if ( $facebook_profile && $facebook_profile != '' ) {
					echo '<li class="facebook btn-xs btn-ghost"><a href="' . esc_url($facebook_profile) . '" target="_blank"><span class="fa fa-facebook"></span></a></li>';
				}

				$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
				if ( $linkedin_profile && $linkedin_profile != '' ) {
					echo '<li class="linkedin btn-xs btn-ghost"><a href="' . esc_url($linkedin_profile) . '" target="_blank"><span class="fa fa-linkedin"></span></a></li>';
				}

				$xing_profile = get_the_author_meta( 'xing_profile' );
				if ( $xing_profile && $xing_profile != '' ) {
					echo '<li class="xing btn-xs btn-ghost"><a href="' . esc_url($xing_profile) . '" target="_blank"><span class="fa fa-xing"></span></a></li>';
				}
			?>
			</ul>
		</div>
</div><!--END .author-bio-->
