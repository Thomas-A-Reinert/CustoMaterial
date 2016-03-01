<?php

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

add_action( 'cmb2_admin_init', 'TAR_portfolio_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function TAR_portfolio_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_lathom_';

	/**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'portfolio_metabox',
        'title'         => __( 'Portfolio Metabox', 'understrap' ),
        'object_types'  => array( 'portfolio', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

    $cmb->add_field( array(
	    'name' => __( 'Usage instructions', 'understrap' ),
	    'desc' => __( 'You do not have to enter <b><u>any</u></b> info at all, just the ones you need. Empty values won´t be displayed.', 'understrap' ),
	    'type' => 'title',
	    'id'   => 'portfolio_description',
	) );

	$cmb->add_field( array(
    'name'             => __( 'Portfolio Layout Selection', 'understrap' ),
    'id'               => 'portfolio_layout',
    'type'             => 'radio_inline',
    'before_row'	   => __( 'Do you want to show the gallery on the left or the right side?<br><br>
	    	<img src="' . get_stylesheet_directory_uri() . '/imgs/gallery_preview_info_right.png">&nbsp;&nbsp;<img src="' . get_stylesheet_directory_uri() . '/imgs/gallery_preview_info_left.png">', 'understrap' ),
    'default'		   => 'gallery_left',
    'options'          => array(
        'gallery_left' => __( 'Gallery on the left', 'understrap' ),
        'gallery_right'   => __( 'Gallery on the right', 'understrap' ),
    ),
) );

    $cmb->add_field( array(
        'name'       => __( 'Project Title', 'understrap' ),
        'desc'       => __( 'Enter the Projects title here.', 'understrap' ),
        'id'         => $prefix . 'project_title',
        'type'       => 'text',
    ) );

    $cmb->add_field( array(
	    'name'    => 'Client / Project Logo',
	    'desc'    => 'Upload an image or enter an URL.',
	    'id'      => $prefix . 'project_logo',
	    'type'    => 'file',
	    // Optional:
	    'options' => array(
	        'url' => false, // Hide the text input for the url
	    ),
	) );

    // Regular text field
    $cmb->add_field( array(
        'name'       => __( 'Client Name', 'understrap' ),
        'desc'       => __( 'Enter the Clients Name here.', 'understrap' ),
        'id'         => $prefix . 'project_clientname',
        'type'       => 'text',
    ) );

    // URL text field
    $cmb->add_field( array(
        'name' => __( 'Website URL', 'understrap' ),
        'desc' => __( 'Must begin with "http://" or "https://"', 'understrap' ),
        'id'   => $prefix . 'project_url',
        'type' => 'text_url',
        // 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
        'protocols' => array('http', 'https'), // Array of allowed protocols
        'repeatable' => true,
    ) );

    $cmb->add_field( array(
		'name' => __( 'Project Start Date', 'understrap' ),
		'desc' => __( 'When did the project begin?', 'understrap' ),
		'id'   => $prefix . 'project_startdate',
		'type' => 'text_date',
	) );

    $cmb->add_field( array(
		'name' => __( 'Project End Date', 'understrap' ),
		'desc' => __( 'When did it end?', 'understrap' ),
		'id'   => $prefix . 'project_enddate',
		'type' => 'text_date',
	) );

    $cmb->add_field( array(
		'name' => __( 'Project Tasks', 'understrap' ),
		'desc' => __( 'What were your responsibilities/tasks on that project?', 'understrap' ),
		'id'   => $prefix . 'project_tasks',
		'type' => 'text',
		'repeatable' => true,
	) );

	$cmb->add_field( array(
	    'name'    => __( 'Project Description', 'understrap' ),
	    'desc'    => __( '', 'understrap' ),
	    'id'      => $prefix . 'project_wysiwyg_text',
	    'type'    => 'wysiwyg',
	    'options' => array(),
	) ); // allowed tags: address, a, abbr, acronym, area, article, aside, b, big, blockquote, br, caption, cite, class, code, col, del, details, dd, div, dl, dt, em, figure, figcaption, footer, font, h1, h2, h3, h4, h5, h6, header, hgroup, hr, i, img, ins, kbd, li, map, ol, p, pre, q, s, section, small, span, strike, strong, sub, summary, sup, table, tbody, td, tfoot, th, thead, tr, tt, u, ul, var



	$cmb->add_field( array(
	    'name' => __( 'Project Gallery', 'understrap' ),
	    'desc' => __( 'Attach as many image files as you like. They will be displayed in a custom Gallery.<br> Please do <b><u>NOT</u></b> include any downloadable files here as this will break the Gallery!<br> Use the "Project Attachments" field for this instead.', 'understrap' ),
	    'id'   => $prefix . 'project_gallery_list',
	    'type' => 'file_list',
	    'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

	$cmb->add_field( array(
	    'name' => __( 'Project Attachments', 'understrap' ),
	    'desc' => __( 'Attach as many downloadable files as you like.<br>
	    	<u>Accepted filetypes:</u><br>
	    	<b>Images</b>: .jpg, .jpeg, .png, .gif, .ico, .svg<br>
	    	<b>Documents</b>: .pdf, .doc, .docx, .ppt, .pptx, .pps, .ppsx, .odt, .xls, .xlsx, .psd<br>
	    	<b>Audio</b>: .mp3, .m4a, .ogg, .wav<br>
	    	<b>Video</b>: .mp4, .m4v, .mov, .wmv, .avi, .mpg, .ogv, .3gp, .3g2<br>', 'understrap' ),
	    'id'   => $prefix . 'project_attachment_list',
	    'type' => 'file_list',
	    'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	) );

}

/*
* Output functions
 */

// function cmb2_output_gallery( $file_list_meta_key, $img_size = 'medium' ) {
// 	$gallery_images = get_post_meta( get_the_ID(), $file_list_meta_key, true );

// 	if ( ! empty( $gallery_images ) ) {
// 		echo '<div class="owl-carousel">';
// 		foreach($gallery_images as $key => $value) {
// 		 	echo '<div><img src="' . $value . '"></div>';  //working
// 		 	//wp_get_attachment_url( $key);
// 		 	$gallery_images = array_keys($gallery_images);
// 		}
// 		echo "</div>";
// 	}
// }

function cmb2_output_gallery( $file_list_meta_key, $img_size = 'large' ) {
	$gallery_images = get_post_meta( get_the_ID(), $file_list_meta_key, true );

	if ( ! empty( $gallery_images ) ) {
		echo '<div class="owl-carousel">';
		foreach($gallery_images as $key => $value) {

		 		$gallery_image_id = get_post_thumbnail_id( $key );
		 		$gallery_image_sources = wp_get_attachment_image_src($key, 'large', false);
		 		$gallery_image_title = get_the_title($key);
		 		$gallery_image_alt = get_post_meta($key , '_wp_attachment_image_alt', true);

		 		echo '<figure>';
			 		echo '<img src="' . $gallery_image_sources[0] . '" alt="' . $gallery_image_alt . '" class="img-responsive">' ;

			 		echo '<figcaption><h3> ' . $gallery_image_title . '</h3></figcaption>';
			 		// echo '<br><strong>Title:</strong> ' . $gallery_image_title . '<br>';
			 		// echo '<br><strong>Alt:</strong> ' . $gallery_image_alt . '<br>';
			 		//echo '<br><strong>Caption:</strong> ' . $gallery_image_caption . '<hr>';
	// 		 	// 	//echo $gallery_image_caption . '<br>';
	// 		 	// 	echo '<hr';
		 		echo '</figure>';
// 		 	// }
		}
		echo "</div>";
// 	} else {
// 		echo '<h2>' . __( 'This gallery currently contains no images. ', 'understrap' ) . '</h2>';
	}
}


function cmb2_output_attachments( $file_list_meta_key, $img_size = 'medium' ) {
    $attachments = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );

    if (!empty($attachments)) {
	    foreach( (array) $attachments as $attachment_id => $attachment_url) {
			$attachment_title = get_the_title($attachment_id);
			echo '<li>'. get_icon_for_attachment($attachment_id) . '&nbsp;<a href="' . wp_get_attachment_url( $attachment_id) . '" title="' . __( 'File Type: ', 'understrap' ) . get_post_mime_type($attachment_id) .'" download>'  . $attachment_title . '</a>&nbsp;&nbsp;(' . getSize(get_attached_file($attachment_id) ) . ')</li>';
		}
	}
}

