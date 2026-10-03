<?php
/**
 * Elementor Outlets & Retail Experience Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Outlets_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_outlets';
    }

    public function get_title() {
        return esc_html__( 'Santino Outlets & Retail Cards', 'santino' );
    }

    public function get_icon() {
        return 'eicon-map-pin';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Section Header', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'VISIT OUR OUTLETS',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Where to Experience',
            )
        );

        $this->add_control(
            'title_accent',
            array(
                'label'   => esc_html__( 'Accent Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Santino Coffee',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Find our premium coffee at trusted retail partners and enjoy the Santino experience, near you.',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            array(
                'label'   => esc_html__( 'Outlet Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Shwapno Superstores',
            )
        );

        $repeater->add_control(
            'partner_tag',
            array(
                'label'   => esc_html__( 'Partner Tag', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'RETAIL PARTNER',
            )
        );

        $repeater->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Find Santino Coffee at your nearest Shwapno Superstore and enjoy your favorite brew.',
            )
        );

        $repeater->add_control(
            'location_tag',
            array(
                'label'   => esc_html__( 'Location Tag', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Nationwide',
            )
        );

        $repeater->add_control(
            'link_url',
            array(
                'label'   => esc_html__( 'Page Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/swapno/' ),
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Card Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => SANTINO_URI . '/assets/images/shwapno_santino_retail.jpg',
                ),
            )
        );

        $this->add_control(
            'outlets',
            array(
                'label'       => esc_html__( 'Outlet Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'name'         => 'Shwapno Superstores',
                        'partner_tag'  => 'RETAIL PARTNER',
                        'description'  => 'Find Santino Coffee at your nearest Shwapno Superstore and enjoy your favorite brew.',
                        'location_tag' => 'Nationwide',
                        'link_url'     => array( 'url' => '/swapno/' ),
                        'image'        => array( 'url' => SANTINO_URI . '/assets/images/shwapno_santino_retail.jpg' ),
                    ),
                    array(
                        'name'         => 'BFC (Best Fried Chicken)',
                        'partner_tag'  => 'RESTAURANT PARTNER',
                        'description'  => 'Enjoy Santino Coffee at BFC outlets, where great food meets great coffee.',
                        'location_tag' => 'Nationwide',
                        'link_url'     => array( 'url' => '/bfc/' ),
                        'image'        => array( 'url' => SANTINO_URI . '/assets/images/bfc_santino_foodservice.jpg' ),
                    ),
                ),
                'title_field' => '{{{ name }}} ({{{ partner_tag }}})',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $outlets = ! empty( $settings['outlets'] ) ? $settings['outlets'] : array();
        ?>
        <section class="outlets-experience-section" id="availability">
            <div class="container">
                <div class="text-center mb-5">
                    <?php if ( ! empty( $settings['badge'] ) ) : ?>
                        <div class="sec-pill-badge-wrap mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="sec-title mb-2">
                        <?php echo esc_html( $settings['title'] ); ?> 
                        <?php if ( ! empty( $settings['title_accent'] ) ) : ?>
                            <span class="sec-title-accent"><?php echo esc_html( $settings['title_accent'] ); ?></span>
                        <?php endif; ?>
                    </h2>
                    <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                        <p class="text-muted mx-auto" style="max-width: 620px; font-size: 0.95rem;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                    <?php endif; ?>
                </div>

                <div class="row g-4">
                    <?php foreach ( $outlets as $outlet ) : 
                        $img_url = ! empty( $outlet['image']['url'] ) ? esc_url( $outlet['image']['url'] ) : '';
                        $link_url = ! empty( $outlet['link_url']['url'] ) ? esc_url( $outlet['link_url']['url'] ) : '#';
                    ?>
                        <div class="col-lg-6">
                            <a href="<?php echo $link_url; ?>" class="outlet-card">
                                <img src="<?php echo $img_url; ?>" alt="<?php echo esc_attr( $outlet['name'] ); ?>" class="outlet-card-img" loading="lazy">
                                <div class="outlet-card-overlay"></div>
                                <span class="outlet-partner-badge"><i class="bi bi-shop me-1"></i> <?php echo esc_html( $outlet['partner_tag'] ); ?></span>
                                <div class="outlet-card-content">
                                    <h3 class="outlet-card-title"><?php echo esc_html( $outlet['name'] ); ?></h3>
                                    <p class="outlet-card-desc"><?php echo esc_html( $outlet['description'] ); ?></p>
                                    <div class="outlet-location-tag"><i class="bi bi-geo-alt-fill me-1"></i> <?php echo esc_html( $outlet['location_tag'] ); ?></div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
