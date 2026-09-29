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
        return esc_html__( 'Santino Hero Banner', 'santino' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Hero Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'OFFICIAL IMPORTER & ROASTERY',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Main Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Commercial Espresso Machines & Fresh Specialty Roastery in Bangladesh',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Authorized distributor of Nuova Simonelli, Victoria Arduino, CREM, Kalerm & 3TEMP. Complete turnkey setup with 24/7 technical AMC support.',
            )
        );

        $this->add_control(
            'btn1_text',
            array(
                'label'   => esc_html__( 'Primary Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'EXPLORE MACHINES',
            )
        );

        $this->add_control(
            'btn1_url',
            array(
                'label'   => esc_html__( 'Primary Button URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/machines' ),
            )
        );

        $this->add_control(
            'btn2_text',
            array(
                'label'   => esc_html__( 'Secondary Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BOOK DEMO',
            )
        );

        $this->add_control(
            'btn2_url',
            array(
                'label'   => esc_html__( 'Secondary Button URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '#enquiryModal' ),
            )
        );

        $this->add_control(
            'hero_image',
            array(
                'label'   => esc_html__( 'Hero Machine Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => SANTINO_URI . '/assets/images/appia-life-front.png',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="hero-section py-5 position-relative overflow-hidden">
            <div class="container-fluid px-lg-5">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <?php if ( ! empty( $settings['badge_text'] ) ) : ?>
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-warning bg-opacity-25 text-dark fw-bold small mb-3 border border-warning border-opacity-50">
                                <i class="bi bi-patch-check-fill text-warning"></i>
                                <?php echo esc_html( $settings['badge_text'] ); ?>
                            </div>
                        <?php endif; ?>

                        <h1 class="display-4 fw-black font-heading text-dark mb-3">
                            <?php echo wp_kses_post( $settings['title'] ); ?>
                        </h1>

                        <p class="lead text-muted mb-4">
                            <?php echo wp_kses_post( $settings['subtitle'] ); ?>
                        </p>

                        <div class="d-flex flex-wrap gap-3 mb-4">
                            <?php if ( ! empty( $settings['btn1_text'] ) ) : ?>
                                <a href="<?php echo esc_url( $settings['btn1_url']['url'] ); ?>" class="btn btn-dark btn-lg rounded-pill px-4 fw-bold">
                                    <?php echo esc_html( $settings['btn1_text'] ); ?>
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ( ! empty( $settings['btn2_text'] ) ) : ?>
                                <a href="<?php echo esc_url( $settings['btn2_url']['url'] ); ?>" class="btn btn-outline-dark btn-lg rounded-pill px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                                    <?php echo esc_html( $settings['btn2_text'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex align-items-center gap-4 pt-3 border-top">
                            <div>
                                <div class="h4 fw-bold mb-0 text-dark">500+</div>
                                <div class="text-muted small">Machines Installed</div>
                            </div>
                            <div class="vr"></div>
                            <div>
                                <div class="h4 fw-bold mb-0 text-dark">24/7</div>
                                <div class="text-muted small">Technical Support</div>
                            </div>
                            <div class="vr"></div>
                            <div>
                                <div class="h4 fw-bold mb-0 text-dark">100%</div>
                                <div class="text-muted small">Genuine Spare Parts</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 text-center position-relative">
                        <div class="hero-image-wrap p-4">
                            <?php if ( ! empty( $settings['hero_image']['url'] ) ) : ?>
                                <img src="<?php echo esc_url( $settings['hero_image']['url'] ); ?>" alt="Commercial Coffee Machine" class="img-fluid rounded-4 drop-shadow-hero" style="max-height: 480px; object-fit: contain;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
