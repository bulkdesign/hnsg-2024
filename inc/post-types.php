<?php
/**
 * Declares theme's custom post types
 *
 * @package mm
 */

/**
 * Theme's post types
 */
// Médicos
register_post_type('medico',
    array(
        'labels'			=> array(
            'name'			=> __('Médicos'),
            'singular_name' =>	__('Médico')
            ),
        'menu_position'     => 6,
        'public'			=> true,
        'has_archive'		=> true,
        'taxonomies'		=> array( 'especialidade',''),
        'menu_icon'			=> 'dashicons-nametag',
        'supports'			=>	array('title', 'thumbnail', 'taxonomy', 'page-attributes'),
    )
);

// Especialidades
register_post_type('especialidades',
    array(
        'labels'			=> array(
            'name'			=> __('Especialidades'),
            'singular_name' =>	__('Especialidade')
            ),
        'menu_position'     => 7,
        'public'			=> true,
        'has_archive'		=> true,
        'menu_icon'			=> 'dashicons-editor-spellcheck',
        'supports'			=>	array('title'),
    )
);

// Convênios
register_post_type('convenios',
    array(
        'labels'			=> array(
            'name'			=> __('Convênios'),
            'singular_name' =>	__('Convênio')
            ),
        'menu_position'     => 9,
        'public'			=> true,
        'has_archive'		=> true,
        'menu_icon'			=> 'dashicons-admin-multisite',
        'supports'			=>	array('title', 'page-attributes', 'thumbnail'),
    )
);

// Convênios Cobertura
register_post_type('convenios_cobertura',
    array(
        'labels'			=> array(
            'name'			=> __('Cobertura dos Convênios'),
            'singular_name' =>	__('Cobertura do Convênio')
            ),
        'menu_position'     => 10,
        'public'			=> true,
        'has_archive'		=> true,
        'menu_icon'			=> 'dashicons-groups',
        'supports'			=>	array('title', 'page-attributes'),
    )
);

// Locais de Atendimento
register_post_type('locais_atendimento',
    array(
        'labels'			=> array(
            'name'			=> __('Locais de atendimento'),
            'singular_name' =>	__('Local de atendimento')
            ),
        'menu_position'     => 10,
        'public'			=> true,
        'has_archive'		=> true,
        'menu_icon'			=> 'dashicons-groups',
        'supports'			=>	array('title', 'page-attributes'),
    )
);

// Outras Funções
register_post_type('outras_funcoes',
    array(
        'labels'			=> array(
            'name'			=> __('Outras funções'),
            'singular_name' =>	__('Outras funções')
            ),
        'menu_position'     => 10,
        'public'			=> true,
        'has_archive'		=> true,
        'menu_icon'			=> 'dashicons-businessman',
        'supports'			=>	array('title', 'page-attributes'),
    )
);