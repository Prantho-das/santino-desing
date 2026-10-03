<?php
/**
 * Template Name: Machines Page
 *
 * @package Santino
 */

/**
 * Template Name: Santino Commercial Coffee Machines
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

<!-- MINIMAL CLEAN COMMERCIAL MACHINES HERO -->
  <section class="pro-banner-hero" style="background-image: url('<?php echo santino_img('imgi_218_blackeagle2.jpg'); ?>'); background-position: center; min-height: 52vh;">
    <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.45) 100%);"></div>
    <div class="pro-banner-glow-line"></div>
    
    <div class="container pro-banner-container" style="max-width: 680px;">
      
      <!-- Minimal Badge -->
      <div class="pro-banner-pill mb-3">
        <span class="pro-pulse-dot"></span>
        <span>AUTHORIZED ITALIAN DISTRIBUTOR</span>
      </div>

      <!-- Concise Headline -->
      <h1 class="pro-banner-title mb-2">
        Commercial Espresso Machinery
      </h1>

      <!-- One-line Subtitle -->
      <p class="pro-banner-desc mb-4" style="max-width: 520px; font-size: 1.05rem;">
        Official Italian espresso machines, automated coffee stations, and 4-hour on-site tech SLA.
      </p>

      <!-- Action Buttons -->
      <div class="pro-banner-actions">
        <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#demoModal">
          <span>Book Live Demo</span>
          <i class="bi bi-play-circle-fill"></i>
        </button>
        <a href="#machineGrid" class="btn-hero-outline">
          <i class="bi bi-arrow-down-short fs-5 text-gold"></i>
          <span>Explore Catalog</span>
        </a>
      </div>

    </div>
  </section>

  <!-- CLEAN SUBTLE STATS STRIP BELOW HERO -->
  <section class="py-4 border-bottom bg-white">
    <div class="container">
      <div class="row g-4 text-center justify-content-center">
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">500+</div>
          <div class="small text-muted fw-bold text-uppercase">Machines Installed</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-teal font-heading" style="color: var(--santino-teal);">4 Hours</div>
          <div class="small text-muted fw-bold text-uppercase">Rapid Tech SLA</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">100%</div>
          <div class="small text-muted fw-bold text-uppercase">OEM Italian Parts</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-gold font-heading" style="color: var(--santino-gold);">Zero</div>
          <div class="small text-muted fw-bold text-uppercase">Downtime Warranty</div>
        </div>
      </div>
    </div>
  </section>

  <!-- BRAND PARTNERS MARQUEE -->
  <div class="py-4 border-top border-bottom bg-white reveal">
    <div class="container">
      <div class="d-flex justify-content-center align-items-center flex-wrap gap-4 gap-md-5 opacity-75">
        <span class="fw-bold font-heading text-muted">AUTHORIZED PARTNERS:</span>
        <span class="fw-bold text-dark fs-6">VICTORIA ARDUINO</span>
        <span class="fw-bold text-dark fs-6">NUOVA SIMONELLI</span>
        <span class="fw-bold text-dark fs-6">KALERM AUTOMATION</span>
        <span class="fw-bold text-dark fs-6">CAYE BIONIC ROBOTICS</span>
        <span class="fw-bold text-dark fs-6">3TEMP BREWERS</span>
        <span class="fw-bold text-dark fs-6">CAFEVA CARE</span>
      </div>
    </div>
  </div>

  <!-- MACHINERY CATALOG WITH CATEGORY TABS -->
  <section class="py-5" id="machineGrid">
    <div class="container">
      
      <div class="sec-heading-center text-center mb-5 reveal">
        <span class="badge-tag-pill mb-2"><i class="bi bi-gear-wide-connected text-teal me-1"></i> EQUIPMENT PORTFOLIO</span>
        <h2 class="sec-title">Engineered for Flawless Extraction</h2>
        <div class="sec-subtitle">Discover our comprehensive collection of traditional, superautomatic, and bionic coffee machinery</div>
      </div>

      <!-- Filter Buttons -->
      <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 reveal">
        <button class="branch-filter-btn active" onclick="filterMachines('all', this)">All Equipment (8)</button>
        <button class="branch-filter-btn" onclick="filterMachines('traditional', this)">Traditional Commercial</button>
        <button class="branch-filter-btn" onclick="filterMachines('superautomatic', this)">Bean-to-Cup Automatics</button>
        <button class="branch-filter-btn" onclick="filterMachines('robotics', this)">Bionic Robotic Baristas</button>
        <button class="branch-filter-btn" onclick="filterMachines('grinders', this)">Grinders & Care</button>
      </div>

      <!-- Machines Grid -->
      <div class="row g-4" id="machinesContainer">
        
        <!-- Machine 1 -->
        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="100" data-category="traditional">
          <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-dark">ITALIAN TRADITIONAL</span>
                <span class="text-muted small fw-bold">Victoria Arduino</span>
              </div>
              <div class="machine-img-box text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp'); ?>" alt="Black Eagle Maverick" class="img-fluid" style="max-height: 200px; object-fit: contain;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Black Eagle Maverick</h4>
              <p class="text-muted small mb-3">T3 Genius multiboiler with PureBrew filter extraction and gravimetric auto-tare scales.</p>
              
              <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">2/3 Group Heads</span>
                <span class="badge bg-light text-dark border">7100W Power</span>
                <span class="badge bg-light text-dark border">Gravitech Scale</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex gap-2">
              <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
              </button>
              <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                Book Demo
              </button>
            </div>
          </div>
        </div>

        <!-- Machine 2 -->
        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="200" data-category="traditional">
          <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-teal text-white" style="background-color: var(--santino-teal);">ENERGY EFFICIENT</span>
                <span class="text-muted small fw-bold">Victoria Arduino</span>
              </div>
              <div class="machine-img-box text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_21_EagleOne_e524e570-7076-4cbc-916e-ad851ca2de5c.jpg'); ?>" alt="Eagle One" class="img-fluid" style="max-height: 200px; object-fit: contain;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Eagle One Commercial</h4>
              <p class="text-muted small mb-3">NEO engine technology that uses instant heating to reduce carbon emissions by up to 35%.</p>
              
              <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">NEO Instant Boiler</span>
                <span class="badge bg-light text-dark border">TERS Heat Recovery</span>
                <span class="badge bg-light text-dark border">Mobile App Control</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex gap-2">
              <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
              </button>
              <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                Book Demo
              </button>
            </div>
          </div>
        </div>

        <!-- Machine 3 -->
        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="300" data-category="traditional">
          <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-danger">BESTSELLER WORKHORSE</span>
                <span class="text-muted small fw-bold">Nuova Simonelli</span>
              </div>
              <div class="machine-img-box text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_26_santino_-_250522-07312.jpg'); ?>" alt="Appia Life" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 12px;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Nuova Simonelli Appia Life</h4>
              <p class="text-muted small mb-3">SIS Soft Infusion System guaranteeing creamy, consistent crema for high-volume cafes.</p>
              
              <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">2/3 Group Volumetric</span>
                <span class="badge bg-light text-dark border">SIS Soft Infusion</span>
                <span class="badge bg-light text-dark border">EasyCream Auto Steamer</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex gap-2">
              <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
              </button>
              <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                Book Demo
              </button>
            </div>
          </div>
        </div>

        <!-- Machine 4 -->
        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="100" data-category="superautomatic">
          <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-warning text-dark">TOUCHSCREEN AUTO</span>
                <span class="text-muted small fw-bold">Kalerm Premium</span>
              </div>
              <div class="machine-img-box text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_20_santino_-_250522-07574.jpg'); ?>" alt="Kalerm Superautomatic" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 12px;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Kalerm K95 / X400 Superautomatic</h4>
              <p class="text-muted small mb-3">Commercial 10.1" Android touchscreen, dual grinders, fresh milk foam, 200+ cups/day.</p>
              
              <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">One-Touch Latte/Cappuccino</span>
                <span class="badge bg-light text-dark border">Dual Bean Hoppers</span>
                <span class="badge bg-light text-dark border">Hotel / Corporate Ready</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex gap-2">
              <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
              </button>
              <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                Book Demo
              </button>
            </div>
          </div>
        </div>

        <!-- Machine 5 -->
        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="200" data-category="robotics">
          <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-danger">AI BIONIC ROBOT</span>
                <span class="text-muted small fw-bold">CAYE Robotics</span>
              </div>
              <div class="machine-img-box text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_23_santino_-_250522-07495.jpg'); ?>" alt="CAYE Bionic Barista" class="img-fluid" style="max-height: 200px; object-fit: cover; border-radius: 12px;">
              </div>
              <h4 class="font-heading fw-bold mb-1">CAYE 6-Axis Bionic Barista Robot</h4>
              <p class="text-muted small mb-3">Fully automated robotic coffee kiosk capable of grinding, tamping, brewing, and pouring custom latte art.</p>
              
              <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">6-Axis Dual Robot Arms</span>
                <span class="badge bg-light text-dark border">60-Sec Latte Art Execution</span>
                <span class="badge bg-light text-dark border">24/7 Unmanned Kiosk</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex gap-2">
              <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
              </button>
              <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                Book Demo
              </button>
            </div>
          </div>
        </div>

        <!-- Machine 6 -->
        <div class="col-lg-4 col-md-6 machine-card-col reveal" data-delay="300" data-category="grinders">
          <div class="machine-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm d-flex flex-column justify-content-between p-4 hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-dark">ON-DEMAND GRIND</span>
                <span class="text-muted small fw-bold">Mythos & Blue Stone</span>
              </div>
              <div class="machine-img-box text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_30_Blue-Stone-3_800x_526184df-2650-40b7-9dcf-e8af5b97527b.webp'); ?>" alt="Precision Grinder" class="img-fluid" style="max-height: 200px; object-fit: contain;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Mythos Two Gravimetric Grinder</h4>
              <p class="text-muted small mb-3">Titanium burrs with Clima Pro thermal stability and instant micro-metric dose adjustments.</p>
              
              <div class="machine-spec-tags d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">85mm Titanium Burrs</span>
                <span class="badge bg-light text-dark border">Clima Pro 2.0 Temperature</span>
                <span class="badge bg-light text-dark border">Zero Retention</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex gap-2">
              <button class="btn-prod-outline flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                <i class="bi bi-file-earmark-pdf me-1"></i> Specs PDF
              </button>
              <button class="btn-prod-quote flex-fill" data-bs-toggle="modal" data-bs-target="#demoModal">
                Book Demo
              </button>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- LEASING & 24/7 SUPPORT SERVICES -->
  <section class="py-5 bg-light border-top">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 reveal-left">
          <span class="badge-tag-pill mb-3">TOTAL PEACE OF MIND</span>
          <h2 class="font-heading fw-bold mb-3">Turnkey Leasing & 24/7 Breakdown Coverage</h2>
          <p class="text-muted mb-4">
            Santino offers flexible monthly operating lease options for corporate cafes, restaurants, and hospitality businesses across Bangladesh, eliminating heavy capital expenditures.
          </p>
          <div class="row g-3">
            <div class="col-sm-6">
              <div class="p-3 bg-white rounded-3 border hover-lift">
                <i class="bi bi-shield-check text-success fs-3 mb-2"></i>
                <h6 class="fw-bold mb-1">Guaranteed Replacement</h6>
                <p class="text-muted small mb-0">Temporary backup machine provided in under 4 hours.</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="p-3 bg-white rounded-3 border hover-lift">
                <i class="bi bi-wrench-adjustable-circle text-primary fs-3 mb-2"></i>
                <h6 class="fw-bold mb-1">Preventative Descaling</h6>
                <p class="text-muted small mb-0">Quarterly water filtration and group head refurbishment.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 reveal-right">
          <div class="p-4 p-md-5 rounded-4 bg-white border shadow-xl hover-lift">
            <h4 class="font-heading fw-bold mb-2">Request Equipment Quotation</h4>
            <p class="text-muted small mb-4">Tell us about your business scale and daily cup requirements.</p>
            <form onsubmit="alert('Thank you! Our commercial machinery team will send your custom quote and arrange a demo.'); return false;">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Company / Cafe Name *" required>
              </div>
              <div class="row g-2 mb-3">
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="Contact Person *" required>
                </div>
                <div class="col-6">
                  <input type="tel" class="form-control" placeholder="Phone Number *" required>
                </div>
              </div>
              <div class="mb-3">
                <select class="form-select">
                  <option>Purchase Outright</option>
                  <option>Monthly Machine Rental / Lease</option>
                  <option>Turnkey Coffee + Machine Package</option>
                  <option>Annual Maintenance Contract</option>
                </select>
              </div>
              <button type="submit" class="btn-prod-quote w-100 py-3" style="background-color: var(--santino-teal); border: none;">
                SUBMIT QUOTE REQUEST
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Demo Booking Modal -->
  <div class="modal fade" id="demoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 p-4">
        <div class="modal-header border-0 pb-0">
          <h4 class="modal-title font-heading fw-bold">Book A Live Machine Demo</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted small mb-4">Visit our Tejgaon Roastery Lab or Gulshan Experience Center to test Victoria Arduino espresso machines and CAYE bionic robots hands-on.</p>
          <form onsubmit="alert('Demo Booked! Our team will contact you to confirm your showroom session.'); return false;">
            <div class="mb-3">
              <label class="form-label small fw-bold">Full Name *</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Phone Number *</label>
              <input type="tel" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Machine of Interest</label>
              <select class="form-select">
                <option>Victoria Arduino Black Eagle Maverick</option>
                <option>Victoria Arduino Eagle One</option>
                <option>Nuova Simonelli Appia Life</option>
                <option>Kalerm Superautomatic Series</option>
                <option>CAYE Bionic Barista Robot</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Preferred Showroom Location</label>
              <select class="form-select">
                <option>Tejgaon Roastery & Technical Lab</option>
                <option>Gulshan-2 Flagship Experience Center</option>
              </select>
            </div>
            <button type="submit" class="btn-kp-maroon w-100 py-3 fw-bold">
              CONFIRM DEMO SESSION
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->

<?php\n<?php
endif;
get_footer();
