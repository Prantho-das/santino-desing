<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Menu_Grid_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_menu_grid';
    }

    public function get_title() {
        return esc_html__( 'Santino: 2. Menu Tabs & Handcrafted Items Grid', 'santino' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_grid_header',
            array(
                'label' => esc_html__( 'Grid Heading & Filter', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'grid_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'FRESHLY BREWED',
            )
        );

        $this->add_control(
            'grid_title',
            array(
                'label'   => esc_html__( 'Title Main', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'All Handcrafted',
            )
        );

        $this->add_control(
            'grid_title_accent',
            array(
                'label'   => esc_html__( 'Title Accent (Green)', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Items',
            )
        );

        $this->add_control(
            'grid_desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Showing specialty beverages and gourmet items',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $grid_badge  = isset( $settings['grid_badge'] ) && $settings['grid_badge'] !== '' ? $settings['grid_badge'] : 'FRESHLY BREWED';
        $grid_title  = isset( $settings['grid_title'] ) && $settings['grid_title'] !== '' ? $settings['grid_title'] : 'All Handcrafted';
        $grid_accent = isset( $settings['grid_title_accent'] ) && $settings['grid_title_accent'] !== '' ? $settings['grid_title_accent'] : 'Items';
        $grid_desc   = isset( $settings['grid_desc'] ) && $settings['grid_desc'] !== '' ? $settings['grid_desc'] : 'Showing specialty beverages and gourmet items';
        ?>
        <!-- 2. STICKY CATEGORY NAV -->
        <nav class="sticky-category-nav py-3 bg-white" id="categoryNav">
          <div class="container">
            <div class="category-tabs-scroll-wrap d-flex align-items-center gap-2">
              <button class="btn-cat-tab active" data-filter="all">
                <i class="bi bi-grid-fill"></i> All Items
              </button>
              <button class="btn-cat-tab" data-filter="signature-lattes">
                <i class="bi bi-stars"></i> Signature Lattes
              </button>
              <button class="btn-cat-tab" data-filter="barista-coffee">
                <i class="bi bi-cup-hot-fill"></i> Barista Coffee
              </button>
              <button class="btn-cat-tab" data-filter="fruity-americano">
                <i class="bi bi-brightness-high-fill"></i> Fruity Americano
              </button>
              <button class="btn-cat-tab" data-filter="soe-espresso">
                <i class="bi bi-award-fill"></i> Single Origin (SOE)
              </button>
              <button class="btn-cat-tab" data-filter="matcha-tea">
                <i class="bi bi-flower1"></i> Matcha &amp; Frappe
              </button>
              <button class="btn-cat-tab" data-filter="bakery">
                <i class="bi bi-pie-chart-fill"></i> Gourmet Bakery
              </button>
            </div>
          </div>
        </nav>

        <!-- 3. ALL HANDCRAFTED ITEMS GRID -->
        <section class="menu-items-section py-5" id="menuGridSection">
          <div class="container">
            
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 reveal">
              <div>
                <?php if ( ! empty( $grid_badge ) ) : ?>
                <div class="sec-pill-badge-wrap mb-1">
                  <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> <?php echo esc_html( $grid_badge ); ?></span>
                </div>
                <?php endif; ?>
                <h2 class="sec-title mb-1" id="currentCategoryHeading"><?php echo esc_html( $grid_title ); ?> <?php if ( ! empty( $grid_accent ) ) : ?><span class="sec-title-accent"><?php echo esc_html( $grid_accent ); ?></span><?php endif; ?></h2>
                <?php if ( ! empty( $grid_desc ) ) : ?>
                <div class="sec-description text-muted small" id="itemsCountText"><?php echo esc_html( $grid_desc ); ?></div>
                <?php endif; ?>
              </div>
              
              <div class="d-flex gap-2 align-items-center">
                <select id="dietaryFilter" class="form-select form-select-sm" style="width: auto; border-radius: 50px; font-weight: 600; padding: 6px 16px; border: 1.5px solid #d5e5e0;">
                  <option value="all">All Options</option>
                  <option value="iced">Iced Only</option>
                  <option value="hot">Hot Only</option>
                  <option value="bestseller">Bestseller</option>
                  <option value="plantbased">Plant-Based / Oat</option>
                </select>
              </div>
            </div>

            <div class="row g-4" id="menuItemsGrid">
              <?php
              $dynamic_menu_items = class_exists( 'Santino_Handcrafted_Items_System' ) ? Santino_Handcrafted_Items_System::get_all_menu_items() : array();
              if ( ! empty( $dynamic_menu_items ) ) :
                foreach ( $dynamic_menu_items as $m_item ) :
                  $m_badge = ! empty( $m_item['tag'] ) ? $m_item['tag'] : 'Handcrafted';
                  $m_class = ! empty( $m_item['badgeClass'] ) ? $m_item['badgeClass'] : 'badge-teal';
                  $m_price = is_numeric( $m_item['price'] ?? '' ) ? '৳ ' . $m_item['price'] : $m_item['price'];
                  $m_desc  = ! empty( $m_item['roast'] ) ? $m_item['roast'] : ( $m_item['desc'] ?? '' );
              ?>
              <div class="col-md-6 col-lg-4">
                <div class="menu-product-card">
                  <div class="menu-card-image-wrap">
                    <span class="menu-badge-pill <?php echo esc_attr( $m_class ); ?>"><?php echo esc_html( $m_badge ); ?></span>
                    <img src="<?php echo esc_url( $m_item['img'] ); ?>" alt="<?php echo esc_attr( $m_item['name'] ); ?>" class="menu-card-img" loading="lazy">
                  </div>
                  <div class="menu-card-body">
                    <div class="menu-taste-notes"><?php echo esc_html( $m_desc ); ?></div>
                    <h4 class="menu-item-name"><?php echo esc_html( $m_item['name'] ); ?></h4>
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                      <span class="menu-item-price"><?php echo esc_html( $m_price ); ?></span>
                      <?php if ( ! empty( $m_item['calories'] ) ) : ?>
                      <span class="menu-item-cal text-muted small ms-1"><?php echo esc_html( $m_item['calories'] ); ?></span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php
                endforeach;
              endif;
              ?>
            </div>
            <script>
            window.santino_menu_data = window.santino_menu_data || {};
            window.santino_menu_data.items = <?php echo json_encode( $dynamic_menu_items ); ?>;
            if (typeof menuProducts !== 'undefined' && Array.isArray(window.santino_menu_data.items)) {
              menuProducts = window.santino_menu_data.items;
            }
            </script>

            <div id="noResultsBox" class="text-center py-5 d-none">
              <i class="bi bi-cup-straw text-muted" style="font-size: 4rem;"></i>
              <h4 class="mt-3 fw-bold">No matching drinks found</h4>
              <p class="text-muted">Try searching with different keywords or clear the category filters.</p>
            </div>

          </div>
        </section>
        <?php
    }
}
