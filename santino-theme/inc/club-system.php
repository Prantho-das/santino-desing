<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Club_Registrations_System {

    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_type' ) );
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
        add_filter( 'manage_santino_club_reg_posts_columns', array( __CLASS__, 'set_columns' ) );
        add_action( 'manage_santino_club_reg_posts_custom_column', array( __CLASS__, 'render_columns' ), 10, 2 );

        add_action( 'wp_ajax_santino_submit_club_reg', array( __CLASS__, 'handle_club_reg_ajax' ) );
        add_action( 'wp_ajax_nopriv_santino_submit_club_reg', array( __CLASS__, 'handle_club_reg_ajax' ) );
    }

    public static function register_post_type() {
        $labels = array(
            'name'               => 'Santino Club Registrations',
            'singular_name'      => 'Club Member',
            'menu_name'          => 'Santino Club Registrations',
            'all_items'          => 'All Club Registrations',
            'add_new'            => 'Add New Member',
            'add_new_item'       => 'Add Club Member',
            'edit_item'          => 'View Club Member Details',
            'search_items'       => 'Search Club Members',
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 27,
            'menu_icon'          => 'dashicons-groups',
            'supports'           => array( 'title' ),
            'capability_type'    => 'post',
        );

        register_post_type( 'santino_club_reg', $args );
    }

    public static function set_columns( $columns ) {
        return array(
            'cb'            => $columns['cb'],
            'title'         => 'Member Name',
            'member_id'     => 'Club ID',
            'business_type' => 'Business / Member Type',
            'contact'       => 'Phone / WhatsApp & Email',
            'requirements'  => 'Requirements & Questions',
            'date'          => 'Joined Date',
        );
    }

    public static function render_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'member_id':
                $id = get_post_meta( $post_id, '_club_member_id', true );
                echo '<strong style="font-family:monospace;font-size:13px;color:#00625d;">' . esc_html( $id ? $id : '—' ) . '</strong>';
                break;
            case 'business_type':
                $bt = get_post_meta( $post_id, '_club_business_type', true );
                echo '<span class="badge" style="background:#553c9a;color:#fff;padding:5px 9px;border-radius:4px;font-size:11px;font-weight:600;">' . esc_html( strtoupper( $bt ? $bt : 'COMMUNITY' ) ) . '</span>';
                break;
            case 'contact':
                $phone = get_post_meta( $post_id, '_club_phone', true );
                $email = get_post_meta( $post_id, '_club_email', true );
                echo '<strong>' . esc_html( $phone ) . '</strong><br><small style="color:#646970;">' . esc_html( $email ) . '</small>';
                break;
            case 'requirements':
                $msg = get_post_meta( $post_id, '_club_message', true );
                echo esc_html( wp_trim_words( $msg, 12 ) ?: '—' );
                break;
        }
    }

    public static function add_meta_boxes() {
        add_meta_box(
            'santino_club_reg_details',
            'Santino Club Member Application Details',
            array( __CLASS__, 'render_meta_box' ),
            'santino_club_reg',
            'normal',
            'high'
        );
    }

    public static function render_meta_box( $post ) {
        $name          = get_post_meta( $post->ID, '_club_name', true );
        $member_id     = get_post_meta( $post->ID, '_club_member_id', true );
        $phone         = get_post_meta( $post->ID, '_club_phone', true );
        $email         = get_post_meta( $post->ID, '_club_email', true );
        $business_type = get_post_meta( $post->ID, '_club_business_type', true );
        $message       = get_post_meta( $post->ID, '_club_message', true );
        $date          = get_the_date( 'F j, Y g:i A', $post );
        $clean_phone   = preg_replace( '/[^0-9+]/', '', $phone );
        ?>
        <div style="background:#fff;padding:15px;border-radius:8px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;padding-bottom:12px;border-bottom:2px solid #f0f0f1;">
                <div>
                    <span style="display:inline-block;background:#553c9a;color:#fff;padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;letter-spacing:0.5px;">
                        SANTINO CLUB MEMBER
                    </span>
                    <strong style="margin-left:12px;font-family:monospace;font-size:14px;color:#00625d;">ID: <?php echo esc_html( $member_id ); ?></strong>
                    <span style="margin-left:15px;color:#646970;font-size:13px;">Registered on <?php echo esc_html( $date ); ?></span>
                </div>
                <div style="display:flex;gap:8px;">
                    <?php if ( ! empty( $clean_phone ) ) : ?>
                        <a href="tel:<?php echo esc_attr( $clean_phone ); ?>" class="button button-primary" style="background:#00625d;border-color:#00625d;">
                            <span class="dashicons dashicons-phone" style="line-height:28px;font-size:16px;"></span> Call Member
                        </a>
                        <a href="https://wa.me/<?php echo esc_attr( ltrim( $clean_phone, '+' ) ); ?>" target="_blank" class="button" style="background:#25d366;color:#fff;border-color:#25d366;">
                            <span class="dashicons dashicons-whatsapp" style="line-height:28px;font-size:16px;"></span> WhatsApp
                        </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $email ) ) : ?>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>" class="button button-secondary">
                            <span class="dashicons dashicons-email" style="line-height:28px;font-size:16px;"></span> Email
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <table class="widefat striped" style="border:1px solid #ccd0d4;border-radius:4px;overflow:hidden;">
                <tbody>
                    <tr>
                        <th style="width:220px;font-weight:600;padding:12px 15px;background:#f9f9f9;">Member Full Name</th>
                        <td style="padding:12px 15px;font-size:15px;font-weight:700;color:#1d2327;"><?php echo esc_html( $name ? $name : $post->post_title ); ?></td>
                    </tr>
                    <tr>
                        <th style="font-weight:600;padding:12px 15px;background:#f9f9f9;">Club Registration ID</th>
                        <td style="padding:12px 15px;font-family:monospace;font-size:14px;font-weight:700;color:#00625d;"><?php echo esc_html( $member_id ); ?></td>
                    </tr>
                    <tr>
                        <th style="font-weight:600;padding:12px 15px;background:#f9f9f9;">Phone / WhatsApp</th>
                        <td style="padding:12px 15px;font-size:14px;font-weight:600;color:#1d2327;"><?php echo esc_html( $phone ? $phone : '—' ); ?></td>
                    </tr>
                    <tr>
                        <th style="font-weight:600;padding:12px 15px;background:#f9f9f9;">Email Address</th>
                        <td style="padding:12px 15px;font-size:14px;"><a href="mailto:<?php echo esc_attr( $email ); ?>" style="text-decoration:none;"><?php echo esc_html( $email ? $email : '—' ); ?></a></td>
                    </tr>
                    <tr>
                        <th style="font-weight:600;padding:12px 15px;background:#f9f9f9;">Business / Member Type</th>
                        <td style="padding:12px 15px;font-size:14px;font-weight:600;color:#553c9a;"><?php echo esc_html( ucfirst( $business_type ? $business_type : 'Individual' ) ); ?></td>
                    </tr>
                    <tr>
                        <th style="font-weight:600;padding:12px 15px;background:#f9f9f9;vertical-align:top;">Requirements &amp; Questions</th>
                        <td style="padding:12px 15px;font-size:14px;line-height:1.6;background:#f8f5ff;border-left:3px solid #7c3aed;">
                            <?php echo nl2br( esc_html( $message ? $message : 'None provided' ) ); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php
    }

    public static function create_club_member_record( $name, $phone, $email, $business_type, $message ) {
        $member_id = 'SNT-CLUB-' . strtoupper( wp_generate_password( 6, false ) );
        $post_title = $name . ' (' . ucfirst( $business_type ? $business_type : 'Club Member' ) . ')';

        $post_id = wp_insert_post( array(
            'post_title'  => $post_title,
            'post_type'   => 'santino_club_reg',
            'post_status' => 'publish',
        ) );

        if ( ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_club_name', $name );
            update_post_meta( $post_id, '_club_member_id', $member_id );
            update_post_meta( $post_id, '_club_phone', $phone );
            update_post_meta( $post_id, '_club_email', $email );
            update_post_meta( $post_id, '_club_business_type', $business_type );
            update_post_meta( $post_id, '_club_message', $message );
            return array( 'post_id' => $post_id, 'member_id' => $member_id );
        }
        return false;
    }

    public static function handle_club_reg_ajax() {
        if ( ! empty( $_REQUEST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'santino_frontend_nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Security token expired. Please refresh the page.' ) );
        }

        $name          = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
        $phone         = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
        $email         = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
        $business_type = isset( $_POST['business_type'] ) ? sanitize_text_field( wp_unslash( $_POST['business_type'] ) ) : 'individual';
        $message       = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

        if ( empty( $name ) || empty( $phone ) ) {
            wp_send_json_error( array( 'message' => 'Please provide your Name and Phone / WhatsApp number.' ) );
        }

        $result = self::create_club_member_record( $name, $phone, $email, $business_type, $message );

        if ( $result ) {
            wp_send_json_success( array(
                'message'   => 'Thank you, ' . esc_html( $name ) . '! You are now registered as a Santino Club Member. (Registration ID: ' . esc_html( $result['member_id'] ) . '). Our team will contact you shortly.',
                'member_id' => $result['member_id'],
                'post_id'   => $result['post_id'],
            ) );
        } else {
            wp_send_json_error( array( 'message' => 'Registration failed. Please try again.' ) );
        }
    }
}

Santino_Club_Registrations_System::init();
