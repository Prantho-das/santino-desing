<?php
/**
 * Clean Database & Import Only Real Authentic Santino Products & Machines
 */

require_once 'C:/laragon/www/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

echo "=== 1. PURGING OLD / TEST PRODUCTS ===\n";
$all_old_prods = get_posts( array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'any',
    'fields'         => 'ids',
) );

foreach ( $all_old_prods as $old_id ) {
    wp_delete_post( $old_id, true );
}
echo "Purged " . count( $all_old_prods ) . " old products.\n";

$json_file = 'C:/Users/Administrator/Desktop/santino/scraped_machines/all_products_detailed.json';
$imgs_dir  = 'C:/Users/Administrator/Desktop/santino/scraped_machines/images/';

$raw_products = json_decode( file_get_contents( $json_file ), true );

// Helper to find image in media library or register it
function santino_attach_image( $filename, $imgs_dir, $post_id, $title ) {
    $file_path = $imgs_dir . $filename;
    if ( ! file_exists( $file_path ) || filesize( $file_path ) === 0 ) {
        return 0;
    }

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

// Master list of real Santino equipment & coffee products
$real_catalog = array(
    // 1. Victoria Arduino Commercial Espresso
    array(
        'title'       => 'Victoria Arduino Black Eagle Maverick',
        'slug'        => 'victoria-arduino-black-eagle-maverick',
        'cat'         => 'Commercial Espresso Machines',
        'price'       => '1850000',
        'sku'         => 'SNT-VA-MAVERICK',
        'img'         => 'showcase_victoria-arduino-black-eagle-maverick_1.png',
        'gallery'     => array( 'showcase_victoria-arduino-black-eagle-maverick_4.jpg', 'showcase_victoria-arduino-black-eagle-maverick_8.jpg' ),
        'excerpt'     => 'The world’s most advanced commercial espresso machine featuring PureBrew technology, T3 Genius thermal stability, and sustainable energy efficiency.',
        'desc'        => '<h3>Victoria Arduino Black Eagle Maverick</h3><p>Engineered for champion baristas and specialty coffee shops worldwide. The Maverick combines next-generation <strong>T3 Genius Multiboiler System</strong> with revolutionary <strong>PureBrew Extraction Technology</strong>, enabling both world-class espresso and gravity-extracted filter coffee in one machine.</p><ul><li><strong>PureBrew Technology:</strong> Conical basket filter extraction for espresso & filter coffee.</li><li><strong>T3 Genius System:</strong> Instant temperature adjustment per group with 37% less energy usage.</li><li><strong>Gravimetric Technology:</strong> Real-time liquid weight measurement in the cup.</li><li><strong>Steam by Wire:</strong> Electronically controlled proportional steam levers.</li></ul>'
    ),
    array(
        'title'       => 'Victoria Arduino Eagle One',
        'slug'        => 'victoria-arduino-eagle-one',
        'cat'         => 'Commercial Espresso Machines',
        'price'       => '1450000',
        'sku'         => 'SNT-VA-EAGLE1',
        'img'         => 'showcase_victoria-arduino-eagle-one_1.png',
        'gallery'     => array( 'showcase_victoria-arduino-eagle-one_3.jpg', 'showcase_victoria-arduino-eagle-one_5.jpg' ),
        'excerpt'     => 'Sustainable, compact, and ultra-high performance espresso machine designed for modern cafes and specialty roasteries.',
        'desc'        => '<h3>Victoria Arduino Eagle One</h3><p>Designed in collaboration with James Hoffmann, the Eagle One is built for the new generation of coffee shops with <strong>NEO (New Engine Optimization)</strong> technology that cuts power consumption by up to 29%.</p><ul><li><strong>NEO Engine:</strong> Instant heating system that uses only the necessary water for extraction.</li><li><strong>TERS (Thermal Energy Recovery System):</strong> Recycles discharge water heat to preheat incoming water.</li><li><strong>Smart App Connectivity:</strong> Cloud recipe management and parameter sharing.</li><li><strong>Autopurge:</strong> Automatic grouphead rinse after portafilter removal.</li></ul>'
    ),
    array(
        'title'       => 'Victoria Arduino Eagle Tempo',
        'slug'        => 'victoria-arduino-eagle-tempo',
        'cat'         => 'Commercial Espresso Machines',
        'price'       => '1250000',
        'sku'         => 'SNT-VA-TEMPO',
        'img'         => 'showcase_victoria-arduino-eagle-tempo_1.png',
        'gallery'     => array( 'showcase_victoria-arduino-eagle-tempo_3.jpg', 'showcase_victoria-arduino-eagle-tempo_6.jpg' ),
        'excerpt'     => 'High-volume commercial espresso machine engineered for high productivity cafes, restaurants, and hospitality businesses.',
        'desc'        => '<h3>Victoria Arduino Eagle Tempo</h3><p>The Eagle Tempo combines unmistakable Victoria Arduino aesthetic with high-volume capacity and temperature consistency across busy service hours.</p><ul><li><strong>High Productivity Boiler:</strong> Optimized steam volume for back-to-back milk steaming.</li><li><strong>EasyCream Technology:</strong> Automatic micro-foam texturing with variable air injection.</li><li><strong>Ergonomic Portafilters:</strong> Cool-touch insulated steam wands.</li></ul>'
    ),
    array(
        'title'       => 'Victoria Arduino E1 Prima',
        'slug'        => 'victoria-arduino-e1-prima',
        'cat'         => 'Commercial Espresso Machines',
        'price'       => '680000',
        'sku'         => 'SNT-VA-E1PRIMA',
        'img'         => 'showcase_e1-prima-victoria-arduino-singapore_1.png',
        'gallery'     => array( 'showcase_e1-prima-victoria-arduino-singapore_3.jpg', 'showcase_e1-prima-victoria-arduino-singapore_6.png' ),
        'excerpt'     => 'Professional 1-group compact espresso powerhouse for boutique cafes, roasteries, studio labs, and luxury homes.',
        'desc'        => '<h3>Victoria Arduino E1 Prima (1-Group)</h3><p>E1 Prima brings professional multiboiler performance into a versatile single-group footprint. 100% barista control via mobile app Bluetooth.</p><ul><li><strong>NEO Technology:</strong> Ready in 8 minutes from cold start.</li><li><strong>Ghost Display:</strong> Touch OLED interface seamlessly integrated into grouphead.</li><li><strong>Cool Touch Steam Wand:</strong> Professional dry steam power up to 2.5 bar.</li></ul>'
    ),
    // 2. Nuova Simonelli Commercial Line
    array(
        'title'       => 'Nuova Simonelli Appia Life (2-Group & 3-Group)',
        'slug'        => 'nuova-simonelli-appia-life',
        'cat'         => 'Commercial Espresso Machines',
        'price'       => '750000',
        'sku'         => 'SNT-NS-APPIALIFE',
        'img'         => 'showcase_nuova-appia-life-timer_1.jpg',
        'gallery'     => array( 'showcase_nuova-appia-life-timer_2.png', 'showcase_nuova-appia-life-timer_3.png' ),
        'excerpt'     => 'The most trusted commercial espresso workhorse in Bangladesh with SIS pre-infusion and 20% energy savings.',
        'desc'        => '<h3>Nuova Simonelli Appia Life</h3><p>Renowned for exceptional reliability and cup consistency. Appia Life is the preferred choice of top cafes and restaurant chains in Dhaka.</p><ul><li><strong>Soft Infusion System (SIS):</strong> Guarantees soft, creamy espresso extractions.</li><li><strong>DryTex Boiler Insulation:</strong> Reduces energy consumption by 13%.</li><li><strong>EasyCream System:</strong> Uniform cappuccino micro-foam at the press of a lever.</li><li><strong>Raised Groups:</strong> Accommodates tall takeaway cups effortlessly.</li></ul>'
    ),
    array(
        'title'       => 'Nuova Simonelli Appia Viva Commercial Espresso Machine',
        'slug'        => 'nuova-simonelli-appia-viva',
        'cat'         => 'Commercial Espresso Machines',
        'price'       => '820000',
        'sku'         => 'SNT-NS-VIVA',
        'img'         => 'nuova-simonelli-appia-viva-commercial-espresso-machine_1.png',
        'gallery'     => array( 'nuova-simonelli-appia-viva-commercial-espresso-machine_2.png' ),
        'excerpt'     => 'High-capacity dual group commercial espresso machine with modern ergonomics and reinforced chassis.',
        'desc'        => '<h3>Nuova Simonelli Appia Viva</h3><p>Designed for medium-to-high volume cafe operations demanding consistent extraction quality and low maintenance overhead.</p><ul><li><strong>Stainless Steel Construction:</strong> Heavy duty corrosion-resistant body.</li><li><strong>Dual High-Output Steam Wands:</strong> Effortless milk jug steaming.</li><li><strong>Ergonomic Push-Pull Levers:</strong> Eliminates barista wrist fatigue.</li></ul>'
    ),
    array(
        'title'       => 'Nuova Simonelli Aurelia Wave UX',
        'slug'        => 'nuova-simonelli-aurelia-wave-ux',
        'cat'         => 'Commercial Espresso Machines',
        'price'       => '1650000',
        'sku'         => 'SNT-NS-AURELIA',
        'img'         => 'showcase_nuova-aurelia_1.jpg',
        'gallery'     => array( 'showcase_nuova-aurelia_2.png', 'showcase_nuova-aurelia_7.jpg' ),
        'excerpt'     => 'The official machine of world barista competitions featuring independent temperature fluid dynamics and Smart Water Technology.',
        'desc'        => '<h3>Nuova Simonelli Aurelia Wave UX</h3><p>The pinnacle of fluid dynamics technology. Aurelia Wave gives baristas full independent temperature control over every individual grouphead.</p><ul><li><strong>Independent Group Thermo-Control:</strong> Set different temperatures for distinct bean roasts.</li><li><strong>Smart Water Technology:</strong> Real-time TDS and water quality monitoring.</li><li><strong>Ergonomic Pulse Steam:</strong> Precision foam texturing.</li></ul>'
    ),
    // 3. CREM Espresso Machines
    array(
        'title'       => 'CREM EX3 Commercial Espresso Machine',
        'slug'        => 'crem-ex3',
        'cat'         => 'Commercial Espresso Machines',
        'price'       => '650000',
        'sku'         => 'SNT-CREM-EX3',
        'img'         => 'crem-ex3_1.webp',
        'gallery'     => array( 'crem-ex3_2.webp' ),
        'excerpt'     => 'Award-winning European commercial espresso machine combining smart modularity with barista ergonomics.',
        'desc'        => '<h3>CREM EX3 (2-Group & 3-Group)</h3><p>Winner of the IF Design Award and Red Dot Award. The CREM EX3 delivers precise PID temperature control and dual pre-infusion chambers.</p><ul><li><strong>Modular Design:</strong> Sleek aesthetic suited for modern contemporary cafe spaces.</li><li><strong>PID Temperature Control:</strong> High thermal stability within +/- 0.5°C.</li><li><strong>Pre-infusion Chamber:</strong> Enhances aroma extraction and body.</li></ul>'
    ),
    // 4. Commercial Coffee Grinders
    array(
        'title'       => 'Victoria Arduino Mythos MY75 / MY85 On-Demand Grinder',
        'slug'        => 'victoria-arduino-mythos-my-series',
        'cat'         => 'Commercial Coffee Grinders',
        'price'       => '420000',
        'sku'         => 'SNT-VA-MYTHOS',
        'img'         => 'showcase_victoria-arduino-my-series-grinders_1.webp',
        'gallery'     => array( 'showcase_victoria-arduino-my-series-grinders_2.jpg', 'showcase_victoria-arduino-my-series-grinders_4.jpg' ),
        'excerpt'     => 'The global benchmark for specialty coffee grinding featuring Clima Pro thermal stability and zero-retention clump crushers.',
        'desc'        => '<h3>Victoria Arduino Mythos (MY75 / MY85 / Gravimetric)</h3><p>The Mythos series is the undisputed champion grinder of world barista stages. Features patented Clima Pro heating and cooling chamber for exact grind micron uniformity.</p><ul><li><strong>75mm / 85mm Titanium Burrs:</strong> Flawless grind speed under 2.5 seconds per dose.</li><li><strong>Clima Pro 2.0:</strong> Eliminates morning grind dial-in shifts.</li><li><strong>Gravimetric Option:</strong> Grinds by exact weight in grams directly into portafilter.</li><li><strong>Touchscreen Display:</strong> Fast programmed dose adjustments.</li></ul>'
    ),
    array(
        'title'       => 'Nuova Simonelli MDJ On-Demand Commercial Grinder',
        'slug'        => 'nuova-simonelli-mdj-grinder',
        'cat'         => 'Commercial Coffee Grinders',
        'price'       => '280000',
        'sku'         => 'SNT-NS-MDJ',
        'img'         => 'nuova-simonelli-mdj_1.webp',
        'gallery'     => array( 'nuova-simonelli-mdj_2.webp' ),
        'excerpt'     => 'High-output 75mm flat burr on-demand espresso grinder engineered for silent, high-volume cafe grinding.',
        'desc'        => '<h3>Nuova Simonelli MDJ On-Demand</h3><p>Engineered for high-volume coffee operations. The MDJ delivers up to 13 kg/hour grinding capacity with whisper-quiet sound-insulating body.</p><ul><li><strong>75mm Stainless Steel Burrs:</strong> Fast, consistent grind distribution.</li><li><strong>Silent Grind Technology:</strong> Reduces noise levels by over 10 dB.</li><li><strong>Micrometric Regulation:</strong> Stepless infinite grind adjustment.</li></ul>'
    ),
    array(
        'title'       => 'Nuova Simonelli MDXS On-Demand Grinder',
        'slug'        => 'nuova-simonelli-mdxs-grinder',
        'cat'         => 'Commercial Coffee Grinders',
        'price'       => '230000',
        'sku'         => 'SNT-NS-MDXS',
        'img'         => 'nuova-simonelli-mdxs-on-demand-grinder_1.webp',
        'gallery'     => array( 'nuova-simonelli-mdxs-on-demand-grinder_2.webp' ),
        'excerpt'     => 'Versatile 65mm on-demand espresso grinder with LED portafilter illumination and precision doser.',
        'desc'        => '<h3>Nuova Simonelli MDXS On-Demand</h3><p>Compact footprint with heavy-duty commercial internals. Perfect for medium cafes and secondary decaf/single origin service.</p><ul><li><strong>65mm Hardened Steel Burrs:</strong> Clean, fluffy grinds with zero channeling.</li><li><strong>LED Illumination:</strong> Direct lighting over portafilter basket.</li></ul>'
    ),
    // 5. Super Automatic Bean-to-Cup Machines
    array(
        'title'       => 'Kalerm Y580C Commercial Super Automatic Espresso Machine',
        'slug'        => 'kalerm-y580c',
        'cat'         => 'Super Automatic Bean-to-Cup',
        'price'       => '480000',
        'sku'         => 'SNT-KAL-Y580C',
        'img'         => 'kalerm-y580c_1.webp',
        'gallery'     => array( 'kalerm-y580c_2.webp' ),
        'excerpt'     => 'High-capacity corporate and hotel bean-to-cup machine delivering 200+ cups daily with 10.1-inch Android touch screen.',
        'desc'        => '<h3>Kalerm Y580C Commercial Automatic</h3><p>The ultimate solution for high-end corporate offices, hotel lounges, and convenience retail. One-touch brewing for 24+ beverage selections.</p><ul><li><strong>10.1-inch HD Touch Screen:</strong> Fully customizable drink menu and video promo display.</li><li><strong>Dual Grinders & Dual Boilers:</strong> Seamless espresso and fresh milk texturing.</li><li><strong>Self-Cleaning System:</strong> Automated milk pipe and brewing group rinse.</li><li><strong>Direct Water Line & Waste Drainage:</strong> Zero-downtime continuous operation.</li></ul>'
    ),
    array(
        'title'       => 'Kalerm 460C Super Automatic Coffee Machine',
        'slug'        => 'kalerm-460c',
        'cat'         => 'Super Automatic Bean-to-Cup',
        'price'       => '320000',
        'sku'         => 'SNT-KAL-460C',
        'img'         => 'kalerm-460c_1.webp',
        'gallery'     => array( 'kalerm-460c_2.webp' ),
        'excerpt'     => 'Reliable one-touch cappuccino and latte machine for corporate headquarters, executive boardrooms, and boutique cafes.',
        'desc'        => '<h3>Kalerm 460C Bean-to-Cup</h3><p>Compact, elegant, and efficient. Delivers authentic barista-grade espresso, americano, and velvety milk beverages at the touch of a button.</p><ul><li><strong>Patented Brew Unit:</strong> Consistent 19-bar extraction pressure.</li><li><strong>Dual Thermoblock Heating:</strong> Instant temperature transition between coffee and steam.</li></ul>'
    ),
    array(
        'title'       => 'Kalerm B6 Bean-to-Cup Office Coffee Machine',
        'slug'        => 'kalerm-b6',
        'cat'         => 'Super Automatic Bean-to-Cup',
        'price'       => '260000',
        'sku'         => 'SNT-KAL-B6',
        'img'         => 'kalerm-b6_1.webp',
        'gallery'     => array( 'kalerm-b6_2.webp' ),
        'excerpt'     => 'Modern smart bean-to-cup coffee machine with intuitive touch menu, ideal for offices with 30-100 staff.',
        'desc'        => '<h3>Kalerm B6 Office Coffee Solution</h3><p>Designed to deliver fresh roast coffee all day long with zero barista training required.</p><ul><li><strong>7-inch Color Screen:</strong> 16 customizable coffee and tea beverages.</li><li><strong>Ceramic Flat Burrs:</strong> Consistent grind size with low heat transfer.</li></ul>'
    ),
    array(
        'title'       => 'Rex-Royal S1 Swiss Automatic Coffee Machine',
        'slug'        => 'rex-royal-s1',
        'cat'         => 'Super Automatic Bean-to-Cup',
        'price'       => '950000',
        'sku'         => 'SNT-RR-S1',
        'img'         => 'showcase_rex-royal_1.jpg',
        'gallery'     => array( 'showcase_rex-royal_2.webp', 'showcase_rex-royal_4.webp' ),
        'excerpt'     => '100% Swiss Made precision super automatic espresso machine with patented Rex-Royal metal brewing group.',
        'desc'        => '<h3>Rex-Royal S1 (Swiss Made)</h3><p>Swiss engineering at its best. Built for heavy commercial use in airport lounges, luxury hotels, and fast-paced bakeries.</p><ul><li><strong>Metal Brewing Unit:</strong> Accommodates up to 23 grams of coffee for intense extraction.</li><li><strong>Compact 30cm Width:</strong> Space-saving premium stainless design.</li><li><strong>HACCP Certified Cleaning:</strong> Fully automatic hygiene program.</li></ul>'
    ),
    array(
        'title'       => 'Rex-Royal S300 / S500 High-Capacity Swiss Machine',
        'slug'        => 'rex-royal-s500',
        'cat'         => 'Super Automatic Bean-to-Cup',
        'price'       => '1850000',
        'sku'         => 'SNT-RR-S500',
        'img'         => 'showcase_rex-royal_8.webp',
        'gallery'     => array( 'showcase_rex-royal_10.webp', 'showcase_rex-royal_12.webp' ),
        'excerpt'     => 'The ultimate high-capacity Swiss automatic coffee system capable of brewing 350+ cups per hour with dual fresh milk and chocolate.',
        'desc'        => '<h3>Rex-Royal S500 Commercial Enterprise</h3><p>For high-throughput venues demanding continuous operation and unmatched Swiss build quality.</p><ul><li><strong>Dual Grinders & Heated Metal Brew Group.</strong></li><li><strong>Simultaneous Dispensing:</strong> Coffee and hot water/milk at the same time.</li><li><strong>IoT Telemetry:</strong> Live cloud consumption and maintenance monitoring.</li></ul>'
    ),
    // 6. Specialty Brewing & Robotic Barista
    array(
        'title'       => '3TEMP Hyperscaling Filter Coffee Brewer System',
        'slug'        => '3temp-hyperscaling-brewer',
        'cat'         => 'Specialty Tea & Brewing Systems',
        'price'       => '850000',
        'sku'         => 'SNT-3TEMP-BREWER',
        'img'         => 'showcase_3temp_1.webp',
        'gallery'     => array( 'showcase_3temp_3.jpg', 'showcase_3temp_7.webp' ),
        'excerpt'     => 'Scandinavian temperature profiling batch brewer for single origin coffees and competition filter brewing.',
        'desc'        => '<h3>3TEMP Hyperscaling Brewer (Sweden)</h3><p>Revolutionary filter coffee machine with 3-stage temperature profiling per brew cycle (Blooming, Infusion, Finalization).</p><ul><li><strong>Zero Tank Heat Loss:</strong> Flash water heating delivers exact programmed temperature on contact.</li><li><strong>Batch Size Modularity:</strong> Brew from single cup 250ml up to 6 Liters.</li><li><strong>Cold Drip Mode:</strong> Extracts specialty cold brew in under 20 minutes.</li></ul>'
    ),
    array(
        'title'       => 'CAYE Bionic Barista Automated Coffee Kiosk',
        'slug'        => 'caye-bionic-barista',
        'cat'         => 'Robotic & Automated Kiosks',
        'price'       => '3500000',
        'sku'         => 'SNT-CAYE-ROBOT',
        'img'         => 'showcase_caye-bionic-barista_1.png',
        'gallery'     => array( 'showcase_caye-bionic-barista_2.jpg', 'showcase_caye-bionic-barista_5.webp' ),
        'excerpt'     => 'Fully autonomous 6-axis robotic barista coffee kiosk for universities, airports, shopping malls, and corporate parks.',
        'desc'        => '<h3>CAYE Bionic Barista Robotic Kiosk</h3><p>The future of automated specialty coffee. Powered by precision 6-axis robotic arm, dual espresso grinders, and automatic milk texturing.</p><ul><li><strong>24/7 Unattended Operation:</strong> Serves up to 80 cups per hour.</li><li><strong>Interactive Latte Art Printing:</strong> Custom selfies and logos on foam.</li><li><strong>Integrated Mobile Order & Payment.</strong></li></ul>'
    ),
    array(
        'title'       => 'Galaxy 2-Groups Under-Counter Teapresso Machine',
        'slug'        => 'galaxy-teapresso-machine',
        'cat'         => 'Specialty Tea & Brewing Systems',
        'price'       => '550000',
        'sku'         => 'SNT-GALAXY-TEA',
        'img'         => 'galaxy-2-groups-under-counter-teapresso-machine_1.webp',
        'gallery'     => array( 'galaxy-2-groups-under-counter-teapresso-machine_2.webp' ),
        'excerpt'     => 'High-pressure under-counter tea extraction system for modern bubble tea cafes and premium beverage bars.',
        'desc'        => '<h3>Galaxy 2-Groups Teapresso System</h3><p>Extracts fresh whole leaf tea in 45 seconds using high pressure extraction for maximum polyphenol aroma and clean body.</p><ul><li><strong>Multi-stage Pressure Profiling:</strong> Tailored for green, black, oolong, and floral teas.</li><li><strong>Under-Counter Space-Saving Design.</strong></li></ul>'
    ),
    // 7. Santino Specialty Roastery Beans
    array(
        'title'       => 'Santino Rainforest Reserve Coffee Beans (Rainforest Alliance Certified)',
        'slug'        => 'santino-rainforest-reserve',
        'cat'         => 'Specialty Roastery Beans',
        'price'       => '2800',
        'sku'         => 'SNT-BEAN-RF-1KG',
        'img'         => 'santino-rainforest-reserve-rainforest-alliance-certified_1.webp',
        'gallery'     => array( 'santino-rainforest-reserve-rainforest-alliance-certified_2.webp' ),
        'excerpt'     => '100% Arabica Rainforest Alliance Certified roast with notes of dark chocolate, roasted hazelnut, and sweet brown sugar.',
        'desc'        => '<h3>Santino Rainforest Reserve (1kg)</h3><p>Our flagship certified sustainable specialty roast. Ethically sourced from sustainable farms and roasted freshly at our Dhaka Roastery Lab.</p><ul><li><strong>Roast Profile:</strong> Medium-Dark.</li><li><strong>Tasting Notes:</strong> Dark Chocolate, Toffee, Roasted Almond, Honey sweetness.</li><li><strong>Ideal For:</strong> Commercial Espresso, Americano, and Handcrafted Latte.</li></ul>'
    ),
    array(
        'title'       => 'Santino Gourmet Signature Espresso Blend',
        'slug'        => 'santino-gourmet-signature-blend',
        'cat'         => 'Specialty Roastery Beans',
        'price'       => '2400',
        'sku'         => 'SNT-BEAN-GOURMET-1KG',
        'img'         => 'imgi_19_santino_-_250522-07313.jpg',
        'gallery'     => array( 'imgi_23_santino_-_250522-07495.jpg', 'imgi_24_santino_-_250522-07240.jpg' ),
        'excerpt'     => 'Artisanal high-crema espresso blend crafted specifically for milk-based drinks and Dhaka cafe menus.',
        'desc'        => '<h3>Santino Gourmet Signature Blend (1kg)</h3><p>Rich, creamy, and bold. Formulated to cut beautifully through steamed milk, creating rich caramel notes and thick golden crema.</p><ul><li><strong>Origin Blend:</strong> South America & Asia-Pacific Specialty Lots.</li><li><strong>Flavor Notes:</strong> Cocoa nibs, Spiced Caramel, Black Cherry.</li></ul>'
    ),
    array(
        'title'       => 'Santino Single Origin Micro-Lot Ethiopian Yirgacheffe',
        'slug'        => 'santino-ethiopia-yirgacheffe',
        'cat'         => 'Specialty Roastery Beans',
        'price'       => '3400',
        'sku'         => 'SNT-BEAN-ETH-250G',
        'img'         => 'imgi_30_Blue-Stone-3_800x_526184df-2650-40b7-9dcf-e8af5b97527b.webp',
        'gallery'     => array( 'imgi_29_maverick-VA_1200x1200_fc8d047e-bc19-4666-8e3a-90081b8cdca7.webp' ),
        'excerpt'     => 'Specialty grade single origin washed Arabica with delicate jasmine floral aroma, bergamot, and lemon citrus clarity.',
        'desc'        => '<h3>Santino Single Origin Ethiopia Yirgacheffe (250g / 1kg)</h3><p>Hand-picked Grade 1 Ethiopian Arabica. Light-Medium roast for filter pourover (V60 / Chemex / Aeropress) and bright espresso extractions.</p><ul><li><strong>Process:</strong> Fully Washed.</li><li><strong>Altitude:</strong> 1,900 - 2,200 MASL.</li><li><strong>Cup Score:</strong> 87.5 SCA Specialty Score.</li></ul>'
    ),
    // 8. Commercial Milk Coolers & Barista Equipment
    array(
        'title'       => 'Kalerm C100 / C22 Commercial Milk Cooler Fridge',
        'slug'        => 'kalerm-commercial-milk-cooler',
        'cat'         => 'Barista Accessories & Maintenance',
        'price'       => '85000',
        'sku'         => 'SNT-COOLER-C100',
        'img'         => 'kalerm-c100-milk-cooler-fridge_1.webp',
        'gallery'     => array( 'kalerm-c22-milk-cooler_1.webp' ),
        'excerpt'     => 'Thermostatic 4°C fresh milk refrigerator with direct hose ports for automatic bean-to-cup coffee machines.',
        'desc'        => '<h3>Kalerm Commercial Milk Fridge</h3><p>Keeps fresh dairy milk at consistent 4°C to prevent bacteria growth and ensure dense, velvety microfoam.</p><ul><li><strong>Capacity:</strong> Holds 2 x 2L milk cartons.</li><li><strong>Sensor Monitoring:</strong> Digital temperature readout on front door.</li></ul>'
    )
);

echo "=== 2. IMPORTING " . count( $real_catalog ) . " AUTHENTIC SANTINO PRODUCTS ===\n";

$imported_count = 0;

foreach ( $real_catalog as $idx => $item ) {
    $post_id = wp_insert_post( array(
        'post_title'   => $item['title'],
        'post_name'    => $item['slug'],
        'post_content' => $item['desc'],
        'post_excerpt' => $item['excerpt'],
        'post_status'  => 'publish',
        'post_type'    => 'product',
    ) );

    if ( ! $post_id || is_wp_error( $post_id ) ) {
        echo "Error inserting {$item['title']}\n";
        continue;
    }

    // Assign Category & Type
    wp_set_object_terms( $post_id, 'simple', 'product_type' );
    wp_set_object_terms( $post_id, $item['cat'], 'product_cat' );

    // WooCommerce Meta
    update_post_meta( $post_id, '_visibility', 'visible' );
    update_post_meta( $post_id, '_stock_status', 'instock' );
    update_post_meta( $post_id, '_price', $item['price'] );
    update_post_meta( $post_id, '_regular_price', $item['price'] );
    update_post_meta( $post_id, '_sku', $item['sku'] );
    update_post_meta( $post_id, '_manage_stock', 'no' );

    // Attach Featured Image
    $thumb_id = santino_attach_image( $item['img'], $imgs_dir, $post_id, $item['title'] );
    if ( $thumb_id ) {
        set_post_thumbnail( $post_id, $thumb_id );
    }

    // Attach Gallery
    if ( ! empty( $item['gallery'] ) ) {
        $g_ids = array();
        foreach ( $item['gallery'] as $g_file ) {
            $gid = santino_attach_image( $g_file, $imgs_dir, $post_id, $item['title'] );
            if ( $gid ) {
                $g_ids[] = $gid;
            }
        }
        if ( ! empty( $g_ids ) ) {
            update_post_meta( $post_id, '_product_image_gallery', implode( ',', $g_ids ) );
        }
    }

    $imported_count++;
    echo "[✓] Imported: {$item['title']} -> Category: {$item['cat']} | Price: ৳{$item['price']}\n";
}

echo "\n=======================================================\n";
echo "SUCCESS! Imported $imported_count Authentic Santino Commercial Products into WooCommerce!\n";
echo "=======================================================\n";
