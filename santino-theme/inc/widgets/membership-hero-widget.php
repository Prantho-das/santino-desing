<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Membership_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_membership_hero';
    }

    public function get_title() {
        return esc_html__( 'Santino: 1. Member Hero Banner & Metrics', 'santino' );
    }

    public function get_icon() {
        return 'eicon-banner';
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
            'badge_text',
            array(
                'label'       => esc_html__( 'Pill Badge Text', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'SANTINO COFFEE CLUB',
                'description' => esc_html__( 'Leave blank to completely hide the badge.', 'santino' ),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Hero Title', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Buy 5 Cups, <span style="color: #dfbe8d;">Get 1 Free!</span>',
                'description' => esc_html__( 'Leave blank to hide. HTML allowed.', 'santino' ),
            )
        );

        $this->add_control(
            'desc',
            array(
                'label'       => esc_html__( 'Hero Description', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Our exclusive digital stamp rewards club for true coffee connoisseurs across Bangladesh.',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->add_control(
            'bg_image',
            array(
                'label'   => esc_html__( 'Background Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => '',
                ),
            )
        );

        $this->add_control(
            'btn1_text',
            array(
                'label'       => esc_html__( 'Primary Button Text', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Claim Stamp Card',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->add_control(
            'btn1_url',
            array(
                'label'   => esc_html__( 'Primary Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '#clubPortal',
                ),
            )
        );

        $this->add_control(
            'btn2_text',
            array(
                'label'       => esc_html__( 'Secondary Button Text', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Explore Cafe Menu',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->add_control(
            'btn2_url',
            array(
                'label'   => esc_html__( 'Secondary Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '/menu/',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_metrics',
            array(
                'label' => esc_html__( 'Floating Metrics Bar', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_metrics',
            array(
                'label'        => esc_html__( 'Show Floating Metrics', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__( 'Icon Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-stars',
            )
        );

        $repeater->add_control(
            'num',
            array(
                'label'   => esc_html__( 'Metric Number/Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '100% Free',
            )
        );

        $repeater->add_control(
            'label',
            array(
                'label'   => esc_html__( 'Metric Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Club Enrollment',
            )
        );

        $this->add_control(
            'metrics_list',
            array(
                'label'       => esc_html__( 'Metrics Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'icon'  => 'bi bi-stars',
                        'num'   => '100% Free',
                        'label' => 'Club Enrollment',
                    ),
                    array(
                        'icon'  => 'bi bi-percent',
                        'num'   => '15% Off',
                        'label' => 'Retail Bean Privilege',
                    ),
                    array(
                        'icon'  => 'bi bi-cup-hot-fill',
                        'num'   => 'Priority',
                        'label' => 'Private Cupping Access',
                    ),
                    array(
                        'icon'  => 'bi bi-calendar-heart-fill',
                        'num'   => 'Monthly',
                        'label' => 'Exclusive Micro-Lots',
                    ),
                ),
                'title_field' => '{{{ num }}} - {{{ label }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge_text = isset( $settings['badge_text'] ) ? trim( (string) $settings['badge_text'] ) : '';
        $title      = isset( $settings['title'] ) ? trim( (string) $settings['title'] ) : '';
        $desc       = isset( $settings['desc'] ) ? trim( (string) $settings['desc'] ) : '';
        $btn1_text  = isset( $settings['btn1_text'] ) ? trim( (string) $settings['btn1_text'] ) : '';
        $btn1_url   = ! empty( $settings['btn1_url']['url'] ) ? $settings['btn1_url']['url'] : '#clubPortal';
        $btn2_text  = isset( $settings['btn2_text'] ) ? trim( (string) $settings['btn2_text'] ) : '';
        $btn2_url   = ! empty( $settings['btn2_url']['url'] ) ? $settings['btn2_url']['url'] : '/menu/';

        $hero_bg_url = '';
        if ( ! empty( $settings['bg_image']['url'] ) ) {
            $hero_bg_url = $settings['bg_image']['url'];
        } elseif ( function_exists( 'santino_get_page_banner' ) ) {
            $hero_bg_url = santino_get_page_banner( 'membership', 'imgi_20_santino_-_250522-07574.jpg' );
        } elseif ( function_exists( 'santino_img' ) ) {
            $hero_bg_url = santino_img( 'imgi_20_santino_-_250522-07574.jpg' );
        }

        $show_metrics = ( ( $settings['show_metrics'] ?? 'yes' ) === 'yes' );
        $metrics_list = ! empty( $settings['metrics_list'] ) && is_array( $settings['metrics_list'] ) ? $settings['metrics_list'] : array();
        $has_hero = ( $badge_text !== '' || $title !== '' || $desc !== '' || $btn1_text !== '' || $btn2_text !== '' || $hero_bg_url !== '' );
        ?>
        <style>
        .santino-mb-hero-wrap, .santino-mb-hero-wrap * {
          box-sizing: border-box;
        }
        .pro-banner-hero {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
        }
        .pro-banner-title {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          letter-spacing: -0.5px;
        }
        .sec-pill-badge-wrap {
          display: inline-flex;
          align-items: center;
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
        </style>

        <div class="santino-mb-hero-wrap">
          <?php if ( $has_hero ) : ?>
          <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>'); background-position: center; background-size: cover; min-height: 56vh; display: flex; align-items: center; justify-content: center; padding: 80px 20px;">
            <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0, 38, 35, 0.7) 100%); z-index: 1;"></div>
            
            <div class="container position-relative" style="max-width: 820px; z-index: 2;">
              
              <?php if ( $badge_text !== '' ) : ?>
              <div class="sec-pill-badge-wrap light mb-3">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge"><i class="bi bi-gem me-1 text-warning"></i> <?php echo esc_html( $badge_text ); ?></span>
                <span class="sec-pill-line"></span>
              </div>
              <?php endif; ?>

              <?php if ( $title !== '' ) : ?>
              <h1 class="pro-banner-title mb-3" style="font-size: clamp(2.3rem, 4.5vw, 3.6rem); font-weight: 900; line-height: 1.18; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
                <?php echo wp_kses_post( $title ); ?>
              </h1>
              <?php endif; ?>

              <?php if ( $desc !== '' ) : ?>
              <p class="pro-banner-desc mb-4" style="max-width: 640px; font-size: 1.08rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.4);">
                <?php echo esc_html( $desc ); ?>
              </p>
              <?php endif; ?>

              <?php if ( $btn1_text !== '' || $btn2_text !== '' ) : ?>
              <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
                <?php if ( $btn1_text !== '' ) : ?>
                <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-hero-lifestyle">
                  <span><?php echo esc_html( $btn1_text ); ?></span>
                  <i class="bi bi-arrow-right"></i>
                </a>
                <?php endif; ?>
                <?php if ( $btn2_text !== '' ) : ?>
                <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-hero-outline">
                  <i class="bi bi-arrow-down-short text-warning"></i>
                  <span><?php echo esc_html( $btn2_text ); ?></span>
                </a>
                <?php endif; ?>
              </div>
              <?php endif; ?>

            </div>
          </section>
          <?php endif; ?>

          <?php if ( $show_metrics && ! empty( $metrics_list ) ) : ?>
          <div class="story-metrics-floating-wrap">
            <div class="container">
              <div class="row g-3 g-md-4 text-center justify-content-center">
                <?php foreach ( $metrics_list as $item ) : 
                  $m_num   = isset( $item['num'] ) ? trim( (string) $item['num'] ) : '';
                  $m_label = isset( $item['label'] ) ? trim( (string) $item['label'] ) : '';
                  $m_icon  = isset( $item['icon'] ) ? trim( (string) $item['icon'] ) : 'bi bi-stars';
                  if ( $m_num === '' && $m_label === '' ) continue;
                ?>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <?php if ( $m_icon !== '' ) : ?>
                    <div class="metric-card-icon"><i class="<?php echo esc_attr( $m_icon ); ?>"></i></div>
                    <?php endif; ?>
                    <?php if ( $m_num !== '' ) : ?>
                    <div class="metric-num"><?php echo esc_html( $m_num ); ?></div>
                    <?php endif; ?>
                    <?php if ( $m_label !== '' ) : ?>
                    <div class="metric-label"><?php echo esc_html( $m_label ); ?></div>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <?php
    }
}
