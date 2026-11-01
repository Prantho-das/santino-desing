<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Competitions_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_competitions';
    }

    public function get_title() {
        return esc_html__( 'Santino Academy & Competitions (2 Cards)', 'santino' );
    }

    public function get_icon() {
        return 'eicon-trophy';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Academy Programs', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'ACADEMY & COMPETITIONS',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Learn, Compete, Grow',
            )
        );

        $this->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Enhance your skills, gain industry knowledge, and be part of exciting coffee competitions with Santino.',
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Link Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'View All Programs',
            )
        );

        $this->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Link URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '#training' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'badge_icon',
            array(
                'label'   => esc_html__( 'Badge Icon', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-mortarboard-fill',
            )
        );

        $repeater->add_control(
            'badge_text',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'TRAINING & EDUCATION',
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Program Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Santino Coffee Academy',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Structured training, hands-on practice, and expert guidance to help baristas and coffee enthusiasts build a professional future.',
            )
        );

        $repeater->add_control(
            'link_text',
            array(
                'label'   => esc_html__( 'Card Link Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Learn More',
            )
        );

        $repeater->add_control(
            'link_url',
            array(
                'label'   => esc_html__( 'Card Link URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '#contact' ),
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Media Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_23_santino_-_250522-07495.jpg' ) : '',
                ),
            )
        );

        $this->add_control(
            'programs',
            array(
                'label'       => esc_html__( 'Programs (2 Cards)', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'badge_icon' => 'bi bi-mortarboard-fill',
                        'badge_text' => 'TRAINING & EDUCATION',
                        'title'      => 'Santino Coffee Academy',
                        'desc'       => 'Structured training, hands-on practice, and expert guidance to help baristas and coffee enthusiasts build a professional future.',
                        'link_text'  => 'Learn More',
                        'link_url'   => array( 'url' => '#contact' ),
                        'image'      => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_23_santino_-_250522-07495.jpg' ) : '' ),
                    ),
                    array(
                        'badge_icon' => 'bi bi-trophy-fill',
                        'badge_text' => 'COMPETITIONS',
                        'title'      => 'WBC & WBrC Coaching',
                        'desc'       => 'Championship-level preparation and personalized coaching for baristas ready to compete on the global stage.',
                        'link_text'  => 'Learn More',
                        'link_url'   => array( 'url' => '#contact' ),
                        'image'      => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_24_santino_-_250522-07240.jpg' ) : '' ),
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $programs = ! empty( $settings['programs'] ) ? $settings['programs'] : array();
        $btn_url = ! empty( $settings['btn_url']['url'] ) ? esc_url( $settings['btn_url']['url'] ) : '#training';
        ?>
        <section class="academy-section-v2" id="training">
            <div class="container">
                <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
                    <div>
                        <?php if ( ! empty( $settings['badge'] ) ) : ?>
                            <div class="sec-pill-badge-wrap start mb-2">
                                <span class="sec-pill-line"></span>
                                <span class="sec-pill-badge"><i class="bi bi-mortarboard me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                                <span class="sec-pill-line"></span>
                            </div>
                        <?php endif; ?>
                        <h2 class="academy-sec-title"><?php echo esc_html( $settings['title'] ); ?></h2>
                        <?php if ( ! empty( $settings['desc'] ) ) : ?>
                            <p class="academy-sec-desc"><?php echo esc_html( $settings['desc'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $settings['btn_text'] ) ) : ?>
                        <div>
                            <a href="<?php echo $btn_url; ?>" class="academy-view-all">
                                <span><?php echo esc_html( $settings['btn_text'] ); ?></span>
                                <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row g-4">
                    <?php foreach ( $programs as $card ) : 
                        $img_url = ! empty( $card['image']['url'] ) ? esc_url( $card['image']['url'] ) : '';
                        $card_link = ! empty( $card['link_url']['url'] ) ? esc_url( $card['link_url']['url'] ) : '#contact';
                    ?>
                        <div class="col-lg-6">
                            <div class="academy-prog-card">
                                <div class="academy-card-content">
                                    <div class="academy-card-badge">
                                        <span class="badge-icon"><i class="<?php echo esc_attr( $card['badge_icon'] ); ?>"></i></span>
                                        <span class="badge-text"><?php echo esc_html( $card['badge_text'] ); ?></span>
                                    </div>
                                    <h3 class="academy-card-title"><?php echo esc_html( $card['title'] ); ?></h3>
                                    <p class="academy-card-desc"><?php echo esc_html( $card['desc'] ); ?></p>
                                    <a href="<?php echo $card_link; ?>" class="academy-card-link">
                                        <span><?php echo esc_html( $card['link_text'] ); ?></span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                                <div class="academy-card-media">
                                    <div class="media-wave-backdrop"></div>
                                    <img src="<?php echo $img_url; ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" class="academy-card-img" loading="lazy">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="academy-dots-indicator">
                    <span class="academy-dot"></span>
                    <span class="academy-dot active"></span>
                    <span class="academy-dot"></span>
                </div>
            </div>
        </section>
        <?php
    }
}
