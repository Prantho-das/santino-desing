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
            'layout_mode',
            array(
                'label'   => esc_html__( 'Layout Mode', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'featured' => 'Home Featured 4-Grid',
                    'catalog'  => 'Full Machinery Catalog with Filter Tabs',
                ),
                'default' => 'featured',
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
        $layout = ! empty( $settings['layout_mode'] ) ? $settings['layout_mode'] : 'featured';
        $products = ! empty( $settings['products'] ) ? $settings['products'] : array();
        $btn_url = ! empty( $settings['btn_url']['url'] ) ? esc_url( $settings['btn_url']['url'] ) : home_url( '/machines/' );

        if ( $layout === 'catalog' ) {
            ?>
            <section class="py-5" id="machineGrid">
                <div class="container">
                    <div class="sec-heading-center text-center mb-5 reveal">
                        <?php if ( ! empty( $settings['badge'] ) ) : ?>
                            <div class="sec-pill-badge-wrap mb-2">
                                <span class="sec-pill-line"></span>
                                <span class="sec-pill-badge"><i class="bi bi-gear-wide-connected me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                                <span class="sec-pill-line"></span>
                            </div>
                        <?php endif; ?>
                        <h2 class="sec-title"><?php echo esc_html( $settings['title'] ); ?> <?php if ( ! empty( $settings['title_italic'] ) ) : ?><em><?php echo esc_html( $settings['title_italic'] ); ?></em><?php endif; ?></h2>
                        <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                            <div class="sec-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 reveal">
                        <button class="branch-filter-btn active" onclick="santinoFilterMachines('all', this)">All Equipment (8)</button>
                        <button class="branch-filter-btn" onclick="santinoFilterMachines('traditional', this)">Traditional Commercial</button>
                        <button class="branch-filter-btn" onclick="santinoFilterMachines('superautomatic', this)">Bean-to-Cup Automatics</button>
                        <button class="branch-filter-btn" onclick="santinoFilterMachines('robotics', this)">Bionic Robotic Baristas</button>
                        <button class="branch-filter-btn" onclick="santinoFilterMachines('grinders', this)">Grinders & Care</button>
                    </div>

                    <div class="row g-4" id="machinesContainer">
                        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="100" data-category="traditional">
                            <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-dark">ITALIAN TRADITIONAL</span>
                                        <span class="text-muted small fw-bold">Victoria Arduino</span>
                                    </div>
                                    <div class="machine-img-box text-center my-3 hover-img-zoom">
                                        <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="Black Eagle Maverick" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1">Black Eagle Maverick</h4>
                                    <p class="text-muted small mb-3">T3 Genius multiboiler with PureBrew filter extraction and gravimetric auto-tare scales.</p>
                                    <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-light text-dark border">2/3 Group Heads</span>
                                        <span class="badge bg-light text-dark border">7100W Power</span>
                                        <span class="badge bg-light text-dark border">Gravitech Scale</span>
                                    </div>
                                </div>
                                <div class="border-top pt-3 d-flex gap-2">
                                    <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
                                    </button>
                                    <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        Book Demo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="200" data-category="traditional">
                            <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-teal text-white" style="background-color: var(--santino-teal);">ENERGY EFFICIENT</span>
                                        <span class="text-muted small fw-bold">Victoria Arduino</span>
                                    </div>
                                    <div class="machine-img-box text-center my-3 hover-img-zoom">
                                        <img src="<?php echo santino_img('imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg'); ?>" alt="Eagle One" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1">Eagle One Commercial</h4>
                                    <p class="text-muted small mb-3">NEO engine technology that uses instant heating to reduce carbon emissions by up to 35%.</p>
                                    <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-light text-dark border">NEO Instant Boiler</span>
                                        <span class="badge bg-light text-dark border">TERS Heat Recovery</span>
                                        <span class="badge bg-light text-dark border">Mobile App Control</span>
                                    </div>
                                </div>
                                <div class="border-top pt-3 d-flex gap-2">
                                    <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
                                    </button>
                                    <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        Book Demo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="300" data-category="traditional">
                            <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge text-white fw-bold" style="background-color: var(--santino-teal);">BESTSELLER WORKHORSE</span>
                                        <span class="text-muted small fw-bold">Nuova Simonelli</span>
                                    </div>
                                    <div class="machine-img-box text-center my-3 hover-img-zoom">
                                        <img src="<?php echo santino_img('nuova-simonelli-appia-viva-commercial-espresso-machine_1.png'); ?>" alt="Appia Life" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1">Nuova Simonelli Appia Life</h4>
                                    <p class="text-muted small mb-3">SIS Soft Infusion System guaranteeing creamy, consistent crema for high-volume cafes.</p>
                                    <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-light text-dark border">2/3 Group Volumetric</span>
                                        <span class="badge bg-light text-dark border">SIS Soft Infusion</span>
                                        <span class="badge bg-light text-dark border">EasyCream Auto Steamer</span>
                                    </div>
                                </div>
                                <div class="border-top pt-3 d-flex gap-2">
                                    <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
                                    </button>
                                    <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        Book Demo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="100" data-category="superautomatic">
                            <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-warning text-dark">TOUCHSCREEN AUTO</span>
                                        <span class="text-muted small fw-bold">Kalerm Premium</span>
                                    </div>
                                    <div class="machine-img-box text-center my-3 hover-img-zoom">
                                        <img src="<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>" alt="Kalerm Superautomatic" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1">Kalerm K95 / X400 Superautomatic</h4>
                                    <p class="text-muted small mb-3">Commercial 10.1" Android touchscreen, dual grinders, fresh milk foam, 200+ cups/day.</p>
                                    <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-light text-dark border">10.1" HD Touchscreen</span>
                                        <span class="badge bg-light text-dark border">Dual Bean Hoppers</span>
                                        <span class="badge bg-light text-dark border">Auto Milk Frother</span>
                                    </div>
                                </div>
                                <div class="border-top pt-3 d-flex gap-2">
                                    <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
                                    </button>
                                    <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        Book Demo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="200" data-category="robotics">
                            <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-danger text-white">BIONIC ROBOT</span>
                                        <span class="text-muted small fw-bold">CAYE Robotics</span>
                                    </div>
                                    <div class="machine-img-box text-center my-3 hover-img-zoom">
                                        <img src="<?php echo santino_img('imgi_24_santino_-_250522-07240.jpg'); ?>" alt="CAYE Robotic Barista" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1">CAYE Bionic Robotic Barista Station</h4>
                                    <p class="text-muted small mb-3">6-axis bionic arm pulling espresso, texturing microfoam latte art, and serving 65 cups/hour 24/7.</p>
                                    <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-light text-dark border">6-Axis Robotic Arm</span>
                                        <span class="badge bg-light text-dark border">Latte Art Free-Pour</span>
                                        <span class="badge bg-light text-dark border">Zero Staffing Required</span>
                                    </div>
                                </div>
                                <div class="border-top pt-3 d-flex gap-2">
                                    <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
                                    </button>
                                    <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        Book Demo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="300" data-category="grinders">
                            <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-dark">SINGLE DOSE COMMERCIAL</span>
                                        <span class="text-muted small fw-bold">Mahlkönig & Puqpress</span>
                                    </div>
                                    <div class="machine-img-box text-center my-3 hover-img-zoom">
                                        <img src="<?php echo santino_img('imgi_14_kalerm-202203230959.png'); ?>" alt="Mahlkönig EK43S" class="img-fluid" style="max-height: 200px; object-fit: contain;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1">Mahlkönig EK43S & Puqpress Precision</h4>
                                    <p class="text-muted small mb-3">98mm premium cast steel burrs and automated calibrated tamping ensuring channel-free extraction.</p>
                                    <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-light text-dark border">98mm Steel Burrs</span>
                                        <span class="badge bg-light text-dark border">Zero Retention</span>
                                        <span class="badge bg-light text-dark border">Auto Electronic Tamp</span>
                                    </div>
                                </div>
                                <div class="border-top pt-3 d-flex gap-2">
                                    <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
                                    </button>
                                    <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        Book Demo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="100" data-category="traditional">
                            <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-primary text-white">PRECISION BATCH BREWER</span>
                                        <span class="text-muted small fw-bold">3TEMP Sweden</span>
                                    </div>
                                    <div class="machine-img-box text-center my-3 hover-img-zoom">
                                        <img src="<?php echo santino_img('traditional-coffee-9kg_1.jpg'); ?>" alt="3TEMP Hipster" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1">3TEMP Hipster Precision Batch Brewer</h4>
                                    <p class="text-muted small mb-3">Swedish recipe controlled batch brewer controlling temperature stage-by-stage for pour-over quality.</p>
                                    <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-light text-dark border">3-Stage Temp Profiling</span>
                                        <span class="badge bg-light text-dark border">Cold Drip Feature</span>
                                        <span class="badge bg-light text-dark border">Low Power Idle</span>
                                    </div>
                                </div>
                                <div class="border-top pt-3 d-flex gap-2">
                                    <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
                                    </button>
                                    <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        Book Demo
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="200" data-category="grinders">
                            <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-success text-white">WATER PURIFICATION</span>
                                        <span class="text-muted small fw-bold">BWT Bestmax</span>
                                    </div>
                                    <div class="machine-img-box text-center my-3 hover-img-zoom">
                                        <img src="<?php echo santino_img('imgi_218_blackeagle2.jpg'); ?>" alt="BWT Bestmax" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1">BWT Bestmax Premium Water Softening Filtration</h4>
                                    <p class="text-muted small mb-3">High Capacity 5-stage magnesium mineralizer filter system guarding boilers against scaling in Bangladesh.</p>
                                    <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                                        <span class="badge bg-light text-dark border">Magnesium Mineralizer</span>
                                        <span class="badge bg-light text-dark border">Scale Defense</span>
                                        <span class="badge bg-light text-dark border">Digital Flow Meter</span>
                                    </div>
                                </div>
                                <div class="border-top pt-3 d-flex gap-2">
                                    <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
                                    </button>
                                    <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                                        Book Demo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script>
            function santinoFilterMachines(cat, btn) {
                var btns = document.querySelectorAll('#machineGrid .branch-filter-btn');
                btns.forEach(function(b) { b.classList.remove('active'); });
                if (btn) btn.classList.add('active');
                var cards = document.querySelectorAll('#machinesContainer .machine-card-col');
                cards.forEach(function(c) {
                    if (cat === 'all' || c.getAttribute('data-category') === cat) {
                        c.style.display = '';
                    } else {
                        c.style.display = 'none';
                    }
                });
            }
            if (typeof filterMachines === 'undefined') {
                window.filterMachines = santinoFilterMachines;
            }
            </script>
            <?php
            return;
        }
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
