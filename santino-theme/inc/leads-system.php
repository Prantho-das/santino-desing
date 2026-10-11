<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Leads_System {

    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_type' ) );
        add_action( 'wp_ajax_santino_submit_inquiry', array( __CLASS__, 'handle_inquiry_ajax' ) );
        add_action( 'wp_ajax_nopriv_santino_submit_inquiry', array( __CLASS__, 'handle_inquiry_ajax' ) );
        add_action( 'wp_ajax_santino_ajax_add_to_cart', array( __CLASS__, 'handle_ajax_add_to_cart' ) );
        add_action( 'wp_ajax_nopriv_santino_ajax_add_to_cart', array( __CLASS__, 'handle_ajax_add_to_cart' ) );
        
        add_filter( 'manage_santino_inquiry_posts_columns', array( __CLASS__, 'set_columns' ) );
        add_action( 'manage_santino_inquiry_posts_custom_column', array( __CLASS__, 'render_columns' ), 10, 2 );
    }

    public static function register_post_type() {
        $labels = array(
            'name'               => 'Inquiries & Leads',
            'singular_name'      => 'Inquiry',
            'menu_name'          => 'Santino Leads',
            'all_items'          => 'All Inquiries',
            'add_new'            => 'Add New Inquiry',
            'add_new_item'       => 'Add New Lead',
            'edit_item'          => 'View Inquiry',
            'search_items'       => 'Search Inquiries',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 26,
            'menu_icon'          => 'dashicons-email-alt2',
            'supports'           => array( 'title', 'custom-fields' ),
            'capability_type'    => 'post',
        );

        register_post_type( 'santino_inquiry', $args );
    }

    public static function set_columns( $columns ) {
        return array(
            'cb'         => $columns['cb'],
            'title'      => 'Inquirer Name',
            'type'       => 'Inquiry Type / Page',
            'contact'    => 'Contact (Phone / Email)',
            'details'    => 'Request Details',
            'date'       => 'Submission Date',
        );
    }

    public static function render_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'type':
                $type = get_post_meta( $post_id, '_inquiry_type', true );
                echo '<span class="badge" style="background:#00625d;color:#fff;padding:4px 8px;border-radius:4px;">' . esc_html( strtoupper( $type ) ) . '</span>';
                break;
            case 'contact':
                $phone = get_post_meta( $post_id, '_inquiry_phone', true );
                $email = get_post_meta( $post_id, '_inquiry_email', true );
                echo '<strong>' . esc_html( $phone ) . '</strong><br><small>' . esc_html( $email ) . '</small>';
                break;
            case 'details':
                $details = get_post_meta( $post_id, '_inquiry_details', true );
                echo esc_html( wp_trim_words( $details, 15 ) );
                break;
        }
    }

    public static function handle_inquiry_ajax() {
        if ( ! empty( $_REQUEST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'santino_frontend_nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Security token expired. Please refresh the page.' ) );
        }

        $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
        $phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
        $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
        $type    = isset( $_POST['inquiry_type'] ) ? sanitize_text_field( wp_unslash( $_POST['inquiry_type'] ) ) : ( isset( $_POST['type'] ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : 'general' );
        
        $details_parts = array();
        if ( ! empty( $_POST['company'] ) ) {
            $details_parts[] = 'Company/Org: ' . sanitize_text_field( wp_unslash( $_POST['company'] ) );
        }
        if ( ! empty( $_POST['location'] ) ) {
            $details_parts[] = 'Location: ' . sanitize_text_field( wp_unslash( $_POST['location'] ) );
        }
        if ( ! empty( $_POST['designation'] ) ) {
            $details_parts[] = 'Designation: ' . sanitize_text_field( wp_unslash( $_POST['designation'] ) );
        }
        if ( ! empty( $_POST['team_size'] ) ) {
            $details_parts[] = 'Team Size: ' . sanitize_text_field( wp_unslash( $_POST['team_size'] ) );
        }
        if ( ! empty( $_POST['service'] ) ) {
            $details_parts[] = 'Service/Product: ' . sanitize_text_field( wp_unslash( $_POST['service'] ) );
        }
        if ( ! empty( $_POST['preferred_date'] ) ) {
            $details_parts[] = 'Date: ' . sanitize_text_field( wp_unslash( $_POST['preferred_date'] ) );
        }
        if ( ! empty( $_POST['message'] ) ) {
            $details_parts[] = 'Message/Notes: ' . sanitize_textarea_field( wp_unslash( $_POST['message'] ) );
        }
        if ( ! empty( $_POST['details'] ) ) {
            $details_parts[] = 'Details: ' . sanitize_textarea_field( wp_unslash( $_POST['details'] ) );
        }
        $details = implode( " | ", $details_parts );

        if ( empty( $name ) || empty( $phone ) ) {
            wp_send_json_error( array( 'message' => 'Please provide your name and phone number.' ) );
        }

        $post_title = $name . ' (' . ucfirst( str_replace( '_', ' ', $type ) ) . ')';
        $post_id = wp_insert_post( array(
            'post_title'  => $post_title,
            'post_type'   => 'santino_inquiry',
            'post_status' => 'publish',
        ) );

        if ( is_wp_error( $post_id ) ) {
            wp_send_json_error( array( 'message' => 'Failed to save inquiry. Please try again.' ) );
        }

        update_post_meta( $post_id, '_inquiry_name', $name );
        update_post_meta( $post_id, '_inquiry_phone', $phone );
        update_post_meta( $post_id, '_inquiry_email', $email );
        update_post_meta( $post_id, '_inquiry_type', $type );
        update_post_meta( $post_id, '_inquiry_details', $details );

        wp_send_json_success( array(
            'message' => 'Thank you, ' . esc_html( $name ) . '! Your request has been received. Our team will contact you shortly.',
            'lead_id' => $post_id,
        ) );
    }

    public static function handle_ajax_add_to_cart() {
        check_ajax_referer( 'santino_frontend_nonce', 'nonce' );

        if ( ! class_exists( 'WooCommerce' ) ) {
            wp_send_json_error( array( 'message' => 'WooCommerce is not active.' ) );
        }

        $product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
        $quantity   = isset( $_POST['quantity'] ) ? absint( $_POST['quantity'] ) : 1;

        if ( ! $product_id ) {
            wp_send_json_error( array( 'message' => 'Invalid product.' ) );
        }

        $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

        if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity ) ) {
            do_action( 'woocommerce_ajax_added_to_cart', $product_id );

            wp_send_json_success( array(
                'cart_count' => WC()->cart->get_cart_contents_count(),
                'cart_total' => WC()->cart->get_cart_total(),
                'message'    => 'Product added to your cart!',
            ) );
        }

        wp_send_json_error( array( 'message' => 'Could not add product to cart.' ) );
    }
}

Santino_Leads_System::init();
