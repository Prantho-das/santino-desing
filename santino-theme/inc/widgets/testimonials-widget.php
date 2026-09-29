<?php
/**
 * Elementor Testimonials Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Testimonials_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_testimonials';
    }

    public function get_title() {
        return esc_html__( 'Santino Testimonials & Reviews', 'santino' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Testimonials Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Section Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Trusted by 500+ Top Cafes, Hotels & Corporate Offices',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'author_name',
            array(
                'label'   => esc_html__( 'Client / Cafe Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Crimson Cup BD',
            )
        );

        $repeater->add_control(
            'role',
            array(
                'label'   => esc_html__( 'Designation / Location', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Banani Outlet, Dhaka',
            )
        );

        $repeater->add_control(
            'quote',
            array(
                'label'   => esc_html__( 'Testimonial Quote', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Santino has been our trusted espresso machine partner for over 5 years. Their prompt AMC support ensures our machines never stop brewing.',
            )
        );

        $repeater->add_control(
            'rating',
            array(
                'label'   => esc_html__( 'Rating Stars', 'santino' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'min'     => 1,
                'max'     => 5,
            )
        );

        $this->add_control(
            'testimonials_list',
            array(
                'label'       => esc_html__( 'Testimonials List', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'author_name' => 'The Coffee Lounge',
                        'role'        => 'Gulshan 2, Dhaka',
                        'quote'       => 'We purchased Nuova Simonelli Appia Life from Santino. Flawless temperature stability and great technical onboarding!',
                        'rating'      => 5,
                    ),
                    array(
                        'author_name' => 'North End Roastery Partner',
                        'role'        => 'Dhanmondi, Dhaka',
                        'quote'       => 'Their fresh roast beans and barista academy trained our entire opening team to international SCA standards.',
                        'rating'      => 5,
                    ),
                    array(
                        'author_name' => 'Grameenphone Corporate HQ',
                        'role'        => 'Corporate Cafe, Bashundhara',
                        'quote'       => 'Automated Kalerm bean-to-cup machines handle 500+ cups daily with zero hassle. Highest recommendation for office setups.',
                        'rating'      => 5,
                    ),
                ),
                'title_field' => '{{{ author_name }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="testimonials-section py-5 bg-light">
            <div class="container-fluid px-lg-5">
                <div class="text-center mb-5">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2">SUCCESS STORIES</span>
                    <h2 class="display-6 fw-bold font-heading text-dark"><?php echo esc_html( $settings['title'] ); ?></h2>
                </div>

                <div class="row g-4">
                    <?php foreach ( $settings['testimonials_list'] as $item ) : ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                <div class="text-warning mb-3">
                                    <?php for ( $i = 0; $i < intval( $item['rating'] ); $i++ ) : ?>
                                        <i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                </div>
                                <p class="text-muted fst-italic mb-4 flex-grow-1">"<?php echo esc_html( $item['quote'] ); ?>"</p>
                                <div class="d-flex align-items-center gap-3 pt-3 border-top">
                                    <div class="avatar-circle bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 44px; height: 44px;">
                                        <?php echo esc_html( substr( $item['author_name'], 0, 1 ) ); ?>
                                    </div>
                                    <div>
                                        <h5 class="h6 fw-bold font-heading mb-0 text-dark"><?php echo esc_html( $item['author_name'] ); ?></h5>
                                        <div class="text-muted small"><?php echo esc_html( $item['role'] ); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
