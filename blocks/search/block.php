<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_search() {
	theme_declare_block(
		array(
			'name'        => 'search',
			'title'       => __( 'Specialist Search', 'bulk' ),
			'description' => __( 'Search bar that results in finding doctors and specialists', 'bulk' ),
			'icon'        => 'search',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['s'])) {
    $search_query = sanitize_text_field($_POST['s']);
    
    // Manually build the redirect URL without using esc_url() to prevent over-encoding
    $redirect_url = home_url( '/hospital/corpo-clinico/?paged=1&filter_block[s]=' . urlencode($search_query) );

    // Perform the redirect
    wp_redirect($redirect_url);
    exit;
}

add_action( 'theme_declare_block', 'child_theme_block_search', 20 );
