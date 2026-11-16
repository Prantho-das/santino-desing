<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Story_Marquee_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_story_marquee';
    }

    public function get_title() {
        return esc_html__( 'Santino Story: Photo Reel Marquee', 'santino' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_marquee',
            array(
                'label' => esc_html__( 'Photo Reel / Gallery', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control( 'marquee_badge', array( 'label' => esc_html__( 'Badge Text', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'MOMENTS AT SANTINO' ) );
        $this->add_control( 'marquee_title', array( 'label' => esc_html__( 'Section Title (HTML)', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Inside Our Roastery, <span class="sec-title-accent">Cafes &amp; Labs</span>' ) );
        $this->add_control( 'reel_row1_gallery', array( 'label' => esc_html__( 'Row 1 Photos (Optional Override)', 'santino' ), 'type' => \Elementor\Controls_Manager::GALLERY, 'default' => array() ) );
        $this->add_control( 'reel_row2_gallery', array( 'label' => esc_html__( 'Row 2 Photos (Optional Override)', 'santino' ), 'type' => \Elementor\Controls_Manager::GALLERY, 'default' => array() ) );

        $this->end_controls_section();
    }

    protected function render() {
        $s  = $this->get_settings_for_display();
        $r1 = array();
        if ( ! empty( $s['reel_row1_gallery'] ) ) {
            foreach ( $s['reel_row1_gallery'] as $g ) { if ( ! empty( $g['url'] ) ) $r1[] = $g['url']; }
        } else {
            foreach ( array( 'imgi_20_santino_-_250522-07574.jpg', 'imgi_23_santino_-_250522-07495.jpg', 'imgi_25_santino_-_250522-07618.jpg', 'imgi_26_santino_-_250522-07312.jpg', 'imgi_27_santino_-_250522-07216.jpg', 'bd-barista-latte-art.jpg' ) as $f ) {
                if ( function_exists( 'santino_img' ) ) $r1[] = santino_img( $f );
            }
        }
        $r2 = array();
        if ( ! empty( $s['reel_row2_gallery'] ) ) {
            foreach ( $s['reel_row2_gallery'] as $g ) { if ( ! empty( $g['url'] ) ) $r2[] = $g['url']; }
        } else {
            foreach ( array( 'shwapno_santino_retail.jpg', 'bfc_santino_foodservice.jpg', 'bd-barista-training.jpg', 'santino_cup_specialist.jpg', 'menu-raw-coconut-latte.jpg', 'menu-cappuccino-hot.jpg' ) as $f ) {
                if ( function_exists( 'santino_img' ) ) $r2[] = santino_img( $f );
            }
        }
        ?>
        <section class="story-marquee-reel-section py-5 my-4 bg-light">
          <div class="container-fluid px-0">
            <div class="text-center mb-4">
              <?php if ( ! empty( $s['marquee_badge'] ) ) : ?>
              <div class="sec-pill-badge-wrap mb-2">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $s['marquee_badge'] ); ?></span>
                <span class="sec-pill-line"></span>
              </div>
              <?php endif; ?>
              <h3 class="sec-title mt-1"><?php echo wp_kses_post( $s['marquee_title'] ); ?></h3>
            </div>

            <div class="story-photo-marquee-track track-left mb-3">
              <div class="story-marquee-row">
                <?php foreach ( array_merge( $r1, array_slice( $r1, 0, 3 ) ) as $img_u ) : ?>
                  <img src="<?php echo esc_url( $img_u ); ?>" alt="" class="reel-photo">
                <?php endforeach; ?>
              </div>
            </div>

            <div class="story-photo-marquee-track track-right">
              <div class="story-marquee-row">
                <?php foreach ( array_merge( $r2, array_slice( $r2, 0, 3 ) ) as $img_u ) : ?>
                  <img src="<?php echo esc_url( $img_u ); ?>" alt="" class="reel-photo">
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
