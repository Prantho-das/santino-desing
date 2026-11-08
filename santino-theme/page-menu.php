<?php
/**
 * Template Name: Santino Beverage & Cafe Menu
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();
?>

<div class="menu-page-wrap">
  <?php
  while ( have_posts() ) :
      the_post();
      the_content();
  endwhile;
  ?>
</div>

<?php
get_template_part( 'template-parts/menu-modals' );
get_footer();
