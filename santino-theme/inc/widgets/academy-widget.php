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
                        'desc'  => 'Job placement assistance with top partner cafes.',
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
        ?>
        <section class="barista-academy-home-section position-relative" id="academy">
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
                                    <div class="carousel-item active h-100">
                                        <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=1200&auto=format&fit=crop&q=80" alt="Freshly Ground Coffee Portafilter" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Master Barista Pouring Latte Art" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <div class="carousel-item h-100">
                                        <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="Commercial Espresso Dial-In" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                </div>
                                <div class="position-absolute top-0 start-0 m-4 text-white" style="font-family: var(--kp-font-title); font-style: italic; font-weight: 800; font-size: 1.5rem; line-height: 1.2; text-shadow: 0 2px 12px rgba(0,0,0,0.9); z-index: 2;">
                                    Better Baristas<br>Brew Better Stories
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 g-lg-4 align-items-stretch pt-2">
                    <?php foreach ( $features as $feat ) : ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="academy-feature-card">
                                <div class="academy-feature-icon">
                                    <i class="<?php echo esc_attr( $feat['icon'] ); ?>"></i>
                                </div>
                                <h6 class="academy-feature-title"><?php echo esc_html( $feat['title'] ); ?></h6>
                                <p class="academy-feature-desc"><?php echo esc_html( $feat['desc'] ); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
