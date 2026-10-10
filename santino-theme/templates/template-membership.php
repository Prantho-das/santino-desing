<?php
/**
 * Template Name: Santino VIP Coffee Club Membership
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

$is_elementor_page = false;
if ( class_exists( '\Elementor\Plugin' ) ) {
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
/* Enforce Home Page Exact Font Hierarchy for Membership Page */
.membership-page-wrap, 
.pro-banner-hero, 
.perks-section, 
.club-portal-section,
#perks,
#clubPortal {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
}

.pro-banner-title,
.sec-title,
.perk-title,
.font-heading,
h1, h2, h3, h4, h5, h6,
.sec-pill-badge,
.portal-tabs .nav-link,
.btn,
.btn-portal-submit,
.btn-hero-lifestyle,
.btn-hero-outline,
.vip-card-surface h4,
.vip-card-surface .badge,
.perk-pill-tag {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  letter-spacing: -0.3px;
}

.sec-title {
  font-size: clamp(2rem, 3.5vw, 2.8rem) !important;
  font-weight: 900 !important;
  color: #111111 !important;
  letter-spacing: -0.5px !important;
}

.sec-title-accent,
.menu-title-highlight {
  color: var(--santino-teal, #00625d) !important;
}

.sec-pill-badge {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  font-size: 0.78rem !important;
}

p, .pro-banner-desc, .perk-desc, .text-muted, label, input, select, textarea {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif) !important;
}

.floating-bg-icons {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  pointer-events: none !important;
  overflow: hidden !important;
  z-index: 1 !important;
}
.float-item {
  position: absolute !important;
  color: var(--santino-teal, #00625d) !important;
  opacity: 0.16 !important;
  filter: drop-shadow(0 6px 16px rgba(0, 98, 93, 0.15)) !important;
  will-change: transform !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}
.float-item svg {
  width: 100% !important;
  height: 100% !important;
  max-width: 65px !important;
  max-height: 65px !important;
  display: block !important;
}
.float-item-1 { top: 5% !important; left: 2% !important; width: 68px !important; height: 68px !important; }
.float-item-2 { top: 12% !important; right: 4% !important; width: 76px !important; height: 76px !important; }
.float-item-3 { top: 42% !important; left: 4% !important; width: 56px !important; height: 56px !important; }
.float-item-4 { top: 68% !important; right: 3% !important; width: 80px !important; height: 80px !important; }
.float-item-5 { bottom: 8% !important; left: 14% !important; width: 72px !important; height: 72px !important; }
.float-item-6 { top: 6% !important; left: 42% !important; width: 54px !important; height: 54px !important; }
.float-item-7 { bottom: 18% !important; right: 18% !important; width: 64px !important; height: 64px !important; }
.float-item-8 { top: 56% !important; left: 52% !important; width: 50px !important; height: 50px !important; }
.float-item-9 { top: 30% !important; right: 12% !important; width: 60px !important; height: 60px !important; }
.float-item-10 { bottom: 35% !important; left: 2% !important; width: 70px !important; height: 70px !important; }

</style>

<!-- MINIMAL CLEAN MEMBERSHIP HERO -->
  <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>'); background-position: center; background-size: cover; min-height: 56vh; display: flex; align-items: center; justify-content: center; padding: 80px 20px;">
    <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0, 38, 35, 0.7) 100%); z-index: 1;"></div>
    
    <div class="container position-relative" style="max-width: 820px; z-index: 2;">
      
      <!-- Home Page Style Pill Badge -->
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-gem me-1 text-warning"></i> SANTINO VIP COFFEE CLUB</span>
        <span class="sec-pill-line"></span>
      </div>

      <!-- Concise Balanced Headline -->
      <h1 class="pro-banner-title mb-3" style="font-family: var(--kp-font-title, 'Montserrat', sans-serif); font-size: clamp(2.3rem, 4.5vw, 3.6rem); font-weight: 900; line-height: 1.18; letter-spacing: -0.5px; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
        Exclusive Connoisseur <span style="color: #dfbe8d;">Privileges</span>
      </h1>

      <!-- Subtitle -->
      <p class="pro-banner-desc mb-4" style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); max-width: 640px; font-size: 1.08rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.4);">
        Private cupping sessions, seasonal micro-lot allocations, and 15% VIP artisan bean discounts across Bangladesh.
      </p>

      <!-- Action Buttons (Home Page Exact Styling) -->
      <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
        <a href="#clubPortal" class="btn-hero-lifestyle">
          <span>Join Coffee Club</span>
          <i class="bi bi-arrow-right"></i>
        </a>
        <a href="#perks" class="btn-hero-outline">
          <i class="bi bi-arrow-down-short text-warning"></i>
          <span>Explore Perks</span>
        </a>
      </div>

    </div>
  </section>

  <!-- Luxury Overlap Floating Metrics Bar -->
  <div class="story-metrics-floating-wrap">
    <div class="container">
      <div class="row g-3 g-md-4 text-center justify-content-center">
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-stars"></i></div>
            <div class="metric-num">100% Free</div>
            <div class="metric-label">Club Enrollment</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-percent"></i></div>
            <div class="metric-num">15% Off</div>
            <div class="metric-label">Retail Bean Privilege</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-cup-hot-fill"></i></div>
            <div class="metric-num">Priority</div>
            <div class="metric-label">Private Cupping Access</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-calendar-heart-fill"></i></div>
            <div class="metric-num">Monthly</div>
            <div class="metric-label">Exclusive Micro-Lots</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
