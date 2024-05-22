<?php
/**
 * Block: Footer One
 *
 * @package mm
 */

?>

<footer <?php theme_block_attributes( $block, 'footer-one alignfull' ); ?> data-color-scheme="<?php the_field( 'color_scheme' ); ?>">
    <div class="footer-one-main">
        <?php $logo = get_field( 'logo' ); ?>
        <?php if (!empty($logo)): ?>
            <div class="footer-one-column">
                <a href="<?php echo esc_url( get_home_url() ); ?>" class="logo" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <?php if(!empty($logo)): ?>
                        <?php if( 'image/svg+xml' === $logo['mime_type'] ): ?>
                            <?php 
                                // phpcs:ignore
                                echo file_get_contents( get_attached_file( $logo['ID'] ) );
                            ?>
                        <?php else: ?>
                            <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        <?php endif; ?>
                    <?php endif; ?>
                </a>

                <?php the_field( 'text_content' ); ?>
            </div>
        <?php endif; ?>

        <div class="footer-one-column-container">
            <?php if( have_rows( 'menus' ) ): ?>
                <?php while( have_rows( 'menus' ) ): ?>
                    <?php the_row(); ?>

                    <div class="footer-one-column">
                        <?php if( get_sub_field( 'title' ) ): ?>
                        <h2><?php the_sub_field( 'title' ); ?></h2>
                        <?php endif; ?>
                        <?php
                            $menu = wp_get_nav_menu_object( get_sub_field( 'menu' ) );
                            if ( ! is_wp_error( $menu ) ) {
                                $menu_name = $menu->name;
                            }else{
                                $menu_name = '';
                            }

                            wp_nav_menu(
                                array(
                                    'menu' => get_sub_field( 'menu' ),
                                    'depth' => 1,
                                    'container' => 'nav',
                                    'container_aria_label' => $menu_name,
                                )
                            );
                        ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php if( have_rows( 'social_media_links' ) ): ?>
            <div class="footer-one-column footer-one-social-media">
                <?php if( get_field( 'social_media_title' ) ): ?>
                <h2><?php the_field( 'social_media_title' ); ?></h2>
                <?php endif; ?>

                <ul>
                    <?php while( have_rows( 'social_media_links' ) ): ?>
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
    <div class="footer-one-copyright">
        <?php if ( get_field( 'copyright_text' ) ): ?>
            <p><?php echo get_field( 'copyright_text' ); ?></p>
        <?php endif; ?>
        
        <?php if( get_field( 'copyright' ) ): ?>
            <p><?php echo get_bloginfo(); ?> &copy; <?php echo esc_attr( date( 'Y' ) ); ?> <?php the_field( 'copyright' ); ?></p>
        <?php endif; ?>
    </div>

    <?php if ( get_field( 'enable_footer_chatbot' ) ): ?>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link id="gs-css" type="text/css" rel="stylesheet" href="https://acc-softapi.softmarketing.com.br/hnsg/static/css/export.css">
        <link rel="stylesheet" href="https://acc-softapi.softmarketing.com.br/hnsg/static/vendor/fontawesome/css/all.min.css">
        <script type="text/javascript" src="https://acc-softapi.softmarketing.com.br/hnsg/static/js/InnerFormValidation.js"></script>
        <div id="supportchatwidget" class="chatsoftinova" style="display: block;">
        <div id="widget-close" class="chatsoftinova tc-widget widget-fadeIn hidewidget widget-fadeOut">
            <div class="chatsoftinova agent-face" title="">
            <div class="half">
                <img id="agent1" class="chatsoftinova agent circle" src="https://acc-softapi.softmarketing.com.br/hnsg/static/images/softinova_icon.png" alt="Avatar ">
            </div>
            </div>
            <span class="chatsoftinova right" onclick="toggleWidget(false)"> ___ </span>
            <span class="chatsoftinova chat-title">
            <p id="assistant-name"></p>
            <p id="company-name"></p>
            </span>
        </div>
        <div id="widget-open" class="chatsoftinova tc-widget widget-type circular-widget" onclick="toggleWidget(true)" style="display: block;">
            <img id="agent2" class="chatsoftinova agent circle" src="https://acc-softapi.softmarketing.com.br/hnsg/static/images/loading.gif" alt="Avatar ">
        </div>
        <a id="speech-bubble-link" href="javascript:void(0)">
            <div id="bubble_initial" class="chatsoftinova speech-bubble" style="display: block;">
            <span id="infochat_close_message" class="chatsoftinova close-message" onclick="closemessage()">x</span>
            <p id="msg_initial" onclick="toggleWidget(true)"></p>
            <div id="bubble_bottom" class="chatsoftinova speech-bubble-bottom" onclick="toggleWidget(true)"></div>
            </div>
        </a>
        </div>
        <div id="widget" class="chatsoftinova tc-widget widget-content widget-fadeIn hidewidget widget-fadeOut" style="display: none;">
        <div class="chatsoftinova widget-wrapper">
            <div class="chatsoftinova content-wrapper hide" id="div-message">
            <div class="chatsoftinova conversation-container">
                <!-- mCustomScrollbar _mCS_1-->
                <div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0">
                <div id="mCSB_1_container" class="mCSB_container"" dir=" ltr"></div>
                </div>
            </div>
            <div class="chatsoftinova footer-wrap">
                <form id="post-message-form" class="chatsoftinova" style="display: block;">
                <div class="chatsoftinova alerts"></div>
                <div class="chatsoftinova footer create-newmessage" id="footer">
                    <div class="chatsoftinova input-group input-types">
                    <input type="text" class="chatsoftinova form-control post-message" placeholder="Escreva aqui" id="post-message" autocomplete="off">
                    <div class="chatsoftinova input-group-addon">
                        <button type="button" class="chatsoftinova ic_attach cursor" id="attach_file" onclick="$('#image_upload').click();">
                        <i class="chatsoftinova fas fa-upload"></i>
                        </button>
                        <button type="button" id="widgetSendButton" class="chatsoftinova ic_send">
                        <i class="chatsoftinova fa fa-paper-plane"></i>
                        </button>
                    </div>
                    </div>
                    <div class="chatsoftinova powered-by" id="poweredByCompany"></div>
                </div>
                </form>
                <form id="reinicia_form" class="chatsoftinova" style="display: none;">
                <div class="chatsoftinova footer create-newmessage" id="footer">
                    <span style="padding: 10px 10px 10px 25px;font-size:inherit;">Sessão Finalizada</span>
                    <a id="btnreinicia" class="chatsoftinova btn option-btn btn-qr hover-white" onclick="ReiniciaForm()">Reiniciar Chat</a>
                </div>
                </form>
            </div>
            </div>
            <input type="file" class="chatsoftinova" id="image_upload" onchange="UploadFile()" name="upload" style="display: none;">
            <input type="hidden" id="mensagem" name="mensagem" />
            <input type="hidden" id="dados" style="display: none;">
            <div class="chatsoftinova content-wrapper" id="div-form" style="overflow: auto">
            <h4 id="titulo_form" style="display:none;padding-left:10px"></h4>
            <form id="post-form" style="display: block;padding: 10px;" action="javascript:void(0)" class="chatsoftinova validate"></form>
            </div>
        </div>
        </div>
        <input id="http_id" name="http_id" type="hidden" value="https://acc-softapi.softmarketing.com.br/hnsg" />
        <input id="http_ia" name="http_ia" type="hidden" value="https://acc-ia.softmarketing.com.br" />
        <input type="hidden" id="chat_id" name="chat_id" value="" />
        <input id="http_id_integra" name="http_id_integra" type="hidden" value="https://acc-integra.softmarketing.com.br/hnsg" />
        <script>
        function closemessage() {
            document.getElementById("bubble_initial").style.display = "none";
        }

        function toggleWidget(tipo) {
            if (tipo) {
            document.getElementById("widget-close").classList.remove("hidewidget");
            document.getElementById("widget-close").classList.remove("widget-fadeOut");
            document.getElementById("widget-close").style.display = "block";
            document.getElementById("widget").classList.remove("hidewidget");
            document.getElementById("widget").classList.remove("widget-fadeOut");
            document.getElementById("widget").style.display = "block";
            document.getElementById("widget-open").style.display = "none";
            document.getElementById("speech-bubble-link").style.display = "none";
            if (iniciaAtendimento == false) {
                chat_id = $("#chat_id").val();
                FormInput(chat_id);
                ReiniciaButton();
                iniciaAtendimento = true;
            }
            } else {
            document.getElementById("widget-close").classList.add("hidewidget");
            document.getElementById("widget-close").classList.add("widget-fadeOut");
            document.getElementById("widget-close").style.display = "none";
            document.getElementById("widget").classList.add("hidewidget");
            document.getElementById("widget").classList.add("widget-fadeOut");
            document.getElementById("widget").style.display = "none";
            document.getElementById("widget-open").style.display = "block";
            document.getElementById("speech-bubble-link").style.display = "block";
            }
        }
        </script>
        <script type="text/javascript" src="https://acc-softapi.softmarketing.com.br/hnsg/static/js/main.js"></script>
    <?php endif; ?>
</footer>