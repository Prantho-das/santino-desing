<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Menu_App_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_menu_app';
    }

    public function get_title() {
        return esc_html__( 'Santino: 4. Mobile App Download Banner', 'santino' );
    }

    public function get_icon() {
        return 'eicon-download-button';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_app',
            array(
                'label' => esc_html__( 'App Download Card', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'app_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'MOBILE REWARDS & ORDERING',
            )
        );

        $this->add_control(
            'app_title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Download the Santino Coffee App',
            )
        );

        $this->add_control(
            'app_sub',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Save time with swift order pickup, earn reward beans on every roast, and access exclusive member privileges.',
            )
        );

        $this->add_control(
            'play_text',
            array(
                'label'   => esc_html__( 'Google Play Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Google Play',
            )
        );

        $this->add_control(
            'play_url',
            array(
                'label'   => esc_html__( 'Google Play URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'https://play.google.com',
            )
        );

        $this->add_control(
            'apple_text',
            array(
                'label'   => esc_html__( 'App Store Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'App Store',
            )
        );

        $this->add_control(
            'apple_url',
            array(
                'label'   => esc_html__( 'App Store URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'https://apps.apple.com',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge      = ! empty( $settings['app_badge'] ) ? $settings['app_badge'] : ( ! empty( $settings['badge_text'] ) ? $settings['badge_text'] : 'MOBILE REWARDS & ORDERING' );
        $title      = ! empty( $settings['app_title'] ) ? $settings['app_title'] : ( ! empty( $settings['title'] ) ? $settings['title'] : 'Download the Santino Coffee App' );
        $sub        = ! empty( $settings['app_sub'] ) ? $settings['app_sub'] : ( ! empty( $settings['desc'] ) ? $settings['desc'] : 'Save time with swift order pickup, earn reward beans on every roast, and access exclusive member privileges.' );
        $play_text  = isset( $settings['play_text'] ) && $settings['play_text'] !== '' ? $settings['play_text'] : 'Google Play';
        $play_url   = ! empty( $settings['play_url'] ) ? ( is_array( $settings['play_url'] ) ? ( $settings['play_url']['url'] ?? '' ) : $settings['play_url'] ) : 'https://play.google.com';
        $apple_text = isset( $settings['apple_text'] ) && $settings['apple_text'] !== '' ? $settings['apple_text'] : 'App Store';
        $apple_url  = ! empty( $settings['apple_url'] ) ? ( is_array( $settings['apple_url'] ) ? ( $settings['apple_url']['url'] ?? '' ) : $settings['apple_url'] ) : 'https://apps.apple.com';
        ?>
        <!-- 5. APP PROMO CTA -->
        <section class="app-download-section">
          <div class="container">
            <div class="app-download-card">
              <div class="row align-items-center g-4 text-center text-lg-start">
                <div class="col-lg-7">
                  <?php if ( ! empty( $badge ) ) : ?>
                  <span class="app-badge-tag"><i class="bi bi-phone"></i> <?php echo esc_html( $badge ); ?></span>
                  <?php endif; ?>
                  <h3 class="app-card-title"><?php echo esc_html( $title ); ?></h3>
                  <p class="app-card-sub mb-0">
                    <?php echo esc_html( $sub ); ?>
                  </p>
                </div>
                <div class="col-lg-5 text-center text-lg-end">
                  <div class="d-inline-flex flex-wrap gap-3 justify-content-center justify-content-lg-end align-items-center">
                    <?php if ( ! empty( $play_text ) ) : ?>
                    <a href="<?php echo esc_url( $play_url ); ?>" target="_blank" class="app-store-badge-btn">
                      <i class="bi bi-google-play text-white"></i>
                      <div class="text-start">
                        <span class="badge-text-top">GET IT ON</span>
                        <strong class="badge-text-main"><?php echo esc_html( $play_text ); ?></strong>
                      </div>
                    </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $apple_text ) ) : ?>
                    <a href="<?php echo esc_url( $apple_url ); ?>" target="_blank" class="app-store-badge-btn">
                      <i class="bi bi-apple text-white"></i>
                      <div class="text-start">
                        <span class="badge-text-top">Download on the</span>
                        <strong class="badge-text-main"><?php echo esc_html( $apple_text ); ?></strong>
                      </div>
                    </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
