<?php
/**
 * The footer for Santino Theme
 *
 * @package Santino
 */
?>
  <!-- Footer Section -->
  <footer class="site-footer">
    <div class="container-fluid px-lg-5">
      <div class="row g-4 mb-5">
        
        <!-- Column 1: Brand Info -->
        <div class="col-lg-3 col-md-6 col-12 pe-lg-4">
          <div class="d-flex align-items-center gap-2 mb-3">
            <img src="<?php echo santino_img( 'Logo-Santino-Coffee-white.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height: 44px; width: auto; object-fit: contain;">
          </div>
          <p class="footer-brand-desc">
            Bangladesh's premier commercial espresso machine importer, authorized technical service center, and specialty coffee roastery.
          </p>
          <div class="footer-contact-item">
            <i class="bi bi-geo-alt-fill text-warning"></i>
            <span>House 12, Road 11, Banani, Dhaka, Bangladesh</span>
          </div>
          <div class="footer-contact-item">
            <i class="bi bi-telephone-fill text-warning"></i>
            <a href="tel:+8801700000000">+880 1700-000000</a>
          </div>
          <div class="footer-contact-item">
            <i class="bi bi-envelope-fill text-warning"></i>
            <a href="mailto:info@santino.com.bd">info@santino.com.bd</a>
          </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-col-title">Quick Links</h5>
          <ul class="footer-menu-list">
            <li><a href="<?php echo esc_url( home_url( '/our-story' ) ); ?>">About Us</a></li>
            <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>">Machines</a></li>
            <li><a href="<?php echo esc_url( home_url( '/beans' ) ); ?>">Coffee Beans</a></li>
            <li><a href="<?php echo esc_url( home_url( '/training' ) ); ?>">Barista Academy</a></li>
            <li><a href="<?php echo esc_url( home_url( '/office-cafe' ) ); ?>">Horeca &amp; Office</a></li>
            <li><a href="<?php echo esc_url( home_url( '/membership' ) ); ?>">Club Membership</a></li>
          </ul>
        </div>

        <!-- Column 3: Customer Care -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5 class="footer-col-title">Customer Care</h5>
          <ul class="footer-menu-list">
            <li><a href="<?php echo esc_url( home_url( '/office-cafe#contact' ) ); ?>">24/7 AMC Support</a></li>
            <li><a href="<?php echo esc_url( home_url( '/office-cafe#contact' ) ); ?>">Commercial Consultation</a></li>
            <li><a href="<?php echo esc_url( home_url( '/menu#branches' ) ); ?>">Find Cafes &amp; Outlets</a></li>
            <li><a href="<?php echo esc_url( home_url( '/our-story' ) ); ?>">Brand Heritage</a></li>
            <li><a href="tel:+8801700000000">Direct Hotline</a></li>
          </ul>
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
          &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
        </div>
        <div class="footer-brand-motto">
          Good Coffee &bull; Better Days <i class="bi bi-cup-hot-fill ms-1 text-warning"></i>
        </div>
      </div>
    </div>
  </footer>

  <!-- Quick Enquiry Modal -->
  <div class="modal fade" id="enquiryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 p-4">
        <div class="modal-header border-0 pb-0">
          <h4 class="modal-title font-heading fw-bold">Drop an Enquiry</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted small mb-4">Leave your details and our commercial coffee team will contact you immediately.</p>
          <form onsubmit="alert('Thank you! We will contact you shortly.'); return false;">
            <div class="mb-3">
              <input type="text" class="form-control" placeholder="Full Name *" required>
            </div>
            <div class="mb-3">
              <input type="tel" class="form-control" placeholder="Phone Number *" required>
            </div>
            <div class="mb-3">
              <input type="email" class="form-control" placeholder="Email Address *" required>
            </div>
            <div class="mb-3">
              <textarea class="form-control" rows="3" placeholder="Tell us about your machine or coffee needs..."></textarea>
            </div>
            <button type="submit" class="btn-kp-maroon w-100 py-2">
              SEND INQUIRY
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MOBILE NATIVE APP BOTTOM NAVIGATION DOCK -->
  <nav class="mobile-app-dock d-flex d-lg-none" aria-label="Mobile Navigation">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="app-dock-item active">
      <div class="dock-icon-wrap"><i class="bi bi-house-door-fill"></i></div>
      <span class="dock-label">Home</span>
    </a>
    <a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="app-dock-item">
      <div class="dock-icon-wrap"><i class="bi bi-cpu-fill"></i></div>
      <span class="dock-label">Machines</span>
    </a>
    <a href="https://wa.me/8801700000000" target="_blank" class="app-dock-item dock-highlight-item" title="WhatsApp Chat">
      <div class="dock-action-circle"><i class="bi bi-whatsapp"></i></div>
      <span class="dock-label">Chat</span>
    </a>
    <a href="<?php echo esc_url( home_url( '/beans' ) ); ?>" class="app-dock-item">
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

  <?php wp_footer(); ?>
</body>
</html>
