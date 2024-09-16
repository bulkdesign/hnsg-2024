<?php
/**
 * This is a template for pages and posts.
 *
 * Template Name: Doc News
 * Template Post Type: page
 *
 * @package bulk
 */

?>

<?php get_header(); ?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

	<main>
		<div class="blocks-container">
			<?php the_content(); ?>
		</div>
	</main>

<?php endwhile; ?>

<?php
get_footer();
