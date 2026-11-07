<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Handcrafted_Items_System {

    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_type' ) );
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
        add_action( 'save_post', array( __CLASS__, 'save_meta_box_data' ) );

        add_filter( 'manage_santino_item_posts_columns', array( __CLASS__, 'set_columns' ) );
        add_action( 'manage_santino_item_posts_custom_column', array( __CLASS__, 'render_columns' ), 10, 2 );

        add_action( 'admin_init', array( __CLASS__, 'maybe_seed_items' ) );
        add_action( 'admin_init', array( __CLASS__, 'handle_csv_downloads' ) );
        add_action( 'admin_init', array( __CLASS__, 'handle_csv_upload' ) );
        add_action( 'admin_notices', array( __CLASS__, 'render_admin_csv_ui' ) );
    }

    public static function register_post_type() {
        $labels = array(
            'name'               => __( 'Handcrafted Items', 'santino' ),
            'singular_name'      => __( 'Handcrafted Item', 'santino' ),
            'menu_name'          => __( 'Handcrafted Items', 'santino' ),
            'name_admin_bar'     => __( 'Handcrafted Item', 'santino' ),
            'add_new'            => __( 'Add New Item', 'santino' ),
            'add_new_item'       => __( 'Add New Handcrafted Item', 'santino' ),
            'new_item'           => __( 'New Item', 'santino' ),
            'edit_item'          => __( 'Edit Item', 'santino' ),
            'view_item'          => __( 'View Item', 'santino' ),
            'all_items'          => __( 'All Handcrafted Items', 'santino' ),
            'search_items'       => __( 'Search Items', 'santino' ),
            'not_found'          => __( 'No items found.', 'santino' ),
            'not_found_in_trash' => __( 'No items in trash.', 'santino' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 28,
            'menu_icon'          => 'dashicons-coffee',
            'query_var'          => false,
            'rewrite'            => false,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'supports'           => array( 'title', 'thumbnail', 'editor' ),
        );

        register_post_type( 'santino_item', $args );
    }

    public static function add_meta_boxes() {
        add_meta_box(
            'santino_item_details',
            __( 'Handcrafted Item Details & Pricing', 'santino' ),
            array( __CLASS__, 'render_meta_box' ),
            'santino_item',
            'normal',
            'high'
        );
    }

    public static function render_meta_box( $post ) {
        wp_nonce_field( 'santino_item_nonce_action', 'santino_item_nonce' );

        $category    = get_post_meta( $post->ID, '_santino_item_category', true ) ?: 'barista-coffee';
        $price       = get_post_meta( $post->ID, '_santino_item_price', true ) ?: '170';
        $roast       = get_post_meta( $post->ID, '_santino_item_roast', true ) ?: 'Reg Tk. 170 | Large Tk. 220';
        $tag         = get_post_meta( $post->ID, '_santino_item_tag', true ) ?: 'HERO ITEM';
        $calories    = get_post_meta( $post->ID, '_santino_item_calories', true ) ?: '140 kcal';
        $type        = get_post_meta( $post->ID, '_santino_item_type', true ) ?: 'hot';
        $bestseller  = get_post_meta( $post->ID, '_santino_item_bestseller', true );
        $plantbased  = get_post_meta( $post->ID, '_santino_item_plantbased', true );
        $redeemable  = get_post_meta( $post->ID, '_santino_item_redeemable', true ) ?: 'yes';
        $custom_img  = get_post_meta( $post->ID, '_santino_item_custom_img', true );
        ?>
        <style>
            .santino-item-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                margin-top: 10px;
            }
            .santino-item-field {
                display: flex;
                flex-direction: column;
            }
            .santino-item-field label {
                font-weight: 600;
                margin-bottom: 5px;
                color: #0f172a;
            }
            .santino-item-field input, .santino-item-field select {
                padding: 8px 12px;
                border: 1px solid #cbd5e1;
                border-radius: 6px;
                font-size: 14px;
            }
            .santino-item-full {
                grid-column: span 2;
            }
        </style>

        <div class="santino-item-grid">
            <div class="santino-item-field">
                <label for="santino_item_category"><?php _e( 'Menu Category', 'santino' ); ?></label>
                <select id="santino_item_category" name="santino_item_category">
                    <option value="barista-coffee" <?php selected( $category, 'barista-coffee' ); ?>>Barista Classics / Coffee</option>
                    <option value="signature-lattes" <?php selected( $category, 'signature-lattes' ); ?>>Signature Lattes</option>
                    <option value="specialty-espresso" <?php selected( $category, 'specialty-espresso' ); ?>>Specialty Espresso &amp; Pour-over</option>
                    <option value="matcha-tea" <?php selected( $category, 'matcha-tea' ); ?>>Matcha, Tea &amp; Blended Frappes</option>
                    <option value="pastry-bakery" <?php selected( $category, 'pastry-bakery' ); ?>>Artisan Bakery &amp; Treats</option>
                </select>
            </div>

            <div class="santino-item-field">
                <label for="santino_item_price"><?php _e( 'Base Price (Tk)', 'santino' ); ?></label>
                <input type="number" id="santino_item_price" name="santino_item_price" value="<?php echo esc_attr( $price ); ?>" placeholder="e.g. 170" required>
            </div>

            <div class="santino-item-field">
                <label for="santino_item_type"><?php _e( 'Drink Serving Type', 'santino' ); ?></label>
                <select id="santino_item_type" name="santino_item_type">
                    <option value="hot" <?php selected( $type, 'hot' ); ?>>Hot Only</option>
                    <option value="iced" <?php selected( $type, 'iced' ); ?>>Iced Only</option>
                    <option value="both" <?php selected( $type, 'both' ); ?>>Both Hot &amp; Iced</option>
                    <option value="blended" <?php selected( $type, 'blended' ); ?>>Ice Blended / Frappe</option>
                </select>
            </div>

            <div class="santino-item-field">
                <label for="santino_item_roast"><?php _e( 'Sizes / Portion / Description Tag', 'santino' ); ?></label>
                <input type="text" id="santino_item_roast" name="santino_item_roast" value="<?php echo esc_attr( $roast ); ?>" placeholder="e.g. Reg Tk. 170 | Large Tk. 220">
            </div>

            <div class="santino-item-field">
                <label for="santino_item_tag"><?php _e( 'Visual Badge / Pill Tag', 'santino' ); ?></label>
                <input type="text" id="santino_item_tag" name="santino_item_tag" value="<?php echo esc_attr( $tag ); ?>" placeholder="e.g. HERO ITEM, BESTSELLER, NEW">
            </div>

            <div class="santino-item-field">
                <label for="santino_item_calories"><?php _e( 'Calories Info', 'santino' ); ?></label>
                <input type="text" id="santino_item_calories" name="santino_item_calories" value="<?php echo esc_attr( $calories ); ?>" placeholder="e.g. 140 kcal">
            </div>

            <div class="santino-item-field santino-item-full" style="background:#f8fafc; padding:12px; border-radius:6px; border:1px solid #e2e8f0;">
                <label style="margin-bottom:8px; display:block;"><?php _e( 'Special Flags & 6th Cup Free Redeem Eligibility', 'santino' ); ?></label>
                <div style="display:flex; gap:24px; flex-wrap:wrap;">
                    <label style="font-weight:normal; cursor:pointer;">
                        <input type="checkbox" name="santino_item_redeemable" value="yes" <?php checked( $redeemable, 'yes' ); ?>>
                        <strong style="color:#00625d;">✓ Eligible for 6th Cup Free VIP Redeem</strong> (সদস্যরা ৫ কাপ স্ট্যাম্প সম্পন্ন করলে এই আইটেমটি ফ্রি হিসেবে রিডিম করতে পারবে)
                    </label>

                    <label style="font-weight:normal; cursor:pointer;">
                        <input type="checkbox" name="santino_item_bestseller" value="yes" <?php checked( $bestseller, 'yes' ); ?>>
                        <strong>Mark as Bestseller</strong>
                    </label>

                    <label style="font-weight:normal; cursor:pointer;">
                        <input type="checkbox" name="santino_item_plantbased" value="yes" <?php checked( $plantbased, 'yes' ); ?>>
                        <strong>Plant-Based / Oat Milk</strong>
                    </label>
                </div>
            </div>

            <div class="santino-item-field santino-item-full">
                <p class="description" style="color: #64748b; font-size: 13px; margin: 4px 0 0;">
                    <?php _e( '💡 <strong>Photo Upload:</strong> Use the "Featured Image" box on the right sidebar to upload the coffee drink image. If no photo is uploaded, a category coffee image will automatically be displayed.', 'santino' ); ?>
                </p>
            </div>
        </div>
        <?php
    }

    public static function save_meta_box_data( $post_id ) {
        if ( ! isset( $_POST['santino_item_nonce'] ) || ! wp_verify_nonce( $_POST['santino_item_nonce'], 'santino_item_nonce_action' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( 'santino_item' !== get_post_type( $post_id ) ) {
            return;
        }

        $fields = array(
            'santino_item_category'   => '_santino_item_category',
            'santino_item_price'      => '_santino_item_price',
            'santino_item_roast'      => '_santino_item_roast',
            'santino_item_tag'        => '_santino_item_tag',
            'santino_item_calories'   => '_santino_item_calories',
            'santino_item_type'       => '_santino_item_type',
        );

        foreach ( $fields as $input_key => $meta_key ) {
            if ( isset( $_POST[ $input_key ] ) ) {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $input_key ] ) ) );
            }
        }

        update_post_meta( $post_id, '_santino_item_redeemable', isset( $_POST['santino_item_redeemable'] ) ? 'yes' : 'no' );
        update_post_meta( $post_id, '_santino_item_bestseller', isset( $_POST['santino_item_bestseller'] ) ? 'yes' : 'no' );
        update_post_meta( $post_id, '_santino_item_plantbased', isset( $_POST['santino_item_plantbased'] ) ? 'yes' : 'no' );
    }

    public static function set_columns( $columns ) {
        $new_columns = array(
            'cb'         => $columns['cb'],
            'thumb'      => __( 'Photo', 'santino' ),
            'title'      => __( 'Item Name', 'santino' ),
            'category'   => __( 'Category', 'santino' ),
            'price'      => __( 'Price (Tk)', 'santino' ),
            'type'       => __( 'Type', 'santino' ),
            'redeemable' => __( '6th Cup Redeemable', 'santino' ),
        );
        return $new_columns;
    }

    public static function render_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'thumb':
                if ( has_post_thumbnail( $post_id ) ) {
                    echo get_the_post_thumbnail( $post_id, array( 50, 50 ), array( 'style' => 'border-radius:6px; object-fit:cover;' ) );
                } else {
                    $custom_img = get_post_meta( $post_id, '_santino_item_custom_img', true );
                    if ( ! empty( $custom_img ) ) {
                        echo '<img src="' . esc_url( $custom_img ) . '" alt="" style="width:50px; height:50px; border-radius:6px; object-fit:cover; display:block;" />';
                    } else {
                        echo '<span style="display:inline-block; width:45px; height:45px; background:#f1f5f9; border-radius:6px; line-height:45px; text-align:center; font-size:20px;">☕</span>';
                    }
                }
                break;

            case 'category':
                $cat = get_post_meta( $post_id, '_santino_item_category', true );
                echo '<span class="badge" style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:4px; font-weight:600;">' . esc_html( ucfirst( str_replace( '-', ' ', $cat ?: 'coffee' ) ) ) . '</span>';
                break;

            case 'price':
                $price = get_post_meta( $post_id, '_santino_item_price', true );
                echo '<strong>Tk ' . esc_html( $price ?: '0' ) . '</strong>';
                break;

            case 'type':
                $type = get_post_meta( $post_id, '_santino_item_type', true ) ?: 'hot';
                echo esc_html( strtoupper( $type ) );
                break;

            case 'redeemable':
                $red = get_post_meta( $post_id, '_santino_item_redeemable', true ) ?: 'yes';
                if ( 'yes' === $red ) {
                    echo '<span style="color:#059669; font-weight:700;">✓ Free Redeem Eligible</span>';
                } else {
                    echo '<span style="color:#94a3b8;">No</span>';
                }
                break;
        }
    }

    public static function get_all_menu_items() {
        $posts = get_posts( array(
            'post_type'      => 'santino_item',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
        ) );

        if ( empty( $posts ) ) {
            return array();
        }

        $items = array();
        foreach ( $posts as $p ) {
            $cat   = get_post_meta( $p->ID, '_santino_item_category', true ) ?: 'barista-coffee';
            if ( $cat === 'pastry-bakery' ) {
                $cat = 'bakery';
            } elseif ( $cat === 'specialty-espresso' ) {
                $cat = 'soe-espresso';
            }
            $price = intval( get_post_meta( $p->ID, '_santino_item_price', true ) ?: 170 );
            $tag   = get_post_meta( $p->ID, '_santino_item_tag', true ) ?: '';
            $roast = get_post_meta( $p->ID, '_santino_item_roast', true ) ?: ( 'Tk. ' . $price );
            $cal   = get_post_meta( $p->ID, '_santino_item_calories', true ) ?: '';
            $type  = get_post_meta( $p->ID, '_santino_item_type', true ) ?: 'hot';
            $best  = get_post_meta( $p->ID, '_santino_item_bestseller', true ) === 'yes';
            $plant = get_post_meta( $p->ID, '_santino_item_plantbased', true ) === 'yes';
            $red   = get_post_meta( $p->ID, '_santino_item_redeemable', true ) !== 'no';

            $img_url = get_the_post_thumbnail_url( $p->ID, 'medium' );
            if ( ! $img_url ) {
                $custom_img = get_post_meta( $p->ID, '_santino_item_custom_img', true );
                if ( ! empty( $custom_img ) ) {
                    $img_url = $custom_img;
                }
            }
            if ( ! $img_url ) {
                $title_lower = strtolower( $p->post_title );
                $img_map = array(
                    'cappuccino'   => 'menu-cappuccino-hot.jpg',
                    'iced latte'   => 'menu-iced-latte.jpg',
                    'hot mocha'    => 'menu-hot-mocha.jpg',
                    'iced mocha'   => 'menu-iced-mocha.jpg',
                    'mocha frappe' => 'menu-mocha-frappe.jpg',
                    'hazelnut'     => 'menu-hazelnut-frappe.jpg',
                    'coconut'      => 'menu-raw-coconut-latte.jpg',
                    'caramel'      => 'menu-caramel-macchiato.jpg',
                    'macchiato'    => 'menu-caramel-macchiato.jpg',
                    'americano'    => 'menu-americano.jpg',
                    'pour-over'    => 'menu-pourover-v60.jpg',
                    'v60'          => 'menu-pourover-v60.jpg',
                    'croissant'    => 'menu-croissant.jpg',
                    'flat white'   => 'menu-flat-white.jpg',
                    'matcha'       => 'menu-matcha-latte.jpg',
                    'chocolate'    => 'menu-iced-chocolate.jpg',
                );
                foreach ( $img_map as $kw => $fname ) {
                    if ( strpos( $title_lower, $kw ) !== false ) {
                        $img_url = function_exists( 'santino_img' ) ? santino_img( $fname ) : ( SANTINO_URI . '/assets/images/' . $fname );
                        break;
                    }
                }
            }
            if ( ! $img_url ) {
                $img_url = function_exists( 'santino_img' ) ? santino_img( 'menu-cappuccino-hot.jpg' ) : ( SANTINO_URI . '/placeholder.jpg' );
            }

            $badgeClass = 'badge-teal';
            if ( stripos( $tag, 'hero' ) !== false ) $badgeClass = 'badge-teal';
            elseif ( stripos( $tag, 'gold' ) !== false || stripos( $tag, 'sign' ) !== false ) $badgeClass = 'badge-gold';
            elseif ( stripos( $tag, 'best' ) !== false || stripos( $tag, 'danger' ) !== false ) $badgeClass = 'badge-danger';

            $items[] = array(
                'id'          => 'item-' . $p->ID,
                'name'        => $p->post_title,
                'category'    => $cat,
                'price'       => $price,
                'tag'         => $tag,
                'badgeClass'  => $badgeClass,
                'img'         => $img_url,
                'desc'        => wp_strip_all_tags( $p->post_content ?: $p->post_title ),
                'calories'    => $cal,
                'type'        => $type,
                'plantBased'  => $plant,
                'bestseller'  => $best,
                'roast'       => $roast,
                'redeemable'  => $red,
            );
        }

        return $items;
    }

    public static function get_redeemable_items() {
        $all = self::get_all_menu_items();
        if ( ! empty( $all ) ) {
            $redeemable = array();
            foreach ( $all as $item ) {
                if ( ! empty( $item['redeemable'] ) ) {
                    $redeemable[] = $item['name'];
                }
            }
            if ( ! empty( $redeemable ) ) {
                return array_unique( $redeemable );
            }
        }

        return array(
            'Handcrafted Cappuccino',
            'Signature Caffe Latte',
            'Spanish Latte',
            'Classic Americano',
            'Caramel Macchiato',
            'Flat White',
            'Hot Mocha',
            'Iced Signature Latte',
            'Cold Brew Reserve',
            'Hot Chocolate',
        );
    }

    public static function normalize_category_slug( $raw_cat ) {
        $raw = strtolower( trim( $raw_cat ) );
        if ( strpos( $raw, 'latte' ) !== false || strpos( $raw, 'signature' ) !== false ) {
            return 'signature-lattes';
        }
        if ( strpos( $raw, 'espresso' ) !== false || strpos( $raw, 'specialty' ) !== false || strpos( $raw, 'pour' ) !== false || strpos( $raw, 'v60' ) !== false ) {
            return 'specialty-espresso';
        }
        if ( strpos( $raw, 'matcha' ) !== false || strpos( $raw, 'tea' ) !== false || strpos( $raw, 'frappe' ) !== false ) {
            return 'matcha-tea';
        }
        if ( strpos( $raw, 'pastry' ) !== false || strpos( $raw, 'bakery' ) !== false || strpos( $raw, 'croissant' ) !== false || strpos( $raw, 'cake' ) !== false || strpos( $raw, 'treat' ) !== false ) {
            return 'pastry-bakery';
        }
        return 'barista-coffee';
    }

    public static function normalize_type( $raw_type ) {
        $raw = strtolower( trim( $raw_type ) );
        if ( in_array( $raw, array( 'hot', 'iced', 'both', 'blended' ), true ) ) {
            return $raw;
        }
        if ( strpos( $raw, 'blend' ) !== false || strpos( $raw, 'frappe' ) !== false ) {
            return 'blended';
        }
        if ( strpos( $raw, 'both' ) !== false ) {
            return 'both';
        }
        if ( strpos( $raw, 'ice' ) !== false || strpos( $raw, 'cold' ) !== false ) {
            return 'iced';
        }
        return 'hot';
    }

    public static function handle_csv_downloads() {
        if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
            return;
        }
        if ( ! isset( $_GET['post_type'] ) || $_GET['post_type'] !== 'santino_item' ) {
            return;
        }

        $action = sanitize_text_field( $_GET['santino_item_action'] ?? '' );
        if ( empty( $action ) ) {
            return;
        }

        if ( 'sample_csv' === $action ) {
            check_admin_referer( 'santino_item_sample_csv' );
            while ( ob_get_level() ) {
                ob_end_clean();
            }
            header( 'Content-Type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename="santino-handcrafted-items-sample.csv"' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
            $out = fopen( 'php://output', 'w' );
            fprintf( $out, chr( 0xEF ) . chr( 0xBB ) . chr( 0xBF ) );
            fputcsv( $out, array( 'item_name', 'category', 'price', 'type', 'portion_sizes', 'tag', 'calories', 'bestseller', 'redeemable', 'plantbased', 'image_url', 'description' ) );
            fputcsv( $out, array( 'Vanilla Bean Spanish Latte', 'signature-lattes', '240', 'both', 'Reg Tk. 240 | Large Tk. 290', 'SIGNATURE', '190 kcal', 'yes', 'yes', 'no', '', 'Double shot espresso layered with sweet condensed milk, Madagascar vanilla, and whole farm milk.' ) );
            fputcsv( $out, array( 'Single-Origin Pour-over (V60)', 'specialty-espresso', '340', 'hot', 'Ethiopia Yirgacheffe / Colombia Geisha', 'ARTISAN', '5 kcal', 'no', 'yes', 'yes', '', 'Precision hand-brewed single origin Arabica with bright floral jasmine notes and silky tea-like finish.' ) );
            fputcsv( $out, array( 'Japanese Ceremonial Matcha Frappe', 'matcha-tea', '280', 'blended', 'Large 16oz • Ice Blended', 'POPULAR', '220 kcal', 'yes', 'yes', 'yes', '', 'Stone-ground Uji matcha blended with fresh farm milk, vanilla bean syrup, and cloud cream.' ) );
            fputcsv( $out, array( 'Artisan Butter Croissant', 'pastry-bakery', '180', 'hot', 'Served Warm with French Butter', 'BAKERY', '260 kcal', 'yes', 'no', 'no', '', 'Authentic French butter croissant baked fresh daily with 48 golden laminated flaky layers.' ) );
            fclose( $out );
            exit;
        }

        if ( 'export_csv' === $action ) {
            check_admin_referer( 'santino_item_export_csv' );
            while ( ob_get_level() ) {
                ob_end_clean();
            }
            header( 'Content-Type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename="santino-items-export-' . date( 'Y-m-d' ) . '.csv"' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
            $out = fopen( 'php://output', 'w' );
            fprintf( $out, chr( 0xEF ) . chr( 0xBB ) . chr( 0xBF ) );
            fputcsv( $out, array( 'item_name', 'category', 'price', 'type', 'portion_sizes', 'tag', 'calories', 'bestseller', 'redeemable', 'plantbased', 'image_url', 'description' ) );

            $posts = get_posts( array(
                'post_type'      => 'santino_item',
                'posts_per_page' => -1,
                'post_status'    => 'any',
                'orderby'        => 'ID',
                'order'          => 'DESC',
            ) );

            foreach ( $posts as $p ) {
                $img = get_the_post_thumbnail_url( $p->ID, 'full' ) ?: get_post_meta( $p->ID, '_santino_item_custom_img', true );
                fputcsv( $out, array(
                    $p->post_title,
                    get_post_meta( $p->ID, '_santino_item_category', true ) ?: 'barista-coffee',
                    get_post_meta( $p->ID, '_santino_item_price', true ) ?: '0',
                    get_post_meta( $p->ID, '_santino_item_type', true ) ?: 'hot',
                    get_post_meta( $p->ID, '_santino_item_roast', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_item_tag', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_item_calories', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_item_bestseller', true ) ?: 'no',
                    get_post_meta( $p->ID, '_santino_item_redeemable', true ) ?: 'yes',
                    get_post_meta( $p->ID, '_santino_item_plantbased', true ) ?: 'no',
                    $img ?: '',
                    $p->post_content,
                ) );
            }

            fclose( $out );
            exit;
        }
    }

    public static function handle_csv_upload() {
        if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
            return;
        }
        if ( ! isset( $_POST['santino_item_csv_action'] ) || $_POST['santino_item_csv_action'] !== 'import' ) {
            return;
        }
        check_admin_referer( 'santino_item_import_nonce' );

        if ( empty( $_FILES['item_csv']['tmp_name'] ) || ! is_uploaded_file( $_FILES['item_csv']['tmp_name'] ) ) {
            wp_safe_redirect( add_query_arg( array( 'post_type' => 'santino_item', 'item_error' => 'no_file' ), admin_url( 'edit.php' ) ) );
            exit;
        }

        $file_path = $_FILES['item_csv']['tmp_name'];
        $handle    = fopen( $file_path, 'r' );
        if ( false === $handle ) {
            wp_safe_redirect( add_query_arg( array( 'post_type' => 'santino_item', 'item_error' => 'read_error' ), admin_url( 'edit.php' ) ) );
            exit;
        }

        $mode   = sanitize_text_field( $_POST['import_mode'] ?? 'append' );
        $header = fgetcsv( $handle );
        if ( ! $header ) {
            fclose( $handle );
            wp_safe_redirect( add_query_arg( array( 'post_type' => 'santino_item', 'item_error' => 'empty_csv' ), admin_url( 'edit.php' ) ) );
            exit;
        }

        if ( isset( $header[0] ) ) {
            $header[0] = preg_replace( '/\x{EF}\x{BB}\x{BF}/', '', $header[0] );
        }

        $h_map = array();
        foreach ( (array) $header as $idx => $col ) {
            $clean_col = strtolower( trim( preg_replace( '/[^a-zA-Z0-9_]/', '', str_replace( ' ', '_', $col ) ) ) );
            $h_map[ $clean_col ] = $idx;
        }

        $imported = 0;
        $updated  = 0;
        $skipped  = 0;

        while ( ( $row = fgetcsv( $handle ) ) !== false ) {
            if ( empty( array_filter( $row ) ) ) {
                continue;
            }

            $name = trim( $row[ $h_map['item_name'] ?? $h_map['name'] ?? $h_map['title'] ?? 0 ] ?? '' );
            if ( empty( $name ) ) {
                $skipped++;
                continue;
            }

            $cat_raw  = trim( $row[ $h_map['category'] ?? $h_map['cat'] ?? 1 ] ?? 'barista-coffee' );
            $cat      = self::normalize_category_slug( $cat_raw );
            $price    = intval( preg_replace( '/[^0-9]/', '', $row[ $h_map['price'] ?? 2 ] ?? '0' ) );
            $type_raw = trim( $row[ $h_map['type'] ?? $h_map['serving_type'] ?? 3 ] ?? 'hot' );
            $type     = self::normalize_type( $type_raw );
            $roast    = trim( $row[ $h_map['portion_sizes'] ?? $h_map['sizes'] ?? $h_map['roast'] ?? 4 ] ?? '' );
            $tag      = trim( $row[ $h_map['tag'] ?? $h_map['badge'] ?? 5 ] ?? '' );
            $calories = trim( $row[ $h_map['calories'] ?? $h_map['calorie'] ?? 6 ] ?? '' );
            $best     = strtolower( trim( $row[ $h_map['bestseller'] ?? $h_map['popular'] ?? 7 ] ?? 'no' ) );
            $redeem   = strtolower( trim( $row[ $h_map['redeemable'] ?? $h_map['free_redeem'] ?? 8 ] ?? 'yes' ) );
            $plant    = strtolower( trim( $row[ $h_map['plantbased'] ?? $h_map['vegan'] ?? 9 ] ?? 'no' ) );
            $img_url  = trim( $row[ $h_map['image_url'] ?? $h_map['image'] ?? $h_map['photo'] ?? 10 ] ?? '' );
            $desc     = trim( $row[ $h_map['description'] ?? $h_map['desc'] ?? $h_map['content'] ?? 11 ] ?? '' );

            $best   = in_array( $best, array( 'yes', '1', 'true' ), true ) ? 'yes' : 'no';
            $redeem = in_array( $redeem, array( 'no', '0', 'false' ), true ) ? 'no' : 'yes';
            $plant  = in_array( $plant, array( 'yes', '1', 'true' ), true ) ? 'yes' : 'no';

            $existing = get_page_by_title( $name, OBJECT, 'santino_item' );
            $post_id  = null;

            if ( $existing ) {
                if ( 'append' === $mode ) {
                    $skipped++;
                    continue;
                }
                $post_id = $existing->ID;
                wp_update_post( array(
                    'ID'           => $post_id,
                    'post_content' => $desc,
                ) );
                $updated++;
            } else {
                $post_id = wp_insert_post( array(
                    'post_title'   => sanitize_text_field( $name ),
                    'post_content' => $desc,
                    'post_type'    => 'santino_item',
                    'post_status'  => 'publish',
                ) );
                if ( is_wp_error( $post_id ) || ! $post_id ) {
                    $skipped++;
                    continue;
                }
                $imported++;
            }

            update_post_meta( $post_id, '_santino_item_category', sanitize_text_field( $cat ) );
            update_post_meta( $post_id, '_santino_item_price', $price );
            update_post_meta( $post_id, '_santino_item_type', sanitize_text_field( $type ) );
            update_post_meta( $post_id, '_santino_item_roast', sanitize_text_field( $roast ?: ( 'Tk. ' . $price ) ) );
            update_post_meta( $post_id, '_santino_item_tag', sanitize_text_field( $tag ) );
            update_post_meta( $post_id, '_santino_item_calories', sanitize_text_field( $calories ) );
            update_post_meta( $post_id, '_santino_item_bestseller', $best );
            update_post_meta( $post_id, '_santino_item_redeemable', $redeem );
            update_post_meta( $post_id, '_santino_item_plantbased', $plant );

            if ( ! empty( $img_url ) ) {
                update_post_meta( $post_id, '_santino_item_custom_img', esc_url_raw( $img_url ) );
            }
        }

        fclose( $handle );

        $redirect = add_query_arg( array(
            'post_type'      => 'santino_item',
            'imported_items' => $imported,
            'updated_items'  => $updated,
            'skipped_items'  => $skipped,
        ), admin_url( 'edit.php' ) );

        wp_safe_redirect( $redirect );
        exit;
    }

    public static function render_admin_csv_ui() {
        $screen = get_current_screen();
        if ( ! $screen || $screen->id !== 'edit-santino_item' || $screen->post_type !== 'santino_item' ) {
            return;
        }

        if ( isset( $_GET['imported_items'] ) ) {
            $imp  = intval( $_GET['imported_items'] );
            $upd  = intval( $_GET['updated_items'] ?? 0 );
            $skip = intval( $_GET['skipped_items'] ?? 0 );
            ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #00625d;">
                <p><strong><?php _e( 'Handcrafted Items CSV Import Completed:', 'santino' ); ?></strong> <?php echo sprintf( __( '%d added, %d updated, %d skipped.', 'santino' ), $imp, $upd, $skip ); ?></p>
            </div>
            <?php
        }

        if ( isset( $_GET['item_error'] ) ) {
            $err = sanitize_text_field( $_GET['item_error'] );
            $msg = __( 'An error occurred during CSV upload.', 'santino' );
            if ( 'no_file' === $err ) $msg = __( 'No CSV file was selected.', 'santino' );
            if ( 'read_error' === $err ) $msg = __( 'Could not open or read the CSV file.', 'santino' );
            if ( 'empty_csv' === $err ) $msg = __( 'The uploaded CSV file is empty.', 'santino' );
            ?>
            <div class="notice notice-error is-dismissible">
                <p><strong><?php _e( 'Error:', 'santino' ); ?></strong> <?php echo esc_html( $msg ); ?></p>
            </div>
            <?php
        }
        ?>
        <div id="santino-item-csv-panel" class="postbox" style="display: none; margin: 15px 0; padding: 15px 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Bulk CSV File Import', 'santino' ); ?></h3>
            <p class="description">
                <?php _e( 'Upload .csv with columns: item_name, category, price, type, portion_sizes, tag, calories, bestseller, redeemable, plantbased, image_url, description', 'santino' ); ?>
            </p>
            <form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'edit.php?post_type=santino_item' ) ); ?>">
                <?php wp_nonce_field( 'santino_item_import_nonce' ); ?>
                <input type="hidden" name="santino_item_csv_action" value="import">
                <p>
                    <input type="file" name="item_csv" accept=".csv" required>
                </p>
                <p>
                    <label><input type="radio" name="import_mode" value="append" checked> <?php _e( 'Append to existing', 'santino' ); ?></label>
                    &nbsp;&nbsp;
                    <label><input type="radio" name="import_mode" value="update"> <?php _e( 'Replace / Update existing', 'santino' ); ?></label>
                </p>
                <p>
                    <input type="submit" class="button button-primary" value="<?php _e( 'Upload & Import CSV', 'santino' ); ?>">
                    <button type="button" class="button button-secondary" onclick="document.getElementById('santino-item-csv-panel').style.display='none';"><?php _e( 'Cancel', 'santino' ); ?></button>
                </p>
            </form>
        </div>

        <style>
        .wrap .page-title-action,
        .wrap .santino-item-csv-btn,
        .wrap a.page-title-action {
            display: inline-block;
            border: 1.5px solid #2271b1 !important;
            background: #f6f7f7 !important;
            color: #2271b1 !important;
            border-radius: 3px !important;
            padding: 4px 10px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            line-height: normal !important;
            text-decoration: none !important;
            margin-left: 6px !important;
            vertical-align: middle !important;
            box-shadow: none !important;
            transition: all 0.15s ease-in-out !important;
            cursor: pointer !important;
        }
        .wrap .page-title-action:hover,
        .wrap .santino-item-csv-btn:hover,
        .wrap a.page-title-action:hover {
            background: #2271b1 !important;
            color: #ffffff !important;
            border-color: #2271b1 !important;
        }
        </style>

        <script>
        jQuery(document).ready(function($) {
            if (!$('.santino-item-csv-btn').length) {
                var $target = $('.wrap .page-title-action').last();
                if (!$target.length) {
                    $target = $('.wrap .wp-heading-inline');
                }
                var sampleUrl = '<?php echo esc_url( wp_nonce_url( admin_url( 'edit.php?post_type=santino_item&santino_item_action=sample_csv' ), 'santino_item_sample_csv' ) ); ?>';
                var exportUrl = '<?php echo esc_url( wp_nonce_url( admin_url( 'edit.php?post_type=santino_item&santino_item_action=export_csv' ), 'santino_item_export_csv' ) ); ?>';
                
                var buttons = '<a href="' + sampleUrl + '" class="page-title-action santino-item-csv-btn"><?php _e( 'Download Sample CSV', 'santino' ); ?></a>' +
                              '<a href="' + exportUrl + '" class="page-title-action santino-item-csv-btn"><?php _e( 'Export CSV', 'santino' ); ?></a>' +
                              '<a href="#import-csv" class="page-title-action santino-item-csv-btn" onclick="var b=document.getElementById(\'santino-item-csv-panel\'); b.style.display=(b.style.display===\'none\'||!b.style.display)?\'block\':\'none\'; return false;"><?php _e( 'Import CSV', 'santino' ); ?></a>';
                
                $target.after(buttons);
            }
        });
        </script>
        <?php
    }

    public static function maybe_seed_items() {
        if ( get_option( 'santino_items_seeded_v1' ) ) {
            return;
        }

        $existing = get_posts( array(
            'post_type'      => 'santino_item',
            'posts_per_page' => 1,
            'post_status'    => 'any',
        ) );

        if ( ! empty( $existing ) ) {
            update_option( 'santino_items_seeded_v1', 1 );
            return;
        }

        $seeds = array(
            array(
                'title'       => 'Hot Cappuccino',
                'category'    => 'barista-coffee',
                'price'       => 170,
                'tag'         => 'HERO ITEM',
                'desc'        => 'Rich Italian espresso topped with a velvety layer of foamed steamed milk and cocoa dusting.',
                'calories'    => '140 kcal',
                'type'        => 'hot',
                'bestseller'  => 'yes',
                'roast'       => 'Reg Tk. 170 | Large Tk. 220',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Iced Latte',
                'category'    => 'barista-coffee',
                'price'       => 200,
                'tag'         => 'HERO ITEM',
                'desc'        => 'Fresh Italian espresso combined with chilled farm milk, served crisp over crystalline ice.',
                'calories'    => '130 kcal',
                'type'        => 'iced',
                'bestseller'  => 'yes',
                'roast'       => 'Large Tk. 200 • Smooth & Refreshing',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Hot Mocha',
                'category'    => 'barista-coffee',
                'price'       => 190,
                'tag'         => 'HERO ITEM',
                'desc'        => 'Espresso combined with rich artisanal chocolate syrup, steamed milk, and whipped chocolate drizzle.',
                'calories'    => '210 kcal',
                'type'        => 'hot',
                'bestseller'  => 'yes',
                'roast'       => 'Reg Tk. 190 | Large Tk. 230',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Iced Mocha',
                'category'    => 'barista-coffee',
                'price'       => 210,
                'tag'         => 'HERO ITEM',
                'desc'        => 'Chilled espresso and Belgian dark cocoa sauce poured over silky cold milk and ice.',
                'calories'    => '220 kcal',
                'type'        => 'iced',
                'bestseller'  => 'yes',
                'roast'       => 'Large Tk. 210 • Rich Belgian Cocoa',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Mocha Frappe',
                'category'    => 'matcha-tea',
                'price'       => 230,
                'tag'         => 'HERO ITEM',
                'desc'        => 'Blended espresso, chocolate ganache, ice crystals, and cloud whipped cream topped with chocolate shavings.',
                'calories'    => '290 kcal',
                'type'        => 'blended',
                'bestseller'  => 'yes',
                'roast'       => 'Large Tk. 230 • Ice Blended',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Hazelnut Frappe',
                'category'    => 'matcha-tea',
                'price'       => 230,
                'tag'         => 'HERO ITEM',
                'desc'        => 'Roasted Italian hazelnut syrup blended with creamy dairy, espresso, and topped with golden praline crunch.',
                'calories'    => '280 kcal',
                'type'        => 'blended',
                'bestseller'  => 'yes',
                'roast'       => 'Large Tk. 230 • Roasted Hazelnut',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Santino Raw Coconut Latte',
                'category'    => 'signature-lattes',
                'price'       => 380,
                'tag'         => 'BESTSELLER',
                'desc'        => 'Our iconic creation. Cold-pressed raw coconut milk infused with a double shot of dark-roasted Italian Arabica espresso.',
                'calories'    => '185 kcal',
                'type'        => 'iced',
                'plantbased'  => 'yes',
                'bestseller'  => 'yes',
                'roast'       => 'Dark Roast • Nutty & Tropical',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Vanilla Caramel Macchiato',
                'category'    => 'signature-lattes',
                'price'       => 390,
                'tag'         => 'SIGNATURE',
                'desc'        => 'Freshly steamed milk with Madagascar vanilla syrup, marked with espresso and drizzled with caramel glaze.',
                'calories'    => '235 kcal',
                'type'        => 'both',
                'bestseller'  => 'yes',
                'roast'       => 'Medium Dark • Vanilla Caramel',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Classic Americano',
                'category'    => 'specialty-espresso',
                'price'       => 160,
                'tag'         => 'CLASSIC',
                'desc'        => 'Double espresso pulled long over hot water, highlighting the pure sweetness and nutty finish.',
                'calories'    => '10 kcal',
                'type'        => 'both',
                'bestseller'  => 'no',
                'roast'       => 'Reg Tk. 160 | Large Tk. 200',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Single-Origin Pour-over (V60)',
                'category'    => 'specialty-espresso',
                'price'       => 340,
                'tag'         => 'ARTISAN',
                'desc'        => 'Precision hand-brewed specialty Arabica with delicate florals, bright acidity, and clean tea-like finish.',
                'calories'    => '5 kcal',
                'type'        => 'hot',
                'bestseller'  => 'no',
                'roast'       => 'Ethiopia Yirgacheffe / Colombia Geisha',
                'redeemable'  => 'yes',
            ),
            array(
                'title'       => 'Artisan Butter Croissant',
                'category'    => 'pastry-bakery',
                'price'       => 180,
                'tag'         => 'BAKERY',
                'desc'        => 'Freshly baked flaky Parisian butter croissant with 48 laminated layers, golden crust, and airy honeycomb crumb.',
                'calories'    => '260 kcal',
                'type'        => 'hot',
                'bestseller'  => 'yes',
                'roast'       => 'Served Warm with French Butter',
                'redeemable'  => 'no',
            ),
        );

        foreach ( $seeds as $seed ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $seed['title'],
                'post_content' => $seed['desc'],
                'post_type'    => 'santino_item',
                'post_status'  => 'publish',
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_santino_item_category', $seed['category'] );
                update_post_meta( $post_id, '_santino_item_price', $seed['price'] );
                update_post_meta( $post_id, '_santino_item_tag', $seed['tag'] );
                update_post_meta( $post_id, '_santino_item_calories', $seed['calories'] );
                update_post_meta( $post_id, '_santino_item_type', $seed['type'] );
                update_post_meta( $post_id, '_santino_item_roast', $seed['roast'] );
                update_post_meta( $post_id, '_santino_item_redeemable', $seed['redeemable'] );
                update_post_meta( $post_id, '_santino_item_bestseller', $seed['bestseller'] );
                if ( ! empty( $seed['plantbased'] ) ) {
                    update_post_meta( $post_id, '_santino_item_plantbased', $seed['plantbased'] );
                }
            }
        }

        update_option( 'santino_items_seeded_v1', 1 );
    }
}

Santino_Handcrafted_Items_System::init();
