<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Brands_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_brands_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino Global Brands & Clients Solution', 'santino' );
    }

    public function get_icon() {
        return 'eicon-star-o';
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
                'default' => 'NATIONWIDE COFFEE ECOSYSTEM',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our Brand & Client Partners',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Powering retail superstore aisles, quick-service restaurant chains, and corporate offices.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
        .brands-page-wrap, body, p, .text-muted, label, input, select, textarea {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
        }
        .pro-banner-title,
        .sec-title,
        .font-heading,
        h1, h2, h3, h4, h5, h6,
        .sec-pill-badge,
        .btn-hero-lifestyle,
        .btn-hero-outline {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          letter-spacing: -0.3px;
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
          font-size: 2.55rem;
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
        </style>

        <div class="brands-page-wrap">
          <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo function_exists('santino_get_page_banner') ? santino_get_page_banner('brands', 'imgi_218_blackeagle2.jpg') : santino_img('imgi_218_blackeagle2.jpg'); ?>'); background-position: center; background-size: cover; min-height: 52vh; display: flex; align-items: center; justify-content: center; padding: 75px 20px;">
            <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.65) 100%);"></div>
            
            <div class="container position-relative" style="max-width: 720px; z-index: 2;">
              <div class="sec-pill-badge-wrap light mb-3">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3);"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $settings['hero_badge'] ); ?></span>
                <span class="sec-pill-line"></span>
              </div>

              <h1 class="pro-banner-title mb-2" style="font-size: clamp(2.2rem, 4.2vw, 3.4rem); font-weight: 900; color: #ffffff;">
                <?php echo esc_html( $settings['hero_title'] ); ?>
              </h1>

              <p class="pro-banner-desc mb-4" style="max-width: 580px; font-size: 1.05rem; color: rgba(255,255,255,0.9); margin: 0 auto;">
                <?php echo esc_html( $settings['hero_desc'] ); ?>
              </p>

              <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
                <a href="#featured-partners" class="btn-hero-lifestyle">
                  <span>Explore Partners</span>
                  <i class="bi bi-arrow-down-short"></i>
                </a>
              </div>
            </div>
          </section>

          <div class="story-metrics-floating-wrap">
            <div class="container">
              <div class="row g-3 g-md-4 text-center justify-content-center">
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-shop-window"></i></div>
                    <div class="metric-num">50+</div>
                    <div class="metric-label">BFC Restaurant Outlets</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-cart4"></i></div>
                    <div class="metric-num">100+</div>
                    <div class="metric-label">Shwapno Superstores</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-building"></i></div>
                    <div class="metric-num">150+</div>
                    <div class="metric-label">Corporate Office Cafes</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-cup-hot-fill"></i></div>
                    <div class="metric-num">1.5M+</div>
                    <div class="metric-label">Annual Cups Served</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <section id="featured-partners" class="py-5" style="background-color: #f8faf9;">
            <div class="container py-lg-4">
              <div class="text-center max-w-700 mx-auto mb-5">
                <span class="text-uppercase fw-bold small" style="color: var(--santino-teal, #00625d); letter-spacing: 2px;">Core Alliances</span>
                <h2 class="sec-title mb-2" style="color: #1a2b29;">Flagship Brand Pages</h2>
                <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">Dedicated operational integration powering retail and foodservice giants.</p>
              </div>

              <div class="row g-4">
                <div class="col-lg-6">
                  <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden p-4 p-md-5 text-white position-relative" style="background: linear-gradient(135deg, #003633 0%, #002220 100%);">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                      <span class="badge bg-warning text-dark px-3 py-2 fw-bold rounded-pill">Foodservice Chain Partner</span>
                      <i class="bi bi-shop fs-1 text-warning"></i>
                    </div>
                    <h3 class="fw-bold mb-2 text-white">BFC (Best Fried Chicken)</h3>
                    <p class="text-light opacity-80 mb-4" style="font-size: 0.95rem;">
                      Freshly brewed Italian espresso beverages, cold frappes and cappuccinos across 50+ quick service restaurants throughout Bangladesh.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                      <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-geo-alt me-1"></i> 50+ Outlets</span>
                      <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-cup-hot me-1"></i> 1.5M+ Cups/Yr</span>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/bfc/' ) ); ?>" class="btn-hero-lifestyle align-self-start mt-auto">
                      Visit BFC Brand Page <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden p-4 p-md-5 text-white position-relative" style="background: linear-gradient(135deg, #002d2a 0%, #004d49 100%);">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                      <span class="badge bg-light text-success px-3 py-2 fw-bold rounded-pill">Retail Superstore Partner</span>
                      <i class="bi bi-cart3 fs-1 text-warning"></i>
                    </div>
                    <h3 class="fw-bold mb-2 text-white">Shwapno Superstores</h3>
                    <p class="text-light opacity-80 mb-4" style="font-size: 0.95rem;">
                      Specialty roasted whole bean & fine grind packs with aroma valves available on retail aisles across 100+ Shwapno superstores nationwide.
                    </p>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                      <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-geo-alt me-1"></i> 100+ Superstores</span>
                      <span class="badge bg-white bg-opacity-10 text-light px-3 py-2 rounded-pill"><i class="bi bi-box-seam me-1"></i> 4 Roasted Blends</span>
                    </div>
                    <a href="<?php echo esc_url( home_url( '/swapno/' ) ); ?>" class="btn-hero-lifestyle align-self-start mt-auto">
                      Visit Shwapno Brand Page <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="py-5 bg-white">
            <div class="container py-lg-4">
              <div class="text-center max-w-700 mx-auto mb-5">
                <span class="text-uppercase fw-bold small" style="color: var(--santino-teal, #00625d); letter-spacing: 2px;">Comprehensive Client Reach</span>
                <h2 class="sec-title mb-2" style="color: #1a2b29;">Retailers, HORECA &amp; Corporate Network</h2>
                <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">Proudly powering coffee programs across leading organizations.</p>
              </div>

              <div class="row g-4 text-center">
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="fw-bold fs-5 text-dark mb-1">UNIMART</div>
                    <div class="small text-muted">Premium Retail Aisles</div>
                  </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="fw-bold fs-5 text-dark mb-1">AGORA</div>
                    <div class="small text-muted">Retail Superstore Chain</div>
                  </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="fw-bold fs-5 text-dark mb-1">MEENA BAZAR</div>
                    <div class="small text-muted">Gourmet Grocery Outlets</div>
                  </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="fw-bold fs-5 text-dark mb-1">RADISSON BLU</div>
                    <div class="small text-muted">5-Star Hospitality Coffee</div>
                  </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="fw-bold fs-5 text-dark mb-1">INTERCONTINENTAL</div>
                    <div class="small text-muted">Banquet &amp; Suite Espresso</div>
                  </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="fw-bold fs-5 text-dark mb-1">THE WESTIN DHAKA</div>
                    <div class="small text-muted">Executive Lounge Bars</div>
                  </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="fw-bold fs-5 text-dark mb-1">SUBWAY BANGLADESH</div>
                    <div class="small text-muted">Quick Service Bean-to-Cup</div>
                  </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                  <div class="p-4 rounded-4 border bg-light h-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="fw-bold fs-5 text-dark mb-1">BRAC ENTERPRISES</div>
                    <div class="small text-muted">Corporate Headquarters</div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <?php
    }
}
