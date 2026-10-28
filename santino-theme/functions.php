<?php
/**
 * Santino Theme Functions and Definitions
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'SANTINO_VERSION', time() );
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

    // Elementor & WooCommerce Support
    add_theme_support( 'elementor' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Ensure Elementor does not override custom fonts and colors
    if ( get_option( 'elementor_disable_color_schemes' ) !== 'yes' ) {
        update_option( 'elementor_disable_color_schemes', 'yes' );
    }
    if ( get_option( 'elementor_disable_typography_schemes' ) !== 'yes' ) {
        update_option( 'elementor_disable_typography_schemes', 'yes' );
    }

    register_nav_menus( array(
        'primary' => __( 'Primary Header Navigation', 'santino' ),
        'topbar'  => __( 'Top Contact Bar Menu', 'santino' ),
        'footer_quick' => __( 'Footer Quick Links', 'santino' ),
        'footer_care'  => __( 'Footer Customer Care', 'santino' ),
    ) );
}
add_action( 'after_setup_theme', 'santino_theme_setup' );

function santino_is_elementor_page( $post_id = null ) {
    if ( ! class_exists( '\Elementor\Plugin' ) ) {
        return false;
    }
    if ( \Elementor\Plugin::$instance->editor->is_edit_mode() || \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
        return true;
    }
    if ( ! $post_id ) {
        $post_id = get_the_ID() ? get_the_ID() : get_queried_object_id();
    }
    if ( ! $post_id ) {
        return false;
    }
    $document = \Elementor\Plugin::$instance->documents->get( $post_id );
    if ( $document && $document->is_built_with_elementor() ) {
        return true;
    }
    return get_post_meta( $post_id, '_elementor_edit_mode', true ) === 'builder';
}


/**
 * Update WooCommerce Cart Count via AJAX
 */
function santino_woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger header-cart-count" style="font-size: 10px;">
        <?php echo WC()->cart ? esc_html( WC()->cart->get_cart_contents_count() ) : '0'; ?>
    </span>
    <?php
    $fragments['span.header-cart-count'] = ob_get_clean();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'santino_woocommerce_header_add_to_cart_fragment' );

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

    // Theme Custom CSS - Primary style.css + assets/css/styles.css fallback
    wp_enqueue_style( 'santino-theme-style', get_stylesheet_uri(), array( 'bootstrap' ), SANTINO_VERSION );
    if ( file_exists( SANTINO_DIR . '/assets/css/styles.css' ) ) {
        wp_enqueue_style( 'santino-main-style', SANTINO_URI . '/assets/css/styles.css', array( 'santino-theme-style' ), SANTINO_VERSION );
    }

    // Bootstrap JS
    wp_enqueue_script( 'bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '5.3.3', true );

    // Custom Script (Checks assets/js first, falls back to root script.js)
    $script_src = file_exists( SANTINO_DIR . '/assets/js/script.js' ) ? ( SANTINO_URI . '/assets/js/script.js' ) : ( SANTINO_URI . '/script.js' );
    $menu_src   = file_exists( SANTINO_DIR . '/assets/js/menu.js' ) ? ( SANTINO_URI . '/assets/js/menu.js' ) : ( SANTINO_URI . '/menu.js' );

    wp_enqueue_script( 'santino-script', $script_src, array( 'bootstrap-bundle' ), SANTINO_VERSION, true );
    wp_enqueue_script( 'santino-menu-js', $menu_src, array( 'bootstrap-bundle', 'santino-script' ), SANTINO_VERSION, true );

    // Localize AJAX parameters for Frontend
    wp_localize_script( 'santino-script', 'santino_ajax', array(
        'ajax_url'  => admin_url( 'admin-ajax.php' ),
        'nonce'     => wp_create_nonce( 'santino_frontend_nonce' ),
        'theme_uri' => SANTINO_URI,
    ) );
}
add_action( 'wp_enqueue_scripts', 'santino_enqueue_scripts', 99 );

add_action( 'elementor/frontend/after_enqueue_styles', function() {
    wp_enqueue_style( 'santino-theme-style', get_stylesheet_uri(), array( 'elementor-frontend' ), SANTINO_VERSION );
}, 99 );

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
    require_once SANTINO_DIR . '/inc/widgets/cafe-menu-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/outlets-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/story-timeline-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/brands-showcase-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/bfc-solution-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/swapno-retail-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/pro-banner-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/floating-metrics-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/editorial-gallery-widget.php';
    require_once SANTINO_DIR . '/inc/widgets/certificate-verification-widget.php';

    // Register Widgets
    $widgets_manager->register( new \Santino_Hero_Banner_Widget() );
    $widgets_manager->register( new \Santino_Pro_Banner_Widget() );
    $widgets_manager->register( new \Santino_Floating_Metrics_Widget() );
    $widgets_manager->register( new \Santino_Editorial_Gallery_Widget() );
    $widgets_manager->register( new \Santino_Certificate_Verification_Widget() );
    $widgets_manager->register( new \Santino_Outlets_Widget() );
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
    $widgets_manager->register( new \Santino_Cafe_Menu_Widget() );
    $widgets_manager->register( new \Santino_Story_Timeline_Widget() );
    $widgets_manager->register( new \Santino_Brands_Showcase_Widget() );
    $widgets_manager->register( new \Santino_BFC_Solution_Widget() );
    $widgets_manager->register( new \Santino_Swapno_Retail_Widget() );
}
add_action( 'elementor/widgets/register', 'santino_register_elementor_widgets' );

/**
 * Custom Helper to Output Image URL easily with dynamic Media Library fallback
 * and high quality category-aware placeholder images
 */
