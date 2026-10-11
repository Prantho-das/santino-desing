<?php
/**
 * Template Name: Santino BFC Foodservice Coffee
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

$is_elementor_page = false;
if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    $document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
    if ( $document && $document->is_built_with_elementor() ) {
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
<style>
/* Santino Unified Design System - BFC Page */
.bfc-page-wrap, body, p, .pro-banner-desc, .text-muted, .text-secondary, label, input, select, textarea {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif) !important;
}

.pro-banner-title,
.sec-title,
.editorial-gallery-title,
.branch-title,
.font-heading,
h1, h2, h3, h4, h5, h6,
.sec-pill-badge,
.btn-hero-lifestyle,
.btn-hero-outline,
.btn-lookup-action,
.branch-filter-btn,
.badge-theme {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  letter-spacing: -0.3px;
}

.sec-title {
  font-size: clamp(2rem, 3.5vw, 2.8rem) !important;
  font-weight: 900 !important;
  color: #111111;
  letter-spacing: -0.5px !important;
}

.sec-title.text-white,
.text-white .sec-title,
#bfc-gallery .sec-title,
#swapno-gallery .sec-title {
  color: #ffffff !important;
}

.sec-title-accent, .menu-title-highlight {
  color: var(--santino-teal, #00625d) !important;
}

.sec-pill-badge {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  font-size: 0.78rem !important;
}

/* Home Page Exact Button Sizing */
.btn-hero-lifestyle,
.btn-hero-outline {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  font-weight: 700 !important;
  font-size: 13px !important;
  letter-spacing: 0.6px !important;
  text-transform: uppercase !important;
  height: 48px !important;
  min-height: 48px !important;
  max-height: 48px !important;
  padding: 0 28px !important;
  box-sizing: border-box !important;
  line-height: 1 !important;
  border-radius: 50px !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 8px !important;
  text-decoration: none !important;
  cursor: pointer !important;
  white-space: nowrap !important;
  vertical-align: middle !important;
  transition: all 0.28s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
}

.btn-hero-lifestyle span,
.btn-hero-outline span {
  display: inline-block !important;
  line-height: 1 !important;
  vertical-align: middle !important;
}

.btn-hero-lifestyle i,
.btn-hero-outline i {
  font-size: 14px !important;
  line-height: 1 !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  margin: 0 !important;
  vertical-align: middle !important;
  transition: transform 0.25s ease !important;
}

.btn-hero-lifestyle {
  background: var(--santino-teal, #00625d) !important;
  border: 2px solid var(--santino-teal, #00625d) !important;
  color: #ffffff !important;
  box-shadow: 0 6px 18px rgba(0, 98, 93, 0.35) !important;
}

.btn-hero-lifestyle:hover {
  background: #004d49 !important;
  border-color: #004d49 !important;
  color: #ffffff !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 10px 25px rgba(0, 98, 93, 0.5) !important;
}

.btn-hero-lifestyle:hover i {
  transform: translateX(4px) !important;
}

.btn-hero-outline {
  background: transparent !important;
  border: 2px solid rgba(255, 255, 255, 0.85) !important;
  color: #ffffff !important;
}

.btn-hero-outline:hover {
  background: #ffffff !important;
  color: var(--santino-teal, #00625d) !important;
  border-color: #ffffff !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 8px 22px rgba(255, 255, 255, 0.3) !important;
}

/* Theme Badges */
.badge-theme-teal {
  background: rgba(0, 98, 93, 0.08);
  color: var(--santino-teal, #00625d);
  border: 1px solid rgba(0, 98, 93, 0.2);
  padding: 4px 10px;
  border-radius: 50px;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}
.badge-theme-gold {
  background: rgba(195, 153, 108, 0.15);
  color: #8e683b;
  border: 1px solid rgba(195, 153, 108, 0.3);
  padding: 4px 10px;
  border-radius: 50px;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}
.badge-theme-maroon {
  background: rgba(115, 27, 32, 0.08);
  color: var(--kp-maroon, #731b20);
  border: 1px solid rgba(115, 27, 32, 0.2);
  padding: 4px 10px;
  border-radius: 50px;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
}

/* Home Page Capsule Search Pill */
.portal-lookup-group {
  display: flex;
  align-items: center;
  background: #ffffff;
  border: 1.5px solid #d5e5e0;
  border-radius: 50px;
  padding: 5px 6px 5px 16px;
  transition: all 0.3s ease;
  box-shadow: 0 2px 10px rgba(0, 98, 93, 0.04);
  width: 100%;
}
.portal-lookup-group:focus-within {
  border-color: var(--santino-teal, #00625d);
  box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.12), 0 4px 16px rgba(0, 98, 93, 0.08);
}
.portal-lookup-field {
  flex: 1;
  display: flex;
  align-items: center;
  gap: 10px;
}
.portal-lookup-field i {
  color: var(--santino-teal, #00625d);
  font-size: 1.1rem;
}
.portal-lookup-field input {
  width: 100%;
  border: none;
  background: transparent;
  outline: none;
  box-shadow: none;
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
  font-size: 0.92rem;
  color: #1a2b28;
  padding: 8px 0;
}
.portal-lookup-field input::placeholder {
  color: #8da19d;
}
.btn-lookup-action {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  border: none;
  font-family: var(--kp-font-title, 'Montserrat', sans-serif);
  font-weight: 700;
  font-size: 12.5px;
  letter-spacing: 0.6px;
  text-transform: uppercase;
  padding: 10px 24px;
  border-radius: 50px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  cursor: pointer;
  box-shadow: 0 4px 14px rgba(0, 98, 93, 0.25);
  transition: all 0.25s ease;
  white-space: nowrap;
}
.btn-lookup-action:hover {
  background: #004d49;
  color: #ffffff;
  transform: translateY(-1px);
  box-shadow: 0 8px 20px rgba(0, 98, 93, 0.4);
}

/* Branch Filter Pills */
.branch-filter-btn {
  background: #ffffff;
  border: 1.5px solid #d5e5e0;
  color: #3b504c;
  padding: 6px 16px;
  border-radius: 50px;
  font-size: 12.5px;
  font-weight: 700;
  letter-spacing: 0.3px;
  transition: all 0.25s ease;
  cursor: pointer;
}
.branch-filter-btn:hover {
  border-color: var(--santino-teal, #00625d);
  color: var(--santino-teal, #00625d);
  background: #f0f6f4;
}
.branch-filter-btn.active {
  background: var(--santino-teal, #00625d) !important;
  border-color: var(--santino-teal, #00625d) !important;
  color: #ffffff !important;
  box-shadow: 0 4px 12px rgba(0, 98, 93, 0.25);
}

/* Compact Neat Outlet Cards - Absolutely No Unwanted Height */
.outlet-item {
  height: auto !important;
  min-height: unset !important;
}
.outlet-card-box {
  background: #ffffff !important;
  border: 1.5px solid #e1ebe7 !important;
  border-radius: 16px !important;
  padding: 18px 20px !important;
  box-shadow: 0 4px 16px rgba(0, 77, 73, 0.04) !important;
  transition: all 0.25s ease !important;
  height: auto !important;
  min-height: unset !important;
  display: block !important;
}
.outlet-card-box:hover {
  transform: translateY(-3px);
  border-color: rgba(0, 98, 93, 0.4) !important;
  box-shadow: 0 12px 28px rgba(0, 77, 73, 0.08) !important;
}
.btn-outlet-action {
  border: 1.5px solid var(--santino-teal, #00625d);
  color: var(--santino-teal, #00625d);
  background: #ffffff;
  font-family: var(--kp-font-title, 'Montserrat', sans-serif);
  font-weight: 700;
  font-size: 11px;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  padding: 8px 14px;
  border-radius: 50px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
  transition: all 0.2s ease;
  margin-top: 4px;
}
.btn-outlet-action:hover {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
}
</style>

<div class="bfc-page-wrap">
  <!-- MINIMAL CLEAN BFC HERO BANNER -->
  <section class="pro-banner-hero pro-banner-bfc position-relative overflow-hidden text-center" style="background-image: url('<?php echo santino_img('bfc_santino_foodservice.jpg'); ?>'); background-position: center 30%; min-height: 50vh; display: flex; align-items: center; justify-content: center; padding: 70px 20px;">
    <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0, 0, 0, 0.35) 0%, rgba(0, 38, 35, 0.72) 100%); z-index: 1;"></div>
    
    <div class="container position-relative" style="max-width: 780px; z-index: 2;">
      
      <!-- Home Style Pill Badge -->
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-shield-check me-1 text-warning"></i> OFFICIAL FOODSERVICE PARTNER</span>
        <span class="sec-pill-line"></span>
      </div>

      <!-- Main Heading -->
      <h1 class="pro-banner-title mb-2" style="font-size: clamp(2.2rem, 4.2vw, 3.4rem); font-weight: 900; line-height: 1.18; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
        BFC × Santino <span style="color: #dfbe8d;">Espresso Bar</span>
      </h1>

      <!-- Lead Description -->
      <p class="pro-banner-desc mb-4" style="max-width: 580px; font-size: 1.02rem; line-height: 1.6; color: rgba(255, 255, 255, 0.92); margin: 0 auto;">
        Specialty Italian espresso & handcrafted beverages served fresh daily across 50+ BFC restaurant counters in Bangladesh.
      </p>

      <!-- Action Buttons -->
      <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
        <a href="#outlets" class="btn-hero-lifestyle">
          <i class="bi bi-geo-alt-fill"></i>
          <span>Find Nearest BFC</span>
        </a>
        <a href="#bfc-gallery" class="btn-hero-outline">
          <i class="bi bi-images text-warning"></i>
          <span>View Gallery</span>
        </a>
      </div>

    </div>
  </section>

  <!-- SUBTLE STATS STRIP BELOW HERO -->
  <section class="py-3 border-bottom bg-white">
    <div class="container">
      <div class="row g-3 text-center justify-content-center">
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black font-heading" style="color: var(--santino-teal, #00625d);">50+</div>
          <div class="small text-muted fw-bold text-uppercase" style="font-size: 11px;">BFC Outlets Powered</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">1.5M+</div>
          <div class="small text-muted fw-bold text-uppercase" style="font-size: 11px;">Cups Served Annually</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black font-heading" style="color: #8e683b;">&lt; 45s</div>
          <div class="small text-muted fw-bold text-uppercase" style="font-size: 11px;">Serving Speed</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black font-heading" style="color: var(--santino-teal, #00625d);">24/7</div>
          <div class="small text-muted fw-bold text-uppercase" style="font-size: 11px;">Certified Barista SLA</div>
        </div>
      </div>
    </div>
  </section>

  <!-- 1. EDITORIAL PHOTOGRAPHY SHOWCASE -->
  <section id="bfc-gallery" class="py-5" style="background-color: #08100f; color: #ffffff;">
    <div class="container py-lg-3">
      
      <div class="text-center max-w-700 mx-auto mb-4">
        <div class="sec-pill-badge-wrap light mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-camera-fill me-1"></i> VISUAL EXPERIENCE</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="sec-title text-white mb-2">Inside The BFC × <span class="sec-title-accent" style="color: #dfbe8d !important;">Santino Craft</span></h2>
        <p class="text-white-50 small mb-0" style="max-width: 580px; margin: 0 auto;">Live commercial espresso stations, artisan roasted beans, and certified barista workflows across 50+ branches in Bangladesh.</p>
      </div>

      <!-- Seamless Gallery Layout -->
      <div class="row g-3">
        
        <!-- Feature 1 -->
        <div class="col-lg-7">
          <div class="editorial-gallery-item" style="min-height: 340px;">
            <img src="<?php echo santino_img('bfc_santino_foodservice.jpg'); ?>" alt="Commercial Espresso Station" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge"><i class="bi bi-cup-hot-fill"></i> Live Counter Setup</span>
              <h3 class="editorial-gallery-title">Commercial 9-Bar Espresso Station</h3>
              <p class="editorial-gallery-desc">High-pressure Italian steam boilers ensuring thick golden crema on every single shot served across all BFC outlets.</p>
            </div>
          </div>
        </div>

        <!-- Feature 2 -->
        <div class="col-lg-5">
          <div class="editorial-gallery-item" style="min-height: 340px;">
            <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Barista Latte Pour" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge" style="color: #dfbe8d;"><i class="bi bi-droplet-fill"></i> Microfoam Steam</span>
              <h3 class="editorial-gallery-title">Velvety Textured Milk</h3>
              <p class="editorial-gallery-desc">Micro-textured milk heated to the exact 65°C sweet spot for silk-smooth cappuccinos and lattes.</p>
            </div>
          </div>
        </div>

        <!-- Tile 3 -->
        <div class="col-md-6 col-lg-4">
          <div class="editorial-gallery-item" style="min-height: 250px;">
            <img src="<?php echo santino_img('bangladesh_corporate_expansion.jpg'); ?>" alt="Master Drum Roastery" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge" style="color: #dfbe8d;"><i class="bi bi-fire"></i> Custom Roasts</span>
              <h3 class="editorial-gallery-title">BFC Signature Blend</h3>
              <p class="editorial-gallery-desc">Medium-dark roasted weekly in micro-batches with rich dark cocoa & hazelnut notes.</p>
            </div>
          </div>
        </div>

        <!-- Tile 4 -->
        <div class="col-md-6 col-lg-4">
          <div class="editorial-gallery-item" style="min-height: 250px;">
            <img src="<?php echo santino_img('bd-barista-training.jpg'); ?>" alt="Barista Training" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge" style="color: #00a896;"><i class="bi bi-award-fill"></i> Barista Academy</span>
              <h3 class="editorial-gallery-title">Certified Staff Calibration</h3>
              <p class="editorial-gallery-desc">Regular WBC-standard training and audits to guarantee taste consistency at all 50+ branches.</p>
            </div>
          </div>
        </div>

        <!-- Tile 5 -->
        <div class="col-md-12 col-lg-4">
          <div class="editorial-gallery-item" style="min-height: 250px;">
            <img src="<?php echo santino_img('bd-office-coffee.jpg'); ?>" alt="Fast Service Velocity" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge" style="color: #dfbe8d;"><i class="bi bi-lightning-charge-fill"></i> Peak Velocity</span>
              <h3 class="editorial-gallery-title">Under 45s Serving Speed</h3>
              <p class="editorial-gallery-desc">Engineered workflow designed for rush hours without compromising beverage extraction quality.</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 2. PARTNERSHIP SYNERGY -->
  <section class="py-5" style="background-color: #f8faf9;">
    <div class="container py-lg-3">
      <div class="row align-items-center g-4">
        <div class="col-lg-6">
          <div class="pe-lg-3">
            <div class="sec-pill-badge-wrap start mb-2">
              <span class="sec-pill-line"></span>
              <span class="sec-pill-badge"><i class="bi bi-lightning-charge-fill me-1"></i> PARTNERSHIP SYNERGY</span>
              <span class="sec-pill-line"></span>
            </div>
            <h2 class="sec-title mb-2">How Santino Powers The <span class="sec-title-accent">BFC Coffee Experience</span></h2>
            <p class="text-secondary leading-relaxed mb-3" style="font-size: 0.95rem; line-height: 1.6;">
              Every BFC quick-service counter is equipped with professional Santino commercial bean-to-cup espresso equipment and our custom-roasted barista blend beans. Designed to serve restaurant diners fast, consistent, and barista-level specialty coffee.
            </p>
            
            <div class="d-flex flex-column gap-2">
              <div class="d-flex align-items-start gap-3 p-2.5 bg-white rounded-3 shadow-sm border" style="border-color: #e2ece8 !important; padding: 12px 14px;">
                <div class="p-2 rounded-circle text-white d-flex align-items-center justify-content-center" style="background-color: var(--santino-teal, #00625d); width: 38px; height: 38px; flex-shrink: 0;">
                  <i class="bi bi-cup-hot fs-6"></i>
                </div>
                <div>
                  <h6 class="fw-bold mb-0 font-heading" style="font-size: 0.95rem;">Authentic 9-Bar Extraction</h6>
                  <p class="small text-muted mb-0" style="font-size: 0.84rem;">High-pressure Italian steam boilers ensuring thick golden crema on every single shot.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-2.5 bg-white rounded-3 shadow-sm border" style="border-color: #e2ece8 !important; padding: 12px 14px;">
                <div class="p-2 rounded-circle text-white d-flex align-items-center justify-content-center" style="background-color: #8e683b; width: 38px; height: 38px; flex-shrink: 0;">
                  <i class="bi bi-lightning-charge fs-6"></i>
                </div>
                <div>
                  <h6 class="fw-bold mb-0 font-heading" style="font-size: 0.95rem;">Under 45s Serving Velocity</h6>
                  <p class="small text-muted mb-0" style="font-size: 0.84rem;">Engineered for rush hour restaurant volumes without dropping cup quality.</p>
                </div>
              </div>

              <div class="d-flex align-items-start gap-3 p-2.5 bg-white rounded-3 shadow-sm border" style="border-color: #e2ece8 !important; padding: 12px 14px;">
                <div class="p-2 rounded-circle text-white d-flex align-items-center justify-content-center" style="background-color: #1a2b29; width: 38px; height: 38px; flex-shrink: 0;">
                  <i class="bi bi-award fs-6"></i>
                </div>
                <div>
                  <h6 class="fw-bold mb-0 font-heading" style="font-size: 0.95rem;">Certified Barista Staff Training</h6>
                  <p class="small text-muted mb-0" style="font-size: 0.84rem;">Regular calibration and milk texturing training conducted by Santino Coffee Academy.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="row g-2">
            <div class="col-6">
              <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Commercial Espresso Roastery" class="img-fluid rounded-4 shadow-sm w-100" style="height: 200px; object-fit: cover;">
            </div>
            <div class="col-6">
              <img src="<?php echo santino_img('bfc_santino_foodservice.jpg'); ?>" alt="BFC Foodservice Setup" class="img-fluid rounded-4 shadow-sm w-100" style="height: 200px; object-fit: cover;">
            </div>
            <div class="col-12">
              <div class="p-3.5 rounded-4 text-white shadow-sm" style="background: linear-gradient(135deg, var(--santino-teal, #00625d) 0%, #003633 100%); padding: 16px 20px;">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="fw-bold mb-1 text-white font-heading" style="font-size: 1rem;">BFC Signature Blend Beans</h6>
                    <p class="small text-light opacity-75 mb-0" style="font-size: 0.84rem;">80% Arabica + 20% Robusta custom medium-dark roast profile.</p>
                  </div>
                  <i class="bi bi-bag-check-fill fs-2 text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. BFC COFFEE LINEUP -->
  <section id="bfc-menu" class="py-5 bg-white">
    <div class="container py-lg-3">
      <div class="text-center max-w-700 mx-auto mb-4">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> SERVED HOT & ICED</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="sec-title mb-2">Santino Coffee <span class="sec-title-accent">Lineup at BFC</span></h2>
        <p class="text-muted mb-0" style="font-size: 0.95rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">Available at all BFC counters across Dhaka, Chattogram, Sylhet, and major cities.</p>
      </div>

      <div class="row g-3">
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-3 hover-lift" style="border: 1.5px solid #e1ebe7 !important;">
            <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(0,98,93,0.08); color: var(--santino-teal, #00625d);">
              <i class="bi bi-cup-hot fs-3"></i>
            </div>
            <span class="badge-theme-teal mx-auto mb-2">All Time Favorite</span>
            <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Classic Cappuccino</h6>
            <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.4;">Rich single origin espresso topped with thick velvety steamed microfoam milk.</p>
            <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 180 <span class="small text-muted fw-normal" style="font-size: 11px;">/ Regular</span></div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-3 hover-lift" style="border: 1.5px solid #e1ebe7 !important;">
            <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(195,153,108,0.15); color: #8e683b;">
              <i class="bi bi-snow2 fs-3"></i>
            </div>
            <span class="badge-theme-gold mx-auto mb-2">Cold Refreshment</span>
            <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Iced Caramel Latte</h6>
            <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.4;">Freshly pulled espresso layered over cold milk, ice cubes, and gourmet caramel drizzle.</p>
            <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 220 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 16oz</span></div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-3 hover-lift" style="border: 1.5px solid #e1ebe7 !important;">
            <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(0,98,93,0.08); color: var(--santino-teal, #00625d);">
              <i class="bi bi-fire fs-3"></i>
            </div>
            <span class="badge-theme-maroon mx-auto mb-2">Pure Caffeine</span>
            <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Americano / Long Black</h6>
            <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.4;">Double ristretto shot diluted with purified hot water for crisp dark notes.</p>
            <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 150 <span class="small text-muted fw-normal" style="font-size: 11px;">/ Regular</span></div>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-3 hover-lift" style="border: 1.5px solid #e1ebe7 !important;">
            <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(195,153,108,0.15); color: #8e683b;">
              <i class="bi bi-cup-straw fs-3"></i>
            </div>
            <span class="badge-theme-gold mx-auto mb-2">Signature Dessert</span>
            <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Hazelnut Mocha Frappe</h6>
            <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.4;">Blended ice roast espresso, pure cocoa, roasted hazelnut notes, and whipped cream.</p>
            <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 250 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 16oz</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. OUTLETS LOCATOR -->
  <section id="outlets" class="py-5" style="background-color: #f8faf9;">
    <div class="container py-lg-3">
      
      <div class="row align-items-center mb-3">
        <div class="col-md-7">
          <div class="sec-pill-badge-wrap start mb-2">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill me-1"></i> NATIONWIDE PRESENCE</span>
            <span class="sec-pill-line"></span>
          </div>
          <h2 class="sec-title mb-1">Find Santino Coffee at <span class="sec-title-accent">Your Nearest BFC</span></h2>
          <p class="text-muted small mt-1 mb-0">Serving fresh Italian espresso at 50+ branches across Bangladesh.</p>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
          <div class="portal-lookup-group">
            <div class="portal-lookup-field">
              <i class="bi bi-search text-teal"></i>
              <input type="text" id="bfcSearchInput" placeholder="Search branch (e.g. Dhanmondi, Gulshan, Sylhet)..." onkeyup="filterBfcOutlets()">
            </div>
            <button class="btn-lookup-action" type="button" onclick="filterBfcOutlets()">
              <span>Search</span> <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Quick Area Filter Pills -->
      <div class="d-flex flex-wrap gap-2 mb-3">
        <button class="branch-filter-btn active" onclick="filterBfcByTag('all', this)">All Outlets (12)</button>
        <button class="branch-filter-btn" onclick="filterBfcByTag('dhaka-north', this)">Dhaka North (Gulshan, Banani, Uttara)</button>
        <button class="branch-filter-btn" onclick="filterBfcByTag('dhaka-south', this)">Dhaka South (Dhanmondi, Bailey Rd, Khilgaon)</button>
        <button class="branch-filter-btn" onclick="filterBfcByTag('chattogram', this)">Chattogram (GEC, Agrabad)</button>
        <button class="branch-filter-btn" onclick="filterBfcByTag('sylhet', this)">Sylhet &amp; Others</button>
      </div>

      <!-- Outlets Grid (All 12 Branches) -->
      <div class="row g-3" id="bfcOutletGrid">
        
        <!-- Branch 1: BFC Dhanmondi 27 -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-south dhanmondi">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Dhanmondi 27</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Rangs Fortune Square, Road 27, Dhanmondi, Dhaka</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:00 AM – 11:30 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000001</div>
            <a href="https://maps.google.com/?q=BFC+Dhanmondi+27+Dhaka" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 2: BFC Gulshan 1 Avenue -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north gulshan">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Gulshan 1 Avenue</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Navana Tower, Ground Floor, Gulshan 1, Dhaka</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:00 AM – 12:00 AM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000002</div>
            <a href="https://maps.google.com/?q=BFC+Gulshan+1+Dhaka" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 3: BFC Banani Road 11 -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north banani">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Banani Road 11</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> House 54, Road 11, Block D, Banani, Dhaka</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:00 AM – 12:00 AM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000003</div>
            <a href="https://maps.google.com/?q=BFC+Banani+Road+11+Dhaka" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 4: BFC Uttara Sector 3 -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north uttara">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Uttara Sector 3</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Rabindra Sarani, Sector 3, Uttara, Dhaka</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:00 AM – 11:30 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000004</div>
            <a href="https://maps.google.com/?q=BFC+Uttara+Dhaka" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 5: BFC Bailey Road -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-south bailey">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Bailey Road</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Capital Siraj Center, New Bailey Road, Dhaka</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 11:00 AM – 11:00 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000005</div>
            <a href="https://maps.google.com/?q=BFC+Bailey+Road+Dhaka" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 6: BFC Khilgaon Taltola -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-south khilgaon">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Khilgaon Taltola</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Shahid Baki Road, Taltola, Khilgaon, Dhaka</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 11:00 AM – 11:30 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000006</div>
            <a href="https://maps.google.com/?q=BFC+Khilgaon+Dhaka" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 7: BFC Mirpur 1 -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north mirpur">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Mirpur 1</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Sony Cinema Hall Circle, Mirpur 1, Dhaka</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:00 AM – 11:00 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000007</div>
            <a href="https://maps.google.com/?q=BFC+Mirpur+1+Dhaka" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 8: BFC Bashundhara R/A -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north bashundhara">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Bashundhara R/A</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Main Gate, Bashundhara R/A, Dhaka</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:00 AM – 11:30 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000008</div>
            <a href="https://maps.google.com/?q=BFC+Bashundhara+Dhaka" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 9: BFC Chattogram GEC -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="chattogram gec">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Chattogram GEC</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> GEC Circle, CDA Avenue, Chattogram</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:30 AM – 11:30 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000009</div>
            <a href="https://maps.google.com/?q=BFC+GEC+Chattogram" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 10: BFC Chattogram Agrabad -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="chattogram agrabad">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Chattogram Agrabad</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Agrabad Commercial Area, Chattogram</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:30 AM – 11:00 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000010</div>
            <a href="https://maps.google.com/?q=BFC+Agrabad+Chattogram" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 11: BFC Sylhet Zindabazar -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="sylhet zindabazar">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Sylhet Zindabazar</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Millennium Market, Zindabazar, Sylhet</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 11:00 AM – 11:00 PM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000011</div>
            <a href="https://maps.google.com/?q=BFC+Zindabazar+Sylhet" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>

        <!-- Branch 12: BFC Coxs Bazar Kolatoli -->
        <div class="col-md-6 col-lg-4 outlet-item" data-zone="sylhet other cox">
          <div class="outlet-card-box">
            <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
              <h5 class="fw-bold mb-0 font-heading text-dark" style="font-size: 1.02rem;">BFC Coxs Bazar Kolatoli</h5>
              <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle me-1"></i>ACTIVE</span>
            </div>
            <p class="small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt-fill text-teal me-1"></i> Hotel Motel Zone, Kolatoli, Coxs Bazar</p>
            <div class="small text-secondary mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock me-1 text-teal"></i> 10:00 AM – 12:00 AM Daily</div>
            <div class="small text-muted mb-2" style="font-size: 0.82rem;"><i class="bi bi-telephone-fill me-1 text-teal"></i> Hotline: +880 1711-000012</div>
            <a href="https://maps.google.com/?q=BFC+Coxs+Bazar" target="_blank" class="btn-outlet-action w-100"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<script>
window.filterBfcByTag = function(tag, btn) {
  if (btn) {
    document.querySelectorAll('#outlets .branch-filter-btn').forEach(function(b) { b.classList.remove('active'); });
    btn.classList.add('active');
  }
  var cards = document.querySelectorAll('#bfcOutletGrid [data-zone]');
  cards.forEach(function(card) {
    var zone = (card.getAttribute('data-zone') || '').toLowerCase();
    if (tag === 'all' || zone.indexOf(tag.toLowerCase()) !== -1) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
};

window.filterBfcOutlets = function() {
  var input = document.getElementById('bfcSearchInput');
  var q = (input ? input.value : '').toLowerCase().trim();
  var cards = document.querySelectorAll('#bfcOutletGrid [data-zone]');
  cards.forEach(function(card) {
    var zone = (card.getAttribute('data-zone') || '').toLowerCase();
    var text = (card.innerText || '').toLowerCase();
    if (!q || zone.indexOf(q) !== -1 || text.indexOf(q) !== -1) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
};
</script>
<?php
endif;
get_footer();
?>