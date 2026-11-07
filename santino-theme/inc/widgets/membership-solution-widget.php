<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Membership_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_membership_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino: /membership/ All Sections & Stamps', 'santino' );
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
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
                'default' => 'SANTINO VIP COFFEE CLUB',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'       => esc_html__( 'Hero Title', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Exclusive Connoisseur <span style="color: #dfbe8d;">Privileges</span>',
                'description' => esc_html__( 'HTML tags like <span> or <br> are supported for gold highlight accent.', 'santino' ),
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Private cupping sessions, seasonal micro-lot allocations, and 15% VIP artisan bean discounts across Bangladesh.',
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
                'label'   => esc_html__( 'Primary Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Join Coffee Club',
            )
        );

        $this->add_control(
            'hero_btn1_url',
            array(
                'label'   => esc_html__( 'Primary Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '#clubPortal',
                ),
            )
        );

        $this->add_control(
            'hero_btn2_text',
            array(
                'label'   => esc_html__( 'Secondary Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Perks',
            )
        );

        $this->add_control(
            'hero_btn2_url',
            array(
                'label'   => esc_html__( 'Secondary Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array(
                    'url' => '#perks',
                ),
            )
        );

        $this->end_controls_section();

        // 2. METRICS ROW CONTROLS
        $this->start_controls_section(
            'section_metrics',
            array(
                'label' => esc_html__( 'Key Metrics Row', 'santino' ),
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

        $this->add_control(
            'metric1_num',
            array(
                'label'   => esc_html__( 'Metric 1 Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '100% Free',
            )
        );
        $this->add_control(
            'metric1_label',
            array(
                'label'   => esc_html__( 'Metric 1 Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Club Enrollment',
            )
        );

        $this->add_control(
            'metric2_num',
            array(
                'label'   => esc_html__( 'Metric 2 Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '15% Off',
            )
        );
        $this->add_control(
            'metric2_label',
            array(
                'label'   => esc_html__( 'Metric 2 Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Retail Bean Privilege',
            )
        );

        $this->add_control(
            'metric3_num',
            array(
                'label'   => esc_html__( 'Metric 3 Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Priority',
            )
        );
        $this->add_control(
            'metric3_label',
            array(
                'label'   => esc_html__( 'Metric 3 Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Private Cupping Access',
            )
        );

        $this->add_control(
            'metric4_num',
            array(
                'label'   => esc_html__( 'Metric 4 Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Monthly',
            )
        );
        $this->add_control(
            'metric4_label',
            array(
                'label'   => esc_html__( 'Metric 4 Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Exclusive Micro-Lots',
            )
        );

        $this->end_controls_section();

        // 3. PERKS & PRIVILEGES SECTION
        $this->start_controls_section(
            'section_perks',
            array(
                'label' => esc_html__( 'Perks & Privileges Section', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_perks',
            array(
                'label'        => esc_html__( 'Show Perks Cards', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
            )
        );

        $this->add_control(
            'perks_badge',
            array(
                'label'   => esc_html__( 'Perks Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'MEMBER PRIVILEGES',
            )
        );

        $this->add_control(
            'perks_title',
            array(
                'label'   => esc_html__( 'Perks Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Crafted Exclusively For Coffee Lovers',
            )
        );

        $this->add_control(
            'perks_desc',
            array(
                'label'   => esc_html__( 'Perks Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Elevate every cup with exclusive roastery privileges, private sensory workshops, and member-only pricing.',
            )
        );

        // 6 Perks Controls
        $perk_defaults = array(
            1 => array( 'tag' => 'VIP ALLOCATION', 'title' => 'Priority Micro-Lot Reserves', 'desc' => 'Exclusive 48-hour advance access to rare competition harvests, Geisha lots, and anaerobic micro-batches before public store launch.', 'foot1' => 'Limited Batches', 'foot2' => 'First Access' ),
            2 => array( 'tag' => 'SCA • WBC LAB', 'title' => 'Private Cupping Masterclasses', 'desc' => 'Invitations to sensory cupping workshops and origin taste profiling led by certified SCA and WBC barista trainers at our Tejgaon roastery lab.', 'foot1' => 'Tejgaon Roastery', 'foot2' => 'Free Passes' ),
            3 => array( 'tag' => '15% OFF BEANS', 'title' => 'Artisan Roasted Beans Discount', 'desc' => 'Enjoy a permanent 15% VIP member privilege on all 250g and 1kg bags of freshly roasted single-origin coffees and signature espresso blends.', 'foot1' => '250g & 1kg Bags', 'foot2' => 'Year-Round' ),
            4 => array( 'tag' => 'ANNUAL GIFT', 'title' => 'Birthday Month Signature Treat', 'desc' => 'Celebrate your special month with a complimentary handcrafted artisanal drink or single-origin pour-over at any Santino flagship cafe.', 'foot1' => 'Any Branch', 'foot2' => '100% On Us' ),
            5 => array( 'tag' => 'TECH CARE', 'title' => 'Barista Dial-In & Gear Support', 'desc' => 'Direct access to our technicians for home espresso grinder calibration, brew ratio optimization, and equipment maintenance consultations.', 'foot1' => 'Expert Baristas', 'foot2' => 'Consultations' ),
            6 => array( 'tag' => 'ZERO WAIT', 'title' => 'Express WhatsApp Order-Ahead', 'desc' => 'Skip peak morning lines at Gulshan, Banani, and Tejgaon branches with priority WhatsApp beverage pre-ordering and table reserve.', 'foot1' => 'Priority Line', 'foot2' => 'Express Queue' ),
        );

        for ( $p = 1; $p <= 6; $p++ ) {
            $this->add_control(
                'perk' . $p . '_tag',
                array(
                    'label'   => esc_html__( "Perk $p Tag", 'santino' ),
                    'type'    => \Elementor\Controls_Manager::TEXT,
                    'default' => $perk_defaults[ $p ]['tag'],
                )
            );
            $this->add_control(
                'perk' . $p . '_title',
                array(
                    'label'   => esc_html__( "Perk $p Title", 'santino' ),
                    'type'    => \Elementor\Controls_Manager::TEXT,
                    'default' => $perk_defaults[ $p ]['title'],
                )
            );
            $this->add_control(
                'perk' . $p . '_desc',
                array(
                    'label'   => esc_html__( "Perk $p Description", 'santino' ),
                    'type'    => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => $perk_defaults[ $p ]['desc'],
                )
            );
        }

        $this->end_controls_section();

        // 4. PORTAL SECTION CONTROLS
        $this->start_controls_section(
            'section_portal',
            array(
                'label' => esc_html__( 'VIP Club Portal Section', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_portal',
            array(
                'label'        => esc_html__( 'Show VIP Club Portal Section', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'return_value' => 'yes',
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
                'default' => 'Enter your Registered Phone Number or Regular Member ID below.',
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
                'default' => 'Submit your receipt details. Cups will be credited to your stamp card upon portal verification.',
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

        // 5. BOTTOM CTA SECTION
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
                'default'      => 'yes',
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
        ?>
        <style>
        .membership-page-wrap, 
        .pro-banner-hero, 
        .perks-section, 
        .club-portal-section,
        #perks,
        #clubPortal {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
        }
        .pro-banner-title,
        .sec-title,
        .perk-title,
        .font-heading,
        h1, h2, h3, h4, h5, h6,
        .sec-pill-badge,
        .portal-tabs .nav-link,
        .btn,
        .btn-portal-submit,
        .btn-hero-lifestyle,
        .btn-hero-outline,
        .vip-card-surface h4,
        .vip-card-surface .badge,
        .perk-pill-tag {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          letter-spacing: -0.3px;
        }
        .sec-title {
          font-size: clamp(2rem, 3.5vw, 2.8rem) !important;
          font-weight: 900 !important;
          color: #111111 !important;
          letter-spacing: -0.5px !important;
        }
        .sec-title-accent,
        .menu-title-highlight {
          color: var(--santino-teal, #00625d) !important;
        }
        .sec-pill-badge {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          font-weight: 800 !important;
          letter-spacing: 1px !important;
          font-size: 0.78rem !important;
        }
        p, .pro-banner-desc, .perk-desc, .text-muted, label, input, select, textarea {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif) !important;
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
          will-change: transform !important;
          display: flex !important;
          align-items: center !important;
          justify-content: center !important;
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
        .perks-section {
          background: #ffffff;
          position: relative;
        }
        .perk-card-luxury {
          background: #ffffff;
          border: 1.5px solid #e8f0ed;
          border-radius: 22px;
          padding: 32px 28px;
          height: 100%;
          position: relative;
          overflow: hidden;
          transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
          box-shadow: 0 8px 24px rgba(0, 77, 73, 0.04);
          display: flex;
          flex-direction: column;
          justify-content: space-between;
        }
        .perk-card-luxury:hover {
          transform: translateY(-8px);
          border-color: rgba(195, 153, 108, 0.5);
          box-shadow: 0 20px 40px rgba(0, 77, 73, 0.1);
        }
        .perk-icon-wrap {
          width: 58px;
          height: 58px;
          border-radius: 16px;
          background: linear-gradient(135deg, rgba(0, 98, 93, 0.08) 0%, rgba(195, 153, 108, 0.15) 100%);
          border: 1px solid rgba(195, 153, 108, 0.25);
          display: inline-flex;
          align-items: center;
          justify-content: center;
          font-size: 26px;
          color: #00625d;
          margin-bottom: 20px;
        }
        .perk-pill-tag {
          font-size: 10.5px;
          font-weight: 700;
          letter-spacing: 1px;
          text-transform: uppercase;
          padding: 4px 10px;
          border-radius: 20px;
          background: #f0f6f4;
          color: #00625d;
          border: 1px solid #d5e5e1;
        }
        .perk-title {
          font-size: 1.25rem;
          font-weight: 800;
          color: #12211e;
          margin-bottom: 10px;
        }
        .perk-desc {
          font-size: 0.92rem;
          color: #5c706d;
          line-height: 1.65;
          margin-bottom: 0;
        }
        .club-portal-section {
          background: linear-gradient(180deg, #f8faf9 0%, #edf3f1 100%);
          position: relative;
        }
        .vip-card-surface {
          background: linear-gradient(135deg, #004d49 0%, #002d2b 60%, #011d1c 100%);
          border: 1px solid rgba(195, 153, 108, 0.4);
          border-radius: 20px;
          color: #ffffff;
          padding: 28px;
          position: relative;
          overflow: hidden;
          box-shadow: 0 20px 40px rgba(0, 77, 73, 0.22);
        }
        .gold-chip {
          width: 42px;
          height: 32px;
          border-radius: 6px;
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 50%, #b88a59 100%);
          border: 1px solid rgba(255,255,255,0.4);
          display: inline-block;
        }
        .stamp-slot {
          width: 48px;
          height: 48px;
          border-radius: 50%;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          font-size: 20px;
        }
        .stamp-slot.active {
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
          color: #002d2b;
          border: 2px solid #ffffff;
        }
        .stamp-slot.empty {
          background: rgba(255, 255, 255, 0.08);
          border: 1.5px dashed rgba(195, 153, 108, 0.4);
          color: rgba(255, 255, 255, 0.4);
          font-size: 14px;
          font-weight: 700;
        }
        .stamp-slot.reward {
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
          border: 2px solid #ffffff;
        }
        .portal-tabs .nav-link {
          color: #4b6360;
          background: #ffffff;
          border: 1px solid #dbe5e2;
          border-radius: 12px;
          padding: 10px 18px;
          font-weight: 700;
          font-size: 13.5px;
        }
        .portal-tabs .nav-link.active {
          background: #00625d !important;
          color: #ffffff !important;
          border-color: #00625d !important;
        }
        .portal-card {
          background: #ffffff;
          border: 1px solid #dbe5e2;
          border-radius: 20px;
          box-shadow: 0 15px 35px rgba(0, 77, 73, 0.06);
        }
        .btn-portal-submit {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          border: none;
          border-radius: 10px;
          font-weight: 700;
          letter-spacing: 0.5px;
          padding: 14px 24px;
        }
        .btn-portal-submit:hover {
          background: #004d49;
          color: #ffffff;
        }
        .portal-lookup-group {
          background: #ffffff;
          border-radius: 50px;
          padding: 6px 8px 6px 20px;
          display: flex;
          align-items: center;
          gap: 12px;
          border: 1.5px solid #d8e5e1;
        }
        .portal-lookup-field {
          flex: 1;
          display: flex;
          align-items: center;
          gap: 10px;
        }
        .portal-lookup-field input {
          border: none;
          outline: none;
          width: 100%;
          font-size: 0.95rem;
          color: #333;
          background: transparent;
        }
        .btn-lookup-action {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          border: none;
          padding: 10px 22px;
          border-radius: 50px;
          font-weight: 700;
          font-size: 12px;
          letter-spacing: 0.5px;
          text-transform: uppercase;
          display: inline-flex;
          align-items: center;
          gap: 6px;
          cursor: pointer;
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
        </style>

        <?php
        $hero_bg_url = '';
        if ( ! empty( $settings['hero_bg_image']['url'] ) ) {
            $hero_bg_url = $settings['hero_bg_image']['url'];
        } elseif ( function_exists( 'santino_get_page_banner' ) ) {
            $hero_bg_url = santino_get_page_banner( 'membership', 'imgi_20_santino_-_250522-07574.jpg' );
        }
        if ( empty( $hero_bg_url ) && function_exists( 'santino_img' ) ) {
            $hero_bg_url = santino_img( 'imgi_20_santino_-_250522-07574.jpg' );
        }
        if ( $hero_bg_url ) {
            $hero_bg_url = set_url_scheme( $hero_bg_url );
        }

        $hero_badge  = isset( $settings['hero_badge'] ) ? trim( (string) $settings['hero_badge'] ) : '';
        $hero_title  = isset( $settings['hero_title'] ) ? trim( (string) $settings['hero_title'] ) : '';
        $hero_desc   = isset( $settings['hero_desc'] ) ? trim( (string) $settings['hero_desc'] ) : '';
        $btn1_text   = isset( $settings['hero_btn1_text'] ) ? trim( (string) $settings['hero_btn1_text'] ) : '';
        $btn1_url    = ! empty( $settings['hero_btn1_url']['url'] ) ? $settings['hero_btn1_url']['url'] : '#clubPortal';
        $btn2_text   = isset( $settings['hero_btn2_text'] ) ? trim( (string) $settings['hero_btn2_text'] ) : '';
        $btn2_url    = ! empty( $settings['hero_btn2_url']['url'] ) ? $settings['hero_btn2_url']['url'] : '#perks';
        $show_hero   = ( $settings['show_hero'] ?? 'yes' ) === 'yes';
        $show_metrics = ( $settings['show_metrics'] ?? 'yes' ) === 'yes';
        ?>

        <div class="membership-page-wrap">
          <?php if ( $show_hero && ( $hero_badge !== '' || $hero_title !== '' || $hero_desc !== '' || $btn1_text !== '' || $btn2_text !== '' || $hero_bg_url !== '' ) ) : ?>
          <section class="pro-banner-hero position-relative overflow-hidden text-center" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>'); background-position: center; background-size: cover; min-height: 56vh; display: flex; align-items: center; justify-content: center; padding: 80px 20px;">
            <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.35) 0%, rgba(0, 38, 35, 0.7) 100%); z-index: 1;"></div>
            
            <div class="container position-relative" style="max-width: 820px; z-index: 2;">
              <?php if ( $hero_badge !== '' ) : ?>
              <div class="sec-pill-badge-wrap light mb-3">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge"><i class="bi bi-gem me-1 text-warning"></i> <?php echo wp_kses_post( $hero_badge ); ?></span>
                <span class="sec-pill-line"></span>
              </div>
              <?php endif; ?>

              <?php if ( $hero_title !== '' ) : ?>
              <h1 class="pro-banner-title mb-3" style="font-family: var(--kp-font-title, 'Montserrat', sans-serif); font-size: clamp(2.3rem, 4.5vw, 3.6rem); font-weight: 900; line-height: 1.18; letter-spacing: -0.5px; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
                <?php echo wp_kses_post( $hero_title ); ?>
              </h1>
              <?php endif; ?>

              <?php if ( $hero_desc !== '' ) : ?>
              <p class="pro-banner-desc mb-4" style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); max-width: 640px; font-size: 1.08rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.4);">
                <?php echo wp_kses_post( $hero_desc ); ?>
              </p>
              <?php endif; ?>

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
                  <i class="bi bi-arrow-down-short text-warning"></i>
                  <span><?php echo esc_html( $btn2_text ); ?></span>
                </a>
                <?php endif; ?>
              </div>
              <?php endif; ?>
            </div>
          </section>
          <?php endif; ?>

          <?php if ( $show_metrics ) : ?>
          <div class="story-metrics-floating-wrap">
            <div class="container">
              <div class="row g-3 g-md-4 text-center justify-content-center">
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-stars"></i></div>
                    <div class="metric-num"><?php echo esc_html( $settings['metric1_num'] ?? '100% Free' ); ?></div>
                    <div class="metric-label"><?php echo esc_html( $settings['metric1_label'] ?? 'Club Enrollment' ); ?></div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-percent"></i></div>
                    <div class="metric-num"><?php echo esc_html( $settings['metric2_num'] ?? '15% Off' ); ?></div>
                    <div class="metric-label"><?php echo esc_html( $settings['metric2_label'] ?? 'Retail Bean Privilege' ); ?></div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-cup-hot-fill"></i></div>
                    <div class="metric-num"><?php echo esc_html( $settings['metric3_num'] ?? 'Priority' ); ?></div>
                    <div class="metric-label"><?php echo esc_html( $settings['metric3_label'] ?? 'Private Cupping Access' ); ?></div>
                  </div>
                </div>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="bi bi-calendar-heart-fill"></i></div>
                    <div class="metric-num"><?php echo esc_html( $settings['metric4_num'] ?? 'Monthly' ); ?></div>
                    <div class="metric-label"><?php echo esc_html( $settings['metric4_label'] ?? 'Exclusive Micro-Lots' ); ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <?php 
          $show_perks = ( $settings['show_perks'] ?? 'yes' ) === 'yes';
          if ( $show_perks ) : 
            $perks_badge = ! empty( $settings['perks_badge'] ) ? $settings['perks_badge'] : 'MEMBER PRIVILEGES';
            $perks_title = ! empty( $settings['perks_title'] ) ? $settings['perks_title'] : 'Crafted Exclusively For Coffee Lovers';
            $perks_desc  = ! empty( $settings['perks_desc'] ) ? $settings['perks_desc'] : 'Elevate every cup with exclusive roastery privileges, private sensory workshops, and member-only pricing.';

            $perk_icons = array(
              1 => 'bi bi-stars',
              2 => 'bi bi-mortarboard-fill',
              3 => 'bi bi-tag-fill',
              4 => 'bi bi-gift-fill',
              5 => 'bi bi-sliders',
              6 => 'bi bi-whatsapp',
            );
            $perk_footers = array(
              1 => array( 'left' => 'Limited Batches', 'right' => 'First Access' ),
              2 => array( 'left' => 'Tejgaon Roastery', 'right' => 'Free Passes' ),
              3 => array( 'left' => '250g & 1kg Bags', 'right' => 'Year-Round' ),
              4 => array( 'left' => 'Any Branch', 'right' => '100% On Us' ),
              5 => array( 'left' => 'Expert Baristas', 'right' => 'Consultations' ),
              6 => array( 'left' => 'Priority Line', 'right' => 'Express Queue' ),
            );
          ?>
          <section class="py-5 perks-section position-relative overflow-hidden" id="perks">
            <div class="container py-lg-4">
              <div class="text-center max-w-700 mx-auto mb-5">
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-award-fill me-1"></i> <?php echo esc_html( $perks_badge ); ?></span>
                  <span class="sec-pill-line"></span>
                </div>
                <h2 class="sec-title mb-2"><?php echo esc_html( $perks_title ); ?></h2>
                <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">
                  <?php echo esc_html( $perks_desc ); ?>
                </p>
              </div>

              <div class="row g-4 justify-content-center">
                <?php for ( $p = 1; $p <= 6; $p++ ) : 
                  $p_tag   = $settings[ 'perk' . $p . '_tag' ] ?? '';
                  $p_title = $settings[ 'perk' . $p . '_title' ] ?? '';
                  $p_desc  = $settings[ 'perk' . $p . '_desc' ] ?? '';
                  if ( empty( $p_title ) ) continue;
                ?>
                <div class="col-lg-4 col-md-6">
                  <div class="perk-card-luxury">
                    <div>
                      <div class="d-flex justify-content-between align-items-start">
                        <div class="perk-icon-wrap"><i class="<?php echo esc_attr( $perk_icons[ $p ] ); ?>"></i></div>
                        <?php if ( ! empty( $p_tag ) ) : ?>
                          <span class="perk-pill-tag"><?php echo esc_html( $p_tag ); ?></span>
                        <?php endif; ?>
                      </div>
                      <h4 class="font-heading perk-title"><?php echo esc_html( $p_title ); ?></h4>
                      <p class="perk-desc"><?php echo esc_html( $p_desc ); ?></p>
                    </div>
                    <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 12px;">
                      <span><i class="bi bi-check2-circle text-teal me-1"></i> <?php echo esc_html( $perk_footers[ $p ]['left'] ); ?></span>
                      <span class="fw-bold text-teal"><?php echo esc_html( $perk_footers[ $p ]['right'] ); ?></span>
                    </div>
                  </div>
                </div>
                <?php endfor; ?>
              </div>
            </div>
          </section>
          <?php endif; ?>

          <?php 
          $show_portal = ( $settings['show_portal'] ?? 'yes' ) === 'yes';
          if ( $show_portal ) :
            $portal_badge = ! empty( $settings['portal_badge'] ) ? $settings['portal_badge'] : 'VIP LOYALTY REWARDS';
            $portal_title = ! empty( $settings['portal_title'] ) ? $settings['portal_title'] : 'Digital Coffee Stamp Card & Club Portal';
            $portal_desc  = ! empty( $settings['portal_desc'] ) ? $settings['portal_desc'] : 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!';
            $tab1_title   = ! empty( $settings['tab1_title'] ) ? $settings['tab1_title'] : 'Check Your Live Stamp Progress';
            $tab1_desc    = ! empty( $settings['tab1_desc'] ) ? $settings['tab1_desc'] : 'Enter your Registered Phone Number or Regular Member ID below.';
            $tab2_title   = ! empty( $settings['tab2_title'] ) ? $settings['tab2_title'] : 'Log Cafe Invoice / Memo Number';
            $tab2_desc    = ! empty( $settings['tab2_desc'] ) ? $settings['tab2_desc'] : 'Submit your receipt details. Cups will be credited to your stamp card upon portal verification.';
            $tab3_title   = ! empty( $settings['tab3_title'] ) ? $settings['tab3_title'] : 'Santino Regular Member Enrollment';
            $tab3_desc    = ! empty( $settings['tab3_desc'] ) ? $settings['tab3_desc'] : 'Complete 5 cups of handcrafted coffee across Dhaka branches to enjoy your 6th cup free.';
          ?>
          <div id="stamps"></div>
          <section class="py-5 club-portal-section position-relative overflow-hidden" id="clubPortal">
            <div class="container py-lg-4">
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
                <div class="col-lg-5">
                  <div class="d-flex flex-column gap-3">
                    <div class="vip-card-surface">
                      <div class="d-flex justify-content-between align-items-start mb-3 position-relative" style="z-index: 2;">
                        <div>
                          <div class="small fw-bold text-uppercase" style="color: #dfbe8d; letter-spacing: 1.5px; font-size: 11px;">
                            SANTINO COFFEE CLUB
                          </div>
                          <h4 class="font-heading fw-bold text-white mb-0 mt-1">Regular Member</h4>
                        </div>
                        <div class="gold-chip"></div>
                      </div>

                      <div class="mb-4 position-relative" style="z-index: 2;">
                        <div class="font-monospace text-white-50 small" style="letter-spacing: 2px;">SNT-REG-•••• ••••</div>
                      </div>

                      <div class="p-3 rounded-4 mb-3 position-relative" style="background: rgba(0, 0, 0, 0.25); border: 1px solid rgba(195, 153, 108, 0.25); z-index: 2;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                          <span class="small fw-bold" style="color: #dfbe8d; font-size: 11.5px;">5-Cup Stamp Card Tracker</span>
                          <span class="badge rounded-pill" style="background: rgba(195, 153, 108, 0.25); color: #dfbe8d; font-size: 10px;">BUY 5, GET 1 FREE</span>
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

                      <div class="d-flex justify-content-between align-items-center text-white-50 small position-relative" style="z-index: 2; font-size: 11px;">
                        <span>Valid across all Dhaka branches</span>
                        <span style="color: #dfbe8d;"><i class="bi bi-patch-check-fill me-1"></i> Auto-Verified</span>
                      </div>
                    </div>

                    <div class="p-3 bg-white rounded-4 border shadow-sm">
                      <div class="row g-2 text-center">
                        <div class="col-4">
                          <div class="fs-4 text-teal mb-1"><i class="bi bi-cup-hot"></i></div>
                          <div class="fw-bold small text-dark">1. Sip Coffee</div>
                          <div class="text-muted" style="font-size: 10px;">At partner cafes</div>
                        </div>
                        <div class="col-4 border-start border-end">
                          <div class="fs-4 text-teal mb-1"><i class="bi bi-receipt"></i></div>
                          <div class="fw-bold small text-dark">2. Log Memo</div>
                          <div class="text-muted" style="font-size: 10px;">Submit invoice #</div>
                        </div>
                        <div class="col-4">
                          <div class="fs-4 text-teal mb-1" style="color: #c3996c !important;"><i class="bi bi-gift"></i></div>
                          <div class="fw-bold small text-dark">3. Get Free Cup</div>
                          <div class="text-muted" style="font-size: 10px;">Instant voucher</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-7">
                  <div class="portal-card p-4 p-md-5 h-100 d-flex flex-column justify-content-between">
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
                      <div class="tab-pane fade show active" id="stamps-pane" role="tabpanel">
                        <div class="mb-4">
                          <h4 class="font-heading fw-bold text-dark mb-1"><?php echo esc_html( $tab1_title ); ?></h4>
                          <p class="text-muted small"><?php echo esc_html( $tab1_desc ); ?></p>
                        </div>

                        <form id="santinoLookupForm" class="mb-4">
                          <div class="portal-lookup-group">
                            <div class="portal-lookup-field">
                              <i class="bi bi-telephone text-teal"></i>
                              <input type="text" name="query" placeholder="e.g. 01712345678 or SNT-REG-XXXX" required>
                            </div>
                            <button type="submit" class="btn-lookup-action">
                              <span>LOOKUP</span> <i class="bi bi-arrow-right"></i>
                            </button>
                          </div>
                        </form>
                        <div id="liveStampCardContainer" style="display: none;"></div>
                      </div>

                      <div class="tab-pane fade" id="invoice-pane" role="tabpanel">
                        <div class="mb-4">
                          <h4 class="font-heading fw-bold text-dark mb-1"><?php echo esc_html( $tab2_title ); ?></h4>
                          <p class="text-muted small"><?php echo esc_html( $tab2_desc ); ?></p>
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
                            <div class="col-12">
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
                            <label class="form-label small fw-bold text-dark"><i class="bi bi-camera-fill me-1 text-teal"></i> Upload Invoice / Memo Photo * (Mandatory)</label>
                            <input type="file" name="invoice_image" id="santinoInvoiceImage" class="form-control" accept="image/jpeg,image/png,image/webp,image/jpg" required>
                            <div class="form-text text-muted small" style="font-size: 0.78rem;">Upload photo of your physical cafe bill/memo for fast verification (JPG, PNG, WebP) - Required.</div>
                          </div>
                          <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                            Submit Invoice For Stamp Verification →
                          </button>
                        </form>
                      </div>

                      <div class="tab-pane fade" id="register-pane" role="tabpanel">
                        <div class="mb-4">
                          <h4 class="font-heading fw-bold text-dark mb-1"><?php echo esc_html( $tab3_title ); ?></h4>
                          <p class="text-muted small"><?php echo esc_html( $tab3_desc ); ?></p>
                        </div>
                        <div id="membershipResponseBox" style="display: none;" class="mb-4"></div>
                        <form id="santinoMembershipForm">
                          <div class="row g-3 mb-3">
                            <div class="col-12">
                              <label class="form-label small fw-bold text-dark">Full Name *</label>
                              <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                          </div>
                          <div class="row g-3 mb-3">
                            <div class="col-12">
                              <label class="form-label small fw-bold text-dark">Mobile Number: *</label>
                              <input type="tel" name="phone" id="santinoMemberPhone" class="form-control" placeholder="017XXXXXXXX" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" required>
                              <div class="form-text text-muted" style="font-size: 11px;">Same mobile number cannot be re-registered without portal permission.</div>
                            </div>
                          </div>
                          <div class="row g-3 mb-3">
                            <div class="col-md-6">
                              <label class="form-label small fw-bold text-dark">Birth Month *</label>
                              <select name="birth_month" class="form-select" required>
                                <option value="">Select Month</option>
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
                                <option value="">Select Day</option>
                                <?php for ( $d = 1; $d <= 31; $d++ ) : ?>
                                  <option value="<?php echo sprintf( '%02d', $d ); ?>"><?php echo sprintf( '%02d', $d ); ?></option>
                                <?php endfor; ?>
                              </select>
                            </div>
                          </div>
                          <div class="row g-3 mb-4">
                            <div class="col-12">
                              <label class="form-label small fw-bold text-dark">Email: *</label>
                              <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                            </div>
                          </div>
                          <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="termsCheck" checked required>
                            <label class="form-check-label small text-muted" for="termsCheck">
                              I agree to join Santino Coffee Club to receive reward stamps and complimentary cups.
                            </label>
                          </div>
                          <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                            Register For Santino Coffee Club →
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <?php endif; ?>

          <?php 
          $show_bottom_cta = ( $settings['show_bottom_cta'] ?? 'yes' ) === 'yes';
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
