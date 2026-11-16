<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Story_Vision_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_story_vision';
    }

    public function get_title() {
        return esc_html__( 'Santino Story: Purpose & Vision', 'santino' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_vision',
            array(
                'label' => esc_html__( 'Purpose & Vision', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control( 'vision_badge', array( 'label' => esc_html__( 'Section Badge', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'OUR PURPOSE & VISION' ) );
        $this->add_control( 'vision_title', array( 'label' => esc_html__( 'Section Title (HTML)', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Innovation Grounded in <span class="sec-title-accent">Heritage</span>' ) );
        $this->add_control( 'vision_desc', array( 'label' => esc_html__( 'Vision Description', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => 'Santino Coffee was born with a single mission: to empower coffee entrepreneurs, businesses, and coffee lovers with world-class beans, precision machinery, and deep sensory knowledge. We believe that every cup tells a story of dedicated farmers, meticulous roast masters, and passionate baristas.' ) );

        $rep = new \Elementor\Repeater();
        $rep->add_control( 'icon', array( 'label' => esc_html__( 'Icon Class', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'bi bi-globe-americas' ) );
        $rep->add_control( 'badge', array( 'label' => esc_html__( 'Pill Badge', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Direct Farm Sourcing' ) );
        $rep->add_control( 'title', array( 'label' => esc_html__( 'Card Title', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Authentic Origin' ) );
        $rep->add_control( 'desc', array( 'label' => esc_html__( 'Card Description', 'santino' ), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => '100% ethically sourced Rainforest Alliance certified green beans from direct partner estates.' ) );

        $this->add_control(
            'vision_cards',
            array(
                'label'       => esc_html__( 'Vision Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $rep->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => array(
                    array( 'icon' => 'bi bi-globe-americas', 'badge' => 'Direct Farm Sourcing', 'title' => 'Authentic Origin', 'desc' => '100% ethically sourced Rainforest Alliance certified green beans from direct partner estates.' ),
                    array( 'icon' => 'bi bi-fire', 'badge' => 'Master Roasting', 'title' => 'Precision Roasting', 'desc' => 'Custom roast profiles digitally calibrated to temperature, humidity, and peak flavor release.' ),
                    array( 'icon' => 'bi bi-shield-check', 'badge' => 'Dedicated 24/7 Care', 'title' => 'Continuous Care', 'desc' => '24/7 technical breakdown support, preventive maintenance, and barista training academies.' ),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        ?>
        <section class="story-vision-section py-5 my-lg-2 position-relative" id="vision">
          <div class="container position-relative" style="z-index: 1;">
            <div class="row justify-content-center text-center">
              <div class="col-xl-9 col-lg-10">
                <?php if ( ! empty( $s['vision_badge'] ) ) : ?>
                <div class="sec-pill-badge-wrap mb-3">
                  <span class="sec-pill-line"></span>
                  <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $s['vision_badge'] ); ?></span>
                  <span class="sec-pill-line"></span>
                </div>
                <?php endif; ?>
                <h2 class="sec-title mb-3"><?php echo wp_kses_post( $s['vision_title'] ); ?></h2>
                <p class="story-vision-text mb-4" style="max-width: 780px; margin: 0 auto 35px;">
                  <?php echo esc_html( $s['vision_desc'] ); ?>
                </p>
                <?php if ( ! empty( $s['vision_cards'] ) ) : ?>
                <div class="row g-4 mt-2">
                  <?php foreach ( $s['vision_cards'] as $vc ) : ?>
                  <div class="col-md-4">
                    <div class="vision-feature-card">
                      <div class="vision-icon-wrap"><i class="<?php echo esc_attr( $vc['icon'] ?: 'bi bi-globe-americas' ); ?>"></i></div>
                      <?php if ( ! empty( $vc['badge'] ) ) : ?>
                      <span class="vision-badge-pill"><?php echo esc_html( $vc['badge'] ); ?></span>
                      <?php endif; ?>
                      <h4><?php echo esc_html( $vc['title'] ); ?></h4>
                      <p><?php echo esc_html( $vc['desc'] ); ?></p>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
