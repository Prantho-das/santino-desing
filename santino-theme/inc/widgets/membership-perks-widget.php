<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Membership_Perks_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_membership_perks';
    }

    public function get_title() {
        return esc_html__( 'Santino: 2. Member VIP Perks', 'santino' );
    }

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_header',
            array(
                'label' => esc_html__( 'Section Header', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'       => esc_html__( 'Pill Badge Text', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'MEMBER PRIVILEGES',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Section Title', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Crafted Exclusively For Coffee Lovers',
                'description' => esc_html__( 'Leave blank to hide. HTML allowed.', 'santino' ),
            )
        );

        $this->add_control(
            'desc',
            array(
                'label'       => esc_html__( 'Section Description', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Elevate every cup with exclusive roastery privileges, private sensory workshops, and member-only pricing.',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_perks',
            array(
                'label' => esc_html__( 'Perks List', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__( 'Icon Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-stars',
            )
        );

        $repeater->add_control(
            'tag',
            array(
                'label'   => esc_html__( 'Tag Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'ROASTERY EXCLUSIVE',
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Perk Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Secret Micro-Lot Drops',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Perk Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'First access to rare, limited-origin beans before public shelf release.',
            )
        );

        $repeater->add_control(
            'footer_left',
            array(
                'label'   => esc_html__( 'Footer Left Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Limited Batches',
            )
        );

        $repeater->add_control(
            'footer_right',
            array(
                'label'   => esc_html__( 'Footer Right Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'First Access',
            )
        );

        $this->add_control(
            'perks_list',
            array(
                'label'       => esc_html__( 'Perks Cards', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'icon'         => 'bi bi-stars',
                        'tag'          => 'ROASTERY EXCLUSIVE',
                        'title'        => 'Secret Micro-Lot Drops',
                        'desc'         => 'First access to rare, limited-origin beans before public shelf release.',
                        'footer_left'  => 'Limited Batches',
                        'footer_right' => 'First Access',
                    ),
                    array(
                        'icon'         => 'bi bi-mortarboard-fill',
                        'tag'          => 'VIP INVITATION',
                        'title'        => 'Free Cupping Sessions',
                        'desc'         => 'Quarterly private masterclasses with head roasters at Santino Lab Tejgaon.',
                        'footer_left'  => 'Tejgaon Roastery',
                        'footer_right' => 'Free Passes',
                    ),
                    array(
                        'icon'         => 'bi bi-tag-fill',
                        'tag'          => 'YEAR-ROUND PRIVILEGE',
                        'title'        => '15% Off All Beans',
                        'desc'         => 'Automatic member discount applied across all packaged whole beans and grounds.',
                        'footer_left'  => '250g & 1kg Bags',
                        'footer_right' => 'Year-Round',
                    ),
                    array(
                        'icon'         => 'bi bi-gift-fill',
                        'tag'          => 'ANNUAL CELEBRATION',
                        'title'        => 'Complimentary Birthday Brew',
                        'desc'         => 'A complimentary handcrafted drink on your birthday month across any Santino branch.',
                        'footer_left'  => 'Any Branch',
                        'footer_right' => '100% On Us',
                    ),
                    array(
                        'icon'         => 'bi bi-sliders',
                        'tag'          => 'EXPERT ASSISTANCE',
                        'title'        => 'Custom Dial-In Guides',
                        'desc'         => 'Personalised grind & brew recipes formulated by baristas for your specific home setup.',
                        'footer_left'  => 'Expert Baristas',
                        'footer_right' => 'Consultations',
                    ),
                    array(
                        'icon'         => 'bi bi-whatsapp',
                        'tag'          => 'DEDICATED CHANNEL',
                        'title'        => 'Priority Barista Concierge',
                        'desc'         => 'Direct WhatsApp line for reservations, bean pre-orders, and equipment support.',
                        'footer_left'  => 'Priority Line',
                        'footer_right' => 'Express Queue',
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge_text = isset( $settings['badge_text'] ) ? trim( (string) $settings['badge_text'] ) : '';
        $title      = isset( $settings['title'] ) ? trim( (string) $settings['title'] ) : '';
        $desc       = isset( $settings['desc'] ) ? trim( (string) $settings['desc'] ) : '';
        $perks_list = ! empty( $settings['perks_list'] ) && is_array( $settings['perks_list'] ) ? $settings['perks_list'] : array();
        ?>
        <style>
        .perks-section {
          background: #ffffff;
          position: relative;
        }
        .perk-card-luxury {
          background: #ffffff;
          border: 1.5px solid #e8f0ed;
          border-radius: 22px;
          padding: 32px 28px;
          height: 100%;
          position: relative;
          overflow: hidden;
          transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
          box-shadow: 0 8px 24px rgba(0, 77, 73, 0.04);
          display: flex;
          flex-direction: column;
          justify-content: space-between;
        }
        .perk-card-luxury:hover {
          transform: translateY(-8px);
          border-color: rgba(195, 153, 108, 0.5);
          box-shadow: 0 20px 40px rgba(0, 77, 73, 0.1);
        }
        .perk-icon-wrap {
          width: 58px;
          height: 58px;
          border-radius: 16px;
          background: linear-gradient(135deg, rgba(0, 98, 93, 0.08) 0%, rgba(195, 153, 108, 0.15) 100%);
          border: 1px solid rgba(195, 153, 108, 0.25);
          display: inline-flex;
          align-items: center;
          justify-content: center;
          font-size: 26px;
          color: #00625d;
          margin-bottom: 20px;
        }
        .perk-pill-tag {
          font-size: 10.5px;
          font-weight: 700;
          letter-spacing: 1px;
          text-transform: uppercase;
          padding: 4px 10px;
          border-radius: 20px;
          background: #f0f6f4;
          color: #00625d;
          border: 1px solid #d5e5e1;
        }
        .perk-title {
          font-size: 1.25rem;
          font-weight: 800;
          color: #12211e;
          margin-bottom: 10px;
        }
        .perk-desc {
          font-size: 0.92rem;
          color: #5c706d;
          line-height: 1.65;
          margin-bottom: 0;
        }
        .floating-bg-icons {
          position: absolute !important;
          top: 0 !important;
          left: 0 !important;
          width: 100% !important;
          height: 100% !important;
          pointer-events: none !important;
          overflow: hidden !important;
          z-index: 1 !important;
        }
        .float-item {
          position: absolute !important;
          color: var(--santino-teal, #00625d) !important;
          opacity: 0.16 !important;
          filter: drop-shadow(0 6px 16px rgba(0, 98, 93, 0.15)) !important;
          display: flex !important;
          align-items: center !important;
          justify-content: center !important;
        }
        .float-item svg {
          width: 100% !important;
          height: 100% !important;
          max-width: 65px !important;
          max-height: 65px !important;
        }
        .float-item-1 { top: 5% !important; left: 2% !important; width: 68px !important; height: 68px !important; }
        .float-item-2 { top: 12% !important; right: 4% !important; width: 76px !important; height: 76px !important; }
        .float-item-3 { top: 42% !important; left: 4% !important; width: 56px !important; height: 56px !important; }
        .float-item-4 { top: 68% !important; right: 3% !important; width: 80px !important; height: 80px !important; }
        .float-item-5 { bottom: 8% !important; left: 14% !important; width: 72px !important; height: 72px !important; }
        </style>

        <section class="py-5 perks-section position-relative overflow-hidden" id="perks">
          <div class="floating-bg-icons" aria-hidden="true">
            <div class="float-item float-item-1">
              <svg viewBox="0 0 64 64" fill="currentColor"><path d="M58.5 5.5C40.2 6.8 23 18.2 16.4 34.6c-2.3 5.7-3.4 12-3.4 18.4l-7.5 5.5 8.8.8c5.4-.1 10.8-1.5 15.6-4.1C47 47.1 57.3 28.5 58.5 5.5zM22.5 45.8c-2.6-3.8-4.2-8.3-4.8-12.9 6.2-4.5 13.5-7.5 21.2-8.7-7.8 7.3-13.4 15.9-16.4 21.6zm7.2-2.1c2.4-4.8 6.5-11.7 12.8-17.7 2.2-.4 4.5-.6 6.8-.7-.6 6.9-3.8 13.4-9 18.2-3.5 1.2-7.1 1.7-10.6.2z"/></svg>
            </div>
            <div class="float-item float-item-2"><i class="bi bi-cup-hot-fill"></i></div>
            <div class="float-item float-item-3">
              <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A4.49,4.49 0 0,0 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25V8.75C14,7.75 19,7 20,6.5C19,8 15,9.5 10,11.25V13.75C14.5,12.25 18,11 19,10.5C18,12 14,14 11,16.25V19C15,16.5 18,14.5 19,14C18,16 14,18.5 12,20C17,19.5 20,14 20,14C20,14 19,16 17,18C20.5,12.5 20,8 17,8Z"/></svg>
            </div>
            <div class="float-item float-item-4"><i class="bi bi-cup-straw"></i></div>
            <div class="float-item float-item-5"><i class="bi bi-stars"></i></div>
          </div>

          <div class="container py-lg-4 position-relative" style="z-index: 2;">
            <?php if ( $badge_text !== '' || $title !== '' || $desc !== '' ) : ?>
            <div class="text-center max-w-700 mx-auto mb-5">
              <?php if ( $badge_text !== '' ) : ?>
              <div class="sec-pill-badge-wrap mb-2">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge"><i class="bi bi-award-fill me-1"></i> <?php echo esc_html( $badge_text ); ?></span>
                <span class="sec-pill-line"></span>
              </div>
              <?php endif; ?>

              <?php if ( $title !== '' ) : ?>
              <h2 class="sec-title mb-2"><?php echo wp_kses_post( $title ); ?></h2>
              <?php endif; ?>

              <?php if ( $desc !== '' ) : ?>
              <p class="text-muted mb-0" style="font-size: 0.98rem; max-width: 580px; line-height: 1.5; margin: 0 auto;">
                <?php echo esc_html( $desc ); ?>
              </p>
              <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if ( ! empty( $perks_list ) ) : ?>
            <div class="row g-4 justify-content-center">
              <?php foreach ( $perks_list as $item ) : 
                $p_title = isset( $item['title'] ) ? trim( (string) $item['title'] ) : '';
                $p_desc  = isset( $item['desc'] ) ? trim( (string) $item['desc'] ) : '';
                $p_tag   = isset( $item['tag'] ) ? trim( (string) $item['tag'] ) : '';
                $p_icon  = isset( $item['icon'] ) ? trim( (string) $item['icon'] ) : 'bi bi-stars';
                $p_fleft = isset( $item['footer_left'] ) ? trim( (string) $item['footer_left'] ) : '';
                $p_fright = isset( $item['footer_right'] ) ? trim( (string) $item['footer_right'] ) : '';
                if ( $p_title === '' && $p_desc === '' ) continue;
              ?>
              <div class="col-lg-4 col-md-6">
                <div class="perk-card-luxury">
                  <div>
                    <div class="d-flex justify-content-between align-items-start">
                      <?php if ( $p_icon !== '' ) : ?>
                      <div class="perk-icon-wrap"><i class="<?php echo esc_attr( $p_icon ); ?>"></i></div>
                      <?php endif; ?>
                      <?php if ( $p_tag !== '' ) : ?>
                      <span class="perk-pill-tag"><?php echo esc_html( $p_tag ); ?></span>
                      <?php endif; ?>
                    </div>
                    <?php if ( $p_title !== '' ) : ?>
                    <h4 class="font-heading perk-title"><?php echo esc_html( $p_title ); ?></h4>
                    <?php endif; ?>
                    <?php if ( $p_desc !== '' ) : ?>
                    <p class="perk-desc"><?php echo esc_html( $p_desc ); ?></p>
                    <?php endif; ?>
                  </div>
                  <?php if ( $p_fleft !== '' || $p_fright !== '' ) : ?>
                  <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between text-muted" style="font-size: 12px;">
                    <?php if ( $p_fleft !== '' ) : ?>
                    <span><i class="bi bi-check2-circle text-teal me-1"></i> <?php echo esc_html( $p_fleft ); ?></span>
                    <?php endif; ?>
                    <?php if ( $p_fright !== '' ) : ?>
                    <span class="fw-bold text-teal"><?php echo esc_html( $p_fright ); ?></span>
                    <?php endif; ?>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <?php endif; ?>
          </div>
        </section>
        <?php
    }
}
