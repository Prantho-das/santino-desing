<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Testimonials_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_testimonials';
    }

    public function get_title() {
        return esc_html__( 'Santino Hospitality Partners Say', 'santino' );
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
                'label' => esc_html__( 'Hospitality Testimonials', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'PARTNER TRUST',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'What Our Hospitality Partners Say',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Real partners. Real results. Here’s what our valued hospitality partners have to say about working with Santino Coffee.',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'quote',
            array(
                'label'   => esc_html__( 'Quote Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Santino\'s espresso calibration and machine consistency have been outstanding.',
            )
        );

        $repeater->add_control(
            'author_name',
            array(
                'label'   => esc_html__( 'Author Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'MOHAMMAD RAHMAN',
            )
        );

        $repeater->add_control(
            'author_role',
            array(
                'label'   => esc_html__( 'Author Role / Organization', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Operations Manager<br>BFC (Best Fried Chicken)',
            )
        );

        $repeater->add_control(
            'avatar_initials',
            array(
                'label'   => esc_html__( 'Avatar Initials', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'MR',
            )
        );

        $repeater->add_control(
            'stars',
            array(
                'label'   => esc_html__( 'Star Count', 'santino' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'min'     => 1,
                'max'     => 5,
            )
        );

        $this->add_control(
            'testimonials',
            array(
                'label'       => esc_html__( 'Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'quote'           => '“ Santino\'s espresso calibration and machine consistency have been outstanding. It helps us serve high-quality coffee across 50+ BFC outlets without any hassle. ”',
                        'author_name'     => 'MOHAMMAD RAHMAN',
                        'author_role'     => 'Operations Manager<br>BFC (Best Fried Chicken)',
                        'avatar_initials' => 'MR',
                        'stars'           => 5,
                    ),
                    array(
                        'quote'           => '“ As an artisan specialty cafe, coffee quality is our lifeblood. Santino’s freshly drum-roasted micro-lot beans and rapid machine maintenance keep our barista bar buzzing daily. ”',
                        'author_name'     => 'TANVIR AHMED',
                        'author_role'     => 'Founder &amp; Head Barista<br>Café Aroma',
                        'avatar_initials' => 'TA',
                        'stars'           => 5,
                    ),
                    array(
                        'quote'           => '“ We leased our Nuova Simonelli espresso machine through Santino. Their 4-hour technical SLA and quarterly staff training give us total peace of mind. ”',
                        'author_name'     => 'NUSRAT JAHAN',
                        'author_role'     => 'Co-Founder<br>The Daily Grind',
                        'avatar_initials' => 'NJ',
                        'stars'           => 5,
                    ),
                ),
                'title_field' => '{{{ author_name }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $testimonials = ! empty( $settings['testimonials'] ) ? $settings['testimonials'] : array();
        ?>
        <section class="hospitality-testimonials-section" id="hospitality-partners">
            <div class="hospitality-float-leaf hospitality-leaf-left" aria-hidden="true">
                <svg viewBox="0 0 64 64" fill="currentColor">
                    <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
                </svg>
            </div>
            <div class="hospitality-float-leaf hospitality-leaf-right" aria-hidden="true">
                <svg viewBox="0 0 64 64" fill="currentColor">
                    <path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/>
                </svg>
            </div>

            <div class="container position-relative" style="z-index: 2;">
                <div class="text-center mb-5">
                    <?php if ( ! empty( $settings['badge'] ) ) : ?>
                        <div class="sec-pill-badge-wrap mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-handshake me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="hospitality-title"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                        <p class="hospitality-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                    <?php endif; ?>
                </div>

                <div class="row g-4 align-items-stretch">
                    <?php foreach ( $testimonials as $item ) : 
                        $stars = ! empty( $item['stars'] ) ? intval( $item['stars'] ) : 5;
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="hospitality-card">
                                <div>
                                    <div class="partner-stars">
                                        <?php for ( $i = 0; $i < $stars; $i++ ) : ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="partner-quote">
                                        <?php echo esc_html( $item['quote'] ); ?>
                                    </p>
                                </div>
                                <div class="partner-author-row">
                                    <div class="partner-avatar"><?php echo esc_html( $item['avatar_initials'] ); ?></div>
                                    <div>
                                        <div class="partner-author-name"><?php echo esc_html( $item['author_name'] ); ?></div>
                                        <div class="partner-author-role"><?php echo wp_kses_post( $item['author_role'] ); ?></div>
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
