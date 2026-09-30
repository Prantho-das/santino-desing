<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$imgs_dir = 'C:/Users/Administrator/Desktop/santino/scraped_machines/images/';
$theme_imgs = 'C:/Users/Administrator/Desktop/santino/santino-theme/assets/images/';

function attach_img_to_prod($post_id, $file_path, $title) {
    if (!file_exists($file_path)) return 0;
    
    $filename = basename($file_path);
    global $wpdb;
    $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1", '%' . $filename));
    if ($attachment_id) {
        set_post_thumbnail($post_id, intval($attachment_id));
        return intval($attachment_id);
    }
    
    $upload_dir = wp_upload_dir();
    $dest = $upload_dir['path'] . '/' . $filename;
    copy($file_path, $dest);
    
    $filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'guid' => $upload_dir['url'] . '/' . $filename,
        'post_mime_type' => $filetype['type'],
        'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    $attach_id = wp_insert_attachment($attachment, $dest, $post_id);
    $attach_data = wp_generate_attachment_metadata($attach_id, $dest);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($post_id, $attach_id);
    return $attach_id;
}

$fixes = array(
    219 => 'showcase_victoria-arduino-black-eagle-maverick_1.gif',
    245 => 'crem-ex3_1.jpg',
    253 => 'nuova-simonelli-mdxs-on-demand-grinder_1.jpg',
    254 => 'kalerm-460c_1.png',
    255 => 'kalerm-460c_1.png',
    256 => 'kalerm-b6_1.png',
    275 => 'butter-scotch-flavoured-sauce-from-da-vinci-gourmet-authenti.webp',
    277 => 'kalerm-c100-milk-cooler-fridge_1.png',

);

foreach ($fixes as $pid => $fn) {
    $path = $imgs_dir . $fn;
    if (!file_exists($path)) {
        $path = $theme_imgs . $fn;
    }
    if (file_exists($path)) {
        $id = attach_img_to_prod($pid, $path, get_the_title($pid));
        echo "Fixed Product {$pid} with image: {$fn} (Attach ID: {$id})
";
    }
}
echo "All product images fixed!
";
