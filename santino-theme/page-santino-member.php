<?php
/**
 * Template Name: Santino Member Portal
 * Template Post Type: page
 *
 * Dedicated layout for /santino-member/ and /coffee-club/
 * Fully editable via Elementor.
 *
 * @package Santino
 */

get_header();
?>

<div class="santino-member-wrap">
  <?php
  while ( have_posts() ) :
      the_post();
      the_content();
  endwhile;
  ?>
</div>

<?php
get_footer();
