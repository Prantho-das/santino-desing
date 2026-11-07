<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Member_Portal_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_member_portal';
    }

    public function get_title() {
        return esc_html__( 'Santino: [Legacy Single Widget] All Sections & Portal', 'santino' );
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        // 1. HERO BANNER CONTROLS
        $this->start_controls_section(
            'section_hero',
            array(
                'label' => esc_html__( 'Hero Banner Section', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_hero',
            array(
                'label'        => esc_html__( 'Show Hero Banner', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'hero_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SANTINO VIP MEMBER PORTAL',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Santino Member Club & Rewards',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Track your 5-cup coffee stamps, upload cafe invoices, and claim your free 6th handcrafted cup across Santino partner cafes.',
            )
        );

        $this->add_control(
            'hero_bg_image',
            array(
                'label'   => esc_html__( 'Hero Background Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => '',
                ),
            )
        );

        $this->add_control(
            'hero_btn1_text',
            array(
                'label'   => esc_html__( 'Button 1 Text (Check Stamps)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Check Stamp Card',
            )
        );

        $this->add_control(
            'hero_btn1_url',
            array(
                'label'   => esc_html__( 'Button 1 Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '#clubPortal',
                ),
            )
        );

        $this->add_control(
            'hero_btn2_text',
            array(
                'label'   => esc_html__( 'Button 2 Text (Log Invoice)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Log Invoice Memo',
            )
        );

        $this->add_control(
            'hero_btn2_url',
            array(
                'label'   => esc_html__( 'Button 2 Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '#invoice-tab',
                ),
            )
        );

        $this->end_controls_section();

        // 2. PORTAL HEADER & CARD CONTROLS
        $this->start_controls_section(
            'section_portal_details',
            array(
                'label' => esc_html__( 'Portal Section Header & VIP Card', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'portal_badge',
            array(
                'label'   => esc_html__( 'Portal Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'VIP LOYALTY REWARDS',
            )
        );

        $this->add_control(
            'portal_title',
            array(
                'label'   => esc_html__( 'Portal Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Digital Coffee Stamp Card & Club Portal',
            )
        );

        $this->add_control(
            'portal_desc',
            array(
                'label'   => esc_html__( 'Portal Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!',
            )
        );

        $this->add_control(
            'card_tier_label',
            array(
                'label'   => esc_html__( 'Card Member Tier', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Regular Member',
            )
        );

        $this->add_control(
            'card_promo_badge',
            array(
                'label'   => esc_html__( 'Stamp Card Promo Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BUY 5, GET 1 FREE',
            )
        );

        $this->add_control(
            'tab1_title',
            array(
                'label'   => esc_html__( 'Tab 1 Heading', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Check Your Live Stamp Progress',
            )
        );
        $this->add_control(
            'tab1_desc',
            array(
                'label'   => esc_html__( 'Tab 1 Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Enter your Registered Phone Number or Member ID below.',
            )
        );

        $this->add_control(
            'tab2_title',
            array(
                'label'   => esc_html__( 'Tab 2 Heading', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Log Cafe Invoice / Memo Number',
            )
        );
        $this->add_control(
            'tab2_desc',
            array(
                'label'   => esc_html__( 'Tab 2 Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Submit your receipt details. Each approved cup credits your 5-cup stamp progress.',
            )
        );

        $this->add_control(
            'tab3_title',
            array(
                'label'   => esc_html__( 'Tab 3 Heading', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Santino Regular Member Enrollment',
            )
        );
        $this->add_control(
            'tab3_desc',
            array(
                'label'   => esc_html__( 'Tab 3 Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Complete 5 cups of handcrafted coffee across Dhaka branches to enjoy your 6th cup free.',
            )
        );

        $this->end_controls_section();

        // 3. BOTTOM CTA SECTION
        $this->start_controls_section(
            'section_bottom_cta',
            array(
                'label' => esc_html__( 'Bottom CTA (Visit Cafes)', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_bottom_cta',
            array(
                'label'        => esc_html__( 'Show Bottom CTA Section', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'cta_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'VISIT OUR CAFES',
            )
        );

        $this->add_control(
            'cta_title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Taste The',
            )
        );

        $this->add_control(
            'cta_title_accent',
            array(
                'label'   => esc_html__( 'Title Accent', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Santino Difference',
            )
        );

        $this->add_control(
            'cta_desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Discover our signature handcrafted beverages, artisanal roasts, and modern cafe ambiance across Dhaka.',
            )
        );

        $this->add_control(
            'cta_btn_text',
            array(
                'label'       => esc_html__( 'Button Text (Blank to Hide)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Explore Drinks Menu',
                'description' => esc_html__( 'Leave blank if you want to hide this button completely.', 'santino' ),
            )
        );

        $this->add_control(
            'cta_btn_url',
            array(
                'label'   => esc_html__( 'Button URL', 'santino' ),
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

        $show_hero   = ( $settings['show_hero'] ?? 'yes' ) === 'yes';
        $hero_bg_url = '';
        if ( ! empty( $settings['hero_bg_image']['url'] ) ) {
            $hero_bg_url = $settings['hero_bg_image']['url'];
        } elseif ( function_exists( 'santino_get_page_banner' ) ) {
            $hero_bg_url = santino_get_page_banner( 'santino-member', 'imgi_20_santino_-_250522-07574.jpg' );
        }
        if ( empty( $hero_bg_url ) && function_exists( 'santino_img' ) ) {
            $hero_bg_url = santino_img( 'imgi_20_santino_-_250522-07574.jpg' );
        }
        if ( $hero_bg_url ) {
            $hero_bg_url = set_url_scheme( $hero_bg_url );
        }

        $hero_badge  = ! empty( $settings['hero_badge'] ) ? $settings['hero_badge'] : 'SANTINO VIP MEMBER PORTAL';
        $hero_title  = ! empty( $settings['hero_title'] ) ? $settings['hero_title'] : 'Santino Member Club &amp; Rewards';
        $hero_desc   = ! empty( $settings['hero_desc'] ) ? $settings['hero_desc'] : 'Track your 5-cup coffee stamps, upload cafe invoices, and claim your free 6th handcrafted cup across Santino partner cafes.';

        $btn1_text   = isset( $settings['hero_btn1_text'] ) ? trim( (string) $settings['hero_btn1_text'] ) : '';
        $btn1_url    = ! empty( $settings['hero_btn1_url']['url'] ) ? $settings['hero_btn1_url']['url'] : '#clubPortal';
        $btn2_text   = isset( $settings['hero_btn2_text'] ) ? trim( (string) $settings['hero_btn2_text'] ) : '';
        $btn2_url    = ! empty( $settings['hero_btn2_url']['url'] ) ? $settings['hero_btn2_url']['url'] : '#invoice-tab';

        $portal_badge = $settings['portal_badge'] ?: 'VIP LOYALTY REWARDS';
        $portal_title = $settings['portal_title'] ?: 'Digital Coffee Stamp Card & Club Portal';
        $portal_desc  = $settings['portal_desc'] ?: 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!';
        $card_tier    = $settings['card_tier_label'] ?: 'Regular Member';
        $card_promo   = $settings['card_promo_badge'] ?: 'BUY 5, GET 1 FREE';
        ?>

        <style>
        .standalone-portal-page,
        .standalone-portal-section {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
        }

        .sec-title,
        .font-heading,
        .sec-pill-badge,
        .portal-tabs .nav-link,
        .btn-portal-submit,
        .vip-card-surface h4,
        .vip-card-surface .badge,
        .btn-hero-lifestyle,
        .btn-hero-outline {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          letter-spacing: -0.3px;
        }

        .sec-title {
          font-size: clamp(2rem, 3.5vw, 2.8rem) !important;
          font-weight: 900 !important;
          color: #111111 !important;
          letter-spacing: -0.5px !important;
        }

        .sec-pill-badge-wrap {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: 12px;
        }
        .sec-pill-line {
          display: inline-block;
          width: 24px;
          height: 2px;
          background: #c3996c;
        }
        .sec-pill-badge {
          display: inline-block;
          padding: 4px 14px;
          border-radius: 50px;
          background: rgba(0, 98, 93, 0.08);
          color: #00625d;
          font-size: 0.78rem;
          font-weight: 800;
          letter-spacing: 1px;
          text-transform: uppercase;
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

        .standalone-portal-section {
          background: #fdfbf7;
          padding: 60px 0 90px;
          position: relative;
          overflow: hidden;
        }

        .vip-card-surface {
          background: radial-gradient(circle at 80% 20%, #005c56 0%, #071d1b 60%, #04100e 100%);
          border-radius: 24px;
          padding: 32px 28px;
          color: #ffffff;
          position: relative;
          overflow: hidden;
          box-shadow: 0 20px 45px rgba(0, 38, 35, 0.22);
          border: 1px solid rgba(195, 153, 108, 0.35);
        }

        .vip-card-watermark {
          position: absolute;
          right: -20px;
          bottom: -30px;
          font-size: 160px;
          color: rgba(255, 255, 255, 0.03);
          pointer-events: none;
          z-index: 1;
        }

        .gold-chip {
          width: 44px;
          height: 32px;
          border-radius: 6px;
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
          box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.6), 0 2px 6px rgba(0,0,0,0.3);
        }

        .stamp-slot {
          width: 42px;
          height: 42px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 15px;
          font-weight: 700;
          margin: 0 auto;
          transition: all 0.3s ease;
        }

        .stamp-slot.active {
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
          color: #041a18;
          box-shadow: 0 0 14px rgba(223, 190, 141, 0.45);
          border: 2px solid #ffffff;
        }

        .stamp-slot.empty {
          background: rgba(0, 98, 93, 0.25);
          border: 2px dashed rgba(195, 153, 108, 0.35);
          color: rgba(255, 255, 255, 0.4);
        }

        .stamp-slot.reward {
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
          color: #002d2b;
          border: 2px solid #ffffff;
          animation: pulse-reward 2s infinite ease-in-out;
        }

        @keyframes pulse-reward {
          0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(223, 190, 141, 0.7); }
          50% { transform: scale(1.08); box-shadow: 0 0 16px 4px rgba(223, 190, 141, 0.85); }
        }

        .portal-card {
          background: #ffffff;
          border-radius: 24px;
          box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
          border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .portal-tabs .nav-link {
          border-radius: 50px !important;
          padding: 10px 20px !important;
          font-size: 13.5px !important;
          font-weight: 700 !important;
          color: #4a5568 !important;
          background: #f1f5f9 !important;
          border: 1px solid transparent !important;
          transition: all 0.25s ease !important;
        }

        .portal-tabs .nav-link:hover {
          background: #e2e8f0 !important;
          color: #1a202c !important;
        }

        .portal-tabs .nav-link.active {
          background: var(--santino-teal, #00625d) !important;
          color: #ffffff !important;
          box-shadow: 0 6px 18px rgba(0, 98, 93, 0.28) !important;
        }

        .portal-lookup-group {
          display: flex !important;
          align-items: center !important;
          background: #ffffff !important;
          border: 2px solid #00625d !important;
          border-radius: 60px !important;
          padding: 6px 8px 6px 18px !important;
          box-shadow: 0 8px 24px rgba(0, 98, 93, 0.08) !important;
          gap: 10px !important;
          width: 100% !important;
        }

        .portal-lookup-field {
          display: flex !important;
          align-items: center !important;
          gap: 12px !important;
          flex: 1 1 auto !important;
        }

        .portal-lookup-field input {
          border: none !important;
          outline: none !important;
          box-shadow: none !important;
          background: transparent !important;
          font-size: 15px !important;
          font-weight: 600 !important;
          width: 100% !important;
          color: #1a2b28 !important;
          padding: 8px 0 !important;
        }

        .btn-lookup-action {
          background: var(--santino-teal, #00625d) !important;
          color: #ffffff !important;
          border: none !important;
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          font-weight: 700 !important;
          font-size: 13px !important;
          letter-spacing: 0.6px !important;
          text-transform: uppercase !important;
          padding: 10px 24px !important;
          border-radius: 50px !important;
          min-height: 40px !important;
          display: inline-flex !important;
          align-items: center !important;
          justify-content: center !important;
          gap: 8px !important;
          cursor: pointer !important;
          box-shadow: 0 4px 14px rgba(0, 98, 93, 0.25) !important;
          transition: all 0.25s ease !important;
          white-space: nowrap !important;
          flex-shrink: 0 !important;
        }

        .btn-lookup-action:hover {
          background: #004d49 !important;
          color: #ffffff !important;
          transform: translateY(-1px) !important;
          box-shadow: 0 8px 20px rgba(0, 98, 93, 0.35) !important;
        }

        .btn-portal-submit {
          background: linear-gradient(135deg, #00625d 0%, #00423e 100%);
          color: #ffffff !important;
          border: none;
          border-radius: 12px;
          padding: 14px 24px;
          font-weight: 800;
          letter-spacing: 0.5px;
          font-size: 14px;
          box-shadow: 0 8px 20px rgba(0, 98, 93, 0.25);
          transition: all 0.3s ease;
        }

        .btn-portal-submit:hover {
          background: #003330;
          color: #ffffff !important;
          transform: translateY(-2px);
          box-shadow: 0 12px 28px rgba(0, 98, 93, 0.35);
        }

        .floating-bg-icons {
          position: absolute !important;
          top: 0 !important;
          left: 0 !important;
          width: 100% !important;
          height: 100% !important;
          pointer-events: none !important;
          overflow: hidden !important;
          z-index: 1 !important;
        }

        .float-item {
          position: absolute !important;
          color: var(--santino-teal, #00625d) !important;
          opacity: 0.16 !important;
          filter: drop-shadow(0 6px 16px rgba(0, 98, 93, 0.15)) !important;
          display: flex !important;
          align-items: center !important;
          justify-content: center !important;
        }
        .float-item-1 { top: 5% !important; left: 2% !important; width: 68px !important; height: 68px !important; }
        .float-item-2 { top: 12% !important; right: 4% !important; width: 76px !important; height: 76px !important; }
        .float-item-3 { top: 42% !important; left: 4% !important; width: 56px !important; height: 56px !important; }
        .float-item-4 { top: 68% !important; right: 3% !important; width: 80px !important; height: 80px !important; }
        .float-item-5 { bottom: 8% !important; left: 14% !important; width: 72px !important; height: 72px !important; }
        .float-item-6 { top: 6% !important; left: 42% !important; width: 54px !important; height: 54px !important; }
        </style>

        <div class="standalone-portal-page">
          <?php if ( $show_hero ) : ?>
          <!-- HERO BANNER SECTION -->
          <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>'); background-position: center; background-size: cover; min-height: 56vh; display: flex; align-items: center; justify-content: center; padding: 85px 20px;">
            <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0, 38, 35, 0.72) 100%); z-index: 1;"></div>
            
            <div class="container position-relative" style="max-width: 840px; z-index: 2;">
              <div class="sec-pill-badge-wrap light mb-3">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge" style="background: rgba(223, 190, 141, 0.2); color: #dfbe8d; border: 1px solid rgba(223, 190, 141, 0.35);"><i class="bi bi-gem me-1 text-warning"></i> <?php echo wp_kses_post( $hero_badge ); ?></span>
                <span class="sec-pill-line"></span>
              </div>

              <h1 class="pro-banner-title mb-3" style="font-family: var(--kp-font-title, 'Montserrat', sans-serif); font-size: clamp(2.3rem, 4.5vw, 3.6rem); font-weight: 900; line-height: 1.18; letter-spacing: -0.5px; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
                <?php echo wp_kses_post( $hero_title ); ?>
              </h1>

              <p class="pro-banner-desc mb-4" style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); max-width: 640px; font-size: 1.08rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.4);">
                <?php echo wp_kses_post( $hero_desc ); ?>
              </p>

              <?php if ( ! empty( $btn1_text ) || ! empty( $btn2_text ) ) : ?>
              <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
                <?php if ( ! empty( $btn1_text ) ) : ?>
                <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-hero-lifestyle">
                  <span><?php echo esc_html( $btn1_text ); ?></span>
                  <i class="bi bi-arrow-right"></i>
                </a>
                <?php endif; ?>
                <?php if ( ! empty( $btn2_text ) ) : ?>
                <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-hero-outline">
                  <i class="bi bi-receipt-cutoff text-warning"></i>
                  <span><?php echo esc_html( $btn2_text ); ?></span>
                </a>
                <?php endif; ?>
              </div>
              <?php endif; ?>
            </div>
          </section>
          <?php endif; ?>

          <!-- 2-COLUMN VIP LOYALTY PORTAL SECTION -->
          <div id="stamps"></div>
          <section class="standalone-portal-section position-relative overflow-hidden" id="clubPortal">
            <!-- Floating Background Icons -->
            <div class="floating-bg-icons" aria-hidden="true">
              <div class="float-item float-item-1"><i class="bi bi-cup-hot-fill fs-2"></i></div>
              <div class="float-item float-item-2"><i class="bi bi-stars fs-2"></i></div>
              <div class="float-item float-item-3"><i class="bi bi-cup-straw fs-2"></i></div>
              <div class="float-item float-item-4"><i class="bi bi-droplet-fill fs-2"></i></div>
              <div class="float-item float-item-5"><i class="bi bi-patch-check-fill fs-2"></i></div>
              <div class="float-item float-item-6"><i class="bi bi-gift-fill fs-2"></i></div>
            </div>

            <div class="container py-lg-4">
              <!-- Section Header -->
              <div class="text-center max-w-700 mx-auto mb-5">
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> <?php echo esc_html( $portal_badge ); ?></span>
                  <span class="sec-pill-line"></span>
                </div>
                <h2 class="sec-title mb-2"><?php echo esc_html( $portal_title ); ?></h2>
                <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">
                  <?php echo esc_html( $portal_desc ); ?>
                </p>
              </div>

              <div class="row g-4 align-items-start justify-content-center">
                <!-- LEFT COLUMN: Stamp Card Display -->
                <div class="col-lg-5">
                  <div class="d-flex flex-column gap-3">
                    <!-- Luxury Gold/Teal Card -->
                    <div class="vip-card-surface">
                      <i class="bi bi-cup-hot vip-card-watermark"></i>
                      
                      <!-- Card Top Header -->
                      <div class="d-flex justify-content-between align-items-start mb-3 position-relative" style="z-index: 2;">
                        <div>
                          <div class="small fw-bold text-uppercase" style="color: #dfbe8d; letter-spacing: 1.5px; font-size: 11px;">
                            SANTINO COFFEE CLUB
                          </div>
                          <h4 class="font-heading fw-bold text-white mb-0 mt-1"><?php echo esc_html( $card_tier ); ?></h4>
                        </div>
                        <div class="gold-chip"></div>
                      </div>

                      <!-- Card ID -->
                      <div class="mb-4 position-relative" style="z-index: 2;">
                        <div class="font-monospace text-white-50 small" style="letter-spacing: 2px;">SNT-REG-•••• ••••</div>
                      </div>

                      <!-- 5-Cup Physical Stamp Grid -->
                      <div class="p-3 rounded-4 mb-3 position-relative" style="background: rgba(0, 0, 0, 0.25); border: 1px solid rgba(195, 153, 108, 0.25); z-index: 2;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                          <span class="small fw-bold" style="color: #dfbe8d; font-size: 11.5px;">5-Cup Stamp Card Tracker</span>
                          <span class="badge rounded-pill" style="background: rgba(195, 153, 108, 0.25); color: #dfbe8d; font-size: 10px;"><?php echo esc_html( $card_promo ); ?></span>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center py-2 px-1">
                          <div class="text-center">
                            <div class="stamp-slot active mb-1">☕</div>
                            <div style="font-size: 9.5px; color: #dfbe8d;">Cup 1</div>
                          </div>
                          <div class="text-center">
                            <div class="stamp-slot active mb-1">☕</div>
                            <div style="font-size: 9.5px; color: #dfbe8d;">Cup 2</div>
                          </div>
                          <div class="text-center">
                            <div class="stamp-slot empty mb-1">3</div>
                            <div class="text-white-50" style="font-size: 9.5px;">Cup 3</div>
                          </div>
                          <div class="text-center">
                            <div class="stamp-slot empty mb-1">4</div>
                            <div class="text-white-50" style="font-size: 9.5px;">Cup 4</div>
                          </div>
                          <div class="text-center">
                            <div class="stamp-slot empty mb-1">5</div>
                            <div class="text-white-50" style="font-size: 9.5px;">Cup 5</div>
                          </div>
                          <div class="text-center">
                            <div class="stamp-slot reward mb-1"><i class="bi bi-gift-fill" style="color: #002d2b; font-size: 17px;"></i></div>
                            <div style="font-size: 9.5px; color: #dfbe8d; font-weight: 700;">FREE #6</div>
                          </div>
                        </div>
                      </div>

                      <!-- Card Bottom Info -->
                      <div class="d-flex justify-content-between align-items-center text-white-50 small position-relative" style="z-index: 2; font-size: 11px;">
                        <span>Valid across all Dhaka branches</span>
                        <span style="color: #dfbe8d;"><i class="bi bi-patch-check-fill me-1"></i> Auto-Verified</span>
                      </div>
                    </div>

                    <!-- 3 Simple How It Works Steps -->
                    <div class="p-3 bg-white rounded-4 border shadow-sm">
                      <div class="row g-2 text-center">
                        <div class="col-4">
                          <div class="fs-4 text-teal mb-1" style="color: #00625d;"><i class="bi bi-cup-hot"></i></div>
                          <div class="fw-bold small text-dark">1. Sip Coffee</div>
                          <div class="text-muted" style="font-size: 10px;">At partner cafes</div>
                        </div>
                        <div class="col-4 border-start border-end">
                          <div class="fs-4 text-teal mb-1" style="color: #00625d;"><i class="bi bi-receipt"></i></div>
                          <div class="fw-bold small text-dark">2. Log Memo</div>
                          <div class="text-muted" style="font-size: 10px;">Submit invoice &amp; cups</div>
                        </div>
                        <div class="col-4">
                          <div class="fs-4 mb-1" style="color: #c3996c !important;"><i class="bi bi-gift"></i></div>
                          <div class="fw-bold small text-dark">3. Get Free Cup</div>
                          <div class="text-muted" style="font-size: 10px;">Buy 5, Get 1 Free</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- RIGHT COLUMN: Interactive Portal Form Tabs -->
                <div class="col-lg-7">
                  <div class="portal-card p-4 p-md-5 h-100 d-flex flex-column justify-content-between">
                    <!-- Navigation Pills -->
                    <ul class="nav nav-pills portal-tabs gap-2 mb-4 justify-content-start" id="loyaltyTabs" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="stamps-tab" data-bs-toggle="pill" data-bs-target="#stamps-pane" type="button" role="tab">
                          <i class="bi bi-search me-1"></i> Check Stamp Status
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="invoice-tab" data-bs-toggle="pill" data-bs-target="#invoice-pane" type="button" role="tab">
                          <i class="bi bi-receipt-cutoff me-1"></i> Log Invoice
                        </button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register-pane" type="button" role="tab">
                          <i class="bi bi-person-check-fill me-1"></i> Join Coffee Club
                        </button>
                      </li>
                    </ul>

                    <div class="tab-content flex-grow-1" id="loyaltyTabsContent">
                      <!-- TAB 1: CHECK STAMP STATUS -->
                      <div class="tab-pane fade show active" id="stamps-pane" role="tabpanel">
                        <div class="mb-4">
                          <h4 class="font-heading fw-bold text-dark mb-1"><?php echo esc_html( $settings['tab1_title'] ?? 'Check Your Live Stamp Progress' ); ?></h4>
                          <p class="text-muted small"><?php echo esc_html( $settings['tab1_desc'] ?? 'Enter your Registered Phone Number or Member ID below.' ); ?></p>
                        </div>

                        <form id="santinoLookupForm" class="mb-4">
                          <div class="portal-lookup-group">
                            <div class="portal-lookup-field">
                              <i class="bi bi-telephone" style="color: #00625d;"></i>
                              <input type="text" name="query" placeholder="e.g. 01712345678 or SNT-REG-XXXX" required>
                            </div>
                            <button type="submit" class="btn-lookup-action">
                              <span>LOOKUP</span> <i class="bi bi-arrow-right"></i>
                            </button>
                          </div>
                        </form>

                        <div id="liveStampCardContainer" style="display: none;"></div>
                      </div>

                      <!-- TAB 2: LOG INVOICE NUMBER -->
                      <div class="tab-pane fade" id="invoice-pane" role="tabpanel">
                        <div class="mb-4">
                          <h4 class="font-heading fw-bold text-dark mb-1"><?php echo esc_html( $settings['tab2_title'] ?? 'Log Cafe Invoice / Memo Number' ); ?></h4>
                          <p class="text-muted small"><?php echo esc_html( $settings['tab2_desc'] ?? 'Submit your receipt details. Each approved cup credits your 5-cup stamp progress.' ); ?></p>
                        </div>

                        <div id="invoiceResponseBox" style="display: none;" class="mb-4"></div>

                        <form id="santinoInvoiceForm" enctype="multipart/form-data">
                          <div class="row g-3 mb-3">
                            <div class="col-md-6">
                              <label class="form-label small fw-bold text-dark">Invoice / Memo Number *</label>
                              <input type="text" name="invoice_number" class="form-control" placeholder="e.g. SNT-2026-9042" required>
                            </div>
                            <div class="col-md-6">
                              <label class="form-label small fw-bold text-dark">Phone Number / WhatsApp *</label>
                              <input type="tel" name="phone" class="form-control santino-phone-validate" placeholder="017XXXXXXXX" pattern="^(?:\+?880|0)1[3-9]\d{8}$" maxlength="15" title="Please enter a valid 11-digit Bangladeshi phone number" required>
                            </div>
                          </div>

                          <!-- Dynamic Multi-Item Order Section (Compact & Mobile-First) -->
                          <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                              <label class="form-label small fw-bold text-dark mb-0">
                                <i class="bi bi-cup-hot-fill me-1" style="color: #00625d;"></i> Items Ordered / Consumed *
                              </label>
                              <span class="santino-total-cups-badge">
                                Total: <span class="santino-total-cups-count">1</span> Cup(s)/Item(s)
                              </span>
                            </div>

                            <div class="santino-order-items-container mb-2">
                              <div class="santino-order-item-row">
                                <div class="santino-row-main">
                                  <select name="order_items[]" class="santino-item-select" required>
                                    <option value="" disabled selected>-- Select Ordered Coffee / Item --</option>
                                    <?php 
                                    $ordered_items = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_order_item_choices() : array();
                                    foreach ( $ordered_items as $item_choice ) : ?>
                                      <option value="<?php echo esc_attr( $item_choice ); ?>"><?php echo esc_html( $item_choice ); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="santino-row-actions">
                                  <div class="santino-stepper-capsule">
                                    <button type="button" class="santino-stepper-btn santino-row-minus" aria-label="Decrease">−</button>
                                    <input type="text" name="order_qtys[]" class="santino-stepper-val santino-row-qty" value="1" readonly>
                                    <button type="button" class="santino-stepper-btn santino-row-plus" aria-label="Increase">+</button>
                                  </div>
                                  <button type="button" class="santino-remove-item-row d-none" title="Remove item">
                                    <i class="bi bi-trash3"></i>
                                  </button>
                                </div>
                              </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center pt-2">
                              <button type="button" class="btn santino-add-order-item-btn">
                                <i class="bi bi-plus-circle-fill"></i> Add Another Item
                              </button>
                              <div class="text-muted" style="font-size: 11px;">Specify each item &amp; quantity</div>
                            </div>

                            <input type="hidden" name="cups" class="santino-cups-input" value="1">
                            <input type="hidden" name="items_consumed" class="santino-items-consumed-summary" value="">
                          </div>

                          <div class="row g-3 mb-3">
                            <div class="col-md-12">
                              <label class="form-label small fw-bold text-dark">Cafe Branch Visited</label>
                              <select name="branch" class="form-select">
                                <?php 
                                $cafe_branches = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_cafe_branches() : array( 'Gulshan-2 Flagship Experience Center' );
                                foreach ( $cafe_branches as $b ) : ?>
                                  <option value="<?php echo esc_attr( $b ); ?>"><?php echo esc_html( $b ); ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>

                          <div class="mb-4">
                            <label class="form-label small fw-bold text-dark"><i class="bi bi-camera-fill me-1" style="color: #00625d;"></i> Upload Invoice / Memo Photo * (Mandatory)</label>
                            <input type="file" name="invoice_image" id="santinoInvoiceImage" class="form-control" accept="image/jpeg,image/png,image/webp,image/jpg" required>
                            <div class="form-text text-muted small" style="font-size: 0.78rem;">Upload photo of your physical cafe bill/memo for fast verification (JPG, PNG, WebP) - Required.</div>
                          </div>

                          <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                            Submit Invoice For Stamp Verification →
                          </button>
                        </form>
                      </div>

                      <!-- TAB 3: REGISTER FOR COFFEE CLUB -->
                      <div class="tab-pane fade" id="register-pane" role="tabpanel">
                        <div class="mb-4">
                          <h4 class="font-heading fw-bold text-dark mb-1">Register For Santino Coffee Club</h4>
                          <p class="text-muted small">Join Regular Membership to activate your 5-cup digital coffee stamp card.</p>
                        </div>

                        <div id="membershipResponseBox" style="display: none;" class="mb-4"></div>

                        <form id="santinoMembershipForm">
                          <div class="row g-3 mb-3">
                            <div class="col-md-12">
                              <label class="form-label small fw-bold text-dark">Full Name *</label>
                              <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                          </div>

                          <div class="row g-3 mb-3">
                            <div class="col-md-12">
                              <label class="form-label small fw-bold text-dark">Mobile Number: *</label>
                              <input type="tel" name="phone" id="santinoMemberPhone" class="form-control" placeholder="017XXXXXXXX" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" title="Please enter a valid Bangladeshi phone number" required>
                              <div class="form-text text-muted" style="font-size: 11px;">Same mobile number cannot be re-registered without portal permission.</div>
                            </div>
                          </div>

                          <div class="row g-3 mb-3">
                            <div class="col-md-6">
                              <label class="form-label small fw-bold text-dark">Birth Month *</label>
                              <select name="birth_month" class="form-select" required>
                                <option value="">Select Birth Month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                              </select>
                            </div>
                            <div class="col-md-6">
                              <label class="form-label small fw-bold text-dark">Birth Day *</label>
                              <select name="birth_day" class="form-select" required>
                                <option value="">Select Birth Day</option>
                                <?php for ( $d = 1; $d <= 31; $d++ ) : ?>
                                  <option value="<?php echo sprintf( '%02d', $d ); ?>"><?php echo sprintf( '%02d', $d ); ?></option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>

                          <div class="row g-3 mb-4">
                            <div class="col-md-12">
                              <label class="form-label small fw-bold text-dark">Email Address *</label>
                              <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                            </div>
                          </div>

                          <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="termsCheck" checked required>
                            <label class="form-check-label small text-muted" for="termsCheck">
                              I agree to join Santino Coffee Club Regular Membership to receive reward stamps and free cups.
                            </label>
                          </div>

                          <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                            Register For Coffee Club Regular Membership →
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <?php 
          $show_bottom_cta = ( $settings['show_bottom_cta'] ?? 'no' ) === 'yes';
          if ( $show_bottom_cta ) :
            $cta_badge  = ! empty( $settings['cta_badge'] ) ? $settings['cta_badge'] : '';
            $cta_title  = ! empty( $settings['cta_title'] ) ? $settings['cta_title'] : 'Taste The';
            $cta_accent = ! empty( $settings['cta_title_accent'] ) ? $settings['cta_title_accent'] : 'Santino Difference';
            $cta_desc   = ! empty( $settings['cta_desc'] ) ? $settings['cta_desc'] : '';
            $cta_btn    = isset( $settings['cta_btn_text'] ) ? trim( (string) $settings['cta_btn_text'] ) : '';
            $cta_url    = ! empty( $settings['cta_btn_url']['url'] ) ? $settings['cta_btn_url']['url'] : home_url( '/menu/' );
          ?>
          <section class="py-5 bg-white text-center border-top">
            <div class="container py-4" style="max-width: 700px;">
              <?php if ( ! empty( $cta_badge ) ) : ?>
              <div class="sec-pill-badge-wrap mb-2">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> <?php echo esc_html( $cta_badge ); ?></span>
                <span class="sec-pill-line"></span>
              </div>
              <?php endif; ?>
              <h2 class="sec-title mb-2">
                <?php echo esc_html( $cta_title ); ?> 
                <?php if ( ! empty( $cta_accent ) ) : ?>
                  <span class="sec-title-accent"><?php echo esc_html( $cta_accent ); ?></span>
                <?php endif; ?>
              </h2>
              <?php if ( ! empty( $cta_desc ) ) : ?>
              <p class="text-muted mb-4" style="font-size: 0.98rem; max-width: 540px; margin: 0 auto; line-height: 1.6;">
                <?php echo esc_html( $cta_desc ); ?>
              </p>
              <?php endif; ?>
              <?php if ( ! empty( $cta_btn ) ) : ?>
              <div class="d-flex justify-content-center">
                <a href="<?php echo esc_url( $cta_url ); ?>" class="btn-hero-lifestyle">
                  <span><?php echo esc_html( $cta_btn ); ?></span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
              <?php endif; ?>
            </div>
          </section>
          <?php endif; ?>
        </div>
        <?php
    }
}
