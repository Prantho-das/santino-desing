<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';

$prods = get_posts( array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish'
) );

echo "Found " . count( $prods ) . " published products.\n";

foreach ( $prods as $p ) {
    // Ensure product_visibility is clean (not excluded from catalog)
    wp_set_object_terms( $p->ID, array(), 'product_visibility' );
    
    // Set WooCommerce lookup table data if WC function exists
    if ( function_exists( 'wc_update_product_lookup_tables' ) ) {
        wc_update_product_lookup_tables_column( 'min_max_price', $p->ID );
        wc_update_product_lookup_tables_column( 'stock_status', $p->ID );
    }
}

// Re-generate lookup tables
if ( function_exists( 'wc_update_product_lookup_tables_is_running' ) ) {
    wc_update_product_lookup_tables();
}

echo "Cleaned product visibility and rebuilt WooCommerce lookup tables!\n";
