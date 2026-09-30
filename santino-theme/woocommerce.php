<?php
/**
 * The template for displaying WooCommerce pages
 *
 * @package Santino
 */

get_header();
?>

<main id="primary" class="site-main py-5">
    <div class="container py-4">
        <?php if ( function_exists( 'woocommerce_content' ) ) : ?>
            <?php woocommerce_content(); ?>
        <?php else : ?>
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
