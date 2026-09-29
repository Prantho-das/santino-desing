<?php
/**
 * Template Name: Menu & Cafes Page
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
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">CAFE EXPERIENCE</span>
                        <h1 class="display-4 fw-bold font-heading text-white">Artisan Beverage Menu &amp; Outlets</h1>
                        <p class="lead text-light opacity-75 mx-auto" style="max-width: 700px;">
                            Crafted espresso, cold brews, loose leaf teas, and signature gourmet pastries served at Santino Flagship Cafes.
                        </p>
                    </div>
                </section>

                <section class="py-5 bg-light" id="menu-items">
                    <div class="container-fluid px-lg-5">
                        <div class="row g-4">
                            <!-- Hot Coffee -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="h5 fw-bold font-heading mb-0">Caffè Espresso</h4>
                                            <span class="badge bg-warning text-dark fw-bold">৳ 180</span>
                                        </div>
                                        <p class="small text-muted mb-0">Double ristretto shot pulled with 1:2 ratio on Nuova Simonelli.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Cappuccino -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="h5 fw-bold font-heading mb-0">Velvet Cappuccino</h4>
                                            <span class="badge bg-warning text-dark fw-bold">৳ 260</span>
                                        </div>
                                        <p class="small text-muted mb-0">Rich espresso topped with dense, silky microfoam and cocoa dust.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Spanish Latte -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="h5 fw-bold font-heading mb-0">Spanish Latte</h4>
                                            <span class="badge bg-warning text-dark fw-bold">৳ 320</span>
                                        </div>
                                        <p class="small text-muted mb-0">Sweetened condensed milk blended with double espresso and textured milk.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Cold Brew -->
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-3 bg-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h4 class="h5 fw-bold font-heading mb-0">Nitro Cold Brew</h4>
                                            <span class="badge bg-warning text-dark fw-bold">৳ 350</span>
                                        </div>
                                        <p class="small text-muted mb-0">18-hour cold steeped single origin infused with nitrogen draft for creamy head.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Branches Section -->
                        <div class="mt-5 pt-4 border-top" id="branches">
                            <h2 class="display-6 fw-bold font-heading text-center mb-4">Visit Our Roastery &amp; Experience Centers</h2>
                            <div class="row g-4 justify-content-center">
                                <div class="col-md-5">
                                    <div class="card border-0 rounded-4 shadow-sm p-4 bg-white">
                                        <h4 class="h5 fw-bold font-heading"><i class="bi bi-geo-alt-fill text-warning me-2"></i> Banani Flagship Roastery</h4>
                                        <p class="text-muted small mb-2">House 12, Road 11, Block D, Banani, Dhaka - 1213</p>
                                        <p class="text-muted small mb-0"><i class="bi bi-clock me-1"></i> Open Daily: 8:00 AM &ndash; 11:30 PM</p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card border-0 rounded-4 shadow-sm p-4 bg-white">
                                        <h4 class="h5 fw-bold font-heading"><i class="bi bi-geo-alt-fill text-warning me-2"></i> Gulshan Experience Lounge</h4>
                                        <p class="text-muted small mb-2">Avenue 1, Road 45, Gulshan 2, Dhaka - 1212</p>
                                        <p class="text-muted small mb-0"><i class="bi bi-clock me-1"></i> Open Daily: 8:00 AM &ndash; 12:00 AM</p>
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
