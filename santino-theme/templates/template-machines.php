<?php
/**
 * Template Name: Machines Page
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
                <!-- Page Hero -->
                <section class="py-5 bg-dark text-white text-center">
                    <div class="container py-4">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">COMMERCIAL EQUIPMENT</span>
                        <h1 class="display-4 fw-bold font-heading text-white">World-Class Espresso Machines &amp; Automation</h1>
                        <p class="lead text-light opacity-75 mx-auto" style="max-width: 700px;">
                            Authorized distributor for Nuova Simonelli, Victoria Arduino, CREM, Kalerm, and 3TEMP in Bangladesh.
                        </p>
                    </div>
                </section>

                <!-- Dynamic Machines Catalog -->
                <section class="py-5 bg-light">
                    <div class="container-fluid px-lg-5">
                        <div class="row g-4">
                            <!-- Nuova Simonelli -->
                            <div class="col-md-6 col-lg-4" id="nuova-simonelli">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                    <span class="badge bg-dark rounded-pill align-self-start mb-2">ITALY</span>
                                    <img src="<?php echo santino_img( 'appia-life-front.png' ); ?>" alt="Nuova Simonelli Appia Life" class="img-fluid my-3" style="height: 200px; object-fit: contain;">
                                    <h3 class="h5 fw-bold font-heading">Nuova Simonelli Appia Life</h3>
                                    <p class="small text-muted mb-3">2 Group volumetric espresso machine with Soft Infusion System (SIS), dual cool-touch steam wands, and high cup capacity.</p>
                                    <div class="mt-auto d-flex gap-2">
                                        <button class="btn btn-outline-dark rounded-pill flex-grow-1 btn-sm" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquire</button>
                                        <a href="https://wa.me/8801700000000?text=Nuova Simonelli Appia Life" target="_blank" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-whatsapp"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Victoria Arduino -->
                            <div class="col-md-6 col-lg-4" id="victoria-arduino">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                    <span class="badge bg-warning text-dark rounded-pill align-self-start mb-2">FLAGSHIP</span>
                                    <img src="<?php echo santino_img( 'victoria-arduino-e1-prima.png' ); ?>" alt="Victoria Arduino E1 Prima" class="img-fluid my-3" style="height: 200px; object-fit: contain;">
                                    <h3 class="h5 fw-bold font-heading">Victoria Arduino E1 Prima</h3>
                                    <p class="small text-muted mb-3">Single-group specialty espresso machine with NEO engine, instant heating, app control, and extreme thermodynamic stability.</p>
                                    <div class="mt-auto d-flex gap-2">
                                        <button class="btn btn-outline-dark rounded-pill flex-grow-1 btn-sm" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquire</button>
                                        <a href="https://wa.me/8801700000000?text=Victoria Arduino E1 Prima" target="_blank" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-whatsapp"></i></a>
                                    </div>
                                </div>
                            </div>

                            <!-- Kalerm -->
                            <div class="col-md-6 col-lg-4" id="kalerm">
                                <div class="card h-100 border-0 rounded-4 shadow-sm p-4 bg-white">
                                    <span class="badge bg-info text-dark rounded-pill align-self-start mb-2">SMART AUTOMATION</span>
                                    <img src="<?php echo santino_img( 'kalerm-k95.png' ); ?>" alt="Kalerm K95L Commercial" class="img-fluid my-3" style="height: 200px; object-fit: contain;">
                                    <h3 class="h5 fw-bold font-heading">Kalerm K95L Commercial</h3>
                                    <p class="small text-muted mb-3">One-touch bean-to-cup automation with 7" HD touchscreen, fresh milk foaming system, dual boilers, and IoT telemetry.</p>
                                    <div class="mt-auto d-flex gap-2">
                                        <button class="btn btn-outline-dark rounded-pill flex-grow-1 btn-sm" data-bs-toggle="modal" data-bs-target="#enquiryModal">Enquire</button>
                                        <a href="https://wa.me/8801700000000?text=Kalerm K95L" target="_blank" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-whatsapp"></i></a>
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
