<?php
/**
 * Elementor Office & Horeca Solutions Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Office_Horeca_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_office_horeca';
    }

    public function get_title() {
        return esc_html__( 'Santino Office & Horeca Solutions', 'santino' );
    }

    public function get_icon() {
        return 'eicon-office-building';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Office Cafe & B2B Solutions', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Corporate Office Cafe & Horeca Equipment Solutions',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Tailored coffee corner setups with one-touch bean-to-cup automation, monthly freshly roasted bean subscriptions, and comprehensive 24/7 AMC.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="horeca-section py-5 bg-white">
            <div class="container-fluid px-lg-5">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold mb-3">TURNKEY B2B SERVICES</div>
                        <h2 class="display-6 fw-bold font-heading text-dark mb-3"><?php echo esc_html( $settings['title'] ); ?></h2>
                        <p class="text-muted mb-4"><?php echo esc_html( $settings['subtitle'] ); ?></p>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="p-3 rounded-4 bg-light">
                                    <div class="h5 fw-bold text-dark mb-1"><i class="bi bi-gear-fill text-warning me-2"></i> Machine Rental</div>
                                    <p class="small text-muted mb-0">Flexible monthly leasing with zero capital expenditure.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 rounded-4 bg-light">
                                    <div class="h5 fw-bold text-dark mb-1"><i class="bi bi-shield-check text-success me-2"></i> AMC &amp; Preventive Care</div>
                                    <p class="small text-muted mb-0">Weekly servicing, descaling and replacement backup units.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <a href="<?php echo esc_url( home_url( '/office-cafe' ) ); ?>" class="btn btn-dark rounded-pill px-4 py-2 fw-bold">Explore Office Packages</a>
                            <button class="btn btn-outline-dark rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#enquiryModal">Request Consultation</button>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="p-4 rounded-4 bg-light shadow-sm text-center">
                            <img src="<?php echo santino_img( 'bd-office-coffee.jpg' ); ?>" alt="Office Cafe Setup" class="img-fluid rounded-4">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
