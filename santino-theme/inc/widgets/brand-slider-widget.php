<?php
/**
 * Elementor Brand Partners / Logos Carousel Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Brand_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_brand_slider';
    }

    public function get_title() {
        return esc_html__( 'Santino Global Brand Partners', 'santino' );
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Brand Partners', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Section Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Official Authorized Partners & Equipment Manufacturers',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'brand_name',
            array(
                'label'   => esc_html__( 'Brand Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Nuova Simonelli',
            )
        );

        $repeater->add_control(
            'country',
            array(
                'label'   => esc_html__( 'Country / Origin', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Italy',
            )
        );

        $repeater->add_control(
            'logo',
            array(
                'label'   => esc_html__( 'Brand Logo', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => SANTINO_URI . '/assets/images/Logo-Santino-Coffee-transparent.png',
                ),
            )
        );

        $this->add_control(
            'brands_list',
            array(
                'label'       => esc_html__( 'Brand List', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array( 'brand_name' => 'Nuova Simonelli', 'country' => 'Italy' ),
                    array( 'brand_name' => 'Victoria Arduino', 'country' => 'Italy' ),
                    array( 'brand_name' => 'CREM Expobar', 'country' => 'Sweden/Spain' ),
                    array( 'brand_name' => 'Kalerm Smart', 'country' => 'Global' ),
                    array( 'brand_name' => 'Rex Royal', 'country' => 'Switzerland' ),
                    array( 'brand_name' => '3TEMP Brewer', 'country' => 'Sweden' ),
                ),
                'title_field' => '{{{ brand_name }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="brand-slider-section py-4 bg-white border-top border-bottom">
            <div class="container-fluid px-lg-5">
                <p class="text-center text-uppercase text-muted fw-bold small mb-4 tracking-wider"><?php echo esc_html( $settings['title'] ); ?></p>
                <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 gap-lg-5">
                    <?php foreach ( $settings['brands_list'] as $item ) : ?>
                        <div class="brand-item text-center p-2">
                            <span class="fw-bold fs-5 font-heading text-dark text-opacity-75"><?php echo esc_html( $item['brand_name'] ); ?></span>
                            <span class="badge bg-light text-muted border ms-2 small"><?php echo esc_html( $item['country'] ); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }
}
