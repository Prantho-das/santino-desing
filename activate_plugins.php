<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/plugin.php';

$plugins = array(
    'woocommerce/woocommerce.php',
    'elementor/elementor.php',
);

foreach ( $plugins as $p ) {
    if ( ! is_plugin_active( $p ) ) {
        $res = activate_plugin( $p );
        if ( is_wp_error( $res ) ) {
            echo "Error activating $p: " . $res->get_error_message() . "\n";
        } else {
            echo "Activated $p!\n";
        }
    } else {
        echo "$p is already active.\n";
    }
}

flush_rewrite_rules();
echo "Flushed rewrite rules!\n";
