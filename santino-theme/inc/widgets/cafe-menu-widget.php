<?php
/**
 * Elementor Cafe Menu Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Cafe_Menu_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_cafe_menu';
    }

    public function get_title() {
        return esc_html__( 'Santino Featured Cafe Menu Slider', 'santino' );
    }

    public function get_icon() {
        return 'eicon-table';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Header & Loyalty', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '100% ARTISAN ROASTED BEANS',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Main Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Good Coffee,',
            )
        );

        $this->add_control(
            'title_highlight',
            array(
                'label'   => esc_html__( 'Title Highlight', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Better Days',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Santino Caffè signature hot & chilled brews crafted with Italian roasted espresso for your daily boost.',
            )
        );

        $this->add_control(
            'menu_url',
            array(
                'label'   => esc_html__( 'Full Menu Page URL', 'santino' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => array( 'url' => '/menu/' ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name',
            array(
                'label'   => esc_html__( 'Drink Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Cappuccino',
            )
        );

        $repeater->add_control(
            'tag_text',
            array(
                'label'   => esc_html__( 'Badge Tag', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Hot Classic',
            )
        );

        $repeater->add_control(
            'tag_type',
            array(
                'label'   => esc_html__( 'Tag Style', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'hot-tag'    => 'Hot (Orange)',
                    'cold-tag'   => 'Cold (Blue)',
                    'frappe-tag' => 'Signature / Frappe (Purple/Gold)',
                ),
                'default' => 'hot-tag',
            )
        );

        $repeater->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Velvety micro-foam espresso with rich aroma & smooth taste.',
            )
        );

        $repeater->add_control(
            'price',
            array(
                'label'   => esc_html__( 'Price (in Tk)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '170',
            )
        );

        $repeater->add_control(
            'size',
            array(
                'label'   => esc_html__( 'Size Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '/ Reg',
            )
        );

        $repeater->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Drink Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=600&auto=format&fit=crop&q=80',
                ),
            )
        );

        $this->add_control(
            'drinks',
            array(
                'label'       => esc_html__( 'Drink Items', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'name'        => 'Cappuccino',
                        'tag_text'    => 'Hot Classic',
                        'tag_type'    => 'hot-tag',
                        'description' => 'Velvety micro-foam espresso with rich aroma & smooth taste.',
                        'price'       => '170',
                        'size'        => '/ Reg',
                        'image'       => array( 'url' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=600&auto=format&fit=crop&q=80' ),
                    ),
                    array(
                        'name'        => 'Iced Latte',
                        'tag_text'    => 'Cold Favorite',
                        'tag_type'    => 'cold-tag',
                        'description' => 'Smooth chilled milk layered over double shot fresh espresso.',
                        'price'       => '200',
                        'size'        => '/ Large',
                        'image'       => array( 'url' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=600&auto=format&fit=crop&q=80' ),
                    ),
                    array(
                        'name'        => 'Iced Mocha',
                        'tag_text'    => 'Rich Cocoa',
                        'tag_type'    => 'cold-tag',
                        'description' => 'Premium dark chocolate syrup drizzle with iced espresso and cream.',
                        'price'       => '210',
                        'size'        => '/ Large',
                        'image'       => array( 'url' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?w=700&auto=format&fit=crop&q=85' ),
                    ),
                    array(
                        'name'        => 'Mocha Frappe',
                        'tag_text'    => 'Hero Item',
                        'tag_type'    => 'frappe-tag',
                        'description' => 'Blended iced coffee topped with whipped cream and rich chocolate fudge.',
                        'price'       => '230',
                        'size'        => '/ Large',
                        'image'       => array( 'url' => 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=600&auto=format&fit=crop&q=80' ),
                    ),
                    array(
                        'name'        => 'Hazelnut Frappe',
                        'tag_text'    => 'Signature',
                        'tag_type'    => 'frappe-tag',
                        'description' => 'Roasted hazelnut blend with crushed ice, coffee essence & whipped peak.',
                        'price'       => '230',
                        'size'        => '/ Large',
                        'image'       => array( 'url' => 'https://images.unsplash.com/photo-1579888944880-d98341245702?w=600&auto=format&fit=crop&q=80' ),
                    ),
                    array(
                        'name'        => 'Americano',
                        'tag_text'    => 'Bold Brew',
                        'tag_type'    => 'hot-tag',
                        'description' => 'Double-shot artisan espresso lengthened with purified hot water.',
                        'price'       => '140',
                        'size'        => '/ Reg',
                        'image'       => array( 'url' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=600&auto=format&fit=crop&q=80' ),
                    ),
                    array(
                        'name'        => 'Iced Chocolate',
                        'tag_text'    => 'Sweet Sip',
                        'tag_type'    => 'cold-tag',
                        'description' => 'Indulgent dark chocolate blended creamy with ice cold milk.',
                        'price'       => '190',
                        'size'        => '/ Large',
                        'image'       => array( 'url' => 'https://images.unsplash.com/photo-1541658016709-82535e94bc69?w=600&auto=format&fit=crop&q=80' ),
                    ),
                ),
                'title_field' => '{{{ name }}} (Tk. {{{ price }}}) - {{{ tag_text }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $drinks = ! empty( $settings['drinks'] ) ? $settings['drinks'] : array();
        $menu_url = ! empty( $settings['menu_url']['url'] ) ? esc_url( $settings['menu_url']['url'] ) : home_url( '/menu/' );
        ?>
        <section class="home-menu-preview-section py-5 position-relative" id="featured-menu">
            <div class="container py-3">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                    <div>
                        <?php if ( ! empty( $settings['badge'] ) ) : ?>
                            <div class="sec-pill-badge-wrap start mb-2">
                                <span class="sec-pill-line"></span>
                                <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                                <span class="sec-pill-line"></span>
                            </div>
                        <?php endif; ?>
                        <h2 class="sec-title mb-2">
                            <?php echo esc_html( $settings['title'] ); ?> 
                            <?php if ( ! empty( $settings['title_highlight'] ) ) : ?>
                                <span class="menu-title-highlight"><?php echo esc_html( $settings['title_highlight'] ); ?></span>
                            <?php endif; ?>
                        </h2>
                        <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                            <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mt-3 mt-md-0 d-flex align-items-center gap-2">
                        <button class="menu-slider-nav-btn menu-slider-prev" aria-label="Previous Drink">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <button class="menu-slider-nav-btn menu-slider-next" aria-label="Next Drink">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                        <a href="<?php echo $menu_url; ?>" class="btn btn-dark ms-2 fw-bold px-4 py-2 rounded-pill shadow-sm" style="background: var(--kp-maroon); border: none; font-size: 13.5px; letter-spacing: 0.4px;">
                            View Full Menu <i class="bi bi-arrow-up-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="menu-teaser-slider-wrapper">
                    <div class="menu-teaser-track" id="menuTeaserTrack">
                        <?php foreach ( $drinks as $item ) : 
                            $img_url = ! empty( $item['image']['url'] ) ? esc_url( $item['image']['url'] ) : '';
                            $tag_class = ! empty( $item['tag_type'] ) ? $item['tag_type'] : 'hot-tag';
                        ?>
                            <div class="menu-teaser-card">
                                <div class="menu-teaser-img-box">
                                    <img src="<?php echo $img_url; ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" loading="lazy">
                                </div>
                                <div class="menu-teaser-info">
                                    <div>
                                        <div class="d-flex justify-content-end">
                                            <span class="menu-card-tag <?php echo esc_attr( $tag_class ); ?>">
                                                <i class="bi bi-fire"></i> <?php echo esc_html( $item['tag_text'] ); ?>
                                            </span>
                                        </div>
                                        <h4 class="menu-teaser-title"><?php echo esc_html( $item['name'] ); ?></h4>
                                        <p class="menu-teaser-desc"><?php echo esc_html( $item['description'] ); ?></p>
                                    </div>
                                    <div class="menu-teaser-price-row">
                                        <div class="price-val"><span class="currency">Tk.</span> <?php echo esc_html( $item['price'] ); ?> <small class="text-muted fs-8"><?php echo esc_html( $item['size'] ); ?></small></div>
                                        <a href="<?php echo $menu_url; ?>" class="menu-add-btn" title="View in Menu"><i class="bi bi-plus-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Loyalty Strip -->
                <div class="menu-loyalty-strip mt-4 d-flex flex-column flex-lg-row justify-content-between align-items-center p-3 p-md-4 text-white">
                    <div class="d-flex align-items-center gap-3 text-center text-md-start mb-3 mb-lg-0">
                        <div class="loyalty-icon-circle">
                            <i class="bi bi-gift-fill"></i>
                        </div>
                        <div>
                            <span class="loyalty-tag-pill"><i class="bi bi-gem me-1"></i> VIP Club Benefit</span>
                            <div class="fw-bold fs-5 text-white">Santino Coffee Member Perk</div>
                            <div class="small text-white-50" style="font-size: 0.92rem;">
                                Buy 5 Coffees &amp; Get your 6th one <span class="loyalty-free-highlight">100% Free!</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2 justify-content-center">
                        <a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="btn btn-loyalty-primary">
                            <i class="bi bi-stars me-1"></i> Become Member
                        </a>
                        <a href="<?php echo $menu_url; ?>" class="btn btn-loyalty-secondary">
                            Explore Menu (20+ Items) <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>
        <?php
    }
}
