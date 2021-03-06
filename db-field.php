<?php

$field_group_slug = $GLOBALS['field_group_slug'];
$field_group_info = $GLOBALS['field_groups'][ $field_group_slug ];

$field_slug = $GLOBALS['field_slug'];
$field_info = $GLOBALS['bc_fields'][ $field_slug ];

$field_data = bc_get_database_field_value( $field_slug );
if ( 'checkbox' === $field_info['type'] ) {
	$field_data = ! empty( $field_data ) ? 'Yes' : 'No';
}

if ( $field_data ) {
	if ( ! $field_group_info['is_single'] ) {
		$field_data = '<strong>' . esc_html( $field_info['title'] ) . ':</strong> ' . $field_data;
	}

	$field_data = wptexturize( $field_data );
	$field_data = wpautop( $field_data );
	$field_data = make_clickable( $field_data );

	echo $field_data;
}
