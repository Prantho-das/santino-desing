<?php
/**
 * Santino VIP Membership & 5-Cup Digital Coffee Stamp Loyalty System
 *
 * Handles:
 * - VIP Members (santino_member)
 * - Coffee Invoice Submissions (santino_invoice) with Admin Approval Workflow
 * - Digital Coffee Stamp Card (☕☕☕☕☕: Buy 5, Get 1 Free)
 * - Automated Free Coffee Vouchers (FREE-CUP-XXXX)
 * - AJAX Member Registration, Invoice Submissions & Live Stamp Card Lookup
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Membership_System {

    public static function init() {
        // Register Post Types
        add_action( 'init', array( __CLASS__, 'register_post_types' ) );

        // Meta Boxes
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_custom_meta_boxes' ) );
        add_action( 'save_post', array( __CLASS__, 'save_custom_meta_data' ) );

        // Admin Columns
        add_filter( 'manage_santino_member_posts_columns', array( __CLASS__, 'set_member_columns' ) );
        add_action( 'manage_santino_member_posts_custom_column', array( __CLASS__, 'render_member_columns' ), 10, 2 );

        add_filter( 'manage_santino_invoice_posts_columns', array( __CLASS__, 'set_invoice_columns' ) );
        add_action( 'manage_santino_invoice_posts_custom_column', array( __CLASS__, 'render_invoice_columns' ), 10, 2 );

        // Admin Quick Approve / Reject Actions
        add_action( 'admin_action_santino_approve_invoice', array( __CLASS__, 'handle_admin_approve_invoice' ) );
        add_action( 'admin_action_santino_reject_invoice', array( __CLASS__, 'handle_admin_reject_invoice' ) );
        add_action( 'admin_action_santino_redeem_voucher', array( __CLASS__, 'handle_admin_redeem_voucher' ) );

        // AJAX Handlers
        add_action( 'wp_ajax_santino_apply_membership', array( __CLASS__, 'handle_ajax_membership_apply' ) );
        add_action( 'wp_ajax_nopriv_santino_apply_membership', array( __CLASS__, 'handle_ajax_membership_apply' ) );

        add_action( 'wp_ajax_santino_submit_invoice', array( __CLASS__, 'handle_ajax_invoice_submit' ) );
        add_action( 'wp_ajax_nopriv_santino_submit_invoice', array( __CLASS__, 'handle_ajax_invoice_submit' ) );

        add_action( 'wp_ajax_santino_lookup_stamp_card', array( __CLASS__, 'handle_ajax_stamp_card_lookup' ) );
        add_action( 'wp_ajax_nopriv_santino_lookup_stamp_card', array( __CLASS__, 'handle_ajax_stamp_card_lookup' ) );

        // Admin Menus & Submenus
        add_action( 'admin_menu', array( __CLASS__, 'register_admin_pages' ) );

        // Shortcodes
        add_shortcode( 'santino_stamp_portal', array( __CLASS__, 'render_stamp_portal_shortcode' ) );
        add_shortcode( 'santino_vip_card', array( __CLASS__, 'render_vip_card_shortcode' ) );
    }

    /**
     * 1. Register Custom Post Types
     */
    public static function register_post_types() {
        // Members CPT
        register_post_type( 'santino_member', array(
            'labels' => array(
                'name'               => __( 'VIP Members', 'santino' ),
                'singular_name'      => __( 'VIP Member', 'santino' ),
                'menu_name'          => __( 'Santino Club', 'santino' ),
                'add_new'            => __( 'Add New Member', 'santino' ),
                'add_new_item'       => __( 'Add VIP Member', 'santino' ),
                'edit_item'          => __( 'Edit Member', 'santino' ),
                'all_items'          => __( 'All VIP Members', 'santino' ),
            ),
            'public'        => false,
            'show_ui'       => true,
            'show_in_menu'  => true,
            'menu_position' => 26,
            'menu_icon'     => 'dashicons-awards',
            'supports'      => array( 'title' ),
        ) );

        // Invoice Submissions CPT
        $pending_count = self::get_pending_invoices_count();
        $menu_title = $pending_count > 0 ? sprintf( __( 'Invoices <span class="update-plugins count-%d"><span class="plugin-count">%d</span></span>', 'santino' ), $pending_count, $pending_count ) : __( 'Invoices & Stamps', 'santino' );

        register_post_type( 'santino_invoice', array(
            'labels' => array(
                'name'               => __( 'Coffee Invoices', 'santino' ),
                'singular_name'      => __( 'Coffee Invoice', 'santino' ),
                'menu_name'          => $menu_title,
                'add_new'            => __( 'Add Invoice', 'santino' ),
                'add_new_item'       => __( 'Add Invoice Record', 'santino' ),
                'edit_item'          => __( 'Edit Invoice', 'santino' ),
                'all_items'          => __( 'Invoice Approvals', 'santino' ),
            ),
            'public'        => false,
            'show_ui'       => true,
            'show_in_menu'  => 'edit.php?post_type=santino_member',
            'supports'      => array( 'title' ),
        ) );

        // Free Coffee Vouchers CPT
        register_post_type( 'santino_voucher', array(
            'labels' => array(
                'name'               => __( 'Free Coffee Vouchers', 'santino' ),
                'singular_name'      => __( 'Free Coffee Voucher', 'santino' ),
                'all_items'          => __( 'Free Coffee Vouchers', 'santino' ),
            ),
            'public'        => false,
            'show_ui'       => true,
            'show_in_menu'  => 'edit.php?post_type=santino_member',
            'supports'      => array( 'title' ),
        ) );
    }

    public static function get_pending_invoices_count() {
        $query = new WP_Query( array(
            'post_type'      => 'santino_invoice',
            'post_status'    => 'publish',
            'meta_key'       => '_santino_invoice_status',
            'meta_value'     => 'pending',
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ) );
        return $query->found_posts;
    }

    /**
     * 2. Meta Boxes
     */
    public static function add_custom_meta_boxes() {
        // Member Details
        add_meta_box(
            'santino_member_meta',
            __( 'VIP Member Details & Coffee Stamp Card', 'santino' ),
            array( __CLASS__, 'render_member_meta_box' ),
            'santino_member',
            'normal',
            'high'
        );

        // Invoice Details & Verification
        add_meta_box(
            'santino_invoice_meta',
            __( 'Coffee Invoice Verification & Stamp Approval', 'santino' ),
            array( __CLASS__, 'render_invoice_meta_box' ),
            'santino_invoice',
            'normal',
            'high'
        );
    }

    public static function render_member_meta_box( $post ) {
        wp_nonce_field( 'santino_save_member_meta', 'santino_member_nonce' );

        $member_id    = get_post_meta( $post->ID, '_santino_member_id', true );
        $phone        = get_post_meta( $post->ID, '_santino_member_phone', true );
        $email        = get_post_meta( $post->ID, '_santino_member_email', true );
        $tier         = get_post_meta( $post->ID, '_santino_member_tier', true ) ?: 'gold';
        $stamps       = intval( get_post_meta( $post->ID, '_santino_cup_stamps', true ) ?: 0 );
        $total_free   = intval( get_post_meta( $post->ID, '_santino_total_free_coffees', true ) ?: 0 );
        $total_cups   = intval( get_post_meta( $post->ID, '_santino_total_approved_cups', true ) ?: 0 );

        if ( empty( $member_id ) ) {
            $member_id = 'SNT-VIP-' . strtoupper( wp_generate_password( 6, false ) );
        }
        ?>
        <div style="background: #f8f9fa; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 20px;">
            <h3 style="margin-top: 0; color: #00625d; font-size: 16px; font-weight: bold;">
                ☕ Digital Coffee Stamp Card Progress (<?php echo esc_html( $stamps ); ?> / 5 Cups)
            </h3>
            
            <div style="display: flex; gap: 14px; margin: 16px 0; align-items: center;">
                <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                    <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; border: 2px solid <?php echo ( $i <= $stamps ) ? '#00625d' : '#cbd5e1'; ?>; background: <?php echo ( $i <= $stamps ) ? '#e6f4f3' : '#ffffff'; ?>; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                        <?php echo ( $i <= $stamps ) ? '☕' : '⚪'; ?>
                    </div>
                <?php endfor; ?>
                <div style="margin-left: 12px;">
                    <span style="font-size: 13px; font-weight: 600; color: #334155;">
                        <?php echo ( 5 - $stamps ); ?> more approved invoice<?php echo ( 5 - $stamps === 1 ) ? '' : 's'; ?> for 1 FREE COFFEE!
                    </span>
                </div>
            </div>

            <div style="display: flex; gap: 20px; font-size: 13px; color: #475569; border-top: 1px solid #e2e8f0; padding-top: 12px;">
                <div>Total Lifetime Approved Cups: <strong><?php echo esc_html( $total_cups ); ?></strong></div>
                <div>Total Free Coffees Earned: <strong style="color: #00625d;"><?php echo esc_html( $total_free ); ?> Vouchers</strong></div>
            </div>
        </div>

        <table class="form-table">
            <tr>
                <th><label><?php _e( 'VIP Member ID', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_member_id" value="<?php echo esc_attr( $member_id ); ?>" readonly style="font-weight:bold; color:#00625d; font-family:monospace; background:#f1f5f9;"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Phone / WhatsApp', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_member_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Email', 'santino' ); ?></label></th>
                <td><input type="email" name="santino_member_email" value="<?php echo esc_attr( $email ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Current Cup Stamps (0 - 5)', 'santino' ); ?></label></th>
                <td><input type="number" name="santino_cup_stamps" min="0" max="5" value="<?php echo esc_attr( $stamps ); ?>" style="width: 80px;"></td>
            </tr>
        </table>
        <?php
    }

    public static function render_invoice_meta_box( $post ) {
        wp_nonce_field( 'santino_save_invoice_meta', 'santino_invoice_nonce' );

        $invoice_no = get_post_meta( $post->ID, '_santino_invoice_number', true );
        $phone      = get_post_meta( $post->ID, '_santino_invoice_phone', true );
        $member_id  = get_post_meta( $post->ID, '_santino_invoice_member_id', true );
        $branch     = get_post_meta( $post->ID, '_santino_invoice_branch', true );
        $status     = get_post_meta( $post->ID, '_santino_invoice_status', true ) ?: 'pending';
        $admin_note = get_post_meta( $post->ID, '_santino_invoice_admin_note', true );

        $approve_url = wp_nonce_url( admin_url( 'admin.php?action=santino_approve_invoice&invoice_id=' . $post->ID ), 'santino_approve_' . $post->ID );
        $reject_url  = wp_nonce_url( admin_url( 'admin.php?action=santino_reject_invoice&invoice_id=' . $post->ID ), 'santino_reject_' . $post->ID );
        ?>
        <div style="background: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #cbd5e1;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; font-size: 16px;">
                        Invoice Status: 
                        <?php if ( $status === 'approved' ) : ?>
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-weight: bold;">APPROVED (Stamp Added)</span>
                        <?php elseif ( $status === 'rejected' ) : ?>
                            <span style="background: #fee2e2; color: #b91c1c; padding: 4px 10px; border-radius: 20px; font-weight: bold;">REJECTED</span>
                        <?php else : ?>
                            <span style="background: #fef9c3; color: #854d0e; padding: 4px 10px; border-radius: 20px; font-weight: bold;">PENDING VERIFICATION</span>
                        <?php endif; ?>
                    </h3>
                </div>
                
                <?php if ( $status === 'pending' ) : ?>
                    <div style="display: flex; gap: 10px;">
                        <a href="<?php echo esc_url( $approve_url ); ?>" class="button button-primary" style="background: #00625d; border-color: #004d49; font-weight: bold;">
                            ✓ Approve Invoice & Add +1 Cup Stamp
                        </a>
                        <a href="<?php echo esc_url( $reject_url ); ?>" class="button" style="color: #b91c1c; border-color: #b91c1c;" onclick="return confirm('Reject this invoice submission?');">
                            ✗ Reject
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <table class="form-table">
            <tr>
                <th><label><?php _e( 'Invoice / Memo Number', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_invoice_number" value="<?php echo esc_attr( $invoice_no ); ?>" class="regular-text" style="font-size: 1.1em; font-weight: bold; color: #0f172a;"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Customer Phone Number', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_invoice_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'VIP Member ID', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_invoice_member_id" value="<?php echo esc_attr( $member_id ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Cafe Branch', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_invoice_branch" value="<?php echo esc_attr( $branch ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Verification Status', 'santino' ); ?></label></th>
                <td>
                    <select name="santino_invoice_status">
                        <option value="pending" <?php selected( $status, 'pending' ); ?>>Pending Review</option>
                        <option value="approved" <?php selected( $status, 'approved' ); ?>>Approved (+1 Stamp Added)</option>
                        <option value="rejected" <?php selected( $status, 'rejected' ); ?>>Rejected</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label><?php _e( 'Admin Note / Reason', 'santino' ); ?></label></th>
                <td><textarea name="santino_invoice_admin_note" rows="2" class="large-text"><?php echo esc_textarea( $admin_note ); ?></textarea></td>
            </tr>
        </table>
        <?php
    }

    public static function save_custom_meta_data( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Save Member Meta
        if ( isset( $_POST['santino_member_nonce'] ) && wp_verify_nonce( $_POST['santino_member_nonce'], 'santino_save_member_meta' ) ) {
            if ( isset( $_POST['santino_member_phone'] ) ) {
                update_post_meta( $post_id, '_santino_member_phone', sanitize_text_field( $_POST['santino_member_phone'] ) );
            }
            if ( isset( $_POST['santino_member_email'] ) ) {
                update_post_meta( $post_id, '_santino_member_email', sanitize_email( $_POST['santino_member_email'] ) );
            }
            if ( isset( $_POST['santino_cup_stamps'] ) ) {
                update_post_meta( $post_id, '_santino_cup_stamps', intval( $_POST['santino_cup_stamps'] ) );
            }
        }

        // Save Invoice Meta
        if ( isset( $_POST['santino_invoice_nonce'] ) && wp_verify_nonce( $_POST['santino_invoice_nonce'], 'santino_save_invoice_meta' ) ) {
            if ( isset( $_POST['santino_invoice_number'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_number', sanitize_text_field( $_POST['santino_invoice_number'] ) );
            }
            if ( isset( $_POST['santino_invoice_phone'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_phone', sanitize_text_field( $_POST['santino_invoice_phone'] ) );
            }
            if ( isset( $_POST['santino_invoice_status'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_status', sanitize_text_field( $_POST['santino_invoice_status'] ) );
            }
            if ( isset( $_POST['santino_invoice_admin_note'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_admin_note', sanitize_textarea_field( $_POST['santino_invoice_admin_note'] ) );
            }
        }
    }

    /**
     * 3. Admin Columns
     */
    public static function set_member_columns( $columns ) {
        return array(
            'cb'            => $columns['cb'],
            'title'         => __( 'Member Name', 'santino' ),
            'member_id'     => __( 'VIP ID', 'santino' ),
            'phone'         => __( 'Phone', 'santino' ),
            'stamp_card'    => __( 'Coffee Stamp Card (5 Cups)', 'santino' ),
            'free_coffees'  => __( 'Free Cups Won', 'santino' ),
            'date'          => __( 'Joined', 'santino' ),
        );
    }

    public static function render_member_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'member_id':
                echo '<strong style="color:#00625d; font-family:monospace;">' . esc_html( get_post_meta( $post_id, '_santino_member_id', true ) ?: 'N/A' ) . '</strong>';
                break;
            case 'phone':
                echo esc_html( get_post_meta( $post_id, '_santino_member_phone', true ) ?: '—' );
                break;
            case 'stamp_card':
                $stamps = intval( get_post_meta( $post_id, '_santino_cup_stamps', true ) ?: 0 );
                echo '<div style="display:inline-flex; gap:3px; font-size:14px;">';
                for ( $i = 1; $i <= 5; $i++ ) {
                    echo ( $i <= $stamps ) ? '☕' : '⚪';
                }
                echo '</div> <strong style="color:#00625d; margin-left:5px;">(' . $stamps . '/5)</strong>';
                break;
            case 'free_coffees':
                $free = intval( get_post_meta( $post_id, '_santino_total_free_coffees', true ) ?: 0 );
                if ( $free > 0 ) {
                    echo '<span style="background:#00625d; color:#fff; padding:2px 8px; border-radius:10px; font-weight:bold;">' . $free . ' Free Cup' . ( $free > 1 ? 's' : '' ) . '</span>';
                } else {
                    echo '<span style="color:#94a3b8;">0</span>';
                }
                break;
        }
    }

    public static function set_invoice_columns( $columns ) {
        return array(
            'cb'          => $columns['cb'],
            'title'       => __( 'Invoice Record', 'santino' ),
            'invoice_no'  => __( 'Invoice #', 'santino' ),
            'phone'       => __( 'Customer Phone', 'santino' ),
            'branch'      => __( 'Cafe Branch', 'santino' ),
            'status'      => __( 'Verification Status', 'santino' ),
            'actions'     => __( 'Quick Action', 'santino' ),
            'date'        => __( 'Submitted Date', 'santino' ),
        );
    }

    public static function render_invoice_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'invoice_no':
                $no = get_post_meta( $post_id, '_santino_invoice_number', true );
                echo '<strong style="font-family:monospace; font-size:13px; color:#0f172a;">' . esc_html( $no ) . '</strong>';
                break;
            case 'phone':
                echo esc_html( get_post_meta( $post_id, '_santino_invoice_phone', true ) ?: '—' );
                break;
            case 'branch':
                echo esc_html( get_post_meta( $post_id, '_santino_invoice_branch', true ) ?: 'Santino Flagship' );
                break;
            case 'status':
                $status = get_post_meta( $post_id, '_santino_invoice_status', true ) ?: 'pending';
                if ( $status === 'approved' ) {
                    echo '<span style="color:#15803d; background:#dcfce7; padding:3px 8px; border-radius:6px; font-weight:bold; font-size:11px;">✓ APPROVED (+1 ☕)</span>';
                } elseif ( $status === 'rejected' ) {
                    echo '<span style="color:#b91c1c; background:#fee2e2; padding:3px 8px; border-radius:6px; font-weight:bold; font-size:11px;">✗ REJECTED</span>';
                } else {
                    echo '<span style="color:#854d0e; background:#fef9c3; padding:3px 8px; border-radius:6px; font-weight:bold; font-size:11px;">⏳ PENDING CHECK</span>';
                }
                break;
            case 'actions':
                $status = get_post_meta( $post_id, '_santino_invoice_status', true ) ?: 'pending';
                if ( $status === 'pending' ) {
                    $approve_url = wp_nonce_url( admin_url( 'admin.php?action=santino_approve_invoice&invoice_id=' . $post_id ), 'santino_approve_' . $post_id );
                    $reject_url  = wp_nonce_url( admin_url( 'admin.php?action=santino_reject_invoice&invoice_id=' . $post_id ), 'santino_reject_' . $post_id );
                    echo '<a href="' . esc_url( $approve_url ) . '" class="button button-small button-primary" style="background:#00625d; border-color:#004d49;">Approve</a> ';
                    echo '<a href="' . esc_url( $reject_url ) . '" class="button button-small" style="color:#b91c1c;">Reject</a>';
                } else {
                    echo '—';
                }
                break;
        }
    }

    /**
     * 4. Admin Invoice Approval Action (The Stamp & 5-Cup Reward Engine)
     */
    public static function handle_admin_approve_invoice() {
        $invoice_id = intval( $_GET['invoice_id'] ?? 0 );
        check_admin_referer( 'santino_approve_' . $invoice_id );

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Permission denied' );
        }

        // Check if already approved
        $current_status = get_post_meta( $invoice_id, '_santino_invoice_status', true );
        if ( $current_status === 'approved' ) {
            wp_redirect( admin_url( 'edit.php?post_type=santino_invoice&approved=already' ) );
            exit;
        }

        // Mark invoice approved
        update_post_meta( $invoice_id, '_santino_invoice_status', 'approved' );
        update_post_meta( $invoice_id, '_santino_invoice_approved_at', current_time( 'mysql' ) );

        $phone = get_post_meta( $invoice_id, '_santino_invoice_phone', true );
        $member_id_str = get_post_meta( $invoice_id, '_santino_invoice_member_id', true );

        // Find matching member
        $member = self::find_member_by_phone_or_id( $phone, $member_id_str );

        if ( $member ) {
            $member_post_id = $member->ID;
            $current_stamps = intval( get_post_meta( $member_post_id, '_santino_cup_stamps', true ) ?: 0 );
            $total_cups     = intval( get_post_meta( $member_post_id, '_santino_total_approved_cups', true ) ?: 0 );
            $total_free     = intval( get_post_meta( $member_post_id, '_santino_total_free_coffees', true ) ?: 0 );

            $new_stamps = $current_stamps + 1;
            $total_cups = $total_cups + 1;
            update_post_meta( $member_post_id, '_santino_total_approved_cups', $total_cups );

            // Check if 5 cups reached!
            if ( $new_stamps >= 5 ) {
                // RESET stamps counter for next cycle
                update_post_meta( $member_post_id, '_santino_cup_stamps', 0 );
                update_post_meta( $member_post_id, '_santino_total_free_coffees', $total_free + 1 );

                // Issue Free Coffee Voucher
                self::generate_free_coffee_voucher( $member_post_id, $member->post_title, $phone );

                wp_redirect( admin_url( 'edit.php?post_type=santino_invoice&approved=free_coffee_issued' ) );
                exit;
            } else {
                update_post_meta( $member_post_id, '_santino_cup_stamps', $new_stamps );
            }
        }

        wp_redirect( admin_url( 'edit.php?post_type=santino_invoice&approved=1' ) );
        exit;
    }

    public static function handle_admin_reject_invoice() {
        $invoice_id = intval( $_GET['invoice_id'] ?? 0 );
        check_admin_referer( 'santino_reject_' . $invoice_id );

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Permission denied' );
        }

        update_post_meta( $invoice_id, '_santino_invoice_status', 'rejected' );
        wp_redirect( admin_url( 'edit.php?post_type=santino_invoice&rejected=1' ) );
        exit;
    }

    public static function generate_free_coffee_voucher( $member_id, $member_name, $phone ) {
        $voucher_code = 'FREE-CUP-' . strtoupper( wp_generate_password( 6, false ) );

        $post_id = wp_insert_post( array(
            'post_title'  => sprintf( 'Free Coffee Voucher - %s (%s)', $member_name, $voucher_code ),
            'post_type'   => 'santino_voucher',
            'post_status' => 'publish',
        ) );

        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_santino_voucher_code', $voucher_code );
            update_post_meta( $post_id, '_santino_voucher_member_id', $member_id );
            update_post_meta( $post_id, '_santino_voucher_phone', $phone );
            update_post_meta( $post_id, '_santino_voucher_status', 'unused' );
            update_post_meta( $post_id, '_santino_voucher_created_at', current_time( 'mysql' ) );
            update_post_meta( $post_id, '_santino_voucher_expiry', date( 'Y-m-d', strtotime( '+30 days' ) ) );
        }

        return $voucher_code;
    }

    /**
     * Helper: Find Member by Phone or VIP ID
     */
    public static function find_member_by_phone_or_id( $phone, $member_id_str = '' ) {
        $clean_phone = preg_replace( '/[^0-9]/', '', $phone );
        
        // 1. Search by VIP ID
        if ( ! empty( $member_id_str ) ) {
            $q = new WP_Query( array(
                'post_type'      => 'santino_member',
                'posts_per_page' => 1,
                'meta_query'     => array(
                    array(
                        'key'     => '_santino_member_id',
                        'value'   => trim( $member_id_str ),
                        'compare' => '=',
                    ),
                ),
            ) );
            if ( $q->have_posts() ) {
                return $q->posts[0];
            }
        }

        // 2. Search by Phone
        if ( ! empty( $clean_phone ) ) {
            $all_members = get_posts( array(
                'post_type'      => 'santino_member',
                'posts_per_page' => -1,
            ) );
            foreach ( $all_members as $m ) {
                $m_phone = preg_replace( '/[^0-9]/', '', get_post_meta( $m->ID, '_santino_member_phone', true ) );
                if ( ! empty( $m_phone ) && ( str_ends_with( $m_phone, substr( $clean_phone, -10 ) ) || str_ends_with( $clean_phone, substr( $m_phone, -10 ) ) ) ) {
                    return $m;
                }
            }
        }

        return null;
    }

    /**
     * 5. AJAX Handlers (Frontend Form Submissions)
     */
    // Apply for VIP Membership
    public static function handle_ajax_membership_apply() {
        check_ajax_referer( 'santino_frontend_nonce', 'security' );

        $full_name = sanitize_text_field( $_POST['fullname'] ?? '' );
        $email     = sanitize_email( $_POST['email'] ?? '' );
        $phone     = sanitize_text_field( $_POST['phone'] ?? '' );
        $tier      = sanitize_text_field( $_POST['tier'] ?? 'gold' );

        if ( empty( $full_name ) || empty( $phone ) ) {
            wp_send_json_error( array( 'message' => __( 'Please fill in Name and Phone Number.', 'santino' ) ) );
        }

        // Check if phone already registered
        $existing = self::find_member_by_phone_or_id( $phone );
        if ( $existing ) {
            $exist_id = get_post_meta( $existing->ID, '_santino_member_id', true );
            wp_send_json_success( array(
                'message'   => __( 'You are already a registered Santino VIP member!', 'santino' ),
                'member_id' => $exist_id,
                'name'      => $existing->post_title,
                'tier'      => strtoupper( get_post_meta( $existing->ID, '_santino_member_tier', true ) ?: 'GOLD' ),
            ) );
        }

        $member_id = 'SNT-VIP-' . strtoupper( wp_generate_password( 6, false ) );

        $post_id = wp_insert_post( array(
            'post_title'   => $full_name,
            'post_type'    => 'santino_member',
            'post_status'  => 'publish',
        ) );

        if ( is_wp_error( $post_id ) ) {
            wp_send_json_error( array( 'message' => __( 'Could not register. Please try again.', 'santino' ) ) );
        }

        update_post_meta( $post_id, '_santino_member_id', $member_id );
        update_post_meta( $post_id, '_santino_member_status', 'active' );
        update_post_meta( $post_id, '_santino_member_tier', $tier );
        update_post_meta( $post_id, '_santino_member_phone', $phone );
        update_post_meta( $post_id, '_santino_member_email', $email );
        update_post_meta( $post_id, '_santino_cup_stamps', 0 );
        update_post_meta( $post_id, '_santino_total_approved_cups', 0 );
        update_post_meta( $post_id, '_santino_total_free_coffees', 0 );

        wp_send_json_success( array(
            'message'   => __( 'Congratulations! Your Santino VIP Coffee Club membership is active.', 'santino' ),
            'member_id' => $member_id,
            'name'      => $full_name,
            'tier'      => strtoupper( $tier ),
        ) );
    }

    // Submit Coffee Invoice Number
    public static function handle_ajax_invoice_submit() {
        check_ajax_referer( 'santino_frontend_nonce', 'security' );

        $invoice_no = sanitize_text_field( $_POST['invoice_number'] ?? '' );
        $phone      = sanitize_text_field( $_POST['phone'] ?? '' );
        $member_id  = sanitize_text_field( $_POST['member_id'] ?? '' );
        $branch     = sanitize_text_field( $_POST['branch'] ?? 'Gulshan-2 Flagship Experience Center' );

        if ( empty( $invoice_no ) || ( empty( $phone ) && empty( $member_id ) ) ) {
            wp_send_json_error( array( 'message' => __( 'Please provide Invoice Number and your Phone Number / VIP ID.', 'santino' ) ) );
        }

        // Check if invoice already submitted
        $existing_inv = new WP_Query( array(
            'post_type'      => 'santino_invoice',
            'posts_per_page' => 1,
            'meta_query'     => array(
                array(
                    'key'     => '_santino_invoice_number',
                    'value'   => trim( $invoice_no ),
                    'compare' => '=',
                ),
            ),
        ) );

        if ( $existing_inv->have_posts() ) {
            wp_send_json_error( array( 'message' => sprintf( __( 'Invoice #%s has already been submitted!', 'santino' ), $invoice_no ) ) );
        }

        // Verify member exists or create on the fly
        $member = self::find_member_by_phone_or_id( $phone, $member_id );
        if ( ! $member && ! empty( $phone ) ) {
            // Auto-enroll member
            $new_vip_id = 'SNT-VIP-' . strtoupper( wp_generate_password( 6, false ) );
            $m_id = wp_insert_post( array(
                'post_title'   => 'Member ' . substr( $phone, -4 ),
                'post_type'    => 'santino_member',
                'post_status'  => 'publish',
            ) );
            update_post_meta( $m_id, '_santino_member_id', $new_vip_id );
            update_post_meta( $m_id, '_santino_member_phone', $phone );
            update_post_meta( $m_id, '_santino_cup_stamps', 0 );
            $member_id = $new_vip_id;
        } elseif ( $member ) {
            $member_id = get_post_meta( $member->ID, '_santino_member_id', true );
        }

        // Insert invoice
        $inv_post_id = wp_insert_post( array(
            'post_title'   => sprintf( 'Invoice #%s - %s', $invoice_no, $phone ),
            'post_type'    => 'santino_invoice',
            'post_status'  => 'publish',
        ) );

        if ( is_wp_error( $inv_post_id ) ) {
            wp_send_json_error( array( 'message' => __( 'Could not submit invoice. Please try again.', 'santino' ) ) );
        }

        update_post_meta( $inv_post_id, '_santino_invoice_number', $invoice_no );
        update_post_meta( $inv_post_id, '_santino_invoice_phone', $phone );
        update_post_meta( $inv_post_id, '_santino_invoice_member_id', $member_id );
        update_post_meta( $inv_post_id, '_santino_invoice_branch', $branch );
        update_post_meta( $inv_post_id, '_santino_invoice_status', 'pending' );
        update_post_meta( $inv_post_id, '_santino_invoice_submitted_at', current_time( 'mysql' ) );

        wp_send_json_success( array(
            'message'    => sprintf( __( 'Invoice #%s submitted successfully! Our barista/admin will verify it shortly and add your coffee stamp.', 'santino' ), $invoice_no ),
            'invoice_no' => $invoice_no,
            'status'     => 'pending',
        ) );
    }

    // Live Stamp Card & Vouchers Lookup
    public static function handle_ajax_stamp_card_lookup() {
        check_ajax_referer( 'santino_frontend_nonce', 'security' );

        $query_str = sanitize_text_field( $_POST['query'] ?? '' );
        if ( empty( $query_str ) ) {
            wp_send_json_error( array( 'message' => __( 'Please enter your Phone Number or VIP Member ID.', 'santino' ) ) );
        }

        $member = self::find_member_by_phone_or_id( $query_str, $query_str );
        if ( ! $member ) {
            wp_send_json_error( array( 'message' => __( 'No member found with this Phone Number or VIP ID. Please register first!', 'santino' ) ) );
        }

        $member_id    = get_post_meta( $member->ID, '_santino_member_id', true );
        $phone        = get_post_meta( $member->ID, '_santino_member_phone', true );
        $stamps       = intval( get_post_meta( $member->ID, '_santino_cup_stamps', true ) ?: 0 );
        $total_cups   = intval( get_post_meta( $member->ID, '_santino_total_approved_cups', true ) ?: 0 );
        $tier         = strtoupper( get_post_meta( $member->ID, '_santino_member_tier', true ) ?: 'GOLD' );

        // Fetch Recent Invoices
        $invoices = get_posts( array(
            'post_type'      => 'santino_invoice',
            'posts_per_page' => 5,
            'meta_query'     => array(
                'relation' => 'OR',
                array( 'key' => '_santino_invoice_phone', 'value' => $phone, 'compare' => '=' ),
                array( 'key' => '_santino_invoice_member_id', 'value' => $member_id, 'compare' => '=' ),
            ),
        ) );

        $invoice_list = array();
        foreach ( $invoices as $inv ) {
            $invoice_list[] = array(
                'invoice_no' => get_post_meta( $inv->ID, '_santino_invoice_number', true ),
                'branch'     => get_post_meta( $inv->ID, '_santino_invoice_branch', true ),
                'status'     => get_post_meta( $inv->ID, '_santino_invoice_status', true ),
                'date'       => get_the_date( 'M d, Y', $inv->ID ),
            );
        }

        // Fetch Free Coffee Vouchers
        $vouchers = get_posts( array(
            'post_type'      => 'santino_voucher',
            'posts_per_page' => 5,
            'meta_query'     => array(
                array( 'key' => '_santino_voucher_member_id', 'value' => $member->ID, 'compare' => '=' ),
            ),
        ) );

        $voucher_list = array();
        foreach ( $vouchers as $v ) {
            $voucher_list[] = array(
                'code'   => get_post_meta( $v->ID, '_santino_voucher_code', true ),
                'status' => get_post_meta( $v->ID, '_santino_voucher_status', true ),
                'expiry' => get_post_meta( $v->ID, '_santino_voucher_expiry', true ),
            );
        }

        wp_send_json_success( array(
            'name'         => $member->post_title,
            'member_id'    => $member_id,
            'phone'        => $phone,
            'tier'         => $tier,
            'stamps'       => $stamps,
            'total_cups'   => $total_cups,
            'invoices'     => $invoice_list,
            'vouchers'     => $voucher_list,
        ) );
    }

    /**
     * 6. Admin Vouchers Redemption Action
     */
    public static function handle_admin_redeem_voucher() {
        $voucher_id = intval( $_GET['voucher_id'] ?? 0 );
        check_admin_referer( 'santino_redeem_' . $voucher_id );

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Permission denied' );
        }

        update_post_meta( $voucher_id, '_santino_voucher_status', 'redeemed' );
        update_post_meta( $voucher_id, '_santino_voucher_redeemed_at', current_time( 'mysql' ) );

        wp_redirect( admin_url( 'edit.php?post_type=santino_voucher&redeemed=1' ) );
        exit;
    }

    /**
     * 7. Register Admin Submenus
     */
    public static function register_admin_pages() {
        add_submenu_page(
            'edit.php?post_type=santino_member',
            __( 'Loyalty Analytics & Stamp Engine', 'santino' ),
            __( 'Loyalty Reports', 'santino' ),
            'manage_options',
            'santino-loyalty-stats',
            array( __CLASS__, 'render_loyalty_dashboard' )
        );
    }

    public static function render_loyalty_dashboard() {
        $total_members  = wp_count_posts( 'santino_member' )->publish ?? 0;
        $total_invoices = wp_count_posts( 'santino_invoice' )->publish ?? 0;
        $total_vouchers = wp_count_posts( 'santino_voucher' )->publish ?? 0;
        $pending        = self::get_pending_invoices_count();
        ?>
        <div class="wrap" style="max-width: 1100px; margin-top: 20px;">
            <h1 style="font-weight: 800; color: #00625d; display: flex; align-items: center; gap: 10px;">
                ☕ Santino "Buy 5, Get 1 Free" Coffee Loyalty Engine
            </h1>
            <p class="description">Real-time tracking of coffee invoices, cup stamps, and free reward vouchers.</p>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin: 24px 0;">
                <div style="background: #fff; padding: 20px; border-radius: 12px; border-left: 4px solid #00625d; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase;">Total VIP Members</div>
                    <div style="font-size: 32px; font-weight: 800; color: #0f172a; margin-top: 6px;"><?php echo esc_html( $total_members ); ?></div>
                </div>

                <div style="background: #fff; padding: 20px; border-radius: 12px; border-left: 4px solid <?php echo ( $pending > 0 ) ? '#f59e0b' : '#10b981'; ?>; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase;">Pending Invoices</div>
                    <div style="font-size: 32px; font-weight: 800; color: <?php echo ( $pending > 0 ) ? '#f59e0b' : '#10b981'; ?>; margin-top: 6px;"><?php echo esc_html( $pending ); ?></div>
                </div>

                <div style="background: #fff; padding: 20px; border-radius: 12px; border-left: 4px solid #6366f1; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase;">Total Invoices Logged</div>
                    <div style="font-size: 32px; font-weight: 800; color: #0f172a; margin-top: 6px;"><?php echo esc_html( $total_invoices ); ?></div>
                </div>

                <div style="background: #fff; padding: 20px; border-radius: 12px; border-left: 4px solid #ec4899; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase;">Free Coffees Awarded</div>
                    <div style="font-size: 32px; font-weight: 800; color: #ec4899; margin-top: 6px;"><?php echo esc_html( $total_vouchers ); ?></div>
                </div>
            </div>

            <div style="background: #fff; padding: 24px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="margin-top: 0; color: #0f172a;">How Admin Invoice Verification Works:</h3>
                <ol style="line-height: 1.8; color: #334155;">
                    <li>When a customer drinks coffee and submits their invoice number from the website, it appears in <a href="<?php echo admin_url( 'edit.php?post_type=santino_invoice' ); ?>"><strong>Invoices & Stamps</strong></a> with <code>⏳ PENDING CHECK</code> status.</li>
                    <li>Admin/Barista clicks <strong>[Approve]</strong> after checking the cash counter receipt.</li>
                    <li>The system immediately adds <strong>+1 ☕ Stamp</strong> to the customer's digital card.</li>
                    <li>When the customer completes <strong>5 Approved Cups</strong>, the system automatically resets the stamp card and issues a <strong>Free Coffee Voucher</strong> (<code>FREE-CUP-XXXX</code>).</li>
                </ol>
            </div>
        </div>
        <?php
    }

    /**
     * 8. Shortcode: Digital VIP Pass Card
     */
    public static function render_vip_card_shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'id'     => 'SNT-VIP-88001',
            'name'   => 'VIP Valued Member',
            'tier'   => 'GOLD ROASTERY VIP',
            'expiry' => date( 'M Y', strtotime( '+1 year' ) ),
        ), $atts );

        ob_start();
        ?>
        <div class="santino-digital-vip-card" style="max-width: 440px; margin: 20px auto; background: linear-gradient(135deg, #0d2b28 0%, #00625d 50%, #1a1a1a 100%); border-radius: 20px; padding: 26px; color: #fff; box-shadow: 0 16px 35px rgba(0,98,93,0.3); position: relative; overflow: hidden; border: 1px solid rgba(218,165,32,0.4); font-family: 'Plus Jakarta Sans', sans-serif;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <div>
                    <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 2px; color: #c5a059; font-weight: 700;">Santino Coffee Club</span>
                    <h4 style="margin: 2px 0 0; font-size: 18px; font-weight: 800; color: #fff;">VIP PASS</h4>
                </div>
                <span style="background: #c5a059; color: #14191e; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; letter-spacing: 1px;"><?php echo esc_html( $atts['tier'] ); ?></span>
            </div>

            <div style="margin-bottom: 24px;">
                <div style="font-size: 11px; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 1px;">Card Number</div>
                <div style="font-size: 20px; font-weight: 700; letter-spacing: 3px; font-family: monospace; color: #fdfdfd; margin-top: 4px;"><?php echo esc_html( $atts['id'] ); ?></div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 14px;">
                <div>
                    <div style="font-size: 10px; color: rgba(255,255,255,0.6); text-transform: uppercase;">Member Name</div>
                    <div style="font-size: 14px; font-weight: 700; color: #fff; margin-top: 2px;"><?php echo esc_html( $atts['name'] ); ?></div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 10px; color: rgba(255,255,255,0.6); text-transform: uppercase;">Valid Thru</div>
                    <div style="font-size: 13px; font-weight: 600; color: #c5a059; margin-top: 2px;"><?php echo esc_html( $atts['expiry'] ); ?></div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

Santino_Membership_System::init();
