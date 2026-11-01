<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Machines_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_machines_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino Commercial Machines Solution', 'santino' );
    }

    public function get_icon() {
        return 'eicon-cog';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_hero',
            array(
                'label' => esc_html__( 'Hero Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'hero_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'AUTHORIZED ITALIAN DISTRIBUTOR',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Commercial Espresso Machinery',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Official Italian espresso machines, automated coffee stations, and 4-hour on-site tech SLA.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
        .machines-page-wrap, body, p, .text-muted, label, input, select, textarea {
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
        .branch-filter-btn {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif);
          font-weight: 600;
          font-size: 13px;
          padding: 8px 20px;
          border-radius: 50px;
          border: 1.5px solid #d5e5e0;
          background: #fff;
          color: #334441;
          cursor: pointer;
        }
        .branch-filter-btn.active, .branch-filter-btn:hover {
          background: var(--santino-teal, #00625d);
          color: #fff;
          border-color: var(--santino-teal, #00625d);
        }
        .btn-prod-quote {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          border: none;
          padding: 8px 16px;
          border-radius: 50px;
          font-weight: 700;
          font-size: 12px;
          cursor: pointer;
        }
        .btn-prod-outline {
          background: transparent;
          color: #334441;
          border: 1px solid #d5e5e0;
          padding: 8px 16px;
          border-radius: 50px;
          font-weight: 700;
          font-size: 12px;
          cursor: pointer;
        }
        </style>

        <div class="machines-page-wrap">
          <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo function_exists('santino_get_page_banner') ? santino_get_page_banner('machines', 'imgi_218_blackeagle2.jpg') : santino_img('imgi_218_blackeagle2.jpg'); ?>'); background-position: center; background-size: cover; min-height: 52vh; display: flex; align-items: center; justify-content: center; padding: 75px 20px;">
            <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.55) 100%);"></div>
            
            <div class="container position-relative" style="max-width: 720px; z-index: 2;">
              <div class="sec-pill-badge-wrap light mb-3">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3);"><i class="bi bi-shield-check me-1"></i> <?php echo esc_html( $settings['hero_badge'] ); ?></span>
                <span class="sec-pill-line"></span>
              </div>

              <h1 class="pro-banner-title mb-2" style="font-size: clamp(2.2rem, 4.2vw, 3.4rem); font-weight: 900; color: #ffffff;">
                <?php echo esc_html( $settings['hero_title'] ); ?>
              </h1>

              <p class="pro-banner-desc mb-4" style="max-width: 540px; font-size: 1.05rem; color: rgba(255,255,255,0.92); margin: 0 auto;">
                <?php echo esc_html( $settings['hero_desc'] ); ?>
              </p>

              <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
                <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#demoModal">
                  <span>Book Live Demo</span>
                  <i class="bi bi-play-circle-fill"></i>
                </button>
                <a href="#machineGrid" class="btn-hero-outline">
                  <i class="bi bi-arrow-down-short text-warning"></i>
                  <span>Explore Catalog</span>
                </a>
              </div>
            </div>
          </section>

          <div class="story-metrics-floating-wrap">
            <div class="container">
              <div class="row g-3 g-md-4 text-center justify-content-center">
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-gear-wide-connected"></i></div>
                    <div class="metric-num">500+</div>
                    <div class="metric-label">Machines Installed</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-clock-history"></i></div>
                    <div class="metric-num">4 Hours</div>
                    <div class="metric-label">Rapid Tech SLA</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-cpu-fill"></i></div>
                    <div class="metric-num">100%</div>
                    <div class="metric-label">OEM Italian Parts</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-shield-check"></i></div>
                    <div class="metric-num">Zero</div>
                    <div class="metric-label">Downtime Warranty</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="py-4 border-top border-bottom bg-white">
            <div class="container">
              <div class="d-flex justify-content-center align-items-center flex-wrap gap-2 gap-md-3">
                <span class="sec-pill-badge"><i class="bi bi-shield-check me-1"></i> AUTHORIZED PARTNERS</span>
                <span class="badge bg-white text-dark border px-3 py-2 fs-7 fw-bold shadow-sm">VICTORIA ARDUINO</span>
                <span class="badge bg-white text-dark border px-3 py-2 fs-7 fw-bold shadow-sm">NUOVA SIMONELLI</span>
                <span class="badge bg-white text-dark border px-3 py-2 fs-7 fw-bold shadow-sm">KALERM AUTOMATION</span>
                <span class="badge bg-white text-dark border px-3 py-2 fs-7 fw-bold shadow-sm">CAYE BIONIC ROBOTICS</span>
                <span class="badge bg-white text-dark border px-3 py-2 fs-7 fw-bold shadow-sm">3TEMP BREWERS</span>
                <span class="badge bg-white text-dark border px-3 py-2 fs-7 fw-bold shadow-sm">CAFEVA CARE</span>
              </div>
            </div>
          </div>

          <section class="py-5" id="machineGrid">
            <div class="container">
              <div class="sec-heading-center text-center mb-5">
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-gear-wide-connected me-1"></i> EQUIPMENT PORTFOLIO</span>
                  <span class="sec-pill-line"></span>
                </div>
                <h2 class="sec-title">Engineered for Flawless Extraction</h2>
                <div class="sec-subtitle text-muted">Discover our comprehensive collection of traditional, superautomatic, and bionic coffee machinery</div>
              </div>

              <div class="row g-4" id="machinesContainer">
                <div class="col-lg-4 col-md-6">
                  <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4">
                    <div>
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-dark">ITALIAN TRADITIONAL</span>
                        <span class="text-muted small fw-bold">Victoria Arduino</span>
                      </div>
                      <div class="machine-img-box text-center my-3">
                        <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="Black Eagle Maverick" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                      </div>
                      <h4 class="font-heading fw-bold mb-1">Black Eagle Maverick</h4>
                      <p class="text-muted small mb-3">T3 Genius multiboiler with PureBrew filter extraction and gravimetric auto-tare scales.</p>
                      <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-light text-dark border">2/3 Group Heads</span>
                        <span class="badge bg-light text-dark border">7100W Power</span>
                        <span class="badge bg-light text-dark border">Gravitech Scale</span>
                      </div>
                    </div>
                    <div class="border-top pt-3 d-flex gap-2">
                      <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                        Book Demo
                      </button>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-6">
                  <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4">
                    <div>
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge text-white" style="background-color: var(--santino-teal, #00625d);">ENERGY EFFICIENT</span>
                        <span class="text-muted small fw-bold">Victoria Arduino</span>
                      </div>
                      <div class="machine-img-box text-center my-3">
                        <img src="<?php echo santino_img('imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg'); ?>" alt="Eagle One" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                      </div>
                      <h4 class="font-heading fw-bold mb-1">Eagle One Commercial</h4>
                      <p class="text-muted small mb-3">NEO engine technology that uses instant heating to reduce carbon emissions by up to 35%.</p>
                      <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-light text-dark border">NEO Instant Boiler</span>
                        <span class="badge bg-light text-dark border">TERS Heat Recovery</span>
                        <span class="badge bg-light text-dark border">Mobile App Control</span>
                      </div>
                    </div>
                    <div class="border-top pt-3 d-flex gap-2">
                      <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                        Book Demo
                      </button>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-6">
                  <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4">
                    <div>
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-danger">BIONIC ROBOTICS</span>
                        <span class="text-muted small fw-bold">CAYE Robotics</span>
                      </div>
                      <div class="machine-img-box text-center my-3">
                        <img src="<?php echo santino_img('imgi_218_blackeagle2.jpg'); ?>" alt="CAYE Barista Bot" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                      </div>
                      <h4 class="font-heading fw-bold mb-1">CAYE Bionic Barista Robot</h4>
                      <p class="text-muted small mb-3">Automated 6-axis dual robotic arm kiosk serving latte art and specialty brews in 45 seconds.</p>
                      <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                        <span class="badge bg-light text-dark border">6-Axis Dual Arm</span>
                        <span class="badge bg-light text-dark border">Flawless Latte Art</span>
                        <span class="badge bg-light text-dark border">Cloud POS Sync</span>
                      </div>
                    </div>
                    <div class="border-top pt-3 d-flex gap-2">
                      <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                        Book Demo
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <div class="modal fade" id="demoModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content rounded-4 border-0 p-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                  <h4 class="modal-title font-heading fw-bold">Schedule Machinery Demo</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <p class="text-muted small mb-3">Experience extraction calibration and steam power live at our Tejgaon showroom.</p>
                  <form class="santino-inquiry-form">
                    <input type="hidden" name="inquiry_type" value="machinery_demo">
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Full Name *</label>
                      <input type="text" name="name" class="form-control rounded-pill px-3 py-2" placeholder="Rahim Chowdhury" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Phone Number *</label>
                      <input type="tel" name="phone" class="form-control rounded-pill px-3 py-2" placeholder="+880 1711-000000" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" required>
                    </div>
                    <div class="mb-4">
                      <label class="form-label small fw-bold">Select Machine</label>
                      <select name="machine" class="form-select rounded-pill px-3 py-2">
                        <option value="Victoria Arduino Black Eagle Maverick">Victoria Arduino Black Eagle Maverick</option>
                        <option value="Victoria Arduino Eagle One">Victoria Arduino Eagle One</option>
                        <option value="Nuova Simonelli Appia Life">Nuova Simonelli Appia Life</option>
                        <option value="CAYE Bionic Robotic Barista">CAYE Bionic Robotic Barista</option>
                        <option value="Kalerm Bean-to-Cup Automatics">Kalerm Bean-to-Cup Automatics</option>
                      </select>
                    </div>
                    <button type="submit" class="btn-hero-lifestyle w-100 py-3">Book Demonstration</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
}
