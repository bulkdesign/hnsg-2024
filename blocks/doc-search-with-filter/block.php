<?php
/**
 * Declares a block
 *
 * @package mm
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_doc_search_with_filter() {
	theme_declare_block(
		array(
			'name'        => 'doc-search-with-filter',
			'title'       => __( 'Doctors Search With Filter', 'mm' ),
			'description' => __( 'Displays a list of doctors', 'mm' ),
			'icon'        => 'admin-post',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
            'post_types'  => array( 'page', 'template' ),
		)
	);

	function child_theme_block_doc_search_with_filter_query_vars( $query_vars ){
		$query_vars[] = 'filter_block';
		return $query_vars;
	}
	add_filter( 'query_vars', 'child_theme_block_doc_search_with_filter_query_vars' );
	
    function child_theme_block_doc_search_with_filter_load_post_types( $field ) {
		$post_types = get_post_types( array(), 'objects');

		if ( ! empty( $post_types ) ) {
			foreach ( $post_types as $current_post_type ) {
				if ( $current_post_type->exclude_from_search || $current_post_type->name === 'attachment' ) continue;
				$field['choices'][ $current_post_type->name ] = $current_post_type->label;
			}
		}

        return $field;
    }
    add_filter( 'acf/prepare_field/key=field_64c158a4ed708_doc_search_with_filter', 'child_theme_block_doc_search_with_filter_load_post_types' );
	
    function child_theme_block_doc_search_with_filter_load_taxonomies( $field ) {
		$taxonomies = get_taxonomies( array(), 'objects');

		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $current_taxonomy ) {
				if ( ! $current_taxonomy->publicly_queryable || $current_taxonomy->name === 'post_format' ) continue;
				$field['choices'][ $current_taxonomy->name ] = $current_taxonomy->label;
			}
		}

        return $field;
    }
    add_filter( 'acf/prepare_field/key=field_64c158b2ed709_doc_search_with_filter', 'child_theme_block_doc_search_with_filter_load_taxonomies' );
}

add_action( 'theme_declare_block', 'child_theme_block_doc_search_with_filter', 60 );