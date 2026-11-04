<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Menu_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_menu_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino: /menu/ All Sections & Items', 'santino' );
    }

    public function get_icon() {
        return 'eicon-table';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_hero',
            array(
                'label' => esc_html__( '1. Header & Live Search', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'hero_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SANTINO SIGNATURE CAFE MENU',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Artisan Coffee &',
            )
        );

        $this->add_control(
            'hero_title_accent',
            array(
                'label'   => esc_html__( 'Title Accent (Green)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Beverage Menu',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.',
            )
        );

        $this->add_control(
            'hero_search_ph',
            array(
                'label'   => esc_html__( 'Search Placeholder', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Search cappuccino, mocha, frappe, latte, croissant...',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cat_banners',
            array(
                'label' => esc_html__( '2. Visual Category Banners (5 Cards)', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_cat_banners',
            array(
                'label'        => esc_html__( 'Show Category Banners', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'cat_banner_1_img',
            array(
                'label'   => esc_html__( 'Banner 1: Signature Lattes Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'cat_banner_1_slug',
            array(
                'label'   => esc_html__( 'Banner 1 Category Filter Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'signature-lattes',
            )
        );

        $this->add_control(
            'cat_banner_2_img',
            array(
                'label'   => esc_html__( 'Banner 2: Barista Coffee Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'cat_banner_2_slug',
            array(
                'label'   => esc_html__( 'Banner 2 Category Filter Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'barista-coffee',
            )
        );

        $this->add_control(
            'cat_banner_3_img',
            array(
                'label'   => esc_html__( 'Banner 3: Fruity Americano Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'cat_banner_3_slug',
            array(
                'label'   => esc_html__( 'Banner 3 Category Filter Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'fruity-americano',
            )
        );

        $this->add_control(
            'cat_banner_4_img',
            array(
                'label'   => esc_html__( 'Banner 4: Single Origin (SOE) Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'cat_banner_4_slug',
            array(
                'label'   => esc_html__( 'Banner 4 Category Filter Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'soe-espresso',
            )
        );

        $this->add_control(
            'cat_banner_5_img',
            array(
                'label'   => esc_html__( 'Banner 5: Matcha & Frappe Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );
        $this->add_control(
            'cat_banner_5_slug',
            array(
                'label'   => esc_html__( 'Banner 5 Category Filter Slug', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'matcha-tea',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_items_grid',
            array(
                'label' => esc_html__( '3. Handcrafted Items Grid Header', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'grid_badge',
            array(
                'label'   => esc_html__( 'Grid Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'FRESHLY BREWED',
            )
        );

        $this->add_control(
            'grid_title',
            array(
                'label'   => esc_html__( 'Grid Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'All Handcrafted',
            )
        );

        $this->add_control(
            'grid_title_accent',
            array(
                'label'   => esc_html__( 'Title Accent', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Items',
            )
        );

        $this->add_control(
            'grid_desc',
            array(
                'label'   => esc_html__( 'Grid Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Showing specialty beverages and gourmet items',
            )
        );

        $this->add_control(
            'order_btn_text',
            array(
                'label'   => esc_html__( 'Card Order Button Text (Blank to Hide)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            )
        );

        $this->add_control(
            'order_wa_number',
            array(
                'label'   => esc_html__( 'Order WhatsApp Phone Number', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '8801613334514',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_vip_poster',
            array(
                'label' => esc_html__( '4. VIP Hero Poster Section', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_vip_section',
            array(
                'label'        => esc_html__( 'Show VIP Poster Section', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
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
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Premium Beans,',
            )
        );

        $this->add_control(
            'vip_title_accent',
            array(
                'label'   => esc_html__( 'Title Accent (Gold)', 'santino' ),
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
            'vip_poster_img',
            array(
                'label'   => esc_html__( 'Poster Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
            )
        );

        $this->add_control(
            'vip_btn1_text',
            array(
                'label'   => esc_html__( 'Button 1 Text (Blank to Hide)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Buy 5 Get 6th Free',
            )
        );

        $this->add_control(
            'vip_btn1_url',
            array(
                'label'   => esc_html__( 'Button 1 URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '/membership/',
                ),
            )
        );

        $this->add_control(
            'vip_btn2_text',
            array(
                'label'   => esc_html__( 'Button 2 Text (Blank to Hide)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Full Menu',
            )
        );

        $this->add_control(
            'vip_btn2_url',
            array(
                'label'   => esc_html__( 'Button 2 URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '#menuGridSection',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_app_download',
            array(
                'label' => esc_html__( '5. Mobile App Download Banner', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_app_section',
            array(
                'label'        => esc_html__( 'Show App Download Banner', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
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
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Save time with swift order pickup, earn reward beans on every roast, and access exclusive member privileges.',
            )
        );

        $this->add_control(
            'app_play_text',
            array(
                'label'   => esc_html__( 'Google Play Button Text (Blank to Hide)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Google Play',
            )
        );

        $this->add_control(
            'app_play_url',
            array(
                'label'   => esc_html__( 'Google Play URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => 'https://play.google.com',
                ),
            )
        );

        $this->add_control(
            'app_apple_text',
            array(
                'label'   => esc_html__( 'Apple Store Button Text (Blank to Hide)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'App Store',
            )
        );

        $this->add_control(
            'app_apple_url',
            array(
                'label'   => esc_html__( 'Apple Store URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => 'https://apps.apple.com',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_branches',
            array(
                'label' => esc_html__( '6. Experience Hubs & Branches Locator', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_branches_section',
            array(
                'label'        => esc_html__( 'Show Branches Locator', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'branches_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'EXPERIENCE SANTINO NATIONWIDE',
            )
        );

        $this->add_control(
            'branches_title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our Cafes &',
            )
        );

        $this->add_control(
            'branches_title_accent',
            array(
                'label'   => esc_html__( 'Title Accent', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Roastery Hubs',
            )
        );

        $this->add_control(
            'branches_sub',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Step into an artisan coffee retreat or visit our partner express bars across prime Dhaka locations',
            )
        );

        $this->add_control(
            'branch_map_btn_text',
            array(
                'label'   => esc_html__( 'Maps Button Text (Blank to Hide)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Google Maps',
            )
        );

        $this->add_control(
            'branch_call_btn_text',
            array(
                'label'   => esc_html__( 'Call Button Text (Blank to Hide)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Call Branch',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $hero_badge        = ! empty( $settings['hero_badge'] ) ? $settings['hero_badge'] : '';
        $hero_title        = ! empty( $settings['hero_title'] ) ? $settings['hero_title'] : 'Artisan Coffee &';
        $hero_title_accent = ! empty( $settings['hero_title_accent'] ) ? $settings['hero_title_accent'] : 'Beverage Menu';
        $hero_desc         = ! empty( $settings['hero_desc'] ) ? $settings['hero_desc'] : '';
        $hero_search_ph    = ! empty( $settings['hero_search_ph'] ) ? $settings['hero_search_ph'] : 'Search cappuccino, mocha, frappe, latte, croissant...';

        $show_cat_banners  = ( $settings['show_cat_banners'] ?? 'yes' ) === 'yes';
        $banner1_img       = ! empty( $settings['cat_banner_1_img']['url'] ) ? $settings['cat_banner_1_img']['url'] : santino_img( 'banner-signature-lattes.jpg' );
        $banner1_slug      = ! empty( $settings['cat_banner_1_slug'] ) ? $settings['cat_banner_1_slug'] : 'signature-lattes';
        $banner2_img       = ! empty( $settings['cat_banner_2_img']['url'] ) ? $settings['cat_banner_2_img']['url'] : santino_img( 'banner-barista-coffee.jpg' );
        $banner2_slug      = ! empty( $settings['cat_banner_2_slug'] ) ? $settings['cat_banner_2_slug'] : 'barista-coffee';
        $banner3_img       = ! empty( $settings['cat_banner_3_img']['url'] ) ? $settings['cat_banner_3_img']['url'] : santino_img( 'banner-fruity-americano.jpg' );
        $banner3_slug      = ! empty( $settings['cat_banner_3_slug'] ) ? $settings['cat_banner_3_slug'] : 'fruity-americano';
        $banner4_img       = ! empty( $settings['cat_banner_4_img']['url'] ) ? $settings['cat_banner_4_img']['url'] : santino_img( 'banner-soe-espresso.jpg' );
        $banner4_slug      = ! empty( $settings['cat_banner_4_slug'] ) ? $settings['cat_banner_4_slug'] : 'soe-espresso';
        $banner5_img       = ! empty( $settings['cat_banner_5_img']['url'] ) ? $settings['cat_banner_5_img']['url'] : santino_img( 'banner-matcha-tea.jpg' );
        $banner5_slug      = ! empty( $settings['cat_banner_5_slug'] ) ? $settings['cat_banner_5_slug'] : 'matcha-tea';

        $grid_badge        = ! empty( $settings['grid_badge'] ) ? $settings['grid_badge'] : '';
        $grid_title        = ! empty( $settings['grid_title'] ) ? $settings['grid_title'] : 'All Handcrafted';
        $grid_title_accent = ! empty( $settings['grid_title_accent'] ) ? $settings['grid_title_accent'] : 'Items';
        $grid_desc         = ! empty( $settings['grid_desc'] ) ? $settings['grid_desc'] : '';
        $order_btn_text    = isset( $settings['order_btn_text'] ) ? trim( (string) $settings['order_btn_text'] ) : '';
        $order_wa_number   = ! empty( $settings['order_wa_number'] ) ? preg_replace( '/[^0-9]/', '', $settings['order_wa_number'] ) : '8801613334514';

        $show_vip          = ( $settings['show_vip_section'] ?? 'yes' ) === 'yes';
        $vip_badge         = ! empty( $settings['vip_badge'] ) ? $settings['vip_badge'] : '';
        $vip_title         = ! empty( $settings['vip_title'] ) ? $settings['vip_title'] : 'Premium Beans,';
        $vip_title_accent  = ! empty( $settings['vip_title_accent'] ) ? $settings['vip_title_accent'] : 'Hot & Cold Hero Brews';
        $vip_desc          = ! empty( $settings['vip_desc'] ) ? $settings['vip_desc'] : '';
        $vip_poster_img    = ! empty( $settings['vip_poster_img']['url'] ) ? $settings['vip_poster_img']['url'] : santino_img( 'santino-hero-poster.jpg' );
        $vip_btn1_text     = isset( $settings['vip_btn1_text'] ) ? trim( (string) $settings['vip_btn1_text'] ) : '';
        $vip_btn1_url      = ! empty( $settings['vip_btn1_url']['url'] ) ? $settings['vip_btn1_url']['url'] : '/membership/';
        $vip_btn2_text     = isset( $settings['vip_btn2_text'] ) ? trim( (string) $settings['vip_btn2_text'] ) : '';
        $vip_btn2_url      = ! empty( $settings['vip_btn2_url']['url'] ) ? $settings['vip_btn2_url']['url'] : '#menuGridSection';

        $show_app          = ( $settings['show_app_section'] ?? 'yes' ) === 'yes';
        $app_badge         = ! empty( $settings['app_badge'] ) ? $settings['app_badge'] : '';
        $app_title         = ! empty( $settings['app_title'] ) ? $settings['app_title'] : 'Download the Santino Coffee App';
        $app_sub           = ! empty( $settings['app_sub'] ) ? $settings['app_sub'] : '';
        $app_play_text     = isset( $settings['app_play_text'] ) ? trim( (string) $settings['app_play_text'] ) : '';
        $app_play_url      = ! empty( $settings['app_play_url']['url'] ) ? $settings['app_play_url']['url'] : 'https://play.google.com';
        $app_apple_text    = isset( $settings['app_apple_text'] ) ? trim( (string) $settings['app_apple_text'] ) : '';
        $app_apple_url     = ! empty( $settings['app_apple_url']['url'] ) ? $settings['app_apple_url']['url'] : 'https://apps.apple.com';

        $show_branches     = ( $settings['show_branches_section'] ?? 'yes' ) === 'yes';
        $branches_badge    = ! empty( $settings['branches_badge'] ) ? $settings['branches_badge'] : '';
        $branches_title    = ! empty( $settings['branches_title'] ) ? $settings['branches_title'] : 'Our Cafes &';
        $branches_title_accent = ! empty( $settings['branches_title_accent'] ) ? $settings['branches_title_accent'] : 'Roastery Hubs';
        $branches_sub      = ! empty( $settings['branches_sub'] ) ? $settings['branches_sub'] : '';
        $branch_map_btn_text = isset( $settings['branch_map_btn_text'] ) ? trim( (string) $settings['branch_map_btn_text'] ) : '';
        $branch_call_btn_text = isset( $settings['branch_call_btn_text'] ) ? trim( (string) $settings['branch_call_btn_text'] ) : '';

        $branches_detailed = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_branches_detailed() : array();
        $region_filters    = array();
        foreach ( $branches_detailed as $b ) {
            $r = ! empty( $b['district'] ) ? trim( $b['district'] ) : ( ! empty( $b['division'] ) ? trim( $b['division'] ) : '' );
            if ( $r && ! in_array( $r, $region_filters ) ) {
                $region_filters[] = $r;
            }
        }
        ?>
        <style>
        .menu-page-wrap, body, p, .text-muted, .text-secondary, label, input, select, textarea {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
        }
        .sec-title,
        .font-heading,
        h1, h2, h3, h4, h5, h6,
        .sec-pill-badge,
        .btn-hero-lifestyle,
        .btn-hero-outline,
        .btn-lookup-action,
        .branch-filter-btn,
        .btn-cat-tab,
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
        .text-white .sec-title {
          color: #ffffff !important;
        }
        .sec-title-accent, .menu-title-highlight {
          color: var(--santino-teal, #00625d) !important;
        }
        .sec-description {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
          color: #556662;
          font-size: 1rem;
          line-height: 1.6;
        }
        .sec-pill-badge-wrap {
          display: inline-flex;
          align-items: center;
        }
        .sec-pill-badge {
          display: inline-flex;
          align-items: center;
          gap: 6px;
          background: rgba(0, 98, 93, 0.08);
          color: var(--santino-teal, #00625d);
          border: 1px solid rgba(0, 98, 93, 0.22);
          padding: 5px 14px;
          border-radius: 50px;
          font-size: 0.76rem;
          font-weight: 800;
          letter-spacing: 1px;
          text-transform: uppercase;
        }
        .portal-lookup-group {
          display: flex;
          align-items: center;
          background: #f8faf9;
          border: 1.5px solid #d5e5e0;
          border-radius: 50px;
          padding: 6px 8px 6px 18px;
          transition: all 0.3s ease;
          box-shadow: 0 2px 10px rgba(0, 98, 93, 0.04);
          width: 100%;
        }
        .portal-lookup-group:focus-within {
          border-color: var(--santino-teal, #00625d);
          background: #ffffff;
          box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.12), 0 4px 16px rgba(0, 98, 93, 0.08);
        }
        .portal-lookup-field {
          flex: 1;
          display: flex;
          align-items: center;
          gap: 12px;
        }
        .portal-lookup-field i {
          color: var(--santino-teal, #00625d);
          font-size: 1.15rem;
        }
        .portal-lookup-field input {
          width: 100%;
          border: none;
          background: transparent;
          outline: none;
          box-shadow: none;
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
          font-size: 0.95rem;
          color: #111111;
          padding: 8px 0;
        }
        .btn-lookup-action {
          background: var(--santino-teal, #00625d);
          border: none;
          color: #ffffff;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          cursor: pointer;
          transition: all 0.2s ease;
          flex-shrink: 0;
        }
        .btn-lookup-action:hover {
          background: #004d49;
          transform: scale(1.05);
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
        .btn-cat-tab {
          border: 1.5px solid #e0ebe8;
          background: #ffffff;
          color: #334441;
          border-radius: 50px;
          padding: 9px 20px;
          font-size: 13.5px;
          font-weight: 700;
          transition: all 0.25s ease;
          display: inline-flex;
          align-items: center;
          gap: 8px;
          cursor: pointer;
        }
        .btn-cat-tab:hover {
          border-color: var(--santino-teal, #00625d);
          color: var(--santino-teal, #00625d);
          background: #f4faf8;
        }
        .btn-cat-tab.active {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          border-color: var(--santino-teal, #00625d);
          box-shadow: 0 4px 14px rgba(0, 98, 93, 0.25);
        }
        .menu-product-card {
          background: #ffffff;
          border: 1px solid #e8f0ed;
          border-radius: 18px;
          overflow: hidden;
          transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
          display: flex;
          flex-direction: column;
          height: 100%;
        }
        .menu-product-card:hover {
          transform: translateY(-6px);
          border-color: rgba(0, 98, 93, 0.3);
          box-shadow: 0 14px 34px rgba(0, 98, 93, 0.12);
        }
        .menu-card-image-wrap {
          position: relative;
          height: 220px;
          background: #f7f9f8;
          overflow: hidden;
        }
        .menu-card-img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.5s ease;
        }
        .menu-product-card:hover .menu-card-img {
          transform: scale(1.05);
        }
        .menu-badge-pill {
          position: absolute;
          top: 12px;
          left: 12px;
          z-index: 2;
          font-size: 10px;
          font-weight: 800;
          letter-spacing: 0.6px;
          padding: 4px 10px;
          border-radius: 50px;
        }
        .menu-badge-pill.badge-teal {
          background: rgba(0, 98, 93, 0.9);
          color: #ffffff;
        }
        .menu-card-body {
          padding: 18px;
          display: flex;
          flex-direction: column;
          flex: 1;
        }
        .menu-taste-notes {
          font-size: 11.5px;
          font-weight: 700;
          color: var(--santino-teal, #00625d);
          text-transform: uppercase;
          letter-spacing: 0.5px;
          margin-bottom: 4px;
        }
        .menu-item-name {
          font-size: 1.15rem;
          font-weight: 800;
          color: #111111;
          margin-bottom: 6px;
          line-height: 1.3;
        }
        .menu-item-price {
          font-size: 1.25rem;
          font-weight: 900;
          color: #111111;
          font-family: var(--kp-font-title, 'Montserrat', sans-serif);
        }
        .luckin-category-banners-container {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
          gap: 14px;
          margin-top: 24px;
        }
        .luckin-banner-card {
          border-radius: 14px;
          overflow: hidden;
          box-shadow: 0 4px 14px rgba(0,0,0,0.06);
          display: block;
          transition: transform 0.25s ease;
        }
        .luckin-banner-card:hover {
          transform: translateY(-4px);
        }
        .luckin-banner-card img {
          width: 100%;
          height: auto;
          display: block;
        }
        .menu-category-sticky-bar {
          background: #ffffff;
          border-top: 1px solid #edf2f0;
          border-bottom: 1px solid #edf2f0;
          padding: 14px 0;
          position: sticky;
          top: 70px;
          z-index: 10;
        }
        .category-tabs-wrapper {
          overflow-x: auto;
          white-space: nowrap;
          padding-bottom: 4px;
        }
        .branch-card {
          background: #ffffff;
          border: 1px solid #e8f0ed;
          border-radius: 18px;
          overflow: hidden;
          box-shadow: 0 4px 20px rgba(0,0,0,0.04);
          transition: transform 0.3s ease;
        }
        .branch-card:hover {
          transform: translateY(-4px);
        }
        .branch-card-img {
          height: 200px;
          background-size: cover;
          background-position: center;
          position: relative;
        }
        .branch-tag-badge {
          position: absolute;
          top: 12px;
          left: 12px;
          background: var(--santino-teal, #00625d);
          color: #fff;
          font-size: 10px;
          font-weight: 800;
          padding: 4px 10px;
          border-radius: 50px;
        }
        .branch-card-body {
          padding: 20px;
        }
        .branch-title {
          font-size: 1.15rem;
          font-weight: 800;
          color: #111;
          margin-bottom: 8px;
        }
        .branch-filter-btn {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif);
          font-weight: 600;
          font-size: 13px;
          padding: 8px 20px;
          border-radius: 50px;
          border: 1.5px solid #d5e5e0;
          background: #fff;
          color: #334155;
          cursor: pointer;
        }
        .branch-filter-btn.active, .branch-filter-btn:hover {
          background: var(--santino-teal, #00625d);
          color: #fff;
          border-color: var(--santino-teal, #00625d);
        }
        .app-download-section {
          padding: 40px 0;
          background: #f7faf9;
        }
        .app-download-card {
          background: linear-gradient(135deg, #092622 0%, #004d49 100%);
          border-radius: 24px;
          padding: 45px 40px;
          color: #ffffff;
          box-shadow: 0 20px 50px rgba(0, 77, 73, 0.18);
        }
        .app-card-title {
          font-size: clamp(1.6rem, 2.5vw, 2.2rem);
          font-weight: 900;
          color: #ffffff;
          margin-bottom: 12px;
        }
        .app-card-sub {
          font-size: 1rem;
          color: rgba(255, 255, 255, 0.85);
          line-height: 1.6;
        }
        .app-store-badge-btn {
          display: inline-flex;
          align-items: center;
          gap: 12px;
          background: #000000;
          border: 1.5px solid rgba(255, 255, 255, 0.25);
          color: #ffffff;
          padding: 10px 22px;
          border-radius: 14px;
          text-decoration: none;
          transition: all 0.25s ease;
        }
        .app-store-badge-btn:hover {
          background: #111111;
          color: #dfbe8d;
          border-color: #dfbe8d;
          transform: translateY(-2px);
        }
        .app-store-badge-btn i {
          font-size: 26px;
        }
        .badge-text-top {
          font-size: 10px;
          text-transform: uppercase;
          letter-spacing: 0.5px;
          display: block;
          color: rgba(255, 255, 255, 0.7);
        }
        .badge-text-main {
          font-size: 14px;
          font-weight: 700;
          display: block;
        }
        </style>

        <div class="menu-page-wrap">
          <section class="py-4 bg-white position-relative">
            <div class="container position-relative" style="z-index: 1;">
              <div class="row align-items-center mb-4 g-3">
                <div class="col-lg-6">
                  <?php if ( ! empty( $hero_badge ) ) : ?>
                  <div class="sec-pill-badge-wrap mb-2">
                    <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $hero_badge ); ?></span>
                  </div>
                  <?php endif; ?>
                  <h1 class="sec-title mb-2">
                    <?php echo esc_html( $hero_title ); ?> 
                    <?php if ( ! empty( $hero_title_accent ) ) : ?>
                      <span class="sec-title-accent"><?php echo esc_html( $hero_title_accent ); ?></span>
                    <?php endif; ?>
                  </h1>
                  <?php if ( ! empty( $hero_desc ) ) : ?>
                  <p class="sec-description mb-0"><?php echo esc_html( $hero_desc ); ?></p>
                  <?php endif; ?>
                </div>
                <div class="col-lg-6">
                  <div class="portal-lookup-group shadow-sm">
                    <div class="portal-lookup-field">
                      <i class="bi bi-search"></i>
                      <input type="text" id="menuSearchInput" placeholder="<?php echo esc_attr( $hero_search_ph ); ?>">
                    </div>
                    <button type="button" class="btn-lookup-action" id="menuSearchActionBtn" aria-label="Search">
                      <i class="bi bi-arrow-right"></i>
                    </button>
                  </div>
                </div>
              </div>

              <?php if ( $show_cat_banners ) : ?>
              <div class="luckin-category-banners-container">
                <a href="javascript:void(0)" onclick="if(window.filterByCategory){window.filterByCategory('<?php echo esc_js($banner1_slug); ?>');}" class="luckin-banner-card">
                  <img src="<?php echo esc_url( $banner1_img ); ?>" alt="Signature Lattes">
                </a>
                <a href="javascript:void(0)" onclick="if(window.filterByCategory){window.filterByCategory('<?php echo esc_js($banner2_slug); ?>');}" class="luckin-banner-card">
                  <img src="<?php echo esc_url( $banner2_img ); ?>" alt="Barista Coffee">
                </a>
                <a href="javascript:void(0)" onclick="if(window.filterByCategory){window.filterByCategory('<?php echo esc_js($banner3_slug); ?>');}" class="luckin-banner-card">
                  <img src="<?php echo esc_url( $banner3_img ); ?>" alt="Fruity Americano">
                </a>
                <a href="javascript:void(0)" onclick="if(window.filterByCategory){window.filterByCategory('<?php echo esc_js($banner4_slug); ?>');}" class="luckin-banner-card">
                  <img src="<?php echo esc_url( $banner4_img ); ?>" alt="Single Origin Espresso">
                </a>
                <a href="javascript:void(0)" onclick="if(window.filterByCategory){window.filterByCategory('<?php echo esc_js($banner5_slug); ?>');}" class="luckin-banner-card">
                  <img src="<?php echo esc_url( $banner5_img ); ?>" alt="Matcha Tea &amp; Frappe">
                </a>
              </div>
              <?php endif; ?>
            </div>
          </section>

          <nav class="menu-category-sticky-bar" id="categoryStickyBar">
            <div class="container">
              <div class="category-tabs-wrapper d-flex align-items-center gap-2">
                <button class="btn-cat-tab active" data-filter="all"><i class="bi bi-grid-fill"></i> All Items</button>
                <button class="btn-cat-tab" data-filter="signature-lattes"><i class="bi bi-cup-hot-fill"></i> Signature Lattes</button>
                <button class="btn-cat-tab" data-filter="barista-coffee"><i class="bi bi-cup-straw"></i> Barista Classics</button>
                <button class="btn-cat-tab" data-filter="fruity-americano"><i class="bi bi-lightning-charge-fill"></i> Fruity Americano</button>
                <button class="btn-cat-tab" data-filter="soe-espresso"><i class="bi bi-award-fill"></i> Single Origin (SOE)</button>
                <button class="btn-cat-tab" data-filter="matcha-tea"><i class="bi bi-flower1"></i> Matcha &amp; Frappe</button>
                <button class="btn-cat-tab" data-filter="bakery"><i class="bi bi-pie-chart-fill"></i> Gourmet Bakery</button>
              </div>
            </div>
          </nav>

          <section class="menu-items-section py-5" id="menuGridSection">
            <div class="container">
              <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div>
                  <?php if ( ! empty( $grid_badge ) ) : ?>
                  <div class="sec-pill-badge-wrap mb-1">
                    <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $grid_badge ); ?></span>
                  </div>
                  <?php endif; ?>
                  <h2 class="sec-title mb-1" id="currentCategoryHeading">
                    <?php echo esc_html( $grid_title ); ?> 
                    <?php if ( ! empty( $grid_title_accent ) ) : ?>
                      <span class="sec-title-accent"><?php echo esc_html( $grid_title_accent ); ?></span>
                    <?php endif; ?>
                  </h2>
                  <?php if ( ! empty( $grid_desc ) ) : ?>
                  <div class="sec-description text-muted small" id="itemsCountText"><?php echo esc_html( $grid_desc ); ?></div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="row g-4" id="menuItemsGrid">
                <?php
                $dynamic_items = class_exists( 'Santino_Handcrafted_Items_System' ) ? Santino_Handcrafted_Items_System::get_all_menu_items() : array();
                if ( empty( $dynamic_items ) ) {
                    $dynamic_items = array(
                        array( 'name' => 'Hot Cappuccino', 'roast' => 'Reg Tk. 170 | Large Tk. 220', 'price' => 170, 'img' => santino_img( 'menu-cappuccino-hot.jpg' ), 'tag' => 'Hero Item', 'badgeClass' => 'badge-teal' ),
                        array( 'name' => 'Iced Latte', 'roast' => 'Smooth & Refreshing', 'price' => 200, 'img' => santino_img( 'menu-iced-latte.jpg' ), 'tag' => 'Hero Item', 'badgeClass' => 'badge-teal' ),
                        array( 'name' => 'Hot Mocha', 'roast' => 'Reg Tk. 190 | Large Tk. 230', 'price' => 190, 'img' => santino_img( 'menu-hot-mocha.jpg' ), 'tag' => 'Bestseller', 'badgeClass' => 'badge-gold' ),
                        array( 'name' => 'Iced Mocha', 'roast' => 'Rich Belgian Cocoa', 'price' => 210, 'img' => santino_img( 'menu-iced-mocha.jpg' ), 'tag' => 'Bestseller', 'badgeClass' => 'badge-gold' ),
                        array( 'name' => 'Mocha Frappe', 'roast' => 'Ice Blended', 'price' => 230, 'img' => santino_img( 'menu-mocha-frappe.jpg' ), 'tag' => 'Hero Item', 'badgeClass' => 'badge-danger' ),
                        array( 'name' => 'Artisan Butter Croissant', 'roast' => 'French Cultured Butter', 'price' => 220, 'img' => santino_img( 'menu-signature-croissant.jpg' ), 'tag' => 'Bakery', 'badgeClass' => 'badge-teal' ),
                    );
                }
                foreach ( $dynamic_items as $item ) :
                    $it_name  = $item['name'] ?? '';
                    $it_notes = ! empty( $item['roast'] ) ? $item['roast'] : ( $item['desc'] ?? '' );
                    $it_price = is_numeric( $item['price'] ?? '' ) ? '৳ ' . $item['price'] : ( $item['price'] ?? '' );
                    $it_img   = $item['img'] ?? santino_img( 'menu-cappuccino-hot.jpg' );
                    $it_badge = ! empty( $item['tag'] ) ? $item['tag'] : ( ! empty( $item['badge'] ) ? $item['badge'] : 'Handcrafted' );
                    $it_class = ! empty( $item['badgeClass'] ) ? $item['badgeClass'] : 'badge-teal';
                ?>
                <div class="col-md-6 col-lg-4">
                  <div class="menu-product-card">
                    <div class="menu-card-image-wrap">
                      <span class="menu-badge-pill <?php echo esc_attr( $it_class ); ?>"><?php echo esc_html( $it_badge ); ?></span>
                      <img src="<?php echo esc_url( $it_img ); ?>" alt="<?php echo esc_attr( $it_name ); ?>" class="menu-card-img">
                    </div>
                    <div class="menu-card-body">
                      <div class="menu-taste-notes"><?php echo esc_html( $it_notes ); ?></div>
                      <h4 class="menu-item-name"><?php echo esc_html( $it_name ); ?></h4>
                      <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                        <span class="menu-item-price"><?php echo esc_html( $it_price ); ?></span>
                        <?php if ( ! empty( $order_btn_text ) ) : ?>
                        <a href="https://wa.me/<?php echo esc_attr( $order_wa_number ); ?>?text=<?php echo urlencode( 'I want to order ' . $it_name ); ?>" target="_blank" class="btn-hero-lifestyle" style="height: 38px; min-height: 38px; padding: 0 18px; font-size: 11px;">
                          <?php echo esc_html( $order_btn_text ); ?>
                        </a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
              <script>
              window.santino_menu_data = window.santino_menu_data || {};
              window.santino_menu_data.items = <?php echo json_encode( $dynamic_items ); ?>;
              window.santino_order_btn_text = <?php echo json_encode( $order_btn_text ); ?>;
              if (typeof menuProducts !== 'undefined' && Array.isArray(window.santino_menu_data.items)) {
                menuProducts = window.santino_menu_data.items;
              }
              </script>
            </div>
          </section>

          <?php if ( $show_vip ) : ?>
          <section class="py-5" style="background: linear-gradient(135deg, #0f2723 0%, #004d49 100%);">
            <div class="container">
              <div class="row align-items-center g-4">
                <div class="col-lg-5 text-center text-lg-start">
                  <?php if ( ! empty( $vip_badge ) ) : ?>
                  <div class="sec-pill-badge-wrap mb-3">
                    <span class="sec-pill-badge" style="background: rgba(195, 153, 108, 0.2); color: #dfbe8d; border-color: rgba(195, 153, 108, 0.4);">
                      <i class="bi bi-gem me-1" style="color: #dfbe8d;"></i> <?php echo esc_html( $vip_badge ); ?>
                    </span>
                  </div>
                  <?php endif; ?>
                  <h2 class="sec-title text-white mb-3">
                    <?php echo esc_html( $vip_title ); ?> 
                    <?php if ( ! empty( $vip_title_accent ) ) : ?>
                      <span style="color: #dfbe8d;"><?php echo esc_html( $vip_title_accent ); ?></span>
                    <?php endif; ?>
                  </h2>
                  <?php if ( ! empty( $vip_desc ) ) : ?>
                  <p class="text-white-50 mb-4" style="font-size: 1.05rem; line-height: 1.7;">
                    <?php echo esc_html( $vip_desc ); ?>
                  </p>
                  <?php endif; ?>
                  <?php if ( ! empty( $vip_btn1_text ) || ! empty( $vip_btn2_text ) ) : ?>
                  <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <?php if ( ! empty( $vip_btn1_text ) ) : ?>
                    <a href="<?php echo esc_url( $vip_btn1_url ); ?>" class="btn-hero-lifestyle" style="background: #dfbe8d !important; border-color: #dfbe8d !important; color: #0d2622 !important;">
                      <i class="bi bi-gift-fill me-1"></i> <?php echo esc_html( $vip_btn1_text ); ?>
                    </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $vip_btn2_text ) ) : ?>
                    <a href="<?php echo esc_url( $vip_btn2_url ); ?>" class="btn-hero-outline">
                      <i class="bi bi-cup-hot-fill me-1"></i> <?php echo esc_html( $vip_btn2_text ); ?>
                    </a>
                    <?php endif; ?>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="col-lg-7">
                  <div class="rounded-4 overflow-hidden shadow-lg border border-white-10 text-center" style="max-height: 480px; background: #000;">
                    <img src="<?php echo esc_url( $vip_poster_img ); ?>" alt="Santino Coffee Hero Menu Poster" class="w-100 h-100 object-fit-contain" style="max-height: 480px;">
                  </div>
                </div>
              </div>
            </div>
          </section>
          <?php endif; ?>

          <?php if ( $show_app ) : ?>
          <section class="app-download-section">
            <div class="container">
              <div class="app-download-card">
                <div class="row align-items-center g-4 text-center text-lg-start">
                  <div class="col-lg-7">
                    <?php if ( ! empty( $app_badge ) ) : ?>
                    <span class="badge rounded-pill px-3 py-1 mb-2" style="background: rgba(223, 190, 141, 0.2); color: #dfbe8d; border: 1px solid rgba(223, 190, 141, 0.35); font-size: 11px;">
                      <i class="bi bi-phone me-1"></i> <?php echo esc_html( $app_badge ); ?>
                    </span>
                    <?php endif; ?>
                    <h3 class="app-card-title"><?php echo esc_html( $app_title ); ?></h3>
                    <?php if ( ! empty( $app_sub ) ) : ?>
                    <p class="app-card-sub mb-0"><?php echo esc_html( $app_sub ); ?></p>
                    <?php endif; ?>
                  </div>
                  <div class="col-lg-5 text-center text-lg-end">
                    <?php if ( ! empty( $app_play_text ) || ! empty( $app_apple_text ) ) : ?>
                    <div class="d-inline-flex flex-wrap gap-3 justify-content-center justify-content-lg-end align-items-center">
                      <?php if ( ! empty( $app_play_text ) ) : ?>
                      <a href="<?php echo esc_url( $app_play_url ); ?>" target="_blank" class="app-store-badge-btn">
                        <i class="bi bi-google-play"></i>
                        <div class="text-start">
                          <span class="badge-text-top">GET IT ON</span>
                          <strong class="badge-text-main"><?php echo esc_html( $app_play_text ); ?></strong>
                        </div>
                      </a>
                      <?php endif; ?>
                      <?php if ( ! empty( $app_apple_text ) ) : ?>
                      <a href="<?php echo esc_url( $app_apple_url ); ?>" target="_blank" class="app-store-badge-btn">
                        <i class="bi bi-apple"></i>
                        <div class="text-start">
                          <span class="badge-text-top">Download on</span>
                          <strong class="badge-text-main"><?php echo esc_html( $app_apple_text ); ?></strong>
                        </div>
                      </a>
                      <?php endif; ?>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <?php endif; ?>

          <?php if ( $show_branches ) : ?>
          <section class="cafe-branches-section py-5" id="branches" style="background-color: #fff9f3;">
            <div class="container">
              <div class="sec-heading-center text-center mb-5">
                <?php if ( ! empty( $branches_badge ) ) : ?>
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill text-danger me-1"></i> <?php echo esc_html( $branches_badge ); ?></span>
                </div>
                <?php endif; ?>
                <h2 class="sec-title mb-2">
                  <?php echo esc_html( $branches_title ); ?> 
                  <?php if ( ! empty( $branches_title_accent ) ) : ?>
                    <span class="sec-title-accent"><?php echo esc_html( $branches_title_accent ); ?></span>
                  <?php endif; ?>
                </h2>
                <?php if ( ! empty( $branches_sub ) ) : ?>
                <div class="sec-description"><?php echo esc_html( $branches_sub ); ?></div>
                <?php endif; ?>
              </div>

              <?php if ( ! empty( $region_filters ) ) : ?>
              <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
                <button class="branch-filter-btn active" data-branch-filter="all">All Locations (<?php echo count( $branches_detailed ); ?>)</button>
                <?php foreach ( $region_filters as $rf ) : ?>
                  <button class="branch-filter-btn" data-branch-filter="<?php echo esc_attr( sanitize_title( $rf ) ); ?>"><?php echo esc_html( $rf ); ?></button>
                <?php endforeach; ?>
              </div>
              <?php endif; ?>

              <div class="row g-4" id="branchesGrid">
                <?php foreach ( $branches_detailed as $idx => $b ) :
                    $b_region = sanitize_title( ! empty( $b['district'] ) ? $b['district'] : ( ! empty( $b['division'] ) ? $b['division'] : 'dhaka' ) );
                    $map_url = ! empty( $b['map_location'] ) ? $b['map_location'] : ( ( ! empty( $b['lat'] ) && ! empty( $b['long'] ) ) ? 'https://www.google.com/maps?q=' . $b['lat'] . ',' . $b['long'] : 'https://maps.google.com/?q=' . urlencode( ( $b['name'] ?? '' ) . ' ' . ( $b['address'] ?? '' ) ) );
                    $phone_clean = preg_replace( '/[^0-9+]/', '', $b['phone'] ?? '' );
                    $card_img = santino_img( 'imgi_26_santino_-_250522-07312.jpg' );
                    if ( $idx === 0 ) {
                        $card_img = santino_img( 'banner-signature-lattes.jpg' );
                    } elseif ( $idx % 2 === 0 ) {
                        $card_img = santino_img( 'imgi_27_santino_-_250522-07216.jpg' );
                    }
                ?>
                <div class="col-lg-4 col-md-6 branch-item-col" data-region="<?php echo esc_attr( $b_region ); ?>">
                  <div class="branch-card">
                    <div class="branch-card-img" style="background-image: url('<?php echo esc_url( $card_img ); ?>');">
                      <span class="branch-tag-badge"><?php echo esc_html( ! empty( $b['division'] ) ? strtoupper( $b['division'] ) : 'EXPERIENCE HUB' ); ?></span>
                    </div>
                    <div class="branch-card-body">
                      <h3 class="branch-title"><?php echo esc_html( $b['name'] ?? '' ); ?></h3>
                      <p class="text-muted small mb-3"><?php echo esc_html( ! empty( $b['district'] ) ? ( $b['district'] . ', ' . ( $b['division'] ?? 'Bangladesh' ) ) : 'Artisan espresso bar & fresh bakery treats.' ); ?></p>
                      
                      <?php if ( ! empty( $b['address'] ) ) : ?>
                      <div class="info-line small text-muted mb-2"><i class="bi bi-geo-alt text-teal me-1"></i> <?php echo esc_html( $b['address'] ); ?></div>
                      <?php endif; ?>
                      <?php if ( ! empty( $b['lat'] ) && ! empty( $b['long'] ) ) : ?>
                      <div class="info-line small text-muted mb-2"><i class="bi bi-compass text-teal me-1"></i> GPS: <?php echo esc_html( $b['lat'] ); ?>, <?php echo esc_html( $b['long'] ); ?></div>
                      <?php endif; ?>

                      <?php if ( ! empty( $branch_map_btn_text ) || ( ! empty( $branch_call_btn_text ) && ! empty( $phone_clean ) ) ) : ?>
                      <div class="d-flex gap-2 mt-3 pt-2 border-top">
                        <?php if ( ! empty( $branch_map_btn_text ) ) : ?>
                        <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" class="btn-hero-outline flex-fill text-dark" style="height: 38px; min-height: 38px; font-size: 11px; border-color: #d5e5e0 !important; color: #334155 !important;">
                          <i class="bi bi-map-fill me-1 text-danger"></i> <?php echo esc_html( $branch_map_btn_text ); ?>
                        </a>
                        <?php endif; ?>
                        <?php if ( ! empty( $branch_call_btn_text ) && ! empty( $phone_clean ) ) : ?>
                        <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="btn-hero-lifestyle flex-fill" style="height: 38px; min-height: 38px; font-size: 11px;">
                          <i class="bi bi-telephone-fill me-1"></i> <?php echo esc_html( $branch_call_btn_text ); ?>
                        </a>
                        <?php endif; ?>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </section>
          <?php endif; ?>
        </div>
        <?php
    }
}
