<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package understrap
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}

if (get_theme_mod('content_width') == 'fullwidth') {
    $sidebarwidth = "col-md-3";
} else {
    $sidebarwidth = "col-md-4";
}
?>

<div id="secondary" class="widget-area <?php echo $sidebarwidth; ?>" role="complementary">

    <?php dynamic_sidebar('sidebar-1'); ?>

</div><!-- #secondary -->
