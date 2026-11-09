<?php
/**
 * Template Name: Santino VIP Coffee Club Membership
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();
?>

<div class="membership-page-wrap">
  <?php
  while ( have_posts() ) :
      the_post();
      the_content();
  endwhile;
  ?>
</div>

<?php
get_footer();
