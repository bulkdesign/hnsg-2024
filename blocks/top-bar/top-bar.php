<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'top-bar' ); ?>>
    <div class="top-bar-inner">
        <?php if( get_field( 'waiting_time' ) ): ?>
        <ul class="top-bar-content">
            <?php
                function fetchData() {
                    $url = "http://www2.hnsg.org.br/app/api/papediatrico";
                    $host = parse_url($url, PHP_URL_HOST);
                    $port = parse_url($url, PHP_URL_PORT) ?: 80;
                    
                    // Check if the host is reachable
                    $connection = @fsockopen($host, $port, $errno, $errstr, 5);
                    if (!$connection) {
                        // Return error status and message
                        return array('status' => 'error', 'message' => "Cannot connect to $host: $errstr");
                    }
                    fclose($connection);
                    
                    // Create HTTP context with header
                    $context = stream_context_create(array('http' => array('header' => 'Connection: close\r\n')));
                    
                    // Attempt to fetch data
                    $jsondata = @file_get_contents($url, false, $context);
                    
                    // Decode JSON data
                    $array = json_decode($jsondata, true);
                    
                    // Return success status and data
                    return array('status' => 'success', 'data' => $array);
                }
            ?>

            <?php $result = fetchData();
                
            if ($result['status'] == 'success') : ?>
                <li>
                    <p>Tempo de Espera:</p>
                    <p>PA Pediátrico é de <strong><?php if($array[0]->HR != "00h") : echo $array[0]->HR; endif; echo $array[0]->MI; ?></strong> | PA Adulto é de <?php if($array[0]->HR_ADULTO != "00h") : echo $array[0]->HR_ADULTO; endif; echo $array[0]->MI_ADULTO; ?></p>
                </li>
                <?php else :
                    echo "Não foi possível conectar à API de espera."; ?>
            <?php endif; ?>

        </ul>
        <?php endif; ?>

        <?php if( have_rows( 'social_media' ) ): ?>
            <div class="top-bar-social-media">
                <?php if( get_field( 'social_media_title' ) ): ?>
                <h2><?php the_field( 'social_media_title' ); ?></h2>
                <?php endif; ?>

                <ul>
                    <?php while( have_rows( 'social_media' ) ): ?>
                    <?php the_row(); ?>
                    <li>
                        <?php 
                            $logo   = get_sub_field( 'icon' ); 
                            $button = get_sub_field( 'link' ); 
                        ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>" title="<?php echo esc_attr( $button['title'] ); ?>">
                            <?php if(!empty($logo)): ?>
                                <?php if( 'image/svg+xml' === $logo['mime_type'] ): ?>
                                    <?php 
                                        // phpcs:ignore
                                        echo file_get_contents( get_attached_file( $logo['ID'] ) );
                                    ?>
                                <?php else: ?>
                                    <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( $button['title'] ); ?>" loading="lazy">
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <span>
                                <?php echo wp_kses_post( $button['title'] ); ?>
                            </span>

                            <?php if ( '_blank' === theme_get_link_target( $button ) ) : ?>
                            <span class="sr-only">
                                <?php esc_attr_e( '(Opens in a new tab)', 'bulk'); ?>
                            </span>
                            <?php endif; ?>
                        </a>
                        <?php endif; ?>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>