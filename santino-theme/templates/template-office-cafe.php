<?php
/**
 * Template Name: Office Cafe & Horeca Page
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
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">CORPORATE &amp; HORECA</span>
                        <h1 class="display-4 fw-bold font-heading text-white">Commercial Office Cafe &amp; Hotel Solutions</h1>
                        <p class="lead text-light opacity-75 mx-auto" style="max-width: 700px;">
                            Zero-headache coffee machines, rental leasing packages, automatic replenishment, and 24/7 AMC in Bangladesh.
                        </p>
                    </div>
                </section>

                <section class="py-5 bg-white">
                    <div class="container-fluid px-lg-5">
                        <div class="row g-5 align-items-center mb-5">
                            <div class="col-lg-6">
                                <span class="badge bg-success text-white px-3 py-2 rounded-pill mb-3">ONE-TOUCH AUTOMATION</span>
                                <h2 class="display-6 fw-bold font-heading text-dark mb-3">Elevate Your Workplace Experience</h2>
                                <p class="text-muted lead">Boost productivity and impress your clients with barista-quality Cappuccino, Latte, and Americano at the press of a button.</p>
                                <ul class="list-unstyled text-muted mb-4">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Free machine installation &amp; staff onboarding</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Monthly fresh bean delivery straight from Roastery</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Free regular descaling and preventive maintenance</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Immediate backup machine during breakdown</li>
                                </ul>
                                <button class="btn btn-dark btn-lg rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#enquiryModal">Request Office Free Trial</button>
                            </div>
                            <div class="col-lg-6">
                                <img src="<?php echo santino_img( 'banner-3.png' ); ?>" alt="Office Coffee Setup" class="img-fluid rounded-4 shadow">
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
