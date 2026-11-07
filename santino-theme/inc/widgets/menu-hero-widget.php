<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Menu_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_menu_hero';
    }

    public function get_title() {
        return esc_html__( 'Santino: 1. Menu Hero & Category Banners', 'santino' );
    }

    public function get_icon() {
        return 'eicon-search';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_hero',
            array(
                'label' => esc_html__( 'Hero Header & Search', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'       => esc_html__( 'Badge Text', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'SANTINO SIGNATURE CAFE MENU',
            )
        );

        $this->add_control(
            'title_main',
            array(
                'label'       => esc_html__( 'Title Main', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Artisan Coffee &',
            )
        );

        $this->add_control(
            'title_accent',
            array(
                'label'       => esc_html__( 'Title Accent (Green)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Beverage Menu',
            )
        );

        $this->add_control(
            'desc_text',
            array(
                'label'       => esc_html__( 'Description', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.',
            )
        );

        $this->add_control(
            'search_placeholder',
            array(
                'label'       => esc_html__( 'Search Placeholder', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Search cappuccino, mocha, frappe, latte, croissant...',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_banners',
            array(
                'label' => esc_html__( '5 Visual Category Banners', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'banner_1_img',
            array(
                'label'   => esc_html__( 'Banner 1: Signature Lattes Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'banner_1_slug',
            array(
                'label'   => esc_html__( 'Banner 1 Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'signature-lattes',
            )
        );

        $this->add_control(
            'banner_2_img',
            array(
                'label'   => esc_html__( 'Banner 2: Barista Coffee Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'banner_2_slug',
            array(
                'label'   => esc_html__( 'Banner 2 Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'barista-coffee',
            )
        );

        $this->add_control(
            'banner_3_img',
            array(
                'label'   => esc_html__( 'Banner 3: Fruity Americano Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'banner_3_slug',
            array(
                'label'   => esc_html__( 'Banner 3 Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'fruity-americano',
            )
        );

        $this->add_control(
            'banner_4_img',
            array(
                'label'   => esc_html__( 'Banner 4: SOE Espresso Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'banner_4_slug',
            array(
                'label'   => esc_html__( 'Banner 4 Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'soe-espresso',
            )
        );

        $this->add_control(
            'banner_5_img',
            array(
                'label'   => esc_html__( 'Banner 5: Matcha Tea Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'banner_5_slug',
            array(
                'label'   => esc_html__( 'Banner 5 Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'matcha-tea',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge_text  = isset( $settings['badge_text'] ) && $settings['badge_text'] !== '' ? $settings['badge_text'] : 'SANTINO SIGNATURE CAFE MENU';
        $title_main  = isset( $settings['title_main'] ) && $settings['title_main'] !== '' ? $settings['title_main'] : 'Artisan Coffee &';
        $title_accent = isset( $settings['title_accent'] ) && $settings['title_accent'] !== '' ? $settings['title_accent'] : 'Beverage Menu';
        $desc_text   = isset( $settings['desc_text'] ) && $settings['desc_text'] !== '' ? $settings['desc_text'] : 'Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.';
        $search_ph   = ! empty( $settings['search_placeholder'] ) ? $settings['search_placeholder'] : 'Search cappuccino, mocha, frappe, latte, croissant...';

        $b1 = ! empty( $settings['banner_1_img']['url'] ) ? $settings['banner_1_img']['url'] : santino_img( 'banner-signature-lattes.jpg' );
        $s1 = ! empty( $settings['banner_1_slug'] ) ? $settings['banner_1_slug'] : 'signature-lattes';

        $b2 = ! empty( $settings['banner_2_img']['url'] ) ? $settings['banner_2_img']['url'] : santino_img( 'banner-barista-coffee.jpg' );
        $s2 = ! empty( $settings['banner_2_slug'] ) ? $settings['banner_2_slug'] : 'barista-coffee';

        $b3 = ! empty( $settings['banner_3_img']['url'] ) ? $settings['banner_3_img']['url'] : santino_img( 'banner-fruity-americano.jpg' );
        $s3 = ! empty( $settings['banner_3_slug'] ) ? $settings['banner_3_slug'] : 'fruity-americano';

        $b4 = ! empty( $settings['banner_4_img']['url'] ) ? $settings['banner_4_img']['url'] : santino_img( 'banner-soe-espresso.jpg' );
        $s4 = ! empty( $settings['banner_4_slug'] ) ? $settings['banner_4_slug'] : 'soe-espresso';

        $b5 = ! empty( $settings['banner_5_img']['url'] ) ? $settings['banner_5_img']['url'] : santino_img( 'banner-matcha-tea.jpg' );
        $s5 = ! empty( $settings['banner_5_slug'] ) ? $settings['banner_5_slug'] : 'matcha-tea';
        ?>
        <section class="py-4 bg-white position-relative">
          <div class="floating-bg-icons">
            <i class="bi bi-cup-hot" style="top: 15%; left: 3%; font-size: 45px;"></i>
            <i class="bi bi-flower1" style="top: 60%; right: 4%; font-size: 40px;"></i>
          </div>

          <div class="container position-relative" style="z-index: 1;">
            
            <div class="row align-items-center mb-4 g-3 reveal">
              <div class="col-lg-6">
                <?php if ( ! empty( $badge_text ) ) : ?>
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $badge_text ); ?></span>
                </div>
                <?php endif; ?>
                <h1 class="sec-title mb-2"><?php echo esc_html( $title_main ); ?> <?php if ( ! empty( $title_accent ) ) : ?><span class="sec-title-accent"><?php echo esc_html( $title_accent ); ?></span><?php endif; ?></h1>
                <?php if ( ! empty( $desc_text ) ) : ?>
                <p class="sec-description mb-0"><?php echo esc_html( $desc_text ); ?></p>
                <?php endif; ?>
              </div>
              <div class="col-lg-6">
                <div class="portal-lookup-group shadow-sm">
                  <div class="portal-lookup-field">
                    <i class="bi bi-search"></i>
                    <input type="text" id="menuSearchInput" placeholder="<?php echo esc_attr( $search_ph ); ?>">
                  </div>
                  <button class="btn btn-outline-secondary border-0 d-none" id="clearSearchBtn" style="width: 32px; height: 32px; padding: 0; margin-right: 4px;" aria-label="Clear"><i class="bi bi-x-circle-fill"></i></button>
                  <button type="button" class="btn-lookup-action" id="menuSearchActionBtn" aria-label="Search">
                    <i class="bi bi-arrow-right"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- 5 Category Visual Banners -->
            <div class="luckin-category-banners-container reveal">
              
              <a href="javascript:void(0)" onclick="filterByCategory('<?php echo esc_js( $s1 ); ?>')" class="luckin-banner-card hover-lift">
                <img src="<?php echo esc_url( $b1 ); ?>" alt="Signature Lattes">
              </a>

              <a href="javascript:void(0)" onclick="filterByCategory('<?php echo esc_js( $s2 ); ?>')" class="luckin-banner-card hover-lift">
                <img src="<?php echo esc_url( $b2 ); ?>" alt="Barista Coffee">
              </a>

              <a href="javascript:void(0)" onclick="filterByCategory('<?php echo esc_js( $s3 ); ?>')" class="luckin-banner-card hover-lift">
                <img src="<?php echo esc_url( $b3 ); ?>" alt="Fruity Americano">
              </a>

              <a href="javascript:void(0)" onclick="filterByCategory('<?php echo esc_js( $s4 ); ?>')" class="luckin-banner-card hover-lift">
                <img src="<?php echo esc_url( $b4 ); ?>" alt="Single Origin (SOE)">
              </a>

              <a href="javascript:void(0)" onclick="filterByCategory('<?php echo esc_js( $s5 ); ?>')" class="luckin-banner-card hover-lift">
                <img src="<?php echo esc_url( $b5 ); ?>" alt="Matcha &amp; Frappe">
              </a>

            </div>

          </div>
        </section>
        <?php
    }
}
