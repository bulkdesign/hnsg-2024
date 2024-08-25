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

            <?php if (get_field('box_contato') == 'SIM'): ?>

                <div class="page-grid">
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                    <aside class="sidebar">
                        <nav>
                            <?php if (!empty(get_field('box_contato_titulo')) && strlen(get_field('box_contato_titulo')) > 2 ): ?>
                                <h3><?php the_field('box_contato_titulo'); ?></h3>
                            <?php else: ?>
                                <h3>Contato:</h3>
                            <?php endif; ?>
                            
                            <ul>
                                <?php if (!empty(get_field('box_contato_telefone')) && strlen(get_field('box_contato_telefone')) > 2 ): ?>
                                    <li class="telefone">
                                        <h5>Telefone:</h5>
                                        <?php the_field('box_contato_telefone'); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty(get_field('box_contato_email')) && strlen(get_field('box_contato_email')) > 2 ): ?>
                                    <li class="email">
                                        <h5>Email:</h5>
                                        <?php the_field('box_contato_email'); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty(get_field('box_contato_horafunc')) && strlen(get_field('box_contato_horafunc')) > 2 ): ?>
                                    <li class="horario-funcionamento"> 
                                        <h5>Horário de funcionamento:</h5>
                                        <?php the_field('box_contato_horafunc'); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty(get_field('box_contato_localizacao')) && strlen(get_field('box_contato_localizacao')) > 2 ): ?>
                                    <li class="localizacao">    
                                        <h5>Localização:</h5>
                                        <?php the_field('box_contato_localizacao'); ?>
                                    </li>
                                <?php endif; ?>
                            </ul>												
                        </nav>
                    </aside>
                </div>
                <?php else : ?>
                    <?php the_content(); ?>
            <?php endif; ?>
		<?php endwhile; ?>
	</div>
</main>

<?php

get_footer();
