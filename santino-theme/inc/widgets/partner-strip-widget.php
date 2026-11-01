<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Partner_Strip_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_partner_strip';
    }

    public function get_title() {
        return esc_html__( 'Santino Partner Brands & Banner', 'santino' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_cta',
            array(
                'label' => esc_html__( 'Cafe Partner Banner (Right)', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'EXPAND WITH SANTINO',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Become Our Cafe Partner',
            )
        );

        $this->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Turnkey machine setups, roasted beans & barista coaching.',
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'PARTNER WITH US',
            )
        );

        $this->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Button Link', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '#enquiryModal' ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_brands',
            array(
                'label' => esc_html__( 'Brand Logos (Left)', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            array(
                'label'   => esc_html__( 'Brand Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BFC',
            )
        );

        $repeater->add_control(
            'sub',
            array(
                'label'   => esc_html__( 'Sub Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BEST FRIED CHICKEN',
            )
        );

        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__( 'Icon Class (Optional)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            )
        );

        $repeater->add_control(
            'css_class',
            array(
                'label'   => esc_html__( 'CSS Style Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'brand-bfc'       => 'BFC Style',
                    'brand-movenpick' => 'Mövenpick Style',
                    'brand-ritz'      => 'The Ritz-Carlton Style',
                    'brand-citymax'   => 'Citymax Style',
                    'brand-aroma'     => 'Café Aroma Style',
                    'brand-urban'     => 'Urban Brew Style',
                ),
                'default' => 'brand-bfc',
            )
        );

        $this->add_control(
            'brands',
            array(
                'label'       => esc_html__( 'Brand Strip Items', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array( 'name' => 'BFC', 'sub' => 'BEST FRIED CHICKEN', 'icon' => '', 'css_class' => 'brand-bfc' ),
                    array( 'name' => 'MÖVENPICK', 'sub' => 'HOTELS & RESORTS', 'icon' => '', 'css_class' => 'brand-movenpick' ),
                    array( 'name' => 'THE RITZ-CARLTON', 'sub' => '', 'icon' => 'bi bi-shield-shaded', 'css_class' => 'brand-ritz' ),
                    array( 'name' => 'CITYMAX', 'sub' => 'HOTELS', 'icon' => '', 'css_class' => 'brand-citymax' ),
                    array( 'name' => 'Café Aroma', 'sub' => 'CAFE & BISTRO', 'icon' => '', 'css_class' => 'brand-aroma' ),
                    array( 'name' => 'URBAN BREW', 'sub' => 'COFFEE & KITCHEN', 'icon' => 'bi bi-flower1', 'css_class' => 'brand-urban' ),
                ),
                'title_field' => '{{{ name }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $brands = ! empty( $settings['brands'] ) ? $settings['brands'] : array();
        $btn_url = ! empty( $settings['btn_url']['url'] ) ? esc_url( $settings['btn_url']['url'] ) : '#';
        $is_modal = strpos( $btn_url, '#enquiryModal' ) !== false;
        ?>
        <section class="hospitality-partner-strip" id="partner-strip">
            <div class="container-fluid p-0">
                <div class="row g-0 align-items-stretch">
                    <div class="col-lg-8 partner-brands-col">
                        <?php foreach ( $brands as $i => $brand ) : ?>
                            <?php if ( $i > 0 ) : ?>
                                <span class="brand-dot">•</span>
                            <?php endif; ?>
                            <div class="brand-item">
                                <?php if ( ! empty( $brand['icon'] ) ) : ?>
                                    <div class="brand-icon"><i class="<?php echo esc_attr( $brand['icon'] ); ?>"></i></div>
                                <?php endif; ?>
                                <div class="<?php echo esc_attr( $brand['css_class'] ); ?>"><?php echo esc_html( $brand['name'] ); ?></div>
                                <?php if ( ! empty( $brand['sub'] ) ) : ?>
                                    <div class="brand-sub"><?php echo esc_html( $brand['sub'] ); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="col-lg-4 cafe-cta-col">
                        <?php if ( ! empty( $settings['badge'] ) ) : ?>
                            <div class="sec-pill-badge-wrap start light mb-2">
                                <span class="sec-pill-line"></span>
                                <span class="sec-pill-badge"><i class="bi bi-flower2 me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                                <span class="sec-pill-line"></span>
                            </div>
                        <?php endif; ?>
                        <h3 class="cafe-cta-title"><?php echo esc_html( $settings['title'] ); ?></h3>
                        <?php if ( ! empty( $settings['desc'] ) ) : ?>
                            <p class="cafe-cta-desc"><?php echo esc_html( $settings['desc'] ); ?></p>
                        <?php endif; ?>
                        <div>
                            <?php if ( $is_modal ) : ?>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#enquiryModal" class="btn-cafe-partner">
                                    <?php echo esc_html( $settings['btn_text'] ); ?> <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            <?php else : ?>
                                <a href="<?php echo $btn_url; ?>" class="btn-cafe-partner">
                                    <?php echo esc_html( $settings['btn_text'] ); ?> <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
