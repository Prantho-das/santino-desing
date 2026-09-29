<?php
/**
 * Elementor Call To Action & Booking Banner Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_CTA_Banner_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_cta_banner';
    }

    public function get_title() {
        return esc_html__( 'Santino CTA & Consultation Banner', 'santino' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Banner Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Main Heading', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Ready to Build or Upgrade Your Commercial Coffee Setup?',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Talk to our coffee machine experts for custom consultation, live demo booking, and quotation.',
            )
        );

        $this->add_control(
            'phone',
            array(
                'label'   => esc_html__( 'Hotline Number', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '+880 1700-000000',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="cta-banner-section py-5 my-4 mx-3 mx-lg-5 rounded-5 bg-gradient-dark text-white p-4 p-lg-5 text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #1f1a17 0%, #3a2e26 100%);">
            <div class="position-relative z-1 max-w-700 mx-auto">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">GET STARTED TODAY</span>
                <h2 class="display-6 fw-bold font-heading text-white mb-3"><?php echo esc_html( $settings['title'] ); ?></h2>
                <p class="text-light opacity-75 mb-4 mx-auto" style="max-width: 600px;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <button class="btn btn-warning btn-lg rounded-pill px-4 fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                        Drop an Enquiry
                    </button>
                    <a href="tel:<?php echo esc_attr( str_replace(' ', '', $settings['phone']) ); ?>" class="btn btn-outline-light btn-lg rounded-pill px-4 fw-bold">
                        <i class="bi bi-telephone-fill me-2 text-warning"></i> Call <?php echo esc_html( $settings['phone'] ); ?>
                    </a>
                </div>
            </div>
        </section>
        <?php
    }
}
