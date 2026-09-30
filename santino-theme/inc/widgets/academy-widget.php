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
        return esc_html__( 'Santino Barista Academy', 'santino' );
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
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Professional Barista Certification & Roastery Academy',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Hands-on practical training on commercial multi-boiler espresso machines, latte art mastery, sensoric cupping, and cafe operations in Dhaka.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="academy-section py-5 bg-dark text-white rounded-5 my-4 mx-3 mx-lg-5 p-4 p-lg-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">SCA CERTIFIED CURRICULUM</span>
                    <h2 class="display-6 fw-bold font-heading text-white mb-3"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <p class="text-light opacity-75 mb-4"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="p-3 bg-white bg-opacity-10 rounded-3 border border-white border-opacity-10">
                                <i class="bi bi-award-fill text-warning fs-4 mb-2 d-block"></i>
                                <h5 class="h6 fw-bold text-white mb-1">Commercial Barista Foundation</h5>
                                <p class="small text-light opacity-75 mb-0">Espresso extraction dial-in, milk steaming microfoam &amp; machine upkeep.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-white bg-opacity-10 rounded-3 border border-white border-opacity-10">
                                <i class="bi bi-cup-straw text-warning fs-4 mb-2 d-block"></i>
                                <h5 class="h6 fw-bold text-white mb-1">Advanced Latte Art &amp; Brewing</h5>
                                <p class="small text-light opacity-75 mb-0">Free-pour rosetta, swan, V60, Chemex &amp; AeroPress recipes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?php echo esc_url( home_url( '/training' ) ); ?>" class="btn btn-warning rounded-pill px-4 py-2 fw-bold text-dark">Enroll Course</a>
                        <a href="https://wa.me/8801606291393?text=I want to join Barista Training" target="_blank" class="btn btn-outline-light rounded-pill px-4 py-2"><i class="bi bi-whatsapp me-1"></i> WhatsApp Inquiry</a>
                    </div>
                </div>

                <div class="col-lg-5 text-center">
                    <img src="<?php echo santino_img( 'banner-2.png' ); ?>" alt="Barista Academy" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </section>
        <?php
    }
}
