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
  <?php get_template_part( 'template-parts/floating-bar' ); ?>

  <!-- Top Contact Bar (Desktop) -->
  <div class="top-contact-bar d-none d-lg-block">
    <div class="container-fluid px-lg-5 d-flex justify-content-between align-items-center">
      <div class="d-flex gap-4">
        <span>For Sales &amp; Service: <a href="tel:+8801613334514">+880 1613-334514</a></span>
        <span>For Training: <a href="tel:+8801606291393">+880 1606-291393</a></span>
        <span>Email: <a href="mailto:sales@santino.com.bd">sales@santino.com.bd</a></span>
      </div>
      <div class="d-flex gap-3">
        <a href="<?php echo esc_url( home_url( '/our-story/' ) ); ?>">Our Story</a>
        <span>|</span>
        <a href="<?php echo esc_url( home_url( '/menu/#branches' ) ); ?>">Find Our Cafes</a>
      </div>
    </div>
  </div>

  <!-- Header Navigation -->
  <header class="site-header">
    <div class="container-fluid px-lg-5 py-1">
      <div class="d-flex align-items-center justify-content-between">
        
        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="d-flex align-items-center gap-2 py-1">
          <?php
          $custom_logo_id = get_theme_mod( 'custom_logo' );
          $logo_url = $custom_logo_id ? wp_get_attachment_image_url( $custom_logo_id, 'full' ) : '';
          if ( ! $logo_url && file_exists( SANTINO_DIR . '/assets/images/Logo-Santino-Coffee-transparent.png' ) ) {
              $logo_url = SANTINO_URI . '/assets/images/Logo-Santino-Coffee-transparent.png';
          }
          if ( $logo_url ) : ?>
            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height: 48px; width: auto; object-fit: contain;">
          <?php else : ?>
            <span class="fs-4 fw-bold font-heading text-dark">Santino<span style="color: #c5a059;">.</span></span>
          <?php endif; ?>
        </a>

        <!-- Desktop Menu 1 (Dynamic WP Nav Menu) -->
        <nav class="d-none d-lg-flex align-items-center gap-1">
          <?php
          wp_nav_menu( array(
              'theme_location' => 'primary',
              'container'      => false,
              'items_wrap'     => '%3$s',
              'walker'         => new Santino_Primary_Nav_Walker(),
              'fallback_cb'    => 'santino_primary_nav_fallback',
          ) );
          ?>
        </nav>

        <!-- Right CTA Items -->
        <div class="d-flex align-items-center gap-3 gap-md-4">
          <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="text-dark fs-5 p-1" title="View Menu"><i class="bi bi-search"></i></a>
          <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="text-dark fs-5 position-relative p-1" title="Cart">
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
        <img src="<?php echo santino_img('Logo-Santino-Coffee-white.png'); ?>" alt="Santino Coffee" style="height: 38px; width: auto; object-fit: contain;">
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

        <a href="<?php echo esc_url( home_url( '/our-story/' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-info-circle-fill drawer-icon-left"></i>
            <span>About Santino</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>
        
        <!-- Mobile Machine Accordion -->
        <div class="border rounded-3 p-2 bg-light">
          <a class="d-flex align-items-center justify-content-between p-2 text-dark fw-bold text-decoration-none collapsed" data-bs-toggle="collapse" href="#mobileEquipmentCollapse" role="button" aria-expanded="false">
            <div class="d-flex align-items-center">
              <i class="bi bi-cpu-fill text-success me-2 fs-5"></i>
              <span>Commercial Machines</span>
            </div>
            <i class="bi bi-chevron-down text-muted small"></i>
          </a>
          <div class="collapse mt-2" id="mobileEquipmentCollapse">
            <div class="d-flex flex-column gap-1 pt-2 border-top">
              <a href="<?php echo esc_url( home_url( '/machines/#victoria-arduino' ) ); ?>" class="small py-1.5 px-2 text-dark fw-bold text-decoration-none d-flex justify-content-between align-items-center bg-white rounded">
                <span>Victoria Arduino</span>
                <span class="badge bg-warning text-dark" style="font-size: 9px;">FLAGSHIP</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/machines/#nuova-simonelli' ) ); ?>" class="small py-1.5 px-2 text-dark fw-bold text-decoration-none d-flex justify-content-between align-items-center bg-white rounded">
                <span>Nuova Simonelli</span>
                <span class="badge bg-secondary" style="font-size: 9px;">ITALY</span>
              </a>
              <a href="<?php echo esc_url( home_url( '/machines/#crem' ) ); ?>" class="small py-1.5 px-2 text-dark text-decoration-none">CREM Espresso</a>
              <a href="<?php echo esc_url( home_url( '/machines/#kalerm' ) ); ?>" class="small py-1.5 px-2 text-dark text-decoration-none">Kalerm Smart Automatics</a>
              <a href="<?php echo esc_url( home_url( '/machines/#rex-royal' ) ); ?>" class="small py-1.5 px-2 text-dark text-decoration-none">Rex Royal Swiss</a>
              <a href="<?php echo esc_url( home_url( '/machines/#3temp' ) ); ?>" class="small py-1.5 px-2 text-dark text-decoration-none">3TEMP Specialty Brewers</a>
              <a href="<?php echo esc_url( home_url( '/machines/#caye' ) ); ?>" class="small py-1.5 px-2 text-dark text-decoration-none">CAYE Bionic Barista Robot</a>
              <a href="<?php echo esc_url( home_url( '/machines/#grinders' ) ); ?>" class="small py-1.5 px-2 text-dark text-decoration-none">Precision Grinders</a>
              <a href="<?php echo esc_url( home_url( '/#machine-services' ) ); ?>" class="small py-1.5 px-2 text-success fw-bold text-decoration-none border-top">24/7 AMC Support &amp; Parts</a>
            </div>
          </div>
        </div>

        <a href="<?php echo esc_url( home_url( '/beans/' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-cup-hot-fill drawer-icon-left"></i>
            <span>Fresh Roasted Beans</span>
          </div>
          <span class="badge bg-success" style="font-size: 9px;">FSSC22000</span>
        </a>

        <a href="<?php echo esc_url( home_url( '/training/' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-mortarboard-fill drawer-icon-left"></i>
            <span>Barista Academy</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>

        <a href="<?php echo esc_url( home_url( '/horeca/' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-building drawer-icon-left"></i>
            <span>HoReCa &amp; Office Coffee</span>
          </div>
          <i class="bi bi-chevron-right text-muted small"></i>
        </a>

        <a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="drawer-nav-link">
          <div class="d-flex align-items-center">
            <i class="bi bi-award-fill drawer-icon-left"></i>
            <span>Club Membership</span>
          </div>
          <span class="badge bg-warning text-dark" style="font-size: 9px;">VIP</span>
        </a>

      </div>

      <!-- Drawer Footer Actions -->
      <div class="pt-3 border-top mt-3">
        <div class="d-flex gap-2 mb-2">
          <a href="tel:+8801613334514" class="btn btn-outline-dark flex-1 w-50 py-2.5 d-flex align-items-center justify-content-center gap-1 font-heading fw-bold" style="font-size: 12px; border-radius: 10px;">
            <i class="bi bi-telephone-fill text-success"></i> Call
          </a>
          <a href="https://wa.me/8801613334514" target="_blank" class="btn btn-success flex-1 w-50 py-2.5 d-flex align-items-center justify-content-center gap-1 font-heading fw-bold" style="font-size: 12px; border-radius: 10px; background-color: #25D366; border: none;">
            <i class="bi bi-whatsapp"></i> WhatsApp
          </a>
        </div>
        <button type="button" class="btn btn-dark w-100 fw-bold py-2.5 d-flex align-items-center justify-content-center gap-2" style="background-color: var(--santino-teal); border: none; border-radius: 10px;" data-bs-dismiss="offcanvas" data-bs-toggle="modal" data-bs-target="#enquiryModal">
          <i class="bi bi-headset"></i> VIP Consultation
        </button>
      </div>
    </div>
  </div>

  <!-- 2ND MENU BAR (Visible on Desktop and Mobile Screen) -->
  <div class="top-category-bar second-menu-bar">
    <div class="container-fluid px-2 px-lg-5">
      <div class="second-menu-wrapper d-flex justify-content-center align-items-center gap-2 gap-sm-4 gap-md-5">
        <a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="second-menu-item">
          <i class="bi bi-award-fill"></i> MEMBERSHIP
        </a>
        <span class="second-menu-sep text-muted">|</span>
        <a href="<?php echo esc_url( home_url( '/bfc/' ) ); ?>" class="second-menu-item">
          <i class="bi bi-shop"></i> BFC
        </a>
        <span class="second-menu-sep text-muted">|</span>
        <a href="<?php echo esc_url( home_url( '/swapno/' ) ); ?>" class="second-menu-item">
          <i class="bi bi-cart3"></i> SWAPNO
        </a>
        <span class="second-menu-sep text-muted">|</span>
        <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="second-menu-item">
          <i class="bi bi-journal-text"></i> MENU
        </a>
      </div>
    </div>
  </div>
