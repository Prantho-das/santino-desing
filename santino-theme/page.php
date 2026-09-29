<?php
/**
 * The template for displaying all pages & Elementor canvas/full-width
 *
 * @package Santino
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer();
