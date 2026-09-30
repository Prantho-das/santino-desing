<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';

// Check or create Shop page
$shop = get_page_by_path( 'shop' );
if ( ! $shop ) {
    $shop_id = wp_insert_post( array(
        'post_title'   => 'Shop',
        'post_name'    => 'shop',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '[products limit="24" columns="3"]',
    ) );
} else {
    $shop_id = $shop->ID;
    if ( empty( $shop->post_content ) ) {
        wp_update_post( array(
            'ID'           => $shop_id,
            'post_content' => '[products limit="24" columns="3"]',
        ) );
    }
}
update_option( 'woocommerce_shop_page_id', $shop_id );

// Check or create Cart page
$cart = get_page_by_path( 'cart' );
if ( ! $cart ) {
    $cart_id = wp_insert_post( array(
        'post_title'   => 'Cart',
        'post_name'    => 'cart',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '[woocommerce_cart]',
    ) );
} else {
    $cart_id = $cart->ID;
}
update_option( 'woocommerce_cart_page_id', $cart_id );

// Check or create Checkout page
$checkout = get_page_by_path( 'checkout' );
if ( ! $checkout ) {
    $checkout_id = wp_insert_post( array(
        'post_title'   => 'Checkout',
        'post_name'    => 'checkout',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '[woocommerce_checkout]',
    ) );
} else {
    $checkout_id = $checkout->ID;
}
update_option( 'woocommerce_checkout_page_id', $checkout_id );

// Check or create My Account page
$account = get_page_by_path( 'my-account' );
if ( ! $account ) {
    $account_id = wp_insert_post( array(
        'post_title'   => 'My Account',
        'post_name'    => 'my-account',
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '[woocommerce_my_account]',
    ) );
} else {
    $account_id = $account->ID;
}
update_option( 'woocommerce_myaccount_page_id', $account_id );

echo "WooCommerce pages configured!\n";
echo "- Shop: ID $shop_id\n";
echo "- Cart: ID $cart_id\n";
echo "- Checkout: ID $checkout_id\n";
echo "- My Account: ID $account_id\n";
