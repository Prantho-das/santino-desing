<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Leads_System {

    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_type' ) );
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
        add_action( 'save_post_santino_inquiry', array( __CLASS__, 'save_lead_meta' ) );
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
            'supports'           => array( 'title' ),
            'capability_type'    => 'post',
        );

        register_post_type( 'santino_inquiry', $args );
    }

    public static function add_meta_boxes() {
        add_meta_box(
            'santino_inquiry_details_box',
            __( 'Lead & Inquiry Information', 'santino' ),
            array( __CLASS__, 'render_inquiry_meta_box' ),
            'santino_inquiry',
            'normal',
            'high'
        );
    }

    public static function render_inquiry_meta_box( $post ) {
        wp_nonce_field( 'santino_save_lead_nonce', 'santino_lead_nonce' );

        $name     = get_post_meta( $post->ID, '_inquiry_name', true );
        $phone    = get_post_meta( $post->ID, '_inquiry_phone', true );
        $email    = get_post_meta( $post->ID, '_inquiry_email', true );
        $type     = get_post_meta( $post->ID, '_inquiry_type', true );
        $b_type   = get_post_meta( $post->ID, '_inquiry_business_type', true );
        $message  = get_post_meta( $post->ID, '_inquiry_message', true );
        $details  = get_post_meta( $post->ID, '_inquiry_details', true );
        $status   = get_post_meta( $post->ID, '_inquiry_status', true ) ?: 'new';
        $clean_phone = preg_replace( '/[^0-9]/', '', $phone );
        ?>
        <div style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <div>
                    <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; font-weight: bold;">Lead Status:</span>
                    <select name="santino_inquiry_status" style="margin-left: 8px; font-weight: bold;">
                        <option value="new" <?php selected( $status, 'new' ); ?>>🟡 New Lead</option>
                        <option value="contacted" <?php selected( $status, 'contacted' ); ?>>🔵 Contacted</option>
                        <option value="in_progress" <?php selected( $status, 'in_progress' ); ?>>🟣 Proposal Sent</option>
                        <option value="won" <?php selected( $status, 'won' ); ?>>🟢 Converted / Client</option>
                        <option value="closed" <?php selected( $status, 'closed' ); ?>>⚪ Closed / Unresponsive</option>
                    </select>
                </div>
                <div>
                    <?php if ( $phone ) : ?>
                        <a href="https://wa.me/<?php echo esc_attr( $clean_phone ); ?>" target="_blank" class="button" style="background:#25D366; color:#fff; border-color:#20bd5a; font-weight:bold;">
                            WhatsApp Chat →
                        </a>
                        <a href="tel:<?php echo esc_attr( $phone ); ?>" class="button button-primary" style="background:#00625d; border-color:#004d49;">
                            Call Phone →
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <table class="form-table">
            <tr>
                <th style="width: 180px;"><label>Customer Name:</label></th>
                <td><strong style="font-size: 15px; color: #0f172a;"><?php echo esc_html( $name ?: $post->post_title ); ?></strong></td>
            </tr>
            <tr>
                <th><label>Phone / WhatsApp:</label></th>
                <td><a href="tel:<?php echo esc_attr( $phone ); ?>" style="font-weight: bold; color: #00625d;"><?php echo esc_html( $phone ?: '—' ); ?></a></td>
            </tr>
            <tr>
                <th><label>Email Address:</label></th>
                <td><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ?: '—' ); ?></a></td>
            </tr>
            <tr>
                <th><label>Inquiry Source / Page:</label></th>
                <td><span style="background: #00625d; color: #fff; padding: 3px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; text-transform: uppercase;"><?php echo esc_html( str_replace( '_', ' ', $type ) ); ?></span></td>
            </tr>
            <?php if ( $b_type ) : ?>
            <tr>
                <th><label>Business Type:</label></th>
                <td><strong><?php echo esc_html( $b_type ); ?></strong></td>
            </tr>
            <?php endif; ?>
            <?php if ( $message ) : ?>
            <tr>
                <th><label>Customer Message / Note:</label></th>
                <td><div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px; white-space: pre-wrap; font-size: 13px;"><?php echo esc_html( $message ); ?></div></td>
            </tr>
            <?php endif; ?>
            <tr>
                <th><label>All Submitted Fields:</label></th>
                <td><div style="background: #f1f5f9; padding: 10px; border-radius: 6px; font-family: monospace; font-size: 12px;"><?php echo esc_html( $details ?: 'No additional metadata' ); ?></div></td>
            </tr>
            <tr>
                <th><label>Submission Date:</label></th>
                <td><?php echo esc_html( get_the_date( 'F j, Y g:i a', $post ) ); ?></td>
            </tr>
        </table>
        <?php
    }

    public static function save_lead_meta( $post_id ) {
        if ( ! isset( $_POST['santino_lead_nonce'] ) || ! wp_verify_nonce( $_POST['santino_lead_nonce'], 'santino_save_lead_nonce' ) ) {
            return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['santino_inquiry_status'] ) ) {
            update_post_meta( $post_id, '_inquiry_status', sanitize_text_field( $_POST['santino_inquiry_status'] ) );
        }
    }

    public static function set_columns( $columns ) {
        return array(
            'cb'         => $columns['cb'],
            'title'      => 'Inquirer Name',
            'type'       => 'Inquiry Type / Page',
            'contact'    => 'Contact (Phone / Email)',
            'status'     => 'Lead Status',
            'details'    => 'Request Details',
            'date'       => 'Submission Date',
        );
    }

    public static function render_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'type':
                $type = get_post_meta( $post_id, '_inquiry_type', true );
                echo '<span class="badge" style="background:#00625d;color:#fff;padding:4px 8px;border-radius:4px;font-size:11px;">' . esc_html( strtoupper( str_replace( '_', ' ', $type ) ) ) . '</span>';
                break;
            case 'contact':
                $phone = get_post_meta( $post_id, '_inquiry_phone', true );
                $email = get_post_meta( $post_id, '_inquiry_email', true );
                echo '<strong>' . esc_html( $phone ) . '</strong><br><small style="color:#64748b;">' . esc_html( $email ) . '</small>';
                break;
            case 'status':
                $status = get_post_meta( $post_id, '_inquiry_status', true ) ?: 'new';
                $colors = array(
                    'new'         => array( '#854d0e', '#fef9c3', '🟡 NEW' ),
                    'contacted'   => array( '#1e40af', '#dbeafe', '🔵 CONTACTED' ),
                    'in_progress' => array( '#6b21a8', '#f3e8ff', '🟣 PROPOSAL' ),
                    'won'         => array( '#15803d', '#dcfce7', '🟢 WON' ),
                    'closed'      => array( '#475569', '#f1f5f9', '⚪ CLOSED' ),
                );
                $info = $colors[ $status ] ?? array( '#475569', '#f1f5f9', strtoupper( $status ) );
                echo '<span style="color:' . $info[0] . '; background:' . $info[1] . '; padding:3px 8px; border-radius:6px; font-weight:bold; font-size:11px;">' . esc_html( $info[2] ) . '</span>';
                break;
            case 'details':
                $details = get_post_meta( $post_id, '_inquiry_details', true );
                echo esc_html( wp_trim_words( $details, 12 ) );
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
        $b_type  = isset( $_POST['business_type'] ) ? sanitize_text_field( wp_unslash( $_POST['business_type'] ) ) : '';
        $msg     = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
        
        $details_parts = array();
        if ( ! empty( $b_type ) ) {
            $details_parts[] = 'Business Type: ' . $b_type;
        }
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
        if ( ! empty( $msg ) ) {
            $details_parts[] = 'Message/Notes: ' . $msg;
        }
        if ( ! empty( $_POST['details'] ) ) {
            $details_parts[] = 'Details: ' . sanitize_textarea_field( wp_unslash( $_POST['details'] ) );
        }
        $details = implode( " | ", $details_parts );

        if ( empty( $name ) || empty( $phone ) ) {
            wp_send_json_error( array( 'message' => 'Please provide your name and phone number.' ) );
        }

        $clean_phone = preg_replace( '/[\s\-\(\)\.]/', '', $phone );
        if ( ! preg_match( '/^(?:\+?880|0)1[3-9]\d{8}$/', $clean_phone ) ) {
            wp_send_json_error( array( 'message' => 'দয়া করে সঠিক ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর দিন (যেমন: 017XXXXXXXX).' ) );
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
        update_post_meta( $post_id, '_inquiry_business_type', $b_type );
        update_post_meta( $post_id, '_inquiry_message', $msg );
        update_post_meta( $post_id, '_inquiry_details', $details );
        update_post_meta( $post_id, '_inquiry_status', 'new' );

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
