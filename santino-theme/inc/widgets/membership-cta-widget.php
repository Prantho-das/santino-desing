<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Membership_CTA_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_membership_cta';
    }

    public function get_title() {
        return esc_html__( 'Santino: 4. Member Cafe CTA', 'santino' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_cta',
            array(
                'label' => esc_html__( 'Call To Action', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'       => esc_html__( 'Pill Badge Text', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'VISIT OUR CAFES',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Title', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Ready For Your Next Handcrafted Brew?',
                'description' => esc_html__( 'Leave blank to hide. HTML allowed.', 'santino' ),
            )
        );

        $this->add_control(
            'desc',
            array(
                'label'       => esc_html__( 'Description', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Visit our barista bars across Gulshan, Banani, Dhanmondi & Uttara.',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'       => esc_html__( 'Button Text', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Explore Full Menu →',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '/menu/',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge_text = isset( $settings['badge_text'] ) ? trim( (string) $settings['badge_text'] ) : '';
        $title      = isset( $settings['title'] ) ? trim( (string) $settings['title'] ) : '';
        $desc       = isset( $settings['desc'] ) ? trim( (string) $settings['desc'] ) : '';
        $btn_text   = isset( $settings['btn_text'] ) ? trim( (string) $settings['btn_text'] ) : '';
        $btn_url    = ! empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '/menu/';

        if ( $badge_text === '' && $title === '' && $desc === '' && $btn_text === '' ) {
            return;
        }
        ?>
        <style>
        .btn-hero-lifestyle {
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
          background: var(--santino-teal, #00625d) !important;
          border: 2px solid var(--santino-teal, #00625d) !important;
          color: #ffffff !important;
          box-shadow: 0 6px 18px rgba(0, 98, 93, 0.35) !important;
          transition: all 0.28s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
        }
        .btn-hero-lifestyle:hover {
          background: #004d49 !important;
          border-color: #004d49 !important;
          color: #ffffff !important;
          transform: translateY(-2px) !important;
        }
        </style>

        <section class="py-5 bg-white text-center border-top">
          <div class="container py-4" style="max-width: 700px;">
            <?php if ( $badge_text !== '' ) : ?>
            <div class="sec-pill-badge-wrap mb-2">
              <span class="sec-pill-line"></span>
              <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> <?php echo esc_html( $badge_text ); ?></span>
              <span class="sec-pill-line"></span>
            </div>
            <?php endif; ?>

            <?php if ( $title !== '' ) : ?>
            <h2 class="sec-title mb-2">
              <?php echo wp_kses_post( $title ); ?>
            </h2>
            <?php endif; ?>

            <?php if ( $desc !== '' ) : ?>
            <p class="text-muted mb-4" style="font-size: 0.98rem; max-width: 540px; margin: 0 auto; line-height: 1.6;">
              <?php echo esc_html( $desc ); ?>
            </p>
            <?php endif; ?>

            <?php if ( $btn_text !== '' ) : ?>
            <div class="d-flex justify-content-center">
              <a href="<?php echo esc_url( $btn_url ); ?>" class="btn-hero-lifestyle">
                <span><?php echo esc_html( $btn_text ); ?></span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
            <?php endif; ?>
          </div>
        </section>
        <?php
    }
}
