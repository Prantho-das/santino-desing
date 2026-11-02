<?php
/**
 * Elementor Member & Membership Pages Auto-Sync and Support
 *
 * Ensures /santino-member/ and /membership/ are automatically registered in WordPress,
 * configured for Elementor builder mode, and pre-populated with visual widgets.
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Elementor_Pages_Sync {

    const SYNC_VERSION = '1.2.0';

    public static function init() {
        add_action( 'init', array( __CLASS__, 'ensure_pages' ), 20 );
        add_action( 'admin_init', array( __CLASS__, 'admin_check' ), 20 );
    }

    public static function get_pages_config() {
        return array(
            'santino-member' => array(
                'title'    => 'Santino Member Portal',
                'template' => 'templates/template-santino-member.php',
                'widget'   => 'santino_member_portal',
                'settings' => array(
                    'show_hero'        => 'yes',
                    'hero_badge'       => 'SANTINO VIP MEMBER PORTAL',
                    'hero_title'       => 'Santino Member Club &amp; Rewards',
                    'hero_desc'        => 'Track your 5-cup coffee stamps, upload cafe invoices, and claim your free 6th handcrafted cup across Santino partner cafes.',
                    'hero_btn1_text'   => 'Check Stamp Card',
                    'hero_btn1_url'    => array( 'url' => '#clubPortal' ),
                    'hero_btn2_text'   => 'Log Invoice Memo',
                    'hero_btn2_url'    => array( 'url' => '#invoice-tab' ),
                    'portal_badge'     => 'VIP LOYALTY REWARDS',
                    'portal_title'     => 'Digital Coffee Stamp Card &amp; Club Portal',
                    'portal_desc'      => 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!',
                    'card_tier_label'  => 'Regular Member',
                    'card_promo_badge' => 'BUY 5, GET 1 FREE',
                ),
            ),
            'membership' => array(
                'title'    => 'VIP Coffee Club Membership',
                'template' => 'templates/template-membership.php',
                'widget'   => 'santino_membership_solution',
                'settings' => array(
                    'show_hero'      => 'yes',
                    'hero_badge'     => 'SANTINO VIP COFFEE CLUB',
                    'hero_title'     => 'Exclusive Connoisseur <span style="color: #dfbe8d;">Privileges</span>',
                    'hero_desc'      => 'Private cupping sessions, seasonal micro-lot allocations, and 15% VIP artisan bean discounts across Bangladesh.',
                    'hero_btn1_text' => 'Join Coffee Club',
                    'hero_btn1_url'  => array( 'url' => '#clubPortal' ),
                    'hero_btn2_text' => 'Explore Perks',
                    'hero_btn2_url'  => array( 'url' => '#perks' ),
                    'show_metrics'   => 'yes',
                    'show_perks'     => 'yes',
                    'show_portal'    => 'yes',
                ),
            ),
        );
    }

    public static function ensure_pages() {
        $last_synced = get_option( 'santino_member_elementor_sync_ver' );
        if ( $last_synced === self::SYNC_VERSION ) {
            return;
        }

        self::sync_all();
        update_option( 'santino_member_elementor_sync_ver', self::SYNC_VERSION );
    }

    public static function admin_check() {
        if ( isset( $_GET['santino_force_elementor_sync'] ) && current_user_can( 'manage_options' ) ) {
            self::sync_all();
            wp_safe_redirect( remove_query_arg( 'santino_force_elementor_sync' ) );
            exit;
        }
    }

    public static function sync_all() {
        $configs = self::get_pages_config();
        $cache_cleared = false;

        foreach ( $configs as $slug => $data ) {
            $page = get_page_by_path( $slug );

            if ( ! $page ) {
                $posts = get_posts( array(
                    'name'        => $slug,
                    'post_type'   => 'page',
                    'post_status' => 'any',
                    'numberposts' => 1,
                ) );
                if ( ! empty( $posts ) ) {
                    $page = $posts[0];
                }
            }

            if ( ! $page ) {
                $pid = wp_insert_post( array(
                    'post_title'  => $data['title'],
                    'post_name'   => $slug,
                    'post_status' => 'publish',
                    'post_type'   => 'page',
                ) );
            } else {
                $pid = $page->ID;
                if ( $page->post_status !== 'publish' ) {
                    wp_update_post( array(
                        'ID'          => $pid,
                        'post_status' => 'publish',
                    ) );
                }
            }

            if ( ! $pid || is_wp_error( $pid ) ) {
                continue;
            }

            // 1. Template
            $current_template = get_post_meta( $pid, '_wp_page_template', true );
            if ( $current_template !== $data['template'] ) {
                update_post_meta( $pid, '_wp_page_template', $data['template'] );
            }

            // 2. Elementor Edit Mode
            update_post_meta( $pid, '_elementor_edit_mode', 'builder' );
            update_post_meta( $pid, '_elementor_version', '3.25.0' );

            // 3. Elementor Data
            $el_data = get_post_meta( $pid, '_elementor_data', true );
            $needs_structure = false;

            if ( empty( $el_data ) || $el_data === '[]' || $el_data === '""' ) {
                $needs_structure = true;
            } elseif ( strpos( $el_data, $data['widget'] ) === false ) {
                $needs_structure = true;
            }

            if ( $needs_structure ) {
                $sec_id = substr( md5( $slug . '_sec_' . time() ), 0, 7 );
                $col_id = substr( md5( $slug . '_col_' . time() ), 0, 7 );
                $w_id   = substr( md5( $slug . '_w_' . time() ), 0, 7 );

                $structure = array(
                    array(
                        'id'       => $sec_id,
                        'elType'   => 'section',
                        'settings' => array(
                            'layout' => 'full_width',
                            'gap'    => 'no',
                        ),
                        'elements' => array(
                            array(
                                'id'       => $col_id,
                                'elType'   => 'column',
                                'settings' => array( '_column_size' => 100 ),
                                'elements' => array(
                                    array(
                                        'id'         => $w_id,
                                        'elType'     => 'widget',
                                        'widgetType' => $data['widget'],
                                        'settings'   => $data['settings'],
                                    ),
                                ),
                            ),
                        ),
                    ),
                );

                $json = wp_json_encode( $structure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                update_post_meta( $pid, '_elementor_data', $json );
                $cache_cleared = true;
            }
        }

        if ( $cache_cleared && class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }
    }
}

Santino_Elementor_Pages_Sync::init();
