<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Story_Chapters_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_story_chapters';
    }

    public function get_title() {
        return esc_html__( 'Santino Story: Heritage Chapters', 'santino' );
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_chapters',
            array(
                'label' => esc_html__( 'Story Chapters', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $rep = new \Elementor\Repeater();
        $rep->add_control( 'badge', array( 'label' => esc_html__( 'Chapter Badge', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'CHAPTER 01' ) );
        $rep->add_control( 'title', array( 'label' => esc_html__( 'Chapter Title (HTML)', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Artisan Roasting &amp; <span class="sec-title-accent">Quality Without Compromise</span>' ) );
        $rep->add_control( 'desc', array( 'label' => esc_html__( 'Description', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => '' ) );
        $rep->add_control( 'bullets', array( 'label' => esc_html__( 'Bullet Points (One per line, "Bold Title: text")', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => '' ) );
        $rep->add_control( 'image', array( 'label' => esc_html__( 'Chapter Image', 'santino' ), 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => array( 'url' => '' ) ) );
        $rep->add_control( 'fallback_img', array( 'label' => esc_html__( 'Fallback Asset Filename', 'santino' ), 'type' => \Elementor\Controls_Manager::HIDDEN, 'default' => 'bd-barista-latte-art.jpg' ) );
        $rep->add_control( 'img_badge_icon', array( 'label' => esc_html__( 'Image Badge Icon', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'bi bi-fire text-danger fs-4' ) );
        $rep->add_control( 'img_badge_title', array( 'label' => esc_html__( 'Image Badge Title', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Artisan Roastery Lab' ) );
        $rep->add_control( 'img_badge_sub', array( 'label' => esc_html__( 'Image Badge Subtitle', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Small Batch Custom Roasts' ) );
        $rep->add_control( 'btn_text', array( 'label' => esc_html__( 'Button Text', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Explore More' ) );
        $rep->add_control( 'btn_url', array( 'label' => esc_html__( 'Button Link', 'santino' ), 'type' => \Elementor\Controls_Manager::URL, 'default' => array( 'url' => '/beans/' ) ) );
        $rep->add_control( 'reverse_layout', array( 'label' => esc_html__( 'Reverse Image/Text Side', 'santino' ), 'type' => \Elementor\Controls_Manager::SWITCHER, 'default' => '' ) );

        $this->add_control(
            'chapters_list',
            array(
                'label'       => esc_html__( 'Chapters', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $rep->get_controls(),
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
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        if ( empty( $s['chapters_list'] ) ) {
            return;
        }
        $total = count( $s['chapters_list'] );
        ?>
        <section class="story-split-chapters-section py-5 position-relative">
          <div class="container">
            <?php foreach ( $s['chapters_list'] as $idx => $ch ) :
                $is_last    = ( $idx === $total - 1 );
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
        <?php
    }
}
