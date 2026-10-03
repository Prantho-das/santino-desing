<?php
/**
 * Elementor Brands Showcase Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Brands_Showcase_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_brands_showcase';
    }

    public function get_title() {
        return esc_html__( 'Santino Brand Partners Showcase', 'santino' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Brand Cards', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Section Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Official Authorized Partner Brands',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Section Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'We are the exclusive and authorized importer of the world’s most prestigious coffee brands in Bangladesh.',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'brand_name',
            array(
                'label'   => esc_html__( 'Brand Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Nuova Simonelli',
            )
        );

        $repeater->add_control(
            'origin',
            array(
                'label'   => esc_html__( 'Country of Origin', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Italy',
            )
        );

        $repeater->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Official Importer',
            )
        );

        $repeater->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'World barista championship standard espresso machines engineered for performance.',
            )
        );

        $this->add_control(
            'brands_list',
            array(
                'label'       => esc_html__( 'Brands', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'brand_name'  => 'Nuova Simonelli',
                        'origin'      => 'Belforte del Chienti, Italy',
                        'badge'       => 'Exclusive Importer',
                        'description' => 'Renowned for Appia Life, Aurelia Wave, and commercial espresso machinery with T3 tech.',
                    ),
                    array(
                        'brand_name'  => 'Victoria Arduino',
                        'origin'      => 'Italy',
                        'badge'       => 'Official Partner',
                        'description' => 'State-of-the-art specialty machines like Black Eagle Maverick and Mythos One grinders.',
                    ),
                    array(
                        'brand_name'  => 'CREM Coffee (Welbilt)',
                        'origin'      => 'Sweden / Spain',
                        'badge'       => 'Authorized Hub',
                        'description' => 'Heavy-duty EX3, Megacrem, and Diamant Pro professional cafe systems.',
                    ),
                    array(
                        'brand_name'  => 'Kalerm Commercial',
                        'origin'      => 'Germany / Asia',
                        'badge'       => 'Sole Distributor',
                        'description' => 'High-speed automated bean-to-cup coffee machines for busy corporate cafeterias.',
                    ),
                    array(
                        'brand_name'  => '3TEMP Specialty Brewers',
                        'origin'      => 'Sweden',
                        'badge'       => 'Nordic Precision',
                        'description' => 'Cutting edge batch brew and profiling filter coffee systems.',
                    ),
                    array(
                        'brand_name'  => 'Monin Syrups & Purees',
                        'origin'      => 'France',
                        'badge'       => 'Authorized Supply',
                        'description' => 'Premium gourmet syrups, fruit purees, and frappe beverage bases.',
                    ),
                ),
                'title_field' => '{{{ brand_name }}} ({{{ origin }}})',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="py-5 bg-light brands-builder-section">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="display-6 font-heading fw-black text-dark mb-2"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <p class="text-muted mx-auto" style="max-width: 650px;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                </div>

                <div class="row g-4">
                    <?php foreach ( $settings['brands_list'] as $b ) : ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white hover-lift transition-all">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="badge bg-warning bg-opacity-25 text-dark border border-warning border-opacity-50 px-3 py-1 rounded-pill small fw-bold">
                                        <?php echo esc_html( $b['badge'] ); ?>
                                    </span>
                                    <span class="text-muted small"><i class="bi bi-geo-alt-fill text-danger me-1"></i><?php echo esc_html( $b['origin'] ); ?></span>
                                </div>
                                <h4 class="h5 fw-bold text-dark mb-2"><?php echo esc_html( $b['brand_name'] ); ?></h4>
                                <p class="small text-muted mb-4"><?php echo esc_html( $b['description'] ); ?></p>
                                <div class="mt-auto pt-3 border-top">
                                    <a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="btn btn-outline-dark btn-sm rounded-pill px-3">View Machines <i class="bi bi-arrow-right ms-1"></i></a>
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
