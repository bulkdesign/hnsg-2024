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
    $post_types = get_field( 'post_types' ) ? get_field( 'post_types' ) : apply_filters( 'doc_search_with_filter_post_types', array( 'medico' ) );
} else {
    $post_types = get_field( 'post_types' ) ? get_field( 'post_types' ) : apply_filters( 'doc_search_with_filter_post_types', array( 'medico' ) );
}

?>

<section <?php theme_block_attributes( $block, 'doc-search-with-filter alignwide' ); ?>>
    <div class="doc-search-with-filter-inner">
        <div class="doc-search-with-filter-content">
            <form class="doc-search-with-filter-filters">
                <?php if ( ! get_field( 'hide_title' ) ) : ?>
                    <h1>
                        <?php if( get_field( 'title' ) ) {
                            the_field( 'title' );
                        } ?>
                    </h1>
                <?php endif; ?>

                <div class="doc-search-with-filter-filters-search">
                    <button type="submit" aria-label="<?php echo esc_attr( 'Digite aqui o nome de um(a) médico(a) ou utilize o filtro para buscar pelas especialidades', 'bulk' ); ?>">
                        <?php theme_block_asset( 'img/search.svg' ); ?>
                    </button>
                    <input type="text" value="<?php echo get_search_query(); ?>" name="filter_block[s]" id="s" placeholder="<?php echo esc_attr( 'Digite aqui o nome de um(a) médico(a) ou utilize o filtro para buscar pelas especialidades', 'bulk' ); ?>" />
                    <div class="doc-search-with-filter-filters-submit">
                        <button type="submit" class="primary-button">
                            <?php esc_attr_e( 'Apply', 'bulk' ); ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="doc-search-with-filter-content-wrapper">

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
        
        <?php if ( ! empty( $filter_taxonomies ) ) : ?>
            <form class="doc-search-with-filter-filters">
                <div>
                    <div class="sr-only">
                        <h2><?php esc_attr_e('Filters', 'bulk'); ?></h2>
                        <p><?php esc_attr_e('Changing any of the form inputs will cause the content to refresh with the filtered results.'); ?></p>
                    </div>
                    <a href="#<?php echo esc_attr( theme_block_id( $block ) ); ?>-doc-search-with-filter-content-grid" class="sr-only ignore skip-filters"><?php esc_html_e( 'Skip filters', 'bulk' ); ?></a>
                </div>
                <input type="hidden" name="paged" value="1">

                <?php if (is_array($filter_taxonomies)) : ?>
                    <?php foreach( $filter_taxonomies as $filter_taxonomy ): ?>
                        <?php
                            $taxonomy_details = get_taxonomy( $filter_taxonomy );

                            if ( ! is_wp_error( $taxonomy_details ) ) {
                                $taxonomies_to_display = get_terms( array(
                                    'taxonomy' => $filter_taxonomy,
                                ) );
                            }else{
                                $taxonomies_to_display = array();
                            }
                        ?>

                        <?php if( ! empty( $taxonomies_to_display ) ): ?>
                        <div class="doc-search-with-filter-filters-group" data-taxonomy="<?php echo $filter_taxonomy; ?>">
                            <div class="doc-search-with-filter-filters-group-heading">
                                <button type="button" class="doc-search-with-filter-filters-group-clear" title="<?php printf(esc_attr__( 'Clear All %s', 'bulk' ), $taxonomy_details->label); ?>" aria-label="<?php printf(esc_attr__( 'Clear All %s', 'bulk' ), $taxonomy_details->label); ?>" tabindex="-1" aria-hidden disabled></button>
                                <button type="button" class="doc-search-with-filter-filters-group-title" aria-expanded="false" aria-haspopup="listbox" role="combobox">
                                    <h3><?php echo $taxonomy_details->label; ?></h3>
                                </button>
                            </div>
                            <div class="doc-search-with-filter-filters-group-options" aria-label="<?php echo $taxonomy_details->label; ?>">
                                <?php
                                    if ( ! $uses_custom_query ) {
                                        $selected_taxonomies = get_query_var( $taxonomy_details->query_var );
                                    }else{
                                        if( ! empty( $filters['taxonomy'][$taxonomy_details->name] ) ){
                                            $selected_taxonomies = $filters['taxonomy'][$taxonomy_details->name];
                                        }
                                    }
                                    if( ! empty($selected_taxonomies) && ! is_array($selected_taxonomies) ){
                                        $selected_taxonomies = explode(',', get_query_var( $taxonomy_details->query_var ));
                                    }
                                    if( empty( $selected_taxonomies ) ){
                                        $selected_taxonomies = array();
                                    }
                                ?>
                                <?php foreach( $taxonomies_to_display as $current_taxonomy ) : ?>
                                <div class="doc-search-with-filter-filters-group-options-item">
                                    <?php
                                        $field_id = $current_taxonomy->taxonomy . '_' . $current_taxonomy->term_id;
                                        $field_name = 'filter_block[taxonomy][' . $taxonomy_details->name . '][]';
                                    ?>
                                    <input type="checkbox" name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $current_taxonomy->slug; ?>" <?php echo in_array( $current_taxonomy->slug, $selected_taxonomies, false ) ? 'checked' : ''; ?>>
                                    <label for="<?php echo $field_id; ?>">
                                        <?php echo $current_taxonomy->name; ?>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="doc-search-with-filter-filters-submit">
                    <button type="submit" class="primary-button">
                        <?php esc_attr_e( 'Apply', 'bulk' ); ?>
                    </button>
                </div>
            </form>
        <?php endif; ?>

		<div class="doc-search-with-filter-content-loading">
			<?php theme_block_asset( 'img/loading.svg' ); ?>
		</div>
        <div class="doc-search-with-filter-content-inner">
            <?php
                $args = array(
                    'post_type'      => $post_types,
                    'paged'          => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
                    'orderby'        => 'title',
                    'order'          => 'asc',
                    // phpcs:ignore
                    'posts_per_page' => get_field( 'posts_per_page' ) ? get_field( 'posts_per_page' ) : get_option( 'posts_per_page' ),
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

            <?php if ( $query->have_posts() ) : ?>
                <div class="doc-search-with-filter-content-grid" id="<?php echo esc_attr( theme_block_id( $block ) ); ?>-doc-search-with-filter-content-grid" tabindex="0">
                    <?php while ( $query->have_posts() ) : ?>
                        <?php $query->the_post(); ?>

                        <article class="post-loop doc-card">

                            <div class="doc-search-with-filter-content-grid-inner">
                                <!-- THUMBNAIL -->
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="doc-search-with-filter-content-grid-inner-thumb">
                                        <?php $attachment_image = wp_get_attachment_url( get_post_thumbnail_id() ); ?>

                                        <div class="post-loop-image">
                                            <img src="<?php echo esc_url( $attachment_image ); ?>" />
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="doc-search-with-filter-content-grid-inner-content">
                                    <h3><?php the_title(); ?></h3>

                                    <!-- CRM -->
                                    <?php $crm = get_field( 'crm', get_the_ID() ); ?>
                                    <?php if ( ! empty( $crm ) ) : ?>
                                        <p>CRM: <?php echo $crm; ?></p>
                                    <?php endif; ?>

                                    <!-- ESPECIALIDADE -->
                                    <?php $especialidades = get_the_terms( get_the_ID(), 'especialidade' ); ?>
                                    <?php if (! empty( $especialidades ) ): ?>
                                        <h4>Especialidade</h4>
                                        <?php if ( ! empty( $especialidades ) ) : ?>
                                            <?php foreach ( $especialidades as $especialidade ) : ?>
                                                <?php echo $especialidade->name; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <!-- CONSULTORIO NO HOSPITAL -->
                                    <div class="doc-search-with-filter-content-office">
                                        <p>Consultório no Hospital: <strong><?php the_field( 'atende_no_hospital', get_the_ID() ); ?></strong></p>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        <span class="primary-button"><?php esc_html_e( 'Mais informações', 'bulk' ); ?></span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="doc-search-with-filter-content-pagination">
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
            <div class="doc-search-with-filter-content-not-found" id="<?php echo esc_attr( theme_block_id( $block ) ); ?>-doc-search-with-filter-content-grid" tabindex="0">
                <h3><?php esc_attr_e( 'Nothing found', 'bulk' ); ?></h3>
                <p><?php esc_attr_e( 'No content matching your selection was found. Please try again.', 'bulk' ); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

</section>