<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';

$products = wc_get_products( array(
    'limit' => -1,
    'status' => 'publish'
) );

echo "=== 100% AUTHENTIC SANTINO PRODUCTS IN WOOCOMMERCE ===\n";
echo "Total: " . count( $products ) . " products\n\n";

foreach ( $products as $p ) {
    $cats = wp_get_post_terms( $p->get_id(), 'product_cat', array( 'fields' => 'names' ) );
    $has_img = has_post_thumbnail( $p->get_id() ) ? '✓ Has Image' : '✗ No Image';
    echo sprintf( "[ID %d] %-55s | %-32s | ৳%-9s | %s\n", 
        $p->get_id(), 
        substr( $p->get_name(), 0, 55 ), 
        implode( ', ', $cats ), 
        number_format( (float)$p->get_price() ),
        $has_img 
    );
}
