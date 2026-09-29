<?php
/**
 * Template Name: Coffee Beans Page
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
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">ARTISAN ROASTERY</span>
                        <h1 class="display-4 fw-bold font-heading text-white">Freshly Roasted Specialty Coffee Beans</h1>
                        <p class="lead text-light opacity-75 mx-auto" style="max-width: 700px;">
                            Ethically sourced single origins and custom espresso blends roasted fresh weekly in Dhaka.
                        </p>
                    </div>
                </section>

                <section class="py-5 bg-light">
                    <div class="container-fluid px-lg-5">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                    <img src="<?php echo santino_img( 'Signature-coffee.png' ); ?>" alt="Signature Blend" class="img-fluid mb-3" style="height: 220px; object-fit: contain;">
                                    <h3 class="h5 fw-bold font-heading">Santino Signature Dark Roast</h3>
                                    <div class="badge bg-secondary align-self-start mb-2">Dark Roast &bull; Espresso</div>
                                    <p class="small text-muted mb-2"><strong>Origin:</strong> Brazil Santos &amp; Colombia Supremo</p>
                                    <p class="small text-muted mb-3"><strong>Flavour:</strong> Dark Cocoa, Roasted Walnut, Caramelized Cane Sugar</p>
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                                        <span class="fw-bold fs-5 text-dark">৳ 1,350 <span class="small text-muted fw-normal">/ 500g</span></span>
                                        <button class="btn btn-dark btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal">Order Now</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                    <img src="<?php echo santino_img( 'Signature-coffee.png' ); ?>" alt="Ethiopia Yirgacheffe" class="img-fluid mb-3" style="height: 220px; object-fit: contain;">
                                    <h3 class="h5 fw-bold font-heading">Ethiopia Yirgacheffe G1</h3>
                                    <div class="badge bg-warning text-dark align-self-start mb-2">Light-Medium Roast &bull; Filter</div>
                                    <p class="small text-muted mb-2"><strong>Origin:</strong> Yirgacheffe, Ethiopia (Washed)</p>
                                    <p class="small text-muted mb-3"><strong>Flavour:</strong> Bergamot, Jasmine Florals, Peach, Citrus Spark</p>
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                                        <span class="fw-bold fs-5 text-dark">৳ 1,850 <span class="small text-muted fw-normal">/ 250g</span></span>
                                        <button class="btn btn-dark btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#enquiryModal">Order Now</button>
                                    </div>
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
