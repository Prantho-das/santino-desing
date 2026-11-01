<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Swapno_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_swapno_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino Shwapno Retail Solution', 'santino' );
    }

    public function get_icon() {
        return 'eicon-store';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_hero',
            array(
                'label' => esc_html__( 'Hero Banner', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'hero_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'OFFICIAL RETAIL PARTNER',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Shwapno × Santino Retail Coffee',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Freshly roasted specialty coffee bean packs available on supermarket shelves across 100+ Shwapno Superstores in Bangladesh.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
        .swapno-page-wrap, body, p, .pro-banner-desc, .text-muted, .text-secondary, label, input, select, textarea {
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
        .editorial-gallery-item {
          position: relative;
          border-radius: 18px;
          overflow: hidden;
          background-color: #111;
          height: 100%;
          min-height: 240px;
          box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .editorial-gallery-img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          position: absolute;
          inset: 0;
          transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .editorial-gallery-item:hover .editorial-gallery-img {
          transform: scale(1.05);
        }
        .editorial-gallery-overlay {
          position: absolute;
          inset: 0;
          background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.78) 75%, rgba(0,0,0,0.92) 100%);
          display: flex;
          flex-direction: column;
          justify-content: flex-end;
          padding: 24px;
          z-index: 2;
        }
        .editorial-gallery-badge {
          display: inline-block;
          font-size: 11px;
          font-weight: 700;
          text-transform: uppercase;
          letter-spacing: 0.8px;
          color: #00a896;
          margin-bottom: 8px;
        }
        .editorial-gallery-title {
          font-size: 1.25rem;
          font-weight: 800;
          color: #ffffff;
          margin-bottom: 6px;
        }
        .editorial-gallery-desc {
          font-size: 0.88rem;
          color: rgba(255,255,255,0.75);
          margin-bottom: 0;
          line-height: 1.45;
        }
        .badge-theme-teal {
          background-color: rgba(0, 98, 93, 0.1);
          color: var(--santino-teal, #00625d);
          font-size: 10px;
          font-weight: 700;
          text-transform: uppercase;
          letter-spacing: 0.6px;
          padding: 4px 10px;
          border-radius: 50px;
          display: inline-flex;
          align-items: center;
        }
        .badge-theme-gold {
          background-color: rgba(223, 190, 141, 0.15);
          color: #8e683b;
          font-size: 10px;
          font-weight: 700;
          text-transform: uppercase;
          letter-spacing: 0.6px;
          padding: 4px 10px;
          border-radius: 50px;
          display: inline-flex;
          align-items: center;
        }
        .badge-theme-maroon {
          background-color: rgba(142, 28, 44, 0.1);
          color: #8e1c2c;
          font-size: 10px;
          font-weight: 700;
          text-transform: uppercase;
          letter-spacing: 0.6px;
          padding: 4px 10px;
          border-radius: 50px;
          display: inline-flex;
          align-items: center;
        }
        .branch-card-pro {
          background: #ffffff;
          border-radius: 16px;
          padding: 20px;
          border: 1px solid #e5ece9;
          transition: all 0.28s ease;
          height: 100%;
          display: flex;
          flex-direction: column;
        }
        .branch-card-pro:hover {
          transform: translateY(-4px);
          box-shadow: 0 12px 28px rgba(0, 98, 93, 0.08);
          border-color: #c2ddd7;
        }
        .branch-filter-btn {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif);
          font-weight: 600;
          font-size: 12px;
          letter-spacing: 0.3px;
          padding: 7px 18px;
          border-radius: 50px;
          border: 1px solid #d5e0dc;
          background: #ffffff;
          color: #495057;
          transition: all 0.2s ease;
          cursor: pointer;
        }
        .branch-filter-btn:hover,
        .branch-filter-btn.active {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          border-color: var(--santino-teal, #00625d);
        }
        .portal-lookup-group {
          background: #ffffff;
          border-radius: 50px;
          padding: 6px 8px 6px 20px;
          display: flex;
          align-items: center;
          gap: 12px;
          border: 1.5px solid #d8e5e1;
          box-shadow: 0 4px 14px rgba(0,0,0,0.04);
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
          transition: background 0.2s;
        }
        .btn-lookup-action:hover {
          background: #004d49;
        }
        .btn-branch-action {
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
          margin-top: auto;
        }
        .btn-branch-action:hover {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
        }
        </style>

        <div class="swapno-page-wrap">
          <section class="pro-banner-hero pro-banner-swapno position-relative overflow-hidden text-center" style="background-image: url('<?php echo function_exists('santino_get_page_banner') ? santino_get_page_banner('swapno', 'shwapno_santino_retail.jpg') : santino_img('shwapno_santino_retail.jpg'); ?>'); background-position: center 35%; background-size: cover; min-height: 50vh; display: flex; align-items: center; justify-content: center; padding: 70px 20px;">
            <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0, 0, 0, 0.35) 0%, rgba(0, 38, 35, 0.72) 100%); z-index: 1;"></div>
            
            <div class="container position-relative" style="max-width: 780px; z-index: 2;">
              <div class="sec-pill-badge-wrap light mb-3">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge"><i class="bi bi-shield-check me-1 text-warning"></i> <?php echo esc_html( $settings['hero_badge'] ); ?></span>
                <span class="sec-pill-line"></span>
              </div>

              <h1 class="pro-banner-title mb-2" style="font-size: clamp(2.2rem, 4.2vw, 3.4rem); font-weight: 900; line-height: 1.18; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
                <?php echo esc_html( $settings['hero_title'] ); ?>
              </h1>

              <p class="pro-banner-desc mb-4" style="max-width: 580px; font-size: 1.02rem; line-height: 1.6; color: rgba(255, 255, 255, 0.92); margin: 0 auto;">
                <?php echo esc_html( $settings['hero_desc'] ); ?>
              </p>

              <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
                <a href="#store-locator" class="btn-hero-lifestyle">
                  <i class="bi bi-geo-alt-fill"></i>
                  <span>Find Nearest Shwapno</span>
                </a>
                <a href="#swapno-gallery" class="btn-hero-outline">
                  <i class="bi bi-images text-warning"></i>
                  <span>View Retail Gallery</span>
                </a>
              </div>
            </div>
          </section>

          <section class="py-3 border-bottom bg-white">
            <div class="container">
              <div class="row g-3 text-center justify-content-center">
                <div class="col-6 col-md-3">
                  <div class="fs-2 fw-black font-heading" style="color: var(--santino-teal, #00625d);">100+</div>
                  <div class="small text-muted fw-bold text-uppercase" style="font-size: 11px;">Superstore Shelves</div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="fs-2 fw-black text-dark font-heading">Weekly</div>
                  <div class="small text-muted fw-bold text-uppercase" style="font-size: 11px;">Fresh Batch Dispatch</div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="fs-2 fw-black font-heading" style="color: #8e683b;">100%</div>
                  <div class="small text-muted fw-bold text-uppercase" style="font-size: 11px;">Nitrogen Degassing Pack</div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="fs-2 fw-black font-heading" style="color: var(--santino-teal, #00625d);">On-Demand</div>
                  <div class="small text-muted fw-bold text-uppercase" style="font-size: 11px;">In-Store Grinding Booths</div>
                </div>
              </div>
            </div>
          </section>

          <section id="swapno-gallery" class="py-5" style="background-color: #08100f; color: #ffffff;">
            <div class="container py-lg-3">
              <div class="text-center max-w-700 mx-auto mb-4">
                <div class="sec-pill-badge-wrap light mb-2">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-camera-fill me-1"></i> RETAIL EXPERIENCE</span>
                  <span class="sec-pill-line"></span>
                </div>
                <h2 class="sec-title text-white mb-2">Inside Shwapno × <span class="sec-title-accent" style="color: #dfbe8d !important;">Santino Retail</span></h2>
                <p class="text-white-50 small mb-0" style="max-width: 580px; margin: 0 auto;">Fresh roasted bags, one-way degassing valves, and in-store grinding experience across 100+ supermarket aisles in Bangladesh.</p>
              </div>

              <div class="row g-3">
                <div class="col-lg-7">
                  <div class="editorial-gallery-item" style="min-height: 340px;">
                    <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="Shwapno Supermarket Coffee Shelf" class="editorial-gallery-img">
                    <div class="editorial-gallery-overlay">
                      <span class="editorial-gallery-badge"><i class="bi bi-cart3"></i> Supermarket Aisle</span>
                      <h3 class="editorial-gallery-title">Nationwide Superstore Presence</h3>
                      <p class="editorial-gallery-desc">Dedicated premium coffee displays in 100+ Shwapno branches bringing freshly roasted beans directly to home brewers.</p>
                    </div>
                  </div>
                </div>

                <div class="col-lg-5">
                  <div class="editorial-gallery-item" style="min-height: 340px;">
                    <img src="<?php echo santino_img('bangladesh_corporate_expansion.jpg'); ?>" alt="Artisan Batch Roastery" class="editorial-gallery-img">
                    <div class="editorial-gallery-overlay">
                      <span class="editorial-gallery-badge" style="color: #dfbe8d;"><i class="bi bi-fire"></i> Weekly Fresh Batches</span>
                      <h3 class="editorial-gallery-title">Direct Roastery Logistics</h3>
                      <p class="editorial-gallery-desc">Weekly dispatch directly from our roastery ensuring beans on retail shelves are always within their optimal aroma window.</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4">
                  <div class="editorial-gallery-item" style="min-height: 250px;">
                    <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Nitrogen Sealed Packaging" class="editorial-gallery-img">
                    <div class="editorial-gallery-overlay">
                      <span class="editorial-gallery-badge" style="color: #00a896;"><i class="bi bi-shield-check"></i> Nitrogen Degassing</span>
                      <h3 class="editorial-gallery-title">Aroma Lock Pouches</h3>
                      <p class="editorial-gallery-desc">Foil-lined pouches with Italian one-way degassing valves preserve complex volatile crema oils.</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4">
                  <div class="editorial-gallery-item" style="min-height: 250px;">
                    <img src="<?php echo santino_img('bd-office-coffee.jpg'); ?>" alt="In-Store Precision Grinding" class="editorial-gallery-img">
                    <div class="editorial-gallery-overlay">
                      <span class="editorial-gallery-badge" style="color: #dfbe8d;"><i class="bi bi-sliders"></i> Complimentary Service</span>
                      <h3 class="editorial-gallery-title">In-Store Precision Grinding</h3>
                      <p class="editorial-gallery-desc">Free calibrated grinding at flagship booths for French Press, Pour Over, Moka Pot, or Espresso.</p>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 col-lg-4">
                  <div class="editorial-gallery-item" style="min-height: 250px;">
                    <img src="<?php echo santino_img('bd-barista-training.jpg'); ?>" alt="Weekend Cupping & Tasting" class="editorial-gallery-img">
                    <div class="editorial-gallery-overlay">
                      <span class="editorial-gallery-badge" style="color: #dfbe8d;"><i class="bi bi-cup-hot-fill"></i> Tasting Experience</span>
                      <h3 class="editorial-gallery-title">Weekend In-Store Cupping</h3>
                      <p class="editorial-gallery-desc">Live barista brewing and free espresso tasting sessions for Shwapno Club members every weekend.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section id="retail-packs" class="py-5 bg-white">
            <div class="container py-lg-3">
              <div class="text-center max-w-700 mx-auto mb-4">
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-bag-check-fill me-1"></i> RETAIL PACK COLLECTION</span>
                  <span class="sec-pill-line"></span>
                </div>
                <h2 class="sec-title mb-2">Santino Coffee <span class="sec-title-accent">On Shwapno Shelves</span></h2>
                <p class="text-muted mb-0" style="font-size: 0.95rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">Available in Whole Bean & Fresh Pre-Ground Variants across 100+ superstore branches.</p>
              </div>

              <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                  <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-3 text-center" style="border: 1.5px solid #e1ebe7 !important;">
                    <div class="p-2 bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 160px;">
                      <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Signature Espresso Blend" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
                    </div>
                    <span class="badge-theme-teal mx-auto mb-2">Best Seller</span>
                    <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Signature Espresso Blend</h6>
                    <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.35;">Dark Chocolate & Roasted Almond Notes</p>
                    <div class="small text-secondary mb-2" style="font-size: 0.82rem;"><i class="bi bi-bag-check me-1 text-teal"></i> Available: 250g | 500g</div>
                    <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 650 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 250g</span></div>
                  </div>
                </div>

                <div class="col-md-6 col-lg-3">
                  <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-3 text-center" style="border: 1.5px solid #e1ebe7 !important;">
                    <div class="p-2 bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 160px;">
                      <img src="<?php echo santino_img('bangladesh_corporate_expansion.jpg'); ?>" alt="Colombia Supremo" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
                    </div>
                    <span class="badge-theme-gold mx-auto mb-2">100% Arabica Single Origin</span>
                    <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Colombia Supremo</h6>
                    <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.35;">Caramel, Brown Sugar & Citrus Acidity</p>
                    <div class="small text-secondary mb-2" style="font-size: 0.82rem;"><i class="bi bi-bag-check me-1 text-teal"></i> Available: 250g | 500g</div>
                    <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 850 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 250g</span></div>
                  </div>
                </div>

                <div class="col-md-6 col-lg-3">
                  <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-3 text-center" style="border: 1.5px solid #e1ebe7 !important;">
                    <div class="p-2 bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 160px;">
                      <img src="<?php echo santino_img('bd-office-coffee.jpg'); ?>" alt="Mocha Italia Roast" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
                    </div>
                    <span class="badge-theme-maroon mx-auto mb-2">Velvety & Full-Bodied</span>
                    <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Mocha Italia Roast</h6>
                    <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.35;">Hazelnut, Molasses & Cocoa Crema</p>
                    <div class="small text-secondary mb-2" style="font-size: 0.82rem;"><i class="bi bi-bag-check me-1 text-teal"></i> Available: 250g | 500g | 1kg</div>
                    <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 720 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 250g</span></div>
                  </div>
                </div>

                <div class="col-md-6 col-lg-3">
                  <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-3 text-center" style="border: 1.5px solid #e1ebe7 !important;">
                    <div class="p-2 bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 160px;">
                      <img src="<?php echo santino_img('traditional-coffee-9kg_1.jpg'); ?>" alt="Barista Gold Edition" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
                    </div>
                    <span class="badge-theme-gold mx-auto mb-2">Limited Batch</span>
                    <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Barista Gold Edition</h6>
                    <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.35;">Ethiopian Yirgacheffe & Java Floral Notes</p>
                    <div class="small text-secondary mb-2" style="font-size: 0.82rem;"><i class="bi bi-bag-check me-1 text-teal"></i> Available: 250g</div>
                    <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 950 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 250g</span></div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section id="store-locator" class="py-5" style="background-color: #f8faf9;">
            <div class="container py-lg-3">
              <div class="text-center max-w-700 mx-auto mb-3">
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill me-1"></i> SUPERSTORE LOCATOR</span>
                  <span class="sec-pill-line"></span>
                </div>
                <h2 class="sec-title mb-2">Find Santino Shelves At <span class="sec-title-accent">100+ Shwapno Outlets</span></h2>
                <p class="text-muted mb-0" style="font-size: 0.95rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">Search by area, road, or filter by division to find your nearest fresh coffee stock.</p>
              </div>

              <div class="row justify-content-center mb-3">
                <div class="col-lg-8">
                  <div class="portal-lookup-group" style="max-width: 600px; margin: 0 auto;">
                    <div class="portal-lookup-field">
                      <i class="bi bi-search text-teal"></i>
                      <input type="text" id="shwapnoSearchInput" placeholder="Search branch (e.g. Gulshan, Banani, Dhanmondi, Uttara)..." onkeyup="filterShwapnoOutlets()">
                    </div>
                    <button class="btn-lookup-action" type="button" onclick="filterShwapnoOutlets()">
                      <span>Search</span> <i class="bi bi-arrow-right"></i>
                    </button>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
                <button class="branch-filter-btn active" onclick="filterShwapnoZone('all', this)">All Superstores (12)</button>
                <button class="branch-filter-btn" onclick="filterShwapnoZone('dhaka-north', this)">Dhaka North (Gulshan, Banani, Uttara)</button>
                <button class="branch-filter-btn" onclick="filterShwapnoZone('dhaka-south', this)">Dhaka South (Dhanmondi, Mogbazar)</button>
                <button class="branch-filter-btn" onclick="filterShwapnoZone('chattogram', this)">Chattogram</button>
                <button class="branch-filter-btn" onclick="filterShwapnoZone('sylhet', this)">Sylhet &amp; Other</button>
              </div>

              <div class="row g-3" id="shwapnoOutletGrid">
                <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north gulshan">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Grinder</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Flagship Gulshan 1</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>South Avenue, Gulshan 1 Circle, Dhaka 1212</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000001</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Gulshan+1" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north banani">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Stocked</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Superstore Banani 11</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Road 11, Block E, Banani, Dhaka 1213</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000002</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Banani+11" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-south dhanmondi">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA SOUTH</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Grinder</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Dhanmondi 27</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Old 27 (New 16), Satmasjid Road, Dhanmondi, Dhaka</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000003</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Dhanmondi+27" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north uttara">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Stocked</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Uttara Sector 3</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Rabindra Sarani, Sector 3, Uttara, Dhaka 1230</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000004</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Uttara+Sector+3" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north mirpur">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Stocked</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Mirpur 1</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Sony Cinema Hall Circle, Mirpur 1, Dhaka 1216</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:00 AM – 10:30 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000005</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Mirpur+1" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-south mogbazar">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA SOUTH</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Stocked</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Mogbazar Wireless</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Wireless Gate, Outer Circular Road, Mogbazar, Dhaka</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000006</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Mogbazar" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-north bashundhara">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA NORTH</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Grinder</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Bashundhara Block C</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Block C, Main Avenue, Bashundhara R/A, Dhaka</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:00 AM – 11:00 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000007</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Bashundhara" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="dhaka-south shantinagar">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> DHAKA SOUTH</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Stocked</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Shantinagar Twin Towers</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Twin Towers Concord, Shantinagar, Dhaka</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:30 AM – 10:30 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000008</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Shantinagar" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="chattogram gec">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> CHATTOGRAM</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Grinder</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Chattogram GEC Circle</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>GEC Circle, CDA Avenue, Chattogram</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:30 AM – 11:00 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000009</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+GEC+Circle" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="chattogram nasirabad">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> CHATTOGRAM</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Stocked</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Chattogram Nasirabad</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Nasirabad Housing Society, Chattogram</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:30 AM – 11:00 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000010</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Nasirabad+Chattogram" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="sylhet subidbazar">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> SYLHET</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Grinder</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Sylhet Subidbazar</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Subidbazar Main Road, Sylhet 3100</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:30 AM – 10:30 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000011</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Subidbazar+Sylhet" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-4 outlet-item" data-zone="sylhet kumarpara">
                  <div class="branch-card-pro">
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                      <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> SYLHET</span>
                      <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Stocked</span>
                    </div>
                    <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;">Shwapno Sylhet Kumarpara</h4>
                    <div class="branch-info-list mb-2">
                      <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span>Kumarpara Point, Sylhet</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span>Open Daily: 8:30 AM – 10:30 PM</span></div>
                      <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: +880 1700-000012</span></div>
                    </div>
                    <a href="https://maps.google.com/?q=Shwapno+Kumarpara+Sylhet" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

        <script>
        window.filterShwapnoZone = function(zoneTag, btn) {
          if (btn) {
            document.querySelectorAll('#store-locator .branch-filter-btn').forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
          }
          var cards = document.querySelectorAll('#shwapnoOutletGrid [data-zone]');
          cards.forEach(function(card) {
            var zone = (card.getAttribute('data-zone') || '').toLowerCase();
            if (zoneTag === 'all' || zone.indexOf(zoneTag.toLowerCase()) !== -1) {
              card.style.display = '';
            } else {
              card.style.display = 'none';
            }
          });
        };

        window.filterShwapnoOutlets = function() {
          var input = document.getElementById('shwapnoSearchInput');
          var q = (input ? input.value : '').toLowerCase().trim();
          var cards = document.querySelectorAll('#shwapnoOutletGrid [data-zone]');
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
    }
}
