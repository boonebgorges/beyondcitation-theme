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

/**
 * Don't allow WP to trim excerpts on single DB pages.
 */
add_action( 'wp', function() {
	if ( is_singular( 'bc_database' ) ) {
		remove_filter( 'get_the_excerpt', 'responsive_custom_excerpt_more' );
	}
} );

/**
 * Get a field group -> field mapping.
 */
function beyondcitation_field_groups() {
	return array(
		'overview' => array(
			'title' => 'Overview',
			'is_single' => true,
			'fields' => array(
				'bc_overview',
			),
		),
		'facts' => array(
			'title' => 'Facts',
			'is_single' => false,
			'fields' => array(
				'date_range',
				'publisher_name',
				'link_publisher_about_page',
				'type_object',
				'geographic_location_original_materials',
				'geographic_location_subject',
				'image_exportable',
				'facsimile_image',
				'full_text_searchable',
				'link_list_titles',
			),
		),
		'history' => array(
			'title' => 'History/Provenance',
			'is_single' => false,
			'fields' => array(
				'original_catalog',
				'original_microfilm',
				'original_sources',
				'history',
			),
		),
		'review' => array(
			'title' => 'Review',
			'is_single' => true,
			'fields' => array(
				'third_party_reviews',
			),
		),
		'access' => array(
			'title' => 'Access',
			'is_single' => false,
			'fields' => array(
				'link_worldcat',
				'access',
				'ill_conditions',
			),
		),
		'publisher' => array(
			'title' => 'Info from Publisher',
			'is_single' => true,
			'fields' => array(
				'info_from_publisher',
			),
		),
		'conversations' => array(
			'title' => 'Conversations',
			'is_single' => true,
			'fields' => array(
				'conversations',
			),
		),
		'citing' => array(
			'title' => 'Citing',
			'is_single' => true,
			'fields' => array(
				'citing',
			),
		),
	);
}
