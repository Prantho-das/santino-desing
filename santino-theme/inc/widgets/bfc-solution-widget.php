<?php
/**
 * Elementor BFC Solution Widget - Full 7-Section Architecture
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_BFC_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_bfc_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino BFC Foodservice Solution (Full 7 Sections)', 'santino' );
    }

    public function get_icon() {
        return 'eicon-shop';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        // Section 1: Hero Controls
        $this->start_controls_section(
            'section_hero',
            array(
                'label' => esc_html__( '1. Hero Banner', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'hero_pill',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'OFFICIAL FOODSERVICE PARTNER',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BFC × Santino Espresso Bar',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Specialty Italian espresso & handcrafted beverages served fresh across 50+ BFC outlets.',
            )
        );

        $this->end_controls_section();

        // Section 2: Stats Strip Controls
        $this->start_controls_section(
            'section_stats',
            array(
                'label' => esc_html__( '2. Key Impact Stats', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'stat1_num',
            array(
                'label'   => esc_html__( 'Stat 1 Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '50+',
            )
        );
        $this->add_control(
            'stat1_lbl',
            array(
                'label'   => esc_html__( 'Stat 1 Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'BFC Outlets Powered',
            )
        );

        $this->add_control(
            'stat2_num',
            array(
                'label'   => esc_html__( 'Stat 2 Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '1.5M+',
            )
        );
        $this->add_control(
            'stat2_lbl',
            array(
                'label'   => esc_html__( 'Stat 2 Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Cups Served Annually',
            )
        );

        $this->add_control(
            'stat3_num',
            array(
                'label'   => esc_html__( 'Stat 3 Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '< 45s',
            )
        );
        $this->add_control(
            'stat3_lbl',
            array(
                'label'   => esc_html__( 'Stat 3 Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Serving Speed',
            )
        );

        $this->add_control(
            'stat4_num',
            array(
                'label'   => esc_html__( 'Stat 4 Value', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '24/7',
            )
        );
        $this->add_control(
            'stat4_lbl',
            array(
                'label'   => esc_html__( 'Stat 4 Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Certified Barista SLA',
            )
        );

        $this->end_controls_section();

        // Section 7: CTA Controls
        $this->start_controls_section(
            'section_cta',
            array(
                'label' => esc_html__( '7. Franchise CTA Banner', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'cta_title',
            array(
                'label'   => esc_html__( 'CTA Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Want Santino Espresso Station In Your Restaurant Chain?',
            )
        );

        $this->add_control(
            'cta_desc',
            array(
                'label'   => esc_html__( 'CTA Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'From turnkey Italian machinery leasing to custom bean roasts and nationwide barista crew training — we make high-volume foodservice coffee effortless and lucrative.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        $theme_uri = get_template_directory_uri();
        ?>

        <!-- 1. MINIMAL CLEAN BFC HERO BANNER -->
        <section class="pro-banner-hero pro-banner-bfc" style="background-image: url('<?php echo esc_url( $theme_uri . '/assets/images/bfc_santino_foodservice.jpg' ); ?>'); background-position: center 30%; min-height: 52vh;">
            <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.18) 0%, rgba(11, 21, 20, 0.45) 100%);"></div>
            <div class="pro-banner-glow-line"></div>
            
            <div class="container pro-banner-container" style="max-width: 680px;">
                <div class="pro-banner-pill mb-3">
                    <span class="pro-pulse-dot"></span>
                    <span><?php echo esc_html( $s['hero_pill'] ); ?></span>
                </div>

                <h1 class="pro-banner-title mb-2">
                    <?php echo esc_html( $s['hero_title'] ); ?>
                </h1>

                <p class="pro-banner-desc mb-4" style="max-width: 520px; font-size: 1.05rem;">
                    <?php echo esc_html( $s['hero_desc'] ); ?>
                </p>

                <div class="pro-banner-actions">
                    <a href="#outlets" class="btn-hero-lifestyle">
                        <i class="bi bi-geo-alt-fill me-1"></i>
                        <span>Find Nearest BFC</span>
                    </a>
                    <a href="#bfc-gallery" class="btn-hero-outline">
                        <i class="bi bi-images me-1 text-gold"></i>
                        <span>View Gallery</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- 2. SUBTLE STATS STRIP BELOW HERO -->
        <section class="py-4 border-bottom bg-white">
            <div class="container">
                <div class="row g-4 text-center justify-content-center">
                    <div class="col-6 col-md-3">
                        <div class="fs-2 fw-black text-danger font-heading" style="color: #d90429 !important;"><?php echo esc_html( $s['stat1_num'] ); ?></div>
                        <div class="small text-muted fw-bold text-uppercase"><?php echo esc_html( $s['stat1_lbl'] ); ?></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fs-2 fw-black text-dark font-heading"><?php echo esc_html( $s['stat2_num'] ); ?></div>
                        <div class="small text-muted fw-bold text-uppercase"><?php echo esc_html( $s['stat2_lbl'] ); ?></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fs-2 fw-black text-dark font-heading"><?php echo esc_html( $s['stat3_num'] ); ?></div>
                        <div class="small text-muted fw-bold text-uppercase"><?php echo esc_html( $s['stat3_lbl'] ); ?></div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fs-2 fw-black text-success font-heading"><?php echo esc_html( $s['stat4_num'] ); ?></div>
                        <div class="small text-muted fw-bold text-uppercase"><?php echo esc_html( $s['stat4_lbl'] ); ?></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. RICH EDITORIAL PHOTOGRAPHY SHOWCASE -->
        <section id="bfc-gallery" class="py-5" style="background-color: #08100f; color: #ffffff;">
            <div class="container py-lg-4">
                <div class="text-center max-w-700 mx-auto mb-5">
                    <span class="editorial-gallery-badge justify-content-center mb-2"><i class="bi bi-camera-fill me-1"></i> VISUAL EXPERIENCE</span>
                    <h2 class="display-6 fw-bold text-white font-heading">Inside The BFC × Santino Craft</h2>
                    <p class="text-white-50 small">Live commercial espresso stations, artisan roasted beans, and certified barista workflows across 50+ branches.</p>
                </div>

                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="editorial-gallery-item" style="min-height: 380px;">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/bfc_santino_foodservice.jpg' ); ?>" alt="Commercial Espresso Station" class="editorial-gallery-img">
                            <div class="editorial-gallery-overlay">
                                <span class="editorial-gallery-badge"><i class="bi bi-cup-hot-fill"></i> Live Counter Setup</span>
                                <h3 class="editorial-gallery-title">Commercial 9-Bar Espresso Station</h3>
                                <p class="editorial-gallery-desc">High-pressure Italian steam boilers ensuring thick golden crema on every single shot served across all BFC outlets.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="editorial-gallery-item" style="min-height: 380px;">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/imgi_20_santino_-_250522-07574.jpg' ); ?>" alt="Barista Latte Pour" class="editorial-gallery-img">
                            <div class="editorial-gallery-overlay">
                                <span class="editorial-gallery-badge" style="color: #64dfdf;"><i class="bi bi-droplet-fill"></i> Microfoam Steam</span>
                                <h3 class="editorial-gallery-title">Velvety Textured Milk</h3>
                                <p class="editorial-gallery-desc">Micro-textured milk heated to the exact 65°C sweet spot for silk-smooth cappuccinos and lattes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="editorial-gallery-item" style="min-height: 280px;">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/bd-barista-latte-art.jpg' ); ?>" alt="Master Drum Roastery" class="editorial-gallery-img">
                            <div class="editorial-gallery-overlay">
                                <span class="editorial-gallery-badge" style="color: #ffd166;"><i class="bi bi-fire"></i> Custom Roasts</span>
                                <h3 class="editorial-gallery-title">BFC Signature Blend</h3>
                                <p class="editorial-gallery-desc">Medium-dark roasted weekly in micro-batches with rich dark cocoa & hazelnut notes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="editorial-gallery-item" style="min-height: 280px;">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/imgi_24_santino_-_250522-07240.jpg' ); ?>" alt="Barista Training" class="editorial-gallery-img">
                            <div class="editorial-gallery-overlay">
                                <span class="editorial-gallery-badge" style="color: #06d6a0;"><i class="bi bi-award-fill"></i> Barista Academy</span>
                                <h3 class="editorial-gallery-title">Certified Staff Calibration</h3>
                                <p class="editorial-gallery-desc">Regular WBC-standard training and audits to guarantee taste consistency at all 50+ branches.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <div class="editorial-gallery-item" style="min-height: 280px;">
                            <img src="<?php echo esc_url( $theme_uri . '/assets/images/imgi_25_santino_-_250522-07618.jpg' ); ?>" alt="Fast Service Velocity" class="editorial-gallery-img">
                            <div class="editorial-gallery-overlay">
                                <span class="editorial-gallery-badge" style="color: #ffb703;"><i class="bi bi-lightning-charge-fill"></i> Peak Velocity</span>
                                <h3 class="editorial-gallery-title">Under 45s Serving Speed</h3>
                                <p class="editorial-gallery-desc">Engineered workflow designed for rush hours without compromising beverage extraction quality.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. PARTNERSHIP SYNERGY -->
        <section class="py-5" style="background-color: #f8faf9;">
            <div class="container py-lg-4">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="pe-lg-4">
                            <span class="text-uppercase fw-bold text-success small" style="color: var(--santino-teal) !important; letter-spacing: 2px;">Partnership Synergy</span>
                            <h2 class="display-6 fw-bold mt-2 mb-4" style="color: #1a2b29;">How Santino Powers The BFC Coffee Experience</h2>
                            <p class="text-secondary leading-relaxed">
                                Every BFC quick-service counter is equipped with professional Santino commercial bean-to-cup espresso equipment and our custom-roasted barista blend beans. Designed to serve restaurant diners fast, consistent, and barista-level specialty coffee.
                            </p>
                            
                            <div class="d-flex flex-column gap-3 mt-4">
                                <div class="d-flex align-items-start gap-3 p-3 bg-white rounded-3 shadow-sm border border-light">
                                    <div class="p-2 rounded-circle text-white d-flex align-items-center justify-content-center" style="background-color: var(--santino-teal); width: 44px; height: 44px; flex-shrink: 0;">
                                        <i class="bi bi-cup-hot fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Authentic 9-Bar Extraction</h6>
                                        <p class="small text-muted mb-0">High-pressure Italian steam boilers ensuring thick golden crema on every single shot.</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3 p-3 bg-white rounded-3 shadow-sm border border-light">
                                    <div class="p-2 rounded-circle text-white d-flex align-items-center justify-content-center" style="background-color: var(--santino-gold); width: 44px; height: 44px; flex-shrink: 0;">
                                        <i class="bi bi-lightning-charge fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Under 45s Serving Velocity</h6>
                                        <p class="small text-muted mb-0">Engineered for rush hour restaurant volumes without dropping cup quality.</p>
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3 p-3 bg-white rounded-3 shadow-sm border border-light">
                                    <div class="p-2 rounded-circle text-white d-flex align-items-center justify-content-center" style="background-color: #1a2b29; width: 44px; height: 44px; flex-shrink: 0;">
                                        <i class="bi bi-award fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Certified Barista Staff Training</h6>
                                        <p class="small text-muted mb-0">Regular calibration and milk texturing training conducted by Santino Coffee Academy.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6">
                                <img src="<?php echo esc_url( $theme_uri . '/assets/images/bd-barista-latte-art.jpg' ); ?>" alt="Commercial Espresso Roastery" class="img-fluid rounded-4 shadow-sm w-100" style="height: 240px; object-fit: cover;">
                            </div>
                            <div class="col-6">
                                <img src="<?php echo esc_url( $theme_uri . '/assets/images/imgi_141_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg' ); ?>" alt="Italian Machine Technology" class="img-fluid rounded-4 shadow-sm w-100" style="height: 240px; object-fit: cover;">
                            </div>
                            <div class="col-12">
                                <div class="p-4 rounded-4 text-white shadow-sm" style="background: linear-gradient(135deg, var(--santino-teal) 0%, #003633 100%);">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="fw-bold mb-1 text-white">BFC Signature Blend Beans</h5>
                                            <p class="small text-light opacity-75 mb-0">80% Arabica + 20% Robusta custom medium-dark roast profile.</p>
                                        </div>
                                        <i class="bi bi-bag-check-fill fs-1 text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. SANTINO COFFEE LINEUP AT BFC -->
        <section id="bfc-menu" class="py-5 bg-white">
            <div class="container py-lg-4">
                <div class="text-center max-w-700 mx-auto mb-5">
                    <span class="text-uppercase fw-bold small" style="color: var(--santino-teal); letter-spacing: 2px;">Served Hot & Iced</span>
                    <h2 class="display-6 fw-bold mt-2" style="color: #1a2b29;">Santino Coffee Lineup at BFC</h2>
                    <p class="text-muted">Available at all BFC counters across Dhaka, Chattogram, Sylhet, and major cities.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-4 hover-lift">
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(0,98,93,0.08); color: var(--santino-teal);">
                                <i class="bi bi-cup-hot fs-1"></i>
                            </div>
                            <span class="badge bg-danger rounded-pill mx-auto mb-2 px-3 py-1">All Time Favorite</span>
                            <h5 class="fw-bold mb-1">Classic Cappuccino</h5>
                            <p class="small text-muted mb-3">Rich single origin espresso topped with thick velvety steamed microfoam milk.</p>
                            <div class="mt-auto fw-bold fs-5 text-dark">৳ 180 <span class="small text-muted fw-normal">/ Regular</span></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-4 hover-lift">
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(195,153,108,0.15); color: var(--santino-gold);">
                                <i class="bi bi-snow2 fs-1"></i>
                            </div>
                            <span class="badge bg-warning text-dark rounded-pill mx-auto mb-2 px-3 py-1">Cold Refreshment</span>
                            <h5 class="fw-bold mb-1">Iced Caramel Latte</h5>
                            <p class="small text-muted mb-3">Freshly pulled espresso layered over cold milk, ice cubes, and gourmet caramel drizzle.</p>
                            <div class="mt-auto fw-bold fs-5 text-dark">৳ 220 <span class="small text-muted fw-normal">/ 16oz</span></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-4 hover-lift">
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(0,98,93,0.08); color: var(--santino-teal);">
                                <i class="bi bi-fire fs-1"></i>
                            </div>
                            <span class="badge bg-dark rounded-pill mx-auto mb-2 px-3 py-1">Pure Caffeine</span>
                            <h5 class="fw-bold mb-1">Americano / Long Black</h5>
                            <p class="small text-muted mb-3">Double ristretto shot diluted with purified hot water for crisp dark notes.</p>
                            <div class="mt-auto fw-bold fs-5 text-dark">৳ 150 <span class="small text-muted fw-normal">/ Regular</span></div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden text-center p-4 hover-lift">
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(195,153,108,0.15); color: var(--santino-gold);">
                                <i class="bi bi-cup-straw fs-1"></i>
                            </div>
                            <span class="badge bg-success rounded-pill mx-auto mb-2 px-3 py-1">Signature Dessert</span>
                            <h5 class="fw-bold mb-1">Hazelnut Mocha Frappe</h5>
                            <p class="small text-muted mb-3">Blended ice roast espresso, pure cocoa, roasted hazelnut notes, and whipped cream.</p>
                            <div class="mt-auto fw-bold fs-5 text-dark">৳ 250 <span class="small text-muted fw-normal">/ 16oz</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. COMPREHENSIVE OUTLETS LOCATOR (12+ DETAILED BRANCHES) -->
        <section id="outlets" class="py-5" style="background-color: #f1f5f4;">
            <div class="container py-lg-4">
                <div class="row align-items-center mb-4">
                    <div class="col-md-7">
                        <span class="text-uppercase fw-bold small" style="color: var(--santino-teal); letter-spacing: 2px;">Nationwide Presence</span>
                        <h2 class="display-6 fw-bold mt-1 mb-0 font-heading" style="color: #1a2b29;">Find Santino Coffee at Your Nearest BFC</h2>
                        <p class="text-muted small mt-1 mb-0">Serving fresh Italian espresso at 50+ branches across Bangladesh.</p>
                    </div>
                    <div class="col-md-5 text-md-end mt-3 mt-md-0">
                        <div class="input-group shadow-sm">
                            <input type="text" id="bfcSearchInput" class="form-control rounded-pill-start border-0 px-3" placeholder="Search branch (e.g. Dhanmondi, Gulshan, Sylhet)..." onkeyup="filterBfcOutlets()">
                            <button class="btn btn-dark rounded-pill-end px-3" type="button" onclick="filterBfcOutlets()"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    <button class="branch-filter-btn active" onclick="filterBfcByTag('all', this)">All Outlets (12)</button>
                    <button class="branch-filter-btn" onclick="filterBfcByTag('dhaka-north', this)">Dhaka North (Gulshan, Banani, Uttara)</button>
                    <button class="branch-filter-btn" onclick="filterBfcByTag('dhaka-south', this)">Dhaka South (Dhanmondi, Bailey Rd, Khilgaon)</button>
                    <button class="branch-filter-btn" onclick="filterBfcByTag('chattogram', this)">Chattogram (GEC, Agrabad)</button>
                    <button class="branch-filter-btn" onclick="filterBfcByTag('sylhet', this)">Sylhet & Others</button>
                </div>

                <div class="row g-3" id="bfcOutletGrid">
                    <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-south dhanmondi">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100 border border-light hover-lift d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0 font-heading text-dark">BFC Dhanmondi 27</h5>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i>Active Bar</span>
                                </div>
                                <p class="small text-muted mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Rangs Fortune Square, Road 27, Dhanmondi, Dhaka</p>
                                <div class="small text-secondary mb-2"><i class="bi bi-clock me-1 text-gold"></i> 10:00 AM – 11:30 PM Daily</div>
                                <div class="small text-muted mb-3"><i class="bi bi-telephone-fill me-1 text-gold"></i> Hotline: +880 1711-000001</div>
                            </div>
                            <a href="https://maps.google.com/?q=BFC+Dhanmondi+27+Dhaka" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north gulshan">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100 border border-light hover-lift d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0 font-heading text-dark">BFC Gulshan 1 Avenue</h5>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i>Active Bar</span>
                                </div>
                                <p class="small text-muted mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Navana Tower, Ground Floor, Gulshan 1, Dhaka</p>
                                <div class="small text-secondary mb-2"><i class="bi bi-clock me-1 text-gold"></i> 10:00 AM – 12:00 AM Daily</div>
                                <div class="small text-muted mb-3"><i class="bi bi-telephone-fill me-1 text-gold"></i> Hotline: +880 1711-000002</div>
                            </div>
                            <a href="https://maps.google.com/?q=BFC+Gulshan+1+Dhaka" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north banani">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100 border border-light hover-lift d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0 font-heading text-dark">BFC Banani 11</h5>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i>Active Bar</span>
                                </div>
                                <p class="small text-muted mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> House 54, Road 11, Block D, Banani, Dhaka</p>
                                <div class="small text-secondary mb-2"><i class="bi bi-clock me-1 text-gold"></i> 11:00 AM – 12:30 AM Daily</div>
                                <div class="small text-muted mb-3"><i class="bi bi-telephone-fill me-1 text-gold"></i> Hotline: +880 1711-000003</div>
                            </div>
                            <a href="https://maps.google.com/?q=BFC+Banani+Road+11+Dhaka" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north uttara">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100 border border-light hover-lift d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0 font-heading text-dark">BFC Uttara Sector 3</h5>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i>Active Bar</span>
                                </div>
                                <p class="small text-muted mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Rabindra Sarani, Sector 3, Uttara, Dhaka</p>
                                <div class="small text-secondary mb-2"><i class="bi bi-clock me-1 text-gold"></i> 10:30 AM – 11:30 PM Daily</div>
                                <div class="small text-muted mb-3"><i class="bi bi-telephone-fill me-1 text-gold"></i> Hotline: +880 1711-000004</div>
                            </div>
                            <a href="https://maps.google.com/?q=BFC+Uttara+Sector+3+Dhaka" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-south bailey">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100 border border-light hover-lift d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0 font-heading text-dark">BFC Bailey Road</h5>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i>Active Bar</span>
                                </div>
                                <p class="small text-muted mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> 12 New Bailey Road, Natak Sarani, Dhaka</p>
                                <div class="small text-secondary mb-2"><i class="bi bi-clock me-1 text-gold"></i> 11:00 AM – 11:00 PM Daily</div>
                                <div class="small text-muted mb-3"><i class="bi bi-telephone-fill me-1 text-gold"></i> Hotline: +880 1711-000005</div>
                            </div>
                            <a href="https://maps.google.com/?q=BFC+Bailey+Road+Dhaka" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 outlet-card" data-zone="dhaka-north mirpur">
                        <div class="bg-white p-4 rounded-4 shadow-sm h-100 border border-light hover-lift d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0 font-heading text-dark">BFC Mirpur 10 Circle</h5>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1"><i class="bi bi-check-circle me-1"></i>Active Bar</span>
                                </div>
                                <p class="small text-muted mb-2"><i class="bi bi-geo-alt-fill text-danger me-1"></i> Near Fire Service, Mirpur 10 Roundabout, Dhaka</p>
                                <div class="small text-secondary mb-2"><i class="bi bi-clock me-1 text-gold"></i> 10:00 AM – 11:00 PM Daily</div>
                                <div class="small text-muted mb-3"><i class="bi bi-telephone-fill me-1 text-gold"></i> Hotline: +880 1711-000006</div>
                            </div>
                            <a href="https://maps.google.com/?q=BFC+Mirpur+10+Dhaka" target="_blank" class="btn btn-outline-dark btn-sm rounded-pill w-100 fw-bold"><i class="bi bi-map me-1"></i> Open in Google Maps</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. ENTERPRISE PARTNERSHIP CTA -->
        <section class="py-5 text-white" style="background: linear-gradient(135deg, #111e1c 0%, #004541 100%);">
            <div class="container py-lg-4 text-center">
                <h2 class="display-6 fw-bold mb-3 text-white"><?php echo esc_html( $s['cta_title'] ); ?></h2>
                <p class="lead text-light-50 mb-4 mx-auto" style="max-width: 650px; color: #d1dedc;">
                    <?php echo esc_html( $s['cta_desc'] ); ?>
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-warning px-4 py-3 fw-bold rounded-pill text-dark shadow" data-bs-toggle="modal" data-bs-target="#enquiryModal" style="background-color: var(--santino-gold); border: none;">
                        <i class="bi bi-briefcase-fill me-2"></i> Partner With Santino Foodservice
                    </button>
                    <a href="tel:+8801613334514" class="btn btn-outline-light px-4 py-3 fw-bold rounded-pill">
                        <i class="bi bi-telephone-outbound-fill me-2"></i> Call Corporate Sales
                    </a>
                </div>
            </div>
        </section>
        <?php
    }
}
