<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Services_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_services';
    }

    public function get_title() {
        return esc_html__( 'Santino Zig-Zag Showcases', 'santino' );
    }

    public function get_icon() {
        return 'eicon-table-of-contents';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Zig-Zag Rows', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Row Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Innovation with Purpose',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'We embrace new ideas, technologies, and methods that elevate coffee culture in Bangladesh while respecting tradition.',
            )
        );

        $repeater->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Link Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'EXPLORE AUTOMATION',
            )
        );

        $repeater->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Link URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/machines/' ),
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Row Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp' ) : '',
                ),
            )
        );

        $repeater->add_control(
            'reverse',
            array(
                'label'        => esc_html__( 'Reverse Row (Image on Right)', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'santino' ),
                'label_off'    => esc_html__( 'No', 'santino' ),
                'return_value' => 'yes',
                'default'      => 'no',
            )
        );

        $this->add_control(
            'zigzag_rows',
            array(
                'label'       => esc_html__( 'Rows', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title'    => 'Innovation with Purpose',
                        'desc'     => 'We embrace new ideas, technologies, and methods that elevate coffee culture in Bangladesh while respecting tradition. From advanced CAYE Bionic Baristas to intelligent superautomatics, we empower businesses to lead the coffee revolution.',
                        'btn_text' => 'EXPLORE AUTOMATION',
                        'btn_url'  => array( 'url' => '/machines/' ),
                        'image'    => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp' ) : '' ),
                        'reverse'  => 'no',
                    ),
                    array(
                        'title'    => 'Quality Without Compromise',
                        'desc'     => 'Everything we do shows our dedication and commitment to quality — backed by our FSSC22000 food safety certification and Rainforest Alliance certified coffee beans roasted fresh to precision in every single batch.',
                        'btn_text' => 'VIEW CERTIFICATIONS',
                        'btn_url'  => array( 'url' => '/beans/' ),
                        'image'    => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'shwapno_santino_retail.jpg' ) : '' ),
                        'reverse'  => 'yes',
                    ),
                    array(
                        'title'    => 'Empowerment Through Knowledge',
                        'desc'     => 'We train, mentor, and share expertise to grow the next generation of coffee leaders in Bangladesh. Our certified trainers support baristas from foundational skills to World Barista & Brewers Cup championships.',
                        'btn_text' => 'JOIN ACADEMY',
                        'btn_url'  => array( 'url' => '/training/' ),
                        'image'    => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'bd-barista-training.jpg' ) : '' ),
                        'reverse'  => 'no',
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $rows = ! empty( $settings['zigzag_rows'] ) ? $settings['zigzag_rows'] : array();
        ?>
        <section class="zigzag-section" id="services">
            <?php foreach ( $rows as $index => $row ) : 
                $img_url = ! empty( $row['image']['url'] ) ? esc_url( $row['image']['url'] ) : '';
                $btn_url = ! empty( $row['btn_url']['url'] ) ? esc_url( $row['btn_url']['url'] ) : '#';
                $is_reverse = ( isset( $row['reverse'] ) && $row['reverse'] === 'yes' ) || ( ! isset( $row['reverse'] ) && $index % 2 === 1 );
                $reverse_class = $is_reverse ? ' flex-lg-row-reverse' : '';
            ?>
                <div class="zigzag-row<?php echo esc_attr( $reverse_class ); ?>">
                    <div class="zigzag-col-image" style="background-image: url('<?php echo $img_url; ?>');"></div>
                    <div class="zigzag-col-text">
                        <h3 class="zigzag-title"><?php echo esc_html( $row['title'] ); ?></h3>
                        <p class="zigzag-desc"><?php echo esc_html( $row['desc'] ); ?></p>
                        <?php if ( ! empty( $row['btn_text'] ) ) : ?>
                            <a href="<?php echo $btn_url; ?>" class="link-kp-red"><?php echo esc_html( $row['btn_text'] ); ?> <i class="bi bi-arrow-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
        <?php
    }
}
