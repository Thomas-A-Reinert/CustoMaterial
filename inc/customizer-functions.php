<?php

/**
 * Adapted from  * https://github.com/aristath/kirki/issues/268
 * Build a background-gradient style for CSS
 *
 * @param $color_1      hex color value
 * @param $color_2      hex color value
 *
 * @return string       CSS definition
 */
function kirki_build_gradients( $color_1, $color_2, $rotation ) {

    $styles = 'background:repeating-linear-gradient('.$rotation.'deg,'.$color_1.','.$color_1.' 3px,'.$color_2.' 10px,'.$color_2.' 20px);';

    return $styles;

}

function kirki_enqueue_header_gradients() {

    $color_1 = get_theme_mod( 'sticky_gradient_color_1', 'rgba(0,0,0,0.035)' );
    $color_2 = get_theme_mod( 'sticky_gradient_color_2', 'rgba(255,255,255,0)' );
    $rotation = get_theme_mod( 'sticky_gradient_rotation', '135' );

    $css = '.sticky{'.kirki_build_gradients( $color_1, $color_2, $rotation ).'}';
    if (get_theme_mod('display_sticky_gradient') == "true") {
    	wp_add_inline_style( 'kirki-styles', $css );
    }
}
add_action( 'wp_enqueue_scripts', 'kirki_enqueue_header_gradients', 999 );



/**
* Hex2RGB Converter
* http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
*/
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}

function adjustBrightness($hex, $steps) {
// lighten/darken hexcolors
// from: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}

/*
 * Invert incoming rgba-value
 * See https://gist.github.com/Thomas-A-Reinert/7eb5cfdfd64d64e5714e
 */
function invertRGBa($rgba) {
    $rgba = trim(str_replace(' ', '', $rgba));
    $res = array();
    if (stripos($rgba, 'rgba') !== false) {
        $res = sscanf($rgba, "rgba(%d, %d, %d, %f)");
    }
    else {
        $res = sscanf($rgba, "rgb(%d, %d, %d)");
        $res[] = 1;
    }
    //print_r($res);
    $r = 255-$res[0];
    $g = 255-$res[1];
    $b = 255-$res[2];

    $output = "$r, $g, $b";
    if (isset($res[3] ,$res)) {
    	$output .= ", " . $res[3];
    } else {
    	$output .= ", 1";
    }
    return $output;
}

?>
