<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Widget Template
 *
 *
 * @file           sidebar-left.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/sidebar-left.php
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>
<?php responsive_widgets_before(); // above widgets container hook ?>
	<div id="widgets" class="grid-right col-220 rtl-fit">
		<?php responsive_widgets(); // above widgets hook ?>

		<?php if( !dynamic_sidebar( 'left-sidebar' ) ) : ?>
			<div class="widget-wrapper">
			<?php echo do_shortcode('[searchandfilter fields="publisher,dates_in_collection,collection_objects" order_by="slug,slug,slug" types="checkbox,checkbox,checkbox" headings="Publisher,Dates,Types"]'); ?>

				

			</div><!-- end of .widget-wrapper -->
		<?php endif; //end of right-left ?>

		<?php responsive_widgets_end(); // after widgets hook ?>
	</div><!-- end of #widgets -->
<?php responsive_widgets_after(); // after widgets container hook ?>