<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Membership_Portal_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_membership_portal';
    }

    public function get_title() {
        return esc_html__( 'Santino: 3. Member VIP Portal & Stamp Card', 'santino' );
    }

    public function get_icon() {
        return 'eicon-user-circle-o';
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
                'default'     => 'VIP LOYALTY REWARDS',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Section Title', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Digital Coffee Stamp Card & Club Portal',
                'description' => esc_html__( 'Leave blank to hide. HTML allowed.', 'santino' ),
            )
        );

        $this->add_control(
            'desc',
            array(
                'label'       => esc_html__( 'Section Description', 'santino' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!',
                'description' => esc_html__( 'Leave blank to hide.', 'santino' ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_card',
            array(
                'label' => esc_html__( 'Stamp Card & Tabs Settings', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'card_sub',
            array(
                'label'   => esc_html__( 'Card Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SANTINO COFFEE CLUB',
            )
        );

        $this->add_control(
            'card_title',
            array(
                'label'   => esc_html__( 'Card Membership Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Regular Member',
            )
        );

        $this->add_control(
            'tab1_title',
            array(
                'label'   => esc_html__( 'Tab 1 Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Check Stamp Status',
            )
        );

        $this->add_control(
            'tab2_title',
            array(
                'label'   => esc_html__( 'Tab 2 Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Log Invoice',
            )
        );

        $this->add_control(
            'tab3_title',
            array(
                'label'   => esc_html__( 'Tab 3 Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Join Coffee Club',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $badge_text = isset( $settings['badge_text'] ) ? trim( (string) $settings['badge_text'] ) : '';
        $title      = isset( $settings['title'] ) ? trim( (string) $settings['title'] ) : '';
        $desc       = isset( $settings['desc'] ) ? trim( (string) $settings['desc'] ) : '';

        $card_sub   = ! empty( $settings['card_sub'] ) ? $settings['card_sub'] : 'SANTINO COFFEE CLUB';
        $card_title = ! empty( $settings['card_title'] ) ? $settings['card_title'] : 'Regular Member';

        $tab1_title = ! empty( $settings['tab1_title'] ) ? $settings['tab1_title'] : 'Check Stamp Status';
        $tab2_title = ! empty( $settings['tab2_title'] ) ? $settings['tab2_title'] : 'Log Invoice';
        $tab3_title = ! empty( $settings['tab3_title'] ) ? $settings['tab3_title'] : 'Join Coffee Club';
        ?>
        <style>
        .club-portal-section {
          background: radial-gradient(circle at 12% 18%, rgba(0, 98, 93, 0.06) 0%, transparent 45%),
                      radial-gradient(circle at 88% 82%, rgba(195, 153, 108, 0.09) 0%, transparent 45%),
                      linear-gradient(180deg, #f7faf9 0%, #eaf1ef 100%);
          position: relative;
          overflow-x: clip;
          overflow-y: visible;
        }
        .vip-card-surface {
          background: radial-gradient(circle at 88% 12%, rgba(223, 190, 141, 0.22) 0%, transparent 50%),
                      linear-gradient(135deg, #014642 0%, #002826 55%, #001615 100%);
          border: 1px solid rgba(223, 190, 141, 0.38);
          border-radius: 24px;
          color: #ffffff;
          padding: clamp(20px, 3vw, 30px);
          position: relative;
          overflow: hidden;
          box-shadow: 0 24px 48px -12px rgba(0, 45, 43, 0.32), inset 0 1px 0 rgba(255, 255, 255, 0.12);
          transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
        }
        .vip-card-surface:hover {
          transform: translateY(-3px);
          box-shadow: 0 28px 54px -12px rgba(0, 45, 43, 0.38), inset 0 1px 0 rgba(255, 255, 255, 0.16);
        }
        .vip-card-watermark {
          position: absolute;
          right: -20px;
          bottom: -30px;
          font-size: clamp(120px, 18vw, 165px);
          color: rgba(255, 255, 255, 0.04);
          pointer-events: none;
          z-index: 1;
        }
        .gold-chip {
          width: 44px;
          height: 32px;
          border-radius: 7px;
          background: linear-gradient(135deg, #ebd0a3 0%, #c89f70 50%, #9f7545 100%);
          border: 1px solid rgba(255, 255, 255, 0.45);
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25), inset 0 1px 1px rgba(255, 255, 255, 0.5);
          position: relative;
          flex-shrink: 0;
        }
        .gold-chip::after {
          content: "";
          position: absolute;
          inset: 6px;
          border: 1px solid rgba(0, 45, 43, 0.22);
          border-radius: 3px;
        }
        .vip-tracker-box {
          background: rgba(0, 0, 0, 0.24);
          backdrop-filter: blur(10px);
          -webkit-backdrop-filter: blur(10px);
          border: 1px solid rgba(223, 190, 141, 0.22);
          border-radius: 18px;
          padding: clamp(12px, 2.5vw, 18px);
          position: relative;
          z-index: 2;
        }
        .vip-stamps-grid {
          display: grid;
          grid-template-columns: repeat(6, minmax(0, 1fr));
          gap: clamp(4px, 1.5vw, 10px);
          align-items: start;
          padding-top: 6px;
        }
        .vip-stamp-col {
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
          min-width: 0;
        }
        .stamp-slot {
          width: clamp(34px, 8.5vw, 44px);
          height: clamp(34px, 8.5vw, 44px);
          border-radius: 50%;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          font-size: clamp(14px, 3vw, 18px);
          transition: transform 0.25s ease;
        }
        .stamp-slot.active {
          background: linear-gradient(135deg, #ebd0a3 0%, #c3996c 100%);
          color: #002d2b;
          border: 2px solid #ffffff;
          box-shadow: 0 4px 12px rgba(223, 190, 141, 0.35);
        }
        .stamp-slot.empty {
          background: rgba(255, 255, 255, 0.06);
          border: 1.5px dashed rgba(223, 190, 141, 0.38);
          color: rgba(255, 255, 255, 0.55);
          font-size: clamp(11px, 2.4vw, 13px);
          font-weight: 700;
        }
        .stamp-slot.reward {
          background: linear-gradient(135deg, #f3dcaf 0%, #c3996c 100%);
          border: 2px solid #ffffff;
          box-shadow: 0 0 16px rgba(223, 190, 141, 0.45);
        }
        .portal-steps-card {
          background: rgba(255, 255, 255, 0.92);
          backdrop-filter: blur(10px);
          border: 1px solid rgba(0, 98, 93, 0.1);
          border-radius: 20px;
          padding: clamp(12px, 2vw, 18px);
          box-shadow: 0 12px 30px rgba(0, 77, 73, 0.05);
        }
        .portal-steps-grid {
          display: grid;
          grid-template-columns: repeat(3, minmax(0, 1fr));
          gap: 8px;
        }
        .portal-step-item {
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
          padding: 10px 6px;
          border-radius: 14px;
          transition: background 0.25s ease, transform 0.25s ease;
          position: relative;
        }
        .portal-step-item:hover {
          background: rgba(0, 98, 93, 0.04);
          transform: translateY(-2px);
        }
        .portal-step-icon {
          width: 40px;
          height: 40px;
          border-radius: 12px;
          background: rgba(0, 98, 93, 0.08);
          color: #00625d;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          font-size: 1.15rem;
          margin-bottom: 8px;
        }
        .portal-step-item.is-reward .portal-step-icon {
          background: rgba(195, 153, 108, 0.16);
          color: #b4844e;
        }
        #clubPortal .portal-card {
          background: #ffffff;
          border: 1px solid rgba(0, 98, 93, 0.11);
          border-radius: 24px;
          padding: clamp(20px, 3.2vw, 32px);
          box-shadow: 0 20px 45px rgba(0, 77, 73, 0.07);
        }
        #clubPortal .portal-tabs {
          display: flex !important;
          flex-wrap: nowrap !important;
          gap: 8px;
          background: #eef4f1;
          padding: 8px;
          border-radius: 18px;
          border: 1px solid #d8e5e0;
        }
        #clubPortal .portal-tabs .nav-item {
          flex: 1 1 auto;
          min-width: 0;
        }
        #clubPortal .portal-tabs .nav-link {
          width: 100%;
          min-height: 46px;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: 8px;
          color: #1a332f !important;
          background: #ffffff !important;
          border: 1.5px solid #d4e2dd !important;
          border-radius: 12px;
          padding: 10px 14px;
          font-weight: 700;
          font-size: 13px;
          box-shadow: 0 2px 6px rgba(0, 40, 35, 0.04);
          transition: all 0.25s ease;
        }
        #clubPortal .portal-tabs .nav-link i {
          color: #00625d;
          font-size: 14px;
          transition: color 0.2s ease;
        }
        #clubPortal .portal-tabs .nav-link:hover:not(.active) {
          background: #f4faf7 !important;
          color: #004d49 !important;
          border-color: #00625d !important;
        }
        #clubPortal .portal-tabs .nav-link.active {
          background: linear-gradient(135deg, #006e68 0%, #004d49 100%) !important;
          color: #ffffff !important;
          border-color: #004d49 !important;
          box-shadow: 0 6px 18px rgba(0, 98, 93, 0.28) !important;
        }
        #clubPortal .portal-tabs .nav-link.active i {
          color: #ffffff !important;
        }
        #clubPortal .portal-lookup-group {
          background: #f8fbfa;
          border-radius: 50px;
          padding: 6px 6px 6px 18px !important;
          display: flex !important;
          align-items: center !important;
          gap: 10px !important;
          width: 100% !important;
          max-width: 100% !important;
          box-sizing: border-box !important;
          border: 1.5px solid #d5e4df;
          transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
        }
        #clubPortal .portal-lookup-group:focus-within {
          background: #ffffff;
          border-color: #00625d;
          box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.11);
        }
        #clubPortal .portal-lookup-field {
          flex: 1 1 0% !important;
          min-width: 0 !important;
          display: flex !important;
          align-items: center !important;
          gap: 10px !important;
        }
        #clubPortal .portal-lookup-field input {
          border: none !important;
          outline: none !important;
          box-shadow: none !important;
          width: 100% !important;
          min-width: 0 !important;
          flex: 1 1 0% !important;
          font-size: 0.95rem;
          font-weight: 500;
          color: #1f2d2b;
          background: transparent !important;
          padding: 8px 0 !important;
        }
        #clubPortal .btn-lookup-action {
          flex: 0 0 auto !important;
          width: auto !important;
          min-width: max-content !important;
          background: linear-gradient(135deg, #006e68 0%, #005450 100%) !important;
          color: #ffffff !important;
          border: none !important;
          min-height: 42px;
          padding: 10px 22px !important;
          border-radius: 50px !important;
          font-weight: 700;
          font-size: 12px;
          letter-spacing: 0.6px;
          text-transform: uppercase;
          white-space: nowrap !important;
          display: inline-flex !important;
          align-items: center !important;
          justify-content: center !important;
          gap: 6px;
          cursor: pointer;
          box-shadow: 0 6px 16px rgba(0, 98, 93, 0.22);
          transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        #clubPortal .btn-lookup-action:hover {
          transform: translateY(-1px);
          box-shadow: 0 8px 20px rgba(0, 98, 93, 0.3);
        }
        #clubPortal .portal-quick-info {
          display: grid;
          grid-template-columns: repeat(2, minmax(0, 1fr));
          gap: 10px;
          margin-top: 20px;
        }
        #clubPortal .portal-info-pill {
          display: flex;
          align-items: center;
          gap: 10px;
          padding: 12px 14px;
          border-radius: 14px;
          background: #f7faf9;
          border: 1px solid #e3eeea;
        }
        #clubPortal .portal-info-pill i {
          width: 34px;
          height: 34px;
          border-radius: 10px;
          background: rgba(0, 98, 93, 0.08);
          color: #00625d;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          flex-shrink: 0;
          font-size: 1rem;
        }
        #clubPortal .portal-card .form-control,
        #clubPortal .portal-card .form-select {
          border-radius: 12px;
          border: 1.5px solid #dbe5e2;
          min-height: 44px;
          font-size: 0.92rem;
          transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        #clubPortal .portal-card .form-control:focus,
        #clubPortal .portal-card .form-select:focus {
          border-color: #00625d;
          box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.1);
        }
        #clubPortal .btn-portal-submit {
          background: linear-gradient(135deg, #006e68 0%, #00504c 100%);
          color: #ffffff;
          border: none;
          border-radius: 14px;
          min-height: 48px;
          font-weight: 700;
          letter-spacing: 0.5px;
          padding: 13px 24px;
          box-shadow: 0 10px 24px rgba(0, 98, 93, 0.22);
          transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        #clubPortal .btn-portal-submit:hover {
          background: linear-gradient(135deg, #005b56 0%, #00423e 100%);
          color: #ffffff;
          transform: translateY(-1px);
          box-shadow: 0 12px 28px rgba(0, 98, 93, 0.28);
        }
        @media (max-width: 991.98px) {
          #clubPortal .portal-tabs {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 8px !important;
            padding: 8px !important;
          }
          #clubPortal .portal-tabs .nav-link {
            min-height: 48px;
            font-size: 12.5px !important;
            padding: 8px 10px !important;
            white-space: normal !important;
            text-align: center;
            line-height: 1.25;
          }
        }
        @media (max-width: 575.98px) {
          #clubPortal {
            padding-bottom: 95px !important;
          }
          #clubPortal .portal-card {
            padding: 18px 14px 28px !important;
            border-radius: 18px !important;
          }
          #clubPortal .portal-tabs {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 6px !important;
            padding: 6px !important;
          }
          #clubPortal .portal-tabs .nav-link {
            font-size: 11.5px !important;
            padding: 8px 4px !important;
            gap: 5px;
          }
          #clubPortal .portal-quick-info {
            grid-template-columns: 1fr;
          }
          #clubPortal .portal-lookup-group {
            flex-direction: column !important;
            border-radius: 18px !important;
            padding: 10px !important;
            align-items: stretch !important;
          }
          #clubPortal .portal-lookup-field {
            padding: 2px 6px;
            font-size: 16px !important;
          }
          #clubPortal .btn-lookup-action {
            width: 100% !important;
            border-radius: 12px !important;
            min-height: 46px;
          }
          #clubPortal .form-control,
          #clubPortal .form-select {
            font-size: 16px !important;
            min-height: 48px !important;
          }
          .portal-step-item {
            padding: 8px 3px;
          }
        }
        #clubPortal .snt-ss-wrap {
          position: relative;
          width: 100%;
          z-index: 2;
        }
        #clubPortal .snt-ss-wrap.is-open {
          z-index: 9999 !important;
        }
        #clubPortal .snt-ss-native {
          position: absolute !important;
          opacity: 0 !important;
          pointer-events: none !important;
          width: 1px !important;
          height: 1px !important;
          left: 50%;
          bottom: 0;
          margin: 0 !important;
          padding: 0 !important;
        }
        #clubPortal .snt-ss-trigger {
          width: 100%;
          min-height: 44px;
          padding: 9px 14px;
          border-radius: 12px;
          border: 1.5px solid #dbe5e2;
          background: #ffffff;
          color: #1f2d2b;
          font-size: 0.92rem;
          font-weight: 500;
          text-align: left;
          cursor: pointer;
          display: flex;
          align-items: center;
          justify-content: space-between;
          gap: 10px;
          transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        #clubPortal .santino-row-main .snt-ss-trigger {
          border: none !important;
          background: transparent !important;
          min-height: 40px;
          padding: 6px 10px;
          box-shadow: none !important;
        }
        #clubPortal .snt-ss-trigger-text {
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
        }
        #clubPortal .snt-ss-trigger.is-placeholder .snt-ss-trigger-text {
          color: #7c928d;
        }
        #clubPortal .snt-ss-chevron {
          color: #00625d;
          font-size: 0.85rem;
          flex-shrink: 0;
          transition: transform 0.2s ease;
        }
        #clubPortal .snt-ss-wrap.is-open .snt-ss-trigger {
          border-color: #00625d;
          box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.1);
        }
        #clubPortal .snt-ss-wrap.is-open .snt-ss-chevron {
          transform: rotate(180deg);
        }
        #clubPortal .snt-ss-panel {
          position: absolute;
          top: calc(100% + 6px);
          left: 0;
          right: 0;
          z-index: 99999 !important;
          background: #ffffff;
          border: 1.5px solid #d5e4df;
          border-radius: 16px;
          box-shadow: 0 18px 40px rgba(0, 45, 43, 0.18);
          overflow: hidden;
          display: none;
        }
        #clubPortal .snt-ss-wrap.is-open-up .snt-ss-panel {
          top: auto;
          bottom: calc(100% + 6px);
        }
        #clubPortal .snt-ss-wrap.is-open .snt-ss-panel {
          display: block;
        }
        #clubPortal .snt-ss-search-box {
          display: flex;
          align-items: center;
          gap: 8px;
          padding: 10px 12px;
          border-bottom: 1px solid #e8f0ed;
          background: #f8fbfa;
        }
        #clubPortal .snt-ss-search-box i {
          color: #00625d;
          font-size: 0.9rem;
        }
        #clubPortal .snt-ss-search {
          border: none !important;
          outline: none !important;
          background: transparent !important;
          width: 100%;
          font-size: 0.88rem;
          color: #1f2d2b;
          padding: 2px 0;
        }
        #clubPortal .snt-ss-list {
          max-height: 220px;
          overflow-y: auto;
          padding: 6px;
        }
        #clubPortal .snt-ss-opt {
          padding: 9px 12px;
          border-radius: 10px;
          font-size: 0.89rem;
          color: #1f2d2b;
          cursor: pointer;
          display: flex;
          align-items: center;
          justify-content: space-between;
          gap: 8px;
          transition: background 0.15s ease, color 0.15s ease;
        }
        #clubPortal .snt-ss-opt:hover {
          background: #f0faf7;
          color: #004d49;
        }
        #clubPortal .snt-ss-opt.is-selected {
          background: #e6f4f1;
          color: #00625d;
          font-weight: 700;
        }
        #clubPortal .snt-ss-empty {
          padding: 14px 10px;
          text-align: center;
          font-size: 0.84rem;
          color: #7c928d;
        }
        </style>

        <section class="py-5 club-portal-section position-relative" id="clubPortal">
          <div class="container py-lg-4">
            
            <?php if ( $badge_text !== '' || $title !== '' || $desc !== '' ) : ?>
            <div class="text-center max-w-700 mx-auto mb-5">
              <?php if ( $badge_text !== '' ) : ?>
              <div class="sec-pill-badge-wrap mb-2">
                <span class="sec-pill-line"></span>
                <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> <?php echo esc_html( $badge_text ); ?></span>
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

            <div class="row g-4 align-items-start justify-content-center">
              
              <div class="col-lg-5">
                <div class="d-flex flex-column gap-3">
                  <div class="vip-card-surface">
                    <i class="bi bi-cup-hot vip-card-watermark"></i>
                    
                    <div class="d-flex justify-content-between align-items-start mb-3 position-relative" style="z-index: 2;">
                      <div>
                        <div class="small fw-bold text-uppercase" style="color: #dfbe8d; letter-spacing: 1.5px; font-size: 11px;">
                          <?php echo esc_html( $card_sub ); ?>
                        </div>
                        <h4 class="font-heading fw-bold text-white mb-0 mt-1"><?php echo esc_html( $card_title ); ?></h4>
                      </div>
                      <div class="gold-chip"></div>
                    </div>

                    <div class="mb-4 position-relative" style="z-index: 2;">
                      <div class="font-monospace text-white-50 small" style="letter-spacing: 2px;">SNT-REG-•••• ••••</div>
                    </div>

                    <div class="vip-tracker-box mb-3">
                      <div class="d-flex justify-content-between align-items-center mb-2 gap-2 flex-wrap">
                        <span class="small fw-bold" style="color: #dfbe8d; font-size: 11.5px;">5-Cup Stamp Card Tracker</span>
                        <span class="badge rounded-pill" style="background: rgba(195, 153, 108, 0.25); color: #ebd0a3; font-size: 10px; border: 1px solid rgba(223, 190, 141, 0.3);">BUY 5, GET 1 FREE</span>
                      </div>
                      
                      <div class="vip-stamps-grid">
                        <div class="vip-stamp-col">
                          <div class="stamp-slot active mb-1">☕</div>
                          <div style="font-size: 9.5px; color: #dfbe8d;">Cup 1</div>
                        </div>
                        <div class="vip-stamp-col">
                          <div class="stamp-slot active mb-1">☕</div>
                          <div style="font-size: 9.5px; color: #dfbe8d;">Cup 2</div>
                        </div>
                        <div class="vip-stamp-col">
                          <div class="stamp-slot empty mb-1">3</div>
                          <div class="text-white-50" style="font-size: 9.5px;">Cup 3</div>
                        </div>
                        <div class="vip-stamp-col">
                          <div class="stamp-slot empty mb-1">4</div>
                          <div class="text-white-50" style="font-size: 9.5px;">Cup 4</div>
                        </div>
                        <div class="vip-stamp-col">
                          <div class="stamp-slot empty mb-1">5</div>
                          <div class="text-white-50" style="font-size: 9.5px;">Cup 5</div>
                        </div>
                        <div class="vip-stamp-col">
                          <div class="stamp-slot reward mb-1"><i class="bi bi-gift-fill" style="color: #002d2b; font-size: 15px;"></i></div>
                          <div style="font-size: 9.5px; color: #dfbe8d; font-weight: 700;">FREE #6</div>
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center text-white-50 small position-relative gap-2 flex-wrap" style="z-index: 2; font-size: 11px;">
                      <span>Valid across all Dhaka branches</span>
                      <span style="color: #dfbe8d;"><i class="bi bi-patch-check-fill me-1"></i> Auto-Verified</span>
                    </div>
                  </div>

                  <div class="portal-steps-card">
                    <div class="portal-steps-grid">
                      <div class="portal-step-item">
                        <div class="portal-step-icon"><i class="bi bi-cup-hot"></i></div>
                        <div class="fw-bold small text-dark">1. Sip Coffee</div>
                        <div class="text-muted" style="font-size: 10.5px;">At partner cafes</div>
                      </div>
                      <div class="portal-step-item">
                        <div class="portal-step-icon"><i class="bi bi-receipt"></i></div>
                        <div class="fw-bold small text-dark">2. Log Memo</div>
                        <div class="text-muted" style="font-size: 10.5px;">Submit invoice &amp; cups</div>
                      </div>
                      <div class="portal-step-item is-reward">
                        <div class="portal-step-icon"><i class="bi bi-gift"></i></div>
                        <div class="fw-bold small text-dark">3. Get Free Cup</div>
                        <div class="text-muted" style="font-size: 10.5px;">Buy 5, Get 1 Free</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-7">
                <div class="portal-card">
                  <ul class="nav nav-pills portal-tabs mb-4" id="loyaltyTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="stamps-tab" data-bs-toggle="pill" data-bs-target="#stamps-pane" type="button" role="tab">
                        <i class="bi bi-search me-1"></i> <?php echo esc_html( $tab1_title ); ?>
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="invoice-tab" data-bs-toggle="pill" data-bs-target="#invoice-pane" type="button" role="tab">
                        <i class="bi bi-receipt-cutoff me-1"></i> <?php echo esc_html( $tab2_title ); ?>
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="register-tab" data-bs-toggle="pill" data-bs-target="#register-pane" type="button" role="tab">
                        <i class="bi bi-person-check-fill me-1"></i> <?php echo esc_html( $tab3_title ); ?>
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="today-offer-tab" data-bs-toggle="pill" data-bs-target="#today-offer-pane" type="button" role="tab">
                        <i class="bi bi-stars me-1 text-warning"></i> Today's Offer
                      </button>
                    </li>
                  </ul>

                  <div class="tab-content flex-grow-1" id="loyaltyTabsContent">
                    
                    <div class="tab-pane fade show active" id="stamps-pane" role="tabpanel">
                      <div class="mb-4">
                        <h4 class="font-heading fw-bold text-dark mb-1">Check Your Live Stamp Progress</h4>
                        <p class="text-muted small">Enter your Registered Phone Number below.</p>
                      </div>

                      <form id="santinoLookupForm" class="mb-4">
                        <div class="portal-lookup-group">
                          <div class="portal-lookup-field">
                            <i class="bi bi-telephone text-teal"></i>
                            <input type="text" name="query" placeholder="e.g. 017XXXXXXXX" required>
                          </div>
                          <button type="submit" class="btn-lookup-action">
                            <span>LOOKUP</span> <i class="bi bi-arrow-right"></i>
                          </button>
                        </div>
                      </form>

                      <div id="liveStampCardContainer" style="display: none;"></div>

                      <div class="portal-quick-info">
                        <div class="portal-info-pill">
                          <i class="bi bi-cup-hot-fill"></i>
                          <div>
                            <div class="fw-bold text-dark" style="font-size: 12px;">5 Stamps = 1 Free</div>
                            <div class="text-muted" style="font-size: 11px;">Claim any handcrafted cup</div>
                          </div>
                        </div>
                        <div class="portal-info-pill">
                          <i class="bi bi-lightning-charge-fill"></i>
                          <div>
                            <div class="fw-bold text-dark" style="font-size: 12px;">Instant Sync</div>
                            <div class="text-muted" style="font-size: 11px;">Live balance across Dhaka</div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="invoice-pane" role="tabpanel">
                      <div class="mb-4">
                        <h4 class="font-heading fw-bold text-dark mb-1">Log Cafe Invoice / Memo Number</h4>
                        <p class="text-muted small">Submit your receipt details. Each approved cup credits your 5-cup stamp progress.</p>
                      </div>

                      <div id="invoiceResponseBox" style="display: none;" class="mb-4"></div>

                      <form id="santinoInvoiceForm" enctype="multipart/form-data">
                        <div class="row g-3 mb-3">
                          <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Invoice / Memo Number *</label>
                            <input type="text" name="invoice_number" class="form-control" placeholder="e.g. SNT-2026-9042" required>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Phone Number / WhatsApp *</label>
                            <input type="tel" name="phone" class="form-control santino-phone-validate" placeholder="017XXXXXXXX" pattern="^(?:\+?880|0)1[3-9]\d{8}$" maxlength="15" title="Please enter a valid 11-digit Bangladeshi phone number" required>
                          </div>
                        </div>

                        <!-- Dynamic Multi-Item Order Section (Compact & Mobile-First) -->
                        <div class="mb-3">
                          <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label small fw-bold text-dark mb-0">
                              <i class="bi bi-cup-hot-fill me-1" style="color: #00625d;"></i> Items Ordered / Consumed *
                            </label>
                            <span class="santino-total-cups-badge">
                              Total: <span class="santino-total-cups-count">1</span> Cup(s)/Item(s)
                            </span>
                          </div>

                          <div class="santino-order-items-container mb-2">
                            <div class="santino-order-item-row">
                              <div class="santino-row-main">
                                <select name="order_items[]" class="santino-item-select" required>
                                  <option value="" disabled selected>-- Select Ordered Coffee / Item --</option>
                                  <?php 
                                  $ordered_items = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_order_item_choices() : array();
                                  foreach ( $ordered_items as $item_choice ) : ?>
                                    <option value="<?php echo esc_attr( $item_choice ); ?>"><?php echo esc_html( $item_choice ); ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="santino-row-actions">
                                <div class="santino-stepper-capsule">
                                  <button type="button" class="santino-stepper-btn santino-row-minus" aria-label="Decrease">−</button>
                                  <input type="text" name="order_qtys[]" class="santino-stepper-val santino-row-qty" value="1" readonly>
                                  <button type="button" class="santino-stepper-btn santino-row-plus" aria-label="Increase">+</button>
                                </div>
                                <button type="button" class="santino-remove-item-row d-none" title="Remove item">
                                  <i class="bi bi-trash3"></i>
                                </button>
                              </div>
                            </div>
                          </div>

                          <div class="d-flex justify-content-between align-items-center pt-2">
                            <button type="button" class="btn santino-add-order-item-btn">
                              <i class="bi bi-plus-circle-fill"></i> Add Another Item
                            </button>
                            <div class="text-muted" style="font-size: 11px;">Specify each item &amp; quantity</div>
                          </div>

                          <input type="hidden" name="cups" class="santino-cups-input" value="1">
                          <input type="hidden" name="items_consumed" class="santino-items-consumed-summary" value="">
                        </div>

                        <div class="row g-3 mb-3">
                          <div class="col-md-12">
                            <label class="form-label small fw-bold text-dark">Cafe Branch Visited</label>
                            <select name="branch" class="form-select">
                              <?php 
                              $cafe_branches = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_cafe_branches() : array( 'Gulshan-2 Flagship Experience Center' );
                              foreach ( $cafe_branches as $b ) : ?>
                                <option value="<?php echo esc_attr( $b ); ?>"><?php echo esc_html( $b ); ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <?php if ( class_exists( 'Santino_Membership_System' ) ) { echo Santino_Membership_System::render_promo_selector_field(); } ?>
                        </div>

                        <div class="mb-4">
                          <label class="form-label small fw-bold text-dark"><i class="bi bi-camera-fill me-1 text-teal"></i> Upload Invoice / Memo Photo * (Mandatory)</label>
                          <input type="file" name="invoice_image" id="santinoInvoiceImage" class="form-control" accept="image/jpeg,image/png,image/webp,image/jpg" required>
                          <div class="form-text text-muted small" style="font-size: 0.78rem;">Upload photo of your physical cafe bill/memo for fast verification (JPG, PNG, WebP) - Required.</div>
                        </div>

                        <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                          Submit Invoice For Stamp Verification →
                        </button>
                      </form>
                    </div>

                    <div class="tab-pane fade" id="register-pane" role="tabpanel">
                      <div class="mb-4">
                        <h4 class="font-heading fw-bold text-dark mb-1">Register For Santino Coffee Club</h4>
                        <p class="text-muted small">Join Regular Membership to activate your 5-cup digital coffee stamp card.</p>
                      </div>

                      <div id="membershipResponseBox" style="display: none;" class="mb-4"></div>

                      <form id="santinoMembershipForm">
                        <div class="row g-3 mb-3">
                          <div class="col-md-12">
                            <label class="form-label small fw-bold text-dark">Full Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                          </div>
                        </div>

                        <div class="row g-3 mb-3">
                          <div class="col-md-12">
                            <label class="form-label small fw-bold text-dark">Mobile Number / WhatsApp *</label>
                            <input type="tel" name="phone" id="santinoMemberPhone" class="form-control" placeholder="017XXXXXXXX or +88017XXXXXXXX" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" title="Please enter a valid Bangladeshi phone number" required>
                          </div>
                        </div>

                        <div class="row g-3 mb-3">
                          <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Birth Month <span class="text-muted fw-normal">(Optional)</span></label>
                            <select name="birth_month" class="form-select">
                              <option value="">Month</option>
                              <option value="January">January</option>
                              <option value="February">February</option>
                              <option value="March">March</option>
                              <option value="April">April</option>
                              <option value="May">May</option>
                              <option value="June">June</option>
                              <option value="July">July</option>
                              <option value="August">August</option>
                              <option value="September">September</option>
                              <option value="October">October</option>
                              <option value="November">November</option>
                              <option value="December">December</option>
                            </select>
                          </div>
                          <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Birth Day <span class="text-muted fw-normal">(Optional)</span></label>
                            <select name="birth_day" class="form-select">
                              <option value="">Day</option>
                              <?php for ( $d = 1; $d <= 31; $d++ ) : ?>
                                <option value="<?php echo sprintf( '%02d', $d ); ?>"><?php echo sprintf( '%02d', $d ); ?></option>
                              <?php endfor; ?>
                            </select>
                          </div>
                        </div>

                        <div class="row g-3 mb-4">
                          <div class="col-md-12">
                            <label class="form-label small fw-bold text-dark">Email Address <span class="text-muted fw-normal">(Optional)</span></label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com (optional)">
                          </div>
                        </div>

                        <div class="form-check mb-4">
                          <input class="form-check-input" type="checkbox" id="termsCheck" checked required>
                          <label class="form-check-label small text-muted" for="termsCheck">
                            I agree to join Santino Coffee Club Regular Membership to receive reward stamps.
                          </label>
                        </div>

                        <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                          Register For Coffee Club Regular Membership →
                        </button>
                      </form>
                    </div>

                    <?php if ( class_exists( 'Santino_Membership_System' ) ) { echo Santino_Membership_System::render_today_offer_tab_pane(); } ?>

                  </div>
                </div>
              </div>

            </div>
          </div>
        </section>
        <?php
    }
}
