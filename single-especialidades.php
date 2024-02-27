<?php get_header(); ?>

<section class="alignwide default-template">
    <div class="blocks-container">
        <header>
            <div class="breadcrumb">
                <?php if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                } ?>
            </div>
        </header>

        <?php
        $current_post_id = get_the_ID();
        $args_especialidade = array(
            'post_type' => 'especialidades',
            'post__in'  => array($current_post_id)
        );

        $especialidade = new WP_Query($args_especialidade);
        ?>

        <?php if ($especialidade->have_posts()) : ?>

            <?php while ($especialidade->have_posts()) : $especialidade->the_post(); ?>

                <?php if (!has_post_thumbnail()) { ?>
                    <h3><?php the_title(); ?></h3>
                <?php } ?>

                <h4>Lista de especialistas:</h4>

                <?php
                $medicos = get_field('medicos', $current_post_id);
                $medicos_names = [];

                if (!empty($medicos)) {
                    foreach ($medicos as $post_id) {
                        $medico = get_post($post_id);
                        $medicos_names[] = $medico->post_title;
                    }
                }
                ?>

                <?php if (!empty($medicos_names)) : ?>
                    <ul>
                        <?php foreach ($medicos_names as $medico_name) {
                            echo '<li>' . $medico_name . "</li>";
                        } ?>
                    </ul>
                <?php endif; ?>

            <?php endwhile; ?>

        <?php endif; ?>
        <?php wp_reset_postdata(); ?>

    </div>
</section>

<?php get_footer(); ?>
