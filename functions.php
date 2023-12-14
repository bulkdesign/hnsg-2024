<?php
/**
 * WordPress theme functions and definitions
 *
 * @package mm
 */

/**
 * Include helper scripts
 */
require_once get_stylesheet_directory() . '/inc/post-types.php';
require_once get_stylesheet_directory() . '/inc/taxonomies.php';

/**
 * Enqueue all the stylesheets necessary for the child theme.
 */
function child_theme_enqueue_styles() {
    //wp_enqueue_style( 'child-main-css', get_stylesheet_directory_uri() . '/css/main.css', array('main-css'), theme_get_app_css_version() );

}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );

/**
 * Enqueue all the scripts necessary for the child.
 */
function child_theme_enqueue_scripts() {
	
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_scripts' );