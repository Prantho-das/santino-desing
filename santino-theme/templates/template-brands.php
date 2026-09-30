<?php
/**
 * Template Name: Santino Global Partner Brands
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

// Elementor builder compatibility check
if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor() ) :
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
else :
?>

<!-- MINIMAL CLEAN ALL BRANDS HERO -->
  <section class="pro-banner-hero" style="background-image: url('<?php echo santino_img('bd-barista-latte-art.jpg'); ?>'); background-position: center; min-height: 52vh;">
    <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.45) 100%);"></div>
    <div class="pro-banner-glow-line"></div>
    
    <div class="container pro-banner-container" style="max-width: 680px;">
      
      <!-- Minimal Badge -->
      <div class="pro-banner-pill mb-3">
        <span class="pro-pulse-dot"></span>
        <span>NATIONWIDE COFFEE ECOSYSTEM</span>
      </div>

      <!-- Concise Headline -->
      <h1 class="pro-banner-title mb-2">
        Our Brand & Client Partners
      </h1>

      <!-- One-line Subtitle -->
      <p class="pro-banner-desc mb-4" style="max-width: 520px; font-size: 1.05rem;">
        Powering retail superstore aisles, quick-service restaurant chains, and corporate offices.
      </p>

      <!-- Action Buttons -->
      <div class="pro-banner-actions">
        <a href="#featured-partners" class="btn-hero-lifestyle">
          <span>Explore Partners</span>
          <i class="bi bi-arrow-down-short fs-5"></i>
        </a>
        <button class="btn-hero-outline" data-bs-toggle="modal" data-bs-target="#enquiryModal">
          <i class="bi bi-handshake fs-5 text-gold"></i>
          <span>Become a Partner</span>
        </button>
      </div>

    </div>
  </section>

  <!-- CLEAN SUBTLE STATS STRIP BELOW HERO -->
  <section class="py-4 border-bottom bg-white">
    <div class="container">
      <div class="row g-4 text-center justify-content-center">
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black font-heading" style="color: #d90429;">50+</div>
          <div class="small text-muted fw-bold text-uppercase">BFC Restaurant Outlets</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">100+</div>
          <div class="small text-muted fw-bold text-uppercase">Shwapno Superstores</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-teal font-heading" style="color: var(--santino-teal);">150+</div>
          <div class="small text-muted fw-bold text-uppercase">Corporate Office Cafes</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-gold font-heading" style="color: var(--santino-gold);">1.5M+</div>
          <div class="small text-muted fw-bold text-uppercase">Annual Cups Served</div>
        </div>
      </div>
    </div>
  </section>

  <section id="featured-partners" class="py-5" style="background-color: #f8faf9;">
    <div class="container py-lg-4">
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="text-uppercase fw-bold small" style="color: var(--santino-teal); letter-spacing: 2px;">Core Alliances</span>
        <h2 class="display-6 fw-bold mt-2" style="color: #1a2b29;">Flagship Brand Pages</h2>
        <p class="text-muted">Dedicated operational integration powering retail and foodservice giants.</p>
      </div>

      <div class="row g-4">
        <div class="col-lg-6">
          <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden p-4 p-md-5 text-white position-relative" style="background: linear-gradient(135deg, #1b2624 0%, #004541 100%);">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <span class="badge bg-warning text-dark px-3 py-2 fw-bold rounded-pill">Foodservice Chain Partner</span>
              <i class="bi bi-shop fs-1 text-warning"></i>
            </div>
            <h3 class="fw-bold mb-2 text-white">BFC (Best Fried Chicken)</h3>
            <p class="text-light opacity-80 mb-4" style="font-size: 0.95rem;">
              Freshly brewed Italian espresso beverages, cold frappes and cappuccinos across 50+ quick service restaurants throughout Bangladesh.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-4">
              <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-geo-alt me-1"></i> 50+ Outlets</span>
              <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-cup-hot me-1"></i> 1.5M+ Cups/Yr</span>
            </div>
            <a href="<?php echo esc_url( home_url( '/bfc/' ) ); ?>" class="btn btn-warning fw-bold rounded-pill px-4 py-2 text-dark mt-auto align-self-start" style="background-color: var(--santino-gold); border: none;">
              Visit BFC Brand Page <i class="bi bi-arrow-right ms-2"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden p-4 p-md-5 text-white position-relative" style="background: linear-gradient(135deg, #2a1517 0%, #7b1822 100%);">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <span class="badge bg-light text-danger px-3 py-2 fw-bold rounded-pill">Retail Superstore Partner</span>
              <i class="bi bi-cart3 fs-1 text-danger"></i>
            </div>
            <h3 class="fw-bold mb-2 text-white">Shwapno Superstores</h3>
            <p class="text-light opacity-80 mb-4" style="font-size: 0.95rem;">
              Specialty roasted whole bean & fine grind packs with aroma valves available on retail aisles across 100+ Shwapno superstores nationwide.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-4">
              <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-geo-alt me-1"></i> 100+ Superstores</span>
              <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-box-seam me-1"></i> 4 Roasted Blends</span>
            </div>
            <a href="<?php echo esc_url( home_url( '/swapno/' ) ); ?>" class="btn btn-light fw-bold rounded-pill px-4 py-2 text-danger mt-auto align-self-start">
              Visit Shwapno Brand Page <i class="bi bi-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-white">
    <div class="container py-lg-4">
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="text-uppercase fw-bold small" style="color: var(--santino-teal); letter-spacing: 2px;">Comprehensive Client Reach</span>
        <h2 class="display-6 fw-bold mt-2" style="color: #1a2b29;">Retailers, HORECA & Corporate Network</h2>
        <p class="text-muted">Proudly powering coffee programs across leading organizations.</p>
      </div>

      <div class="row g-4 text-center">
        <div class="col-6 col-md-4 col-lg-3">
          <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center hover-lift">
            <div class="fw-bold fs-5 text-dark mb-1">UNIMART</div>
            <div class="small text-muted">Premium Retail Aisles</div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center hover-lift">
            <div class="fw-bold fs-5 text-dark mb-1">AGORA</div>
            <div class="small text-muted">Retail Superstore Chain</div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center hover-lift">
            <div class="fw-bold fs-5 text-dark mb-1">MEENA BAZAR</div>
            <div class="small text-muted">Gourmet Grocery Outlets</div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center hover-lift">
            <div class="fw-bold fs-5 text-dark mb-1">RADISSON BLU</div>
            <div class="small text-muted">5-Star Hospitality Coffee</div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center hover-lift">
            <div class="fw-bold fs-5 text-dark mb-1">INTERCONTINENTAL</div>
            <div class="small text-muted">Banquet & Suite Espresso</div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center hover-lift">
            <div class="fw-bold fs-5 text-dark mb-1">THE WESTIN DHAKA</div>
            <div class="small text-muted">Executive Lounge Bars</div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center hover-lift">
            <div class="fw-bold fs-5 text-dark mb-1">SUBWAY BANGLADESH</div>
            <div class="small text-muted">Quick Service Bean-to-Cup</div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center hover-lift">
            <div class="fw-bold fs-5 text-dark mb-1">BRAC ENTERPRISES</div>
            <div class="small text-muted">Corporate Headquarters</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->

<?php
endif;

get_footer();
