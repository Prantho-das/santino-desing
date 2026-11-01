<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Menu_Solution_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_menu_solution';
    }

    public function get_title() {
        return esc_html__( 'Santino Cafe Menu Solution', 'santino' );
    }

    public function get_icon() {
        return 'eicon-table';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_hero',
            array(
                'label' => esc_html__( 'Header Content', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'hero_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SANTINO SIGNATURE CAFE MENU',
            )
        );

        $this->add_control(
            'hero_title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Artisan Coffee & Beverage Menu',
            )
        );

        $this->add_control(
            'hero_desc',
            array(
                'label'   => esc_html__( 'Hero Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
        .menu-page-wrap, body, p, .text-muted, .text-secondary, label, input, select, textarea {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
        }
        .sec-title,
        .font-heading,
        h1, h2, h3, h4, h5, h6,
        .sec-pill-badge,
        .btn-hero-lifestyle,
        .btn-hero-outline,
        .btn-lookup-action,
        .branch-filter-btn,
        .btn-cat-tab,
        .badge-theme {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          letter-spacing: -0.3px;
        }
        .sec-title {
          font-size: clamp(2rem, 3.5vw, 2.8rem) !important;
          font-weight: 900 !important;
          color: #111111;
          letter-spacing: -0.5px !important;
        }
        .sec-title.text-white,
        .text-white .sec-title {
          color: #ffffff !important;
        }
        .sec-title-accent, .menu-title-highlight {
          color: var(--santino-teal, #00625d) !important;
        }
        .sec-description {
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
          color: #556662;
          font-size: 1rem;
          line-height: 1.6;
        }
        .sec-pill-badge-wrap {
          display: inline-flex;
          align-items: center;
        }
        .sec-pill-badge {
          display: inline-flex;
          align-items: center;
          gap: 6px;
          background: rgba(0, 98, 93, 0.08);
          color: var(--santino-teal, #00625d);
          border: 1px solid rgba(0, 98, 93, 0.22);
          padding: 5px 14px;
          border-radius: 50px;
          font-size: 0.76rem;
          font-weight: 800;
          letter-spacing: 1px;
          text-transform: uppercase;
        }
        .portal-lookup-group {
          display: flex;
          align-items: center;
          background: #f8faf9;
          border: 1.5px solid #d5e5e0;
          border-radius: 50px;
          padding: 6px 8px 6px 18px;
          transition: all 0.3s ease;
          box-shadow: 0 2px 10px rgba(0, 98, 93, 0.04);
          width: 100%;
        }
        .portal-lookup-group:focus-within {
          border-color: var(--santino-teal, #00625d);
          background: #ffffff;
          box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.12), 0 4px 16px rgba(0, 98, 93, 0.08);
        }
        .portal-lookup-field {
          flex: 1;
          display: flex;
          align-items: center;
          gap: 12px;
        }
        .portal-lookup-field i {
          color: var(--santino-teal, #00625d);
          font-size: 1.15rem;
        }
        .portal-lookup-field input {
          width: 100%;
          border: none;
          background: transparent;
          outline: none;
          box-shadow: none;
          font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
          font-size: 0.95rem;
          color: #111111;
          padding: 8px 0;
        }
        .btn-lookup-action {
          background: var(--santino-teal, #00625d);
          border: none;
          color: #ffffff;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          cursor: pointer;
          transition: all 0.2s ease;
          flex-shrink: 0;
        }
        .btn-lookup-action:hover {
          background: #004d49;
          transform: scale(1.05);
        }
        .btn-hero-lifestyle,
        .btn-hero-outline {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
          font-weight: 700 !important;
          font-size: 13px !important;
          letter-spacing: 0.6px !important;
          text-transform: uppercase !important;
          height: 48px !important;
          min-height: 48px !important;
          max-height: 48px !important;
          padding: 0 28px !important;
          box-sizing: border-box !important;
          line-height: 1 !important;
          border-radius: 50px !important;
          display: inline-flex !important;
          align-items: center !important;
          justify-content: center !important;
          gap: 8px !important;
          text-decoration: none !important;
          cursor: pointer !important;
          white-space: nowrap !important;
          vertical-align: middle !important;
          transition: all 0.28s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
        }
        .btn-hero-lifestyle {
          background: var(--santino-teal, #00625d) !important;
          border: 2px solid var(--santino-teal, #00625d) !important;
          color: #ffffff !important;
          box-shadow: 0 6px 18px rgba(0, 98, 93, 0.35) !important;
        }
        .btn-hero-lifestyle:hover {
          background: #004d49 !important;
          border-color: #004d49 !important;
          color: #ffffff !important;
          transform: translateY(-2px) !important;
        }
        .btn-hero-outline {
          background: transparent !important;
          border: 2px solid rgba(255, 255, 255, 0.85) !important;
          color: #ffffff !important;
        }
        .btn-hero-outline:hover {
          background: #ffffff !important;
          color: var(--santino-teal, #00625d) !important;
          border-color: #ffffff !important;
          transform: translateY(-2px) !important;
        }
        .btn-cat-tab {
          border: 1.5px solid #e0ebe8;
          background: #ffffff;
          color: #334441;
          border-radius: 50px;
          padding: 9px 20px;
          font-size: 13.5px;
          font-weight: 700;
          transition: all 0.25s ease;
          display: inline-flex;
          align-items: center;
          gap: 8px;
          cursor: pointer;
        }
        .btn-cat-tab:hover {
          border-color: var(--santino-teal, #00625d);
          color: var(--santino-teal, #00625d);
          background: #f4faf8;
        }
        .btn-cat-tab.active {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          border-color: var(--santino-teal, #00625d);
          box-shadow: 0 4px 14px rgba(0, 98, 93, 0.25);
        }
        .menu-product-card {
          background: #ffffff;
          border: 1px solid #e8f0ed;
          border-radius: 18px;
          overflow: hidden;
          transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
          display: flex;
          flex-direction: column;
          height: 100%;
          cursor: pointer;
        }
        .menu-product-card:hover {
          transform: translateY(-6px);
          border-color: rgba(0, 98, 93, 0.3);
          box-shadow: 0 14px 34px rgba(0, 98, 93, 0.12);
        }
        .menu-card-image-wrap {
          position: relative;
          height: 220px;
          background: #f7f9f8;
          overflow: hidden;
        }
        .menu-card-img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.5s ease;
        }
        .menu-product-card:hover .menu-card-img {
          transform: scale(1.05);
        }
        .menu-badge-pill {
          position: absolute;
          top: 12px;
          left: 12px;
          z-index: 2;
          font-size: 10px;
          font-weight: 800;
          letter-spacing: 0.6px;
          padding: 4px 10px;
          border-radius: 50px;
        }
        .menu-badge-pill.badge-teal {
          background: rgba(0, 98, 93, 0.9);
          color: #ffffff;
        }
        .menu-badge-pill.badge-gold {
          background: rgba(195, 153, 108, 0.95);
          color: #ffffff;
        }
        .menu-card-body {
          padding: 18px;
          display: flex;
          flex-direction: column;
          flex: 1;
        }
        .menu-taste-notes {
          font-size: 11.5px;
          font-weight: 700;
          color: var(--santino-teal, #00625d);
          text-transform: uppercase;
          letter-spacing: 0.5px;
          margin-bottom: 4px;
        }
        .menu-item-name {
          font-size: 1.15rem;
          font-weight: 800;
          color: #111111;
          margin-bottom: 6px;
          line-height: 1.3;
        }
        .menu-item-desc {
          font-size: 0.88rem;
          color: #6c757d;
          line-height: 1.5;
          margin-bottom: 0;
          flex: 1;
        }
        .menu-item-price {
          font-size: 1.25rem;
          font-weight: 900;
          color: #111111;
          font-family: var(--kp-font-title, 'Montserrat', sans-serif);
        }
        .luckin-category-banners-container {
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
          gap: 14px;
          margin-top: 24px;
        }
        .luckin-banner-card {
          border-radius: 14px;
          overflow: hidden;
          box-shadow: 0 4px 14px rgba(0,0,0,0.06);
          display: block;
          transition: transform 0.25s ease;
        }
        .luckin-banner-card:hover {
          transform: translateY(-4px);
        }
        .luckin-banner-card img {
          width: 100%;
          height: auto;
          display: block;
        }
        .menu-category-sticky-bar {
          background: #ffffff;
          border-top: 1px solid #edf2f0;
          border-bottom: 1px solid #edf2f0;
          padding: 14px 0;
          position: sticky;
          top: 70px;
          z-index: 10;
        }
        .category-tabs-wrapper {
          overflow-x: auto;
          white-space: nowrap;
          padding-bottom: 4px;
        }
        .branch-card {
          background: #ffffff;
          border: 1px solid #e8f0ed;
          border-radius: 18px;
          overflow: hidden;
          box-shadow: 0 4px 20px rgba(0,0,0,0.04);
          transition: transform 0.3s ease;
        }
        .branch-card:hover {
          transform: translateY(-4px);
        }
        .branch-card-img {
          height: 200px;
          background-size: cover;
          background-position: center;
          position: relative;
        }
        .branch-tag-badge {
          position: absolute;
          top: 12px;
          left: 12px;
          background: var(--santino-teal, #00625d);
          color: #fff;
          font-size: 10px;
          font-weight: 800;
          padding: 4px 10px;
          border-radius: 50px;
        }
        .branch-card-body {
          padding: 20px;
        }
        .branch-title {
          font-size: 1.15rem;
          font-weight: 800;
          color: #111;
          margin-bottom: 8px;
        }
        .branch-filter-btn {
          font-family: var(--kp-font-title, 'Montserrat', sans-serif);
          font-weight: 600;
          font-size: 13px;
          padding: 8px 20px;
          border-radius: 50px;
          border: 1.5px solid #d5e5e0;
          background: #fff;
          color: #334441;
          cursor: pointer;
        }
        .branch-filter-btn.active, .branch-filter-btn:hover {
          background: var(--santino-teal, #00625d);
          color: #fff;
          border-color: var(--santino-teal, #00625d);
        }
        </style>

        <div class="menu-page-wrap">
          <section class="py-4 bg-white position-relative">
            <div class="container position-relative" style="z-index: 1;">
              <div class="row align-items-center mb-4 g-3">
                <div class="col-lg-6">
                  <div class="sec-pill-badge-wrap mb-2">
                    <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $settings['hero_badge'] ); ?></span>
                  </div>
                  <h1 class="sec-title mb-2"><?php echo esc_html( $settings['hero_title'] ); ?></h1>
                  <p class="sec-description mb-0"><?php echo esc_html( $settings['hero_desc'] ); ?></p>
                </div>
                <div class="col-lg-6">
                  <div class="portal-lookup-group shadow-sm">
                    <div class="portal-lookup-field">
                      <i class="bi bi-search"></i>
                      <input type="text" id="menuSearchInput" placeholder="Search cappuccino, mocha, frappe, latte, croissant...">
                    </div>
                    <button type="button" class="btn-lookup-action" id="menuSearchActionBtn" aria-label="Search">
                      <i class="bi bi-arrow-right"></i>
                    </button>
                  </div>
                </div>
              </div>

              <div class="luckin-category-banners-container">
                <a href="#menuGridSection" class="luckin-banner-card">
                  <img src="<?php echo santino_img('banner-signature-lattes.jpg'); ?>" alt="Signature Lattes">
                </a>
                <a href="#menuGridSection" class="luckin-banner-card">
                  <img src="<?php echo santino_img('banner-barista-coffee.jpg'); ?>" alt="BARISTA COFFEE">
                </a>
                <a href="#menuGridSection" class="luckin-banner-card">
                  <img src="<?php echo santino_img('banner-fruity-americano.jpg'); ?>" alt="FRUITY AMERICANO">
                </a>
                <a href="#menuGridSection" class="luckin-banner-card">
                  <img src="<?php echo santino_img('banner-soe-espresso.jpg'); ?>" alt="Single Origin Espresso">
                </a>
                <a href="#menuGridSection" class="luckin-banner-card">
                  <img src="<?php echo santino_img('banner-matcha-tea.jpg'); ?>" alt="Matcha">
                </a>
              </div>
            </div>
          </section>

          <nav class="menu-category-sticky-bar" id="categoryStickyBar">
            <div class="container">
              <div class="category-tabs-wrapper d-flex align-items-center gap-2">
                <button class="btn-cat-tab active" data-filter="all"><i class="bi bi-grid-fill"></i> All Items</button>
                <button class="btn-cat-tab" data-filter="signature-lattes"><i class="bi bi-cup-hot-fill"></i> Signature Lattes</button>
                <button class="btn-cat-tab" data-filter="barista-coffee"><i class="bi bi-cup-straw"></i> Barista Classics</button>
                <button class="btn-cat-tab" data-filter="fruity-americano"><i class="bi bi-lightning-charge-fill"></i> Fruity Americano</button>
                <button class="btn-cat-tab" data-filter="soe-espresso"><i class="bi bi-award-fill"></i> Single Origin (SOE)</button>
                <button class="btn-cat-tab" data-filter="matcha-tea"><i class="bi bi-flower1"></i> Matcha &amp; Frappe</button>
                <button class="btn-cat-tab" data-filter="bakery"><i class="bi bi-pie-chart-fill"></i> Gourmet Bakery</button>
              </div>
            </div>
          </nav>

          <section class="menu-items-section py-5" id="menuGridSection">
            <div class="container">
              <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div>
                  <div class="sec-pill-badge-wrap mb-1">
                    <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> FRESHLY BREWED</span>
                  </div>
                  <h2 class="sec-title mb-1" id="currentCategoryHeading">All Handcrafted <span class="sec-title-accent">Items</span></h2>
                  <div class="sec-description text-muted small">Showing specialty beverages and gourmet items</div>
                </div>
              </div>

              <div class="row g-4" id="menuItemsGrid">
                <?php
                $drinks = array(
                    array( 'name' => 'Raw Coconut Latte', 'notes' => 'Signature Blend', 'price' => '৳ 380', 'img' => 'menu-raw-coconut-latte.jpg', 'badge' => 'Bestseller' ),
                    array( 'name' => 'Velvet Flat White', 'notes' => 'Double Ristretto', 'price' => '৳ 320', 'img' => 'menu-cappuccino-hot.jpg', 'badge' => 'Classic' ),
                    array( 'name' => 'Orange Expresso Americano', 'notes' => 'Valencia Citrus', 'price' => '৳ 340', 'img' => 'banner-fruity-americano.jpg', 'badge' => 'Craft Brew' ),
                    array( 'name' => 'Yirgacheffe SOE Pour-Over', 'notes' => 'Floral Jasmine', 'price' => '৳ 420', 'img' => 'banner-soe-espresso.jpg', 'badge' => 'Single Origin' ),
                    array( 'name' => 'Ceremonial Matcha Latte', 'notes' => 'Uji Kyoto Grade', 'price' => '৳ 390', 'img' => 'banner-matcha-tea.jpg', 'badge' => 'Specialty' ),
                    array( 'name' => 'Artisan Butter Croissant', 'notes' => 'French Cultured Butter', 'price' => '৳ 220', 'img' => 'menu-signature-croissant.jpg', 'badge' => 'Bakery' ),
                );
                foreach ( $drinks as $item ) :
                ?>
                <div class="col-md-6 col-lg-4">
                  <div class="menu-product-card">
                    <div class="menu-card-image-wrap">
                      <span class="menu-badge-pill badge-teal"><?php echo esc_html( $item['badge'] ); ?></span>
                      <img src="<?php echo santino_img( $item['img'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>" class="menu-card-img">
                    </div>
                    <div class="menu-card-body">
                      <div class="menu-taste-notes"><?php echo esc_html( $item['notes'] ); ?></div>
                      <h4 class="menu-item-name"><?php echo esc_html( $item['name'] ); ?></h4>
                      <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                        <span class="menu-item-price"><?php echo esc_html( $item['price'] ); ?></span>
                        <a href="https://wa.me/8801613334514?text=<?php echo urlencode('I want to order ' . $item['name']); ?>" target="_blank" class="btn-hero-lifestyle" style="height: 38px; min-height: 38px; padding: 0 18px; font-size: 11px;">
                          Order Now
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </section>

          <section class="py-5" style="background: linear-gradient(135deg, #0f2723 0%, #004d49 100%);">
            <div class="container">
              <div class="row align-items-center g-4">
                <div class="col-lg-5 text-center text-lg-start">
                  <div class="sec-pill-badge-wrap mb-3">
                    <span class="sec-pill-badge" style="background: rgba(195, 153, 108, 0.2); color: #dfbe8d; border-color: rgba(195, 153, 108, 0.4);">
                      <i class="bi bi-gem me-1" style="color: #dfbe8d;"></i> SANTINO HERO ITEMS
                    </span>
                  </div>
                  <h2 class="sec-title text-white mb-3">Premium Beans, <span style="color: #dfbe8d;">Hot &amp; Cold Hero Brews</span></h2>
                  <p class="text-white-50 mb-4" style="font-size: 1.05rem; line-height: 1.7;">
                    Explore our barista favorites including Hot Cappuccino, Iced Latte, Rich Hot Mocha, Iced Mocha, and ice-blended Frappes crafted with 100% premium roasted beans.
                  </p>
                  <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                    <a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="btn-hero-lifestyle" style="background: #dfbe8d !important; border-color: #dfbe8d !important; color: #0d2622 !important;">
                      <i class="bi bi-gift-fill me-1"></i> Buy 5 Get 6th Free
                    </a>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="rounded-4 overflow-hidden shadow-lg border border-white-10 text-center" style="max-height: 480px; background: #000;">
                    <img src="<?php echo santino_img('santino-hero-poster.jpg'); ?>" alt="Santino Coffee Hero Menu Poster" class="w-100 h-100 object-fit-contain" style="max-height: 480px;">
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="cafe-branches-section py-5" id="branches" style="background-color: #fff9f3;">
            <div class="container">
              <div class="sec-heading-center text-center mb-5">
                <div class="sec-pill-badge-wrap mb-2">
                  <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill text-danger me-1"></i> EXPERIENCE SANTINO NATIONWIDE</span>
                </div>
                <h2 class="sec-title mb-2">Our Cafes &amp; <span class="sec-title-accent">Roastery Hubs</span></h2>
                <div class="sec-description">Step into an artisan coffee retreat or visit our partner express bars across prime Dhaka locations</div>
              </div>

              <div class="row g-4" id="branchesGrid">
                <div class="col-lg-4 col-md-6">
                  <div class="branch-card">
                    <div class="branch-card-img" style="background-image: url('<?php echo santino_img('banner-signature-lattes.jpg'); ?>');">
                      <span class="branch-tag-badge">FLAGSHIP EXPERIENCE</span>
                    </div>
                    <div class="branch-card-body">
                      <h3 class="branch-title">Santino Experience Hub | Gulshan-2</h3>
                      <p class="text-muted small mb-3">State-of-the-art Victoria Arduino espresso bar, cupping lounge &amp; VIP meeting rooms.</p>
                      <div class="info-line small text-muted mb-2"><i class="bi bi-geo-alt text-teal me-1"></i> Plot 11, Road 48, Gulshan-2, Dhaka 1212</div>
                      <a href="https://maps.google.com" target="_blank" class="btn-hero-lifestyle w-100 mt-3" style="height: 38px; min-height: 38px; font-size: 11px;">
                        <i class="bi bi-map-fill me-1"></i> Map Directions
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-6">
                  <div class="branch-card">
                    <div class="branch-card-img" style="background-image: url('<?php echo santino_img('imgi_26_santino_-_250522-07312.jpg'); ?>');">
                      <span class="branch-tag-badge">COMMERCIAL HUB</span>
                    </div>
                    <div class="branch-card-body">
                      <h3 class="branch-title">Borak Mehnur Tower | Banani</h3>
                      <p class="text-muted small mb-3">Located on Kamal Ataturk Avenue with vibrant outdoor seating and grab-and-go bar.</p>
                      <div class="info-line small text-muted mb-2"><i class="bi bi-geo-alt text-teal me-1"></i> Plot 51/B, Kamal Ataturk Avenue, Banani, Dhaka</div>
                      <a href="https://maps.google.com" target="_blank" class="btn-hero-lifestyle w-100 mt-3" style="height: 38px; min-height: 38px; font-size: 11px;">
                        <i class="bi bi-map-fill me-1"></i> Map Directions
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-6">
                  <div class="branch-card">
                    <div class="branch-card-img" style="background-image: url('<?php echo santino_img('imgi_27_santino_-_250522-07216.jpg'); ?>');">
                      <span class="branch-tag-badge">LIFESTYLE CAFE</span>
                    </div>
                    <div class="branch-card-body">
                      <h3 class="branch-title">Santino Cafe | Dhanmondi 27</h3>
                      <p class="text-muted small mb-3">Quiet study ambiance, artisan pourover coffee station, and fresh bakery pastries.</p>
                      <div class="info-line small text-muted mb-2"><i class="bi bi-geo-alt text-teal me-1"></i> House 14, Road 27 (Old), Dhanmondi, Dhaka 1209</div>
                      <a href="https://maps.google.com" target="_blank" class="btn-hero-lifestyle w-100 mt-3" style="height: 38px; min-height: 38px; font-size: 11px;">
                        <i class="bi bi-map-fill me-1"></i> Map Directions
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <?php
    }
}
