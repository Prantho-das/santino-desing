<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Machine_Services_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_machine_services';
    }

    public function get_title() {
        return esc_html__( 'Santino Espresso Machine Services (3x2 Cards)', 'santino' );
    }

    public function get_icon() {
        return 'eicon-wrench';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Services Header', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'TECHNICAL EXCELLENCE & SUPPORT',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Espresso Machine',
            )
        );

        $this->add_control(
            'title_italic',
            array(
                'label'   => esc_html__( 'Italic Accent Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Services',
            )
        );

        $this->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Expert care for your coffee equipment — keeping your business running smoothly, efficiently, and at its best.',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Service Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Installation & Setup',
            )
        );

        $repeater->add_control(
            'tag_badge',
            array(
                'label'   => esc_html__( 'Tag Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'INSTALLATION',
            )
        );

        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__( 'Icon Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-wrench',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Professional installation and setup for your espresso machines, ensuring optimal performance from day one.',
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Card Media Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg' ) : '',
                ),
            )
        );

        $repeater->add_control(
            'link_url',
            array(
                'label'   => esc_html__( 'Link URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '#enquiryModal' ),
            )
        );

        $this->add_control(
            'services',
            array(
                'label'       => esc_html__( 'Service Cards (6)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title'     => 'Installation & Setup',
                        'tag_badge' => 'INSTALLATION',
                        'icon'      => 'bi bi-wrench',
                        'desc'      => 'Professional installation and setup for your espresso machines, ensuring optimal performance from day one.',
                        'image'     => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg' ) : '' ),
                        'link_url'  => array( 'url' => '#enquiryModal' ),
                    ),
                    array(
                        'title'     => 'Preventive Maintenance (PM)',
                        'tag_badge' => 'PREVENTIVE',
                        'icon'      => 'bi bi-shield-check',
                        'desc'      => 'Regular maintenance to keep your machine running smoothly and extend its lifespan.',
                        'image'     => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_23_santino_-_250522-07495.jpg' ) : '' ),
                        'link_url'  => array( 'url' => '#enquiryModal' ),
                    ),
                    array(
                        'title'     => 'Emergency Breakdown & Repair',
                        'tag_badge' => 'EMERGENCY',
                        'icon'      => 'bi bi-lightning-charge-fill',
                        'desc'      => 'Fast and reliable repair services to get you back in business with minimal downtime.',
                        'image'     => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_31_blackeagle2.jpg' ) : '' ),
                        'link_url'  => array( 'url' => '#enquiryModal' ),
                    ),
                    array(
                        'title'     => '100% Genuine Spare Parts',
                        'tag_badge' => 'PARTS',
                        'icon'      => 'bi bi-gear-fill',
                        'desc'      => 'Original spare parts for lasting performance and peace of mind.',
                        'image'     => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_30_Blue-Stone-3_800x_526184df-2650-40b7-9dcf-e8af5b97527b.webp' ) : '' ),
                        'link_url'  => array( 'url' => '#enquiryModal' ),
                    ),
                    array(
                        'title'     => 'Onsite Barista & Staff Training',
                        'tag_badge' => 'TRAINING',
                        'icon'      => 'bi bi-people-fill',
                        'desc'      => 'Hands-on training to help your team make better coffee and get the most from your equipment.',
                        'image'     => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'bd-barista-latte-art.jpg' ) : '' ),
                        'link_url'  => array( 'url' => '#enquiryModal' ),
                    ),
                    array(
                        'title'     => 'Machine Relocation & Moving',
                        'tag_badge' => 'MOVING',
                        'icon'      => 'bi bi-truck',
                        'desc'      => 'Safe and professional relocation services for your espresso machines.',
                        'image'     => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp' ) : '' ),
                        'link_url'  => array( 'url' => '#enquiryModal' ),
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $services = ! empty( $settings['services'] ) ? $settings['services'] : array();
        ?>
        <section class="espresso-services-section" id="machine-services">
            <div class="service-corner-leaf service-leaf-left" aria-hidden="true">
                <svg viewBox="0 0 64 64" fill="currentColor">
                    <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
                </svg>
            </div>
            <div class="service-corner-leaf service-leaf-right" aria-hidden="true">
                <svg viewBox="0 0 64 64" fill="currentColor">
                    <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5z"/>
                </svg>
            </div>

            <div class="container position-relative" style="z-index: 2;">
                <div class="text-center mb-5">
                    <?php if ( ! empty( $settings['badge'] ) ) : ?>
                        <div class="sec-pill-badge-wrap mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-tools me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="service-section-title">
                        <?php echo esc_html( $settings['title'] ); ?> 
                        <?php if ( ! empty( $settings['title_italic'] ) ) : ?>
                            <em><?php echo esc_html( $settings['title_italic'] ); ?></em>
                        <?php endif; ?>
                    </h2>
                    <?php if ( ! empty( $settings['desc'] ) ) : ?>
                        <p class="service-section-desc"><?php echo esc_html( $settings['desc'] ); ?></p>
                    <?php endif; ?>
                </div>

                <div class="row g-4 align-items-stretch">
                    <?php foreach ( $services as $card ) : 
                        $img_url = ! empty( $card['image']['url'] ) ? esc_url( $card['image']['url'] ) : '';
                        $link_url = ! empty( $card['link_url']['url'] ) ? esc_url( $card['link_url']['url'] ) : '#';
                        $is_modal = strpos( $link_url, '#enquiryModal' ) !== false;
                        $icon = ! empty( $card['icon'] ) ? $card['icon'] : 'bi bi-wrench';
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-luxury-card">
                                <div class="service-card-info">
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <span class="service-icon-box"><i class="<?php echo esc_attr( $icon ); ?>"></i></span>
                                            <span class="service-tag-badge"><?php echo esc_html( $card['tag_badge'] ); ?></span>
                                        </div>
                                        <h5 class="service-card-title"><?php echo esc_html( $card['title'] ); ?></h5>
                                        <p class="service-card-desc"><?php echo esc_html( $card['desc'] ); ?></p>
                                    </div>
                                    <div>
                                        <?php if ( $is_modal ) : ?>
                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="service-card-link">
                                                Learn More <i class="bi bi-arrow-right"></i>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo $link_url; ?>" class="service-card-link">
                                                Learn More <i class="bi bi-arrow-right"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="service-card-media">
                                    <img src="<?php echo $img_url; ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" class="service-card-img" loading="lazy">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
