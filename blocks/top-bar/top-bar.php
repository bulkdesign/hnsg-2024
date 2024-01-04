<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'top-bar' ); ?> data-color-scheme="dark">
    <div class="top-bar-inner">
        <?php if( have_rows( 'content' ) ): ?>
        <ul class="top-bar-content">
            <?php while( have_rows( 'content' ) ) : ?>
                <?php the_row(); ?>
                <li>
                    <?php if( get_row_layout() === 'text' ): ?>
                        <?php the_sub_field( 'text' ); ?>
                    <?php elseif( get_row_layout() === 'link'): ?>
                        <?php $button = get_sub_field( 'link' ); ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>">
                            <?php echo wp_kses_post( $button['title'] ); ?>
                        </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>

                <?php if (get_field( 'waiting_time' )) : ?>
                    <li>
                        <?php 
                            $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
                            $jsondata = file_get_contents("http://www2.hnsg.org.br/app/api/papediatrico", false, $context);
                            $array = json_decode($jsondata);
                        ?>

                        <p>
                            PA Pediátrico é de
                            <strong>
                                <?php		 
                                    if($array[0]->HR != "00h") : 
                                        echo $array[0]->HR; 
                                    endif;
                                        echo $array[0]->MI; 
                                ?>	 	
                            </strong>
                            
                            | PA Adulto é de
                            
                            <strong>
                                <?php 
                                    if($array[0]->HR_ADULTO != "00h") : 
                                        echo $array[0]->HR_ADULTO; 
                                    endif;
                                        echo $array[0]->MI_ADULTO; 
                                ?> 	
                            </strong>
                        </p>
                    </li>
                <?php endif; ?>

            <?php endwhile; ?>
        </ul>
        <?php endif; ?>

        <?php $button = get_field( 'call_to_action' ); ?>
        <?php if ( ! empty( $button ) ) : ?>
        <a class="tertiary-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>"><?php echo wp_kses_post( $button['title'] ); ?></a>
        <?php endif; ?>
    </div>
</div>