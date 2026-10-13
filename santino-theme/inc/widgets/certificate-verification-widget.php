<?php
/**
 * Elementor Certificate Verification Widget
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Certificate_Verification_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_certificate_verification';
    }

    public function get_title() {
        return esc_html__( 'Santino Certificate Verification Console', 'santino' );
    }

    public function get_icon() {
        return 'eicon-document-file';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Hero & Content Settings', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'   => esc_html__( 'Pill Badge', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Official Registry & Accreditation',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Hero Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Certificate Verification',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Hero Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Instantly verify the authenticity of credentials issued by Santino Barista Academy & Bangladesh Barista Training Academy (BBTA).',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="cert-verify-wrap">
          <!-- HERO SECTION -->
          <section class="cert-hero" style="background-image: url('<?php echo santino_img('bd-barista-training.jpg'); ?>'); background-position: center; background-size: cover; position: relative; min-height: 48vh; display: flex; align-items: center;">
            <div class="cert-hero-overlay" style="position: absolute; inset: 0; background: linear-gradient(180deg, rgba(10, 20, 20, 0.82) 0%, rgba(10, 20, 20, 0.94) 100%);"></div>
            <div class="container position-relative py-5 text-center text-white" style="z-index: 2;">
              <div class="mx-auto" style="max-width: 780px;">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(195, 153, 108, 0.18); border: 1px solid rgba(195, 153, 108, 0.4);">
                  <i class="bi bi-shield-fill-check text-warning"></i>
                  <span class="small fw-bold text-uppercase" style="letter-spacing: 1px; color: #dfc49f;"><?php echo esc_html( $settings['badge_text'] ); ?></span>
                </div>
                <h1 class="display-4 fw-bold font-heading mb-3 text-white"><?php echo esc_html( $settings['title'] ); ?></h1>
                <p class="lead mb-4 text-white-50" style="font-size: 1.15rem; line-height: 1.6;">
                  <?php echo esc_html( $settings['subtitle'] ); ?>
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
                  <div class="cert-search-card" style="background: #ffffff; border-radius: 16px; border: 1px solid rgba(0, 98, 93, 0.12); box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08); padding: 2.25rem; margin-top: -60px; position: relative; z-index: 10;">
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
                          <div class="cert-input-group position-relative d-flex align-items-center">
                            <i class="bi bi-search position-absolute" style="left: 1.15rem; color: #00625d; font-size: 1.35rem; pointer-events: none;"></i>
                            <input type="text" id="certIdInput" class="form-control" style="font-size: 1.15rem; font-weight: 600; letter-spacing: 0.5px; border: 2px solid #d9e2ec; border-radius: 12px; padding: 0.95rem 1.15rem 0.95rem 3.2rem; text-transform: uppercase;" placeholder="e.g. SNT-2025-001 or BBTA-2025-042" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <button type="submit" id="btnVerifySubmit" class="btn w-100" style="background: #00625d; color: #fff; font-weight: 700; padding: 0.95rem 2rem; border-radius: 12px;">
                            <i class="bi bi-shield-check me-1"></i> Verify Now
                          </button>
                        </div>
                      </div>
                    </form>

                    <div class="mt-3 pt-3 border-top d-flex flex-wrap align-items-center gap-2">
                      <span class="small text-muted fw-semibold me-1">Try demo IDs:</span>
                      <a href="javascript:void(0)" class="badge bg-light text-dark border text-decoration-none p-2" onclick="fillAndVerify('SNT-2025-001')">SNT-2025-001</a>
                      <a href="javascript:void(0)" class="badge bg-light text-dark border text-decoration-none p-2" onclick="fillAndVerify('BBTA-2025-042')">BBTA-2025-042</a>
                      <a href="javascript:void(0)" class="badge bg-light text-dark border text-decoration-none p-2" onclick="fillAndVerify('SNT-ADV-108')">SNT-ADV-108</a>
                    </div>
                  </div>

                  <!-- NOT FOUND -->
                  <div id="certNotFound" class="alert alert-warning mt-4 text-center" style="display: none; border-radius: 14px;">
                    <i class="bi bi-exclamation-triangle-fill fs-3 text-danger d-block mb-2"></i>
                    <h5 class="fw-bold">Certificate Record Not Found</h5>
                    <p class="mb-0" id="notFoundMessage">Please check the ID and try again.</p>
                  </div>

                  <!-- RESULT CARD -->
                  <div id="certResultDisplay" class="card mt-4 shadow-sm border-2" style="display: none; border-color: #c3996c; border-radius: 16px; overflow: hidden;">
                    <div class="card-header text-white p-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #00625d 0%, #004541 100%);">
                      <div>
                        <span class="badge bg-success mb-1"><i class="bi bi-check-circle-fill me-1"></i> AUTHENTIC &amp; VERIFIED</span>
                        <h4 class="mb-0 text-white fw-bold" id="certCandidateName">Mohammed Tanvir Hossain</h4>
                        <small class="text-white-50" id="certInstituteTitle">Santino Barista Academy</small>
                      </div>
                      <div class="text-end">
                        <small class="text-white-50 d-block">ID</small>
                        <span class="fw-bold fs-5 text-warning font-monospace" id="certDisplayId">SNT-2025-001</span>
                      </div>
                    </div>
                    <div class="card-body p-4 bg-light">
                      <div class="row g-3">
                        <div class="col-sm-6">
                          <small class="text-muted fw-bold d-block">COURSE</small>
                          <span class="fw-bold text-dark" id="certCourseName">Barista Advance Professional</span>
                        </div>
                        <div class="col-sm-6">
                          <small class="text-muted fw-bold d-block">HOURS</small>
                          <span class="fw-bold text-dark" id="certDuration">18 Days (54 Hours)</span>
                        </div>
                        <div class="col-sm-6">
                          <small class="text-muted fw-bold d-block">ISSUE DATE</small>
                          <span class="fw-bold text-dark" id="certIssueDate">12 October 2025</span>
                        </div>
                        <div class="col-sm-6">
                          <small class="text-muted fw-bold d-block">RESULT</small>
                          <span class="fw-bold text-success" id="certGrade">Distinction (Grade A+)</span>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </section>
        </div>
        <?php
    }
}
