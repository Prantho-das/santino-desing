<?php
/**
 * Template Name: Santino Our Heritage & Journey
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

<!-- 1. VIDEO HERO BANNER (Luckin Our-Story Style) -->
  <section class="story-video-hero position-relative overflow-hidden">
    
    <!-- Background Video with Loop and Poster Fallback -->
    <div class="story-video-wrap">
      <video class="story-video-bg" autoplay muted loop playsinline poster="<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>">
        <source src="https://web.luckincdn.com/default/assets/ourstory-41023fc9.webm" type="video/webm">
        <source src="https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/ab6140f6-129c-4ae9-aaa0-20190c43183b.mp4" type="video/mp4">
      </video>
      <div class="story-video-overlay"></div>
    </div>

    <!-- Video Hero Content Overlay -->
    <div class="container position-relative story-video-content-box">
      <div class="row">
        <div class="col-xl-8 col-lg-10 reveal-left">
          <span class="badge-tag-pill mb-3" style="background: rgba(255, 255, 255, 0.15); color: #ffffff; border-color: rgba(255, 255, 255, 0.3);">
            <i class="bi bi-patch-check-fill text-warning me-1"></i> SINCE 1996 • 30+ YEARS ROASTING HERITAGE
          </span>
          <h1 class="story-hero-heading text-white">
            The Game Changer in Specialty Coffee Culture
          </h1>
          <p class="story-hero-lead text-white-50">
            From direct origin estates in Ethiopia and Colombia to precision roasting labs, championship barista academies, and nationwide retail supermarket presence.
          </p>
          <div class="d-flex flex-wrap gap-3 mt-4">
            <a href="#vision" class="btn-hero-lifestyle">
              Discover Our Story <i class="bi bi-arrow-down-circle ms-1"></i>
            </a>
            <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-hero-outline">
              Explore Menu <i class="bi bi-cup-hot ms-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Live Floating Stats Bar at Hero Bottom -->
    <div class="container story-hero-metrics reveal">
      <div class="row g-3 g-md-4 text-center">
        <div class="col-md-3 col-6">
          <div class="metric-card hover-lift">
            <div class="metric-num">30+</div>
            <div class="metric-label">Years of Roasting Mastery</div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="metric-card hover-lift">
            <div class="metric-num">500+</div>
            <div class="metric-label">Hotels, Cafes & Corporate Hubs</div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="metric-card hover-lift">
            <div class="metric-num">100%</div>
            <div class="metric-label">FSSC22000 Food Certified</div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="metric-card hover-lift">
            <div class="metric-num">1,000+</div>
            <div class="metric-label">Certified Barista Graduates</div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- 2. BRAND VISION & PHILOSOPHY (Standard Narrative Format) -->
  <section class="story-vision-section py-5 my-lg-4" id="vision">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-xl-9 col-lg-10 reveal">
          <span class="badge-tag-pill mb-2"><i class="bi bi-compass-fill me-1 text-teal"></i> OUR PURPOSE & VISION</span>
          <h2 class="sec-title mb-4">Innovation Grounded in Heritage</h2>
          <p class="story-vision-text">
            Santino Coffee was born with a single mission: to empower coffee entrepreneurs, businesses, and coffee lovers with world-class beans, precision machinery, and deep sensory knowledge. We believe that every cup tells a story of dedicated farmers, meticulous roast masters, and passionate baristas.
          </p>
          <div class="story-vision-highlight-box mt-4 p-4 rounded-4 hover-lift">
            <div class="row g-4 align-items-center">
              <div class="col-md-4 border-end-md">
                <h4 class="fw-bold mb-1" style="color: var(--santino-teal);">Authentic Origin</h4>
                <p class="text-muted small mb-0">100% ethically sourced Rainforest Alliance certified green beans.</p>
              </div>
              <div class="col-md-4 border-end-md">
                <h4 class="fw-bold mb-1" style="color: var(--santino-teal);">Precision Roasting</h4>
                <p class="text-muted small mb-0">Custom roast profiles tailored to temperature, humidity & workflow.</p>
              </div>
              <div class="col-md-4">
                <h4 class="fw-bold mb-1" style="color: var(--santino-teal);">Continuous Care</h4>
                <p class="text-muted small mb-0">24/7 technical breakdown support and annual equipment servicing.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 3. SPLIT STORY SECTIONS (One Side Image, One Side Description) -->
  <section class="story-split-chapters-section">
    <div class="container">
      
      <!-- Chapter 1: The Roastery Mastery (Image Left, Text Right) -->
      <div class="story-split-row row align-items-center g-5 mb-5 pb-lg-5">
        <div class="col-lg-6 reveal-left">
          <div class="story-split-img-wrapper hover-img-zoom">
            <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Artisan Roastery" class="story-split-img rounded-4 shadow-xl">
            <div class="story-img-badge">
              <i class="bi bi-fire text-danger fs-4"></i>
              <div>
                <strong>Artisan Roastery Lab</strong>
                <span>Small Batch Custom Roasts</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 ps-lg-5 reveal-right">
          <span class="badge-tag-pill mb-3">CHAPTER 01</span>
          <h3 class="story-chapter-title">Artisan Roasting & Quality Without Compromise</h3>
          <p class="story-chapter-desc">
            Everything we roast represents an unyielding dedication to excellence. Our state-of-the-art roastery in Singapore and Bangladesh operates under strict FSSC22000 food safety certifications, roasting single origins and private label blends with high reproducibility.
          </p>
          <ul class="story-bullet-list">
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>Rainforest Alliance Certified:</strong> Direct farm relationships ensuring sustainable livelihood for growers.</li>
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>Custom Private Label OEM:</strong> Tailored flavor curves designed for five-star hotels and specialty roasteries.</li>
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>Real-Time Profile Tracking:</strong> Digital thermocouple logging ensuring ±0.5°C batch consistency.</li>
          </ul>
          <a href="index.html#beans" class="btn btn-outline-dark fw-bold px-4 py-2 mt-3 rounded-3 hover-lift">
            Explore Bean Collections →
          </a>
        </div>
      </div>

      <!-- Chapter 2: Machinery & Automation (Text Left, Image Right) -->
      <div class="story-split-row row align-items-center g-5 mb-5 pb-lg-5 flex-lg-row-reverse">
        <div class="col-lg-6 reveal-right">
          <div class="story-split-img-wrapper hover-img-zoom">
            <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="Victoria Arduino Machinery" class="story-split-img rounded-4 shadow-xl">
            <div class="story-img-badge">
              <i class="bi bi-cpu-fill text-primary fs-4"></i>
              <div>
                <strong>Next-Gen Automation</strong>
                <span>Victoria Arduino & Bionic Robots</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 pe-lg-5 reveal-left">
          <span class="badge-tag-pill mb-3">CHAPTER 02</span>
          <h3 class="story-chapter-title">State-of-the-Art Espresso & Bionic Robotics</h3>
          <p class="story-chapter-desc">
            We partner with the world's most prestigious espresso machine innovators — Victoria Arduino, Nuova Simonelli, Kalerm, and CAYE Robotics — delivering commercial extraction consistency that elevates customer retention and operational speed.
          </p>
          <ul class="story-bullet-list">
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>T3 Genius PureBrew Technology:</strong> Variable water flow and gravimetric dosing on Victoria Arduino Black Eagle & Eagle One.</li>
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>CAYE Bionic Barista Robotic Arms:</strong> Fully automated 6-axis barista robots delivering flawless latte art in under 60 seconds.</li>
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>Turnkey Machine Leasing:</strong> Complete corporate rental packages with guaranteed zero-downtime maintenance.</li>
          </ul>
          <a href="index.html#products" class="btn btn-outline-dark fw-bold px-4 py-2 mt-3 rounded-3 hover-lift">
            View Machine Catalog →
          </a>
        </div>
      </div>

      <!-- Chapter 3: Barista Academy (Image Left, Text Right) -->
      <div class="story-split-row row align-items-center g-5 mb-5 pb-lg-5">
        <div class="col-lg-6 reveal-left">
          <div class="story-split-img-wrapper hover-img-zoom">
            <img src="<?php echo santino_img('bd-barista-training.jpg'); ?>" alt="Barista Training Academy" class="story-split-img rounded-4 shadow-xl">
            <div class="story-img-badge">
              <i class="bi bi-trophy-fill text-warning fs-4"></i>
              <div>
                <strong>Championship Coaching</strong>
                <span>WBC & WBrC Certified Trainers</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 ps-lg-5 reveal-right">
          <span class="badge-tag-pill mb-3">CHAPTER 03</span>
          <h3 class="story-chapter-title">Empowering the Next Generation of Coffee Leaders</h3>
          <p class="story-chapter-desc">
            Knowledge is the heartbeat of our craft. Santino Barista Academy offers internationally structured certification programs, crop-to-cup sensory training, and competitive coaching for aspiring champions.
          </p>
          <ul class="story-bullet-list">
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>Foundational to Master Barista:</strong> Milk texturing, espresso calibration, workflow ergonomics, and cupping.</li>
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>Corporate Staff Upskilling:</strong> Standardizing beverage execution across multi-branch restaurant operations.</li>
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>Specialty Brewing Modules:</strong> V60, Chemex, Aeropress, Cold Brew, and Syphon sensory mastery.</li>
          </ul>
          <button class="btn btn-dark fw-bold px-4 py-2 mt-3 rounded-3 hover-glow" style="background-color: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#enquiryModal">
            Enroll in Barista Academy →
          </button>
        </div>
      </div>

      <!-- Chapter 4: Nationwide Retail & Foodservice (Text Left, Image Right) -->
      <div class="story-split-row row align-items-center g-5 flex-lg-row-reverse">
        <div class="col-lg-6 reveal-right">
          <div class="story-split-img-wrapper hover-img-zoom">
            <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="Shwapno Supermarket Partnership" class="story-split-img rounded-4 shadow-xl">
            <div class="story-img-badge">
              <i class="bi bi-shop-window text-success fs-4"></i>
              <div>
                <strong>Nationwide Presence</strong>
                <span>Shwapno Superstores & BFC Dining</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 pe-lg-5 reveal-left">
          <span class="badge-tag-pill mb-3">CHAPTER 04</span>
          <h3 class="story-chapter-title">Everyday Specialty Coffee for Every Community</h3>
          <p class="story-chapter-desc">
            We are bridging the gap between luxury specialty coffee and everyday accessibility. Today, Santino roasted bean packs are available on retail shelves at Shwapno Superstores nationwide, and freshly brewed coffees are served across 50+ BFC restaurant locations.
          </p>
          <ul class="story-bullet-list">
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>100+ Shwapno Outlets:</strong> Freshly sealed 250g & 1kg bags available at your neighborhood supermarket.</li>
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>50+ BFC Quick Service Bars:</strong> Hot and iced espresso beverages brewed on authentic commercial Italian machines.</li>
            <li><i class="bi bi-check-circle-fill text-teal me-2"></i> <strong>B2B Direct Supply:</strong> Fast scheduled deliveries maintaining optimal bean degassing periods.</li>
          </ul>
          <a href="menu.html#branches" class="btn btn-outline-dark fw-bold px-4 py-2 mt-3 rounded-3 hover-lift">
            Find Nearest Outlet →
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- 4. DUAL-TRACK SLIDING PHOTO REEL (Luckin Style Continuous Marquee) -->
  <section class="story-marquee-reel-section py-5 my-5 bg-light reveal">
    <div class="container-fluid px-0">
      
      <div class="text-center mb-4">
        <span class="badge-tag-pill">MOMENTS AT SANTINO</span>
        <h3 class="font-heading fw-bold mt-2">Inside Our Roastery, Cafes & Labs</h3>
      </div>

      <!-- Marquee Track 1 (Moves Left) -->
      <div class="story-photo-marquee-track track-left mb-3">
        <div class="story-marquee-row">
          <img src="<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_25_santino_-_250522-07618.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_26_santino_-_250522-07312.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_27_santino_-_250522-07216.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="" class="reel-photo">
          <!-- Duplicates for seamless loop -->
          <img src="<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_25_santino_-_250522-07618.jpg'); ?>" alt="" class="reel-photo">
        </div>
      </div>

      <!-- Marquee Track 2 (Moves Right) -->
      <div class="story-photo-marquee-track track-right">
        <div class="story-marquee-row">
          <img src="<?php echo santino_img('imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_30_Blue-Stone-3_800x_526184df-2650-40b7-9dcf-e8af5b97527b.webp'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_24_santino_-_250522-07240.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('bfc_santino_foodservice.jpg'); ?>" alt="" class="reel-photo">
          <!-- Duplicates for seamless loop -->
          <img src="<?php echo santino_img('imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_30_Blue-Stone-3_800x_526184df-2650-40b7-9dcf-e8af5b97527b.webp'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="" class="reel-photo">
        </div>
      </div>

    </div>
  </section>

  <!-- 5. CALL TO ACTION: VISIT US OR JOIN OUR NETWORK -->
  <section class="story-cta-section text-center py-5 reveal">
    <div class="container">
      <div class="p-4 p-md-5 rounded-4 position-relative text-white overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #003633 0%, #005652 50%, #002826 100%); border: 1px solid rgba(212, 175, 55, 0.25);">
        <div class="position-relative" style="z-index: 2;">
          <span class="badge-tag-pill mb-3" style="background: rgba(249, 203, 83, 0.12) !important; border-color: rgba(249, 203, 83, 0.35) !important; color: #f9cb53 !important;">
            <i class="bi bi-handshake me-1"></i> BECOME A PARTNER
          </span>
          <h2 class="font-heading fw-bold display-6 mb-3 text-white">Ready to Elevate Your Coffee Experience?</h2>
          <p class="text-white-50 mx-auto mb-4" style="max-width: 680px; font-size: 1.05rem; line-height: 1.6;">
            Whether you are opening a specialty cafe, outfitting a hotel with bionic espresso machinery, or looking for freshly roasted wholesale beans, Santino is your total solutions partner.
          </p>
          <div class="d-flex justify-content-center flex-wrap gap-3">
            <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#enquiryModal" style="background: var(--santino-gold) !important; border-color: var(--santino-gold) !important;">
              <span>Book A Roastery Visit</span>
              <i class="bi bi-geo-alt-fill text-danger ms-1"></i>
            </button>
            <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-hero-outline">
              <span>Explore Drinks Menu</span>
              <i class="bi bi-cup-hot ms-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Quick Enquiry Modal -->
  <div class="modal fade" id="enquiryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 p-4">
        <div class="modal-header border-0 pb-0">
          <h4 class="modal-title font-heading fw-bold">Connect with Santino</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted small mb-4">Leave your details and our commercial coffee team will contact you immediately.</p>
          <form onsubmit="alert('Thank you! Our coffee team will reach out to you shortly.'); return false;">
            <div class="mb-3">
              <label class="form-label small fw-bold">Full Name *</label>
              <input type="text" class="form-control" placeholder="Marcus Tan" required>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Phone Number *</label>
              <input type="tel" class="form-control" placeholder="+880 1613-334514" required>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Email Address *</label>
              <input type="email" class="form-control" placeholder="sales@yourcafe.com" required>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Interested In</label>
              <select class="form-select">
                <option>Commercial Espresso Machinery</option>
                <option>Wholesale Coffee Beans (Rainforest Alliance)</option>
                <option>Barista Academy & Staff Training</option>
                <option>Cafe Franchise & VIP Membership</option>
              </select>
            </div>
            <button type="submit" class="btn-kp-maroon w-100 py-3 fw-bold">
              SEND INQUIRY
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->

<?php
endif;

get_footer();
