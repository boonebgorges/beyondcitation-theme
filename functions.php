<?php

/**
 * Provide a fallback value for header image.
 */
function beyondcitation_header_image_fallback( $image ) {
	if ( ! empty( $image ) ) {
		return $image;
	}

	return get_stylesheet_directory_uri() . '/assets/img/beyondcitation_logo_500_1.png';
}
add_filter( 'theme_mod_header_image', 'beyondcitation_header_image_fallback' );

/**
 * Provide a fallback value for header image dimensions.
 */
function beyondcitation_header_image_data_fallback( $data ) {
	if ( ! empty( $data ) ) {
		return $data;
	}

	$data = new stdClass;
	$data->width = 500;
	$data->height = 215;

	return $data;
}
add_filter( 'theme_mod_header_image_data', 'beyondcitation_header_image_data_fallback' );