<style>
/* Luxury Member Perks Showcase Styling */
.perks-section {
  background: #ffffff;
  position: relative;
}
.perk-card-luxury {
  background: #ffffff;
  border: 1.5px solid #e8f0ed;
  border-radius: 22px;
  padding: 32px 28px;
  height: 100%;
  position: relative;
  overflow: hidden;
  transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
  box-shadow: 0 8px 24px rgba(0, 77, 73, 0.04);
  display: flex; flex-direction: column; justify-content: space-between;
}
.perk-card-luxury::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: linear-gradient(90deg, #00625d 0%, #c3996c 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
}
.perk-card-luxury:hover {
  transform: translateY(-8px);
  border-color: rgba(195, 153, 108, 0.5);
  box-shadow: 0 20px 40px rgba(0, 77, 73, 0.1), 0 1px 3px rgba(0,0,0,0.05);
}
.perk-card-luxury:hover::before {
  opacity: 1;
}
.perk-icon-wrap {
  width: 58px;
  height: 58px;
  border-radius: 16px;
  background: linear-gradient(135deg, rgba(0, 98, 93, 0.08) 0%, rgba(195, 153, 108, 0.15) 100%);
  border: 1px solid rgba(195, 153, 108, 0.25);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  color: #00625d;
  margin-bottom: 20px;
  transition: transform 0.3s ease, background 0.3s ease;
}
.perk-card-luxury:hover .perk-icon-wrap {
  transform: scale(1.08) rotate(3deg);
  background: linear-gradient(135deg, #00625d 0%, #004541 100%);
  color: #dfbe8d;
}
.perk-pill-tag {
  font-size: 10.5px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 4px 10px;
  border-radius: 20px;
  background: #f0f6f4;
  color: #00625d;
  border: 1px solid #d5e5e1;
}
.perk-card-luxury:hover .perk-pill-tag {
  background: rgba(195, 153, 108, 0.15);
  color: #93683a;
  border-color: rgba(195, 153, 108, 0.35);
}
.perk-title {
  font-size: 1.25rem;
  font-weight: 800;
  color: #12211e;
  margin-bottom: 10px;
  letter-spacing: -0.2px;
}
.perk-desc {
  font-size: 0.92rem;
  color: #5c706d;
  line-height: 1.65;
  margin-bottom: 0;
}

.floating-bg-icons {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  pointer-events: none !important;
  overflow: hidden !important;
  z-index: 1 !important;
}
.float-item {
  position: absolute !important;
  color: var(--santino-teal, #00625d) !important;
  opacity: 0.16 !important;
  filter: drop-shadow(0 6px 16px rgba(0, 98, 93, 0.15)) !important;
  will-change: transform !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}
.float-item svg {
  width: 100% !important;
  height: 100% !important;
  max-width: 65px !important;
  max-height: 65px !important;
  display: block !important;
}
.float-item-1 { top: 5% !important; left: 2% !important; width: 68px !important; height: 68px !important; }
.float-item-2 { top: 12% !important; right: 4% !important; width: 76px !important; height: 76px !important; }
.float-item-3 { top: 42% !important; left: 4% !important; width: 56px !important; height: 56px !important; }
.float-item-4 { top: 68% !important; right: 3% !important; width: 80px !important; height: 80px !important; }
.float-item-5 { bottom: 8% !important; left: 14% !important; width: 72px !important; height: 72px !important; }
.float-item-6 { top: 6% !important; left: 42% !important; width: 54px !important; height: 54px !important; }
.float-item-7 { bottom: 18% !important; right: 18% !important; width: 64px !important; height: 64px !important; }
.float-item-8 { top: 56% !important; left: 52% !important; width: 50px !important; height: 50px !important; }
.float-item-9 { top: 30% !important; right: 12% !important; width: 60px !important; height: 60px !important; }
.float-item-10 { bottom: 35% !important; left: 2% !important; width: 70px !important; height: 70px !important; }

</style>
  <!-- LUXURY MEMBER PERKS SHOWCASE -->
  <section class="py-5 perks-section position-relative overflow-hidden" id="perks">
    <!-- Floating Background Icons & Leaves -->
    <div class="floating-bg-icons" aria-hidden="true">
      <div class="float-item leaf-green float-item-1" title="Coffee Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
        </svg>
      </div>
      <div class="float-item float-item-2"><i class="bi bi-cup-hot-fill"></i></div>
      <div class="float-item leaf-emerald float-item-3" title="Botanical Leaf">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
        </svg>
      </div>
      <div class="float-item maroon float-item-4"><i class="bi bi-cup-straw"></i></div>
      <div class="float-item leaf-green float-item-5" title="Coffee Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M5.5 58.5C6.8 40.2 18.2 23 34.6 16.4c5.7-2.3 12-3.4 18.4-3.4l5.5-7.5.8 8.8c-.1 5.4-1.5 10.8-4.1 15.6C47.1 47 28.5 57.3 5.5 58.5zm40.3-36c-3.8-2.6-8.3-4.2-12.9-4.8-4.5 6.2-7.5 13.5-8.7 21.2 7.3-7.8 15.9-13.4 21.6-16.4zm-2.1 7.2c-4.8 2.4-11.7 6.5-17.7 12.8-.4 2.2-.6 4.5-.7 6.8 6.9-.6 13.4-3.8 18.2-9 1.2-3.5 1.7-7.1.2-10.6z"/>
        </svg>
      </div>
      <div class="float-item gold float-item-6"><i class="bi bi-stars"></i></div>
      <div class="float-item leaf-emerald float-item-7" title="Fresh Leaf">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2C6.5 2 2 6.5 2 12c0 3.5 1.8 6.6 4.6 8.4L6 22l3.6-.6C10.3 21.8 11.1 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm1 14.9V13h3.5l-5.5-7v3.9H7.5l5.5 7z" opacity="0.3"/>
          <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
        </svg>
      </div>
      <div class="float-item gold float-item-8"><i class="bi bi-droplet-fill"></i></div>
      <div class="float-item leaf-green float-item-9" title="Eco Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
        </svg>
      </div>
      <div class="float-item maroon float-item-10"><i class="bi bi-cup-hot"></i></div>
    </div>
    <div class="container py-lg-4">
      
      <!-- Section Header -->
      <div class="text-center max-w-700 mx-auto mb-5 reveal">
        <div class="sec-pill-badge-wrap mb-2">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-award-fill  me-1"></i> MEMBER PRIVILEGES</span>
        <span class="sec-pill-line"></span>
      </div>
        <h2 class="sec-title mb-2">
          Crafted Exclusively For Coffee Lovers
        </h2>
        <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">
          Elevate every cup with exclusive roastery privileges, private sensory workshops, and member-only pricing.
        </p>
      </div>

      <div class="row g-4 justify-content-center">
        
        <!-- Perk 1: Priority Micro-Lots -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="50">
          <div class="perk-card-luxury">
            <div>
              <div class="d-flex justify-content-between align-items-start">
                <div class="perk-icon-wrap">
                  <i class="bi bi-stars"></i>
                </div>
                <span class="perk-pill-tag">VIP ALLOCATION</span>
              </div>
              <h4 class="font-heading perk-title">Priority Micro-Lot Reserves</h4>
              <p class="perk-desc">
                Exclusive 48-hour advance access to rare competition harvests, Geisha lots, and anaerobic micro-batches before public store launch.
              </p>
            </div>
            <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 12px;">
              <span><i class="bi bi-check2-circle text-teal me-1"></i> Limited Batches</span>
              <span class="fw-bold text-teal">First Access</span>
            </div>
          </div>
        </div>

        <!-- Perk 2: Cupping Workshops -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="100">
          <div class="perk-card-luxury">
            <div>
              <div class="d-flex justify-content-between align-items-start">
                <div class="perk-icon-wrap">
                  <i class="bi bi-mortarboard-fill"></i>
                </div>
                <span class="perk-pill-tag">SCA &bull; WBC LAB</span>
              </div>
              <h4 class="font-heading perk-title">Private Cupping Masterclasses</h4>
              <p class="perk-desc">
                Invitations to sensory cupping workshops and origin taste profiling led by certified SCA and WBC barista trainers at our Tejgaon roastery lab.
              </p>
            </div>
            <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 12px;">
              <span><i class="bi bi-geo-alt text-teal me-1"></i> Tejgaon Roastery</span>
              <span class="fw-bold text-teal">Free Passes</span>
            </div>
          </div>
        </div>

        <!-- Perk 3: Whole Beans Privilege -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="150">
          <div class="perk-card-luxury">
            <div>
              <div class="d-flex justify-content-between align-items-start">
                <div class="perk-icon-wrap">
                  <i class="bi bi-tag-fill"></i>
                </div>
                <span class="perk-pill-tag" style="background: rgba(195, 153, 108, 0.15); color: #93683a;">15% OFF BEANS</span>
              </div>
              <h4 class="font-heading perk-title">Artisan Roasted Beans Discount</h4>
              <p class="perk-desc">
                Enjoy a permanent 15% VIP member privilege on all 250g and 1kg bags of freshly roasted single-origin coffees and signature espresso blends.
              </p>
            </div>
            <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 12px;">
              <span><i class="bi bi-bag-check text-teal me-1"></i> 250g &amp; 1kg Bags</span>
              <span class="fw-bold text-teal">Year-Round</span>
            </div>
          </div>
        </div>

        <!-- Perk 4: Birthday Month Treat -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="200">
          <div class="perk-card-luxury">
            <div>
              <div class="d-flex justify-content-between align-items-start">
                <div class="perk-icon-wrap">
                  <i class="bi bi-gift-fill"></i>
                </div>
                <span class="perk-pill-tag">ANNUAL GIFT</span>
              </div>
              <h4 class="font-heading perk-title">Birthday Month Signature Treat</h4>
              <p class="perk-desc">
                Celebrate your special month with a complimentary handcrafted artisanal drink or single-origin pour-over at any Santino flagship cafe.
              </p>
            </div>
            <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 12px;">
              <span><i class="bi bi-cup-hot text-teal me-1"></i> Any Branch</span>
              <span class="fw-bold text-teal">100% On Us</span>
            </div>
          </div>
        </div>

        <!-- Perk 5: Gear & Dial-In Support -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="250">
          <div class="perk-card-luxury">
            <div>
              <div class="d-flex justify-content-between align-items-start">
                <div class="perk-icon-wrap">
                  <i class="bi bi-sliders"></i>
                </div>
                <span class="perk-pill-tag">TECH CARE</span>
              </div>
              <h4 class="font-heading perk-title">Barista Dial-In &amp; Gear Support</h4>
              <p class="perk-desc">
                Direct access to our technicians for home espresso grinder calibration, brew ratio optimization, and equipment maintenance consultations.
              </p>
            </div>
            <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 12px;">
              <span><i class="bi bi-wrench-adjustable text-teal me-1"></i> Expert Baristas</span>
              <span class="fw-bold text-teal">Consultations</span>
            </div>
          </div>
        </div>

        <!-- Perk 6: Express Order Ahead -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="300">
          <div class="perk-card-luxury">
            <div>
              <div class="d-flex justify-content-between align-items-start">
                <div class="perk-icon-wrap">
                  <i class="bi bi-whatsapp"></i>
                </div>
                <span class="perk-pill-tag">ZERO WAIT</span>
              </div>
              <h4 class="font-heading perk-title">Express WhatsApp Order-Ahead</h4>
              <p class="perk-desc">
                Skip peak morning lines at Gulshan, Banani, and Tejgaon branches with priority WhatsApp beverage pre-ordering and table reserve.
              </p>
            </div>
            <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 12px;">
              <span><i class="bi bi-lightning-charge text-teal me-1"></i> Priority Line</span>
              <span class="fw-bold text-teal">Express Queue</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  

<style>
/* Santino Club Portal Clean Luxury Styling */
.club-portal-section {
  background: linear-gradient(180deg, #f8faf9 0%, #edf3f1 100%);
  position: relative;
}
.vip-card-surface {
  background: linear-gradient(135deg, #004d49 0%, #002d2b 60%, #011d1c 100%);
  border: 1px solid rgba(195, 153, 108, 0.4);
  border-radius: 20px;
  color: #ffffff;
  padding: 28px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 20px 40px rgba(0, 77, 73, 0.22), 0 1px 3px rgba(0,0,0,0.1);
  transition: transform 0.4s ease, box-shadow 0.4s ease;
}
.vip-card-surface:hover {
  transform: translateY(-4px);
  box-shadow: 0 26px 50px rgba(0, 77, 73, 0.28);
}
.vip-card-watermark {
  position: absolute;
  right: -30px;
  bottom: -30px;
  font-size: 140px;
  color: rgba(195, 153, 108, 0.08);
  pointer-events: none;
  line-height: 1;
}
.gold-chip {
  width: 42px;
  height: 32px;
  border-radius: 6px;
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 50%, #b88a59 100%);
  border: 1px solid rgba(255,255,255,0.4);
  box-shadow: inset 0 1px 2px rgba(255,255,255,0.6), 0 2px 6px rgba(0,0,0,0.2);
  display: inline-block;
}
.stamp-slot {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  transition: all 0.3s ease;
}
.stamp-slot.active {
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
  color: #002d2b;
  box-shadow: 0 4px 14px rgba(223, 190, 141, 0.5);
  border: 2px solid #ffffff;
}
.stamp-slot.empty {
  background: rgba(255, 255, 255, 0.08);
  border: 1.5px dashed rgba(195, 153, 108, 0.4);
  color: rgba(255, 255, 255, 0.4);
  font-size: 14px;
  font-weight: 700;
}
.stamp-slot.reward {
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
  border: 2px solid #ffffff;
  box-shadow: 0 0 16px rgba(223, 190, 141, 0.7);
  animation: pulse-reward 2s infinite;
}
@keyframes pulse-reward {
  0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(223, 190, 141, 0.7); }
  70% { transform: scale(1.06); box-shadow: 0 0 0 10px rgba(223, 190, 141, 0); }
  100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(223, 190, 141, 0); }
}

/* Tab Navigation */
.portal-tabs .nav-link {
  color: #4b6360;
  background: #ffffff;
  border: 1px solid #dbe5e2;
  border-radius: 12px;
  padding: 10px 18px;
  font-weight: 700;
  font-size: 13.5px;
  transition: all 0.3s ease;
}
.portal-tabs .nav-link:hover {
  background: #f0f6f4;
  color: #00625d;
}
.portal-tabs .nav-link.active {
  background: #00625d !important;
  color: #ffffff !important;
  border-color: #00625d !important;
  box-shadow: 0 6px 18px rgba(0, 98, 93, 0.25);
}
.portal-card {
  background: #ffffff;
  border: 1px solid #dbe5e2;
  border-radius: 20px;
  box-shadow: 0 15px 35px rgba(0, 77, 73, 0.06);
}
.portal-card .form-control, .portal-card .form-select {
  border: 1.5px solid #d5e2df;
  border-radius: 10px;
  padding: 12px 14px;
  font-size: 14.5px;
  color: #1a2b28;
  background-color: #fbfcfa;
  transition: all 0.2s ease;
}
.portal-card .form-control:focus, .portal-card .form-select:focus {
  border-color: #00625d;
  background-color: #ffffff;
  box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.12);
}
.btn-portal-submit {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  border: none;
  border-radius: 10px;
  font-weight: 700;
  letter-spacing: 0.5px;
  padding: 14px 24px;
  transition: all 0.3s ease;
}
.btn-portal-submit:hover {
  background: #004d49;
  color: #ffffff;
  transform: translateY(-1px);
  box-shadow: 0 8px 20px rgba(0, 98, 93, 0.3);
}

.floating-bg-icons {
  position: absolute !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  pointer-events: none !important;
  overflow: hidden !important;
  z-index: 1 !important;
}
.float-item {
  position: absolute !important;
  color: var(--santino-teal, #00625d) !important;
  opacity: 0.16 !important;
  filter: drop-shadow(0 6px 16px rgba(0, 98, 93, 0.15)) !important;
  will-change: transform !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}
.float-item svg {
  width: 100% !important;
  height: 100% !important;
  max-width: 65px !important;
  max-height: 65px !important;
  display: block !important;
}
.float-item-1 { top: 5% !important; left: 2% !important; width: 68px !important; height: 68px !important; }
.float-item-2 { top: 12% !important; right: 4% !important; width: 76px !important; height: 76px !important; }
.float-item-3 { top: 42% !important; left: 4% !important; width: 56px !important; height: 56px !important; }
.float-item-4 { top: 68% !important; right: 3% !important; width: 80px !important; height: 80px !important; }
.float-item-5 { bottom: 8% !important; left: 14% !important; width: 72px !important; height: 72px !important; }
.float-item-6 { top: 6% !important; left: 42% !important; width: 54px !important; height: 54px !important; }
.float-item-7 { bottom: 18% !important; right: 18% !important; width: 64px !important; height: 64px !important; }
.float-item-8 { top: 56% !important; left: 52% !important; width: 50px !important; height: 50px !important; }
.float-item-9 { top: 30% !important; right: 12% !important; width: 60px !important; height: 60px !important; }
.float-item-10 { bottom: 35% !important; left: 2% !important; width: 70px !important; height: 70px !important; }

</style>
  <!-- CLEAN PREMIUM 2-COLUMN VIP LOYALTY PORTAL -->
  <section class="py-5 club-portal-section position-relative overflow-hidden" id="clubPortal">
    <!-- Floating Background Icons & Leaves -->
    <div class="floating-bg-icons" aria-hidden="true">
      <div class="float-item leaf-green float-item-1" title="Coffee Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
        </svg>
      </div>
      <div class="float-item float-item-2"><i class="bi bi-cup-hot-fill"></i></div>
      <div class="float-item leaf-emerald float-item-3" title="Botanical Leaf">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
        </svg>
      </div>
      <div class="float-item maroon float-item-4"><i class="bi bi-cup-straw"></i></div>
      <div class="float-item leaf-green float-item-5" title="Coffee Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M5.5 58.5C6.8 40.2 18.2 23 34.6 16.4c5.7-2.3 12-3.4 18.4-3.4l5.5-7.5.8 8.8c-.1 5.4-1.5 10.8-4.1 15.6C47.1 47 28.5 57.3 5.5 58.5zm40.3-36c-3.8-2.6-8.3-4.2-12.9-4.8-4.5 6.2-7.5 13.5-8.7 21.2 7.3-7.8 15.9-13.4 21.6-16.4zm-2.1 7.2c-4.8 2.4-11.7 6.5-17.7 12.8-.4 2.2-.6 4.5-.7 6.8 6.9-.6 13.4-3.8 18.2-9 1.2-3.5 1.7-7.1.2-10.6z"/>
        </svg>
      </div>
      <div class="float-item gold float-item-6"><i class="bi bi-stars"></i></div>
      <div class="float-item leaf-emerald float-item-7" title="Fresh Leaf">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2C6.5 2 2 6.5 2 12c0 3.5 1.8 6.6 4.6 8.4L6 22l3.6-.6C10.3 21.8 11.1 22 12 22c5.5 0 10-4.5 10-10S17.5 2 12 2zm1 14.9V13h3.5l-5.5-7v3.9H7.5l5.5 7z" opacity="0.3"/>
          <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
        </svg>
      </div>
      <div class="float-item gold float-item-8"><i class="bi bi-droplet-fill"></i></div>
      <div class="float-item leaf-green float-item-9" title="Eco Leaf">
        <svg viewBox="0 0 64 64" fill="currentColor">
          <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
        </svg>
      </div>
      <div class="float-item maroon float-item-10"><i class="bi bi-cup-hot"></i></div>
    </div>
    <div class="container py-lg-4">
      
      <!-- Section Header -->
      <div class="text-center max-w-700 mx-auto mb-5 reveal">
        <div class="sec-pill-badge-wrap mb-2">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill  me-1"></i> VIP LOYALTY REWARDS</span>
        <span class="sec-pill-line"></span>
      </div>
        <h2 class="sec-title mb-2">
          Digital Coffee Stamp Card &amp; Club Portal
        </h2>
        <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">
          Enjoy specialty brews across Santino partner cafes. Collect <strong>5 Cup Stamps</strong> and claim your <strong>6th Handcrafted Drink 100% Free!</strong>
        </p>
      </div>

      <div class="row g-4 align-items-stretch justify-content-center">
        
        <!-- LEFT COLUMN: Realistic VIP Stamp Card Display -->
        <div class="col-lg-5 reveal" data-delay="100">
          <div class="d-flex flex-column justify-content-between h-100">
            
            <!-- Luxury Gold/Teal Card -->
            <div class="vip-card-surface mb-4">
              <i class="bi bi-cup-hot vip-card-watermark"></i>
              
              <!-- Card Top Header -->
              <div class="d-flex justify-content-between align-items-start mb-3 position-relative" style="z-index: 2;">
                <div>
                  <div class="small fw-bold text-uppercase" style="color: #dfbe8d; letter-spacing: 1.5px; font-size: 11px;">
                    SANTINO ROASTERY &bull; VIP CLUB
                  </div>
                  <h4 class="font-heading fw-bold text-white mb-0 mt-1">Connoisseur Member</h4>
                </div>
                <div class="gold-chip"></div>
              </div>

              <!-- Card ID & Tagline -->
              <div class="mb-4 position-relative" style="z-index: 2;">
                <div class="font-monospace text-white-50 small" style="letter-spacing: 2px;">SNT-VIP-•••• ••••</div>
              </div>

              <!-- 5-Cup Physical Stamp Grid Inside Card -->
              <div class="p-3 rounded-4 mb-3 position-relative" style="background: rgba(0, 0, 0, 0.25); border: 1px solid rgba(195, 153, 108, 0.25); z-index: 2;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="small fw-bold" style="color: #dfbe8d; font-size: 11.5px;">5-Cup Stamp Card Tracker</span>
                  <span class="badge rounded-pill" style="background: rgba(195, 153, 108, 0.25); color: #dfbe8d; font-size: 10px;">BUY 5, GET 1 FREE</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center py-2 px-1">
                  <div class="text-center">
                    <div class="stamp-slot active mb-1">☕</div>
                    <div style="font-size: 9.5px; color: #dfbe8d;">Cup 1</div>
                  </div>
                  <div class="text-center">
                    <div class="stamp-slot active mb-1">☕</div>
                    <div style="font-size: 9.5px; color: #dfbe8d;">Cup 2</div>
                  </div>
                  <div class="text-center">
                    <div class="stamp-slot empty mb-1">3</div>
                    <div class="text-white-50" style="font-size: 9.5px;">Cup 3</div>
                  </div>
                  <div class="text-center">
                    <div class="stamp-slot empty mb-1">4</div>
                    <div class="text-white-50" style="font-size: 9.5px;">Cup 4</div>
                  </div>
                  <div class="text-center">
                    <div class="stamp-slot empty mb-1">5</div>
                    <div class="text-white-50" style="font-size: 9.5px;">Cup 5</div>
                  </div>
                  <div class="text-center">
                    <div class="stamp-slot reward mb-1"><i class="bi bi-gift-fill" style="color: #002d2b; font-size: 17px;"></i></div>
                    <div style="font-size: 9.5px; color: #dfbe8d; font-weight: 700;">FREE #6</div>
                  </div>
                </div>
              </div>

              <!-- Card Bottom Info -->
              <div class="d-flex justify-content-between align-items-center text-white-50 small position-relative" style="z-index: 2; font-size: 11px;">
                <span>Valid across all Dhaka branches</span>
                <span style="color: #dfbe8d;"><i class="bi bi-patch-check-fill me-1"></i> Auto-Verified</span>
              </div>
            </div>

            <!-- 3 Simple How It Works Steps -->
            <div class="p-3 bg-white rounded-4 border shadow-sm">
              <div class="row g-2 text-center">
                <div class="col-4">
                  <div class="fs-4 text-teal mb-1"><i class="bi bi-cup-hot"></i></div>
                  <div class="fw-bold small text-dark">1. Sip Coffee</div>
                  <div class="text-muted" style="font-size: 10px;">At partner cafes</div>
                </div>
                <div class="col-4 border-start border-end">
                  <div class="fs-4 text-teal mb-1"><i class="bi bi-receipt"></i></div>
                  <div class="fw-bold small text-dark">2. Log Memo</div>
                  <div class="text-muted" style="font-size: 10px;">Submit invoice #</div>
                </div>
                <div class="col-4">
                  <div class="fs-4 text-teal mb-1" style="color: #c3996c !important;"><i class="bi bi-gift"></i></div>
                  <div class="fw-bold small text-dark">3. Get Free Cup</div>
                  <div class="text-muted" style="font-size: 10px;">Instant voucher</div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- RIGHT COLUMN: Interactive Portal Form Tabs -->
        <div class="col-lg-7 reveal" data-delay="150">
          <div class="portal-card p-4 p-md-5 h-100 d-flex flex-column justify-content-between">
            
            <!-- Navigation Pills -->
            <ul class="nav nav-pills portal-tabs gap-2 mb-4 justify-content-start" id="loyaltyTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="stamps-tab" data-bs-toggle="pill" data-bs-target="#stamps-pane" type="button" role="tab">
                  <i class="bi bi-search me-1"></i> Check Stamp Status
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="invoice-tab" data-bs-toggle="pill" data-bs-target="#invoice-pane" type="button" role="tab">
                  <i class="bi bi-receipt-cutoff me-1"></i> Log Invoice
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register-pane" type="button" role="tab">
                  <i class="bi bi-person-check-fill me-1"></i> Join Coffee Club
                </button>
              </li>
            </ul>

            <div class="tab-content flex-grow-1" id="loyaltyTabsContent">

              <!-- TAB 1: CHECK STAMP STATUS -->
              <div class="tab-pane fade show active" id="stamps-pane" role="tabpanel">
                <div class="mb-4">
                  <h4 class="font-heading fw-bold text-dark mb-1">Check Your Live Stamp Progress</h4>
                  <p class="text-muted small">Enter your Registered Phone Number or VIP Member ID below.</p>
                </div>

                <form id="santinoLookupForm" class="mb-4">
                  <div class="portal-lookup-group">
                    <div class="portal-lookup-field">
                      <i class="bi bi-telephone text-teal"></i>
                      <input type="text" name="query" placeholder="e.g. 01712345678 or SNT-VIP-XXXX" required>
                    </div>
                    <button type="submit" class="btn-lookup-action">
                      <span>LOOKUP</span> <i class="bi bi-arrow-right"></i>
                    </button>
                  </div>
                </form>

                <div id="liveStampCardContainer" style="display: none;"></div>
              </div>

              <!-- TAB 2: LOG INVOICE NUMBER -->
              <div class="tab-pane fade" id="invoice-pane" role="tabpanel">
                <div class="mb-4">
                  <h4 class="font-heading fw-bold text-dark mb-1">Log Cafe Invoice / Memo Number</h4>
                  <p class="text-muted small">Submit your receipt details. +1 Cup stamp will be credited to your card upon verification.</p>
                </div>

                <div id="invoiceResponseBox" style="display: none;" class="mb-4"></div>

                <form id="santinoInvoiceForm">
                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Invoice / Memo Number *</label>
                      <input type="text" name="invoice_number" class="form-control" placeholder="e.g. SNT-2026-9042" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Phone Number / WhatsApp *</label>
                      <input type="tel" name="phone" class="form-control" placeholder="017XXXXXXXX or +88017..." pattern="^(?:\+?880|0)?1[3-9]\d{8}$" title="Please enter a valid Bangladeshi phone number" required>
                    </div>
                  </div>

                  <div class="row g-3 mb-4">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Cafe Branch Visited</label>
                      <select name="branch" class="form-select">
                        <option>Gulshan-2 Flagship Experience Center</option>
                        <option>Banani Borak Mehnur</option>
                        <option>Tejgaon Roastery &amp; Lab</option>
                        <option>Dhanmondi Ahmed &amp; Kazi Tower</option>
                        <option>Uttara Liberty Tower</option>
                        <option>Baridhara Diplomatic Enclave</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">VIP Member ID (Optional)</label>
                      <input type="text" name="member_id" class="form-control" placeholder="e.g. SNT-VIP-XXXX">
                    </div>
                  </div>

                  <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                    Submit Invoice For Stamp Verification →
                  </button>
                </form>
              </div>

              <!-- TAB 3: REGISTER FOR COFFEE CLUB -->
              <div class="tab-pane fade" id="register-pane" role="tabpanel">
                <div class="mb-4">
                  <h4 class="font-heading fw-bold text-dark mb-1">Register For Santino Coffee Club</h4>
                  <p class="text-muted small">Fill in your details to immediately activate your digital stamp card and member perks.</p>
                </div>

                <div id="membershipResponseBox" style="display: none;" class="mb-4"></div>

                <form id="santinoMembershipForm">
                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Full Name *</label>
                      <input type="text" name="fullname" class="form-control" placeholder="Your Full Name" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Phone Number / WhatsApp *</label>
                      <input type="tel" name="phone" id="santinoMemberPhone" class="form-control" placeholder="017XXXXXXXX or +88017XXXXXXXX" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" title="Please enter a valid Bangladeshi phone number" required>
                    </div>
                  </div>

                  <div class="row g-3 mb-4">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Email Address *</label>
                      <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Address / Location *</label>
                      <input type="text" name="address" class="form-control" placeholder="House, Road, Area, Dhaka" required>
                    </div>
                  </div>

                  <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="termsCheck" checked required>
                    <label class="form-check-label small text-muted" for="termsCheck">
                      I agree to join Santino Coffee Club to receive member perks, cupping invitations, and reward stamps.
                    </label>
                  </div>

                  <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                    Register For Santino Coffee Club →
                  </button>
                </form>
              </div>

            </div>

          </div>
        </div>

      </div>

    </div>
  </section>


      <!-- SIMPLE CLEAN CAFE DISCOVERY CTA -->
  <section class="py-5 bg-white text-center border-top">
    <div class="container py-4" style="max-width: 700px;">
      
      <!-- Home Page Pill Badge -->
      <div class="sec-pill-badge-wrap mb-2">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> VISIT OUR CAFES</span>
        <span class="sec-pill-line"></span>
      </div>

      <!-- Title -->
      <h2 class="sec-title mb-2">
        Taste The <span class="sec-title-accent">Santino Difference</span>
      </h2>

      <!-- Description -->
      <p class="text-muted mb-4" style="font-size: 0.98rem; max-width: 540px; margin: 0 auto; line-height: 1.6;">
        Discover our signature handcrafted beverages, artisanal roasts, and modern cafe ambiance across Dhaka.
      </p>

      <!-- Clean Button -->
      <div class="d-flex justify-content-center">
        <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-hero-lifestyle">
          <span>Explore Drinks Menu</span>
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>

    </div>
  </section>

  <!-- FOOTER -->

<?php
endif;
get_footer();
