<?php

/**
 * Enqueue static assets.
 */
function beyondcitation_enqueue_assets() {
	wp_enqueue_script( 'beyond-citation', get_stylesheet_directory_uri() . '/assets/js/bc.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'beyondcitation_enqueue_assets' );

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
				'link_titles_list',
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

// Create 'Blog' and 'Essays' custom post types
function create_posttypes() {
  register_post_type( 'blog',
  // CPT Options
    array(
        'labels' => array(
            'name' => __( 'Blog' ),
            'singular_name' => __( 'Blog Post' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'blog-posts'),
        'menu_icon' => 'dashicons-format-quote'
    )
  );
  register_post_type( 'essays',
  // CPT Options
    array(
        'labels' => array(
            'name' => __( 'Essays' ),
            'singular_name' => __( 'Essay' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'essay'),
        'menu_icon' => 'dashicons-format-aside'
    )
  );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttypes' );


// Advance Custom Fields for 'Blog'
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_blog-fields',
		'title' => 'Blog Fields',
		'fields' => array (
			array (
				'key' => 'field_5ae687f7dfde5',
				'label' => 'Author',
				'name' => 'author',
				'type' => 'text',
				'instructions' => 'The original author of the post',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => 'by',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'blog',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}


// Add <div class="table-responsive"> to all instances of tables made with WYSIWYG
add_action( 'the_content', 'wpse_260756_the_content', 10, 1 );
function wpse_260756_the_content( $content ) {
  $pattern = "/<table(.*?)>(.*?)<\/table>/i";
  $replacement = '<div class="table-responsive"><table$1>$2</table></div>';

  return preg_replace( $pattern, $replacement, $content );
}





// Advance Custom Fields for 'Essays'
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_bibliography',
		'title' => 'Bibliography',
		'fields' => array (
			array (
				'key' => 'field_5af0bd813f3f0',
				'label' => 'Bibliography',
				'name' => 'bibliography',
				'type' => 'wysiwyg',
				'instructions' => 'Add each source to the content editor separated by a return.
	Bold the title of each source.',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'essays',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_subtitle-author-and-date',
		'title' => 'Subtitle, Author, and Date',
		'fields' => array (
			array (
				'key' => 'field_5af0c49d630b1',
				'label' => 'Subtitle',
				'name' => 'subtitle',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5af22ddb8fed5',
				'label' => 'Author',
				'name' => 'author',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => 'by',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5af22ddb8fed3',
				'label' => 'Author Link Destination',
				'name' => 'author_link_destination',
				'type' => 'text',
				'instructions' => 'The name of the author will appear as a link. Enter the URL that the author\'s name should link to. By default it will link to the contributor\'s page.',
				'default_value' => 'https://www.beyondcitation.org/contributors/',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5af3a57ba9a67',
				'label' => 'Date',
				'name' => 'essay_date',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'January 1st, 2000',
				'prepend' => 'Published',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'essays',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_editors-introduction',
		'title' => 'Editor\'s Introduction',
		'fields' => array (
			array (
				'key' => 'field_5af48233fc86b',
				'label' => 'Add Introduction',
				'name' => 'add_introduction',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af481f3fc86a',
				'label' => 'Editor\'s Introduction',
				'name' => 'editors_introduction',
				'type' => 'wysiwyg',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af48233fc86b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af482e7fc86c',
				'label' => 'Introduction Author',
				'name' => 'introduction_author',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af48233fc86b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => 'By',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5af482fdfc86d',
				'label' => 'Introduction Date',
				'name' => 'introduction_date',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af48233fc86b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'January 1st, 2000',
				'prepend' => 'Published',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'essays',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));
	register_field_group(array (
		'id' => 'acf_editors-note',
		'title' => 'Editor\'s Note',
		'fields' => array (
			array (
				'key' => 'field_5af5c222c717f',
				'label' => 'Add an editor\'s note?',
				'name' => 'add_a_note',
				'type' => 'true_false',
				'instructions' => ' ',
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c277c7180',
				'label' => 'Add editor\'s note ',
				'name' => 'add_editors_note',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c222c717f',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af5c2b9c7181',
				'label' => 'Add a second note?',
				'name' => 'add_a_second_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c222c717f',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c2dac7182',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_2',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c2b9c7181',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af5c2f5c7183',
				'label' => 'Add a third note?',
				'name' => 'add_a_third_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c2b9c7181',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c31ec7184',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_3',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c2f5c7183',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af5c49329387',
				'label' => 'Add a fourth note?',
				'name' => 'add_a_fourth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c2f5c7183',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c49929388',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_4',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c49329387',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af5c4f429389',
				'label' => 'Add a fifth note?',
				'name' => 'add_a_fifth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c49329387',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c50e2938a',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_5',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c4f429389',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af5c53d2938e',
				'label' => 'Add a sixth note?',
				'name' => 'add_a_sixth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c4f429389',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c54a29392',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_6',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c53d2938e',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af5c53c2938d',
				'label' => 'Add a seventh note?',
				'name' => 'add_a_seventh_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c53d2938e',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c54a29391',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_7',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c53c2938d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af5c53c2938c',
				'label' => 'Add an eighth note?',
				'name' => 'add_an_eighth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c53c2938d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c54929390',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_8',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c53c2938c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af5c5392938b',
				'label' => 'Add a ninth note? ',
				'name' => 'add_a_ninth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c53c2938c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af5c5492938f',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_9',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c5392938b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af617ff59e40',
				'label' => 'Add a tenth note?',
				'name' => 'add_a_tenth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af5c5392938b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af6180959e41',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_10',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617ff59e40',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af617ff59e3f',
				'label' => 'Add an eleventh note?',
				'name' => 'add_an_eleventh_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617ff59e40',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af6181259e45',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_11',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617ff59e3f',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af617fe59e3e',
				'label' => 'Add a twelfth note?',
				'name' => 'add_a_twelfth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617ff59e3f',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af6181259e44',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_12',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617fe59e3e',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af617fe59e3d',
				'label' => 'Add a thirtheenth note?',
				'name' => 'add_a_thirteenth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617fe59e3e',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af6181159e43',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_13',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617fe59e3d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af617f359e3c',
				'label' => 'Add a fourteenth note?',
				'name' => 'add_a_fourteenth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617fe59e3d',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af6181159e42',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_14',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617f359e3c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af617f259e3b',
				'label' => 'Add a fifteenth note?',
				'name' => 'add_a_fifteenth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617f359e3c',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af6195059e48',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_15',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617f259e3b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af617f159e3a',
				'label' => 'Add a sixteenth note?',
				'name' => 'add_a_sixteenth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617f259e3b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af6194e59e47',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_16',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617f159e3a',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af617f059e39',
				'label' => 'Add a seventeenth note?',
				'name' => 'add_a_seventeenth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617f159e3a',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af6194d59e46',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_17',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617f059e39',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af619d259e4b',
				'label' => 'Add an eighteenth note?',
				'name' => 'add_an_eighteenth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af617f059e39',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af619d759e4e',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_18',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af619d259e4b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af619d159e4a',
				'label' => 'Add a nineteenth note?',
				'name' => 'add_a_nineteenth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af619d259e4b',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af619d759e4d',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_19',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af619d159e4a',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5af619d159e49',
				'label' => 'Add a twentieth note?',
				'name' => 'add_a_twentieth_note',
				'type' => 'true_false',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af619d159e4a',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => 'Add note',
				'default_value' => 0,
			),
			array (
				'key' => 'field_5af619d659e4c',
				'label' => 'Add editor\'s note',
				'name' => 'add_editors_note_20',
				'type' => 'wysiwyg',
				'instructions' => 'Add the date at the top of your note as a Heading 1.
	But also… this is it. Too many notes. You\'re cut off.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5af619d159e49',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'essays',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 1,
	));
}
