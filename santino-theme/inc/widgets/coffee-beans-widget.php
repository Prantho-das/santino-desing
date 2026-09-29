<?php
/**
 * Elementor Coffee Beans Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Coffee_Beans_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_coffee_beans';
    }

    public function get_title() {
        return esc_html__( 'Santino Specialty Beans', 'santino' );
    }

    public function get_icon() {
        return 'eicon-cup';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Coffee Beans Showcase', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Freshly Roasted Specialty Coffee Beans',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Single origin microlots and artisan espresso blends roasted fresh weekly in our Dhaka Roastery.',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'bean_name',
            array(
                'label'   => esc_html__( 'Bean / Blend Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Signature Espresso Blend',
            )
        );

        $repeater->add_control(
            'origin',
            array(
                'label'   => esc_html__( 'Origin & Altitude', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Ethiopia Yirgacheffe & Brazil Santos | 1800m',
            )
        );

        $repeater->add_control(
            'roast_level',
            array(
                'label'   => esc_html__( 'Roast Profile', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Medium-Dark Roast',
            )
        );

        $repeater->add_control(
            'tasting_notes',
            array(
                'label'   => esc_html__( 'Tasting Notes', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Dark Chocolate, Caramel, Roasted Hazelnut, Citrus Zest',
            )
        );

        $repeater->add_control(
            'price',
            array(
                'label'   => esc_html__( 'Price (BDT)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '৳ 1,450 / 500g',
            )
        );

        $repeater->add_control(
            'bean_image',
            array(
                'label'   => esc_html__( 'Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => SANTINO_URI . '/assets/images/Signature-coffee.png',
                ),
            )
        );

        $this->add_control(
            'beans_list',
            array(
                'label'       => esc_html__( 'Bean Varieties', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'bean_name'     => 'Santino Signature Dark Roast',
                        'origin'        => 'Brazil & Colombia Blend | 1650m',
                        'roast_level'   => 'Dark Roast (Full Body)',
                        'tasting_notes' => 'Molasses, Dark Cocoa, Smoky Cedar',
                        'price'         => '৳ 1,350 / 500g',
                        'bean_image'    => array( 'url' => SANTINO_URI . '/assets/images/Signature-coffee.png' ),
                    ),
                    array(
                        'bean_name'     => 'Ethiopia Guji Microlot',
                        'origin'        => 'Guji, Oromia, Ethiopia | 2100m',
                        'roast_level'   => 'Light-Medium Filter Roast',
                        'tasting_notes' => 'Jasmine, Bergamot, Blueberry, Peach',
                        'price'         => '৳ 1,850 / 250g',
                        'bean_image'    => array( 'url' => SANTINO_URI . '/assets/images/Signature-coffee.png' ),
                    ),
                ),
                'title_field' => '{{{ bean_name }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="beans-showcase-section py-5">
            <div class="container-fluid px-lg-5">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold font-heading text-dark"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <p class="text-muted mx-auto" style="max-width: 650px;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                </div>

                <div class="row g-4">
                    <?php foreach ( $settings['beans_list'] as $item ) : ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white hover-lift transition-all">
                                <div class="text-center mb-3">
                                    <img src="<?php echo esc_url( $item['bean_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['bean_name'] ); ?>" class="img-fluid" style="height: 200px; object-fit: contain;">
                                </div>
                                <h4 class="h5 fw-bold font-heading mb-1"><?php echo esc_html( $item['bean_name'] ); ?></h4>
                                <div class="badge bg-secondary mb-2"><?php echo esc_html( $item['roast_level'] ); ?></div>
                                <p class="small text-muted mb-2"><i class="bi bi-geo-alt text-danger me-1"></i> <?php echo esc_html( $item['origin'] ); ?></p>
                                <p class="small text-muted mb-3"><i class="bi bi-droplet-fill text-warning me-1"></i> <strong>Notes:</strong> <?php echo esc_html( $item['tasting_notes'] ); ?></p>
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                                    <span class="fw-bold text-dark fs-5"><?php echo esc_html( $item['price'] ); ?></span>
                                    <a href="<?php echo esc_url( home_url( '/beans' ) ); ?>" class="btn btn-dark btn-sm rounded-pill px-3">Order Fresh</a>
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
