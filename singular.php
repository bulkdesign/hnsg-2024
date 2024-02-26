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
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.5562 12.9062L16.1007 13.359C16.1007 13.359 15.0181 14.4355 12.0631 11.4972C9.10812 8.55901 10.1907 7.48257 10.1907 7.48257L10.4775 7.19738C11.1841 6.49484 11.2507 5.36691 10.6342 4.54348L9.37326 2.85908C8.61028 1.83992 7.13596 1.70529 6.26145 2.57483L4.69185 4.13552C4.25823 4.56668 3.96765 5.12559 4.00289 5.74561C4.09304 7.33182 4.81071 10.7447 8.81536 14.7266C13.0621 18.9492 17.0468 19.117 18.6763 18.9651C19.1917 18.9171 19.6399 18.6546 20.0011 18.2954L21.4217 16.883C22.3806 15.9295 22.1102 14.2949 20.8833 13.628L18.9728 12.5894C18.1672 12.1515 17.1858 12.2801 16.5562 12.9062Z" fill="#000000"></path> </g></svg>
                                        <p>Telefone:<br>
                                        <span><?php the_field('box_contato_telefone'); ?></span></p>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty(get_field('box_contato_email')) && strlen(get_field('box_contato_email')) > 2 ): ?>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" width="800px" height="800px" viewBox="0 -3.5 32 32" version="1.1"><desc>Created with Sketch Beta.</desc><defs> </defs><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"><g id="Icon-Set-Filled" sketch:type="MSLayerGroup" transform="translate(-414.000000, -261.000000)" fill="#000000"><path d="M430,275.916 L426.684,273.167 L415.115,285.01 L444.591,285.01 L433.235,273.147 L430,275.916 L430,275.916 Z M434.89,271.89 L445.892,283.329 C445.955,283.107 446,282.877 446,282.634 L446,262.862 L434.89,271.89 L434.89,271.89 Z M414,262.816 L414,282.634 C414,282.877 414.045,283.107 414.108,283.329 L425.147,271.927 L414,262.816 L414,262.816 Z M445,261 L415,261 L430,273.019 L445,261 L445,261 Z" id="mail" sketch:type="MSShapeGroup"> </path></g></g></svg>    
                                        <p>Email:<br>
                                        <span><?php the_field('box_contato_email'); ?></span></p>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty(get_field('box_contato_horafunc')) && strlen(get_field('box_contato_horafunc')) > 2 ): ?>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#000000"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 7.25C12.4142 7.25 12.75 7.58579 12.75 8V11.6893L15.0303 13.9697C15.3232 14.2626 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2626 15.3232 13.9697 15.0303L11.4697 12.5303C11.329 12.3897 11.25 12.1989 11.25 12V8C11.25 7.58579 11.5858 7.25 12 7.25Z" fill="white"></path> </g></svg>    
                                        <p>Horário de funcionamento:<br>
                                        <span><?php the_field('box_contato_horafunc'); ?></span></p>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty(get_field('box_contato_localizacao')) && strlen(get_field('box_contato_localizacao')) > 2 ): ?>
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3856 23.789L11.3831 23.7871L11.3769 23.7822L11.355 23.765C11.3362 23.7501 11.3091 23.7287 11.2742 23.7008C11.2046 23.6451 11.1039 23.5637 10.9767 23.4587C10.7224 23.2488 10.3615 22.944 9.92939 22.5599C9.06662 21.793 7.91329 20.7041 6.75671 19.419C5.60303 18.1371 4.42693 16.639 3.53467 15.0528C2.64762 13.4758 2 11.7393 2 10C2 7.34784 3.05357 4.8043 4.92893 2.92893C6.8043 1.05357 9.34784 0 12 0C14.6522 0 17.1957 1.05357 19.0711 2.92893C20.9464 4.8043 22 7.34784 22 10C22 11.7393 21.3524 13.4758 20.4653 15.0528C19.5731 16.639 18.397 18.1371 17.2433 19.419C16.0867 20.7041 14.9334 21.793 14.0706 22.5599C13.6385 22.944 13.2776 23.2488 13.0233 23.4587C12.8961 23.5637 12.7954 23.6451 12.7258 23.7008C12.6909 23.7287 12.6638 23.7501 12.645 23.765L12.6231 23.7822L12.6169 23.7871L12.615 23.7885C12.615 23.7885 12.6139 23.7894 12 23L12.6139 23.7894C12.2528 24.0702 11.7467 24.0699 11.3856 23.789ZM12 23L11.3856 23.789C11.3856 23.789 11.3861 23.7894 12 23ZM15 10C15 11.6569 13.6569 13 12 13C10.3431 13 9 11.6569 9 10C9 8.34315 10.3431 7 12 7C13.6569 7 15 8.34315 15 10Z" fill="#000000"></path> </g></svg>    
                                        <p>Localização:<br>
                                        <span><?php the_field('box_contato_localizacao'); ?></span></p>
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
