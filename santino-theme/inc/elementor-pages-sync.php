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

    const SYNC_VERSION = '2.5.0';

    public static function init() {
        add_action( 'init', array( __CLASS__, 'ensure_pages' ), 20 );
        add_action( 'admin_init', array( __CLASS__, 'admin_check' ), 20 );
        add_action( 'admin_init', array( __CLASS__, 'auto_split_legacy_member_page' ), 5 );
        add_action( 'elementor/editor/init', array( __CLASS__, 'auto_split_legacy_member_page' ), 5 );
        add_action( 'elementor/editor/before_enqueue_scripts', array( __CLASS__, 'auto_split_legacy_member_page' ), 5 );
        add_action( 'admin_menu', array( __CLASS__, 'register_admin_menu' ) );
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_syncer_meta_box' ) );
        add_action( 'admin_bar_menu', array( __CLASS__, 'add_admin_bar_item' ), 100 );
        add_action( 'admin_post_santino_sync_specific_page', array( __CLASS__, 'handle_specific_page_sync' ) );
        add_action( 'admin_post_santino_cleanup_unused_pages', array( __CLASS__, 'handle_cleanup_unused_pages' ) );
    }

    public static function get_protected_page_ids_and_slugs() {
        $protected_slugs = array_unique( array_merge(
            array_keys( self::get_pages_config() ),
            array(
                'home', 'machines', 'beans', 'training', 'office-cafe', 'horeca',
                'our-story', 'membership', 'santino-member', 'coffee-club', 'menu',
                'offers', 'brands', 'bfc', 'swapno', 'certificate-verification',
                'shop', 'cart', 'checkout', 'my-account', 'privacy-policy',
            )
        ) );

        $protected_ids = array();
        $option_keys   = array(
            'page_on_front', 'page_for_posts', 'wp_page_for_privacy_policy',
            'woocommerce_shop_page_id', 'woocommerce_cart_page_id',
            'woocommerce_checkout_page_id', 'woocommerce_myaccount_page_id',
            'woocommerce_terms_page_id',
        );
        foreach ( $option_keys as $opt ) {
            $val = intval( get_option( $opt ) );
            if ( $val > 0 ) {
                $protected_ids[] = $val;
            }
        }

        $menu_items = get_posts( array(
            'post_type'      => 'nav_menu_item',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'meta_query'     => array(
                array( 'key' => '_menu_item_object', 'value' => 'page' ),
            ),
        ) );
        foreach ( $menu_items as $mi ) {
            $obj_id = intval( get_post_meta( $mi->ID, '_menu_item_object_id', true ) );
            if ( $obj_id > 0 ) {
                $protected_ids[] = $obj_id;
            }
        }

        return array(
            'ids'   => array_unique( $protected_ids ),
            'slugs' => $protected_slugs,
        );
    }

    public static function is_page_protected( $page, $protected = null ) {
        if ( ! $protected ) {
            $protected = self::get_protected_page_ids_and_slugs();
        }
        if ( in_array( (int) $page->ID, $protected['ids'], true ) ) {
            return true;
        }
        $slug = strtolower( (string) $page->post_name );
        return in_array( $slug, $protected['slugs'], true );
    }

    public static function handle_cleanup_unused_pages() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Unauthorized' );
        }
        check_admin_referer( 'santino_cleanup_unused_pages' );

        $protected = self::get_protected_page_ids_and_slugs();
        $all_pages = get_posts( array(
            'post_type'      => 'page',
            'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
            'posts_per_page' => -1,
        ) );

        $trashed = 0;
        foreach ( $all_pages as $p ) {
            if ( self::is_page_protected( $p, $protected ) ) {
                continue;
            }
            if ( wp_trash_post( $p->ID ) ) {
                $trashed++;
            }
        }

        wp_safe_redirect( add_query_arg( array(
            'page'          => 'santino-elementor-syncer',
            'cleaned_count' => $trashed,
        ), admin_url( 'admin.php' ) ) );
        exit;
    }

    public static function register_admin_menu() {
        add_submenu_page(
            'santino-demo-import',
            __( 'Elementor Page Syncer', 'santino' ),
            __( 'Elementor Page Syncer', 'santino' ),
            'manage_options',
            'santino-elementor-syncer',
            array( __CLASS__, 'render_admin_syncer_page' )
        );
    }

    public static function add_syncer_meta_box() {
        add_meta_box(
            'santino_page_syncer_box',
            __( '⚡ Santino Elementor Syncer', 'santino' ),
            array( __CLASS__, 'render_meta_box' ),
            'page',
            'side',
            'high'
        );
    }

    public static function render_meta_box( $post ) {
        $sync_url_menu = wp_nonce_url( admin_url( 'admin-post.php?action=santino_sync_specific_page&target_page_id=' . $post->ID . '&layout_type=menu_sections' ), 'santino_sync_nonce_' . $post->ID );
        $sync_url_3sec = wp_nonce_url( admin_url( 'admin-post.php?action=santino_sync_specific_page&target_page_id=' . $post->ID . '&layout_type=three_sections' ), 'santino_sync_nonce_' . $post->ID );
        $sync_url_vip  = wp_nonce_url( admin_url( 'admin-post.php?action=santino_sync_specific_page&target_page_id=' . $post->ID . '&layout_type=membership_solution' ), 'santino_sync_nonce_' . $post->ID );
        $is_menu       = ( 23 === (int) $post->ID || 'menu' === $post->post_name );
        ?>
        <div style="font-size: 13px; line-height: 1.5;">
            <p style="margin-top: 0; color: #475569;">
                <?php _e( 'Instantly push clean Elementor section structures to this page.', 'santino' ); ?>
            </p>
            <p>
                <?php if ( $is_menu ) : ?>
                <a href="<?php echo esc_url( $sync_url_menu ); ?>" class="button button-primary" style="width: 100%; text-align: center; margin-bottom: 6px; background: #00625d; border-color: #004d49;" onclick="return confirm('Sync this page to 5 modular Menu Elementor widgets?');">
                    <?php _e( '⚡ Sync 5 Menu Sections (Hero + Grid + VIP + App + Branches)', 'santino' ); ?>
                </a>
                <?php else : ?>
                <a href="<?php echo esc_url( $sync_url_3sec ); ?>" class="button button-primary" style="width: 100%; text-align: center; margin-bottom: 6px;" onclick="return confirm('Sync this page to 3 clean Elementor sections?');">
                    <?php _e( '⚡ Sync 3 Sections (Hero + Portal + CTA)', 'santino' ); ?>
                </a>
                <a href="<?php echo esc_url( $sync_url_vip ); ?>" class="button button-secondary" style="width: 100%; text-align: center;" onclick="return confirm('Sync this page to VIP Membership layout?');">
                    <?php _e( 'Sync VIP Membership Layout', 'santino' ); ?>
                </a>
                <?php endif; ?>
            </p>
            <p class="description" style="font-size: 11px;">
                <?php _e( 'Overwrites elementor data with individual editable widgets and clears cache.', 'santino' ); ?>
            </p>
        </div>
        <?php
    }

    public static function add_admin_bar_item( $wp_admin_bar ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $post_id = 0;
        if ( is_page() ) {
            $post_id = get_the_ID();
        } elseif ( is_admin() && isset( $_GET['post'] ) ) {
            $post_id = intval( $_GET['post'] );
        }

        if ( $post_id ) {
            $post = get_post( $post_id );
            if ( $post && 'page' === $post->post_type ) {
                $sync_url = wp_nonce_url( admin_url( 'admin-post.php?action=santino_sync_specific_page&target_page_id=' . $post_id . '&layout_type=three_sections' ), 'santino_sync_nonce_' . $post_id );
                $wp_admin_bar->add_node( array(
                    'id'    => 'santino_sync_page',
                    'title' => '<span class="ab-icon dashicons dashicons-update"></span> ' . __( 'Sync to 3 Elementor Sections', 'santino' ),
                    'href'  => $sync_url,
                    'meta'  => array(
                        'onclick' => 'return confirm("Sync this page to 3 clean Elementor sections?");',
                        'title'   => __( 'Click to sync this specific page into 3 clean Elementor sections', 'santino' ),
                    ),
                ) );
            }
        }
    }

    public static function handle_specific_page_sync() {
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Unauthorized' );
        }

        $page_id = isset( $_REQUEST['target_page_id'] ) ? intval( $_REQUEST['target_page_id'] ) : 0;
        if ( ! empty( $_REQUEST['custom_page_id'] ) ) {
            $page_id = intval( $_REQUEST['custom_page_id'] );
        }

        if ( ! $page_id && ! empty( $_REQUEST['create_slug'] ) ) {
            $slug = sanitize_title( $_REQUEST['create_slug'] );
            $existing = get_page_by_path( $slug );
            if ( $existing ) {
                $page_id = $existing->ID;
            } else {
                $page_id = wp_insert_post( array(
                    'post_title'     => ucfirst( $slug ),
                    'post_name'      => $slug,
                    'post_status'    => 'publish',
                    'post_type'      => 'page',
                    'comment_status' => 'closed',
                    'ping_status'    => 'closed',
                ) );
            }
        }

        if ( ! $page_id ) {
            wp_die( 'Invalid page ID specified.' );
        }

        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'santino_sync_specific_page_nonce' ) && ! wp_verify_nonce( $_REQUEST['_wpnonce'] ?? '', 'santino_sync_nonce_' . $page_id ) ) {
            wp_die( 'Security check failed. Please refresh and try again.' );
        }

        $post = get_post( $page_id );

        if ( ! $post ) {
            wp_die( 'Page not found with ID: ' . esc_html( $page_id ) );
        }

        $is_menu_page      = ( ( isset( $_REQUEST['layout_type'] ) && in_array( $_REQUEST['layout_type'], array( 'menu_native', 'menu_sections' ), true ) ) || 'menu' === $post->post_name || 23 === (int) $page_id );
        $is_vip_membership = ( 22 === (int) $page_id || 'membership' === $post->post_name );
        $is_offers_page    = ( 'offers' === $post->post_name );
        $is_our_story_page = ( 'our-story' === $post->post_name );
        $is_member_portal  = ( 36426 === (int) $page_id || in_array( $post->post_name, array( 'santino-member', 'coffee-club' ), true ) || false !== stripos( $post->post_title, 'Santino Member' ) );

        if ( $is_menu_page ) {
            update_post_meta( $page_id, '_wp_page_template', 'templates/template-menu.php' );
            update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
            update_post_meta( $page_id, '_elementor_version', '3.25.0' );
            if ( class_exists( 'Santino_Handcrafted_Items_System' ) && method_exists( 'Santino_Handcrafted_Items_System', 'maybe_seed_items' ) ) {
                Santino_Handcrafted_Items_System::maybe_seed_items();
            }
            if ( class_exists( 'Santino_Membership_System' ) && method_exists( 'Santino_Membership_System', 'get_branches_detailed' ) ) {
                Santino_Membership_System::get_branches_detailed();
            }
            $structure = self::get_menu_five_sections_structure();
        } else {
            update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
            update_post_meta( $page_id, '_elementor_version', '3.25.0' );

            if ( $is_vip_membership ) {
                update_post_meta( $page_id, '_wp_page_template', 'templates/template-membership.php' );
                $structure = self::get_membership_four_sections_structure();
            } elseif ( $is_offers_page ) {
                update_post_meta( $page_id, '_wp_page_template', 'templates/template-offers.php' );
                $structure = self::get_offers_three_sections_structure();
            } elseif ( $is_our_story_page ) {
                update_post_meta( $page_id, '_wp_page_template', 'templates/template-our-story.php' );
                $structure = self::get_our_story_six_sections_structure();
            } elseif ( $is_member_portal ) {
                update_post_meta( $page_id, '_wp_page_template', 'templates/template-santino-member.php' );
                $structure = self::get_santino_member_three_sections_structure();
            } else {
                $all_structures = class_exists( 'Santino_Demo_Importer' ) ? Santino_Demo_Importer::get_all_structures() : array();
                if ( isset( $all_structures[ $post->post_name ] ) ) {
                    $structure = $all_structures[ $post->post_name ];
                } else {
                    $structure = self::get_santino_member_three_sections_structure();
                }
            }
        }

        $json = wp_json_encode( $structure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
        update_post_meta( $page_id, '_elementor_data', wp_slash( $json ) );
        delete_post_meta( $page_id, '_elementor_css' );

        // Empty post_content & remove revisions/autosaves so Elementor never opens old monolithic widget or text editor
        wp_update_post( array( 'ID' => $page_id, 'post_content' => '' ) );
        $revisions = wp_get_post_revisions( $page_id );
        if ( ! empty( $revisions ) ) {
            foreach ( $revisions as $rev ) {
                wp_delete_post_revision( $rev->ID );
            }
        }

        if ( class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }

        $redirect = add_query_arg( array(
            'page'         => 'santino-elementor-syncer',
            'synced_id'    => $page_id,
            'synced_title' => rawurlencode( $post->post_title ),
        ), admin_url( 'admin.php' ) );

        wp_safe_redirect( $redirect );
        exit;
    }

    public static function render_admin_syncer_page() {
        $all_pages = get_posts( array(
            'post_type'      => 'page',
            'post_status'    => array( 'publish', 'draft', 'pending', 'private' ),
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ) );

        $synced_id     = isset( $_GET['synced_id'] ) ? intval( $_GET['synced_id'] ) : 0;
        $synced_title  = isset( $_GET['synced_title'] ) ? sanitize_text_field( rawurldecode( $_GET['synced_title'] ) ) : '';
        $cleaned_count = isset( $_GET['cleaned_count'] ) ? intval( $_GET['cleaned_count'] ) : -1;

        $protected    = self::get_protected_page_ids_and_slugs();
        $unused_count = 0;
        foreach ( $all_pages as $ap ) {
            if ( ! self::is_page_protected( $ap, $protected ) ) {
                $unused_count++;
            }
        }
        $cleanup_url = wp_nonce_url( admin_url( 'admin-post.php?action=santino_cleanup_unused_pages' ), 'santino_cleanup_unused_pages' );
        ?>
        <div class="wrap" style="max-width: 1400px; margin: 25px auto;">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                <div>
                    <h1 class="wp-heading-inline" style="font-size: 24px; font-weight: 800; color: #004d49; margin: 0;">
                        <?php _e( 'Elementor Page Syncer', 'santino' ); ?>
                    </h1>
                    <span class="count" style="margin-left: 10px; color: #64748b; font-weight: 600; font-size: 14px;">(<?php echo count( $all_pages ); ?> <?php _e( 'Pages', 'santino' ); ?>)</span>
                </div>
                <div>
                    <?php if ( $unused_count > 0 ) : ?>
                        <a href="<?php echo esc_url( $cleanup_url ); ?>" class="button" style="background: #dc2626; border-color: #b91c1c; color: #ffffff; font-weight: 700; padding: 4px 14px; height: auto;" onclick="return confirm('<?php echo esc_js( sprintf( __( 'Move %d unused page(s) to Trash? All %d required/menu/system pages and their data will remain 100%% safe.', 'santino' ), $unused_count, count( $all_pages ) - $unused_count ) ); ?>');">
                            🗑️ <?php echo sprintf( __( 'Remove %d Unused Pages (Move to Trash)', 'santino' ), $unused_count ); ?>
                        </a>
                    <?php else : ?>
                        <span class="button disabled" style="background: #f1f5f9; color: #64748b; border-color: #cbd5e1; font-weight: 600;">
                            ✓ <?php _e( 'All Pages Are Needed (0 Unused)', 'santino' ); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <hr class="wp-header-end" style="margin-bottom: 20px;">

            <?php if ( $cleaned_count >= 0 ) : ?>
                <div class="notice notice-success is-dismissible" style="border-left-color: #00625d; padding: 14px 18px; margin: 15px 0 25px 0; border-radius: 6px; background: #f0fdf4;">
                    <strong style="color: #166534;">✓ <?php echo sprintf( __( '%d unused page(s) moved to Trash. All required pages and their data are untouched.', 'santino' ), $cleaned_count ); ?></strong>
                </div>
            <?php endif; ?>

            <?php if ( $synced_id ) : 
                $el_edit_url = admin_url( 'post.php?post=' . $synced_id . '&action=elementor' );
                $view_url    = get_permalink( $synced_id );
            ?>
                <div class="notice notice-success is-dismissible" style="border-left-color: #00625d; padding: 14px 18px; margin: 15px 0 25px 0; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); background: #f0fdf4;">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
                        <div>
                            <strong style="color: #166534; font-size: 15px;">✓ <?php _e( 'Page Synced Successfully!', 'santino' ); ?></strong>
                            <span style="color: #15803d; font-size: 14px; margin-left: 6px;">
                                <?php echo sprintf( __( 'Page #%d ("%s") was pushed into Elementor with clean section structures.', 'santino' ), $synced_id, esc_html( $synced_title ) ); ?>
                            </span>
                        </div>
                        <div style="display: flex; gap: 8px;">
                            <a href="<?php echo esc_url( $el_edit_url ); ?>" class="button button-primary" target="_blank" style="background:#00625d; border-color:#004d49; font-weight: 600;">
                                ✏️ <?php _e( 'Open in Elementor Editor', 'santino' ); ?> &rarr;
                            </a>
                            <a href="<?php echo esc_url( $view_url ); ?>" class="button button-secondary" target="_blank">
                                👁️ <?php _e( 'View Live', 'santino' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 18px;">
                <?php foreach ( $all_pages as $p ) : 
                    $p_id        = $p->ID;
                    $sync_url    = wp_nonce_url( admin_url( 'admin-post.php?action=santino_sync_specific_page&target_page_id=' . $p_id ), 'santino_sync_nonce_' . $p_id );
                    $el_edit_url = admin_url( 'post.php?post=' . $p_id . '&action=elementor' );
                    $is_el        = get_post_meta( $p_id, '_elementor_edit_mode', true ) === 'builder';
                    $is_protected = self::is_page_protected( $p, $protected );
                    $is_special   = ( 36426 === (int) $p_id || in_array( $p->post_name, array( 'santino-member', 'membership', 'coffee-club', 'offers' ), true ) );
                ?>
                    <div class="postbox" style="padding: 18px 20px; margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between; border-radius: 8px; border: 1px solid <?php echo $is_special ? '#00625d' : ( $is_protected ? '#cbd5e1' : '#fca5a5' ); ?>; <?php if ( $is_special ) echo 'border-left: 4px solid #00625d;'; ?> box-shadow: 0 2px 6px rgba(0,0,0,0.03); background: #ffffff;">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 8px; margin-bottom: 6px;">
                                <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: #0f172a; line-height: 1.35;">
                                    <?php echo esc_html( $p->post_title ?: __( '(no title)', 'santino' ) ); ?>
                                </h3>
                                <span style="font-size: 11px; font-weight: 600; padding: 2px 7px; border-radius: 4px; background: <?php echo $is_el ? '#dcfce7' : '#f1f5f9'; ?>; color: <?php echo $is_el ? '#166534' : '#64748b'; ?>; white-space: nowrap;">
                                    #<?php echo esc_html( $p_id ); ?>
                                </span>
                            </div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 16px; display: flex; align-items: center; justify-content: space-between; gap: 6px;">
                                <code>/<?php echo esc_html( $p->post_name ); ?>/</code>
                                <span style="font-size: 10.5px; font-weight: 700; padding: 2px 6px; border-radius: 4px; background: <?php echo $is_protected ? '#ecfdf5' : '#fef2f2'; ?>; color: <?php echo $is_protected ? '#047857' : '#b91c1c'; ?>;">
                                    <?php echo $is_protected ? __( 'Protected', 'santino' ) : __( 'Unused', 'santino' ); ?>
                                </span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 8px; align-items: center; padding-top: 14px; border-top: 1px solid #f1f5f9;">
                            <a href="<?php echo esc_url( $sync_url ); ?>" class="button button-primary" style="flex: 1; text-align: center; background: #00625d; border-color: #004d49; font-weight: 600; font-size: 13px; height: 34px; line-height: 32px;" onclick="return confirm('Sync \'<?php echo esc_js( $p->post_title ); ?>\' (#<?php echo $p_id; ?>) into Elementor?');">
                                ⚡ <?php _e( 'Sync', 'santino' ); ?>
                            </a>
                            <?php if ( $is_el ) : ?>
                                <a href="<?php echo esc_url( $el_edit_url ); ?>" class="button button-secondary" target="_blank" style="font-size: 12px; height: 34px; line-height: 32px; padding: 0 10px;" title="<?php esc_attr_e( 'Edit in Elementor', 'santino' ); ?>">
                                    ✏️ <?php _e( 'Edit', 'santino' ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }

    public static function auto_split_legacy_member_page() {
        $target_ids = array( 36426, 22, 23 );
        if ( isset( $_GET['post'] ) ) {
            $target_ids[] = intval( $_GET['post'] );
        }

        $slugs = array( 'santino-member', 'membership', 'coffee-club', 'menu', 'offers' );
        foreach ( $slugs as $slug ) {
            $p = get_page_by_path( $slug );
            if ( $p ) {
                $target_ids[] = $p->ID;
            }
        }

        $member_pages = get_posts( array(
            'post_type'      => 'page',
            'post_status'    => 'any',
            'posts_per_page' => 20,
            'meta_query'     => array(
                'relation' => 'OR',
                array(
                    'key'     => '_elementor_data',
                    'value'   => 'santino_member_portal',
                    'compare' => 'LIKE',
                ),
                array(
                    'key'     => '_elementor_data',
                    'value'   => 'santino_membership_solution',
                    'compare' => 'LIKE',
                ),
            ),
        ) );
        foreach ( $member_pages as $mp ) {
            $target_ids[] = $mp->ID;
        }

        $target_ids = array_unique( array_filter( $target_ids ) );

        $cache_cleared = false;
        foreach ( $target_ids as $pid ) {
            $post = get_post( $pid );
            if ( ! $post ) {
                continue;
            }

            $el_data           = get_post_meta( $pid, '_elementor_data', true );
            $is_vip_membership = ( 22 === (int) $pid || 'membership' === $post->post_name );
            $is_offers_page    = ( 'offers' === $post->post_name );
            $is_member_portal  = ( 36426 === (int) $pid || in_array( $post->post_name, array( 'santino-member', 'coffee-club' ), true ) || false !== stripos( $post->post_title, 'Santino Member' ) );
            $is_menu_page      = ( 23 === (int) $pid || 'menu' === $post->post_name );

            if ( $is_menu_page ) {
                if ( empty( $el_data ) || false !== strpos( $el_data, 'santino_menu_solution' ) || get_post_meta( $pid, '_elementor_edit_mode', true ) !== 'builder' ) {
                    $structure = self::get_menu_five_sections_structure();
                    $json      = wp_json_encode( $structure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                    update_post_meta( $pid, '_elementor_data', wp_slash( $json ) );
                    update_post_meta( $pid, '_elementor_edit_mode', 'builder' );
                    update_post_meta( $pid, '_elementor_version', '3.25.0' );
                    update_post_meta( $pid, '_wp_page_template', 'templates/template-menu.php' );
                    delete_post_meta( $pid, '_elementor_css' );

                    if ( ! empty( $post->post_content ) ) {
                        wp_update_post( array( 'ID' => $pid, 'post_content' => '' ) );
                    }

                    $revisions = wp_get_post_revisions( $pid );
                    if ( ! empty( $revisions ) ) {
                        foreach ( $revisions as $rev ) {
                            wp_delete_post_revision( $rev->ID );
                        }
                    }
                    $cache_cleared = true;
                }
            } elseif ( $is_vip_membership ) {
                $already_migrated = get_post_meta( $pid, '_santino_split_migrated', true );
                if ( ! empty( $el_data ) && false === strpos( $el_data, 'santino_membership_solution' ) ) {
                    update_post_meta( $pid, '_santino_split_migrated', '1' );
                }
                if ( ! $already_migrated && ( empty( $el_data ) || false !== strpos( $el_data, 'santino_membership_solution' ) ) ) {
                    $structure = self::get_membership_four_sections_structure();
                    $json      = wp_json_encode( $structure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                    update_post_meta( $pid, '_elementor_data', wp_slash( $json ) );
                    update_post_meta( $pid, '_elementor_edit_mode', 'builder' );
                    update_post_meta( $pid, '_elementor_version', '3.25.0' );
                    update_post_meta( $pid, '_wp_page_template', 'templates/template-membership.php' );
                    update_post_meta( $pid, '_santino_split_migrated', '1' );
                    delete_post_meta( $pid, '_elementor_css' );

                    if ( ! empty( $post->post_content ) ) {
                        wp_update_post( array( 'ID' => $pid, 'post_content' => '' ) );
                    }

                    $revisions = wp_get_post_revisions( $pid );
                    if ( ! empty( $revisions ) ) {
                        foreach ( $revisions as $rev ) {
                            wp_delete_post_revision( $rev->ID );
                        }
                    }
                    $cache_cleared = true;
                }
            } elseif ( $is_offers_page ) {
                $already_migrated = get_post_meta( $pid, '_santino_split_migrated', true );
                if ( ! $already_migrated && empty( $el_data ) ) {
                    $structure = self::get_offers_three_sections_structure();
                    $json      = wp_json_encode( $structure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                    update_post_meta( $pid, '_elementor_data', wp_slash( $json ) );
                    update_post_meta( $pid, '_elementor_edit_mode', 'builder' );
                    update_post_meta( $pid, '_elementor_version', '3.25.0' );
                    update_post_meta( $pid, '_wp_page_template', 'templates/template-offers.php' );
                    update_post_meta( $pid, '_santino_split_migrated', '1' );
                    delete_post_meta( $pid, '_elementor_css' );
                    $cache_cleared = true;
                }
            } elseif ( $is_member_portal || ( ! empty( $el_data ) && false !== strpos( $el_data, 'santino_member_portal' ) ) ) {
                $already_migrated = get_post_meta( $pid, '_santino_split_migrated', true );
                if ( ! empty( $el_data ) && false === strpos( $el_data, 'santino_member_portal' ) ) {
                    update_post_meta( $pid, '_santino_split_migrated', '1' );
                }
                if ( ! $already_migrated && ( empty( $el_data ) || false !== strpos( $el_data, 'santino_member_portal' ) ) ) {
                    $structure = self::get_santino_member_three_sections_structure();
                    $json      = wp_json_encode( $structure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                    update_post_meta( $pid, '_elementor_data', wp_slash( $json ) );
                    update_post_meta( $pid, '_elementor_edit_mode', 'builder' );
                    update_post_meta( $pid, '_elementor_version', '3.25.0' );
                    update_post_meta( $pid, '_wp_page_template', 'templates/template-santino-member.php' );
                    update_post_meta( $pid, '_santino_split_migrated', '1' );
                    delete_post_meta( $pid, '_elementor_css' );

                    if ( ! empty( $post->post_content ) ) {
                        wp_update_post( array( 'ID' => $pid, 'post_content' => '' ) );
                    }

                    $revisions = wp_get_post_revisions( $pid );
                    if ( ! empty( $revisions ) ) {
                        foreach ( $revisions as $rev ) {
                            wp_delete_post_revision( $rev->ID );
                        }
                    }
                    $cache_cleared = true;
                }
            }
        }

        if ( $cache_cleared && class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }
    }

    public static function get_santino_member_three_sections_structure() {
        return array(
            array(
                'id'       => substr( md5( 'sec_hero_banner_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '1. Hero Banner & Metrics',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_hero_banner_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_hero_banner_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_hero',
                                'settings'   => array(
                                    'badge_text'     => 'SANTINO VIP MEMBER PORTAL',
                                    'title'          => 'Santino Member Club &amp; Rewards',
                                    'desc'           => 'Track your 5-cup coffee stamps, upload cafe invoices, and claim your free 6th handcrafted cup across Santino partner cafes.',
                                    'btn1_text'      => 'Check Stamp Card',
                                    'btn1_url'       => array( 'url' => '#clubPortal' ),
                                    'btn2_text'      => 'Log Invoice Memo',
                                    'btn2_url'       => array( 'url' => '#invoice-tab' ),
                                    'show_metrics'   => 'yes',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_member_portal_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '2. Member VIP Portal & Stamp Card',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_member_portal_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_member_portal_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_portal',
                                'settings'   => array(
                                    'badge_text'  => 'VIP LOYALTY REWARDS',
                                    'title'       => 'Digital Coffee Stamp Card &amp; Club Portal',
                                    'desc'        => 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!',
                                    'card_sub'    => 'SANTINO COFFEE CLUB',
                                    'card_title'  => 'Regular Member',
                                    'tab1_title'  => 'Check Stamp Status',
                                    'tab2_title'  => 'Log Invoice',
                                    'tab3_title'  => 'Join Coffee Club',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_cafe_cta_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '3. Member Cafe CTA',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_cafe_cta_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_cafe_cta_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_cta',
                                'settings'   => array(
                                    'badge_text' => 'VISIT OUR CAFES',
                                    'title'      => 'Ready For Your Next Handcrafted Brew?',
                                    'desc'       => 'Visit our barista bars across Gulshan, Banani, Dhanmondi & Uttara.',
                                    'btn_text'   => 'Explore Full Menu →',
                                    'btn_url'    => array( 'url' => '/menu/' ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
    }

    public static function get_offers_three_sections_structure() {
        return array(
            array(
                'id'       => substr( md5( 'sec_offers_hero_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '1. Offers Hero Banner',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_offers_hero_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_offers_hero_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_hero',
                                'settings'   => array(
                                    'badge_text' => '7 DAYS, 7 REASONS TO CELEBRATE',
                                    'title'      => 'Daily <span style="color: #dfbe8d;">3 + 1 FREE</span> Cafe Offers',
                                    'desc'       => 'Order 3 handcrafted cups and get the 4th free every day of the week — plus earn 3 VIP Stamps toward your 5-Cup Free Drink Card!',
                                    'btn1_text'  => 'See Today\'s Offer',
                                    'btn1_url'   => array( 'url' => '#dailyPromos' ),
                                    'btn2_text'  => 'VIP Stamp Portal',
                                    'btn2_url'   => array( 'url' => '/membership/#clubPortal' ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_offers_grid_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '2. Dynamic 7-Day Promotions',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_offers_grid_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_offers_grid_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_daily_promotions',
                                'settings'   => array(
                                    'layout'      => 'grid',
                                    'data_source' => 'wp_admin',
                                    'show_header' => 'yes',
                                    'badge_text'  => '7 DAYS, 7 REASONS TO CELEBRATE',
                                    'title'       => 'Daily Special <span class="sec-title-accent">3 + 1 FREE</span> Offers',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_offers_cta_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '3. VIP Stack & Stamp CTA',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_offers_cta_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_offers_cta_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_cta',
                                'settings'   => array(
                                    'badge_text' => 'STACK WITH VIP CLUB',
                                    'title'      => 'Double Your Rewards With VIP Membership',
                                    'desc'       => 'Claim any 3 + 1 FREE daily offer and submit your invoice in the Santino VIP Portal to collect 3 Coffee Stamps + 15% off artisan beans.',
                                    'btn_text'   => 'Log Invoice & Earn Stamps →',
                                    'btn_url'    => array( 'url' => '/membership/#clubPortal' ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
    }

    public static function get_membership_four_sections_structure() {
        return array(
            array(
                'id'       => substr( md5( 'sec_vip_hero_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '1. Hero Banner & Metrics',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_vip_hero_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_vip_hero_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_hero',
                                'settings'   => array(
                                    'badge_text'     => 'SANTINO VIP COFFEE CLUB',
                                    'title'          => 'Exclusive Connoisseur <span style="color: #dfbe8d;">Privileges</span>',
                                    'desc'           => 'Private cupping sessions, seasonal micro-lot allocations, and 15% VIP artisan bean discounts across Bangladesh.',
                                    'btn1_text'      => 'Join Coffee Club',
                                    'btn1_url'       => array( 'url' => '#clubPortal' ),
                                    'btn2_text'      => 'Explore Perks',
                                    'btn2_url'       => array( 'url' => '#perks' ),
                                    'show_metrics'   => 'yes',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_vip_perks_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '2. Exclusive VIP Perks',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_vip_perks_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_vip_perks_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_perks',
                                'settings'   => array(
                                    'badge_text' => 'EXCLUSIVE PRIVILEGES',
                                    'title'      => 'Crafted Exclusively for Connoisseurs',
                                    'desc'       => 'Elevate every cup with exclusive roastery privileges, private sensory workshops, and member-only pricing.',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_daily_promos_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '2.5 Daily 3+1 FREE Offers',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_daily_promos_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_daily_promos_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_daily_promotions',
                                'settings'   => array(
                                    'layout'     => 'grid',
                                    'badge_text' => '7 DAYS, 7 REASONS TO CELEBRATE',
                                    'title'      => 'Daily Special <span class="sec-title-accent">3 + 1 FREE</span> Offers',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_vip_portal_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '3. VIP Loyalty Portal & Stamp Card',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_vip_portal_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_vip_portal_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_portal',
                                'settings'   => array(
                                    'badge_text'  => 'VIP LOYALTY REWARDS',
                                    'title'       => 'Digital Coffee Stamp Card &amp; Club Portal',
                                    'desc'        => 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!',
                                    'card_sub'    => 'SANTINO VIP COFFEE CLUB',
                                    'card_title'  => 'VIP Connoisseur Member',
                                    'tab1_title'  => 'Check Stamp Status',
                                    'tab2_title'  => 'Log Invoice',
                                    'tab3_title'  => 'Join Coffee Club',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_vip_cta_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '4. Member Cafe CTA',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_vip_cta_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_vip_cta_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_membership_cta',
                                'settings'   => array(
                                    'badge_text' => 'VISIT OUR CAFES',
                                    'title'      => 'Ready For Your Next Handcrafted Brew?',
                                    'desc'       => 'Visit our barista bars across Gulshan, Banani, Dhanmondi & Uttara.',
                                    'btn_text'   => 'Explore Full Menu →',
                                    'btn_url'    => array( 'url' => '/menu/' ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
    }

    public static function get_menu_five_sections_structure() {
        return array(
            array(
                'id'       => substr( md5( 'sec_menu_hero_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '1. Hero & Live Search',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_menu_hero_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_menu_hero_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_menu_hero',
                                'settings'   => array(
                                    'badge_text'         => 'SANTINO SIGNATURE CAFE MENU',
                                    'title_main'         => 'Artisan Coffee &',
                                    'title_accent'       => 'Beverage Menu',
                                    'desc_text'          => 'Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.',
                                    'search_placeholder'=> 'Search espresso, cold brew, matcha...',
                                    'category_banners'   => array(
                                        array(
                                            '_id'          => 'b1',
                                            'banner_img'   => array( 'url' => santino_img( 'banner-signature-lattes.jpg' ) ),
                                            'banner_title' => 'Signature Lattes',
                                            'banner_slug'  => 'signature-lattes',
                                        ),
                                        array(
                                            '_id'          => 'b2',
                                            'banner_img'   => array( 'url' => santino_img( 'banner-barista-coffee.jpg' ) ),
                                            'banner_title' => 'Barista Coffee',
                                            'banner_slug'  => 'barista-coffee',
                                        ),
                                        array(
                                            '_id'          => 'b3',
                                            'banner_img'   => array( 'url' => santino_img( 'banner-fruity-americano.jpg' ) ),
                                            'banner_title' => 'Fruity Americano',
                                            'banner_slug'  => 'fruity-americano',
                                        ),
                                        array(
                                            '_id'          => 'b4',
                                            'banner_img'   => array( 'url' => santino_img( 'banner-soe-espresso.jpg' ) ),
                                            'banner_title' => 'Single Origin (SOE)',
                                            'banner_slug'  => 'soe-espresso',
                                        ),
                                        array(
                                            '_id'          => 'b5',
                                            'banner_img'   => array( 'url' => santino_img( 'banner-matcha-tea.jpg' ) ),
                                            'banner_title' => 'Matcha & Frappe',
                                            'banner_slug'  => 'matcha-tea',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_menu_grid_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '2. Handcrafted Items Grid',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_menu_grid_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_menu_grid_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_menu_grid',
                                'settings'   => array(
                                    'grid_badge'        => 'FRESHLY BREWED',
                                    'grid_title'        => 'All Handcrafted',
                                    'grid_title_accent' => 'Items',
                                    'grid_desc'         => 'Showing specialty beverages and gourmet items',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_menu_vip_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '3. VIP Club Poster',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_menu_vip_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_menu_vip_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_menu_vip',
                                'settings'   => array(
                                    'vip_badge'        => 'EXCLUSIVE VIP PRIVILEGE',
                                    'vip_title'        => 'Premium Beans,',
                                    'vip_title_accent' => 'Hot & Cold Hero Brews',
                                    'vip_desc'         => 'Explore our barista favorites including Hot Cappuccino, Iced Latte, Rich Hot Mocha, Iced Mocha, and ice-blended Frappes crafted with 100% premium roasted beans.',
                                    'btn1_text'        => 'Buy 5 Get 6th Free',
                                    'btn1_url'         => '/membership/',
                                    'btn2_text'        => 'Explore Full Menu',
                                    'btn2_url'         => '#menuGridSection',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_menu_app_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '4. Mobile App Banner',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_menu_app_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_menu_app_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_menu_app',
                                'settings'   => array(
                                    'app_badge'  => 'MOBILE REWARDS & ORDERING',
                                    'app_title'  => 'Download the Santino Coffee App',
                                    'app_sub'    => 'Save time with swift order pickup, earn reward beans on every roast, and access exclusive member privileges.',
                                    'play_text'  => 'Google Play',
                                    'play_url'   => 'https://play.google.com',
                                    'apple_text' => 'App Store',
                                    'apple_url'  => 'https://apps.apple.com',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'id'       => substr( md5( 'sec_menu_branches_' . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'isInner'  => false,
                'settings' => array(
                    '_title' => '5. Cafes & Hubs Locator',
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'col_menu_branches_' . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'isInner'  => false,
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'w_menu_branches_' . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'isInner'    => false,
                                'widgetType' => 'santino_menu_branches',
                                'settings'   => array(
                                    'branches_badge'        => 'EXPERIENCE SANTINO NATIONWIDE',
                                    'branches_title'        => 'Our Cafes &',
                                    'branches_title_accent' => 'Roastery Hubs',
                                    'branches_sub'          => 'Step into an artisan coffee retreat or visit our partner express bars across prime Dhaka locations',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
    }

    public static function get_our_story_six_sections_structure() {
        $configs = self::get_pages_config();
        $widgets = $configs['our-story']['widgets'] ?? array();
        $structure = array();
        foreach ( $widgets as $idx => $w_item ) {
            $structure[] = array(
                'id'       => substr( md5( 'our_story_sec_' . $idx . microtime() ), 0, 7 ),
                'elType'   => 'section',
                'settings' => array(
                    'layout' => 'full_width',
                    'gap'    => 'no',
                ),
                'elements' => array(
                    array(
                        'id'       => substr( md5( 'our_story_col_' . $idx . microtime() ), 0, 7 ),
                        'elType'   => 'column',
                        'settings' => array( '_column_size' => 100 ),
                        'elements' => array(
                            array(
                                'id'         => substr( md5( 'our_story_w_' . $idx . microtime() ), 0, 7 ),
                                'elType'     => 'widget',
                                'widgetType' => $w_item['widget'],
                                'settings'   => $w_item['settings'] ?? array(),
                            ),
                        ),
                    ),
                ),
            );
        }
        return $structure;
    }

    public static function get_pages_config() {
        return array(
            'menu' => array(
                'title'    => 'Beverage & Cafe Menu',
                'template' => 'templates/template-menu.php',
                'widgets'  => array(
                    array(
                        'widget'   => 'santino_menu_hero',
                        'settings' => array(
                            'badge_text'         => 'SANTINO SIGNATURE CAFE MENU',
                            'title_main'         => 'Artisan Coffee &',
                            'title_accent'       => 'Beverage Menu',
                            'desc_text'          => 'Crafted with master roasted beans, plant-based dairy, and precision Italian extraction.',
                            'search_placeholder'=> 'Search espresso, cold brew, matcha...',
                            'category_banners'   => array(
                                array(
                                    '_id'          => 'b1',
                                    'banner_img'   => array( 'url' => santino_img( 'banner-signature-lattes.jpg' ) ),
                                    'banner_title' => 'Signature Lattes',
                                    'banner_slug'  => 'signature-lattes',
                                ),
                                array(
                                    '_id'          => 'b2',
                                    'banner_img'   => array( 'url' => santino_img( 'banner-barista-coffee.jpg' ) ),
                                    'banner_title' => 'Barista Coffee',
                                    'banner_slug'  => 'barista-coffee',
                                ),
                                array(
                                    '_id'          => 'b3',
                                    'banner_img'   => array( 'url' => santino_img( 'banner-fruity-americano.jpg' ) ),
                                    'banner_title' => 'Fruity Americano',
                                    'banner_slug'  => 'fruity-americano',
                                ),
                                array(
                                    '_id'          => 'b4',
                                    'banner_img'   => array( 'url' => santino_img( 'banner-soe-espresso.jpg' ) ),
                                    'banner_title' => 'Single Origin (SOE)',
                                    'banner_slug'  => 'soe-espresso',
                                ),
                                array(
                                    '_id'          => 'b5',
                                    'banner_img'   => array( 'url' => santino_img( 'banner-matcha-tea.jpg' ) ),
                                    'banner_title' => 'Matcha & Frappe',
                                    'banner_slug'  => 'matcha-tea',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'widget'   => 'santino_menu_grid',
                        'settings' => array(
                            'badge_text' => 'HANDCRAFTED BEVERAGES',
                            'title'      => 'Explore Our Barista Menu',
                            'desc'       => 'Every beverage is calibrated to golden extraction standards using single-origin beans and premium dairy.',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_menu_vip',
                        'settings' => array(
                            'badge_text' => 'EXCLUSIVE CLUB PRIVILEGE',
                            'title'      => 'Santino VIP Coffee Club',
                            'desc'       => 'Join hundreds of connoisseurs across Dhaka. Enjoy 15% VIP discounts on artisan beans, private cupping invitations, and your 6th handcrafted drink completely free on us.',
                            'btn1_text'  => 'Join VIP Coffee Club →',
                            'btn1_url'   => array( 'url' => '/membership/' ),
                            'btn2_text'  => 'Digital Stamp Card',
                            'btn2_url'   => array( 'url' => '/santino-member/' ),
                        ),
                    ),
                    array(
                        'widget'   => 'santino_menu_app',
                        'settings' => array(
                            'badge_text' => 'ORDER ON THE GO',
                            'title'      => 'Download Santino Cafe App',
                            'desc'       => 'Skip the queue, customize your roast profile, schedule pick-up, and earn loyalty beans with every espresso sip.',
                            'apple_url'  => array( 'url' => '#' ),
                            'google_url' => array( 'url' => '#' ),
                        ),
                    ),
                    array(
                        'widget'   => 'santino_menu_branches',
                        'settings' => array(
                            'badge_text' => 'FIND A ROASTERY BAR',
                            'title'      => 'Experience Santino Live',
                            'desc'       => 'Visit our certified barista bars and sensory experience lounges across Dhaka.',
                        ),
                    ),
                ),
            ),
            'santino-member' => array(
                'title'    => 'Santino Member Portal',
                'template' => 'templates/template-santino-member.php',
                'widgets'  => array(
                    array(
                        'widget'   => 'santino_membership_hero',
                        'settings' => array(
                            'badge_text'     => 'SANTINO VIP MEMBER PORTAL',
                            'title'          => 'Santino Member Club &amp; Rewards',
                            'desc'           => 'Track your 5-cup coffee stamps, upload cafe invoices, and claim your free 6th handcrafted cup across Santino partner cafes.',
                            'btn1_text'      => 'Check Stamp Card',
                            'btn1_url'       => array( 'url' => '#clubPortal' ),
                            'btn2_text'      => 'Log Invoice Memo',
                            'btn2_url'       => array( 'url' => '#invoice-tab' ),
                            'show_metrics'   => 'yes',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_portal',
                        'settings' => array(
                            'badge_text'  => 'VIP LOYALTY REWARDS',
                            'title'       => 'Digital Coffee Stamp Card &amp; Club Portal',
                            'desc'        => 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!',
                            'card_sub'    => 'SANTINO COFFEE CLUB',
                            'card_title'  => 'Regular Member',
                            'tab1_title'  => 'Check Stamp Status',
                            'tab2_title'  => 'Log Invoice',
                            'tab3_title'  => 'Join Coffee Club',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_cta',
                        'settings' => array(
                            'badge_text' => 'VISIT OUR CAFES',
                            'title'      => 'Ready For Your Next Handcrafted Brew?',
                            'desc'       => 'Visit our barista bars across Gulshan, Banani, Dhanmondi & Uttara.',
                            'btn_text'   => 'Explore Full Menu →',
                            'btn_url'    => array( 'url' => '/menu/' ),
                        ),
                    ),
                ),
            ),
            'membership' => array(
                'title'    => 'VIP Coffee Club Membership',
                'template' => 'templates/template-membership.php',
                'widgets'  => array(
                    array(
                        'widget'   => 'santino_membership_hero',
                        'settings' => array(
                            'badge_text'     => 'SANTINO VIP COFFEE CLUB',
                            'title'          => 'Exclusive Connoisseur <span style="color: #dfbe8d;">Privileges</span>',
                            'desc'           => 'Private cupping sessions, seasonal micro-lot allocations, and 15% VIP artisan bean discounts across Bangladesh.',
                            'btn1_text'      => 'Join Coffee Club',
                            'btn1_url'       => array( 'url' => '#clubPortal' ),
                            'btn2_text'      => 'Explore Perks',
                            'btn2_url'       => array( 'url' => '#perks' ),
                            'show_metrics'   => 'yes',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_perks',
                        'settings' => array(
                            'badge_text'     => 'EXCLUSIVE PRIVILEGES',
                            'title'          => 'Crafted Exclusively for Connoisseurs',
                            'desc'           => 'Elevate every cup with exclusive roastery privileges, private sensory workshops, and member-only pricing.',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_portal',
                        'settings' => array(
                            'badge_text'     => 'VIP LOYALTY REWARDS',
                            'title'          => 'Digital Coffee Stamp Card &amp; Club Portal',
                            'desc'           => 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!',
                            'card_sub'       => 'SANTINO VIP COFFEE CLUB',
                            'card_title'     => 'VIP Connoisseur Member',
                            'tab1_title'     => 'Check Stamp Status',
                            'tab2_title'     => 'Log Invoice',
                            'tab3_title'     => 'Join Coffee Club',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_cta',
                        'settings' => array(
                            'badge_text'     => 'VISIT OUR CAFES',
                            'title'          => 'Ready For Your Next Handcrafted Brew?',
                            'desc'           => 'Visit our barista bars across Gulshan, Banani, Dhanmondi & Uttara.',
                            'btn_text'       => 'Explore Full Menu →',
                            'btn_url'        => array( 'url' => '/menu/' ),
                        ),
                    ),
                ),
            ),
            'coffee-club' => array(
                'title'    => 'Santino Coffee Club',
                'template' => 'templates/template-santino-member.php',
                'widgets'  => array(
                    array(
                        'widget'   => 'santino_membership_hero',
                        'settings' => array(
                            'badge_text'     => 'SANTINO COFFEE CLUB',
                            'title'          => 'Buy 5 Cups, <span style="color: #dfbe8d;">Get 1 Free!</span>',
                            'desc'           => 'Our exclusive digital stamp rewards club for true coffee connoisseurs across Bangladesh.',
                            'btn1_text'      => 'Check Stamp Card',
                            'btn1_url'       => array( 'url' => '#clubPortal' ),
                            'btn2_text'      => 'Log Invoice Memo',
                            'btn2_url'       => array( 'url' => '#invoice-tab' ),
                            'show_metrics'   => 'yes',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_portal',
                        'settings' => array(
                            'badge_text'  => 'VIP LOYALTY REWARDS',
                            'title'       => 'Digital Coffee Stamp Card &amp; Club Portal',
                            'desc'        => 'Enjoy specialty brews across Santino partner cafes. Collect 5 Cup Stamps and claim your 6th Handcrafted Drink 100% Free!',
                            'card_sub'    => 'SANTINO COFFEE CLUB',
                            'card_title'  => 'Regular Member',
                            'tab1_title'  => 'Check Stamp Status',
                            'tab2_title'  => 'Log Invoice',
                            'tab3_title'  => 'Join Coffee Club',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_cta',
                        'settings' => array(
                            'badge_text' => 'VISIT OUR CAFES',
                            'title'      => 'Ready For Your Next Handcrafted Brew?',
                            'desc'       => 'Visit our barista bars across Gulshan, Banani, Dhanmondi & Uttara.',
                            'btn_text'   => 'Explore Full Menu →',
                            'btn_url'    => array( 'url' => '/menu/' ),
                        ),
                    ),
                ),
            ),
            'offers' => array(
                'title'    => 'Daily Offers',
                'template' => 'templates/template-offers.php',
                'widgets'  => array(
                    array(
                        'widget'   => 'santino_membership_hero',
                        'settings' => array(
                            'badge_text' => '7 DAYS, 7 REASONS TO CELEBRATE',
                            'title'      => 'Daily <span style="color: #dfbe8d;">3 + 1 FREE</span> Cafe Offers',
                            'desc'       => 'Order 3 handcrafted cups and get the 4th free every day of the week — plus earn 3 VIP Stamps toward your 5-Cup Free Drink Card!',
                            'btn1_text'  => 'See Today\'s Offer',
                            'btn1_url'   => array( 'url' => '#dailyPromos' ),
                            'btn2_text'  => 'VIP Stamp Portal',
                            'btn2_url'   => array( 'url' => '/membership/#clubPortal' ),
                        ),
                    ),
                    array(
                        'widget'   => 'santino_daily_promotions',
                        'settings' => array(
                            'layout'      => 'grid',
                            'data_source' => 'wp_admin',
                            'show_header' => 'yes',
                            'badge_text'  => '7 DAYS, 7 REASONS TO CELEBRATE',
                            'title'       => 'Daily Special <span class="sec-title-accent">3 + 1 FREE</span> Offers',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_cta',
                        'settings' => array(
                            'badge_text' => 'STACK WITH VIP CLUB',
                            'title'      => 'Double Your Rewards With VIP Membership',
                            'desc'       => 'Claim any 3 + 1 FREE daily offer and submit your invoice in the Santino VIP Portal to collect 3 Coffee Stamps + 15% off artisan beans.',
                            'btn_text'   => 'Log Invoice & Earn Stamps →',
                            'btn_url'    => array( 'url' => '/membership/#clubPortal' ),
                        ),
                    ),
                ),
            ),
            'our-story' => array(
                'title'    => 'About Us (Our Story)',
                'template' => 'templates/template-our-story.php',
                'widgets'  => array(
                    array(
                        'widget'   => 'santino_pro_banner',
                        'settings' => array(
                            'badge_text'   => 'SINCE 1996 • 30+ YEARS ROASTING HERITAGE',
                            'title'        => 'The Game Changer in Specialty Coffee Culture',
                            'subtitle'     => 'From direct origin estates in Ethiopia and Colombia to precision roasting labs, championship barista academies, and nationwide supermarket presence in Bangladesh.',
                            'btn1_text'    => 'Discover Our Story',
                            'btn1_icon'    => 'bi bi-arrow-right',
                            'btn1_target'  => '#vision',
                            'btn2_text'    => 'Explore Menu',
                            'btn2_url'     => '/menu/',
                            'bg_type'      => 'video',
                            'bg_image'     => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_20_santino_-_250522-07574.jpg' ) : '' ),
                            'bg_video_url' => 'https://ilucky-fe-outside-oss-prod.luckincdn.com/iadmin/ab6140f6-129c-4ae9-aaa0-20190c43183b.mp4',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_floating_metrics',
                        'settings' => array(
                            'metric1_num'   => '30+',
                            'metric1_label' => 'Years of Roasting Mastery',
                            'metric1_icon'  => 'bi bi-clock-history',
                            'metric2_num'   => '500+',
                            'metric2_label' => 'Hotels, Cafes & Corporate Hubs',
                            'metric2_icon'  => 'bi bi-building',
                            'metric3_num'   => '100%',
                            'metric3_label' => 'FSSC22000 Food Certified',
                            'metric3_icon'  => 'bi bi-patch-check-fill',
                            'metric4_num'   => '1,000+',
                            'metric4_label' => 'Certified Barista Graduates',
                            'metric4_icon'  => 'bi bi-mortarboard-fill',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_story_vision',
                        'settings' => array(
                            'vision_badge' => 'OUR PURPOSE & VISION',
                            'vision_title' => 'Innovation Grounded in <span class="sec-title-accent">Heritage</span>',
                            'vision_desc'  => 'Santino Coffee was born with a single mission: to empower coffee entrepreneurs, businesses, and coffee lovers with world-class beans, precision machinery, and deep sensory knowledge. We believe that every cup tells a story of dedicated farmers, meticulous roast masters, and passionate baristas.',
                            'vision_cards' => array(
                                array(
                                    '_id'   => 'vc1',
                                    'icon'  => 'bi bi-globe-americas',
                                    'badge' => 'Direct Farm Sourcing',
                                    'title' => 'Authentic Origin',
                                    'desc'  => '100% ethically sourced Rainforest Alliance certified green beans from direct partner estates.',
                                ),
                                array(
                                    '_id'   => 'vc2',
                                    'icon'  => 'bi bi-fire',
                                    'badge' => 'Master Roasting',
                                    'title' => 'Precision Roasting',
                                    'desc'  => 'Custom roast profiles digitally calibrated to temperature, humidity, and peak flavor release.',
                                ),
                                array(
                                    '_id'   => 'vc3',
                                    'icon'  => 'bi bi-shield-check',
                                    'badge' => 'Dedicated 24/7 Care',
                                    'title' => 'Continuous Care',
                                    'desc'  => '24/7 technical breakdown support, preventive maintenance, and barista training academies.',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'widget'   => 'santino_story_chapters',
                        'settings' => array(
                            'chapters_list' => array(
                                array(
                                    '_id'             => 'ch1',
                                    'badge'           => 'CHAPTER 01',
                                    'title'           => 'Artisan Roasting &amp; <span class="sec-title-accent">Quality Without Compromise</span>',
                                    'desc'            => 'Everything we roast represents an unyielding dedication to excellence. Our roastery facilities operate under strict FSSC22000 food safety certifications, roasting single origins and private label blends with high batch consistency.',
                                    'bullets'         => "Rainforest Alliance Certified: Direct farm relationships ensuring sustainable livelihood for growers.\nCustom Private Label OEM: Tailored flavor curves designed for five-star hotels and specialty roasteries.\nReal-Time Profile Tracking: Digital thermocouple logging ensuring ±0.5°C batch consistency.",
                                    'image'           => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'bd-barista-latte-art.jpg' ) : '' ),
                                    'fallback_img'    => 'bd-barista-latte-art.jpg',
                                    'img_badge_icon'  => 'bi bi-fire text-danger fs-4',
                                    'img_badge_title' => 'Artisan Roastery Lab',
                                    'img_badge_sub'   => 'Small Batch Custom Roasts',
                                    'btn_text'        => 'Explore Bean Collections',
                                    'btn_url'         => array( 'url' => '/beans/' ),
                                    'reverse_layout'  => '',
                                ),
                                array(
                                    '_id'             => 'ch2',
                                    'badge'           => 'CHAPTER 02',
                                    'title'           => 'State-of-the-Art Espresso &amp; <span class="sec-title-accent">Bionic Robotics</span>',
                                    'desc'            => 'We partner with the world\'s most prestigious espresso machine innovators — Victoria Arduino, Nuova Simonelli, Kalerm, and CAYE Robotics — delivering commercial extraction consistency that elevates customer retention and operational speed.',
                                    'bullets'         => "T3 Genius PureBrew Technology: Variable water flow and gravimetric dosing on Victoria Arduino Black Eagle & Eagle One.\nCAYE Bionic Barista Robotic Arms: Fully automated 6-axis barista robots delivering flawless latte art in under 60 seconds.\nTurnkey Machine Leasing: Complete corporate rental packages with guaranteed zero-downtime maintenance.",
                                    'image'           => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp' ) : '' ),
                                    'fallback_img'    => 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp',
                                    'img_badge_icon'  => 'bi bi-cpu-fill text-primary fs-4',
                                    'img_badge_title' => 'Next-Gen Automation',
                                    'img_badge_sub'   => 'Victoria Arduino & Bionic Robots',
                                    'btn_text'        => 'View Machine Catalog',
                                    'btn_url'         => array( 'url' => '/machines/' ),
                                    'reverse_layout'  => 'yes',
                                ),
                                array(
                                    '_id'             => 'ch3',
                                    'badge'           => 'CHAPTER 03',
                                    'title'           => 'Empowering the Next Generation of <span class="sec-title-accent">Coffee Leaders</span>',
                                    'desc'            => 'Knowledge is the heartbeat of our craft. Santino Barista Academy offers internationally structured certification programs, crop-to-cup sensory training, and competitive coaching for aspiring champions in Bangladesh.',
                                    'bullets'         => "Foundational to Master Barista: Milk texturing, espresso calibration, workflow ergonomics, and cupping.\nCorporate Staff Upskilling: Standardizing beverage execution across multi-branch restaurant operations.\nSpecialty Brewing Modules: V60, Chemex, Aeropress, Cold Brew, and Syphon sensory mastery.",
                                    'image'           => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'bd-barista-training.jpg' ) : '' ),
                                    'fallback_img'    => 'bd-barista-training.jpg',
                                    'img_badge_icon'  => 'bi bi-trophy-fill text-warning fs-4',
                                    'img_badge_title' => 'Championship Coaching',
                                    'img_badge_sub'   => 'Certified Barista Trainers',
                                    'btn_text'        => 'Enroll in Barista Academy',
                                    'btn_url'         => array( 'url' => '/training/' ),
                                    'reverse_layout'  => '',
                                ),
                                array(
                                    '_id'             => 'ch4',
                                    'badge'           => 'CHAPTER 04',
                                    'title'           => 'Everyday Specialty Coffee for <span class="sec-title-accent">Every Community</span>',
                                    'desc'            => 'We are bridging the gap between luxury specialty coffee and everyday accessibility. Today, Santino roasted bean packs are available on retail shelves at Shwapno Superstores nationwide, and freshly brewed coffees are served across 50+ BFC restaurant locations.',
                                    'bullets'         => "100+ Shwapno Outlets: Freshly sealed 250g & 1kg bags available at your neighborhood supermarket.\n50+ BFC Quick Service Bars: Hot and iced espresso beverages brewed on authentic commercial Italian machines.\nB2B Direct Supply: Fast scheduled deliveries maintaining optimal bean degassing periods.",
                                    'image'           => array( 'url' => function_exists( 'santino_img' ) ? santino_img( 'shwapno_santino_retail.jpg' ) : '' ),
                                    'fallback_img'    => 'shwapno_santino_retail.jpg',
                                    'img_badge_icon'  => 'bi bi-shop-window text-success fs-4',
                                    'img_badge_title' => 'Nationwide Presence',
                                    'img_badge_sub'   => 'Shwapno Superstores & BFC Dining',
                                    'btn_text'        => 'Explore Retail Outlets',
                                    'btn_url'         => array( 'url' => '/swapno/' ),
                                    'reverse_layout'  => 'yes',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'widget'   => 'santino_story_marquee',
                        'settings' => array(
                            'marquee_badge' => 'MOMENTS AT SANTINO',
                            'marquee_title' => 'Inside Our Roastery, <span class="sec-title-accent">Cafes &amp; Labs</span>',
                        ),
                    ),
                    array(
                        'widget'   => 'santino_membership_cta',
                        'settings' => array(
                            'badge_text' => 'BECOME A PARTNER',
                            'title'      => 'Ready to Elevate Your Coffee Experience?',
                            'desc'       => 'Whether you are opening a specialty cafe, outfitting a hotel with commercial espresso machinery, or looking for freshly roasted wholesale beans, Santino is your total solutions partner.',
                            'btn_text'   => 'Explore Drinks Menu →',
                            'btn_url'    => array( 'url' => '/menu/' ),
                        ),
                    ),
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
            } elseif ( false !== strpos( $el_data, 'santino_membership_solution' ) || false !== strpos( $el_data, 'santino_member_portal' ) || false !== strpos( $el_data, 'santino_our_story_solution' ) ) {
                $needs_structure = true;
            }

            if ( $needs_structure ) {
                $structure = array();

                if ( isset( $data['widgets'] ) && is_array( $data['widgets'] ) ) {
                    foreach ( $data['widgets'] as $idx => $w_item ) {
                        $sec_id = substr( md5( $slug . '_sec_' . $idx . time() ), 0, 7 );
                        $col_id = substr( md5( $slug . '_col_' . $idx . time() ), 0, 7 );
                        $w_id   = substr( md5( $slug . '_w_' . $idx . time() ), 0, 7 );

                        $structure[] = array(
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
                                            'widgetType' => $w_item['widget'],
                                            'settings'   => $w_item['settings'] ?? array(),
                                        ),
                                    ),
                                ),
                            ),
                        );
                    }
                } else {
                    $sec_id = substr( md5( $slug . '_sec_' . time() ), 0, 7 );
                    $col_id = substr( md5( $slug . '_col_' . time() ), 0, 7 );
                    $w_id   = substr( md5( $slug . '_w_' . time() ), 0, 7 );

                    $structure[] = array(
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
                                        'settings'   => $data['settings'] ?? array(),
                                    ),
                                ),
                            ),
                        ),
                    );
                }

                $json = wp_json_encode( $structure, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                update_post_meta( $pid, '_elementor_data', wp_slash( $json ) );
                $cache_cleared = true;
            }
        }

        if ( $cache_cleared && class_exists( '\Elementor\Plugin' ) && isset( \Elementor\Plugin::$instance->files_manager ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }
    }
}

Santino_Elementor_Pages_Sync::init();
