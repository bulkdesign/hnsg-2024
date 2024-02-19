<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bulk
 */

get_header(); ?>

<main id="page" class="default-template">
	<div class="blocks-container">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

            <?php if ( function_exists('yoast_breadcrumb') ): ?>
                <?php yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>
            <?php endif; ?>

            <div class="page-title">
                <?php $categories = get_the_category(); ?>
                <?php if ( ! empty( $categories ) ) : ?>
                    <h1><?php echo esc_html( $categories[0]->name ); ?></h1>
                <?php else : ?>
                    <?php $parent_title = get_the_title($post->post_parent); ?>
                    <h1><?php echo $parent_title; ?></h1>
                <?php endif; ?>
            </div>

			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
</main>

<?php

get_footer();
