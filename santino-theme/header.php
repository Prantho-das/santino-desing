<?php
/**
 * The header for Santino Theme
 *
 * @package Santino
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <!-- Floating Sticky Action Bar -->
  <div class="floating-side-bar">
    <a href="https://wa.me/8801700000000" target="_blank" class="side-btn-whatsapp" title="Chat on WhatsApp">
      <i class="bi bi-whatsapp"></i>
    </a>
    <a href="tel:+8801700000000" class="side-btn-call" title="Call Sales & Service">
      <i class="bi bi-telephone-fill"></i>
    </a>
    <button class="side-btn-enquiry" data-bs-toggle="modal" data-bs-target="#enquiryModal">
      Drop an Enquiry
    </button>
  </div>

  <!-- Top Contact Bar (Desktop) -->
  <div class="top-contact-bar d-none d-lg-block">
    <div class="container-fluid px-lg-5 d-flex justify-content-between align-items-center">
      <div class="d-flex gap-4">
        <span>For Service: <a href="tel:+8801700000000">+880 1700-000000</a></span>
        <span>For Sales: <a href="tel:+8801800000000">+880 1800-000000</a></span>
        <span>Email: <a href="mailto:sales@santino.com.bd">sales@santino.com.bd</a></span>
      </div>
      <div class="d-flex gap-3">
        <a href="<?php echo esc_url( home_url( '/our-story' ) ); ?>">Our Story</a>
        <span>|</span>
        <a href="<?php echo esc_url( home_url( '/menu#branches' ) ); ?>">Find Our Cafes</a>
      </div>
    </div>
  </div>

  <!-- Header Navigation -->
  <header class="site-header">
    <div class="container-fluid px-lg-5 py-1">
      <div class="d-flex align-items-center justify-content-between">
        
        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="d-flex align-items-center gap-2 py-1">
          <?php if ( has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
          <?php else : ?>
            <img src="<?php echo santino_img( 'Logo-Santino-Coffee-transparent.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height: 48px; width: auto; object-fit: contain;">
          <?php endif; ?>
        </a>

        <!-- Desktop Menu with Multi-Level Nested Dropdown for Machine -->
        <nav class="d-none d-lg-flex align-items-center gap-1">
          <a href="<?php echo esc_url( home_url( '/our-story' ) ); ?>" class="nav-link-custom">About Us</a>
          
          <!-- MACHINE WITH NESTED DROPDOWN -->
          <div class="nav-item-dropdown">
            <a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-link-custom d-flex align-items-center gap-1">
              <span>Machine</span>
              <i class="bi bi-chevron-down" style="font-size: 10px;"></i>
            </a>

            <!-- Level 1 Dropdown List -->
            <ul class="nav-nested-menu">
              
              <!-- 1. Nuova Simonelli -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/machines#nuova-simonelli' ) ); ?>" class="nav-nested-link">
                  <span>Nuova Simonelli</span>
                  <span class="nav-nested-badge">ITALY</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Appia Life</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Aurelia Wave</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Prontobar Touch</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">MDJ Grinder</a></li>
                </ul>
              </li>

              <!-- 2. Victoria Arduino -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/machines#victoria-arduino' ) ); ?>" class="nav-nested-link">
                  <span>Victoria Arduino</span>
                  <span class="nav-nested-badge">FLAGSHIP</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">E1 Prima</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Maverick</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Eagle One</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Eagle Tempo</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">MY-Series Grinders</a></li>
                </ul>
              </li>

              <!-- 3. CREM -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/machines#crem' ) ); ?>" class="nav-nested-link">
                  <span>CREM</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">EX3</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Diamant Pro</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Megacrem</a></li>
                </ul>
              </li>

              <!-- 4. Kalerm -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/machines#kalerm' ) ); ?>" class="nav-nested-link">
                  <span>Kalerm</span>
                  <span class="nav-nested-badge">SMART</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Y580C Smart</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">K95L Commercial</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">X580 Automatic</a></li>
                </ul>
              </li>

              <!-- 5. Rex Royal -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/machines#rex-royal' ) ); ?>" class="nav-nested-link">
                  <span>Rex Royal</span>
                  <span class="nav-nested-badge">SWISS</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">S500 Compact</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">S300 Commercial</a></li>
                </ul>
              </li>

              <!-- 6. 3TEMP -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/machines#3temp' ) ); ?>" class="nav-nested-link">
                  <span>3TEMP</span>
                  <span class="nav-nested-badge">BREWER</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Hipster Pulse</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Hipster Profile</a></li>
                </ul>
              </li>

              <!-- 7. CAYE Bionic Barista -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/machines#caye' ) ); ?>" class="nav-nested-link">
                  <span>CAYE Bionic Barista</span>
                  <span class="nav-nested-badge">AI/ROBOT</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Robotic Kiosk System</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Dual-Arm Barista Robot</a></li>
                </ul>
              </li>

              <!-- 8. Grinders -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/machines#grinders' ) ); ?>" class="nav-nested-link">
                  <span>Grinders</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Mythos One / Two</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Eureka Helios</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="nav-sub-link">Fiorenzato F64</a></li>
                </ul>
              </li>

              <!-- 9. Technical Support -->
              <li class="nav-nested-item">
                <a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-nested-link">
                  <span>Technical Support</span>
                  <span class="nav-nested-badge" style="background: rgba(0, 98, 93, 0.4); color: #85e4db; border-color: rgba(133, 228, 219, 0.4);">24/7 AMC</span>
                  <i class="bi bi-chevron-right"></i>
                </a>
                <ul class="nav-nested-submenu">
                  <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">Installation & Setup</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">Preventive AMC</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">Emergency Breakdown</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">100% Genuine Spare Parts</a></li>
                  <li><a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="nav-sub-link">Descaling & Filtration</a></li>
                </ul>
              </li>

            </ul>
          </div>

          <a href="<?php echo esc_url( home_url( '/beans' ) ); ?>" class="nav-link-custom">Beans</a>
          <a href="<?php echo esc_url( home_url( '/training' ) ); ?>" class="nav-link-custom">Training</a>
          <a href="<?php echo esc_url( home_url( '/office-cafe' ) ); ?>" class="nav-link-custom">Horeca</a>
          <a href="<?php echo esc_url( home_url( '/office-cafe' ) ); ?>" class="nav-link-custom">Office Cafe</a>
        </nav>

        <!-- Right CTA Items -->
        <div class="d-flex align-items-center gap-3 gap-md-4">
          <a href="<?php echo esc_url( home_url( '/menu' ) ); ?>" class="text-dark fs-5 p-1" title="View Menu"><i class="bi bi-search"></i></a>
          <a href="<?php echo esc_url( home_url( '/menu' ) ); ?>" class="text-dark fs-5 position-relative p-1" title="Cart">
            <i class="bi bi-cart3"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px;">0</span>
          </a>
          <!-- Mobile App Drawer Trigger -->
          <button class="btn-mobile-menu-trigger d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-label="Open Menu">
            <i class="bi bi-list"></i>
          </button>
        </div>

      </div>
    </div>
  </header>

  <!-- Mobile Offcanvas Native App Drawer -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header">
      <div class="mobile-drawer-brand">
        <img src="<?php echo santino_img( 'Logo-Santino-Coffee-white.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height: 38px; width: auto; object-fit: contain;">
        <span class="drawer-sub-badge"><i class="bi bi-patch-check-fill me-1"></i> Official Roastery &amp; Equipment</span>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column justify-content-between p-3">
      <div class="drawer-nav-group">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-house-door-fill drawer-icon-left"></i>
            <span>Home</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>

        <a href="<?php echo esc_url( home_url( '/our-story' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-info-circle-fill drawer-icon-left"></i>
            <span>About Santino</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>
        
        <a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-cpu-fill drawer-icon-left"></i>
            <span>Commercial Machines</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>

        <a href="<?php echo esc_url( home_url( '/beans' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-cup-hot-fill drawer-icon-left"></i>
            <span>Specialty Coffee Beans</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>

        <a href="<?php echo esc_url( home_url( '/training' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-mortarboard-fill drawer-icon-left"></i>
            <span>Barista Training Academy</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>

        <a href="<?php echo esc_url( home_url( '/office-cafe' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-building drawer-icon-left"></i>
            <span>Horeca &amp; Office Setup</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>

        <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-award-fill drawer-icon-left"></i>
            <span>Club Membership</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>
      </div>

      <div class="mt-4 pt-3 border-top">
        <a href="tel:+8801700000000" class="btn btn-outline-dark w-100 rounded-pill mb-2"><i class="bi bi-telephone-fill me-2 text-success"></i> +880 1700-000000</a>
        <a href="https://wa.me/8801700000000" target="_blank" class="btn btn-success w-100 rounded-pill"><i class="bi bi-whatsapp me-2"></i> WhatsApp Instant Support</a>
      </div>
    </div>
  </div>
