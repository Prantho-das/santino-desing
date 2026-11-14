<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Daily_Promotions_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_daily_promotions';
    }

    public function get_title() {
        return esc_html__( 'Santino: Daily 3+1 Promotions', 'santino' );
    }

    public function get_icon() {
        return 'eicon-calendar';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Promotions Settings', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'layout',
            array(
                'label'   => esc_html__( 'Layout Mode', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => array(
                    'grid'   => esc_html__( 'Spotlight + 7-Day Grid', 'santino' ),
                    'banner' => esc_html__( 'Today Spotlight Only', 'santino' ),
                ),
            )
        );

        $this->add_control(
            'data_source',
            array(
                'label'   => esc_html__( 'Promotions Source', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'wp_admin',
                'options' => array(
                    'wp_admin'         => esc_html__( 'WP Admin (Club Members > Daily Promotions)', 'santino' ),
                    'elementor_custom' => esc_html__( 'Custom Elementor List Below', 'santino' ),
                ),
            )
        );

        $this->add_control(
            'show_header',
            array(
                'label'        => esc_html__( 'Show Section Header', 'santino' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'santino' ),
                'label_off'    => esc_html__( 'Hide', 'santino' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'     => esc_html__( 'Badge Text', 'santino' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => '7 DAYS, 7 REASONS TO CELEBRATE',
                'condition' => array( 'show_header' => 'yes' ),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'     => esc_html__( 'Section Title', 'santino' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => 'Daily Special <span class="sec-title-accent">3 + 1 FREE</span> Offers',
                'condition' => array( 'show_header' => 'yes' ),
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'     => esc_html__( 'Subtitle', 'santino' ),
                'type'      => \Elementor\Controls_Manager::TEXTAREA,
                'default'   => 'Every day brings a signature handcrafted privilege across all Santino flagship cafes.',
                'condition' => array( 'show_header' => 'yes' ),
            )
        );

        $this->add_control(
            'whatsapp',
            array(
                'label'   => esc_html__( 'WhatsApp Number', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '8801613334514',
            )
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'day_key',
            array(
                'label'   => esc_html__( 'Day', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'sunday',
                'options' => array(
                    'sunday'    => 'Sunday',
                    'monday'    => 'Monday',
                    'tuesday'   => 'Tuesday',
                    'wednesday' => 'Wednesday',
                    'thursday'  => 'Thursday',
                    'friday'    => 'Friday',
                    'saturday'  => 'Saturday',
                ),
            )
        );
        $repeater->add_control(
            'offer_title',
            array(
                'label'   => esc_html__( 'Offer Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '3 + 1 FREE',
            )
        );
        $repeater->add_control(
            'items',
            array(
                'label'   => esc_html__( 'Featured Items', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Hot or Iced Chocolate',
            )
        );
        $repeater->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Tag', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SPECIAL',
            )
        );

        $this->add_control(
            'custom_items',
            array(
                'label'       => esc_html__( 'Custom Promotions List', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ day_key }}} — {{{ offer_title }}} ({{{ items }}})',
                'condition'   => array( 'data_source' => 'elementor_custom' ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings      = $this->get_settings_for_display();
        $custom_promos = array();

        if ( ( $settings['data_source'] ?? 'wp_admin' ) === 'elementor_custom' && ! empty( $settings['custom_items'] ) ) {
            foreach ( $settings['custom_items'] as $row ) {
                $key = strtolower( $row['day_key'] ?? 'sunday' );
                $custom_promos[] = array(
                    'id'         => 'el_' . uniqid(),
                    'schedule'   => $key,
                    'day'        => ucfirst( $key ),
                    'title'      => $row['offer_title'] ?? '3 + 1 FREE',
                    'items'      => $row['items'] ?? '',
                    'badge'      => $row['badge'] ?? 'SPECIAL',
                    'paid_cups'  => 3,
                    'start_date' => '',
                    'end_date'   => '',
                    'active'     => true,
                );
            }
        }

        if ( class_exists( 'Santino_Membership_System' ) ) {
            echo Santino_Membership_System::render_daily_promotions_markup( array(
                'layout'        => $settings['layout'] ?? 'grid',
                'show_header'   => ( $settings['show_header'] ?? 'yes' ) === 'yes',
                'badge_text'    => $settings['badge_text'] ?? '7 DAYS, 7 REASONS TO CELEBRATE',
                'title'         => $settings['title'] ?? 'Daily Special <span class="sec-title-accent">3 + 1 FREE</span> Offers',
                'subtitle'      => $settings['subtitle'] ?? '',
                'whatsapp'      => $settings['whatsapp'] ?? '8801613334514',
                'custom_promos' => $custom_promos,
            ) );
        }
    }
}
