<?php
/**
 * Template Name: Santino Member Portal
 * Template Post Type: page
 *
 * Dedicated layout for /santino-member/ with Hero Section and VIP Coffee Club Portal.
 * Fully editable via Elementor.
 *
 * @package Santino
 */

get_header();

$is_elementor = false;
if ( function_exists( 'santino_is_elementor_page' ) && santino_is_elementor_page() ) {
    $is_elementor = true;
} elseif ( class_exists( '\Elementor\Plugin' ) ) {
    $document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
    if ( $document && $document->is_built_with_elementor() ) {
        $is_elementor = true;
    }
}

if ( $is_elementor ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
else :
    // Fallback: render complete luxury Hero + Member Portal
    $mb_hero_badge        = get_theme_mod( 'santino_mb_hero_badge', 'SANTINO VIP MEMBER PORTAL' );
    $mb_hero_title        = get_theme_mod( 'santino_mb_hero_title', 'Santino Member Club' );
    $mb_hero_title_accent = get_theme_mod( 'santino_mb_hero_title_accent', '& Rewards' );
    $mb_hero_desc         = get_theme_mod( 'santino_mb_hero_desc', 'Track your 5-cup coffee stamps, upload cafe invoices, and claim your free 6th handcrafted cup across Santino partner cafes.' );
    $mb_hero_btn1_text    = get_theme_mod( 'santino_mb_hero_btn1_text', 'Check Stamp Card' );
    $mb_hero_btn1_url     = get_theme_mod( 'santino_mb_hero_btn1_url', '#clubPortal' );
    $mb_hero_btn2_text    = get_theme_mod( 'santino_mb_hero_btn2_text', 'Log Invoice Memo' );
    $mb_hero_btn2_url     = get_theme_mod( 'santino_mb_hero_btn2_url', '#invoice-tab' );
    $hero_bg_url          = get_theme_mod( 'santino_mb_hero_bg' );
    if ( ! $hero_bg_url ) {
        $hero_bg_url = function_exists( 'santino_get_page_banner' ) 
            ? santino_get_page_banner( 'santino-member', 'imgi_20_santino_-_250522-07574.jpg' ) 
            : ( function_exists( 'santino_img' ) ? santino_img( 'imgi_20_santino_-_250522-07574.jpg' ) : '' );
    }
?>

<style>
.standalone-portal-page,
.standalone-portal-section {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
}

.sec-title,
.font-heading,
.sec-pill-badge,
.portal-tabs .nav-link,
.btn-portal-submit,
.vip-card-surface h4,
.vip-card-surface .badge,
.btn-hero-lifestyle,
.btn-hero-outline {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  letter-spacing: -0.3px;
}

.sec-title {
  font-size: clamp(2rem, 3.5vw, 2.8rem) !important;
  font-weight: 900 !important;
  color: #111111 !important;
  letter-spacing: -0.5px !important;
}

.sec-pill-badge-wrap {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
}
.sec-pill-line {
  display: inline-block;
  width: 24px;
  height: 2px;
  background: #c3996c;
}
.sec-pill-badge {
  display: inline-block;
  padding: 4px 14px;
  border-radius: 50px;
  background: rgba(0, 98, 93, 0.08);
  color: #00625d;
  font-size: 0.78rem;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
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
}

.standalone-portal-section {
  background: #fdfbf7;
  padding: 60px 0 90px;
  position: relative;
  overflow: hidden;
}

.vip-card-surface {
  background: radial-gradient(circle at 80% 20%, #005c56 0%, #071d1b 60%, #04100e 100%);
  border-radius: 24px;
  padding: 32px 28px;
  color: #ffffff;
  position: relative;
  overflow: hidden;
  box-shadow: 0 20px 45px rgba(0, 38, 35, 0.22);
  border: 1px solid rgba(195, 153, 108, 0.35);
}

.vip-card-watermark {
  position: absolute;
  right: -20px;
  bottom: -30px;
  font-size: 160px;
  color: rgba(255, 255, 255, 0.03);
  pointer-events: none;
  z-index: 1;
}

.gold-chip {
  width: 44px;
  height: 32px;
  border-radius: 6px;
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
  box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.6), 0 2px 6px rgba(0,0,0,0.3);
}

.stamp-slot {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  font-weight: 700;
  margin: 0 auto;
  transition: all 0.3s ease;
}

.stamp-slot.active {
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
  color: #041a18;
  box-shadow: 0 0 14px rgba(223, 190, 141, 0.45);
  border: 2px solid #ffffff;
}

.stamp-slot.empty {
  background: rgba(0, 98, 93, 0.25);
  border: 2px dashed rgba(195, 153, 108, 0.35);
  color: rgba(255, 255, 255, 0.4);
}

.stamp-slot.reward {
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
  color: #002d2b;
  border: 2px solid #ffffff;
  animation: pulse-reward 2s infinite ease-in-out;
}

@keyframes pulse-reward {
  0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(223, 190, 141, 0.7); }
  50% { transform: scale(1.08); box-shadow: 0 0 16px 4px rgba(223, 190, 141, 0.85); }
}

