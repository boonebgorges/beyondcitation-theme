<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * No-Posts Loop Content Template-Part File
 *
 * @file           loop-no-posts.php
 * @package        Responsive
 * @author         Emil Uzelac
 * @copyright      2003 - 2014 CyberChimps
 * @license        license.txt
 * @version        Release: 1.1.0
 * @filesource     wp-content/themes/responsive/loop-no-posts.php
 * @link           http://codex.wordpress.org/Templates
 * @since          available since Release 1.0
 */

/**
 * If there are no posts in the loop,
 * display default content
 */
$title = ( is_search() ? sprintf( __( 'Your search for %s did not match any entries.', 'responsive' ), get_search_query() ) : __( 'No results', 'responsive' ) );
?>

	<h1 class="title-404"><?php echo $title; ?></h1>

	<p><?php _e( 'The filters are designed to show results that match all selected criteria. To see results from any publisher or any time period, leave the publisher boxes unchecked.', 'responsive' ); ?></p>

	<h6><?php
		printf( __( 'You could also try searching for something more specific.', 'responsive' ),
				sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
						 esc_url( get_home_url() ),
						 esc_attr__( 'Home', 'responsive' ),
						 esc_attr__( '&larr; Home', 'responsive' )
				)
		);
		?></h6>

<?php get_search_form(); ?>