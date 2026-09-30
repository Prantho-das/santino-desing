<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$p = get_page_by_path( 'galaxy-teapresso-machine', OBJECT, 'product' );
if ( $p ) {
    $file = 'C:/Users/Administrator/Desktop/santino/scraped_machines/images/galaxy-2-groups-under-counter-teapresso-machine_1.webp';
    if ( file_exists( $file ) ) {
        $upload_dir = wp_upload_dir();
        $dest = $upload_dir['path'] . '/galaxy-teapresso.webp';
        copy( $file, $dest );
        $attach = array(
            'guid'           => $upload_dir['url'] . '/galaxy-teapresso.webp',
            'post_mime_type' => 'image/webp',
            'post_title'     => 'Galaxy Teapresso',
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        $id = wp_insert_attachment( $attach, $dest, $p->ID );
        wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $dest ) );
        set_post_thumbnail( $p->ID, $id );
        echo "Galaxy Teapresso attached ID: $id\n";
    }
}
