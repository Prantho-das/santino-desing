<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';

$prods = get_posts( array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'any'
) );

echo "WooCommerce Products in DB: " . count( $prods ) . "\n";
