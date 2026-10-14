<?php
/**
 * Template Name: Santino Our Heritage & Journey
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
.story-page-wrap, body, p, .text-muted, .text-secondary, label, input, select, textarea {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
}

.pro-banner-title,
.sec-title,
.story-hero-heading,
.font-heading,
h1, h2, h3, h4, h5, h6,
.sec-pill-badge,
.btn-hero-lifestyle,
.btn-hero-outline,
.metric-num,
.story-chapter-title,
.vision-feature-card h4 {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  letter-spacing: -0.3px;
}

.story-video-hero {
  position: relative;
  overflow: hidden;
  min-height: 68vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 110px 20px 95px;
}

.story-video-wrap {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: 1;
}

.story-video-bg {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.story-video-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(0, 0, 0, 0.42) 0%, rgba(0, 38, 35, 0.82) 100%);
  z-index: 2;
}

.sec-title {
  font-size: clamp(2.1rem, 3.8vw, 3rem) !important;
  font-weight: 900 !important;
  color: #111111;
  letter-spacing: -0.6px !important;
  line-height: 1.25 !important;
}

.sec-title.text-white,
.text-white .sec-title {
  color: #ffffff !important;
}

.sec-title-accent {
  color: var(--santino-teal, #00625d) !important;
}

.sec-description, .story-vision-text, .story-chapter-desc {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
  color: #556662;
  font-size: 1.08rem;
  line-height: 1.75;
}

.sec-pill-badge-wrap {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
}

.sec-pill-line {
  width: 36px;
  height: 1.5px;
  background: rgba(0, 98, 93, 0.35);
  display: inline-block;
  border-radius: 2px;
}

.sec-pill-badge-wrap.light .sec-pill-line {
  background: rgba(255, 255, 255, 0.45);
}

.sec-pill-badge {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(0, 98, 93, 0.08);
  color: var(--santino-teal, #00625d);
  border: 1px solid rgba(0, 98, 93, 0.24);
  padding: 6px 20px;
  border-radius: 50px;
  font-size: 0.78rem;
  font-weight: 800;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  backdrop-filter: blur(4px);
}

.sec-pill-badge i {
  font-size: 8px;
  color: var(--santino-teal, #00625d);
}

.sec-pill-badge.light {
  background: rgba(255, 255, 255, 0.14);
  color: #ffffff;
  border: 1px solid rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(10px);
}

.sec-pill-badge.light i {
  color: var(--santino-gold, #dfbe8d);
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
  box-shadow: 0 8px 20px rgba(0, 98, 93, 0.35) !important;
}

.btn-hero-lifestyle:hover {
  background: #004d49 !important;
  border-color: #004d49 !important;
  color: #ffffff !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 12px 28px rgba(0, 98, 93, 0.5) !important;
}

.btn-hero-lifestyle:hover i {
  transform: translateX(4px) !important;
}

.btn-hero-outline {
  background: rgba(0, 0, 0, 0.25) !important;
  backdrop-filter: blur(8px) !important;
  border: 2px solid rgba(255, 255, 255, 0.88) !important;
  color: #ffffff !important;
}

.btn-hero-outline:hover {
  background: #ffffff !important;
  color: var(--santino-teal, #00625d) !important;
  border-color: #ffffff !important;
  transform: translateY(-2px) !important;
  box-shadow: 0 10px 26px rgba(255, 255, 255, 0.35) !important;
}

.btn-hero-outline:hover i {
  transform: translateY(2px) !important;
}

.btn-hero-outline:hover .text-warning {
  color: var(--santino-teal, #00625d) !important;
}

/* Floating Metrics Bar (Luxury Overlap Pattern) */
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
  box-shadow: 0 14px 34px rgba(0, 77, 73, 0.07), 0 2px 6px rgba(0, 0, 0, 0.03);
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.metric-card-pro::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--santino-teal, #00625d), var(--santino-gold, #dfbe8d));
  opacity: 0;
  transition: opacity 0.3s ease;
}

