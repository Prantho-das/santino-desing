<?php
/**
 * Template Name: Home Page (Static & Elementor)
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
                // Default Dynamic Theme Sections if Elementor content is empty
                ?>
                <!-- Hero Section -->
                <section class="hero-section py-5 position-relative overflow-hidden">
                    <div class="container-fluid px-lg-5">
                        <div class="row align-items-center g-4">
                            <div class="col-lg-6">
                                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-warning bg-opacity-25 text-dark fw-bold small mb-3 border border-warning border-opacity-50">
                                    <i class="bi bi-patch-check-fill text-warning"></i>
                                    OFFICIAL IMPORTER & ROASTERY
                                </div>
                                <h1 class="display-4 fw-black font-heading text-dark mb-3">
                                    Commercial Espresso Machines &amp; Specialty Roastery in Bangladesh
                                </h1>
                                <p class="lead text-muted mb-4">
                                    Official distributor of Nuova Simonelli, Victoria Arduino, CREM, Kalerm &amp; 3TEMP. Complete turnkey commercial coffee setups with 24/7 technical AMC support.
                                </p>
                                <div class="d-flex flex-wrap gap-3 mb-4">
                                    <a href="<?php echo esc_url( home_url( '/machines' ) ); ?>" class="btn btn-dark btn-lg rounded-pill px-4 fw-bold">
                                        EXPLORE MACHINES <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                    <button class="btn btn-outline-dark btn-lg rounded-pill px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                                        BOOK DEMO
                                    </button>
                                </div>
                                <div class="d-flex align-items-center gap-4 pt-3 border-top">
                                    <div><div class="h4 fw-bold mb-0 text-dark">500+</div><div class="text-muted small">Machines Installed</div></div>
                                    <div class="vr"></div>
                                    <div><div class="h4 fw-bold mb-0 text-dark">24/7</div><div class="text-muted small">Technical Support</div></div>
                                    <div class="vr"></div>
                                    <div><div class="h4 fw-bold mb-0 text-dark">100%</div><div class="text-muted small">Genuine Spare Parts</div></div>
                                </div>
                            </div>
                            <div class="col-lg-6 text-center">
                                <img src="<?php echo santino_img( 'appia-life-front.png' ); ?>" alt="Nuova Simonelli Appia Life" class="img-fluid drop-shadow-hero" style="max-height: 460px; object-fit: contain;">
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
