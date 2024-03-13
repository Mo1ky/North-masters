<!-- Подвал сайта -->
<footer class="footer">
            <div class="upper-footer">
                <div class="center">
                    <span class="site-title"><a href="http://severmasters29.ru.xsph.ru/"><?php echo carbon_get_theme_option( 'site-title' ); ?></a></span>
                    <div class="footer-login">
                        <ul class="footer-list">
                            <li class="footer-item"><a href="mailto:<?php echo carbon_get_theme_option( 'mail-footer' ); ?>" class="footer-link"><?php echo carbon_get_theme_option( 'mail-footer' ); ?></a></li>
                            <li class="footer-item"><a href="tel:<?php echo carbon_get_theme_option( 'phone-number-footer' ); ?>" class="footer-link"><?php echo carbon_get_theme_option( 'phone-number-footer' ); ?></a>
                            </li>
                        </ul>
                        <div class="user-block">
                            <a href="http://severmasters29.ru.xsph.ru/about/"><i class="fa fa-user" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

</div>

    <!-- Подключение скриптов -->

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/card.js" defer></script>
    
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/menu.js"></script>

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/mixitup.min.js"></script>
</body>

</html>