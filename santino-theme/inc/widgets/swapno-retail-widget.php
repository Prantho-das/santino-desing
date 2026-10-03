<?php
/**
 * Elementor Swapno Retail Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Swapno_Retail_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_swapno_retail';
    }

    public function get_title() {
        return esc_html__( 'Santino Shwapno Retail Showcase', 'santino' );
    }

    public function get_icon() {
        return 'eicon-store';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Shwapno Retail Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Santino Fresh Beans at Shwapno Superstores',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Grab freshly roasted 100% Arabica whole beans and ground coffee from your nearest Shwapno superstore.',
            )
        );

        $this->add_control(
            'banner_badge',
            array(
                'label'   => esc_html__( 'Banner Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Available Across 80+ Shwapno Outlets',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'outlet_name',
            array(
                'label'   => esc_html__( 'Outlet Name / Area', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Gulshan 1 Outlet',
            )
        );

        $repeater->add_control(
            'address',
            array(
                'label'   => esc_html__( 'Address / Landmark', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Road 132, Gulshan Avenue, Dhaka',
            )
        );

        $repeater->add_control(
            'hours',
            array(
                'label'   => esc_html__( 'Hours', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '8:00 AM - 11:00 PM (Daily)',
            )
        );

        $this->add_control(
            'outlets_list',
            array(
                'label'       => esc_html__( 'Key Outlets', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'outlet_name' => 'Shwapno Flagship Gulshan 1',
                        'address'     => 'Gulshan South Avenue, Dhaka 1212',
                        'hours'       => '8:00 AM - 11:30 PM',
                    ),
                    array(
                        'outlet_name' => 'Shwapno Banani 11',
                        'address'     => 'Road 11, Block D, Banani, Dhaka',
                        'hours'       => '8:30 AM - 11:00 PM',
                    ),
                    array(
                        'outlet_name' => 'Shwapno Dhanmondi 27',
                        'address'     => 'Old 27, Rangs Fortune Square, Dhaka',
                        'hours'       => '8:00 AM - 11:00 PM',
                    ),
                    array(
                        'outlet_name' => 'Shwapno Uttara Sector 3',
                        'address'     => 'Rabindra Sarani, Uttara, Dhaka',
                        'hours'       => '8:00 AM - 11:00 PM',
                    ),
                ),
                'title_field' => '{{{ outlet_name }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="py-5 bg-light swapno-builder-section">
            <div class="container">
                <div class="text-center mb-5">
                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-1 rounded-pill small fw-bold mb-2">
                        <?php echo esc_html( $settings['banner_badge'] ); ?>
                    </span>
                    <h2 class="display-6 font-heading fw-black text-dark mb-2"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <p class="text-muted mx-auto" style="max-width: 650px;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                </div>

                <div class="row g-4">
                    <?php foreach ( $settings['outlets_list'] as $o ) : ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white hover-lift transition-all">
                                <div class="d-flex align-items-center gap-2 mb-2 text-danger">
                                    <i class="bi bi-geo-alt-fill fs-5"></i>
                                    <h4 class="h6 fw-bold text-dark mb-0"><?php echo esc_html( $o['outlet_name'] ); ?></h4>
                                </div>
                                <p class="small text-muted mb-2"><?php echo esc_html( $o['address'] ); ?></p>
                                <div class="mt-auto pt-2 border-top text-muted small">
                                    <i class="bi bi-clock me-1 text-secondary"></i> <?php echo esc_html( $o['hours'] ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-5 p-4 rounded-4 bg-white shadow-sm border text-center">
                    <h4 class="h5 fw-bold text-dark mb-2">Can't Visit Shwapno? Order Online Direct From Our Roastery</h4>
                    <p class="text-muted small mb-3">Same day dispatch across Dhaka with free shipping on orders over ৳ 3,000.</p>
                    <a href="<?php echo esc_url( home_url( '/beans' ) ); ?>" class="btn btn-dark rounded-pill px-4 fw-bold">Shop Coffee Beans Online</a>
                </div>
            </div>
        </section>
        <?php
    }
}
