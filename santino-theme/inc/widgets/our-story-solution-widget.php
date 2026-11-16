<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Our_Story_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_our_story_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino Our Story & Heritage Solution', 'santino' );
    }

    public function get_icon() {
        return 'eicon-history';
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
                'label'   => esc_html__( 'Hero Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SINCE 1996 • 30+ YEARS ROASTING HERITAGE',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'The Game Changer in Specialty Coffee Culture',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'From direct origin estates in Ethiopia and Colombia to precision roasting labs, championship barista academies, and nationwide supermarket presence in Bangladesh.',
            )
        );

        $this->add_control(
            'hero_video_url',
            array(
                'label'       => esc_html__( 'Hero Video URL (MP4)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'description' => esc_html__( 'Leave blank to use Customizer/default video.', 'santino' ),
            )
        );

        $this->add_control(
            'hero_poster',
            array(
                'label'   => esc_html__( 'Hero Poster / Fallback Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array( 'url' => '' ),
            )
        );

        $this->add_control(
            'hero_btn1_text',
            array(
                'label'   => esc_html__( 'Primary Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Discover Our Story',
            )
        );

        $this->add_control(
            'hero_btn1_url',
            array(
                'label'   => esc_html__( 'Primary Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '#vision' ),
            )
        );

        $this->add_control(
            'hero_btn2_text',
            array(
                'label'   => esc_html__( 'Secondary Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Menu',
            )
        );

        $this->add_control(
            'hero_btn2_url',
            array(
                'label'   => esc_html__( 'Secondary Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/menu/' ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_metrics',
            array(
                'label' => esc_html__( 'Floating Metrics Cards', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $m_rep = new \Elementor\Repeater();
        $m_rep->add_control( 'icon', array( 'label' => esc_html__( 'Bootstrap Icon Class', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'bi bi-clock-history' ) );
        $m_rep->add_control( 'num', array( 'label' => esc_html__( 'Number / Value', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => '30+' ) );
        $m_rep->add_control( 'label', array( 'label' => esc_html__( 'Label', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Years of Roasting Mastery' ) );

        $this->add_control(
            'metrics_list',
            array(
                'label'       => esc_html__( 'Metrics', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $m_rep->get_controls(),
                'title_field' => '{{{ num }}} — {{{ label }}}',
                'default'     => array(
                    array( 'icon' => 'bi bi-clock-history', 'num' => '30+', 'label' => 'Years of Roasting Mastery' ),
                    array( 'icon' => 'bi bi-building', 'num' => '500+', 'label' => 'Hotels, Cafes & Corporate Hubs' ),
                    array( 'icon' => 'bi bi-patch-check-fill', 'num' => '100%', 'label' => 'FSSC22000 Food Certified' ),
                    array( 'icon' => 'bi bi-mortarboard-fill', 'num' => '1,000+', 'label' => 'Certified Barista Graduates' ),
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_vision',
            array(
                'label' => esc_html__( 'Purpose & Vision', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control( 'vision_badge', array( 'label' => esc_html__( 'Section Badge', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'OUR PURPOSE & VISION' ) );
        $this->add_control( 'vision_title', array( 'label' => esc_html__( 'Section Title (HTML)', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Innovation Grounded in <span class="sec-title-accent">Heritage</span>' ) );
        $this->add_control( 'vision_desc', array( 'label' => esc_html__( 'Vision Description', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Santino Coffee was born with a single mission: to empower coffee entrepreneurs, businesses, and coffee lovers with world-class beans, precision machinery, and deep sensory knowledge. We believe that every cup tells a story of dedicated farmers, meticulous roast masters, and passionate baristas.' ) );

        $v_rep = new \Elementor\Repeater();
        $v_rep->add_control( 'icon', array( 'label' => esc_html__( 'Icon Class', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'bi bi-globe-americas' ) );
        $v_rep->add_control( 'badge', array( 'label' => esc_html__( 'Pill Badge', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Direct Farm Sourcing' ) );
        $v_rep->add_control( 'title', array( 'label' => esc_html__( 'Card Title', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Authentic Origin' ) );
        $v_rep->add_control( 'desc', array( 'label' => esc_html__( 'Card Description', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => '100% ethically sourced Rainforest Alliance certified green beans from direct partner estates.' ) );

        $this->add_control(
            'vision_cards',
            array(
                'label'       => esc_html__( 'Vision Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $v_rep->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => array(
                    array( 'icon' => 'bi bi-globe-americas', 'badge' => 'Direct Farm Sourcing', 'title' => 'Authentic Origin', 'desc' => '100% ethically sourced Rainforest Alliance certified green beans from direct partner estates.' ),
                    array( 'icon' => 'bi bi-fire', 'badge' => 'Master Roasting', 'title' => 'Precision Roasting', 'desc' => 'Custom roast profiles digitally calibrated to temperature, humidity, and peak flavor release.' ),
                    array( 'icon' => 'bi bi-shield-check', 'badge' => 'Dedicated 24/7 Care', 'title' => 'Continuous Care', 'desc' => '24/7 technical breakdown support, preventive maintenance, and barista training academies.' ),
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_chapters',
            array(
                'label' => esc_html__( 'Story Chapters', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $c_rep = new \Elementor\Repeater();
        $c_rep->add_control( 'badge', array( 'label' => esc_html__( 'Chapter Badge', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'CHAPTER 01' ) );
        $c_rep->add_control( 'title', array( 'label' => esc_html__( 'Chapter Title (HTML)', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Artisan Roasting &amp; <span class="sec-title-accent">Quality Without Compromise</span>' ) );
        $c_rep->add_control( 'desc', array( 'label' => esc_html__( 'Description', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => '' ) );
        $c_rep->add_control( 'bullets', array( 'label' => esc_html__( 'Bullet Points (One per line, "Bold Title: text")', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => '' ) );
        $c_rep->add_control( 'image', array( 'label' => esc_html__( 'Chapter Image', 'santino' ), 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => array( 'url' => '' ) ) );
        $c_rep->add_control( 'fallback_img', array( 'label' => esc_html__( 'Fallback Asset Filename', 'santino' ), 'type' => \Elementor\Controls_Manager::HIDDEN, 'default' => 'bd-barista-latte-art.jpg' ) );
        $c_rep->add_control( 'img_badge_icon', array( 'label' => esc_html__( 'Image Badge Icon', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'bi bi-fire text-danger fs-4' ) );
        $c_rep->add_control( 'img_badge_title', array( 'label' => esc_html__( 'Image Badge Title', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Artisan Roastery Lab' ) );
        $c_rep->add_control( 'img_badge_sub', array( 'label' => esc_html__( 'Image Badge Subtitle', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Small Batch Custom Roasts' ) );
        $c_rep->add_control( 'btn_text', array( 'label' => esc_html__( 'Button Text', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Explore More' ) );
        $c_rep->add_control( 'btn_url', array( 'label' => esc_html__( 'Button Link', 'santino' ), 'type' => \Elementor\Controls_Manager::URL, 'default' => array( 'url' => '/beans/' ) ) );
        $c_rep->add_control( 'reverse_layout', array( 'label' => esc_html__( 'Reverse Image/Text Side', 'santino' ), 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => '' ) );

        $this->add_control(
            'chapters_list',
            array(
                'label'       => esc_html__( 'Chapters', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $c_rep->get_controls(),
                'title_field' => '{{{ badge }}} — {{{ img_badge_title }}}',
                'default'     => array(
                    array(
                        'badge'           => 'CHAPTER 01',
                        'title'           => 'Artisan Roasting &amp; <span class="sec-title-accent">Quality Without Compromise</span>',
                        'desc'            => 'Everything we roast represents an unyielding dedication to excellence. Our roastery facilities operate under strict FSSC22000 food safety certifications, roasting single origins and private label blends with high batch consistency.',
                        'bullets'         => "Rainforest Alliance Certified: Direct farm relationships ensuring sustainable livelihood for growers.\nCustom Private Label OEM: Tailored flavor curves designed for five-star hotels and specialty roasteries.\nReal-Time Profile Tracking: Digital thermocouple logging ensuring ±0.5°C batch consistency.",
                        'fallback_img'    => 'bd-barista-latte-art.jpg',
                        'img_badge_icon'  => 'bi bi-fire text-danger fs-4',
                        'img_badge_title' => 'Artisan Roastery Lab',
                        'img_badge_sub'   => 'Small Batch Custom Roasts',
                        'btn_text'        => 'Explore Bean Collections',
                        'btn_url'         => array( 'url' => '/beans/' ),
                        'reverse_layout'  => '',
                    ),
                    array(
                        'badge'           => 'CHAPTER 02',
                        'title'           => 'State-of-the-Art Espresso &amp; <span class="sec-title-accent">Bionic Robotics</span>',
                        'desc'            => 'We partner with the world\'s most prestigious espresso machine innovators — Victoria Arduino, Nuova Simonelli, Kalerm, and CAYE Robotics — delivering commercial extraction consistency that elevates customer retention and operational speed.',
                        'bullets'         => "T3 Genius PureBrew Technology: Variable water flow and gravimetric dosing on Victoria Arduino Black Eagle & Eagle One.\nCAYE Bionic Barista Robotic Arms: Fully automated 6-axis barista robots delivering flawless latte art in under 60 seconds.\nTurnkey Machine Leasing: Complete corporate rental packages with guaranteed zero-downtime maintenance.",
                        'fallback_img'    => 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp',
                        'img_badge_icon'  => 'bi bi-cpu-fill text-primary fs-4',
                        'img_badge_title' => 'Next-Gen Automation',
                        'img_badge_sub'   => 'Victoria Arduino & Bionic Robots',
                        'btn_text'        => 'View Machine Catalog',
                        'btn_url'         => array( 'url' => '/machines/' ),
                        'reverse_layout'  => 'yes',
                    ),
                    array(
                        'badge'           => 'CHAPTER 03',
                        'title'           => 'Empowering the Next Generation of <span class="sec-title-accent">Coffee Leaders</span>',
                        'desc'            => 'Knowledge is the heartbeat of our craft. Santino Barista Academy offers internationally structured certification programs, crop-to-cup sensory training, and competitive coaching for aspiring champions in Bangladesh.',
                        'bullets'         => "Foundational to Master Barista: Milk texturing, espresso calibration, workflow ergonomics, and cupping.\nCorporate Staff Upskilling: Standardizing beverage execution across multi-branch restaurant operations.\nSpecialty Brewing Modules: V60, Chemex, Aeropress, Cold Brew, and Syphon sensory mastery.",
                        'fallback_img'    => 'bd-barista-training.jpg',
                        'img_badge_icon'  => 'bi bi-trophy-fill text-warning fs-4',
                        'img_badge_title' => 'Championship Coaching',
                        'img_badge_sub'   => 'Certified Barista Trainers',
                        'btn_text'        => 'Enroll in Barista Academy',
                        'btn_url'         => array( 'url' => '/training/' ),
                        'reverse_layout'  => '',
                    ),
                    array(
                        'badge'           => 'CHAPTER 04',
                        'title'           => 'Everyday Specialty Coffee for <span class="sec-title-accent">Every Community</span>',
                        'desc'            => 'We are bridging the gap between luxury specialty coffee and everyday accessibility. Today, Santino roasted bean packs are available on retail shelves at Shwapno Superstores nationwide, and freshly brewed coffees are served across 50+ BFC restaurant locations.',
                        'bullets'         => "100+ Shwapno Outlets: Freshly sealed 250g & 1kg bags available at your neighborhood supermarket.\n50+ BFC Quick Service Bars: Hot and iced espresso beverages brewed on authentic commercial Italian machines.\nB2B Direct Supply: Fast scheduled deliveries maintaining optimal bean degassing periods.",
                        'fallback_img'    => 'shwapno_santino_retail.jpg',
                        'img_badge_icon'  => 'bi bi-shop-window text-success fs-4',
                        'img_badge_title' => 'Nationwide Presence',
                        'img_badge_sub'   => 'Shwapno Superstores & BFC Dining',
                        'btn_text'        => 'Explore Retail Outlets',
                        'btn_url'         => array( 'url' => '/swapno/' ),
                        'reverse_layout'  => 'yes',
                    ),
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_marquee',
            array(
                'label' => esc_html__( 'Photo Reel / Gallery', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control( 'marquee_badge', array( 'label' => esc_html__( 'Badge Text', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'MOMENTS AT SANTINO' ) );
        $this->add_control( 'marquee_title', array( 'label' => esc_html__( 'Section Title (HTML)', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Inside Our Roastery, <span class="sec-title-accent">Cafes &amp; Labs</span>' ) );
        $this->add_control( 'reel_row1_gallery', array( 'label' => esc_html__( 'Row 1 Photos (Optional Override)', 'santino' ), 'type' => \Elementor\Controls_Manager::GALLERY, 'default' => array() ) );
        $this->add_control( 'reel_row2_gallery', array( 'label' => esc_html__( 'Row 2 Photos (Optional Override)', 'santino' ), 'type' => \Elementor\Controls_Manager::GALLERY, 'default' => array() ) );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cta',
            array(
                'label' => esc_html__( 'Bottom CTA Banner', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control( 'cta_badge', array( 'label' => esc_html__( 'CTA Badge', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'BECOME A PARTNER' ) );
        $this->add_control( 'cta_title', array( 'label' => esc_html__( 'CTA Title (HTML)', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Ready to Elevate Your <span style="color: #dfbe8d;">Coffee Experience?</span>' ) );
        $this->add_control( 'cta_desc', array( 'label' => esc_html__( 'CTA Description', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Whether you are opening a specialty cafe, outfitting a hotel with commercial espresso machinery, or looking for freshly roasted wholesale beans, Santino is your total solutions partner.' ) );
        $this->add_control( 'cta_btn1_text', array( 'label' => esc_html__( 'Primary Button Text (Modal)', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Book A Roastery Visit' ) );
        $this->add_control( 'cta_btn2_text', array( 'label' => esc_html__( 'Secondary Button Text', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Explore Drinks Menu' ) );
        $this->add_control( 'cta_btn2_url', array( 'label' => esc_html__( 'Secondary Button Link', 'santino' ), 'type' => \Elementor\Controls_Manager::URL, 'default' => array( 'url' => '/menu/' ) ) );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
        .story-page-wrap, body, p, .text-muted, .text-secondary, label, input, select, textarea {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
        }
        .pro-banner-title,
        .sec-title,
        .story-hero-heading,
        .font-heading,
        h1, h2, h3, h4, h5, h6,
        .sec-pill-badge,
        .btn-hero-lifestyle,
        .btn-hero-outline,
        .metric-num,
        .story-chapter-title,
        .vision-feature-card h4 {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          letter-spacing: -0.3px;
        }
        .story-video-hero {
          position: relative;
          overflow: hidden;
          min-height: 68vh;
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 110px 20px 95px;
        }
        .story-video-wrap {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          overflow: hidden;
          z-index: 1;
        }
        .story-video-bg {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
        .story-video-overlay {
          position: absolute;
          inset: 0;
          background: linear-gradient(180deg, rgba(0, 0, 0, 0.42) 0%, rgba(0, 38, 35, 0.82) 100%);
          z-index: 2;
        }
        .sec-title {
          font-size: clamp(2.1rem, 3.8vw, 3rem) !important;
          font-weight: 900 !important;
          color: #111111;
          letter-spacing: -0.6px !important;
          line-height: 1.25 !important;
        }
        .sec-title.text-white,
        .text-white .sec-title {
          color: #ffffff !important;
        }
        .sec-title-accent {
          color: var(--santino-teal, #00625d) !important;
        }
        .sec-description, .story-vision-text, .story-chapter-desc {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
          color: #556662;
          font-size: 1.08rem;
          line-height: 1.75;
        }
        .sec-pill-badge-wrap {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: 12px;
        }
        .sec-pill-line {
          width: 36px;
          height: 1.5px;
          background: rgba(0, 98, 93, 0.35);
          display: inline-block;
          border-radius: 2px;
        }
        .sec-pill-badge-wrap.light .sec-pill-line {
          background: rgba(255, 255, 255, 0.45);
        }
        .sec-pill-badge {
          display: inline-flex;
          align-items: center;
          gap: 7px;
          background: rgba(0, 98, 93, 0.08);
          color: var(--santino-teal, #00625d);
          border: 1px solid rgba(0, 98, 93, 0.24);
          padding: 6px 20px;
          border-radius: 50px;
          font-size: 0.78rem;
          font-weight: 800;
          letter-spacing: 1.2px;
          text-transform: uppercase;
          backdrop-filter: blur(4px);
        }
        .sec-pill-badge.light {
          background: rgba(255, 255, 255, 0.14);
          color: #ffffff;
          border: 1px solid rgba(255, 255, 255, 0.3);
          backdrop-filter: blur(10px);
        }
        .sec-pill-badge.light i {
          color: var(--santino-gold, #dfbe8d);
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
        .btn-hero-lifestyle span,
        .btn-hero-outline span {
          display: inline-block !important;
          line-height: 1 !important;
          vertical-align: middle !important;
        }
        .btn-hero-lifestyle i,
        .btn-hero-outline i {
          font-size: 14px !important;
          line-height: 1 !important;
          display: inline-flex !important;
          align-items: center !important;
          justify-content: center !important;
          margin: 0 !important;
          vertical-align: middle !important;
          transition: transform 0.25s ease !important;
        }
        .btn-hero-lifestyle {
          background: var(--santino-teal, #00625d) !important;
          border: 2px solid var(--santino-teal, #00625d) !important;
          color: #ffffff !important;
          box-shadow: 0 8px 20px rgba(0, 98, 93, 0.35) !important;
        }
        .btn-hero-lifestyle:hover {
          background: #004d49 !important;
          border-color: #004d49 !important;
          color: #ffffff !important;
          transform: translateY(-2px) !important;
          box-shadow: 0 12px 28px rgba(0, 98, 93, 0.5) !important;
        }
        .btn-hero-lifestyle:hover i {
          transform: translateX(4px) !important;
        }
        .btn-hero-outline {
          background: rgba(0, 0, 0, 0.25) !important;
          backdrop-filter: blur(8px) !important;
          border: 2px solid rgba(255, 255, 255, 0.88) !important;
          color: #ffffff !important;
        }
        .btn-hero-outline:hover {
          background: #ffffff !important;
          color: var(--santino-teal, #00625d) !important;
          border-color: #ffffff !important;
          transform: translateY(-2px) !important;
          box-shadow: 0 10px 26px rgba(255, 255, 255, 0.35) !important;
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
          box-shadow: 0 14px 34px rgba(0, 77, 73, 0.07), 0 2px 6px rgba(0, 0, 0, 0.03);
          transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
          position: relative;
          overflow: hidden;
          display: flex;
          flex-direction: column;
          align-items: center;
        }
        .metric-card-pro::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          height: 4px;
          background: linear-gradient(90deg, var(--santino-teal, #00625d), var(--santino-gold, #dfbe8d));
          opacity: 0;
          transition: opacity 0.3s ease;
        }
        .metric-card-pro:hover {
          transform: translateY(-7px);
          border-color: rgba(0, 98, 93, 0.35);
          box-shadow: 0 20px 42px rgba(0, 98, 93, 0.15);
        }
        .metric-card-pro:hover::before {
          opacity: 1;
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
          transition: all 0.3s ease;
        }
        .metric-card-pro:hover .metric-card-icon {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          transform: scale(1.1);
        }
        .metric-card-pro .metric-num {
          font-size: 2.55rem;
          font-weight: 900;
          color: var(--santino-teal, #00625d);
          line-height: 1.1;
          margin-bottom: 6px;
          letter-spacing: -0.5px;
        }
        .metric-card-pro .metric-label {
          color: #4a5c57;
          font-size: 0.86rem;
          font-weight: 700;
          line-height: 1.4;
          letter-spacing: 0.2px;
        }
        .story-vision-section {
          background: radial-gradient(circle at 50% 15%, rgba(0, 98, 93, 0.035) 0%, rgba(255, 255, 255, 1) 75%);
        }
        .vision-feature-card {
          background: #ffffff;
          border: 1.5px solid rgba(0, 98, 93, 0.12);
          border-radius: 24px;
          padding: 38px 28px 32px;
          text-align: center;
          transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
          box-shadow: 0 12px 30px rgba(0, 98, 93, 0.05);
          height: 100%;
          display: flex;
          flex-direction: column;
          align-items: center;
          position: relative;
          overflow: hidden;
        }
        .vision-feature-card::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          height: 4px;
          background: linear-gradient(90deg, transparent, var(--santino-teal, #00625d), transparent);
          opacity: 0;
          transition: opacity 0.3s ease;
        }
        .vision-feature-card:hover {
          transform: translateY(-8px);
          border-color: rgba(0, 98, 93, 0.38);
          box-shadow: 0 22px 50px rgba(0, 98, 93, 0.14);
        }
        .vision-feature-card:hover::before {
          opacity: 1;
        }
        .vision-icon-wrap {
          width: 72px;
          height: 72px;
          border-radius: 50%;
          background: linear-gradient(135deg, rgba(0, 98, 93, 0.08) 0%, rgba(223, 190, 141, 0.15) 100%);
          color: var(--santino-teal, #00625d);
          display: inline-flex;
          align-items: center;
          justify-content: center;
          font-size: 28px;
          margin-bottom: 18px;
          transition: all 0.35s ease;
          border: 1.5px solid rgba(0, 98, 93, 0.16);
        }
        .vision-feature-card:hover .vision-icon-wrap {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          transform: scale(1.1) rotate(6deg);
          box-shadow: 0 10px 24px rgba(0, 98, 93, 0.3);
          border-color: var(--santino-teal, #00625d);
        }
        .vision-badge-pill {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif);
          font-size: 0.72rem;
          font-weight: 800;
          letter-spacing: 0.8px;
          text-transform: uppercase;
          color: var(--santino-teal, #00625d);
          background: rgba(0, 98, 93, 0.08);
          padding: 4px 12px;
          border-radius: 30px;
          margin-bottom: 12px;
          display: inline-block;
        }
        .vision-feature-card h4 {
          font-size: 1.28rem;
          font-weight: 800;
          color: #111111;
          margin-bottom: 12px;
          letter-spacing: -0.3px;
        }
        .vision-feature-card p {
          color: #556662;
          font-size: 0.95rem;
          line-height: 1.68;
          margin: 0;
        }
        .story-split-img {
          width: 100%;
          height: 400px;
          object-fit: cover;
          border-radius: 24px;
          border: 1px solid rgba(0, 98, 93, 0.12);
        }
        .story-img-badge {
          position: absolute;
          bottom: 22px;
          left: 22px;
          background: rgba(255, 255, 255, 0.95);
          backdrop-filter: blur(12px);
          padding: 12px 20px;
          border-radius: 14px;
          display: flex;
          align-items: center;
          gap: 14px;
          box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
          border: 1px solid rgba(0, 98, 93, 0.15);
        }
        .story-img-badge strong {
          display: block;
          font-family: var(--kp-font-title, 'Montserrat', sans-serif);
          font-size: 13.5px;
          color: #111111;
          font-weight: 800;
        }
        .story-img-badge span {
          font-size: 11.5px;
          color: var(--santino-teal, #00625d);
          font-weight: 700;
        }
        .story-bullet-list {
          list-style: none;
          padding: 0;
          margin: 22px 0;
          display: flex;
          flex-direction: column;
          gap: 14px;
        }
        .story-bullet-list li {
          display: flex;
          align-items: flex-start;
          gap: 12px;
          font-size: 0.96rem;
          color: #445551;
          line-height: 1.6;
        }
        .story-bullet-list li i {
          color: var(--santino-teal, #00625d);
          font-size: 1.15rem;
          margin-top: 2px;
          flex-shrink: 0;
        }
        .story-chapter-title {
          font-size: clamp(1.6rem, 2.5vw, 2.1rem);
          font-weight: 900;
          color: #111111;
          line-height: 1.3;
          margin-bottom: 16px;
        }
        .story-photo-marquee-track {
          overflow: hidden;
          white-space: nowrap;
          position: relative;
        }
        .story-marquee-row {
          display: inline-flex;
          gap: 20px;
          animation: marqueeScroll 35s linear infinite;
        }
        .track-right .story-marquee-row {
          animation-direction: reverse;
        }
        .reel-photo {
          width: 280px;
          height: 190px;
          object-fit: cover;
          border-radius: 16px;
          box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        @keyframes marqueeScroll {
          0% { transform: translateX(0); }
          100% { transform: translateX(-50%); }
        }
        </style>

        <div class="story-page-wrap">
          <section class="story-video-hero position-relative overflow-hidden text-center">
            <div class="story-video-wrap">
              <?php
              $story_vid = ! empty( $settings['hero_video_url'] ) ? $settings['hero_video_url'] : get_theme_mod( 'santino_story_video_mp4' );
              if ( ! $story_vid ) $story_vid = get_theme_mod( 'santino_story_video_url', 'https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/ab6140f6-129c-4ae9-aaa0-20190c43183b.mp4' );
              $story_poster = ! empty( $settings['hero_poster']['url'] ) ? $settings['hero_poster']['url'] : get_theme_mod( 'santino_story_poster_img' );
              if ( ! $story_poster && function_exists( 'santino_img' ) ) $story_poster = santino_img( 'imgi_20_santino_-_250522-07574.jpg' );
              $btn1_url = ! empty( $settings['hero_btn1_url']['url'] ) ? $settings['hero_btn1_url']['url'] : '#vision';
              $btn2_url = ! empty( $settings['hero_btn2_url']['url'] ) ? $settings['hero_btn2_url']['url'] : home_url( '/menu/' );
              ?>
              <video class="story-video-bg" autoplay muted loop playsinline poster="<?php echo esc_url( $story_poster ); ?>">
                <source src="<?php echo esc_url( $story_vid ); ?>" type="video/mp4">
              </video>
              <div class="story-video-overlay"></div>
            </div>
            
            <div class="container position-relative" style="max-width: 860px; z-index: 3;">
              <?php if ( ! empty( $settings['hero_badge'] ) ) : ?>
              <div class="sec-pill-badge-wrap light mb-3">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge light">
                  <i class="bi bi-gem me-1 text-warning"></i> <?php echo esc_html( $settings['hero_badge'] ); ?>
                </span>
                <span class="sec-pill-line"></span>
              </div>
              <?php endif; ?>

              <h1 class="pro-banner-title mb-3" style="font-family: var(--kp-font-title, 'Montserrat', sans-serif); font-size: clamp(2.4rem, 4.8vw, 3.8rem); font-weight: 900; line-height: 1.18; letter-spacing: -0.5px; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.6);">
                <?php echo esc_html( $settings['hero_title'] ); ?>
              </h1>

              <p class="pro-banner-desc mb-4" style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); max-width: 680px; font-size: 1.08rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.5);">
                <?php echo esc_html( $settings['hero_desc'] ); ?>
              </p>

              <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
                <?php if ( ! empty( $settings['hero_btn1_text'] ) ) : ?>
                <a href="<?php echo esc_url( $btn1_url ); ?>" class="btn-hero-lifestyle">
                  <span><?php echo esc_html( $settings['hero_btn1_text'] ); ?></span>
                  <i class="bi bi-arrow-right"></i>
                </a>
                <?php endif; ?>
                <?php if ( ! empty( $settings['hero_btn2_text'] ) ) : ?>
                <a href="<?php echo esc_url( $btn2_url ); ?>" class="btn-hero-outline">
                  <i class="bi bi-arrow-down-short text-warning"></i>
                  <span><?php echo esc_html( $settings['hero_btn2_text'] ); ?></span>
                </a>
                <?php endif; ?>
              </div>
            </div>
          </section>

          <?php if ( ! empty( $settings['metrics_list'] ) ) : ?>
          <div class="story-metrics-floating-wrap">
            <div class="container">
              <div class="row g-3 g-md-4 text-center justify-content-center">
                <?php foreach ( $settings['metrics_list'] as $m ) : ?>
                <div class="col-lg-3 col-6">
                  <div class="metric-card-pro">
                    <div class="metric-card-icon"><i class="<?php echo esc_attr( $m['icon'] ?: 'bi bi-stars' ); ?>"></i></div>
                    <div class="metric-num"><?php echo esc_html( $m['num'] ); ?></div>
                    <div class="metric-label"><?php echo esc_html( $m['label'] ); ?></div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>

          <section class="story-vision-section py-5 my-lg-2 position-relative" id="vision">
            <div class="container position-relative" style="z-index: 1;">
              <div class="row justify-content-center text-center">
                <div class="col-xl-9 col-lg-10">
                  <?php if ( ! empty( $settings['vision_badge'] ) ) : ?>
                  <div class="sec-pill-badge-wrap mb-3">
                    <span class="sec-pill-line"></span>
                    <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $settings['vision_badge'] ); ?></span>
                    <span class="sec-pill-line"></span>
                  </div>
                  <?php endif; ?>
                  <h2 class="sec-title mb-3"><?php echo wp_kses_post( $settings['vision_title'] ); ?></h2>
                  <p class="story-vision-text mb-4" style="max-width: 780px; margin: 0 auto 35px;">
                    <?php echo esc_html( $settings['vision_desc'] ); ?>
                  </p>
                  
                  <?php if ( ! empty( $settings['vision_cards'] ) ) : ?>
                  <div class="row g-4 mt-2">
                    <?php foreach ( $settings['vision_cards'] as $vc ) : ?>
                    <div class="col-md-4">
                      <div class="vision-feature-card">
                        <div class="vision-icon-wrap"><i class="<?php echo esc_attr( $vc['icon'] ?: 'bi bi-globe-americas' ); ?>"></i></div>
                        <?php if ( ! empty( $vc['badge'] ) ) : ?>
                        <span class="vision-badge-pill"><?php echo esc_html( $vc['badge'] ); ?></span>
                        <?php endif; ?>
                        <h4><?php echo esc_html( $vc['title'] ); ?></h4>
                        <p><?php echo esc_html( $vc['desc'] ); ?></p>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </section>

          <?php if ( ! empty( $settings['chapters_list'] ) ) : ?>
          <section class="story-split-chapters-section py-5 position-relative">
            <div class="container">
              <?php
              $ch_total = count( $settings['chapters_list'] );
              foreach ( $settings['chapters_list'] as $idx => $ch ) :
                  $is_last    = ( $idx === $ch_total - 1 );
                  $is_rev     = ( ( $ch['reverse_layout'] ?? '' ) === 'yes' );
                  $ch_img     = ! empty( $ch['image']['url'] ) ? $ch['image']['url'] : ( ! empty( $ch['fallback_img'] ) && function_exists( 'santino_img' ) ? santino_img( $ch['fallback_img'] ) : '' );
                  $ch_btn_url = ! empty( $ch['btn_url']['url'] ) ? $ch['btn_url']['url'] : '#';
                  $bullets    = array_filter( array_map( 'trim', explode( "\n", (string) ( $ch['bullets'] ?? '' ) ) ) );
              ?>
              <div class="story-split-row row align-items-center g-5 <?php echo $is_last ? '' : 'mb-5 pb-lg-5'; ?> <?php echo $is_rev ? 'flex-lg-row-reverse' : ''; ?>">
                <div class="col-lg-6">
                  <div class="story-split-img-wrapper position-relative">
                    <?php if ( $ch_img ) : ?>
                    <img src="<?php echo esc_url( $ch_img ); ?>" alt="<?php echo esc_attr( strip_tags( $ch['title'] ) ); ?>" class="story-split-img shadow-sm">
                    <?php endif; ?>
                    <?php if ( ! empty( $ch['img_badge_title'] ) ) : ?>
                    <div class="story-img-badge">
                      <i class="<?php echo esc_attr( $ch['img_badge_icon'] ?: 'bi bi-stars fs-4' ); ?>"></i>
                      <div>
                        <strong><?php echo esc_html( $ch['img_badge_title'] ); ?></strong>
                        <span><?php echo esc_html( $ch['img_badge_sub'] ?? '' ); ?></span>
                      </div>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-6 <?php echo $is_rev ? 'pe-lg-5' : 'ps-lg-5'; ?>">
                  <?php if ( ! empty( $ch['badge'] ) ) : ?>
                  <div class="sec-pill-badge-wrap mb-3">
                    <span class="sec-pill-line"></span>
                    <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $ch['badge'] ); ?></span>
                    <span class="sec-pill-line"></span>
                  </div>
                  <?php endif; ?>
                  <h3 class="story-chapter-title"><?php echo wp_kses_post( $ch['title'] ); ?></h3>
                  <?php if ( ! empty( $ch['desc'] ) ) : ?>
                  <p class="story-chapter-desc"><?php echo esc_html( $ch['desc'] ); ?></p>
                  <?php endif; ?>
                  <?php if ( ! empty( $bullets ) ) : ?>
                  <ul class="story-bullet-list">
                    <?php foreach ( $bullets as $b_line ) :
                        $parts = explode( ':', $b_line, 2 );
                    ?>
                    <li>
                      <i class="bi bi-check-circle-fill"></i>
                      <span>
                        <?php if ( count( $parts ) === 2 ) : ?>
                          <strong><?php echo esc_html( trim( $parts[0] ) ); ?>:</strong> <?php echo esc_html( trim( $parts[1] ) ); ?>
                        <?php else : ?>
                          <?php echo esc_html( $b_line ); ?>
                        <?php endif; ?>
                      </span>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                  <?php endif; ?>
                  <?php if ( ! empty( $ch['btn_text'] ) ) : ?>
                  <a href="<?php echo esc_url( $ch_btn_url ); ?>" class="btn-hero-lifestyle mt-2">
                    <span><?php echo esc_html( $ch['btn_text'] ); ?></span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </section>
          <?php endif; ?>

          <section class="story-marquee-reel-section py-5 my-4 bg-light">
            <div class="container-fluid px-0">
              <div class="text-center mb-4">
                <?php if ( ! empty( $settings['marquee_badge'] ) ) : ?>
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $settings['marquee_badge'] ); ?></span>
                  <span class="sec-pill-line"></span>
                </div>
                <?php endif; ?>
                <h3 class="sec-title mt-1"><?php echo wp_kses_post( $settings['marquee_title'] ); ?></h3>
              </div>

              <?php
              $r1 = array();
              if ( ! empty( $settings['reel_row1_gallery'] ) ) {
                  foreach ( $settings['reel_row1_gallery'] as $g ) { if ( ! empty( $g['url'] ) ) $r1[] = $g['url']; }
              } else {
                  foreach ( array( 'imgi_20_santino_-_250522-07574.jpg', 'imgi_23_santino_-_250522-07495.jpg', 'imgi_25_santino_-_250522-07618.jpg', 'imgi_26_santino_-_250522-07312.jpg', 'imgi_27_santino_-_250522-07216.jpg', 'bd-barista-latte-art.jpg' ) as $f ) {
                      if ( function_exists( 'santino_img' ) ) $r1[] = santino_img( $f );
                  }
              }
              $r2 = array();
              if ( ! empty( $settings['reel_row2_gallery'] ) ) {
                  foreach ( $settings['reel_row2_gallery'] as $g ) { if ( ! empty( $g['url'] ) ) $r2[] = $g['url']; }
              } else {
                  foreach ( array( 'shwapno_santino_retail.jpg', 'bfc_santino_foodservice.jpg', 'bd-barista-training.jpg', 'santino_cup_specialist.jpg', 'menu-raw-coconut-latte.jpg', 'menu-cappuccino-hot.jpg' ) as $f ) {
                      if ( function_exists( 'santino_img' ) ) $r2[] = santino_img( $f );
                  }
              }
              ?>

              <div class="story-photo-marquee-track track-left mb-3">
                <div class="story-marquee-row">
                  <?php foreach ( array_merge( $r1, array_slice( $r1, 0, 3 ) ) as $img_u ) : ?>
                    <img src="<?php echo esc_url( $img_u ); ?>" alt="" class="reel-photo">
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="story-photo-marquee-track track-right">
                <div class="story-marquee-row">
                  <?php foreach ( array_merge( $r2, array_slice( $r2, 0, 3 ) ) as $img_u ) : ?>
                    <img src="<?php echo esc_url( $img_u ); ?>" alt="" class="reel-photo">
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </section>

          <section class="story-cta-section text-center py-5">
            <div class="container">
              <div class="p-4 p-md-5 rounded-4 position-relative text-white overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #002b28 0%, #00504b 50%, #002220 100%); border: 1px solid rgba(212, 175, 55, 0.35);">
                <div class="position-relative" style="z-index: 2;">
                  <?php if ( ! empty( $settings['cta_badge'] ) ) : ?>
                  <div class="sec-pill-badge-wrap light mb-3">
                    <span class="sec-pill-line"></span>
                    <span class="sec-pill-badge light">
                      <i class="bi bi-handshake me-1" style="color: #dfbe8d;"></i> <?php echo esc_html( $settings['cta_badge'] ); ?>
                    </span>
                    <span class="sec-pill-line"></span>
                  </div>
                  <?php endif; ?>
                  <h2 class="sec-title text-white mb-3"><?php echo wp_kses_post( $settings['cta_title'] ); ?></h2>
                  <p class="text-white-50 mx-auto mb-4" style="max-width: 680px; font-size: 1.05rem; line-height: 1.6;">
                    <?php echo esc_html( $settings['cta_desc'] ); ?>
                  </p>
                  <div class="d-flex justify-content-center flex-wrap gap-3">
                    <?php if ( ! empty( $settings['cta_btn1_text'] ) ) : ?>
                    <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                      <span><?php echo esc_html( $settings['cta_btn1_text'] ); ?></span>
                      <i class="bi bi-arrow-right"></i>
                    </button>
                    <?php endif; ?>
                    <?php if ( ! empty( $settings['cta_btn2_text'] ) ) : ?>
                    <a href="<?php echo esc_url( ! empty( $settings['cta_btn2_url']['url'] ) ? $settings['cta_btn2_url']['url'] : home_url( '/menu/' ) ); ?>" class="btn-hero-outline">
                      <i class="bi bi-arrow-down-short text-warning"></i>
                      <span><?php echo esc_html( $settings['cta_btn2_text'] ); ?></span>
                    </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <div class="modal fade" id="enquiryModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content rounded-4 border-0 p-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                  <div>
                    <div class="sec-pill-badge-wrap mb-1">
                      <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> GET IN TOUCH</span>
                    </div>
                    <h4 class="modal-title font-heading fw-bold mt-1">Connect with Santino</h4>
                  </div>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <p class="text-muted small mb-4">Leave your details and our commercial coffee specialist will contact you promptly.</p>
                  <form class="santino-inquiry-form">
                    <input type="hidden" name="inquiry_type" value="our_story_inquiry">
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Full Name *</label>
                      <input type="text" name="name" class="form-control rounded-pill px-3 py-2 border-1" placeholder="Tanvir Ahmed" required style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); border-color: #d5e5e0;">
                    </div>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Phone Number *</label>
                      <input type="tel" name="phone" class="form-control rounded-pill px-3 py-2 border-1" placeholder="+880 1711-000000" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" required style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); border-color: #d5e5e0;">
                    </div>
                    <div class="mb-3">
                      <label class="form-label small fw-bold">Email Address *</label>
                      <input type="email" name="email" class="form-control rounded-pill px-3 py-2 border-1" placeholder="tanvir@example.com" required style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); border-color: #d5e5e0;">
                    </div>
                    <div class="mb-4">
                      <label class="form-label small fw-bold">Interested In</label>
                      <select name="service" class="form-select rounded-pill px-3 py-2 border-1" style="font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif); border-color: #d5e5e0;">
                        <option value="Commercial Espresso Machinery">Commercial Espresso Machinery</option>
                        <option value="Wholesale Coffee Beans (Rainforest Alliance)">Wholesale Coffee Beans (Rainforest Alliance)</option>
                        <option value="Barista Academy & Staff Training">Barista Academy &amp; Staff Training</option>
                        <option value="Cafe Franchise & VIP Membership">Cafe Franchise &amp; VIP Membership</option>
                      </select>
                    </div>
                    <button type="submit" class="btn-hero-lifestyle w-100 py-3 font-heading fw-bold text-uppercase">
                      SEND INQUIRY
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
}
