<?php
/**
 * Template Name: Shwapno Retail Coffee Page
 *
 * @package Santino
 */

/**
 * Template Name: Santino Shwapno Retail Coffee
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

if ( class_exists( '\Elementor\Plugin' ) && ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
else :
?>

<!-- MINIMAL CLEAN SHWAPNO HERO BANNER -->
  <section class="pro-banner-hero pro-banner-swapno" style="background-image: url('<?php echo santino_img('shwapno_santino_retail.jpg'); ?>'); background-position: center 35%; min-height: 52vh;">
    <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.18) 0%, rgba(11, 21, 20, 0.45) 100%);"></div>
    <div class="pro-banner-glow-line"></div>
    
    <div class="container pro-banner-container" style="max-width: 680px;">
      
      <!-- Live Partnership Trust Pill -->
      <div class="pro-banner-pill mb-3">
        <span class="pro-pulse-dot"></span>
        <span>OFFICIAL RETAIL PARTNER</span>
      </div>

      <!-- Main Heading -->
      <h1 class="pro-banner-title mb-2">
        Shwapno × Santino Retail Coffee
      </h1>

      <!-- Lead Description -->
      <p class="pro-banner-desc mb-4" style="max-width: 520px; font-size: 1.05rem;">
        Freshly roasted specialty coffee bean packs available on aisles across 100+ Shwapno Superstores.
      </p>

      <!-- Action Buttons -->
      <div class="pro-banner-actions">
        <a href="#store-locator" class="btn-hero-lifestyle">
          <i class="bi bi-geo-alt-fill me-1"></i>
          <span>Find Nearest Shwapno</span>
        </a>
        <a href="#swapno-gallery" class="btn-hero-outline">
          <i class="bi bi-images me-1 text-gold"></i>
          <span>View Retail Gallery</span>
        </a>
      </div>

    </div>
  </section>

  <!-- CLEAN SUBTLE STATS STRIP BELOW HERO -->
  <section class="py-4 border-bottom bg-white">
    <div class="container">
      <div class="row g-4 text-center justify-content-center">
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black font-heading" style="color: #d90429;">100+</div>
          <div class="small text-muted fw-bold text-uppercase">Superstore Shelves</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">Weekly</div>
          <div class="small text-muted fw-bold text-uppercase">Fresh Batch Dispatch</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black font-heading" style="color: var(--santino-teal);">100%</div>
          <div class="small text-muted fw-bold text-uppercase">Nitrogen Degassing Pack</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black font-heading" style="color: var(--santino-gold);">On-Demand</div>
          <div class="small text-muted fw-bold text-uppercase">In-Store Grinding Booths</div>
        </div>
      </div>
    </div>
  </section>

  <!-- 1. RICH EDITORIAL PHOTOGRAPHY SHOWCASE -->
  <section id="swapno-gallery" class="py-5" style="background-color: #08100f; color: #ffffff;">
    <div class="container py-lg-4">
      
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="editorial-gallery-badge justify-content-center mb-2"><i class="bi bi-camera-fill me-1"></i> RETAIL EXPERIENCE</span>
        <h2 class="display-6 fw-bold text-white font-heading">Inside Shwapno × Santino Retail Craft</h2>
        <p class="text-white-50 small">Fresh roasted bags, one-way degassing valves, and in-store grinding experience across 100+ supermarket aisles.</p>
      </div>

      <!-- Modern Seamless Gallery Layout -->
      <div class="row g-4">
        
        <!-- Large Feature 1 (7 cols) -->
        <div class="col-lg-7">
          <div class="editorial-gallery-item" style="min-height: 380px;">
            <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="Shwapno Supermarket Coffee Shelf" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge"><i class="bi bi-cart3"></i> Supermarket Aisle</span>
              <h3 class="editorial-gallery-title">Nationwide Superstore Presence</h3>
              <p class="editorial-gallery-desc">Dedicated premium coffee displays in 100+ Shwapno branches bringing freshly roasted Singapore beans directly to home brewers.</p>
            </div>
          </div>
        </div>

        <!-- Large Feature 2 (5 cols) -->
        <div class="col-lg-5">
          <div class="editorial-gallery-item" style="min-height: 380px;">
            <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Artisan Batch Roastery" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge" style="color: #ffd166;"><i class="bi bi-fire"></i> Weekly Fresh Batches</span>
              <h3 class="editorial-gallery-title">Direct Roastery Logistics</h3>
              <p class="editorial-gallery-desc">Weekly dispatch directly from our roastery ensuring beans on retail shelves are always within their optimal aroma window.</p>
            </div>
          </div>
        </div>

        <!-- Tile 3 (4 cols) -->
        <div class="col-md-6 col-lg-4">
          <div class="editorial-gallery-item" style="min-height: 280px;">
            <img src="<?php echo santino_img('imgi_22_Untitleddesign_4.png'); ?>" alt="Nitrogen Sealed Packaging" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge" style="color: #64dfdf;"><i class="bi bi-shield-check"></i> Nitrogen Degassing</span>
              <h3 class="editorial-gallery-title">Aroma Lock Pouches</h3>
              <p class="editorial-gallery-desc">Foil-lined pouches with Italian one-way degassing valves preserve complex volatile crema oils.</p>
            </div>
          </div>
        </div>

        <!-- Tile 4 (4 cols) -->
        <div class="col-md-6 col-lg-4">
          <div class="editorial-gallery-item" style="min-height: 280px;">
            <img src="<?php echo santino_img('imgi_30_Blue-Stone-3_800x_526184df-2650-40b7-9dcf-e8af5b97527b.webp'); ?>" alt="In-Store Precision Grinding" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge" style="color: #06d6a0;"><i class="bi bi-sliders"></i> Complimentary Service</span>
              <h3 class="editorial-gallery-title">In-Store Precision Grinding</h3>
              <p class="editorial-gallery-desc">Free calibrated grinding at flagship booths for French Press, Pour Over, Moka Pot, or Espresso.</p>
            </div>
          </div>
        </div>

        <!-- Tile 5 (4 cols) -->
        <div class="col-md-12 col-lg-4">
          <div class="editorial-gallery-item" style="min-height: 280px;">
            <img src="<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>" alt="Weekend Cupping & Tasting" class="editorial-gallery-img">
            <div class="editorial-gallery-overlay">
              <span class="editorial-gallery-badge" style="color: #ffb703;"><i class="bi bi-cup-hot-fill"></i> Tasting Experience</span>
              <h3 class="editorial-gallery-title">Weekend In-Store Cupping</h3>
              <p class="editorial-gallery-desc">Live barista brewing and free espresso tasting sessions for Shwapno Club members every weekend.</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 2. RETAIL BEAN PACKS CATALOG -->
  <section id="retail-packs" class="py-5 bg-white">
    <div class="container py-lg-4">
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="badge-tag-pill mb-2"><i class="bi bi-bag-check-fill text-gold me-1"></i> RETAIL PACK COLLECTION</span>
        <h2 class="sec-title">Santino Coffee On Shwapno Shelves</h2>
        <div class="sec-subtitle">Available in Whole Bean & Fresh Pre-Ground Variants across all 100+ branches</div>
      </div>

      <div class="row g-4">
        
        <!-- Product 1 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-4 text-center hover-lift">
            <div class="p-3 bg-light rounded-4 mb-3 d-flex align-items-center justify-content-center" style="height: 190px;">
              <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Santino Espresso Italia" class="img-fluid rounded-3" style="max-height: 160px; object-fit: cover;">
            </div>
            <span class="badge bg-dark rounded-pill mx-auto mb-2 px-3 py-1">Best Seller</span>
            <h5 class="fw-bold mb-1 font-heading">Signature Espresso Blend</h5>
            <p class="small text-muted mb-2">Dark Chocolate & Roasted Almond Notes</p>
            <div class="small text-secondary mb-3"><i class="bi bi-bag-check me-1"></i> Available: 250g | 500g</div>
            <div class="mt-auto fw-bold fs-5 text-dark">৳ 650 <span class="small text-muted fw-normal">/ 250g</span></div>
          </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-4 text-center hover-lift">
            <div class="p-3 bg-light rounded-4 mb-3 d-flex align-items-center justify-content-center" style="height: 190px;">
              <img src="<?php echo santino_img('imgi_140_santino_-_250522-07574.jpg'); ?>" alt="Colombia Supremo" class="img-fluid rounded-3" style="max-height: 160px; object-fit: cover;">
            </div>
            <span class="badge bg-success rounded-pill mx-auto mb-2 px-3 py-1">100% Arabica Single Origin</span>
            <h5 class="fw-bold mb-1 font-heading">Colombia Supremo</h5>
            <p class="small text-muted mb-2">Caramel, Brown Sugar & Citrus Acidity</p>
            <div class="small text-secondary mb-3"><i class="bi bi-bag-check me-1"></i> Available: 250g | 500g</div>
            <div class="mt-auto fw-bold fs-5 text-dark">৳ 850 <span class="small text-muted fw-normal">/ 250g</span></div>
          </div>
        </div>

        <!-- Product 3 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-4 text-center hover-lift">
            <div class="p-3 bg-light rounded-4 mb-3 d-flex align-items-center justify-content-center" style="height: 190px;">
              <img src="<?php echo santino_img('imgi_100_05_Sustainability-e1750424125646.jpg'); ?>" alt="Mocha Italia Roast" class="img-fluid rounded-3" style="max-height: 160px; object-fit: cover;">
            </div>
            <span class="badge bg-warning text-dark rounded-pill mx-auto mb-2 px-3 py-1">Velvety & Full-Bodied</span>
            <h5 class="fw-bold mb-1 font-heading">Mocha Italia Roast</h5>
            <p class="small text-muted mb-2">Hazelnut, Molasses & Cocoa Crema</p>
            <div class="small text-secondary mb-3"><i class="bi bi-bag-check me-1"></i> Available: 250g | 500g | 1kg</div>
            <div class="mt-auto fw-bold fs-5 text-dark">৳ 720 <span class="small text-muted fw-normal">/ 250g</span></div>
          </div>
        </div>

        <!-- Product 4 -->
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-4 text-center hover-lift">
            <div class="p-3 bg-light rounded-4 mb-3 d-flex align-items-center justify-content-center" style="height: 190px;">
              <img src="<?php echo santino_img('imgi_19_santino_-_250522-07313.jpg'); ?>" alt="Barista Gold Edition" class="img-fluid rounded-3" style="max-height: 160px; object-fit: cover;">
            </div>
            <span class="badge bg-danger rounded-pill mx-auto mb-2 px-3 py-1">Limited Batch</span>
            <h5 class="fw-bold mb-1 font-heading">Barista Gold Edition</h5>
            <p class="small text-muted mb-2">Ethiopian Yirgacheffe & Java Floral Notes</p>
            <div class="small text-secondary mb-3"><i class="bi bi-bag-check me-1"></i> Available: 250g</div>
            <div class="mt-auto fw-bold fs-5 text-dark">৳ 950 <span class="small text-muted fw-normal">/ 250g</span></div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 3. STORE LOCATOR WITH SEARCH & AREA FILTERS -->
  <section id="store-locator" class="py-5" style="background-color: #f8faf9;">
    <div class="container py-lg-4">
      
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="badge-tag-pill mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> SUPERSTORE LOCATOR</span>
        <h2 class="sec-title">Find Santino Shelves At 100+ Shwapno Outlets</h2>
        <div class="sec-subtitle">Search by area, road, or filter by division to find your nearest fresh coffee stock</div>
      </div>

      <!-- Search Bar & Filters -->
      <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
          <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white p-1 border">
            <span class="input-group-text bg-transparent border-0 ps-3"><i class="bi bi-search text-muted"></i></span>
            <input type="text" id="shwapnoSearchInput" class="form-control border-0 shadow-none" placeholder="Search branch (e.g. Gulshan, Banani, Dhanmondi, Uttara, Chattogram, Sylhet)..." onkeyup="filterShwapnoOutlets()">
            <button class="btn btn-dark rounded-pill px-4 fw-bold" type="button" style="background-color: #d90429; border: none;" onclick="filterShwapnoOutlets()">Search</button>
          </div>
        </div>
      </div>

      <!-- Zone Filter Pills -->
      <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
        <button class="branch-filter-btn active" onclick="filterShwapnoZone('all', this)">All Superstores (12)</button>
        <button class="branch-filter-btn" onclick="filterShwapnoZone('dhaka-north', this)">Dhaka North (Gulshan, Banani, Uttara)</button>
        <button class="branch-filter-btn" onclick="filterShwapnoZone('dhaka-south', this)">Dhaka South (Dhanmondi, Mogbazar)</button>
        <button class="branch-filter-btn" onclick="filterShwapnoZone('chattogram', this)">Chattogram</button>
        <button class="branch-filter-btn" onclick="filterShwapnoZone('sylhet', this)">Sylhet & Other</button>
      </div>

      <!-- 12 Detailed Shwapno Superstore Branch Cards -->
      <div class="row g-4" id="shwapnoOutletGrid">
        
        <!-- Outlet 1 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north gulshan">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-danger bg-opacity-10 text-danger"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock + Grinder</span>
            </div>
            <h4 class="branch-title">Shwapno Flagship Gulshan 1</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>South Avenue, Gulshan 1 Circle, Dhaka 1212</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000001</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Gulshan+1" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 2 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north banani">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-danger bg-opacity-10 text-danger"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock</span>
            </div>
            <h4 class="branch-title">Shwapno Superstore Banani 11</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Road 11, Block E, Banani, Dhaka 1213</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000002</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Banani+11" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 3 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-south dhanmondi">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-primary bg-opacity-10 text-primary"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA SOUTH</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock + Grinder</span>
            </div>
            <h4 class="branch-title">Shwapno Dhanmondi 27</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Old 27 (New 16), Satmasjid Road, Dhanmondi, Dhaka</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000003</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Dhanmondi+27" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 4 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north uttara">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-danger bg-opacity-10 text-danger"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock</span>
            </div>
            <h4 class="branch-title">Shwapno Uttara Sector 3</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Rabindra Sarani, Sector 3, Uttara, Dhaka 1230</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000004</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Uttara+Sector+3" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 5 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north mirpur">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-danger bg-opacity-10 text-danger"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock</span>
            </div>
            <h4 class="branch-title">Shwapno Mirpur 1</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Sony Cinema Hall Circle, Mirpur 1, Dhaka 1216</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:00 AM – 10:30 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000005</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Mirpur+1" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 6 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-south mogbazar">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-primary bg-opacity-10 text-primary"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA SOUTH</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock</span>
            </div>
            <h4 class="branch-title">Shwapno Mogbazar Wireless</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Wireless Gate, Outer Circular Road, Mogbazar, Dhaka</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:30 AM – 11:00 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000006</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Mogbazar" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 7 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="chattogram khulshi">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-warning bg-opacity-10 text-dark"><i class="bi bi-geo-alt-fill me-1"></i> CHATTOGRAM</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock + Grinder</span>
            </div>
            <h4 class="branch-title">Shwapno Khulshi Town Center</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Zakir Hossain Road, South Khulshi, Chattogram</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:30 AM – 10:30 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000007</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Khulshi+Chattogram" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 8 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="chattogram nasirabad">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-warning bg-opacity-10 text-dark"><i class="bi bi-geo-alt-fill me-1"></i> CHATTOGRAM</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock</span>
            </div>
            <h4 class="branch-title">Shwapno Nasirabad GEC</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>CDA Avenue, GEC Circle, Nasirabad, Chattogram</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:30 AM – 10:30 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000008</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+GEC+Chattogram" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 9 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="sylhet zindabazar">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-info bg-opacity-10 text-info"><i class="bi bi-geo-alt-fill me-1"></i> SYLHET</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock</span>
            </div>
            <h4 class="branch-title">Shwapno Sylhet Zindabazar</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Al Hamra Shopping City, Zindabazar, Sylhet 3100</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 9:00 AM – 10:30 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000009</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Zindabazar+Sylhet" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 10 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="sylhet kumarpara">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-info bg-opacity-10 text-info"><i class="bi bi-geo-alt-fill me-1"></i> SYLHET</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock</span>
            </div>
            <h4 class="branch-title">Shwapno Sylhet Kumarpara</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Kumarpara Main Road, Sylhet 3100</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 9:00 AM – 10:30 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000010</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Kumarpara+Sylhet" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 11 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-south narayanganj">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-primary bg-opacity-10 text-primary"><i class="bi bi-geo-alt-fill me-1"></i> NARAYANGANJ</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock</span>
            </div>
            <h4 class="branch-title">Shwapno Chashara Narayanganj</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Bangabandhu Road, Chashara, Narayanganj</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:30 AM – 10:30 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000011</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Chashara" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

        <!-- Outlet 12 -->
        <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north bashundhara">
          <div class="branch-card-pro">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="branch-badge bg-danger bg-opacity-10 text-danger"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
              <span class="badge bg-success bg-opacity-10 text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i> Full Stock + Grinder</span>
            </div>
            <h4 class="branch-title">Shwapno Bashundhara R/A</h4>
            <div class="branch-info-list mb-3">
              <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Block C, Main Gate Avenue, Bashundhara R/A, Dhaka</span></div>
              <div class="info-line"><i class="bi bi-clock text-muted"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
              <div class="info-line"><i class="bi bi-telephone text-muted"></i> <span>Hotline: +880 1700-000012</span></div>
            </div>
            <div class="d-flex gap-2 pt-2 border-top">
              <a href="https://maps.google.com/?q=Shwapno+Bashundhara" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
              <button class="btn btn-light btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal"><i class="bi bi-info-circle"></i></button>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- FOOTER -->

<?php\n<?php
endif;
get_footer();