.portal-card {
  background: #ffffff;
  border-radius: 24px;
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
  border: 1px solid rgba(0, 0, 0, 0.06);
}

.portal-tabs .nav-link {
  border-radius: 50px !important;
  padding: 10px 20px !important;
  font-size: 13.5px !important;
  font-weight: 700 !important;
  color: #4a5568 !important;
  background: #f1f5f9 !important;
  border: 1px solid transparent !important;
  transition: all 0.25s ease !important;
}

.portal-tabs .nav-link:hover {
  background: #e2e8f0 !important;
  color: #1a202c !important;
}

.portal-tabs .nav-link.active {
  background: var(--santino-teal, #00625d) !important;
  color: #ffffff !important;
  box-shadow: 0 6px 18px rgba(0, 98, 93, 0.28) !important;
}

.portal-lookup-group {
  display: flex !important;
  align-items: center !important;
  background: #ffffff !important;
  border: 2px solid #00625d !important;
  border-radius: 60px !important;
  padding: 6px 8px 6px 18px !important;
  box-shadow: 0 8px 24px rgba(0, 98, 93, 0.08) !important;
  gap: 10px !important;
  width: 100% !important;
}

.portal-lookup-field {
  display: flex !important;
  align-items: center !important;
  gap: 12px !important;
  flex: 1 1 auto !important;
}

.portal-lookup-field input {
  border: none !important;
  outline: none !important;
  box-shadow: none !important;
  background: transparent !important;
  font-size: 15px !important;
  font-weight: 600 !important;
  width: 100% !important;
  color: #1a2b28 !important;
  padding: 8px 0 !important;
}

.btn-lookup-action {
  background: var(--santino-teal, #00625d) !important;
  color: #ffffff !important;
  border: none !important;
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  font-weight: 700 !important;
  font-size: 13px !important;
  letter-spacing: 0.6px !important;
  text-transform: uppercase !important;
  padding: 10px 24px !important;
  border-radius: 50px !important;
  min-height: 40px !important;
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 8px !important;
  cursor: pointer !important;
  box-shadow: 0 4px 14px rgba(0, 98, 93, 0.25) !important;
  transition: all 0.25s ease !important;
  white-space: nowrap !important;
  flex-shrink: 0 !important;
}

.btn-lookup-action:hover {
  background: #004d49 !important;
  color: #ffffff !important;
  transform: translateY(-1px) !important;
  box-shadow: 0 8px 20px rgba(0, 98, 93, 0.35) !important;
}

.btn-portal-submit {
  background: linear-gradient(135deg, #00625d 0%, #00423e 100%);
  color: #ffffff !important;
  border: none;
  border-radius: 12px;
  padding: 14px 24px;
  font-weight: 800;
  letter-spacing: 0.5px;
  font-size: 14px;
  box-shadow: 0 8px 20px rgba(0, 98, 93, 0.25);
  transition: all 0.3s ease;
}

.btn-portal-submit:hover {
  background: #003330;
  color: #ffffff !important;
  transform: translateY(-2px);
  box-shadow: 0 12px 28px rgba(0, 98, 93, 0.35);
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
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
}
.float-item-1 { top: 5% !important; left: 2% !important; width: 68px !important; height: 68px !important; }
.float-item-2 { top: 12% !important; right: 4% !important; width: 76px !important; height: 76px !important; }
.float-item-3 { top: 42% !important; left: 4% !important; width: 56px !important; height: 56px !important; }
.float-item-4 { top: 68% !important; right: 3% !important; width: 80px !important; height: 80px !important; }
.float-item-5 { bottom: 8% !important; left: 14% !important; width: 72px !important; height: 72px !important; }
.float-item-6 { top: 6% !important; left: 42% !important; width: 54px !important; height: 54px !important; }
</style>

<div class="standalone-portal-page">
  <!-- HERO BANNER SECTION -->
  <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>'); background-position: center; background-size: cover; min-height: 56vh; display: flex; align-items: center; justify-content: center; padding: 85px 20px;">
    <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0, 38, 35, 0.72) 100%); z-index: 1;"></div>
    
    <div class="container position-relative" style="max-width: 840px; z-index: 2;">
      <?php if ( ! empty( $mb_hero_badge ) ) : ?>
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge" style="background: rgba(223, 190, 141, 0.2); color: #dfbe8d; border: 1px solid rgba(223, 190, 141, 0.35);"><i class="bi bi-gem me-1 text-warning"></i> <?php echo esc_html( $mb_hero_badge ); ?></span>
        <span class="sec-pill-line"></span>
      </div>
      <?php endif; ?>

      <h1 class="pro-banner-title mb-3" style="font-family: var(--kp-font-title, 'Montserrat', sans-serif); font-size: clamp(2.3rem, 4.5vw, 3.6rem); font-weight: 900; line-height: 1.18; letter-spacing: -0.5px; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
        <?php echo esc_html( $mb_hero_title ); ?> <?php if ( ! empty( $mb_hero_title_accent ) ) : ?><span style="color: #dfbe8d;"><?php echo esc_html( $mb_hero_title_accent ); ?></span><?php endif; ?>
      </h1>

      <?php if ( ! empty( $mb_hero_desc ) ) : ?>
      <p class="pro-banner-desc mb-4" style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); max-width: 640px; font-size: 1.08rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.4);">
        <?php echo esc_html( $mb_hero_desc ); ?>
      </p>
      <?php endif; ?>

      <?php if ( ! empty( $mb_hero_btn1_text ) || ! empty( $mb_hero_btn2_text ) ) : ?>
      <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
        <?php if ( ! empty( $mb_hero_btn1_text ) ) : ?>
        <a href="<?php echo esc_url( $mb_hero_btn1_url ); ?>" class="btn-hero-lifestyle">
          <span><?php echo esc_html( $mb_hero_btn1_text ); ?></span>
          <i class="bi bi-arrow-right"></i>
        </a>
        <?php endif; ?>
        <?php if ( ! empty( $mb_hero_btn2_text ) ) : ?>
        <a href="<?php echo esc_url( $mb_hero_btn2_url ); ?>" class="btn-hero-outline">
          <i class="bi bi-receipt-cutoff text-warning"></i>
          <span><?php echo esc_html( $mb_hero_btn2_text ); ?></span>
        </a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- 2-COLUMN VIP LOYALTY PORTAL SECTION -->
  <section class="standalone-portal-section position-relative overflow-hidden" id="clubPortal">
    <!-- Floating Background Icons -->
    <div class="floating-bg-icons" aria-hidden="true">
      <div class="float-item float-item-1"><i class="bi bi-cup-hot-fill fs-2"></i></div>
      <div class="float-item float-item-2"><i class="bi bi-stars fs-2"></i></div>
      <div class="float-item float-item-3"><i class="bi bi-cup-straw fs-2"></i></div>
      <div class="float-item float-item-4"><i class="bi bi-droplet-fill fs-2"></i></div>
      <div class="float-item float-item-5"><i class="bi bi-patch-check-fill fs-2"></i></div>
      <div class="float-item float-item-6"><i class="bi bi-gift-fill fs-2"></i></div>
    </div>

    <div class="container py-lg-4">
      <!-- Section Header -->
      <div class="text-center max-w-700 mx-auto mb-5">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> VIP LOYALTY REWARDS</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="sec-title mb-2">Digital Coffee Stamp Card &amp; Club Portal</h2>
        <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">
          Enjoy specialty brews across Santino partner cafes. Collect <strong>5 Cup Stamps</strong> and claim your <strong>6th Handcrafted Drink 100% Free!</strong>
        </p>
      </div>

      <div class="row g-4 align-items-start justify-content-center">
        <!-- LEFT COLUMN: Stamp Card Display -->
        <div class="col-lg-5">
          <div class="d-flex flex-column gap-3">
            <!-- Luxury Gold/Teal Card -->
            <div class="vip-card-surface">
              <i class="bi bi-cup-hot vip-card-watermark"></i>
              
              <!-- Card Top Header -->
              <div class="d-flex justify-content-between align-items-start mb-3 position-relative" style="z-index: 2;">
                <div>
                  <div class="small fw-bold text-uppercase" style="color: #dfbe8d; letter-spacing: 1.5px; font-size: 11px;">
                    SANTINO COFFEE CLUB
                  </div>
                  <h4 class="font-heading fw-bold text-white mb-0 mt-1">Regular Member</h4>
                </div>
                <div class="gold-chip"></div>
              </div>

              <!-- Card ID -->
              <div class="mb-4 position-relative" style="z-index: 2;">
                <div class="font-monospace text-white-50 small" style="letter-spacing: 2px;">SNT-REG-•••• ••••</div>
              </div>

              <!-- 5-Cup Physical Stamp Grid -->
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
                  <div class="fs-4 text-teal mb-1" style="color: #00625d;"><i class="bi bi-cup-hot"></i></div>
                  <div class="fw-bold small text-dark">1. Sip Coffee</div>
                  <div class="text-muted" style="font-size: 10px;">At partner cafes</div>
                </div>
                <div class="col-4 border-start border-end">
                  <div class="fs-4 text-teal mb-1" style="color: #00625d;"><i class="bi bi-receipt"></i></div>
                  <div class="fw-bold small text-dark">2. Log Memo</div>
                  <div class="text-muted" style="font-size: 10px;">Submit invoice &amp; cups</div>
                </div>
                <div class="col-4">
                  <div class="fs-4 mb-1" style="color: #c3996c !important;"><i class="bi bi-gift"></i></div>
                  <div class="fw-bold small text-dark">3. Get Free Cup</div>
                  <div class="text-muted" style="font-size: 10px;">Buy 5, Get 1 Free</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- RIGHT COLUMN: Interactive Portal Form Tabs -->
        <div class="col-lg-7">
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
                  <p class="text-muted small">Enter your Registered Phone Number or Member ID below.</p>
                </div>

                <form id="santinoLookupForm" class="mb-4">
                  <div class="portal-lookup-group">
                    <div class="portal-lookup-field">
                      <i class="bi bi-telephone" style="color: #00625d;"></i>
                      <input type="text" name="query" placeholder="e.g. 01712345678 or SNT-REG-XXXX" required>
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
                  <p class="text-muted small">Submit your receipt details. Each approved cup credits your 5-cup stamp progress.</p>
                </div>

                <div id="invoiceResponseBox" style="display: none;" class="mb-4"></div>

                <form id="santinoInvoiceForm" enctype="multipart/form-data">
                  <div class="row g-3 mb-3">
                    <div class="col-md-5">
                      <label class="form-label small fw-bold text-dark">Invoice / Memo Number *</label>
                      <input type="text" name="invoice_number" class="form-control" placeholder="e.g. SNT-2026-9042" required>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label small fw-bold text-dark">No. of Items / Cups *</label>
                      <div class="input-group">
                        <button class="btn btn-outline-secondary px-2 santino-cup-minus" type="button" style="font-weight: bold; border-color: #cbd5e1;">−</button>
                        <input type="number" name="cups" class="form-control text-center santino-cups-input" min="1" max="50" value="1" style="font-weight: bold; color: #00625d;" required>
                        <button class="btn btn-outline-secondary px-2 santino-cup-plus" type="button" style="font-weight: bold; border-color: #cbd5e1;">+</button>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label small fw-bold text-dark">Phone Number / WhatsApp *</label>
                      <input type="tel" name="phone" class="form-control santino-phone-validate" placeholder="017XXXXXXXX" pattern="^(?:\+?880|0)1[3-9]\d{8}$" maxlength="15" title="Please enter a valid 11-digit Bangladeshi phone number" required>
                    </div>
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-12">
                      <label class="form-label small fw-bold text-dark"><i class="bi bi-cup-hot-fill me-1" style="color: #00625d;"></i> Items Ordered / Consumed *</label>
                      <select name="items_consumed" class="form-select" required>
                        <option value="" disabled selected>-- Select Ordered Coffee / Item --</option>
                        <?php 
                        $ordered_items = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_order_item_choices() : array();
                        foreach ( $ordered_items as $item_choice ) : ?>
                          <option value="<?php echo esc_attr( $item_choice ); ?>"><?php echo esc_html( $item_choice ); ?></option>
                        <?php endforeach; ?>
                      </select>
                      <div class="form-text text-muted" style="font-size: 11px;">Select the handcrafted coffee or bakery item on your receipt.</div>
                    </div>
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-12">
                      <label class="form-label small fw-bold text-dark">Cafe Branch Visited</label>
                      <select name="branch" class="form-select">
                        <?php 
                        $cafe_branches = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_cafe_branches() : array( 'Gulshan-2 Flagship Experience Center' );
                        foreach ( $cafe_branches as $b ) : ?>
                          <option value="<?php echo esc_attr( $b ); ?>"><?php echo esc_html( $b ); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-4">
                    <label class="form-label small fw-bold text-dark"><i class="bi bi-camera-fill me-1" style="color: #00625d;"></i> Upload Invoice / Memo Photo * (Mandatory)</label>
                    <input type="file" name="invoice_image" id="santinoInvoiceImage" class="form-control" accept="image/jpeg,image/png,image/webp,image/jpg" required>
                    <div class="form-text text-muted small" style="font-size: 0.78rem;">Upload photo of your physical cafe bill/memo for fast verification (JPG, PNG, WebP) - Required.</div>
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
                  <p class="text-muted small">Join Regular Membership to activate your 5-cup digital coffee stamp card.</p>
                </div>

                <div id="membershipResponseBox" style="display: none;" class="mb-4"></div>

                <form id="santinoMembershipForm">
                  <div class="row g-3 mb-3">
                    <div class="col-md-12">
                      <label class="form-label small fw-bold text-dark">Full Name *</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                    </div>
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-12">
                      <label class="form-label small fw-bold text-dark">Mobile Number: *</label>
                      <input type="tel" name="phone" id="santinoMemberPhone" class="form-control" placeholder="017XXXXXXXX" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" title="Please enter a valid Bangladeshi phone number" required>
                      <div class="form-text text-muted" style="font-size: 11px;">Same mobile number cannot be re-registered without portal permission.</div>
                    </div>
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Birth Month *</label>
                      <select name="birth_month" class="form-select" required>
                        <option value="">Select Birth Month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Birth Day *</label>
                      <select name="birth_day" class="form-select" required>
                        <option value="">Select Birth Day</option>
                        <?php for ( $d = 1; $d <= 31; $d++ ) : ?>
                          <option value="<?php echo sprintf( '%02d', $d ); ?>"><?php echo sprintf( '%02d', $d ); ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>
                  </div>

                  <div class="row g-3 mb-4">
                    <div class="col-md-12">
                      <label class="form-label small fw-bold text-dark">Email Address *</label>
                      <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>
                  </div>

                  <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="termsCheck" checked required>
                    <label class="form-check-label small text-muted" for="termsCheck">
                      I agree to join Santino Coffee Club Regular Membership to receive reward stamps and free cups.
                    </label>
                  </div>

                  <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                    Register For Coffee Club Regular Membership →
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
endif;

get_footer();
