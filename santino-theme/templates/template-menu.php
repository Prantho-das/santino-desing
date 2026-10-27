<?php
/**
 * Template Name: Cafe Beverage Menu Page
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

<style>
.menu-page-wrap, body, p, .text-muted, .text-secondary, label, input, select, textarea {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
}

.sec-title,
.font-heading,
h1, h2, h3, h4, h5, h6,
.sec-pill-badge,
.btn-hero-lifestyle,
.btn-hero-outline,
.btn-lookup-action,
.branch-filter-btn,
.btn-cat-tab,
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
.text-white .sec-title {
  color: #ffffff !important;
}

.sec-title-accent, .menu-title-highlight {
  color: var(--santino-teal, #00625d) !important;
}

.sec-description {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
  color: #556662;
  font-size: 1rem;
  line-height: 1.6;
}

.sec-pill-badge-wrap {
  display: inline-flex;
  align-items: center;
}

.sec-pill-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(0, 98, 93, 0.08);
  color: var(--santino-teal, #00625d);
  border: 1px solid rgba(0, 98, 93, 0.22);
  padding: 5px 14px;
  border-radius: 50px;
  font-size: 0.76rem;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.sec-pill-badge i {
  font-size: 7px;
  color: var(--santino-teal, #00625d);
}

.portal-lookup-group {
  display: flex;
  align-items: center;
  background: #f8faf9;
  border: 1.5px solid #d5e5e0;
  border-radius: 50px;
  padding: 6px 8px 6px 18px;
  transition: all 0.3s ease;
  box-shadow: 0 2px 10px rgba(0, 98, 93, 0.04);
  width: 100%;
}

.portal-lookup-group:focus-within {
  border-color: var(--santino-teal, #00625d);
  background: #ffffff;
  box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.12), 0 4px 16px rgba(0, 98, 93, 0.08);
}

.portal-lookup-field {
  flex: 1;
  display: flex;
  align-items: center;
  gap: 12px;
}

.portal-lookup-field i {
  color: var(--santino-teal, #00625d);
  font-size: 1.15rem;
}

.portal-lookup-field input {
  width: 100%;
  border: none;
  background: transparent;
  outline: none;
  box-shadow: none;
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
  font-size: 0.95rem;
  color: #111111;
  padding: 8px 0;
}

.portal-lookup-field input::placeholder {
  color: #8da39e;
  font-weight: 400;
}

.btn-lookup-action {
  background: var(--santino-teal, #00625d);
  border: none;
  color: #ffffff;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  flex-shrink: 0;
}

.btn-lookup-action:hover {
  background: #004d49;
  transform: scale(1.05);
}

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

.floating-bg-icons {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  overflow: hidden;
  z-index: 0;
}

.floating-bg-icons i {
  position: absolute;
  color: rgba(0, 98, 93, 0.04);
  animation: floatSlow 8s ease-in-out infinite alternate;
}

@keyframes floatSlow {
  0% { transform: translateY(0) rotate(0deg); }
  100% { transform: translateY(-15px) rotate(10deg); }
}

/* Category Filter Tabs */
.btn-cat-tab {
  border: 1.5px solid #e0ebe8;
  background: #ffffff;
  color: #334441;
  border-radius: 50px;
  padding: 9px 20px;
  font-size: 13.5px;
  font-weight: 700;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
}

