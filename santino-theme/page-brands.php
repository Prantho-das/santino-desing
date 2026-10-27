<?php
/**
 * Template Name: Santino Global Partner Brands
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

$is_elementor_page = function_exists( 'santino_is_elementor_page' ) ? santino_is_elementor_page() : false;
if ( ! $is_elementor_page && class_exists( '\Elementor\Plugin' ) ) {
    $document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
    if ( ( $document && $document->is_built_with_elementor() ) || \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
        $is_elementor_page = true;
    }
}

if ( $is_elementor_page ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
else :
?>

<!-- MINIMAL CLEAN ALL BRANDS HERO -->
  <section class="pro-banner-hero" style="background-image: url('<?php echo function_exists('santino_get_page_banner') ? santino_get_page_banner('brands', 'imgi_218_blackeagle2.jpg') : santino_img('imgi_218_blackeagle2.jpg'); ?>')"; background-position: center; min-height: 52vh;">
    <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.45) 100%);"></div>
    <div class="pro-banner-glow-line"></div>
    
    <div class="container pro-banner-container" style="max-width: 680px;">
      
      <!-- Minimal Badge -->
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> NATIONWIDE COFFEE ECOSYSTEM</span>
        <span class="sec-pill-line"></span>
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
          <i class="bi bi-arrow-down-short"></i>
        </a>
        <button class="btn-hero-outline" data-bs-toggle="modal" data-bs-target="#enquiryModal">
          <i class="bi bi-handshake text-gold"></i>
          <span>Become a Partner</span>
        </button>
      </div>

    </div>
  </section>

  <!-- Luxury Overlap Floating Metrics Bar -->
  <div class="story-metrics-floating-wrap">
    <div class="container">
      <div class="row g-3 g-md-4 text-center justify-content-center">
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-shop-window"></i></div>
            <div class="metric-num">50+</div>
            <div class="metric-label">BFC Restaurant Outlets</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-cart4"></i></div>
            <div class="metric-num">100+</div>
            <div class="metric-label">Shwapno Superstores</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-building"></i></div>
            <div class="metric-num">150+</div>
            <div class="metric-label">Corporate Office Cafes</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-cup-hot-fill"></i></div>
            <div class="metric-num">1.5M+</div>
            <div class="metric-label">Annual Cups Served</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section id="featured-partners" class="py-5" style="background-color: #f8faf9;">
    <div class="container py-lg-4">
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="text-uppercase fw-bold small" style="color: var(--santino-teal); letter-spacing: 2px;">Core Alliances</span>
        <h2 class="sec-title mb-2" style="color: #1a2b29;">Flagship Brand Pages</h2>
        <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">Dedicated operational integration powering retail and foodservice giants.</p>
      </div>

      <div class="row g-4">
        <div class="col-lg-6">
          <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden p-4 p-md-5 text-white position-relative" style="background: linear-gradient(135deg, #003633 0%, #002220 100%);">
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
            <a href="<?php echo esc_url( home_url( '/bfc/' ) ); ?>" class="btn-hero-lifestyle align-self-start mt-auto">
              Visit BFC Brand Page <i class="bi bi-arrow-right ms-2"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden p-4 p-md-5 text-white position-relative" style="background: linear-gradient(135deg, #002d2a 0%, #004d49 100%);">
            <div class="d-flex justify-content-between align-items-start mb-4">
              <span class="badge bg-light text-success px-3 py-2 fw-bold rounded-pill">Retail Superstore Partner</span>
              <i class="bi bi-cart3 fs-1 text-warning"></i>
            </div>
            <h3 class="fw-bold mb-2 text-white">Shwapno Superstores</h3>
            <p class="text-light opacity-80 mb-4" style="font-size: 0.95rem;">
              Specialty roasted whole bean & fine grind packs with aroma valves available on retail aisles across 100+ Shwapno superstores nationwide.
            </p>
            <div class="d-flex flex-wrap gap-2 mb-4">
              <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-geo-alt me-1"></i> 100+ Superstores</span>
              <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-box-seam me-1"></i> 4 Roasted Blends</span>
            </div>
            <a href="<?php echo esc_url( home_url( '/swapno/' ) ); ?>" class="btn btn-light fw-bold rounded-pill px-4 py-2 text-warning mt-auto align-self-start">
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
        <h2 class="sec-title mb-2" style="color: #1a2b29;">Retailers, HORECA & Corporate Network</h2>
        <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">Proudly powering coffee programs across leading organizations.</p>
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
