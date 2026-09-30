<?php
require_once 'C:/laragon/www/wordpress/wp-load.php';

$members = get_posts( array(
    'post_type'   => 'santino_member',
    'numberposts' => 10,
    'post_status' => 'any'
) );

echo "=== SANTINO VIP MEMBERS IN DATABASE ===\n";
echo "Total found: " . count($members) . "\n";
foreach ( $members as $m ) {
    $id     = get_post_meta( $m->ID, '_santino_member_id', true );
    $tier   = get_post_meta( $m->ID, '_santino_member_tier', true );
    $status = get_post_meta( $m->ID, '_santino_member_status', true );
    $phone  = get_post_meta( $m->ID, '_santino_member_phone', true );
    $biz    = get_post_meta( $m->ID, '_santino_member_business', true );
    $points = get_post_meta( $m->ID, '_santino_member_points', true );
    echo "- Name: {$m->post_title} | VIP ID: {$id} | Tier: {$tier} | Status: {$status} | Phone: {$phone} | Business: {$biz} | Points: {$points}\n";
}
