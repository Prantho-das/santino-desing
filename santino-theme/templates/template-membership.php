<?php
/**
 * Template Name: Membership Page
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
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">VIP CLUB</span>
                        <h1 class="display-4 fw-bold font-heading text-white">Santino Coffee Connoisseur Club</h1>
                        <p class="lead text-light opacity-75 mx-auto" style="max-width: 700px;">
                            Unlock wholesale pricing, exclusive roast releases, priority AMC support, and invitation-only cupping events.
                        </p>
                    </div>
                </section>

                <section class="py-5 bg-light">
                    <div class="container-fluid px-lg-5">
                        <div class="row g-4 justify-content-center">
                            <!-- Silver Tier -->
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 text-center bg-white">
                                    <div class="mb-3"><i class="bi bi-shield-shaded text-secondary fs-1"></i></div>
                                    <h3 class="h4 fw-bold font-heading">Silver Member</h3>
                                    <p class="text-muted small">Ideal for Home Baristas &amp; Coffee Aficionados</p>
                                    <div class="display-6 fw-bold text-dark my-3">Free</div>
                                    <hr>
                                    <ul class="list-unstyled text-start small text-muted mb-4">
                                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> 5% discount on all fresh bean orders</li>
                                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Early access to seasonal microlots</li>
                                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Free brewing guides and recipes</li>
                                    </ul>
                                    <button class="btn btn-outline-dark w-100 rounded-pill mt-auto" data-bs-toggle="modal" data-bs-target="#enquiryModal">Join Silver Free</button>
                                </div>
                            </div>

                            <!-- Gold Tier -->
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-2 border-warning rounded-4 shadow-sm p-4 text-center bg-white position-relative">
                                    <span class="position-absolute top-0 start-50 translate-middle badge bg-warning text-dark rounded-pill px-3 py-2">MOST VALUABLE</span>
                                    <div class="mb-3 mt-2"><i class="bi bi-trophy-fill text-warning fs-1"></i></div>
                                    <h3 class="h4 fw-bold font-heading">Gold Commercial</h3>
                                    <p class="text-muted small">For Cafes, Restaurants &amp; Corporate Offices</p>
                                    <div class="display-6 fw-bold text-dark my-3">৳ 25,000 <span class="fs-6 text-muted fw-normal">/ year</span></div>
                                    <hr>
                                    <ul class="list-unstyled text-start small text-muted mb-4">
                                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> 12% wholesale rate on coffee beans</li>
                                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Guaranteed 4-hour emergency breakdown visit</li>
                                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> 4 Free quarterly machine health checkups</li>
                                        <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> 2 Free Barista Academy course vouchers</li>
                                    </ul>
                                    <button class="btn btn-warning w-100 rounded-pill fw-bold text-dark mt-auto" data-bs-toggle="modal" data-bs-target="#enquiryModal">Join Gold VIP</button>
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
