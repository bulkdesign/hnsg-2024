<?php
/**
 * Declares theme's custom taxonomies
 *
 * @package mm
 */

/**
 * Theme's taxonomies
 */

add_action( 'init', 'medicos_tax' );
function medicos_tax() {

	register_taxonomy(
		'especialidade',
		'medico',
		array(
			'label' => 'Especialidades',
			'hierarchical' => true,
			)
		);

	register_taxonomy(
		'centro',
		'medico',
		array(
			'label' => 'Centros',
			'hierarchical' => true,
			)
		);

}