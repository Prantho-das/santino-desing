<?php
/**
 * Santino Theme Customizer - Full Comprehensive Media & Video Upload Options
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function santino_customize_register( $wp_customize ) {
    // ----------------------------------------------------
    // Section 1: Branding & Logos
    // ----------------------------------------------------
    $wp_customize->add_section(
        'santino_branding_settings',
        array(
            'title'       => __( 'Santino: Logos & Branding', 'santino' ),
            'priority'    => 25,
            'description' => __( 'Upload your primary header logo and footer white logo.', 'santino' ),
        )
    );

    // Footer White Logo Upload
    $wp_customize->add_setting(
        'santino_footer_logo',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'santino_footer_logo',
            array(
                'label'       => __( 'Footer White Logo', 'santino' ),
                'section'     => 'santino_branding_settings',
                'description' => __( 'Upload white version of your logo for dark footer backgrounds.', 'santino' ),
            )
        )
    );

    // ----------------------------------------------------
    // Section 1B: Secondary Sub-Header Bar & Brand Logos
    // ----------------------------------------------------
    $wp_customize->add_section(
        'santino_second_bar_settings',
        array(
            'title'       => __( 'Santino: Sub-Header Bar & Brand Logos', 'santino' ),
            'priority'    => 25.5,
            'description' => __( 'Upload real brand logos for BFC & Shwapno, manage the sub-header bar.', 'santino' ),
        )
    );

    // Toggle Bar
    $wp_customize->add_setting( 'santino_second_bar_enable', array( 'default' => '1', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control(
        'santino_second_bar_enable',
        array(
            'label'   => __( 'Show Secondary Menu Bar', 'santino' ),
            'section' => 'santino_second_bar_settings',
            'type'    => 'checkbox',
        )
    );

    // BFC Real Logo Upload
    $wp_customize->add_setting( 'santino_bfc_logo', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'santino_bfc_logo',
            array(
                'label'       => __( 'BFC Brand Real Logo (Upload)', 'santino' ),
                'section'     => 'santino_second_bar_settings',
                'description' => __( 'Upload official BFC logo (PNG / SVG / JPG). Replaces the default shop icon in top menu.', 'santino' ),
            )
        )
    );

    // Swapno Real Logo Upload
    $wp_customize->add_setting( 'santino_swapno_logo', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'santino_swapno_logo',
            array(
                'label'       => __( 'Shwapno Brand Real Logo (Upload)', 'santino' ),
                'section'     => 'santino_second_bar_settings',
                'description' => __( 'Upload official Shwapno logo (PNG / SVG / JPG). Replaces the default cart icon in top menu.', 'santino' ),
            )
        )
    );

    // Membership Logo / Icon Upload
    $wp_customize->add_setting( 'santino_membership_logo', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'santino_membership_logo',
            array(
                'label'       => __( 'Membership Custom Logo / Icon (Optional)', 'santino' ),
                'section'     => 'santino_second_bar_settings',
            )
        )
    );

    // Menu Logo / Icon Upload
    $wp_customize->add_setting( 'santino_menu_logo', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'santino_menu_logo',
            array(
                'label'       => __( 'Menu Custom Logo / Icon (Optional)', 'santino' ),
                'section'     => 'santino_second_bar_settings',
            )
        )
    );

    // Custom Titles
    $wp_customize->add_setting( 'santino_second_bar_hide_labels', array( 'default' => '0', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'santino_second_bar_hide_labels', array(
        'label'       => __( 'Hide Text Labels (Logo Only Mode)', 'santino' ),
        'section'     => 'santino_second_bar_settings',
        'type'        => 'checkbox',
        'description' => __( 'When checked, items with logos will hide their text labels.', 'santino' ),
    ) );

    $wp_customize->add_setting( 'santino_membership_title', array( 'default' => 'MEMBERSHIP', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'santino_membership_title', array(
        'label'   => __( 'Membership Label', 'santino' ),
        'section' => 'santino_second_bar_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'santino_bfc_title', array( 'default' => 'BFC', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'santino_bfc_title', array(
        'label'   => __( 'BFC Label', 'santino' ),
        'section' => 'santino_second_bar_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'santino_swapno_title', array( 'default' => 'SWAPNO', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'santino_swapno_title', array(
        'label'   => __( 'Shwapno Label', 'santino' ),
        'section' => 'santino_second_bar_settings',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'santino_menu_title', array( 'default' => 'MENU', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'santino_menu_title', array(
        'label'   => __( 'Menu Label', 'santino' ),
        'section' => 'santino_second_bar_settings',
        'type'    => 'text',
    ) );

    // URL Overrides (Default fallbacks)
    $wp_customize->add_setting( 'santino_membership_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'santino_membership_url', array(
        'label'       => __( 'Membership Custom URL', 'santino' ),
        'section'     => 'santino_second_bar_settings',
        'type'        => 'url',
        'description' => __( 'Leave blank to use default /membership/', 'santino' ),
    ) );

    $wp_customize->add_setting( 'santino_bfc_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'santino_bfc_url', array(
        'label'       => __( 'BFC Custom URL', 'santino' ),
        'section'     => 'santino_second_bar_settings',
        'type'        => 'url',
        'description' => __( 'Leave blank to use default /bfc/', 'santino' ),
    ) );

    $wp_customize->add_setting( 'santino_swapno_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'santino_swapno_url', array(
        'label'       => __( 'Shwapno Custom URL', 'santino' ),
        'section'     => 'santino_second_bar_settings',
        'type'        => 'url',
        'description' => __( 'Leave blank to use default /swapno/', 'santino' ),
    ) );

    $wp_customize->add_setting( 'santino_menu_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'santino_menu_url', array(
        'label'       => __( 'Menu Custom URL', 'santino' ),
        'section'     => 'santino_second_bar_settings',
        'type'        => 'url',
        'description' => __( 'Leave blank to use default /menu/', 'santino' ),
    ) );

}
add_action( 'customize_register', 'santino_customize_register' );

/**
 * Helper to get active page banner with multi-tier fallback:
 * 1. Page Featured Image
 * 2. santino_img() dynamic lookup
 */
function santino_get_page_banner( $page_slug = '', $default_img = '' ) {
    if ( is_singular() && has_post_thumbnail() ) {
        $thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        if ( $thumb ) {
            return esc_url( $thumb );
        }
    }

    if ( $default_img && function_exists( 'santino_img' ) ) {
        return santino_img( $default_img );
    }

    $banner_ph = file_exists( SANTINO_DIR . '/placeholder-banner.jpg' ) ? ( SANTINO_URI . '/placeholder-banner.jpg' ) : ( SANTINO_URI . '/placeholder.jpg' );
    return esc_url( $banner_ph );
}
