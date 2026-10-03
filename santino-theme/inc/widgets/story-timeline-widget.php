<?php
/**
 * Elementor Story & Roastery Heritage Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Story_Timeline_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_story_timeline';
    }

    public function get_title() {
        return esc_html__( 'Santino Roasting Heritage Story', 'santino' );
    }

    public function get_icon() {
        return 'eicon-history';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Heritage Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'OUR HERITAGE',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Innovation Grounded in',
            )
        );

        $this->add_control(
            'title_accent',
            array(
                'label'   => esc_html__( 'Accent Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heritage',
            )
        );

        $this->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'For over 20 years, Santino Coffee has stayed true to its heritage — combining time-honored coffee traditions with modern innovation. From carefully selected beans to precision roasting, we craft coffee that brings people together, one cup at a time.',
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Link Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Discover Our Roasting Story',
            )
        );

        $this->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Link URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/our-story/' ),
            )
        );

        $this->add_control(
            'card_image',
            array(
                'label'   => esc_html__( 'Roasting Showcase Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => SANTINO_URI . '/assets/images/imgi_19_santino_-_250522-07313.jpg',
                ),
            )
        );

        $this->add_control(
            'card_title',
            array(
                'label'   => esc_html__( 'Card Title Serif', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'The Art of Roasting',
            )
        );

        $this->add_control(
            'card_subtitle',
            array(
                'label'   => esc_html__( 'Card Subtitle Caps', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'TRADITION • MEETS • INNOVATION',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $btn_url = ! empty( $settings['btn_url']['url'] ) ? esc_url( $settings['btn_url']['url'] ) : home_url( '/our-story/' );
        $card_img = ! empty( $settings['card_image']['url'] ) ? esc_url( $settings['card_image']['url'] ) : santino_img( 'imgi_19_santino_-_250522-07313.jpg' );
        ?>
        <section class="heritage-story-section" id="about">
            <div class="container">
                <div class="row align-items-center g-4 g-lg-5">
                    <div class="col-lg-5">
                        <?php if ( ! empty( $settings['badge'] ) ) : ?>
                            <div class="sec-pill-badge-wrap start mb-2">
                                <span class="sec-pill-line"></span>
                                <span class="sec-pill-badge"><i class="bi bi-flower1 me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                                <span class="sec-pill-line"></span>
                            </div>
                        <?php endif; ?>
                        <h2 class="heritage-title">
                            <?php echo esc_html( $settings['title'] ); ?> 
                            <?php if ( ! empty( $settings['title_accent'] ) ) : ?>
                                <span class="sec-title-accent"><?php echo esc_html( $settings['title_accent'] ); ?></span>
                            <?php endif; ?>
                        </h2>
                        <?php if ( ! empty( $settings['description'] ) ) : ?>
                            <p class="heritage-desc">
                                <?php echo esc_html( $settings['description'] ); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ( ! empty( $settings['btn_text'] ) ) : ?>
                            <div>
                                <a href="<?php echo $btn_url; ?>" class="heritage-cta-link">
                                    <?php echo esc_html( $settings['btn_text'] ); ?> <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-7">
                        <div class="roasting-showcase-card">
                            <img src="<?php echo $card_img; ?>" alt="<?php echo esc_attr( $settings['card_title'] ); ?>" class="roasting-bg-img" loading="lazy">
                            <div class="roasting-card-overlay"></div>
                            <img src="<?php echo santino_img('Logo-Santino-Coffee-transparent.png'); ?>" alt="Santino Logo" class="roasting-logo-badge">
                            <a href="javascript:void(0)" class="roasting-play-btn" data-bs-toggle="modal" data-bs-target="#enquiryModal" aria-label="Play Roasting Video">
                                <i class="bi bi-play-fill ms-1"></i>
                            </a>
                            <div class="roasting-content-bottom">
                                <div class="roast-title-serif"><?php echo esc_html( $settings['card_title'] ); ?></div>
                                <div class="roast-subtitle-caps"><?php echo esc_html( $settings['card_subtitle'] ); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
