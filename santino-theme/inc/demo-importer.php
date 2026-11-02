<?php
/**
 * One-Click Demo Importer & Plugin Recommendation Engine for Santino Theme
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Demo_Importer {

    public static function init() {
        add_action( 'admin_menu', array( __CLASS__, 'register_admin_menu' ) );
        add_action( 'wp_ajax_santino_ajax_import_theme_data', array( __CLASS__, 'handle_ajax_import' ) );
        add_action( 'wp_ajax_santino_ajax_import_menus_only', array( __CLASS__, 'handle_ajax_import_menus_only' ) );
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_admin_assets' ) );
        add_action( 'admin_notices', array( __CLASS__, 'show_setup_prompt_notice' ) );
    }

    public static function register_admin_menu() {
        add_menu_page(
            'Santino Theme Setup & Demo Import',
            'Santino Setup',
            'manage_options',
            'santino-demo-import',
            array( __CLASS__, 'render_admin_page' ),
            'dashicons-coffee',
            3
        );

        add_submenu_page(
            'themes.php',
            'Santino Demo Import',
            'Santino Demo Import',
            'manage_options',
            'santino-demo-import',
            array( __CLASS__, 'render_admin_page' )
        );
    }

    public static function show_setup_prompt_notice() {
        $screen = get_current_screen();
        if ( isset( $screen->id ) && strpos( $screen->id, 'santino-demo-import' ) !== false ) {
            return;
        }

        $home = get_page_by_path( 'home' );
        $is_imported = $home && get_post_meta( $home->ID, '_elementor_data', true );

        if ( ! $is_imported ) {
            ?>
            <div class="notice notice-info is-dismissible" style="border-left-color: #00625d; padding: 12px 18px; background: #fff;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <strong style="color: #00625d; font-size: 14px;"><span class="dashicons dashicons-coffee" style="color: #00625d; margin-right: 5px;"></span>Santino Theme Setup:</strong>
                        <span style="font-size: 13px; color: #444; margin-left: 6px;">Install recommended plugins and import all 13 official pages in 1-click.</span>
                    </div>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=santino-demo-import' ) ); ?>" class="button button-primary" style="background: #00625d; border-color: #004d49; font-weight: 600;">
                        Open Santino Setup & Demo Import &rarr;
                    </a>
                </div>
            </div>
            <?php
        }
    }

    public static function enqueue_admin_assets( $hook ) {
        if ( strpos( $hook, 'santino-demo-import' ) === false ) {
            return;
        }
        wp_enqueue_style( 'dashicons' );
    }

    public static function render_admin_page() {
        $elementor_active = class_exists( '\Elementor\Plugin' ) || did_action( 'elementor/loaded' );
        $elementor_installed = file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' );

        $woo_active = class_exists( 'WooCommerce' );
        $woo_installed = file_exists( WP_PLUGIN_DIR . '/woocommerce/woocommerce.php' );

        $elementor_action_url = '';
        if ( ! $elementor_installed ) {
            $elementor_action_url = wp_nonce_url( admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
        } elseif ( ! $elementor_active ) {
            $elementor_action_url = wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=elementor/elementor.php' ), 'activate-plugin_elementor/elementor.php' );
        }

        $woo_action_url = '';
        if ( ! $woo_installed ) {
            $woo_action_url = wp_nonce_url( admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' );
        } elseif ( ! $woo_active ) {
            $woo_action_url = wp_nonce_url( admin_url( 'plugins.php?action=activate&plugin=woocommerce/woocommerce.php' ), 'activate-plugin_woocommerce/woocommerce.php' );
        }

        $home_page = get_page_by_path( 'home' );
        $has_existing_data = $home_page && get_post_meta( $home_page->ID, '_elementor_data', true );
        ?>
        <div class="wrap" style="max-width: 1040px; margin: 25px auto; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
            
            <!-- Header Header -->
            <div style="background: linear-gradient(135deg, #004d49 0%, #002d2b 100%); color: #fff; border-radius: 12px; padding: 32px 36px; margin-bottom: 25px; box-shadow: 0 10px 25px rgba(0,77,73,0.15);">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <span style="display: inline-block; background: rgba(223, 190, 141, 0.2); color: #dfbe8d; border: 1px solid rgba(223, 190, 141, 0.4); padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; letter-spacing: 1px; margin-bottom: 8px;">
                            SANTINO OFFICIAL MIGRATION &amp; SETUP
                        </span>
                        <h1 style="color: #fff; margin: 0 0 8px 0; font-size: 26px; font-weight: 800; letter-spacing: -0.5px;">
                            Live Theme Deployment &amp; Demo Importer
                        </h1>
                        <p style="margin: 0; color: rgba(255,255,255,0.85); font-size: 14px; max-width: 650px; line-height: 1.5;">
                            Setup your required page builder plugins, configure WordPress reading settings, and import all 13 official Santino theme pages with their complete visual Elementor structures in 1-click.
                        </p>
                    </div>
                    <div>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="button" style="background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.3); font-weight: 600; padding: 6px 16px;">
                            <span class="dashicons dashicons-external" style="line-height: 26px;"></span> Visit Site
                        </a>
                    </div>
                </div>
            </div>

            <!-- Two-Column Grid: Step 1 Plugins & Step 2 Data Importer -->
            <div style="display: grid; grid-template-columns: 1fr 1.3fr; gap: 24px;">

                <!-- Left Column: Plugin Suggestions -->
                <div style="background: #fff; border-radius: 10px; border: 1px solid #ccd0d4; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px; border-bottom: 2px solid #f0f0f1; padding-bottom: 12px;">
                        <span class="dashicons dashicons-admin-plugins" style="font-size: 22px; color: #00625d;"></span>
                        <h2 style="margin: 0; font-size: 17px; font-weight: 700; color: #1d2327;">
                            1. Recommended Plugins
                        </h2>
                    </div>

                    <p style="color: #646970; font-size: 13px; line-height: 1.5; margin-bottom: 20px;">
                        Ensure these plugins are active before running the demo import so all 22+ custom Santino coffee widgets register seamlessly:
                    </p>

                    <!-- Elementor Card -->
                    <div style="border: 1px solid <?php echo $elementor_active ? '#c3e6cb' : '#ffeeba'; ?>; background: <?php echo $elementor_active ? '#f8fdf9' : '#fffdf5'; ?>; border-radius: 8px; padding: 15px; margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                            <strong style="font-size: 14px; color: #1d2327;">Elementor Page Builder</strong>
                            <?php if ( $elementor_active ) : ?>
                                <span style="background: #28a745; color: #fff; font-size: 10.5px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">✓ ACTIVE</span>
                            <?php elseif ( $elementor_installed ) : ?>
                                <span style="background: #ffc107; color: #212529; font-size: 10.5px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">INSTALLED</span>
                            <?php else : ?>
                                <span style="background: #6c757d; color: #fff; font-size: 10.5px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">MISSING</span>
                            <?php endif; ?>
                        </div>
                        <p style="font-size: 12px; color: #646970; margin: 0 0 12px 0;">Required for visual drag-and-drop editing and all 22+ custom Santino coffee elements.</p>
                        <?php if ( ! $elementor_active ) : ?>
                            <a href="<?php echo esc_url( $elementor_action_url ); ?>" class="button button-primary" style="background: #00625d; border-color: #004d49; font-size: 12px; font-weight: 600; width: 100%; text-align: center;">
                                <?php echo $elementor_installed ? 'Activate Elementor &rarr;' : 'Install & Activate Elementor &rarr;'; ?>
                            </a>
                        <?php else : ?>
                            <span style="font-size: 12px; color: #28a745; font-weight: 600;">Ready for Visual Editing</span>
                        <?php endif; ?>
                    </div>

                    <!-- WooCommerce Card -->
                    <div style="border: 1px solid <?php echo $woo_active ? '#c3e6cb' : '#e2e8f0'; ?>; background: <?php echo $woo_active ? '#f8fdf9' : '#f8fafc'; ?>; border-radius: 8px; padding: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                            <strong style="font-size: 14px; color: #1d2327;">WooCommerce</strong>
                            <?php if ( $woo_active ) : ?>
                                <span style="background: #28a745; color: #fff; font-size: 10.5px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">✓ ACTIVE</span>
                            <?php elseif ( $woo_installed ) : ?>
                                <span style="background: #ffc107; color: #212529; font-size: 10.5px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">INSTALLED</span>
                            <?php else : ?>
                                <span style="background: #6c757d; color: #fff; font-size: 10.5px; font-weight: 700; padding: 3px 8px; border-radius: 12px;">OPTIONAL</span>
                            <?php endif; ?>
                        </div>
                        <p style="font-size: 12px; color: #646970; margin: 0 0 12px 0;">Enables e-commerce checkout, coffee bean cart badges, and live ordering.</p>
                        <?php if ( ! $woo_active ) : ?>
                            <a href="<?php echo esc_url( $woo_action_url ); ?>" class="button button-secondary" style="font-size: 12px; font-weight: 600; width: 100%; text-align: center;">
                                <?php echo $woo_installed ? 'Activate WooCommerce &rarr;' : 'Install & Activate WooCommerce &rarr;'; ?>
                            </a>
                        <?php else : ?>
                            <span style="font-size: 12px; color: #28a745; font-weight: 600;">Ready for Checkout</span>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- Right Column: Theme Demo Importer -->
                <div style="background: #fff; border-radius: 10px; border: 1px solid #ccd0d4; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px; border-bottom: 2px solid #f0f0f1; padding-bottom: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span class="dashicons dashicons-cloud-upload" style="font-size: 22px; color: #00625d;"></span>
                            <h2 style="margin: 0; font-size: 17px; font-weight: 700; color: #1d2327;">
                                2. One-Click Theme Demo Import
                            </h2>
                        </div>
                        <?php if ( $has_existing_data ) : ?>
                            <span style="background: #e6f4ea; color: #137333; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 12px;">
                                THEME PAGES INSTALLED
                            </span>
                        <?php endif; ?>
                    </div>

                    <p style="color: #646970; font-size: 13.5px; line-height: 1.6; margin-bottom: 16px;">
                        Clicking the button below will automatically configure <strong>only Santino theme pages and structures</strong>:
                    </p>

                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px 18px; margin-bottom: 20px;">
                        <ul style="margin: 0; padding-left: 20px; font-size: 12.5px; color: #334155; line-height: 1.8;">
                            <li><strong>13 Theme Pages Created &amp; Synced:</strong> Home, Machines, Beans, Training, Office Cafe, HoReCa, Our Story, Membership, Menu, Brands, BFC Solution, Swapno Retail, Certificate Verification.</li>
                            <li><strong>Elementor Visual Data Injected:</strong> Sets full-width section layouts, typography, banners, and native media controls.</li>
                            <li><strong>Reading Settings:</strong> Automatically configures static front page to <code>Home</code>.</li>
                            <li><strong>Navigation:</strong> Generates Santino Primary navigation and assigns to theme locations.</li>
                            <li><strong>Zero Database Junk:</strong> No dummy blog posts, fake comments, or external demo bloatware.</li>
                        </ul>
                    </div>

                    <!-- Import Trigger Box -->
                    <div style="text-align: center; padding: 20px; background: #faf8f5; border: 1.5px dashed #c59d5f; border-radius: 8px;" id="santino-import-box">
                        <div style="display: flex; justify-content: center; align-items: center; gap: 12px; flex-wrap: wrap;">
                            <button type="button" id="santino-start-import-btn" class="button button-primary" style="background: #00625d; border-color: #004d49; font-size: 15px; padding: 10px 28px; height: auto; border-radius: 30px; font-weight: 700; box-shadow: 0 4px 12px rgba(0,98,93,0.25);">
                                <span class="dashicons dashicons-download" style="line-height: 26px; font-size: 19px;"></span> Import Theme Demo Data
                            </button>
                            <button type="button" id="santino-sync-menus-btn" class="button button-secondary" style="font-size: 14px; padding: 10px 22px; height: auto; border-radius: 30px; font-weight: 700; border-color: #00625d; color: #00625d;">
                                <span class="dashicons dashicons-menu-alt3" style="line-height: 24px; font-size: 18px;"></span> Sync &amp; Assign Menus Only
                            </button>
                        </div>
                        <div style="margin-top: 10px; font-size: 12px; color: #777;">
                            Safe to re-run anytime. It updates page templates, menus and structures without deleting your media.
                        </div>
                    </div>

                    <!-- Live Progress State (Hidden by default) -->
                    <div id="santino-import-progress" style="display: none; padding: 25px 20px; text-align: center; background: #faf8f5; border-radius: 8px; border: 1px solid #ccd0d4; margin-top: 15px;">
                        <div class="spinner is-active" style="float: none; margin: 0 auto 15px auto; width: 32px; height: 32px;"></div>
                        <h4 style="margin: 0 0 6px 0; font-size: 16px; color: #00625d; font-weight: 700;" id="santino-progress-status">Importing Theme Pages &amp; Elementor Structures...</h4>
                        <p style="margin: 0; font-size: 12.5px; color: #646970;">Please do not close this window. This usually takes around 3-5 seconds.</p>
                    </div>

                    <!-- Success State (Hidden by default) -->
                    <div id="santino-import-success" style="display: none; padding: 25px 20px; text-align: center; background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 8px; margin-top: 15px;">
                        <span class="dashicons dashicons-yes-alt" style="font-size: 42px; width: 42px; height: 42px; color: #16a34a; margin-bottom: 8px;"></span>
                        <h3 style="margin: 0 0 6px 0; font-size: 18px; color: #15803d; font-weight: 800;">Theme Demo Data Imported Successfully!</h3>
                        <p style="margin: 0 0 16px 0; font-size: 13px; color: #166534;" id="santino-success-msg">All 13 pages, Elementor section layouts, and navigation menus are active.</p>
                        <div style="display: flex; justify-content: center; gap: 10px;">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="button button-primary" style="background: #16a34a; border-color: #15803d; font-weight: 700;">
                                View Live Home Page &rarr;
                            </a>
                            <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=page' ) ); ?>" class="button button-secondary" style="font-weight: 600;">
                                View All 13 Pages
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btn = document.getElementById('santino-start-import-btn');
            var menuBtn = document.getElementById('santino-sync-menus-btn');

            if (menuBtn) {
                menuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (!confirm('Import and assign the official Santino Header & Footer Navigation Menus?')) {
                        return;
                    }
                    importBox.style.display = 'none';
                    progressBox.style.display = 'block';
                    document.getElementById('santino-progress-status').textContent = 'Creating & Assigning Official Santino Menus...';

                    var fd = new FormData();
                    fd.append('action', 'santino_ajax_import_menus_only');
                    fd.append('nonce', '<?php echo esc_js( wp_create_nonce( 'santino_demo_import_nonce' ) ); ?>');

                    fetch(ajaxurl, { method: 'POST', body: fd })
                    .then(function(res) { return res.json(); })
                    .then(function(res) {
                        progressBox.style.display = 'none';
                        if (res.success) {
                            successBox.style.display = 'block';
                            if (res.data && res.data.message) {
                                successMsg.textContent = res.data.message;
                            }
                        } else {
                            importBox.style.display = 'block';
                            alert('Menu Import Notice: ' + (res.data && res.data.message ? res.data.message : 'Unknown error.'));
                        }
                    })
                    .catch(function(err) {
                        progressBox.style.display = 'none';
                        importBox.style.display = 'block';
                        alert('Network error during menu import.');
                    });
                });
            }
            var importBox = document.getElementById('santino-import-box');
            var progressBox = document.getElementById('santino-import-progress');
            var successBox = document.getElementById('santino-import-success');
            var successMsg = document.getElementById('santino-success-msg');

            if (!btn) return;

            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (!confirm('Start importing Santino Theme Demo Data? This will configure all 13 pages and Elementor structures.')) {
                    return;
                }

                importBox.style.display = 'none';
                progressBox.style.display = 'block';

                var formData = new FormData();
                formData.append('action', 'santino_ajax_import_theme_data');
                formData.append('nonce', '<?php echo esc_js( wp_create_nonce( 'santino_demo_import_nonce' ) ); ?>');

                fetch(ajaxurl, {
                    method: 'POST',
                    body: formData
                })
                .then(function(res) { return res.json(); })
                .then(function(res) {
                    progressBox.style.display = 'none';
                    if (res.success) {
                        successBox.style.display = 'block';
                        if (res.data && res.data.message) {
                            successMsg.textContent = res.data.message;
                        }
                    } else {
                        importBox.style.display = 'block';
                        alert('Import Notice: ' + (res.data && res.data.message ? res.data.message : 'Unknown error.'));
                    }
                })
                .catch(function(err) {
                    progressBox.style.display = 'none';
                    importBox.style.display = 'block';
                    alert('Network error during import. Please try again.');
                });
            });
        });
        </script>
        <?php
    }

    private static function build_sec( $widgets ) {
        $sec_id = substr( md5( uniqid( (string) rand(), true ) ), 0, 7 );
        $col_id = substr( md5( uniqid( (string) rand(), true ) ), 0, 7 );
        $elems  = array();

        foreach ( $widgets as $w ) {
            $w_id    = substr( md5( uniqid( (string) rand(), true ) ), 0, 7 );
            $elems[] = array(
                'id'         => $w_id,
                'elType'     => 'widget',
                'widgetType' => $w['type'],
                'settings'   => isset( $w['settings'] ) ? $w['settings'] : array(),
            );
        }

        return array(
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
                    'elements' => $elems,
                ),
            ),
        );
    }

    public static function handle_ajax_import() {
        if ( ! empty( $_REQUEST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'santino_demo_import_nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Security token expired. Please refresh the page.' ) );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( array( 'message' => 'Permission denied.' ) );
        }

        $pages_definition = array(
            'home' => array(
                'title'    => 'Home',
                'template' => 'template-home.php',
            ),
            'machines' => array(
                'title'    => 'Commercial Coffee Machines',
                'template' => 'templates/template-machines.php',
            ),
            'beans' => array(
                'title'    => 'Specialty Coffee Beans & Roastery',
                'template' => 'templates/template-beans.php',
            ),
            'training' => array(
                'title'    => 'Barista Academy & SCA Training',
                'template' => 'templates/template-training.php',
            ),
            'office-cafe' => array(
                'title'    => 'Corporate Office Coffee Solutions',
                'template' => 'templates/template-office-cafe.php',
            ),
            'horeca' => array(
                'title'    => 'HoReCa Coffee & Hospitality Solutions',
                'template' => 'templates/template-horeca.php',
            ),
            'our-story' => array(
                'title'    => 'Our Heritage & Journey',
                'template' => 'templates/template-our-story.php',
            ),
            'membership' => array(
                'title'    => 'VIP Coffee Club Membership',
                'template' => 'templates/template-membership.php',
            ),
            'santino-member' => array(
                'title'    => 'Santino Member Portal',
                'template' => 'templates/template-santino-member.php',
            ),
            'menu' => array(
                'title'    => 'Beverage & Cafe Menu',
                'template' => 'templates/template-menu.php',
            ),
            'brands' => array(
                'title'    => 'Global Partner Brands',
                'template' => 'templates/template-brands.php',
            ),
            'bfc' => array(
                'title'    => 'BFC Foodservice Coffee',
                'template' => 'templates/template-bfc.php',
            ),
            'swapno' => array(
                'title'    => 'Shwapno Retail Coffee',
                'template' => 'templates/template-swapno.php',
            ),
            'certificate-verification' => array(
                'title'    => 'Certificate Verification',
                'template' => 'templates/template-certificate-verification.php',
            ),
        );

        $created_page_ids = array();

        // 1. Create or sync all 13 Pages
        foreach ( $pages_definition as $slug => $data ) {
            $existing = get_page_by_path( $slug );
            if ( ! $existing ) {
                $pid = wp_insert_post( array(
                    'post_title'   => $data['title'],
                    'post_name'    => $slug,
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                    'post_content' => '',
                ) );
                if ( $pid && ! is_wp_error( $pid ) ) {
                    update_post_meta( $pid, '_wp_page_template', $data['template'] );
                    $created_page_ids[ $slug ] = $pid;
                }
            } else {
                update_post_meta( $existing->ID, '_wp_page_template', $data['template'] );
                $created_page_ids[ $slug ] = $existing->ID;
            }
        }

        $structures = self::get_all_structures();
        foreach ( $structures as $slug => $sections ) {
            if ( isset( $created_page_ids[ $slug ] ) ) {
                $pid = $created_page_ids[ $slug ];
                $json = wp_json_encode( $sections, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                update_post_meta( $pid, '_elementor_data', $json );
                update_post_meta( $pid, '_elementor_edit_mode', 'builder' );
                update_post_meta( $pid, '_elementor_version', '3.25.0' );
            }
        }

        if ( isset( $created_page_ids['home'] ) ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $created_page_ids['home'] );
        }

        if ( class_exists( '\Elementor\Plugin' ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }

        if ( function_exists( 'santino_setup_official_nav_menus' ) ) {
            santino_setup_official_nav_menus( true );
        }

        wp_send_json_success( array( 'message' => 'Demo data imported successfully! All 13 pages configured with native Elementor structures.' ) );
    }

    public static function get_all_structures() {
        return array(
            'home' => array(
                self::build_sec( array( array( 'type' => 'santino_hero_banner', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cafe_menu', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_outlets', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_story_timeline', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_academy', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_office_horeca', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_testimonials', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_partner_strip', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_machine_services', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_machine_grid', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_membership', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_faq', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_competitions', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_consultation_form', 'settings' => array() ) ) ),
            ),

            'machines' => array(
                self::build_sec( array( array( 'type' => 'santino_machines_solution', 'settings' => array() ) ) ),
            ),

            'beans' => array(
                self::build_sec( array( array( 'type' => 'santino_beans_solution', 'settings' => array() ) ) ),
            ),

            'training' => array(
                self::build_sec( array( array( 'type' => 'santino_training_solution', 'settings' => array() ) ) ),
            ),

            'office-cafe' => array(
                self::build_sec( array( array( 'type' => 'santino_office_cafe_solution', 'settings' => array() ) ) ),
            ),

            'horeca' => array(
                self::build_sec( array( array( 'type' => 'santino_horeca_solution', 'settings' => array() ) ) ),
            ),

            'our-story' => array(
                self::build_sec( array( array( 'type' => 'santino_our_story_solution', 'settings' => array() ) ) ),
            ),

            'membership' => array(
                self::build_sec( array( array( 'type' => 'santino_membership_solution', 'settings' => array() ) ) ),
            ),

            'santino-member' => array(
                self::build_sec( array( array( 'type' => 'santino_member_portal', 'settings' => array() ) ) ),
            ),

            'menu' => array(
                self::build_sec( array( array( 'type' => 'santino_menu_solution', 'settings' => array() ) ) ),
            ),

            'brands' => array(
                self::build_sec( array( array( 'type' => 'santino_brands_solution', 'settings' => array() ) ) ),
            ),

            'bfc' => array(
                self::build_sec( array( array( 'type' => 'santino_bfc_solution', 'settings' => array() ) ) ),
            ),

            'swapno' => array(
                self::build_sec( array( array( 'type' => 'santino_swapno_solution', 'settings' => array() ) ) ),
            ),

            'certificate-verification' => array(
                self::build_sec( array( array( 'type' => 'santino_certificate_verification', 'settings' => array() ) ) ),
            ),
        );
    }

    public static function handle_ajax_import_menus_only() {
        if ( ! empty( $_REQUEST['nonce'] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) ), 'santino_demo_import_nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Security token expired. Please refresh the page.' ) );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( array( 'message' => 'Permission denied.' ) );
        }

        if ( function_exists( 'santino_setup_official_nav_menus' ) ) {
            santino_setup_official_nav_menus( true );
            wp_send_json_success( array(
                'message' => 'Official Santino Navigation Menus (Primary Header Mega Menu, Footer Quick Links, and Customer Care) have been created and assigned successfully!',
            ) );
        }

        wp_send_json_error( array( 'message' => 'Menu setup engine missing.' ) );
    }
}

Santino_Demo_Importer::init();
