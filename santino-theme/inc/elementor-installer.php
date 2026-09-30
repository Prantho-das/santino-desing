<?php
/**
 * Plugin Dependencies & Automatic Installer for Santino Theme
 * Handles Elementor and WooCommerce auto-installer prompts
 *
 * @package Santino
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get List of Required / Recommended Plugins
 */
function santino_get_required_plugins() {
    return array(
        'elementor' => array(
            'name'      => 'Elementor Page Builder',
            'slug'      => 'elementor',
            'file'      => 'elementor/elementor.php',
            'is_active' => did_action( 'elementor/loaded' ) || class_exists( '\Elementor\Plugin' ),
            'is_installed' => file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ),
            'desc'      => __( 'Required for 12+ Santino custom coffee widgets and visual drag-and-drop page editing.', 'santino' ),
            'icon'      => 'dashicons-coffee',
        ),
        'woocommerce' => array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'file'      => 'woocommerce/woocommerce.php',
            'is_active' => class_exists( 'WooCommerce' ),
            'is_installed' => file_exists( WP_PLUGIN_DIR . '/woocommerce/woocommerce.php' ),
            'desc'      => __( 'Required for online coffee beans shop, machinery checkout, dynamic cart, and bKash/Nagad orders.', 'santino' ),
            'icon'      => 'dashicons-cart',
        ),
    );
}

/**
 * Display Admin Notice when Plugins are missing
 */
function santino_plugins_admin_notice() {
    $plugins = santino_get_required_plugins();
    $missing_plugins = array();

    foreach ( $plugins as $plugin ) {
        if ( ! $plugin['is_active'] ) {
            $missing_plugins[] = $plugin;
        }
    }

    if ( empty( $missing_plugins ) ) {
        return;
    }

    $screen = get_current_screen();
    if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
        return;
    }

    ?>
    <div class="notice notice-warning is-dismissible" style="padding: 16px 20px; border-left: 4px solid #c3996c; background: #fff; margin-top: 15px; border-radius: 4px; box-shadow: 0 1px 4px rgba(0,0,0,0.08);">
        <div style="margin-bottom: 12px;">
            <h3 style="margin: 0 0 4px 0; font-size: 16px; color: #111; font-weight: 700;">
                <span class="dashicons dashicons-coffee" style="color: #c3996c; margin-right: 6px;"></span>
                <?php esc_html_e( 'Santino Theme &bull; Recommended Plugins Setup', 'santino' ); ?>
            </h3>
            <p style="margin: 0; color: #666; font-size: 13px;">
                <?php esc_html_e( 'To unlock all custom features (Visual Page Builder, 12+ Coffee Widgets, and Online Store / Cart), please install and activate the following plugins:', 'santino' ); ?>
            </p>
        </div>

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <?php foreach ( $missing_plugins as $plugin ) : ?>
                <?php
                if ( $plugin['is_installed'] ) {
                    $action_url = wp_nonce_url(
                        admin_url( 'plugins.php?action=activate&plugin=' . $plugin['file'] ),
                        'activate-plugin_' . $plugin['file']
                    );
                    $btn_text = sprintf( __( 'Activate %s', 'santino' ), $plugin['name'] );
                    $btn_class = 'button-primary';
                } else {
                    $action_url = wp_nonce_url(
                        admin_url( 'update.php?action=install-plugin&plugin=' . $plugin['slug'] ),
                        'install-plugin_' . $plugin['slug']
                    );
                    $btn_text = sprintf( __( 'Install & Activate %s', 'santino' ), $plugin['name'] );
                    $btn_class = 'button-primary';
                }
                ?>
                <div style="display: flex; align-items: center; justify-content: space-between; background: #faf8f5; border: 1px solid #eee; padding: 10px 14px; border-radius: 6px; flex-wrap: wrap; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span class="dashicons <?php echo esc_attr( $plugin['icon'] ); ?>" style="color: #004d49; font-size: 20px;"></span>
                        <div>
                            <strong style="color: #222;"><?php echo esc_html( $plugin['name'] ); ?></strong>
                            <div style="font-size: 12px; color: #777;"><?php echo esc_html( $plugin['desc'] ); ?></div>
                        </div>
                    </div>
                    <div>
                        <a href="<?php echo esc_url( $action_url ); ?>" class="button <?php echo esc_attr( $btn_class ); ?>" style="background: #004d49; border-color: #003633; color: #fff; font-weight: 600;">
                            <?php echo esc_html( $btn_text ); ?> &rarr;
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
add_action( 'admin_notices', 'santino_plugins_admin_notice' );

/**
 * Auto-activate plugin after installation if triggered from our installer
 */
function santino_auto_activate_plugins_after_install( $response, $hook_extra, $result ) {
    $plugins = array(
        'elementor'   => 'elementor/elementor.php',
        'woocommerce' => 'woocommerce/woocommerce.php',
    );

    if ( isset( $hook_extra['plugin'] ) && isset( $plugins[ $hook_extra['plugin'] ] ) ) {
        activate_plugin( $plugins[ $hook_extra['plugin'] ] );
    }
    return $result;
}
add_filter( 'upgrader_post_install', 'santino_auto_activate_plugins_after_install', 10, 3 );
