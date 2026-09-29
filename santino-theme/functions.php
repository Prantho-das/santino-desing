<?php
/**
 * Santino Theme Functions and Definitions
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'SANTINO_VERSION', '1.1.0' );
define( 'SANTINO_DIR', get_template_directory() );
define( 'SANTINO_URI', get_template_directory_uri() );

/**
 * Theme Setup
 */
function santino_theme_setup() {
    load_theme_textdomain( 'santino', SANTINO_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Elementor Support
    add_theme_support( 'elementor' );

    register_nav_menus( array(
        'primary' => __( 'Primary Header Navigation', 'santino' ),
        'topbar'  => __( 'Top Contact Bar Menu', 'santino' ),
        'footer_quick' => __( 'Footer Quick Links', 'santino' ),
        'footer_care'  => __( 'Footer Customer Care', 'santino' ),
    ) );
}
add_action( 'after_setup_theme', 'santino_theme_setup' );

/**
 * Register CSS and JS
 */
function santino_enqueue_scripts() {
    // Bootstrap 5 CSS
    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
    
    // Bootstrap Icons
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '1.11.3' );

    // Google Fonts
    wp_enqueue_style( 'santino-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@1,400;1,600;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Proza+Libre:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap', array(), null );

    // Theme Custom CSS
    wp_enqueue_style( 'santino-main-style', SANTINO_URI . '/assets/css/styles.css', array( 'bootstrap' ), SANTINO_VERSION );
    wp_enqueue_style( 'santino-theme-style', get_stylesheet_uri(), array( 'santino-main-style' ), SANTINO_VERSION );

    // Bootstrap JS
    wp_enqueue_script( 'bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );

    // Custom Script
    wp_enqueue_script( 'santino-script', SANTINO_URI . '/assets/js/script.js', array( 'bootstrap-bundle' ), SANTINO_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'santino_enqueue_scripts' );

/**
 * Register Custom Elementor Category
 */
function santino_register_elementor_category( $elements_manager ) {
    $elements_manager->add_category(
        'santino-category',
        array(
            'title' => esc_html__( 'Santino Coffee Elements', 'santino' ),
            'icon'  => 'fa fa-coffee',
        )
    );
}
add_action( 'elementor/elements/categories_registered', 'santino_register_elementor_category' );

/**
 * Load and Register All Elementor Custom Widgets
 */
function santino_register_elementor_widgets( $widgets_manager ) {
    // Include Widget Classes
    require_once SANTINO_DIR . '/inc/widgets/hero-banner-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/machine-grid-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/coffee-beans-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/academy-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/office-horeca-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/membership-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/brand-slider-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/services-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/testimonials-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/stats-counter-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/faq-accordion-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/cta-banner-widget.php';

    // Register Widgets
    $widgets_manager->register( new \Santino_Hero_Banner_Widget() );
    $widgets_manager->register( new \Santino_Machine_Grid_Widget() );
    $widgets_manager->register( new \Santino_Coffee_Beans_Widget() );
    $widgets_manager->register( new \Santino_Academy_Widget() );
    $widgets_manager->register( new \Santino_Office_Horeca_Widget() );
    $widgets_manager->register( new \Santino_Membership_Widget() );
    $widgets_manager->register( new \Santino_Brand_Slider_Widget() );
    $widgets_manager->register( new \Santino_Services_Widget() );
    $widgets_manager->register( new \Santino_Testimonials_Widget() );
    $widgets_manager->register( new \Santino_Stats_Counter_Widget() );
    $widgets_manager->register( new \Santino_FAQ_Widget() );
    $widgets_manager->register( new \Santino_CTA_Banner_Widget() );
}
add_action( 'elementor/widgets/register', 'santino_register_elementor_widgets' );

/**
 * Custom Helper to Output Image URL easily
 */
function santino_img( $file ) {
    return esc_url( SANTINO_URI . '/assets/images/' . ltrim( $file, '/' ) );
}
