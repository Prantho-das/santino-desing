<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$imgs_dir = 'C:/Users/Administrator/Desktop/santino/scraped_machines/images/';

$p = get_page_by_path('galaxy-teapresso-machine', OBJECT, 'product');
if ($p) {
    $fn = 'galaxy-2-groups-under-counter-teapresso-machine_1.webp';
    $path = $imgs_dir . $fn;
    if (file_exists($path)) {
        $upload_dir = wp_upload_dir();
        $dest = $upload_dir['path'] . '/' . $fn;
        copy($path, $dest);
        $attachment = array(
            'guid' => $upload_dir['url'] . '/' . $fn,
            'post_mime_type' => 'image/webp',
            'post_title' => 'Galaxy Teapresso Machine',
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment($attachment, $dest, $p->ID);
        $attach_data = wp_generate_attachment_metadata($attach_id, $dest);
        wp_update_attachment_metadata($attach_id, $attach_data);
        set_post_thumbnail($p->ID, $attach_id);
        echo "Attached Galaxy Teapresso image!\n";
    }
}
