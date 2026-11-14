<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Rest_Api {

    public static function init() {
        add_action( 'rest_api_init', array( __CLASS__, 'register_routes' ) );
    }

    public static function register_routes() {
        register_rest_route( 'santino/v1', '/branches', array(
            'methods'             => 'GET',
            'callback'            => array( __CLASS__, 'get_branches' ),
            'permission_callback' => '__return_true',
        ) );

        register_rest_route( 'santino/v1', '/menu', array(
            'methods'             => 'GET',
            'callback'            => array( __CLASS__, 'get_menu' ),
            'permission_callback' => '__return_true',
        ) );

        register_rest_route( 'santino/v1', '/cafe-data', array(
            'methods'             => 'GET',
            'callback'            => array( __CLASS__, 'get_all_data' ),
            'permission_callback' => '__return_true',
        ) );

        register_rest_route( 'santino/v1', '/promotions', array(
            'methods'             => 'GET',
            'callback'            => array( __CLASS__, 'get_promotions' ),
            'permission_callback' => '__return_true',
        ) );
    }

    public static function get_promotions( $request ) {
        $promos    = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_daily_promotions() : array();
        $today_key = class_exists( 'Santino_Membership_System' ) ? Santino_Membership_System::get_today_dhaka_key() : strtolower( wp_date( 'l' ) );
        return rest_ensure_response( array(
            'today_key'  => $today_key,
            'today'      => $promos[ $today_key ] ?? null,
            'promotions' => $promos,
        ) );
    }

    public static function get_branches( $request ) {
        $branches = array();
        if ( class_exists( 'Santino_Membership_System' ) && method_exists( 'Santino_Membership_System', 'get_branches_detailed' ) ) {
            $branches = Santino_Membership_System::get_branches_detailed();
        }

        if ( empty( $branches ) && class_exists( 'Santino_Membership_System' ) ) {
            $raw_names = Santino_Membership_System::get_cafe_branches();
            foreach ( $raw_names as $name ) {
                $branches[] = array(
                    'name'     => $name,
                    'division' => 'Dhaka',
                    'city'     => 'Dhaka',
                    'address'  => '',
                    'phone'    => '',
                );
            }
        }

        $division = sanitize_text_field( $request->get_param( 'division' ) );
        $search   = sanitize_text_field( $request->get_param( 'search' ) );

        if ( ! empty( $division ) ) {
            $branches = array_filter( $branches, function( $b ) use ( $division ) {
                return isset( $b['division'] ) && strcasecmp( $b['division'], $division ) === 0;
            } );
        }

        if ( ! empty( $search ) ) {
            $branches = array_filter( $branches, function( $b ) use ( $search ) {
                $haystack = ( $b['name'] ?? '' ) . ' ' . ( $b['address'] ?? '' ) . ' ' . ( $b['city'] ?? '' );
                return stripos( $haystack, $search ) !== false;
            } );
        }

        return rest_ensure_response( array(
            'success' => true,
            'count'   => count( $branches ),
            'data'    => array_values( $branches ),
        ) );
    }

    public static function get_menu( $request ) {
        $items = array();
        if ( class_exists( 'Santino_Handcrafted_Items_System' ) && method_exists( 'Santino_Handcrafted_Items_System', 'get_all_menu_items' ) ) {
            $raw_items = Santino_Handcrafted_Items_System::get_all_menu_items();
            if ( ! empty( $raw_items ) ) {
                foreach ( $raw_items as $item ) {
                    $items[] = array(
                        'id'          => $item['id'] ?? null,
                        'name'        => $item['name'] ?? '',
                        'category'    => $item['category'] ?? 'barista-coffee',
                        'price'       => $item['price'] ?? 0,
                        'roast'       => $item['roast'] ?? '',
                        'type'        => $item['type'] ?? 'hot',
                        'calories'    => $item['calories'] ?? '',
                        'tag'         => $item['tag'] ?? '',
                        'bestseller'  => ! empty( $item['bestseller'] ),
                        'plantbased'  => ! empty( $item['plantbased'] ),
                        'redeemable'  => ! empty( $item['redeemable'] ),
                        'image'       => $item['img'] ?? '',
                        'description' => $item['desc'] ?? '',
                    );
                }
            }
        }

        if ( empty( $items ) && class_exists( 'Santino_Membership_System' ) ) {
            $fallback_choices = Santino_Membership_System::get_order_item_choices();
            foreach ( $fallback_choices as $idx => $choice ) {
                $items[] = array(
                    'id'          => $idx + 1,
                    'name'        => $choice,
                    'category'    => 'barista-coffee',
                    'price'       => 170,
                    'roast'       => 'Tk. 170',
                    'type'        => 'hot',
                    'calories'    => '',
                    'tag'         => '',
                    'bestseller'  => false,
                    'plantbased'  => false,
                    'redeemable'  => true,
                    'image'       => '',
                    'description' => '',
                );
            }
        }

        $category = sanitize_text_field( $request->get_param( 'category' ) );
        $type     = sanitize_text_field( $request->get_param( 'type' ) );
        $search   = sanitize_text_field( $request->get_param( 'search' ) );

        if ( ! empty( $category ) ) {
            $items = array_filter( $items, function( $it ) use ( $category ) {
                return isset( $it['category'] ) && strcasecmp( $it['category'], $category ) === 0;
            } );
        }

        if ( ! empty( $type ) ) {
            $items = array_filter( $items, function( $it ) use ( $type ) {
                return isset( $it['type'] ) && strcasecmp( $it['type'], $type ) === 0;
            } );
        }

        if ( ! empty( $search ) ) {
            $items = array_filter( $items, function( $it ) use ( $search ) {
                return stripos( $it['name'] ?? '', $search ) !== false;
            } );
        }

        return rest_ensure_response( array(
            'success' => true,
            'count'   => count( $items ),
            'data'    => array_values( $items ),
        ) );
    }

    public static function get_all_data( $request ) {
        $branches_res = self::get_branches( $request );
        $menu_res     = self::get_menu( $request );

        return rest_ensure_response( array(
            'success'  => true,
            'branches' => $branches_res->get_data()['data'] ?? array(),
            'menu'     => $menu_res->get_data()['data'] ?? array(),
        ) );
    }
}

Santino_Rest_Api::init();
