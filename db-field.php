<?php

$field_group_slug = $GLOBALS['field_group_slug'];
$field_group_info = $GLOBALS['field_groups'][ $field_group_slug ];

$field_slug = $GLOBALS['field_slug'];
$field_info = $GLOBALS['bc_fields'][ $field_slug ];

$field_data = get_post_meta( get_the_ID(), $field_slug, true );

if ( $field_data ) {
	if ( ! $field_group_info['is_single'] ) {
		$field_data = '<strong>' . esc_html( $field_info['title'] ) . ':</strong> ' . $field_data;
	}

	$field_data = wptexturize( $field_data );
	$field_data = wpautop( $field_data );
	$field_data = make_clickable( $field_data );

	echo $field_data;
}
