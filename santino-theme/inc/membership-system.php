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

        add_action( 'post_edit_form_tag', array( __CLASS__, 'add_post_enctype' ) );
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
                        <select name="free_item" required style="font-size: 12px; height: 32px; border-radius: 6px; border: 1px solid #059669; font-weight: 500;">
                            <option value="">-- Choose Free Item --</option>
                            <option value="Handcrafted Cappuccino">Handcrafted Cappuccino</option>
                            <option value="Signature Caffe Latte">Signature Caffe Latte</option>
                            <option value="Spanish Latte">Spanish Latte</option>
                            <option value="Classic Americano">Classic Americano</option>
                            <option value="Caramel Macchiato">Caramel Macchiato</option>
                            <option value="Flat White">Flat White</option>
                            <option value="Iced Signature Latte">Iced Signature Latte</option>
                            <option value="Iced Americano">Iced Americano</option>
                            <option value="Cold Brew Reserve">Cold Brew Reserve</option>
                            <option value="Hot Mocha">Hot Mocha</option>
                        </select>

                        <label style="font-weight: bold; font-size: 12px; color: #065f46;">Branch:</label>
                        <select name="branch" style="font-size: 12px; height: 32px; border-radius: 6px; border: 1px solid #059669;">
                            <option value="Gulshan-2 Flagship Experience Center">Gulshan-2 Flagship</option>
                            <option value="Banani Borak Mehnur">Banani Borak Mehnur</option>
                            <option value="Tejgaon Roastery & Lab">Tejgaon Roastery & Lab</option>
                            <option value="Dhanmondi Ahmed & Kazi Tower">Dhanmondi</option>
                            <option value="Uttara Liberty Tower">Uttara</option>
                            <option value="Baridhara Diplomatic Enclave">Baridhara</option>
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
                        <strong>Allow Re-registration from Portal</strong> (অনুমতি দিলে এই নম্বর দিয়ে ওয়েবসাইটের পোর্টাল থেকে পুনরায় মেম্বারশিপ ফর্ম সাবমিট করা যাবে)
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
                            <a href="<?php echo esc_url( $img_url ); ?>" target="_blank" title="Open Full Photo in New Window">
                                <img src="<?php echo esc_url( $img_url ); ?>" style="max-height: 280px; max-width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); display: block; margin-bottom: 8px;">
                            </a>
                            <a href="<?php echo esc_url( $img_url ); ?>" target="_blank" class="button button-small" style="font-weight: 600;">🔍 View Full Image</a>
                        </div>
                    <?php else : ?>
                        <p style="color: #64748b; font-style: italic; margin-bottom: 8px;"><?php _e( 'No customer receipt photo uploaded.', 'santino' ); ?></p>
                    <?php endif; ?>
                    <label style="font-size: 12px; color: #475569; display: block; margin-top: 6px; font-weight: 600;"><?php _e( 'Upload / Replace Memo Photo:', 'santino' ); ?></label>
                    <input type="file" name="santino_invoice_admin_image" accept="image/*">
                </td>
            </tr>
            <tr>
                <th><label><?php _e( 'Number of Cups', 'santino' ); ?></label></th>
                <td><input type="number" name="santino_invoice_cups" min="1" max="50" value="<?php echo esc_attr( $cups ); ?>" style="width: 80px; font-weight:bold; font-size:14px;"> ☕ (কয় কাপ কফি নেওয়া হয়েছে)</td>
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
                        <a href="<?php echo esc_url( $approve_url ); ?>" class="button button-primary" style="background: #15803d; border-color: #166534; font-weight: bold;">
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
                <th><label><?php _e( 'Selected Free Item', 'santino' ); ?></label></th>
                <td><input type="text" name="santino_redeem_item" value="<?php echo esc_attr( $item ); ?>" class="regular-text" style="font-weight:bold; color:#0f172a;"></td>
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

    public static function set_invoice_columns( $columns ) {
        return array(
            'cb'            => $columns['cb'],
            'title'         => __( 'Invoice Record', 'santino' ),
            'invoice_no'    => __( 'Invoice #', 'santino' ),
            'receipt_photo' => __( 'Receipt Photo', 'santino' ),
            'cups'          => __( 'Cups', 'santino' ),
            'phone'         => __( 'Customer Phone', 'santino' ),
            'branch'        => __( 'Cafe Branch', 'santino' ),
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
                    $img_url = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
                }
                if ( $img_url ) {
                    echo '<a href="' . esc_url( $img_url ) . '" target="_blank" title="View Full Receipt Memo" style="display:inline-block;"><img src="' . esc_url( $img_url ) . '" style="width:45px; height:45px; object-fit:cover; border-radius:6px; border:1px solid #cbd5e1; box-shadow:0 1px 3px rgba(0,0,0,0.1); vertical-align:middle;"></a>';
                } else {
                    echo '<span style="color:#94a3b8; font-size:11px;">No Photo</span>';
                }
                break;
            case 'cups':
                $cups = intval( get_post_meta( $post_id, '_santino_invoice_cups', true ) ?: 1 );
                echo '<strong style="color:#00625d; font-size:13px;">' . esc_html( $cups ) . ' ☕</strong>';
                break;
            case 'phone':
                $inv_raw_phone = get_post_meta( $post_id, '_santino_invoice_phone', true );
                echo esc_html( self::normalize_phone( $inv_raw_phone ) ?: '—' );
                break;
            case 'branch':
                echo esc_html( get_post_meta( $post_id, '_santino_invoice_branch', true ) ?: 'Santino Flagship' );
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
                $status = get_post_meta( $post_id, '_santino_redeem_status', true ) ?: 'pending';
                if ( $status === 'pending' ) {
                    $approve_url = wp_nonce_url( admin_url( 'admin.php?action=santino_approve_redeem&redeem_id=' . $post_id ), 'santino_approve_redeem_' . $post_id );
                    $reject_url  = wp_nonce_url( admin_url( 'admin.php?action=santino_reject_redeem&redeem_id=' . $post_id ), 'santino_reject_redeem_' . $post_id );
                    echo '<a href="' . esc_url( $approve_url ) . '" class="button button-small button-primary" style="background:#15803d; border-color:#166534;">✓ Approve & Serve</a> ';
                    echo '<a href="' . esc_url( $reject_url ) . '" class="button button-small" style="color:#b91c1c;">Reject</a>';
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

        wp_redirect( admin_url( 'edit.php?post_type=santino_redeem&approved=1' ) );
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

        wp_redirect( add_query_arg( array( 'post' => $member_id, 'action' => 'edit', 'redeem_success' => '1', 'served_item' => urlencode( $item ) ), admin_url( 'post.php' ) ) );
        exit;
    }

    public static function render_admin_notices() {
        if ( isset( $_GET['redeem_success'] ) ) {
            $item = isset( $_GET['served_item'] ) ? sanitize_text_field( $_GET['served_item'] ) : 'Free Coffee';
            echo '<div class="notice notice-success is-dismissible" style="border-left-color: #059669;"><p><strong>✓ Free Cup Served!</strong> 1 Free Beverage (<strong>' . esc_html( $item ) . '</strong>) was successfully served and deducted from member balance.</p></div>';
        }
        if ( isset( $_GET['redeem_error'] ) && $_GET['redeem_error'] === 'no_balance' ) {
            echo '<div class="notice notice-error is-dismissible"><p><strong>✗ Redeem Error:</strong> Member has 0 free cups available.</p></div>';
        }
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

        $phone       = self::normalize_phone( sanitize_text_field( $_POST['phone'] ?? '' ) );
        $email       = sanitize_email( $_POST['email'] ?? '' );
        $birth_month = sanitize_text_field( $_POST['birth_month'] ?? '' );
        $birth_day   = sanitize_text_field( $_POST['birth_day'] ?? '' );
        $tier        = 'regular';

        if ( empty( $phone ) || empty( $email ) || empty( $birth_month ) || empty( $birth_day ) ) {
            wp_send_json_error( array( 'message' => __( 'Please fill in Mobile Number, Birthday (Month & Day), and Email Address.', 'santino' ) ) );
        }

        // Phone validation (BD format)
        if ( ! self::is_valid_bd_phone( $phone ) ) {
            wp_send_json_error( array( 'message' => __( 'দয়া করে সঠিক ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর প্রদান করুন (যেমন: 017XXXXXXXX)।', 'santino' ) ) );
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
                update_post_meta( $existing->ID, '_santino_member_email', $email );
                update_post_meta( $existing->ID, '_santino_member_birth_month', $birth_month );
                update_post_meta( $existing->ID, '_santino_member_birth_day', $birth_day );
                update_post_meta( $existing->ID, '_santino_member_birthday', $birth_month . ' - ' . $birth_day );
                update_post_meta( $existing->ID, '_santino_member_status', 'active' );
                $exist_id = get_post_meta( $existing->ID, '_santino_member_id', true );
                wp_send_json_success( array(
                    'message'   => __( 'আপনার মেম্বারশিপ প্রোফাইল সফলভাবে আপডেট করা হয়েছে!', 'santino' ),
                    'member_id' => $exist_id,
                    'name'      => $existing->post_title,
                    'tier'      => 'REGULAR MEMBER',
                ) );
            } else {
                wp_send_json_error( array(
                    'message' => __( 'এই মোবাইল নম্বরটি দিয়ে ইতিমধ্যে মেম্বারশিপ রেজিস্ট্রেশন করা হয়েছে। পোর্টাল/অ্যাডমিন এর অনুমতি ছাড়া একই নম্বর দিয়ে ২য় বার রেজিস্ট্রেশন করা যাবে না।', 'santino' ),
                ) );
            }
        }

        $member_id = 'SNT-REG-' . strtoupper( wp_generate_password( 6, false ) );

        $post_id = wp_insert_post( array(
            'post_title'   => sprintf( 'Regular Member (%s)', $phone ),
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
        update_post_meta( $post_id, '_santino_member_birth_month', $birth_month );
        update_post_meta( $post_id, '_santino_member_birth_day', $birth_day );
        update_post_meta( $post_id, '_santino_member_birthday', $birth_month . ' - ' . $birth_day );
        update_post_meta( $post_id, '_santino_allow_reregister', 'no' );
        update_post_meta( $post_id, '_santino_cup_stamps', 0 );
        update_post_meta( $post_id, '_santino_total_approved_cups', 0 );
        update_post_meta( $post_id, '_santino_total_free_coffees', 0 );

        wp_send_json_success( array(
            'message'   => __( 'অভিনন্দন! আপনার Santino Coffee Club Regular Membership সক্রিয় হয়েছে।', 'santino' ),
            'member_id' => $member_id,
            'name'      => sprintf( 'Member (%s)', substr( $phone, -4 ) ),
            'tier'      => 'REGULAR MEMBER',
        ) );
    }

    // Submit Coffee Invoice Number
    public static function handle_ajax_invoice_submit() {
        check_ajax_referer( 'santino_frontend_nonce', 'security' );

        $invoice_no = sanitize_text_field( $_POST['invoice_number'] ?? '' );
        $phone      = self::normalize_phone( sanitize_text_field( $_POST['phone'] ?? '' ) );
        $member_id  = sanitize_text_field( $_POST['member_id'] ?? '' );
        $branch     = sanitize_text_field( $_POST['branch'] ?? 'Gulshan-2 Flagship Experience Center' );
        $cups       = max( 1, intval( $_POST['cups'] ?? 1 ) );

        if ( empty( $invoice_no ) ) {
            wp_send_json_error( array( 'message' => __( 'দয়া করে ইনভয়েস/মেমো নম্বর প্রদান করুন।', 'santino' ) ) );
        }

        if ( empty( $phone ) || ! self::is_valid_bd_phone( $phone ) ) {
            wp_send_json_error( array( 'message' => __( 'দয়া করে সঠিক ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর প্রদান করুন (যেমন: 017XXXXXXXX)।', 'santino' ) ) );
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
        $inv_post_id = wp_insert_post( array(
            'post_title'   => sprintf( 'Invoice #%s - %s (%d Cups)', $invoice_no, $phone, $cups ),
            'post_type'    => 'santino_invoice',
            'post_status'  => 'publish',
        ) );

        if ( is_wp_error( $inv_post_id ) ) {
            wp_send_json_error( array( 'message' => __( 'Could not submit invoice. Please try again.', 'santino' ) ) );
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

        update_post_meta( $inv_post_id, '_santino_invoice_number', $invoice_no );
        update_post_meta( $inv_post_id, '_santino_invoice_cups', $cups );
        update_post_meta( $inv_post_id, '_santino_invoice_phone', $phone );
        update_post_meta( $inv_post_id, '_santino_invoice_member_id', $member_id );
        update_post_meta( $inv_post_id, '_santino_invoice_branch', $branch );
        update_post_meta( $inv_post_id, '_santino_invoice_status', 'pending' );
        update_post_meta( $inv_post_id, '_santino_invoice_submitted_at', current_time( 'mysql' ) );

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

        $phone       = sanitize_text_field( $_POST['phone'] ?? '' );
        $free_item   = sanitize_text_field( $_POST['free_item'] ?? '' );
        $branch      = sanitize_text_field( $_POST['branch'] ?? 'Gulshan-2 Flagship Experience Center' );
        $redeem_code = sanitize_text_field( $_POST['redeem_code'] ?? '' );

        if ( empty( $phone ) || empty( $free_item ) ) {
            wp_send_json_error( array( 'message' => __( 'দয়া করে আপনার মোবাইল নম্বর এবং ফ্রি কফি আইটেম সিলেক্ট করুন।', 'santino' ) ) );
        }

        if ( ! self::is_valid_bd_phone( $phone ) ) {
            wp_send_json_error( array( 'message' => __( 'দয়া করে সঠিক ১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর প্রদান করুন (যেমন: 017XXXXXXXX)।', 'santino' ) ) );
        }

        $member = self::find_member_by_phone_or_id( $phone );
        if ( ! $member ) {
            wp_send_json_error( array( 'message' => __( 'এই মোবাইল নম্বর দিয়ে কোনো রেজিস্টার্ড মেম্বারশিপ পাওয়া যায়নি।', 'santino' ) ) );
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
            wp_send_json_error( array( 'message' => __( 'আপনার কোনো ফ্রি কফি ভাউচার অবশিষ্ট নেই। ৫টি কাপ স্ট্যাম্প সম্পন্ন হলে ফ্রি কফি রিডিম করতে পারবেন।', 'santino' ) ) );
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
            wp_send_json_error( array( 'message' => __( 'রিডিম রিকোয়েস্ট জমা দেওয়া সম্ভব হয়নি। আবার চেষ্টা করুন।', 'santino' ) ) );
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

        wp_send_json_success( array(
            'message'     => sprintf( __( 'ফ্রি কাপ রিডিম রিকোয়েস্ট সফলভাবে জমা হয়েছে! (Redeem ID: %s)। পোর্টাল/অ্যাডমিন অ্যাপ্রুভ করলে বারিস্তা আপনাকে ফ্রি %s প্রদান করবে।', 'santino' ), $redeem_code, $free_item ),
            'redeem_code' => $redeem_code,
            'free_item'   => $free_item,
            'branch'      => $branch,
            'status'      => 'pending',
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
        $total_free   = intval( get_post_meta( $member->ID, '_santino_total_free_coffees', true ) ?: 0 );
        $tier         = strtoupper( get_post_meta( $member->ID, '_santino_member_tier', true ) ?: 'REGULAR' );
        $birthday     = get_post_meta( $member->ID, '_santino_member_birthday', true );

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
            'name'         => $member->post_title,
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
            __( 'Loyalty Analytics & Stamp Engine', 'santino' ),
            __( 'Loyalty Reports', 'santino' ),
            'manage_options',
            'santino-loyalty-stats',
            array( __CLASS__, 'render_loyalty_dashboard' )
        );
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
        ?>
        <style>
            .loyalty-report-wrap { max-width: 1300px; margin: 20px auto 40px; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif; }
            .loyalty-grid-6 { display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: 16px; margin: 22px 0; }
            .loyalty-card { background: #fff; padding: 20px 22px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.04); position: relative; overflow: hidden; }
            .loyalty-card-accent { position: absolute; left: 0; top: 0; bottom: 0; width: 4px; }
            .loyalty-label { color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
            .loyalty-value { font-size: 30px; font-weight: 800; color: #0f172a; line-height: 1.1; }
            .loyalty-sub { font-size: 12px; color: #94a3b8; margin-top: 6px; font-weight: 500; }
            .loyalty-section { background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.04); padding: 24px; margin-bottom: 24px; }
            .loyalty-title { font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 16px; display: flex; align-items: center; justify-content: space-between; }
            .loyalty-table { width: 100%; border-collapse: collapse; text-align: left; }
            .loyalty-table th { background: #f8fafc; color: #475569; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; padding: 12px 14px; border-bottom: 1px solid #e2e8f0; }
            .loyalty-table td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; font-size: 13px; color: #334155; vertical-align: middle; }
            .loyalty-table tr:hover td { background: #f8fafc; }
            .badge-pill { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; letter-spacing: 0.3px; }
            .badge-approved { background: #dcfce7; color: #15803d; }
            .badge-pending { background: #fef9c3; color: #854d0e; }
            .badge-rejected { background: #fee2e2; color: #b91c1c; }
            .badge-voucher { background: #fdf2f8; color: #db2777; font-family: monospace; }
        </style>

        <div class="wrap loyalty-report-wrap">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; margin-bottom: 8px;">
                <div>
                    <h1 style="font-size: 26px; font-weight: 800; color: #00625d; margin: 0; display: flex; align-items: center; gap: 10px;">
                        ☕ Santino Club — Executive Loyalty & Stamp Report
                    </h1>
                    <p style="margin: 4px 0 0; color: #64748b; font-size: 14px;">Complete real-time analytics across cafe branches, verified cup throughput, member milestones, and rewards.</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="<?php echo admin_url( 'edit.php?post_type=santino_invoice' ); ?>" class="button button-primary" style="background: #00625d; border-color: #004d49; font-weight: 700;">
                        Verify Invoices <?php echo ( $pending_inv > 0 ) ? '(' . $pending_inv . ' Pending)' : ''; ?>
                    </a>
                    <a href="<?php echo admin_url( 'edit.php?post_type=santino_redeem' ); ?>" class="button" style="font-weight: 600;">
                        Redeem Approvals <?php echo ( $pending_red > 0 ) ? '(' . $pending_red . ' Pending)' : ''; ?>
                    </a>
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
                                    <a href="<?php echo esc_url( $img_url ); ?>" target="_blank" title="View Full Receipt">
                                        <img src="<?php echo esc_url( $img_url ); ?>" style="width: 38px; height: 38px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; vertical-align: middle;">
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
}

Santino_Membership_System::init();
