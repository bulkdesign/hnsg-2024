<?php
/**
 * Block: Posts Archive with Filter
 *
 * @package bulk
 */

$filters = get_query_var('filter_block');

if ( ! is_singular() && empty( $filters ) ) {
    $uses_custom_query = 0;
    $queried_object = get_queried_object();
} else {
    $uses_custom_query = 1;
    if(empty($filters)){
        $filters = array();
    }
}

// Add a fallback in case $queried_object is still not set
if ( ! isset( $queried_object ) ) {
    $queried_object = null; // Define a default value if $queried_object is not set
}

$post_types = get_field( 'post_types' ) ? get_field( 'post_types' ) : apply_filters( 'posts_archive_with_filter_post_types', array( 'post' ) );

?>

<section <?php theme_block_attributes( $block, 'posts-archive-with-filter alignwide' ); ?>>
    <?php if ( ! get_field( 'hide_title' ) ) : ?>
    <header>
        <h1>
            <?php 
                if( is_search() ){
                    $title = sprintf( esc_attr__( 'Search for: %s', 'bulk' ), get_search_query() );
                }elseif( is_home() ){
                    $title = get_the_title( get_option( 'page_for_posts', true ) );
                }else{
                    $title = get_the_archive_title(); 
                }

                if( get_field( 'title' ) ) {
                    the_field( 'title' );
                }else{
                    echo apply_filters( 'posts_archive_with_filter_title', $title );
                }
            ?>
        </h1>
    </header>
    <?php endif; ?>

    <?php
        if( is_post_type_archive() ){
            $post_type_taxonomies = get_object_taxonomies( $queried_object->name );
        }elseif( is_tax() ){
            $post_type_taxonomies = array( $queried_object->taxonomy );
        }else{
            $post_type_taxonomies = get_object_taxonomies( $post_types );
        }

        $filter_taxonomies = get_field( 'taxonomies' ) ? get_field( 'taxonomies' ) : apply_filters( 'posts_archive_with_filter_taxonomies', $post_type_taxonomies, $queried_object );
    ?>
    
    <div class="posts-archive-with-filter-content-wrapper">
		<div class="posts-archive-with-filter-content-loading">
			<?php theme_block_asset( 'img/loading.svg' ); ?>
		</div>
        <div class="posts-archive-with-filter-content-inner">
            <?php
                if ( ! $uses_custom_query ) {
                    global $wp_query;
			        $query = $wp_query;
                } else {
                    $args = array(
                        'post_type'      => $post_types,
                        'paged'          => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
                        'orderby'        => 'date',
                        'order'          => 'desc',
                        // phpcs:ignore
                        'posts_per_page' => get_field( 'posts_per_page' ) ? get_field( 'posts_per_page' ) : get_option( 'posts_per_page' ),
                        // phpcs:ignore
                        'tax_query'      => array(),
                    );

                    if ( ! empty( $filters['s'] ) ) {
                        $args['s'] = $filters['s'];
                    }

                    if ( ! empty( $filters['taxonomy'] ) ) {
                        foreach ( $filters['taxonomy'] as $key => $filter ) {
                            $args['tax_query'][] = array(
                                'taxonomy' => $key,
                                'field'    => 'slug',
                                'terms'    => $filter,
                            );
                        }
                    }

				    $query = new WP_Query( $args );
                }
            ?>

            <?php if ( $query->have_posts() ) : ?>
                <?php if ( get_post_type() !== 'convenios' ) : ?>
                    <div class="posts-archive-with-filter-content-grid" id="<?php echo esc_attr( theme_block_id( $block ) ); ?>-posts-archive-with-filter-content-grid" tabindex="0">
                        <?php while ( $query->have_posts() ) : ?>
                            <?php $query->the_post(); ?>

                            <?php if ( get_the_title() ) : ?>
                                <article class="post-loop post-card">
                                    <div class="posts-archive-with-filter-content-grid-inner">
                                        <!-- THUMBNAIL -->
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php if ( get_post_type() === 'post' ) : ?>
                                                <div class="posts-archive-with-filter-content-grid-inner-thumb">
                                                    <?php $attachment_image = wp_get_attachment_url( get_post_thumbnail_id() ); ?>

                                                    <div class="post-loop-image">
                                                        <img src="<?php echo esc_url( $attachment_image ); ?>" />
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div class="posts-archive-with-filter-content-grid-inner-content">
                                            <h3><?php the_title(); ?></h3>

                                            <?php if ( get_post_type() === 'medico' ) : ?>
                                                <!-- CRM -->
                                                <?php $crm = get_field( 'crm', get_the_ID() ); ?>
                                                <?php if ( ! empty( $crm ) ) : ?>
                                                    <p>CRM: <?php echo $crm; ?></p>
                                                <?php endif; ?>

                                                <!-- ESPECIALIDADE -->
                                                <?php $especialidade = get_field( 'especilidade_medica', get_the_ID() ); ?>
                                                <?php $especialidade_titulo = get_the_title( $especialidade ); ?>
                                                    
                                                <?php if ( ! empty( $especialidade_titulo ) ) : ?>
                                                    <h4>Especialidade</h4>
                                                    <?php echo $especialidade_titulo; ?>
                                                <?php endif; ?>

                                                <!-- CONSULTORIO NO HOSPITAL -->
                                                <?php $consultorio = get_field( 'atende_no_hospital', get_the_ID() ); ?>
                                                <?php if ( ! empty( $consultorio ) ) : ?>
                                                    <p>Consultório no Hospital: <strong><?php echo $consultorio; ?></strong></p>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <a href="<?php the_permalink(); ?>" class="read-more">
                                                <span class="primary-button"><?php esc_html_e( 'Mais informações', 'bulk' ); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="posts-archive-with-filter-content-pagination">
                        <?php if ( ! $uses_custom_query ) : ?>
                            <?php the_posts_pagination(); ?>
                        <?php else: ?>
                        <nav class="navigation pagination" aria-label="<?php esc_attr_e( 'Pagination', 'bulk' ); ?>">
                            <div class="nav-links">
                                <?php  
                                    echo wp_kses_post(
                                        paginate_links(
                                            array(
                                                'base'    => str_replace( PHP_INT_MAX, '%#%', get_pagenum_link( PHP_INT_MAX, false ) ),
                                                'format'  => '?paged=%#%',
                                                'current' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
                                                'total'   => $query->max_num_pages,
                                            )
                                        )
                                    );
                                ?>
                            </div>
                        </nav>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="posts-archive-with-filter-content-not-found" id="<?php echo esc_attr( theme_block_id( $block ) ); ?>-posts-archive-with-filter-content-grid" tabindex="0">
                    <h3><?php esc_attr_e( 'Nothing found', 'bulk' ); ?></h3>
                    <p><?php esc_attr_e( 'No content matching your selection was found. Please try again.', 'bulk' ); ?></p>
                </div>
            <?php endif; ?>

            <?php
                $convenios = array(
                    'post_type'      => 'convenios',
                    'orderby'        => 'title',
                    'order'          => 'asc',
                    'posts_per_page' => -1,
                );

                $queryConvenios = new WP_Query( $convenios );
            ?>

            <?php if ( $queryConvenios->have_posts() && get_post_type() === 'convenios' ) : ?>
                <div class="posts-archive-with-filter-content-grid" id="<?php echo esc_attr( theme_block_id( $block ) ); ?>-posts-archive-with-filter-content-grid" tabindex="0">
                    <?php while ( $queryConvenios->have_posts() ) : ?>
                        <?php $queryConvenios->the_post(); ?>

                        <?php if ( get_the_title() ) : ?>
                            <article class="post-loop post-card">

                                <div class="posts-archive-with-filter-content-grid-inner">
                                    <!-- THUMBNAIL -->
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="posts-archive-with-filter-content-grid-inner-thumb">
                                            <?php $attachment_image = wp_get_attachment_url( get_post_thumbnail_id() ); ?>

                                            <div class="post-loop-image">
                                                <img src="<?php echo esc_url( $attachment_image ); ?>" />
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="posts-archive-with-filter-content-grid-inner-content">
                                        <h3><?php the_title(); ?></h3>
                                        <a href="<?php the_permalink(); ?>" class="read-more">
                                            <span class="primary-button"><?php esc_html_e( 'Mais informações', 'bulk' ); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>