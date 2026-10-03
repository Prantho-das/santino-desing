<?php
/**
 * Template Name: Santino VIP Coffee Club Membership
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

if ( class_exists( '\Elementor\Plugin' ) && ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
else :
?>

<!-- MINIMAL CLEAN MEMBERSHIP HERO -->
  <section class="pro-banner-hero" style="background-image: url('<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>'); background-position: center; min-height: 52vh;">
    <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.45) 100%);"></div>
    <div class="pro-banner-glow-line"></div>
    
    <div class="container pro-banner-container" style="max-width: 680px;">
      
      <!-- Minimal Badge -->
      <div class="pro-banner-pill mb-3">
        <span class="pro-pulse-dot"></span>
        <span>SANTINO COFFEE CLUB</span>
      </div>

      <!-- Concise Headline -->
      <h1 class="pro-banner-title mb-2">
        Exclusive Connoisseur Privileges
      </h1>

      <!-- One-line Subtitle -->
      <p class="pro-banner-desc mb-4" style="max-width: 520px; font-size: 1.05rem;">
        Private cupping sessions, seasonal micro-lot allocations, and 15% VIP bean discounts.
      </p>

      <!-- Action Buttons -->
      <div class="pro-banner-actions">
        <a href="#joinClub" class="btn-hero-lifestyle">
          <span>Join Coffee Club</span>
          <i class="bi bi-gem"></i>
        </a>
        <a href="#perks" class="btn-hero-outline">
          <i class="bi bi-arrow-down-short fs-5 text-gold"></i>
          <span>Explore Perks</span>
        </a>
      </div>

    </div>
  </section>

  <!-- CLEAN SUBTLE STATS STRIP BELOW HERO -->
  <section class="py-4 border-bottom bg-white">
    <div class="container">
      <div class="row g-4 text-center justify-content-center">
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-gold font-heading" style="color: var(--santino-gold);">100% Free</div>
          <div class="small text-muted fw-bold text-uppercase">Club Enrollment</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">15% Off</div>
          <div class="small text-muted fw-bold text-uppercase">Retail Bean Privilege</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-teal font-heading" style="color: var(--santino-teal);">Priority</div>
          <div class="small text-muted fw-bold text-uppercase">Private Cupping Access</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">Monthly</div>
          <div class="small text-muted fw-bold text-uppercase">Exclusive Micro-Lots</div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5" id="perks" style="background-color: #fafafa;">
    <div class="container py-lg-4">
      
      <div class="text-center max-w-700 mx-auto mb-5 reveal">
        <span class="badge-tag-pill mb-2"><i class="bi bi-award-fill text-teal me-1"></i> MEMBER PRIVILEGES</span>
        <h2 class="display-6 font-heading fw-black text-dark mb-2">Crafted Exclusively For Coffee Lovers</h2>
        <p class="text-muted">Discover the elevated benefits designed to enrich every sip and connection with our roastery.</p>
      </div>

      <div class="row g-4 justify-content-center">
        
        <div class="col-lg-4 col-md-6 reveal" data-delay="100">
          <div class="p-4 bg-white rounded-4 border h-100 shadow-sm d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="fs-1 text-teal mb-3"><i class="bi bi-patch-check"></i></div>
              <h4 class="font-heading fw-bold text-dark mb-2">Priority Micro-Lot Reserves</h4>
              <p class="text-muted small mb-0">Exclusive access to limited-edition championship lots, Geisha reserves, and anaerobic single-origin coffees before public release.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 reveal" data-delay="150">
          <div class="p-4 bg-white rounded-4 border h-100 shadow-sm d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="fs-1 text-teal mb-3"><i class="bi bi-mortarboard"></i></div>
              <h4 class="font-heading fw-bold text-dark mb-2">Private Cupping Masterclasses</h4>
              <p class="text-muted small mb-0">Exclusive invitations to sensory cupping workshops led by certified SCA and WBC trainers at our Tejgaon roastery lab.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 reveal" data-delay="200">
          <div class="p-4 bg-white rounded-4 border h-100 shadow-sm d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="fs-1 text-teal mb-3"><i class="bi bi-gift"></i></div>
              <h4 class="font-heading fw-bold text-dark mb-2">Birthday Month Signature Treat</h4>
              <p class="text-muted small mb-0">Celebrate your special day with a complimentary handcrafted signature latte or single-origin pour-over at any branch.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 reveal" data-delay="100">
          <div class="p-4 bg-white rounded-4 border h-100 shadow-sm d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="fs-1 text-teal mb-3"><i class="bi bi-tag"></i></div>
              <h4 class="font-heading fw-bold text-dark mb-2">15% Off Roasted Whole Beans</h4>
              <p class="text-muted small mb-0">Enjoy preferential pricing on all 250g and 1kg bags of freshly roasted specialty coffee beans and filter packs.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 reveal" data-delay="150">
          <div class="p-4 bg-white rounded-4 border h-100 shadow-sm d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="fs-1 text-teal mb-3"><i class="bi bi-gear-wide-connected"></i></div>
              <h4 class="font-heading fw-bold text-dark mb-2">Home & Office Dial-In Support</h4>
              <p class="text-muted small mb-0">Complimentary virtual or in-person dial-in consultations with our technicians to optimize your home espresso grinder or drip brewer.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 reveal" data-delay="200">
          <div class="p-4 bg-white rounded-4 border h-100 shadow-sm d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="fs-1 text-teal mb-3"><i class="bi bi-lightning-charge"></i></div>
              <h4 class="font-heading fw-bold text-dark mb-2">Express Order Ahead</h4>
              <p class="text-muted small mb-0">Skip the line at busy morning hours through direct priority WhatsApp order-ahead service across all partner cafe branches.</p>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 3-TAB INTERACTIVE LOYALTY PORTAL -->
  <section class="py-5" id="clubPortal">
    <div class="container py-lg-4">
      
      <!-- Section Header -->
      <div class="text-center mb-5 reveal">
        <span class="badge-tag-pill mb-2"><i class="bi bi-cup-hot-fill text-teal me-1"></i> SANTINO LOYALTY REWARDS</span>
        <h2 class="display-6 font-heading fw-bold mb-2">Digital Coffee Stamp Card & Club Portal</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">
          Drink 5 Cups of specialty coffee at Santino partner cafes, submit your invoice number, and enjoy <strong>1 FREE Handcrafted Coffee</strong> on us!
        </p>

        <!-- Navigation Tabs -->
        <ul class="nav nav-pills justify-content-center gap-2 mt-4" id="loyaltyTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-pill px-4 py-2.5 fw-bold font-heading" id="stamps-tab" data-bs-toggle="pill" data-bs-target="#stamps-pane" type="button" role="tab">
              <i class="bi bi-cup-hot me-1"></i> My Coffee Stamp Card
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 py-2.5 fw-bold font-heading" id="invoice-tab" data-bs-toggle="pill" data-bs-target="#invoice-pane" type="button" role="tab">
              <i class="bi bi-receipt me-1"></i> Submit Invoice Number
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 py-2.5 fw-bold font-heading" id="register-tab" data-bs-toggle="pill" data-bs-target="#register-pane" type="button" role="tab">
              <i class="bi bi-person-plus me-1"></i> New VIP Registration
            </button>
          </li>
        </ul>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-8">
          
          <div class="tab-content" id="loyaltyTabsContent">

            <!-- TAB 1: DIGITAL STAMP CARD LOOKUP -->
            <div class="tab-pane fade show active" id="stamps-pane" role="tabpanel">
              <div class="p-4 p-md-5 rounded-4 bg-white border shadow-xl">
                <div class="text-center mb-4">
                  <h4 class="font-heading fw-bold mb-2">Check Your 5-Cup Stamp Card Status</h4>
                  <p class="text-muted small">Enter your Registered Phone Number or VIP Member ID to view your progress.</p>
                </div>

                <form id="santinoLookupForm" class="mb-4">
                  <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-telephone text-teal"></i></span>
                    <input type="text" name="query" class="form-control border-start-0 fs-6" placeholder="Enter Phone (e.g. 01613334514) or VIP ID" required>
                    <button type="submit" class="btn btn-dark px-4 fw-bold font-heading" style="background: var(--santino-teal); border: none;">
                      Check Stamps
                    </button>
                  </div>
                </form>

                <div id="liveStampCardContainer" style="display: none;"></div>
              </div>
            </div>

            <!-- TAB 2: SUBMIT COFFEE INVOICE -->
            <div class="tab-pane fade" id="invoice-pane" role="tabpanel">
              <div class="p-4 p-md-5 rounded-4 bg-white border shadow-xl">
                <div class="text-center mb-4">
                  <span class="badge bg-warning text-dark px-3 py-1.5 fw-bold text-uppercase mb-2">☕ BUY 5, GET 1 FREE</span>
                  <h4 class="font-heading fw-bold mb-2">Log Coffee Invoice / Memo Number</h4>
                  <p class="text-muted small">Enter the invoice number from your cafe receipt. Once verified by our admin, +1 cup will be stamped to your card!</p>
                </div>

                <div id="invoiceResponseBox" style="display: none;" class="mb-4"></div>

                <form id="santinoInvoiceForm">
                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Invoice / Memo Number *</label>
                      <input type="text" name="invoice_number" class="form-control form-control-lg rounded-3 fs-6" placeholder="e.g. SNT-2026-9042" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Your Phone Number / WhatsApp *</label>
                      <input type="tel" name="phone" class="form-control form-control-lg rounded-3 fs-6" placeholder="+880 1..." required>
                    </div>
                  </div>

                  <div class="row g-3 mb-4">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Cafe Branch Visited</label>
                      <select name="branch" class="form-select form-select-lg rounded-3 fs-6">
                        <option>Gulshan-2 Flagship Experience Center</option>
                        <option>Banani Borak Mehnur</option>
                        <option>Tejgaon Roastery & Lab</option>
                        <option>Dhanmondi Ahmed & Kazi Tower</option>
                        <option>Uttara Liberty Tower</option>
                        <option>Baridhara Diplomatic Enclave</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">VIP Member ID (If already registered)</label>
                      <input type="text" name="member_id" class="form-control form-control-lg rounded-3 fs-6" placeholder="e.g. SNT-VIP-XXXX">
                    </div>
                  </div>

                  <button type="submit" class="btn btn-dark w-100 py-3 fw-bold rounded-3 text-white font-heading text-uppercase shadow-lg hover-glow" style="background: var(--santino-teal); border: none; font-size: 15px;">
                    Submit Invoice for Stamp Verification →
                  </button>
                </form>
              </div>
            </div>

            <!-- TAB 3: REGISTER NEW VIP MEMBER -->
            <div class="tab-pane fade" id="register-pane" role="tabpanel">
              <div class="p-4 p-md-5 rounded-4 bg-white border shadow-xl">
                <div class="text-center mb-4">
                  <span class="badge-tag-pill mb-2"><i class="bi bi-person-check-fill text-teal me-1"></i> JOIN TODAY</span>
                  <h4 class="font-heading fw-bold mb-2">Register For Santino Coffee Club</h4>
                  <p class="text-muted small">Fill in your details below to activate your member privileges immediately.</p>
                </div>

                <div id="membershipResponseBox" style="display: none;" class="mb-4"></div>

                <form id="santinoMembershipForm">
                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Full Name *</label>
                      <input type="text" name="fullname" class="form-control form-control-lg rounded-3 fs-6" placeholder="Your Name" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Phone Number / WhatsApp *</label>
                      <input type="tel" name="phone" class="form-control form-control-lg rounded-3 fs-6" placeholder="+880 1..." required>
                    </div>
                  </div>

                  <div class="row g-3 mb-3">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Email Address *</label>
                      <input type="email" name="email" class="form-control form-control-lg rounded-3 fs-6" placeholder="name@email.com" required>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Cafe / Business / Organization</label>
                      <input type="text" name="business" class="form-control form-control-lg rounded-3 fs-6" placeholder="Company / Cafe Name">
                    </div>
                  </div>

                  <div class="row g-3 mb-4">
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Select VIP Membership Tier</label>
                      <select name="tier" class="form-select form-select-lg rounded-3 fs-6">
                        <option value="gold">Gold Roastery VIP (10% Beans Off + 1 Free AMC)</option>
                        <option value="silver">Silver Club (5% Beans Off)</option>
                        <option value="platinum">Platinum Enterprise (15% Off + 24/7 Support)</option>
                        <option value="barista">Barista Academy Pro</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label small fw-bold">Installed Coffee Equipment (Optional)</label>
                      <input type="text" name="machines" class="form-control form-control-lg rounded-3 fs-6" placeholder="e.g. Nuova Simonelli / Crem / Grinder">
                    </div>
                  </div>

                  <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="termsCheck" checked required>
                    <label class="form-check-label small text-muted" for="termsCheck">
                      I would like to receive invitations to private roastery cuppings and seasonal micro-lot announcements.
                    </label>
                  </div>

                  <button type="submit" class="btn btn-dark w-100 py-3 fw-bold rounded-3 text-white font-heading text-uppercase shadow-lg hover-glow" style="background: var(--santino-teal); border: none; font-size: 15px;">
                    Activate My Membership Privileges →
                  </button>
                </form>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>


  <section class="py-5 text-center text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #003633 0%, #004d49 50%, #002826 100%);">
    <div class="container py-4 position-relative" style="z-index: 2;">
      <span class="badge-tag-pill mb-3" style="background: rgba(195, 153, 108, 0.15) !important; border: 1px solid rgba(195, 153, 108, 0.4) !important; color: #dfbe8d !important; padding: 6px 18px; font-size: 11.5px; font-weight: 700; letter-spacing: 1.5px; border-radius: 50px; display: inline-flex; align-items: center;">
        <i class="bi bi-cup-hot-fill me-2" style="color: #c3996c;"></i> VISIT OUR CAFES
      </span>
      <h2 class="display-5 font-heading fw-bold text-white mb-3">Taste The Santino Difference</h2>
      <p class="text-white-50 mx-auto mb-4" style="max-width: 660px; font-size: 1.05rem; line-height: 1.7;">
        Discover our signature handcrafted beverages, artisanal roasts, and modern cafe ambiance across Dhaka.
      </p>
      <div class="d-flex justify-content-center">
        <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-hero-cta-teal">
          <span>Explore Drinks Menu</span>
          <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->

<?php\n<?php
endif;
get_footer();
