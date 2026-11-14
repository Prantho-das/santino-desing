<?php
/**
 * Template Name: Santino Daily Offers & Promotions
 * Template Post Type: page
 *
 * @package Santino
 */

get_header();
?>

<div class="offers-page-wrap">
  <?php
  $has_elementor = function_exists( 'santino_is_elementor_page' ) && santino_is_elementor_page( get_the_ID() );
  if ( $has_elementor ) :
      while ( have_posts() ) :
          the_post();
          the_content();
      endwhile;
  else :
      $banner_img = function_exists( 'santino_get_img' ) ? santino_get_img( 'banner-signature-lattes.jpg', 'placeholder-banner.jpg' ) : '';
  ?>
  <section class="pro-banner-hero position-relative d-flex align-items-center text-center text-white" style="min-height: 430px; background: linear-gradient(135deg, rgba(0, 45, 43, 0.92) 0%, rgba(0, 98, 93, 0.85) 100%)<?php echo $banner_img ? ', url(' . esc_url( $banner_img ) . ') center/cover no-repeat' : ''; ?>; padding: 90px 0 70px;">
    <div class="container position-relative" style="max-width: 820px; z-index: 2;">
      <div class="sec-pill-badge-wrap light mb-3">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-stars me-1 text-warning"></i> 7 DAYS, 7 REASONS TO CELEBRATE</span>
        <span class="sec-pill-line"></span>
      </div>
      <h1 class="pro-banner-title mb-3" style="font-family: var(--kp-font-title, 'Montserrat', sans-serif); font-size: clamp(2.2rem, 4.5vw, 3.5rem); font-weight: 900; line-height: 1.18; color: #ffffff;">
        Daily <span style="color: #dfbe8d;">3 + 1 FREE</span> Cafe Offers
      </h1>
      <p class="pro-banner-desc mb-4 mx-auto" style="max-width: 640px; font-size: 1.06rem; color: rgba(255,255,255,0.92);">
        Enjoy a new handcrafted beverage privilege every day of the week — plus earn 3 VIP Coffee Stamps toward your 5-Cup Free Drink Card!
      </p>
      <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
        <a href="#dailyPromos" class="btn-hero-lifestyle">
          <span>See Today's Offer</span>
          <i class="bi bi-arrow-down-short"></i>
        </a>
        <a href="<?php echo esc_url( home_url( '/membership/#clubPortal' ) ); ?>" class="btn-hero-outline">
          <i class="bi bi-gem text-warning"></i>
          <span>VIP Stamp Portal</span>
        </a>
      </div>
    </div>
  </section>

  <?php
  if ( class_exists( 'Santino_Membership_System' ) ) {
      echo Santino_Membership_System::render_daily_promotions_markup( array(
          'layout'      => 'grid',
          'show_header' => true,
      ) );
  }
  ?>

  <section class="py-5 bg-white border-top text-center">
    <div class="container py-3" style="max-width: 740px;">
      <div class="sec-pill-badge-wrap mb-2">
        <span class="sec-pill-line"></span>
        <span class="sec-pill-badge"><i class="bi bi-award-fill me-1"></i> STACK WITH VIP CLUB</span>
        <span class="sec-pill-line"></span>
      </div>
      <h2 class="sec-title mb-2">Double Your Rewards With <span class="sec-title-accent">VIP Membership</span></h2>
      <p class="text-muted mb-4" style="font-size: 0.98rem; line-height: 1.6;">
        Claim any 3 + 1 FREE daily offer and submit your invoice in the Santino VIP Portal to collect 3 Coffee Stamps (Buy 5, Get 1 Free) + 15% off artisan beans.
      </p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="<?php echo esc_url( home_url( '/membership/#clubPortal' ) ); ?>" class="btn-hero-lifestyle">
          <span>Log Invoice &amp; Earn Stamps</span>
          <i class="bi bi-arrow-right"></i>
        </a>
        <a href="<?php echo esc_url( home_url( '/menu/' ) ); ?>" class="btn-hero-lifestyle" style="background: #1a2b28 !important; border-color: #1a2b28 !important;">
          <span>Explore Full Menu</span>
          <i class="bi bi-cup-hot"></i>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>
</div>

<?php
get_footer();
