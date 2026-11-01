<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Office_Horeca_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_office_horeca';
    }

    public function get_title() {
        return esc_html__( 'Santino B2B Coffee Solutions (3 Cards)', 'santino' );
    }

    public function get_icon() {
        return 'eicon-office-building';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'B2B Solutions Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BUSINESS SOLUTIONS',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Section Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Coffee Solutions for Your Business',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Section Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Built around your needs, scale, and workflow',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Card Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'HORECA',
            )
        );

        $repeater->add_control(
            'bg_image',
            array(
                'label'   => esc_html__( 'Background Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array( 'url' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=1000&auto=format&fit=crop&q=80' ),
            )
        );

        $repeater->add_control(
            'link1_text',
            array(
                'label'   => esc_html__( 'Bullet Link 1 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Hotels, Fine Dining & Cafes',
            )
        );

        $repeater->add_control(
            'link1_url',
            array(
                'label'   => esc_html__( 'Bullet Link 1 URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/horeca/' ),
            )
        );

        $repeater->add_control(
            'link2_text',
            array(
                'label'   => esc_html__( 'Bullet Link 2 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Commercial Espresso Machines',
            )
        );

        $repeater->add_control(
            'link2_url',
            array(
                'label'   => esc_html__( 'Bullet Link 2 URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/machines/' ),
            )
        );

        $repeater->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Action Button Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'EXPLORE HORECA →',
            )
        );

        $repeater->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Action Button URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/horeca/' ),
            )
        );

        $this->add_control(
            'solutions_list',
            array(
                'label'       => esc_html__( 'Solution Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title'      => 'HORECA',
                        'bg_image'   => array( 'url' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=1000&auto=format&fit=crop&q=80' ),
                        'link1_text' => 'Hotels, Fine Dining & Cafes',
                        'link1_url'  => array( 'url' => '/horeca/' ),
                        'link2_text' => 'Commercial Espresso Machines',
                        'link2_url'  => array( 'url' => '/machines/' ),
                        'btn_text'   => 'EXPLORE HORECA →',
                        'btn_url'    => array( 'url' => '/horeca/' ),
                    ),
                    array(
                        'title'      => 'Office Coffee',
                        'bg_image'   => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'bd-office-coffee.jpg' ) : '' ),
                        'link1_text' => 'Corporate Bean-to-Cup Setup',
                        'link1_url'  => array( 'url' => '/office-cafe/' ),
                        'link2_text' => 'Monthly Roast Subscriptions',
                        'link2_url'  => array( 'url' => '#enquiryModal' ),
                        'btn_text'   => 'EXPLORE OFFICE COFFEE →',
                        'btn_url'    => array( 'url' => '/office-cafe/' ),
                    ),
                    array(
                        'title'      => 'Event Coffee / Consulting',
                        'bg_image'   => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'bd-barista-training.jpg' ) : '' ),
                        'link1_text' => 'Pop-Up Live Espresso Bars',
                        'link1_url'  => array( 'url' => '#enquiryModal' ),
                        'link2_text' => 'Cafe Setup & Barista Strategy',
                        'link2_url'  => array( 'url' => '/training/' ),
                        'btn_text'   => 'GET CONSULTATION →',
                        'btn_url'    => array( 'url' => '#enquiryModal' ),
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $solutions = ! empty( $settings['solutions_list'] ) ? $settings['solutions_list'] : array();
        ?>
        <section class="solutions-section" id="solutions">
            <div class="container" id="horeca">
                <div class="sec-heading-center" id="office-cafe">
                    <?php if ( ! empty( $settings['badge'] ) ) : ?>
                        <div class="sec-pill-badge-wrap mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-briefcase-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="sec-title"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                        <div class="sec-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></div>
                    <?php endif; ?>
                </div>

                <div class="row g-4 mobile-scroll-row">
                    <?php foreach ( $solutions as $card ) : 
                        $bg_img = ! empty( $card['bg_image']['url'] ) ? esc_url( $card['bg_image']['url'] ) : '';
                        $btn_url = ! empty( $card['btn_url']['url'] ) ? esc_url( $card['btn_url']['url'] ) : '#';
                        $is_modal = strpos( $btn_url, '#enquiryModal' ) !== false;
                        $l1_url = ! empty( $card['link1_url']['url'] ) ? esc_url( $card['link1_url']['url'] ) : '#';
                        $l1_modal = strpos( $l1_url, '#enquiryModal' ) !== false;
                        $l2_url = ! empty( $card['link2_url']['url'] ) ? esc_url( $card['link2_url']['url'] ) : '#';
                        $l2_modal = strpos( $l2_url, '#enquiryModal' ) !== false;
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="solution-card" style="background-image: url('<?php echo $bg_img; ?>');">
                                <div class="solution-card-overlay"></div>
                                <div class="solution-card-content">
                                    <h3 class="solution-card-title"><?php echo esc_html( $card['title'] ); ?></h3>
                                    <ul class="solution-card-links">
                                        <?php if ( ! empty( $card['link1_text'] ) ) : ?>
                                            <li>
                                                <?php if ( $l1_modal ) : ?>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="text-white text-decoration-none"><?php echo esc_html( $card['link1_text'] ); ?> <i class="bi bi-arrow-right"></i></a>
                                                <?php else : ?>
                                                    <a href="<?php echo $l1_url; ?>" class="text-white text-decoration-none"><?php echo esc_html( $card['link1_text'] ); ?> <i class="bi bi-arrow-right"></i></a>
                                                <?php endif; ?>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $card['link2_text'] ) ) : ?>
                                            <li>
                                                <?php if ( $l2_modal ) : ?>
                                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="text-white text-decoration-none"><?php echo esc_html( $card['link2_text'] ); ?> <i class="bi bi-arrow-right"></i></a>
                                                <?php else : ?>
                                                    <a href="<?php echo $l2_url; ?>" class="text-white text-decoration-none"><?php echo esc_html( $card['link2_text'] ); ?> <i class="bi bi-arrow-right"></i></a>
                                                <?php endif; ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                    <?php if ( ! empty( $card['btn_text'] ) ) : ?>
                                        <?php if ( $is_modal ) : ?>
                                            <button class="btn-card-knowmore" data-bs-toggle="modal" data-bs-target="#enquiryModal"><?php echo esc_html( $card['btn_text'] ); ?></button>
                                        <?php else : ?>
                                            <a href="<?php echo $btn_url; ?>" class="btn-card-knowmore text-decoration-none text-center"><?php echo esc_html( $card['btn_text'] ); ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
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
