<?php
/**
 * Template Name: Santino Member Portal
 * Template Post Type: page
 *
 * Dedicated layout for /santino-member/ with 3 sections:
 * 1. Member Hero Banner & Floating Metrics
 * 2. VIP Loyalty Rewards & Digital Stamp Portal
 * 3. Cafe Discovery CTA Section
 *
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
?>

<style>
.santino-member-wrap,
.pro-banner-hero,
.club-portal-section,
#clubPortal {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
}

.pro-banner-title,
.sec-title,
.font-heading,
h1, h2, h3, h4, h5, h6,
.sec-pill-badge,
.portal-tabs .nav-link,
.btn,
.btn-portal-submit,
.btn-hero-lifestyle,
.btn-hero-outline,
.vip-card-surface h4,
.vip-card-surface .badge {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  letter-spacing: -0.3px;
}

.sec-title {
  font-size: clamp(2rem, 3.5vw, 2.8rem) !important;
  font-weight: 900 !important;
  color: #111111 !important;
  letter-spacing: -0.5px !important;
}

.sec-title-accent {
  color: var(--santino-teal, #00625d) !important;
}

.sec-pill-badge-wrap {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
}
.sec-pill-badge-wrap.light .sec-pill-line {
  width: 32px;
  height: 1px;
  background: rgba(255, 255, 255, 0.4);
}
.sec-pill-badge-wrap.light .sec-pill-badge {
  background: rgba(255, 255, 255, 0.12);
  border: 1px solid rgba(255, 255, 255, 0.35);
  color: #ffffff;
  padding: 6px 16px;
  border-radius: 50px;
  font-size: 0.78rem;
  font-weight: 800;
  letter-spacing: 1px;
  text-transform: uppercase;
  backdrop-filter: blur(4px);
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

.story-metrics-floating-wrap {
  position: relative;
  z-index: 15;
  margin-top: -55px;
  padding-bottom: 30px;
}
.metric-card-pro {
  background: #ffffff;
  border: 1.5px solid rgba(0, 98, 93, 0.12);
  border-radius: 22px;
  padding: 26px 20px 22px;
  text-align: center;
  box-shadow: 0 14px 34px rgba(0, 77, 73, 0.07);
  transition: transform 0.3s ease;
}
.metric-card-pro:hover {
  transform: translateY(-4px);
}
.metric-card-icon {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: rgba(0, 98, 93, 0.06);
  color: var(--santino-teal, #00625d);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
  margin-bottom: 12px;
}
.metric-card-pro .metric-num {
  font-size: 2.2rem;
  font-weight: 900;
  color: var(--santino-teal, #00625d);
  line-height: 1.1;
  margin-bottom: 6px;
}
.metric-card-pro .metric-label {
  color: #4a5c57;
  font-size: 0.86rem;
  font-weight: 700;
}

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
  box-shadow: 0 20px 40px rgba(0, 77, 73, 0.22);
}
.vip-card-watermark {
  position: absolute;
  right: -25px;
  bottom: -35px;
  font-size: 160px;
  color: rgba(255, 255, 255, 0.04);
  pointer-events: none;
  z-index: 1;
}
.gold-chip {
  width: 42px;
  height: 32px;
  border-radius: 6px;
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 50%, #b88a59 100%);
  border: 1px solid rgba(255,255,255,0.4);
  display: inline-block;
}
.stamp-slot {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}
.stamp-slot.active {
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
  color: #002d2b;
  border: 2px solid #ffffff;
}
.stamp-slot.empty {
  background: rgba(255, 255, 255, 0.08);
  border: 1.5px dashed rgba(195, 153, 108, 0.4);
  color: rgba(255, 255, 255, 0.4);
  font-size: 13px;
  font-weight: 700;
}
.stamp-slot.reward {
  background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
  border: 2px solid #ffffff;
}
.portal-tabs .nav-link {
  color: #4b6360;
  background: #ffffff;
  border: 1px solid #dbe5e2;
  border-radius: 12px;
  padding: 10px 18px;
  font-weight: 700;
  font-size: 13.5px;
}
.portal-tabs .nav-link.active {
  background: #00625d !important;
  color: #ffffff !important;
  border-color: #00625d !important;
}
.portal-card {
  background: #ffffff;
  border: 1px solid #dbe5e2;
  border-radius: 20px;
  box-shadow: 0 15px 35px rgba(0, 77, 73, 0.06);
}
.btn-portal-submit {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  border: none;
  border-radius: 10px;
  font-weight: 700;
  letter-spacing: 0.5px;
  padding: 14px 24px;
  transition: background 0.3s ease;
}
.btn-portal-submit:hover {
  background: #004d49;
  color: #ffffff;
}
.portal-lookup-group {
  background: #ffffff;
  border-radius: 50px;
  padding: 6px 8px 6px 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  border: 1.5px solid #d8e5e1;
}
.portal-lookup-field {
  flex: 1;
  display: flex;
  align-items: center;
  gap: 10px;
}
.portal-lookup-field input {
  border: none;
  outline: none;
  width: 100%;
  font-size: 0.95rem;
  color: #333;
  background: transparent;
}
.btn-lookup-action {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  border: none;
  padding: 10px 22px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 12px;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
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
.float-item svg {
  width: 100% !important;
  height: 100% !important;
  max-width: 65px !important;
  max-height: 65px !important;
}
.float-item-1 { top: 5%; left: 2%; width: 68px; height: 68px; }
.float-item-2 { top: 12%; right: 4%; width: 76px; height: 76px; }
.float-item-3 { top: 42%; left: 4%; width: 56px; height: 56px; }
.float-item-4 { top: 68%; right: 3%; width: 80px; height: 80px; }
.float-item-5 { bottom: 8%; left: 14%; width: 72px; height: 72px; }
.float-item-6 { top: 6%; left: 42%; width: 54px; height: 54px; }
</style>

<?php
$mb_hero_badge_raw = get_theme_mod( 'santino_member_hero_badge', get_theme_mod( 'santino_mb_hero_badge' ) );
$mb_hero_badge     = ( $mb_hero_badge_raw !== false ) ? trim( (string) $mb_hero_badge_raw ) : 'SANTINO VIP MEMBER PORTAL';
$mb_hero_title_raw = get_theme_mod( 'santino_member_hero_title', get_theme_mod( 'santino_mb_hero_title' ) );
$mb_hero_title     = ( $mb_hero_title_raw !== false ) ? trim( (string) $mb_hero_title_raw ) : 'Santino Member Club';
$mb_hero_accent_raw = get_theme_mod( 'santino_member_hero_accent', get_theme_mod( 'santino_mb_hero_title_accent' ) );
$mb_hero_title_accent = ( $mb_hero_accent_raw !== false ) ? trim( (string) $mb_hero_accent_raw ) : '& Rewards';
$mb_hero_desc_raw  = get_theme_mod( 'santino_member_hero_desc', get_theme_mod( 'santino_mb_hero_desc' ) );
$mb_hero_desc      = ( $mb_hero_desc_raw !== false ) ? trim( (string) $mb_hero_desc_raw ) : 'Track your 5-cup coffee stamps, upload cafe invoices, and claim your free 6th handcrafted cup across Santino partner cafes.';
$mb_hero_btn1_text = trim( (string) get_theme_mod( 'santino_member_btn1_text', 'Check Stamp Card' ) );
$mb_hero_btn1_url  = get_theme_mod( 'santino_member_btn1_url', '#clubPortal' );
$mb_hero_btn2_text = trim( (string) get_theme_mod( 'santino_member_btn2_text', 'Log Invoice Memo' ) );
$mb_hero_btn2_url  = get_theme_mod( 'santino_member_btn2_url', '#invoice-tab' );
$mb_hero_bg        = get_theme_mod( 'santino_member_bg', get_theme_mod( 'santino_mb_hero_bg' ) );
if ( ! $mb_hero_bg ) {
    $mb_hero_bg = function_exists('santino_get_page_banner') ? santino_get_page_banner('santino-member', 'imgi_20_santino_-_250522-07574.jpg') : ( function_exists('santino_img') ? santino_img('imgi_20_santino_-_250522-07574.jpg') : '' );
}
?>

<div class="santino-member-wrap">
  <!-- SECTION 1: HERO BANNER & FLOATING METRICS -->
  <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo esc_url( $mb_hero_bg ); ?>'); background-position: center; background-size: cover; min-height: 56vh; display: flex; align-items: center; justify-content: center; padding: 85px 20px;">
    <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0, 38, 35, 0.72) 100%); z-index: 1;"></div>
    
    <div class="container position-relative" style="max-width: 840px; z-index: 2;">
      <?php if ( $mb_hero_badge !== '' ) : ?>
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-gem me-1 text-warning"></i> <?php echo esc_html( $mb_hero_badge ); ?></span>
        <span class="sec-pill-line"></span>
      </div>
      <?php endif; ?>

      <?php if ( $mb_hero_title !== '' ) : ?>
      <h1 class="pro-banner-title mb-3" style="font-size: clamp(2.3rem, 4.5vw, 3.6rem); font-weight: 900; line-height: 1.18; letter-spacing: -0.5px; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
        <?php echo esc_html( $mb_hero_title ); ?> <?php if ( $mb_hero_title_accent !== '' ) : ?><span style="color: #dfbe8d;"><?php echo esc_html( $mb_hero_title_accent ); ?></span><?php endif; ?>
      </h1>
      <?php endif; ?>

      <?php if ( $mb_hero_desc !== '' ) : ?>
      <p class="pro-banner-desc mb-4" style="max-width: 640px; font-size: 1.08rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.4);">
        <?php echo esc_html( $mb_hero_desc ); ?>
      </p>
      <?php endif; ?>

      <?php if ( $mb_hero_btn1_text !== '' || $mb_hero_btn2_text !== '' ) : ?>
      <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
        <?php if ( $mb_hero_btn1_text !== '' ) : ?>
        <a href="<?php echo esc_url( $mb_hero_btn1_url ); ?>" class="btn-hero-lifestyle">
          <span><?php echo esc_html( $mb_hero_btn1_text ); ?></span>
          <i class="bi bi-arrow-right"></i>
        </a>
        <?php endif; ?>
        <?php if ( $mb_hero_btn2_text !== '' ) : ?>
        <a href="<?php echo esc_url( $mb_hero_btn2_url ); ?>" class="btn-hero-outline">
          <i class="bi bi-receipt-cutoff text-warning"></i>
          <span><?php echo esc_html( $mb_hero_btn2_text ); ?></span>
        </a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
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

  <!-- SECTION 2: VIP MEMBER LOYALTY PORTAL -->
  <section class="py-5 club-portal-section position-relative overflow-hidden" id="clubPortal">
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
        <!-- LEFT COLUMN: VIP Stamp Card Display -->
        <div class="col-lg-5">
          <div class="d-flex flex-column gap-3">
            <div class="vip-card-surface">
              <i class="bi bi-cup-hot vip-card-watermark"></i>
              
              <div class="d-flex justify-content-between align-items-start mb-3 position-relative" style="z-index: 2;">
                <div>
                  <div class="small fw-bold text-uppercase" style="color: #dfbe8d; letter-spacing: 1.5px; font-size: 11px;">
                    SANTINO COFFEE CLUB
                  </div>
                  <h4 class="font-heading fw-bold text-white mb-0 mt-1">Regular Member</h4>
                </div>
                <div class="gold-chip"></div>
              </div>

              <div class="mb-4 position-relative" style="z-index: 2;">
                <div class="font-monospace text-white-50 small" style="letter-spacing: 2px;">SNT-REG-•••• ••••</div>
              </div>

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
                    <div class="stamp-slot reward mb-1"><i class="bi bi-gift-fill" style="color: #002d2b; font-size: 16px;"></i></div>
                    <div style="font-size: 9.5px; color: #dfbe8d; font-weight: 700;">FREE #6</div>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center text-white-50 small position-relative" style="z-index: 2; font-size: 11px;">
                <span>Valid across all Dhaka branches</span>
                <span style="color: #dfbe8d;"><i class="bi bi-patch-check-fill me-1"></i> Auto-Verified</span>
              </div>
            </div>

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
                  <div class="text-muted" style="font-size: 10px;">Submit invoice &amp; cups</div>
                </div>
                <div class="col-4">
                  <div class="fs-4 text-teal mb-1" style="color: #c3996c !important;"><i class="bi bi-gift"></i></div>
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
                  <p class="text-muted small">Enter your Registered Phone Number below.</p>
                </div>

                <form id="santinoLookupForm" class="mb-4">
                  <div class="portal-lookup-group">
                    <div class="portal-lookup-field">
                      <i class="bi bi-telephone text-teal"></i>
                      <input type="text" name="query" placeholder="e.g. 017XXXXXXXX" required>
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
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Invoice / Memo Number *</label>
                      <input type="text" name="invoice_number" class="form-control" placeholder="e.g. SNT-2026-9042" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold text-dark">Phone Number / WhatsApp *</label>
                      <input type="tel" name="phone" class="form-control santino-phone-validate" placeholder="017XXXXXXXX" pattern="^(?:\+?880|0)1[3-9]\d{8}$" maxlength="15" title="Please enter a valid 11-digit Bangladeshi phone number" required>
                    </div>
                  </div>

                  <!-- Dynamic Multi-Item Order Section (Compact & Mobile-First) -->
                  <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                      <label class="form-label small fw-bold text-dark mb-0">
                        <i class="bi bi-cup-hot-fill me-1" style="color: #00625d;"></i> Items Ordered / Consumed *
                      </label>
                      <span class="santino-total-cups-badge">
                        Total: <span class="santino-total-cups-count">1</span> Cup(s)/Item(s)
                      </span>
                    </div>

                    <div class="santino-order-items-container mb-2">
                      <div class="santino-order-item-row">
                        <div class="santino-row-main">
                          <select name="order_items[]" class="santino-item-select" required>
                            <option value="" disabled selected>-- Select Ordered Coffee / Item --</option>
                            <?php 
                            $ordered_items = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_order_item_choices() : array();
                            foreach ( $ordered_items as $item_choice ) : ?>
                              <option value="<?php echo esc_attr( $item_choice ); ?>"><?php echo esc_html( $item_choice ); ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="santino-row-actions">
                          <div class="santino-stepper-capsule">
                            <button type="button" class="santino-stepper-btn santino-row-minus" aria-label="Decrease">−</button>
                            <input type="text" name="order_qtys[]" class="santino-stepper-val santino-row-qty" value="1" readonly>
                            <button type="button" class="santino-stepper-btn santino-row-plus" aria-label="Increase">+</button>
                          </div>
                          <button type="button" class="santino-remove-item-row d-none" title="Remove item">
                            <i class="bi bi-trash3"></i>
                          </button>
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-2">
                      <button type="button" class="btn santino-add-order-item-btn">
                        <i class="bi bi-plus-circle-fill"></i> Add Another Item
                      </button>
                      <div class="text-muted" style="font-size: 11px;">Specify each item &amp; quantity</div>
                    </div>

                    <input type="hidden" name="cups" class="santino-cups-input" value="1">
                    <input type="hidden" name="items_consumed" class="santino-items-consumed-summary" value="">
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
                    <label class="form-label small fw-bold text-dark"><i class="bi bi-camera-fill me-1 text-teal"></i> Upload Invoice / Memo Photo * (Mandatory)</label>
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
                      <label class="form-label small fw-bold text-dark">Mobile Number / WhatsApp *</label>
                      <input type="tel" name="phone" id="santinoMemberPhone" class="form-control" placeholder="017XXXXXXXX or +88017XXXXXXXX" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" title="Please enter a valid Bangladeshi phone number" required>
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
                      I agree to join Santino Coffee Club Regular Membership to receive reward stamps.
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

  <?php
  $mb_show_cta     = get_theme_mod( 'santino_mb_show_cta', '1' );
  if ( $mb_show_cta ) :
    $mb_cta_title    = get_theme_mod( 'santino_mb_cta_title', 'Ready For Your Next Handcrafted Brew?' );
    $mb_cta_desc     = get_theme_mod( 'santino_mb_cta_desc', 'Visit our barista bars across Gulshan, Banani, Dhanmondi & Uttara.' );
    $mb_cta_btn_text = get_theme_mod( 'santino_mb_cta_btn_text', 'Explore Full Menu →' );
    $mb_cta_btn_url  = get_theme_mod( 'santino_mb_cta_btn_url', '/menu/' );
  ?>
  <!-- SECTION 3: CAFE DISCOVERY CTA -->
  <section class="py-5 bg-white text-center border-top">
    <div class="container py-4" style="max-width: 700px;">
      <div class="sec-pill-badge-wrap mb-2">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> VISIT OUR CAFES</span>
        <span class="sec-pill-line"></span>
      </div>

      <h2 class="sec-title mb-2">
        <?php echo esc_html( $mb_cta_title ); ?>
      </h2>

      <p class="text-muted mb-4" style="font-size: 0.98rem; max-width: 540px; margin: 0 auto; line-height: 1.6;">
        <?php echo esc_html( $mb_cta_desc ); ?>
      </p>

      <?php if ( ! empty( $mb_cta_btn_text ) ) : ?>
      <div class="d-flex justify-content-center">
        <a href="<?php echo esc_url( $mb_cta_btn_url ); ?>" class="btn-hero-lifestyle">
          <span><?php echo esc_html( $mb_cta_btn_text ); ?></span>
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <?php endif; ?>
</div>

<?php
endif;

get_footer();
