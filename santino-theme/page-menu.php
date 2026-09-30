<?php
/**
 * Template Name: Santino Beverage & Cafe Menu
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

<section class="py-4 bg-white">
    <div class="container">
      
      <div class="row align-items-center mb-4 g-3 reveal">
        <div class="col-lg-6">
          <h1 class="display-6 font-heading fw-black text-dark mb-1">Artisan Coffee & Beverage Menu</h1>
          <p class="text-muted small mb-0">Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.</p>
        </div>
        <div class="col-lg-6">
          <div class="input-group input-group-lg shadow-sm rounded-4 overflow-hidden border">
            <span class="input-group-text bg-white border-0 text-muted ps-3"><i class="bi bi-search"></i></span>
            <input type="text" id="menuSearchInput" class="form-control border-0 ps-2 fs-6" placeholder="Search coconut latte, SOE, fruity americano, matcha...">
            <button class="btn btn-outline-secondary border-0 d-none" id="clearSearchBtn"><i class="bi bi-x-circle-fill"></i></button>
          </div>
        </div>
      </div>

      <div class="luckin-category-banners-container reveal">
        
        <a href="javascript:void(0)" onclick="filterByCategory('signature-lattes')" class="luckin-banner-card hover-lift">
          <img src="https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/0c267af7-c7a5-409d-8a26-c9bc946929ef.jpg" alt="Signature Lattes">
        </a>

        <a href="javascript:void(0)" onclick="filterByCategory('barista-coffee')" class="luckin-banner-card hover-lift">
          <img src="https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/b4f10758-5b47-4370-b56e-02aff9c28592.jpg" alt="BARISTA COFFEE">
        </a>

        <a href="javascript:void(0)" onclick="filterByCategory('fruity-americano')" class="luckin-banner-card hover-lift">
          <img src="https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/f4e2baf8-013d-4d1c-9756-4e02e02a8b69.jpg" alt="FRUITY AMERICANO">
        </a>

        <a href="javascript:void(0)" onclick="filterByCategory('soe-espresso')" class="luckin-banner-card hover-lift">
          <img src="https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/ebbcbccb-3cec-42c1-b53a-8994f5f80597.jpg" alt="Single Origin Espresso">
        </a>

        <a href="javascript:void(0)" onclick="filterByCategory('matcha-tea')" class="luckin-banner-card hover-lift">
          <img src="https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/51a7bfc8-098a-43a4-8d72-ad3fef562bbf.jpg" alt="Matcha">
        </a>

      </div>

    </div>
  </section>

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
          <i class="bi bi-flower1"></i> Matcha & Frappe
        </button>
        <button class="btn-cat-tab" data-filter="bakery">
          <i class="bi bi-pie-chart-fill"></i> Gourmet Bakery
        </button>
      </div>
    </div>
  </nav>

  <section class="menu-items-section py-5" id="menuGridSection">
    <div class="container">
      
      <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 reveal">
        <div>
          <h2 class="font-heading fw-bold mb-1" id="currentCategoryHeading">All Handcrafted Items</h2>
          <div class="text-muted small" id="itemsCountText">Showing specialty beverages and gourmet items</div>
        </div>
        
        <div class="d-flex gap-2 align-items-center">
          <select id="dietaryFilter" class="form-select form-select-sm" style="width: auto; border-radius: 8px;">
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
        <button class="btn btn-outline-dark px-4 py-2 mt-2" id="resetFiltersBtn">Reset Filters</button>
      </div>

    </div>
  </section>

  <!-- App Download Banner -->
  <section class="app-download-section reveal">
    <div class="container">
      <div class="app-download-card">
        <div class="row align-items-center g-4 text-center text-lg-start">
          <div class="col-lg-7">
            <span class="app-badge-tag"><i class="bi bi-phone"></i> MOBILE REWARDS & ORDERING</span>
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

  <section class="cafe-branches-section" id="branches" style="background-color: #fff9f3;">
    <div class="container">
      
      <div class="sec-heading-center text-center mb-5 reveal">
        <span class="badge-tag-pill mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> EXPERIENCE SANTINO NATIONWIDE</span>
        <h2 class="sec-title">Our Cafes & Roastery Experience Hubs</h2>
        <div class="sec-subtitle">Step into an artisan coffee retreat or visit our partner express bars across prime Dhaka locations</div>
      </div>

      <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 reveal">
        <button class="branch-filter-btn active" data-branch-filter="all">All Locations (6)</button>
        <button class="branch-filter-btn" data-branch-filter="gulshan">Gulshan & Banani</button>
        <button class="branch-filter-btn" data-branch-filter="dhanmondi">Dhanmondi</button>
        <button class="branch-filter-btn" data-branch-filter="uttara">Uttara</button>
        <button class="branch-filter-btn" data-branch-filter="tejgaon">Tejgaon Roastery</button>
      </div>

      <div class="row g-4" id="branchesGrid">
        
        <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="100" data-region="gulshan">
          <div class="branch-card hover-lift">
            <div class="branch-card-img" style="background-image: url('<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>');">
              <span class="branch-tag-badge">FLAGSHIP EXPERIENCE</span>
            </div>
            <div class="branch-card-body">
              <h3 class="branch-title">Santino Experience Hub | Gulshan-2</h3>
              <p class="branch-desc text-muted small mb-3">State-of-the-art Victoria Arduino espresso bar, cupping lounge & VIP meeting rooms.</p>
              
              <div class="branch-info-list">
                <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Plot 11, Road 48, CWN Block, Gulshan-2, Dhaka 1212</span></div>
                <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Sat – Thurs: 7:30 AM – 11:00 PM | Fri: 8:00 AM – 11:30 PM</span></div>
                <div class="info-line"><i class="bi bi-p-circle text-success"></i> <span>Valet & Underground Parking Available • Free High-Speed WiFi</span></div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <a href="https://maps.google.com" target="_blank" class="btn-prod-outline flex-fill">
                  <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                </a>
                <button class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;" data-branch="Gulshan-2 Flagship">
                  <i class="bi bi-cup-hot-fill me-1"></i> Order Here
                </button>
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
                <button class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;" data-branch="Banani Borak Tower">
                  <i class="bi bi-cup-hot-fill me-1"></i> Order Here
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="300" data-region="tejgaon">
          <div class="branch-card hover-lift">
            <div class="branch-card-img" style="background-image: url('<?php echo santino_img('bd-barista-latte-art.jpg'); ?>');">
              <span class="branch-tag-badge">ROASTERY & ACADEMY</span>
            </div>
            <div class="branch-card-body">
              <h3 class="branch-title">Artisan Roastery & Lab | Tejgaon</h3>
              <p class="branch-desc text-muted small mb-3">Witness live batch roasting on Giesen roasters, explore crop-to-cup origin flights.</p>
              
              <div class="branch-info-list">
                <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>232-234 Tejgaon Industrial Area (Near Gulshan Link Road), Dhaka</span></div>
                <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Sun – Sat: 7:30 AM – 10:00 PM</span></div>
                <div class="info-line"><i class="bi bi-p-circle text-success"></i> <span>Dedicated Free Parking • Roastery Viewing Deck • Barista Lab</span></div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <a href="https://maps.google.com" target="_blank" class="btn-prod-outline flex-fill">
                  <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                </a>
                <button class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;" data-branch="Tejgaon Roastery">
                  <i class="bi bi-cup-hot-fill me-1"></i> Order Here
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="100" data-region="dhanmondi">
          <div class="branch-card hover-lift">
            <div class="branch-card-img" style="background-image: url('<?php echo santino_img('imgi_24_santino_-_250522-07240.jpg'); ?>');">
              <span class="branch-tag-badge">LAKESIDE CAFE</span>
            </div>
            <div class="branch-card-body">
              <h3 class="branch-title">Santino Lakeside | Dhanmondi 27</h3>
              <p class="branch-desc text-muted small mb-3">Lush green garden patio, artisan pour-overs, handcrafted bakery & brunch.</p>
              
              <div class="branch-info-list">
                <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>House 14, Road 27 (Old), Dhanmondi R/A, Dhaka 1209</span></div>
                <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Daily: 8:00 AM – 11:00 PM</span></div>
                <div class="info-line"><i class="bi bi-p-circle text-success"></i> <span>Lakeside View • Garden Seating • Wheelchair Accessible</span></div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <a href="https://maps.google.com" target="_blank" class="btn-prod-outline flex-fill">
                  <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                </a>
                <button class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;" data-branch="Dhanmondi Lakeside">
                  <i class="bi bi-cup-hot-fill me-1"></i> Order Here
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="200" data-region="uttara">
          <div class="branch-card hover-lift">
            <div class="branch-card-img" style="background-image: url('<?php echo santino_img('imgi_25_santino_-_250522-07618.jpg'); ?>');">
              <span class="branch-tag-badge">EXPRESS LOUNGE</span>
            </div>
            <div class="branch-card-body">
              <h3 class="branch-title">Santino Express | Uttara Sector 7</h3>
              <p class="branch-desc text-muted small mb-3">Convenient drive-by express coffee bar, swift mobile app order pickup.</p>
              
              <div class="branch-info-list">
                <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Plot 28, Sonargaon Janapath, Sector 7, Uttara, Dhaka</span></div>
                <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Daily: 7:00 AM – 11:00 PM</span></div>
                <div class="info-line"><i class="bi bi-p-circle text-success"></i> <span>Drive-Thru Pickup • Outdoor Benches • Pet-Friendly Patio</span></div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <a href="https://maps.google.com" target="_blank" class="btn-prod-outline flex-fill">
                  <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                </a>
                <button class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;" data-branch="Uttara Sector 7">
                  <i class="bi bi-cup-hot-fill me-1"></i> Order Here
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="300" data-region="dhanmondi">
          <div class="branch-card hover-lift">
            <div class="branch-card-img" style="background-image: url('<?php echo santino_img('imgi_27_santino_-_250522-07216.jpg'); ?>');">
              <span class="branch-tag-badge">ACADEMY & CAFE</span>
            </div>
            <div class="branch-card-body">
              <h3 class="branch-title">Santino Studio | Satmasjid Road</h3>
              <p class="branch-desc text-muted small mb-3">Single-origin manual brew bar, slow coffee experience, and barista training zone.</p>
              
              <div class="branch-info-list">
                <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span>Level 4, Navana Tower, Satmasjid Road, Dhanmondi, Dhaka</span></div>
                <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Daily: 8:30 AM – 10:30 PM</span></div>
                <div class="info-line"><i class="bi bi-p-circle text-success"></i> <span>Quiet Study Area • Power Outlets at Every Table • SCA Lab</span></div>
              </div>

              <div class="d-flex gap-2 mt-4">
                <a href="https://maps.google.com" target="_blank" class="btn-prod-outline flex-fill">
                  <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                </a>
                <button class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;" data-branch="Dhanmondi Satmasjid">
                  <i class="bi bi-cup-hot-fill me-1"></i> Order Here
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <div class="modal fade" id="itemCustomModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content rounded-4 border-0 overflow-hidden">
        
        <div class="modal-header border-0 pb-0">
          <div>
            <span class="badge mb-1 px-3 py-1" id="modalItemTag" style="background: var(--santino-teal); color: #fff;">SPECIALTY DRINK</span>
            <h3 class="modal-title font-heading fw-bold" id="modalItemTitle">Drink Title</h3>
            <div class="text-muted small" id="modalItemCalories">180 kcal</div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body pt-3">
          <div class="row g-4">
            
            <div class="col-md-5 text-center">
              <div class="rounded-4 overflow-hidden shadow-sm mb-3 hover-img-zoom" style="height: 240px; background: #f8f9fa;">
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
                <label class="form-label small fw-bold text-uppercase">1. Temperature</label>
                <div class="d-flex gap-2">
                  <input type="radio" class="btn-check" name="tempOption" id="tempIced" value="Iced" checked>
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="tempIced"><i class="bi bi-snow me-1"></i> Iced (Standard)</label>
                  
                  <input type="radio" class="btn-check" name="tempOption" id="tempHot" value="Hot">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill py-2" for="tempHot"><i class="bi bi-cup-hot me-1"></i> Hot</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">2. Sweetness</label>
                <div class="d-flex gap-2 flex-wrap">
                  <input type="radio" class="btn-check" name="sweetOption" id="sw100" value="100% Regular" checked>
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw100">100% Regular</label>
                  
                  <input type="radio" class="btn-check" name="sweetOption" id="sw70" value="70% Less">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw70">70% Less</label>
                  
                  <input type="radio" class="btn-check" name="sweetOption" id="sw30" value="30% Slight">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw30">30% Slight</label>
                  
                  <input type="radio" class="btn-check" name="sweetOption" id="sw0" value="0% No Sugar">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="sw0">0% Sugar</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase">3. Milk Selection</label>
                <div class="d-flex gap-2 flex-wrap">
                  <input type="radio" class="btn-check" name="milkOption" id="milkFresh" value="Fresh Milk" checked>
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkFresh">Whole Milk (+৳0)</label>
                  
                  <input type="radio" class="btn-check" name="milkOption" id="milkOat" value="Oatly Oat (+৳50)">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkOat">Oatly Oat (+৳50)</label>
                  
                  <input type="radio" class="btn-check" name="milkOption" id="milkCoconut" value="Coconut Milk (+৳40)">
                  <label class="btn btn-outline-dark btn-sm flex-fill rounded-pill" for="milkCoconut">Coconut (+৳40)</label>
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center mb-4 pt-2">
                <label class="form-label small fw-bold text-uppercase mb-0">Quantity</label>
                <div class="d-flex align-items-center gap-2">
                  <button type="button" class="btn btn-outline-dark btn-sm rounded-circle" id="qtyMinusBtn" style="width: 32px; height: 32px; padding: 0;">-</button>
                  <span class="fw-bold px-2" id="modalQtyDisplay">1</span>
                  <button type="button" class="btn btn-outline-dark btn-sm rounded-circle" id="qtyPlusBtn" style="width: 32px; height: 32px; padding: 0;">+</button>
                </div>
              </div>

              <button type="button" class="btn btn-dark w-100 py-3 fw-bold rounded-3 font-heading text-uppercase shadow-md hover-glow" id="modalAddToCartBtn" style="background: var(--santino-teal); border: none;">
                Add To Order • <span id="modalTotalCalculate">৳ 0</span>
              </button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas">
    <div class="offcanvas-header border-bottom">
      <h5 class="offcanvas-title font-heading fw-bold"><i class="bi bi-cart3 me-2"></i> Your Coffee Order</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-between">
      
      <div id="cartItemsList" class="d-flex flex-column gap-3 overflow-auto">
        <div id="emptyCartMessage" class="text-center py-5 text-muted">
          <i class="bi bi-cart-x fs-1"></i>
          <p class="mt-2 mb-0">Your order is currently empty</p>
        </div>
      </div>

      <div class="pt-3 border-top" id="cartFooterBox" style="display: none;">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="text-muted">Total Amount</span>
          <span class="fw-bold font-heading fs-5" id="cartTotalPayable">৳ 0</span>
        </div>
        <button class="btn btn-dark w-100 py-3 fw-bold rounded-3 font-heading text-uppercase hover-glow" style="background: var(--santino-teal); border: none;" onclick="alert('Thank you for ordering! Please show your order to the barista counter.');">
          Proceed To Checkout →
        </button>
      </div>

    </div>
  </div>

  <!-- FOOTER -->

<?php
endif;

get_footer();
