<?php
/**
 * Elementor Hero Banner Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Hero_Banner_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_hero_banner';
    }

    public function get_title() {
        return esc_html__( 'Santino Hero Slider (5-Slides & Video)', 'santino' );
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_slides',
            array(
                'label' => esc_html__( 'Hero Slides', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'eyebrow',
            array(
                'label'   => esc_html__( 'Eyebrow Tag', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'CARE PARTNER & B2B EXPANSION',
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Main Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Expansion Coffee Business,',
            )
        );

        $repeater->add_control(
            'title_italic',
            array(
                'label'   => esc_html__( 'Italic Accent Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'In Bangladesh',
            )
        );

        $repeater->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Turnkey commercial coffee solutions — Italian espresso machinery leases, 4-hour rapid technical care SLA, custom artisan roasting, and cafe consulting.',
            )
        );

        $repeater->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Button Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore B2B Solutions',
            )
        );

        $repeater->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '#enquiryModal' ),
            )
        );

        $repeater->add_control(
            'bg_type',
            array(
                'label'   => esc_html__( 'Background Type', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'video' => 'Video Background',
                    'image' => 'Image Background',
                ),
                'default' => 'video',
            )
        );

        $repeater->add_control(
            'bg_image',
            array(
                'label'   => esc_html__( 'Background / Poster Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => SANTINO_URI . '/assets/images/bd-barista-latte-art.jpg',
                ),
            )
        );

        $repeater->add_control(
            'bg_video_url',
            array(
                'label'   => esc_html__( 'MP4 Video URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => SANTINO_URI . '/assets/videos/coffee_espresso_video.mp4',
                'condition' => array( 'bg_type' => 'video' ),
            )
        );

        $repeater->add_control(
            'feat1_icon',
            array(
                'label'   => esc_html__( 'Feature 1 Icon Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-gear-wide-connected',
            )
        );
        $repeater->add_control(
            'feat1_text',
            array(
                'label'   => esc_html__( 'Feature 1 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Italian Espresso<br>Machinery',
            )
        );

        $repeater->add_control(
            'feat2_icon',
            array(
                'label'   => esc_html__( 'Feature 2 Icon Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-clock-history',
            )
        );
        $repeater->add_control(
            'feat2_text',
            array(
                'label'   => esc_html__( 'Feature 2 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '4-Hour Rapid<br>Service SLA',
            )
        );

        $repeater->add_control(
            'feat3_icon',
            array(
                'label'   => esc_html__( 'Feature 3 Icon Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-shield-check',
            )
        );
        $repeater->add_control(
            'feat3_text',
            array(
                'label'   => esc_html__( 'Feature 3 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Turnkey Care<br>Partnership',
            )
        );

        $this->add_control(
            'slides',
            array(
                'label'       => esc_html__( 'Slider Items', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'eyebrow'      => 'CARE PARTNER & B2B EXPANSION',
                        'title'        => 'Expansion Coffee Business,',
                        'title_italic' => 'In Bangladesh',
                        'description'  => 'Turnkey commercial coffee solutions — Italian espresso machinery leases, 4-hour rapid technical care SLA, custom artisan roasting, and cafe consulting.',
                        'btn_text'     => 'Explore B2B Solutions',
                        'btn_url'      => array( 'url' => '#enquiryModal' ),
                        'bg_type'      => 'video',
                        'bg_image'     => array( 'url' => SANTINO_URI . '/assets/images/bd-barista-latte-art.jpg' ),
                        'bg_video_url' => SANTINO_URI . '/assets/videos/coffee_espresso_video.mp4',
                        'feat1_icon'   => 'bi bi-gear-wide-connected',
                        'feat1_text'   => 'Italian Espresso<br>Machinery',
                        'feat2_icon'   => 'bi bi-clock-history',
                        'feat2_text'   => '4-Hour Rapid<br>Service SLA',
                        'feat3_icon'   => 'bi bi-shield-check',
                        'feat3_text'   => 'Turnkey Care<br>Partnership',
                    ),
                    array(
                        'eyebrow'      => 'OFFICIAL FOODSERVICE PARTNER',
                        'title'        => 'Signature Espresso Bar,',
                        'title_italic' => 'Across 50+ BFC Outlets',
                        'description'  => 'Commercial 9-bar Italian espresso stations, custom roasted barista blend beans, and WBC-standard staff training powering dining across 50+ BFC restaurants nationwide.',
                        'btn_text'     => 'Visit BFC Brand Page',
                        'btn_url'      => array( 'url' => '/bfc/' ),
                        'bg_type'      => 'image',
                        'bg_image'     => array( 'url' => SANTINO_URI . '/assets/images/bfc_santino_foodservice.jpg' ),
                        'feat1_icon'   => 'bi bi-shop',
                        'feat1_text'   => '50+ BFC<br>Outlets',
                        'feat2_icon'   => 'bi bi-cup-hot',
                        'feat2_text'   => 'Fresh Barista<br>Coffee Blend',
                        'feat3_icon'   => 'bi bi-award',
                        'feat3_text'   => 'WBC Standard<br>Staff Training',
                    ),
                    array(
                        'eyebrow'      => 'RETAIL SUPERSTORE PARTNER',
                        'title'        => 'Specialty Retail Coffee,',
                        'title_italic' => 'At 100+ Shwapno Shelves',
                        'description'  => 'Freshly roasted whole bean & fine ground coffee packs with one-way degassing valves and in-store grinding booths available across 100+ Shwapno superstores.',
                        'btn_text'     => 'Visit Shwapno Page',
                        'btn_url'      => array( 'url' => '/swapno/' ),
                        'bg_type'      => 'image',
                        'bg_image'     => array( 'url' => SANTINO_URI . '/assets/images/shwapno_santino_retail.jpg' ),
                        'feat1_icon'   => 'bi bi-cart3',
                        'feat1_text'   => '100+ Shwapno<br>Superstores',
                        'feat2_icon'   => 'bi bi-flower1',
                        'feat2_text'   => 'Whole Bean &<br>Fine Ground',
                        'feat3_icon'   => 'bi bi-box-seam',
                        'feat3_text'   => 'Degassing Valve<br>Aroma Seal',
                    ),
                    array(
                        'eyebrow'      => '90+ SCA MICRO-LOT ROASTERY',
                        'title'        => 'Direct Trade Origins,',
                        'title_italic' => '& Roasting Mastery',
                        'description'  => 'Single-origin micro-lots directly sourced from Ethiopia, Colombia & Guatemala. Precision batch roasting preserves peak aromatic notes and golden crema.',
                        'btn_text'     => 'Explore Bean Roasts',
                        'btn_url'      => array( 'url' => '/beans/' ),
                        'bg_type'      => 'video',
                        'bg_image'     => array( 'url' => SANTINO_URI . '/assets/images/imgi_4_pexels-sikunovruslan-11942442.jpg' ),
                        'bg_video_url' => SANTINO_URI . '/assets/videos/coffee_roasting_video.webm',
                        'feat1_icon'   => 'bi bi-fire',
                        'feat1_text'   => 'Drum Batch<br>Roasting',
                        'feat2_icon'   => 'bi bi-globe-americas',
                        'feat2_text'   => 'Direct Trade<br>Ethiopia & Colombia',
                        'feat3_icon'   => 'bi bi-patch-check',
                        'feat3_text'   => 'FSSC 22000<br>Certified',
                    ),
                    array(
                        'eyebrow'      => 'ITALIAN ENGINEERING & CARE SLA',
                        'title'        => 'Turnkey Espresso Business,',
                        'title_italic' => '& 4-Hour Service SLA',
                        'description'  => 'Official distributor of Victoria Arduino, Nuova Simonelli, and Kalerm. Providing guaranteed 4-hour on-site maintenance, barista calibration, and zero-capex leasing.',
                        'btn_text'     => 'Discover Machines',
                        'btn_url'      => array( 'url' => '/machines/' ),
                        'bg_type'      => 'video',
                        'bg_image'     => array( 'url' => SANTINO_URI . '/assets/images/imgi_218_blackeagle2.jpg' ),
                        'bg_video_url' => SANTINO_URI . '/assets/videos/coffee_espresso_video.mp4',
                        'feat1_icon'   => 'bi bi-gear',
                        'feat1_text'   => 'Victoria Arduino<br>& Simonelli',
                        'feat2_icon'   => 'bi bi-tools',
                        'feat2_text'   => '4-Hour SLA<br>On-site AMC',
                        'feat3_icon'   => 'bi bi-cash-stack',
                        'feat3_text'   => 'Zero-Capex<br>Lease Plans',
                    ),
                ),
                'title_field' => '{{{ eyebrow }}} — {{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $slides = ! empty( $settings['slides'] ) ? $settings['slides'] : array();
        if ( empty( $slides ) ) {
            return;
        }
        ?>
        <section class="hero-banner-section position-relative">
            <div id="heroCarousel" class="carousel slide carousel-fade hero-carousel" data-bs-ride="carousel" data-bs-interval="6500">
                <div class="carousel-inner">
                    <?php foreach ( $slides as $index => $slide ) : 
                        $is_active = $index === 0 ? 'active' : '';
                        $is_video = ( isset( $slide['bg_type'] ) && $slide['bg_type'] === 'video' ) && ! empty( $slide['bg_video_url'] );
                        $bg_img = ! empty( $slide['bg_image']['url'] ) ? esc_url( $slide['bg_image']['url'] ) : '';
                        $btn_url = ! empty( $slide['btn_url']['url'] ) ? esc_url( $slide['btn_url']['url'] ) : '#';
                        $is_modal = strpos( $btn_url, '#enquiryModal' ) !== false;
                    ?>
                        <div class="carousel-item <?php echo esc_attr( $is_active ); ?> hero-carousel-item position-relative overflow-hidden" <?php if ( ! $is_video && $bg_img ) : ?>style="background-image: url('<?php echo $bg_img; ?>'); background-position: center 30%;"<?php endif; ?>>
                            <?php if ( $is_video ) : ?>
                                <div class="hero-video-wrap">
                                    <video class="hero-video-bg" autoplay muted loop playsinline poster="<?php echo $bg_img; ?>">
                                        <source src="<?php echo esc_url( $slide['bg_video_url'] ); ?>" type="video/mp4">
                                    </video>
                                </div>
                            <?php endif; ?>
                            <div class="hero-overlay"></div>
                            <div class="container hero-content my-auto position-relative" style="z-index: 2;">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 col-lg-9 hero-content-wrap">
                                        <?php if ( ! empty( $slide['eyebrow'] ) ) : ?>
                                            <div class="hero-slider-eyebrow"><?php echo esc_html( $slide['eyebrow'] ); ?></div>
                                        <?php endif; ?>

                                        <h1 class="hero-lifestyle-title">
                                            <?php echo esc_html( $slide['title'] ); ?><br>
                                            <?php if ( ! empty( $slide['title_italic'] ) ) : ?>
                                                <span class="hero-italic-serif"><?php echo esc_html( $slide['title_italic'] ); ?></span>
                                            <?php endif; ?>
                                        </h1>

                                        <?php if ( ! empty( $slide['description'] ) ) : ?>
                                            <p class="hero-lifestyle-desc">
                                                <?php echo esc_html( $slide['description'] ); ?>
                                            </p>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $slide['btn_text'] ) ) : ?>
                                            <div>
                                                <?php if ( $is_modal ) : ?>
                                                    <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                                                        <?php echo esc_html( $slide['btn_text'] ); ?> <i class="bi bi-arrow-right"></i>
                                                    </button>
                                                <?php else : ?>
                                                    <a href="<?php echo $btn_url; ?>" class="btn-hero-lifestyle">
                                                        <?php echo esc_html( $slide['btn_text'] ); ?> <i class="bi bi-arrow-right"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Feature Strip -->
                                        <div class="hero-features-strip">
                                            <?php if ( ! empty( $slide['feat1_text'] ) ) : ?>
                                                <div class="hero-feature-unit">
                                                    <i class="<?php echo esc_attr( $slide['feat1_icon'] ); ?>"></i>
                                                    <div class="hero-feature-text"><?php echo wp_kses_post( $slide['feat1_text'] ); ?></div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="hero-feature-sep"></div>
                                            <?php if ( ! empty( $slide['feat2_text'] ) ) : ?>
                                                <div class="hero-feature-unit">
                                                    <i class="<?php echo esc_attr( $slide['feat2_icon'] ); ?>"></i>
                                                    <div class="hero-feature-text"><?php echo wp_kses_post( $slide['feat2_text'] ); ?></div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="hero-feature-sep"></div>
                                            <?php if ( ! empty( $slide['feat3_text'] ) ) : ?>
                                                <div class="hero-feature-unit">
                                                    <i class="<?php echo esc_attr( $slide['feat3_icon'] ); ?>"></i>
                                                    <div class="hero-feature-text"><?php echo wp_kses_post( $slide['feat3_text'] ); ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="hero-nav-arrow hero-nav-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous Slide">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <button class="hero-nav-arrow hero-nav-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next Slide">
                    <i class="bi bi-arrow-right"></i>
                </button>

                <div class="hero-vertical-pagination d-none d-lg-flex">
                    <span class="hero-slide-counter-num" id="heroSlideCounter">01 / <?php echo str_pad( count( $slides ), 2, '0', STR_PAD_LEFT ); ?></span>
                    <ul class="hero-vert-dot-list">
                        <?php foreach ( $slides as $i => $s ) : ?>
                            <li class="hero-vert-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo $i; ?>"></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="hero-lifestyle-indicators">
                    <?php foreach ( $slides as $i => $s ) : ?>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-current="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo ( $i + 1 ); ?>"></button>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
