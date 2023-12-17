<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<header <?php theme_block_attributes( $block, 'header' ); ?>>
    <div class="header-inner">
        <a href="<?php echo esc_url( get_home_url() ); ?>" class="logo" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
            <?php $logo = get_field( 'logo' ); ?>
            <?php if(!empty($logo)): ?>
                <?php if( 'image/svg+xml' === $logo['mime_type'] ): ?>
                    <?php 
                        // phpcs:ignore
                        echo file_get_contents( get_attached_file( $logo['ID'] ) );
                    ?>
                <?php else: ?>
                    <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <?php endif; ?>
            <?php endif; ?>
        </a>

        <?php if( get_field( 'display_search' ) ) : ?>
        <button class="header-search-toggle" type="button" aria-label="<?php esc_attr_e( 'Search', 'mm' ); ?>">
            <?php theme_block_asset('img/icon-search.svg'); ?>
        </button>
        <?php endif; ?>

        <button class="header-menu-toggle" aria-label="<?php esc_attr_e( 'Menu', 'mm' ); ?>">
            <span class="menu-bar"></span>
            <span class="menu-bar"></span>
            <span class="menu-bar"></span>
        </button>

        <div class="header-collapsable-content">
            <?php if( get_field( 'display_search' ) ) : ?>
            <form action="<?php echo get_home_url(); ?>" class="header-search-form" role="search">
                <button type="submit" class="header-search-form-submit" aria-label="<?php esc_attr_e( 'Search', 'mm' ); ?>">
                    <?php theme_block_asset('img/icon-search.svg'); ?>
                </button>
                <input type="search" name="s" placeholder="<?php esc_attr_e( 'What are you looking for?', 'mm' ); ?>" value="<?php echo esc_attr( get_query_var( 's' ) ); ?>" aria-label="<?php esc_attr_e( 'Search', 'mm' ); ?>">
                <button type="button" class="header-search-form-close" aria-label="<?php esc_attr_e( 'Close search form', 'mm' ); ?>">
                    
                </button>
            </form>
            <?php endif; ?>

            <?php add_filter( 'walker_nav_menu_start_el', 'child_theme_block_header_submenu_toggle', 10, 4 ); ?>
            <?php if( get_field( 'main_menu' ) ): ?>
            <nav class="header-main-menu">
                <?php
                    wp_nav_menu(
                        array(
                            'menu' => get_field( 'main_menu' ),
                            'depth' => 2,
                            'menu_class' => 'menu main-menu',
                        )
                    );
                ?>
            </nav>
            <?php endif; ?>
            <?php remove_filter( 'walker_nav_menu_start_el', 'child_theme_block_header_submenu_toggle', 10 ); ?>
        </div>
    </div>
</header>