<?php
/**
 * Elementor Floating Metrics Bar Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Floating_Metrics_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_floating_metrics';
    }

    public function get_title() {
        return esc_html__( 'Santino Floating Metrics Bar', 'santino' );
    }

    public function get_icon() {
        return 'eicon-counter';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_metrics',
            array(
                'label' => esc_html__( '4 Metrics Cards', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        for ( $i = 1; $i <= 4; $i++ ) {
            $this->add_control(
                "metric{$i}_num",
                array(
                    'label'   => esc_html__( "Metric $i Number", 'santino' ),
                    'type'    => \Elementor\Controls_Manager::TEXT,
                    'default' => $i === 1 ? '500+' : ( $i === 2 ? '4 Hours' : ( $i === 3 ? '100%' : 'Zero' ) ),
                )
            );

            $this->add_control(
                "metric{$i}_label",
                array(
                    'label'   => esc_html__( "Metric $i Label", 'santino' ),
                    'type'    => \Elementor\Controls_Manager::TEXT,
                    'default' => $i === 1 ? 'Machines Installed' : ( $i === 2 ? 'Rapid Tech SLA' : ( $i === 3 ? 'OEM Italian Parts' : 'Downtime Warranty' ) ),
                )
            );

            $this->add_control(
                "metric{$i}_icon",
                array(
                    'label'   => esc_html__( "Metric $i Icon", 'santino' ),
                    'type'    => \Elementor\Controls_Manager::TEXT,
                    'default' => $i === 1 ? 'bi bi-gear-wide-connected' : ( $i === 2 ? 'bi bi-clock-history' : ( $i === 3 ? 'bi bi-cpu-fill' : 'bi bi-shield-check' ) ),
                )
            );
        }

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        ?>
        <div class="story-metrics-floating-wrap">
            <div class="container">
                <div class="row g-3 g-md-4 text-center justify-content-center">
                    <?php for ( $i = 1; $i <= 4; $i++ ) : 
                        $num = $s["metric{$i}_num"] ?? '';
                        $lbl = $s["metric{$i}_label"] ?? '';
                        $ico = $s["metric{$i}_icon"] ?? 'bi bi-check-circle-fill';
                        if ( empty( $num ) && empty( $lbl ) ) continue;
                    ?>
                        <div class="col-lg-3 col-6">
                            <div class="metric-card-pro">
                                <div class="metric-card-icon"><i class="<?php echo esc_attr( $ico ); ?>"></i></div>
                                <div class="metric-num"><?php echo esc_html( $num ); ?></div>
                                <div class="metric-label"><?php echo esc_html( $lbl ); ?></div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <?php
    }
}
