<?php
/**
 * Elementor Membership Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Membership_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_membership';
    }

    public function get_title() {
        return esc_html__( 'Santino Club Membership', 'santino' );
    }

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Membership Perks', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Join Santino VIP Coffee Connoisseur Club',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Earn reward points on every bean purchase, get exclusive invitations to cupping sessions, priority machine repair and member discounts.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="membership-section py-5 bg-light">
            <div class="container-fluid px-lg-5">
                <div class="text-center mb-5">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2">EXCLUSIVE PRIVILEGES</span>
                    <h2 class="display-6 fw-bold font-heading text-dark"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <p class="text-muted mx-auto" style="max-width: 600px;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                </div>

                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center bg-white">
                            <div class="mb-3"><i class="bi bi-shield-shaded text-secondary fs-1"></i></div>
                            <h4 class="h5 fw-bold font-heading">Silver Member</h4>
                            <p class="text-muted small">For home baristas and coffee enthusiasts</p>
                            <hr>
                            <ul class="list-unstyled text-start small text-muted mb-4">
                                <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> 5% off on all fresh coffee bean orders</li>
                                <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Free delivery on orders over ৳2,000</li>
                                <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Access to seasonal single origins</li>
                            </ul>
                            <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="btn btn-outline-dark rounded-pill w-100 mt-auto">Join Silver</a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-2 border-warning rounded-4 shadow-sm p-4 text-center bg-white position-relative">
                            <span class="position-absolute top-0 start-50 translate-middle badge bg-warning text-dark rounded-pill px-3 py-2">MOST POPULAR</span>
                            <div class="mb-3 mt-2"><i class="bi bi-trophy-fill text-warning fs-1"></i></div>
                            <h4 class="h5 fw-bold font-heading">Gold Connoisseur</h4>
                            <p class="text-muted small">For specialty coffee shops and offices</p>
                            <hr>
                            <ul class="list-unstyled text-start small text-muted mb-4">
                                <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> 12% wholesale rate on coffee beans</li>
                                <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Priority 4-hour breakdown support</li>
                                <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Free quarterly machine maintenance check</li>
                                <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> 2 Free Barista Masterclasses per year</li>
                            </ul>
                            <a href="<?php echo esc_url( home_url( '/membership' ) ); ?>" class="btn btn-warning fw-bold text-dark rounded-pill w-100 mt-auto">Join Gold</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
