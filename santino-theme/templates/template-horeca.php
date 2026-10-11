<?php
/**
 * Template Name: Santino HoReCa Coffee & Hospitality Solutions
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

$is_elementor_page = false;
if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
    $document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
    if ( $document && $document->is_built_with_elementor() ) {
        $is_elementor_page = true;
    }
}

if ( $is_elementor_page ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
else :
?>

<style>
.horeca-page-wrap, body, p, .text-muted, .text-secondary, label, input, select, textarea {
  font-family: var(--kp-font-body, 'Plus Jakarta Sans', sans-serif);
}

.pro-banner-title,
.sec-title,
.font-heading,
h1, h2, h3, h4, h5, h6,
.sec-pill-badge,
.btn-hero-lifestyle,
.btn-hero-outline,
.metric-num,
.horeca-card-title {
  font-family: var(--kp-font-title, 'Montserrat', sans-serif) !important;
  letter-spacing: -0.3px;
}

.horeca-hero-banner {
  position: relative;
  background-image: url('<?php echo santino_img('bd-barista-latte-art.jpg'); ?>');
  background-size: cover;
  background-position: center 30%;
  min-height: 56vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 110px 20px 95px;
}

.horeca-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(0, 20, 18, 0.55) 0%, rgba(0, 45, 42, 0.88) 100%);
  z-index: 1;
}

.horeca-floating-stats {
  position: relative;
  z-index: 15;
  margin-top: -50px;
  padding-bottom: 25px;
}

.horeca-stat-card {
  background: #ffffff;
  border: 1.5px solid rgba(0, 98, 93, 0.12);
  border-radius: 22px;
  padding: 24px 18px;
  text-align: center;
  box-shadow: 0 14px 34px rgba(0, 77, 73, 0.07);
  transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.horeca-stat-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--santino-teal, #00625d), var(--santino-gold, #dfbe8d));
  opacity: 0;
  transition: opacity 0.3s ease;
}

.horeca-stat-card:hover {
  transform: translateY(-6px);
  border-color: rgba(0, 98, 93, 0.35);
  box-shadow: 0 20px 42px rgba(0, 98, 93, 0.15);
}

.horeca-stat-card:hover::before {
  opacity: 1;
}

.horeca-stat-icon {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: rgba(0, 98, 93, 0.06);
  color: var(--santino-teal, #00625d);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
  margin-bottom: 10px;
  transition: all 0.3s ease;
}

.horeca-stat-card:hover .horeca-stat-icon {
  background: var(--santino-teal, #00625d);
  color: #ffffff;
  transform: scale(1.1);
}

.horeca-stat-card .stat-num {
  font-size: 2.35rem;
  font-weight: 900;
  color: var(--santino-teal, #00625d);
  line-height: 1.1;
  margin-bottom: 4px;
}

.horeca-stat-card .stat-label {
  color: #4a5c57;
  font-size: 0.86rem;
  font-weight: 700;
  line-height: 1.4;
}

.horeca-sector-card {
  background: #ffffff;
  border: 1.5px solid rgba(0, 98, 93, 0.1);
  border-radius: 22px;
  padding: 34px 26px;
  height: 100%;
  transition: all 0.32s ease;
  box-shadow: 0 10px 30px rgba(0, 98, 93, 0.04);
  display: flex;
  flex-direction: column;
}

.horeca-sector-card:hover {
  transform: translateY(-6px);
  border-color: var(--santino-teal, #00625d);
  box-shadow: 0 18px 40px rgba(0, 98, 93, 0.12);
}

.horeca-sector-badge {
  display: inline-block;
  background: rgba(0, 98, 93, 0.08);
  color: var(--santino-teal, #00625d);
  font-family: var(--kp-font-title, 'Montserrat', sans-serif);
  font-size: 0.72rem;
  font-weight: 800;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 30px;
  margin-bottom: 14px;
  width: fit-content;
}

.horeca-pill-check {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: 0.92rem;
  color: #465853;
  margin-bottom: 10px;
  line-height: 1.55;
}

.horeca-pill-check i {
  color: var(--santino-teal, #00625d);
  font-size: 1.1rem;
  margin-top: 1px;
  flex-shrink: 0;
}
</style>

<div class="horeca-page-wrap">

  <!-- HERO SECTION -->
  <section class="horeca-hero-banner text-center position-relative">
    <div class="horeca-hero-overlay"></div>
    <div class="container position-relative" style="max-width: 820px; z-index: 3;">
      
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge light">
          <i class="bi bi-patch-check-fill me-1 text-warning"></i> HOSPITALITY &amp; FOODSERVICE EXCELLENCE
        </span>
        <span class="sec-pill-line"></span>
      </div>

      <h1 class="pro-banner-title mb-3" style="font-size: clamp(2.3rem, 4.5vw, 3.6rem); font-weight: 900; line-height: 1.18; color: #ffffff; text-shadow: 0 2px 14px rgba(0,0,0,0.5);">
        Turnkey HoReCa Coffee &amp; <span style="color: #dfbe8d;">Equipment Solutions</span>
      </h1>

      <p class="pro-banner-desc mb-4" style="max-width: 660px; font-size: 1.06rem; line-height: 1.65; color: rgba(255, 255, 255, 0.92); margin: 0 auto; text-shadow: 0 1px 8px rgba(0,0,0,0.5);">
        Equipping 5-star hotels, luxury resorts, fine dining restaurants, and high-volume specialty cafes across Bangladesh with precision Italian machinery, custom artisan roasting curves, and 24/7 priority SLA technical care.
      </p>

      <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
        <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#horecaQuoteModal">
          <span>Book HoReCa Consultation</span>
          <i class="bi bi-arrow-right"></i>
        </button>
        <a href="<?php echo esc_url( home_url( '/machines/' ) ); ?>" class="btn-hero-outline">
          <i class="bi bi-cpu-fill text-warning"></i>
          <span>View Commercial Machines</span>
        </a>
      </div>

    </div>
  </section>

  <!-- FLOATING STATS STRIP -->
  <div class="horeca-floating-stats">
    <div class="container">
      <div class="row g-3 g-md-4 text-center justify-content-center">
        <div class="col-lg-3 col-6">
          <div class="horeca-stat-card">
            <div class="horeca-stat-icon"><i class="bi bi-building"></i></div>
            <div class="stat-num">500+</div>
            <div class="stat-label">Hotels, Cafes &amp; Venues</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="horeca-stat-card">
            <div class="horeca-stat-icon"><i class="bi bi-clock-history"></i></div>
            <div class="stat-num">4 Hours</div>
            <div class="stat-label">Rapid On-Site SLA Response</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="horeca-stat-card">
            <div class="horeca-stat-icon"><i class="bi bi-cash-stack"></i></div>
            <div class="stat-num">Zero</div>
            <div class="stat-label">Capex Machine Leasing</div>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="horeca-stat-card">
            <div class="horeca-stat-icon"><i class="bi bi-shield-check"></i></div>
            <div class="stat-num">100%</div>
            <div class="stat-label">FSSC22000 &amp; SCA Certified</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- TRUSTED CLIENTS STRIP -->
  <section class="py-4 border-bottom bg-light">
    <div class="container text-center">
      <p class="text-uppercase small fw-bold text-muted mb-3" style="letter-spacing: 2px;">
        Trusted by Leading 5-Star Hotel Chains, Fine Dining Venues, BFC Outlets &amp; Corporate Hubs
      </p>
      <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 gap-md-5 text-secondary opacity-75 fs-6 fw-bold">
        <span><i class="bi bi-building me-2 text-success"></i> 5-STAR HOTELS &amp; RESORTS</span>
        <span><i class="bi bi-cup-hot-fill me-2 text-success"></i> SPECIALTY CAFE CHAINS</span>
        <span><i class="bi bi-shop me-2 text-success"></i> BFC FOODSERVICE OUTLETS</span>
        <span><i class="bi bi-cart3 me-2 text-success"></i> SHWAPNO SUPERSTORES</span>
        <span><i class="bi bi-award me-2 text-success"></i> DIPLOMATIC MISSIONS &amp; CLUBS</span>
      </div>
    </div>
  </section>

  <!-- 4 SECTOR VERTICALS -->
  <section class="py-5" style="background-color: #fbfbfb;">
    <div class="container py-lg-4">
      
      <div class="text-center max-w-700 mx-auto mb-5">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-diagram-3-fill me-1"></i> TAILORED SECTORS</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="sec-title mb-2">End-to-End Solutions for Every Hospitality Format</h2>
        <p class="text-muted mb-0" style="font-size: 1rem; max-width: 620px; line-height: 1.6; margin: 0 auto;">From high-traffic luxury hotel breakfast stations to artisanal single-origin espresso bars, we design custom workflows that maximize speed and flavor consistency.</p>
      </div>

      <div class="row g-4">
        
        <!-- Sector 1: Hotels & Resorts -->
        <div class="col-lg-6">
          <div class="horeca-sector-card">
            <span class="horeca-sector-badge">5-STAR HOSPITALITY</span>
            <h3 class="horeca-card-title fw-bold text-dark mb-3">Luxury Hotels &amp; Resorts</h3>
            <p class="text-muted small mb-4">Complete coffee ecosystem covering Executive Lounges, all-day dining breakfast buffets, in-room VIP service, and banquet halls.</p>
            
            <div class="row g-3 mb-4">
              <div class="col-sm-6">
                <div class="p-3 bg-light rounded-3">
                  <div class="fw-bold text-dark small mb-1"><i class="bi bi-cpu text-warning me-1"></i> Equipment Setup</div>
                  <div class="text-muted small">Victoria Arduino Black Eagle &amp; Kalerm Touch Automatics</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="p-3 bg-light rounded-3">
                  <div class="fw-bold text-dark small mb-1"><i class="bi bi-fire text-danger me-1"></i> Bean Selection</div>
                  <div class="text-muted small">Custom Hotel House Blends &amp; Single Origin Micro-lots</div>
                </div>
              </div>
            </div>

            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Zero Capex commercial machine rentals with complete maintenance included</span></div>
            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>High-output automatic thermal urns for rapid banquet guest service</span></div>
            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Executive boardroom tasting flights and VIP barista support</span></div>
          </div>
        </div>

        <!-- Sector 2: Specialty Cafes -->
        <div class="col-lg-6">
          <div class="horeca-sector-card">
            <span class="horeca-sector-badge">SPECIALTY COFFEE</span>
            <h3 class="horeca-card-title fw-bold text-dark mb-3">High-Volume Specialty Cafes &amp; Chains</h3>
            <p class="text-muted small mb-4">Engineered for peak-rush extraction precision, lightning-fast milk steaming, and flawless cup-to-cup consistency.</p>
            
            <div class="row g-3 mb-4">
              <div class="col-sm-6">
                <div class="p-3 bg-light rounded-3">
                  <div class="fw-bold text-dark small mb-1"><i class="bi bi-cpu text-warning me-1"></i> Flagship Machinery</div>
                  <div class="text-muted small">Nuova Simonelli Aurelia Wave &amp; Victoria Arduino Maverick</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="p-3 bg-light rounded-3">
                  <div class="fw-bold text-dark small mb-1"><i class="bi bi-mortarboard text-success me-1"></i> Barista Academy</div>
                  <div class="text-muted small">Barista calibration and latte art workflow certification</div>
                </div>
              </div>
            </div>

            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Gravimetric dosing and variable temperature control for SOE espresso</span></div>
            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>High-speed on-demand commercial grinders (Mythos One, Eureka Helios)</span></div>
            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Weekly fresh roast supply directly degassed and ready for brewing</span></div>
          </div>
        </div>

        <!-- Sector 3: Fine Dining & Restobars -->
        <div class="col-lg-6">
          <div class="horeca-sector-card">
            <span class="horeca-sector-badge">CULINARY &amp; DINING</span>
            <h3 class="horeca-card-title fw-bold text-dark mb-3">Fine Dining &amp; Premium Restobars</h3>
            <p class="text-muted small mb-4">Elevate after-dinner culinary memories with exquisite specialty coffee service, table-side pour-overs, and coffee cocktail pairings.</p>
            
            <div class="row g-3 mb-4">
              <div class="col-sm-6">
                <div class="p-3 bg-light rounded-3">
                  <div class="fw-bold text-dark small mb-1"><i class="bi bi-cup text-primary me-1"></i> Compact Commercial</div>
                  <div class="text-muted small">Victoria Arduino E1 Prima &amp; Crem EX3 Compact</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="p-3 bg-light rounded-3">
                  <div class="fw-bold text-dark small mb-1"><i class="bi bi-journal-check text-info me-1"></i> Sensory Menu</div>
                  <div class="text-muted small">Custom dessert and savory dinner pairing profiles</div>
                </div>
              </div>
            </div>

            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Silent grinding operations preserving elegant restaurant ambience</span></div>
            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Specialty manual brewing kit setups (V60, Chemex, Syphon, Cold Brew)</span></div>
            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Espresso martini and cold brew mixology support for bar staff</span></div>
          </div>
        </div>

        <!-- Sector 4: Event Catering & Bionic Robotics -->
        <div class="col-lg-6">
          <div class="horeca-sector-card">
            <span class="horeca-sector-badge">NEXT-GEN CATERING</span>
            <h3 class="horeca-card-title fw-bold text-dark mb-3">Institutional Catering &amp; Bionic Robotics</h3>
            <p class="text-muted small mb-4">Next-generation automated speed for mega corporate conventions, high-capacity catering events, and futuristic robotic barista kiosks.</p>
            
            <div class="row g-3 mb-4">
              <div class="col-sm-6">
                <div class="p-3 bg-light rounded-3">
                  <div class="fw-bold text-dark small mb-1"><i class="bi bi-robot text-danger me-1"></i> Robotics &amp; Urns</div>
                  <div class="text-muted small">CAYE Bionic Barista Robotic Arms &amp; 3TEMP High-Speed Brewers</div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="p-3 bg-light rounded-3">
                  <div class="fw-bold text-dark small mb-1"><i class="bi bi-lightning-charge text-warning me-1"></i> Capacity</div>
                  <div class="text-muted small">Up to 600+ fresh cups per hour with flawless consistency</div>
                </div>
              </div>
            </div>

            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Fully turnkey pop-up espresso bars with equipment, power, and staff</span></div>
            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>6-axis robotic arms delivering latte art in under 60 seconds</span></div>
            <div class="horeca-pill-check"><i class="bi bi-check-circle-fill"></i> <span>Guaranteed zero-downtime backup machinery on standby during events</span></div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- THE 5 SANTINO ADVANTAGES -->
  <section class="py-5 bg-white">
    <div class="container py-lg-4">
      
      <div class="text-center max-w-700 mx-auto mb-5">
        <div class="sec-pill-badge-wrap mb-2">
          <span class="sec-pill-line"></span>
          <span class="sec-pill-badge"><i class="bi bi-gem me-1 text-warning"></i> TOTAL SOLUTIONS</span>
          <span class="sec-pill-line"></span>
        </div>
        <h2 class="sec-title mb-2">Why Bangladesh’s Top Hospitality Brands Partner with Santino</h2>
        <p class="text-muted mb-0" style="font-size: 1rem; max-width: 600px; line-height: 1.6; margin: 0 auto;">We don’t just supply beans or machines — we take full responsibility for your daily beverage operation.</p>
      </div>

      <div class="row g-4 justify-content-center">
        
        <div class="col-lg-4 col-md-6">
          <div class="p-4 rounded-4 bg-light border h-100 text-center">
            <div class="vision-icon-wrap mx-auto mb-3" style="width: 58px; height: 58px; font-size: 24px; border-radius: 50%; background: rgba(0,98,93,0.08); color: var(--santino-teal); display: inline-flex; align-items: center; justify-content: center;">
              <i class="bi bi-shield-fill-check"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">Guaranteed 4-Hour SLA</h4>
            <p class="text-muted small mb-0">Our rapid response engineering fleet is available 24/7 across Dhaka and major divisions with backup standby units.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="p-4 rounded-4 bg-light border h-100 text-center">
            <div class="vision-icon-wrap mx-auto mb-3" style="width: 58px; height: 58px; font-size: 24px; border-radius: 50%; background: rgba(0,98,93,0.08); color: var(--santino-teal); display: inline-flex; align-items: center; justify-content: center;">
              <i class="bi bi-fire"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">Bespoke OEM Roasting</h4>
            <p class="text-muted small mb-0">Custom roast profiles created by master roasters with private label packaging under strict FSSC22000 food safety certifications.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="p-4 rounded-4 bg-light border h-100 text-center">
            <div class="vision-icon-wrap mx-auto mb-3" style="width: 58px; height: 58px; font-size: 24px; border-radius: 50%; background: rgba(0,98,93,0.08); color: var(--santino-teal); display: inline-flex; align-items: center; justify-content: center;">
              <i class="bi bi-mortarboard-fill"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">Staff &amp; Barista Academy</h4>
            <p class="text-muted small mb-0">SCA-certified continuous coaching for your restaurant hospitality staff covering milk steaming, hygiene, and grinder calibration.</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- CTA BANNER -->
  <section class="py-5 text-center text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #002d2a 0%, #004d49 50%, #002220 100%);">
    <div class="container py-4 position-relative" style="z-index: 2;">
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge light"><i class="bi bi-handshake me-1" style="color: #dfbe8d;"></i> ELEVATE YOUR GUEST EXPERIENCE</span>
        <span class="sec-pill-line"></span>
      </div>
      <h2 class="sec-title text-white mb-3">Ready to Upgrade Your Venue's Coffee Program?</h2>
      <p class="text-white-50 mx-auto mb-4" style="max-width: 660px; font-size: 1.05rem; line-height: 1.65;">
        Schedule an executive sensory cupping session, inspect our commercial espresso machinery in person, or request a customized HoReCa proposal.
      </p>
      <div class="d-flex justify-content-center flex-wrap gap-3">
        <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#horecaQuoteModal">
          <span>Request HoReCa Proposal</span>
          <i class="bi bi-arrow-right"></i>
        </button>
        <a href="<?php echo esc_url( home_url( '/office-cafe/' ) ); ?>" class="btn-hero-outline">
          <i class="bi bi-building text-warning"></i>
          <span>View Office Cafe Solutions</span>
        </a>
      </div>
    </div>
  </section>

  <!-- HORECA MODAL -->
  <div class="modal fade" id="horecaQuoteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content rounded-4 border-0 p-4 p-md-5 shadow-lg">
        <div class="modal-header border-0 pb-0">
          <div>
            <div class="sec-pill-badge-wrap mb-2">
              <span class="sec-pill-badge"><i class="bi bi-circle-fill"></i> HOSPITALITY INQUIRY</span>
            </div>
            <h3 class="modal-title font-heading fw-bold">Request HoReCa Coffee Proposal</h3>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body pt-3">
          <p class="text-muted small mb-4">
            Share your venue requirements below. A dedicated hospitality coffee consultant will contact you within 2 business hours.
          </p>

          <form class="santino-inquiry-form">
            <input type="hidden" name="inquiry_type" value="horeca_quote">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Venue / Business Name *</label>
                <input type="text" name="company" class="form-control rounded-pill px-3 py-2 border-1" placeholder="e.g. Grand Sultan Resort / Cafe Bistro" required style="border-color: #d5e5e0;">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Property Type *</label>
                <select name="location" class="form-select rounded-pill px-3 py-2 border-1" style="border-color: #d5e5e0;">
                  <option value="5-Star Hotel / Resort" selected>5-Star Hotel / Resort</option>
                  <option value="Specialty Cafe / Chain">Specialty Cafe / Chain</option>
                  <option value="Fine Dining Restaurant">Fine Dining Restaurant</option>
                  <option value="Catering & Banquet Facility">Catering &amp; Banquet Facility</option>
                  <option value="Cloud Kitchen & Quick Service">Cloud Kitchen &amp; Quick Service</option>
                </select>
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Contact Person Name *</label>
                <input type="text" name="name" class="form-control rounded-pill px-3 py-2 border-1" placeholder="General Manager / F&amp;B Director" required style="border-color: #d5e5e0;">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Phone Number / WhatsApp *</label>
                <input type="tel" name="phone" class="form-control rounded-pill px-3 py-2 border-1" placeholder="+880 1711-000000" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" required style="border-color: #d5e5e0;">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Official Work Email *</label>
                <input type="email" name="email" class="form-control rounded-pill px-3 py-2 border-1" placeholder="fb@hotel.com" required style="border-color: #d5e5e0;">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Primary Requirement</label>
                <select name="service" class="form-select rounded-pill px-3 py-2 border-1" style="border-color: #d5e5e0;">
                  <option value="Turnkey Commercial Machine Leasing">Turnkey Commercial Machine Leasing</option>
                  <option value="Wholesale Specialty Roasted Beans (OEM)">Wholesale Specialty Roasted Beans (OEM)</option>
                  <option value="Barista & Staff Training Academy">Barista &amp; Staff Training Academy</option>
                  <option value="24/7 Machine Maintenance AMC">24/7 Machine Maintenance AMC</option>
                  <option value="Complete Coffee Corner Setup">Complete Coffee Corner Setup</option>
                </select>
              </div>
            </div>

            <button type="submit" class="btn-hero-lifestyle w-100 py-3 mt-2 font-heading fw-bold text-uppercase">
              SUBMIT HORECA INQUIRY
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
endif;
get_footer();
