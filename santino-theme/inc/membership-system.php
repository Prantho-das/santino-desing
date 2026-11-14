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

        add_filter( 'manage_santino_redeem_posts_columns', array( __CLASS__, 'set_redeem_columns' ) );
        add_action( 'manage_santino_redeem_posts_custom_column', array( __CLASS__, 'render_redeem_columns' ), 10, 2 );

        // Admin Quick Approve / Reject Actions
        add_action( 'admin_action_santino_approve_invoice', array( __CLASS__, 'handle_admin_approve_invoice' ) );
        add_action( 'admin_action_santino_reject_invoice', array( __CLASS__, 'handle_admin_reject_invoice' ) );
        add_action( 'admin_action_santino_approve_redeem', array( __CLASS__, 'handle_admin_approve_redeem' ) );
        add_action( 'admin_action_santino_reject_redeem', array( __CLASS__, 'handle_admin_reject_redeem' ) );
        add_action( 'admin_action_santino_direct_redeem', array( __CLASS__, 'handle_admin_direct_redeem' ) );
        add_action( 'admin_action_santino_print_redeem_voucher', array( __CLASS__, 'handle_admin_print_redeem_voucher' ) );
        add_action( 'template_redirect', array( __CLASS__, 'handle_public_print_redeem_voucher' ) );
        add_action( 'admin_init', array( __CLASS__, 'handle_branch_csv_downloads' ) );
        add_action( 'admin_notices', array( __CLASS__, 'render_admin_notices' ) );

        // AJAX Handlers
        add_action( 'wp_ajax_santino_apply_membership', array( __CLASS__, 'handle_ajax_membership_apply' ) );
        add_action( 'wp_ajax_nopriv_santino_apply_membership', array( __CLASS__, 'handle_ajax_membership_apply' ) );

        add_action( 'wp_ajax_santino_submit_invoice', array( __CLASS__, 'handle_ajax_invoice_submit' ) );
        add_action( 'wp_ajax_nopriv_santino_submit_invoice', array( __CLASS__, 'handle_ajax_invoice_submit' ) );

        add_action( 'wp_ajax_santino_submit_redeem', array( __CLASS__, 'handle_ajax_redeem_submit' ) );
        add_action( 'wp_ajax_nopriv_santino_submit_redeem', array( __CLASS__, 'handle_ajax_redeem_submit' ) );

        add_action( 'wp_ajax_santino_lookup_stamp_card', array( __CLASS__, 'handle_ajax_stamp_card_lookup' ) );
        add_action( 'wp_ajax_nopriv_santino_lookup_stamp_card', array( __CLASS__, 'handle_ajax_stamp_card_lookup' ) );

        // Admin Menus & Submenus
        add_action( 'admin_menu', array( __CLASS__, 'register_admin_pages' ) );
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_qr_assets' ) );

        // Shortcodes
        add_shortcode( 'santino_stamp_portal', array( __CLASS__, 'render_stamp_portal_shortcode' ) );
        add_shortcode( 'santino_vip_card', array( __CLASS__, 'render_vip_card_shortcode' ) );
        add_shortcode( 'santino_daily_promotions', array( __CLASS__, 'render_daily_promotions_shortcode' ) );

        add_action( 'post_edit_form_tag', array( __CLASS__, 'add_post_enctype' ) );
        add_action( 'admin_footer', array( __CLASS__, 'render_admin_receipt_modal' ) );
    }

    public static function render_admin_receipt_modal() {
        if ( ! is_admin() ) {
            return;
        }
        ?>
        <!-- Santino Backend Receipt Lightbox Modal -->
        <div id="santinoReceiptModal" style="display:none; position:fixed; inset:0; z-index:9999999; background:rgba(15, 23, 42, 0.85); backdrop-filter:blur(5px); -webkit-backdrop-filter:blur(5px); align-items:center; justify-content:center; padding:20px; box-sizing:border-box;">
            <div class="santino-receipt-modal-dialog" style="position:relative; background:#ffffff; border-radius:14px; box-shadow:0 25px 50px -12px rgba(0,0,0,0.5); max-width:92vw; max-height:92vh; display:flex; flex-direction:column; overflow:hidden; animation:santinoModalPop 0.2s cubic-bezier(0.16, 1, 0.3, 1);">
                <div style="display:flex; justify-content:space-between; align-items:center; padding:12px 20px; background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span class="dashicons dashicons-format-image" style="color:#00625d; font-size:22px; width:22px; height:22px;"></span>
                        <strong id="santinoReceiptModalTitle" style="color:#0f172a; font-size:15px; font-weight:700;">Invoice Receipt Photo</strong>
                    </div>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <a id="santinoReceiptModalOpenTab" href="#" target="_blank" class="button button-small" style="display:inline-flex; align-items:center; gap:4px; font-weight:600; color:#475569;">
                            <span class="dashicons dashicons-external" style="font-size:14px; margin-top:2px;"></span> Open in New Tab
                        </a>
                        <button type="button" id="santinoReceiptModalClose" style="background:transparent; border:none; font-size:22px; line-height:1; cursor:pointer; color:#64748b; padding:4px 8px; border-radius:6px; display:inline-flex; align-items:center; justify-content:center;" title="Close (Esc)">
                            ✕
                        </button>
                    </div>
                </div>

                <div style="padding:16px; background:#0f172a; display:flex; align-items:center; justify-content:center; overflow:auto; max-height:calc(92vh - 60px); min-width:320px; min-height:220px;">
                    <img id="santinoReceiptModalImg" src="" alt="Receipt Photo" style="max-height:calc(85vh - 60px); max-width:100%; object-fit:contain; border-radius:6px; box-shadow:0 6px 20px rgba(0,0,0,0.6); display:block; margin:auto;">
                </div>
            </div>
        </div>

        <style>
        @keyframes santinoModalPop {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }
        #santinoReceiptModalClose:hover {
            color: #ef4444 !important;
            background: #fee2e2 !important;
        }
        </style>

        <script>
        jQuery(document).ready(function($) {
            function openSantinoReceiptModal(url, title) {
                if (!url) return;
                $('#santinoReceiptModalTitle').text(title || 'Invoice Receipt Photo');
                $('#santinoReceiptModalImg').attr('src', url);
                $('#santinoReceiptModalOpenTab').attr('href', url);
                $('#santinoReceiptModal').css('display', 'flex').hide().fadeIn(150);
                $('body').css('overflow', 'hidden');
            }

            function closeSantinoReceiptModal() {
                $('#santinoReceiptModal').fadeOut(150, function() {
                    $('#santinoReceiptModalImg').attr('src', '');
                    $('body').css('overflow', '');
                });
            }

            $(document).on('click', '.santino-receipt-modal-trigger', function(e) {
                e.preventDefault();
                var url = $(this).data('receipt-url') || $(this).attr('href');
                var title = $(this).data('receipt-title') || $(this).attr('title') || 'Invoice Receipt Photo';
                openSantinoReceiptModal(url, title);
            });

            $('body.post-type-santino_invoice .column-receipt_photo a').each(function() {
                $(this).addClass('santino-receipt-modal-trigger');
                if (!$(this).data('receipt-url')) {
                    $(this).data('receipt-url', $(this).attr('href'));
                }
            });

            $('#santinoReceiptModalClose').on('click', function(e) {
                e.preventDefault();
                closeSantinoReceiptModal();
            });

            $('#santinoReceiptModal').on('click', function(e) {
                if ($(e.target).is('#santinoReceiptModal')) {
                    closeSantinoReceiptModal();
                }
            });

            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $('#santinoReceiptModal').is(':visible')) {
                    closeSantinoReceiptModal();
                }
            });
        });
        </script>
        <?php
    }

    public static function add_post_enctype() {
        echo ' enctype="multipart/form-data"';
    }

    public static function is_valid_bd_phone( $phone ) {
        $clean = preg_replace( '/[\s\-\(\)\.]/', '', $phone );
        return (bool) preg_match( '/^(?:\+?880|0)1[3-9]\d{8}$/', $clean );
    }

    /**
     * 1. Register Custom Post Types
     */
    public static function register_post_types() {
        // Members CPT
        register_post_type( 'santino_member', array(
            'labels' => array(
                'name'               => __( 'Club Members', 'santino' ),
                'singular_name'      => __( 'Club Member', 'santino' ),
                'menu_name'          => __( 'Santino Club', 'santino' ),
                'add_new'            => __( 'Add New Member', 'santino' ),
                'add_new_item'       => __( 'Add Club Member', 'santino' ),
                'edit_item'          => __( 'Edit Member', 'santino' ),
                'all_items'          => __( 'All Club Members', 'santino' ),
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
            'supports'      => array( 'title', 'thumbnail' ),
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
            'show_in_menu'  => false,
            'supports'      => array( 'title' ),
        ) );

        // Redeem Requests CPT
        $pending_redeem_count = self::get_pending_redeems_count();
        $redeem_menu_title = $pending_redeem_count > 0 ? sprintf( __( 'Redeem Requests <span class="update-plugins count-%d"><span class="plugin-count">%d</span></span>', 'santino' ), $pending_redeem_count, $pending_redeem_count ) : __( 'Redeem Requests', 'santino' );

        register_post_type( 'santino_redeem', array(
            'labels' => array(
                'name'               => __( 'Free Cup Redeems', 'santino' ),
                'singular_name'      => __( 'Redeem Request', 'santino' ),
                'menu_name'          => $redeem_menu_title,
                'add_new'            => __( 'Add Redeem', 'santino' ),
                'add_new_item'       => __( 'Add Redeem Request', 'santino' ),
                'edit_item'          => __( 'Edit Redeem Request', 'santino' ),
                'all_items'          => __( 'Redeem Approvals', 'santino' ),
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

    public static function get_pending_redeems_count() {
        $query = new WP_Query( array(
            'post_type'      => 'santino_redeem',
            'post_status'    => 'publish',
            'meta_key'       => '_santino_redeem_status',
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
            __( 'Club Member Details & Coffee Stamp Card', 'santino' ),
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

        // Redeem Request Details & Verification
        add_meta_box(
            'santino_redeem_meta',
            __( 'Free Cup Redeem Verification & Barista Authorization', 'santino' ),
            array( __CLASS__, 'render_redeem_meta_box' ),
            'santino_redeem',
            'normal',
            'high'
        );
    }

    public static function render_member_meta_box( $post ) {
        wp_nonce_field( 'santino_save_member_meta', 'santino_member_nonce' );

        $member_id        = get_post_meta( $post->ID, '_santino_member_id', true );
        $phone            = get_post_meta( $post->ID, '_santino_member_phone', true );
        $email            = get_post_meta( $post->ID, '_santino_member_email', true );
        $birth_month      = get_post_meta( $post->ID, '_santino_member_birth_month', true );
        $birth_day        = get_post_meta( $post->ID, '_santino_member_birth_day', true );
        $tier             = get_post_meta( $post->ID, '_santino_member_tier', true ) ?: 'regular';
        $allow_reregister = get_post_meta( $post->ID, '_santino_allow_reregister', true );
        $stamps           = intval( get_post_meta( $post->ID, '_santino_cup_stamps', true ) ?: 0 );
        $total_free       = intval( get_post_meta( $post->ID, '_santino_total_free_coffees', true ) ?: 0 );
        $total_cups       = intval( get_post_meta( $post->ID, '_santino_total_approved_cups', true ) ?: 0 );

        if ( empty( $member_id ) ) {
            $member_id = 'SNT-REG-' . strtoupper( wp_generate_password( 6, false ) );
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
                        <?php echo ( 5 - $stamps ); ?> more approved cup<?php echo ( 5 - $stamps === 1 ) ? '' : 's'; ?> for 1 FREE COFFEE!
                    </span>
                </div>
            </div>

            <div style="display: flex; gap: 20px; font-size: 13px; color: #475569; border-top: 1px solid #e2e8f0; padding-top: 12px;">
                <div>Total Lifetime Cups Logged: <strong><?php echo esc_html( $total_cups ); ?></strong></div>
                <div>Available Free Coffees: <strong style="color: #00625d;"><?php echo esc_html( $total_free ); ?> Free Cups</strong></div>
            </div>
        </div>

        <?php if ( $total_free > 0 ) : ?>
            <div style="background: #ecfdf5; border: 2px solid #059669; border-radius: 10px; padding: 16px; margin-bottom: 24px; box-shadow: 0 2px 4px rgba(5,150,105,0.08);">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                    <div>
                        <div style="font-size: 15px; font-weight: bold; color: #065f46;">
                            🎁 Member has <?php echo esc_html( $total_free ); ?> Unused Free Coffee<?php echo $total_free > 1 ? 's' : ''; ?> Available!
                        </div>
                        <div style="color: #047857; font-size: 12px; margin-top: 3px;">
                            Counter Barista can serve 1 free cup directly below. It will deduct from member balance and log an approved redeem record.
                        </div>
                    </div>
                    <form method="post" action="<?php echo esc_url( admin_url( 'admin.php' ) ); ?>" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; margin: 0;">
                        <?php wp_nonce_field( 'santino_direct_redeem_' . $post->ID, 'santino_direct_redeem_nonce' ); ?>
                        <input type="hidden" name="action" value="santino_direct_redeem">
                        <input type="hidden" name="member_id" value="<?php echo esc_attr( $post->ID ); ?>">
                        
                        <label style="font-weight: bold; font-size: 12px; color: #065f46;">Drink:</label>
                        <?php 
                        $redeem_drinks = class_exists( 'Santino_Handcrafted_Items_System' ) 
                            ? Santino_Handcrafted_Items_System::get_redeemable_items() 
                            : array( 'Handcrafted Cappuccino', 'Signature Caffe Latte', 'Spanish Latte', 'Classic Americano', 'Caramel Macchiato', 'Flat White', 'Hot Mocha', 'Iced Signature Latte' );
                        ?>
                        <select name="free_item" required style="font-size: 12px; height: 32px; border-radius: 6px; border: 1px solid #059669; font-weight: 500;">
                            <option value="">-- Choose Free Item --</option>
                            <?php foreach ( $redeem_drinks as $rd ) : ?>
                                <option value="<?php echo esc_attr( $rd ); ?>"><?php echo esc_html( $rd ); ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label style="font-weight: bold; font-size: 12px; color: #065f46;">Branch:</label>
                        <select name="branch" style="font-size: 12px; height: 32px; border-radius: 6px; border: 1px solid #059669;">
                            <?php foreach ( self::get_cafe_branches() as $b ) : ?>
                                <option value="<?php echo esc_attr( $b ); ?>"><?php echo esc_html( $b ); ?></option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit" class="button button-primary" style="background: #059669; border-color: #047857; font-weight: bold; padding: 0 14px; height: 32px; line-height: 30px;" onclick="return confirm('Confirm serving 1 free coffee to this member and deducting from balance?');">
                            ✓ Serve &amp; Deduct 1 Free Cup
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <table class="form-table">
            <tr>
                <th><label><?php _e( 'Full Name', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_member_name" value="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>" class="regular-text" placeholder="Member Full Name"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Membership ID', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_member_id" value="<?php echo esc_attr( $member_id ); ?>" readonly style="font-weight:bold; color:#00625d; font-family:monospace; background:#f1f5f9;"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Membership Tier', 'santino' ); ?></label></th>
                <td><strong style="color: #00625d; text-transform: uppercase;"><?php echo esc_html( $tier ); ?> MEMBER</strong></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Mobile Number / WhatsApp', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_member_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Email Address', 'santino' ); ?></label></th>
                <td><input type="email" name="santino_member_email" value="<?php echo esc_attr( $email ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Birthday', 'santino' ); ?></label></th>
                <td>
                    Month: <input type="text" name="santino_member_birth_month" value="<?php echo esc_attr( $birth_month ); ?>" placeholder="e.g. October" style="width: 140px;">
                    Day: <input type="number" name="santino_member_birth_day" value="<?php echo esc_attr( $birth_day ); ?>" min="1" max="31" placeholder="Day" style="width: 70px;">
                </td>
            </tr>
            <tr>
                <th><label><?php _e( 'Re-Registration Permission', 'santino' ); ?></label></th>
                <td>
                    <label>
                        <input type="checkbox" name="santino_allow_reregister" value="yes" <?php checked( $allow_reregister, 'yes' ); ?>>
                        <strong>Allow Re-registration from Portal</strong> (Allows this mobile number to submit the portal enrollment form again)
                    </label>
                </td>
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

        global $pagenow;
        $is_new = ( $pagenow === 'post-new.php' || empty( $post->ID ) || $post->post_status === 'auto-draft' );

        $invoice_no = get_post_meta( $post->ID, '_santino_invoice_number', true );
        $phone      = get_post_meta( $post->ID, '_santino_invoice_phone', true );
        $member_id  = get_post_meta( $post->ID, '_santino_invoice_member_id', true );
        $branch     = get_post_meta( $post->ID, '_santino_invoice_branch', true );
        $cups       = max( 1, intval( get_post_meta( $post->ID, '_santino_invoice_cups', true ) ?: 1 ) );
        $status     = $is_new ? '' : ( get_post_meta( $post->ID, '_santino_invoice_status', true ) ?: 'pending' );
        $admin_note = get_post_meta( $post->ID, '_santino_invoice_admin_note', true );

        $approve_url = wp_nonce_url( admin_url( 'admin.php?action=santino_approve_invoice&invoice_id=' . $post->ID ), 'santino_approve_' . $post->ID );
        $reject_url  = wp_nonce_url( admin_url( 'admin.php?action=santino_reject_invoice&invoice_id=' . $post->ID ), 'santino_reject_' . $post->ID );
        ?>
        <?php if ( ! $is_new ) : ?>
        <div style="background: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #cbd5e1;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; font-size: 16px;">
                        Invoice Status: 
                        <?php if ( $status === 'approved' ) : ?>
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-weight: bold;">APPROVED (+<?php echo $cups; ?> Cup Stamp<?php echo $cups > 1 ? 's' : ''; ?> Added)</span>
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
                            ✓ Approve Invoice & Add +<?php echo $cups; ?> Cup<?php echo $cups > 1 ? 's' : ''; ?>
                        </a>
                        <a href="<?php echo esc_url( $reject_url ); ?>" class="button" style="color: #b91c1c; border-color: #b91c1c;" onclick="return confirm('Reject this invoice submission?');">
                            ✗ Reject
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php else : ?>
        <div style="background: #f8fafc; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; border: 1px dashed #cbd5e1; color: #64748b; font-size: 13px;">
            ℹ️ <strong>New Invoice Record:</strong> Verification and stamp approval actions will become active after this record is saved.
        </div>
        <?php endif; ?>

        <table class="form-table">
            <tr>
                <th><label><?php _e( 'Invoice / Memo Number', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_invoice_number" value="<?php echo esc_attr( $invoice_no ); ?>" class="regular-text" style="font-size: 1.1em; font-weight: bold; color: #0f172a;"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Receipt / Memo Photo', 'santino' ); ?></label></th>
                <td>
                    <?php
                    $img_url = get_post_meta( $post->ID, '_santino_invoice_image_url', true );
                    if ( ! $img_url && has_post_thumbnail( $post->ID ) ) {
                        $img_url = get_the_post_thumbnail_url( $post->ID, 'large' );
                    }
                    if ( $img_url ) :
                    ?>
                        <div style="margin-bottom: 12px;">
                            <a href="<?php echo esc_url( $img_url ); ?>" class="santino-receipt-modal-trigger" data-receipt-url="<?php echo esc_url( $img_url ); ?>" data-receipt-title="<?php echo esc_attr( 'Receipt Photo - Invoice #' . $invoice_no ); ?>" title="Click to View Full Photo in Modal" style="cursor: pointer; display: inline-block;">
                                <img src="<?php echo esc_url( $img_url ); ?>" style="max-height: 280px; max-width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); display: block; margin-bottom: 8px; transition: opacity 0.15s ease;" onmouseover="this.style.opacity='0.92'" onmouseout="this.style.opacity='1'">
                            </a>
                            <div style="display:flex; gap:8px;">
                                <button type="button" class="button button-primary santino-receipt-modal-trigger" data-receipt-url="<?php echo esc_url( $img_url ); ?>" data-receipt-title="<?php echo esc_attr( 'Receipt Photo - Invoice #' . $invoice_no ); ?>" style="background: #00625d; border-color: #004d49; font-weight: 600;">
                                    🔍 View in Modal Popup
                                </button>
                                <a href="<?php echo esc_url( $img_url ); ?>" target="_blank" class="button button-secondary" style="font-weight: 600;">
                                    ↗ Open in New Tab
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <p style="color: #64748b; font-style: italic; margin-bottom: 8px;"><?php _e( 'No customer receipt photo uploaded.', 'santino' ); ?></p>
                    <?php endif; ?>
                    <label style="font-size: 12px; color: #475569; display: block; margin-top: 6px; font-weight: 600;"><?php _e( 'Upload / Replace Memo Photo:', 'santino' ); ?></label>
                    <input type="file" name="santino_invoice_admin_image" accept="image/*">
                </td>
            </tr>
            <tr>
                <th><label><?php _e( 'Items Ordered / Consumed', 'santino' ); ?></label></th>
                <td>
                    <textarea name="santino_invoice_items_consumed" rows="2" class="large-text" placeholder="e.g. 2x Cappuccino, 1x Spanish Latte"><?php echo esc_textarea( get_post_meta( $post->ID, '_santino_invoice_items_consumed', true ) ); ?></textarea>
                    <p class="description"><?php _e( 'Details of handcrafted beverage or food items ordered', 'santino' ); ?></p>
                </td>
            </tr>
            <tr>
                <th><label><?php _e( 'Number of Cups', 'santino' ); ?></label></th>
                <td><input type="number" name="santino_invoice_cups" min="1" max="50" value="<?php echo esc_attr( $cups ); ?>" style="width: 80px; font-weight:bold; font-size:14px;"> ☕ (Total approved cups)</td>
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
                        <option value="approved" <?php selected( $status, 'approved' ); ?>>Approved</option>
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

    public static function render_redeem_meta_box( $post ) {
        wp_nonce_field( 'santino_save_redeem_meta', 'santino_redeem_nonce' );

        global $pagenow;
        $is_new = ( $pagenow === 'post-new.php' || empty( $post->ID ) || $post->post_status === 'auto-draft' );

        $code       = get_post_meta( $post->ID, '_santino_redeem_code', true );
        $phone      = get_post_meta( $post->ID, '_santino_redeem_phone', true );
        $item       = get_post_meta( $post->ID, '_santino_redeem_item', true );
        $branch     = get_post_meta( $post->ID, '_santino_redeem_branch', true );
        $status     = $is_new ? '' : ( get_post_meta( $post->ID, '_santino_redeem_status', true ) ?: 'pending' );
        $voucher_no = get_post_meta( $post->ID, '_santino_redeem_voucher_code', true );

        $approve_url = wp_nonce_url( admin_url( 'admin.php?action=santino_approve_redeem&redeem_id=' . $post->ID ), 'santino_approve_redeem_' . $post->ID );
        $reject_url  = wp_nonce_url( admin_url( 'admin.php?action=santino_reject_redeem&redeem_id=' . $post->ID ), 'santino_reject_redeem_' . $post->ID );
        ?>
        <?php if ( ! $is_new ) : ?>
        <div style="background: #fff; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #cbd5e1;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; font-size: 16px;">
                        Redeem Authorization Status: 
                        <?php if ( $status === 'approved' ) : ?>
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 20px; font-weight: bold;">✓ APPROVED (Free Cup Served)</span>
                        <?php elseif ( $status === 'rejected' ) : ?>
                            <span style="background: #fee2e2; color: #b91c1c; padding: 4px 10px; border-radius: 20px; font-weight: bold;">✗ REJECTED</span>
                        <?php else : ?>
                            <span style="background: #fef9c3; color: #854d0e; padding: 4px 10px; border-radius: 20px; font-weight: bold;">⏳ PENDING PORTAL APPROVAL</span>
                        <?php endif; ?>
                    </h3>
                </div>
                
                <?php if ( $status === 'pending' ) : ?>
                    <div style="display: flex; gap: 10px;">
                        <a href="<?php echo esc_url( $approve_url ); ?>" class="button button-primary" style="background: #15803d; border-color: #166534; font-weight: bold;" onclick="var itemVal = document.getElementById('santino_redeem_item_input').value; if(itemVal) { this.href += '&served_item=' + encodeURIComponent(itemVal); }">
                            ✓ Approve Free Cup Delivery (Barista Can Serve Coffee)
                        </a>
                        <a href="<?php echo esc_url( $reject_url ); ?>" class="button" style="color: #b91c1c; border-color: #b91c1c;" onclick="return confirm('Reject this redeem request?');">
                            ✗ Reject
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php else : ?>
        <div style="background: #f8fafc; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; border: 1px dashed #cbd5e1; color: #64748b; font-size: 13px;">
            ℹ️ <strong>New Redeem Request:</strong> Barista approval/rejection actions will become available after this record is submitted or saved.
        </div>
        <?php endif; ?>

        <table class="form-table">
            <tr>
                <th><label><?php _e( 'Redeem Request Code', 'santino' ); ?></label></th>
                <td><strong style="font-family:monospace; font-size:14px; color:#00625d;"><?php echo esc_html( $code ); ?></strong></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Customer Mobile Number', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_redeem_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Served Free Item / Beverage', 'santino' ); ?></label></th>
                <td>
                    <input type="text" id="santino_redeem_item_input" name="santino_redeem_item" value="<?php echo esc_attr( $item ?: 'Cappuccino' ); ?>" class="regular-text" style="font-weight:bold; color:#00625d; font-size:14px;">
                    <p class="description" style="margin-top:6px; color:#475569;">Specify the served beverage or click one of the quick items below:</p>
                    <div style="display:flex; flex-wrap:wrap; gap:6px; margin-top:8px;">
                        <?php 
                        $popular_coffees = array( 'Cappuccino', 'Cafe Latte', 'Americano', 'Spanish Latte', 'Caramel Macchiato', 'Cafe Mocha', 'Flat White', 'Iced Latte', 'Cold Brew', 'Hot Chocolate' );
                        foreach ( $popular_coffees as $coffee ) : ?>
                            <button type="button" class="button button-small" onclick="document.getElementById('santino_redeem_item_input').value='<?php echo esc_js( $coffee ); ?>';" style="border-radius:12px; font-size:12px;">
                                ☕ <?php echo esc_html( $coffee ); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th><label><?php _e( 'Barista / Counter Notes', 'santino' ); ?></label></th>
                <td>
                    <input type="text" name="santino_redeem_note" value="<?php echo esc_attr( get_post_meta( $post->ID, '_santino_redeem_note', true ) ); ?>" class="regular-text" placeholder="e.g. Barista: Karim / Almond milk / Extra hot">
                </td>
            </tr>
            <tr>
                <th><label><?php _e( 'Cafe Branch', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_redeem_branch" value="<?php echo esc_attr( $branch ); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Voucher Code Used', 'santino' ); ?></label></th>
                <td><code><?php echo esc_html( $voucher_no ); ?></code></td>
            </tr>
            <tr>
                <th><label><?php _e( 'Redeem Status', 'santino' ); ?></label></th>
                <td>
                    <select name="santino_redeem_status">
                        <option value="pending" <?php selected( $status, 'pending' ); ?>>Pending Portal Approval</option>
                        <option value="approved" <?php selected( $status, 'approved' ); ?>>Approved (Free Cup Served)</option>
                        <option value="rejected" <?php selected( $status, 'rejected' ); ?>>Rejected</option>
                    </select>
                </td>
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
            if ( isset( $_POST['santino_member_name'] ) && ! empty( trim( $_POST['santino_member_name'] ) ) ) {
                $name = sanitize_text_field( $_POST['santino_member_name'] );
                update_post_meta( $post_id, '_santino_member_name', $name );
                remove_action( 'save_post', array( __CLASS__, 'save_custom_meta_data' ) );
                wp_update_post( array(
                    'ID'         => $post_id,
                    'post_title' => $name,
                ) );
                add_action( 'save_post', array( __CLASS__, 'save_custom_meta_data' ) );
            }
            if ( isset( $_POST['santino_member_phone'] ) ) {
                update_post_meta( $post_id, '_santino_member_phone', sanitize_text_field( $_POST['santino_member_phone'] ) );
            }
            if ( isset( $_POST['santino_member_email'] ) ) {
                update_post_meta( $post_id, '_santino_member_email', sanitize_email( $_POST['santino_member_email'] ) );
            }
            if ( isset( $_POST['santino_member_birth_month'] ) ) {
                update_post_meta( $post_id, '_santino_member_birth_month', sanitize_text_field( $_POST['santino_member_birth_month'] ) );
            }
            if ( isset( $_POST['santino_member_birth_day'] ) ) {
                update_post_meta( $post_id, '_santino_member_birth_day', sanitize_text_field( $_POST['santino_member_birth_day'] ) );
                $m = sanitize_text_field( $_POST['santino_member_birth_month'] ?? '' );
                $d = sanitize_text_field( $_POST['santino_member_birth_day'] ?? '' );
                update_post_meta( $post_id, '_santino_member_birthday', $m . ' - ' . $d );
            }
            $allow = isset( $_POST['santino_allow_reregister'] ) ? 'yes' : 'no';
            update_post_meta( $post_id, '_santino_allow_reregister', $allow );

            if ( isset( $_POST['santino_cup_stamps'] ) ) {
                update_post_meta( $post_id, '_santino_cup_stamps', intval( $_POST['santino_cup_stamps'] ) );
            }
        }

        // Save Invoice Meta
        if ( isset( $_POST['santino_invoice_nonce'] ) && wp_verify_nonce( $_POST['santino_invoice_nonce'], 'santino_save_invoice_meta' ) ) {
            if ( isset( $_POST['santino_invoice_number'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_number', sanitize_text_field( $_POST['santino_invoice_number'] ) );
            }
            if ( isset( $_POST['santino_invoice_cups'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_cups', max( 1, intval( $_POST['santino_invoice_cups'] ) ) );
            }
            if ( isset( $_POST['santino_invoice_items_consumed'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_items_consumed', sanitize_textarea_field( $_POST['santino_invoice_items_consumed'] ) );
            }
            if ( isset( $_POST['santino_invoice_phone'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_phone', sanitize_text_field( $_POST['santino_invoice_phone'] ) );
            }
            if ( isset( $_POST['santino_invoice_member_id'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_member_id', sanitize_text_field( $_POST['santino_invoice_member_id'] ) );
            }
            if ( isset( $_POST['santino_invoice_branch'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_branch', sanitize_text_field( $_POST['santino_invoice_branch'] ) );
            }
            if ( ! empty( $_FILES['santino_invoice_admin_image']['name'] ) ) {
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                require_once( ABSPATH . 'wp-admin/includes/file.php' );
                require_once( ABSPATH . 'wp-admin/includes/media.php' );
                $att_id = media_handle_upload( 'santino_invoice_admin_image', $post_id );
                if ( ! is_wp_error( $att_id ) ) {
                    $url = wp_get_attachment_url( $att_id );
                    update_post_meta( $post_id, '_santino_invoice_image_id', $att_id );
                    update_post_meta( $post_id, '_santino_invoice_image_url', $url );
                    set_post_thumbnail( $post_id, $att_id );
                }
            }
            if ( isset( $_POST['santino_invoice_status'] ) ) {
                $new_status  = sanitize_text_field( $_POST['santino_invoice_status'] );
                $prev_status = get_post_meta( $post_id, '_santino_invoice_status', true );
                update_post_meta( $post_id, '_santino_invoice_status', $new_status );
                if ( $new_status === 'approved' && $prev_status !== 'approved' ) {
                    update_post_meta( $post_id, '_santino_invoice_approved_at', current_time( 'mysql' ) );
                    self::credit_invoice_cups_to_member( $post_id );
                }
            }
            if ( isset( $_POST['santino_invoice_admin_note'] ) ) {
                update_post_meta( $post_id, '_santino_invoice_admin_note', sanitize_textarea_field( $_POST['santino_invoice_admin_note'] ) );
            }
        }

        // Save Redeem Meta
        if ( isset( $_POST['santino_redeem_nonce'] ) && wp_verify_nonce( $_POST['santino_redeem_nonce'], 'santino_save_redeem_meta' ) ) {
            if ( isset( $_POST['santino_redeem_status'] ) ) {
                update_post_meta( $post_id, '_santino_redeem_status', sanitize_text_field( $_POST['santino_redeem_status'] ) );
            }
            if ( isset( $_POST['santino_redeem_phone'] ) ) {
                update_post_meta( $post_id, '_santino_redeem_phone', sanitize_text_field( $_POST['santino_redeem_phone'] ) );
            }
            if ( isset( $_POST['santino_redeem_item'] ) ) {
                update_post_meta( $post_id, '_santino_redeem_item', sanitize_text_field( $_POST['santino_redeem_item'] ) );
            }
            if ( isset( $_POST['santino_redeem_branch'] ) ) {
                update_post_meta( $post_id, '_santino_redeem_branch', sanitize_text_field( $_POST['santino_redeem_branch'] ) );
            }
            if ( isset( $_POST['santino_redeem_note'] ) ) {
                update_post_meta( $post_id, '_santino_redeem_note', sanitize_text_field( $_POST['santino_redeem_note'] ) );
            }
        }
    }

    /**
     * 3. Admin Columns
     */
    public static function set_member_columns( $columns ) {
        return array(
            'cb'            => $columns['cb'],
            'title'         => __( 'Member', 'santino' ),
            'member_id'     => __( 'Member ID', 'santino' ),
            'phone'         => __( 'Mobile', 'santino' ),
            'birthday'      => __( 'Birthday', 'santino' ),
            'email'         => __( 'Email', 'santino' ),
            'stamp_card'    => __( 'Stamp Card (5 Cups)', 'santino' ),
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
                $m_raw_phone = get_post_meta( $post_id, '_santino_member_phone', true );
                echo esc_html( self::normalize_phone( $m_raw_phone ) ?: '—' );
                break;
            case 'birthday':
                $b = get_post_meta( $post_id, '_santino_member_birthday', true );
                echo esc_html( $b ?: '—' );
                break;
            case 'email':
                echo esc_html( get_post_meta( $post_id, '_santino_member_email', true ) ?: '—' );
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

    public static function resolve_request_source_label( $source, $fallback = 'Membership Portal' ) {
        $map = array(
            'portal_redeem_modal'  => 'Membership Portal (Redeem Modal)',
            'qr_portal_redeem'     => 'QR Scan Portal Redeem',
            'admin_direct_counter' => 'Admin Direct Counter',
            'today_offer_tab'      => "Today's Offer Tab",
            'portal_invoice_tab'   => 'Log Invoice Tab',
            'offers_page'          => 'Offers Page',
            'rest_api'             => 'REST API',
        );
        return $map[ $source ] ?? ( $source ? ucwords( str_replace( '_', ' ', $source ) ) : $fallback );
    }

    public static function set_invoice_columns( $columns ) {
        return array(
            'cb'            => $columns['cb'],
            'title'         => __( 'Invoice Record', 'santino' ),
            'invoice_no'    => __( 'Invoice #', 'santino' ),
            'receipt_photo' => __( 'Receipt Photo', 'santino' ),
            'cups'          => __( 'Cups', 'santino' ),
            'items_consumed'=> __( 'Items Consumed', 'santino' ),
            'phone'         => __( 'Customer Phone', 'santino' ),
            'branch'        => __( 'Cafe Branch', 'santino' ),
            'source'        => __( 'Request Source', 'santino' ),
            'status'        => __( 'Verification Status', 'santino' ),
            'actions'       => __( 'Quick Action', 'santino' ),
            'date'          => __( 'Submitted Date', 'santino' ),
        );
    }

    public static function render_invoice_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'invoice_no':
                $no = get_post_meta( $post_id, '_santino_invoice_number', true );
                echo '<strong style="font-family:monospace; font-size:13px; color:#0f172a;">' . esc_html( $no ) . '</strong>';
                break;
            case 'receipt_photo':
                $img_url = get_post_meta( $post_id, '_santino_invoice_image_url', true );
                if ( ! $img_url && has_post_thumbnail( $post_id ) ) {
                    $img_url = get_the_post_thumbnail_url( $post_id, 'full' );
                }
                if ( $img_url ) {
                    $no = get_post_meta( $post_id, '_santino_invoice_number', true ) ?: get_the_title( $post_id );
                    echo '<a href="' . esc_url( $img_url ) . '" class="santino-receipt-modal-trigger" data-receipt-url="' . esc_url( $img_url ) . '" data-receipt-title="' . esc_attr( 'Receipt Photo - Invoice #' . $no ) . '" title="Click to view full receipt in modal" style="display:inline-block; cursor:pointer;">' .
                         '<img src="' . esc_url( $img_url ) . '" style="width:45px; height:45px; object-fit:cover; border-radius:6px; border:1px solid #cbd5e1; box-shadow:0 1px 3px rgba(0,0,0,0.1); vertical-align:middle; transition:transform 0.15s ease;" onmouseover="this.style.transform=\'scale(1.1)\'" onmouseout="this.style.transform=\'scale(1)\'">' .
                         '</a>';
                } else {
                    echo '<span style="color:#94a3b8; font-size:11px;">No Photo</span>';
                }
                break;
            case 'cups':
                $cups = intval( get_post_meta( $post_id, '_santino_invoice_cups', true ) ?: 1 );
                $promo_claimed = get_post_meta( $post_id, '_santino_invoice_promo_claimed', true );
                $promo_day     = get_post_meta( $post_id, '_santino_invoice_promo_day', true );
                $promo_title   = get_post_meta( $post_id, '_santino_invoice_promo_title', true );
                echo '<strong style="color:#00625d; font-size:13px;">' . esc_html( $cups ) . ' ☕</strong>';
                if ( $promo_claimed === 'yes' ) {
                    $label = $promo_title ? ( $promo_day ? strtoupper( $promo_day ) . ': ' . $promo_title : $promo_title ) : ( $promo_day ? strtoupper( $promo_day ) . ' PROMO' : 'PROMO' );
                    echo '<br><span style="display:inline-block;margin-top:3px;background:#fef3c7;color:#92400e;border:1px solid #f59e0b;border-radius:4px;padding:1px 6px;font-size:10px;font-weight:700;">' . esc_html( $label ) . '</span>';
                }
                break;
            case 'items_consumed':
                $items = get_post_meta( $post_id, '_santino_invoice_items_consumed', true );
                if ( $items ) {
                    echo '<span style="font-size:12px; color:#1e293b; background:#f1f5f9; padding:2px 8px; border-radius:6px; display:inline-block; max-width:180px; line-height:1.35;" title="' . esc_attr( $items ) . '">' . esc_html( wp_trim_words( $items, 6, '...' ) ) . '</span>';
                } else {
                    echo '<span style="color:#94a3b8; font-size:11px;">—</span>';
                }
                break;
            case 'phone':
                $inv_raw_phone = get_post_meta( $post_id, '_santino_invoice_phone', true );
                echo esc_html( self::normalize_phone( $inv_raw_phone ) ?: '—' );
                break;
            case 'branch':
                echo esc_html( get_post_meta( $post_id, '_santino_invoice_branch', true ) ?: 'Santino Flagship' );
                break;
            case 'source':
                $inv_src  = get_post_meta( $post_id, '_santino_invoice_source', true );
                $inv_page = get_post_meta( $post_id, '_santino_invoice_source_page', true );
                $is_promo = get_post_meta( $post_id, '_santino_invoice_promo_claimed', true ) === 'yes';
                $label    = self::resolve_request_source_label( $inv_src, $is_promo ? "Today's Offer Tab" : 'Log Invoice Tab' );
                $bg       = $is_promo ? '#fef3c7' : '#e0f2fe';
                $fg       = $is_promo ? '#92400e' : '#0369a1';
                echo '<span style="display:inline-block; background:' . esc_attr( $bg ) . '; color:' . esc_attr( $fg ) . '; padding:2px 8px; border-radius:6px; font-size:11px; font-weight:600;">' . esc_html( $label ) . '</span>';
                if ( $inv_page ) {
                    echo '<div style="font-size:10px; color:#64748b; margin-top:2px; word-break:break-all;">' . esc_html( $inv_page ) . '</div>';
                }
                break;
            case 'status':
                $status = get_post_meta( $post_id, '_santino_invoice_status', true ) ?: 'pending';
                $cups   = intval( get_post_meta( $post_id, '_santino_invoice_cups', true ) ?: 1 );
                if ( $status === 'approved' ) {
                    echo '<span style="color:#15803d; background:#dcfce7; padding:3px 8px; border-radius:6px; font-weight:bold; font-size:11px;">✓ APPROVED (+' . $cups . ' ☕)</span>';
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

    public static function set_redeem_columns( $columns ) {
        return array(
            'cb'          => $columns['cb'],
            'title'       => __( 'Redeem Record', 'santino' ),
            'phone'       => __( 'Customer Phone', 'santino' ),
            'free_item'   => __( 'Free Item Selected', 'santino' ),
            'branch'      => __( 'Cafe Branch', 'santino' ),
            'source'      => __( 'Request Source', 'santino' ),
            'status'      => __( 'Portal Approval', 'santino' ),
            'actions'     => __( 'Barista Action', 'santino' ),
            'date'        => __( 'Requested Date', 'santino' ),
        );
    }

    public static function render_redeem_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'phone':
                echo esc_html( get_post_meta( $post_id, '_santino_redeem_phone', true ) ?: '—' );
                break;
            case 'free_item':
                echo '<strong style="color:#00625d;">' . esc_html( get_post_meta( $post_id, '_santino_redeem_item', true ) ?: '—' ) . '</strong>';
                break;
            case 'branch':
                echo esc_html( get_post_meta( $post_id, '_santino_redeem_branch', true ) ?: 'Santino Flagship' );
                break;
            case 'source':
                $src      = get_post_meta( $post_id, '_santino_redeem_source', true );
                $src_page = get_post_meta( $post_id, '_santino_redeem_source_page', true );
                $src_ip   = get_post_meta( $post_id, '_santino_redeem_ip', true );
                $by_user  = get_post_meta( $post_id, '_santino_redeem_by_user', true );
                $label    = self::resolve_request_source_label( $src, 'Membership Portal' );
                echo '<span style="display:inline-block; background:#f0fdf4; color:#166534; border:1px solid #bbf7d0; padding:2px 8px; border-radius:6px; font-size:11px; font-weight:600;">' . esc_html( $label ) . '</span>';
                if ( $src_page ) {
                    echo '<div style="font-size:10px; color:#64748b; margin-top:2px; word-break:break-all;">' . esc_html( $src_page ) . '</div>';
                }
                if ( $by_user ) {
                    echo '<div style="font-size:10px; color:#475569;">By: ' . esc_html( $by_user ) . '</div>';
                } elseif ( $src_ip ) {
                    echo '<div style="font-size:10px; color:#94a3b8;">IP: ' . esc_html( $src_ip ) . '</div>';
                }
                break;
            case 'status':
                $status = get_post_meta( $post_id, '_santino_redeem_status', true ) ?: 'pending';
                if ( $status === 'approved' ) {
                    echo '<span style="color:#15803d; background:#dcfce7; padding:3px 8px; border-radius:6px; font-weight:bold; font-size:11px;">✓ APPROVED (Free Cup Served)</span>';
                } elseif ( $status === 'rejected' ) {
                    echo '<span style="color:#b91c1c; background:#fee2e2; padding:3px 8px; border-radius:6px; font-weight:bold; font-size:11px;">✗ REJECTED</span>';
                } else {
                    echo '<span style="color:#854d0e; background:#fef9c3; padding:3px 8px; border-radius:6px; font-weight:bold; font-size:11px;">⏳ PENDING PORTAL APPROVAL</span>';
                }
                break;
            case 'actions':
                $status    = get_post_meta( $post_id, '_santino_redeem_status', true ) ?: 'pending';
                $print_url = admin_url( 'admin.php?action=santino_print_redeem_voucher&redeem_id=' . $post_id );
                if ( $status === 'pending' ) {
                    $approve_url = wp_nonce_url( admin_url( 'admin.php?action=santino_approve_redeem&redeem_id=' . $post_id ), 'santino_approve_redeem_' . $post_id );
                    $reject_url  = wp_nonce_url( admin_url( 'admin.php?action=santino_reject_redeem&redeem_id=' . $post_id ), 'santino_reject_redeem_' . $post_id );
                    echo '<a href="' . esc_url( $approve_url ) . '" class="button button-small button-primary" style="background:#15803d; border-color:#166534;">✓ Approve</a> ';
                    echo '<a href="' . esc_url( $reject_url ) . '" class="button button-small" style="color:#b91c1c;">Reject</a> ';
                    echo '<a href="' . esc_url( $print_url ) . '" target="_blank" class="button button-small" title="Print Slip" style="color:#00625d; border-color:#00625d;">🖨️</a>';
                } elseif ( $status === 'approved' ) {
                    echo '<a href="' . esc_url( $print_url ) . '" target="_blank" class="button button-small button-primary" style="background:#00625d; border-color:#004d49; font-weight:bold;">🖨️ Print 6th Cup Slip</a>';
                } else {
                    echo '—';
                }
                break;
        }
    }

    /**
     * 4. Admin Invoice Approval Action (5-Cup Reward Engine with Cup Calculations)
     */
    public static function credit_invoice_cups_to_member( $invoice_id, $cups = null ) {
        $already_credited = get_post_meta( $invoice_id, '_santino_invoice_stamps_credited', true );
        if ( $already_credited === 'yes' ) {
            return false;
        }

        if ( $cups === null ) {
            $cups = max( 1, intval( get_post_meta( $invoice_id, '_santino_invoice_cups', true ) ?: 1 ) );
        }

        $phone          = get_post_meta( $invoice_id, '_santino_invoice_phone', true );
        $member_id_str  = get_post_meta( $invoice_id, '_santino_invoice_member_id', true );
        $member_post_id = get_post_meta( $invoice_id, '_santino_invoice_member_post_id', true );

        $member = null;
        if ( ! empty( $member_post_id ) ) {
            $m_post = get_post( $member_post_id );
            if ( $m_post && $m_post->post_type === 'santino_member' ) {
                $member = $m_post;
            }
        }
        if ( ! $member ) {
            $member = self::find_member_by_phone_or_id( $phone, $member_id_str );
        }

        if ( $member ) {
            $member_post_id   = $member->ID;
            $current_stamps   = intval( get_post_meta( $member_post_id, '_santino_cup_stamps', true ) ?: 0 );
            $total_cups       = intval( get_post_meta( $member_post_id, '_santino_total_approved_cups', true ) ?: 0 );
            $total_free       = intval( get_post_meta( $member_post_id, '_santino_total_free_coffees', true ) ?: 0 );

            $new_total_stamps = $current_stamps + $cups;
            $vouchers_won     = floor( $new_total_stamps / 5 );
            $remaining_stamps = $new_total_stamps % 5;

            update_post_meta( $member_post_id, '_santino_total_approved_cups', $total_cups + $cups );
            update_post_meta( $member_post_id, '_santino_cup_stamps', $remaining_stamps );

            if ( $vouchers_won > 0 ) {
                update_post_meta( $member_post_id, '_santino_total_free_coffees', $total_free + $vouchers_won );
                for ( $v = 0; $v < $vouchers_won; $v++ ) {
                    self::generate_free_coffee_voucher( $member_post_id, $member->post_title, $phone );
                }
            }

            update_post_meta( $invoice_id, '_santino_invoice_stamps_credited', 'yes' );
            update_post_meta( $invoice_id, '_santino_invoice_member_post_id', $member_post_id );
            return $vouchers_won;
        }

        return false;
    }

    public static function handle_admin_approve_invoice() {
        $invoice_id = intval( $_GET['invoice_id'] ?? 0 );
        check_admin_referer( 'santino_approve_' . $invoice_id );

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Permission denied' );
        }

        $current_status = get_post_meta( $invoice_id, '_santino_invoice_status', true );
        if ( $current_status === 'approved' ) {
            wp_redirect( admin_url( 'edit.php?post_type=santino_invoice&approved=already' ) );
            exit;
        }

        update_post_meta( $invoice_id, '_santino_invoice_status', 'approved' );
        update_post_meta( $invoice_id, '_santino_invoice_approved_at', current_time( 'mysql' ) );

        $vouchers_won = self::credit_invoice_cups_to_member( $invoice_id );

        if ( $vouchers_won !== false && $vouchers_won > 0 ) {
            wp_redirect( admin_url( 'edit.php?post_type=santino_invoice&approved=free_coffee_issued' ) );
            exit;
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

    public static function handle_admin_approve_redeem() {
        $redeem_id = intval( $_GET['redeem_id'] ?? 0 );
        check_admin_referer( 'santino_approve_redeem_' . $redeem_id );

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Permission denied' );
        }

        update_post_meta( $redeem_id, '_santino_redeem_status', 'approved' );
        update_post_meta( $redeem_id, '_santino_redeem_approved_at', current_time( 'mysql' ) );

        $voucher_id = intval( get_post_meta( $redeem_id, '_santino_redeem_voucher_id', true ) );
        if ( $voucher_id ) {
            update_post_meta( $voucher_id, '_santino_voucher_status', 'redeemed' );
            update_post_meta( $voucher_id, '_santino_voucher_redeemed_at', current_time( 'mysql' ) );
        }

        $member_id = intval( get_post_meta( $redeem_id, '_santino_redeem_member_id', true ) );
        if ( $member_id ) {
            $total_free = intval( get_post_meta( $member_id, '_santino_total_free_coffees', true ) ?: 0 );
            if ( $total_free > 0 ) {
                update_post_meta( $member_id, '_santino_total_free_coffees', $total_free - 1 );
            }
        }

        wp_redirect( admin_url( 'edit.php?post_type=santino_redeem&approved=1&print_id=' . $redeem_id ) );
        exit;
    }

    public static function handle_admin_reject_redeem() {
        $redeem_id = intval( $_GET['redeem_id'] ?? 0 );
        check_admin_referer( 'santino_reject_redeem_' . $redeem_id );

        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Permission denied' );
        }

        update_post_meta( $redeem_id, '_santino_redeem_status', 'rejected' );

        $voucher_id = intval( get_post_meta( $redeem_id, '_santino_redeem_voucher_id', true ) );
        if ( $voucher_id ) {
            update_post_meta( $voucher_id, '_santino_voucher_status', 'unused' );
        }

        wp_redirect( admin_url( 'edit.php?post_type=santino_redeem&rejected=1' ) );
        exit;
    }

    public static function handle_admin_direct_redeem() {
        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Permission denied' );
        }

        $member_id = intval( $_POST['member_id'] ?? 0 );
        check_admin_referer( 'santino_direct_redeem_' . $member_id, 'santino_direct_redeem_nonce' );

        $member = get_post( $member_id );
        if ( ! $member || $member->post_type !== 'santino_member' ) {
            wp_die( 'Invalid member' );
        }

        $total_free = intval( get_post_meta( $member_id, '_santino_total_free_coffees', true ) ?: 0 );
        if ( $total_free < 1 ) {
            wp_redirect( add_query_arg( array( 'post' => $member_id, 'action' => 'edit', 'redeem_error' => 'no_balance' ), admin_url( 'post.php' ) ) );
            exit;
        }

        $item    = sanitize_text_field( $_POST['free_item'] ?? 'Handcrafted Cappuccino' );
        $branch  = sanitize_text_field( $_POST['branch'] ?? 'Gulshan-2 Flagship' );
        $phone   = get_post_meta( $member_id, '_santino_member_phone', true );
        $mid_str = get_post_meta( $member_id, '_santino_member_id', true );

        // Deduct 1 free coffee
        update_post_meta( $member_id, '_santino_total_free_coffees', max( 0, $total_free - 1 ) );

        // Create approved redeem record
        $code = 'RDM-' . strtoupper( wp_generate_password( 6, false ) );
        $redeem_id = wp_insert_post( array(
            'post_title'  => sprintf( 'Direct Counter Redeem: %s (%s)', $item, $phone ?: $mid_str ),
            'post_type'   => 'santino_redeem',
            'post_status' => 'publish',
        ) );

        if ( $redeem_id && ! is_wp_error( $redeem_id ) ) {
            update_post_meta( $redeem_id, '_santino_redeem_code', $code );
            update_post_meta( $redeem_id, '_santino_redeem_phone', $phone );
            update_post_meta( $redeem_id, '_santino_redeem_item', $item );
            update_post_meta( $redeem_id, '_santino_redeem_branch', $branch );
            update_post_meta( $redeem_id, '_santino_redeem_status', 'approved' );
            update_post_meta( $redeem_id, '_santino_redeem_member_id', $member_id );
            update_post_meta( $redeem_id, '_santino_redeem_approved_at', current_time( 'mysql' ) );
            update_post_meta( $redeem_id, '_santino_redeem_source', 'admin_direct_counter' );
            update_post_meta( $redeem_id, '_santino_redeem_source_page', 'wp-admin/post.php?post=' . $member_id );
            $current_admin = wp_get_current_user();
            if ( $current_admin && $current_admin->ID ) {
                update_post_meta( $redeem_id, '_santino_redeem_by_user', $current_admin->user_login );
            }
        }

        // Mark matching voucher redeemed if any
        $vouchers = get_posts( array(
            'post_type'      => 'santino_voucher',
            'posts_per_page' => 1,
            'meta_query'     => array(
                array(
                    'key'     => '_santino_voucher_member_id',
                    'value'   => $member_id,
                    'compare' => '=',
                ),
                array(
                    'key'     => '_santino_voucher_status',
                    'value'   => 'unused',
                    'compare' => '=',
                ),
            ),
        ) );

        if ( ! empty( $vouchers ) ) {
            update_post_meta( $vouchers[0]->ID, '_santino_voucher_status', 'redeemed' );
            update_post_meta( $vouchers[0]->ID, '_santino_voucher_redeemed_at', current_time( 'mysql' ) );
            if ( $redeem_id ) {
                update_post_meta( $redeem_id, '_santino_redeem_voucher_id', $vouchers[0]->ID );
                update_post_meta( $redeem_id, '_santino_redeem_voucher_code', get_post_meta( $vouchers[0]->ID, '_santino_voucher_code', true ) );
            }
        }

        wp_redirect( add_query_arg( array( 'post' => $member_id, 'action' => 'edit', 'redeem_success' => '1', 'served_item' => urlencode( $item ), 'print_id' => $redeem_id ), admin_url( 'post.php' ) ) );
        exit;
    }

    public static function render_admin_notices() {
        if ( isset( $_GET['approved'] ) && isset( $_GET['print_id'] ) ) {
            $p_id  = intval( $_GET['print_id'] );
            $p_url = admin_url( 'admin.php?action=santino_print_redeem_voucher&redeem_id=' . $p_id );
            echo '<div class="notice notice-success is-dismissible" style="border-left-color: #15803d;"><p><strong>✓ 6th Cup Free Redeem Approved!</strong> Voucher is ready for barista fulfillment. <a href="' . esc_url( $p_url ) . '" target="_blank" class="button button-primary button-small" style="background:#00625d; border-color:#004d49; margin-left:10px;">🖨️ Print 6th Cup POS Slip</a></p><script>window.open(' . json_encode( $p_url ) . ', "_blank");</script></div>';
        }
        if ( isset( $_GET['redeem_success'] ) ) {
            $item  = isset( $_GET['served_item'] ) ? sanitize_text_field( $_GET['served_item'] ) : 'Free Coffee';
            $p_btn = '';
            if ( isset( $_GET['print_id'] ) ) {
                $p_url = admin_url( 'admin.php?action=santino_print_redeem_voucher&redeem_id=' . intval( $_GET['print_id'] ) );
                $p_btn = ' <a href="' . esc_url( $p_url ) . '" target="_blank" class="button button-primary button-small" style="background:#00625d; border-color:#004d49; margin-left:10px;">🖨️ Print 6th Cup POS Slip</a><script>window.open(' . json_encode( $p_url ) . ', "_blank");</script>';
            }
            echo '<div class="notice notice-success is-dismissible" style="border-left-color: #059669;"><p><strong>✓ Free Cup Served!</strong> 1 Free Beverage (<strong>' . esc_html( $item ) . '</strong>) was successfully served and deducted from member balance.' . $p_btn . '</p></div>';
        }
        if ( isset( $_GET['redeem_error'] ) && $_GET['redeem_error'] === 'no_balance' ) {
            echo '<div class="notice notice-error is-dismissible"><p><strong>✗ Redeem Error:</strong> Member has 0 free cups available.</p></div>';
        }
    }

    public static function handle_admin_print_redeem_voucher() {
        if ( ! current_user_can( 'edit_posts' ) ) {
            wp_die( 'Permission denied' );
        }
        $redeem_id = intval( $_GET['redeem_id'] ?? 0 );
        self::render_printable_voucher_slip( $redeem_id );
    }

    public static function handle_public_print_redeem_voucher() {
        if ( isset( $_GET['santino_print_voucher'] ) && ! empty( $_GET['redeem_id'] ) ) {
            $redeem_id = intval( $_GET['redeem_id'] );
            self::render_printable_voucher_slip( $redeem_id );
        }
    }

    public static function render_printable_voucher_slip( $redeem_id ) {
        $redeem = get_post( $redeem_id );
        if ( ! $redeem || $redeem->post_type !== 'santino_redeem' ) {
            wp_die( 'Redeem record not found.' );
        }

        $code        = get_post_meta( $redeem_id, '_santino_redeem_code', true ) ?: ( 'RDM-' . $redeem_id );
        $phone       = get_post_meta( $redeem_id, '_santino_redeem_phone', true ) ?: '—';
        $item        = get_post_meta( $redeem_id, '_santino_redeem_item', true ) ?: 'Handcrafted Coffee';
        $branch      = get_post_meta( $redeem_id, '_santino_redeem_branch', true ) ?: 'Santino Flagship';
        $v_code      = get_post_meta( $redeem_id, '_santino_redeem_voucher_code', true ) ?: 'FREE-CUP-REWARD';
        $status      = get_post_meta( $redeem_id, '_santino_redeem_status', true ) ?: 'pending';
        $member_id   = intval( get_post_meta( $redeem_id, '_santino_redeem_member_id', true ) );
        $member_code = $member_id ? get_post_meta( $member_id, '_santino_member_id', true ) : 'SNT-MEMBER';
        $date        = get_the_date( 'Y-m-d H:i', $redeem );
        $logo_url    = function_exists( 'santino_img' ) ? santino_img( 'logo.png' ) : '';

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>6th Cup Free Voucher - <?php echo esc_html( $code ); ?></title>
            <style>
                @page {
                    size: 80mm auto;
                    margin: 0;
                }
                body {
                    margin: 0;
                    padding: 12px 14px;
                    font-family: 'Courier New', Courier, monospace, -apple-system, BlinkMacSystemFont, sans-serif;
                    width: 76mm;
                    color: #000;
                    background: #fff;
                    font-size: 13px;
                    line-height: 1.35;
                }
                .text-center { text-align: center; }
                .text-end { text-align: right; }
                .fw-bold { font-weight: bold; }
                .divider {
                    border-top: 1px dashed #000;
                    margin: 8px 0;
                }
                .double-divider {
                    border-top: 2px double #000;
                    margin: 8px 0;
                }
                .logo {
                    max-height: 48px;
                    max-width: 140px;
                    display: block;
                    margin: 0 auto 6px;
                }
                .badge-free {
                    display: inline-block;
                    border: 1.5px solid #000;
                    padding: 3px 8px;
                    font-weight: 900;
                    font-size: 13px;
                    letter-spacing: 1px;
                    margin: 4px 0;
                }
                .barcode-box {
                    text-align: center;
                    letter-spacing: 5px;
                    font-size: 18px;
                    font-weight: 900;
                    padding: 6px 0;
                    border: 1px solid #000;
                    margin: 6px 0;
                }
                .row {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 3px;
                }
                .no-print-bar {
                    margin-bottom: 12px;
                    text-align: center;
                    padding-bottom: 8px;
                    border-bottom: 1px solid #ccc;
                }
                .btn-print {
                    background: #00625d;
                    color: #fff;
                    border: none;
                    padding: 8px 16px;
                    border-radius: 4px;
                    cursor: pointer;
                    font-weight: bold;
                    font-size: 13px;
                }
                @media print {
                    .no-print-bar { display: none !important; }
                    body { width: 100%; }
                }
            </style>
        </head>
        <body>
            <div class="no-print-bar">
                <button class="btn-print" onclick="window.print();">🖨️ Print Slip</button>
            </div>

            <div class="text-center">
                <?php if ( $logo_url ) : ?>
                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="Santino Coffee" class="logo">
                <?php endif; ?>
                <div class="fw-bold" style="font-size: 15px; letter-spacing: 0.5px;">SANTINO COFFEE ROASTERS</div>
                <div style="font-size: 11px;">VIP COFFEE CLUB LOYALTY REWARDS</div>
                <div class="badge-free">*** 6TH CUP FREE REWARD ***</div>
            </div>

            <div class="double-divider"></div>

            <div class="row">
                <span>REDEEM SLIP:</span>
                <span class="fw-bold"><?php echo esc_html( $code ); ?></span>
            </div>
            <div class="row">
                <span>VOUCHER CODE:</span>
                <span class="fw-bold"><?php echo esc_html( $v_code ); ?></span>
            </div>
            <div class="row">
                <span>DATE & TIME:</span>
                <span><?php echo esc_html( $date ); ?></span>
            </div>
            <div class="row">
                <span>BRANCH:</span>
                <span><?php echo esc_html( $branch ); ?></span>
            </div>

            <div class="divider"></div>

            <div class="row">
                <span>MEMBER MOBILE:</span>
                <span class="fw-bold"><?php echo esc_html( $phone ); ?></span>
            </div>
            <div class="row">
                <span>MEMBER ID:</span>
                <span><?php echo esc_html( $member_code ); ?></span>
            </div>
            <div class="row">
                <span>STATUS:</span>
                <span class="fw-bold"><?php echo strtoupper( esc_html( $status ) ); ?></span>
            </div>

            <div class="divider"></div>

            <div style="margin: 6px 0;">
                <div class="fw-bold" style="font-size: 14px;">FREE BEVERAGE ITEM:</div>
                <div class="fw-bold" style="font-size: 16px; margin-top: 2px;">★ <?php echo esc_html( $item ); ?></div>
            </div>
            <div class="row" style="font-size: 14px; margin-top: 4px;">
                <span>AMOUNT PAYABLE:</span>
                <span class="fw-bold">TK. 0.00 (100% FREE)</span>
            </div>

            <div class="divider"></div>

            <div class="barcode-box">
                ||| | |||| | ||| || ||| |
                <div style="font-size: 11px; letter-spacing: 2px; font-weight: normal; margin-top: 2px;"><?php echo esc_html( $code ); ?></div>
            </div>

            <div class="text-center" style="font-size: 10.5px; margin: 8px 0;">
                <div>Buy 5 Cups, Get 1 Free Promo</div>
                <div>Thank you for choosing Santino Coffee!</div>
            </div>

            <div style="margin-top: 25px; padding-top: 6px; border-top: 1px dashed #000;">
                <div class="row" style="font-size: 11px;">
                    <span>Barista Signature:</span>
                    <span>___________________</span>
                </div>
            </div>

            <script>
                window.addEventListener('load', function() {
                    setTimeout(function() {
                        window.print();
                    }, 500);
                });
            </script>
        </body>
        </html>
        <?php
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
     * Helper: Normalize Phone Number to canonical BD format (01XXXXXXXXX)
     */
    public static function normalize_phone( $phone ) {
        $clean = preg_replace( '/[^0-9]/', '', (string) $phone );
        if ( strlen( $clean ) === 13 && substr( $clean, 0, 3 ) === '880' ) {
            $clean = substr( $clean, 2 );
        } elseif ( strlen( $clean ) === 10 && substr( $clean, 0, 1 ) === '1' ) {
            $clean = '0' . $clean;
        } elseif ( strlen( $clean ) === 14 && substr( $clean, 0, 4 ) === '0880' ) {
            $clean = substr( $clean, 3 );
        }
        return $clean;
    }

    /**
     * Helper: Find Member by Phone or VIP ID
     */
    public static function find_member_by_phone_or_id( $phone, $member_id_str = '' ) {
        $clean_phone = self::normalize_phone( $phone );
        
        // 1. Search by Member ID
        if ( ! empty( $member_id_str ) ) {
            $q = new WP_Query( array(
                'post_type'      => 'santino_member',
                'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
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

        // 2. Search by Phone (matches normalized phone or 10-digit BD suffix)
        if ( ! empty( $clean_phone ) ) {
            $phone_suffix = substr( $clean_phone, -10 );
            $all_members = get_posts( array(
                'post_type'      => 'santino_member',
                'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
                'posts_per_page' => -1,
            ) );
            foreach ( $all_members as $m ) {
                $raw_m_phone = get_post_meta( $m->ID, '_santino_member_phone', true );
                $m_phone = self::normalize_phone( $raw_m_phone );
                if ( ! empty( $m_phone ) ) {
                    $m_suffix = substr( $m_phone, -10 );
                    if ( $m_phone === $clean_phone || $m_suffix === $phone_suffix ) {
                        return $m;
                    }
                }
            }
        }

        return null;
    }

    /**
     * 5. AJAX Handlers (Frontend Form Submissions)
     */
    // Apply for Regular Membership
    public static function handle_ajax_membership_apply() {
        check_ajax_referer( 'santino_frontend_nonce', 'security' );

        $name        = sanitize_text_field( $_POST['name'] ?? $_POST['full_name'] ?? '' );
        $phone       = self::normalize_phone( sanitize_text_field( $_POST['phone'] ?? '' ) );
        $email       = sanitize_email( $_POST['email'] ?? '' );
        $birth_month = sanitize_text_field( $_POST['birth_month'] ?? '' );
        $birth_day   = sanitize_text_field( $_POST['birth_day'] ?? '' );
        $tier        = 'regular';

        if ( empty( $phone ) || empty( $email ) || empty( $birth_month ) || empty( $birth_day ) ) {
            wp_send_json_error( array( 'message' => __( 'Please fill in Full Name, Mobile Number, Birthday (Month & Day), and Email Address.', 'santino' ) ) );
        }

        // Phone validation (BD format)
        if ( ! self::is_valid_bd_phone( $phone ) ) {
            wp_send_json_error( array( 'message' => __( 'Please enter a valid 11-digit Bangladeshi mobile number (e.g. 017XXXXXXXX).', 'santino' ) ) );
        }

        // Check if phone already registered
        $existing = self::find_member_by_phone_or_id( $phone );
        if ( $existing ) {
            $allow_reregister  = get_post_meta( $existing->ID, '_santino_allow_reregister', true );
            $existing_birthday = get_post_meta( $existing->ID, '_santino_member_birthday', true );
            $existing_email    = get_post_meta( $existing->ID, '_santino_member_email', true );

            // If auto-enrolled from invoice (birthday/email missing) or admin allowed re-registration:
            if ( $allow_reregister === 'yes' || empty( $existing_birthday ) || empty( $existing_email ) ) {
                update_post_meta( $existing->ID, '_santino_allow_reregister', 'no' );
                if ( ! empty( $name ) ) {
                    update_post_meta( $existing->ID, '_santino_member_name', $name );
                    wp_update_post( array(
                        'ID'         => $existing->ID,
                        'post_title' => $name,
                    ) );
                }
                update_post_meta( $existing->ID, '_santino_member_email', $email );
                update_post_meta( $existing->ID, '_santino_member_birth_month', $birth_month );
                update_post_meta( $existing->ID, '_santino_member_birth_day', $birth_day );
                update_post_meta( $existing->ID, '_santino_member_birthday', $birth_month . ' - ' . $birth_day );
                update_post_meta( $existing->ID, '_santino_member_status', 'active' );
                $exist_id = get_post_meta( $existing->ID, '_santino_member_id', true );
                wp_send_json_success( array(
                    'message'   => __( 'Your membership profile has been successfully updated!', 'santino' ),
                    'member_id' => $exist_id,
                    'name'      => ! empty( $name ) ? $name : $existing->post_title,
                    'tier'      => 'REGULAR MEMBER',
                ) );
            } else {
                wp_send_json_error( array(
                    'message' => __( 'This mobile number is already registered. Please check your stamp card status using the Lookup tab.', 'santino' ),
                ) );
            }
        }

        $member_id = 'SNT-REG-' . strtoupper( wp_generate_password( 6, false ) );

        $member_title = ! empty( $name ) ? $name : sprintf( 'Regular Member (%s)', $phone );

        $post_id = wp_insert_post( array(
            'post_title'   => $member_title,
            'post_type'    => 'santino_member',
            'post_status'  => 'publish',
        ) );

        if ( is_wp_error( $post_id ) ) {
            wp_send_json_error( array( 'message' => __( 'Could not register. Please try again.', 'santino' ) ) );
        }

        update_post_meta( $post_id, '_santino_member_id', $member_id );
        if ( ! empty( $name ) ) {
            update_post_meta( $post_id, '_santino_member_name', $name );
        }
        update_post_meta( $post_id, '_santino_member_status', 'active' );
        update_post_meta( $post_id, '_santino_member_tier', $tier );
        update_post_meta( $post_id, '_santino_member_phone', $phone );
        update_post_meta( $post_id, '_santino_member_email', $email );
        update_post_meta( $post_id, '_santino_member_birth_month', $birth_month );
        update_post_meta( $post_id, '_santino_member_birth_day', $birth_day );
        update_post_meta( $post_id, '_santino_member_birthday', $birth_month . ' - ' . $birth_day );
        update_post_meta( $post_id, '_santino_allow_reregister', 'no' );
        update_post_meta( $post_id, '_santino_cup_stamps', 0 );
        update_post_meta( $post_id, '_santino_total_approved_cups', 0 );
        update_post_meta( $post_id, '_santino_total_free_coffees', 0 );

        wp_send_json_success( array(
            'message'   => __( 'Congratulations! Your Santino Coffee Club Regular Membership is now active.', 'santino' ),
            'member_id' => $member_id,
            'name'      => ! empty( $name ) ? $name : sprintf( 'Member (%s)', substr( $phone, -4 ) ),
            'tier'      => 'REGULAR MEMBER',
        ) );
    }

    // Submit Coffee Invoice Number
    public static function handle_ajax_invoice_submit() {
        check_ajax_referer( 'santino_frontend_nonce', 'security' );

        $invoice_no     = sanitize_text_field( $_POST['invoice_number'] ?? '' );
        $phone          = self::normalize_phone( sanitize_text_field( $_POST['phone'] ?? '' ) );
        $member_id      = sanitize_text_field( $_POST['member_id'] ?? '' );
        $branch         = sanitize_text_field( $_POST['branch'] ?? 'Gulshan-2 Flagship Experience Center' );
        $cups           = max( 1, intval( $_POST['cups'] ?? 1 ) );
        if ( isset( $_POST['items_consumed'] ) && is_array( $_POST['items_consumed'] ) ) {
            $items_consumed = implode( ', ', array_map( 'sanitize_text_field', $_POST['items_consumed'] ) );
        } else {
            $items_consumed = sanitize_text_field( $_POST['items_consumed'] ?? '' );
        }

        // Parse individual items and quantities
        $order_items = isset( $_POST['order_items'] ) ? (array) $_POST['order_items'] : array();
        $order_qtys  = isset( $_POST['order_qtys'] ) ? (array) $_POST['order_qtys'] : array();
        if ( ! empty( $order_items ) ) {
            $breakdown = array();
            $calc_cups = 0;
            foreach ( $order_items as $k => $it_name ) {
                $it_name = sanitize_text_field( $it_name );
                if ( empty( $it_name ) ) continue;
                $it_qty = isset( $order_qtys[ $k ] ) ? max( 1, intval( $order_qtys[ $k ] ) ) : 1;
                $breakdown[] = $it_qty . 'x ' . $it_name;
                $calc_cups += $it_qty;
            }
            if ( ! empty( $breakdown ) ) {
                $items_consumed = implode( ', ', $breakdown );
                if ( $calc_cups > 0 ) {
                    $cups = $calc_cups;
                }
            }
        }

        if ( empty( $invoice_no ) ) {
            wp_send_json_error( array( 'message' => __( 'Please provide the invoice or receipt number.', 'santino' ) ) );
        }

        if ( empty( $phone ) || ! self::is_valid_bd_phone( $phone ) ) {
            wp_send_json_error( array( 'message' => __( 'Please enter a valid 11-digit mobile number (e.g. 017XXXXXXXX).', 'santino' ) ) );
        }

        if ( empty( $items_consumed ) ) {
            wp_send_json_error( array( 'message' => __( 'Please select the coffee or beverage item ordered.', 'santino' ) ) );
        }

        // Invoice image upload is mandatory
        if ( empty( $_FILES['invoice_image']['name'] ) ) {
            wp_send_json_error( array( 'message' => __( 'Receipt image upload is mandatory. Please attach a clear photo of your memo.', 'santino' ) ) );
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
            // Auto-enroll member with complete profile defaults
            $new_vip_id = 'SNT-REG-' . strtoupper( wp_generate_password( 6, false ) );
            $m_id = wp_insert_post( array(
                'post_title'   => 'Regular Member (' . $phone . ')',
                'post_type'    => 'santino_member',
                'post_status'  => 'publish',
            ) );
            update_post_meta( $m_id, '_santino_member_id', $new_vip_id );
            update_post_meta( $m_id, '_santino_member_phone', $phone );
            update_post_meta( $m_id, '_santino_member_status', 'active' );
            update_post_meta( $m_id, '_santino_member_tier', 'regular' );
            update_post_meta( $m_id, '_santino_allow_reregister', 'yes' );
            update_post_meta( $m_id, '_santino_cup_stamps', 0 );
            update_post_meta( $m_id, '_santino_total_approved_cups', 0 );
            update_post_meta( $m_id, '_santino_total_free_coffees', 0 );
            $member_id = $new_vip_id;
        } elseif ( $member ) {
            $member_id = get_post_meta( $member->ID, '_santino_member_id', true );
        }

        // Insert invoice
        $inv_title = sprintf( 'Invoice #%s - %s (%d Items: %s)', $invoice_no, $phone, $cups, wp_trim_words( $items_consumed, 4, '' ) );
        $inv_post_id = wp_insert_post( array(
            'post_title'   => $inv_title,
            'post_type'    => 'santino_invoice',
            'post_status'  => 'publish',
        ) );

        if ( is_wp_error( $inv_post_id ) ) {
            wp_send_json_error( array( 'message' => __( 'Could not submit invoice. Please try again.', 'santino' ) ) );
        }

        update_post_meta( $inv_post_id, '_santino_invoice_items_consumed', $items_consumed );
        if ( ! empty( $order_items ) ) {
            update_post_meta( $inv_post_id, '_santino_invoice_items_breakdown', $order_items );
            update_post_meta( $inv_post_id, '_santino_invoice_items_quantities', $order_qtys );
        }

        // Handle Invoice Image Upload
        if ( ! empty( $_FILES['invoice_image']['name'] ) ) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );

            $attachment_id = media_handle_upload( 'invoice_image', $inv_post_id );
            if ( ! is_wp_error( $attachment_id ) ) {
                $img_url = wp_get_attachment_url( $attachment_id );
                update_post_meta( $inv_post_id, '_santino_invoice_image_id', $attachment_id );
                update_post_meta( $inv_post_id, '_santino_invoice_image_url', $img_url );
                set_post_thumbnail( $inv_post_id, $attachment_id );
            }
        }

        $member_post_id = $member ? $member->ID : ( ! empty( $m_id ) ? $m_id : 0 );
        if ( $member_post_id ) {
            update_post_meta( $inv_post_id, '_santino_invoice_member_post_id', $member_post_id );
        }

        $promo_claimed  = sanitize_text_field( $_POST['promo_claimed'] ?? 'no' );
        $promo_day      = sanitize_text_field( $_POST['promo_day'] ?? '' );
        $promo_id       = sanitize_text_field( $_POST['promo_id'] ?? '' );
        $promo_title    = sanitize_text_field( $_POST['promo_title'] ?? '' );
        $request_source = sanitize_text_field( $_POST['request_source'] ?? '' );
        $request_page   = sanitize_text_field( $_POST['request_page'] ?? '' );
        if ( empty( $request_page ) && function_exists( 'wp_get_referer' ) ) {
            $ref = wp_get_referer();
            if ( $ref ) {
                $request_page = wp_parse_url( $ref, PHP_URL_PATH ) ?: $ref;
            }
        }

        if ( ! empty( $promo_id ) ) {
            $matched_promo = null;
            foreach ( self::get_daily_promotions() as $pr ) {
                if ( ( $pr['id'] ?? '' ) === $promo_id ) {
                    $matched_promo = $pr;
                    break;
                }
            }
            if ( ! $matched_promo || ! self::is_promo_active_today( $matched_promo ) ) {
                wp_delete_post( $inv_post_id, true );
                wp_send_json_error( array( 'message' => __( 'Selected promotion is no longer active today. Please refresh the page and try again.', 'santino' ) ) );
            }
            $promo_claimed = 'yes';
            $promo_title   = $matched_promo['title'] . ' — ' . $matched_promo['items'];
            $promo_day     = $matched_promo['day'];
            if ( ! empty( $matched_promo['paid_cups'] ) ) {
                $cups = max( 1, intval( $matched_promo['paid_cups'] ) );
            }
        } elseif ( $promo_claimed === 'yes' && $cups === 4 ) {
            $cups = 3;
        }

        if ( empty( $request_source ) ) {
            $request_source = ( $promo_claimed === 'yes' ) ? 'today_offer_tab' : 'portal_invoice_tab';
        }

        update_post_meta( $inv_post_id, '_santino_invoice_number', $invoice_no );
        update_post_meta( $inv_post_id, '_santino_invoice_cups', $cups );
        update_post_meta( $inv_post_id, '_santino_invoice_phone', $phone );
        update_post_meta( $inv_post_id, '_santino_invoice_member_id', $member_id );
        update_post_meta( $inv_post_id, '_santino_invoice_branch', $branch );
        update_post_meta( $inv_post_id, '_santino_invoice_status', 'pending' );
        update_post_meta( $inv_post_id, '_santino_invoice_submitted_at', current_time( 'mysql' ) );
        update_post_meta( $inv_post_id, '_santino_invoice_source', $request_source );
        if ( $request_page ) {
            update_post_meta( $inv_post_id, '_santino_invoice_source_page', $request_page );
        }
        if ( $promo_claimed === 'yes' ) {
            update_post_meta( $inv_post_id, '_santino_invoice_promo_claimed', 'yes' );
            update_post_meta( $inv_post_id, '_santino_invoice_promo_day', $promo_day ?: self::get_today_dhaka_key() );
            if ( $promo_id ) update_post_meta( $inv_post_id, '_santino_invoice_promo_id', $promo_id );
            if ( $promo_title ) update_post_meta( $inv_post_id, '_santino_invoice_promo_title', $promo_title );
        }

        wp_send_json_success( array(
            'message'    => sprintf( __( 'Invoice #%s (%d Cups) submitted successfully! Member ID: %s. Admin verification will credit your stamp balance.', 'santino' ), $invoice_no, $cups, $member_id ),
            'invoice_no' => $invoice_no,
            'cups'       => $cups,
            'member_id'  => $member_id,
            'status'     => 'pending',
        ) );
    }

    // Submit Free Cup Redeem Request
    public static function handle_ajax_redeem_submit() {
        check_ajax_referer( 'santino_frontend_nonce', 'security' );

        $phone          = self::normalize_phone( sanitize_text_field( $_POST['phone'] ?? '' ) );
        $free_item      = sanitize_text_field( $_POST['free_item'] ?? '' );
        $branch         = sanitize_text_field( $_POST['branch'] ?? 'Gulshan-2 Flagship Experience Center' );
        $redeem_code    = sanitize_text_field( $_POST['redeem_code'] ?? '' );
        $request_source = sanitize_text_field( $_POST['request_source'] ?? 'portal_redeem_modal' );
        $request_page   = sanitize_text_field( $_POST['request_page'] ?? '' );
        if ( empty( $request_page ) && function_exists( 'wp_get_referer' ) ) {
            $ref = wp_get_referer();
            if ( $ref ) {
                $request_page = wp_parse_url( $ref, PHP_URL_PATH ) ?: $ref;
            }
        }
        $request_ip = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );

        if ( empty( $phone ) || empty( $free_item ) ) {
            wp_send_json_error( array( 'message' => __( 'Please select your mobile number and preferred free beverage.', 'santino' ) ) );
        }

        if ( ! self::is_valid_bd_phone( $phone ) ) {
            wp_send_json_error( array( 'message' => __( 'Please enter a valid 11-digit mobile number (e.g. 017XXXXXXXX).', 'santino' ) ) );
        }

        $member = self::find_member_by_phone_or_id( $phone );
        if ( ! $member ) {
            wp_send_json_error( array( 'message' => __( 'No registered membership found for this mobile number.', 'santino' ) ) );
        }

        // Find an unused free coffee voucher for this member
        $vouchers = get_posts( array(
            'post_type'      => 'santino_voucher',
            'posts_per_page' => 1,
            'meta_query'     => array(
                array( 'key' => '_santino_voucher_member_id', 'value' => $member->ID, 'compare' => '=' ),
                array( 'key' => '_santino_voucher_status', 'value' => 'unused', 'compare' => '=' ),
            ),
        ) );

        $total_free = intval( get_post_meta( $member->ID, '_santino_total_free_coffees', true ) ?: 0 );

        if ( empty( $vouchers ) && $total_free <= 0 ) {
            wp_send_json_error( array( 'message' => __( 'No active complimentary vouchers available. Complete 5 cup stamps to unlock your reward.', 'santino' ) ) );
        }

        $voucher_post = ! empty( $vouchers ) ? $vouchers[0] : null;
        $voucher_code = $voucher_post ? get_post_meta( $voucher_post->ID, '_santino_voucher_code', true ) : ( 'FREE-CUP-' . strtoupper( wp_generate_password( 6, false ) ) );

        if ( empty( $redeem_code ) ) {
            $redeem_code = 'RDM-' . strtoupper( wp_generate_password( 6, false ) );
        }

        // Create Redeem Request CPT
        $redeem_post_id = wp_insert_post( array(
            'post_title'   => sprintf( 'Redeem #%s - %s (%s)', $redeem_code, $phone, $free_item ),
            'post_type'    => 'santino_redeem',
            'post_status'  => 'publish',
        ) );

        if ( is_wp_error( $redeem_post_id ) ) {
            wp_send_json_error( array( 'message' => __( 'Could not submit redemption request. Please try again.', 'santino' ) ) );
        }

        update_post_meta( $redeem_post_id, '_santino_redeem_code', $redeem_code );
        update_post_meta( $redeem_post_id, '_santino_redeem_phone', $phone );
        update_post_meta( $redeem_post_id, '_santino_redeem_member_id', $member->ID );
        update_post_meta( $redeem_post_id, '_santino_redeem_item', $free_item );
        update_post_meta( $redeem_post_id, '_santino_redeem_branch', $branch );
        update_post_meta( $redeem_post_id, '_santino_redeem_voucher_code', $voucher_code );
        if ( $voucher_post ) {
            update_post_meta( $redeem_post_id, '_santino_redeem_voucher_id', $voucher_post->ID );
            update_post_meta( $voucher_post->ID, '_santino_voucher_status', 'pending_redemption' );
        }
        update_post_meta( $redeem_post_id, '_santino_redeem_status', 'pending' );
        update_post_meta( $redeem_post_id, '_santino_redeem_created_at', current_time( 'mysql' ) );
        update_post_meta( $redeem_post_id, '_santino_redeem_source', $request_source ?: 'portal_redeem_modal' );
        if ( $request_page ) {
            update_post_meta( $redeem_post_id, '_santino_redeem_source_page', $request_page );
        }
        if ( $request_ip ) {
            update_post_meta( $redeem_post_id, '_santino_redeem_ip', $request_ip );
        }

        $print_url = add_query_arg( array(
            'santino_print_voucher' => '1',
            'redeem_id'             => $redeem_post_id,
        ), home_url( '/' ) );

        wp_send_json_success( array(
            'message'     => sprintf( __( 'Complimentary coffee redemption request confirmed! (Redeem ID: %s). Present this code to your barista at %s to receive your %s.', 'santino' ), $redeem_code, $branch, $free_item ),
            'redeem_id'   => $redeem_post_id,
            'redeem_code' => $redeem_code,
            'free_item'   => $free_item,
            'branch'      => $branch,
            'status'      => 'pending',
            'print_url'   => $print_url,
        ) );
    }

    // Live Stamp Card & Vouchers Lookup
    public static function handle_ajax_stamp_card_lookup() {
        check_ajax_referer( 'santino_frontend_nonce', 'security' );

        $query_str = sanitize_text_field( $_POST['query'] ?? '' );
        if ( empty( $query_str ) ) {
            wp_send_json_error( array( 'message' => __( 'Please enter your Mobile Number.', 'santino' ) ) );
        }

        $member = self::find_member_by_phone_or_id( $query_str, $query_str );
        if ( ! $member ) {
            wp_send_json_error( array( 'message' => __( 'No active member found with this Mobile Number. Please register below first!', 'santino' ) ) );
        }

        $member_id    = get_post_meta( $member->ID, '_santino_member_id', true );
        $phone        = get_post_meta( $member->ID, '_santino_member_phone', true );
        $stamps       = intval( get_post_meta( $member->ID, '_santino_cup_stamps', true ) ?: 0 );
        $total_cups   = intval( get_post_meta( $member->ID, '_santino_total_approved_cups', true ) ?: 0 );
        $total_free   = intval( get_post_meta( $member->ID, '_santino_total_free_coffees', true ) ?: 0 );
        $tier         = strtoupper( get_post_meta( $member->ID, '_santino_member_tier', true ) ?: 'REGULAR' );
        $birthday     = get_post_meta( $member->ID, '_santino_member_birthday', true );

        $m_name = get_post_meta( $member->ID, '_santino_member_name', true );
        if ( ! empty( $m_name ) ) {
            $clean_name = $m_name;
        } elseif ( ! empty( $member->post_title ) && stripos( $member->post_title, 'Regular Member' ) === false ) {
            $clean_name = $member->post_title;
        } else {
            $clean_name = 'Santino Regular Member';
        }

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
                'cups'       => intval( get_post_meta( $inv->ID, '_santino_invoice_cups', true ) ?: 1 ),
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

        // Fetch Recent Redeems
        $redeems = get_posts( array(
            'post_type'      => 'santino_redeem',
            'posts_per_page' => 5,
            'meta_query'     => array(
                array( 'key' => '_santino_redeem_phone', 'value' => $phone, 'compare' => '=' ),
            ),
        ) );

        $redeem_list = array();
        foreach ( $redeems as $r ) {
            $redeem_list[] = array(
                'code'   => get_post_meta( $r->ID, '_santino_redeem_code', true ),
                'item'   => get_post_meta( $r->ID, '_santino_redeem_item', true ),
                'branch' => get_post_meta( $r->ID, '_santino_redeem_branch', true ),
                'status' => get_post_meta( $r->ID, '_santino_redeem_status', true ),
                'date'   => get_the_date( 'M d, Y', $r->ID ),
            );
        }

        wp_send_json_success( array(
            'name'         => $clean_name,
            'member_id'    => $member_id,
            'phone'        => $phone,
            'tier'         => $tier . ' MEMBER',
            'birthday'     => $birthday,
            'stamps'       => $stamps,
            'total_cups'   => $total_cups,
            'total_free'   => $total_free,
            'invoices'     => $invoice_list,
            'vouchers'     => $voucher_list,
            'redeems'      => $redeem_list,
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
            __( 'Santino QR Code Generator', 'santino' ),
            __( 'QR Code Generator', 'santino' ),
            'manage_options',
            'santino-qr-generator',
            array( __CLASS__, 'render_qr_generator_page' )
        );

        add_submenu_page(
            'edit.php?post_type=santino_member',
            __( 'Cafe Branches', 'santino' ),
            __( 'Cafe Branches', 'santino' ),
            'manage_options',
            'santino-cafe-branches',
            array( __CLASS__, 'render_cafe_branches_page' )
        );

        add_submenu_page(
            'edit.php?post_type=santino_member',
            __( 'Loyalty Analytics & Stamp Engine', 'santino' ),
            __( 'Loyalty Reports', 'santino' ),
            'manage_options',
            'santino-loyalty-stats',
            array( __CLASS__, 'render_loyalty_dashboard' )
        );

        add_submenu_page(
            'edit.php?post_type=santino_member',
            __( 'Daily 7-Day Promotions', 'santino' ),
            __( 'Daily Promotions', 'santino' ),
            'manage_options',
            'santino-daily-promotions',
            array( __CLASS__, 'render_daily_promotions_page' )
        );
    }

    public static function get_branches_detailed() {
        $branches = get_option( 'santino_branches_detailed', null );
        if ( is_array( $branches ) && ! empty( $branches ) ) {
            return $branches;
        }

        // Check if legacy simple string array exists
        $legacy = get_option( 'santino_cafe_branches', array() );
        if ( ! empty( $legacy ) && is_array( $legacy ) ) {
            $converted = array();
            foreach ( $legacy as $b_name ) {
                if ( is_array( $b_name ) ) {
                    $converted[] = $b_name;
                } else {
                    $converted[] = array(
                        'id'           => 'br_' . substr( md5( $b_name ), 0, 8 ),
                        'name'         => trim( $b_name ),
                        'division'     => 'Dhaka',
                        'district'     => 'Dhaka',
                        'lat'          => '23.7925',
                        'long'         => '90.4078',
                        'map_location' => 'https://maps.google.com/?q=' . urlencode( $b_name . ' Dhaka' ),
                        'address'      => trim( $b_name ) . ', Dhaka',
                        'phone'        => '+880 1613-334514',
                    );
                }
            }
            update_option( 'santino_branches_detailed', $converted );
            return $converted;
        }

        $defaults = array(
            array(
                'id'           => 'br_gulshan2',
                'name'         => 'Gulshan-2 Flagship Experience Center',
                'division'     => 'Dhaka',
                'district'     => 'Dhaka',
                'lat'          => '23.7925',
                'long'         => '90.4078',
                'map_location' => 'https://maps.google.com/?q=Santino+Coffee+Gulshan+2+Dhaka',
                'address'      => 'Plot 11, Road 48, CWN Block, Gulshan-2, Dhaka 1212',
                'phone'        => '+880 1613-334514',
            ),
            array(
                'id'           => 'br_banani',
                'name'         => 'Banani Borak Mehnur',
                'division'     => 'Dhaka',
                'district'     => 'Dhaka',
                'lat'          => '23.7936',
                'long'         => '90.4042',
                'map_location' => 'https://maps.google.com/?q=Borak+Mehnur+Banani+Dhaka',
                'address'      => 'Plot 51/B, Kamal Ataturk Avenue, Banani Commercial Area, Dhaka',
                'phone'        => '+880 1613-334514',
            ),
            array(
                'id'           => 'br_tejgaon',
                'name'         => 'Tejgaon Roastery & Lab',
                'division'     => 'Dhaka',
                'district'     => 'Dhaka',
                'lat'          => '23.7598',
                'long'         => '90.3992',
                'map_location' => 'https://maps.google.com/?q=Tejgaon+Industrial+Area+Dhaka',
                'address'      => 'Tejgaon Industrial Area, Dhaka',
                'phone'        => '+880 1613-334514',
            ),
            array(
                'id'           => 'br_dhanmondi',
                'name'         => 'Dhanmondi Ahmed & Kazi Tower',
                'division'     => 'Dhaka',
                'district'     => 'Dhaka',
                'lat'          => '23.7461',
                'long'         => '90.3742',
                'map_location' => 'https://maps.google.com/?q=Dhanmondi+27+Dhaka',
                'address'      => 'House 14, Road 27 (Old), Dhanmondi, Dhaka 1209',
                'phone'        => '+880 1613-334514',
            ),
            array(
                'id'           => 'br_uttara',
                'name'         => 'Uttara Liberty Tower',
                'division'     => 'Dhaka',
                'district'     => 'Dhaka',
                'lat'          => '23.8759',
                'long'         => '90.3795',
                'map_location' => 'https://maps.google.com/?q=Uttara+Sector+3+Dhaka',
                'address'      => 'Sector 3, Uttara Commercial Zone, Dhaka',
                'phone'        => '+880 1613-334514',
            ),
            array(
                'id'           => 'br_baridhara',
                'name'         => 'Baridhara Diplomatic Enclave',
                'division'     => 'Dhaka',
                'district'     => 'Dhaka',
                'lat'          => '23.7998',
                'long'         => '90.4228',
                'map_location' => 'https://maps.google.com/?q=Baridhara+Diplomatic+Zone+Dhaka',
                'address'      => 'Park Road, Baridhara Diplomatic Zone, Dhaka',
                'phone'        => '+880 1613-334514',
            ),
            array(
                'id'           => 'br_agrabad',
                'name'         => 'Agrabad Commercial Lounge',
                'division'     => 'Chattogram',
                'district'     => 'Chattogram',
                'lat'          => '22.3275',
                'long'         => '91.8122',
                'map_location' => 'https://maps.google.com/?q=Agrabad+Chattogram',
                'address'      => 'Agrabad C/A, Chattogram',
                'phone'        => '+880 1613-334514',
            ),
            array(
                'id'           => 'br_zindabazar',
                'name'         => 'Zindabazar Premium Counter',
                'division'     => 'Sylhet',
                'district'     => 'Sylhet',
                'lat'          => '24.8949',
                'long'         => '91.8687',
                'map_location' => 'https://maps.google.com/?q=Zindabazar+Sylhet',
                'address'      => 'Zindabazar Point, Sylhet',
                'phone'        => '+880 1613-334514',
            ),
            array(
                'id'           => 'br_kolatoli',
                'name'         => 'Coxs Bazar Kolatoli Beach Bar',
                'division'     => 'Chattogram',
                'district'     => "Cox's Bazar",
                'lat'          => '21.4272',
                'long'         => '91.9840',
                'map_location' => 'https://maps.google.com/?q=Kolatoli+Coxs+Bazar',
                'address'      => 'Hotel Motel Zone, Kolatoli, Coxs Bazar',
                'phone'        => '+880 1613-334514',
            ),
        );

        update_option( 'santino_branches_detailed', $defaults );
        return $defaults;
    }

    public static function get_order_item_choices() {
        $choices = array();
        if ( class_exists( 'Santino_Handcrafted_Items_System' ) ) {
            $items = Santino_Handcrafted_Items_System::get_all_menu_items();
            if ( ! empty( $items ) && is_array( $items ) ) {
                foreach ( $items as $it ) {
                    if ( ! empty( $it['name'] ) ) {
                        $choices[] = $it['name'];
                    }
                }
            }
        }
        if ( empty( $choices ) ) {
            $choices = array(
                'Hot Cappuccino',
                'Iced Latte',
                'Hot Mocha',
                'Iced Mocha',
                'Mocha Frappe',
                'Hazelnut Frappe',
                'Classic Americano',
                'Spanish Latte',
                'Vanilla Caramel Macchiato',
                'Santino Raw Coconut Latte',
                'Single-Origin Pour-over (V60)',
                'Flat White',
                'Cold Brew Reserve',
                'Artisan Butter Croissant',
                'Signature Roastery Blend Item',
            );
        }
        return array_values( array_unique( $choices ) );
    }

    public static function get_cafe_branches() {
        $detailed = self::get_branches_detailed();
        $names = array();
        foreach ( $detailed as $b ) {
            if ( is_array( $b ) && ! empty( $b['name'] ) ) {
                $names[] = $b['name'];
            } elseif ( is_string( $b ) ) {
                $names[] = $b;
            }
        }
        return array_values( array_unique( array_filter( array_map( 'trim', $names ) ) ) );
    }

    public static function save_branches_detailed( $branches ) {
        if ( ! is_array( $branches ) ) {
            return false;
        }
        update_option( 'santino_branches_detailed', $branches );
        $names = array_values( array_unique( array_filter( array_map( function( $b ) {
            return is_array( $b ) ? ( $b['name'] ?? '' ) : $b;
        }, $branches ) ) ) );
        update_option( 'santino_cafe_branches', $names );
        return true;
    }

    public static function save_cafe_branches( $branches ) {
        return self::save_branches_detailed( $branches );
    }

    public static function handle_branch_csv_downloads() {
        if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'santino-cafe-branches' ) {
            return;
        }
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $action = sanitize_text_field( $_GET['action'] ?? '' );
        if ( 'sample_csv' === $action ) {
            check_admin_referer( 'santino_sample_csv' );
            while ( ob_get_level() ) {
                ob_end_clean();
            }
            header( 'Content-Type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename="santino-branches-sample.csv"' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
            $out = fopen( 'php://output', 'w' );
            fputcsv( $out, array( 'branch_name', 'division', 'district', 'lat', 'long', 'map_location', 'address', 'phone' ) );
            fputcsv( $out, array( 'Gulshan-2 Flagship Experience Center', 'Dhaka', 'Dhaka', '23.7925', '90.4078', 'https://maps.google.com/?q=Santino+Gulshan+2', 'Plot 11, Road 48, CWN Block, Gulshan-2, Dhaka', '+880 1613-334514' ) );
            fputcsv( $out, array( 'Agrabad Commercial Lounge', 'Chattogram', 'Chattogram', '22.3275', '91.8122', 'https://maps.google.com/?q=Agrabad+Chattogram', 'Agrabad C/A, Chattogram', '+880 1613-334514' ) );
            fputcsv( $out, array( 'Zindabazar Premium Counter', 'Sylhet', 'Sylhet', '24.8949', '91.8687', 'https://maps.google.com/?q=Zindabazar+Sylhet', 'Zindabazar Point, Sylhet', '+880 1613-334514' ) );
            fclose( $out );
            exit;
        }

        if ( 'export_csv' === $action ) {
            check_admin_referer( 'santino_export_csv' );
            $all = self::get_branches_detailed();
            while ( ob_get_level() ) {
                ob_end_clean();
            }
            header( 'Content-Type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename="santino-branches-' . date( 'Y-m-d' ) . '.csv"' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
            $out = fopen( 'php://output', 'w' );
            fputcsv( $out, array( 'branch_name', 'division', 'district', 'lat', 'long', 'map_location', 'address', 'phone' ) );
            foreach ( $all as $b ) {
                fputcsv( $out, array(
                    $b['name'] ?? '',
                    $b['division'] ?? 'Dhaka',
                    $b['district'] ?? 'Dhaka',
                    $b['lat'] ?? '',
                    $b['long'] ?? '',
                    $b['map_location'] ?? '',
                    $b['address'] ?? '',
                    $b['phone'] ?? '',
                ) );
            }
            fclose( $out );
            exit;
        }
    }

    public static function render_cafe_branches_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Access denied' );
        }

        $notice = '';

        if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && ! empty( $_GET['branch_id'] ) ) {
            $del_id = sanitize_text_field( $_GET['branch_id'] );
            check_admin_referer( 'santino_del_branch_' . $del_id );
            $current = self::get_branches_detailed();
            $current = array_values( array_filter( $current, function( $item ) use ( $del_id ) {
                return ( $item['id'] ?? '' ) !== $del_id && ( $item['name'] ?? '' ) !== $del_id;
            } ) );
            self::save_branches_detailed( $current );
            $notice = '<div class="notice notice-success is-dismissible"><p>' . __( 'Branch deleted successfully.', 'santino' ) . '</p></div>';
        }

        if ( isset( $_POST['santino_branch_action'] ) && check_admin_referer( 'santino_branches_nonce' ) ) {
            $action = sanitize_text_field( $_POST['santino_branch_action'] );
            $current = self::get_branches_detailed();

            if ( 'bulk_delete' === $action && ! empty( $_POST['branch_ids'] ) ) {
                $del_ids = array_map( 'sanitize_text_field', (array) $_POST['branch_ids'] );
                $current = array_values( array_filter( $current, function( $item ) use ( $del_ids ) {
                    $id = $item['id'] ?? $item['name'];
                    return ! in_array( $id, $del_ids, true ) && ! in_array( $item['name'] ?? '', $del_ids, true );
                } ) );
                self::save_branches_detailed( $current );
                $notice = '<div class="notice notice-success is-dismissible"><p>' . sprintf( __( '%d branch(es) deleted successfully.', 'santino' ), count( $del_ids ) ) . '</p></div>';
            } elseif ( 'add' === $action ) {
                $name = sanitize_text_field( wp_unslash( $_POST['branch_name'] ?? '' ) );
                if ( ! empty( $name ) ) {
                    $div  = sanitize_text_field( wp_unslash( $_POST['division'] ?? 'Dhaka' ) );
                    $dist = sanitize_text_field( wp_unslash( $_POST['district'] ?? 'Dhaka' ) );
                    $lat  = sanitize_text_field( wp_unslash( $_POST['lat'] ?? '' ) );
                    $long = sanitize_text_field( wp_unslash( $_POST['long'] ?? '' ) );
                    $map  = esc_url_raw( wp_unslash( $_POST['map_location'] ?? '' ) );
                    $addr = sanitize_text_field( wp_unslash( $_POST['address'] ?? '' ) );
                    $ph   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );

                    if ( empty( $map ) && ! empty( $lat ) && ! empty( $long ) ) {
                        $map = 'https://maps.google.com/?q=' . $lat . ',' . $long;
                    }

                    $current[] = array(
                        'id'           => 'br_' . substr( md5( $name . microtime() ), 0, 8 ),
                        'name'         => $name,
                        'division'     => $div,
                        'district'     => $dist,
                        'lat'          => $lat,
                        'long'         => $long,
                        'map_location' => $map,
                        'address'      => $addr,
                        'phone'        => $ph,
                    );
                    self::save_branches_detailed( $current );
                    $notice = '<div class="notice notice-success is-dismissible"><p><strong>Branch added successfully:</strong> ' . esc_html( $name ) . ' (' . esc_html( $dist . ', ' . $div ) . ')</p></div>';
                }
            } elseif ( 'edit' === $action ) {
                $b_id = sanitize_text_field( $_POST['branch_id'] ?? '' );
                $name = sanitize_text_field( wp_unslash( $_POST['branch_name'] ?? '' ) );
                if ( ! empty( $b_id ) && ! empty( $name ) ) {
                    foreach ( $current as &$item ) {
                        if ( ( $item['id'] ?? '' ) === $b_id || ( $item['name'] ?? '' ) === $b_id ) {
                            $item['name']         = $name;
                            $item['division']     = sanitize_text_field( wp_unslash( $_POST['division'] ?? 'Dhaka' ) );
                            $item['district']     = sanitize_text_field( wp_unslash( $_POST['district'] ?? 'Dhaka' ) );
                            $item['lat']          = sanitize_text_field( wp_unslash( $_POST['lat'] ?? '' ) );
                            $item['long']         = sanitize_text_field( wp_unslash( $_POST['long'] ?? '' ) );
                            $map                  = esc_url_raw( wp_unslash( $_POST['map_location'] ?? '' ) );
                            if ( empty( $map ) && ! empty( $item['lat'] ) && ! empty( $item['long'] ) ) {
                                $map = 'https://maps.google.com/?q=' . $item['lat'] . ',' . $item['long'];
                            }
                            $item['map_location'] = $map;
                            $item['address']      = sanitize_text_field( wp_unslash( $_POST['address'] ?? '' ) );
                            $item['phone']        = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
                            break;
                        }
                    }
                    self::save_branches_detailed( $current );
                    $notice = '<div class="notice notice-success is-dismissible"><p><strong>Branch updated successfully:</strong> ' . esc_html( $name ) . '</p></div>';
                }
            } elseif ( 'upload_csv' === $action ) {
                if ( ! empty( $_FILES['branches_csv']['tmp_name'] ) && is_uploaded_file( $_FILES['branches_csv']['tmp_name'] ) ) {
                    $mode = sanitize_text_field( $_POST['csv_mode'] ?? 'append' );
                    $handle = fopen( $_FILES['branches_csv']['tmp_name'], 'r' );
                    if ( $handle !== false ) {
                        $header = fgetcsv( $handle );
                        $h_map = array();
                        foreach ( (array) $header as $idx => $col ) {
                            $c = strtolower( trim( preg_replace( '/[^a-zA-Z0-9_]/', '', str_replace( ' ', '_', $col ) ) ) );
                            $h_map[ $c ] = $idx;
                        }

                        $imported = array();
                        while ( ( $row = fgetcsv( $handle ) ) !== false ) {
                            $name_idx = $h_map['branch_name'] ?? $h_map['name'] ?? $h_map['branch'] ?? 0;
                            $b_name   = trim( $row[ $name_idx ] ?? '' );
                            if ( empty( $b_name ) ) continue;

                            $div  = trim( $row[ $h_map['division'] ?? 1 ] ?? 'Dhaka' );
                            $dist = trim( $row[ $h_map['district'] ?? $h_map['strict'] ?? 2 ] ?? 'Dhaka' );
                            $lat  = trim( $row[ $h_map['lat'] ?? $h_map['latitude'] ?? 3 ] ?? '' );
                            $lng  = trim( $row[ $h_map['long'] ?? $h_map['longitude'] ?? $h_map['lng'] ?? 4 ] ?? '' );
                            $map  = trim( $row[ $h_map['map_location'] ?? $h_map['map'] ?? $h_map['google_map'] ?? 5 ] ?? '' );
                            $addr = trim( $row[ $h_map['address'] ?? 6 ] ?? '' );
                            $ph   = trim( $row[ $h_map['phone'] ?? $h_map['hotline'] ?? 7 ] ?? '' );

                            if ( empty( $map ) && ! empty( $lat ) && ! empty( $lng ) ) {
                                $map = 'https://maps.google.com/?q=' . $lat . ',' . $lng;
                            }

                            $imported[] = array(
                                'id'           => 'br_' . substr( md5( $b_name . microtime() ), 0, 8 ),
                                'name'         => sanitize_text_field( $b_name ),
                                'division'     => sanitize_text_field( $div ?: 'Dhaka' ),
                                'district'     => sanitize_text_field( $dist ?: 'Dhaka' ),
                                'lat'          => sanitize_text_field( $lat ),
                                'long'         => sanitize_text_field( $lng ),
                                'map_location' => esc_url_raw( $map ),
                                'address'      => sanitize_text_field( $addr ),
                                'phone'        => sanitize_text_field( $ph ),
                            );
                        }
                        fclose( $handle );

                        if ( ! empty( $imported ) ) {
                            if ( 'replace' === $mode ) {
                                $current = $imported;
                            } else {
                                $current = array_merge( $current, $imported );
                            }
                            self::save_branches_detailed( $current );
                            $notice = '<div class="notice notice-success is-dismissible"><p><strong>CSV Upload Successful!</strong> Imported ' . count( $imported ) . ' branches into the system.</p></div>';
                        } else {
                            $notice = '<div class="notice notice-error is-dismissible"><p>No valid branch rows found in the CSV file.</p></div>';
                        }
                    }
                } else {
                    $notice = '<div class="notice notice-error is-dismissible"><p>Please select a valid CSV file to upload.</p></div>';
                }
            } elseif ( 'reset' === $action ) {
                delete_option( 'santino_branches_detailed' );
                delete_option( 'santino_cafe_branches' );
                $current = self::get_branches_detailed();
                $notice = '<div class="notice notice-info is-dismissible"><p><strong>Branches reset to default list.</strong></p></div>';
            }
        }

        $all_branches   = self::get_branches_detailed();
        $divisions_list = array( 'Dhaka', 'Chattogram', 'Sylhet', 'Rajshahi', 'Khulna', 'Barishal', 'Rangpur', 'Mymensingh' );
        
        $edit_branch = null;
        if ( isset( $_GET['edit'] ) ) {
            $target_id = sanitize_text_field( $_GET['edit'] );
            foreach ( $all_branches as $b ) {
                if ( ( $b['id'] ?? '' ) === $target_id || ( $b['name'] ?? '' ) === $target_id ) {
                    $edit_branch = $b;
                    break;
                }
            }
        }

        $is_new_mode = ( isset( $_GET['action'] ) && $_GET['action'] === 'new' );

        if ( $edit_branch || $is_new_mode ) {
            ?>
            <div class="wrap">
                <h1 class="wp-heading-inline"><?php echo $edit_branch ? __( 'Edit Cafe Branch', 'santino' ) : __( 'Add New Cafe Branch', 'santino' ); ?></h1>
                <a href="<?php echo admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches' ); ?>" class="page-title-action"><?php _e( '← Back to All Branches', 'santino' ); ?></a>
                <hr class="wp-header-end">

                <?php echo $notice; ?>

                <div id="poststuff">
                    <div id="post-body" class="metabox-holder">
                        <div id="post-body-content">
                            <div class="postbox" style="padding: 10px 20px 20px;">
                                <form method="post" action="<?php echo admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches' ); ?>">
                                    <?php wp_nonce_field( 'santino_branches_nonce' ); ?>
                                    <input type="hidden" name="santino_branch_action" value="<?php echo $edit_branch ? 'edit' : 'add'; ?>">
                                    <?php if ( $edit_branch ) : ?>
                                        <input type="hidden" name="branch_id" value="<?php echo esc_attr( $edit_branch['id'] ?? $edit_branch['name'] ); ?>">
                                    <?php endif; ?>

                                    <table class="form-table" role="presentation">
                                        <tbody>
                                            <tr>
                                                <th scope="row"><label for="branch_name"><?php _e( 'Branch Name', 'santino' ); ?> <span class="description">(required)</span></label></th>
                                                <td>
                                                    <input name="branch_name" id="branch_name" type="text" value="<?php echo esc_attr( $edit_branch['name'] ?? '' ); ?>" class="regular-text" required>
                                                    <p class="description"><?php _e( 'The full name of the outlet or cafe roastery.', 'santino' ); ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="branch_division"><?php _e( 'Division', 'santino' ); ?> <span class="description">(required)</span></label></th>
                                                <td>
                                                    <select name="division" id="branch_division" required>
                                                        <?php 
                                                        $cur_div = $edit_branch['division'] ?? 'Dhaka';
                                                        foreach ( $divisions_list as $div ) : ?>
                                                            <option value="<?php echo esc_attr( $div ); ?>" <?php selected( $cur_div, $div ); ?>><?php echo esc_html( $div ); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="branch_district"><?php _e( 'District', 'santino' ); ?> <span class="description">(required)</span></label></th>
                                                <td>
                                                    <input name="district" id="branch_district" type="text" value="<?php echo esc_attr( $edit_branch['district'] ?? 'Dhaka' ); ?>" class="regular-text" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="branch_address"><?php _e( 'Address / Street Area', 'santino' ); ?></label></th>
                                                <td>
                                                    <textarea name="address" id="branch_address" rows="3" class="large-text"><?php echo esc_textarea( $edit_branch['address'] ?? '' ); ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="branch_phone"><?php _e( 'Hotline / Phone Number', 'santino' ); ?></label></th>
                                                <td>
                                                    <input name="phone" id="branch_phone" type="text" value="<?php echo esc_attr( $edit_branch['phone'] ?? '+880 1613-334514' ); ?>" class="regular-text">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="branch_lat"><?php _e( 'Latitude', 'santino' ); ?></label></th>
                                                <td>
                                                    <input name="lat" id="branch_lat" type="text" value="<?php echo esc_attr( $edit_branch['lat'] ?? '' ); ?>" class="regular-text" placeholder="e.g. 23.7925">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="branch_long"><?php _e( 'Longitude', 'santino' ); ?></label></th>
                                                <td>
                                                    <input name="long" id="branch_long" type="text" value="<?php echo esc_attr( $edit_branch['long'] ?? '' ); ?>" class="regular-text" placeholder="e.g. 90.4078">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><label for="branch_map"><?php _e( 'Map Location (Google Maps URL)', 'santino' ); ?></label></th>
                                                <td>
                                                    <input name="map_location" id="branch_map" type="url" value="<?php echo esc_attr( $edit_branch['map_location'] ?? '' ); ?>" class="large-text" placeholder="https://maps.google.com/?q=...">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <p class="submit">
                                        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo $edit_branch ? __( 'Save Changes', 'santino' ) : __( 'Add Branch', 'santino' ); ?>">
                                        <a href="<?php echo admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches' ); ?>" class="button button-secondary" style="margin-left: 8px;"><?php _e( 'Cancel', 'santino' ); ?></a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            return;
        }

        $sample_url = wp_nonce_url( admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches&action=sample_csv' ), 'santino_sample_csv' );
        $export_url = wp_nonce_url( admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches&action=export_csv' ), 'santino_export_csv' );

        $division_filter = isset( $_GET['filter_division'] ) ? sanitize_text_field( wp_unslash( $_GET['filter_division'] ) ) : '';
        $search_query    = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';

        $display_branches = $all_branches;
        if ( $division_filter !== '' ) {
            $display_branches = array_filter( $display_branches, function( $b ) use ( $division_filter ) {
                return strcasecmp( $b['division'] ?? '', $division_filter ) === 0;
            } );
        }
        if ( $search_query !== '' ) {
            $sq = strtolower( $search_query );
            $display_branches = array_filter( $display_branches, function( $b ) use ( $sq ) {
                $combined = strtolower( ( $b['name'] ?? '' ) . ' ' . ( $b['division'] ?? '' ) . ' ' . ( $b['district'] ?? '' ) . ' ' . ( $b['address'] ?? '' ) . ' ' . ( $b['phone'] ?? '' ) );
                return strpos( $combined, $sq ) !== false;
            } );
        }
        $count = count( $display_branches );

        $per_page    = isset( $_GET['per_page'] ) ? max( 5, min( 100, intval( $_GET['per_page'] ) ) ) : 10;
        $total_pages = max( 1, ceil( $count / $per_page ) );
        $paged       = isset( $_GET['paged'] ) ? max( 1, min( $total_pages, intval( $_GET['paged'] ) ) ) : 1;
        $offset      = ( $paged - 1 ) * $per_page;
        $paged_branches = array_slice( $display_branches, $offset, $per_page );

        $render_pagination = function() use ( $count, $total_pages, $paged ) {
            ?>
            <div class="tablenav-pages <?php echo ( $total_pages <= 1 ) ? 'one-page' : ''; ?>">
                <span class="displaying-num"><?php echo sprintf( _n( '%s item', '%s items', $count, 'santino' ), number_format_i18n( $count ) ); ?></span>
                <?php if ( $total_pages > 1 ) : ?>
                    <span class="pagination-links">
                        <?php if ( $paged > 1 ) : ?>
                            <a class="first-page button" href="<?php echo esc_url( add_query_arg( 'paged', 1 ) ); ?>" title="<?php esc_attr_e( 'First page', 'santino' ); ?>"><span class="screen-reader-text"><?php _e( 'First page', 'santino' ); ?></span><span aria-hidden="true">&laquo;</span></a>
                            <a class="prev-page button" href="<?php echo esc_url( add_query_arg( 'paged', $paged - 1 ) ); ?>" title="<?php esc_attr_e( 'Previous page', 'santino' ); ?>"><span class="screen-reader-text"><?php _e( 'Previous page', 'santino' ); ?></span><span aria-hidden="true">&lsaquo;</span></a>
                        <?php else : ?>
                            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">&laquo;</span>
                            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">&lsaquo;</span>
                        <?php endif; ?>

                        <span class="paging-input">
                            <label for="current-page-selector" class="screen-reader-text"><?php _e( 'Current Page', 'santino' ); ?></label>
                            <input class="current-page" id="current-page-selector" type="text" name="paged" value="<?php echo esc_attr( $paged ); ?>" size="2" aria-describedby="table-paging" onkeydown="if(event.key==='Enter'){location.href='<?php echo esc_url( remove_query_arg( 'paged' ) ); ?>&paged='+this.value; return false;}">
                            <span class="tablenav-paging-text"> of <span class="total-pages"><?php echo esc_html( $total_pages ); ?></span></span>
                        </span>

                        <?php if ( $paged < $total_pages ) : ?>
                            <a class="next-page button" href="<?php echo esc_url( add_query_arg( 'paged', $paged + 1 ) ); ?>" title="<?php esc_attr_e( 'Next page', 'santino' ); ?>"><span class="screen-reader-text"><?php _e( 'Next page', 'santino' ); ?></span><span aria-hidden="true">&rsaquo;</span></a>
                            <a class="last-page button" href="<?php echo esc_url( add_query_arg( 'paged', $total_pages ) ); ?>" title="<?php esc_attr_e( 'Last page', 'santino' ); ?>"><span class="screen-reader-text"><?php _e( 'Last page', 'santino' ); ?></span><span aria-hidden="true">&raquo;</span></a>
                        <?php else : ?>
                            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">&rsaquo;</span>
                            <span class="tablenav-pages-navspan button disabled" aria-hidden="true">&raquo;</span>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
            <?php
        };
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php _e( 'Cafe Branches', 'santino' ); ?></h1>
            <a href="<?php echo admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches&action=new' ); ?>" class="page-title-action"><?php _e( 'Add New Branch', 'santino' ); ?></a>
            <a href="<?php echo esc_url( $sample_url ); ?>" class="page-title-action"><?php _e( 'Download Sample CSV', 'santino' ); ?></a>
            <a href="<?php echo esc_url( $export_url ); ?>" class="page-title-action"><?php _e( 'Export CSV', 'santino' ); ?></a>
            <a href="#import-csv" class="page-title-action" onclick="var b=document.getElementById('santinoImportPanel'); b.style.display=(b.style.display==='none'||!b.style.display)?'block':'none'; return false;"><?php _e( 'Import CSV', 'santino' ); ?></a>
            <hr class="wp-header-end">

            <?php echo $notice; ?>

            <div id="santinoImportPanel" class="postbox" style="display: none; margin: 15px 0; padding: 15px 20px;">
                <h3 style="margin-top: 0;"><?php _e( 'Bulk CSV File Import', 'santino' ); ?></h3>
                <p class="description">
                    <?php _e( 'Upload .csv with columns: branch_name, division, district, lat, long, map_location, address, phone', 'santino' ); ?>
                </p>
                <form method="post" enctype="multipart/form-data">
                    <?php wp_nonce_field( 'santino_branches_nonce' ); ?>
                    <input type="hidden" name="santino_branch_action" value="upload_csv">
                    <p>
                        <input type="file" name="branches_csv" accept=".csv" required>
                    </p>
                    <p>
                        <label><input type="radio" name="csv_mode" value="append" checked> <?php _e( 'Append to existing', 'santino' ); ?></label>
                        &nbsp;&nbsp;
                        <label><input type="radio" name="csv_mode" value="replace"> <?php _e( 'Replace all', 'santino' ); ?></label>
                    </p>
                    <p>
                        <input type="submit" class="button button-primary" value="<?php _e( 'Upload & Import CSV', 'santino' ); ?>">
                        <button type="button" class="button button-secondary" onclick="document.getElementById('santinoImportPanel').style.display='none';"><?php _e( 'Cancel', 'santino' ); ?></button>
                    </p>
                </form>
            </div>

            <form method="get" action="<?php echo admin_url( 'edit.php' ); ?>">
                <input type="hidden" name="post_type" value="santino_member">
                <input type="hidden" name="page" value="santino-cafe-branches">
                <p class="search-box">
                    <label class="screen-reader-text" for="branch-search-input"><?php _e( 'Search Branches:', 'santino' ); ?></label>
                    <input type="search" id="branch-search-input" name="s" value="<?php echo esc_attr( $search_query ); ?>" placeholder="<?php esc_attr_e( 'Search branches...', 'santino' ); ?>">
                    <input type="submit" id="search-submit" class="button" value="<?php esc_attr_e( 'Search Branches', 'santino' ); ?>">
                </p>
            </form>

            <form method="post" id="branches-filter">
                <?php wp_nonce_field( 'santino_branches_nonce' ); ?>

                <div class="tablenav top">
                    <div class="alignleft actions bulkactions">
                        <label for="bulk-action-selector-top" class="screen-reader-text"><?php _e( 'Select bulk action', 'santino' ); ?></label>
                        <select name="santino_branch_action" id="bulk-action-selector-top">
                            <option value="-1"><?php _e( 'Bulk actions', 'santino' ); ?></option>
                            <option value="bulk_delete"><?php _e( 'Delete', 'santino' ); ?></option>
                        </select>
                        <input type="submit" id="doaction" class="button action" value="<?php esc_attr_e( 'Apply', 'santino' ); ?>" onclick="if(document.getElementById('bulk-action-selector-top').value==='bulk_delete'){return confirm('Are you sure you want to delete the selected branches?');}">
                    </div>

                    <div class="alignleft actions">
                        <select name="filter_division_select" onchange="location.href='<?php echo admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches' ); ?>' + (this.value ? '&filter_division=' + encodeURIComponent(this.value) : '') + '<?php echo $search_query ? '&s=' . urlencode( $search_query ) : ''; ?>';">
                            <option value=""><?php _e( 'All Divisions', 'santino' ); ?></option>
                            <?php foreach ( $divisions_list as $div ) : ?>
                                <option value="<?php echo esc_attr( $div ); ?>" <?php selected( $division_filter, $div ); ?>><?php echo esc_html( $div ); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ( $division_filter !== '' || $search_query !== '' ) : ?>
                            <a href="<?php echo admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches' ); ?>" class="button"><?php _e( 'Reset Filters', 'santino' ); ?></a>
                        <?php endif; ?>
                    </div>

                    <?php $render_pagination(); ?>
                </div>

                <table class="wp-list-table widefat fixed striped table-view-list posts">
                    <thead>
                        <tr>
                            <td id="cb" class="manage-column column-cb check-column" style="width: 30px;">
                                <input id="cb-select-all-1" type="checkbox" onclick="var c=this.checked; document.querySelectorAll('input[name=\'branch_ids[]\']').forEach(function(i){i.checked=c;});">
                            </td>
                            <th scope="col" class="manage-column column-title column-primary"><?php _e( 'Branch Name', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width: 110px;"><?php _e( 'Division', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width: 110px;"><?php _e( 'District', 'santino' ); ?></th>
                            <th scope="col" class="manage-column"><?php _e( 'Address / Street Area', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width: 140px;"><?php _e( 'Hotline / Phone', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width: 140px;"><?php _e( 'Coordinates', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width: 90px; text-align: center;"><?php _e( 'Map', 'santino' ); ?></th>
                        </tr>
                    </thead>
                    <tbody id="the-list">
                        <?php if ( empty( $paged_branches ) ) : ?>
                            <tr class="no-items"><td class="colspanchange" colspan="8"><?php _e( 'No cafe branches found.', 'santino' ); ?></td></tr>
                        <?php else : ?>
                            <?php foreach ( $paged_branches as $b ) : 
                                $b_id    = $b['id'] ?? $b['name'];
                                $edit_u  = admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches&edit=' . urlencode( $b_id ) );
                                $del_u   = wp_nonce_url( admin_url( 'edit.php?post_type=santino_member&page=santino-cafe-branches&action=delete&branch_id=' . urlencode( $b_id ) ), 'santino_del_branch_' . $b_id );
                                $map_u   = ! empty( $b['map_location'] ) ? $b['map_location'] : ( ( ! empty( $b['lat'] ) && ! empty( $b['long'] ) ) ? 'https://maps.google.com/?q=' . $b['lat'] . ',' . $b['long'] : '' );
                            ?>
                                <tr>
                                    <th scope="row" class="check-column">
                                        <input type="checkbox" name="branch_ids[]" value="<?php echo esc_attr( $b_id ); ?>">
                                    </th>
                                    <td class="title column-title has-row-actions column-primary">
                                        <strong>
                                            <a class="row-title" href="<?php echo esc_url( $edit_u ); ?>">
                                                <?php echo esc_html( $b['name'] ?? '' ); ?>
                                            </a>
                                        </strong>
                                        <div class="row-actions">
                                            <span class="edit">
                                                <a href="<?php echo esc_url( $edit_u ); ?>"><?php _e( 'Edit', 'santino' ); ?></a> | 
                                            </span>
                                            <span class="trash">
                                                <a href="<?php echo esc_url( $del_u ); ?>" class="submitdelete" onclick="return confirm('<?php echo esc_js( sprintf( __( 'Delete %s?', 'santino' ), $b['name'] ?? '' ) ); ?>');"><?php _e( 'Delete', 'santino' ); ?></a>
                                            </span>
                                        </div>
                                    </td>
                                    <td><?php echo esc_html( $b['division'] ?? 'Dhaka' ); ?></td>
                                    <td><?php echo esc_html( $b['district'] ?? 'Dhaka' ); ?></td>
                                    <td><?php echo esc_html( $b['address'] ?? '—' ); ?></td>
                                    <td><?php echo esc_html( $b['phone'] ?? '—' ); ?></td>
                                    <td style="font-family: monospace; font-size: 11px;">
                                        <?php if ( ! empty( $b['lat'] ) && ! empty( $b['long'] ) ) : ?>
                                             <?php echo esc_html( $b['lat'] ); ?>, <?php echo esc_html( $b['long'] ); ?>
                                        <?php else : ?>
                                            —
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if ( $map_u ) : ?>
                                            <a href="<?php echo esc_url( $map_u ); ?>" target="_blank" class="button button-small"><?php _e( 'View Map', 'santino' ); ?></a>
                                        <?php else : ?>
                                            —
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="manage-column column-cb check-column">
                                <input id="cb-select-all-2" type="checkbox" onclick="var c=this.checked; document.querySelectorAll('input[name=\'branch_ids[]\']').forEach(function(i){i.checked=c;});">
                            </td>
                            <th scope="col" class="manage-column column-title column-primary"><?php _e( 'Branch Name', 'santino' ); ?></th>
                            <th scope="col" class="manage-column"><?php _e( 'Division', 'santino' ); ?></th>
                            <th scope="col" class="manage-column"><?php _e( 'District', 'santino' ); ?></th>
                            <th scope="col" class="manage-column"><?php _e( 'Address / Street Area', 'santino' ); ?></th>
                            <th scope="col" class="manage-column"><?php _e( 'Hotline / Phone', 'santino' ); ?></th>
                            <th scope="col" class="manage-column"><?php _e( 'Coordinates', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="text-align: center;"><?php _e( 'Map', 'santino' ); ?></th>
                        </tr>
                    </tfoot>
                </table>

                <div class="tablenav bottom">
                    <div class="alignleft actions bulkactions">
                        <label for="bulk-action-selector-bottom" class="screen-reader-text"><?php _e( 'Select bulk action', 'santino' ); ?></label>
                        <select name="santino_branch_action_bottom" id="bulk-action-selector-bottom" onchange="document.getElementById('bulk-action-selector-top').value=this.value;">
                            <option value="-1"><?php _e( 'Bulk actions', 'santino' ); ?></option>
                            <option value="bulk_delete"><?php _e( 'Delete', 'santino' ); ?></option>
                        </select>
                        <input type="submit" class="button action" value="<?php esc_attr_e( 'Apply', 'santino' ); ?>" onclick="if(document.getElementById('bulk-action-selector-bottom').value==='bulk_delete'){document.getElementById('bulk-action-selector-top').value='bulk_delete'; return confirm('Are you sure you want to delete the selected branches?');}">
                    </div>
                    <?php $render_pagination(); ?>
                </div>
            </form>

            <div style="margin-top: 30px; padding-top: 15px; border-top: 1px solid #dcdcde;">
                <form method="post" onsubmit="return confirm('Reset all branches to default list?');" style="display: inline;">
                    <?php wp_nonce_field( 'santino_branches_nonce' ); ?>
                    <input type="hidden" name="santino_branch_action" value="reset">
                    <input type="submit" class="button button-link-delete" value="<?php _e( '↺ Reset to Default Branches', 'santino' ); ?>" style="color: #b32d2e;">
                </form>
            </div>
        </div>
        <?php
    }

    public static function render_loyalty_dashboard() {
        global $wpdb;

        $total_members  = (int) ( wp_count_posts( 'santino_member' )->publish ?? 0 );
        $total_invoices = (int) ( wp_count_posts( 'santino_invoice' )->publish ?? 0 );
        $total_vouchers = (int) ( wp_count_posts( 'santino_voucher' )->publish ?? 0 );
        $pending_inv    = self::get_pending_invoices_count();
        $pending_red    = self::get_pending_redeems_count();

        $total_approved_cups = (int) $wpdb->get_var( "
            SELECT SUM(CAST(pm.meta_value AS UNSIGNED)) 
            FROM {$wpdb->postmeta} pm 
            INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id 
            INNER JOIN {$wpdb->postmeta} pm_st ON pm_st.post_id = p.ID AND pm_st.meta_key = '_santino_invoice_status'
            WHERE p.post_type = 'santino_invoice' 
              AND p.post_status = 'publish' 
              AND pm.meta_key = '_santino_invoice_cups' 
              AND pm_st.meta_value = 'approved'
        " );

        $total_redeemed_cups = (int) $wpdb->get_var( "
            SELECT COUNT(*) 
            FROM {$wpdb->postmeta} pm 
            INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id 
            WHERE p.post_type = 'santino_redeem' 
              AND p.post_status = 'publish' 
              AND pm.meta_key = '_santino_redeem_status' 
              AND pm.meta_value = 'approved'
        " );

        $inv_status_rows = $wpdb->get_results( "
            SELECT pm.meta_value as status_key, COUNT(*) as cnt
            FROM {$wpdb->postmeta} pm
            INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE p.post_type = 'santino_invoice' AND p.post_status = 'publish' AND pm.meta_key = '_santino_invoice_status'
            GROUP BY pm.meta_value
        " );
        $inv_status_counts = array( 'approved' => 0, 'pending' => 0, 'rejected' => 0 );
        if ( ! empty( $inv_status_rows ) ) {
            foreach ( $inv_status_rows as $row ) {
                $inv_status_counts[ $row->status_key ] = (int) $row->cnt;
            }
        }

        $branch_rows = $wpdb->get_results( "
            SELECT 
                COALESCE(NULLIF(TRIM(pm_b.meta_value), ''), 'Main / Website') as branch_name,
                COUNT(p.ID) as total_invoices,
                SUM(CASE WHEN pm_st.meta_value = 'approved' THEN CAST(COALESCE(pm_c.meta_value, 1) AS UNSIGNED) ELSE 0 END) as approved_cups,
                SUM(CASE WHEN pm_st.meta_value = 'approved' THEN 1 ELSE 0 END) as approved_invoices
            FROM {$wpdb->posts} p
            LEFT JOIN {$wpdb->postmeta} pm_b ON pm_b.post_id = p.ID AND pm_b.meta_key = '_santino_invoice_branch'
            LEFT JOIN {$wpdb->postmeta} pm_st ON pm_st.post_id = p.ID AND pm_st.meta_key = '_santino_invoice_status'
            LEFT JOIN {$wpdb->postmeta} pm_c ON pm_c.post_id = p.ID AND pm_c.meta_key = '_santino_invoice_cups'
            WHERE p.post_type = 'santino_invoice' AND p.post_status = 'publish'
            GROUP BY branch_name
            ORDER BY approved_cups DESC, total_invoices DESC
        " );

        $leaderboard = $wpdb->get_results( "
            SELECT 
                p.ID, 
                p.post_title as member_name,
                pm_p.meta_value as phone,
                pm_id.meta_value as member_id,
                CAST(COALESCE(pm_c.meta_value, 0) AS UNSIGNED) as total_cups,
                CAST(COALESCE(pm_s.meta_value, 0) AS UNSIGNED) as stamps,
                CAST(COALESCE(pm_f.meta_value, 0) AS UNSIGNED) as free_coffees
            FROM {$wpdb->posts} p
            LEFT JOIN {$wpdb->postmeta} pm_p ON pm_p.post_id = p.ID AND pm_p.meta_key = '_santino_member_phone'
            LEFT JOIN {$wpdb->postmeta} pm_id ON pm_id.post_id = p.ID AND pm_id.meta_key = '_santino_member_id'
            LEFT JOIN {$wpdb->postmeta} pm_c ON pm_c.post_id = p.ID AND pm_c.meta_key = '_santino_total_approved_cups'
            LEFT JOIN {$wpdb->postmeta} pm_s ON pm_s.post_id = p.ID AND pm_s.meta_key = '_santino_cup_stamps'
            LEFT JOIN {$wpdb->postmeta} pm_f ON pm_f.post_id = p.ID AND pm_f.meta_key = '_santino_total_free_coffees'
            WHERE p.post_type = 'santino_member' AND p.post_status = 'publish'
            ORDER BY total_cups DESC, free_coffees DESC, stamps DESC
            LIMIT 10
        " );

        $recent_invoices = get_posts( array(
            'post_type'      => 'santino_invoice',
            'post_status'    => 'publish',
            'posts_per_page' => 10,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        $recent_vouchers = get_posts( array(
            'post_type'      => 'santino_voucher',
            'post_status'    => 'publish',
            'posts_per_page' => 8,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        $promo_inv_count = (int) $wpdb->get_var( "
            SELECT COUNT(*)
            FROM {$wpdb->postmeta} pm
            INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE p.post_type = 'santino_invoice'
              AND p.post_status = 'publish'
              AND pm.meta_key = '_santino_invoice_promo_claimed'
              AND pm.meta_value = 'yes'
        " );

        $trend_labels   = array();
        $trend_invoices = array();
        $trend_cups     = array();
        for ( $i = 6; $i >= 0; $i-- ) {
            $d_str            = wp_date( 'Y-m-d', strtotime( "-{$i} days" ) );
            $trend_labels[]   = wp_date( 'M j', strtotime( "-{$i} days" ) );
            $row_t            = $wpdb->get_row( $wpdb->prepare( "
                SELECT COUNT(p.ID) as inv_cnt, SUM(CAST(COALESCE(pm_c.meta_value, 1) AS UNSIGNED)) as cup_cnt
                FROM {$wpdb->posts} p
                LEFT JOIN {$wpdb->postmeta} pm_c ON pm_c.post_id = p.ID AND pm_c.meta_key = '_santino_invoice_cups'
                WHERE p.post_type = 'santino_invoice'
                  AND p.post_status = 'publish'
                  AND DATE(p.post_date) = %s
            ", $d_str ) );
            $trend_invoices[] = $row_t ? (int) $row_t->inv_cnt : 0;
            $trend_cups[]     = $row_t ? (int) $row_t->cup_cnt : 0;
        }

        $chart_branch_labels   = array();
        $chart_branch_cups     = array();
        $chart_branch_invoices = array();
        if ( ! empty( $branch_rows ) ) {
            foreach ( array_slice( $branch_rows, 0, 8 ) as $br ) {
                $chart_branch_labels[]   = $br->branch_name;
                $chart_branch_cups[]     = (int) $br->approved_cups;
                $chart_branch_invoices[] = (int) $br->total_invoices;
            }
        }
        ?>
        <style>
            .loyalty-report-wrap { width: 100%; box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
            .loyalty-grid-6 { display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: 16px; margin: 18px 0; }
            .loyalty-charts-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 18px; margin-bottom: 22px; }
            .loyalty-card { background: #fff; padding: 18px 20px; border-radius: 6px; border: 1px solid #c3c4c7; box-shadow: 0 1px 1px rgba(0,0,0,0.04); position: relative; overflow: hidden; }
            .loyalty-card-accent { position: absolute; left: 0; top: 0; bottom: 0; width: 4px; }
            .loyalty-label { color: #646970; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 6px; }
            .loyalty-value { font-size: 28px; font-weight: 800; color: #1d2327; line-height: 1.1; }
            .loyalty-sub { font-size: 12px; color: #646970; margin-top: 6px; font-weight: 500; }
            .loyalty-section { background: #fff; border-radius: 6px; border: 1px solid #c3c4c7; box-shadow: 0 1px 1px rgba(0,0,0,0.04); padding: 20px; margin-bottom: 20px; }
            .loyalty-title { font-size: 15px; font-weight: 700; color: #1d2327; margin: 0 0 14px; display: flex; align-items: center; justify-content: space-between; }
            .loyalty-table { width: 100%; border-collapse: collapse; text-align: left; }
            .loyalty-table th { background: #f6f7f7; color: #2c3338; font-size: 12px; font-weight: 600; padding: 10px 12px; border-bottom: 1px solid #c3c4c7; }
            .loyalty-table td { padding: 10px 12px; border-bottom: 1px solid #f0f0f1; font-size: 13px; color: #2c3338; vertical-align: middle; }
            .loyalty-table tr:hover td { background: #f6f7f7; }
            .badge-pill { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; letter-spacing: 0.3px; }
            .badge-approved { background: #dcfce7; color: #15803d; }
            .badge-pending { background: #fef9c3; color: #854d0e; }
            .badge-rejected { background: #fee2e2; color: #b91c1c; }
            .badge-voucher { background: #fdf2f8; color: #db2777; font-family: monospace; }
        </style>

        <div class="wrap loyalty-report-wrap">
            <h1 class="wp-heading-inline">Loyalty Reports &amp; Analytics</h1>
            <a href="<?php echo admin_url( 'edit.php?post_type=santino_invoice' ); ?>" class="page-title-action">
                Verify Invoices <?php echo ( $pending_inv > 0 ) ? '(' . $pending_inv . ' Pending)' : ''; ?>
            </a>
            <a href="<?php echo admin_url( 'edit.php?post_type=santino_redeem' ); ?>" class="page-title-action">
                Redeem Approvals <?php echo ( $pending_red > 0 ) ? '(' . $pending_red . ' Pending)' : ''; ?>
            </a>
            <a href="<?php echo admin_url( 'edit.php?post_type=santino_member&page=santino-daily-promotions' ); ?>" class="page-title-action">
                Daily Promotions (<?php echo esc_html( $promo_inv_count ); ?> Claimed)
            </a>
            <hr class="wp-header-end">

            <div class="loyalty-charts-grid" style="margin-top: 16px;">
                <div class="loyalty-section" style="margin-bottom:0;">
                    <div class="loyalty-title"><span>7-Day Cup &amp; Invoice Activity</span></div>
                    <div style="height:240px; position:relative;"><canvas id="santinoTrendChart"></canvas></div>
                </div>
                <div class="loyalty-section" style="margin-bottom:0;">
                    <div class="loyalty-title"><span>Branch Cup Throughput</span></div>
                    <div style="height:240px; position:relative;"><canvas id="santinoBranchChart"></canvas></div>
                </div>
                <div class="loyalty-section" style="margin-bottom:0;">
                    <div class="loyalty-title"><span>Invoice Status &amp; Promo Split</span></div>
                    <div style="height:240px; position:relative;"><canvas id="santinoStatusChart"></canvas></div>
                </div>
            </div>
            </div>

            <!-- KPI Metric Cards Grid -->
            <div class="loyalty-grid-6">
                <div class="loyalty-card">
                    <div class="loyalty-card-accent" style="background: #00625d;"></div>
                    <div class="loyalty-label">VIP Club Members</div>
                    <div class="loyalty-value"><?php echo esc_html( number_format_i18n( $total_members ) ); ?></div>
                    <div class="loyalty-sub">Total enrolled members</div>
                </div>

                <div class="loyalty-card">
                    <div class="loyalty-card-accent" style="background: #0284c7;"></div>
                    <div class="loyalty-label">Verified Cups Drank</div>
                    <div class="loyalty-value" style="color: #0284c7;"><?php echo esc_html( number_format_i18n( $total_approved_cups ) ); ?> ☕</div>
                    <div class="loyalty-sub">Approved cups across cafe</div>
                </div>

                <div class="loyalty-card">
                    <div class="loyalty-card-accent" style="background: <?php echo ( $pending_inv > 0 ) ? '#f59e0b' : '#10b981'; ?>;"></div>
                    <div class="loyalty-label">Pending Verifications</div>
                    <div class="loyalty-value" style="color: <?php echo ( $pending_inv > 0 ) ? '#f59e0b' : '#10b981'; ?>;">
                        <?php echo esc_html( $pending_inv ); ?>
                    </div>
                    <div class="loyalty-sub"><?php echo ( $pending_inv > 0 ) ? 'Awaiting cashier check' : 'All clear (Up to date)'; ?></div>
                </div>

                <div class="loyalty-card">
                    <div class="loyalty-card-accent" style="background: #6366f1;"></div>
                    <div class="loyalty-label">Total Invoices</div>
                    <div class="loyalty-value"><?php echo esc_html( number_format_i18n( $total_invoices ) ); ?></div>
                    <div class="loyalty-sub"><?php echo esc_html( $inv_status_counts['approved'] ); ?> Approved / <?php echo esc_html( $inv_status_counts['rejected'] ); ?> Rejected</div>
                </div>

                <div class="loyalty-card">
                    <div class="loyalty-card-accent" style="background: #ec4899;"></div>
                    <div class="loyalty-label">Free Vouchers Awarded</div>
                    <div class="loyalty-value" style="color: #ec4899;"><?php echo esc_html( number_format_i18n( $total_vouchers ) ); ?> 🎟️</div>
                    <div class="loyalty-sub">5-cups cycle completions</div>
                </div>

                <div class="loyalty-card">
                    <div class="loyalty-card-accent" style="background: #10b981;"></div>
                    <div class="loyalty-label">Free Cups Served</div>
                    <div class="loyalty-value" style="color: #10b981;"><?php echo esc_html( number_format_i18n( $total_redeemed_cups ) ); ?> 🎁</div>
                    <div class="loyalty-sub"><?php echo esc_html( $pending_red ); ?> Pending authorizations</div>
                </div>
            </div>

            <!-- Two Column Layout: Branch Matrix & Member Leaderboard -->
            <div style="display: grid; grid-template-columns: 1.1fr 1fr; gap: 24px; margin-bottom: 24px; align-items: start;">
                <!-- Branch Performance Breakdown -->
                <div class="loyalty-section" style="margin-bottom: 0;">
                    <div class="loyalty-title">
                        <span>🏢 Branch-wise Loyalty Performance</span>
                        <span style="font-size: 12px; font-weight: 500; color: #64748b;"><?php echo count( $branch_rows ); ?> Branches Active</span>
                    </div>
                    <?php if ( ! empty( $branch_rows ) ) : ?>
                    <table class="loyalty-table">
                        <thead>
                            <tr>
                                <th>Branch Name</th>
                                <th style="text-align: center;">Invoices</th>
                                <th style="text-align: right;">Approved Cups</th>
                                <th style="text-align: right;">Share</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $branch_rows as $br ) : 
                                $share = ( $total_approved_cups > 0 ) ? round( ( $br->approved_cups / $total_approved_cups ) * 100, 1 ) : 0;
                            ?>
                            <tr>
                                <td>
                                    <strong><?php echo esc_html( $br->branch_name ); ?></strong>
                                    <div style="font-size: 11px; color: #94a3b8;"><?php echo esc_html( $br->approved_invoices ); ?> verified orders</div>
                                </td>
                                <td style="text-align: center; font-weight: 600; color: #334155;">
                                    <?php echo esc_html( $br->total_invoices ); ?>
                                </td>
                                <td style="text-align: right; font-weight: 700; color: #00625d;">
                                    <?php echo esc_html( number_format_i18n( $br->approved_cups ) ); ?> ☕
                                </td>
                                <td style="text-align: right; width: 110px;">
                                    <div style="display: flex; align-items: center; gap: 6px; justify-content: flex-end;">
                                        <div style="width: 50px; background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden;">
                                            <div style="background: #00625d; height: 100%; width: <?php echo esc_attr( $share ); ?>%;"></div>
                                        </div>
                                        <span style="font-size: 11px; font-weight: 600; color: #64748b; min-width: 32px;"><?php echo esc_html( $share ); ?>%</span>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else : ?>
                        <p style="color: #64748b; margin: 12px 0; font-size: 13px;">No branch logs recorded yet.</p>
                    <?php endif; ?>
                </div>

                <!-- Top Loyal Members Leaderboard -->
                <div class="loyalty-section" style="margin-bottom: 0;">
                    <div class="loyalty-title">
                        <span>🏆 Top Coffee VIPs (Leaderboard)</span>
                        <a href="<?php echo admin_url( 'edit.php?post_type=santino_member' ); ?>" style="font-size: 12px; font-weight: 600; color: #00625d; text-decoration: none;">View All Members →</a>
                    </div>
                    <?php if ( ! empty( $leaderboard ) ) : ?>
                    <table class="loyalty-table">
                        <thead>
                            <tr>
                                <th style="width: 32px;">#</th>
                                <th>VIP Member</th>
                                <th style="text-align: center;">Stamp Card</th>
                                <th style="text-align: right;">Lifetime Cups</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $rank = 1;
                            foreach ( $leaderboard as $mb ) : 
                                $badge_color = ( $rank === 1 ) ? '#f59e0b' : ( ( $rank === 2 ) ? '#94a3b8' : ( ( $rank === 3 ) ? '#b45309' : '#cbd5e1' ) );
                            ?>
                            <tr>
                                <td style="font-weight: 800; color: <?php echo esc_attr( $badge_color ); ?>; font-size: 14px;">
                                    #<?php echo $rank++; ?>
                                </td>
                                <td>
                                    <a href="<?php echo esc_url( get_edit_post_link( $mb->ID ) ); ?>" style="font-weight: 700; color: #0f172a; text-decoration: none;">
                                        <?php echo esc_html( $mb->member_name ); ?>
                                    </a>
                                    <div style="font-size: 11px; color: #64748b;">
                                        <?php echo esc_html( self::normalize_phone( $mb->phone ) ); ?> 
                                        <?php if ( ! empty( $mb->member_id ) ) : ?>
                                            &bull; <code style="font-size: 10px; color: #00625d;"><?php echo esc_html( $mb->member_id ); ?></code>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 2px; justify-content: center;">
                                        <?php for ( $s = 1; $s <= 5; $s++ ) : ?>
                                            <span style="font-size: 11px;"><?php echo ( $s <= $mb->stamps ) ? '☕' : '⚪'; ?></span>
                                        <?php endfor; ?>
                                    </div>
                                    <div style="font-size: 10px; color: #94a3b8; margin-top: 2px;"><?php echo esc_html( $mb->stamps ); ?>/5 stamps</div>
                                </td>
                                <td style="text-align: right;">
                                    <strong style="color: #00625d; font-size: 14px;"><?php echo esc_html( $mb->total_cups ); ?></strong> ☕
                                    <?php if ( $mb->free_coffees > 0 ) : ?>
                                        <div style="font-size: 10px; color: #ec4899; font-weight: 700;">+<?php echo esc_html( $mb->free_coffees ); ?> Free won</div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else : ?>
                        <p style="color: #64748b; margin: 12px 0; font-size: 13px;">No members with cup activity yet.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Invoices Audit Stream -->
            <div class="loyalty-section">
                <div class="loyalty-title">
                    <span>🧾 Live Invoices Audit Stream (Recent Submissions)</span>
                    <a href="<?php echo admin_url( 'edit.php?post_type=santino_invoice' ); ?>" style="font-size: 12px; font-weight: 600; color: #00625d; text-decoration: none;">View All Invoices →</a>
                </div>
                <?php if ( ! empty( $recent_invoices ) ) : ?>
                <table class="loyalty-table">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Memo / Invoice #</th>
                            <th>Receipt Photo</th>
                            <th>Customer Phone</th>
                            <th>Branch</th>
                            <th style="text-align: center;">Cups</th>
                            <th>Verification Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $recent_invoices as $inv_post ) : 
                            $inv_no  = get_post_meta( $inv_post->ID, '_santino_invoice_number', true );
                            $phone   = get_post_meta( $inv_post->ID, '_santino_invoice_phone', true );
                            $branch  = get_post_meta( $inv_post->ID, '_santino_invoice_branch', true );
                            $cups    = max( 1, intval( get_post_meta( $inv_post->ID, '_santino_invoice_cups', true ) ?: 1 ) );
                            $status  = get_post_meta( $inv_post->ID, '_santino_invoice_status', true ) ?: 'pending';
                            $img_url = get_post_meta( $inv_post->ID, '_santino_invoice_image_url', true ) ?: get_the_post_thumbnail_url( $inv_post->ID, 'thumbnail' );
                            $approve_url = wp_nonce_url( admin_url( 'admin.php?action=santino_approve_invoice&invoice_id=' . $inv_post->ID ), 'santino_approve_' . $inv_post->ID );
                        ?>
                        <tr>
                            <td style="color: #64748b; font-size: 12px;">
                                <?php echo esc_html( get_the_date( 'M j, Y - H:i', $inv_post ) ); ?>
                            </td>
                            <td>
                                <a href="<?php echo esc_url( get_edit_post_link( $inv_post->ID ) ); ?>" style="font-weight: 700; color: #0f172a; text-decoration: none; font-size: 13px;">
                                    <?php echo esc_html( $inv_no ?: $inv_post->post_title ); ?>
                                </a>
                            </td>
                            <td>
                                <?php if ( $img_url ) : ?>
                                    <a href="<?php echo esc_url( $img_url ); ?>" class="santino-receipt-modal-trigger" data-receipt-url="<?php echo esc_url( $img_url ); ?>" data-receipt-title="<?php echo esc_attr( 'Receipt Photo - ' . ( $inv_no ?: $inv_post->post_title ) ); ?>" title="View Full Receipt in Modal" style="cursor: pointer; display: inline-block;">
                                        <img src="<?php echo esc_url( $img_url ); ?>" style="width: 38px; height: 38px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; vertical-align: middle; transition: transform 0.15s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    </a>
                                <?php else : ?>
                                    <span style="color: #94a3b8; font-size: 11px;">No Photo</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight: 600;">
                                <?php echo esc_html( self::normalize_phone( $phone ) ); ?>
                            </td>
                            <td style="color: #475569;">
                                <?php echo esc_html( $branch ?: '—' ); ?>
                            </td>
                            <td style="text-align: center;">
                                <strong style="color: #00625d; font-size: 13px;"><?php echo esc_html( $cups ); ?></strong> ☕
                            </td>
                            <td>
                                <?php if ( $status === 'approved' ) : ?>
                                    <span class="badge-pill badge-approved">✓ APPROVED</span>
                                <?php elseif ( $status === 'rejected' ) : ?>
                                    <span class="badge-pill badge-rejected">✗ REJECTED</span>
                                <?php else : ?>
                                    <span class="badge-pill badge-pending">⏳ PENDING</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: right;">
                                <?php if ( $status === 'pending' ) : ?>
                                    <a href="<?php echo esc_url( $approve_url ); ?>" class="button button-small button-primary" style="background: #00625d; border-color: #004d49; font-weight: 700;">
                                        ✓ Approve
                                    </a>
                                <?php else : ?>
                                    <a href="<?php echo esc_url( get_edit_post_link( $inv_post->ID ) ); ?>" class="button button-small">View</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else : ?>
                    <p style="color: #64748b; margin: 12px 0; font-size: 13px;">No invoice submissions yet.</p>
                <?php endif; ?>
            </div>

            <!-- Free Vouchers Activity -->
            <?php if ( ! empty( $recent_vouchers ) ) : ?>
            <div class="loyalty-section" style="margin-bottom: 0;">
                <div class="loyalty-title">
                    <span>🎟️ Free Coffee Reward Vouchers (Latest Generated)</span>
                </div>
                <table class="loyalty-table">
                    <thead>
                        <tr>
                            <th>Voucher Code</th>
                            <th>Member Phone</th>
                            <th>Status</th>
                            <th>Awarded Date</th>
                            <th>Redeemed Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $recent_vouchers as $v_post ) : 
                            $v_code   = get_post_meta( $v_post->ID, '_santino_voucher_code', true ) ?: $v_post->post_title;
                            $v_phone  = get_post_meta( $v_post->ID, '_santino_voucher_phone', true );
                            $v_status = get_post_meta( $v_post->ID, '_santino_voucher_status', true ) ?: 'unused';
                            $v_red_at = get_post_meta( $v_post->ID, '_santino_voucher_redeemed_at', true );
                        ?>
                        <tr>
                            <td>
                                <strong class="badge-pill badge-voucher" style="font-size: 12px;"><?php echo esc_html( $v_code ); ?></strong>
                            </td>
                            <td>
                                <?php echo esc_html( self::normalize_phone( $v_phone ) ); ?>
                            </td>
                            <td>
                                <?php if ( $v_status === 'redeemed' ) : ?>
                                    <span class="badge-pill badge-approved">✓ REDEEMED / SERVED</span>
                                <?php else : ?>
                                    <span class="badge-pill badge-pending" style="background: #fdf2f8; color: #db2777;">ACTIVE / READY TO CLAIM</span>
                                <?php endif; ?>
                            </td>
                            <td style="color: #64748b; font-size: 12px;">
                                <?php echo esc_html( get_the_date( 'M j, Y - H:i', $v_post ) ); ?>
                            </td>
                            <td style="color: #64748b; font-size: 12px;">
                                <?php echo esc_html( $v_red_at ? date( 'M j, Y - H:i', strtotime( $v_red_at ) ) : '—' ); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
        <script>
        (function() {
            if (typeof Chart === 'undefined') return;
            var trendCtx = document.getElementById('santinoTrendChart');
            if (trendCtx) {
                new Chart(trendCtx, {
                    type: 'line',
                    data: {
                        labels: <?php echo wp_json_encode( $trend_labels ); ?>,
                        datasets: [
                            { label: 'Cups Logged', data: <?php echo wp_json_encode( $trend_cups ); ?>, borderColor: '#00625d', backgroundColor: 'rgba(0,98,93,0.12)', fill: true, tension: 0.35 },
                            { label: 'Invoices', data: <?php echo wp_json_encode( $trend_invoices ); ?>, borderColor: '#c3996c', backgroundColor: 'rgba(195,153,108,0.1)', fill: false, tension: 0.35 }
                        ]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
                });
            }

            var branchCtx = document.getElementById('santinoBranchChart');
            if (branchCtx) {
                new Chart(branchCtx, {
                    type: 'bar',
                    data: {
                        labels: <?php echo wp_json_encode( $chart_branch_labels ); ?>,
                        datasets: [
                            { label: 'Approved Cups', data: <?php echo wp_json_encode( $chart_branch_cups ); ?>, backgroundColor: '#00625d', borderRadius: 4 },
                            { label: 'Total Invoices', data: <?php echo wp_json_encode( $chart_branch_invoices ); ?>, backgroundColor: '#c3996c', borderRadius: 4 }
                        ]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
                });
            }

            var statusCtx = document.getElementById('santinoStatusChart');
            if (statusCtx) {
                new Chart(statusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Approved', 'Pending', 'Rejected', 'Promo Claimed'],
                        datasets: [{
                            data: [
                                <?php echo intval( $inv_status_counts['approved'] ); ?>,
                                <?php echo intval( $inv_status_counts['pending'] ); ?>,
                                <?php echo intval( $inv_status_counts['rejected'] ); ?>,
                                <?php echo intval( $promo_inv_count ); ?>
                            ],
                            backgroundColor: ['#16a34a', '#eab308', '#dc2626', '#00625d']
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
                });
            }
        })();
        </script>
        <?php
    }

    public static function enqueue_admin_qr_assets( $hook ) {
        $screen = get_current_screen();
        if ( ! $screen ) {
            return;
        }

        if ( strpos( $hook, 'santino' ) !== false || ( isset( $screen->post_type ) && in_array( $screen->post_type, array( 'santino_member', 'santino_voucher', 'santino_redeem' ) ) ) ) {
            wp_enqueue_script( 'santino-qrcode', get_template_directory_uri() . '/assets/js/qrcode.min.js', array(), '1.0.0', true );
        }
    }

    /**
     * Dedicated QR Code Generator Admin Page
     */
    public static function render_qr_generator_page() {
        $selected_member_id = intval( $_GET['member_id'] ?? 0 );
        $all_members = get_posts( array(
            'post_type'      => 'santino_member',
            'posts_per_page' => 100,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        $init_text = home_url( '/membership/' );
        $init_label = 'SANTINO COFFEE CLUB';
        $init_sub = 'REGULAR MEMBER PASS';
        $init_id_str = '';
        $init_phone_str = '';

        if ( $selected_member_id > 0 ) {
            $m_phone = get_post_meta( $selected_member_id, '_santino_member_phone', true );
            $m_id    = get_post_meta( $selected_member_id, '_santino_member_id', true );
            $init_text = home_url( '/membership/?query=' . urlencode( $m_phone ?: $m_id ) );
            $init_id_str = $m_id;
            $init_phone_str = $m_phone;
        }
        ?>
        <style>
        .santino-qr-admin-wrap { max-width: 1200px; margin: 20px auto 40px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
        .sqr-card { background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        .sqr-btn-primary { background: #00625d; color: #fff; border: none; padding: 10px 22px; border-radius: 8px; font-weight: 700; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-size: 14px; transition: all 0.2s; }
        .sqr-btn-primary:hover { background: #004d49; color: #fff; }
        .sqr-btn-secondary { background: #f8fafc; color: #334155; border: 1px solid #cbd5e1; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 14px; }
        .sqr-btn-secondary:hover { background: #e2e8f0; }
        
        /* Print Pass Styles */
        #santinoPrintPassCard {
            width: 380px;
            margin: 0 auto;
            border-radius: 20px;
            padding: 26px;
            background: radial-gradient(circle at 80% 20%, #005c56 0%, #071d1b 60%, #04100e 100%);
            color: #fff;
            border: 2px solid rgba(195, 153, 108, 0.45);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        #santinoPrintPassCard .brand-sub { font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; color: #dfbe8d; }
        #santinoPrintPassCard .brand-title { font-size: 20px; font-weight: 900; margin: 4px 0 16px; color: #ffffff; letter-spacing: 0.5px; }
        #santinoPrintPassCard .qr-display-surface { background: #ffffff; padding: 16px; border-radius: 14px; display: inline-block; box-shadow: 0 8px 24px rgba(0,0,0,0.25); margin-bottom: 16px; }
        #santinoPrintPassCard .card-info-badge { background: rgba(0,0,0,0.3); border: 1px solid rgba(195,153,108,0.3); border-radius: 10px; padding: 8px 14px; margin-top: 10px; }

        @media print {
            body * { visibility: hidden !important; }
            #santinoPrintPassCard, #santinoPrintPassCard * { visibility: visible !important; }
            #santinoPrintPassCard {
                position: absolute !important;
                left: 50% !important;
                top: 50px !important;
                transform: translateX(-50%) !important;
                box-shadow: none !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
        </style>

        <div class="wrap santino-qr-admin-wrap">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #00625d; margin: 0; display: flex; align-items: center; gap: 10px;">
                        ☕ Santino Club QR Code Generator
                    </h1>
                    <p style="margin: 4px 0 0; color: #64748b;">Generate printable digital pass QR codes for members, counter check-in, or free vouchers.</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="<?php echo admin_url( 'edit.php?post_type=santino_member' ); ?>" class="button">← Back to Members</a>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">
                <!-- Left: Controls & Preset Selectors -->
                <div class="sqr-card">
                    <h2 style="font-size: 17px; font-weight: 700; margin: 0 0 18px; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
                        ⚙️ QR Code Configuration
                    </h2>

                    <!-- 1. Quick Member Select -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #334155;">
                            Select Registered Member (Auto-fill)
                        </label>
                        <select id="memberSelector" style="width: 100%; max-width: 100%; padding: 8px 12px; border-radius: 6px; border: 1px solid #cbd5e1;" onchange="onMemberSelected(this)">
                            <option value="">-- Choose Member or Enter Custom Link Below --</option>
                            <?php foreach ( $all_members as $m ) :
                                $ph  = get_post_meta( $m->ID, '_santino_member_phone', true );
                                $mid = get_post_meta( $m->ID, '_santino_member_id', true );
                                $st  = intval( get_post_meta( $m->ID, '_santino_cup_stamps', true ) ?: 0 );
                                $sel = ( $m->ID === $selected_member_id ) ? 'selected' : '';
                            ?>
                                <option value="<?php echo esc_attr( $ph ?: $mid ); ?>" data-name="<?php echo esc_attr( $m->post_title ); ?>" data-mid="<?php echo esc_attr( $mid ); ?>" data-phone="<?php echo esc_attr( $ph ); ?>" data-stamps="<?php echo esc_attr( $st ); ?>" <?php echo $sel; ?>>
                                    <?php echo esc_html( $m->post_title ); ?> (ID: <?php echo esc_html( $mid ); ?> | Stamps: <?php echo $st; ?>/5)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- 2. QR Content Target URL/Text -->
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: 600; font-size: 13px; margin-bottom: 6px; color: #334155;">
                            QR Code Encoded Data (URL or Text) *
                        </label>
                        <input type="text" id="qrDataInput" value="<?php echo esc_attr( $init_text ); ?>" style="width: 100%; padding: 10px 12px; border-radius: 6px; border: 1px solid #cbd5e1; font-family: monospace; font-size: 13px;" oninput="updateQrCode()" />
                        <div style="font-size: 11px; color: #64748b; margin-top: 4px;">
                            Customers scanning this QR code will instantly land on this page or action.
                        </div>
                    </div>

                    <!-- 3. Quick Action Buttons -->
                    <div style="margin-bottom: 22px;">
                        <span style="font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 8px; display: block;">Quick Presets:</span>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <button type="button" class="button button-small" onclick="setPreset('portal')">🌐 Counter Check-In Portal</button>
                            <button type="button" class="button button-small" onclick="setPreset('menu')">☕ Digital Drinks Menu</button>
                            <button type="button" class="button button-small" onclick="setPreset('voucher')">🎁 Free Cup Voucher</button>
                        </div>
                    </div>

                    <!-- 4. Card Titles -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Card Header Title</label>
                            <input type="text" id="cardTitleInput" value="<?php echo esc_attr( $init_label ); ?>" style="width: 100%; padding: 6px 10px; border-radius: 6px; border: 1px solid #cbd5e1;" oninput="updateCardText()" />
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">Card Sub-Badge</label>
                            <input type="text" id="cardSubInput" value="<?php echo esc_attr( $init_sub ); ?>" style="width: 100%; padding: 6px 10px; border-radius: 6px; border: 1px solid #cbd5e1;" oninput="updateCardText()" />
                        </div>
                    </div>

                    <!-- 5. QR Code Styling & Colors -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 24px;">
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">QR Color</label>
                            <select id="qrColorInput" style="width: 100%; padding: 6px 10px; border-radius: 6px; border: 1px solid #cbd5e1;" onchange="updateQrCode()">
                                <option value="#00625d" selected>Santino Deep Teal (#00625d)</option>
                                <option value="#041a18">Dark Forest (#041a18)</option>
                                <option value="#8B4513">Espresso Brown (#8B4513)</option>
                                <option value="#000000">Classic Black (#000000)</option>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; font-weight: 600; font-size: 12px; margin-bottom: 4px; color: #334155;">QR Resolution Size</label>
                            <select id="qrSizeInput" style="width: 100%; padding: 6px 10px; border-radius: 6px; border: 1px solid #cbd5e1;" onchange="updateQrCode()">
                                <option value="180">Standard (180x180 px)</option>
                                <option value="240" selected>Medium / Card (240x240 px)</option>
                                <option value="320">High Res (320x320 px)</option>
                                <option value="450">Super Print (450x450 px)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Right: Live Preview & Export -->
                <div class="sqr-card" style="text-align: center;">
                    <h2 style="font-size: 17px; font-weight: 700; margin: 0 0 18px; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; text-align: left;">
                        🖨️ Live QR Pass Preview
                    </h2>

                    <!-- Printable Card Container -->
                    <div id="santinoPrintPassCard">
                        <div class="brand-sub" id="displaySub"><?php echo esc_html( $init_sub ); ?></div>
                        <h3 class="brand-title" id="displayTitle"><?php echo esc_html( $init_label ); ?></h3>

                        <div class="qr-display-surface">
                            <div id="santinoQrBox"></div>
                        </div>

                        <div class="card-info-badge">
                            <div style="font-size: 11px; text-transform: uppercase; color: #dfbe8d; letter-spacing: 1px; font-weight: bold;">
                                <span id="displayMemberId"><?php echo esc_html( $init_id_str ?: 'SNT-REG-••••' ); ?></span>
                            </div>
                            <div style="font-size: 13px; font-weight: 600; color: #ffffff; margin-top: 2px;" id="displayPhone">
                                <?php echo esc_html( $init_phone_str ?: 'Valid at all Santino cafes' ); ?>
                            </div>
                        </div>

                        <div style="font-size: 10px; color: rgba(255,255,255,0.6); margin-top: 14px;">
                            Scan at cafe counter to verify stamps &amp; redeem free coffee
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="margin-top: 24px; display: flex; justify-content: center; gap: 12px; flex-wrap: wrap;">
                        <button type="button" class="sqr-btn-primary" onclick="downloadQrPng()">
                            ⬇ Download PNG Image
                        </button>
                        <button type="button" class="sqr-btn-secondary" onclick="window.print()">
                            🖨️ Print Pass Card / Sticker
                        </button>
                        <button type="button" class="sqr-btn-secondary" onclick="copyQrLink()">
                            📋 Copy Encoded Link
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
        var qrObj = null;

        function updateQrCode() {
            var text = document.getElementById('qrDataInput').value.trim() || '<?php echo esc_js( home_url( '/membership/' ) ); ?>';
            var size = parseInt(document.getElementById('qrSizeInput').value, 10) || 240;
            var color = document.getElementById('qrColorInput').value || '#00625d';

            var box = document.getElementById('santinoQrBox');
            box.innerHTML = '';

            if (typeof QRCode !== 'undefined') {
                qrObj = new QRCode(box, {
                    text: text,
                    width: size,
                    height: size,
                    colorDark: color,
                    colorLight: '#ffffff',
                    correctLevel: QRCode.CorrectLevel.H
                });
            } else {
                box.innerHTML = '<img src="https://api.qrserver.com/v1/create-qr-code/?size=' + size + 'x' + size + '&color=' + color.replace('#','') + '&data=' + encodeURIComponent(text) + '" width="' + size + '" height="' + size + '" />';
            }
        }

        function updateCardText() {
            var title = document.getElementById('cardTitleInput').value;
            var sub = document.getElementById('cardSubInput').value;
            document.getElementById('displayTitle').innerText = title || 'SANTINO COFFEE CLUB';
            document.getElementById('displaySub').innerText = sub || 'REGULAR MEMBER PASS';
        }

        function onMemberSelected(sel) {
            var opt = sel.options[sel.selectedIndex];
            if (!opt.value) return;
            var phone = opt.getAttribute('data-phone') || '';
            var mid = opt.getAttribute('data-mid') || '';
            var name = opt.getAttribute('data-name') || '';

            var targetUrl = '<?php echo esc_js( home_url( '/membership/?query=' ) ); ?>' + encodeURIComponent(phone || mid);
            document.getElementById('qrDataInput').value = targetUrl;
            document.getElementById('displayMemberId').innerText = mid || 'SNT-REG-••••';
            document.getElementById('displayPhone').innerText = phone ? ('Phone: ' + phone) : name;
            document.getElementById('cardSubInput').value = 'MEMBER DIGITAL PASS';
            document.getElementById('displaySub').innerText = 'MEMBER DIGITAL PASS';
            updateQrCode();
        }

        function setPreset(type) {
            if (type === 'portal') {
                document.getElementById('qrDataInput').value = '<?php echo esc_js( home_url( '/membership/' ) ); ?>';
                document.getElementById('cardTitleInput').value = 'SANTINO COFFEE CLUB';
                document.getElementById('cardSubInput').value = 'SCAN TO LOG INVOICE';
                document.getElementById('displayMemberId').innerText = 'CAFE COUNTER CHECK-IN';
                document.getElementById('displayPhone').innerText = 'Log Invoices & Redeem Free Cups';
            } else if (type === 'menu') {
                document.getElementById('qrDataInput').value = '<?php echo esc_js( home_url( '/menu/' ) ); ?>';
                document.getElementById('cardTitleInput').value = 'SANTINO ROASTERY';
                document.getElementById('cardSubInput').value = 'DIGITAL DRINKS MENU';
                document.getElementById('displayMemberId').innerText = 'SPECIALTY COFFEE MENU';
                document.getElementById('displayPhone').innerText = 'Scan to browse handcrafted brews';
            } else if (type === 'voucher') {
                var vCode = prompt('Enter Free Coffee Voucher Code (e.g. FREE-CUP-9042):', 'FREE-CUP-');
                if (vCode) {
                    document.getElementById('qrDataInput').value = vCode;
                    document.getElementById('cardTitleInput').value = 'FREE 1 CUP COFFEE';
                    document.getElementById('cardSubInput').value = 'EXCLUSIVE VOUCHER';
                    document.getElementById('displayMemberId').innerText = vCode;
                    document.getElementById('displayPhone').innerText = 'Valid for 1 Handcrafted Drink';
                }
            }
            updateCardText();
            updateQrCode();
        }

        function downloadQrPng() {
            var canvas = document.querySelector('#santinoQrBox canvas');
            var img = document.querySelector('#santinoQrBox img');
            var dataUrl = canvas ? canvas.toDataURL('image/png') : (img ? img.src : '');
            if (dataUrl) {
                var a = document.createElement('a');
                a.href = dataUrl;
                a.download = 'santino-qr-code.png';
                a.click();
            } else {
                alert('QR Code image not ready yet.');
            }
        }

        function copyQrLink() {
            var input = document.getElementById('qrDataInput');
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value).then(function() {
                alert('Copied link: ' + input.value);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateQrCode();
        });
        </script>
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

    public static function get_default_daily_promotions() {
        return array(
            array( 'id' => 'promo_sun', 'schedule' => 'sunday',    'day' => 'Sunday',    'title' => '3 + 1 FREE', 'buy_qty' => 3, 'free_qty' => 1, 'selected_items' => array(), 'custom_items' => 'Hot or Iced Chocolate',             'items' => 'Hot or Iced Chocolate',             'badge' => 'Weekend Kickoff',  'paid_cups' => 3, 'start_date' => '', 'end_date' => '', 'active' => true ),
            array( 'id' => 'promo_mon', 'schedule' => 'monday',    'day' => 'Monday',    'title' => '3 + 1 FREE', 'buy_qty' => 3, 'free_qty' => 1, 'selected_items' => array(), 'custom_items' => 'Hot or Cold Latte',                 'items' => 'Hot or Cold Latte',                 'badge' => 'Monday Fuel',      'paid_cups' => 3, 'start_date' => '', 'end_date' => '', 'active' => true ),
            array( 'id' => 'promo_tue', 'schedule' => 'tuesday',   'day' => 'Tuesday',   'title' => '3 + 1 FREE', 'buy_qty' => 3, 'free_qty' => 1, 'selected_items' => array(), 'custom_items' => 'Mocha / Caramel / Hazelnut Frappe', 'items' => 'Mocha / Caramel / Hazelnut Frappe', 'badge' => 'Frappe Mania',     'paid_cups' => 3, 'start_date' => '', 'end_date' => '', 'active' => true ),
            array( 'id' => 'promo_wed', 'schedule' => 'wednesday', 'day' => 'Wednesday', 'title' => '3 + 1 FREE', 'buy_qty' => 3, 'free_qty' => 1, 'selected_items' => array(), 'custom_items' => 'Chai Latte',                        'items' => 'Chai Latte',                        'badge' => 'Midweek Comfort',  'paid_cups' => 3, 'start_date' => '', 'end_date' => '', 'active' => true ),
            array( 'id' => 'promo_thu', 'schedule' => 'thursday',  'day' => 'Thursday',  'title' => '3 + 1 FREE', 'buy_qty' => 3, 'free_qty' => 1, 'selected_items' => array( 'Hot Cappuccino' ), 'custom_items' => '',                   'items' => 'Hot Cappuccino',                    'badge' => 'Classic Thursday', 'paid_cups' => 3, 'start_date' => '', 'end_date' => '', 'active' => true ),
            array( 'id' => 'promo_fri', 'schedule' => 'friday',    'day' => 'Friday',    'title' => '3 + 1 FREE', 'buy_qty' => 3, 'free_qty' => 1, 'selected_items' => array( 'Iced Mocha' ),     'custom_items' => '',                   'items' => 'Iced Mocha',                        'badge' => 'Friday Chill',     'paid_cups' => 3, 'start_date' => '', 'end_date' => '', 'active' => true ),
            array( 'id' => 'promo_sat', 'schedule' => 'saturday',  'day' => 'Saturday',  'title' => '3 + 1 FREE', 'buy_qty' => 3, 'free_qty' => 1, 'selected_items' => array( 'Iced Latte' ),     'custom_items' => '',                   'items' => 'Iced Latte',                        'badge' => 'Weekend Vibes',    'paid_cups' => 3, 'start_date' => '', 'end_date' => '', 'active' => true ),
        );
    }

    public static function get_schedule_label( $schedule, $start_date = '', $end_date = '' ) {
        $map = array(
            'sunday'     => 'Sunday',
            'monday'     => 'Monday',
            'tuesday'    => 'Tuesday',
            'wednesday'  => 'Wednesday',
            'thursday'   => 'Thursday',
            'friday'     => 'Friday',
            'saturday'   => 'Saturday',
            'everyday'   => 'Every Day',
            'weekends'   => 'Weekends (Fri-Sat)',
            'date_range' => ( $start_date || $end_date ) ? trim( $start_date . ' to ' . $end_date ) : 'Custom Dates',
        );
        return $map[ $schedule ] ?? ucfirst( $schedule );
    }

    public static function get_daily_promotions() {
        $defaults = self::get_default_daily_promotions();
        $saved    = get_option( 'santino_daily_promotions', array() );
        if ( ! is_array( $saved ) || empty( $saved ) ) {
            return $defaults;
        }
        $normalized = array();
        foreach ( $saved as $k => $row ) {
            if ( ! is_array( $row ) ) {
                continue;
            }
            $sched      = sanitize_text_field( $row['schedule'] ?? ( is_string( $k ) && ! is_numeric( $k ) ? $k : 'everyday' ) );
            $start_date = sanitize_text_field( $row['start_date'] ?? '' );
            $end_date   = sanitize_text_field( $row['end_date'] ?? '' );
            $buy_qty    = max( 1, intval( $row['buy_qty'] ?? ( $row['paid_cups'] ?? 3 ) ) );
            $free_qty   = max( 0, intval( $row['free_qty'] ?? 1 ) );
            $sel_items  = isset( $row['selected_items'] ) && is_array( $row['selected_items'] )
                ? array_values( array_filter( array_map( 'sanitize_text_field', $row['selected_items'] ) ) )
                : array();
            $custom_it  = sanitize_text_field( $row['custom_items'] ?? '' );
            $items_str  = sanitize_text_field( $row['items'] ?? '' );
            if ( empty( $items_str ) ) {
                $parts     = $custom_it !== '' ? array_merge( $sel_items, array( $custom_it ) ) : $sel_items;
                $items_str = implode( ', ', $parts );
            }
            if ( empty( $sel_items ) && $custom_it === '' && $items_str !== '' ) {
                $custom_it = $items_str;
            }
            $normalized[] = array(
                'id'             => sanitize_text_field( $row['id'] ?? 'promo_' . uniqid() ),
                'schedule'       => $sched,
                'day'            => self::get_schedule_label( $sched, $start_date, $end_date ),
                'title'          => sanitize_text_field( $row['title'] ?? ( $free_qty > 0 ? $buy_qty . ' + ' . $free_qty . ' FREE' : 'Buy ' . $buy_qty ) ),
                'buy_qty'        => $buy_qty,
                'free_qty'       => $free_qty,
                'selected_items' => $sel_items,
                'custom_items'   => $custom_it,
                'items'          => $items_str,
                'badge'          => sanitize_text_field( $row['badge'] ?? '' ),
                'paid_cups'      => max( 1, intval( $row['paid_cups'] ?? $buy_qty ) ),
                'start_date'     => $start_date,
                'end_date'       => $end_date,
                'active'         => ! empty( $row['active'] ),
            );
        }
        return ! empty( $normalized ) ? $normalized : $defaults;
    }

    public static function get_today_dhaka_date() {
        try {
            $dt = new DateTime( 'now', new DateTimeZone( 'Asia/Dhaka' ) );
            return $dt->format( 'Y-m-d' );
        } catch ( Exception $e ) {
            return wp_date( 'Y-m-d' );
        }
    }

    public static function is_promo_active_today( $promo, $today_key = null, $today_date = null ) {
        if ( empty( $promo['active'] ) ) {
            return false;
        }
        $today_key  = $today_key ?: self::get_today_dhaka_key();
        $today_date = $today_date ?: self::get_today_dhaka_date();
        $sched      = $promo['schedule'] ?? 'everyday';

        if ( $sched === 'everyday' ) {
            return true;
        }
        if ( $sched === 'weekends' ) {
            return in_array( $today_key, array( 'friday', 'saturday' ), true );
        }
        if ( $sched === 'date_range' ) {
            $s = $promo['start_date'] ?? '';
            $e = $promo['end_date'] ?? '';
            if ( $s && $today_date < $s ) return false;
            if ( $e && $today_date > $e ) return false;
            return true;
        }
        return $sched === $today_key;
    }

    public static function get_today_dhaka_key() {
        try {
            $dt = new DateTime( 'now', new DateTimeZone( 'Asia/Dhaka' ) );
            return strtolower( $dt->format( 'l' ) );
        } catch ( Exception $e ) {
            return strtolower( wp_date( 'l' ) );
        }
    }

    public static function render_daily_promotions_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Permission denied' );
        }

        $notice = '';
        if ( isset( $_POST['santino_reset_promos'] ) && check_admin_referer( 'santino_save_daily_promos', 'santino_promo_nonce' ) ) {
            update_option( 'santino_daily_promotions', self::get_default_daily_promotions() );
            $notice = '<div class="notice notice-success is-dismissible"><p>Promotions reset to 7-Day defaults.</p></div>';
        } elseif ( isset( $_POST['santino_save_promos'] ) && check_admin_referer( 'santino_save_daily_promos', 'santino_promo_nonce' ) ) {
            $posted = isset( $_POST['promos'] ) && is_array( $_POST['promos'] ) ? $_POST['promos'] : array();
            $clean  = array();
            foreach ( $posted as $row ) {
                if ( ! is_array( $row ) ) continue;
                $buy_qty    = max( 1, intval( $row['buy_qty'] ?? ( $row['paid_cups'] ?? 3 ) ) );
                $free_qty   = max( 0, intval( $row['free_qty'] ?? 1 ) );
                $auto_title = $free_qty > 0 ? $buy_qty . ' + ' . $free_qty . ' FREE' : 'Buy ' . $buy_qty;
                $title      = sanitize_text_field( $row['title'] ?? '' );
                $sel_items  = isset( $row['selected_items'] ) && is_array( $row['selected_items'] )
                    ? array_values( array_filter( array_map( 'sanitize_text_field', $row['selected_items'] ) ) )
                    : array();
                $custom_it  = sanitize_text_field( $row['custom_items'] ?? '' );
                $item_parts = $custom_it !== '' ? array_merge( $sel_items, array( $custom_it ) ) : $sel_items;
                $items      = implode( ', ', array_unique( array_filter( $item_parts ) ) );
                if ( $items === '' && ! empty( $row['items'] ) ) {
                    $items = sanitize_text_field( $row['items'] );
                }
                if ( empty( $title ) && empty( $items ) ) continue;
                $sched      = sanitize_text_field( $row['schedule'] ?? 'everyday' );
                $start_date = sanitize_text_field( $row['start_date'] ?? '' );
                $end_date   = sanitize_text_field( $row['end_date'] ?? '' );
                $paid_cups  = max( 1, intval( $row['paid_cups'] ?? $buy_qty ) );
                $clean[]    = array(
                    'id'             => sanitize_text_field( $row['id'] ?? 'promo_' . wp_generate_password( 6, false ) ),
                    'schedule'       => $sched,
                    'day'            => self::get_schedule_label( $sched, $start_date, $end_date ),
                    'title'          => $title ?: $auto_title,
                    'buy_qty'        => $buy_qty,
                    'free_qty'       => $free_qty,
                    'selected_items' => $sel_items,
                    'custom_items'   => $custom_it,
                    'items'          => $items ?: 'Signature Coffee',
                    'badge'          => sanitize_text_field( $row['badge'] ?? '' ),
                    'paid_cups'      => $paid_cups,
                    'start_date'     => $start_date,
                    'end_date'       => $end_date,
                    'active'         => ! empty( $row['active'] ),
                );
            }
            update_option( 'santino_daily_promotions', $clean );
            $notice = '<div class="notice notice-success is-dismissible"><p>Dynamic Promotions saved successfully (' . count( $clean ) . ' promotions).</p></div>';
        }

        $promos       = self::get_daily_promotions();
        $menu_choices = self::get_order_item_choices();
        $today_key    = self::get_today_dhaka_key();
        $today_date   = self::get_today_dhaka_date();
        $schedules    = array(
            'sunday'     => 'Sunday',
            'monday'     => 'Monday',
            'tuesday'    => 'Tuesday',
            'wednesday'  => 'Wednesday',
            'thursday'   => 'Thursday',
            'friday'     => 'Friday',
            'saturday'   => 'Saturday',
            'everyday'   => 'Every Day',
            'weekends'   => 'Weekends (Fri-Sat)',
            'date_range' => 'Custom Date Range',
        );
        $active_today_count = 0;
        foreach ( $promos as $pr ) {
            if ( self::is_promo_active_today( $pr, $today_key, $today_date ) ) {
                $active_today_count++;
            }
        }
        ?>
        <style>
        .santino-promo-admin-wrap { max-width: 100%; }
        .santino-promo-hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            background: linear-gradient(135deg, #004d49 0%, #00625d 60%, #0d2b28 100%);
            color: #fff;
            padding: 20px 24px;
            border-radius: 12px;
            margin: 14px 0 18px;
            box-shadow: 0 4px 16px rgba(0, 77, 73, 0.16);
        }
        .santino-promo-hero h2 { margin: 0 0 4px; color: #fff; font-size: 20px; font-weight: 700; letter-spacing: -0.2px; }
        .santino-promo-hero p { margin: 0; color: rgba(255,255,255,0.82); font-size: 13px; }
        .santino-promo-hero-actions { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
        .santino-hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.15s ease;
            border: 1px solid rgba(255,255,255,0.28);
        }
        .santino-hero-btn-gold { background: #dfbe8d; color: #041a18; border-color: #dfbe8d; }
        .santino-hero-btn-gold:hover { background: #e8cda3; color: #041a18; }
        .santino-hero-btn-ghost { background: rgba(255,255,255,0.12); color: #fff; }
        .santino-hero-btn-ghost:hover { background: rgba(255,255,255,0.22); color: #fff; }
        .santino-promo-kpis {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }
        .santino-kpi-card {
            background: #fff;
            border: 1px solid #dcdcde;
            border-left: 4px solid #00625d;
            border-radius: 10px;
            padding: 14px 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .santino-kpi-card.is-green { border-left-color: #00a32a; }
        .santino-kpi-card.is-gold { border-left-color: #dba617; }
        .santino-kpi-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.6px; color: #646970; font-weight: 600; margin-bottom: 4px; }
        .santino-kpi-val { font-size: 22px; font-weight: 700; color: #1d2327; line-height: 1.2; }
        .santino-kpi-sub { font-size: 11.5px; color: #646970; margin-top: 3px; }
        .santino-promo-card {
            background: #fff;
            border: 1px solid #dcdcde;
            border-radius: 12px;
            overflow: visible;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        #santinoPromoTable { border: 0; border-radius: 12px; overflow: visible; }
        #santinoPromoTable thead th {
            background: #f6f7f7;
            font-weight: 600;
            color: #1d2327;
            padding: 12px 14px;
            border-bottom: 2px solid #00625d;
            font-size: 12.5px;
        }
        #santinoPromoTable tbody tr.santino-promo-row td {
            padding: 14px;
            vertical-align: top;
            border-bottom: 1px solid #f0f0f1;
        }
        #santinoPromoTable tbody tr.santino-promo-row.is-today-row {
            background: #f0faf7 !important;
        }
        #santinoPromoTable tbody tr.santino-promo-row.is-today-row td:first-child {
            box-shadow: inset 4px 0 0 #00a32a;
        }
        .santino-today-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 6px;
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #86efac;
            border-radius: 999px;
            padding: 2px 9px;
            font-size: 11px;
            font-weight: 700;
        }
        .santino-qty-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 6px;
            align-items: end;
            margin-bottom: 7px;
        }
        .santino-qty-box label { display: block; font-size: 10.5px; font-weight: 600; color: #50575e; text-transform: uppercase; margin-bottom: 2px; }
        .santino-qty-box input { width: 100%; text-align: center; font-weight: 700; border-radius: 6px; }
        .santino-qty-plus { font-weight: 800; color: #00625d; padding-bottom: 6px; font-size: 14px; }
        .santino-picker-wrap { position: relative; }
        .santino-selected-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-bottom: 6px;
            min-height: 24px;
        }
        .santino-item-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #e6f4f1;
            color: #004d49;
            border: 1px solid #b5dcd5;
            border-radius: 999px;
            padding: 2px 9px;
            font-size: 11.5px;
            font-weight: 600;
        }
        .santino-item-pill button {
            background: none;
            border: 0;
            color: #00625d;
            cursor: pointer;
            font-weight: 800;
            padding: 0 2px;
            line-height: 1;
            font-size: 13px;
        }
        .santino-picker-toggle {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px !important;
            border-radius: 6px !important;
        }
        .santino-picker-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            width: 100%;
            min-width: 260px;
            max-width: 340px;
            background: #fff;
            border: 1px solid #c3c4c7;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.14);
            z-index: 999;
            padding: 8px;
        }
        .santino-picker-dropdown.is-open { display: block; }
        .santino-picker-search { width: 100%; margin-bottom: 6px; font-size: 12px; border-radius: 6px; }
        .santino-picker-list { max-height: 180px; overflow-y: auto; display: flex; flex-direction: column; gap: 3px; }
        .santino-picker-option {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 4px 6px;
            border-radius: 5px;
            font-size: 12px;
            cursor: pointer;
            margin: 0;
        }
        .santino-picker-option:hover { background: #f0faf7; }
        .santino-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 22px;
        }
        .santino-switch input { opacity: 0; width: 0; height: 0; }
        .santino-switch-slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #c3c4c7;
            transition: .2s;
            border-radius: 22px;
        }
        .santino-switch-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .2s;
            border-radius: 50%;
            box-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }
        .santino-switch input:checked + .santino-switch-slider { background-color: #00a32a; }
        .santino-switch input:checked + .santino-switch-slider:before { transform: translateX(18px); }
        .santino-promo-footer-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            background: #f6f7f7;
            border-top: 1px solid #dcdcde;
            border-radius: 0 0 12px 12px;
        }
        .santino-save-btn {
            background: #00625d !important;
            border-color: #004d49 !important;
            padding: 4px 18px !important;
            font-weight: 600 !important;
            border-radius: 6px !important;
        }
        .santino-save-btn:hover { background: #004d49 !important; }
        </style>

        <div class="wrap santino-promo-admin-wrap">
            <h1 class="wp-heading-inline"><?php esc_html_e( 'Daily Promotions', 'santino' ); ?></h1>
            <hr class="wp-header-end">

            <?php echo $notice; ?>

            <div class="santino-promo-hero">
                <div>
                    <h2>☕ Santino Daily Promotions &amp; Offer Builder</h2>
                    <p>Configure dynamic Buy + Free quantities, cafe menu items, schedules, and Dhaka-time live offers.</p>
                </div>
                <div class="santino-promo-hero-actions">
                    <a href="#" id="santinoAddPromoRowBtn" class="santino-hero-btn santino-hero-btn-gold">+ Add New Promotion</a>
                    <a href="<?php echo esc_url( home_url( '/offers/' ) ); ?>" target="_blank" class="santino-hero-btn santino-hero-btn-ghost">View Offers Page ↗</a>
                </div>
            </div>

            <div class="santino-promo-kpis">
                <div class="santino-kpi-card">
                    <div class="santino-kpi-label">Total Configured Offers</div>
                    <div class="santino-kpi-val"><?php echo count( $promos ); ?></div>
                    <div class="santino-kpi-sub">Across weekly &amp; custom schedules</div>
                </div>
                <div class="santino-kpi-card is-green">
                    <div class="santino-kpi-label">Live Today (Asia/Dhaka)</div>
                    <div class="santino-kpi-val"><?php echo esc_html( $active_today_count ); ?> Active</div>
                    <div class="santino-kpi-sub"><?php echo esc_html( ucfirst( $today_key ) . ', ' . $today_date ); ?></div>
                </div>
                <div class="santino-kpi-card is-gold">
                    <div class="santino-kpi-label">Dynamic Cafe Menu Items</div>
                    <div class="santino-kpi-val"><?php echo count( $menu_choices ); ?></div>
                    <div class="santino-kpi-sub">Synced from Handcrafted Menu</div>
                </div>
            </div>

            <form method="post" class="santino-promo-card">
                <?php wp_nonce_field( 'santino_save_daily_promos', 'santino_promo_nonce' ); ?>
                <table class="wp-list-table widefat fixed striped table-view-list" id="santinoPromoTable">
                    <thead>
                        <tr>
                            <th scope="col" class="manage-column" style="width:175px;"><?php esc_html_e( 'Schedule', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width:205px;"><?php esc_html_e( 'Offer Qty & Title', 'santino' ); ?></th>
                            <th scope="col" class="manage-column"><?php esc_html_e( 'Featured Beverage / Items', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width:155px;"><?php esc_html_e( 'Badge Tag', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width:80px; text-align:center;"><?php esc_html_e( 'Stamps', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width:75px; text-align:center;"><?php esc_html_e( 'Active', 'santino' ); ?></th>
                            <th scope="col" class="manage-column" style="width:75px; text-align:center;"><?php esc_html_e( 'Action', 'santino' ); ?></th>
                        </tr>
                    </thead>
                    <tbody id="santinoPromoTableBody">
                        <?php foreach ( $promos as $idx => $p ) :
                            $is_today  = self::is_promo_active_today( $p, $today_key, $today_date );
                            $sched     = $p['schedule'] ?? 'everyday';
                            $buy_qty   = max( 1, intval( $p['buy_qty'] ?? ( $p['paid_cups'] ?? 3 ) ) );
                            $free_qty  = max( 0, intval( $p['free_qty'] ?? 1 ) );
                            $sel_items = isset( $p['selected_items'] ) && is_array( $p['selected_items'] ) ? $p['selected_items'] : array();
                            $custom_it = $p['custom_items'] ?? '';
                            if ( empty( $sel_items ) && $custom_it === '' && ! empty( $p['items'] ) ) {
                                $custom_it = $p['items'];
                            }
                        ?>
                            <tr class="santino-promo-row<?php echo $is_today ? ' is-today-row' : ''; ?>">
                                <td>
                                    <input type="hidden" name="promos[<?php echo $idx; ?>][id]" value="<?php echo esc_attr( $p['id'] ); ?>">
                                    <select name="promos[<?php echo $idx; ?>][schedule]" class="santino-sched-select" style="width:100%; border-radius:6px;">
                                        <?php foreach ( $schedules as $sk => $sl ) : ?>
                                            <option value="<?php echo esc_attr( $sk ); ?>" <?php selected( $sched, $sk ); ?>><?php echo esc_html( $sl ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="santino-date-range-wrap" style="margin-top:6px; display:<?php echo $sched === 'date_range' ? 'flex' : 'none'; ?>; flex-direction:column; gap:4px;">
                                        <input type="date" name="promos[<?php echo $idx; ?>][start_date]" value="<?php echo esc_attr( $p['start_date'] ?? '' ); ?>" style="width:100%; border-radius:6px;">
                                        <input type="date" name="promos[<?php echo $idx; ?>][end_date]" value="<?php echo esc_attr( $p['end_date'] ?? '' ); ?>" style="width:100%; border-radius:6px;">
                                    </div>
                                    <?php if ( $is_today ) : ?>
                                        <div><span class="santino-today-pill">● LIVE TODAY</span></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="santino-qty-grid">
                                        <div class="santino-qty-box">
                                            <label>Buy Qty</label>
                                            <input type="number" min="1" max="20" name="promos[<?php echo $idx; ?>][buy_qty]" value="<?php echo esc_attr( $buy_qty ); ?>" class="small-text santino-qty-buy">
                                        </div>
                                        <div class="santino-qty-plus">+</div>
                                        <div class="santino-qty-box">
                                            <label>Free Qty</label>
                                            <input type="number" min="0" max="10" name="promos[<?php echo $idx; ?>][free_qty]" value="<?php echo esc_attr( $free_qty ); ?>" class="small-text santino-qty-free">
                                        </div>
                                    </div>
                                    <input type="text" name="promos[<?php echo $idx; ?>][title]" value="<?php echo esc_attr( $p['title'] ); ?>" class="regular-text santino-promo-title" style="width:100%; border-radius:6px; font-weight:600;" placeholder="3 + 1 FREE" required>
                                </td>
                                <td>
                                    <div class="santino-picker-wrap">
                                        <div class="santino-selected-pills">
                                            <?php foreach ( $sel_items as $si ) : ?>
                                                <span class="santino-item-pill" data-val="<?php echo esc_attr( $si ); ?>"><?php echo esc_html( $si ); ?> <button type="button" class="santino-pill-remove" aria-label="Remove">&times;</button></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <button type="button" class="button button-small santino-picker-toggle">
                                            <span class="dashicons dashicons-coffee" style="font-size:14px; width:14px; height:14px; line-height:1.3;"></span>
                                            Select Menu Items (<?php echo count( $sel_items ); ?>)
                                        </button>
                                        <div class="santino-picker-dropdown">
                                            <input type="text" class="santino-picker-search" placeholder="Search cafe menu items...">
                                            <div class="santino-picker-list">
                                                <?php foreach ( $menu_choices as $mc ) : ?>
                                                    <label class="santino-picker-option">
                                                        <input type="checkbox" name="promos[<?php echo $idx; ?>][selected_items][]" value="<?php echo esc_attr( $mc ); ?>" class="santino-picker-cb" <?php checked( in_array( $mc, $sel_items, true ) ); ?>>
                                                        <span><?php echo esc_html( $mc ); ?></span>
                                                    </label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="text" name="promos[<?php echo $idx; ?>][custom_items]" value="<?php echo esc_attr( $custom_it ); ?>" class="regular-text" style="width:100%; margin-top:7px; font-size:12px; border-radius:6px;" placeholder="Optional custom item / note (e.g. Hot or Iced)">
                                </td>
                                <td><input type="text" name="promos[<?php echo $idx; ?>][badge]" value="<?php echo esc_attr( $p['badge'] ); ?>" class="regular-text" style="width:100%; border-radius:6px;" placeholder="SPECIAL"></td>
                                <td style="text-align:center;"><input type="number" min="1" max="20" name="promos[<?php echo $idx; ?>][paid_cups]" value="<?php echo esc_attr( intval( $p['paid_cups'] ?? $buy_qty ) ); ?>" class="small-text santino-paid-cups" style="width:62px; text-align:center; font-weight:700; border-radius:6px;"></td>
                                <td style="text-align:center; padding-top:18px;">
                                    <label class="santino-switch">
                                        <input type="checkbox" name="promos[<?php echo $idx; ?>][active]" value="1" <?php checked( ! empty( $p['active'] ) ); ?>>
                                        <span class="santino-switch-slider"></span>
                                    </label>
                                </td>
                                <td style="text-align:center; padding-top:16px;"><button type="button" class="button button-small button-link-delete santino-del-promo-btn"><?php esc_html_e( 'Delete', 'santino' ); ?></button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="santino-promo-footer-bar">
                    <div style="display:flex; gap:10px; align-items:center;">
                        <button type="submit" name="santino_save_promos" class="button button-primary santino-save-btn"><?php esc_html_e( 'Save All Promotions', 'santino' ); ?></button>
                        <button type="submit" name="santino_reset_promos" class="button" onclick="return confirm('Reset to default 7-day 3+1 FREE offers?');"><?php esc_html_e( 'Reset Defaults', 'santino' ); ?></button>
                    </div>
                    <span style="font-size:12px; color:#646970;">Changes reflect immediately on <strong>/offers/</strong>, <strong>Today's Offer Tab</strong>, and <strong>Invoice Logs</strong>.</span>
                </div>
            </form>
        </div>
        <script>
        (function() {
            let nextIdx = <?php echo count( $promos ); ?>;
            const tbody = document.getElementById('santinoPromoTableBody');
            const addBtn = document.getElementById('santinoAddPromoRowBtn');
            const menuChoices = <?php echo wp_json_encode( $menu_choices ); ?>;

            function escapeHtml(str) {
                return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
            }

            function buildMenuCheckboxesHtml(idx) {
                return menuChoices.map(function(item) {
                    const esc = escapeHtml(item);
                    return '<label class="santino-picker-option">' +
                        '<input type="checkbox" name="promos[' + idx + '][selected_items][]" value="' + esc + '" class="santino-picker-cb">' +
                        '<span>' + esc + '</span>' +
                    '</label>';
                }).join('');
            }

            function syncPickerPills(row) {
                const pillsBox = row.querySelector('.santino-selected-pills');
                const toggleBtn = row.querySelector('.santino-picker-toggle');
                const cbs = row.querySelectorAll('.santino-picker-cb:checked');
                if (!pillsBox) return;
                pillsBox.innerHTML = '';
                cbs.forEach(function(cb) {
                    const pill = document.createElement('span');
                    pill.className = 'santino-item-pill';
                    pill.setAttribute('data-val', cb.value);
                    pill.innerHTML = escapeHtml(cb.value) + ' <button type="button" class="santino-pill-remove" aria-label="Remove">&times;</button>';
                    pill.querySelector('.santino-pill-remove').addEventListener('click', function() {
                        cb.checked = false;
                        syncPickerPills(row);
                    });
                    pillsBox.appendChild(pill);
                });
                if (toggleBtn) {
                    toggleBtn.innerHTML = '<span class="dashicons dashicons-coffee" style="font-size:14px; width:14px; height:14px; line-height:1.3;"></span> Select Menu Items (' + cbs.length + ')';
                }
            }

            function bindRowEvents(row) {
                const sel = row.querySelector('.santino-sched-select');
                const dateWrap = row.querySelector('.santino-date-range-wrap');
                if (sel && dateWrap) {
                    sel.addEventListener('change', function() {
                        dateWrap.style.display = this.value === 'date_range' ? 'flex' : 'none';
                    });
                }

                const buyInput = row.querySelector('.santino-qty-buy');
                const freeInput = row.querySelector('.santino-qty-free');
                const titleInput = row.querySelector('.santino-promo-title');
                const stampsInput = row.querySelector('.santino-paid-cups');
                function syncQtyFields() {
                    const b = Math.max(1, parseInt(buyInput ? buyInput.value : 3, 10) || 3);
                    const f = Math.max(0, parseInt(freeInput ? freeInput.value : 1, 10) || 0);
                    if (titleInput) {
                        titleInput.value = f > 0 ? (b + ' + ' + f + ' FREE') : ('Buy ' + b);
                    }
                    if (stampsInput) {
                        stampsInput.value = b;
                    }
                }
                if (buyInput) buyInput.addEventListener('input', syncQtyFields);
                if (freeInput) freeInput.addEventListener('input', syncQtyFields);

                const toggleBtn = row.querySelector('.santino-picker-toggle');
                const dropdown = row.querySelector('.santino-picker-dropdown');
                const searchInput = row.querySelector('.santino-picker-search');
                if (toggleBtn && dropdown) {
                    toggleBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        document.querySelectorAll('.santino-picker-dropdown.is-open').forEach(function(d) {
                            if (d !== dropdown) d.classList.remove('is-open');
                        });
                        dropdown.classList.toggle('is-open');
                        if (dropdown.classList.contains('is-open') && searchInput) {
                            searchInput.focus();
                        }
                    });
                    dropdown.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                }
                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const q = this.value.toLowerCase();
                        row.querySelectorAll('.santino-picker-option').forEach(function(opt) {
                            opt.style.display = opt.textContent.toLowerCase().indexOf(q) !== -1 ? 'flex' : 'none';
                        });
                    });
                }
                row.querySelectorAll('.santino-picker-cb').forEach(function(cb) {
                    cb.addEventListener('change', function() {
                        syncPickerPills(row);
                    });
                });
                row.querySelectorAll('.santino-pill-remove').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const pill = btn.closest('.santino-item-pill');
                        const val = pill ? pill.getAttribute('data-val') : '';
                        row.querySelectorAll('.santino-picker-cb').forEach(function(cb) {
                            if (cb.value === val) cb.checked = false;
                        });
                        syncPickerPills(row);
                    });
                });

                const delBtn = row.querySelector('.santino-del-promo-btn');
                if (delBtn) {
                    delBtn.addEventListener('click', function() {
                        row.remove();
                    });
                }
            }

            document.addEventListener('click', function() {
                document.querySelectorAll('.santino-picker-dropdown.is-open').forEach(function(d) {
                    d.classList.remove('is-open');
                });
            });

            tbody.querySelectorAll('.santino-promo-row').forEach(bindRowEvents);

            addBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const idx = nextIdx++;
                const tr = document.createElement('tr');
                tr.className = 'santino-promo-row';
                tr.innerHTML =
                    '<td>' +
                        '<input type="hidden" name="promos[' + idx + '][id]" value="promo_' + Date.now() + '_' + idx + '">' +
                        '<select name="promos[' + idx + '][schedule]" class="santino-sched-select" style="width:100%; border-radius:6px;">' +
                            '<option value="everyday">Every Day</option>' +
                            '<option value="sunday">Sunday</option>' +
                            '<option value="monday">Monday</option>' +
                            '<option value="tuesday">Tuesday</option>' +
                            '<option value="wednesday">Wednesday</option>' +
                            '<option value="thursday">Thursday</option>' +
                            '<option value="friday">Friday</option>' +
                            '<option value="saturday">Saturday</option>' +
                            '<option value="weekends">Weekends (Fri-Sat)</option>' +
                            '<option value="date_range">Custom Date Range</option>' +
                        '</select>' +
                        '<div class="santino-date-range-wrap" style="margin-top:6px; display:none; flex-direction:column; gap:4px;">' +
                            '<input type="date" name="promos[' + idx + '][start_date]" style="width:100%; font-size:11px; border-radius:6px;">' +
                            '<input type="date" name="promos[' + idx + '][end_date]" style="width:100%; font-size:11px; border-radius:6px;">' +
                        '</div>' +
                    '</td>' +
                    '<td>' +
                        '<div class="santino-qty-grid">' +
                            '<div class="santino-qty-box"><label>Buy Qty</label><input type="number" min="1" max="20" name="promos[' + idx + '][buy_qty]" value="3" class="small-text santino-qty-buy"></div>' +
                            '<div class="santino-qty-plus">+</div>' +
                            '<div class="santino-qty-box"><label>Free Qty</label><input type="number" min="0" max="10" name="promos[' + idx + '][free_qty]" value="1" class="small-text santino-qty-free"></div>' +
                        '</div>' +
                        '<input type="text" name="promos[' + idx + '][title]" value="3 + 1 FREE" class="regular-text santino-promo-title" style="width:100%; border-radius:6px; font-weight:600;" required>' +
                    '</td>' +
                    '<td>' +
                        '<div class="santino-picker-wrap">' +
                            '<div class="santino-selected-pills"></div>' +
                            '<button type="button" class="button button-small santino-picker-toggle"><span class="dashicons dashicons-coffee" style="font-size:14px; width:14px; height:14px; line-height:1.3;"></span> Select Menu Items (0)</button>' +
                            '<div class="santino-picker-dropdown">' +
                                '<input type="text" class="santino-picker-search" placeholder="Search cafe menu items...">' +
                                '<div class="santino-picker-list">' + buildMenuCheckboxesHtml(idx) + '</div>' +
                            '</div>' +
                        '</div>' +
                        '<input type="text" name="promos[' + idx + '][custom_items]" value="" class="regular-text" style="width:100%; margin-top:7px; font-size:12px; border-radius:6px;" placeholder="Optional custom item / note (e.g. Hot or Iced)">' +
                    '</td>' +
                    '<td><input type="text" name="promos[' + idx + '][badge]" value="NEW OFFER" class="regular-text" style="width:100%; border-radius:6px;"></td>' +
                    '<td style="text-align:center;"><input type="number" min="1" max="20" name="promos[' + idx + '][paid_cups]" value="3" class="small-text santino-paid-cups" style="width:62px; text-align:center; font-weight:700; border-radius:6px;"></td>' +
                    '<td style="text-align:center; padding-top:18px;"><label class="santino-switch"><input type="checkbox" name="promos[' + idx + '][active]" value="1" checked><span class="santino-switch-slider"></span></label></td>' +
                    '<td style="text-align:center; padding-top:16px;"><button type="button" class="button button-small button-link-delete santino-del-promo-btn">Delete</button></td>';
                tbody.appendChild(tr);
                bindRowEvents(tr);
            });
        })();
        </script>
        <?php
    }

    public static function render_daily_promotions_markup( $args = array() ) {
        $args = wp_parse_args( $args, array(
            'layout'        => 'grid',
            'badge_text'    => '7 DAYS, 7 REASONS TO CELEBRATE',
            'title'         => 'Daily Special <span class="sec-title-accent">3 + 1 FREE</span> Offers',
            'subtitle'      => 'Every day brings a signature handcrafted privilege across all Santino flagship cafes.',
            'whatsapp'      => '8801613334514',
            'show_header'   => true,
            'custom_promos' => array(),
        ) );

        $promos     = ! empty( $args['custom_promos'] ) && is_array( $args['custom_promos'] ) ? $args['custom_promos'] : self::get_daily_promotions();
        $today_key  = self::get_today_dhaka_key();
        $today_date = self::get_today_dhaka_date();
        $wa_num     = preg_replace( '/[^0-9]/', '', $args['whatsapp'] ) ?: '8801613334514';

        $today_list = array();
        foreach ( $promos as $p ) {
            if ( self::is_promo_active_today( $p, $today_key, $today_date ) ) {
                $today_list[] = $p;
            }
        }
        $today_p = ! empty( $today_list ) ? $today_list[0] : reset( $promos );

        ob_start();
        ?>
        <section class="py-5 santino-daily-promos-section position-relative overflow-hidden" id="dailyPromos" data-dhaka-today="<?php echo esc_attr( $today_key ); ?>" data-wa-number="<?php echo esc_attr( $wa_num ); ?>">
            <div class="container py-lg-3 position-relative" style="z-index:2;">
                <?php if ( $args['show_header'] ) : ?>
                <div class="text-center mx-auto mb-4" style="max-width: 720px;">
                    <div class="sec-pill-badge-wrap mb-2">
                        <span class="sec-pill-line"></span>
                        <span class="sec-pill-badge"><i class="bi bi-calendar2-heart-fill me-1"></i> <?php echo esc_html( $args['badge_text'] ); ?></span>
                        <span class="sec-pill-line"></span>
                    </div>
                    <h2 class="sec-title mb-2"><?php echo wp_kses_post( $args['title'] ); ?></h2>
                    <p class="text-muted mb-0" style="font-size: 0.98rem; line-height: 1.55;"><?php echo esc_html( $args['subtitle'] ); ?></p>
                </div>
                <?php endif; ?>

                <div class="santino-today-spotlight mb-4" id="santinoTodaySpotlight">
                    <div class="row align-items-center g-3">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                <span class="badge rounded-pill santino-live-pill"><span class="live-dot"></span> TODAY'S LIVE OFFER &bull; <span class="js-today-day-name"><?php echo esc_html( strtoupper( $today_p['day'] ) ); ?></span></span>
                                <span class="badge rounded-pill santino-countdown-pill"><i class="bi bi-clock me-1"></i> Ends in <span class="js-dhaka-countdown">00:00:00</span></span>
                            </div>
                            <h3 class="font-heading fw-bold text-white mb-1 js-today-title"><?php echo esc_html( $today_p['title'] . ' — ' . $today_p['items'] ); ?></h3>
                            <p class="mb-0 text-white-50 small">Order 3 cups &amp; get the 4th cup 100% free. VIP Members also earn 3 Coffee Stamps on paid cups!</p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="https://wa.me/<?php echo esc_attr( $wa_num ); ?>?text=<?php echo rawurlencode( 'Hi Santino! I want to claim today\'s (' . $today_p['day'] . ') ' . $today_p['title'] . ' - ' . $today_p['items'] . ' offer.' ); ?>" target="_blank" class="btn-hero-lifestyle js-today-wa-btn">
                                <i class="bi bi-whatsapp"></i> <span>Claim Today's Offer</span>
                            </a>
                        </div>
                    </div>
                </div>

                <?php if ( $args['layout'] !== 'banner' ) : ?>
                <div class="row g-3 g-md-4 justify-content-center">
                    <?php foreach ( $promos as $p ) :
                        if ( empty( $p['active'] ) ) continue;
                        $sched    = $p['schedule'] ?? strtolower( $p['day'] ?? 'everyday' );
                        $is_today = self::is_promo_active_today( $p, $today_key, $today_date );
                        $stamps   = max( 1, intval( $p['paid_cups'] ?? 3 ) );
                        $wa_msg   = 'Hi Santino! I want to claim the ' . $p['day'] . ' (' . $p['title'] . ' - ' . $p['items'] . ') special offer.';
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="santino-promo-day-card <?php echo $is_today ? 'is-today-active' : ''; ?>" data-promo-day="<?php echo esc_attr( $sched ); ?>" data-promo-start="<?php echo esc_attr( $p['start_date'] ?? '' ); ?>" data-promo-end="<?php echo esc_attr( $p['end_date'] ?? '' ); ?>" data-promo-day-label="<?php echo esc_attr( $p['day'] ); ?>" data-promo-title="<?php echo esc_attr( $p['title'] ); ?>" data-promo-items="<?php echo esc_attr( $p['items'] ); ?>">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="promo-day-label"><?php echo esc_html( strtoupper( $p['day'] ) ); ?></span>
                                <span class="promo-status-tag"><?php echo $is_today ? 'TODAY LIVE' : esc_html( $p['badge'] ?: 'WEEKLY' ); ?></span>
                            </div>
                            <div class="promo-offer-pill mb-2"><?php echo esc_html( $p['title'] ); ?></div>
                            <h4 class="font-heading promo-items-title mb-3"><?php echo esc_html( $p['items'] ); ?></h4>
                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <span class="small text-muted"><i class="bi bi-cup-hot text-teal me-1"></i> +<?php echo esc_html( $stamps ); ?> VIP Stamps</span>
                                <a href="https://wa.me/<?php echo esc_attr( $wa_num ); ?>?text=<?php echo rawurlencode( $wa_msg ); ?>" target="_blank" class="promo-claim-link">
                                    Order <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <style>
        .santino-daily-promos-section { background: linear-gradient(180deg, #ffffff 0%, #f5f9f8 100%); }
        .santino-today-spotlight {
            background: linear-gradient(135deg, #004d49 0%, #002d2b 65%, #011d1c 100%);
            border: 1.5px solid rgba(223, 190, 141, 0.55);
            border-radius: 22px;
            padding: 26px 30px;
            box-shadow: 0 18px 40px rgba(0, 77, 73, 0.22);
        }
        .santino-live-pill {
            background: rgba(223, 190, 141, 0.2);
            color: #dfbe8d;
            border: 1px solid rgba(223, 190, 141, 0.45);
            font-size: 11px;
            letter-spacing: 0.8px;
            padding: 6px 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .santino-live-pill .live-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.25);
        }
        .santino-countdown-pill {
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-size: 11px;
            padding: 6px 12px;
        }
        .santino-promo-day-card {
            background: #ffffff;
            border: 1.5px solid #e3eeea;
            border-radius: 20px;
            padding: 24px 22px;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            box-shadow: 0 8px 22px rgba(0, 77, 73, 0.04);
        }
        .santino-promo-day-card:hover {
            transform: translateY(-6px);
            border-color: rgba(195, 153, 108, 0.6);
            box-shadow: 0 18px 36px rgba(0, 77, 73, 0.1);
        }
        .santino-promo-day-card.is-today-active {
            background: linear-gradient(180deg, #ffffff 0%, #f0faf7 100%);
            border: 2px solid #00625d;
            box-shadow: 0 18px 38px rgba(0, 98, 93, 0.18), 0 0 0 4px rgba(223, 190, 141, 0.25);
        }
        .promo-day-label {
            font-family: var(--kp-font-title, 'Montserrat', sans-serif);
            font-weight: 800;
            font-size: 13px;
            letter-spacing: 1.2px;
            color: #00625d;
        }
        .promo-status-tag {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            padding: 4px 10px;
            border-radius: 20px;
            background: #f0f6f4;
            color: #4b6360;
        }
        .is-today-active .promo-status-tag {
            background: #00625d;
            color: #dfbe8d;
        }
        .promo-offer-pill {
            display: inline-block;
            align-self: flex-start;
            background: linear-gradient(135deg, rgba(0, 98, 93, 0.1) 0%, rgba(195, 153, 108, 0.2) 100%);
            color: #004d49;
            font-weight: 800;
            font-size: 13px;
            padding: 5px 12px;
            border-radius: 8px;
            letter-spacing: 0.5px;
        }
        .promo-items-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: #12211e;
            line-height: 1.35;
        }
        .promo-claim-link {
            font-size: 12.5px;
            font-weight: 700;
            color: #00625d;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .promo-claim-link:hover { color: #93683a; }
        </style>
        <?php
        return ob_get_clean();
    }

    public static function render_daily_promotions_shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'layout'     => 'grid',
            'badge_text' => '7 DAYS, 7 REASONS TO CELEBRATE',
            'title'      => 'Daily Special <span class="sec-title-accent">3 + 1 FREE</span> Offers',
            'subtitle'   => 'Every day brings a signature handcrafted privilege across all Santino flagship cafes.',
            'whatsapp'   => '8801613334514',
        ), $atts );
        return self::render_daily_promotions_markup( $atts );
    }

    public static function get_today_active_promotions() {
        $promos     = self::get_daily_promotions();
        $today_key  = self::get_today_dhaka_key();
        $today_date = self::get_today_dhaka_date();
        $list       = array();
        foreach ( $promos as $p ) {
            if ( self::is_promo_active_today( $p, $today_key, $today_date ) ) {
                $list[] = $p;
            }
        }
        return ! empty( $list ) ? $list : array( reset( $promos ) );
    }

    public static function render_promo_selector_field() {
        $today_list = self::get_today_active_promotions();
        ob_start();
        ?>
        <div class="col-md-12">
            <div class="p-3 rounded-3" style="background:#f0faf7; border:1px dashed #00625d;">
                <label class="form-label small fw-bold text-dark mb-1">
                    <i class="bi bi-stars text-warning me-1"></i> Claimed Today's Special Offer? <span class="text-muted fw-normal">(Optional)</span>
                </label>
                <select name="promo_id" class="form-select form-select-sm santino-promo-select">
                    <option value="">-- Regular Order (No Special Offer) --</option>
                    <?php foreach ( $today_list as $tp ) : ?>
                        <option value="<?php echo esc_attr( $tp['id'] ); ?>" data-paid-cups="<?php echo esc_attr( intval( $tp['paid_cups'] ?? 3 ) ); ?>" data-promo-title="<?php echo esc_attr( $tp['title'] . ' — ' . $tp['items'] ); ?>">
                            <?php echo esc_html( $tp['title'] . ' — ' . $tp['items'] . ' (+' . intval( $tp['paid_cups'] ?? 3 ) . ' Stamps)' ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function render_today_offer_tab_pane( $wa_num = '8801613334514' ) {
        $promos     = self::get_daily_promotions();
        $today_key  = self::get_today_dhaka_key();
        $today_date = self::get_today_dhaka_date();
        $wa_clean   = preg_replace( '/[^0-9]/', '', $wa_num ) ?: '8801613334514';
        $today_list = self::get_today_active_promotions();
        $today_p    = $today_list[0];
        $branches   = self::get_cafe_branches();
        $wa_msg     = 'Hi Santino! I want to claim today\'s (' . $today_p['day'] . ') ' . $today_p['title'] . ' - ' . $today_p['items'] . ' offer.';

        ob_start();
        ?>
        <div class="tab-pane fade santino-today-offer-tab-pane" id="today-offer-pane" role="tabpanel" data-wa-number="<?php echo esc_attr( $wa_clean ); ?>">
            <div class="p-3 p-md-4 rounded-4 text-white mb-3 position-relative overflow-hidden" style="background: linear-gradient(135deg, #004d49 0%, #002d2b 70%, #011d1c 100%); border: 1.5px solid rgba(223,190,141,0.5);">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                    <span class="badge rounded-pill px-3 py-1" style="background: rgba(223,190,141,0.2); color: #dfbe8d; border: 1px solid rgba(223,190,141,0.45); font-size: 11px;">
                        <span style="display:inline-block;width:7px;height:7px;border-radius:50%;background:#22c55e;margin-right:6px;"></span>
                        LIVE TODAY &bull; <span class="js-tab-today-day"><?php echo esc_html( strtoupper( $today_p['day'] ) ); ?></span>
                    </span>
                    <span class="badge rounded-pill px-3 py-1" style="background: rgba(255,255,255,0.12); color: #ffffff; font-size: 11px;">
                        <i class="bi bi-clock me-1"></i> Ends in <span class="js-dhaka-countdown">00:00:00</span>
                    </span>
                </div>

                <div class="fw-bold text-uppercase mb-1" style="color: #dfbe8d; font-size: 11.5px; letter-spacing: 1px;">
                    <span class="js-tab-today-badge"><?php echo esc_html( $today_p['title'] ); ?></span>
                </div>
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h4 class="font-heading fw-bold text-white mb-0 js-tab-today-items" style="font-size: 1.35rem;">
                        <?php echo esc_html( $today_p['items'] ); ?>
                    </h4>
                    <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>?text=<?php echo rawurlencode( $wa_msg ); ?>" target="_blank" class="btn btn-sm fw-bold px-3 py-1 rounded-pill js-tab-today-wa" style="background: #dfbe8d; color: #002d2b;">
                        <i class="bi bi-whatsapp me-1"></i> Order on WhatsApp
                    </a>
                </div>
            </div>

            <div class="border rounded-4 p-3 p-md-4 bg-white shadow-sm mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="font-heading fw-bold text-dark mb-0" style="font-size: 1rem;">Log Invoice For Today's Offer</h5>
                        <p class="text-muted mb-0" style="font-size: 12px;">Submit your receipt to auto-credit <strong class="text-teal js-today-offer-stamps-label">+<?php echo esc_html( intval( $today_p['paid_cups'] ?? 3 ) ); ?> Stamps</strong></p>
                    </div>
                    <span class="badge rounded-pill" style="background:#f0faf7; color:#00625d; border:1px solid #d5e5e1;">Auto-Linked</span>
                </div>

                <div id="todayOfferInvoiceResponseBox" style="display:none;" class="mb-3"></div>

                <form id="santinoTodayOfferInvoiceForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-1">Active Offer Claimed *</label>
                        <select name="promo_id" class="form-select js-today-offer-select" required>
                            <?php foreach ( $today_list as $tp ) : ?>
                                <option value="<?php echo esc_attr( $tp['id'] ); ?>" data-paid-cups="<?php echo esc_attr( intval( $tp['paid_cups'] ?? 3 ) ); ?>" data-items="<?php echo esc_attr( $tp['items'] ); ?>" data-title="<?php echo esc_attr( $tp['title'] ); ?>">
                                    <?php echo esc_html( $tp['title'] . ' — ' . $tp['items'] . ' (+' . intval( $tp['paid_cups'] ?? 3 ) . ' Stamps)' ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Invoice / Memo Number *</label>
                            <input type="text" name="invoice_number" class="form-control" placeholder="e.g. SNT-2026-9042" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Phone Number / WhatsApp *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="017XXXXXXXX" pattern="^(?:\+?880|0)?1[3-9]\d{8}$" required>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Cafe Branch Visited</label>
                            <select name="branch" class="form-select">
                                <?php foreach ( $branches as $b ) : ?>
                                    <option value="<?php echo esc_attr( $b ); ?>"><?php echo esc_html( $b ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark mb-1">Receipt Photo *</label>
                            <input type="file" name="invoice_image" class="form-control" accept="image/*" required>
                        </div>
                    </div>

                    <input type="hidden" name="promo_claimed" value="yes">
                    <input type="hidden" name="promo_day" value="<?php echo esc_attr( $today_key ); ?>">
                    <input type="hidden" name="cups" class="js-today-offer-cups" value="<?php echo esc_attr( intval( $today_p['paid_cups'] ?? 3 ) ); ?>">
                    <input type="hidden" name="items_consumed" class="js-today-offer-items-input" value="<?php echo esc_attr( $today_p['title'] . ' — ' . $today_p['items'] ); ?>">

                    <button type="submit" class="btn btn-portal-submit w-100 font-heading text-uppercase">
                        Submit Today's Offer Invoice →
                    </button>
                </form>
            </div>

            <div class="d-flex justify-content-between align-items-center px-1">
                <span class="small text-muted">Want to see all 7 days?</span>
                <a href="<?php echo esc_url( home_url( '/offers/' ) ); ?>" class="small fw-bold text-decoration-none" style="color: #00625d;">View Full Weekly Offers &rarr;</a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

Santino_Membership_System::init();