function santino_img( $file = '' ) {
    if ( empty( $file ) ) {
        return esc_url( file_exists( SANTINO_DIR . '/placeholder.jpg' ) ? ( SANTINO_URI . '/placeholder.jpg' ) : ( SANTINO_URI . '/assets/images/placeholder.jpg' ) );
    }

    $clean_file = ltrim( $file, '/' );

    // 1. Check if theme has Customizer override
    $theme_mod_key = 'santino_img_' . sanitize_key( str_replace( array( '.', '-', '_' ), '_', $clean_file ) );
    $custom_url = get_theme_mod( $theme_mod_key );
    if ( $custom_url ) {
        return esc_url( $custom_url );
    }

    // 2. Check if file exists in theme assets or root
    if ( file_exists( SANTINO_DIR . '/assets/images/' . $clean_file ) ) {
        return esc_url( SANTINO_URI . '/assets/images/' . $clean_file );
    }
    if ( file_exists( SANTINO_DIR . '/' . $clean_file ) ) {
        return esc_url( SANTINO_URI . '/' . $clean_file );
    }

    // 3. Dynamic check in WordPress Media Library by filename or title
    global $wpdb;
    if ( $wpdb ) {
        $attachment_id = $wpdb->get_var( $wpdb->prepare(
            "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s LIMIT 1",
            '%' . $wpdb->esc_like( $clean_file )
        ) );
        if ( ! $attachment_id ) {
            $title_only = pathinfo( $clean_file, PATHINFO_FILENAME );
            $attachment_id = $wpdb->get_var( $wpdb->prepare(
                "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND (post_name = %s OR post_title = %s) LIMIT 1",
                sanitize_title( $title_only ),
                $title_only
            ) );
        }
        if ( $attachment_id ) {
            $attachment_url = wp_get_attachment_url( $attachment_id );
            if ( $attachment_url ) {
                return esc_url( $attachment_url );
            }
        }
    }

    // 4. Category-Aware Premium Placeholder Image Fallback
    $lower = strtolower( $clean_file );
    if ( strpos( $lower, 'machine' ) !== false || strpos( $lower, 'blackeagle' ) !== false || strpos( $lower, 'simonelli' ) !== false || strpos( $lower, 'maverick' ) !== false || strpos( $lower, 'grinder' ) !== false || strpos( $lower, 'kalerm' ) !== false || strpos( $lower, 'crem' ) !== false || strpos( $lower, 'eagle' ) !== false ) {
        $ph = file_exists( SANTINO_DIR . '/placeholder-machine.jpg' ) ? ( SANTINO_URI . '/placeholder-machine.jpg' ) : ( SANTINO_URI . '/placeholder.jpg' );
        return esc_url( $ph );
    }
    if ( strpos( $lower, 'barista' ) !== false || strpos( $lower, 'train' ) !== false || strpos( $lower, 'latte' ) !== false || strpos( $lower, 'academy' ) !== false || strpos( $lower, 'cup' ) !== false ) {
        $ph = file_exists( SANTINO_DIR . '/placeholder-barista.jpg' ) ? ( SANTINO_URI . '/placeholder-barista.jpg' ) : ( SANTINO_URI . '/placeholder.jpg' );
        return esc_url( $ph );
    }
    if ( strpos( $lower, 'office' ) !== false || strpos( $lower, 'horeca' ) !== false || strpos( $lower, 'cafe' ) !== false || strpos( $lower, 'retail' ) !== false || strpos( $lower, 'swapno' ) !== false || strpos( $lower, 'shwapno' ) !== false ) {
        $ph = file_exists( SANTINO_DIR . '/placeholder-cafe.jpg' ) ? ( SANTINO_URI . '/placeholder-cafe.jpg' ) : ( SANTINO_URI . '/placeholder.jpg' );
        return esc_url( $ph );
    }
    if ( strpos( $lower, 'banner' ) !== false || strpos( $lower, 'hero' ) !== false || strpos( $lower, 'poster' ) !== false ) {
        $ph = file_exists( SANTINO_DIR . '/placeholder-banner.jpg' ) ? ( SANTINO_URI . '/placeholder-banner.jpg' ) : ( SANTINO_URI . '/placeholder.jpg' );
        return esc_url( $ph );
    }

    // 5. Default Universal Coffee Placeholder
    $default_ph = file_exists( SANTINO_DIR . '/placeholder.jpg' ) ? ( SANTINO_URI . '/placeholder.jpg' ) : ( SANTINO_URI . '/assets/images/placeholder.jpg' );
    return esc_url( $default_ph );
}

/**
 * Intelligent 301 URL Aliases to ensure no Santino pages 404
 */
function santino_slug_redirects() {
    if ( ! is_404() ) {
        return;
    }
    $path = trim( wp_parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
    $redirects = array(
        'coffee'   => 'beans',
        'academy'  => 'training',
        'vip'      => 'membership',
        'about'    => 'our-story',
        'services' => 'office-cafe',
    );
    if ( isset( $redirects[ $path ] ) ) {
        wp_safe_redirect( home_url( '/' . $redirects[ $path ] . '/' ), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'santino_slug_redirects' );

/**
 * Include Elementor Installer & Dependency Notice
 */
require_once SANTINO_DIR . '/inc/elementor-installer.php';

/**
 * Include Santino VIP Membership Backend Engine
 */
require_once SANTINO_DIR . '/inc/membership-system.php';
require_once SANTINO_DIR . '/inc/menus.php';
require_once SANTINO_DIR . '/inc/leads-system.php';
require_once SANTINO_DIR . '/inc/club-system.php';
require_once SANTINO_DIR . '/inc/demo-importer.php';
require_once SANTINO_DIR . '/inc/customizer.php';




