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
        add_action( 'admin_init', array( __CLASS__, 'auto_seed_on_admin_edit' ) );
        add_action( 'elementor/editor/init', array( __CLASS__, 'auto_seed_on_editor_load' ) );
        add_action( 'template_redirect', array( __CLASS__, 'auto_seed_on_preview_load' ) );
    }

    public static function auto_seed_on_admin_edit() {
        if ( isset( $_GET['action'] ) && $_GET['action'] === 'elementor' && ! empty( $_GET['post'] ) ) {
            self::seed_single_page( intval( $_GET['post'] ) );
        }
    }

    public static function auto_seed_on_editor_load() {
        $post_id = 0;
        if ( isset( $_GET['post'] ) ) {
            $post_id = intval( $_GET['post'] );
        } elseif ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            $post_id = get_the_ID();
        }
        if ( $post_id ) {
            self::seed_single_page( $post_id );
        }
    }

    public static function auto_seed_on_preview_load() {
        if ( isset( $_GET['elementor-preview'] ) ) {
            self::seed_single_page( intval( $_GET['elementor-preview'] ) );
        }
    }

    public static function seed_single_page( $post_id ) {
        $post_id = intval( $post_id );
        if ( ! $post_id ) return false;

        $post = get_post( $post_id );
        if ( ! $post || $post->post_type !== 'page' ) return false;

        $existing = get_post_meta( $post_id, '_elementor_data', true );
        if ( ! empty( $existing ) && $existing !== '[]' ) return false;

        $slug = $post->post_name;
        if ( intval( get_option( 'page_on_front' ) ) === $post_id ) {
            $slug = 'home';
        }

        $tpl = get_post_meta( $post_id, '_wp_page_template', true );
        if ( ! empty( $tpl ) && $tpl !== 'default' ) {
            if ( strpos( $tpl, 'home' ) !== false ) $slug = 'home';
            elseif ( strpos( $tpl, 'machine' ) !== false ) $slug = 'machines';
            elseif ( strpos( $tpl, 'bean' ) !== false ) $slug = 'beans';
            elseif ( strpos( $tpl, 'training' ) !== false ) $slug = 'training';
            elseif ( strpos( $tpl, 'office' ) !== false ) $slug = 'office-cafe';
            elseif ( strpos( $tpl, 'horeca' ) !== false ) $slug = 'horeca';
            elseif ( strpos( $tpl, 'story' ) !== false ) $slug = 'our-story';
            elseif ( strpos( $tpl, 'member' ) !== false ) $slug = 'membership';
            elseif ( strpos( $tpl, 'menu' ) !== false ) $slug = 'menu';
            elseif ( strpos( $tpl, 'brand' ) !== false ) $slug = 'brands';
            elseif ( strpos( $tpl, 'bfc' ) !== false ) $slug = 'bfc';
            elseif ( strpos( $tpl, 'swapno' ) !== false || strpos( $tpl, 'shwapno' ) !== false ) $slug = 'swapno';
            elseif ( strpos( $tpl, 'cert' ) !== false ) $slug = 'certificate-verification';
        }

        $slug_aliases = array(
            'specialty-coffee-beans'     => 'beans',
            'commercial-coffee-machines' => 'machines',
            'barista-training'           => 'training',
            'academy'                    => 'training',
            'vip'                        => 'membership',
            'about'                      => 'our-story',
            'services'                   => 'office-cafe',
        );
        if ( isset( $slug_aliases[ $slug ] ) ) {
            $slug = $slug_aliases[ $slug ];
        }

        $structures = self::get_all_structures();
        if ( isset( $structures[ $slug ] ) ) {
            $json = wp_json_encode( $structures[ $slug ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
            update_post_meta( $post_id, '_elementor_data', $json );
            update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
            update_post_meta( $post_id, '_elementor_version', '3.25.0' );
            if ( class_exists( '\Elementor\Plugin' ) ) {
                \Elementor\Plugin::$instance->files_manager->clear_cache();
            }
            return true;
        }
        return false;
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

        // 2. Build Elementor structures for all 13 pages
        $uri = get_template_directory_uri();

        $structures = self::get_all_structures();

        // 3. Write Elementor JSON to each page
        foreach ( $structures as $slug => $sections ) {
            if ( isset( $created_page_ids[ $slug ] ) ) {
                $pid = $created_page_ids[ $slug ];
                $json = wp_json_encode( $sections, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
                update_post_meta( $pid, '_elementor_data', $json );
                update_post_meta( $pid, '_elementor_edit_mode', 'builder' );
                update_post_meta( $pid, '_elementor_version', '3.25.0' );
            }
        }

        // 4. Set static front page to Home
        if ( isset( $created_page_ids['home'] ) ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $created_page_ids['home'] );
        }

        // 5. Update Permalink structure
        update_option( 'permalink_structure', '/%postname%/' );
        flush_rewrite_rules();

        // 6. Clear Elementor CSS cache
        if ( class_exists( '\Elementor\Plugin' ) ) {
            \Elementor\Plugin::$instance->files_manager->clear_cache();
        }

        // 7. Seed official Santino Navigation Menus (Header & Footers)
        if ( function_exists( 'santino_setup_official_nav_menus' ) ) {
            santino_setup_official_nav_menus( true );
        }

        wp_send_json_success( array(
            'message' => 'All 13 Pages, Elementor Structures, Navigation Menus, and Front Page settings have been imported successfully!',
        ) );
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

    public static function get_all_structures() {
        $uri = get_template_directory_uri();
        return array(
            'home' => array(
                self::build_sec( array( array( 'type' => 'santino_hero_banner', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_brand_slider', 'settings' => array( 'title' => 'Global Brand Partners in Bangladesh' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_machine_grid', 'settings' => array( 'section_title' => 'Commercial Espresso & Brewing Machines' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_coffee_beans', 'settings' => array( 'title' => 'Freshly Roasted Specialty Coffee Beans' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_academy', 'settings' => array( 'title' => 'Santino Barista Academy & SCA Certification' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_office_horeca', 'settings' => array( 'title' => 'Corporate Office & HoReCa Coffee Solutions' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_outlets', 'settings' => array( 'title' => 'Where to Experience Santino Coffee' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_membership', 'settings' => array( 'title' => 'Join Santino VIP Coffee Club' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_stats_counter', 'settings' => array() ) ) ),
                self::build_sec( array( array( 'type' => 'santino_testimonials', 'settings' => array( 'title' => 'Trusted by 500+ Cafes & Hotels Across Bangladesh' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_faq_accordion', 'settings' => array( 'title' => 'Frequently Asked Questions' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Ready to Upgrade Your Coffee Experience?' ) ) ) ),
            ),

            'machines' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'AUTHORIZED ITALIAN DISTRIBUTOR',
                    'title'        => 'Commercial Espresso Machinery',
                    'subtitle'     => 'Official Italian espresso machines, automated coffee stations, and 4-hour on-site tech SLA.',
                    'btn1_text'    => 'Book Live Demo',
                    'btn1_target'  => '#demoModal',
                    'btn2_text'    => 'Explore Catalog',
                    'btn2_url'     => '#machineGrid',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_218_blackeagle2.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '500+',
                    'metric1_label' => 'Machines Installed',
                    'metric2_num'   => '4 Hours',
                    'metric2_label' => 'Rapid Tech SLA',
                    'metric3_num'   => '100%',
                    'metric3_label' => 'OEM Italian Parts',
                    'metric4_num'   => 'Zero',
                    'metric4_label' => 'Downtime Warranty',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_brand_slider', 'settings' => array( 'title' => 'Authorized Global Partners' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_machine_grid', 'settings' => array( 'section_title' => 'Engineered for Flawless Extraction' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array( 'title' => '24/7 Technical Support & Preventative AMC' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Book a Live Machine Demonstration at our Showroom' ) ) ) ),
            ),

            'beans' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'FSSC22000 CERTIFIED ROASTERY',
                    'title'        => 'Specialty Coffee Beans & Artisan Roastery',
                    'subtitle'     => 'Single-origin microlots and signature espresso blends roasted fresh weekly in Dhaka.',
                    'btn1_text'    => 'Order Fresh Beans',
                    'btn1_target'  => '#beansCatalog',
                    'btn2_text'    => 'Wholesale Inquiry',
                    'btn2_url'     => '#wholesaleModal',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_206_beans1.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '100%',
                    'metric1_label' => 'Arabica Specialty',
                    'metric2_num'   => '84+',
                    'metric2_label' => 'SCA Cupping Score',
                    'metric3_num'   => '7 Days',
                    'metric3_label' => 'Fresh Roast Cycle',
                    'metric4_num'   => '100%',
                    'metric4_label' => 'Ethical Direct Trade',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_coffee_beans', 'settings' => array( 'title' => 'Specialty Coffee Bean Selection' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array( 'title' => 'Custom Roasting Profiles & Private Label for Cafes' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_faq_accordion', 'settings' => array( 'title' => 'Coffee Sourcing & Roasting FAQ' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Order Freshly Roasted Coffee Beans Wholesale' ) ) ) ),
            ),

            'training' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'SCA STANDARDS',
                    'title'        => 'Santino Barista Academy & SCA Training',
                    'subtitle'     => 'Professional barista training, sensory cupping, milk science, and cafe business management.',
                    'btn1_text'    => 'Enroll in Next Batch',
                    'btn1_target'  => '#courses',
                    'btn2_text'    => 'Course Curriculum',
                    'btn2_url'     => '#curriculum',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_216_academy1.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '1,200+',
                    'metric1_label' => 'Certified Graduates',
                    'metric2_num'   => 'SCA',
                    'metric2_label' => 'Aligned Curriculum',
                    'metric3_num'   => '100%',
                    'metric3_label' => 'Hands-On Practical',
                    'metric4_num'   => '95%',
                    'metric4_label' => 'Job Placement Rate',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_academy', 'settings' => array( 'title' => 'Certified Professional Barista Courses' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array( 'title' => 'Curriculum & Certification Standards' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_testimonials', 'settings' => array( 'title' => 'Alumni Reviews & Cafe Placements' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Enroll in Upcoming Barista Batch' ) ) ) ),
            ),

            'office-cafe' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'CORPORATE SOLUTIONS',
                    'title'        => 'Corporate Office & HoReCa Coffee Systems',
                    'subtitle'     => 'Smart super-automatic bean-to-cup coffee machines and weekly fresh bean supply for offices.',
                    'btn1_text'    => 'Request 7-Day Trial',
                    'btn1_target'  => '#trialModal',
                    'btn2_text'    => 'Calculate Cost',
                    'btn2_url'     => '#calculator',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_209_office1.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '150+',
                    'metric1_label' => 'Offices Powered',
                    'metric2_num'   => '7 Days',
                    'metric2_label' => 'Free Machine Trial',
                    'metric3_num'   => '৳ 25',
                    'metric3_label' => 'Cost Per Fresh Cup',
                    'metric4_num'   => '4 Hours',
                    'metric4_label' => 'Rapid Support SLA',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_office_horeca', 'settings' => array( 'title' => 'Turnkey Office Coffee Packages & Calculator' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array( 'title' => 'Free 7-Day Office Machine Trial & Maintenance SLA' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_testimonials', 'settings' => array( 'title' => 'Trusted by Top Tech Hubs & Embassies' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Request Free 7-Day Office Coffee Trial' ) ) ) ),
            ),

            'horeca' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'HORECA SOLUTIONS',
                    'title'        => 'Hotel, Restaurant & Cafe Coffee Solutions',
                    'subtitle'     => 'Complete coffee ecosystem for 5-star hotels, luxury resorts, and high-volume fine dining establishments.',
                    'btn1_text'    => 'Request Consultation',
                    'btn1_target'  => '#consultationModal',
                    'btn2_text'    => 'View Equipment',
                    'btn2_url'     => '#equipment',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_209_office1.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '70+',
                    'metric1_label' => 'Hotels & Fine Dining',
                    'metric2_num'   => '4 Hours',
                    'metric2_label' => 'Rapid Support SLA',
                    'metric3_num'   => 'Included',
                    'metric3_label' => 'Staff Barista Training',
                    'metric4_num'   => 'Custom',
                    'metric4_label' => 'Signature Roasts',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_office_horeca', 'settings' => array( 'title' => 'HoReCa Turnkey Equipment Packages' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array( 'title' => 'Full Maintenance AMC & On-Call Barista Support' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_brand_slider', 'settings' => array( 'title' => 'Global Brand Machinery for HoReCa' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_testimonials', 'settings' => array( 'title' => 'Trusted by 5-Star General Managers' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Elevate Your Hotel Coffee Experience Today' ) ) ) ),
            ),

            'our-story' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'SINCE 1998',
                    'title'        => 'Our Heritage, Craft & Roasting Journey',
                    'subtitle'     => '25+ years of coffee craftsmanship bridging Italian roasting heritage with Bangladesh specialty culture.',
                    'btn1_text'    => 'Explore Heritage',
                    'btn1_target'  => '#storyTimeline',
                    'btn2_text'    => 'Roastery Tour',
                    'btn2_url'     => '#roastery',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_217_story1.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '25+ Years',
                    'metric1_label' => 'Roasting Legacy',
                    'metric2_num'   => '1st',
                    'metric2_label' => 'Specialty Roaster BD',
                    'metric3_num'   => '100%',
                    'metric3_label' => 'Direct Ethical Trade',
                    'metric4_num'   => '500+',
                    'metric4_label' => 'Active Partners',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_story_timeline', 'settings' => array( 'title' => '25-Year Innovation Journey' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array( 'title' => 'Master Roaster Philosophy & Ethical Sourcing' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Experience Our Roastery Firsthand' ) ) ) ),
            ),

            'membership' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'EXCLUSIVE CLUB',
                    'title'        => 'Santino VIP Coffee Club & Digital Rewards',
                    'subtitle'     => 'Earn reward stamps on every cup, unlock private tasting invitations, and enjoy member discounts.',
                    'btn1_text'    => 'Join VIP Club',
                    'btn1_target'  => '#membershipTiers',
                    'btn2_text'    => 'View Benefits',
                    'btn2_url'     => '#perks',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_214_beans9.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '10,000+',
                    'metric1_label' => 'Active Members',
                    'metric2_num'   => '10%',
                    'metric2_label' => 'Cashback Points',
                    'metric3_num'   => 'Free',
                    'metric3_label' => 'Birthday Tasting',
                    'metric4_num'   => 'VIP',
                    'metric4_label' => 'Reserve Microlots',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_membership', 'settings' => array( 'title' => 'VIP Membership Tiers & Digital Stamp Card' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_faq_accordion', 'settings' => array( 'title' => 'Membership Frequently Asked Questions' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Apply for VIP Membership Online' ) ) ) ),
            ),

            'menu' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'HANDCRAFTED BEVERAGES',
                    'title'        => 'Santino Cafe Beverage Menu',
                    'subtitle'     => 'Raw coconut lattes, single-origin pour-overs, nitro cold brews, and artisan bakery.',
                    'btn1_text'    => 'Browse Menu',
                    'btn1_target'  => '#menuCatalog',
                    'btn2_text'    => 'Find Branch',
                    'btn2_url'     => '#outlets',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_211_beans6.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cafe_menu', 'settings' => array( 'title' => 'Full Handcrafted Beverage Catalog' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_outlets', 'settings' => array( 'title' => 'Order for Pickup at Your Nearest Branch' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Visit Santino Specialty Coffee Showroom' ) ) ) ),
            ),

            'brands' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'OFFICIAL PARTNERS',
                    'title'        => 'Global Brand Partners & Certified Machinery',
                    'subtitle'     => 'Exclusive distribution and warranty support for premier Italian, Swiss, and global coffee brands.',
                    'btn1_text'    => 'View Brand Matrix',
                    'btn1_target'  => '#brandsMatrix',
                    'btn2_text'    => 'Download Catalog',
                    'btn2_url'     => '#catalog',
                    'bg_image'     => array( 'url'=> santino_img( 'imgi_218_blackeagle2.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_brand_slider', 'settings' => array( 'title' => 'Global Brand Partners in Bangladesh' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_brands_showcase', 'settings' => array( 'title' => 'Authorized Global Brands Matrix' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array( 'title' => '100% Genuine Spare Parts & Factory Certified Technicians' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Inquire About Dealership & Machine Supply' ) ) ) ),
            ),

            'bfc' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'OFFICIAL FOODSERVICE PARTNER',
                    'title'        => 'BFC × Santino Espresso Bar',
                    'subtitle'     => 'Specialty Italian espresso & handcrafted beverages served fresh daily across 50+ BFC restaurant counters in Bangladesh.',
                    'btn1_text'    => 'Find Nearest BFC',
                    'btn1_target'  => '#outlets',
                    'btn2_text'    => 'View Experience',
                    'btn2_url'     => '#gallery',
                    'bg_image'     => array( 'url'=> santino_img( 'bfc_santino_foodservice.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '50+',
                    'metric1_label' => 'BFC Outlets Powered',
                    'metric2_num'   => '1.5M+',
                    'metric2_label' => 'Cups Served Yearly',
                    'metric3_num'   => '< 45s',
                    'metric3_label' => 'Serving Speed',
                    'metric4_num'   => '24/7',
                    'metric4_label' => 'Barista Support SLA',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_editorial_gallery', 'settings' => array(
                    'badge_text' => 'VISUAL EXPERIENCE',
                    'title'      => 'Inside The BFC × Santino Craft',
                    'subtitle'   => 'Live commercial espresso stations, artisan roasted beans, and certified barista workflows across 50+ branches.',
                    'dark_mode'  => 'yes',
                    'cards'      => array(
                        array(
                            'card_badge' => '9-BAR EXTRACTION',
                            'card_title' => 'High Volume Commercial Extraction',
                            'card_desc'  => 'Twin-group commercial machinery calibrated for rapid extraction during rushes.',
                            'card_image' => array( 'url'=> santino_img( 'imgi_218_blackeagle2.jpg' ), 'id' => '' ),
                        ),
                        array(
                            'card_badge' => 'SCA STANDARDS',
                            'card_title' => 'Certified Barista Quality',
                            'card_desc'  => 'Every cup dialed in to exacting extraction ratios and microfoam texture.',
                            'card_image' => array( 'url'=> santino_img( 'bd-barista-latte-art.jpg' ), 'id' => '' ),
                        ),
                        array(
                            'card_badge' => 'FRESH ROASTERY',
                            'card_title' => 'Weekly Roasted Beans',
                            'card_desc'  => 'Fresh batches sealed in nitrogen-flushed packaging for optimal crema.',
                            'card_image' => array( 'url'=> santino_img( 'imgi_206_beans1.jpg' ), 'id' => '' ),
                        ),
                        array(
                            'card_badge' => 'FAST SERVICE',
                            'card_title' => 'Seamless Turnaround',
                            'card_desc'  => 'Integrated order-to-cup workflow designed for busy service counters.',
                            'card_image' => array( 'url'=> santino_img( 'imgi_209_office1.jpg' ), 'id' => '' ),
                        ),
                    ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_machine_grid', 'settings' => array( 'section_title' => 'Commercial 9-Bar Italian Espresso Machinery at BFC' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_coffee_beans', 'settings' => array( 'title' => 'BFC Barista Blend & Micro-Batch Roasted Beans' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_outlets', 'settings' => array( 'title' => 'Find Santino Espresso Bar at 50+ BFC Outlets' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_testimonials', 'settings' => array( 'title' => 'Trusted Foodservice Partnership Feedback' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Want a Turnkey Santino Espresso Station In Your Chain?' ) ) ) ),
            ),

            'swapno' => array(
                self::build_sec( array( array( 'type' => 'santino_pro_banner', 'settings' => array(
                    'badge_text'   => 'RETAIL SUPERSTORE PARTNER',
                    'title'        => 'Shwapno × Santino Fresh Specialty Coffee',
                    'subtitle'     => 'Freshly roasted whole bean & fine ground coffee packs with one-way aroma degassing valves available at 100+ Shwapno superstores.',
                    'btn1_text'    => 'Find Shwapno Outlet',
                    'btn1_target'  => '#outlets',
                    'btn2_text'    => 'Explore Coffee Packs',
                    'btn2_url'     => '#packs',
                    'bg_image'     => array( 'url'=> santino_img( 'shwapno_santino_retail.jpg' ), 'id' => '' ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '100+',
                    'metric1_label' => 'Shwapno Superstores',
                    'metric2_num'   => '100%',
                    'metric2_label' => 'Premium Arabica',
                    'metric3_num'   => 'Weekly',
                    'metric3_label' => 'Fresh Shelf Restock',
                    'metric4_num'   => 'Aroma Valve',
                    'metric4_label' => 'Degassing Shield',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_editorial_gallery', 'settings' => array(
                    'badge_text' => 'RETAIL PRESENCE',
                    'title'      => 'Superstore Display & In-Store Grind Booths',
                    'subtitle'   => 'Fresh whole bean and ground coffee available on prime retail shelves across Dhaka, Chittagong and Sylhet.',
                    'dark_mode'  => 'no',
                    'cards'      => array(
                        array(
                            'card_badge' => 'SUPERSTORE DISPLAY',
                            'card_title' => 'Premium Retail Aisles',
                            'card_desc'  => 'Prominently displayed whole bean bags and fine drip grounds.',
                            'card_image' => array( 'url'=> santino_img( 'shwapno_santino_retail.jpg' ), 'id' => '' ),
                        ),
                        array(
                            'card_badge' => 'IN-STORE GRIND',
                            'card_title' => 'Custom Grind Precision',
                            'card_desc'  => 'Fresh on-demand grinding booths calibrated for Moka pot, Espresso, and French press.',
                            'card_image' => array( 'url'=> santino_img( 'imgi_218_blackeagle2.jpg' ), 'id' => '' ),
                        ),
                        array(
                            'card_badge' => 'AROMA PROTECTION',
                            'card_title' => 'One-Way Valve Packaging',
                            'card_desc'  => 'Preserving volatile aromatics and releasing natural CO2 for maximum shelf freshness.',
                            'card_image' => array( 'url'=> santino_img( 'imgi_206_beans1.jpg' ), 'id' => '' ),
                        ),
                        array(
                            'card_badge' => 'NATIONWIDE REACH',
                            'card_title' => '100+ Outlet Superstore Network',
                            'card_desc'  => 'Consistently restocked weekly across prime residential and commercial zones.',
                            'card_image' => array( 'url'=> santino_img( 'imgi_209_office1.jpg' ), 'id' => '' ),
                        ),
                    ),
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_coffee_beans', 'settings' => array( 'title' => 'Retail Whole Bean & Ground Coffee Selection' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_services', 'settings' => array( 'title' => 'In-Store Grinding Booths & Freshness Preservation' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_outlets', 'settings' => array( 'title' => 'Explore Santino Shelves at Shwapno Outlets' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_faq_accordion', 'settings' => array( 'title' => 'Retail Coffee Freshness & Brewing FAQ' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Partner with Santino for Retail Distribution' ) ) ) ),
            ),

            'certificate-verification' => array(
                self::build_sec( array( array( 'type' => 'santino_certificate_verification', 'settings' => array(
                    'badge_text' => 'Official Registry & Accreditation',
                    'title'      => 'Certificate Verification Portal',
                    'subtitle'   => 'Instantly verify the authenticity of credentials issued by Santino Barista Academy & Bangladesh Barista Training Academy (BBTA).',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_floating_metrics', 'settings' => array(
                    'metric1_num'   => '1,200+',
                    'metric1_label' => 'Verified Baristas',
                    'metric2_num'   => '100%',
                    'metric2_label' => 'Authenticity Guarantee',
                    'metric3_num'   => 'SCA',
                    'metric3_label' => 'Standards Aligned',
                    'metric4_num'   => 'Realtime',
                    'metric4_label' => 'Instant Verification',
                ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_faq_accordion', 'settings' => array( 'title' => 'Verification Frequently Asked Questions' ) ) ) ),
                self::build_sec( array( array( 'type' => 'santino_cta_banner', 'settings' => array( 'title' => 'Need Verification Assistance or Corporate Validation?' ) ) ) ),
            ),
        );
    }
}

Santino_Demo_Importer::init();
