<?php
/**
 * Template Name: Our Story Page
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
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">BRAND HERITAGE</span>
                        <h1 class="display-4 fw-bold font-heading text-white">The Santino Roastery Legacy</h1>
                        <p class="lead text-light opacity-75 mx-auto" style="max-width: 700px;">
                            Pioneering specialty coffee culture, world-class Italian espresso equipment, and barista excellence in Bangladesh.
                        </p>
                    </div>
                </section>

                <section class="py-5 bg-white">
                    <div class="container py-4">
                        <div class="row align-items-center g-5">
                            <div class="col-lg-6">
                                <h2 class="display-6 fw-bold font-heading text-dark mb-4">Dedicated to Precision Roasting &amp; Engineering</h2>
                                <p class="text-muted lead">Founded with a vision to revolutionize the hospitality and specialty coffee industry in Bangladesh, Santino delivers end-to-end commercial solutions.</p>
                                <p class="text-muted">From sourcing high-altitude specialty microlots across Africa and Latin America to bringing flagship Italian machines like Nuova Simonelli and Victoria Arduino into top cafes, we stand for uncompromising quality.</p>
                                <div class="d-flex gap-4 pt-3">
                                    <div><div class="h3 fw-bold text-dark mb-0">15+</div><div class="small text-muted">Years Experience</div></div>
                                    <div class="vr"></div>
                                    <div><div class="h3 fw-bold text-dark mb-0">500+</div><div class="small text-muted">Active Cafe Setups</div></div>
                                    <div class="vr"></div>
                                    <div><div class="h3 fw-bold text-dark mb-0">100%</div><div class="small text-muted">SCA Standard</div></div>
                                </div>
                            </div>
                            <div class="col-lg-6 text-center">
                                <img src="<?php echo santino_img( 'banner-1.png' ); ?>" alt="Santino Heritage" class="img-fluid rounded-4 shadow">
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
