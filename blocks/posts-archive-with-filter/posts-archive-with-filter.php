<?php
/**
 * Block: Doc Search with Filter
 *
 * @package mm
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

if ( is_search() || empty( $filters ) || ! empty( $filters['s'] ) ) {
    $post_types = get_field( 'post_types' ) ? get_field( 'post_types' ) : apply_filters( 'posts_archive_with_filter_post_types', array( 'post', 'page' ) );
} else {
    $post_types = get_field( 'post_types' ) ? get_field( 'post_types' ) : apply_filters( 'posts_archive_with_filter_post_types', array( 'post', 'page' ) );
}

?>

<section <?php theme_block_attributes( $block, 'posts-archive-with-filter alignwide' ); ?>>

    <?php if ( ! get_post_type() === 'convenios' ) : ?>
        <div class="posts-archive-with-filter-inner">
            <div class="posts-archive-with-filter-content">
                <form class="posts-archive-with-filter-filters">
                    <?php if ( ! get_field( 'hide_title' ) ) : ?>
                        <h1>
                            <?php if( get_field( 'title' ) ) {
                                the_field( 'title' );
                            } ?>
                        </h1>
                    <?php endif; ?>

                    <div class="posts-archive-with-filter-filters-search">
                        <button type="submit" aria-label="<?php echo esc_attr( 'Digite aqui o nome de um(a) médico(a) ou utilize o filtro para buscar pelas especialidades', 'bulk' ); ?>">
                            <?php theme_block_asset( 'img/search.svg' ); ?>
                        </button>
                        <input type="text" value="<?php echo get_search_query(); ?>" name="filter_block[s]" id="s" placeholder="<?php echo esc_attr( 'Digite aqui o nome de um(a) médico(a) ou utilize o filtro para buscar pelas especialidades', 'bulk' ); ?>" />
                        <div class="posts-archive-with-filter-filters-submit">
                            <button type="submit" class="primary-button">
                                <?php esc_attr_e( 'Apply', 'bulk' ); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div class="posts-archive-with-filter-content-wrapper">

        <div class="posts-archive-with-filter-content-inner">
            <?php
                $args = array(
                    'post_type'      => $post_types,
                    'paged'          => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
                    'orderby'        => 'title',
                    'order'          => 'asc',
                    // phpcs:ignore
                    'posts_per_page' => get_field( 'posts_per_page' ) ? get_field( 'posts_per_page' ) : 12,
                    // phpcs:ignore
                    'tax_query'      => array(),
                    'ignore_sticky_posts' => 0,
                );

                if ( get_search_query() ) {
                    $args['s'] = get_search_query();
                    $args['orderby'] = 'relevance';
                }

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
            ?>

            <?php
                $convenios = array(
                    'post_type'      => 'convenios',
                    'orderby'        => 'title',
                    'order'          => 'asc',
                    'posts_per_page' => -1,
                );

                $queryConvenios = new WP_Query( $convenios );
            ?>

            <?php if ( ! get_post_type() === 'convenios' || ! is_archive() ) : ?>
                <?php if ( $query->have_posts() ) : ?>
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
                                                'end_size' => 0,
                                                'mid_size' => 6,
                                            )
                                        )
                                    );
                                ?>
                            </div>
                        </nav>
                        <?php endif; ?>
                    </div>
                    
                <?php else : ?>
                    <div class="posts-archive-with-filter-content-not-found" id="<?php echo esc_attr( theme_block_id( $block ) ); ?>-posts-archive-with-filter-content-grid" tabindex="0">
                        <h3><?php esc_attr_e( 'Nothing found', 'bulk' ); ?></h3>
                        <p><?php esc_attr_e( 'No content matching your selection was found. Please try again.', 'bulk' ); ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ( ! is_search() ) : ?>
                <?php if ( $queryConvenios->have_posts() ) : ?>
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
                <?php else : ?>
                <div class="posts-archive-with-filter-content-not-found" id="<?php echo esc_attr( theme_block_id( $block ) ); ?>-posts-archive-with-filter-content-grid" tabindex="0">
                    <h3><?php esc_attr_e( 'Nothing found', 'bulk' ); ?></h3>
                    <p><?php esc_attr_e( 'No content matching your selection was found. Please try again.', 'bulk' ); ?></p>
                </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>

</section>