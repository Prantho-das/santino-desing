<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$imgs_dir   = 'C:/Users/Administrator/Desktop/santino/scraped_machines/images/';
$theme_imgs = 'C:/Users/Administrator/Desktop/santino/santino-theme/assets/images/';

function set_thumbnail_direct($post_id, $filename) {
    global $imgs_dir, $theme_imgs;
    $path = $imgs_dir . $filename;
    if (!file_exists($path)) {
        $path = $theme_imgs . $filename;
    }
    if (!file_exists($path)) {
        echo "File $filename not found!\n";
        return 0;
    }

    $upload_dir = wp_upload_dir();
    $dest = $upload_dir['path'] . '/' . $filename;
    if (!file_exists($dest)) {
        copy($path, $dest);
    }

    $filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'guid' => $upload_dir['url'] . '/' . $filename,
        'post_mime_type' => $filetype['type'],
        'post_title' => preg_replace('/\\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );

    $attach_id = wp_insert_attachment($attachment, $dest, $post_id);
    $attach_data = wp_generate_attachment_metadata($attach_id, $dest);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($post_id, $attach_id);
    echo "Attached $filename to Product $post_id (Attach ID: $attach_id)\n";
    return $attach_id;
}

$prod_images = array(
    'victoria-arduino-black-eagle-maverick' => 'victoria-arduino-black-eagle-maverick_1.webp',
    'crem-ex3'                              => 'crem-ex3_1.jpg',
    'nuova-simonelli-mdxs-grinder'          => 'nuova-simonelli-mdxs-on-demand-grinder_1.jpg',
    'kalerm-y580c'                          => 'kalerm-y580c_1.png',
    'kalerm-460c'                           => 'kalerm-460c_1.png',
    'kalerm-b6'                             => 'kalerm-b6_1.png',
    'galaxy-teapresso-machine'              => 'galaxy-2-groups-under-counter-teapresso-machine_1.png',
    'santino-rainforest-reserve'            => 'imgi_19_santino_-_250522-07313.jpg',
    'santino-gourmet-signature-blend'       => 'imgi_23_santino_-_250522-07495.jpg',
    'santino-ethiopia-yirgacheffe'          => 'imgi_30_Blue-Stone-3_800x_526184df-2650-40b7-9dcf-e8af5b97527b.webp',
    'kalerm-commercial-milk-cooler'         => 'kalerm-c100-milk-cooler-fridge_1.png',
);

foreach ($prod_images as $slug => $file) {
    $p = get_page_by_path($slug, OBJECT, 'product');
    if ($p) {
        set_thumbnail_direct($p->ID, $file);
    }
}

echo "Completed thumbnail updates!\n";
