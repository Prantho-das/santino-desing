<?php
/**
 * Import All 125 Scraped Products into WooCommerce
 */

require_once 'C:/laragon/www/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$json_file = 'C:/Users/Administrator/Desktop/santino/scraped_machines/all_products_detailed.json';
$imgs_dir  = 'C:/Users/Administrator/Desktop/santino/scraped_machines/images/';

if ( ! file_exists( $json_file ) ) {
    die( "JSON file not found!\n" );
}

$products = json_decode( file_get_contents( $json_file ), true );
echo "Loaded " . count( $products ) . " products from JSON.\n";

// Helper to attach local image to WP Media Library
function santino_import_media_image( $filename, $imgs_dir, $post_id, $title ) {
    $file_path = $imgs_dir . $filename;
    if ( ! file_exists( $file_path ) || filesize( $file_path ) === 0 ) {
        return 0;
    }

    // Check if already in media library
    global $wpdb;
    $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1", '%' . $filename ) );
    if ( $attachment_id ) {
        return intval( $attachment_id );
    }

    $upload_dir = wp_upload_dir();
    $dest_file  = $upload_dir['path'] . '/' . $filename;

    if ( ! file_exists( $dest_file ) ) {
        copy( $file_path, $dest_file );
    }

    $filetype = wp_check_filetype( basename( $dest_file ), null );
    $attachment = array(
        'guid'           => $upload_dir['url'] . '/' . basename( $dest_file ),
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $dest_file ) ),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    $attach_id = wp_insert_attachment( $attachment, $dest_file, $post_id );
    $attach_data = wp_generate_attachment_metadata( $attach_id, $dest_file );
    wp_update_attachment_metadata( $attach_id, $attach_data );

    return intval( $attach_id );
}

$imported = 0;
$updated  = 0;

foreach ( $products as $idx => $p ) {
    $title    = $p['title'];
    $handle   = $p['handle'];
    $p_type   = $p['product_type'] ?: 'Equipment';
    $desc     = $p['description'] ?: '';
    $raw_html = $p['raw_html'] ?: $desc;
    $specs    = $p['features_and_specs'] ?: array();

    // Determine category
    $cat_name = 'Commercial Equipment';
    $t_lower  = strtolower( $title );
    if ( strpos( $t_lower, 'grinder' ) !== false || strpos( $t_lower, 'mythos' ) !== false || strpos( $t_lower, 'mdj' ) !== false || strpos( $t_lower, 'mdxs' ) !== false ) {
        $cat_name = 'Commercial Coffee Grinders';
    } elseif ( strpos( $t_lower, 'kalerm' ) !== false || strpos( $t_lower, 'rex-royal' ) !== false || strpos( $t_lower, 'automatic' ) !== false ) {
        $cat_name = 'Super Automatic Machines';
    } elseif ( strpos( $t_lower, 'victoria arduino' ) !== false || strpos( $t_lower, 'nuova simonelli' ) !== false || strpos( $t_lower, 'crem' ) !== false || strpos( $t_lower, 'appia' ) !== false || strpos( $t_lower, 'eagle' ) !== false || strpos( $t_lower, 'prima' ) !== false ) {
        $cat_name = 'Commercial Espresso Machines';
    } elseif ( strpos( $t_lower, 'tea' ) !== false || strpos( $t_lower, 'teapresso' ) !== false || strpos( $t_lower, 'matcha' ) !== false ) {
        $cat_name = 'Specialty Tea & Beverage';
    } elseif ( strpos( $t_lower, 'syrup' ) !== false || strpos( $t_lower, 'sauce' ) !== false || strpos( $t_lower, 'davinci' ) !== false ) {
        $cat_name = 'Gourmet Syrups & Sauces';
    } elseif ( strpos( $t_lower, 'cooler' ) !== false || strpos( $t_lower, 'fridge' ) !== false || strpos( $t_lower, 'cleaning' ) !== false || strpos( $t_lower, 'pump' ) !== false ) {
        $cat_name = 'Barista Accessories & Maintenance';
    }

    // Determine price from variants if present
    $price = '';
    if ( ! empty( $p['variants'] ) && isset( $p['variants'][0]['price'] ) ) {
        $price = $p['variants'][0]['price'];
    }
    if ( empty( $price ) || floatval( $price ) <= 0 ) {
        // Default commercial inquiry price or representative price
        $price = '0';
    }

    // Check if product already exists
    $existing = get_page_by_path( $handle, OBJECT, 'product' );
    $post_id  = 0;

    if ( ! $existing ) {
        $post_id = wp_insert_post( array(
            'post_title'   => $title,
            'post_name'    => $handle,
            'post_content' => $raw_html,
            'post_excerpt' => wp_trim_words( $desc, 35 ),
            'post_status'  => 'publish',
            'post_type'    => 'product',
        ) );
        $imported++;
    } else {
        $post_id = $existing->ID;
        wp_update_post( array(
            'ID'           => $post_id,
            'post_title'   => $title,
            'post_content' => $raw_html,
            'post_excerpt' => wp_trim_words( $desc, 35 ),
        ) );
        $updated++;
    }

    if ( ! $post_id || is_wp_error( $post_id ) ) {
        continue;
    }

    // Set Product Type & Category
    wp_set_object_terms( $post_id, 'simple', 'product_type' );
    wp_set_object_terms( $post_id, $cat_name, 'product_cat' );

    // WooCommerce Metadata
    update_post_meta( $post_id, '_visibility', 'visible' );
    update_post_meta( $post_id, '_stock_status', 'instock' );
    update_post_meta( $post_id, '_price', $price );
    update_post_meta( $post_id, '_regular_price', $price );
    update_post_meta( $post_id, '_sku', 'SNT-' . strtoupper( substr( md5( $handle ), 0, 8 ) ) );
    update_post_meta( $post_id, '_manage_stock', 'no' );

    // Attach Images
    if ( ! empty( $p['images'] ) ) {
        $first_img = $p['images'][0]['local_file'];
        $thumb_id  = santino_import_media_image( $first_img, $imgs_dir, $post_id, $title );
        if ( $thumb_id ) {
            set_post_thumbnail( $post_id, $thumb_id );
        }

        // Gallery images
        $gallery_ids = array();
        for ( $i = 1; $i < min( 5, count( $p['images'] ) ); $i++ ) {
            $g_file = $p['images'][$i]['local_file'];
            $g_id   = santino_import_media_image( $g_file, $imgs_dir, $post_id, $title );
            if ( $g_id ) {
                $gallery_ids[] = $g_id;
            }
        }
        if ( ! empty( $gallery_ids ) ) {
            update_post_meta( $post_id, '_product_image_gallery', implode( ',', $gallery_ids ) );
        }
    }

    if ( ( $idx + 1 ) % 25 === 0 || $idx === count( $products ) - 1 ) {
        echo "Processed " . ( $idx + 1 ) . "/" . count( $products ) . " products...\n";
    }
}

echo "\n=======================================================\n";
echo "IMPORT COMPLETE!\n";
echo "- Total New Products Imported: $imported\n";
echo "- Total Products Updated: $updated\n";
echo "- Total WooCommerce Products in DB: " . ( $imported + $updated ) . "\n";
echo "=======================================================\n";
