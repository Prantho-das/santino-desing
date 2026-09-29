<?php
/**
 * Elementor Machine Grid Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Machine_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_machine_grid';
    }

    public function get_title() {
        return esc_html__( 'Santino Machine Grid', 'santino' );
    }

    public function get_icon() {
        return 'eicon-products-grid';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Machine Showcase', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'section_title',
            array(
                'label'   => esc_html__( 'Section Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Commercial Espresso & Automation Lineup',
            )
        );

        $this->add_control(
            'section_subtitle',
            array(
                'label'   => esc_html__( 'Section Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Engineered for high-volume cafes, specialty coffee bars, hotels and corporate boardrooms.',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'machine_title',
            array(
                'label'   => esc_html__( 'Model Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Nuova Simonelli Appia Life',
            )
        );

        $repeater->add_control(
            'brand_badge',
            array(
                'label'   => esc_html__( 'Brand Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Italy',
            )
        );

        $repeater->add_control(
            'specs',
            array(
                'label'   => esc_html__( 'Key Specs', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '2 Groups | Dual Steam | SIS Pre-infusion',
            )
        );

        $repeater->add_control(
            'capacity',
            array(
                'label'   => esc_html__( 'Daily Capacity', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '250 - 400 cups/day',
            )
        );

        $repeater->add_control(
            'machine_image',
            array(
                'label'   => esc_html__( 'Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => SANTINO_URI . '/assets/images/appia-life-front.png',
                ),
            )
        );

        $this->add_control(
            'machines_list',
            array(
                'label'       => esc_html__( 'Machines', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'machine_title' => 'Nuova Simonelli Appia Life 2G',
                        'brand_badge'   => 'ITALY',
                        'specs'         => '2 Group Volumetric | SIS Infusion | Auto Clean',
                        'capacity'      => '300-500 cups / day',
                        'machine_image' => array( 'url' => SANTINO_URI . '/assets/images/appia-life-front.png' ),
                    ),
                    array(
                        'machine_title' => 'Victoria Arduino E1 Prima',
                        'brand_badge'   => 'FLAGSHIP',
                        'specs'         => 'Single Group Specialty | App Controlled | NEO Engine',
                        'capacity'      => '150-250 cups / day',
                        'machine_image' => array( 'url' => SANTINO_URI . '/assets/images/victoria-arduino-e1-prima.png' ),
                    ),
                    array(
                        'machine_title' => 'Kalerm K95L Smart Bean-to-Cup',
                        'brand_badge'   => 'AUTOMATIC',
                        'specs'         => 'Touchscreen | Fresh Milk Frother | Dual Boiler',
                        'capacity'      => '120-200 cups / day',
                        'machine_image' => array( 'url' => SANTINO_URI . '/assets/images/kalerm-k95.png' ),
                    ),
                ),
                'title_field' => '{{{ machine_title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="machine-showcase-section py-5 bg-light">
            <div class="container-fluid px-lg-5">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold font-heading text-dark"><?php echo esc_html( $settings['section_title'] ); ?></h2>
                    <p class="text-muted mx-auto" style="max-width: 650px;"><?php echo esc_html( $settings['section_subtitle'] ); ?></p>
                </div>

                <div class="row g-4">
                    <?php foreach ( $settings['machines_list'] as $item ) : ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 rounded-4 shadow-sm p-3 bg-white position-relative hover-lift transition-all">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-dark rounded-pill px-3 py-2 text-uppercase"><?php echo esc_html( $item['brand_badge'] ); ?></span>
                                </div>
                                <div class="text-center p-3">
                                    <img src="<?php echo esc_url( $item['machine_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['machine_title'] ); ?>" class="img-fluid" style="height: 220px; object-fit: contain;">
                                </div>
                                <div class="card-body px-2 pb-2">
                                    <h4 class="h5 fw-bold font-heading mb-2"><?php echo esc_html( $item['machine_title'] ); ?></h4>
                                    <p class="text-muted small mb-2"><i class="bi bi-gear-wide-connected me-1 text-warning"></i> <?php echo esc_html( $item['specs'] ); ?></p>
                                    <p class="text-muted small mb-3"><i class="bi bi-speedometer2 me-1 text-success"></i> <?php echo esc_html( $item['capacity'] ); ?></p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-outline-dark btn-sm rounded-pill flex-grow-1" data-bs-toggle="modal" data-bs-target="#enquiryModal">Get Quote</button>
                                        <a href="https://wa.me/8801700000000?text=I am interested in <?php echo urlencode($item['machine_title']); ?>" target="_blank" class="btn btn-success btn-sm rounded-pill px-3"><i class="bi bi-whatsapp"></i></a>
                                    </div>
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