function cmb2_output_links( $link_list_meta_key) {
    $links = get_post_meta( get_the_ID(), $link_list_meta_key, 1 );

	    foreach( (array) $links as $link_id => $link_url) {
			echo '<li>'. '<a href="' . wp_get_attachment_url( $link_id) . '">'  . $link_url . '</a></li>';
		}

}



function get_icon_for_attachment($attachment_id) {
	$type = get_post_mime_type($attachment_id);
	switch ($type) {
		case 'image/jpeg':
		case 'image/png':
		case 'image/gif':
		case 'image/x-icon':
		case 'image/svg+xml':
			return '<span class="fa fa-file-image-o"></span> '; break;
		case 'video/mpeg':
		case 'video/mp4':
		case 'video/quicktime':
		case 'video/x-ms-wmv': // wmv
		case 'video/x-msvideo': //avi
		case 'video/ogg': // ogv
			return '<span class="fa fa-file-video-o"></span> '; break;
		case 'video/mp3':
		case 'audio/mp4': //m4a
		case 'audio/ogg':
		case 'audio/x-wav': //wav
			return '<span class="fa fa-file-audio-o"></span> '; break;
		case 'text/csv':
		case 'text/plain':
		case 'text/xml':
		case 'application/pdf':
		case 'application/msword': //doc
		case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document': //docx
		case 'application/vnd.ms-powerpointtd': //ppt
		case 'application/vnd.openxmlformats-officedocument.presentationml.presentation': //pptx
		case 'application/vnd.ms-powerpoint': //pps
		case 'application/vnd.openxmlformats-officedocument.presentationml.slideshow': //ppsx
		case 'application/vnd.oasis.opendocument.text': //odt
		case 'text/application/vnd.ms-excel': //xls
		case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': // xlsx
		case 'application/photoshop':
		case 'application/zip':
		case 'application/x-compressed-zip':
			return '<span class="fa fa-file-archive-o"></span> '; break;
		default:
			return '<span class="fa fa-file-archive-o"></span> ';
	}
}

function getSize($file) {
	$bytes = filesize($file);
	$s = array('b', 'Kb', 'Mb', 'Gb');
	$e = floor(log($bytes)/log(1024));
	return sprintf('%.2f '.$s[$e], ($bytes/pow(1024, floor($e))));
}
?>