.metric-card-pro:hover {
  transform: translateY(-7px);
  border-color: rgba(0, 98, 93, 0.35);
  box-shadow: 0 20px 42px rgba(0, 98, 93, 0.15);
}

.metric-card-pro:hover::before {
  opacity: 1;
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
  transition: all 0.3s ease;
}

.metric-card-pro:hover .metric-card-icon {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  transform: scale(1.1);
}

.metric-card-pro .metric-num {
  font-size: 2.55rem;
  font-weight: 900;
  color: var(--santino-teal, #00625d);
  line-height: 1.1;
  margin-bottom: 6px;
  letter-spacing: -0.5px;
}

.metric-card-pro .metric-label {
  color: #4a5c57;
  font-size: 0.86rem;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0.2px;
}

/* Vision Feature Cards (3 Luxury Cards) */
.story-vision-section {
  background: radial-gradient(circle at 50% 15%, rgba(0, 98, 93, 0.035) 0%, rgba(255, 255, 255, 1) 75%);
}

.vision-feature-card {
  background: #ffffff;
  border: 1.5px solid rgba(0, 98, 93, 0.12);
  border-radius: 24px;
  padding: 38px 28px 32px;
  text-align: center;
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 0 12px 30px rgba(0, 98, 93, 0.05);
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  overflow: hidden;
}

.vision-feature-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, transparent, var(--santino-teal, #00625d), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.vision-feature-card:hover {
  transform: translateY(-8px);
  border-color: rgba(0, 98, 93, 0.38);
  box-shadow: 0 22px 50px rgba(0, 98, 93, 0.14);
}

.vision-feature-card:hover::before {
  opacity: 1;
}

.vision-icon-wrap {
  width: 72px;
  height: 72px;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(0, 98, 93, 0.08) 0%, rgba(223, 190, 141, 0.15) 100%);
  color: var(--santino-teal, #00625d);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  margin-bottom: 18px;
  transition: all 0.35s ease;
  border: 1.5px solid rgba(0, 98, 93, 0.16);
}

.vision-feature-card:hover .vision-icon-wrap {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  transform: scale(1.1) rotate(6deg);
  box-shadow: 0 10px 24px rgba(0, 98, 93, 0.3);
  border-color: var(--santino-teal, #00625d);
}

.vision-badge-pill {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif);
  font-size: 0.72rem;
  font-weight: 800;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  color: var(--santino-teal, #00625d);
  background: rgba(0, 98, 93, 0.08);
  padding: 4px 12px;
  border-radius: 30px;
  margin-bottom: 12px;
  display: inline-block;
}

.vision-feature-card h4 {
  font-size: 1.28rem;
  font-weight: 800;
  color: #111111;
  margin-bottom: 12px;
  letter-spacing: -0.3px;
}

.vision-feature-card p {
  color: #556662;
  font-size: 0.95rem;
  line-height: 1.68;
  margin: 0;
}
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

.story-split-img {
  width: 100%;
  height: 400px;
  object-fit: cover;
  border-radius: 24px;
  border: 1px solid rgba(0, 98, 93, 0.12);
}

.story-img-badge {
  position: absolute;
  bottom: 22px;
  left: 22px;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(12px);
  padding: 12px 20px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  gap: 14px;
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
  border: 1px solid rgba(0, 98, 93, 0.15);
}

.story-img-badge strong {
  display: block;
  font-family: var(--kp-font-title, 'Montserrat', sans-serif);
  font-size: 13.5px;
  color: #111111;
  font-weight: 800;
}

.story-img-badge span {
  font-size: 11.5px;
  color: var(--santino-teal, #00625d);
  font-weight: 700;
}

.story-bullet-list {
  list-style: none;
  padding: 0;
  margin: 22px 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.story-bullet-list li {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  font-size: 0.96rem;
  color: #445551;
  line-height: 1.6;
}

.story-bullet-list li i {
  color: var(--santino-teal, #00625d);
  font-size: 1.15rem;
  margin-top: 2px;
  flex-shrink: 0;
}

.story-chapter-title {
  font-size: clamp(1.6rem, 2.5vw, 2.1rem);
  font-weight: 900;
  color: #111111;
  line-height: 1.3;
  margin-bottom: 16px;
}
</style>

<div class="story-page-wrap">

  <section class="story-video-hero position-relative overflow-hidden text-center">
    
    <div class="story-video-wrap">
      <?php
      $story_vid = get_theme_mod( 'santino_story_video_mp4' );
      if ( ! $story_vid ) $story_vid = get_theme_mod( 'santino_story_video_url', 'https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/ab6140f6-129c-4ae9-aaa0-20190c43183b.mp4' );
      $story_poster = get_theme_mod( 'santino_story_poster_img' );
      if ( ! $story_poster ) $story_poster = santino_img('imgi_20_santino_-_250522-07574.jpg');
      ?>
      <video class="story-video-bg" autoplay muted loop playsinline poster="<?php echo esc_url( $story_poster ); ?>">
        <source src="<?php echo esc_url( $story_vid ); ?>" type="video/mp4">
      </video>
      <div class="story-video-overlay"></div>
    </div>
    
    <div class="container position-relative" style="max-width: 860px; z-index: 3;">
      
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge light">
          <i class="bi bi-gem me-1 text-warning"></i> SINCE 1996 • 30+ YEARS ROASTING HERITAGE
        </span>
        <span class="sec-pill-line"></span>
      </div>

      <h1 class="pro-banner-title mb-3" style="font-family: var(--kp-font-title, 'Montserrat', sans-serif); font-size: clamp(2.4rem, 4.8vw, 3.8rem); font-weight: 900; line-height: 1.18; letter-spacing: -0.5px; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.6);">
        The Game Changer in <span style="color: #dfbe8d;">Specialty Coffee Culture</span>
      </h1>

      <p class="pro-banner-desc mb-4" style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); max-width: 680px; font-size: 1.08rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.5);">
        From direct origin estates in Ethiopia and Colombia to precision roasting labs, championship barista academies, and nationwide supermarket presence in Bangladesh.
      </p>

      <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
        <a href="#vision" class="btn-hero-lifestyle">
          <span>Discover Our Story</span>
          <i class="bi bi-arrow-right"></i>
        </a>
        <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-hero-outline">
          <i class="bi bi-arrow-down-short text-warning"></i>
          <span>Explore Menu</span>
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
            <div class="metric-card-icon"><i class="bi bi-clock-history"></i></div>
            <div class="metric-num">30+</div>
            <div class="metric-label">Years of Roasting Mastery</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-building"></i></div>
            <div class="metric-num">500+</div>
            <div class="metric-label">Hotels, Cafes &amp; Corporate Hubs</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-patch-check-fill"></i></div>
            <div class="metric-num">100%</div>
            <div class="metric-label">FSSC22000 Food Certified</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="metric-card-pro">
            <div class="metric-card-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div class="metric-num">1,000+</div>
            <div class="metric-label">Certified Barista Graduates</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="story-vision-section py-5 my-lg-2 position-relative" id="vision">
    <div class="floating-bg-icons">
      <i class="bi bi-compass" style="top: 20%; left: 4%; font-size: 40px;"></i>
      <i class="bi bi-award" style="bottom: 10%; right: 4%; font-size: 45px;"></i>
    </div>

    <div class="container position-relative" style="z-index: 1;">
      <div class="row justify-content-center text-center">
        <div class="col-xl-9 col-lg-10 reveal">
          <div class="sec-pill-badge-wrap mb-3">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> OUR PURPOSE &amp; VISION</span>
            <span class="sec-pill-line"></span>
          </div>
          <h2 class="sec-title mb-3">Innovation Grounded in <span class="sec-title-accent">Heritage</span></h2>
          <p class="story-vision-text mb-4" style="max-width: 780px; margin: 0 auto 35px;">
            Santino Coffee was born with a single mission: to empower coffee entrepreneurs, businesses, and coffee lovers with world-class beans, precision machinery, and deep sensory knowledge. We believe that every cup tells a story of dedicated farmers, meticulous roast masters, and passionate baristas.
          </p>
          
          <div class="row g-4 mt-2">
            <div class="col-md-4">
              <div class="vision-feature-card">
                <div class="vision-icon-wrap">
                  <i class="bi bi-globe-americas"></i>
                </div>
                <span class="vision-badge-pill">Direct Farm Sourcing</span>
                <h4>Authentic Origin</h4>
                <p>100% ethically sourced Rainforest Alliance certified green beans from direct partner estates.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="vision-feature-card">
                <div class="vision-icon-wrap">
                  <i class="bi bi-fire"></i>
                </div>
                <span class="vision-badge-pill">Master Roasting</span>
                <h4>Precision Roasting</h4>
                <p>Custom roast profiles digitally calibrated to temperature, humidity, and peak flavor release.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="vision-feature-card">
                <div class="vision-icon-wrap">
                  <i class="bi bi-shield-check"></i>
                </div>
                <span class="vision-badge-pill">Dedicated 24/7 Care</span>
                <h4>Continuous Care</h4>
                <p>24/7 technical breakdown support, preventive maintenance, and barista training academies.</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <section class="story-split-chapters-section py-5 position-relative">
    <div class="container">
      
      <div class="story-split-row row align-items-center g-5 mb-5 pb-lg-5">
        <div class="col-lg-6 reveal-left">
          <div class="story-split-img-wrapper position-relative hover-img-zoom">
            <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Artisan Roastery" class="story-split-img shadow-sm">
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
          <div class="sec-pill-badge-wrap mb-3">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> CHAPTER 01</span>
            <span class="sec-pill-line"></span>
          </div>
          <h3 class="story-chapter-title">Artisan Roasting &amp; <span class="sec-title-accent">Quality Without Compromise</span></h3>
          <p class="story-chapter-desc">
            Everything we roast represents an unyielding dedication to excellence. Our roastery facilities operate under strict FSSC22000 food safety certifications, roasting single origins and private label blends with high batch consistency.
          </p>
          <ul class="story-bullet-list">
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>Rainforest Alliance Certified:</strong> Direct farm relationships ensuring sustainable livelihood for growers.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>Custom Private Label OEM:</strong> Tailored flavor curves designed for five-star hotels and specialty roasteries.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>Real-Time Profile Tracking:</strong> Digital thermocouple logging ensuring ±0.5°C batch consistency.</span></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/beans/' ) ); ?>" class="btn-hero-lifestyle mt-2">
            <span>Explore Bean Collections</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="story-split-row row align-items-center g-5 mb-5 pb-lg-5 flex-lg-row-reverse">
        <div class="col-lg-6 reveal-right">
          <div class="story-split-img-wrapper position-relative hover-img-zoom">
            <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="Victoria Arduino Machinery" class="story-split-img shadow-sm">
            <div class="story-img-badge">
              <i class="bi bi-cpu-fill text-primary fs-4"></i>
              <div>
                <strong>Next-Gen Automation</strong>
                <span>Victoria Arduino &amp; Bionic Robots</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 pe-lg-5 reveal-left">
          <div class="sec-pill-badge-wrap mb-3">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> CHAPTER 02</span>
            <span class="sec-pill-line"></span>
          </div>
          <h3 class="story-chapter-title">State-of-the-Art Espresso &amp; <span class="sec-title-accent">Bionic Robotics</span></h3>
          <p class="story-chapter-desc">
            We partner with the world's most prestigious espresso machine innovators — Victoria Arduino, Nuova Simonelli, Kalerm, and CAYE Robotics — delivering commercial extraction consistency that elevates customer retention and operational speed.
          </p>
          <ul class="story-bullet-list">
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>T3 Genius PureBrew Technology:</strong> Variable water flow and gravimetric dosing on Victoria Arduino Black Eagle &amp; Eagle One.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>CAYE Bionic Barista Robotic Arms:</strong> Fully automated 6-axis barista robots delivering flawless latte art in under 60 seconds.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>Turnkey Machine Leasing:</strong> Complete corporate rental packages with guaranteed zero-downtime maintenance.</span></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="btn-hero-lifestyle mt-2">
            <span>View Machine Catalog</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="story-split-row row align-items-center g-5 mb-5 pb-lg-5">
        <div class="col-lg-6 reveal-left">
          <div class="story-split-img-wrapper position-relative hover-img-zoom">
            <img src="<?php echo santino_img('bd-barista-training.jpg'); ?>" alt="Barista Training Academy" class="story-split-img shadow-sm">
            <div class="story-img-badge">
              <i class="bi bi-trophy-fill text-warning fs-4"></i>
              <div>
                <strong>Championship Coaching</strong>
                <span>Certified Barista Trainers</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 ps-lg-5 reveal-right">
          <div class="sec-pill-badge-wrap mb-3">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> CHAPTER 03</span>
            <span class="sec-pill-line"></span>
          </div>
          <h3 class="story-chapter-title">Empowering the Next Generation of <span class="sec-title-accent">Coffee Leaders</span></h3>
          <p class="story-chapter-desc">
            Knowledge is the heartbeat of our craft. Santino Barista Academy offers internationally structured certification programs, crop-to-cup sensory training, and competitive coaching for aspiring champions in Bangladesh.
          </p>
          <ul class="story-bullet-list">
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>Foundational to Master Barista:</strong> Milk texturing, espresso calibration, workflow ergonomics, and cupping.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>Corporate Staff Upskilling:</strong> Standardizing beverage execution across multi-branch restaurant operations.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>Specialty Brewing Modules:</strong> V60, Chemex, Aeropress, Cold Brew, and Syphon sensory mastery.</span></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/training/' ) ); ?>" class="btn-hero-lifestyle mt-2">
            <span>Enroll in Barista Academy</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="story-split-row row align-items-center g-5 flex-lg-row-reverse">
        <div class="col-lg-6 reveal-right">
          <div class="story-split-img-wrapper position-relative hover-img-zoom">
            <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="Shwapno Supermarket Partnership" class="story-split-img shadow-sm">
            <div class="story-img-badge">
              <i class="bi bi-shop-window text-success fs-4"></i>
              <div>
                <strong>Nationwide Presence</strong>
                <span>Shwapno Superstores &amp; BFC Dining</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 pe-lg-5 reveal-left">
          <div class="sec-pill-badge-wrap mb-3">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> CHAPTER 04</span>
            <span class="sec-pill-line"></span>
          </div>
          <h3 class="story-chapter-title">Everyday Specialty Coffee for <span class="sec-title-accent">Every Community</span></h3>
          <p class="story-chapter-desc">
            We are bridging the gap between luxury specialty coffee and everyday accessibility. Today, Santino roasted bean packs are available on retail shelves at Shwapno Superstores nationwide, and freshly brewed coffees are served across 50+ BFC restaurant locations.
          </p>
          <ul class="story-bullet-list">
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>100+ Shwapno Outlets:</strong> Freshly sealed 250g &amp; 1kg bags available at your neighborhood supermarket.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>50+ BFC Quick Service Bars:</strong> Hot and iced espresso beverages brewed on authentic commercial Italian machines.</span></li>
            <li><i class="bi bi-check-circle-fill"></i> <span><strong>B2B Direct Supply:</strong> Fast scheduled deliveries maintaining optimal bean degassing periods.</span></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/swapno/' ) ); ?>" class="btn-hero-lifestyle mt-2">
            <span>Explore Retail Outlets</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>

    </div>
  </section>

  <section class="story-marquee-reel-section py-5 my-4 bg-light reveal">
    <div class="container-fluid px-0">
      
      <div class="text-center mb-4">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> MOMENTS AT SANTINO</span>
          <span class="sec-pill-line"></span>
        </div>
        <h3 class="sec-title mt-1">Inside Our Roastery, <span class="sec-title-accent">Cafes &amp; Labs</span></h3>
      </div>

      <div class="story-photo-marquee-track track-left mb-3">
        <div class="story-marquee-row">
          <img src="<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_25_santino_-_250522-07618.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_26_santino_-_250522-07312.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_27_santino_-_250522-07216.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('imgi_25_santino_-_250522-07618.jpg'); ?>" alt="" class="reel-photo">
        </div>
      </div>

      <div class="story-photo-marquee-track track-right">
        <div class="story-marquee-row">
          <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('bfc_santino_foodservice.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('bd-barista-training.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('santino_cup_specialist.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('menu-raw-coconut-latte.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('menu-cappuccino-hot.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('bfc_santino_foodservice.jpg'); ?>" alt="" class="reel-photo">
          <img src="<?php echo santino_img('bd-barista-training.jpg'); ?>" alt="" class="reel-photo">
        </div>
      </div>

    </div>
  </section>

  <section class="story-cta-section text-center py-5 reveal">
    <div class="container">
      <div class="p-4 p-md-5 rounded-4 position-relative text-white overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #002b28 0%, #00504b 50%, #002220 100%); border: 1px solid rgba(212, 175, 55, 0.35);">
        <div class="position-relative" style="z-index: 2;">
          <div class="sec-pill-badge-wrap light mb-3">
            <span class="sec-pill-line"></span>
            <span class="sec-pill-badge light">
              <i class="bi bi-handshake me-1" style="color: #dfbe8d;"></i> BECOME A PARTNER
            </span>
            <span class="sec-pill-line"></span>
          </div>
          <h2 class="sec-title text-white mb-3">Ready to Elevate Your <span style="color: #dfbe8d;">Coffee Experience?</span></h2>
          <p class="text-white-50 mx-auto mb-4" style="max-width: 680px; font-size: 1.05rem; line-height: 1.6;">
            Whether you are opening a specialty cafe, outfitting a hotel with commercial espresso machinery, or looking for freshly roasted wholesale beans, Santino is your total solutions partner.
          </p>
          <div class="d-flex justify-content-center flex-wrap gap-3">
            <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#enquiryModal">
              <span>Book A Roastery Visit</span>
              <i class="bi bi-arrow-right"></i>
            </button>
            <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-hero-outline">
              <i class="bi bi-arrow-down-short text-warning"></i>
              <span>Explore Drinks Menu</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="enquiryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 p-4 shadow-lg">
        <div class="modal-header border-0 pb-0">
          <div>
            <div class="sec-pill-badge-wrap mb-1">
              <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> GET IN TOUCH</span>
            </div>
            <h4 class="modal-title font-heading fw-bold mt-1">Connect with Santino</h4>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted small mb-4">Leave your details and our commercial coffee specialist will contact you promptly.</p>
          <form class="santino-inquiry-form">
            <input type="hidden" name="inquiry_type" value="our_story_inquiry">
            <div class="mb-3">
              <label class="form-label small fw-bold">Full Name *</label>
              <input type="text" name="name" class="form-control rounded-pill px-3 py-2 border-1" placeholder="Tanvir Ahmed" required style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); border-color: #d5e5e0;">
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Phone Number *</label>
              <input type="tel" name="phone" class="form-control rounded-pill px-3 py-2 border-1" placeholder="+880 1711-000000" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" required style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); border-color: #d5e5e0;">
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Email Address *</label>
              <input type="email" name="email" class="form-control rounded-pill px-3 py-2 border-1" placeholder="tanvir@example.com" required style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); border-color: #d5e5e0;">
            </div>
            <div class="mb-4">
              <label class="form-label small fw-bold">Interested In</label>
              <select name="service" class="form-select rounded-pill px-3 py-2 border-1" style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); border-color: #d5e5e0;">
                <option value="Commercial Espresso Machinery">Commercial Espresso Machinery</option>
                <option value="Wholesale Coffee Beans (Rainforest Alliance)">Wholesale Coffee Beans (Rainforest Alliance)</option>
                <option value="Barista Academy & Staff Training">Barista Academy &amp; Staff Training</option>
                <option value="Cafe Franchise & VIP Membership">Cafe Franchise &amp; VIP Membership</option>
              </select>
            </div>
            <button type="submit" class="btn-hero-lifestyle w-100 py-3 font-heading fw-bold text-uppercase">
              SEND INQUIRY
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
endif;
get_footer();
