<?php
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
                'label'   => esc_html__( 'Primary Button Text (Blank to Hide)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Book Live Demo',
            )
        );

        $this->add_control(
            'btn1_icon',
            array(
                'label'   => esc_html__( 'Primary Button Icon', 'santino' ),
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
                'label'   => esc_html__( 'Secondary Button Text (Blank to Hide)', 'santino' ),
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
            'bg_type',
            array(
                'label'   => esc_html__( 'Background Type', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'image' => 'Image Background',
                    'video' => 'Video Background (MP4 / WebM)',
                ),
                'default' => 'image',
            )
        );

        $this->add_control(
            'bg_image',
            array(
                'label'   => esc_html__( 'Background / Video Poster Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_218_blackeagle2.jpg' ) : '',
                ),
            )
        );

        $this->add_control(
            'bg_video_upload',
            array(
                'label'      => esc_html__( 'Upload MP4 Video (Media Library)', 'santino' ),
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'video',
                'condition'  => array( 'bg_type' => 'video' ),
            )
        );

        $this->add_control(
            'bg_video_url',
            array(
                'label'     => esc_html__( 'Or Video URL (External/CDN)', 'santino' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'condition' => array( 'bg_type' => 'video' ),
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

        $bg_type  = $s['bg_type'] ?? 'image';
        $video_src = '';
        if ( ! empty( $s['bg_video_upload']['url'] ) ) {
            $video_src = $s['bg_video_upload']['url'];
        } elseif ( ! empty( $s['bg_video_url'] ) ) {
            $video_src = $s['bg_video_url'];
        }

        $title_raw = $s['title'] ?? '';
        $title_clean = str_replace( array( '\u00d7', 'u00d7' ), '×', $title_raw );
        $title_clean = wp_kses_post( html_entity_decode( $title_clean, ENT_QUOTES, 'UTF-8' ) );

        $btn1_text = isset( $s['btn1_text'] ) ? trim( (string) $s['btn1_text'] ) : '';
        $btn2_text = isset( $s['btn2_text'] ) ? trim( (string) $s['btn2_text'] ) : '';
        $is_modal = strpos( $s['btn1_target'] ?? '', '#' ) === 0 && strpos( $s['btn1_target'] ?? '', 'Modal' ) !== false;
        ?>
        <section class="pro-banner-hero w-100 position-relative overflow-hidden" style="<?php echo ( $bg_type === 'image' || empty( $video_src ) ) ? 'background-image: url(' . esc_url( $bg ) . '); background-position: center; background-size: cover;' : ''; ?> min-height: 52vh; width: 100%; display: flex; align-items: center; justify-content: center;">
            <?php if ( $bg_type === 'video' && ! empty( $video_src ) ) : ?>
                <video autoplay muted loop playsinline poster="<?php echo esc_url( $bg ); ?>" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; pointer-events: none;">
                    <source src="<?php echo esc_url( $video_src ); ?>" type="video/mp4">
                </video>
            <?php endif; ?>
            <div class="pro-banner-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,0.22) 0%, rgba(0,0,0,0.65) 100%); z-index: 1;"></div>
            <div class="pro-banner-glow-line" style="position: absolute; bottom: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, transparent, #c3996c, transparent); z-index: 2;"></div>
            
            <div class="container pro-banner-container position-relative text-center" style="max-width: 780px; z-index: 2; padding: 60px 15px;">
                <?php if ( ! empty( $s['badge_text'] ) ) : ?>
                    <div class="pro-banner-pill mb-3 d-inline-flex align-items-center gap-2" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 50px; padding: 4px 14px; color: #ffffff; font-size: 11px; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase;">
                        <span class="pro-pulse-dot" style="width: 7px; height: 7px; border-radius: 50%; background: #dfbe8d; display: inline-block;"></span>
                        <span><?php echo esc_html( $s['badge_text'] ); ?></span>
                    </div>
                <?php endif; ?>

                <h1 class="pro-banner-title mb-2" style="color: #ffffff; font-size: clamp(2.2rem, 4.2vw, 3.4rem); font-weight: 900; line-height: 1.18; letter-spacing: -0.5px;">
                    <?php echo $title_clean; ?>
                </h1>

                <?php if ( ! empty( $s['subtitle'] ) ) : ?>
                    <p class="pro-banner-desc mb-4" style="max-width: 540px; font-size: 1.05rem; color: rgba(255,255,255,0.92); margin: 0 auto 20px; line-height: 1.6;">
                        <?php echo esc_html( $s['subtitle'] ); ?>
                    </p>
                <?php endif; ?>

                <?php if ( ! empty( $btn1_text ) || ! empty( $btn2_text ) ) : ?>
                <div class="pro-banner-actions d-flex justify-content-center align-items-center gap-3 flex-wrap">
                    <?php if ( ! empty( $btn1_text ) ) : ?>
                        <?php if ( $is_modal ) : ?>
                            <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="<?php echo esc_attr( $s['btn1_target'] ); ?>">
                                <span><?php echo esc_html( $btn1_text ); ?></span>
                                <?php if ( ! empty( $s['btn1_icon'] ) ) : ?><i class="<?php echo esc_attr( $s['btn1_icon'] ); ?>"></i><?php endif; ?>
                            </button>
                        <?php else : ?>
                            <a href="<?php echo esc_url( $s['btn1_target'] ); ?>" class="btn-hero-lifestyle">
                                <span><?php echo esc_html( $btn1_text ); ?></span>
                                <?php if ( ! empty( $s['btn1_icon'] ) ) : ?><i class="<?php echo esc_attr( $s['btn1_icon'] ); ?>"></i><?php endif; ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $btn2_text ) ) : ?>
                        <a href="<?php echo esc_attr( $s['btn2_url'] ); ?>" class="btn-hero-outline">
                            <i class="bi bi-arrow-down-short text-gold"></i>
                            <span><?php echo esc_html( $btn2_text ); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
