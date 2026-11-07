<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Menu_Branches_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_menu_branches';
    }

    public function get_title() {
        return esc_html__( 'Santino: 5. Cafes & Roastery Hubs Locator', 'santino' );
    }

    public function get_icon() {
        return 'eicon-google-maps';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_branches',
            array(
                'label' => esc_html__( 'Cafes & Hubs Heading', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'branches_badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'EXPERIENCE SANTINO NATIONWIDE',
            )
        );

        $this->add_control(
            'branches_title',
            array(
                'label'   => esc_html__( 'Title Main', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Our Cafes &',
            )
        );

        $this->add_control(
            'branches_title_accent',
            array(
                'label'   => esc_html__( 'Title Accent', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Roastery Hubs',
            )
        );

        $this->add_control(
            'branches_sub',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Step into an artisan coffee retreat or visit our partner express bars across prime Dhaka locations',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge        = isset( $settings['branches_badge'] ) && $settings['branches_badge'] !== '' ? $settings['branches_badge'] : 'EXPERIENCE SANTINO NATIONWIDE';
        $title        = isset( $settings['branches_title'] ) && $settings['branches_title'] !== '' ? $settings['branches_title'] : 'Our Cafes &';
        $title_accent = isset( $settings['branches_title_accent'] ) && $settings['branches_title_accent'] !== '' ? $settings['branches_title_accent'] : 'Roastery Hubs';
        $sub          = isset( $settings['branches_sub'] ) && $settings['branches_sub'] !== '' ? $settings['branches_sub'] : 'Step into an artisan coffee retreat or visit our partner express bars across prime Dhaka locations';

        $branches_detailed = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_branches_detailed() : array();

        $region_filters = array();
        foreach ( $branches_detailed as $b ) {
            $r = ! empty( $b['district'] ) ? trim( $b['district'] ) : ( ! empty( $b['division'] ) ? trim( $b['division'] ) : '' );
            if ( $r && ! in_array( $r, $region_filters ) ) {
                $region_filters[] = $r;
            }
        }
        ?>
        <!-- 6. EXPERIENCE HUBS LOCATOR -->
        <section class="cafe-branches-section py-5" id="branches" style="background-color: #fff9f3;">
          <div class="container">
            
            <div class="sec-heading-center text-center mb-5 reveal">
              <?php if ( ! empty( $badge ) ) : ?>
              <div class="sec-pill-badge-wrap mb-2">
                <span class="sec-pill-badge"><i class="bi bi-geo-alt-fill text-danger me-1"></i> <?php echo esc_html( $badge ); ?></span>
              </div>
              <?php endif; ?>
              <h2 class="sec-title mb-2"><?php echo esc_html( $title ); ?> <?php if ( ! empty( $title_accent ) ) : ?><span class="sec-title-accent"><?php echo esc_html( $title_accent ); ?></span><?php endif; ?></h2>
              <?php if ( ! empty( $sub ) ) : ?>
              <div class="sec-description"><?php echo esc_html( $sub ); ?></div>
              <?php endif; ?>
            </div>

            <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 reveal">
              <button class="branch-filter-btn active" data-branch-filter="all">All Locations (<?php echo count( $branches_detailed ); ?>)</button>
              <?php foreach ( $region_filters as $rf ) : ?>
              <button class="branch-filter-btn" data-branch-filter="<?php echo esc_attr( sanitize_title( $rf ) ); ?>"><?php echo esc_html( $rf ); ?></button>
              <?php endforeach; ?>
            </div>

            <div class="row g-4" id="branchesGrid">
              <?php
              if ( ! empty( $branches_detailed ) ) :
                foreach ( $branches_detailed as $idx => $b ) :
                  $b_region    = sanitize_title( ! empty( $b['district'] ) ? $b['district'] : ( ! empty( $b['division'] ) ? $b['division'] : 'dhaka' ) );
                  $map_url     = ! empty( $b['map_location'] ) ? $b['map_location'] : ( ( ! empty( $b['lat'] ) && ! empty( $b['long'] ) ) ? 'https://www.google.com/maps?q=' . $b['lat'] . ',' . $b['long'] : 'https://maps.google.com/?q=' . urlencode( $b['name'] . ' ' . $b['address'] ) );
                  $phone_clean = preg_replace( '/[^0-9+]/', '', $b['phone'] ?? '' );
                  $card_img    = santino_img( 'imgi_26_santino_-_250522-07312.jpg' );
                  if ( $idx === 0 ) {
                      $card_img = function_exists('santino_get_page_banner') ? santino_get_page_banner('menu', 'banner-signature-lattes.jpg') : santino_img('banner-signature-lattes.jpg');
                  } elseif ( $idx % 2 === 0 ) {
                      $card_img = santino_img( 'imgi_27_santino_-_250522-07216.jpg' );
                  }
              ?>
              <div class="col-lg-4 col-md-6 branch-item-col reveal" data-delay="<?php echo ( $idx + 1 ) * 100; ?>" data-region="<?php echo esc_attr( $b_region ); ?>">
                <div class="branch-card hover-lift">
                  <div class="branch-card-img" style="background-image: url('<?php echo esc_url( $card_img ); ?>');">
                    <span class="branch-tag-badge"><?php echo esc_html( ! empty( $b['division'] ) ? strtoupper( $b['division'] ) : 'EXPERIENCE HUB' ); ?></span>
                  </div>
                  <div class="branch-card-body">
                    <h3 class="branch-title"><?php echo esc_html( $b['name'] ); ?></h3>
                    <p class="branch-desc text-muted small mb-3"><?php echo esc_html( ! empty( $b['district'] ) ? ( $b['district'] . ', ' . ( $b['division'] ?? 'Bangladesh' ) ) : 'Specialty Espresso bar and fresh bakery treats.' ); ?></p>
                    
                    <div class="branch-info-list">
                      <?php if ( ! empty( $b['address'] ) ) : ?>
                      <div class="info-line"><i class="bi bi-geo-alt text-danger"></i> <span><?php echo esc_html( $b['address'] ); ?></span></div>
                      <?php endif; ?>
                      <?php if ( ! empty( $b['lat'] ) && ! empty( $b['long'] ) ) : ?>
                      <div class="info-line"><i class="bi bi-compass text-teal"></i> <span>GPS: <?php echo esc_html( $b['lat'] ); ?>, <?php echo esc_html( $b['long'] ); ?></span></div>
                      <?php endif; ?>
                      <div class="info-line"><i class="bi bi-clock text-primary"></i> <span>Sat – Thurs: 7:30 AM – 11:00 PM | Fri: 8:00 AM – 11:30 PM</span></div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                      <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" class="btn-prod-outline flex-fill">
                        <i class="bi bi-pin-map-fill me-1 text-danger"></i> Google Maps
                      </a>
                      <?php if ( ! empty( $b['phone'] ) ) : ?>
                      <a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="btn btn-dark btn-sm flex-fill fw-bold py-2 btn-order-branch hover-glow" style="background-color: var(--santino-teal); border: none;">
                        <i class="bi bi-telephone-fill me-1"></i> <?php echo esc_html( $b['phone'] ); ?>
                      </a>
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

          </div>
        </section>
        <?php
    }
}
