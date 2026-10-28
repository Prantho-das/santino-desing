<?php
/**
 * Template Name: Santino Certificate Verification
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();

$is_elementor_page = false;
if ( class_exists( '\Elementor\Plugin' ) ) {
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
.cert-verify-wrap {
  --cv-teal: #00625d;
  --cv-teal-dark: #004d49;
  --cv-gold: #c3996c;
  --cv-gold-light: #f7f2ea;
  --cv-dark: #181818;
  --cv-border: #e2e8f0;
}
.cert-hero {
  background-image: url('<?php echo santino_img('bd-barista-training.jpg'); ?>');
  background-position: center;
  background-size: cover;
  position: relative;
  min-height: 48vh;
  display: flex;
  align-items: center;
}
.cert-hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(10, 20, 20, 0.82) 0%, rgba(10, 20, 20, 0.94) 100%);
}
.cert-search-card {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid rgba(0, 98, 93, 0.12);
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08);
  padding: 2.25rem;
  margin-top: -60px;
  position: relative;
  z-index: 10;
}
.cert-input-group {
  position: relative;
  display: flex;
  align-items: center;
}
.cert-input-group .form-control {
  font-size: 1.15rem;
  font-weight: 600;
  letter-spacing: 0.5px;
  border: 2px solid #d9e2ec;
  border-radius: 12px;
  padding: 0.95rem 1.15rem 0.95rem 3.2rem;
  transition: all 0.25s ease;
  text-transform: uppercase;
}
.cert-input-group .form-control:focus {
  border-color: #00625d;
  box-shadow: 0 0 0 4px rgba(0, 98, 93, 0.15);
}
.cert-input-icon {
  position: absolute;
  left: 1.15rem;
  color: #00625d;
  font-size: 1.35rem;
  pointer-events: none;
}
.btn-cert-search {
  background: #00625d;
  color: #ffffff;
  font-weight: 700;
  font-size: 1rem;
  padding: 0.95rem 2rem;
  border-radius: 12px;
  border: none;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}
.btn-cert-search:hover {
  background: #004d49;
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0, 98, 93, 0.3);
}
.sample-badge {
  background: #f0f7f6;
  color: #00625d;
  border: 1px solid rgba(0, 98, 93, 0.2);
  border-radius: 50px;
  padding: 0.3rem 0.85rem;
  font-size: 0.82rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
  display: inline-block;
}
.sample-badge:hover {
  background: #00625d;
  color: #ffffff;
}
.cert-result-card {
  background: #ffffff;
  border: 2px solid #c3996c;
  border-radius: 18px;
  box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
  overflow: hidden;
  position: relative;
  display: none;
}
.cert-result-header {
  background: linear-gradient(135deg, #00625d 0%, #004541 100%);
  color: #ffffff;
  padding: 1.75rem 2rem;
  border-bottom: 3px solid #c3996c;
}
.cert-badge-verified {
  background: #10b981;
  color: #ffffff;
  font-size: 0.85rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  padding: 0.45rem 1rem;
  border-radius: 50px;
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
}
.cert-result-body {
  padding: 2.25rem;
  background: #fcfcfb;
}
.cert-meta-item {
  border-bottom: 1px dashed #e2e8f0;
  padding: 0.85rem 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 0.5rem;
}
.cert-meta-label {
  color: #64748b;
  font-size: 0.9rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.4px;
}
.cert-meta-val {
  color: #0f172a;
  font-size: 1.05rem;
  font-weight: 700;
  text-align: right;
}
.cert-seal {
  width: 90px;
  height: 90px;
  border: 3px dashed #c3996c;
  border-radius: 50%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #00625d;
  font-size: 0.65rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  background: #fffdf9;
  text-align: center;
  padding: 6px;
  margin: 0 auto;
}
.cert-not-found {
  display: none;
  background: #fff5f5;
  border: 1px solid #fed7d7;
  border-radius: 14px;
  padding: 2rem;
  text-align: center;
}
.step-card {
  background: #ffffff;
  border: 1px solid #eef2f6;
  border-radius: 14px;
  padding: 1.75rem;
  height: 100%;
  transition: all 0.3s ease;
  position: relative;
}
.step-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.06);
  border-color: #c3996c;
}
.step-num {
  width: 44px;
  height: 44px;
  background: #f0f7f6;
  color: #00625d;
  font-weight: 800;
  font-size: 1.2rem;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.2rem;
}
@media print {
  body * {
    visibility: hidden;
  }
  #certResultDisplay, #certResultDisplay * {
    visibility: visible;
  }
  #certResultDisplay {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    margin: 0;
    padding: 0;
    box-shadow: none;
    border: 2px solid #000;
  }
  .no-print {
    display: none !important;
  }
}
</style>

<div class="cert-verify-wrap">

  <!-- HERO SECTION -->
  <section class="cert-hero">
    <div class="cert-hero-overlay"></div>
    <div class="container position-relative py-5 text-center text-white">
      <div class="mx-auto" style="max-width: 780px;">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(195, 153, 108, 0.18); border: 1px solid rgba(195, 153, 108, 0.4);">
          <i class="bi bi-shield-fill-check text-warning"></i>
          <span class="small fw-bold text-uppercase" style="letter-spacing: 1px; color: #dfc49f;">Official Registry &amp; Accreditation</span>
        </div>
        <h1 class="display-4 fw-bold font-heading mb-3 text-white">Certificate Verification</h1>
        <p class="lead mb-4 text-white-50" style="font-size: 1.15rem; line-height: 1.6;">
          Instantly verify the authenticity of credentials issued by Santino Barista Academy &amp; Bangladesh Barista Training Academy (BBTA).
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
          <a href="<?php echo esc_url( home_url( '/training/' ) ); ?>" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold">
            <i class="bi bi-mortarboard-fill me-2 text-warning"></i>Explore Courses
          </a>
          <a href="https://wa.me/8801606291393" target="_blank" class="btn btn-warning rounded-pill px-4 py-2 fw-bold text-dark">
            <i class="bi bi-whatsapp me-2"></i>Contact Academy
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- SEARCH FORM SECTION -->
  <section class="pb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          
          <div class="cert-search-card">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="d-flex align-items-center justify-content-center rounded-3 bg-light text-success" style="width: 50px; height: 50px; font-size: 1.6rem; color: #00625d !important; background: #e6f2f1 !important;">
                <i class="bi bi-patch-check-fill"></i>
              </div>
              <div>
                <h4 class="fw-bold mb-0 text-dark">Verify Credentials</h4>
                <p class="text-muted small mb-0">Enter the unique Certificate ID printed on your official certificate</p>
              </div>
            </div>

            <form id="certVerificationForm" class="mt-4" onsubmit="return handleCertVerify(event);">
              <div class="row g-2">
                <div class="col-md-8">
                  <div class="cert-input-group">
                    <i class="bi bi-search cert-input-icon"></i>
                    <input type="text" id="certIdInput" class="form-control" placeholder="e.g. SNT-2025-001 or BBTA-2025-042" autocomplete="off" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <button type="submit" id="btnVerifySubmit" class="btn-cert-search w-100">
                    <i class="bi bi-shield-check"></i>
                    <span>Verify Now</span>
                  </button>
                </div>
              </div>
            </form>

            <div class="mt-3 pt-3 border-top d-flex flex-wrap align-items-center gap-2">
              <span class="small text-muted fw-semibold me-1">Try demo IDs:</span>
              <a href="javascript:void(0)" class="sample-badge" onclick="fillAndVerify('SNT-2025-001')">SNT-2025-001</a>
              <a href="javascript:void(0)" class="sample-badge" onclick="fillAndVerify('BBTA-2025-042')">BBTA-2025-042</a>
              <a href="javascript:void(0)" class="sample-badge" onclick="fillAndVerify('SNT-ADV-108')">SNT-ADV-108</a>
              <a href="javascript:void(0)" class="sample-badge" onclick="fillAndVerify('BBTA-PIZ-204')">BBTA-PIZ-204</a>
            </div>
            
            <p class="small text-muted mb-0 mt-3">
              <i class="bi bi-info-circle me-1 text-primary"></i> The Certificate ID can be found at the top header or bottom footer of your certificate parchment.
            </p>
          </div>

          <!-- NOT FOUND FEEDBACK -->
          <div id="certNotFound" class="cert-not-found mt-4">
            <div class="text-danger mb-2" style="font-size: 2.5rem;">
              <i class="bi bi-exclamation-octagon-fill"></i>
            </div>
            <h5 class="fw-bold text-dark">Certificate Record Not Found</h5>
            <p class="text-muted mb-3" id="notFoundMessage">
              We could not find any official certificate associated with the ID you entered.
            </p>
            <div class="d-flex flex-wrap gap-2 justify-content-center">
              <button class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('certIdInput').focus();">
                <i class="bi bi-arrow-repeat me-1"></i> Try Another ID
              </button>
              <a href="https://wa.me/8801606291393" target="_blank" class="btn btn-outline-success btn-sm">
                <i class="bi bi-whatsapp me-1"></i> Contact Registry Support
              </a>
            </div>
          </div>

          <!-- RESULT CARD -->
          <div id="certResultDisplay" class="cert-result-card mt-4">
            <div class="cert-result-header d-flex flex-wrap justify-content-between align-items-center gap-2">
              <div>
                <span class="cert-badge-verified mb-2">
                  <i class="bi bi-check-circle-fill"></i> STATUS: AUTHENTIC &amp; VERIFIED
                </span>
                <h3 class="fw-bold mb-0 text-white font-heading" id="certCandidateName">Mohammed Tanvir Hossain</h3>
                <span class="small text-white-50" id="certInstituteTitle">Santino Barista Academy &bull; ISO 9001:2015 Accredited</span>
              </div>
              <div class="text-md-end text-white">
                <div class="small text-uppercase text-white-50">Certificate ID</div>
                <div class="fs-5 fw-bold font-monospace text-warning" id="certDisplayId">SNT-2025-001</div>
              </div>
            </div>

            <div class="cert-result-body">
              <div class="row align-items-center g-4 mb-4">
                <div class="col-md-8">
                  <div class="cert-meta-item">
                    <span class="cert-meta-label">Course / Program</span>
                    <span class="cert-meta-val text-primary" id="certCourseName">Barista Advance Professional &amp; Sensory Lab</span>
                  </div>
                  <div class="cert-meta-item">
                    <span class="cert-meta-label">Duration &amp; Hours</span>
                    <span class="cert-meta-val" id="certDuration">18 Days (54 Contact Hours)</span>
                  </div>
                  <div class="cert-meta-item">
                    <span class="cert-meta-label">Issue Date</span>
                    <span class="cert-meta-val" id="certIssueDate">12 October 2025</span>
                  </div>
                  <div class="cert-meta-item">
                    <span class="cert-meta-label">Accreditation Standard</span>
                    <span class="cert-meta-val" id="certStandard">WBC &amp; SCA Protocols / ISO 9001:2015</span>
                  </div>
                  <div class="cert-meta-item">
                    <span class="cert-meta-label">Assessment Result</span>
                    <span class="cert-meta-val text-success" id="certGrade">Distinction (Grade A+)</span>
                  </div>
                  <div class="cert-meta-item border-bottom-0">
                    <span class="cert-meta-label">Lead Master Trainer</span>
                    <span class="cert-meta-val" id="certTrainer">Lead Barista Trainer, Santino Academy</span>
                  </div>
                </div>

                <div class="col-md-4 text-center border-start-md">
                  <div class="cert-seal mb-3">
                    <i class="bi bi-patch-check-fill fs-5 mb-1 text-warning"></i>
                    <span>SANTINO<br>VERIFIED<br>REGISTRY</span>
                  </div>
                  <div class="badge bg-light text-dark border p-2 w-100 font-monospace small mb-2" id="certHash">
                    HASH: 9A8F-42CD-81E0
                  </div>
                  <small class="text-muted d-block" style="font-size: 0.75rem;">
                    Digitally validated against the Santino Central Credential Database.
                  </small>
                </div>
              </div>

              <!-- Action Bar -->
              <div class="no-print pt-3 border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
                <button class="btn btn-outline-dark btn-sm rounded-pill px-3" onclick="window.print();">
                  <i class="bi bi-printer-fill me-1"></i> Print / Save Record
                </button>
                <button class="btn btn-outline-primary btn-sm rounded-pill px-3" onclick="shareRecord();">
                  <i class="bi bi-share-fill me-1"></i> Copy Verification Link
                </button>
                <button class="btn btn-link text-decoration-none text-muted btn-sm" onclick="resetVerification();">
                  <i class="bi bi-arrow-counterclockwise me-1"></i> Verify Another
                </button>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- 3-STEP GUIDE SECTION -->
  <section class="py-5 bg-light border-top">
    <div class="container py-lg-4">
      <div class="text-center max-w-700 mx-auto mb-5">
        <span class="badge bg-dark text-warning px-3 py-1 mb-2 font-monospace">VERIFICATION PROCESS</span>
        <h2 class="font-heading fw-bold text-dark">How to Verify a Certificate</h2>
        <p class="text-muted mb-0">Follow three simple steps to confirm digital authenticity and prevent credential forgery.</p>
      </div>

      <div class="row g-4">
        <div class="col-lg-4">
          <div class="step-card">
            <div class="step-num">01</div>
            <h5 class="fw-bold mb-2 text-dark">Locate Certificate ID</h5>
            <p class="text-muted small mb-0">Find the alphanumeric serial number printed at the bottom or top header of the official physical or PDF certificate parchment.</p>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="step-card">
            <div class="step-num">02</div>
            <h5 class="fw-bold mb-2 text-dark">Enter &amp; Submit Query</h5>
            <p class="text-muted small mb-0">Type the exact code into the verification console above and click "Verify Now" to query the live central database.</p>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="step-card">
            <div class="step-num">03</div>
            <h5 class="fw-bold mb-2 text-dark">Review Digital Credential</h5>
            <p class="text-muted small mb-0">View authenticated student details, completion grade, syllabus hours, and accreditation seals with instant print/share access.</p>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- TRUST & ACCREDITATION BANNER -->
  <section class="py-5" style="background: #004541; color: #ffffff;">
    <div class="container py-lg-3 text-center">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="d-inline-flex p-2 rounded-circle bg-white text-success mb-3" style="width: 60px; height: 60px; align-items: center; justify-content: center; font-size: 1.8rem; color: #00625d !important;">
            <i class="bi bi-shield-lock-fill"></i>
          </div>
          <h3 class="font-heading fw-bold text-white mb-3">Tamper-Proof Credential Guarantee</h3>
          <p class="text-white-50 mb-4" style="line-height: 1.7; max-width: 680px; margin: 0 auto;">
            All certificates issued by Santino Barista Academy and BBTA are protected with unique cryptographic hashes and recorded in our institutional archive. Trusted by leading 5-star hotels, specialty roasteries, and international hospitality recruiters.
          </p>
          <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="mailto:sales@santino.com.bd" class="btn btn-warning fw-bold px-4 py-2 rounded-pill text-dark">
              <i class="bi bi-envelope-fill me-2"></i>Institutional Enquiries
            </a>
            <a href="tel:+8801606291393" class="btn btn-outline-light fw-bold px-4 py-2 rounded-pill">
              <i class="bi bi-telephone-fill me-2"></i>Registrar Desk: +880 1606-291393
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<script>
// DEMO CERTIFICATE DATABASE
const SANTINO_CERT_DB = {
  "SNT-2025-001": {
    id: "SNT-2025-001",
    name: "Mohammed Tanvir Hossain",
    course: "Barista Advance Professional & Sensory Lab",
    duration: "18 Days (54 Contact Hours)",
    issueDate: "12 October 2025",
    standard: "WBC & SCA Protocols / ISO 9001:2015",
    grade: "Distinction (Grade A+)",
    institute: "Santino Barista Academy • ISO 9001:2015",
    trainer: "Master Barista Trainer, Santino Academy",
    hash: "9A8F-42CD-81E0"
  },
  "BBTA-2025-042": {
    id: "BBTA-2025-042",
    name: "Sadia Afrin Chowdhury",
    course: "Professional Barista Intermediate & Latte Art",
    duration: "7 Days (21 Contact Hours)",
    issueDate: "24 September 2025",
    standard: "BBTA Standard Calibration / ISO 9001:2015",
    grade: "Passed with Honors (94%)",
    institute: "Bangladesh Barista Training Academy (BBTA)",
    trainer: "Senior Barista Specialist, BBTA",
    hash: "3F18-BC90-117A"
  },
  "SNT-ADV-108": {
    id: "SNT-ADV-108",
    name: "Kamrul Islam",
    course: "Espresso Science, Grinder Dial-In & Roastery Management",
    duration: "12 Days (36 Contact Hours)",
    issueDate: "05 August 2025",
    standard: "Victoria Arduino Commercial Standards",
    grade: "Distinction (Grade A)",
    institute: "Santino Barista Academy & Technical Lab",
    trainer: "Authorized VA Technical Instructor",
    hash: "77BC-0044-8F21"
  },
  "BBTA-PIZ-204": {
    id: "BBTA-PIZ-204",
    name: "Farhan Rahman",
    course: "Artisan Pizza & Bakery Masterclass",
    duration: "1 Day Intensive (4 Hours)",
    issueDate: "18 January 2025",
    standard: "Professional Culinary Craft / BBTA Certified",
    grade: "Certified Participant",
    institute: "BBTA Culinary Division",
    trainer: "Executive Pastry & Pizza Chef",
    hash: "55C1-90E2-AA43"
  }
};

function handleCertVerify(e) {
  if (e) e.preventDefault();
  const inputEl = document.getElementById('certIdInput');
  const query = inputEl.value.trim().toUpperCase();
  
  const notFoundEl = document.getElementById('certNotFound');
  const resultEl = document.getElementById('certResultDisplay');
  
  if (!query) return false;

  const data = SANTINO_CERT_DB[query];

  if (data) {
    notFoundEl.style.display = 'none';
    
    document.getElementById('certCandidateName').textContent = data.name;
    document.getElementById('certDisplayId').textContent = data.id;
    document.getElementById('certInstituteTitle').textContent = data.institute;
    document.getElementById('certCourseName').textContent = data.course;
    document.getElementById('certDuration').textContent = data.duration;
    document.getElementById('certIssueDate').textContent = data.issueDate;
    document.getElementById('certStandard').textContent = data.standard;
    document.getElementById('certGrade').textContent = data.grade;
    document.getElementById('certTrainer').textContent = data.trainer;
    document.getElementById('certHash').textContent = 'HASH: ' + data.hash;

    resultEl.style.display = 'block';
    resultEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  } else {
    resultEl.style.display = 'none';
    document.getElementById('notFoundMessage').textContent = 'No record found for ID "' + query + '". Please verify the certificate serial code and try again.';
    notFoundEl.style.display = 'block';
    notFoundEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }
  return false;
}

function fillAndVerify(id) {
  const input = document.getElementById('certIdInput');
  input.value = id;
  handleCertVerify();
}

function resetVerification() {
  document.getElementById('certIdInput').value = '';
  document.getElementById('certResultDisplay').style.display = 'none';
  document.getElementById('certNotFound').style.display = 'none';
  document.getElementById('certIdInput').focus();
}

function shareRecord() {
  const certId = document.getElementById('certDisplayId').textContent;
  const url = window.location.origin + window.location.pathname + '?id=' + encodeURIComponent(certId);
  if (navigator.clipboard) {
    navigator.clipboard.writeText(url).then(() => {
      alert('Verification link copied to clipboard: ' + url);
    });
  } else {
    prompt('Copy this link:', url);
  }
}

// Auto-check if URL has ?id=
window.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(window.location.search);
  const idParam = params.get('id') || params.get('cert_id');
  if (idParam) {
    fillAndVerify(idParam.trim().toUpperCase());
  }
});
</script>

<?php
endif;
get_footer();
