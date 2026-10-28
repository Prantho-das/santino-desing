<?php
/**
 * Elementor Barista Academy Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Academy_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_academy';
    }

    public function get_title() {
        return esc_html__( 'Santino Barista Academy Showcase', 'santino' );
    }

    public function get_icon() {
        return 'eicon-education';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Academy Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BARISTA ACADEMY',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Main Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Learn the Art of Great Coffee',
            )
        );

        $this->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Our Barista Academy offers professional training for coffee lovers, aspiring baristas, and corporate teams. Get hands-on experience, expert guidance, and real-world skills.',
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Academy',
            )
        );

        $this->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/training/' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__( 'Icon Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-cup-hot-fill',
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Feature Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Professional Training',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Feature Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Learn from certified trainers with industry experience.',
            )
        );

        $this->add_control(
            'slide1_img',
            array(
                'label'   => esc_html__( 'Carousel Slide 1 Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array( 'url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=1200&auto=format&fit=crop&q=80' ),
            )
        );

        $this->add_control(
            'slide2_img',
            array(
                'label'   => esc_html__( 'Carousel Slide 2 Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'bd-barista-latte-art.jpg' ) : '' ),
            )
        );

        $this->add_control(
            'slide3_img',
            array(
                'label'   => esc_html__( 'Carousel Slide 3 Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_23_santino_-_250522-07495.jpg' ) : '' ),
            )
        );

        $this->add_control(
            'mini_card1_img',
            array(
                'label'   => esc_html__( 'Mini Floating Card 1 Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array( 'url' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?w=300&auto=format&fit=crop&q=80' ),
            )
        );

        $this->add_control(
            'mini_card2_img',
            array(
                'label'   => esc_html__( 'Mini Floating Card 2 Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_24_santino_-_250522-07240.jpg' ) : '' ),
            )
        );

        $this->add_control(
            'promo_eyebrow',
            array(
                'label'   => esc_html__( 'Promo Card Eyebrow', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'FOR INDIVIDUALS & TEAMS',
            )
        );

        $this->add_control(
            'promo_title',
            array(
                'label'   => esc_html__( 'Promo Card Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Join Our Barista Academy',
            )
        );

        $this->add_control(
            'promo_desc',
            array(
                'label'   => esc_html__( 'Promo Card Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Build your skills. Grow your career. Be a part of our coffee community.',
            )
        );

        $this->add_control(
            'promo_btn_text',
            array(
                'label'   => esc_html__( 'Promo Button Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Learn More',
            )
        );

        $this->add_control(
            'promo_btn_url',
            array(
                'label'   => esc_html__( 'Promo Button URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/training/' ),
            )
        );

        $this->add_control(
            'features',
            array(
                'label'       => esc_html__( 'Feature Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'icon'  => 'bi bi-cup-hot-fill',
                        'title' => 'Professional Training',
                        'desc'  => 'Learn from certified trainers with industry experience.',
                    ),
                    array(
                        'icon'  => 'bi bi-people-fill',
                        'title' => 'Hands-on Practice',
                        'desc'  => 'Work with real equipment and live coffee stations.',
                    ),
                    array(
                        'icon'  => 'bi bi-patch-check-fill',
                        'title' => 'Certification',
                        'desc'  => 'Get a recognized certificate after course completion.',
                    ),
                    array(
                        'icon'  => 'bi bi-briefcase-fill',
                        'title' => 'Career Support',
                        'desc'  => 'Guidance for job placement and career growth.',
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $features = ! empty( $settings['features'] ) ? $settings['features'] : array();
        $btn_url = ! empty( $settings['btn_url']['url'] ) ? esc_url( $settings['btn_url']['url'] ) : home_url( '/training/' );
        $promo_btn_url = ! empty( $settings['promo_btn_url']['url'] ) ? esc_url( $settings['promo_btn_url']['url'] ) : home_url( '/training/' );
        $mini1 = ! empty( $settings['mini_card1_img']['url'] ) ? esc_url( $settings['mini_card1_img']['url'] ) : 'https://images.unsplash.com/photo-1534778101976-62847782c213?w=300&auto=format&fit=crop&q=80';
        $mini2 = ! empty( $settings['mini_card2_img']['url'] ) ? esc_url( $settings['mini_card2_img']['url'] ) : ( function_exists('santino_img') ? santino_img('imgi_24_santino_-_250522-07240.jpg') : '' );
        ?>
        <section class="barista-academy-home-section position-relative" id="academy">
            <div class="academy-float-leaf academy-leaf-1" title="Botanical Leaf" aria-hidden="true">
                <svg viewBox="0 0 64 64" fill="currentColor">
                    <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
                </svg>
            </div>
            <div class="academy-float-leaf teal academy-leaf-2" title="Coffee Branch" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
                </svg>
            </div>
            <div class="academy-float-leaf gold academy-leaf-3" title="Botanical Leaf" aria-hidden="true">
                <svg viewBox="0 0 64 64" fill="currentColor">
                    <path d="M5.5 58.5C6.8 40.2 18.2 23 34.6 16.4c5.7-2.3 12-3.4 18.4-3.4l5.5-7.5.8 8.8c-.1 5.4-1.5 10.8-4.1 15.6C47.1 47 28.5 57.3 5.5 58.5zm40.3-36c-3.8-2.6-8.3-4.2-12.9-4.8-4.5 6.2-7.5 13.5-8.7 21.2 7.3-7.8 15.9-13.4 21.6-16.4zm-2.1 7.2c-4.8 2.4-11.7 6.5-17.7 12.8-.4 2.2-.6 4.5-.7 6.8 6.9-.6 13.4-3.8 18.2-9 1.2-3.5 1.7-7.1.2-10.6z"/>
                </svg>
            </div>
            <div class="academy-float-leaf academy-leaf-4" title="Fresh Leaf" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/>
                </svg>
            </div>
            <div class="academy-float-leaf teal academy-leaf-5" title="Eco Leaf" aria-hidden="true">
                <svg viewBox="0 0 64 64" fill="currentColor">
                    <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
                </svg>
            </div>

            <div class="container py-2">
                <div class="row align-items-center g-4 g-lg-5 mb-5">
                    <div class="col-lg-5">
                        <?php if ( ! empty( $settings['badge'] ) ) : ?>
                            <div class="sec-pill-badge-wrap start mb-3">
                                <span class="sec-pill-line"></span>
                                <span class="sec-pill-badge"><i class="bi bi-mortarboard-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                                <span class="sec-pill-line"></span>
                            </div>
                        <?php endif; ?>
                        
                        <h2 class="sec-title mb-3" style="font-size: 2.35rem; line-height: 1.2;">
                            <?php echo esc_html( $settings['title'] ); ?>
                        </h2>
                        
                        <?php if ( ! empty( $settings['description'] ) ) : ?>
                            <p class="text-muted mb-4" style="font-size: 0.96rem; line-height: 1.65; max-width: 440px;">
                                <?php echo esc_html( $settings['description'] ); ?>
                            </p>
                        <?php endif; ?>
                        
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <a href="<?php echo $btn_url; ?>" class="btn btn-dark fw-bold px-4 py-2 rounded-pill shadow-sm" style="background: var(--kp-maroon); border: none; font-size: 13.5px; letter-spacing: 0.3px;">
                                <?php echo esc_html( $settings['btn_text'] ); ?> <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="btn btn-outline-dark fw-semibold px-4 py-2 rounded-pill d-inline-flex align-items-center gap-2" style="font-size: 13.5px; background: #ffffff;">
                                <i class="bi bi-play-circle fs-6"></i> <span>Watch Overview</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="position-relative">
                            <div id="baristaHeroCarousel" class="carousel slide carousel-fade rounded-4 overflow-hidden shadow-sm position-relative" data-bs-ride="carousel" data-bs-interval="3500" style="height: 380px; background: #111;">
                                <div class="carousel-inner h-100">
                                    <?php
                                    $s1 = ! empty( $settings['slide1_img']['url'] ) ? esc_url( $settings['slide1_img']['url'] ) : 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=1200&auto=format&fit=crop&q=80';
                                    $s2 = ! empty( $settings['slide2_img']['url'] ) ? esc_url( $settings['slide2_img']['url'] ) : ( function_exists('santino_img') ? santino_img('bd-barista-latte-art.jpg') : '' );
                                    $s3 = ! empty( $settings['slide3_img']['url'] ) ? esc_url( $settings['slide3_img']['url'] ) : ( function_exists('santino_img') ? santino_img('imgi_23_santino_-_250522-07495.jpg') : '' );
                                    ?>
                                    <div class="carousel-item active h-100">
                                        <img src="<?php echo $s1; ?>" alt="Freshly Ground Coffee Portafilter" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="<?php echo $s2; ?>" alt="Master Barista Pouring Latte Art" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="<?php echo $s3; ?>" alt="Commercial Espresso Dial-In" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                </div>
                                <div class="position-absolute top-0 start-0 m-4 text-white" style="font-family: var(--kp-font-title); font-style: italic; font-weight: 800; font-size: 1.5rem; line-height: 1.2; text-shadow: 0 2px 12px rgba(0,0,0,0.9); z-index: 2;">
                                    Better Baristas<br>Brew Better Stories
                                </div>
                                <div class="carousel-indicators mb-3 me-3 justify-content-end" style="z-index: 2;">
                                    <button type="button" data-bs-target="#baristaHeroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="width: 18px; height: 4px; border-radius: 4px;"></button>
                                    <button type="button" data-bs-target="#baristaHeroCarousel" data-bs-slide-to="1" aria-label="Slide 2" style="width: 18px; height: 4px; border-radius: 4px;"></button>
                                    <button type="button" data-bs-target="#baristaHeroCarousel" data-bs-slide-to="2" aria-label="Slide 3" style="width: 18px; height: 4px; border-radius: 4px;"></button>
                                </div>
                            </div>

                            <div class="position-absolute bottom-0 start-0 d-flex gap-2 p-2" style="transform: translate(-10px, 20px); z-index: 3;">
                                <div class="rounded-3 overflow-hidden shadow-sm border border-2 border-white" style="width: 105px; height: 105px; background: #fff;">
                                    <img src="<?php echo $mini1; ?>" alt="Latte Art Cup" class="w-100 h-100" style="object-fit: cover;">
                                </div>
                                <div class="rounded-3 overflow-hidden shadow-sm border border-2 border-white" style="width: 105px; height: 105px; background: #fff;">
                                    <img src="<?php echo $mini2; ?>" alt="Barista Classroom Training" class="w-100 h-100" style="object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 g-lg-4 align-items-stretch pt-2">
                    <?php foreach ( $features as $feat ) : ?>
                        <div class="col-md-6 col-lg-3 col-xl-2">
                            <div class="academy-feature-card">
                                <div class="academy-feature-icon">
                                    <i class="<?php echo esc_attr( $feat['icon'] ); ?>"></i>
                                </div>
                                <h6 class="academy-feature-title"><?php echo esc_html( $feat['title'] ); ?></h6>
                                <p class="academy-feature-desc"><?php echo esc_html( $feat['desc'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="col-md-12 col-lg-12 col-xl-4">
                        <div class="academy-promo-card">
                            <div>
                                <span class="text-uppercase fw-bold" style="font-size: 10.5px; letter-spacing: 0.8px; color: #fce79f;"><?php echo esc_html( $settings['promo_eyebrow'] ); ?></span>
                                <h5 class="fw-bold mt-1 mb-2 text-white" style="font-family: var(--kp-font-title);"><?php echo esc_html( $settings['promo_title'] ); ?></h5>
                                <p class="small mb-0" style="color: rgba(255,255,255,0.85); font-size: 12.5px; line-height: 1.45;">
                                    <?php echo esc_html( $settings['promo_desc'] ); ?>
                                </p>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="<?php echo $promo_btn_url; ?>" class="btn btn-sm btn-light fw-bold px-3 py-1 rounded-pill" style="color: #004642; font-size: 12px;">
                                    <?php echo esc_html( $settings['promo_btn_text'] ); ?> <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
