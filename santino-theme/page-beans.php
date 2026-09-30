<?php
/**
 * Template Name: Santino Specialty Coffee Beans & Roastery
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

<!-- MINIMAL CLEAN ARTISAN ROASTERY HERO -->
  <section class="pro-banner-hero" style="background-image: url('<?php echo santino_img('imgi_4_pexels-sikunovruslan-11942442.jpg'); ?>'); background-position: center; min-height: 52vh;">
    <div class="pro-banner-overlay" style="background: linear-gradient(180deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.42) 100%);"></div>
    <div class="pro-banner-glow-line"></div>
    
    <div class="container pro-banner-container" style="max-width: 680px;">
      
      <!-- Minimal Badge -->
      <div class="pro-banner-pill mb-3">
        <span class="pro-pulse-dot"></span>
        <span>SPECIALTY ROASTERY</span>
      </div>

      <!-- Concise Headline -->
      <h1 class="pro-banner-title mb-2">
        Artisan Coffee Beans
      </h1>

      <!-- One-line Subtitle -->
      <p class="pro-banner-desc mb-4" style="max-width: 500px; font-size: 1.05rem;">
        Fresh micro-batch roasts sourced directly from premier origins worldwide.
      </p>

      <!-- Action Buttons -->
      <div class="pro-banner-actions">
        <button class="btn-hero-lifestyle" data-bs-toggle="modal" data-bs-target="#sampleModal">
          <span>Request Samples</span>
          <i class="bi bi-cup-hot-fill"></i>
        </button>
        <a href="#roastCatalog" class="btn-hero-outline">
          <i class="bi bi-arrow-down-short fs-5 text-gold"></i>
          <span>Explore Roasts</span>
        </a>
      </div>

    </div>
  </section>

  <!-- CLEAN SUBTLE STATS STRIP BELOW HERO -->
  <section class="py-4 border-bottom bg-white">
    <div class="container">
      <div class="row g-4 text-center justify-content-center">
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">90+ SCA</div>
          <div class="small text-muted fw-bold text-uppercase">Certified Cupping Score</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-teal font-heading" style="color: var(--santino-teal);">100%</div>
          <div class="small text-muted fw-bold text-uppercase">Micro-Lot Single Origin</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-dark font-heading">24 Hours</div>
          <div class="small text-muted fw-bold text-uppercase">Fresh Batch Dispatch</div>
        </div>
        <div class="col-6 col-md-3">
          <div class="fs-2 fw-black text-gold font-heading" style="color: var(--santino-gold);">FSSC 22000</div>
          <div class="small text-muted fw-bold text-uppercase">Global Safety Certified</div>
        </div>
      </div>
    </div>
  </section>

  <!-- BEANS CATALOG SECTION -->
  <section class="py-5" id="roastCatalog">
    <div class="container">
      
      <div class="sec-heading-center text-center mb-5 reveal">
        <span class="badge-tag-pill mb-2"><i class="bi bi-award-fill text-gold me-1"></i> SPECIALTY ROAST COLLECTION</span>
        <h2 class="sec-title">Roasted to Peak Flavor Expression</h2>
        <div class="sec-subtitle">Explore our Single Origin Espressos (SOE), heritage espresso blends, and OEM private label options</div>
      </div>

      <!-- Filter Buttons -->
      <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 reveal">
        <button class="branch-filter-btn active" onclick="filterBeans('all', this)">All Bean Collections (6)</button>
        <button class="branch-filter-btn" onclick="filterBeans('single-origin', this)">Single Origin (SOE)</button>
        <button class="branch-filter-btn" onclick="filterBeans('blends', this)">Espresso Blends</button>
        <button class="branch-filter-btn" onclick="filterBeans('retail', this)">Retail Packs (Shwapno)</button>
      </div>

      <!-- Beans Grid -->
      <div class="row g-4" id="beansContainer">
        
        <!-- Bean 1 -->
        <div class="col-lg-4 col-md-6 bean-card-col reveal" data-delay="100" data-category="single-origin">
          <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-gold text-dark fw-bold" style="background-color: var(--santino-gold);">90+ CUPPING SCORE</span>
                <span class="text-muted small fw-bold">Ethiopia</span>
              </div>
              <div class="text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_22_Untitleddesign_4.png'); ?>" alt="Ethiopia Yirgacheffe" class="img-fluid" style="max-height: 190px; object-fit: contain;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Ethiopia Yirgacheffe G1</h4>
              <p class="text-muted small mb-3">Washed process from 1,900m altitude. Bursting with jasmine florals, bergamot citrus, and sweet honey.</p>
              
              <div class="bean-flavor-chips d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">Jasmine</span>
                <span class="badge bg-light text-dark border">Bergamot</span>
                <span class="badge bg-light text-dark border">Light-Medium Roast</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <div>
                <span class="fw-bold fs-5 text-dark">৳ 1,450</span>
                <span class="text-muted small"> / 250g</span>
              </div>
              <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal">
                Order Beans
              </button>
            </div>
          </div>
        </div>

        <!-- Bean 2 -->
        <div class="col-lg-4 col-md-6 bean-card-col reveal" data-delay="200" data-category="single-origin">
          <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-danger text-white fw-bold">CHAMPIONSHIP LOT</span>
                <span class="text-muted small fw-bold">Colombia</span>
              </div>
              <div class="text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_144_Untitleddesign_4.png'); ?>" alt="Colombia Geisha" class="img-fluid" style="max-height: 190px; object-fit: contain;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Colombia Huila Geisha Reserve</h4>
              <p class="text-muted small mb-3">Anaerobic slow fermentation. Extraordinary aroma of white peach, lavender blossom, and silky green tea finish.</p>
              
              <div class="bean-flavor-chips d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">White Peach</span>
                <span class="badge bg-light text-dark border">Lavender</span>
                <span class="badge bg-light text-dark border">Filter / Light</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <div>
                <span class="fw-bold fs-5 text-dark">৳ 2,200</span>
                <span class="text-muted small"> / 250g</span>
              </div>
              <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal">
                Order Beans
              </button>
            </div>
          </div>
        </div>

        <!-- Bean 3 -->
        <div class="col-lg-4 col-md-6 bean-card-col reveal" data-delay="300" data-category="blends">
          <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-success text-white fw-bold">100% RAINFOREST ALLIANCE</span>
                <span class="text-muted small fw-bold">House Blend</span>
              </div>
              <div class="text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_146_Untitleddesign_4.png'); ?>" alt="The Green Label" class="img-fluid" style="max-height: 190px; object-fit: contain;">
              </div>
              <h4 class="font-heading fw-bold mb-1">The Green Label Master Blend</h4>
              <p class="text-muted small mb-3">Our flagship commercial espresso blend. Thick golden crema, notes of Swiss dark chocolate, roasted almond, and sweet brown sugar.</p>
              
              <div class="bean-flavor-chips d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">Dark Cocoa</span>
                <span class="badge bg-light text-dark border">Hazelnut</span>
                <span class="badge bg-light text-dark border">Full City Medium-Dark</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <div>
                <span class="fw-bold fs-5 text-dark">৳ 3,800</span>
                <span class="text-muted small"> / 1kg Bag</span>
              </div>
              <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal">
                Order Beans
              </button>
            </div>
          </div>
        </div>

        <!-- Bean 4 -->
        <div class="col-lg-4 col-md-6 bean-card-col reveal" data-delay="100" data-category="blends">
          <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-dark text-white fw-bold">INTENSE CREMA</span>
                <span class="text-muted small fw-bold">Crema Master</span>
              </div>
              <div class="text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_147_Untitleddesign_4.png'); ?>" alt="Crema Master" class="img-fluid" style="max-height: 190px; object-fit: contain;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Santino Crema Master Roastery Blend</h4>
              <p class="text-muted small mb-3">Specially crafted for milky lattes and cappuccinos. Cuts through whole and plant-based milks with rich caramel and roasted pecan.</p>
              
              <div class="bean-flavor-chips d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">Caramelized Pecan</span>
                <span class="badge bg-light text-dark border">Dark Chocolate</span>
                <span class="badge bg-light text-dark border">Dark Roast</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <div>
                <span class="fw-bold fs-5 text-dark">৳ 3,400</span>
                <span class="text-muted small"> / 1kg Bag</span>
              </div>
              <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal">
                Order Beans
              </button>
            </div>
          </div>
        </div>

        <!-- Bean 5 -->
        <div class="col-lg-4 col-md-6 bean-card-col reveal" data-delay="200" data-category="retail">
          <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-teal text-white fw-bold" style="background-color: var(--santino-teal);">SHWAPNO RETAIL PACK</span>
                <span class="text-muted small fw-bold">Home Brew</span>
              </div>
              <div class="text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('shwapno_santino_retail.jpg'); ?>" alt="Shwapno Retail Pack" class="img-fluid rounded-3" style="max-height: 190px; object-fit: cover;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Santino Classic Roast & Ground (250g)</h4>
              <p class="text-muted small mb-3">Available across 100+ Shwapno Superstores nationwide. Nitro-flushed with valve seal for 12 months freshness.</p>
              
              <div class="bean-flavor-chips d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">Ground / Whole Bean</span>
                <span class="badge bg-light text-dark border">Moka Pot / French Press</span>
                <span class="badge bg-light text-dark border">Medium Dark</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <div>
                <span class="fw-bold fs-5 text-dark">৳ 680</span>
                <span class="text-muted small"> / 250g Retail Pack</span>
              </div>
              <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal">
                Store Finder
              </button>
            </div>
          </div>
        </div>

        <!-- Bean 6 -->
        <div class="col-lg-4 col-md-6 bean-card-col reveal" data-delay="300" data-category="single-origin">
          <div class="bean-product-card h-100 bg-white border rounded-4 overflow-hidden shadow-sm p-4 d-flex flex-column justify-content-between hover-lift">
            <div>
              <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-dark text-white fw-bold">VOLCANIC TERROIR</span>
                <span class="text-muted small fw-bold">Sumatra</span>
              </div>
              <div class="text-center my-3 hover-img-zoom">
                <img src="<?php echo santino_img('imgi_22_Untitleddesign_4.png'); ?>" alt="Sumatra Mandheling" class="img-fluid" style="max-height: 190px; object-fit: contain;">
              </div>
              <h4 class="font-heading fw-bold mb-1">Sumatra Mandheling Triple Picked</h4>
              <p class="text-muted small mb-3">Wet-hulled Giling Basah method. Heavy body, spicy cedarwood, dark molasses, and low acidity.</p>
              
              <div class="bean-flavor-chips d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark border">Spicy Cedar</span>
                <span class="badge bg-light text-dark border">Molasses</span>
                <span class="badge bg-light text-dark border">Dark Roast</span>
              </div>
            </div>

            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
              <div>
                <span class="fw-bold fs-5 text-dark">৳ 1,350</span>
                <span class="text-muted small"> / 250g</span>
              </div>
              <button class="btn btn-dark btn-sm fw-bold px-3 py-2" style="background-color: var(--santino-teal); border: none;" data-bs-toggle="modal" data-bs-target="#sampleModal">
                Order Beans
              </button>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- CUSTOM OEM ROASTING FOR CAFES & HOTELS -->
  <section class="py-5 bg-light border-top">
    <div class="container">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 reveal-left">
          <span class="badge-tag-pill mb-3">OEM PRIVATE LABEL</span>
          <h2 class="font-heading fw-bold mb-3">Custom Roast Profiling for Your Brand</h2>
          <p class="text-muted mb-4">
            Santino crafts bespoke coffee profiles tailored to your brand identity, target demographic, and espresso equipment. From origin selection to custom branded packaging with degassing valves.
          </p>
          <ul class="list-unstyled d-flex flex-column gap-3 text-dark fw-bold">
            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Low Minimum Order Quantity (MOQ from 20kg batches)</li>
            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Sensory Cupping & Roast Curve Calibration in our Tejgaon Lab</li>
            <li><i class="bi bi-check-circle-fill text-success me-2"></i> Free Custom Barista Dial-In Guide for your staff</li>
          </ul>
        </div>
        <div class="col-lg-6 reveal-right">
          <div class="p-4 p-md-5 rounded-4 bg-white border shadow-xl hover-lift">
            <h4 class="font-heading fw-bold mb-2">Request OEM Tasting Flight</h4>
            <p class="text-muted small mb-4">Leave your details to receive sample batches roasted specifically for your cafe.</p>
            <form onsubmit="alert('Thank you! Our master roaster will prepare your sample tasting kit.'); return false;">
              <div class="mb-3">
                <input type="text" class="form-control" placeholder="Business Name (Cafe / Hotel) *" required>
              </div>
              <div class="row g-2 mb-3">
                <div class="col-6">
                  <input type="text" class="form-control" placeholder="Contact Name *" required>
                </div>
                <div class="col-6">
                  <input type="tel" class="form-control" placeholder="Phone Number *" required>
                </div>
              </div>
              <div class="mb-3">
                <select class="form-select">
                  <option>Estimated Monthly Volume: 20kg - 50kg</option>
                  <option>Estimated Monthly Volume: 50kg - 200kg</option>
                  <option>Estimated Monthly Volume: 200kg+ (Hotel / Chain)</option>
                </select>
              </div>
              <button type="submit" class="btn-prod-quote w-100 py-3" style="background-color: var(--santino-teal); border: none;">
                REQUEST SAMPLE TASTING KIT
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Sample Modal -->
  <div class="modal fade" id="sampleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 p-4">
        <div class="modal-header border-0 pb-0">
          <h4 class="modal-title font-heading fw-bold">Request Coffee Bean Samples</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted small mb-4">We provide complimentary sample bean packs for registered cafes, restaurants, and hospitality businesses.</p>
          <form onsubmit="alert('Sample request received! We will deliver fresh roast samples to your address.'); return false;">
            <div class="mb-3">
              <label class="form-label small fw-bold">Full Name *</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Phone Number *</label>
              <input type="tel" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Delivery Address for Samples *</label>
              <textarea class="form-control" rows="2" placeholder="Street, Area, City" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold">Preferred Roast Profile</label>
              <select class="form-select">
                <option>The Green Label Master Espresso Blend</option>
                <option>Ethiopia Yirgacheffe G1 (Single Origin)</option>
                <option>Colombia Huila Geisha Reserve</option>
                <option>Complete 3-Roast Sample Flight</option>
              </select>
            </div>
            <button type="submit" class="btn-kp-maroon w-100 py-3 fw-bold">
              SEND FREE SAMPLE PACK
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
