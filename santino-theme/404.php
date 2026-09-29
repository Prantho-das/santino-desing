<?php
/**
 * 404 Error Page
 *
 * @package Santino
 */

get_header();
?>

<main id="primary" class="site-main py-5 my-5 text-center">
    <div class="container py-5">
        <div class="display-1 fw-bold text-warning mb-3">404</div>
        <h1 class="h2 font-heading mb-3">Page Not Found</h1>
        <p class="text-muted mb-4">Sorry, the coffee you are looking for has been brewed or moved elsewhere.</p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-dark rounded-pill px-4 py-2">Back to Homepage</a>
    </div>
</main>

<?php
get_footer();
