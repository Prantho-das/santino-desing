<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Machine_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_machine_grid';
    }

    public function get_title() {
        return esc_html__( 'Santino Featured Equipment & Coffee Cards', 'santino' );
    }

    public function get_icon() {
        return 'eicon-products-grid';
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
                'default' => 'PREMIUM SELECTION',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Featured Equipment &',
            )
        );

        $this->add_control(
            'title_italic',
            array(
                'label'   => esc_html__( 'Italic Accent Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Coffee',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Reliable machines, quality beans, and essential tools for the perfect cup.',
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Top Link Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'View All Products',
            )
        );

        $this->add_control(
            'btn_url',
            array(
                'label'   => esc_html__( 'Top Link URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/machines/' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Product Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'La Marzocco Linea PB',
            )
        );

        $repeater->add_control(
            'price',
            array(
                'label'   => esc_html__( 'Price String', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '৳ 4,250,000',
            )
        );

        $repeater->add_control(
            'currency',
            array(
                'label'   => esc_html__( 'Currency Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BDT',
            )
        );

        $repeater->add_control(
            'stock_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'IN STOCK',
            )
        );

        $repeater->add_control(
            'badge_style',
            array(
                'label'   => esc_html__( 'Badge Style', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'in-stock'    => 'In Stock (Green)',
                    'best-seller' => 'Best Seller (Gold)',
                ),
                'default' => 'in-stock',
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Product Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp' ) : '',
                ),
            )
        );

        $repeater->add_control(
            'spec1_icon',
            array(
                'label'   => esc_html__( 'Spec 1 Icon', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-cup-hot',
            )
        );

        $repeater->add_control(
            'spec1_text',
            array(
                'label'   => esc_html__( 'Spec 1 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Dual Boiler',
            )
        );

        $repeater->add_control(
            'spec2_icon',
            array(
                'label'   => esc_html__( 'Spec 2 Icon', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-sliders',
            )
        );

        $repeater->add_control(
            'spec2_text',
            array(
                'label'   => esc_html__( 'Spec 2 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'PID Control',
            )
        );

        $repeater->add_control(
            'spec3_icon',
            array(
                'label'   => esc_html__( 'Spec 3 Icon', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-speedometer2',
            )
        );

        $repeater->add_control(
            'spec3_text',
            array(
                'label'   => esc_html__( 'Spec 3 Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'High Capacity',
            )
        );

        $this->add_control(
            'products',
            array(
                'label'       => esc_html__( 'Product Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title'       => 'La Marzocco Linea PB',
                        'price'       => '৳ 4,250,000',
                        'currency'    => 'BDT',
                        'stock_badge' => 'IN STOCK',
                        'badge_style' => 'in-stock',
                        'image'       => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp' ) : '' ),
                        'spec1_icon'  => 'bi bi-cup-hot',
                        'spec1_text'  => 'Dual Boiler',
                        'spec2_icon'  => 'bi bi-sliders',
                        'spec2_text'  => 'PID Control',
                        'spec3_icon'  => 'bi bi-speedometer2',
                        'spec3_text'  => 'High Capacity',
                    ),
                    array(
                        'title'       => 'Mahlkönig EK43 Grinder',
                        'price'       => '৳ 680,000',
                        'currency'    => 'BDT',
                        'stock_badge' => 'IN STOCK',
                        'badge_style' => 'in-stock',
                        'image'       => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_14_kalerm-202203230959.png' ) : '' ),
                        'spec1_icon'  => 'bi bi-gear',
                        'spec1_text'  => 'Flat Burrs',
                        'spec2_icon'  => 'bi bi-crosshair',
                        'spec2_text'  => 'High Precision',
                        'spec3_icon'  => 'bi bi-box',
                        'spec3_text'  => 'Low Retention',
                    ),
                    array(
                        'title'       => 'Nuova Simonelli Appia Life',
                        'price'       => '৳ 1,150,000',
                        'currency'    => 'BDT',
                        'stock_badge' => 'IN STOCK',
                        'badge_style' => 'in-stock',
                        'image'       => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg' ) : '' ),
                        'spec1_icon'  => 'bi bi-cup-hot',
                        'spec1_text'  => '2 Group',
                        'spec2_icon'  => 'bi bi-lightning-charge',
                        'spec2_text'  => 'Energy Saving',
                        'spec3_icon'  => 'bi bi-shield-check',
                        'spec3_text'  => 'Reliable',
                    ),
                    array(
                        'title'       => 'Santino Premium Blend (1kg)',
                        'price'       => '৳ 2,800',
                        'currency'    => 'BDT',
                        'stock_badge' => 'BEST SELLER',
                        'badge_style' => 'best-seller',
                        'image'       => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_22_Untitleddesign_4.png' ) : '' ),
                        'spec1_icon'  => 'bi bi-fire',
                        'spec1_text'  => 'Rich Aroma',
                        'spec2_icon'  => 'bi bi-droplet',
                        'spec2_text'  => 'Balanced Taste',
                        'spec3_icon'  => 'bi bi-tree',
                        'spec3_text'  => '100% Arabica',
                    ),
                ),
                'title_field' => '{{{ title }}} ({{{ price }})',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $products = ! empty( $settings['products'] ) ? $settings['products'] : array();
        $btn_url = ! empty( $settings['btn_url']['url'] ) ? esc_url( $settings['btn_url']['url'] ) : home_url( '/machines/' );
        ?>
        <section class="featured-equipment-section" id="products">
            <div class="container">
                <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
                    <div>
                        <?php if ( ! empty( $settings['badge'] ) ) : ?>
                            <div class="sec-pill-badge-wrap start mb-2">
                                <span class="sec-pill-line"></span>
                                <span class="sec-pill-badge"><i class="bi bi-star-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                                <span class="sec-pill-line"></span>
                            </div>
                        <?php endif; ?>
                        <h2 class="feat-sec-title">
                            <?php echo esc_html( $settings['title'] ); ?> 
                            <?php if ( ! empty( $settings['title_italic'] ) ) : ?>
                                <em><?php echo esc_html( $settings['title_italic'] ); ?></em>
                            <?php endif; ?>
                        </h2>
                        <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                            <p class="feat-sec-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $settings['btn_text'] ) ) : ?>
                        <div>
                            <a href="<?php echo $btn_url; ?>" class="btn-view-all">
                                <?php echo esc_html( $settings['btn_text'] ); ?> <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row g-4 align-items-stretch">
                    <?php foreach ( $products as $prod ) : 
                        $img_url = ! empty( $prod['image']['url'] ) ? esc_url( $prod['image']['url'] ) : '';
                        $badge_class = ! empty( $prod['badge_style'] ) ? $prod['badge_style'] : 'in-stock';
                    ?>
                        <div class="col-xl-3 col-lg-6 col-md-6">
                            <div class="equipment-card">
                                <div>
                                    <div class="equipment-card-top">
                                        <span class="stock-badge <?php echo esc_attr( $badge_class ); ?>"><?php echo esc_html( $prod['stock_badge'] ); ?></span>
                                        <button class="btn-wishlist" aria-label="Add to wishlist"><i class="bi bi-suit-heart"></i></button>
                                    </div>
                                    <div class="equipment-img-box">
                                        <img src="<?php echo $img_url; ?>" alt="<?php echo esc_attr( $prod['title'] ); ?>" class="equipment-img" loading="lazy">
                                    </div>
                                    <h5 class="equipment-title"><?php echo esc_html( $prod['title'] ); ?></h5>
                                    <div class="equipment-price"><?php echo esc_html( $prod['price'] ); ?> <span class="currency"><?php echo esc_html( $prod['currency'] ); ?></span></div>
                                    <div class="equipment-specs-row">
                                        <?php if ( ! empty( $prod['spec1_text'] ) ) : ?>
                                            <span class="spec-pill"><i class="<?php echo esc_attr( $prod['spec1_icon'] ); ?>"></i> <?php echo esc_html( $prod['spec1_text'] ); ?></span>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $prod['spec2_text'] ) ) : ?>
                                            <span class="spec-pill"><i class="<?php echo esc_attr( $prod['spec2_icon'] ); ?>"></i> <?php echo esc_html( $prod['spec2_text'] ); ?></span>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $prod['spec3_text'] ) ) : ?>
                                            <span class="spec-pill"><i class="<?php echo esc_attr( $prod['spec3_icon'] ); ?>"></i> <?php echo esc_html( $prod['spec3_text'] ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn-add-cart" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                                        <i class="bi bi-cart2"></i> Add to Cart <i class="bi bi-arrow-right ms-1"></i>
                                    </button>
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
