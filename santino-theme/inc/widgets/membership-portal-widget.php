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
          background: linear-gradient(180deg, #f8faf9 0%, #edf3f1 100%);
          position: relative;
        }
        .vip-card-surface {
          background: linear-gradient(135deg, #004d49 0%, #002d2b 60%, #011d1c 100%);
          border: 1px solid rgba(195, 153, 108, 0.4);
          border-radius: 20px;
          color: #ffffff;
          padding: 28px;
          position: relative;
          overflow: hidden;
          box-shadow: 0 20px 40px rgba(0, 77, 73, 0.22);
        }
        .vip-card-watermark {
          position: absolute;
          right: -25px;
          bottom: -35px;
          font-size: 160px;
          color: rgba(255, 255, 255, 0.04);
          pointer-events: none;
          z-index: 1;
        }
        .gold-chip {
          width: 42px;
          height: 32px;
          border-radius: 6px;
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 50%, #b88a59 100%);
          border: 1px solid rgba(255,255,255,0.4);
          display: inline-block;
        }
        .stamp-slot {
          width: 44px;
          height: 44px;
          border-radius: 50%;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          font-size: 18px;
        }
        .stamp-slot.active {
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
          color: #002d2b;
          border: 2px solid #ffffff;
        }
        .stamp-slot.empty {
          background: rgba(255, 255, 255, 0.08);
          border: 1.5px dashed rgba(195, 153, 108, 0.4);
          color: rgba(255, 255, 255, 0.4);
          font-size: 13px;
          font-weight: 700;
        }
        .stamp-slot.reward {
          background: linear-gradient(135deg, #dfbe8d 0%, #c3996c 100%);
          border: 2px solid #ffffff;
        }
        .portal-tabs .nav-link {
          color: #4b6360;
          background: #ffffff;
          border: 1px solid #dbe5e2;
          border-radius: 12px;
          padding: 10px 18px;
          font-weight: 700;
          font-size: 13.5px;
        }
        .portal-tabs .nav-link.active {
          background: #00625d !important;
          color: #ffffff !important;
          border-color: #00625d !important;
        }
        .portal-card {
          background: #ffffff;
          border: 1px solid #dbe5e2;
          border-radius: 20px;
          box-shadow: 0 15px 35px rgba(0, 77, 73, 0.06);
        }
        .btn-portal-submit {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          border: none;
          border-radius: 10px;
          font-weight: 700;
          letter-spacing: 0.5px;
          padding: 14px 24px;
          transition: background 0.3s ease;
        }
        .btn-portal-submit:hover {
          background: #004d49;
          color: #ffffff;
        }
        .portal-lookup-group {
          background: #ffffff;
          border-radius: 50px;
          padding: 6px 8px 6px 20px;
          display: flex;
          align-items: center;
          gap: 12px;
          border: 1.5px solid #d8e5e1;
        }
        .portal-lookup-field {
          flex: 1;
          display: flex;
          align-items: center;
          gap: 10px;
        }
        .portal-lookup-field input {
          border: none;
          outline: none;
          width: 100%;
          font-size: 0.95rem;
          color: #333;
          background: transparent;
        }
        .btn-lookup-action {
          background: var(--santino-teal, #00625d);
          color: #ffffff;
          border: none;
          padding: 10px 22px;
          border-radius: 50px;
          font-weight: 700;
          font-size: 12px;
          letter-spacing: 0.5px;
          text-transform: uppercase;
          display: inline-flex;
          align-items: center;
          gap: 6px;
          cursor: pointer;
        }
        </style>

        <section class="py-5 club-portal-section position-relative overflow-hidden" id="clubPortal">
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

                    <div class="p-3 rounded-4 mb-3 position-relative" style="background: rgba(0, 0, 0, 0.25); border: 1px solid rgba(195, 153, 108, 0.25); z-index: 2;">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small fw-bold" style="color: #dfbe8d; font-size: 11.5px;">5-Cup Stamp Card Tracker</span>
                        <span class="badge rounded-pill" style="background: rgba(195, 153, 108, 0.25); color: #dfbe8d; font-size: 10px;">BUY 5, GET 1 FREE</span>
                      </div>
                      
                      <div class="d-flex justify-content-between align-items-center py-2 px-1">
                        <div class="text-center">
                          <div class="stamp-slot active mb-1">☕</div>
                          <div style="font-size: 9.5px; color: #dfbe8d;">Cup 1</div>
                        </div>
                        <div class="text-center">
                          <div class="stamp-slot active mb-1">☕</div>
                          <div style="font-size: 9.5px; color: #dfbe8d;">Cup 2</div>
                        </div>
                        <div class="text-center">
                          <div class="stamp-slot empty mb-1">3</div>
                          <div class="text-white-50" style="font-size: 9.5px;">Cup 3</div>
                        </div>
                        <div class="text-center">
                          <div class="stamp-slot empty mb-1">4</div>
                          <div class="text-white-50" style="font-size: 9.5px;">Cup 4</div>
                        </div>
                        <div class="text-center">
                          <div class="stamp-slot empty mb-1">5</div>
                          <div class="text-white-50" style="font-size: 9.5px;">Cup 5</div>
                        </div>
                        <div class="text-center">
                          <div class="stamp-slot reward mb-1"><i class="bi bi-gift-fill" style="color: #002d2b; font-size: 16px;"></i></div>
                          <div style="font-size: 9.5px; color: #dfbe8d; font-weight: 700;">FREE #6</div>
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center text-white-50 small position-relative" style="z-index: 2; font-size: 11px;">
                      <span>Valid across all Dhaka branches</span>
                      <span style="color: #dfbe8d;"><i class="bi bi-patch-check-fill me-1"></i> Auto-Verified</span>
                    </div>
                  </div>

                  <div class="p-3 bg-white rounded-4 border shadow-sm">
                    <div class="row g-2 text-center">
                      <div class="col-4">
                        <div class="fs-4 text-teal mb-1"><i class="bi bi-cup-hot"></i></div>
                        <div class="fw-bold small text-dark">1. Sip Coffee</div>
                        <div class="text-muted" style="font-size: 10px;">At partner cafes</div>
                      </div>
                      <div class="col-4 border-start border-end">
                        <div class="fs-4 text-teal mb-1"><i class="bi bi-receipt"></i></div>
                        <div class="fw-bold small text-dark">2. Log Memo</div>
                        <div class="text-muted" style="font-size: 10px;">Submit invoice &amp; cups</div>
                      </div>
                      <div class="col-4">
                        <div class="fs-4 text-teal mb-1" style="color: #c3996c !important;"><i class="bi bi-gift"></i></div>
                        <div class="fw-bold small text-dark">3. Get Free Cup</div>
                        <div class="text-muted" style="font-size: 10px;">Buy 5, Get 1 Free</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-7">
                <div class="portal-card p-4 p-md-5 h-100 d-flex flex-column justify-content-between">
                  <ul class="nav nav-pills portal-tabs gap-2 mb-4 justify-content-start" id="loyaltyTabs" role="tablist">
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
                          <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Birth Month *</label>
                            <select name="birth_month" class="form-select" required>
                              <option value="">Select Birth Month</option>
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
                          <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Birth Day *</label>
                            <select name="birth_day" class="form-select" required>
                              <option value="">Select Birth Day</option>
                              <?php for ( $d = 1; $d <= 31; $d++ ) : ?>
                                <option value="<?php echo sprintf( '%02d', $d ); ?>"><?php echo sprintf( '%02d', $d ); ?></option>
                              <?php endfor; ?>
                            </select>
                          </div>
                        </div>

                        <div class="row g-3 mb-4">
                          <div class="col-md-12">
                            <label class="form-label small fw-bold text-dark">Email Address *</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
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
