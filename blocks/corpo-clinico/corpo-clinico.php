<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'corpo-clinico' ); ?>>

    <?php if ( ! empty( get_field('title') ) ): ?>
        <h1><?php echo get_field('title'); ?></h1>
    <?php endif; ?>

    <?php if ( ! empty( get_field('subtitle') ) ): ?>
        <p><?php echo get_field('subtitle'); ?></p>
    <?php endif; ?>

    <div class="news">
			<div class="col-md-4">
				<div class="pesquisa-medicos">
					<div class="caixa">
						<h3 style="margin-bottom: 10px;">Pesquisar por médico</h3>
						<form action="/corpo-clinico/">
							<input style="margin-bottom: 10px !important;" class="form-control" placeholder="Digite o nome do médico" name="nome_medico" value="<?php echo isset($_GET['nome_medico']) ? $_GET['nome_medico'] : ''; ?>">
						<button type="submit" class="botao medio" style="width: 100%; display: block; text-align: center; cursor: pointer; background-color: #813da0; border: 0;">Pesquisar</button>
						</form>
					</div>

					<div class="caixa">
						<h3 style="margin-bottom: 10px;" >Pesquisar por especialidade</h3>
						<select style="margin-bottom: 10px !important;" name="especialidade_id" value="<?php echo isset($_GET['especialidade_id']) ? $_GET['especialidade_id'] : ''; ?>" onchange="location.href='/corpo-clinico/?especialidade_id=' + this.value">
							<option value="">-- Selecione a especialidade --</option>
							<?php 
								$args_especialidades = array(
									'post_type'			=> 'especialidades',
									'posts_per_page'	=> -1,
									'orderby'			=> 'title',
									'order'				=> 'ASC'
								);

								$especialidades = new WP_Query($args_especialidades);

								while($especialidades->have_posts()): $especialidades->the_post(); 
									$selected = "";

									if ($especialidades->post->ID == $_GET['especialidade_id']) {
										$selected = 'selected="selected"';
									}
							?>
								<option value="<?php echo $especialidades->post->ID; ?>" <?php echo $selected; ?>><?php echo $especialidades->post->post_title; ?></option>
							<?php endwhile; ?>
							<?php wp_reset_query(); ?>
						</select>
					</div>  
				</div>
			</div>
			<div class="col-md-8 tab-content">		
				<div role="tabpanel" class="tab-pane active" id="todos" >
					<?php 
						$paged = get_query_var('paged') ? get_query_var('paged') : 1;
						$args_medicos = array(
							'post_type'			=> 'medico',
							'posts_per_page'	=> 10,
							'orderby'			=> 'title',
							'order'				=> 'ASC',
							'paged'             => $paged
						);

						if (isset($_GET['especialidade_id'])) {
							$especialidadeId = $_GET['especialidade_id'];
							$args_medicos += ['meta_query' => [[
								'key' => 'especilidade_medica',
								'value' => '"' . $especialidadeId . '"',
								'compare' => 'LIKE'
							]]];
						}

						if (isset($_GET['nome_medico'])) {
							$nomeMedico = $_GET['nome_medico'];
							$args_medicos += ['s' => $nomeMedico];
						}


						$medicos = new WP_Query($args_medicos);
					?>
					<?php if (!$medicos->have_posts()) { ?>
                        <h1>Ops. Não encontrou o que procura?</h1>
                        <hr>
                        <p>Não encontramos nenhum resultado para a sua pesquisa.</p>
					<?php } ?>

					<ul class="listagem list tab-content">
						<li class="col-md-12 medico">	
                            <div class="caixa" style="padding: 30px;">
                                <h2 class="nome-do-medico"><?php the_title(); ?></h2>
                                <div class="foto">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </div>
                                <span class="crm">CRM: <?php the_field('crm'); ?></span>

                                <div class="especialidade">
                                    <?php 
                                        // $especialidades = get_field('especilidade_medica', $post_id); 
                                        // $especialidade_names = [];
                                    
                                        // foreach ($especialidades as $post_id) {
                                        //     $especialidade = get_post($post_id);
                                        //     $especialidade_names[] = "<a>{$especialidade->post_title}</a>";
                                        // }

                                        // echo implode(' | ', $especialidade_names);
                                    ?>
                                </div>
                                <div class="btn_veja">
                                    <a href="<?php the_permalink(); ?>" class="botao medio doctor-more-info">Veja mais informações</a>
                                </div>
                            </div>
                        </li>

                        <div id="modal-docker-info" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    
                                </div>
                                
                            </div>
                        </div>

						<div class="clearfix"></div>

					</ul>
				</div>
			</div>
		</div>

</section>