.btn-cat-tab:hover {
  border-color: var(--santino-teal, #00625d);
  color: var(--santino-teal, #00625d);
  background: #f4faf8;
}

.btn-cat-tab.active {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  border-color: var(--santino-teal, #00625d);
  box-shadow: 0 4px 14px rgba(0, 98, 93, 0.25);
}

/* Menu Product Cards */
.menu-product-card {
  background: #ffffff;
  border: 1px solid #e8f0ed;
  border-radius: 18px;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
  display: flex;
  flex-direction: column;
  height: 100%;
  cursor: pointer;
}

.menu-product-card:hover {
  transform: translateY(-6px);
  border-color: rgba(0, 98, 93, 0.3);
  box-shadow: 0 14px 34px rgba(0, 98, 93, 0.12);
}

.menu-card-image-wrap {
  position: relative;
  height: 220px;
  background: #f7f9f8;
  overflow: hidden;
}

.menu-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.menu-product-card:hover .menu-card-img {
  transform: scale(1.05);
}

.menu-badge-pill {
  position: absolute;
  top: 12px;
  left: 12px;
  z-index: 2;
  font-size: 10px;
  font-weight: 800;
  letter-spacing: 0.6px;
  padding: 4px 10px;
  border-radius: 50px;
}

.menu-badge-pill.badge-teal {
  background: rgba(0, 98, 93, 0.9);
  color: #ffffff;
}

.menu-badge-pill.badge-gold {
  background: rgba(195, 153, 108, 0.95);
  color: #ffffff;
}

.menu-badge-pill.badge-danger {
  background: #e63946;
  color: #ffffff;
}

.menu-badge-pill.badge-dark {
  background: #212529;
  color: #ffffff;
}

.menu-card-quick-order {
  position: absolute;
  bottom: 12px;
  right: 12px;
  z-index: 2;
}

.btn-quick-add {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: #ffffff;
  color: var(--santino-teal, #00625d);
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  transition: all 0.2s ease;
  cursor: pointer;
}

.btn-quick-add:hover {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  transform: scale(1.1);
}

.menu-card-body {
  padding: 18px;
  display: flex;
  flex-direction: column;
  flex: 1;
}

.menu-taste-notes {
  font-size: 11.5px;
  font-weight: 700;
  color: var(--santino-teal, #00625d);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 4px;
}

.menu-item-name {
  font-size: 1.15rem;
  font-weight: 800;
  color: #111111;
  margin-bottom: 6px;
  line-height: 1.3;
}

.menu-item-desc {
  font-size: 0.88rem;
  color: #6c757d;
  line-height: 1.5;
  margin-bottom: 0;
  flex: 1;
}

.menu-item-price {
  font-size: 1.25rem;
  font-weight: 900;
  color: #111111;
  font-family: var(--kp-font-title, 'Montserrat', sans-serif);
}

.btn-customize-pill {
  background: rgba(0, 98, 93, 0.08);
  color: var(--santino-teal, #00625d);
  border: 1px solid rgba(0, 98, 93, 0.2);
  padding: 6px 14px;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s ease;
}

.btn-customize-pill:hover {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
}
</style>

<div class="menu-page-wrap">

  <!-- 1. HERO HEADER & LIVE SEARCH -->
  <section class="py-4 bg-white position-relative">
    <div class="floating-bg-icons">
      <i class="bi bi-cup-hot" style="top: 15%; left: 3%; font-size: 45px;"></i>
      <i class="bi bi-flower1" style="top: 60%; right: 4%; font-size: 40px;"></i>
    </div>

    <div class="container position-relative" style="z-index: 1;">
      
      <div class="row align-items-center mb-4 g-3 reveal">
        <div class="col-lg-6">
          <div class="sec-pill-badge-wrap mb-2">
            <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> SANTINO SIGNATURE CAFE MENU</span>
          </div>
          <h1 class="sec-title mb-2">Artisan Coffee &amp; <span class="sec-title-accent">Beverage Menu</span></h1>
          <p class="sec-description mb-0">Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.</p>
        </div>
        <div class="col-lg-6">
          <div class="portal-lookup-group shadow-sm">
            <div class="portal-lookup-field">
              <i class="bi bi-search"></i>
              <input type="text" id="menuSearchInput" placeholder="Search cappuccino, mocha, frappe, latte, croissant...">
            </div>
            <button class="btn btn-outline-secondary border-0 d-none" id="clearSearchBtn" style="width: 32px; height: 32px; padding: 0; margin-right: 4px;" aria-label="Clear"><i class="bi bi-x-circle-fill"></i></button>
            <button type="button" class="btn-lookup-action" id="menuSearchActionBtn" aria-label="Search">
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- 5 Category Visual Banners (Preserved) -->
      <div class="luckin-category-banners-container reveal">
        
        <a href="javascript:void(0)" onclick="filterByCategory('signature-lattes')" class="luckin-banner-card hover-lift">
          <img src="<?php echo santino_img('banner-signature-lattes.jpg'); ?>" alt="Signature Lattes">
        </a>

        <a href="javascript:void(0)" onclick="filterByCategory('barista-coffee')" class="luckin-banner-card hover-lift">
          <img src="<?php echo santino_img('banner-barista-coffee.jpg'); ?>" alt="BARISTA COFFEE">
        </a>

        <a href="javascript:void(0)" onclick="filterByCategory('fruity-americano')" class="luckin-banner-card hover-lift">
          <img src="<?php echo santino_img('banner-fruity-americano.jpg'); ?>" alt="FRUITY AMERICANO">
        </a>

        <a href="javascript:void(0)" onclick="filterByCategory('soe-espresso')" class="luckin-banner-card hover-lift">
          <img src="<?php echo santino_img('banner-soe-espresso.jpg'); ?>" alt="Single Origin Espresso">
        </a>

        <a href="javascript:void(0)" onclick="filterByCategory('matcha-tea')" class="luckin-banner-card hover-lift">
          <img src="<?php echo santino_img('banner-matcha-tea.jpg'); ?>" alt="Matcha">
        </a>

      </div>

    </div>
  </section>

  <!-- 2. STICKY CATEGORY FILTER BAR -->
  <nav class="menu-category-sticky-bar" id="categoryStickyBar">
    <div class="container">
      <div class="category-tabs-wrapper d-flex align-items-center gap-2">
        <button class="btn-cat-tab active" data-filter="all">
          <i class="bi bi-grid-fill"></i> All Items
        </button>
        <button class="btn-cat-tab" data-filter="signature-lattes">
          <i class="bi bi-cup-hot-fill"></i> Signature Lattes
        </button>
        <button class="btn-cat-tab" data-filter="barista-coffee">
          <i class="bi bi-cup-straw"></i> Barista Classics
        </button>
        <button class="btn-cat-tab" data-filter="fruity-americano">
          <i class="bi bi-lightning-charge-fill"></i> Fruity Americano
        </button>
        <button class="btn-cat-tab" data-filter="soe-espresso">
          <i class="bi bi-award-fill"></i> Single Origin (SOE)
        </button>
        <button class="btn-cat-tab" data-filter="matcha-tea">
          <i class="bi bi-flower1"></i> Matcha &amp; Frappe
        </button>
        <button class="btn-cat-tab" data-filter="bakery">
          <i class="bi bi-pie-chart-fill"></i> Gourmet Bakery
        </button>
      </div>
    </div>
  </nav>

  <!-- 3. ALL HANDCRAFTED ITEMS GRID -->
  <section class="menu-items-section py-5" id="menuGridSection">
    <div class="container">
      
      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 reveal">
        <div>
          <div class="sec-pill-badge-wrap mb-1">
            <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> FRESHLY BREWED</span>
          </div>
          <h2 class="sec-title mb-1" id="currentCategoryHeading">All Handcrafted <span class="sec-title-accent">Items</span></h2>
          <div class="sec-description text-muted small" id="itemsCountText">Showing specialty beverages and gourmet items</div>
        </div>
        
        <div class="d-flex gap-2 align-items-center">
          <select id="dietaryFilter" class="form-select form-select-sm" style="width: auto; border-radius: 50px; font-weight: 600; padding: 6px 16px; border: 1.5px solid #d5e5e0;">
            <option value="all">All Options</option>
            <option value="iced">Iced Only</option>
            <option value="hot">Hot Only</option>
            <option value="bestseller">Bestseller</option>
            <option value="plantbased">Plant-Based / Oat</option>
          </select>
        </div>
      </div>

      <div class="row g-4" id="menuItemsGrid">
      </div>

      <div id="noResultsBox" class="text-center py-5 d-none">
        <i class="bi bi-cup-straw text-muted" style="font-size: 4rem;"></i>
        <h4 class="mt-3 fw-bold">No matching drinks found</h4>
        <p class="text-muted">Try searching with different keywords or clear the category filters.</p>
        <button class="btn btn-outline-dark px-4 py-2 mt-2 rounded-pill" id="resetFiltersBtn">Reset Filters</button>
      </div>

    </div>
  </section>

  <!-- 4. OFFICIAL HERO ITEMS & VIP REWARD POSTER -->
  <section class="py-5" style="background: linear-gradient(135deg, #0f2723 0%, #004d49 100%);">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-5 text-center text-lg-start">
          <div class="sec-pill-badge-wrap mb-3">
            <span class="sec-pill-badge" style="background: rgba(195, 153, 108, 0.2); color: #dfbe8d; border-color: rgba(195, 153, 108, 0.4);">
              <i class="bi bi-gem me-1" style="color: #dfbe8d;"></i> SANTINO HERO ITEMS
            </span>
          </div>
          <h2 class="sec-title text-white mb-3">Premium Beans, <span style="color: #dfbe8d;">Hot &amp; Cold Hero Brews</span></h2>
          <p class="text-white-50 mb-4" style="font-size: 1.05rem; line-height: 1.7;">
            Explore our barista favorites including Hot Cappuccino, Iced Latte, Rich Hot Mocha, Iced Mocha, and ice-blended Frappes crafted with 100% premium roasted beans.
          </p>
          <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
            <a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="btn-hero-lifestyle" style="background: #dfbe8d !important; border-color: #dfbe8d !important; color: #0d2622 !important;">
              <i class="bi bi-gift-fill me-1"></i> Buy 5 Get 6th Free
            </a>
            <a href="#menuGridSection" class="btn-hero-outline">
              <i class="bi bi-cup-hot-fill me-1"></i> Explore Full Menu
            </a>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="rounded-4 overflow-hidden shadow-lg border border-white-10 text-center" style="max-height: 480px; background: #000;">
            <img src="<?php echo santino_img('santino-hero-poster.jpg'); ?>" alt="Santino Coffee Hero Menu Poster" class="w-100 h-100 object-fit-contain" style="max-height: 480px;">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 5. APP DOWNLOAD BANNER -->
  <section class="app-download-section reveal">
    <div class="container">
      <div class="app-download-card">
        <div class="row align-items-center g-4 text-center text-lg-start">
          <div class="col-lg-7">
            <span class="app-badge-tag"><i class="bi bi-phone"></i> MOBILE REWARDS &amp; ORDERING</span>
            <h3 class="app-card-title">Download the Santino Coffee App</h3>
            <p class="app-card-sub mb-0">
              Save time with swift order pickup, earn reward beans on every roast, and access exclusive member privileges.
            </p>
          </div>
          <div class="col-lg-5 text-center text-lg-end">
            <div class="d-inline-flex flex-wrap gap-3 justify-content-center justify-content-lg-end align-items-center">
              <a href="https://play.google.com" target="_blank" class="app-store-badge-btn">
                <i class="bi bi-google-play text-white"></i>
                <div class="text-start">
                  <span class="badge-text-top">GET IT ON</span>
                  <strong class="badge-text-main">Google Play</strong>
                </div>
              </a>
              <a href="https://apps.apple.com" target="_blank" class="app-store-badge-btn">
                <i class="bi bi-apple text-white"></i>
                <div class="text-start">
                  <span class="badge-text-top">Download on the</span>
                  <strong class="badge-text-main">App Store</strong>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 6. EXPERIENCE HUBS LOCATOR -->
  <section class="cafe-branches-section py-5" id="branches" style="background-color: #fff9f3;">
    <div class="container">
      
      <div class="sec-heading-center text-center mb-5 reveal">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill text-danger me-1"></i> EXPERIENCE SANTINO NATIONWIDE</span>
        </div>
        <h2 class="sec-title mb-2">Our Cafes &amp; <span class="sec-title-accent">Roastery Hubs</span></h2>
        <div class="sec-description">Step into an artisan coffee retreat or visit our partner express bars across prime Dhaka locations</div>
      </div>

      <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 reveal">
        <button class="branch-filter-btn active" data-branch-filter="all">All Locations (6)</button>
        <button class="branch-filter-btn" data-branch-filter="gulshan">Gulshan &amp; Banani</button>
        <button class="branch-filter-btn" data-branch-filter="dhanmondi">Dhanmondi</button>
        <button class="branch-filter-btn" data-branch-filter="uttara">Uttara</button>
        <button class="branch-filter-btn" data-branch-filter="tejgaon">Tejgaon Roastery</button>
      </div>

      <div class="row g-4" id="branchesGrid">
        
        <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="100" data-region="gulshan">
          <div class="branch-card hover-lift">
            <div class="branch-card-img" style="background-image: url('<?php echo function_exists('santino_get_page_banner') ? santino_get_page_banner('menu', 'banner-signature-lattes.jpg') : santino_img('banner-signature-lattes.jpg'); ?>')";">
              <span class="branch-tag-badge">FLAGSHIP EXPERIENCE</span>
            </div>
            <div class="branch-card-body">
              <h3 class="branch-title">Santino Experience Hub | Gulshan-2</h3>
              <p class="branch-desc text-muted small mb-3">State-of-the-art Victoria Arduino espresso bar, cupping lounge &amp; VIP meeting rooms.</p>
              
              <div class="branch-info-list">
                <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Plot 11, Road 48, CWN Block, Gulshan-2, Dhaka 1212</span></div>
                <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Sat – Thurs: 7:30 AM – 11:00 PM | Fri: 8:00 AM – 11:30 PM</span></div>
                <div class="info-line"><i class="bi bi-p-circle text-success"></i> <span>Valet &amp; Underground Parking Available • Free High-Speed WiFi</span></div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <a href="https://maps.google.com" target="_blank" class="btn-prod-outline flex-fill">
                  <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                </a>
                <a href="tel:+8801613334514" class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;">
                  <i class="bi bi-cup-hot-fill me-1"></i> Visit Cafe
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="200" data-region="gulshan">
          <div class="branch-card hover-lift">
            <div class="branch-card-img" style="background-image: url('<?php echo santino_img('imgi_26_santino_-_250522-07312.jpg'); ?>');">
              <span class="branch-tag-badge">COMMERCIAL HUB</span>
            </div>
            <div class="branch-card-body">
              <h3 class="branch-title">Borak Mehnur Tower | Banani</h3>
              <p class="branch-desc text-muted small mb-3">Located on Kamal Ataturk Avenue with vibrant outdoor seating and grab-and-go bar.</p>
              
              <div class="branch-info-list">
                <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Plot 51/B, Kamal Ataturk Avenue, Banani Commercial Area, Dhaka</span></div>
                <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Daily: 7:00 AM – 10:30 PM</span></div>
                <div class="info-line"><i class="bi bi-p-circle text-success"></i> <span>Building Parking • Outdoor Terrace • Takeaway Window</span></div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <a href="https://maps.google.com" target="_blank" class="btn-prod-outline flex-fill">
                  <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                </a>
                <a href="tel:+8801613334514" class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;">
                  <i class="bi bi-cup-hot-fill me-1"></i> Visit Cafe
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="300" data-region="dhanmondi">
          <div class="branch-card hover-lift">
            <div class="branch-card-img" style="background-image: url('<?php echo santino_img('imgi_27_santino_-_250522-07216.jpg'); ?>');">
              <span class="branch-tag-badge">LIFESTYLE CAFE</span>
            </div>
            <div class="branch-card-body">
              <h3 class="branch-title">Santino Cafe | Dhanmondi 27</h3>
              <p class="branch-desc text-muted small mb-3">Quiet study ambiance, artisan pourover coffee station, and fresh bakery pastries.</p>
              
              <div class="branch-info-list">
                <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>House 14, Road 27 (Old), Dhanmondi, Dhaka 1209</span></div>
                <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Daily: 8:00 AM – 11:00 PM</span></div>
                <div class="info-line"><i class="bi bi-p-circle text-success"></i> <span>Dedicated Power Sockets • Quiet Work Zones</span></div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <a href="https://maps.google.com" target="_blank" class="btn-prod-outline flex-fill">
                  <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                </a>
                <a href="tel:+8801613334514" class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;">
                  <i class="bi bi-cup-hot-fill me-1"></i> Visit Cafe
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 7. ITEM CUSTOMIZATION MODAL -->
  <div class="modal fade" id="itemCustomModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content rounded-4 border-0 overflow-hidden shadow-lg">
        
        <div class="modal-header border-0 pb-0">
          <div>
            <span class="badge-theme-teal mb-1" id="modalItemTag">HERO ITEM</span>
            <h3 class="modal-title font-heading fw-bold text-dark mt-1" id="modalItemTitle">Drink Title</h3>
            <div class="text-muted small" id="modalItemCalories">180 kcal</div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body pt-3">
          <div class="row g-4">
            
            <div class="col-md-5 text-center">
              <div class="rounded-4 overflow-hidden shadow-sm mb-3" style="height: 220px; background: #f8f9fa;">
                <img id="modalItemImg" src="" alt="Drink" class="w-100 h-100 object-fit-cover">
              </div>
              <p class="text-muted small text-start" id="modalItemDescription">Drink description...</p>
              <div class="p-3 bg-light rounded-3 text-start">
                <div class="text-muted small">Base Price:</div>
                <div class="fs-4 fw-black font-heading text-dark" id="modalItemPrice">৳ 0</div>
              </div>
            </div>

            <div class="col-md-7">
              <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase" style="letter-spacing: 0.5px;">1. Size</label>
                <div class="d-flex gap-2">
                  <input type="radio" class="btn-check" name="sizeOption" id="sizeRegular" value="Regular" checked>
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="sizeRegular">Regular Size</label>
                  
                  <input type="radio" class="btn-check" name="sizeOption" id="sizeLarge" value="Large">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="sizeLarge">Large Size</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase" style="letter-spacing: 0.5px;">2. Temperature</label>
                <div class="d-flex gap-2">
                  <input type="radio" class="btn-check" name="tempOption" id="tempIced" value="Iced" checked>
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="tempIced"><i class="bi bi-snow me-1"></i> Iced (Standard)</label>
                  
                  <input type="radio" class="btn-check" name="tempOption" id="tempHot" value="Hot">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="tempHot"><i class="bi bi-cup-hot me-1"></i> Hot</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase" style="letter-spacing: 0.5px;">3. Sweetness</label>
                <div class="d-flex gap-2 flex-wrap">
                  <input type="radio" class="btn-check" name="sweetOption" id="sw100" value="100% Regular" checked>
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw100">100% Regular</label>
                  
                  <input type="radio" class="btn-check" name="sweetOption" id="sw70" value="70% Less">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw70">70% Less</label>
                  
                  <input type="radio" class="btn-check" name="sweetOption" id="sw0" value="0% Sugar">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw0">0% Sugar</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase" style="letter-spacing: 0.5px;">4. Milk Selection</label>
                <div class="d-flex gap-2 flex-wrap">
                  <input type="radio" class="btn-check" name="milkOption" id="milkFresh" value="Fresh Farm Milk" checked>
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkFresh">Fresh Milk (+৳0)</label>
                  
                  <input type="radio" class="btn-check" name="milkOption" id="milkOat" value="Oat Milk (+৳50)">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkOat">Oat (+৳50)</label>
                  
                  <input type="radio" class="btn-check" name="milkOption" id="milkCoconut" value="Coconut Milk (+৳40)">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkCoconut">Coconut (+৳40)</label>
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center mb-4 pt-2">
                <label class="form-label small fw-bold text-uppercase mb-0" style="letter-spacing: 0.5px;">Quantity</label>
                <div class="d-flex align-items-center gap-2">
                  <button type="button" class="btn btn-outline-dark btn-sm rounded-circle" id="qtyMinusBtn" style="width: 32px; height: 32px; padding: 0;">-</button>
                  <span class="fw-bold px-2 font-heading" id="modalQtyDisplay">1</span>
                  <button type="button" class="btn btn-outline-dark btn-sm rounded-circle" id="qtyPlusBtn" style="width: 32px; height: 32px; padding: 0;">+</button>
                </div>
              </div>

              <button type="button" class="btn-hero-lifestyle w-100 py-3" id="modalAddToCartBtn">
                Add To Order • <span id="modalTotalCalculate">৳ 0</span>
              </button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- 8. SHOPPING ORDER OFFCANVAS -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title font-heading fw-bold"><i class="bi bi-cart3 me-2" style="color: var(--santino-teal);"></i> Your Santino Order</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
      
      <div id="cartItemsList" class="d-flex flex-column gap-3 overflow-auto">
        <div id="emptyCartMessage" class="text-center py-5 text-muted">
          <i class="bi bi-cart-x fs-1 text-muted"></i>
          <p class="mt-2 mb-0">Your order is currently empty</p>
        </div>
      </div>

      <div class="pt-3 border-top" id="cartFooterBox" style="display: none;">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Total Payable:</span>
          <span class="fw-black font-heading fs-5" style="color: var(--santino-teal);" id="cartTotalPayable">৳ 0</span>
        </div>
        <button class="btn-hero-lifestyle w-100 py-3" onclick="alert('Thank you for ordering with Santino Caffè! Please show this confirmation to your barista.');">
          Proceed To Checkout →
        </button>
      </div>

    </div>
  </div>

</div>

<?php
endif;
get_footer();
