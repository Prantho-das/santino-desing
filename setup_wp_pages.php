<?php
// Bootstrap WordPress
require_once 'C:/laragon/www/wordpress/wp-load.php';

$pages = array(
    array(
        'title'    => 'Home',
        'slug'     => 'home',
        'template' => 'template-home.php',
    ),
    array(
        'title'    => 'Commercial Coffee Machines',
        'slug'     => 'machines',
        'template' => 'templates/template-machines.php',
    ),
    array(
        'title'    => 'Specialty Coffee Beans & Roastery',
        'slug'     => 'beans',
        'template' => 'templates/template-beans.php',
    ),
    array(
        'title'    => 'Barista Academy & SCA Training',
        'slug'     => 'training',
        'template' => 'templates/template-training.php',
    ),
    array(
        'title'    => 'Corporate Office & HoReCa Coffee Solutions',
        'slug'     => 'office-cafe',
        'template' => 'templates/template-office-cafe.php',
    ),
    array(
        'title'    => 'Our Heritage & Journey',
        'slug'     => 'our-story',
        'template' => 'templates/template-our-story.php',
    ),
    array(
        'title'    => 'VIP Coffee Club Membership',
        'slug'     => 'membership',
        'template' => 'templates/template-membership.php',
    ),
    array(
        'title'    => 'Beverage & Cafe Menu',
        'slug'     => 'menu',
        'template' => 'templates/template-menu.php',
    ),
    array(
        'title'    => 'Global Partner Brands',
        'slug'     => 'brands',
        'template' => 'templates/template-brands.php',
    ),
    array(
        'title'    => 'BFC Foodservice Coffee',
        'slug'     => 'bfc',
        'template' => 'templates/template-bfc.php',
    ),
    array(
        'title'    => 'Shwapno Retail Coffee',
        'slug'     => 'swapno',
        'template' => 'templates/template-swapno.php',
    ),
);

foreach ( $pages as $p ) {
    $existing = get_page_by_path( $p['slug'] );
    if ( ! $existing ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ) );
        if ( $post_id && ! is_wp_error( $post_id ) ) {
            update_post_meta( $post_id, '_wp_page_template', $p['template'] );
            echo "Created page: {$p['title']} ({$p['slug']}) with template {$p['template']}\n";
        }
    } else {
        update_post_meta( $existing->ID, '_wp_page_template', $p['template'] );
        echo "Updated template for existing page: {$p['title']} (ID {$existing->ID}) -> {$p['template']}\n";
    }
}

// Ensure Front page is set
$home_page = get_page_by_path( 'home' );
if ( $home_page ) {
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $home_page->ID );
    echo "Set static front page to 'Home' (ID: {$home_page->ID})\n";
}

// Ensure Permalinks are set to Post Name (/sample-post/)
update_option( 'permalink_structure', '/%postname%/' );
flush_rewrite_rules();
echo "Flushed rewrite rules to /%postname%/\n";

echo "All pages successfully configured in WordPress!\n";
