<?php
/**
 * Template Name: Santino Home Page
 *
 * @package Santino
 */

get_header();
?>

<!-- 1. HERO BANNER (5-SLIDE CAROUSEL WITH REAL ASSETS & VIDEO) -->
  <section class="hero-banner-section position-relative">
    
    <div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel" data-bs-interval="6500">
      
      <div class="carousel-inner">
        
        <!-- Slide 1: Care Partner / Expansion Coffee Business in Bangladesh (VIDEO HERO) -->
        <div class="carousel-item active hero-carousel-item position-relative overflow-hidden">
          <div class="hero-video-wrap">
            <video class="hero-video-bg" autoplay muted loop playsinline poster="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>">
              <source src="<?php echo esc_url( SANTINO_URI . '/assets/videos/coffee_espresso_video.mp4' ); ?>" type="video/mp4">
              <source src="<?php echo esc_url( SANTINO_URI . '/assets/videos/coffee_roasting_video.webm' ); ?>" type="video/webm">
            </video>
          </div>
          <div class="hero-overlay"></div>
          <div class="container hero-content my-auto position-relative" style="z-index: 2;">
            <div class="row align-items-center">
              <div class="col-xl-8 col-lg-9 hero-content-wrap">
                <div class="hero-slider-eyebrow">CARE PARTNER & B2B EXPANSION</div>
                <h1 class="hero-lifestyle-title">
                  Expansion Coffee Business,<br>
                  <span class="hero-italic-serif">In Bangladesh</span>
                </h1>
                <p class="hero-lifestyle-desc">
                  Turnkey commercial coffee solutions — Italian espresso machinery leases, 4-hour rapid technical care SLA, custom artisan roasting, and cafe consulting.
                </p>
                <div>
                  <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                    Explore B2B Solutions <i class="bi bi-arrow-right"></i>
                  </button>
                </div>

                <!-- 3-Item Feature Strip -->
                <div class="hero-features-strip">
                  <div class="hero-feature-unit">
                    <i class="bi bi-gear-wide-connected"></i>
                    <div class="hero-feature-text">Italian Espresso<br>Machinery</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-clock-history"></i>
                    <div class="hero-feature-text">4-Hour Rapid<br>Service SLA</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-shield-check"></i>
                    <div class="hero-feature-text">Turnkey Care<br>Partnership</div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2: Cafe in BFC -->
        <div class="carousel-item hero-carousel-item" style="background-image: url('<?php echo santino_img('bfc_santino_foodservice.jpg'); ?>'); background-position: center 30%;">
          <div class="hero-overlay"></div>
          <div class="container hero-content my-auto">
            <div class="row align-items-center">
              <div class="col-xl-8 col-lg-9 hero-content-wrap">
                <div class="hero-slider-eyebrow">OFFICIAL FOODSERVICE PARTNER</div>
                <h1 class="hero-lifestyle-title">
                  Signature Espresso Bar,<br>
                  <span class="hero-italic-serif">Across 50+ BFC Outlets</span>
                </h1>
                <p class="hero-lifestyle-desc">
                  Commercial 9-bar Italian espresso stations, custom roasted barista blend beans, and WBC-standard staff training powering dining across 50+ BFC restaurants nationwide.
                </p>
                <div>
                  <a href="<?php echo esc_url( home_url( '/bfc/' ) ); ?>" class="btn-hero-lifestyle">
                    Visit BFC Brand Page <i class="bi bi-arrow-right"></i>
                  </a>
                </div>

                <!-- 3-Item Feature Strip -->
                <div class="hero-features-strip">
                  <div class="hero-feature-unit">
                    <i class="bi bi-shop"></i>
                    <div class="hero-feature-text">50+ BFC<br>Outlets</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-cup-hot"></i>
                    <div class="hero-feature-text">Fresh Barista<br>Coffee Blend</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-award"></i>
                    <div class="hero-feature-text">WBC Standard<br>Staff Training</div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Slide 3: Cafe in Sharpon (Shwapno) -->
        <div class="carousel-item hero-carousel-item" style="background-image: url('<?php echo santino_img('shwapno_santino_retail.jpg'); ?>'); background-position: center 35%;">
          <div class="hero-overlay"></div>
          <div class="container hero-content my-auto">
            <div class="row align-items-center">
              <div class="col-xl-8 col-lg-9 hero-content-wrap">
                <div class="hero-slider-eyebrow">RETAIL SUPERSTORE PARTNER</div>
                <h1 class="hero-lifestyle-title">
                  Specialty Retail Coffee,<br>
                  <span class="hero-italic-serif">At 100+ Shwapno Shelves</span>
                </h1>
                <p class="hero-lifestyle-desc">
                  Freshly roasted whole bean & fine ground coffee packs with one-way degassing valves and in-store grinding booths available across 100+ Shwapno superstores.
                </p>
                <div>
                  <a href="<?php echo esc_url( home_url( '/swapno/' ) ); ?>" class="btn-hero-lifestyle">
                    Visit Shwapno Page <i class="bi bi-arrow-right"></i>
                  </a>
                </div>

                <!-- 3-Item Feature Strip -->
                <div class="hero-features-strip">
                  <div class="hero-feature-unit">
                    <i class="bi bi-cart3"></i>
                    <div class="hero-feature-text">100+ Shwapno<br>Superstores</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-flower1"></i>
                    <div class="hero-feature-text">Whole Bean &<br>Fine Ground</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-box-seam"></i>
                    <div class="hero-feature-text">Degassing Valve<br>Aroma Seal</div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Slide 4: Video in Bean (Artisan Roastery & Sourcing) -->
        <div class="carousel-item hero-carousel-item position-relative overflow-hidden">
          <div class="hero-video-wrap">
            <video class="hero-video-bg" autoplay muted loop playsinline poster="<?php echo santino_img('imgi_4_pexels-sikunovruslan-11942442.jpg'); ?>">
              <source src="<?php echo esc_url( SANTINO_URI . '/assets/videos/coffee_roasting_video.webm' ); ?>" type="video/webm">
              <source src="https://web.luckincdn.com/default/assets/ourstory-41023fc9.webm" type="video/webm">
            </video>
          </div>
          <div class="hero-overlay"></div>
          <div class="container hero-content my-auto">
            <div class="row align-items-center">
              <div class="col-xl-8 col-lg-9 hero-content-wrap">
                <div class="hero-slider-eyebrow">90+ SCA MICRO-LOT ROASTERY</div>
                <h1 class="hero-lifestyle-title">
                  Direct Trade Origins,<br>
                  <span class="hero-italic-serif">& Roasting Mastery</span>
                </h1>
                <p class="hero-lifestyle-desc">
                  Single-origin micro-lots directly sourced from Ethiopia, Colombia & Guatemala. Precision batch roasting preserves peak aromatic notes and golden crema.
                </p>
                <div>
                  <a href="<?php echo esc_url( home_url( '/beans/' ) ); ?>" class="btn-hero-lifestyle">
                    Explore Bean Roasts <i class="bi bi-arrow-right"></i>
                  </a>
                </div>

                <!-- 3-Item Feature Strip -->
                <div class="hero-features-strip">
                  <div class="hero-feature-unit">
                    <i class="bi bi-fire"></i>
                    <div class="hero-feature-text">Drum Batch<br>Roasting</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-globe-americas"></i>
                    <div class="hero-feature-text">Direct Trade<br>Ethiopia & Colombia</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-patch-check"></i>
                    <div class="hero-feature-text">FSSC 22000<br>Certified</div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Slide 5: Video Espresso Business (Commercial Machinery & Care SLA) -->
        <div class="carousel-item hero-carousel-item position-relative overflow-hidden">
          <div class="hero-video-wrap">
            <video class="hero-video-bg" autoplay muted loop playsinline poster="<?php echo santino_img('imgi_218_blackeagle2.jpg'); ?>">
              <source src="<?php echo esc_url( SANTINO_URI . '/assets/videos/coffee_espresso_video.mp4' ); ?>" type="video/mp4">
              <source src="https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/ab6140f6-129c-4ae9-aaa0-20190c43183b.mp4" type="video/mp4">
            </video>
          </div>
          <div class="hero-overlay"></div>
          <div class="container hero-content my-auto">
            <div class="row align-items-center">
              <div class="col-xl-8 col-lg-9 hero-content-wrap">
                <div class="hero-slider-eyebrow">ITALIAN ENGINEERING & CARE SLA</div>
                <h1 class="hero-lifestyle-title">
                  Turnkey Espresso Business,<br>
                  <span class="hero-italic-serif">& 4-Hour Service SLA</span>
                </h1>
                <p class="hero-lifestyle-desc">
                  Official distributor of Victoria Arduino, Nuova Simonelli, and Kalerm. Providing guaranteed 4-hour on-site maintenance, barista calibration, and zero-capex leasing.
                </p>
                <div>
                  <a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="btn-hero-lifestyle">
                    Discover Machines <i class="bi bi-arrow-right"></i>
                  </a>
                </div>

                <!-- 3-Item Feature Strip -->
                <div class="hero-features-strip">
                  <div class="hero-feature-unit">
                    <i class="bi bi-gear"></i>
                    <div class="hero-feature-text">Victoria Arduino<br>& Simonelli</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-tools"></i>
                    <div class="hero-feature-text">4-Hour SLA<br>On-site AMC</div>
                  </div>
                  <div class="hero-feature-sep"></div>
                  <div class="hero-feature-unit">
                    <i class="bi bi-cash-stack"></i>
                    <div class="hero-feature-text">Zero-Capex<br>Lease Plans</div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Circular Outline Nav Arrows (Left & Right) -->
      <button class="hero-nav-arrow hero-nav-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous Slide">
        <i class="bi bi-arrow-left"></i>
      </button>
      <button class="hero-nav-arrow hero-nav-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next Slide">
        <i class="bi bi-arrow-right"></i>
      </button>

      <!-- Vertical Slide Pagination on Right Edge -->
      <div class="hero-vertical-pagination d-none d-lg-flex">
        <span class="hero-slide-counter-num" id="heroSlideCounter">01 / 05</span>
        <ul class="hero-vert-dot-list">
          <li class="hero-vert-dot active" data-bs-target="#heroCarousel" data-bs-slide-to="0"></li>
          <li class="hero-vert-dot" data-bs-target="#heroCarousel" data-bs-slide-to="1"></li>
          <li class="hero-vert-dot" data-bs-target="#heroCarousel" data-bs-slide-to="2"></li>
          <li class="hero-vert-dot" data-bs-target="#heroCarousel" data-bs-slide-to="3"></li>
          <li class="hero-vert-dot" data-bs-target="#heroCarousel" data-bs-slide-to="4"></li>
        </ul>
      </div>

      <!-- Horizontal Line Indicators at Bottom Center -->
      <div class="hero-lifestyle-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
      </div>

    </div>
  </section>

  <!-- 1.2. FEATURED MENU HIGHLIGHT SLIDER (HOT & COLD SIGNATURES) -->
  <section class="home-menu-preview-section py-5 position-relative" id="featured-menu">
    
    <!-- Floating Background Icons & Leaves -->
    <div class="floating-bg-icons" aria-hidden="true">
      <!-- Leaf 1: Top Left -->
      <div class="float-item leaf-green float-item-1" title="Coffee Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
        </svg>
      </div>
      
      <!-- Cup: Top Right -->
      <div class="float-item float-item-2"><i class="bi bi-cup-hot-fill"></i></div>

      <!-- Leaf 2: Center Left -->
      <div class="float-item leaf-emerald float-item-3" title="Botanical Leaf">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
        </svg>
      </div>

      <!-- Coffee Bean / Cup Straw: Bottom Right -->
      <div class="float-item maroon float-item-4"><i class="bi bi-cup-straw"></i></div>

      <!-- Leaf 3: Bottom Left -->
      <div class="float-item leaf-green float-item-5" title="Coffee Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M5.5 58.5C6.8 40.2 18.2 23 34.6 16.4c5.7-2.3 12-3.4 18.4-3.4l5.5-7.5.8 8.8c-.1 5.4-1.5 10.8-4.1 15.6C47.1 47 28.5 57.3 5.5 58.5zm40.3-36c-3.8-2.6-8.3-4.2-12.9-4.8-4.5 6.2-7.5 13.5-8.7 21.2 7.3-7.8 15.9-13.4 21.6-16.4zm-2.1 7.2c-4.8 2.4-11.7 6.5-17.7 12.8-.4 2.2-.6 4.5-.7 6.8 6.9-.6 13.4-3.8 18.2-9 1.2-3.5 1.7-7.1.2-10.6z"/>
        </svg>
      </div>

      <!-- Sparkles / Gold Stars: Top Center -->
      <div class="float-item gold float-item-6"><i class="bi bi-stars"></i></div>

      <!-- Leaf 4: Bottom Center Right -->
      <div class="float-item leaf-emerald float-item-7" title="Fresh Leaf">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2C6.5 2 2 6.5 2 12c0 3.5 1.8 6.6 4.6 8.4L6 22l3.6-.6C10.3 21.8 11.1 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm1 14.9V13h3.5l-5.5-7v3.9H7.5l5.5 7z" opacity="0.3"/>
          <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
        </svg>
      </div>

      <!-- Droplet / Aroma: Center -->
      <div class="float-item gold float-item-8"><i class="bi bi-droplet-fill"></i></div>

      <!-- Leaf 5: Mid Right -->
      <div class="float-item leaf-green float-item-9" title="Eco Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
        </svg>
      </div>

      <!-- Coffee Mug: Far Left -->
      <div class="float-item maroon float-item-10"><i class="bi bi-cup-hot"></i></div>
    </div>

    <div class="container py-3">
      
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
        <div>
          <div class="sec-pill-badge-wrap start mb-2">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> 100% ARTISAN ROASTED BEANS</span>
            <span class="sec-pill-line"></span>
          </div>
          <h2 class="sec-title mb-2">Good Coffee, <span class="menu-title-highlight">Better Days</span></h2>
          <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5;">Santino Caffè signature hot & chilled brews crafted with Italian roasted espresso for your daily boost.</p>
        </div>
        <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
          <!-- Slider Navigation Arrows -->
          <button class="menu-slider-nav-btn menu-slider-prev" aria-label="Previous Drink">
            <i class="bi bi-arrow-left"></i>
          </button>
          <button class="menu-slider-nav-btn menu-slider-next" aria-label="Next Drink">
            <i class="bi bi-arrow-right"></i>
          </button>
          <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn btn-dark ms-2 fw-bold px-4 py-2 rounded-pill shadow-sm" style="background: var(--kp-maroon); border: none; font-size: 13.5px; letter-spacing: 0.4px;">
            View Full Menu <i class="bi bi-arrow-up-right ms-1"></i>
          </a>
        </div>
      </div>

      <!-- Menu Horizontal Slider Track -->
      <div class="menu-teaser-slider-wrapper">
        <div class="menu-teaser-track" id="menuTeaserTrack">
          
          <!-- Item 1: Hot Cappuccino -->
          <div class="menu-teaser-card">
            <div class="menu-teaser-img-box">
              <img src="https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=600&auto=format&fit=crop&q=80" alt="Cappuccino">
            </div>
            <div class="menu-teaser-info">
              <div>
                <div class="d-flex justify-content-end">
                  <span class="menu-card-tag hot-tag"><i class="bi bi-fire"></i> Hot Classic</span>
                </div>
                <h4 class="menu-teaser-title">Cappuccino</h4>
                <p class="menu-teaser-desc">Velvety micro-foam espresso with rich aroma & smooth taste.</p>
              </div>
              <div class="menu-teaser-price-row">
                <div class="price-val"><span class="currency">Tk.</span> 170 <small class="text-muted fs-8">/ Reg</small></div>
                <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="menu-add-btn" title="View in Menu"><i class="bi bi-plus-lg"></i></a>
              </div>
            </div>
          </div>

          <!-- Item 2: Iced Latte -->
          <div class="menu-teaser-card">
            <div class="menu-teaser-img-box">
              <img src="https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=600&auto=format&fit=crop&q=80" alt="Iced Latte">
            </div>
            <div class="menu-teaser-info">
              <div>
                <div class="d-flex justify-content-end">
                  <span class="menu-card-tag cold-tag"><i class="bi bi-snow"></i> Cold Favorite</span>
                </div>
                <h4 class="menu-teaser-title">Iced Latte</h4>
                <p class="menu-teaser-desc">Smooth chilled milk layered over double shot fresh espresso.</p>
              </div>
              <div class="menu-teaser-price-row">
                <div class="price-val"><span class="currency">Tk.</span> 200 <small class="text-muted fs-8">/ Large</small></div>
                <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="menu-add-btn" title="View in Menu"><i class="bi bi-plus-lg"></i></a>
              </div>
            </div>
          </div>

          <!-- Item 3: Iced Mocha -->
          <div class="menu-teaser-card">
            <div class="menu-teaser-img-box">
              <img src="https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=700&auto=format&fit=crop&q=85" alt="Iced Mocha" loading="lazy">
            </div>
            <div class="menu-teaser-info">
              <div>
                <div class="d-flex justify-content-end">
                  <span class="menu-card-tag cold-tag"><i class="bi bi-snow"></i> Rich Cocoa</span>
                </div>
                <h4 class="menu-teaser-title">Iced Mocha</h4>
                <p class="menu-teaser-desc">Premium dark chocolate syrup drizzle with iced espresso and cream.</p>
              </div>
              <div class="menu-teaser-price-row">
                <div class="price-val"><span class="currency">Tk.</span> 210 <small class="text-muted fs-8">/ Large</small></div>
                <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="menu-add-btn" title="View in Menu"><i class="bi bi-plus-lg"></i></a>
              </div>
            </div>
          </div>

          <!-- Item 4: Mocha Frappe -->
          <div class="menu-teaser-card">
            <div class="menu-teaser-img-box">
              <img src="https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=600&auto=format&fit=crop&q=80" alt="Mocha Frappe">
            </div>
            <div class="menu-teaser-info">
              <div>
                <div class="d-flex justify-content-end">
                  <span class="menu-card-tag frappe-tag"><i class="bi bi-stars"></i> Hero Item</span>
                </div>
                <h4 class="menu-teaser-title">Mocha Frappe</h4>
                <p class="menu-teaser-desc">Blended iced coffee topped with whipped cream and rich chocolate fudge.</p>
              </div>
              <div class="menu-teaser-price-row">
                <div class="price-val"><span class="currency">Tk.</span> 230 <small class="text-muted fs-8">/ Large</small></div>
                <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="menu-add-btn" title="View in Menu"><i class="bi bi-plus-lg"></i></a>
              </div>
            </div>
          </div>

          <!-- Item 5: Hazelnut Frappe -->
          <div class="menu-teaser-card">
            <div class="menu-teaser-img-box">
              <img src="https://images.unsplash.com/photo-1579888944880-d98341245702?w=600&auto=format&fit=crop&q=80" alt="Hazelnut Frappe">
            </div>
            <div class="menu-teaser-info">
              <div>
                <div class="d-flex justify-content-end">
                  <span class="menu-card-tag frappe-tag"><i class="bi bi-stars"></i> Signature</span>
                </div>
                <h4 class="menu-teaser-title">Hazelnut Frappe</h4>
                <p class="menu-teaser-desc">Roasted hazelnut blend with crushed ice, coffee essence & whipped peak.</p>
              </div>
              <div class="menu-teaser-price-row">
                <div class="price-val"><span class="currency">Tk.</span> 230 <small class="text-muted fs-8">/ Large</small></div>
                <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="menu-add-btn" title="View in Menu"><i class="bi bi-plus-lg"></i></a>
              </div>
            </div>
          </div>

          <!-- Item 6: Americano -->
          <div class="menu-teaser-card">
            <div class="menu-teaser-img-box">
              <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=600&auto=format&fit=crop&q=80" alt="Americano">
            </div>
            <div class="menu-teaser-info">
              <div>
                <div class="d-flex justify-content-end">
                  <span class="menu-card-tag hot-tag"><i class="bi bi-fire"></i> Bold Brew</span>
                </div>
                <h4 class="menu-teaser-title">Americano</h4>
                <p class="menu-teaser-desc">Double-shot artisan espresso lengthened with purified hot water.</p>
              </div>
              <div class="menu-teaser-price-row">
                <div class="price-val"><span class="currency">Tk.</span> 140 <small class="text-muted fs-8">/ Reg</small></div>
                <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="menu-add-btn" title="View in Menu"><i class="bi bi-plus-lg"></i></a>
              </div>
            </div>
          </div>

          <!-- Item 7: Iced Chocolate -->
          <div class="menu-teaser-card">
            <div class="menu-teaser-img-box">
              <img src="https://images.unsplash.com/photo-1541658016709-82535e94bc69?w=600&auto=format&fit=crop&q=80" alt="Iced Chocolate">
            </div>
            <div class="menu-teaser-info">
              <div>
                <div class="d-flex justify-content-end">
                  <span class="menu-card-tag cold-tag"><i class="bi bi-snow"></i> Sweet Sip</span>
                </div>
                <h4 class="menu-teaser-title">Iced Chocolate</h4>
                <p class="menu-teaser-desc">Indulgent dark chocolate blended creamy with ice cold milk.</p>
              </div>
              <div class="menu-teaser-price-row">
                <div class="price-val"><span class="currency">Tk.</span> 190 <small class="text-muted fs-8">/ Large</small></div>
                <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="menu-add-btn" title="View in Menu"><i class="bi bi-plus-lg"></i></a>
              </div>
            </div>
          </div>

        </div>
      </div>

      <!-- Member Perk Banner Bar -->
      <div class="menu-loyalty-strip mt-4 d-flex flex-column flex-lg-row justify-content-between align-items-center p-3 p-md-4 text-white">
        <div class="d-flex align-items-center gap-3 text-center text-md-start mb-3 mb-lg-0">
          <div class="loyalty-icon-circle">
            <i class="bi bi-gift-fill"></i>
          </div>
          <div>
            <span class="loyalty-tag-pill"><i class="bi bi-gem me-1"></i> VIP Club Benefit</span>
            <div class="fw-bold fs-5 text-white">Santino Coffee Member Perk</div>
            <div class="small text-white-50" style="font-size: 0.92rem;">
              Buy 5 Coffees &amp; Get your 6th one <span class="loyalty-free-highlight">100% Free!</span>
            </div>
          </div>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2 justify-content-center">
          <a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="btn btn-loyalty-primary">
            <i class="bi bi-stars me-1"></i> Become Member
          </a>
          <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn btn-loyalty-secondary">
            Explore Menu (20+ Items) <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- 1.5. WHERE TO EXPERIENCE SANTINO COFFEE -->
  <section class="outlets-experience-section" id="availability">
    <div class="container">
      <div class="text-center mb-5">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill me-1"></i> VISIT OUR OUTLETS</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="sec-title mb-2">Where to Experience <span class="sec-title-accent">Santino Coffee</span></h2>
        <p class="text-muted mx-auto" style="max-width: 620px; font-size: 0.95rem;">Find our premium coffee at trusted retail partners and enjoy the Santino experience, near you.</p>
      </div>

      <div class="row g-4">
        
        <!-- Outlet 1: Shwapno Superstores -->
        <div class="col-lg-6" id="swapno">
          <a href="<?php echo esc_url( home_url( '/swapno/' ) ); ?>" class="outlet-card">
            <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="Shwapno Superstores" class="outlet-card-img" loading="lazy">
            <div class="outlet-card-overlay"></div>
            <span class="outlet-partner-badge"><i class="bi bi-shop me-1"></i> RETAIL PARTNER</span>
            <div class="outlet-card-content">
              <h3 class="outlet-card-title">Shwapno Superstores</h3>
              <p class="outlet-card-desc">Find Santino Coffee at your nearest Shwapno Superstore and enjoy your favorite brew.</p>
              <div class="outlet-location-tag"><i class="bi bi-geo-alt-fill me-1"></i> Nationwide</div>
            </div>
          </a>
        </div>

        <!-- Outlet 2: BFC (Best Fried Chicken) -->
        <div class="col-lg-6" id="bfc">
          <a href="<?php echo esc_url( home_url( '/bfc/' ) ); ?>" class="outlet-card">
            <img src="<?php echo santino_img('bfc_santino_foodservice.jpg'); ?>" alt="BFC Best Fried Chicken" class="outlet-card-img" loading="lazy">
            <div class="outlet-card-overlay"></div>
            <span class="outlet-partner-badge"><i class="bi bi-cup-hot-fill me-1"></i> RESTAURANT PARTNER</span>
            <div class="outlet-card-content">
              <h3 class="outlet-card-title">BFC (Best Fried Chicken)</h3>
              <p class="outlet-card-desc">Enjoy Santino Coffee at BFC outlets, where great food meets great coffee.</p>
              <div class="outlet-location-tag"><i class="bi bi-geo-alt-fill me-1"></i> Nationwide</div>
            </div>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- 2. INNOVATION GROUNDED IN HERITAGE -->
  <section class="heritage-story-section" id="about">
    <div class="container">
      <div class="row align-items-center g-4 g-lg-5">
        
        <div class="col-lg-5">
          <div class="sec-pill-badge-wrap start mb-2">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-flower1 me-1"></i> OUR HERITAGE</span>
            <span class="sec-pill-line"></span>
          </div>
          <h2 class="heritage-title">Innovation Grounded in <span class="sec-title-accent">Heritage</span></h2>
          <p class="heritage-desc">
            For over 20 years, Santino Coffee has stayed true to its heritage — combining time-honored coffee traditions with modern innovation. From carefully selected beans to precision roasting, we craft coffee that brings people together, one cup at a time.
          </p>
          <div>
            <a href="<?php echo esc_url( home_url( '/our-story/' ) ); ?>" class="heritage-cta-link">
              Discover Our Roasting Story <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="roasting-showcase-card">
            <img src="<?php echo santino_img('imgi_19_santino_-_250522-07313.jpg'); ?>" alt="The Art of Roasting" class="roasting-bg-img" loading="lazy">
            <div class="roasting-card-overlay"></div>
            <img src="<?php echo santino_img('Logo-Santino-Coffee-transparent.png'); ?>" alt="Santino Logo" class="roasting-logo-badge">
            <a href="javascript:void(0)" class="roasting-play-btn" data-bs-toggle="modal" data-bs-target="#enquiryModal" aria-label="Play Roasting Video">
              <i class="bi bi-play-fill ms-1"></i>
            </a>
            <div class="roasting-content-bottom">
              <div class="roast-title-serif">The Art of <em>Roasting</em></div>
              <div class="roast-subtitle-caps">TRADITION &bull; MEETS &bull; INNOVATION</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 2.5. BARISTA ACADEMY SECTION (THEME ALIGNED & HARMONIZED) -->
  <section class="barista-academy-home-section position-relative" id="academy">
    
    <!-- Floating Botanical Leaves Background -->
    <div class="academy-float-leaf academy-leaf-1" title="Botanical Leaf" aria-hidden="true">
      <svg viewBox="0 0 64 64" fill="currentColor">
        <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
      </svg>
    </div>

    <div class="academy-float-leaf teal academy-leaf-2" title="Coffee Branch" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="currentColor">
        <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
      </svg>
    </div>

    <div class="academy-float-leaf gold academy-leaf-3" title="Botanical Leaf" aria-hidden="true">
      <svg viewBox="0 0 64 64" fill="currentColor">
        <path d="M5.5 58.5C6.8 40.2 18.2 23 34.6 16.4c5.7-2.3 12-3.4 18.4-3.4l5.5-7.5.8 8.8c-.1 5.4-1.5 10.8-4.1 15.6C47.1 47 28.5 57.3 5.5 58.5zm40.3-36c-3.8-2.6-8.3-4.2-12.9-4.8-4.5 6.2-7.5 13.5-8.7 21.2 7.3-7.8 15.9-13.4 21.6-16.4zm-2.1 7.2c-4.8 2.4-11.7 6.5-17.7 12.8-.4 2.2-.6 4.5-.7 6.8 6.9-.6 13.4-3.8 18.2-9 1.2-3.5 1.7-7.1.2-10.6z"/>
      </svg>
    </div>

    <div class="academy-float-leaf academy-leaf-4" title="Fresh Leaf" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="currentColor">
        <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
      </svg>
    </div>

    <div class="academy-float-leaf teal academy-leaf-5" title="Eco Leaf" aria-hidden="true">
      <svg viewBox="0 0 64 64" fill="currentColor">
        <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
      </svg>
    </div>

    <div class="container py-2">
      
      <!-- Top Row: Editorial Headline + Hero Visual Collage -->
      <div class="row align-items-center g-4 g-lg-5 mb-5">
        
        <!-- Left Column: Editorial Headline & Copy -->
        <div class="col-lg-5">
          <div class="sec-pill-badge-wrap start mb-3">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-mortarboard-fill me-1"></i> BARISTA ACADEMY</span>
            <span class="sec-pill-line"></span>
          </div>
          
          <h2 class="sec-title mb-3" style="font-size: 2.35rem; line-height: 1.2;">
            Learn the Art of Great Coffee
          </h2>
          
          <p class="text-muted mb-4" style="font-size: 0.96rem; line-height: 1.65; max-width: 440px;">
            Our Barista Academy offers professional training for coffee lovers, aspiring baristas, and corporate teams. Get hands-on experience, expert guidance, and real-world skills.
          </p>
          
          <div class="d-flex flex-wrap align-items-center gap-3">
            <a href="<?php echo esc_url( home_url( '/training/' ) ); ?>" class="btn btn-dark fw-bold px-4 py-2 rounded-pill shadow-sm" style="background: var(--kp-maroon); border: none; font-size: 13.5px; letter-spacing: 0.3px;">
              Explore Academy <i class="bi bi-arrow-right ms-1"></i>
            </a>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="btn btn-outline-dark fw-semibold px-4 py-2 rounded-pill d-inline-flex align-items-center gap-2" style="font-size: 13.5px; background: #ffffff;">
              <i class="bi bi-play-circle fs-6"></i> <span>Watch Overview</span>
            </a>
          </div>
        </div>

        <!-- Right Column: Hero Visual Carousel with Overlapping Mini Cards -->
        <div class="col-lg-7">
          <div class="position-relative">
            
            <!-- Main Hero Image Frame: Auto-Sliding Carousel -->
            <div id="baristaHeroCarousel" class="carousel slide carousel-fade rounded-4 overflow-hidden shadow-sm position-relative" data-bs-ride="carousel" data-bs-interval="3500" style="height: 380px; background: #111;">
              
              <!-- Carousel Inner Slides -->
              <div class="carousel-inner h-100">
                <!-- Slide 1: Portafilter Ground Coffee Close-up -->
                <div class="carousel-item active h-100">
                  <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=1200&auto=format&fit=crop&q=80" alt="Freshly Ground Coffee Portafilter" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <!-- Slide 2: Master Barista Pouring Free-pour Latte Art -->
                <div class="carousel-item h-100">
                  <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Master Barista Pouring Latte Art" class="w-100 h-100" style="object-fit: cover;">
                </div>
                <!-- Slide 3: Commercial Espresso Machine Extraction -->
                <div class="carousel-item h-100">
                  <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="Commercial Espresso Dial-In" class="w-100 h-100" style="object-fit: cover;">
                </div>
              </div>

              <!-- Script Typography Overlay (Persistent across slides) -->
              <div class="position-absolute top-0 start-0 m-4 text-white" style="font-family: var(--kp-font-title); font-style: italic; font-weight: 800; font-size: 1.5rem; line-height: 1.2; text-shadow: 0 2px 12px rgba(0,0,0,0.9); z-index: 2;">
                Better Baristas<br>Brew Better Stories
              </div>

              <!-- Carousel Minimal Indicators Top-Right -->
              <div class="carousel-indicators mb-3 me-3 justify-content-end" style="z-index: 2;">
                <button type="button" data-bs-target="#baristaHeroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="width: 18px; height: 4px; border-radius: 4px;"></button>
                <button type="button" data-bs-target="#baristaHeroCarousel" data-bs-slide-to="1" aria-label="Slide 2" style="width: 18px; height: 4px; border-radius: 4px;"></button>
                <button type="button" data-bs-target="#baristaHeroCarousel" data-bs-slide-to="2" aria-label="Slide 3" style="width: 18px; height: 4px; border-radius: 4px;"></button>
              </div>
            </div>

            <!-- Overlapping Mini Floating Cards Bottom-Left -->
            <div class="position-absolute bottom-0 start-0 d-flex gap-2 p-2" style="transform: translate(-10px, 20px); z-index: 3;">
              <!-- Mini Card 1: Authentic Latte Art Cup Top View -->
              <div class="rounded-3 overflow-hidden shadow-sm border border-2 border-white" style="width: 105px; height: 105px; background: #fff;">
                <img src="https://images.unsplash.com/photo-1534778101976-62847782c213?w=300&auto=format&fit=crop&q=80" alt="Latte Art Cup" class="w-100 h-100" style="object-fit: cover;">
              </div>
              <!-- Mini Card 2: Classroom & Baristas Hands -->
              <div class="rounded-3 overflow-hidden shadow-sm border border-2 border-white" style="width: 105px; height: 105px; background: #fff;">
                <img src="<?php echo santino_img('imgi_24_santino_-_250522-07240.jpg'); ?>" alt="Barista Classroom Training" class="w-100 h-100" style="object-fit: cover;">
              </div>
            </div>

          </div>
        </div>

      </div>

      <!-- Bottom Feature Strip: 4 Feature Cards + Dark CTA Card -->
      <div class="row g-3 g-lg-4 align-items-stretch pt-2">
        
        <!-- Feature 1: Professional Training -->
        <div class="col-md-6 col-lg-3 col-xl-2">
          <div class="academy-feature-card">
            <div class="academy-feature-icon">
              <i class="bi bi-cup-hot-fill"></i>
            </div>
            <h6 class="academy-feature-title">Professional Training</h6>
            <p class="academy-feature-desc">Learn from certified trainers with industry experience.</p>
          </div>
        </div>

        <!-- Feature 2: Hands-on Practice -->
        <div class="col-md-6 col-lg-3 col-xl-2">
          <div class="academy-feature-card">
            <div class="academy-feature-icon">
              <i class="bi bi-people-fill"></i>
            </div>
            <h6 class="academy-feature-title">Hands-on Practice</h6>
            <p class="academy-feature-desc">Work with real equipment and live coffee stations.</p>
          </div>
        </div>

        <!-- Feature 3: Certification -->
        <div class="col-md-6 col-lg-3 col-xl-2">
          <div class="academy-feature-card">
            <div class="academy-feature-icon">
              <i class="bi bi-patch-check-fill"></i>
            </div>
            <h6 class="academy-feature-title">Certification</h6>
            <p class="academy-feature-desc">Get a recognized certificate after course completion.</p>
          </div>
        </div>

        <!-- Feature 4: Career Support -->
        <div class="col-md-6 col-lg-3 col-xl-2">
          <div class="academy-feature-card">
            <div class="academy-feature-icon">
              <i class="bi bi-briefcase-fill"></i>
            </div>
            <h6 class="academy-feature-title">Career Support</h6>
            <p class="academy-feature-desc">Guidance for job placement and career growth.</p>
          </div>
        </div>

        <!-- Right Promo Banner Card: Join Our Barista Academy -->
        <div class="col-md-12 col-lg-12 col-xl-4">
          <div class="academy-promo-card">
            <div>
              <span class="text-uppercase fw-bold" style="font-size: 10.5px; letter-spacing: 0.8px; color: #fce79f;">FOR INDIVIDUALS &amp; TEAMS</span>
              <h5 class="fw-bold mt-1 mb-2 text-white" style="font-family: var(--kp-font-title);">Join Our Barista Academy</h5>
              <p class="small mb-0" style="color: rgba(255,255,255,0.85); font-size: 12.5px; line-height: 1.45;">
                Build your skills. Grow your career. Be a part of our coffee community.
              </p>
            </div>
            <div class="d-flex justify-content-end mt-3">
              <a href="<?php echo esc_url( home_url( '/training/' ) ); ?>" class="btn btn-sm btn-light fw-bold px-3 py-1 rounded-pill" style="color: #004642; font-size: 12px;">
                Learn More <i class="bi bi-arrow-right ms-1"></i>
              </a>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 3. "COFFEE SOLUTIONS FOR YOUR BUSINESS" (HORECA, OFFICE COFFEE, EVENT COFFEE / CONSULTING) -->
  <section class="solutions-section" id="solutions">
    <div class="container" id="horeca">
      <div class="sec-heading-center" id="office-cafe">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-briefcase-fill me-1"></i> BUSINESS SOLUTIONS</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="sec-title">Coffee Solutions for Your Business</h2>
        <div class="sec-subtitle">Built around your needs, scale, and workflow</div>
      </div>

      <div class="row g-4 mobile-scroll-row">
        
        <!-- Card 1: HORECA -->
        <div class="col-lg-4 col-md-6">
          <div class="solution-card" style="background-image: url('https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=1000&auto=format&fit=crop&q=80');">
            <div class="solution-card-overlay"></div>
            <div class="solution-card-content">
              <h3 class="solution-card-title">HORECA</h3>
              <ul class="solution-card-links">
                <li><a href="<?php echo esc_url( home_url( '/office-cafe/' ) ); ?>" class="text-white text-decoration-none">Hotels, Fine Dining & Cafes <i class="bi bi-arrow-right"></i></a></li>
                <li><a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="text-white text-decoration-none">Commercial Espresso Machines <i class="bi bi-arrow-right"></i></a></li>
              </ul>
              <a href="<?php echo esc_url( home_url( '/office-cafe/' ) ); ?>" class="btn-card-knowmore text-decoration-none text-center">EXPLORE HORECA →</a>
            </div>
          </div>
        </div>

        <!-- Card 2: Office Coffee -->
        <div class="col-lg-4 col-md-6">
          <div class="solution-card" style="background-image: url('<?php echo santino_img('bd-office-coffee.jpg'); ?>');">
            <div class="solution-card-overlay"></div>
            <div class="solution-card-content">
              <h3 class="solution-card-title">Office Coffee</h3>
              <ul class="solution-card-links">
                <li><a href="<?php echo esc_url( home_url( '/office-cafe/' ) ); ?>" class="text-white text-decoration-none">Corporate Bean-to-Cup Setup <i class="bi bi-arrow-right"></i></a></li>
                <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="text-white text-decoration-none">Monthly Roast Subscriptions <i class="bi bi-arrow-right"></i></a></li>
              </ul>
              <a href="<?php echo esc_url( home_url( '/office-cafe/' ) ); ?>" class="btn-card-knowmore text-decoration-none text-center">EXPLORE OFFICE COFFEE →</a>
            </div>
          </div>
        </div>

        <!-- Card 3: Event Coffee / Consulting -->
        <div class="col-lg-4 col-md-6">
          <div class="solution-card" style="background-image: url('<?php echo santino_img('bd-barista-training.jpg'); ?>');">
            <div class="solution-card-overlay"></div>
            <div class="solution-card-content">
              <h3 class="solution-card-title">Event Coffee / Consulting</h3>
              <ul class="solution-card-links">
                <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="text-white text-decoration-none">Pop-Up Live Espresso Bars <i class="bi bi-arrow-right"></i></a></li>
                <li><a href="<?php echo esc_url( home_url( '/training/' ) ); ?>" class="text-white text-decoration-none">Cafe Setup & Barista Strategy <i class="bi bi-arrow-right"></i></a></li>
              </ul>
              <button class="btn-card-knowmore" data-bs-toggle="modal" data-bs-target="#enquiryModal">GET CONSULTATION →</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 4. ZIG-ZAG SERVICE SHOWCASES -->
  <section class="zigzag-section" id="services">
    
    <!-- Row 1: Innovation with Purpose -->
    <div class="zigzag-row">
      <div class="zigzag-col-image" style="background-image: url('<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>');"></div>
      <div class="zigzag-col-text">
        <h3 class="zigzag-title">Innovation with Purpose</h3>
        <p class="zigzag-desc">
          We embrace new ideas, technologies, and methods that elevate coffee culture in Bangladesh while respecting tradition. From advanced CAYE Bionic Baristas to intelligent superautomatics, we empower businesses to lead the coffee revolution.
        </p>
        <a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="link-kp-red">EXPLORE AUTOMATION <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>

    <!-- Row 2: Quality Without Compromise -->
    <div class="zigzag-row flex-lg-row-reverse">
      <div class="zigzag-col-image" style="background-image: url('<?php echo santino_img('shwapno_santino_retail.jpg'); ?>');"></div>
      <div class="zigzag-col-text">
        <h3 class="zigzag-title">Quality Without Compromise</h3>
        <p class="zigzag-desc">
          Everything we do shows our dedication and commitment to quality — backed by our FSSC22000 food safety certification and Rainforest Alliance certified coffee beans roasted fresh to precision in every single batch.
        </p>
        <a href="<?php echo esc_url( home_url( '/beans/' ) ); ?>" class="link-kp-red">VIEW CERTIFICATIONS <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>

    <!-- Row 3: Empowerment Through Knowledge -->
    <div class="zigzag-row">
      <div class="zigzag-col-image" style="background-image: url('<?php echo santino_img('bd-barista-training.jpg'); ?>');"></div>
      <div class="zigzag-col-text">
        <h3 class="zigzag-title">Empowerment Through Knowledge</h3>
        <p class="zigzag-desc">
          We train, mentor, and share expertise to grow the next generation of coffee leaders in Bangladesh. Our certified trainers support baristas from foundational skills to World Barista & Brewers Cup championships.
        </p>
        <a href="<?php echo esc_url( home_url( '/training/' ) ); ?>" class="link-kp-red">JOIN ACADEMY <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>

  </section>

  <!-- 5. TESTIMONIALS / WHAT OUR HOSPITALITY PARTNERS SAY -->
  <section class="hospitality-testimonials-section" id="hospitality-partners">
    
    <!-- Floating Botanical Leaf Watermarks -->
    <div class="hospitality-float-leaf hospitality-leaf-left" aria-hidden="true">
      <svg viewBox="0 0 64 64" fill="currentColor">
        <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
      </svg>
    </div>
    <div class="hospitality-float-leaf hospitality-leaf-right" aria-hidden="true">
      <svg viewBox="0 0 64 64" fill="currentColor">
        <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
      </svg>
    </div>

    <div class="container position-relative" style="z-index: 2;">
      
      <!-- Section Header -->
      <div class="text-center mb-5">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-handshake me-1"></i> PARTNER TRUST</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="hospitality-title">What Our Hospitality Partners Say</h2>
        <p class="hospitality-subtitle">
          Real partners. Real results. Here’s what our valued hospitality partners have to say about working with Santino Coffee.
        </p>
      </div>

      <!-- 3 Testimonial Cards Grid -->
      <div class="row g-4 align-items-stretch">
        
        <!-- Partner 1: BFC -->
        <div class="col-lg-4 col-md-6">
          <div class="hospitality-card">
            <div>
              <div class="partner-stars">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="partner-quote">
                “ Santino's espresso calibration and machine consistency have been outstanding. It helps us serve high-quality coffee across 50+ BFC outlets without any hassle. ”
              </p>
            </div>
            <div class="partner-author-row">
              <div class="partner-avatar">MR</div>
              <div>
                <div class="partner-author-name">MOHAMMAD RAHMAN</div>
                <div class="partner-author-role">Operations Manager<br>BFC (Best Fried Chicken)</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Partner 2: Cafe Aroma -->
        <div class="col-lg-4 col-md-6">
          <div class="hospitality-card">
            <div>
              <div class="partner-stars">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="partner-quote">
                “ We appreciate Santino's Rainforest Alliance certified roasted beans and their responsive machine service. They truly understand the needs of a busy hospitality business. ”
              </p>
            </div>
            <div class="partner-author-row">
              <div class="partner-avatar">SK</div>
              <div>
                <div class="partner-author-name">SAAD KHAN</div>
                <div class="partner-author-role">Franchise Director<br>Cafe Aroma</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Partner 3: Urban Brew Café -->
        <div class="col-lg-4 col-md-6">
          <div class="hospitality-card">
            <div>
              <div class="partner-stars">
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
              </div>
              <p class="partner-quote">
                “ Our retail roast packs have received great feedback from customers. The quality and consistency are exactly what we look for in a trusted coffee partner. ”
              </p>
            </div>
            <div class="partner-author-row">
              <div class="partner-avatar">NT</div>
              <div>
                <div class="partner-author-name">NAYAN TAHMID</div>
                <div class="partner-author-role">Head of Retail<br>Urban Brew Café</div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 6. PARTNER BRANDS STRIP + BECOME OUR CAFE PARTNER ACTION BANNER -->
  <section class="hospitality-partner-strip" id="partner-strip">
    <div class="container-fluid p-0">
      <div class="row g-0 align-items-stretch">
        
        <!-- Left Side: Hospitality Partner Brand Logos -->
        <div class="col-lg-8 partner-brands-col">
          
          <!-- Brand 1: BFC -->
          <div class="brand-item">
            <div class="brand-bfc">BFC</div>
            <div class="brand-sub">BEST FRIED CHICKEN</div>
          </div>

          <span class="brand-dot">•</span>

          <!-- Brand 2: Mövenpick -->
          <div class="brand-item">
            <div class="brand-movenpick">MÖVENPICK</div>
            <div class="brand-sub">HOTELS &amp; RESORTS</div>
          </div>

          <span class="brand-dot">•</span>

          <!-- Brand 3: The Ritz-Carlton -->
          <div class="brand-item">
            <div class="brand-icon"><i class="bi bi-shield-shaded"></i></div>
            <div class="brand-ritz">THE RITZ-CARLTON</div>
          </div>

          <span class="brand-dot">•</span>

          <!-- Brand 4: Citymax -->
          <div class="brand-item">
            <div class="brand-citymax">CITYMAX</div>
            <div class="brand-sub">HOTELS</div>
          </div>

          <span class="brand-dot">•</span>

          <!-- Brand 5: Café Aroma -->
          <div class="brand-item">
            <div class="brand-aroma">Café Aroma</div>
            <div class="brand-sub">CAFE &amp; BISTRO</div>
          </div>

          <span class="brand-dot">•</span>

          <!-- Brand 6: Urban Brew -->
          <div class="brand-item">
            <div class="brand-icon"><i class="bi bi-flower1"></i></div>
            <div class="brand-urban">URBAN BREW</div>
            <div class="brand-sub">COFFEE &amp; KITCHEN</div>
          </div>

        </div>

        <!-- Right Side: Luxury 'Become Our Cafe Partner' Action Block -->
        <div class="col-lg-4 cafe-cta-col">
          <div class="sec-pill-badge-wrap start light mb-2">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-flower2 me-1"></i> EXPAND WITH SANTINO</span>
            <span class="sec-pill-line"></span>
          </div>
          <h3 class="cafe-cta-title">Become Our Cafe Partner</h3>
          <p class="cafe-cta-desc">
            Turnkey machine setups, roasted beans &amp; barista coaching.
          </p>
          <div>
            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="btn-cafe-partner">
              PARTNER WITH US <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 7. ESPRESSO MACHINE SERVICES SECTION (3x2 SPLIT LUXURY CARDS) -->
  <section class="espresso-services-section" id="machine-services">
    
    <!-- Floating Corner Botanical Leaf Watermarks -->
    <div class="service-corner-leaf service-leaf-left" aria-hidden="true">
      <svg viewBox="0 0 64 64" fill="currentColor">
        <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
      </svg>
    </div>
    <div class="service-corner-leaf service-leaf-right" aria-hidden="true">
      <svg viewBox="0 0 64 64" fill="currentColor">
        <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
      </svg>
    </div>

    <div class="container position-relative" style="z-index: 2;">
      
      <!-- Section Header -->
      <div class="text-center mb-5">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-tools me-1"></i> TECHNICAL EXCELLENCE &amp; SUPPORT</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="service-section-title">Espresso Machine <em>Services</em></h2>
        <p class="service-section-desc">
          Expert care for your coffee equipment — keeping your business running smoothly, efficiently, and at its best.
        </p>
      </div>

      <!-- 6 Service Cards Grid (3x2) -->
      <div class="row g-4 align-items-stretch">
        
        <!-- Card 1: Installation & Setup -->
        <div class="col-lg-4 col-md-6">
          <div class="service-luxury-card">
            <div class="service-card-info">
              <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                  <span class="service-icon-box"><i class="bi bi-wrench"></i></span>
                  <span class="service-tag-badge">INSTALLATION</span>
                </div>
                <h5 class="service-card-title">Installation &amp; Setup</h5>
                <p class="service-card-desc">
                  Professional installation and setup for your espresso machines, ensuring optimal performance from day one.
                </p>
              </div>
              <div>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="service-card-link">
                  Learn More <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="service-card-media">
              <img src="<?php echo santino_img('imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg'); ?>" alt="Installation & Setup" class="service-card-img" loading="lazy">
            </div>
          </div>
        </div>

        <!-- Card 2: Preventive Maintenance (PM) -->
        <div class="col-lg-4 col-md-6">
          <div class="service-luxury-card">
            <div class="service-card-info">
              <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                  <span class="service-icon-box"><i class="bi bi-shield-check"></i></span>
                  <span class="service-tag-badge">PREVENTIVE</span>
                </div>
                <h5 class="service-card-title">Preventive Maintenance (PM)</h5>
                <p class="service-card-desc">
                  Regular maintenance to keep your machine running smoothly and extend its lifespan.
                </p>
              </div>
              <div>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="service-card-link">
                  Learn More <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="service-card-media">
              <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="Preventive Maintenance" class="service-card-img" loading="lazy">
            </div>
          </div>
        </div>

        <!-- Card 3: Emergency Breakdown & Repair -->
        <div class="col-lg-4 col-md-6">
          <div class="service-luxury-card">
            <div class="service-card-info">
              <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                  <span class="service-icon-box"><i class="bi bi-lightning-charge-fill"></i></span>
                  <span class="service-tag-badge">EMERGENCY</span>
                </div>
                <h5 class="service-card-title">Emergency Breakdown &amp; Repair</h5>
                <p class="service-card-desc">
                  Fast and reliable repair services to get you back in business with minimal downtime.
                </p>
              </div>
              <div>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="service-card-link">
                  Learn More <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="service-card-media">
              <img src="<?php echo santino_img('imgi_31_blackeagle2.jpg'); ?>" alt="Emergency Breakdown & Repair" class="service-card-img" loading="lazy">
            </div>
          </div>
        </div>

        <!-- Card 4: 100% Genuine Spare Parts -->
        <div class="col-lg-4 col-md-6">
          <div class="service-luxury-card">
            <div class="service-card-info">
              <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                  <span class="service-icon-box"><i class="bi bi-gear-fill"></i></span>
                  <span class="service-tag-badge">PARTS</span>
                </div>
                <h5 class="service-card-title">100% Genuine Spare Parts</h5>
                <p class="service-card-desc">
                  Original spare parts for lasting performance and peace of mind.
                </p>
              </div>
              <div>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="service-card-link">
                  Learn More <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="service-card-media">
              <img src="<?php echo santino_img('imgi_30_Blue-Stone-3_800x_526184df-2650-40b7-9dcf-e8af5b97527b.webp'); ?>" alt="Genuine Spare Parts" class="service-card-img" loading="lazy">
            </div>
          </div>
        </div>

        <!-- Card 5: Onsite Barista & Staff Training -->
        <div class="col-lg-4 col-md-6">
          <div class="service-luxury-card">
            <div class="service-card-info">
              <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                  <span class="service-icon-box"><i class="bi bi-people-fill"></i></span>
                  <span class="service-tag-badge">TRAINING</span>
                </div>
                <h5 class="service-card-title">Onsite Barista &amp; Staff Training</h5>
                <p class="service-card-desc">
                  Hands-on training to help your team make better coffee and get the most from your equipment.
                </p>
              </div>
              <div>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="service-card-link">
                  Learn More <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="service-card-media">
              <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Onsite Barista Training" class="service-card-img" loading="lazy">
            </div>
          </div>
        </div>

        <!-- Card 6: Machine Relocation & Moving -->
        <div class="col-lg-4 col-md-6">
          <div class="service-luxury-card">
            <div class="service-card-info">
              <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                  <span class="service-icon-box"><i class="bi bi-truck"></i></span>
                  <span class="service-tag-badge">MOVING</span>
                </div>
                <h5 class="service-card-title">Machine Relocation &amp; Moving</h5>
                <p class="service-card-desc">
                  Safe and professional relocation services for your espresso machines.
                </p>
              </div>
              <div>
                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="service-card-link">
                  Learn More <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="service-card-media">
              <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="Machine Relocation & Moving" class="service-card-img" loading="lazy">
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- 8. FEATURED EQUIPMENT & COFFEE (CLEAN LUXURY PRODUCT CARDS) -->
  <section class="featured-equipment-section" id="products">
    <div class="container">
      
      <!-- Section Header -->
      <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
        <div>
          <div class="sec-pill-badge-wrap start mb-2">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-star-fill me-1"></i> PREMIUM SELECTION</span>
            <span class="sec-pill-line"></span>
          </div>
          <h2 class="feat-sec-title">Featured Equipment &amp; <em>Coffee</em></h2>
          <p class="feat-sec-subtitle">
            Reliable machines, quality beans, and essential tools for the perfect cup.
          </p>
        </div>
        <div>
          <a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="btn-view-all">
            View All Products <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      <!-- Product Cards Grid -->
      <div class="row g-4 align-items-stretch">
        
        <!-- Product 1: La Marzocco Linea PB -->
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="equipment-card">
            <div>
              <div class="equipment-card-top">
                <span class="stock-badge in-stock">IN STOCK</span>
                <button class="btn-wishlist" aria-label="Add to wishlist"><i class="bi bi-suit-heart"></i></button>
              </div>
              <div class="equipment-img-box">
                <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="La Marzocco Linea PB" class="equipment-img" loading="lazy">
              </div>
              <h5 class="equipment-title">La Marzocco Linea PB</h5>
              <div class="equipment-price">৳ 4,250,000 <span class="currency">BDT</span></div>
              <div class="equipment-specs-row">
                <span class="spec-pill"><i class="bi bi-cup-hot"></i> Dual Boiler</span>
                <span class="spec-pill"><i class="bi bi-sliders"></i> PID Control</span>
                <span class="spec-pill"><i class="bi bi-speedometer2"></i> High Capacity</span>
              </div>
            </div>
            <div>
              <button class="btn-add-cart" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                <i class="bi bi-cart2"></i> Add to Cart <i class="bi bi-arrow-right ms-1"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Product 2: Mahlkönig EK43 Grinder -->
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="equipment-card">
            <div>
              <div class="equipment-card-top">
                <span class="stock-badge in-stock">IN STOCK</span>
                <button class="btn-wishlist" aria-label="Add to wishlist"><i class="bi bi-suit-heart"></i></button>
              </div>
              <div class="equipment-img-box">
                <img src="<?php echo santino_img('imgi_14_kalerm-202203230959.png'); ?>" alt="Mahlkönig EK43 Grinder" class="equipment-img" loading="lazy">
              </div>
              <h5 class="equipment-title">Mahlkönig EK43 Grinder</h5>
              <div class="equipment-price">৳ 680,000 <span class="currency">BDT</span></div>
              <div class="equipment-specs-row">
                <span class="spec-pill"><i class="bi bi-gear"></i> Flat Burrs</span>
                <span class="spec-pill"><i class="bi bi-crosshair"></i> High Precision</span>
                <span class="spec-pill"><i class="bi bi-box"></i> Low Retention</span>
              </div>
            </div>
            <div>
              <button class="btn-add-cart" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                <i class="bi bi-cart2"></i> Add to Cart <i class="bi bi-arrow-right ms-1"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Product 3: Nuova Simonelli Appia Life -->
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="equipment-card">
            <div>
              <div class="equipment-card-top">
                <span class="stock-badge in-stock">IN STOCK</span>
                <button class="btn-wishlist" aria-label="Add to wishlist"><i class="bi bi-suit-heart"></i></button>
              </div>
              <div class="equipment-img-box">
                <img src="<?php echo santino_img('imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg'); ?>" alt="Nuova Simonelli Appia Life" class="equipment-img" loading="lazy">
              </div>
              <h5 class="equipment-title">Nuova Simonelli Appia Life</h5>
              <div class="equipment-price">৳ 1,150,000 <span class="currency">BDT</span></div>
              <div class="equipment-specs-row">
                <span class="spec-pill"><i class="bi bi-cup-hot"></i> 2 Group</span>
                <span class="spec-pill"><i class="bi bi-lightning-charge"></i> Energy Saving</span>
                <span class="spec-pill"><i class="bi bi-shield-check"></i> Reliable</span>
              </div>
            </div>
            <div>
              <button class="btn-add-cart" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                <i class="bi bi-cart2"></i> Add to Cart <i class="bi bi-arrow-right ms-1"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Product 4: Santino Premium Blend (1kg) -->
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="equipment-card">
            <div>
              <div class="equipment-card-top">
                <span class="stock-badge best-seller">BEST SELLER</span>
                <button class="btn-wishlist" aria-label="Add to wishlist"><i class="bi bi-suit-heart"></i></button>
              </div>
              <div class="equipment-img-box">
                <img src="<?php echo santino_img('imgi_22_Untitleddesign_4.png'); ?>" alt="Santino Premium Blend (1kg)" class="equipment-img" loading="lazy">
              </div>
              <h5 class="equipment-title">Santino Premium Blend (1kg)</h5>
              <div class="equipment-price">৳ 2,800 <span class="currency">BDT</span></div>
              <div class="equipment-specs-row">
                <span class="spec-pill"><i class="bi bi-fire"></i> Rich Aroma</span>
                <span class="spec-pill"><i class="bi bi-droplet"></i> Balanced Taste</span>
                <span class="spec-pill"><i class="bi bi-tree"></i> 100% Arabica</span>
              </div>
            </div>
            <div>
              <button class="btn-add-cart" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                <i class="bi bi-cart2"></i> Add to Cart <i class="bi bi-arrow-right ms-1"></i>
              </button>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 9. SANTINO PRIVILEGE CLUB & QUICK REGISTRATION SECTION (ULTRA-LUXURY DESIGN) -->
  <section class="santino-club-section" id="membership-registration">
    
    <!-- Floating Corner Botanical Leaf / Coffee Bean Visual Accents -->
    <div class="club-corner-deco club-deco-top-right" aria-hidden="true">
      <svg width="220" height="200" viewBox="0 0 220 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Coffee Leaf 1 -->
        <g transform="translate(110, -20) rotate(25)" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.15))">
          <path d="M0,0 C35,15 70,55 80,105 C45,95 20,65 0,0 Z" fill="#1b4d3e"/>
          <path d="M0,0 C35,15 70,55 80,105" stroke="#2d6e5a" stroke-width="2"/>
          <path d="M80,105 C55,100 25,80 0,0 C15,35 30,70 80,105 Z" fill="#2d6e5a" opacity="0.85"/>
        </g>
        <!-- Coffee Leaf 2 -->
        <g transform="translate(140, 20) rotate(55)" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.15))">
          <path d="M0,0 C30,12 60,45 70,90 C40,80 15,55 0,0 Z" fill="#235c4b"/>
          <path d="M0,0 C30,12 60,45 70,90" stroke="#36806a" stroke-width="1.5"/>
        </g>
        <!-- Roasted Coffee Beans -->
        <g transform="translate(170, 75) rotate(-15)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
          <ellipse cx="12" cy="18" rx="10" ry="15" fill="#3b2219"/>
          <path d="M12,4 C14,11 9,18 13,25 C15,29 11,32 12,32" stroke="#1f120c" stroke-width="2" stroke-linecap="round"/>
          <ellipse cx="9" cy="12" rx="3" ry="6" fill="#543325" opacity="0.6"/>
        </g>
        <g transform="translate(185, 120) rotate(35)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
          <ellipse cx="10" cy="15" rx="8" ry="12" fill="#4a2c1f"/>
          <path d="M10,4 C11,9 8,15 11,20 C12,23 9,26 10,26" stroke="#26160e" stroke-width="1.8" stroke-linecap="round"/>
        </g>
        <g transform="translate(145, 145) rotate(70)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
          <ellipse cx="10" cy="14" rx="7" ry="11" fill="#3b2219"/>
          <path d="M10,4 C11,9 8,14 11,19" stroke="#1a0c07" stroke-width="1.5"/>
        </g>
        <g transform="translate(130, 95) rotate(-45)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
          <ellipse cx="9" cy="12" rx="6" ry="9" fill="#2c170f"/>
          <path d="M9,3 C10,7 8,11 10,15" stroke="#120804" stroke-width="1.5"/>
        </g>
      </svg>
    </div>

    <div class="club-corner-deco club-deco-bottom-left" aria-hidden="true">
      <svg width="220" height="200" viewBox="0 0 220 200" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- Coffee Leaf 1 -->
        <g transform="translate(30, 190) rotate(-145)" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.15))">
          <path d="M0,0 C35,15 70,55 80,105 C45,95 20,65 0,0 Z" fill="#1b4d3e"/>
          <path d="M0,0 C35,15 70,55 80,105" stroke="#2d6e5a" stroke-width="2"/>
          <path d="M80,105 C55,100 25,80 0,0 C15,35 30,70 80,105 Z" fill="#2d6e5a" opacity="0.85"/>
        </g>
        <!-- Coffee Leaf 2 -->
        <g transform="translate(10, 150) rotate(-110)" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.15))">
          <path d="M0,0 C30,12 60,45 70,90 C40,80 15,55 0,0 Z" fill="#235c4b"/>
          <path d="M0,0 C30,12 60,45 70,90" stroke="#36806a" stroke-width="1.5"/>
        </g>
        <!-- Roasted Coffee Beans -->
        <g transform="translate(15, 75) rotate(20)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
          <ellipse cx="12" cy="18" rx="10" ry="15" fill="#3b2219"/>
          <path d="M12,4 C14,11 9,18 13,25 C15,29 11,32 12,32" stroke="#1f120c" stroke-width="2" stroke-linecap="round"/>
          <ellipse cx="9" cy="12" rx="3" ry="6" fill="#543325" opacity="0.6"/>
        </g>
        <g transform="translate(35, 45) rotate(-30)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
          <ellipse cx="10" cy="15" rx="8" ry="12" fill="#4a2c1f"/>
          <path d="M10,4 C11,9 8,15 11,20 C12,23 9,26 10,26" stroke="#26160e" stroke-width="1.8" stroke-linecap="round"/>
        </g>
        <g transform="translate(70, 105) rotate(60)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
          <ellipse cx="10" cy="14" rx="7" ry="11" fill="#3b2219"/>
          <path d="M10,4 C11,9 8,14 11,19" stroke="#1a0c07" stroke-width="1.5"/>
        </g>
        <g transform="translate(20, 120) rotate(-65)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
          <ellipse cx="9" cy="12" rx="6" ry="9" fill="#2c170f"/>
          <path d="M9,3 C10,7 8,11 10,15" stroke="#120804" stroke-width="1.5"/>
        </g>
      </svg>
    </div>

    <div class="container position-relative" style="z-index: 2;">
      
      <!-- Section Header -->
      <div class="text-center mb-4">
        <div class="sec-pill-badge-wrap light mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-people-fill me-1"></i> SANTINO PRIVILEGE CLUB</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="club-sec-title">
          Join Bangladesh's Premier<br>Coffee Community
        </h2>
        <p class="club-sec-subtitle">
          Become a Santino Club member to unlock exclusive roastery allocations, VIP wholesale pricing on beans, priority technician dispatch, and private barista workshops.
        </p>
        <div class="club-divider-accent">
          <span></span>
          <i class="bi bi-gem"></i>
          <span></span>
        </div>
      </div>

      <!-- Main 2-Card Row -->
      <div class="row g-4 align-items-stretch">
        
        <!-- Left Column: Member Benefits Card -->
        <div class="col-lg-6">
          <div class="club-benefits-card">
            
            <div class="benefits-card-content">
              <div class="benefits-label-header">
                <span>MEMBER BENEFITS</span>
                <hr>
              </div>

              <div class="benefits-split-row">
                <!-- Benefits List (Left Side) -->
                <div class="benefits-list-col">
                  
                  <div class="benefit-item">
                    <div class="benefit-icon-round">%</div>
                    <div class="benefit-text">
                      <h6 class="benefit-title">15% VIP Bean Discount</h6>
                      <p class="benefit-desc">Special roastery pricing applied automatically on all orders.</p>
                    </div>
                  </div>

                  <div class="benefit-divider"></div>

                  <div class="benefit-item">
                    <div class="benefit-icon-round">
                      <i class="bi bi-cup-hot-fill"></i>
                    </div>
                    <div class="benefit-text">
                      <h6 class="benefit-title">Exclusive Micro-Lot Tastings</h6>
                      <p class="benefit-desc">Complimentary seasonal cupping sessions at Santino Academy.</p>
                    </div>
                  </div>

                  <div class="benefit-divider"></div>

                  <div class="benefit-item">
                    <div class="benefit-icon-round">
                      <i class="bi bi-wrench"></i>
                    </div>
                    <div class="benefit-text">
                      <h6 class="benefit-title">Priority Machine Maintenance</h6>
                      <p class="benefit-desc">Fast-track 24/7 technical hotline and emergency site dispatch.</p>
                    </div>
                  </div>

                </div>

                <!-- Slanted / Angled Santino Coffee Cup Image (Right Side) -->
                <div class="benefit-media-col">
                  <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="Santino Coffee Cup & Beans" class="benefit-media-img" loading="lazy">
                </div>
              </div>
            </div>

            <!-- Bottom Support Strip -->
            <div class="club-support-bar">
              <div class="support-left">
                <div class="support-icon">
                  <i class="bi bi-telephone-fill"></i>
                </div>
                <div>
                  <div class="support-sub">MEMBERSHIP SUPPORT</div>
                  <div class="support-phone">+880 1613-334514</div>
                </div>
              </div>

              <div class="support-divider"></div>

              <div class="support-right">
                <div class="support-clock-icon">
                  <i class="bi bi-clock"></i>
                </div>
                <div>
                  <div class="support-sub">Response in &lt; 2 Hours</div>
                  <div class="support-note">Our team is always here for you.</div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Right Column: Quick Registration Form Card -->
        <div class="col-lg-6">
          <div class="club-register-card">
            
            <div class="benefits-label-header mb-2">
              <i class="bi bi-person-plus-fill me-1"></i>
              <span>QUICK REGISTRATION</span>
              <hr>
            </div>

            <h3 class="club-form-title">Become a Santino Club Member</h3>
            <p class="club-form-subtitle">Get exclusive access, special pricing, and premium support — all in one place.</p>

            <form onsubmit="alert('Thank you! Your Santino Coffee Club Membership has been registered successfully. A digital pass will be sent to your email.'); return false;">
              
              <div class="row g-3">
                
                <!-- Full Name -->
                <div class="col-md-6">
                  <div class="club-input-group">
                    <label class="club-input-label">FULL NAME <span class="text-danger">*</span></label>
                    <div class="club-input-box">
                      <i class="bi bi-person club-input-icon"></i>
                      <input type="text" class="club-form-input" placeholder="e.g. Tanvir Ahmed" required>
                    </div>
                  </div>
                </div>

                <!-- Phone / WhatsApp -->
                <div class="col-md-6">
                  <div class="club-input-group">
                    <label class="club-input-label">PHONE / WHATSAPP NUMBER <span class="text-danger">*</span></label>
                    <div class="club-input-box">
                      <i class="bi bi-whatsapp club-input-icon"></i>
                      <input type="tel" class="club-form-input" placeholder="+880 17XX-XXXXXX" required>
                    </div>
                  </div>
                </div>

                <!-- Email Address -->
                <div class="col-md-6">
                  <div class="club-input-group">
                    <label class="club-input-label">EMAIL ADDRESS <span class="text-danger">*</span></label>
                    <div class="club-input-box">
                      <i class="bi bi-envelope club-input-icon"></i>
                      <input type="email" class="club-form-input" placeholder="e.g. tanvir@company.com" required>
                    </div>
                  </div>
                </div>

                <!-- Business Type Dropdown -->
                <div class="col-md-6">
                  <div class="club-input-group">
                    <label class="club-input-label">BUSINESS TYPE</label>
                    <div class="club-input-box">
                      <i class="bi bi-shop club-input-icon"></i>
                      <select class="club-form-select">
                        <option value="cafe">Café / Coffee Shop</option>
                        <option value="restaurant">Restaurant / Hotel</option>
                        <option value="office">Corporate Office</option>
                        <option value="individual">Home Barista / Individual</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Requirements Textarea -->
                <div class="col-12">
                  <div class="club-input-group">
                    <label class="club-input-label">YOUR REQUIREMENTS &amp; QUESTIONS</label>
                    <div class="club-input-box club-input-box-textarea">
                      <i class="bi bi-chat-left-text club-input-icon-textarea"></i>
                      <textarea class="club-form-textarea" placeholder="Tell us about your machine models of interest, monthly bean volume, or cafe launch timeline..."></textarea>
                    </div>
                  </div>
                </div>

              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn-register-club">
                REGISTER MEMBERSHIP <i class="bi bi-arrow-right-circle-fill ms-1"></i>
              </button>

              <!-- Footer Trust Line -->
              <div class="club-trust-note mt-3">
                <i class="bi bi-shield-check"></i>
                <span>Zero Annual Fees • No Credit Card Required</span>
              </div>

            </form>

          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 10. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION) -->
  <section class="faq-section" id="faqs">
    <div class="container">
      <div class="sec-heading-center">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-question-circle-fill me-1"></i> FREQUENTLY ASKED QUESTIONS</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="sec-title">Frequently Asked Questions</h2>
        <div class="sec-subtitle">Everything you need to know about Santino equipment & roastery</div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="accordion" id="faqAccordionKaapi">
            
            <div class="accordion-item mb-3 border rounded-3 overflow-hidden shadow-sm">
              <h2 class="accordion-header">
                <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faqK1">
                  Why choose Santino Coffee?
                </button>
              </h2>
              <div id="faqK1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordionKaapi">
                <div class="accordion-body text-muted">
                  Santino Coffee bridges heritage and innovation to empower coffee businesses across Asia. With decades of roasting experience, FSSC22000 certification, and authorized distribution of Victoria Arduino and Nuova Simonelli, we provide complete, reliable coffee solutions.
                </div>
              </div>
            </div>

            <div class="accordion-item mb-3 border rounded-3 overflow-hidden shadow-sm">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faqK2">
                  What coffee equipment and solutions do you provide?
                </button>
              </h2>
              <div id="faqK2" class="accordion-collapse collapse" data-bs-parent="#faqAccordionKaapi">
                <div class="accordion-body text-muted">
                  We supply commercial espresso machines, superautomatics, CAYE Bionic Barista robots, precision grinders, 3TEMP batch brewers, Rainforest Alliance certified coffee beans, OEM private label roasting, and full café setup consulting.
                </div>
              </div>
            </div>

            <div class="accordion-item mb-3 border rounded-3 overflow-hidden shadow-sm">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faqK3">
                  Do you offer barista academy certification and competition coaching?
                </button>
              </h2>
              <div id="faqK3" class="accordion-collapse collapse" data-bs-parent="#faqAccordionKaapi">
                <div class="accordion-body text-muted">
                  Yes, our certified trainers lead foundational espresso workshops, advanced latte art masterclasses, and WBC (World Barista Championship) & WBrC competition mentorship.
                </div>
              </div>
            </div>

            <div class="accordion-item mb-3 border rounded-3 overflow-hidden shadow-sm">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#faqK4">
                  What after-sales service and preventive maintenance is available?
                </button>
              </h2>
              <div id="faqK4" class="accordion-collapse collapse" data-bs-parent="#faqAccordionKaapi">
                <div class="accordion-body text-muted">
                  We provide dedicated technical support, scheduled preventive maintenance contracts, on-site diagnostics, and genuine OEM parts to ensure uninterrupted beverage service.
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 11. ACADEMY & COMPETITIONS -->
  <section class="academy-section-v2" id="training">
    <div class="container">
      
      <!-- Section Header -->
      <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
        <div>
          <div class="sec-pill-badge-wrap start mb-2">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-mortarboard me-1"></i> ACADEMY &amp; COMPETITIONS</span>
            <span class="sec-pill-line"></span>
          </div>
          <h2 class="academy-sec-title">Learn, Compete, Grow</h2>
          <p class="academy-sec-desc">Enhance your skills, gain industry knowledge, and be part of exciting coffee competitions with Santino.</p>
        </div>
        <div>
          <a href="#training" class="academy-view-all">
            <span>View All Programs</span>
            <i class="bi bi-arrow-right ms-1"></i>
          </a>
        </div>
      </div>

      <!-- 2 Cards Row -->
      <div class="row g-4">
        
        <!-- Card 1: Training & Education -->
        <div class="col-lg-6">
          <div class="academy-prog-card">
            <div class="academy-card-content">
              <div class="academy-card-badge">
                <span class="badge-icon"><i class="bi bi-mortarboard-fill"></i></span>
                <span class="badge-text">TRAINING &amp; EDUCATION</span>
              </div>
              <h3 class="academy-card-title">Santino Coffee Academy</h3>
              <p class="academy-card-desc">Structured training, hands-on practice, and expert guidance to help baristas and coffee enthusiasts build a professional future.</p>
              <a href="#contact" class="academy-card-link">
                <span>Learn More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
            <div class="academy-card-media">
              <div class="media-wave-backdrop"></div>
              <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="Santino Coffee Academy Barista Training" class="academy-card-img">
            </div>
          </div>
        </div>

        <!-- Card 2: Competitions -->
        <div class="col-lg-6">
          <div class="academy-prog-card">
            <div class="academy-card-content">
              <div class="academy-card-badge">
                <span class="badge-icon"><i class="bi bi-trophy-fill"></i></span>
                <span class="badge-text">COMPETITIONS</span>
              </div>
              <h3 class="academy-card-title">WBC &amp; WBrC Coaching</h3>
              <p class="academy-card-desc">Championship-level preparation and personalized coaching for baristas ready to compete on the global stage.</p>
              <a href="#contact" class="academy-card-link">
                <span>Learn More</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
            <div class="academy-card-media">
              <div class="media-wave-backdrop"></div>
              <img src="<?php echo santino_img('imgi_24_santino_-_250522-07240.jpg'); ?>" alt="WBC and WBrC Championship Coaching" class="academy-card-img">
            </div>
          </div>
        </div>

      </div>

      <!-- Slider Indicator Dots -->
      <div class="academy-dots-indicator">
        <span class="academy-dot"></span>
        <span class="academy-dot active"></span>
        <span class="academy-dot"></span>
      </div>

    </div>
  </section>

  <!-- 12. SPEAK TO A COFFEE SPECIALIST -->
  <section class="specialist-section-v2" id="contact">
    <div class="container">
      <div class="specialist-luxury-card">
        <div class="row g-0">
          
          <!-- Left Column: Dark Green VIP Destination Pane -->
          <div class="col-lg-6 specialist-dark-pane">
            
            <!-- Top Editorial Header -->
            <div class="specialist-top-header mb-3">
              <div class="sec-pill-badge-wrap start light mb-2">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> VIP CONSULTATION</span>
                <span class="sec-pill-line"></span>
              </div>
              <h3 class="specialist-pane-title">Let's Build Your <em>Coffee Destination</em></h3>
              <p class="specialist-pane-desc mb-0">
                Whether setting up a luxury café, upgrading hotel espresso stations, or ordering custom roasted bean blends — our master roasters and technical engineers are here to support your success.
              </p>
            </div>

            <!-- Middle Content: Showcase Image + Perks Grid -->
            <div class="specialist-mid-layout">
              <!-- Coffee Cup Showcase Card -->
              <div class="specialist-cup-wrap d-none d-md-block">
                <img src="<?php echo santino_img('santino_cup_specialist.jpg'); ?>" alt="Santino Speciality Coffee Cup" class="specialist-cup-img">
                <div class="specialist-cup-badge">
                  <i class="bi bi-patch-check-fill text-warning"></i> Certified Roasters
                </div>
              </div>

              <!-- VIP Perks List -->
              <div class="specialist-perks-list">
                <div class="specialist-perk-row">
                  <div class="perk-icon-box">
                    <i class="bi bi-headset"></i>
                  </div>
                  <div>
                    <h4 class="perk-item-title">Free Commercial Consultation</h4>
                    <p class="perk-item-desc">Custom workflow design &amp; machine sizing.</p>
                  </div>
                </div>

                <div class="specialist-perk-row">
                  <div class="perk-icon-box">
                    <i class="bi bi-award"></i>
                  </div>
                  <div>
                    <h4 class="perk-item-title">Direct Roastery Wholesale Pricing</h4>
                    <p class="perk-item-desc">FSSC22000 certified beans &amp; custom blends.</p>
                  </div>
                </div>

                <div class="specialist-perk-row">
                  <div class="perk-icon-box">
                    <i class="bi bi-tools"></i>
                  </div>
                  <div>
                    <h4 class="perk-item-title">24/7 Technical Support &amp; Training</h4>
                    <p class="perk-item-desc">Full installation, warranty &amp; barista coaching.</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Trust Guarantee Badges -->
            <div class="specialist-trust-tags my-2">
              <span class="trust-tag-item"><i class="bi bi-shield-check text-success"></i> Official Importer</span>
              <span class="trust-tag-item"><i class="bi bi-clock-history text-info"></i> 4-Hr SLA Response</span>
              <span class="trust-tag-item"><i class="bi bi-gem text-warning"></i> 100% Genuine Parts</span>
            </div>

            <!-- Bottom Support & Hotline Bar -->
            <div class="specialist-hotline-bar mt-2">
              <div class="hotline-phone-wrap">
                <div class="hotline-circle-icon"><i class="bi bi-telephone-fill"></i></div>
                <div>
                  <span class="hotline-sub">DIRECT HOTLINE</span>
                  <a href="tel:+8801613334514" class="hotline-main-num">+880 1613-334514</a>
                </div>
              </div>
              <div class="hotline-v-sep"></div>
              <div class="hotline-time-wrap">
                <div class="hotline-clock-icon"><i class="bi bi-clock"></i></div>
                <div>
                  <span class="hotline-time-title">Response in &lt;2 Hours</span>
                  <span class="hotline-time-desc">Our team is always here for you.</span>
                </div>
              </div>
            </div>

          </div>

          <!-- Right Column: Interactive Consultation Form -->
          <div class="col-lg-6 specialist-form-pane">
            <div class="mb-3">
              <span class="specialist-partner-pill">
                <i class="bi bi-people-fill me-1"></i> PARTNER WITH SANTINO
              </span>
              <h3 class="specialist-form-title">Speak to a Coffee Specialist</h3>
              <p class="specialist-form-subtitle">Fill in your details below and our team will get back to you promptly with a tailored proposal.</p>
            </div>

            <form onsubmit="alert('Thank you! Your inquiry has been received. Our specialist will contact you shortly.'); return false;">
              <div class="row g-3">
                
                <!-- Full Name -->
                <div class="col-md-6">
                  <div class="specialist-input-group">
                    <label class="specialist-input-label">FULL NAME <span class="req-star">*</span></label>
                    <div class="specialist-input-box">
                      <i class="bi bi-person specialist-field-icon"></i>
                      <input type="text" class="specialist-form-input" placeholder="e.g. Tanvir Ahmed" required>
                    </div>
                  </div>
                </div>

                <!-- Business Email -->
                <div class="col-md-6">
                  <div class="specialist-input-group">
                    <label class="specialist-input-label">BUSINESS EMAIL <span class="req-star">*</span></label>
                    <div class="specialist-input-box">
                      <i class="bi bi-envelope specialist-field-icon"></i>
                      <input type="email" class="specialist-form-input" placeholder="e.g. tanvir@company.com" required>
                    </div>
                  </div>
                </div>

                <!-- Phone / Whatsapp -->
                <div class="col-md-6">
                  <div class="specialist-input-group">
                    <label class="specialist-input-label">PHONE / WHATSAPP NUMBER <span class="req-star">*</span></label>
                    <div class="specialist-input-box">
                      <i class="bi bi-whatsapp specialist-field-icon"></i>
                      <input type="tel" class="specialist-form-input" placeholder="+880 17XX-XXXXXX" required>
                    </div>
                  </div>
                </div>

                <!-- Business Type -->
                <div class="col-md-6">
                  <div class="specialist-input-group">
                    <label class="specialist-input-label">BUSINESS TYPE</label>
                    <div class="specialist-input-box">
                      <i class="bi bi-shop specialist-field-icon"></i>
                      <select class="specialist-form-input specialist-form-select">
                        <option value="cafe">Café / Coffee Shop</option>
                        <option value="restaurant">Restaurant / Hotel</option>
                        <option value="office">Corporate Office</option>
                        <option value="retail">Supermarket / Retail Resale</option>
                        <option value="academy">Barista Academy / Training</option>
                        <option value="other">Other Inquiries</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Requirements Textarea -->
                <div class="col-12">
                  <div class="specialist-input-group">
                    <label class="specialist-input-label">YOUR REQUIREMENTS &amp; QUESTIONS <span class="req-star">*</span></label>
                    <div class="specialist-input-box specialist-input-box-textarea">
                      <i class="bi bi-chat-left-text specialist-field-icon-textarea"></i>
                      <textarea class="specialist-form-textarea" rows="3" placeholder="Tell us about your machine models of interest, monthly bean volume, or cafe launch timeline..." required></textarea>
                    </div>
                  </div>
                </div>

                <!-- Submit CTA Button -->
                <div class="col-12">
                  <button type="submit" class="btn-specialist-cta">
                    <span>SUBMIT INQUIRY &amp; GET QUOTE</span>
                    <i class="bi bi-arrow-right"></i>
                  </button>
                </div>

                <!-- Trust Badges -->
                <div class="col-12">
                  <div class="specialist-trust-footer">
                    <span><i class="bi bi-shield-check"></i> Zero Annual Fees</span>
                    <span class="dot-sep">•</span>
                    <span>No Credit Card Required</span>
                  </div>
                </div>

              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER (REDESIGNED ULTRA-LUXURY FOOTER) -->

<?php
get_footer();
