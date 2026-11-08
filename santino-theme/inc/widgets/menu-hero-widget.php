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
                'label' => esc_html__( 'Category Visual Banners (Add New / Edit)', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'banner_img',
            array(
                'label'   => esc_html__( 'Banner Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ),
            )
        );

        $repeater->add_control(
            'banner_title',
            array(
                'label'       => esc_html__( 'Banner Title (Alt Text)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Category Banner',
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'banner_slug',
            array(
                'label'       => esc_html__( 'Filter Category', 'santino' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'default'     => 'signature-lattes',
                'options'     => array(
                    'signature-lattes' => 'Signature Lattes',
                    'barista-coffee'   => 'Barista Classics',
                    'fruity-americano' => 'Fruity Americano',
                    'soe-espresso'     => 'Single Origin (SOE)',
                    'matcha-tea'       => 'Matcha & Frappe',
                    'bakery'           => 'Gourmet Bakery',
                ),
            )
        );

        $repeater->add_control(
            'banner_url',
            array(
                'label'       => esc_html__( 'Custom Link (Optional)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => 'javascript:void(0) or /menu/#category',
            )
        );

        $this->add_control(
            'category_banners',
            array(
                'label'       => esc_html__( 'Banners List (Click Add Item to Add New)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'banner_img'   => array( 'url' => santino_img( 'banner-signature-lattes.jpg' ) ),
                        'banner_title' => 'Signature Lattes',
                        'banner_slug'  => 'signature-lattes',
                    ),
                    array(
                        'banner_img'   => array( 'url' => santino_img( 'banner-barista-coffee.jpg' ) ),
                        'banner_title' => 'Barista Coffee',
                        'banner_slug'  => 'barista-coffee',
                    ),
                    array(
                        'banner_img'   => array( 'url' => santino_img( 'banner-fruity-americano.jpg' ) ),
                        'banner_title' => 'Fruity Americano',
                        'banner_slug'  => 'fruity-americano',
                    ),
                    array(
                        'banner_img'   => array( 'url' => santino_img( 'banner-soe-espresso.jpg' ) ),
                        'banner_title' => 'Single Origin (SOE)',
                        'banner_slug'  => 'soe-espresso',
                    ),
                    array(
                        'banner_img'   => array( 'url' => santino_img( 'banner-matcha-tea.jpg' ) ),
                        'banner_title' => 'Matcha & Frappe',
                        'banner_slug'  => 'matcha-tea',
                    ),
                ),
                'title_field' => '{{{ banner_title }}} ({{{ banner_slug }}})',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge_text   = isset( $settings['badge_text'] ) && $settings['badge_text'] !== '' ? $settings['badge_text'] : 'SANTINO SIGNATURE CAFE MENU';
        $title_main   = isset( $settings['title_main'] ) && $settings['title_main'] !== '' ? $settings['title_main'] : 'Artisan Coffee &';
        $title_accent = isset( $settings['title_accent'] ) && $settings['title_accent'] !== '' ? $settings['title_accent'] : 'Beverage Menu';
        $desc_text    = isset( $settings['desc_text'] ) && $settings['desc_text'] !== '' ? $settings['desc_text'] : 'Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.';
        $search_ph    = ! empty( $settings['search_placeholder'] ) ? $settings['search_placeholder'] : 'Search cappuccino, mocha, frappe, latte, croissant...';

        $banner_items = array();
        if ( ! empty( $settings['category_banners'] ) && is_array( $settings['category_banners'] ) ) {
            foreach ( $settings['category_banners'] as $b ) {
                $img = ! empty( $b['banner_img']['url'] ) ? $b['banner_img']['url'] : '';
                if ( $img ) {
                    $banner_items[] = array(
                        'img'   => $img,
                        'slug'  => ! empty( $b['banner_slug'] ) ? $b['banner_slug'] : 'signature-lattes',
                        'title' => ! empty( $b['banner_title'] ) ? $b['banner_title'] : 'Category Banner',
                        'url'   => ! empty( $b['banner_url']['url'] ) ? $b['banner_url']['url'] : 'javascript:void(0)',
                    );
                }
            }
        }

        if ( empty( $banner_items ) ) {
            $banner_items = array(
                array(
                    'img'   => ! empty( $settings['banner_1_img']['url'] ) ? $settings['banner_1_img']['url'] : santino_img( 'banner-signature-lattes.jpg' ),
                    'slug'  => ! empty( $settings['banner_1_slug'] ) ? $settings['banner_1_slug'] : 'signature-lattes',
                    'title' => 'Signature Lattes',
                    'url'   => 'javascript:void(0)',
                ),
                array(
                    'img'   => ! empty( $settings['banner_2_img']['url'] ) ? $settings['banner_2_img']['url'] : santino_img( 'banner-barista-coffee.jpg' ),
                    'slug'  => ! empty( $settings['banner_2_slug'] ) ? $settings['banner_2_slug'] : 'barista-coffee',
                    'title' => 'Barista Coffee',
                    'url'   => 'javascript:void(0)',
                ),
                array(
                    'img'   => ! empty( $settings['banner_3_img']['url'] ) ? $settings['banner_3_img']['url'] : santino_img( 'banner-fruity-americano.jpg' ),
                    'slug'  => ! empty( $settings['banner_3_slug'] ) ? $settings['banner_3_slug'] : 'fruity-americano',
                    'title' => 'Fruity Americano',
                    'url'   => 'javascript:void(0)',
                ),
                array(
                    'img'   => ! empty( $settings['banner_4_img']['url'] ) ? $settings['banner_4_img']['url'] : santino_img( 'banner-soe-espresso.jpg' ),
                    'slug'  => ! empty( $settings['banner_4_slug'] ) ? $settings['banner_4_slug'] : 'soe-espresso',
                    'title' => 'Single Origin (SOE)',
                    'url'   => 'javascript:void(0)',
                ),
                array(
                    'img'   => ! empty( $settings['banner_5_img']['url'] ) ? $settings['banner_5_img']['url'] : santino_img( 'banner-matcha-tea.jpg' ),
                    'slug'  => ! empty( $settings['banner_5_slug'] ) ? $settings['banner_5_slug'] : 'matcha-tea',
                    'title' => 'Matcha & Frappe',
                    'url'   => 'javascript:void(0)',
                ),
            );
        }
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

            <!-- Category Visual Banners -->
            <div class="luckin-category-banners-container reveal">
              <?php foreach ( $banner_items as $bi ) : 
                $card_href = ( ! empty( $bi['url'] ) && $bi['url'] !== '#' ) ? esc_url( $bi['url'] ) : 'javascript:void(0);';
              ?>
              <a href="<?php echo $card_href; ?>" onclick="filterByCategory('<?php echo esc_js( $bi['slug'] ); ?>')" class="luckin-banner-card hover-lift">
                <img src="<?php echo esc_url( $bi['img'] ); ?>" alt="<?php echo esc_attr( $bi['title'] ); ?>" loading="lazy">
              </a>
              <?php endforeach; ?>
            </div>

          </div>
        </section>
        <?php
    }
}
