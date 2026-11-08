<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Menu_VIP_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_menu_vip';
    }

    public function get_title() {
        return esc_html__( 'Santino: 3. Hero VIP Poster & Promo', 'santino' );
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_vip',
            array(
                'label' => esc_html__( 'VIP Promo Card', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'vip_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SANTINO HERO ITEMS',
            )
        );

        $this->add_control(
            'vip_title',
            array(
                'label'   => esc_html__( 'Title Main', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Premium Beans,',
            )
        );

        $this->add_control(
            'vip_title_accent',
            array(
                'label'   => esc_html__( 'Title Accent', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Hot & Cold Hero Brews',
            )
        );

        $this->add_control(
            'vip_desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Explore our barista favorites including Hot Cappuccino, Iced Latte, Rich Hot Mocha, Iced Mocha, and ice-blended Frappes crafted with 100% premium roasted beans.',
            )
        );

        $this->add_control(
            'poster_img',
            array(
                'label'   => esc_html__( 'Poster Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );

        $this->add_control(
            'btn1_text',
            array(
                'label'   => esc_html__( 'Button 1 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Buy 5 Get 6th Free',
            )
        );

        $this->add_control(
            'btn1_url',
            array(
                'label'   => esc_html__( 'Button 1 Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '/membership/',
            )
        );

        $this->add_control(
            'btn2_text',
            array(
                'label'   => esc_html__( 'Button 2 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Full Menu',
            )
        );

        $this->add_control(
            'btn2_url',
            array(
                'label'   => esc_html__( 'Button 2 Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '#menuGridSection',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge        = ! empty( $settings['vip_badge'] ) ? $settings['vip_badge'] : ( ! empty( $settings['badge_text'] ) ? $settings['badge_text'] : 'EXCLUSIVE VIP PRIVILEGE' );
        $title        = ! empty( $settings['vip_title'] ) ? $settings['vip_title'] : ( ! empty( $settings['title'] ) ? $settings['title'] : 'Premium Beans,' );
        $title_accent = isset( $settings['vip_title_accent'] ) && $settings['vip_title_accent'] !== '' ? $settings['vip_title_accent'] : 'Hot & Cold Hero Brews';
        $desc         = ! empty( $settings['vip_desc'] ) ? $settings['vip_desc'] : ( ! empty( $settings['desc'] ) ? $settings['desc'] : 'Explore our barista favorites including Hot Cappuccino, Iced Latte, Rich Hot Mocha, Iced Mocha, and ice-blended Frappes crafted with 100% premium roasted beans.' );
        $img          = ! empty( $settings['poster_img']['url'] ) ? $settings['poster_img']['url'] : santino_img( 'santino-hero-poster.jpg' );
        if ( ! empty( $img ) && strpos( $img, '/assets/images/' ) !== false ) {
            $img = SANTINO_URI . '/assets/images/' . basename( parse_url( $img, PHP_URL_PATH ) );
        }
        $btn1_text    = isset( $settings['btn1_text'] ) && $settings['btn1_text'] !== '' ? $settings['btn1_text'] : 'Buy 5 Get 6th Free';
        $btn1_url     = ! empty( $settings['btn1_url'] ) ? ( is_array( $settings['btn1_url'] ) ? ( $settings['btn1_url']['url'] ?? '' ) : $settings['btn1_url'] ) : '/membership/';
        $btn2_text    = isset( $settings['btn2_text'] ) && $settings['btn2_text'] !== '' ? $settings['btn2_text'] : 'Explore Full Menu';
        $btn2_url     = ! empty( $settings['btn2_url'] ) ? ( is_array( $settings['btn2_url'] ) ? ( $settings['btn2_url']['url'] ?? '' ) : $settings['btn2_url'] ) : '#menuGridSection';
        ?>
        <!-- 4. HERO ITEMS PROMO / POSTER BANNER -->
        <section class="py-5" style="background: linear-gradient(135deg, #0f2723 0%, #004d49 100%);">
          <div class="container">
            <div class="row align-items-center g-4">
              <div class="col-lg-5 text-center text-lg-start">
                <?php if ( ! empty( $badge ) ) : ?>
                <div class="sec-pill-badge-wrap mb-3">
                  <span class="sec-pill-badge" style="background: rgba(195, 153, 108, 0.2); color: #dfbe8d; border-color: rgba(195, 153, 108, 0.4);">
                    <i class="bi bi-gem me-1" style="color: #dfbe8d;"></i> <?php echo esc_html( $badge ); ?>
                  </span>
                </div>
                <?php endif; ?>
                <h2 class="sec-title text-white mb-3"><?php echo esc_html( $title ); ?> <?php if ( ! empty( $title_accent ) ) : ?><span style="color: #dfbe8d;"><?php echo esc_html( $title_accent ); ?></span><?php endif; ?></h2>
                <?php if ( ! empty( $desc ) ) : ?>
                <p class="text-white-50 mb-4" style="font-size: 1.05rem; line-height: 1.7;">
                  <?php echo esc_html( $desc ); ?>
                </p>
                <?php endif; ?>
                <?php if ( ! empty( $btn1_text ) || ! empty( $btn2_text ) ) : ?>
                <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                  <?php if ( ! empty( $btn1_text ) ) : ?>
                  <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-hero-lifestyle" style="background: #dfbe8d !important; border-color: #dfbe8d !important; color: #0d2622 !important;">
                    <i class="bi bi-gift-fill me-1"></i> <?php echo esc_html( $btn1_text ); ?>
                  </a>
                  <?php endif; ?>
                  <?php if ( ! empty( $btn2_text ) ) : ?>
                  <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-hero-outline">
                    <i class="bi bi-cup-hot-fill me-1"></i> <?php echo esc_html( $btn2_text ); ?>
                  </a>
                  <?php endif; ?>
                </div>
                <?php endif; ?>
              </div>
              <div class="col-lg-7 text-center">
                <div class="rounded-4 overflow-hidden shadow-lg border border-white-10 text-center d-flex align-items-center justify-content-center" style="max-height: 480px; background: rgba(0, 0, 0, 0.2);">
                  <img src="<?php echo esc_url( $img ); ?>" alt="Santino Coffee Hero Menu Poster" class="img-fluid rounded-4 shadow-sm" style="max-height: 480px; width: auto; object-fit: contain;" loading="eager" decoding="sync">
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
