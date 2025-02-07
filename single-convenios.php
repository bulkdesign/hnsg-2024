<?php get_header(); ?>

<section class="alignwide default-template">
    <div class="blocks-container">
        <header>
            <div class="breadcrumb">
                <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                    }
                ?>
            </div>
        </header>
					
        <?php 
            $current_post_id = get_the_ID();
            $args_convenios = array(
                'post_type'			=> 'convenios',
                'post__in'          => array( $current_post_id )
            );

            $convenios = new WP_Query($args_convenios);
        ?>
						
        <?php if ($convenios->have_posts()):
            
            while($convenios->have_posts()): $convenios->the_post(); ?>
                <div class="single-post-thumbnail">
                    <?php the_post_thumbnail( 'medium' ); ?>
                </div>
                
                <?php if (!has_post_thumbnail()) { ?>
                    <h3><?php the_title(); ?></h3>
                <?php } ?>

                <?php $coberturas = get_field('coberturas'); ?>
                <?php $obsConv = get_field('obs_conv'); ?>

                <?php if ( $coberturas ): ?>
                    <h4>Áreas de Atendimento:</h4>
                    <ul>
                        <?php foreach( $coberturas as $cobertura): ?>
                            <li>
                                <?php echo $cobertura->name; ?>
                            </li>
                        <?php endforeach; ?>

                        <?php if ($obsConv): ?>
                            <li>
                                <strong><?php echo $obsConv; ?></strong>
                            </li>
                        <?php endif ?>
                    </ul>
                <?php endif; ?>     
            <?php endwhile; ?>

        <?php endif; wp_reset_postdata(); ?>
		
    </div>
 </section>

<?php get_footer(); ?>