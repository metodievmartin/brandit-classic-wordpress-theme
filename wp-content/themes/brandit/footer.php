<?php
// TODO: some validation and maybe default values
$contact_email_address = bci_get_contact_email();
$contact_address       = bci_get_contact_address();
$contact_phone_number  = bci_get_contact_phone_number();
?>

<footer class="main-footer-section">
    <div class="container-xxl">
        <div class="row justify-content-between pt-5 pb-5">
            <div class="footer-column col-lg-3 col-md-6">
                <div class="footer-item">
                    <h2 class="mb-4">
						<?php get_template_part( 'template-parts/header/logo' ); ?>
                    </h2>
                    <p class="lh-lg mb-4">
                        There cursus massa at urnaaculis estieSed aliquamellus vitae ultrs condmentum leo massamollis
                        its estiegittis miristum.
                    </p>

					<?php if ( is_active_sidebar( 'footer-social-icons' ) ) : ?>
                        <div class="footer-logo-widget-area">
							<?php dynamic_sidebar( 'footer-social-icons' ); ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
            <div class="footer-column col-xl-2 col-lg-2 col-md-6 mb-30">
                <h3 class="footer-section-heading"><?php esc_html_e( 'Services', 'brandit' ); ?></h3>

				<?php

				if ( has_nav_menu( 'footer-services-menu' ) ) {

					wp_nav_menu( array(
						'theme_location' => 'footer-services-menu',
						'walker'         => new WP_Bootstrap_Navwalker(),
						'menu_class'     => 'nav flex-column footer-menu',
						'container'      => false
					) );
				}

				?>

            </div>
            <div class="footer-column col-xl-2 col-lg-2 col-md-6 mb-30">
                <h3 class="footer-section-heading"><?php esc_html_e( 'Page Links', 'brandit' ); ?></h3>

				<?php

				if ( has_nav_menu( 'footer-page-links-menu' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer-page-links-menu',
						'walker'         => new WP_Bootstrap_Navwalker(),
						'menu_class'     => 'nav flex-column footer-menu',
						'container'      => false
					) );
				}

				?>

            </div>
            <div class="footer-column col-lg-3 col-md-6">
                <div class="footer-item">
                    <h3 class="footer-section-heading"><?php esc_html_e( 'Contac Us', 'brandit' ); ?></h3>
                    <div class="d-flex flex-column align-items-start">
                        <p><i class="fa fa-map-marker-alt me-2"></i> <?php echo esc_html( $contact_address ); ?></p>
                        <p><i class="fa fa-phone-alt me-2"></i> <?php echo esc_html( $contact_phone_number ); ?></p>
                        <p><i class="fas fa-envelope me-2"></i> <?php echo esc_html( $contact_email_address ); ?></p>
                        <p><i class="fa fa-clock me-2"></i> 26/7 Hours Service</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-area">
        <div class="container-xxl text-center">
            <p class="copyright-text">Copyright &copy; <?php echo date( "Y" ); ?> Brand It. All Rights Reserved</p>
        </div>
    </div>

	<?php get_template_part( 'template-parts/search/search-overlay' ) ?>

</footer>

<?php wp_footer(); ?>

</body>
</html>
