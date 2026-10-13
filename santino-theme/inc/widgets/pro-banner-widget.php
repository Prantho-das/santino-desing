<?php
/**
 * Elementor Pro Banner Hero Widget (Inner Page Banner)
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Pro_Banner_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_pro_banner';
    }

    public function get_title() {
        return esc_html__( 'Santino Pro Banner Hero', 'santino' );
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
                'label' => esc_html__( 'Banner Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'   => esc_html__( 'Pill Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SPECIALTY ROASTERY & MACHINES',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Banner Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Commercial Espresso Machinery',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Banner Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Official Italian espresso machines, automated coffee stations, and 4-hour on-site tech SLA.',
            )
        );

        $this->add_control(
            'btn1_text',
            array(
                'label'   => esc_html__( 'Primary Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Book Live Demo',
            )
        );

        $this->add_control(
            'btn1_icon',
            array(
                'label'   => esc_html__( 'Primary Button Icon (Bootstrap Icon)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-play-circle-fill',
            )
        );

        $this->add_control(
            'btn1_target',
            array(
                'label'   => esc_html__( 'Primary Button Link/Target', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '#enquiryModal',
            )
        );

        $this->add_control(
            'btn2_text',
            array(
                'label'   => esc_html__( 'Secondary Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Catalog',
            )
        );

        $this->add_control(
            'btn2_url',
            array(
                'label'   => esc_html__( 'Secondary Button URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '#catalog',
            )
        );

        $this->add_control(
            'bg_image',
            array(
                'label'   => esc_html__( 'Background Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_218_blackeagle2.jpg' ) : '',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        
        $bg = '';
        if ( ! empty( $s['bg_image']['url'] ) ) {
            $bg = $s['bg_image']['url'];
        } elseif ( ! empty( $s['bg_image_url'] ) ) {
            $bg = function_exists( 'santino_img' ) ? santino_img( $s['bg_image_url'] ) : $s['bg_image_url'];
        } else {
            $bg = function_exists( 'santino_img' ) ? santino_img( 'imgi_218_blackeagle2.jpg' ) : '';
        }

        $title_raw = $s['title'] ?? '';
        $title_clean = str_replace( array( '\u00d7', 'u00d7' ), '×', $title_raw );
        $title_clean = wp_kses_post( html_entity_decode( $title_clean, ENT_QUOTES, 'UTF-8' ) );

        $is_modal = strpos( $s['btn1_target'] ?? '', '#' ) === 0 && strpos( $s['btn1_target'] ?? '', 'Modal' ) !== false;
        ?>
        <section class="pro-banner-hero w-100" style="background-image: url('<?php echo esc_url( $bg ); ?>'); background-position: center; min-height: 52vh; width: 100%;">
            <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.45) 100%);"></div>
            <div class="pro-banner-glow-line"></div>
            
            <div class="container pro-banner-container" style="max-width: 780px;">
                <?php if ( ! empty( $s['badge_text'] ) ) : ?>
                    <div class="pro-banner-pill mb-3">
                        <span class="pro-pulse-dot"></span>
                        <span><?php echo esc_html( $s['badge_text'] ); ?></span>
                    </div>
                <?php endif; ?>

                <h1 class="pro-banner-title mb-2">
                    <?php echo $title_clean; ?>
                </h1>

                <?php if ( ! empty( $s['subtitle'] ) ) : ?>
                    <p class="pro-banner-desc mb-4" style="max-width: 520px; font-size: 1.05rem;">
                        <?php echo esc_html( $s['subtitle'] ); ?>
                    </p>
                <?php endif; ?>

                <div class="pro-banner-actions">
                    <?php if ( ! empty( $s['btn1_text'] ) ) : ?>
                        <?php if ( $is_modal ) : ?>
                            <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="<?php echo esc_attr( $s['btn1_target'] ); ?>">
                                <span><?php echo esc_html( $s['btn1_text'] ); ?></span>
                                <?php if ( ! empty( $s['btn1_icon'] ) ) : ?><i class="<?php echo esc_attr( $s['btn1_icon'] ); ?>"></i><?php endif; ?>
                            </button>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $s['btn1_target'] ); ?>" class="btn-hero-lifestyle">
                                <span><?php echo esc_html( $s['btn1_text'] ); ?></span>
                                <?php if ( ! empty( $s['btn1_icon'] ) ) : ?><i class="<?php echo esc_attr( $s['btn1_icon'] ); ?>"></i><?php endif; ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $s['btn2_text'] ) ) : ?>
                        <a href="<?php echo esc_attr( $s['btn2_url'] ); ?>" class="btn-hero-outline">
                            <i class="bi bi-arrow-down-short text-gold"></i>
                            <span><?php echo esc_html( $s['btn2_text'] ); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
