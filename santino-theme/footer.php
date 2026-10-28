<?php
/**
 * The footer for Santino Theme
 *
 * @package Santino
 */
?>

<footer class="site-footer">
    <div class="container">
      <div class="row g-4 justify-content-between">
        
        <!-- Column 1: Brand & Logo -->
        <div class="col-lg-3 col-md-6 footer-brand-col">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo-wrap d-inline-block mb-3">
          <?php
          $footer_logo = get_theme_mod( 'santino_footer_logo' );
          if ( ! $footer_logo ) {
              $custom_logo_id = get_theme_mod( 'custom_logo' );
              $footer_logo = $custom_logo_id ? wp_get_attachment_image_url( $custom_logo_id, 'full' ) : '';
          }
          if ( ! $footer_logo && file_exists( SANTINO_DIR . '/assets/images/Logo-Santino-Coffee-white.png' ) ) {
              $footer_logo = SANTINO_URI . '/assets/images/Logo-Santino-Coffee-white.png';
          }
          if ( $footer_logo ) : ?>
            <img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height: 48px; width: auto; object-fit: contain; background: transparent; padding: 0; box-shadow: none;">
          <?php else : ?>
            <span class="fs-4 fw-bold font-heading text-white">Santino<span style="color: #c5a059;">.</span></span>
          <?php endif; ?>
          </a>
          <div class="mb-3">
            <span class="footer-cert-badge">
              <i class="bi bi-patch-check-fill text-warning me-1"></i> FSSC22000 &bull; RAINFOREST ALLIANCE
            </span>
          </div>
          <p class="footer-brand-desc mb-3">
            Official distributor of Victoria Arduino &amp; Nuova Simonelli in Bangladesh. Providing turnkey commercial machinery, artisan roasting, and 24/7 technical care.
          </p>
          <div class="footer-contact-item mb-2 text-white-50 small">
            <i class="bi bi-geo-alt-fill text-warning me-2"></i>
            <span class="text-white">1/3 Asad Avenue, Mohammadpur, Dhaka 1207</span>
          </div>
          <div class="footer-contact-item mb-2 text-white-50 small">
            <i class="bi bi-telephone-fill text-warning me-2"></i>
            <span class="text-white">Sales &amp; Service: <a href="tel:+8801613334514" class="text-white fw-bold text-decoration-none">+880 1613-334514</a></span>
          </div>
          <div class="footer-contact-item mb-2 text-white-50 small">
            <i class="bi bi-mortarboard-fill text-warning me-2"></i>
            <span class="text-white">Training: <a href="tel:+8801606291393" class="text-white fw-bold text-decoration-none">+880 1606-291393</a></span>
          </div>
          <div class="footer-contact-item text-white-50 small">
            <i class="bi bi-envelope-fill text-warning me-2"></i>
            <a href="mailto:sales@santino.com.bd" class="text-white fw-bold text-decoration-none">sales@santino.com.bd</a>
          </div>
        </div>

        <!-- Column 2: Quick Links (Dynamic WP Menu) -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-col-title">Quick Links</h5>
          <?php
          wp_nav_menu( array(
              'theme_location' => 'footer_quick',
              'container'      => false,
              'menu_class'     => 'footer-menu-list',
              'walker'         => new Santino_Footer_Nav_Walker(),
              'fallback_cb'    => 'santino_footer_quick_fallback',
          ) );
          ?>
        </div>

        <!-- Column 3: Customer Care (Dynamic WP Menu) -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-col-title">Customer Care</h5>
          <?php
          wp_nav_menu( array(
              'theme_location' => 'footer_care',
              'container'      => false,
              'menu_class'     => 'footer-menu-list',
              'walker'         => new Santino_Footer_Nav_Walker(),
              'fallback_cb'    => 'santino_footer_care_fallback',
          ) );
          ?>
        </div>

        <!-- Column 4: Follow Us -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-col-title">Follow Us</h5>
          <div class="footer-social-row">
            <a href="https://facebook.com" target="_blank" class="footer-social-link" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://instagram.com" target="_blank" class="footer-social-link" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://youtube.com" target="_blank" class="footer-social-link" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
            <a href="https://tiktok.com" target="_blank" class="footer-social-link" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
          </div>
        </div>

        <!-- Column 5: Download Our App -->
        <div class="col-lg-3 col-md-6 col-6">
          <h5 class="footer-col-title">Download Our App</h5>
          <div class="footer-app-badges">
            <a href="https://play.google.com" target="_blank" class="footer-app-btn">
              <i class="bi bi-google-play"></i>
              <div>
                <span class="btn-text-small">GET IT ON</span>
                <span class="btn-text-big">Google Play</span>
              </div>
            </a>
            <a href="https://apple.com/app-store" target="_blank" class="footer-app-btn">
              <i class="bi bi-apple"></i>
              <div>
                <span class="btn-text-small">DOWNLOAD ON THE</span>
                <span class="btn-text-big">App Store</span>
              </div>
            </a>
          </div>
        </div>

      </div>

      <!-- Bottom Sub-Footer Bar -->
      <div class="footer-divider d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="footer-copyright">
          &copy; 2026 Santino Caffè Bangladesh. All rights reserved.
        </div>
        <div class="footer-brand-motto">
          Good Coffee &bull; Better Days <i class="bi bi-cup-hot-fill ms-1 text-warning"></i>
        </div>
      </div>
    </div>
  </footer>

  <!-- MOBILE NATIVE APP BOTTOM NAVIGATION DOCK -->
  <nav class="mobile-app-dock d-flex d-lg-none" aria-label="Mobile Navigation">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="app-dock-item <?php echo is_front_page() ? 'active' : ''; ?>">
      <div class="dock-icon-wrap"><i class="bi bi-house-door-fill"></i></div>
      <span class="dock-label">Home</span>
    </a>
    <a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="app-dock-item <?php echo is_page( 'machines' ) ? 'active' : ''; ?>">
      <div class="dock-icon-wrap"><i class="bi bi-cpu-fill"></i></div>
      <span class="dock-label">Machines</span>
    </a>
    <a href="https://wa.me/8801613334514" target="_blank" class="app-dock-item dock-highlight-item" title="WhatsApp Chat">
      <div class="dock-action-circle"><i class="bi bi-whatsapp"></i></div>
      <span class="dock-label">Chat</span>
    </a>
    <a href="<?php echo esc_url( home_url( '/beans/' ) ); ?>" class="app-dock-item <?php echo is_page( 'beans' ) ? 'active' : ''; ?>">
      <div class="dock-icon-wrap"><i class="bi bi-cup-hot-fill"></i></div>
      <span class="dock-label">Beans</span>
    </a>
    <button type="button" class="app-dock-item border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#enquiryModal">
      <div class="dock-icon-wrap"><i class="bi bi-headset"></i></div>
      <span class="dock-label">Enquiry</span>
    </button>
  </nav>

  <!-- Back to Top Button -->
  <button id="backToTop" class="back-to-top" title="Back to Top">
    <i class="bi bi-arrow-up-short"></i>
  </button>

  <!-- Reusable Lead & Contact Modals -->
  <?php get_template_part( 'template-parts/modals' ); ?>

<?php wp_footer(); ?>
</body>
</html>
