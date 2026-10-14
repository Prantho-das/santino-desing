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
    // Section 2: Videos (Home & Story)
    // ----------------------------------------------------
    $wp_customize->add_section(
        'santino_video_settings',
        array(
            'title'       => __( 'Santino: Video Backgrounds', 'santino' ),
            'priority'    => 26,
            'description' => __( 'Upload MP4 videos or paste external video URLs for hero & story backgrounds.', 'santino' ),
        )
    );

    // Hero Video 1 (Care Partner / Expansion)
    $wp_customize->add_setting( 'santino_hero_video_mp4', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Upload_Control(
            $wp_customize,
            'santino_hero_video_mp4',
            array(
                'label'       => __( 'Home Hero MP4 Video 1 (Upload)', 'santino' ),
                'section'     => 'santino_video_settings',
                'description' => __( 'Upload MP4 video from Media Library for slide 1.', 'santino' ),
            )
        )
    );
    $wp_customize->add_setting( 'santino_hero_video_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        'santino_hero_video_url',
        array(
            'label'       => __( 'Or Home Hero Video 1 URL (External/CDN)', 'santino' ),
            'section'     => 'santino_video_settings',
            'type'        => 'url',
        )
    );
    $wp_customize->add_setting( 'santino_hero_poster_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'santino_hero_poster_img',
            array(
                'label'       => __( 'Hero Video 1 Poster / Fallback Image', 'santino' ),
                'section'     => 'santino_video_settings',
            )
        )
    );

    // Roasting Video (Slide 4)
    $wp_customize->add_setting( 'santino_roasting_video_mp4', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Upload_Control(
            $wp_customize,
            'santino_roasting_video_mp4',
            array(
                'label'       => __( 'Roastery MP4 Video (Slide 4 Upload)', 'santino' ),
                'section'     => 'santino_video_settings',
            )
        )
    );
    $wp_customize->add_setting( 'santino_roasting_video_url', array( 'default' => 'https://web.luckincdn.com/default/assets/ourstory-41023fc9.webm', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        'santino_roasting_video_url',
        array(
            'label'       => __( 'Or Roastery Video URL (External/CDN)', 'santino' ),
            'section'     => 'santino_video_settings',
            'type'        => 'url',
        )
    );

    // Our Story Page Video
    $wp_customize->add_setting( 'santino_story_video_mp4', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Upload_Control(
            $wp_customize,
            'santino_story_video_mp4',
            array(
                'label'       => __( 'Our Story Page MP4 Video (Upload)', 'santino' ),
                'section'     => 'santino_video_settings',
            )
        )
    );
    $wp_customize->add_setting( 'santino_story_video_url', array( 'default' => 'https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/ab6140f6-129c-4ae9-aaa0-20190c43183b.mp4', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        'santino_story_video_url',
        array(
            'label'       => __( 'Or Our Story Video URL (External/CDN)', 'santino' ),
            'section'     => 'santino_video_settings',
            'type'        => 'url',
        )
    );
    $wp_customize->add_setting( 'santino_story_poster_img', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'santino_story_poster_img',
            array(
                'label'       => __( 'Our Story Video Poster Image', 'santino' ),
                'section'     => 'santino_video_settings',
            )
        )
    );

    // ----------------------------------------------------
    // Section 3: Inner Page Hero Banners
    // ----------------------------------------------------
    $wp_customize->add_section(
        'santino_banners_settings',
        array(
            'title'       => __( 'Santino: Page Hero Banners', 'santino' ),
            'priority'    => 27,
            'description' => __( 'Upload hero banner backgrounds for all 12 inner pages. You can also set a page Featured Image in WordPress.', 'santino' ),
        )
    );

    $banners = array(
        'santino_banner_default'      => __( 'Global Default Page Banner', 'santino' ),
        'santino_banner_beans'        => __( 'Coffee Beans Page Banner', 'santino' ),
        'santino_banner_machines'     => __( 'Commercial Machines Page Banner', 'santino' ),
        'santino_banner_training'     => __( 'Barista Training Academy Banner', 'santino' ),
        'santino_banner_office_cafe'  => __( 'Office Cafe Setup Banner', 'santino' ),
        'santino_banner_horeca'       => __( 'Horeca Solutions Banner', 'santino' ),
        'santino_banner_membership'   => __( 'VIP Membership Club Banner', 'santino' ),
        'santino_banner_menu'         => __( 'Cafe Signature Menu Banner', 'santino' ),
        'santino_banner_our_story'    => __( 'Our Story & Heritage Banner', 'santino' ),
        'santino_banner_swapno'       => __( 'Shwapno Superstores Retail Banner', 'santino' ),
        'santino_banner_bfc'          => __( 'BFC Foodservice Partner Banner', 'santino' ),
        'santino_banner_cert'         => __( 'Certificate Verification Banner', 'santino' ),
        'santino_banner_brands'       => __( 'Authorized Brands Showcase Banner', 'santino' ),
    );

    foreach ( $banners as $key => $label ) {
        $wp_customize->add_setting( $key, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                $key,
                array(
                    'label'   => $label,
                    'section' => 'santino_banners_settings',
                )
            )
        );
    }
}
add_action( 'customize_register', 'santino_customize_register' );

/**
 * Helper to get active page banner with multi-tier fallback:
 * 1. Page Featured Image
 * 2. Specific Page Banner in Customizer
 * 3. Default Banner in Customizer
 * 4. santino_img() dynamic lookup
 */
function santino_get_page_banner( $page_slug = '', $default_img = '' ) {
    // 1. Featured Image
    if ( is_singular() && has_post_thumbnail() ) {
        $thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        if ( $thumb ) {
            return esc_url( $thumb );
        }
    }

    // 2. Customizer setting for this specific page
    if ( $page_slug ) {
        $custom_banner = get_theme_mod( 'santino_banner_' . sanitize_key( $page_slug ) );
        if ( $custom_banner ) {
            return esc_url( $custom_banner );
        }
    }

    // 3. Global Default Banner in Customizer
    $default_banner = get_theme_mod( 'santino_banner_default' );
    if ( $default_banner ) {
        return esc_url( $default_banner );
    }

    // 4. santino_img fallback
    if ( $default_img && function_exists( 'santino_img' ) ) {
        return santino_img( $default_img );
    }

    // 5. Category/Banner Placeholder
    $banner_ph = file_exists( SANTINO_DIR . '/placeholder-banner.jpg' ) ? ( SANTINO_URI . '/placeholder-banner.jpg' ) : ( SANTINO_URI . '/placeholder.jpg' );
    return esc_url( $banner_ph );
}
