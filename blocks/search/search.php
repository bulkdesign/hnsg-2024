<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'search-block alignwide' ); ?>>
    <div class="search-wrapper">
        <?php $icon = get_field( 'icon' ); ?>
        <?php if(!empty($icon)): ?>
            <?php if( 'image/svg+xml' === $icon['mime_type'] ): ?>
                <?php 
                    // phpcs:ignore
                    echo file_get_contents( get_attached_file( $icon['ID'] ) );
                ?>
            <?php else: ?>
                <img src="<?php echo esc_attr( $icon['url'] ); ?>" alt="<?php echo esc_attr( $button['title'] ); ?>" loading="lazy">
            <?php endif; ?>
        <?php endif; ?>

        <h2><?php echo esc_attr( get_field('title') ); ?></h2>	

        <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr( get_field('placeholder') ); ?>" />
            <input type="submit" class="primary-button" id="searchsubmit" value="<?php echo esc_attr( get_field('submit_text') ); ?>" />
        </form>
        
    </div>
</div>