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
            'singular_name'	=> __('Convênio')
        ),
        'menu_position'     => 9,
        'public'			=> true,
        'has_archive'		=> true,
        'menu_icon'			=> 'dashicons-admin-multisite',
        'supports'			=> array('title', 'page-attributes', 'thumbnail'),
        'taxonomies'        => array('convenio'),
        'hierarchical'      => true,
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

// Eu Venci
register_post_type('eu-venci',
    array(
        'labels'			=> array(
            'name'			=> __('Eu Venci'),
            'singular_name' =>	__('Eu Venci')
            ),
        'menu_position'     => 5,
        'public'			=> true,
        'has_archive'		=> false,
        'menu_icon'			=> 'dashicons-awards',
        'supports'			=>	array('title', 'editor', 'page-attributes', 'thumbnail'),
        'show_in_rest'      => true,
        'taxonomies'        => array('category'),
        'hierarchical'      => true,
    )
);