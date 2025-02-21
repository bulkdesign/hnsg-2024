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
            $args_medico = array(
                'post_type'			=> 'medico',
                'post__in'          => array( $current_post_id )
            );

            $medico = new WP_Query($args_medico);
        ?>
						
        <?php if ($medico->have_posts()):
            
            while($medico->have_posts()): $medico->the_post(); ?>
                
                <?php if (!has_post_thumbnail()) { ?>
                    <h3><?php the_title(); ?></h3>
                <?php } ?>

                <h4>Informações:</h4>

                <?php 
                    $locais = get_field('locais_atendimento');

                    if (! empty( $locais ) ) {
                        $locais_names = [];

                        foreach ($locais as $post_id) {
                            $local = get_post($post_id);
                            $locais_names[] = $local->post_title;
                        }
                    }
                ?>

                <?php 
                    $outrasfuncoes = get_field('outras_funcoes'); 
                    
                    if (! empty( $outrasfuncoes ) ) {
                    
                        $funcoes_names = [];

                        foreach ($outrasfuncoes as $post_id) {
                            $funcao = get_post($post_id);
                            $funcoes_names[] = $funcao->post_title;
                        }
                    }
                ?>

                <ul>
                    <?php if (! empty( get_field( 'crm' ) ) ): ?>
                        <li><strong>CRM:</strong> <?php the_field('crm'); ?></li>
                    <?php endif; ?>

                    <?php $especialidades = get_the_terms( get_the_ID(), 'especialidade' ); ?>
                    <?php if (! empty( $especialidades ) ): ?>
					    <strong>Especialidade(s) Médica:</strong>
                        <?php if ( ! empty( $especialidades ) ) : ?>
                            <ul>
                                <?php foreach ( $especialidades as $especialidade ) : ?>
                                    <li>– <?php echo $especialidade->name; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (! empty( get_field( 'atende_no_hospital' ) ) ): ?>
                        <li><strong>Tem Consultório no Hospital?</strong> <?php the_field('atende_no_hospital'); ?>
                    <?php endif; ?>

                    <?php if (! empty( get_field( 'obs_medico' ) ) ): ?>
                        <li><strong>Observações:</strong> <?php the_field('obs_medico'); ?></li>
                    <?php endif; ?>

                    <?php if (! empty( get_field( 'locais_atendimento' ) ) ): ?>
					    <li><strong>Locais de Atendimento:</strong><br>
                            <?php
                                foreach ($locais_names as $local_name) {
                                    echo '– ' . $local_name . "<br>";
                                }
                            ?>
                        </li>
                    <?php endif; ?>

                    <?php if (! empty( get_field( 'outras_funcoes' ) ) ): ?>
					    <li><strong>Outras Funções:</strong><br>
                            <?php
                                foreach ($funcoes_names as $funcao_name) {
                                    echo '– ' . $funcao_name . "<br>";
                                }
                            ?>
                        </li>
                    <?php endif; ?>

                    <?php if (! empty( get_field( 'telefone_agendamento' ) ) ): ?>
                        <li><strong>Telefone de Agendamento:</strong> <?php the_field('telefone_agendamento'); ?></li>
                    <?php endif; ?>

                    <?php if (! empty( get_field( 'telefone_exame' ) ) ): ?>
                        <li><strong>Telefone do Exame:</strong> <?php the_field('telefone_exame'); ?></li>
                    <?php endif; ?>

                </ul>
                        
            <?php endwhile; ?>

        <?php endif; wp_reset_postdata(); ?>
		
    </div>
 </section>

<?php get_footer(); ?>