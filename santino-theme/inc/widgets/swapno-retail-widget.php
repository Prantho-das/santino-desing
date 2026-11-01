<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Swapno_Retail_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_swapno_retail';
    }

    public function get_title() {
        return esc_html__( 'Santino Shwapno Retail Showcase', 'santino' );
    }

    public function get_icon() {
        return 'eicon-store';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Retail Packs Catalog', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Section Pill Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'RETAIL PACK COLLECTION',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Santino Coffee On Shwapno Shelves',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Available in Whole Bean & Fresh Pre-Ground Variants across 100+ superstore branches.',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_locator',
            array(
                'label' => esc_html__( 'Superstore Locator', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'locator_badge',
            array(
                'label'   => esc_html__( 'Locator Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SUPERSTORE LOCATOR',
            )
        );

        $this->add_control(
            'locator_title',
            array(
                'label'   => esc_html__( 'Locator Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Find Santino Shelves At 100+ Shwapno Outlets',
            )
        );

        $this->add_control(
            'locator_desc',
            array(
                'label'   => esc_html__( 'Locator Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Search by area, road, or filter by division to find your nearest fresh coffee stock.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="retail-packs" class="py-5 bg-white">
            <div class="container py-lg-3">
                <div class="text-center max-w-700 mx-auto mb-4">
                    <?php if ( ! empty( $settings['badge'] ) ) : ?>
                        <div class="sec-pill-badge-wrap mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-bag-check-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="sec-title mb-2"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; max-width: 580px; line-height: 1.5; margin: 0 auto;"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                    <?php endif; ?>
                </div>

                <div class="row g-3">
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-3 text-center hover-lift" style="border: 1.5px solid #e1ebe7 !important;">
                            <div class="p-2 bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 160px;">
                                <img src="<?php echo santino_img('bd-barista-latte-art.jpg'); ?>" alt="Signature Espresso Blend" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
                            </div>
                            <span class="badge-theme-teal mx-auto mb-2">Best Seller</span>
                            <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Signature Espresso Blend</h6>
                            <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.35;">Dark Chocolate & Roasted Almond Notes</p>
                            <div class="small text-secondary mb-2" style="font-size: 0.82rem;"><i class="bi bi-bag-check me-1 text-teal"></i> Available: 250g | 500g</div>
                            <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 650 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 250g</span></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-3 text-center hover-lift" style="border: 1.5px solid #e1ebe7 !important;">
                            <div class="p-2 bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 160px;">
                                <img src="<?php echo santino_img('bangladesh_corporate_expansion.jpg'); ?>" alt="Colombia Supremo" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
                            </div>
                            <span class="badge-theme-gold mx-auto mb-2">100% Arabica Single Origin</span>
                            <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Colombia Supremo</h6>
                            <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.35;">Caramel, Brown Sugar & Citrus Acidity</p>
                            <div class="small text-secondary mb-2" style="font-size: 0.82rem;"><i class="bi bi-bag-check me-1 text-teal"></i> Available: 250g | 500g</div>
                            <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 850 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 250g</span></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-3 text-center hover-lift" style="border: 1.5px solid #e1ebe7 !important;">
                            <div class="p-2 bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 160px;">
                                <img src="<?php echo santino_img('bd-office-coffee.jpg'); ?>" alt="Mocha Italia Roast" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
                            </div>
                            <span class="badge-theme-maroon mx-auto mb-2">Velvety & Full-Bodied</span>
                            <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Mocha Italia Roast</h6>
                            <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.35;">Hazelnut, Molasses & Cocoa Crema</p>
                            <div class="small text-secondary mb-2" style="font-size: 0.82rem;"><i class="bi bi-bag-check me-1 text-teal"></i> Available: 250g | 500g | 1kg</div>
                            <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 720 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 250g</span></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden p-3 text-center hover-lift" style="border: 1.5px solid #e1ebe7 !important;">
                            <div class="p-2 bg-light rounded-3 mb-2 d-flex align-items-center justify-content-center" style="height: 160px;">
                                <img src="<?php echo santino_img('traditional-coffee-9kg_1.jpg'); ?>" alt="Barista Gold Edition" class="img-fluid rounded-3" style="max-height: 140px; object-fit: cover;">
                            </div>
                            <span class="badge-theme-gold mx-auto mb-2">Limited Batch</span>
                            <h6 class="fw-bold mb-1 font-heading" style="font-size: 0.98rem;">Barista Gold Edition</h6>
                            <p class="small text-muted mb-2" style="font-size: 0.82rem; line-height: 1.35;">Ethiopian Yirgacheffe & Java Floral Notes</p>
                            <div class="small text-secondary mb-2" style="font-size: 0.82rem;"><i class="bi bi-bag-check me-1 text-teal"></i> Available: 250g</div>
                            <div class="mt-auto fw-bold text-dark font-heading" style="font-size: 1.1rem;">৳ 950 <span class="small text-muted fw-normal" style="font-size: 11px;">/ 250g</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="store-locator" class="py-5" style="background-color: #f8faf9;">
            <div class="container py-lg-3">
                <div class="text-center max-w-700 mx-auto mb-3">
                    <?php if ( ! empty( $settings['locator_badge'] ) ) : ?>
                        <div class="sec-pill-badge-wrap mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill me-1"></i> <?php echo esc_html( $settings['locator_badge'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="sec-title mb-2"><?php echo esc_html( $settings['locator_title'] ); ?></h2>
                    <?php if ( ! empty( $settings['locator_desc'] ) ) : ?>
                        <p class="text-muted mb-0" style="font-size: 0.95rem; max-width: 580px; line-height: 1.5; margin: 0 auto;"><?php echo esc_html( $settings['locator_desc'] ); ?></p>
                    <?php endif; ?>
                </div>

                <div class="row justify-content-center mb-3">
                    <div class="col-lg-8">
                        <div class="portal-lookup-group" style="max-width: 600px; margin: 0 auto;">
                            <div class="portal-lookup-field">
                                <i class="bi bi-search text-teal"></i>
                                <input type="text" id="shwapnoSearchInput" placeholder="Search branch (e.g. Gulshan, Banani, Dhanmondi, Uttara)..." onkeyup="santinoFilterShwapnoOutlets()">
                            </div>
                            <button class="btn-lookup-action" type="button" onclick="santinoFilterShwapnoOutlets()">
                                <span>Search</span> <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
                    <button class="branch-filter-btn active" onclick="santinoFilterShwapnoZone('all', this)">All Superstores (12)</button>
                    <button class="branch-filter-btn" onclick="santinoFilterShwapnoZone('dhaka-north', this)">Dhaka North (Gulshan, Banani, Uttara)</button>
                    <button class="branch-filter-btn" onclick="santinoFilterShwapnoZone('dhaka-south', this)">Dhaka South (Dhanmondi, Mogbazar)</button>
                    <button class="branch-filter-btn" onclick="santinoFilterShwapnoZone('chattogram', this)">Chattogram</button>
                    <button class="branch-filter-btn" onclick="santinoFilterShwapnoZone('sylhet', this)">Sylhet &amp; Other</button>
                </div>

                <div class="row g-3" id="shwapnoOutletGrid">
                    <?php
                    $branches = array(
                        array( 'name' => 'Shwapno Flagship Gulshan 1', 'zone' => 'dhaka-north gulshan', 'tag' => 'DHAKA NORTH', 'grinder' => true, 'address' => 'South Avenue, Gulshan 1 Circle, Dhaka 1212', 'hours' => 'Open Daily: 8:00 AM – 11:00 PM', 'phone' => '+880 1700-000001' ),
                        array( 'name' => 'Shwapno Premium Banani 11', 'zone' => 'dhaka-north banani', 'tag' => 'DHAKA NORTH', 'grinder' => true, 'address' => 'House 42, Road 11, Block D, Banani, Dhaka', 'hours' => 'Open Daily: 8:30 AM – 11:00 PM', 'phone' => '+880 1700-000002' ),
                        array( 'name' => 'Shwapno Dhanmondi 27 Flagship', 'zone' => 'dhaka-south dhanmondi', 'tag' => 'DHAKA SOUTH', 'grinder' => true, 'address' => 'Old 27, Rangs Fortune Square, Dhanmondi, Dhaka', 'hours' => 'Open Daily: 8:00 AM – 11:00 PM', 'phone' => '+880 1700-000003' ),
                        array( 'name' => 'Shwapno Uttara Sector 3 Flagship', 'zone' => 'dhaka-north uttara', 'tag' => 'DHAKA NORTH', 'grinder' => true, 'address' => 'Rabindra Sarani, Sector 3, Uttara, Dhaka', 'hours' => 'Open Daily: 8:00 AM – 11:00 PM', 'phone' => '+880 1700-000004' ),
                        array( 'name' => 'Shwapno Bashundhara R/A Gate 1', 'zone' => 'dhaka-north bashundhara', 'tag' => 'DHAKA NORTH', 'grinder' => true, 'address' => 'Main Gate Entrance, Bashundhara R/A, Dhaka', 'hours' => 'Open Daily: 8:30 AM – 11:30 PM', 'phone' => '+880 1700-000005' ),
                        array( 'name' => 'Shwapno Dhanmondi 9/A', 'zone' => 'dhaka-south dhanmondi', 'tag' => 'DHAKA SOUTH', 'grinder' => false, 'address' => 'Road 9/A, Satmasjid Road, Dhanmondi, Dhaka', 'hours' => 'Open Daily: 9:00 AM – 11:00 PM', 'phone' => '+880 1700-000006' ),
                        array( 'name' => 'Shwapno Mogbazar Wireless', 'zone' => 'dhaka-south mogbazar', 'tag' => 'DHAKA SOUTH', 'grinder' => false, 'address' => 'Wireless Railgate, Outer Circular Road, Mogbazar', 'hours' => 'Open Daily: 8:30 AM – 11:00 PM', 'phone' => '+880 1700-000007' ),
                        array( 'name' => 'Shwapno Mirpur 10 Circle', 'zone' => 'dhaka-north mirpur', 'tag' => 'DHAKA NORTH', 'grinder' => false, 'address' => 'Roundabout Commercial Center, Mirpur 10, Dhaka', 'hours' => 'Open Daily: 8:00 AM – 11:00 PM', 'phone' => '+880 1700-000008' ),
                        array( 'name' => 'Shwapno GEC Circle Chattogram', 'zone' => 'chattogram gec', 'tag' => 'CHATTOGRAM', 'grinder' => true, 'address' => 'GEC More, CDA Avenue, Chattogram', 'hours' => 'Open Daily: 8:30 AM – 11:00 PM', 'phone' => '+880 1700-000009' ),
                        array( 'name' => 'Shwapno Agrabad Commercial', 'zone' => 'chattogram agrabad', 'tag' => 'CHATTOGRAM', 'grinder' => false, 'address' => 'Agrabad Commercial Area, Chattogram', 'hours' => 'Open Daily: 9:00 AM – 10:30 PM', 'phone' => '+880 1700-000010' ),
                        array( 'name' => 'Shwapno Kumarpara Sylhet', 'zone' => 'sylhet', 'tag' => 'SYLHET', 'grinder' => true, 'address' => 'Kumarpara Point, Sylhet City', 'hours' => 'Open Daily: 9:00 AM – 11:00 PM', 'phone' => '+880 1700-000011' ),
                        array( 'name' => 'Shwapno Cox’s Bazar Kolatoli', 'zone' => 'sylhet other', 'tag' => 'COXS BAZAR', 'grinder' => false, 'address' => 'Hotel Motel Zone, Kolatoli Road, Cox’s Bazar', 'hours' => 'Open Daily: 8:00 AM – 11:30 PM', 'phone' => '+880 1700-000012' ),
                    );

                    foreach ( $branches as $b ) : ?>
                        <div class="col-md-6 col-lg-4 outlet-item" data-zone="<?php echo esc_attr( $b['zone'] ); ?>">
                            <div class="branch-card-pro">
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-1 border-bottom">
                                    <span class="badge-theme-maroon" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-geo-alt-fill me-1"></i> <?php echo esc_html( $b['tag'] ); ?></span>
                                    <?php if ( $b['grinder'] ) : ?>
                                        <span class="badge-theme-teal" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-check-circle-fill me-1"></i> Grinder</span>
                                    <?php else : ?>
                                        <span class="badge-theme-gold" style="font-size: 9.5px; padding: 3px 8px;"><i class="bi bi-bag-check me-1"></i> Pre-Ground</span>
                                    <?php endif; ?>
                                </div>
                                <h4 class="branch-title fw-bold text-dark mb-1" style="font-size: 1.02rem;"><?php echo esc_html( $b['name'] ); ?></h4>
                                <div class="branch-info-list mb-2">
                                    <div class="info-line small text-muted mb-1" style="font-size: 0.86rem; line-height: 1.35;"><i class="bi bi-geo-alt text-teal me-1"></i> <span><?php echo esc_html( $b['address'] ); ?></span></div>
                                    <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-clock text-teal me-1"></i> <span><?php echo esc_html( $b['hours'] ); ?></span></div>
                                    <div class="info-line small text-muted mb-1" style="font-size: 0.82rem;"><i class="bi bi-telephone text-teal me-1"></i> <span>Hotline: <?php echo esc_html( $b['phone'] ); ?></span></div>
                                </div>
                                <a href="https://maps.google.com/?q=<?php echo urlencode( $b['name'] ); ?>" target="_blank" class="btn-branch-action w-100"><i class="bi bi-map-fill me-1"></i> Map Directions</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <script>
        function santinoFilterShwapnoZone(zone, btn) {
            var btns = document.querySelectorAll('#store-locator .branch-filter-btn');
            btns.forEach(function(b) { b.classList.remove('active'); });
            if (btn) btn.classList.add('active');
            var items = document.querySelectorAll('#shwapnoOutletGrid .outlet-item');
            items.forEach(function(it) {
                if (zone === 'all' || (it.getAttribute('data-zone') && it.getAttribute('data-zone').indexOf(zone) !== -1)) {
                    it.style.display = '';
                } else {
                    it.style.display = 'none';
                }
            });
        }
        function santinoFilterShwapnoOutlets() {
            var input = document.getElementById('shwapnoSearchInput');
            var filter = input ? input.value.toLowerCase().trim() : '';
            var items = document.querySelectorAll('#shwapnoOutletGrid .outlet-item');
            items.forEach(function(it) {
                var text = it.innerText.toLowerCase();
                if (!filter || text.indexOf(filter) !== -1) {
                    it.style.display = '';
                } else {
                    it.style.display = 'none';
                }
            });
        }
        if (typeof filterShwapnoZone === 'undefined') {
            window.filterShwapnoZone = santinoFilterShwapnoZone;
        }
        if (typeof filterShwapnoOutlets === 'undefined') {
            window.filterShwapnoOutlets = santinoFilterShwapnoOutlets;
        }
        </script>
        <?php
    }
}
