<?php
/**
 * Elementor Services / 24/7 AMC Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Services_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_services';
    }

    public function get_title() {
        return esc_html__( 'Santino Technical AMC & Services', 'santino' );
    }

    public function get_icon() {
        return 'eicon-tools';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Services Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '24/7 Technical Support & Maintenance Service',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Ensure zero downtime for your commercial cafe with certified technicians and 100% genuine factory spare parts in stock.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="machine-services" class="services-section py-5 bg-white">
            <div class="container-fluid px-lg-5">
                <div class="text-center mb-5">
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold mb-2">OFFICIAL SERVICE CENTER</span>
                    <h2 class="display-6 fw-bold font-heading text-dark"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <p class="text-muted mx-auto" style="max-width: 650px;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="p-4 rounded-4 bg-light h-100 border-0 hover-lift transition-all">
                            <div class="service-icon-box mb-3 text-warning fs-1"><i class="bi bi-gear-wide-connected"></i></div>
                            <h4 class="h5 fw-bold font-heading mb-2">Turnkey Installation</h4>
                            <p class="small text-muted mb-0">Professional plumbing, water filtration setup, electrical calibration, and pressure profiling.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="p-4 rounded-4 bg-light h-100 border-0 hover-lift transition-all">
                            <div class="service-icon-box mb-3 text-danger fs-1"><i class="bi bi-clock-history"></i></div>
                            <h4 class="h5 fw-bold font-heading">24/7 Emergency AMC</h4>
                            <p class="small text-muted mb-0">Guaranteed 4-hour on-site response time across Dhaka, Chittagong, and Sylhet.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="p-4 rounded-4 bg-light h-100 border-0 hover-lift transition-all">
                            <div class="service-icon-box mb-3 text-success fs-1"><i class="bi bi-patch-check-fill"></i></div>
                            <h4 class="h5 fw-bold font-heading">OEM Spare Parts</h4>
                            <p class="small text-muted mb-0">Direct import of genuine Italian heating elements, solenoids, portafilters, and group gaskets.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="p-4 rounded-4 bg-light h-100 border-0 hover-lift transition-all">
                            <div class="service-icon-box mb-3 text-primary fs-1"><i class="bi bi-shield-shaded"></i></div>
                            <h4 class="h5 fw-bold font-heading">Preventive Maintenance</h4>
                            <p class="small text-muted mb-0">Scheduled descaling, boiler safety valve inspection, and grinder burr realignment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
