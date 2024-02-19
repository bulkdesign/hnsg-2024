<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_corpo_clinico() {
	theme_declare_block(
		array(
			'name'        => 'corpo-clinico',
			'title'       => __( 'Corpo Clínico', 'bulk' ),
			'description' => __( 'List with all the specialists', 'bulk' ),
			'icon'        => 'info-outline',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_corpo_clinico', 20 );
