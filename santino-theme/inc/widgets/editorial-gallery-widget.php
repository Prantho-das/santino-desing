<?php
/**
 * Elementor Editorial Gallery Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Editorial_Gallery_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_editorial_gallery';
    }

    public function get_title() {
        return esc_html__( 'Santino Editorial Gallery', 'santino' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Gallery Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'   => esc_html__( 'Pill Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'VISUAL EXPERIENCE',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Inside The Craft & Operation',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Live commercial espresso stations, artisan roasted beans, and certified workflows.',
            )
        );

        $this->add_control(
            'dark_mode',
            array(
                'label'        => esc_html__( 'Dark Mode Background', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Dark', 'santino' ),
                'label_off'    => esc_html__( 'Light', 'santino' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_badge',
            array(
                'label'   => esc_html__( 'Card Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '9-BAR EXTRACTION',
            )
        );

        $repeater->add_control(
            'card_title',
            array(
                'label'   => esc_html__( 'Card Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Commercial Espresso Station',
            )
        );

        $repeater->add_control(
            'card_desc',
            array(
                'label'   => esc_html__( 'Card Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Calibrated extraction for consistent flavor during rush hours.',
            )
        );

        $repeater->add_control(
            'card_image',
            array(
                'label'   => esc_html__( 'Card Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_218_blackeagle2.jpg' ) : '',
                ),
            )
        );

        $this->add_control(
            'cards',
            array(
                'label'       => esc_html__( 'Gallery Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'card_badge' => '9-BAR EXTRACTION',
                        'card_title' => 'High Volume Commercial Extraction',
                        'card_desc'  => 'Twin-group commercial machinery calibrated for rapid extraction during rushes.',
                        'card_image' => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_218_blackeagle2.jpg' ) : '' ),
                    ),
                    array(
                        'card_badge' => 'SCA STANDARDS',
                        'card_title' => 'Certified Barista Quality',
                        'card_desc'  => 'Every cup dialed in to exacting extraction ratios and microfoam texture.',
                        'card_image' => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'bd-barista-latte-art.jpg' ) : '' ),
                    ),
                    array(
                        'card_badge' => 'FRESH ROASTERY',
                        'card_title' => 'Weekly Roasted Beans',
                        'card_desc'  => 'Fresh batches sealed in nitrogen-flushed packaging for optimal crema.',
                        'card_image' => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_206_beans1.jpg' ) : '' ),
                    ),
                    array(
                        'card_badge' => 'FAST SERVICE',
                        'card_title' => 'Seamless Turnaround',
                        'card_desc'  => 'Integrated order-to-cup workflow designed for busy service counters.',
                        'card_image' => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_209_office1.jpg' ) : '' ),
                    ),
                ),
                'title_field' => '{{{ card_title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $is_dark = ( 'yes' === $settings['dark_mode'] );
        $bg_color = $is_dark ? '#08100f' : '#f8f9fa';
        $text_color = $is_dark ? '#ffffff' : '#111111';
        $sub_color = $is_dark ? 'rgba(255,255,255,0.7)' : '#666666';
        $card_bg = $is_dark ? '#0f1f1d' : '#ffffff';
        $card_border = $is_dark ? 'rgba(255,255,255,0.08)' : '#e5e5e5';
        ?>
        <section class="editorial-gallery-section w-100 py-5" style="background-color: <?php echo esc_attr( $bg_color ); ?>; color: <?php echo esc_attr( $text_color ); ?>; width: 100%;">
            <div class="container py-lg-3">
                <div class="text-center mx-auto mb-4" style="max-width: 700px;">
                    <div class="sec-pill-badge-wrap <?php echo $is_dark ? 'light' : ''; ?> mb-2">
                        <span class="sec-pill-line"></span>
                        <span class="sec-pill-badge"><i class="bi bi-camera-fill me-1"></i> <?php echo esc_html( $settings['badge_text'] ); ?></span>
                        <span class="sec-pill-line"></span>
                    </div>
                    <h2 class="sec-title mb-2" style="color: <?php echo esc_attr( $text_color ); ?>;"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <p class="small mb-0" style="color: <?php echo esc_attr( $sub_color ); ?>; max-width: 580px; margin: 0 auto;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                </div>

                <div class="row g-3">
                    <?php foreach ( $settings['cards'] as $card ) : 
                        $img_src = '';
                        if ( ! empty( $card['card_image']['url'] ) ) {
                            $img_src = $card['card_image']['url'];
                        } elseif ( ! empty( $card['card_image'] ) && is_string( $card['card_image'] ) ) {
                            $img_src = function_exists( 'santino_img' ) ? santino_img( $card['card_image'] ) : '';
                        } else {
                            $img_src = function_exists( 'santino_img' ) ? santino_img( 'imgi_218_blackeagle2.jpg' ) : '';
                        }
                    ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="h-100 rounded-4 overflow-hidden shadow-sm d-flex flex-column" style="background-color: <?php echo esc_attr( $card_bg ); ?>; border: 1px solid <?php echo esc_attr( $card_border ); ?>;">
                                <div style="height: 180px; overflow: hidden; position: relative;">
                                    <img src="<?php echo esc_url( $img_src ); ?>" alt="<?php echo esc_attr( $card['card_title'] ); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                    <span class="badge position-absolute top-0 end-0 m-2" style="background-color: rgba(0,0,0,0.7); backdrop-filter: blur(4px); font-size: 10px; font-weight: 700;"><?php echo esc_html( $card['card_badge'] ); ?></span>
                                </div>
                                <div class="p-3 d-flex flex-column flex-grow-1">
                                    <h4 class="h6 fw-bold mb-1" style="color: <?php echo esc_attr( $text_color ); ?>; font-family: var(--kp-font-title, sans-serif);"><?php echo esc_html( $card['card_title'] ); ?></h4>
                                    <p class="small mb-0" style="color: <?php echo esc_attr( $sub_color ); ?>; font-size: 12px; line-height: 1.5;"><?php echo esc_html( $card['card_desc'] ); ?></p>
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
