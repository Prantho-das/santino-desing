<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Beans_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_beans_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino: /beans/ All Sections & Products', 'santino' );
    }

    public function get_icon() {
        return 'eicon-archive';
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
                'default' => 'SPECIALTY ROASTERY',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Artisan Coffee Beans',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Fresh micro-batch roasts sourced directly from premier origins worldwide.',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_catalog',
            array(
                'label' => esc_html__( 'Roastery Beans Catalog', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_catalog',
            array(
                'label'        => esc_html__( 'Show Catalog Section', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'catalog_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SPECIALTY ROAST COLLECTION',
            )
        );

        $this->add_control(
            'catalog_title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Roasted to Peak Flavor Expression',
            )
        );

        $this->add_control(
            'catalog_desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Explore our Single Origin Espressos (SOE), heritage espresso blends, and OEM private label options',
            )
        );

        $this->add_control(
            'bean_btn_text',
            array(
                'label'       => esc_html__( 'Card Button Text (Blank to Hide)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'description' => esc_html__( 'Leave blank if you want to hide the button completely.', 'santino' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
        .beans-page-wrap, body, p, .text-muted, label, input, select, textarea {
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
        </style>

        <div class="beans-page-wrap">
          <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo function_exists('santino_get_page_banner') ? santino_get_page_banner('beans', 'traditional-coffee-9kg_1.jpg') : santino_img('traditional-coffee-9kg_1.jpg'); ?>'); background-position: center; background-size: cover; min-height: 52vh; display: flex; align-items: center; justify-content: center; padding: 75px 20px;">
            <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.52) 100%);"></div>
            
            <div class="container position-relative" style="max-width: 720px; z-index: 2;">
              <div class="sec-pill-badge-wrap light mb-3">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3);"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $settings['hero_badge'] ); ?></span>
                <span class="sec-pill-line"></span>
              </div>

              <h1 class="pro-banner-title mb-2" style="font-size: clamp(2.2rem, 4.2vw, 3.4rem); font-weight: 900; color: #ffffff;">
                <?php echo esc_html( $settings['hero_title'] ); ?>
              </h1>

              <p class="pro-banner-desc mb-4" style="max-width: 520px; font-size: 1.05rem; color: rgba(255,255,255,0.92); margin: 0 auto;">
                <?php echo esc_html( $settings['hero_desc'] ); ?>
              </p>

              <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
                <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#sampleModal">
                  <span>Request Samples</span>
                  <i class="bi bi-cup-hot-fill"></i>
                </button>
                <a href="#roastCatalog" class="btn-hero-outline">
                  <i class="bi bi-arrow-down-short text-warning"></i>
                  <span>Explore Roasts</span>
                </a>
              </div>
            </div>
          </section>

          <div class="story-metrics-floating-wrap">
            <div class="container">
              <div class="row g-3 g-md-4 text-center justify-content-center">
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-award-fill"></i></div>
                    <div class="metric-num">90+ SCA</div>
                    <div class="metric-label">Certified Cupping Score</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="metric-num">100%</div>
                    <div class="metric-label">Micro-Lot Single Origin</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                    <div class="metric-num">24 Hours</div>
                    <div class="metric-label">Fresh Batch Dispatch</div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-shield-check"></i></div>
                    <div class="metric-num">FSSC 22000</div>
                    <div class="metric-label">Global Safety Certified</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php
          $show_catalog  = ( $settings['show_catalog'] ?? 'yes' ) === 'yes';
          $catalog_badge = ! empty( $settings['catalog_badge'] ) ? $settings['catalog_badge'] : '';
          $catalog_title = ! empty( $settings['catalog_title'] ) ? $settings['catalog_title'] : 'Roasted to Peak Flavor Expression';
          $catalog_desc  = ! empty( $settings['catalog_desc'] ) ? $settings['catalog_desc'] : '';
          $bean_btn_text = isset( $settings['bean_btn_text'] ) ? trim( (string) $settings['bean_btn_text'] ) : '';

          if ( $show_catalog ) :
          ?>
          <section class="py-5" id="roastCatalog">
            <div class="container">
              <div class="sec-heading-center text-center mb-5">
                <?php if ( ! empty( $catalog_badge ) ) : ?>
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-award-fill me-1"></i> <?php echo esc_html( $catalog_badge ); ?></span>
                  <span class="sec-pill-line"></span>
                </div>
                <?php endif; ?>
                <h2 class="sec-title"><?php echo esc_html( $catalog_title ); ?></h2>
                <?php if ( ! empty( $catalog_desc ) ) : ?>
                <div class="sec-subtitle text-muted"><?php echo esc_html( $catalog_desc ); ?></div>
                <?php endif; ?>
              </div>

              <div class="row g-4" id="beansContainer">
                <?php
                $bean_posts = get_posts( array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'post_status'    => 'publish',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => array( 'specialty-roastery-beans', 'beans', 'coffee-beans' ),
                        ),
                    ),
                ) );

                if ( ! empty( $bean_posts ) ) :
                    foreach ( $bean_posts as $bp ) :
                        $b_title = $bp->post_title;
                        $b_desc  = wp_trim_words( $bp->post_excerpt ?: $bp->post_content, 16 );
                        $b_img   = get_the_post_thumbnail_url( $bp->ID, 'medium' ) ?: santino_img( 'beans-ethiopia-yirgacheffe.jpg' );
                        $raw_price = get_post_meta( $bp->ID, '_price', true );
                        $b_price = $raw_price ? '৳ ' . number_format( (float) $raw_price ) : '';
                        $cats    = wp_get_post_terms( $bp->ID, 'product_cat', array( 'fields' => 'names' ) );
                        $b_badge = ! empty( $cats[0] ) ? $cats[0] : 'SPECIALTY ROAST';
                ?>
                <div class="col-lg-4 col-md-6">
                  <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between">
                    <div>
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge text-dark fw-bold" style="background-color: var(--santino-gold, #dfbe8d);"><?php echo esc_html( $b_badge ); ?></span>
                        <span class="text-muted small fw-bold">Fresh Roast</span>
                      </div>
                      <div class="text-center my-3">
                        <img src="<?php echo esc_url( $b_img ); ?>" alt="<?php echo esc_attr( $b_title ); ?>" class="img-fluid" style="max-height: 190px; object-fit: cover; border-radius: 12px;">
                      </div>
                      <h4 class="font-heading fw-bold mb-1"><?php echo esc_html( $b_title ); ?></h4>
                      <p class="text-muted small mb-3"><?php echo esc_html( $b_desc ); ?></p>
                    </div>
                    <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                      <div>
                        <?php if ( $b_price ) : ?>
                        <span class="fw-bold fs-5 text-dark"><?php echo esc_html( $b_price ); ?></span>
                        <span class="text-muted small"> / pack</span>
                        <?php endif; ?>
                      </div>
                      <?php if ( ! empty( $bean_btn_text ) ) : ?>
                      <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal, #00625d); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal">
                        <?php echo esc_html( $bean_btn_text ); ?>
                      </button>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php
                    endforeach;
                else :
                ?>
                <div class="col-lg-4 col-md-6">
                  <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between">
                    <div>
                      <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge text-dark fw-bold" style="background-color: var(--santino-gold, #dfbe8d);">90+ CUPPING SCORE</span>
                        <span class="text-muted small fw-bold">Ethiopia</span>
                      </div>
                      <div class="text-center my-3">
                        <img src="<?php echo santino_img('beans-ethiopia-yirgacheffe.jpg'); ?>" alt="Ethiopia Yirgacheffe" class="img-fluid" style="max-height: 190px; object-fit: cover; border-radius: 12px;">
                      </div>
                      <h4 class="font-heading fw-bold mb-1">Ethiopia Yirgacheffe G1</h4>
                      <p class="text-muted small mb-3">Washed process from 1,900m altitude. Bursting with jasmine florals, bergamot citrus, and sweet honey.</p>
                    </div>
                    <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                      <div><span class="fw-bold fs-5 text-dark">৳ 1,450</span><span class="text-muted small"> / 250g</span></div>
                      <?php if ( ! empty( $bean_btn_text ) ) : ?>
                      <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal, #00625d); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal"><?php echo esc_html( $bean_btn_text ); ?></button>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </section>
          <?php endif; ?>

          <div class="modal fade" id="sampleModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content rounded-4 border-0 p-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                  <h4 class="modal-title font-heading fw-bold">Request Bean Tasting Box</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <p class="text-muted small mb-3">Receive 3 complimentary roast samples roasted freshly for your cafe or office cupping.</p>
                  <form class="santino-inquiry-form">
                    <input type="hidden" name="inquiry_type" value="beans_sample">
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Full Name *</label>
                      <input type="text" name="name" class="form-control rounded-pill px-3 py-2" placeholder="Tanvir Ahmed" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Phone Number *</label>
                      <input type="tel" name="phone" class="form-control rounded-pill px-3 py-2" placeholder="+880 1711-000000" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" required>
                    </div>
                    <div class="mb-4">
                      <label class="form-label small fw-bold">Preferred Roasts</label>
                      <select name="roast" class="form-select rounded-pill px-3 py-2">
                        <option value="Single Origin Filter Set">Single Origin Filter Set</option>
                        <option value="Commercial Espresso Blends">Commercial Espresso Blends</option>
                        <option value="Custom OEM Roast Development">Custom OEM Roast Development</option>
                      </select>
                    </div>
                    <button type="submit" class="btn-hero-lifestyle w-100 py-3">Send Sample Request</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
}
