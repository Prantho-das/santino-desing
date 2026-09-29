<?php
/**
 * Elementor Stats Counter Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Stats_Counter_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_stats_counter';
    }

    public function get_title() {
        return esc_html__( 'Santino Impact Stats & Counters', 'santino' );
    }

    public function get_icon() {
        return 'eicon-counter';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Stats Counters', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'number',
            array(
                'label'   => esc_html__( 'Number / Stat', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '500+',
            )
        );

        $repeater->add_control(
            'label',
            array(
                'label'   => esc_html__( 'Stat Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Machines Deployed',
            )
        );

        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__( 'Icon Class (Bootstrap)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi-cpu-fill',
            )
        );

        $this->add_control(
            'stats_list',
            array(
                'label'       => esc_html__( 'Counters', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array( 'number' => '500+', 'label' => 'Commercial Espresso Machines', 'icon' => 'bi-cpu-fill' ),
                    array( 'number' => '1,200+', 'label' => 'Certified Baristas Graduated', 'icon' => 'bi-mortarboard-fill' ),
                    array( 'number' => '25,000+', 'label' => 'KG Coffee Freshly Roasted', 'icon' => 'bi-cup-hot-fill' ),
                    array( 'number' => '99.8%', 'label' => 'AMC Uptime Guarantee', 'icon' => 'bi-shield-check' ),
                ),
                'title_field' => '{{{ label }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="stats-counter-section py-5 bg-dark text-white">
            <div class="container-fluid px-lg-5">
                <div class="row g-4 text-center">
                    <?php foreach ( $settings['stats_list'] as $item ) : ?>
                        <div class="col-6 col-md-3">
                            <div class="p-3">
                                <i class="bi <?php echo esc_attr( $item['icon'] ); ?> text-warning fs-1 mb-2 d-block"></i>
                                <div class="display-5 fw-bold font-heading text-white mb-1"><?php echo esc_html( $item['number'] ); ?></div>
                                <div class="text-light opacity-75 small text-uppercase tracking-wider"><?php echo esc_html( $item['label'] ); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
