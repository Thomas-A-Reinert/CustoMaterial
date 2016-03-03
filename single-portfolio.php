<?php
/**
 * Single Post Template: Portfolio Post Template
 * Description: This part is optional, but helpful for describing the Post Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 *  @package understrap
*/

get_header(); ?>
<div class="wrapper" id="single-wrapper">

    <div  id="content" class="container<?php echo $postfix; ?>">

	<div id="primary" class="content-area <?php //echo $contentwidth ?> portfolio-page">

		<main id="main" class="site-main" role="main">

		<?php if ( function_exists('yoast_breadcrumb') ) {
            $yoast_links_options = get_option( 'wpseo_internallinks' );
            $yoast_bc_enabled=$yoast_links_options['breadcrumbs-enable'];
                if ($yoast_bc_enabled) { ?>
                    <div class="breadcrumb">
                        <?php yoast_breadcrumb('<p id="breadcrumbs"> <i class="fa fa-home"></i> ','</p>'); ?>
                    </div>
            <?php }
        } ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<?php
				if (get_theme_mod( 'show_content_attachment_image', 'true') != '' ) {
				?>
					<?php if ( has_post_thumbnail() ) { ?>
					<figure class="attachment-header-image">
						<?php
							if ( (get_theme_mod( 'show_sidebar') != 'true' ) || (get_theme_mod( 'content_width') == 'fullwidth') ) {
								the_post_thumbnail('header-image-large', array( 'class' => 'img-responsive', 'style' => 'width: 100%' ) );
							} else {
								the_post_thumbnail('header-image-medium', array( 'class' => 'img-responsive', 'style' => 'width: 100%' ) );
							}
						?>
						<figcaption class="attachment-header-image-caption">
							<?php
								// See http://www.bobz.co/how-to-get-attachment-image-caption-alt-or-description/
								// and http://codex.wordpress.org/Function_Reference/wp_get_attachment_metadata#Usage
								$thumb_img = get_post( get_post_thumbnail_id() ); // Get post by ID
							?>
								<div class="h2"><?php echo $thumb_img->post_title; // Display Caption ?></div>
								<p><?php echo $thumb_img->post_excerpt; // Display Description ?></p>

						</figcaption>
					</figure>
					<?php
				} }
				?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div>


				<?php
					// Display Gallery left or right based on Metabox selection
					$direction = get_post_meta( get_the_ID(), 'portfolio_layout', true );
					$the_content_pull = "";
					if ($direction == 'gallery_left') {
						$the_content_pull = "pull-right";
					}
				?>
				<div class="row">
					<div class="col-sm-4 <?php echo $the_content_pull; ?>">
						<div class="project-info">
						<?php
						$project_title = get_post_meta( get_the_ID(), '_lathom_project_title', true );
						$project_logo = get_post_meta( get_the_ID(), '_lathom_project_logo', true );
						$project_clientname = get_post_meta( get_the_ID(), '_lathom_project_clientname', true );
						$project_url = get_post_meta( get_the_ID(), '_lathom_project_url', true );
						$project_startdate = get_post_meta( get_the_ID(), '_lathom_project_startdate', true );
						$project_enddate = get_post_meta( get_the_ID(), '_lathom_project_enddate', true );
						$project_tasks = get_post_meta( get_the_ID(), '_lathom_project_tasks', true ); // (array)
						$project_wysiwyg_text = get_post_meta( get_the_ID(), '_lathom_project_wysiwyg_text', true );
						$project_attachment_list = get_post_meta( get_the_ID(), '_lathom_project_attachment_list', true ); // (array)

						?>
							<h2><?php echo __( 'Project Details', 'understrap' ); ?></h2>
							<?php
							// Project Title
							if (!empty($project_title) ) { ?>
								<div class="project-title">
									<p>
										<strong><?php echo __( 'Project Title: ', 'understrap' );?></strong><br>
										<span class=""><?php echo esc_html( $project_title ); ?></span>
									</p>
								</div>
							<?php
							}

							// Project Logo
							if (!empty($project_logo) ) { ?>
								<div class="project-logo">
									<!-- <h3><?php echo __( 'Project Logo', 'understrap' );?></h3> -->
									<span class="project-logo">
									<?php $logo = get_post_meta( get_the_ID(), '_lathom_project_logo');
									echo '<img src="' .$logo[0] . '" class="img-responsive center-block">';
	     							?></span><br>
								</div>
							<?php
							}


							// Client Info - Name, Link
							if (!empty($project_clientname) || !empty(get_post_meta( get_the_ID(), '_lathom_project_url', true ))) { ?>
								<div class="project-clientinfo">
									<p>
										<strong><?php echo __( 'Client Information: ', 'understrap' );?></strong><br>
										<?php echo esc_html( $project_clientname ); ?>
									</p>
								</div>
								<div class="project-links">
									<p>
										<strong><?php echo __( 'Links: ', 'understrap' );?></strong><br>
										<?php $entries = get_post_meta( get_the_ID(), '_lathom_project_url', true );
									    foreach((array)$entries as $key => $entry) {
									        echo '<span class="fa fa-link"></span> <a href="' . esc_html( $entry ) . '" title="' . esc_html( $project_clientname ) . '" target="_blank">' . esc_html( $entry ) . '</a><br>';
							   			} //* end foreach; ?>
							   		</p>
								</div>
							<?php
							}

							// Project Duration
							if (!empty($project_startdate) || !empty($project_enddate)) { ?>
								<hr>
								<div class="project-duration">
									<p>
										<strong><?php echo __( 'Project Duration: ', 'understrap' );?></strong><br>
										<?php if (!empty($project_startdate) ) { ?>
											<span><span class="fa fa-calendar"></span> <?php echo esc_html( $project_startdate ); ?> <?php echo __( 'until ', 'understrap' );?></span>
										<?php }
										if (!empty($project_enddate) ) { ?>
											&nbsp;<span><span class="fa fa-calendar"></span> <?php echo esc_html( $project_enddate ); ?></span>
										<?php } ?>
									</p>
								</div>
							<?php
							}

							// Project Tasks
							if (!empty($project_tasks)) { ?>
								<hr>
								<div class="project-tasks">
									<strong><?php echo __( 'Project Tasks: ', 'understrap' );?></strong>
									<ul class="project-task-list">
										<?php $entries = get_post_meta(get_the_ID() , '_lathom_project_tasks', true);
									    foreach((array)$entries as $key => $entry) {
									        echo '<li>' . $entry . '</li>';
							   			} //* end foreach; ?>
						   			</ul>
								</div>
							<?php
							}

							// Project Description
							if (!empty($project_wysiwyg_text)) { ?>
								<hr>
								<div class="project-description">
									<strong><?php echo __( 'Project Description: ', 'understrap' );?></strong><br>
									<?php echo $project_wysiwyg_text; ?>
								</div>
							<?php
							}

							// Attachment List
							if (!empty($project_attachment_list)) { ?>
								<hr>
								<div class="project-attachments">
									<strong><?php echo __( 'Project Attachments: ', 'understrap' ); ?></strong>
			    					<ul class="attachment-list">
										<?php echo cmb2_output_attachments( '_lathom_project_attachment_list'); ?>
									</ul>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="col-sm-8">
						<?php cmb2_output_gallery( '_lathom_project_gallery_list', 'medium' ); ?>
					</div>
				</div><!-- .entry-content -->

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'understrap' ),
						'after'  => '</div>',
					) );
				?>

				<footer class="entry-footer">
					<?php understrap_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

			<?php understrap_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php //if ( get_theme_mod( 'show_sidebar', 'true') ) : get_template_part('sidebar'); endif; ?>
</div><!-- Container end -->

</div><!-- Wrapper end -->
<script>
    jQuery(document).ready(function() {
        // var owl = jQuery('.owl-carousel');
        // owl.owlCarousel({
        //     items: 1,
        //     loop: true,
        //     autoplay:true,
        //     autoplayTimeout: 5000,
        //     animateOut: 'fadeOut',
        //     animateIn: 'fadeIn',
        //     nav: true,
        //     dots: true,
        //     autoplayHoverPause:true,
        //     margin:0,
        //     autoHeight:true,
        //     video: true
        // });

        jQuery(document).ready(function(){
		  jQuery(".owl-carousel").owlCarousel({
		  	items: 1,
		  	loop: true,
		  	dots: true,
		  	autoplay: true,
		  	autoplayTimeout: 5000,
		  	autoplayHoverPause: true,
		  	autoHeight: true,
		  	// animateOut: true,
		  	// animateIn: true,

		  });
		});

        jQuery('.play').on('click',function(){
            owl.trigger('autoplay.play.owl',[1000])
        });
        jQuery('.stop').on('click',function(){
            owl.trigger('autoplay.stop.owl')
        });
    });
</script>
<?php get_footer(); ?>
