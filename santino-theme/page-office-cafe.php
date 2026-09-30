<?php
/**
 * Template Name: Santino Corporate Office & HoReCa Coffee Solutions
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

// Elementor builder compatibility check
if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor() ) :
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
else :
?>

<!-- MINIMAL CLEAN OFFICE CAFE HERO -->
  <section class="pro-banner-hero" style="background-image: url('<?php echo santino_img('bd-office-coffee.jpg'); ?>'); background-position: center; min-height: 52vh;">
    <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.45) 100%);"></div>
    <div class="pro-banner-glow-line"></div>
    
    <div class="container pro-banner-container" style="max-width: 680px;">
      
      <!-- Minimal Badge -->
      <div class="pro-banner-pill mb-3">
        <span class="pro-pulse-dot"></span>
        <span>ENTERPRISE WORKPLACE SOLUTIONS</span>
      </div>

      <!-- Concise Headline -->
      <h1 class="pro-banner-title mb-2">
        Enterprise Office Coffee Solutions
      </h1>

      <!-- One-line Subtitle -->
      <p class="pro-banner-desc mb-4" style="max-width: 520px; font-size: 1.05rem;">
        Automated bean-to-cup stations, master roasted beans, and zero capex leasing.
      </p>

      <!-- Action Buttons -->
      <div class="pro-banner-actions">
        <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#corporateQuoteModal">
          <span>Book Free Office Trial</span>
          <i class="bi bi-cup-hot-fill"></i>
        </button>
        <a href="#calculator" class="btn-hero-outline">
          <i class="bi bi-calculator fs-5 text-gold"></i>
          <span>Savings Calculator</span>
        </a>
      </div>

    </div>
  </section>

  <!-- CLEAN SUBTLE STATS STRIP BELOW HERO -->
  <section class="py-4 border-bottom bg-white">
    <div class="container">
      <div class="row g-4 text-center justify-content-center">
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">150+</div>
          <div class="small text-muted fw-bold text-uppercase">Corporate Offices</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-teal font-heading" style="color: var(--santino-teal);">4 Hours</div>
          <div class="small text-muted fw-bold text-uppercase">Rapid Tech SLA</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">Zero</div>
          <div class="small text-muted fw-bold text-uppercase">Machine Capex</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-gold font-heading" style="color: var(--santino-gold);">100%</div>
          <div class="small text-muted fw-bold text-uppercase">Managed Service</div>
        </div>
      </div>
    </div>
  </section>

      </div>
    </div>
  </section>

  <!-- 2. TRUSTED BY INDUSTRY LEADERS MARQUEE -->
  <section class="py-4 border-bottom bg-light reveal">
    <div class="container text-center">
      <p class="text-uppercase small fw-bold text-muted mb-3" style="letter-spacing: 2px;">
        Trusted by 150+ Leading Multinational HQs, Banks, Embassies & Coworking Hubs Across Bangladesh
      </p>
      <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 gap-md-5 text-secondary opacity-75 fs-6 fw-bold">
        <span><i class="bi bi-building me-2 text-teal"></i> MULTINATIONAL TECH HUBS</span>
        <span><i class="bi bi-bank me-2 text-teal"></i> INVESTMENT BANKS</span>
        <span><i class="bi bi-briefcase me-2 text-teal"></i> EMBASSIES & DIPLOMATIC MISSIONS</span>
        <span><i class="bi bi-hospital me-2 text-teal"></i> 5-STAR HOTELS & RESORTS</span>
        <span><i class="bi bi-laptop me-2 text-teal"></i> LUXURY COWORKING NETWORKS</span>
      </div>
    </div>
  </section>

  <!-- 3. THE SANTINO ADVANTAGE - 7 PILLARS (North End Style) -->
  <section class="py-5" style="background-color: #fbfbfb;">
    <div class="container py-lg-4">
      
      <div class="text-center max-w-700 mx-auto mb-5 reveal">
        <span class="corp-badge-pill mb-2"><i class="bi bi-star-fill text-gold me-1"></i> THE SANTINO ADVANTAGE</span>
        <h2 class="display-6 font-heading fw-black text-dark mb-2">Why Leading Companies Partner With Santino</h2>
        <p class="text-muted">A full-spectrum coffee infrastructure built around your workflow, company scale, and daily cup volume.</p>
      </div>

      <!-- 7 Pillars Grid -->
      <div class="row g-4 justify-content-center">
        
        <!-- Pillar 1 -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="100">
          <div class="corp-pillar-card hover-lift">
            <div class="corp-icon-box">
              <i class="bi bi-award"></i>
            </div>
            <h4 class="font-heading fw-bold mb-2 text-dark">Specialty Grade Beans</h4>
            <p class="text-muted small mb-0">Direct-trade, Rainforest Alliance certified 100% Arabica & balanced Robusta micro-lots sourced ethically from Brazil, Colombia, Ethiopia, and Sumatra.</p>
          </div>
        </div>

        <!-- Pillar 2 -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="150">
          <div class="corp-pillar-card hover-lift">
            <div class="corp-icon-box">
              <i class="bi bi-fire"></i>
            </div>
            <h4 class="font-heading fw-bold mb-2 text-dark">In-House Master Roastery</h4>
            <p class="text-muted small mb-0">Roasted in small batches under strict FSSC22000 international food safety standards to preserve delicate aromatic oils and peak sweetness.</p>
          </div>
        </div>

        <!-- Pillar 3 -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="200">
          <div class="corp-pillar-card hover-lift">
            <div class="corp-icon-box">
              <i class="bi bi-sliders"></i>
            </div>
            <h4 class="font-heading fw-bold mb-2 text-dark">Tailored Signature Blends</h4>
            <p class="text-muted small mb-0">Our master roasters create custom roast profiles and flavor notes specifically curated for your team’s taste and executive boardroom guests.</p>
          </div>
        </div>

        <!-- Pillar 4 -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="100">
          <div class="corp-pillar-card hover-lift">
            <div class="corp-icon-box">
              <i class="bi bi-cpu"></i>
            </div>
            <h4 class="font-heading fw-bold mb-2 text-dark">World-Class Italian Machines</h4>
            <p class="text-muted small mb-0">Precision commercial espresso machines and intelligent touch automatics from Victoria Arduino, Nuova Simonelli, Kalerm, and CAYE Robotics.</p>
          </div>
        </div>

        <!-- Pillar 5 -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="150">
          <div class="corp-pillar-card hover-lift">
            <div class="corp-icon-box">
              <i class="bi bi-mortarboard"></i>
            </div>
            <h4 class="font-heading fw-bold mb-2 text-dark">Staff & Pantry Barista Training</h4>
            <p class="text-muted small mb-0">Comprehensive training modules for your pantry hospitality staff covering milk texture, dial-in extraction, hygiene, and signature recipe execution.</p>
          </div>
        </div>

        <!-- Pillar 6 -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="200">
          <div class="corp-pillar-card hover-lift">
            <div class="corp-icon-box">
              <i class="bi bi-headset"></i>
            </div>
            <h4 class="font-heading fw-bold mb-2 text-dark">24/7 Rapid Technical Response</h4>
            <p class="text-muted small mb-0">Guaranteed 4-hour on-site response time across Dhaka and Chittagong with instant replacement standby units to ensure zero downtime.</p>
          </div>
        </div>

        <!-- Pillar 7 -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="250">
          <div class="corp-pillar-card hover-lift">
            <div class="corp-icon-box">
              <i class="bi bi-shield-check"></i>
            </div>
            <h4 class="font-heading fw-bold mb-2 text-dark">Preventive Care & Supervision</h4>
            <p class="text-muted small mb-0">Scheduled monthly sanitization, water filtration testing, scale decalcification, and grinder burr calibration included with zero extra charges.</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 4. INTERACTIVE ROI & COFFEE ESTIMATOR CALCULATOR -->
  <section class="py-5" id="calculator" style="background-color: #fbf9f5;">
    <div class="container py-lg-4">
      
      <div class="bg-white rounded-4 p-4 p-md-5 shadow-sm border reveal" style="border-color: rgba(0, 98, 93, 0.12) !important;">
        <div class="row align-items-center g-5">
          
          <div class="col-lg-6">
            <span class="badge-tag-pill mb-3"><i class="bi bi-calculator me-1"></i> WORKPLACE ROI ESTIMATOR</span>
            <h2 class="display-6 font-heading fw-bold text-dark mb-3">Calculate Your Monthly Workplace Coffee Savings</h2>
            <p class="text-muted mb-4" style="font-size: 0.98rem; line-height: 1.6;">
              Compare the true cost of employee takeaway cafe runs and single-use capsules with Santino’s fully managed bean-to-cup office solution.
            </p>

            <div class="mb-4 bg-light p-4 rounded-4 border">
              <label class="form-label text-dark fw-bold d-flex justify-content-between align-items-center mb-2">
                <span>Select Office Team Size:</span>
                <span id="staffCountText" class="fw-black fs-5" style="color: var(--santino-teal);">50 Employees</span>
              </label>
              <input type="range" class="form-range" id="staffRange" min="10" max="300" step="10" value="50" oninput="updateCalculator(this.value)" style="accent-color: var(--santino-teal); height: 8px;">
              <div class="d-flex justify-content-between text-muted small mt-2 fw-semibold">
                <span>10 Staff (Boutique)</span>
                <span>150 Staff (HQ)</span>
                <span>300+ (Enterprise)</span>
              </div>
            </div>

            <div class="p-3 rounded-3 bg-light border text-muted small d-flex align-items-start gap-2">
              <i class="bi bi-info-circle-fill text-teal mt-0.5" style="color: var(--santino-teal);"></i>
              <span>Calculated based on 2 cups per employee daily, eliminating 30+ minutes coffee away-time.</span>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="row g-3">
              
              <div class="col-sm-6">
                <div class="p-4 rounded-4 bg-light border text-center hover-lift h-100">
                  <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Est. Daily Cups</div>
                  <div class="display-6 fw-black mb-1" id="dailyCupsDisplay" style="color: var(--santino-teal); font-family: var(--kp-font-title);">100</div>
                  <div class="text-muted small">Fresh Barista Servings</div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="p-4 rounded-4 bg-light border text-center hover-lift h-100">
                  <div class="text-muted small text-uppercase fw-bold mb-1" style="font-size: 11px; letter-spacing: 0.5px;">Monthly Beans</div>
                  <div class="display-6 fw-black mb-1" id="monthlyBeansDisplay" style="color: var(--santino-gold); font-family: var(--kp-font-title);">22 kg</div>
                  <div class="text-muted small">Specialty Fresh Roast</div>
                </div>
              </div>

              <div class="col-12">
                <div class="p-4 rounded-4 text-start shadow-sm" style="background: linear-gradient(135deg, #003a37 0%, #005a54 100%); color: #ffffff;">
                  <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                    <span class="text-white fw-bold">Est. Monthly Savings vs Cafes:</span>
                    <span class="fw-black fs-3" id="monthlySavingsDisplay" style="color: #f9cb53;">৳ 65,000+</span>
                  </div>
                  <div class="small mb-4" style="color: rgba(255,255,255,0.85);">
                    Recommended Setup: <strong class="text-white" id="recMachineDisplay">Kalerm Touch Auto (Dual Milk)</strong>
                  </div>
                  <button class="btn-hero-lifestyle w-100" data-bs-toggle="modal" data-bs-target="#corporateQuoteModal" style="background: var(--santino-gold) !important; border-color: var(--santino-gold) !important;">
                    <span>Claim This Setup For 7-Day Trial</span>
                    <i class="bi bi-arrow-right"></i>
                  </button>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- 5. COMPARISON MATRIX: SANTINO VS PODS / VENDING -->
  <section class="py-5 bg-light">
    <div class="container py-lg-4">
      
      <div class="text-center max-w-700 mx-auto mb-5 reveal">
        <span class="corp-badge-pill mb-2"><i class="bi bi-arrow-left-right text-gold me-1"></i> HEAD-TO-HEAD</span>
        <h2 class="display-6 font-heading fw-black text-dark mb-2">Santino Managed Office vs Traditional Solutions</h2>
        <p class="text-muted">Why modern organizations are retiring single-use capsules and powdered vending machines.</p>
      </div>

      <div class="table-responsive reveal">
        <table class="corp-comparison-table">
          <thead>
            <tr>
              <th style="width: 30%;">Features & Standards</th>
              <th class="table-highlight-col text-center" style="width: 35%;">Santino Managed Office Solution</th>
              <th class="text-center text-muted" style="width: 17.5%;">Nespresso / Pods</th>
              <th class="text-center text-muted" style="width: 17.5%;">Instant Vending</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="fw-bold">Coffee Bean Quality</td>
              <td class="table-highlight-col text-center fw-bold text-teal"><i class="bi bi-check-circle-fill text-success me-1"></i> 100% Freshly Roasted Micro-lots</td>
              <td class="text-center text-muted">Stale Pre-ground Capsules</td>
              <td class="text-center text-muted">Instant Powder Premix</td>
            </tr>
            <tr>
              <td class="fw-bold">Fresh Milk Frothing</td>
              <td class="table-highlight-col text-center fw-bold text-teal"><i class="bi bi-check-circle-fill text-success me-1"></i> Real Steamed Fresh Milk (Silky Microfoam)</td>
              <td class="text-center text-muted">Separate Whisk or Manual</td>
              <td class="text-center text-muted">Chemical Powdered Milk</td>
            </tr>
            <tr>
              <td class="fw-bold">Equipment Capital Cost (Capex)</td>
              <td class="table-highlight-col text-center fw-bold text-teal"><i class="bi bi-check-circle-fill text-success me-1"></i> ৳ 0 (Zero Capex On Rental/Commitment)</td>
              <td class="text-center text-muted">High Upfront Machine Cost</td>
              <td class="text-center text-muted">High Purchase Cost</td>
            </tr>
            <tr>
              <td class="fw-bold">Cost Per Cup</td>
              <td class="table-highlight-col text-center fw-bold text-teal"><i class="bi bi-check-circle-fill text-success me-1"></i> ৳ 25 – ৳ 45 (Specialty Grade)</td>
              <td class="text-center text-muted">৳ 120 – ৳ 160 per pod</td>
              <td class="text-center text-muted">৳ 20 – ৳ 30 (Poor Quality)</td>
            </tr>
            <tr>
              <td class="fw-bold">Technical Maintenance & Repairs</td>
              <td class="table-highlight-col text-center fw-bold text-teal"><i class="bi bi-check-circle-fill text-success me-1"></i> 4-Hour On-Site SLA + Free Replacements</td>
              <td class="text-center text-muted">Self-Service / Long Warranty Delays</td>
              <td class="text-center text-muted">Frequent Jams & Poor Support</td>
            </tr>
            <tr>
              <td class="fw-bold">Environmental Sustainability</td>
              <td class="table-highlight-col text-center fw-bold text-teal"><i class="bi bi-check-circle-fill text-success me-1"></i> 100% Compostable Grounds & Recyclable Bags</td>
              <td class="text-center text-danger"><i class="bi bi-x-circle-fill text-danger me-1"></i> High Single-Use Plastic Waste</td>
              <td class="text-center text-muted">Plastic/Paper Cup Waste</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </section>

  <!-- 6. TAILORED PACKAGES & PLANS -->
  <section class="py-5" id="packages">
    <div class="container py-lg-4">
      
      <div class="text-center max-w-700 mx-auto mb-5 reveal">
        <span class="corp-badge-pill mb-2"><i class="bi bi-layers text-gold me-1"></i> CORPORATE PLANS</span>
        <h2 class="display-6 font-heading fw-black text-dark mb-2">Tailored Office Coffee Programs</h2>
        <p class="text-muted">Flexible monthly rental or bean-commitment packages designed for companies of every scale.</p>
      </div>

      <div class="row g-4 align-items-stretch">
        
        <!-- Package 1: Boutique -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="100">
          <div class="corp-plan-card hover-lift">
            <div>
              <span class="badge bg-light text-dark border mb-3 px-3 py-1">10 – 30 EMPLOYEES</span>
              <h3 class="font-heading fw-bold mb-1 text-dark">Boutique & Studio Hub</h3>
              <p class="text-muted small mb-4">Ideal for creative agencies, consultancies, law firms, and executive boardrooms.</p>
              
              <div class="p-3 bg-light rounded-3 mb-4">
                <div class="fw-bold text-dark font-heading">Kalerm Touch Auto</div>
                <div class="text-muted small">One-Touch Fresh Bean-To-Cup & Latte</div>
              </div>

              <ul class="list-unstyled d-flex flex-column gap-3 small text-dark mb-4">
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>5kg - 10kg Monthly:</strong> Freshly roasted single origins</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Zero Capex:</strong> Complimentary machine setup</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Monthly Sanitization:</strong> Automatic descaling & tuning</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Pantry Induction:</strong> Machine operation guidance</li>
              </ul>
            </div>

            <button class="btn btn-outline-dark w-100 py-3 fw-bold rounded-3 font-heading" data-bs-toggle="modal" data-bs-target="#corporateQuoteModal">
              Book Boutique Trial
            </button>
          </div>
        </div>

        <!-- Package 2: Corporate Floor (Featured) -->
        <div class="col-lg-4 col-md-6 reveal" data-delay="200">
          <div class="corp-plan-card featured hover-lift">
            <div class="popular-tag">MOST POPULAR WORKPLACE PLAN</div>
            <div>
              <span class="badge mb-3 px-3 py-1 text-white" style="background: var(--santino-teal);">30 – 120+ EMPLOYEES</span>
              <h3 class="font-heading fw-bold mb-1 text-dark">Corporate Floor & Tech Hub</h3>
              <p class="text-muted small mb-4">High-throughput automated dual-grinder system delivering 200+ specialty cups daily.</p>
              
              <div class="p-3 rounded-3 mb-4" style="background: rgba(0, 98, 93, 0.08);">
                <div class="fw-bold font-heading" style="color: var(--santino-teal);">Kalerm X400 / Rex Royal</div>
                <div class="text-muted small">Dual Hoppers, Microfoam Wand & Rapid Steam</div>
              </div>

              <ul class="list-unstyled d-flex flex-column gap-3 small text-dark mb-4">
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>15kg - 30kg Monthly:</strong> Signature specialty blends</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>4-Hour On-Site SLA:</strong> 24/7 priority technician backup</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Staff Barista Workshop:</strong> Certified training in our academy</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Complimentary Starter Kit:</strong> DaVinci gourmet syrups & accessories</li>
              </ul>
            </div>

            <button class="btn btn-dark w-100 py-3 fw-bold rounded-3 text-white font-heading shadow-md hover-glow" style="background: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#corporateQuoteModal">
              Book 7-Day Free Trial →
            </button>
          </div>
        </div>

        <!-- Package 3: Enterprise & Hotels -->
        <div class="col-lg-4 col-md-12 reveal" data-delay="300">
          <div class="corp-plan-card hover-lift">
            <div>
              <span class="badge bg-dark text-white mb-3 px-3 py-1">120 – 500+ EMPLOYEES</span>
              <h3 class="font-heading fw-bold mb-1 text-dark">Enterprise HQ & Hospitality</h3>
              <p class="text-muted small mb-4">Full multi-group Italian espresso bar, multi-floor deployment, or CAYE robotic kiosk.</p>
              
              <div class="p-3 bg-light rounded-3 mb-4">
                <div class="fw-bold text-dark font-heading">Victoria Arduino / CAYE Bionic</div>
                <div class="text-muted small">Multi-Station High-Volume Commercial Powerhouse</div>
              </div>

              <ul class="list-unstyled d-flex flex-column gap-3 small text-dark mb-4">
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>50kg+ Wholesale Roasts:</strong> Direct weekly batch schedule</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Dedicated Account Manager:</strong> Auto-replenishment logistics</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Full Barista Placement:</strong> Optional trained barista supply</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> <strong>Executive Boardroom Service:</strong> Specialty tasting flights</li>
              </ul>
            </div>

            <button class="btn btn-outline-dark w-100 py-3 fw-bold rounded-3 font-heading" data-bs-toggle="modal" data-bs-target="#corporateQuoteModal">
              Consult Enterprise Team
            </button>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- 7. BANNER STATEMENT -->
  <section class="py-5 text-center text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #003633 0%, #004d49 50%, #002826 100%);">
    <div class="container py-4 position-relative" style="z-index: 2;">
      <span class="badge-tag-pill mb-3" style="background: rgba(195, 153, 108, 0.15) !important; border: 1px solid rgba(195, 153, 108, 0.4) !important; color: #dfbe8d !important; padding: 6px 18px; font-size: 11.5px; font-weight: 700; letter-spacing: 1.5px; border-radius: 50px; display: inline-flex; align-items: center;">
        <i class="bi bi-briefcase-fill me-2" style="color: #c3996c;"></i> PARTNER WITH SANTINO
      </span>
      <h2 class="display-5 font-heading fw-bold text-white mb-3">Our Business is Supporting Your Business</h2>
      <p class="text-white-50 mx-auto mb-4" style="max-width: 660px; font-size: 1.05rem; line-height: 1.7;">
        Fuel your employees with world-class coffee every day. Experience 7 days of seamless corporate coffee without any upfront commitment.
      </p>
      <div class="d-flex justify-content-center">
        <button class="btn-hero-cta-teal" data-bs-toggle="modal" data-bs-target="#corporateQuoteModal">
          <span>Request Free 7-Day Office Trial</span>
          <i class="bi bi-arrow-right"></i>
        </button>
      </div>
    </div>
  </section>


  <!-- CORPORATE QUOTE & TRIAL MODAL -->
  <div class="modal fade" id="corporateQuoteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content rounded-4 border-0 p-4 p-md-5">
        
        <div class="modal-header border-0 pb-0">
          <div>
            <span class="badge mb-2 px-3 py-1 text-dark" style="background: var(--santino-gold);">7-DAY FREE TRIAL</span>
            <h3 class="modal-title font-heading fw-bold">Request Office Coffee Proposal</h3>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body pt-3">
          <p class="text-muted small mb-4">
            We will set up a commercial bean-to-cup machine and specialty coffee beans at your office pantry for a 7-day complimentary test drive.
          </p>

          <form onsubmit="alert('Thank you! Our corporate coffee specialist will contact you within 2 business hours.'); return false;">
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Company / Organization Name *</label>
                <input type="text" class="form-control form-control-lg rounded-3 fs-6" placeholder="e.g. Grameenphone / Unilever" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Office Location / Area *</label>
                <input type="text" class="form-control form-control-lg rounded-3 fs-6" placeholder="Gulshan, Banani, Motijheel, Uttara..." required>
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Contact Person Name *</label>
                <input type="text" class="form-control form-control-lg rounded-3 fs-6" placeholder="Your Full Name" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Designation</label>
                <input type="text" class="form-control form-control-lg rounded-3 fs-6" placeholder="HR Director, Admin Manager, Ops...">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Official Phone / WhatsApp *</label>
                <input type="tel" class="form-control form-control-lg rounded-3 fs-6" placeholder="+880 1..." required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Official Work Email *</label>
                <input type="email" class="form-control form-control-lg rounded-3 fs-6" placeholder="name@company.com" required>
              </div>
            </div>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label small fw-bold">Office Team Size</label>
                <select class="form-select form-select-lg rounded-3 fs-6">
                  <option>10 – 30 Employees (Boutique Hub)</option>
                  <option selected>30 – 100 Employees (Corporate Floor)</option>
                  <option>100 – 300 Employees (Multi-Floor HQ)</option>
                  <option>300+ Employees (Enterprise Campus)</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold">Current Coffee Solution</label>
                <select class="form-select form-select-lg rounded-3 fs-6">
                  <option>Nespresso / Capsule Pods</option>
                  <option>Instant Coffee Powder</option>
                  <option>Outside Delivery / Cafe Takeaway</option>
                  <option>Existing Machine (Seeking Better Provider)</option>
                  <option>Setting Up New Office</option>
                </select>
              </div>
            </div>

            <button type="submit" class="btn btn-dark w-100 py-3 fw-bold rounded-3 text-white font-heading text-uppercase shadow-lg" style="background: var(--santino-teal); border: none; font-size: 15px;">
              Submit Free Trial Request & Schedule Setup →
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- FOOTER -->

<?php
endif;

get_footer();
