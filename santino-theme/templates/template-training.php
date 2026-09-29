<?php
/**
 * Template Name: Barista Training Page
 *
 * @package Santino
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            $content = get_the_content();
            if ( ! empty( $content ) ) {
                the_content();
            } else {
                ?>
                <section class="py-5 bg-dark text-white text-center">
                    <div class="container py-4">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">BARISTA ACADEMY</span>
                        <h1 class="display-4 fw-bold font-heading text-white">Professional Barista Training &amp; SCA Certification</h1>
                        <p class="lead text-light opacity-75 mx-auto" style="max-width: 700px;">
                            Hands-on espresso extraction, milk texturing, latte art, sensoric cupping, and cafe operation skills in Dhaka.
                        </p>
                    </div>
                </section>

                <section class="py-5 bg-light">
                    <div class="container-fluid px-lg-5">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                    <div class="badge bg-primary rounded-pill align-self-start mb-2">FOUNDATION COURSE</div>
                                    <h3 class="h5 fw-bold font-heading">Commercial Barista Essentials</h3>
                                    <p class="small text-muted">Espresso grinder calibration, extraction chemistry, steaming silk microfoam, machine maintenance, and customer service.</p>
                                    <hr>
                                    <ul class="list-unstyled small text-muted mb-4">
                                        <li><i class="bi bi-clock me-2 text-warning"></i> Duration: 3 Days (15 Hours)</li>
                                        <li><i class="bi bi-award me-2 text-success"></i> Santino Barista Certificate</li>
                                        <li><i class="bi bi-tag me-2 text-primary"></i> Fee: ৳ 12,000</li>
                                    </ul>
                                    <button class="btn btn-dark w-100 rounded-pill mt-auto" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enroll Now</button>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                    <div class="badge bg-warning text-dark rounded-pill align-self-start mb-2">ADVANCED ART</div>
                                    <h3 class="h5 fw-bold font-heading">Latte Art &amp; Manual Brewing</h3>
                                    <p class="small text-muted">V60, Chemex, Aeropress recipes, TDS extraction yield, free-pour swan, winged tulip, and rosetta patterns.</p>
                                    <hr>
                                    <ul class="list-unstyled small text-muted mb-4">
                                        <li><i class="bi bi-clock me-2 text-warning"></i> Duration: 2 Days (10 Hours)</li>
                                        <li><i class="bi bi-award me-2 text-success"></i> Masterclass Certificate</li>
                                        <li><i class="bi bi-tag me-2 text-primary"></i> Fee: ৳ 15,000</li>
                                    </ul>
                                    <button class="btn btn-warning w-100 rounded-pill fw-bold text-dark mt-auto" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enroll Now</button>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                    <div class="badge bg-success rounded-pill align-self-start mb-2">B2B CAFE TEAM</div>
                                    <h3 class="h5 fw-bold font-heading">Cafe Opening &amp; Staff Training</h3>
                                    <p class="small text-muted">Complete SOP development, menu formulation, staff workflow management, speed tests, and quality audits.</p>
                                    <hr>
                                    <ul class="list-unstyled small text-muted mb-4">
                                        <li><i class="bi bi-clock me-2 text-warning"></i> Tailored 5-7 Days Program</li>
                                        <li><i class="bi bi-award me-2 text-success"></i> Turnkey On-Site Training</li>
                                        <li><i class="bi bi-tag me-2 text-primary"></i> Custom Corporate Quote</li>
                                    </ul>
                                    <button class="btn btn-outline-dark w-100 rounded-pill mt-auto" data-bs-toggle="modal" data-bs-target="#enquiryModal">Request Proposal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            }
        endwhile;
    endif;
    ?>
</main>

<?php
get_footer();
