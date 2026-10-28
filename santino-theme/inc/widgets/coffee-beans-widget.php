<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Coffee_Beans_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_coffee_beans';
    }

    public function get_title() {
        return esc_html__( 'Santino Specialty Beans', 'santino' );
    }

    public function get_icon() {
        return 'eicon-cup';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Coffee Beans Showcase', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'   => esc_html__( 'Pill Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SPECIALTY ROAST COLLECTION',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Roasted to Peak Flavor Expression',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Explore our Single Origin Espressos (SOE), heritage espresso blends, and OEM private label options',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'bean_name',
            array(
                'label'   => esc_html__( 'Bean / Blend Name', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Ethiopia Yirgacheffe G1',
            )
        );

        $repeater->add_control(
            'category',
            array(
                'label'   => esc_html__( 'Filter Category', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'single-origin' => 'Single Origin (SOE)',
                    'blends'        => 'Espresso Blends',
                    'retail'        => 'Retail Packs (Shwapno)',
                ),
                'default' => 'single-origin',
            )
        );

        $repeater->add_control(
            'badge_text',
            array(
                'label'   => esc_html__( 'Card Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '90+ CUPPING SCORE',
            )
        );

        $repeater->add_control(
            'badge_style',
            array(
                'label'   => esc_html__( 'Badge Style', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'gold' => 'Gold (var(--santino-gold))',
                    'teal' => 'Teal (var(--santino-teal))',
                ),
                'default' => 'gold',
            )
        );

        $repeater->add_control(
            'country',
            array(
                'label'   => esc_html__( 'Country / Origin', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Ethiopia',
            )
        );

        $repeater->add_control(
            'bean_image',
            array(
                'label'   => esc_html__( 'Bean Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'beans-ethiopia-yirgacheffe.jpg' ) : '',
                ),
            )
        );

        $repeater->add_control(
            'description',
            array(
                'label'   => esc_html__( 'Short Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Washed process from 1,900m altitude. Bursting with jasmine florals, bergamot citrus, and sweet honey.',
            )
        );

        $repeater->add_control(
            'tag1',
            array(
                'label'   => esc_html__( 'Flavor Tag 1', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Jasmine',
            )
        );

        $repeater->add_control(
            'tag2',
            array(
                'label'   => esc_html__( 'Flavor Tag 2', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Bergamot',
            )
        );

        $repeater->add_control(
            'tag3',
            array(
                'label'   => esc_html__( 'Roast / Brew Tag 3', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Light-Medium Roast',
            )
        );

        $repeater->add_control(
            'price',
            array(
                'label'   => esc_html__( 'Price', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '৳ 1,450',
            )
        );

        $repeater->add_control(
            'price_unit',
            array(
                'label'   => esc_html__( 'Price Unit', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => ' / 250g',
            )
        );

        $repeater->add_control(
            'btn_text',
            array(
                'label'   => esc_html__( 'Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Order Beans',
            )
        );

        $this->add_control(
            'beans_list',
            array(
                'label'       => esc_html__( 'Beans List', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'bean_name'   => 'Ethiopia Yirgacheffe G1',
                        'category'    => 'single-origin',
                        'badge_text'  => '90+ CUPPING SCORE',
                        'badge_style' => 'gold',
                        'country'     => 'Ethiopia',
                        'description' => 'Washed process from 1,900m altitude. Bursting with jasmine florals, bergamot citrus, and sweet honey.',
                        'tag1'        => 'Jasmine',
                        'tag2'        => 'Bergamot',
                        'tag3'        => 'Light-Medium Roast',
                        'price'       => '৳ 1,450',
                        'price_unit'  => ' / 250g',
                        'btn_text'    => 'Order Beans',
                        'bean_image'  => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'beans-ethiopia-yirgacheffe.jpg' ) : '' ),
                    ),
                    array(
                        'bean_name'   => 'Colombia Huila Geisha Reserve',
                        'category'    => 'single-origin',
                        'badge_text'  => 'CHAMPIONSHIP LOT',
                        'badge_style' => 'teal',
                        'country'     => 'Colombia',
                        'description' => 'Anaerobic slow fermentation. Extraordinary aroma of white peach, lavender blossom, and silky green tea finish.',
                        'tag1'        => 'White Peach',
                        'tag2'        => 'Lavender',
                        'tag3'        => 'Filter / Light',
                        'price'       => '৳ 2,200',
                        'price_unit'  => ' / 250g',
                        'btn_text'    => 'Order Beans',
                        'bean_image'  => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'beans-colombia-geisha.jpg' ) : '' ),
                    ),
                    array(
                        'bean_name'   => 'The Green Label Master Blend',
                        'category'    => 'blends',
                        'badge_text'  => '100% RAINFOREST ALLIANCE',
                        'badge_style' => 'teal',
                        'country'     => 'House Blend',
                        'description' => 'Our flagship commercial espresso blend. Thick golden crema, notes of Swiss dark chocolate, roasted almond, and sweet brown sugar.',
                        'tag1'        => 'Dark Cocoa',
                        'tag2'        => 'Hazelnut',
                        'tag3'        => 'Full City Medium-Dark',
                        'price'       => '৳ 3,800',
                        'price_unit'  => ' / 1kg Bag',
                        'btn_text'    => 'Order Beans',
                        'bean_image'  => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'beans-green-label-blend.jpg' ) : '' ),
                    ),
                    array(
                        'bean_name'   => 'Santino Crema Master Roastery Blend',
                        'category'    => 'blends',
                        'badge_text'  => 'INTENSE CREMA',
                        'badge_style' => 'gold',
                        'country'     => 'Crema Master',
                        'description' => 'Specially crafted for milky lattes and cappuccinos. Cuts through whole and plant-based milks with rich caramel and roasted pecan.',
                        'tag1'        => 'Caramelized Pecan',
                        'tag2'        => 'Dark Chocolate',
                        'tag3'        => 'Dark Roast',
                        'price'       => '৳ 3,400',
                        'price_unit'  => ' / 1kg Bag',
                        'btn_text'    => 'Order Beans',
                        'bean_image'  => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'traditional-coffee-9kg_1.jpg' ) : '' ),
                    ),
                    array(
                        'bean_name'   => 'Santino Classic Roast & Ground (250g)',
                        'category'    => 'retail',
                        'badge_text'  => 'SHWAPNO RETAIL PACK',
                        'badge_style' => 'teal',
                        'country'     => 'Home Brew',
                        'description' => 'Available across 100+ Shwapno Superstores nationwide. Nitro-flushed with valve seal for 12 months freshness.',
                        'tag1'        => 'Ground / Whole Bean',
                        'tag2'        => 'Moka Pot / French Press',
                        'tag3'        => 'Medium Dark',
                        'price'       => '৳ 680',
                        'price_unit'  => ' / 250g Retail Pack',
                        'btn_text'    => 'Store Finder',
                        'bean_image'  => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'shwapno_santino_retail.jpg' ) : '' ),
                    ),
                    array(
                        'bean_name'   => 'Sumatra Mandheling Triple Picked',
                        'category'    => 'single-origin',
                        'badge_text'  => 'VOLCANIC TERROIR',
                        'badge_style' => 'gold',
                        'country'     => 'Sumatra',
                        'description' => 'Wet-hulled Giling Basah method. Heavy body, spicy cedarwood, dark molasses, and low acidity.',
                        'tag1'        => 'Spicy Cedar',
                        'tag2'        => 'Molasses',
                        'tag3'        => 'Dark Roast',
                        'price'       => '৳ 1,350',
                        'price_unit'  => ' / 250g',
                        'btn_text'    => 'Order Beans',
                        'bean_image'  => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'beans-ethiopia-yirgacheffe.jpg' ) : '' ),
                    ),
                ),
                'title_field' => '{{{ bean_name }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $beans = ! empty( $settings['beans_list'] ) ? $settings['beans_list'] : array();
        ?>
        <section class="py-5" id="roastCatalog">
            <div class="container">
                <div class="sec-heading-center text-center mb-5 reveal">
                    <?php if ( ! empty( $settings['badge_text'] ) ) : ?>
                        <div class="sec-pill-badge-wrap mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-award-fill me-1"></i> <?php echo esc_html( $settings['badge_text'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="sec-title"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                        <div class="sec-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 reveal">
                    <button class="branch-filter-btn active" onclick="santinoFilterBeans('all', this)">All Bean Collections (<?php echo count( $beans ); ?>)</button>
                    <button class="branch-filter-btn" onclick="santinoFilterBeans('single-origin', this)">Single Origin (SOE)</button>
                    <button class="branch-filter-btn" onclick="santinoFilterBeans('blends', this)">Espresso Blends</button>
                    <button class="branch-filter-btn" onclick="santinoFilterBeans('retail', this)">Retail Packs (Shwapno)</button>
                </div>

                <div class="row g-4" id="santinoBeansContainer">
                    <?php foreach ( $beans as $idx => $item ) : 
                        $cat = ! empty( $item['category'] ) ? $item['category'] : 'single-origin';
                        $delay = ( ( $idx % 3 ) + 1 ) * 100;
                        $img = ! empty( $item['bean_image']['url'] ) ? esc_url( $item['bean_image']['url'] ) : ( function_exists('santino_img') ? santino_img( 'beans-ethiopia-yirgacheffe.jpg' ) : '' );
                        $is_gold = ( ! empty( $item['badge_style'] ) && $item['badge_style'] === 'gold' );
                    ?>
                        <div class="col-lg-4 col-md-6 bean-card-col reveal" data-delay="<?php echo esc_attr( $delay ); ?>" data-category="<?php echo esc_attr( $cat ); ?>">
                            <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between hover-lift">
                                <div>
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <?php if ( $is_gold ) : ?>
                                            <span class="badge bg-gold text-dark fw-bold" style="background-color: var(--santino-gold);"><?php echo esc_html( $item['badge_text'] ); ?></span>
                                        <?php else : ?>
                                            <span class="badge text-white fw-bold" style="background-color: var(--santino-teal);"><?php echo esc_html( $item['badge_text'] ); ?></span>
                                        <?php endif; ?>
                                        <span class="text-muted small fw-bold"><?php echo esc_html( $item['country'] ); ?></span>
                                    </div>
                                    <div class="text-center my-3 hover-img-zoom">
                                        <img src="<?php echo $img; ?>" alt="<?php echo esc_attr( $item['bean_name'] ); ?>" class="img-fluid" style="max-height: 190px; object-fit: cover; border-radius: 12px;">
                                    </div>
                                    <h4 class="font-heading fw-bold mb-1"><?php echo esc_html( $item['bean_name'] ); ?></h4>
                                    <p class="text-muted small mb-3"><?php echo esc_html( $item['description'] ); ?></p>
                                    
                                    <div class="bean-flavor-chips d-flex flex-wrap gap-2 mb-3">
                                        <?php if ( ! empty( $item['tag1'] ) ) : ?><span class="badge bg-light text-dark border"><?php echo esc_html( $item['tag1'] ); ?></span><?php endif; ?>
                                        <?php if ( ! empty( $item['tag2'] ) ) : ?><span class="badge bg-light text-dark border"><?php echo esc_html( $item['tag2'] ); ?></span><?php endif; ?>
                                        <?php if ( ! empty( $item['tag3'] ) ) : ?><span class="badge bg-light text-dark border"><?php echo esc_html( $item['tag3'] ); ?></span><?php endif; ?>
                                    </div>
                                </div>

                                <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="fw-bold fs-5 text-dark"><?php echo esc_html( $item['price'] ); ?></span>
                                        <span class="text-muted small"><?php echo esc_html( $item['price_unit'] ); ?></span>
                                    </div>
                                    <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal">
                                        <?php echo esc_html( $item['btn_text'] ); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <script>
        function santinoFilterBeans(cat, btn) {
            var btns = document.querySelectorAll('#roastCatalog .branch-filter-btn');
            btns.forEach(function(b) { b.classList.remove('active'); });
            if (btn) btn.classList.add('active');
            var cards = document.querySelectorAll('#santinoBeansContainer .bean-card-col');
            cards.forEach(function(c) {
                if (cat === 'all' || c.getAttribute('data-category') === cat) {
                    c.style.display = '';
                } else {
                    c.style.display = 'none';
                }
            });
        }
        if (typeof filterBeans === 'undefined') {
            window.filterBeans = santinoFilterBeans;
        }
        </script>
        <?php
    }
}
