<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Certificate_System {

    public static function init() {
        add_action( 'init', array( __CLASS__, 'register_post_type' ) );
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
        add_action( 'save_post', array( __CLASS__, 'save_meta_box_data' ) );

        add_filter( 'manage_santino_certificate_posts_columns', array( __CLASS__, 'set_columns' ) );
        add_action( 'manage_santino_certificate_posts_custom_column', array( __CLASS__, 'render_columns' ), 10, 2 );

        add_action( 'wp_ajax_santino_verify_certificate', array( __CLASS__, 'handle_ajax_verify' ) );
        add_action( 'wp_ajax_nopriv_santino_verify_certificate', array( __CLASS__, 'handle_ajax_verify' ) );

        add_action( 'admin_init', array( __CLASS__, 'maybe_seed_certificates' ) );
        add_action( 'admin_init', array( __CLASS__, 'handle_csv_downloads' ) );
        add_action( 'admin_init', array( __CLASS__, 'handle_csv_upload' ) );
        add_action( 'admin_notices', array( __CLASS__, 'render_admin_csv_ui' ) );
    }

    public static function register_post_type() {
        $labels = array(
            'name'               => __( 'Certificates', 'santino' ),
            'singular_name'      => __( 'Certificate', 'santino' ),
            'menu_name'          => __( 'Certificates', 'santino' ),
            'name_admin_bar'     => __( 'Certificate', 'santino' ),
            'add_new'            => __( 'Add New Certificate', 'santino' ),
            'add_new_item'       => __( 'Add New Certificate', 'santino' ),
            'new_item'           => __( 'New Certificate', 'santino' ),
            'edit_item'          => __( 'Edit Certificate', 'santino' ),
            'view_item'          => __( 'View Certificate', 'santino' ),
            'all_items'          => __( 'All Certificates', 'santino' ),
            'search_items'       => __( 'Search Certificates', 'santino' ),
            'not_found'          => __( 'No certificates found.', 'santino' ),
            'not_found_in_trash' => __( 'No certificates in trash.', 'santino' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 29,
            'menu_icon'          => 'dashicons-awards',
            'query_var'          => false,
            'rewrite'            => false,
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'supports'           => array( 'title' ),
        );

        register_post_type( 'santino_certificate', $args );
    }

    public static function add_meta_boxes() {
        add_meta_box(
            'santino_cert_details',
            __( 'Official Certificate Credentials & Information', 'santino' ),
            array( __CLASS__, 'render_meta_box' ),
            'santino_certificate',
            'normal',
            'high'
        );
    }

    public static function render_meta_box( $post ) {
        wp_nonce_field( 'santino_cert_meta_box_nonce', 'santino_cert_nonce' );

        $cert_id   = get_post_meta( $post->ID, '_santino_cert_id', true ) ?: $post->post_title;
        $name      = get_post_meta( $post->ID, '_santino_candidate_name', true );
        $course    = get_post_meta( $post->ID, '_santino_course_name', true );
        $duration  = get_post_meta( $post->ID, '_santino_duration', true );
        $issue_dt  = get_post_meta( $post->ID, '_santino_issue_date', true );
        $standard  = get_post_meta( $post->ID, '_santino_standard', true ) ?: 'WBC & SCA Protocols / ISO 9001:2015';
        $grade     = get_post_meta( $post->ID, '_santino_grade', true ) ?: 'Distinction (Grade A+)';
        $institute = get_post_meta( $post->ID, '_santino_institute', true ) ?: 'Santino Barista Academy • ISO 9001:2015';
        $trainer   = get_post_meta( $post->ID, '_santino_trainer', true ) ?: 'Master Barista Trainer, Santino Academy';
        $hash      = get_post_meta( $post->ID, '_santino_cert_hash', true );
        $status    = get_post_meta( $post->ID, '_santino_cert_status', true ) ?: 'verified';
        $contact   = get_post_meta( $post->ID, '_santino_candidate_contact', true );
        $notes     = get_post_meta( $post->ID, '_santino_cert_notes', true );

        if ( empty( $hash ) ) {
            $hash = strtoupper( substr( md5( ( $cert_id ?: uniqid() ) . 'SANTINO' ), 0, 4 ) . '-' . substr( md5( ( $cert_id ?: uniqid() ) . 'REG' ), 4, 4 ) . '-' . substr( md5( ( $cert_id ?: uniqid() ) . 'CERT' ), 8, 4 ) );
        }
        ?>
        <style>
            .santino-cert-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
                margin-top: 10px;
            }
            .santino-cert-field {
                display: flex;
                flex-direction: column;
            }
            .santino-cert-field label {
                font-weight: 600;
                margin-bottom: 6px;
                color: #1e293b;
            }
            .santino-cert-field input, .santino-cert-field select, .santino-cert-field textarea {
                padding: 8px 12px;
                border: 1px solid #cbd5e1;
                border-radius: 6px;
                font-size: 14px;
            }
            .santino-cert-field input:focus, .santino-cert-field select:focus, .santino-cert-field textarea:focus {
                border-color: #00625d;
                box-shadow: 0 0 0 1px #00625d;
                outline: none;
            }
            .santino-cert-full {
                grid-column: span 2;
            }
            .santino-verify-preview {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                padding: 14px;
                margin-top: 15px;
            }
        </style>

        <div class="santino-cert-grid">
            <div class="santino-cert-field">
                <label for="santino_cert_id"><?php _e( 'Certificate ID / Serial Number (Required)', 'santino' ); ?></label>
                <input type="text" id="santino_cert_id" name="santino_cert_id" value="<?php echo esc_attr( $cert_id ); ?>" placeholder="e.g. SNT-2025-001 or BBTA-2025-042" required style="font-family: monospace; font-weight: bold; text-transform: uppercase;">
                <span class="description" style="font-size: 11px; color: #64748b; margin-top: 4px;"><?php _e( 'This ID is entered by students/recruiters on frontend verification form.', 'santino' ); ?></span>
            </div>

            <div class="santino-cert-field">
                <label for="santino_cert_status"><?php _e( 'Verification Status', 'santino' ); ?></label>
                <select id="santino_cert_status" name="santino_cert_status">
                    <option value="verified" <?php selected( $status, 'verified' ); ?>>✓ Verified &amp; Authentic</option>
                    <option value="pending" <?php selected( $status, 'pending' ); ?>>⏳ Under Review / Pending</option>
                    <option value="revoked" <?php selected( $status, 'revoked' ); ?>>✕ Revoked / Cancelled</option>
                </select>
            </div>

            <div class="santino-cert-field">
                <label for="santino_candidate_name"><?php _e( 'Candidate Full Name (Required)', 'santino' ); ?></label>
                <input type="text" id="santino_candidate_name" name="santino_candidate_name" value="<?php echo esc_attr( $name ); ?>" placeholder="e.g. Mohammed Tanvir Hossain" required>
            </div>

            <div class="santino-cert-field">
                <label for="santino_candidate_contact"><?php _e( 'Candidate Phone / Email (Internal Record)', 'santino' ); ?></label>
                <input type="text" id="santino_candidate_contact" name="santino_candidate_contact" value="<?php echo esc_attr( $contact ); ?>" placeholder="e.g. 017XXXXXXXX / student@gmail.com">
            </div>

            <div class="santino-cert-field">
                <label for="santino_course_name"><?php _e( 'Course / Program Name', 'santino' ); ?></label>
                <input type="text" id="santino_course_name" name="santino_course_name" value="<?php echo esc_attr( $course ); ?>" placeholder="e.g. Barista Advance Professional & Sensory Lab">
            </div>

            <div class="santino-cert-field">
                <label for="santino_duration"><?php _e( 'Duration & Hours', 'santino' ); ?></label>
                <input type="text" id="santino_duration" name="santino_duration" value="<?php echo esc_attr( $duration ); ?>" placeholder="e.g. 18 Days (54 Contact Hours)">
            </div>

            <div class="santino-cert-field">
                <label for="santino_issue_date"><?php _e( 'Issue Date', 'santino' ); ?></label>
                <input type="text" id="santino_issue_date" name="santino_issue_date" value="<?php echo esc_attr( $issue_dt ); ?>" placeholder="e.g. 12 October 2025">
            </div>

            <div class="santino-cert-field">
                <label for="santino_grade"><?php _e( 'Assessment Result / Grade', 'santino' ); ?></label>
                <input type="text" id="santino_grade" name="santino_grade" value="<?php echo esc_attr( $grade ); ?>" placeholder="e.g. Distinction (Grade A+) or Passed with Honors">
            </div>

            <div class="santino-cert-field">
                <label for="santino_institute"><?php _e( 'Issuing Institute / Academy', 'santino' ); ?></label>
                <input type="text" id="santino_institute" name="santino_institute" value="<?php echo esc_attr( $institute ); ?>" placeholder="e.g. Santino Barista Academy • ISO 9001:2015">
            </div>

            <div class="santino-cert-field">
                <label for="santino_trainer"><?php _e( 'Lead Master Trainer / Instructor', 'santino' ); ?></label>
                <input type="text" id="santino_trainer" name="santino_trainer" value="<?php echo esc_attr( $trainer ); ?>" placeholder="e.g. Master Barista Trainer, Santino Academy">
            </div>

            <div class="santino-cert-field">
                <label for="santino_standard"><?php _e( 'Accreditation Standard', 'santino' ); ?></label>
                <input type="text" id="santino_standard" name="santino_standard" value="<?php echo esc_attr( $standard ); ?>" placeholder="e.g. WBC & SCA Protocols / ISO 9001:2015">
            </div>

            <div class="santino-cert-field">
                <label for="santino_cert_hash"><?php _e( 'Verification Hash / Tamper-proof Code', 'santino' ); ?></label>
                <input type="text" id="santino_cert_hash" name="santino_cert_hash" value="<?php echo esc_attr( $hash ); ?>" style="font-family: monospace;">
            </div>

            <div class="santino-cert-field santino-cert-full">
                <label for="santino_cert_notes"><?php _e( 'Internal Registrar Notes / Remarks', 'santino' ); ?></label>
                <textarea id="santino_cert_notes" name="santino_cert_notes" rows="2" placeholder="Optional notes for administration..."><?php echo esc_textarea( $notes ); ?></textarea>
            </div>
        </div>

        <?php if ( ! empty( $cert_id ) ) : ?>
            <div class="santino-verify-preview">
                <strong><?php _e( 'Direct Verification Link:', 'santino' ); ?></strong>
                <a href="<?php echo esc_url( home_url( '/certificate-verification/?id=' . urlencode( $cert_id ) ) ); ?>" target="_blank" style="margin-left: 8px; font-weight: 600; color: #00625d;">
                    <?php echo esc_url( home_url( '/certificate-verification/?id=' . urlencode( $cert_id ) ) ); ?> &rarr;
                </a>
            </div>
        <?php endif; ?>
        <?php
    }

    public static function save_meta_box_data( $post_id ) {
        if ( ! isset( $_POST['santino_cert_nonce'] ) || ! wp_verify_nonce( $_POST['santino_cert_nonce'], 'santino_cert_meta_box_nonce' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( 'santino_certificate' !== get_post_type( $post_id ) ) {
            return;
        }

        $fields = array(
            'santino_candidate_name'    => '_santino_candidate_name',
            'santino_candidate_contact' => '_santino_candidate_contact',
            'santino_course_name'       => '_santino_course_name',
            'santino_duration'          => '_santino_duration',
            'santino_issue_date'        => '_santino_issue_date',
            'santino_standard'          => '_santino_standard',
            'santino_grade'             => '_santino_grade',
            'santino_institute'         => '_santino_institute',
            'santino_trainer'           => '_santino_trainer',
            'santino_cert_status'       => '_santino_cert_status',
            'santino_cert_notes'        => '_santino_cert_notes',
        );

        foreach ( $fields as $input_key => $meta_key ) {
            if ( isset( $_POST[ $input_key ] ) ) {
                update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $input_key ] ) ) );
            }
        }

        $cert_id = isset( $_POST['santino_cert_id'] ) ? strtoupper( trim( sanitize_text_field( wp_unslash( $_POST['santino_cert_id'] ) ) ) ) : '';
        if ( empty( $cert_id ) ) {
            $cert_id = 'SNT-' . date( 'Y' ) . '-' . sprintf( '%03d', $post_id );
        }
        update_post_meta( $post_id, '_santino_cert_id', $cert_id );

        $hash = isset( $_POST['santino_cert_hash'] ) ? strtoupper( trim( sanitize_text_field( wp_unslash( $_POST['santino_cert_hash'] ) ) ) ) : '';
        if ( empty( $hash ) ) {
            $hash = strtoupper( substr( md5( $cert_id . 'SANTINO' ), 0, 4 ) . '-' . substr( md5( $cert_id . 'REG' ), 4, 4 ) . '-' . substr( md5( $cert_id . 'CERT' ), 8, 4 ) );
        }
        update_post_meta( $post_id, '_santino_cert_hash', $hash );

        // Ensure post title matches Certificate ID
        remove_action( 'save_post', array( __CLASS__, 'save_meta_box_data' ) );
        wp_update_post( array(
            'ID'         => $post_id,
            'post_title' => $cert_id,
        ) );
        add_action( 'save_post', array( __CLASS__, 'save_meta_box_data' ) );
    }

    public static function set_columns( $columns ) {
        $new_columns = array(
            'cb'          => $columns['cb'],
            'title'       => __( 'Certificate ID', 'santino' ),
            'candidate'   => __( 'Candidate Name', 'santino' ),
            'course'      => __( 'Course / Program', 'santino' ),
            'issue_date'  => __( 'Issue Date', 'santino' ),
            'grade'       => __( 'Result / Grade', 'santino' ),
            'status'      => __( 'Status', 'santino' ),
            'verify_link' => __( 'Verify', 'santino' ),
        );
        return $new_columns;
    }

    public static function render_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'candidate':
                $name = get_post_meta( $post_id, '_santino_candidate_name', true );
                echo '<strong>' . esc_html( $name ?: '—' ) . '</strong>';
                break;

            case 'course':
                echo esc_html( get_post_meta( $post_id, '_santino_course_name', true ) ?: '—' );
                break;

            case 'issue_date':
                echo esc_html( get_post_meta( $post_id, '_santino_issue_date', true ) ?: '—' );
                break;

            case 'grade':
                $grade = get_post_meta( $post_id, '_santino_grade', true );
                echo '<span class="badge" style="background:#e6f4ea; color:#137333; font-weight:600; padding:3px 8px; border-radius:4px;">' . esc_html( $grade ?: 'Pass' ) . '</span>';
                break;

            case 'status':
                $status = get_post_meta( $post_id, '_santino_cert_status', true ) ?: 'verified';
                if ( 'verified' === $status ) {
                    echo '<span style="color:#059669; font-weight:700;">✓ Verified</span>';
                } elseif ( 'revoked' === $status ) {
                    echo '<span style="color:#dc2626; font-weight:700;">✕ Revoked</span>';
                } else {
                    echo '<span style="color:#d97706; font-weight:700;">⏳ Pending</span>';
                }
                break;

            case 'verify_link':
                $cert_id = get_post_meta( $post_id, '_santino_cert_id', true ) ?: get_the_title( $post_id );
                $url = home_url( '/certificate-verification/?id=' . urlencode( $cert_id ) );
                echo '<a href="' . esc_url( $url ) . '" target="_blank" class="button button-small" style="background:#00625d; color:#fff; border-color:#004d49;">' . __( 'Verify', 'santino' ) . ' &nearr;</a>';
                break;
        }
    }

    public static function handle_ajax_verify() {
        $cert_id = isset( $_POST['cert_id'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_POST['cert_id'] ) ) ) : '';
        if ( empty( $cert_id ) && isset( $_GET['cert_id'] ) ) {
            $cert_id = strtoupper( sanitize_text_field( wp_unslash( $_GET['cert_id'] ) ) );
        }

        if ( empty( $cert_id ) ) {
            wp_send_json_error( array( 'message' => __( 'Please enter a valid Certificate ID.', 'santino' ) ) );
        }

        $args = array(
            'post_type'      => 'santino_certificate',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'meta_query'     => array(
                'relation' => 'OR',
                array(
                    'key'     => '_santino_cert_id',
                    'value'   => $cert_id,
                    'compare' => '=',
                ),
                array(
                    'key'     => '_santino_cert_id',
                    'value'   => $cert_id,
                    'compare' => 'LIKE',
                ),
            ),
        );

        $query = new WP_Query( $args );

        // Fallback search by title
        if ( ! $query->have_posts() ) {
            $args_title = array(
                'post_type'      => 'santino_certificate',
                'posts_per_page' => 1,
                'post_status'    => 'publish',
                'title'          => $cert_id,
            );
            $query = new WP_Query( $args_title );
        }

        if ( ! $query->have_posts() ) {
            wp_send_json_error( array(
                'message' => sprintf( __( 'No record found for ID "%s". Please verify the certificate serial code and try again.', 'santino' ), esc_html( $cert_id ) ),
            ) );
        }

        $post = $query->posts[0];
        $status = get_post_meta( $post->ID, '_santino_cert_status', true ) ?: 'verified';

        if ( 'revoked' === $status ) {
            wp_send_json_error( array(
                'message' => sprintf( __( 'Certificate ID "%s" is recorded as REVOKED or CANCELLED by the Registrar. Please contact Santino Academy.', 'santino' ), esc_html( $cert_id ) ),
                'status'  => 'revoked',
            ) );
        }

        $data = array(
            'id'        => get_post_meta( $post->ID, '_santino_cert_id', true ) ?: $post->post_title,
            'name'      => get_post_meta( $post->ID, '_santino_candidate_name', true ) ?: 'Registered Student',
            'course'    => get_post_meta( $post->ID, '_santino_course_name', true ) ?: 'Barista Professional Training',
            'duration'  => get_post_meta( $post->ID, '_santino_duration', true ) ?: 'Comprehensive Program',
            'issueDate' => get_post_meta( $post->ID, '_santino_issue_date', true ) ?: date( 'd F Y' ),
            'standard'  => get_post_meta( $post->ID, '_santino_standard', true ) ?: 'WBC & SCA Protocols / ISO 9001:2015',
            'grade'     => get_post_meta( $post->ID, '_santino_grade', true ) ?: 'Passed',
            'institute' => get_post_meta( $post->ID, '_santino_institute', true ) ?: 'Santino Barista Academy',
            'trainer'   => get_post_meta( $post->ID, '_santino_trainer', true ) ?: 'Lead Master Trainer',
            'hash'      => get_post_meta( $post->ID, '_santino_cert_hash', true ) ?: 'VALID-AUTH-REG',
            'status'    => $status,
        );

        wp_send_json_success( $data );
    }

    public static function handle_csv_downloads() {
        if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
            return;
        }
        if ( ! isset( $_GET['post_type'] ) || $_GET['post_type'] !== 'santino_certificate' ) {
            return;
        }

        $action = sanitize_text_field( $_GET['santino_cert_action'] ?? '' );
        if ( empty( $action ) ) {
            return;
        }

        if ( 'sample_csv' === $action ) {
            check_admin_referer( 'santino_cert_sample_csv' );
            while ( ob_get_level() ) {
                ob_end_clean();
            }
            header( 'Content-Type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename="santino-certificates-sample.csv"' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
            $out = fopen( 'php://output', 'w' );
            fprintf( $out, chr( 0xEF ) . chr( 0xBB ) . chr( 0xBF ) );
            fputcsv( $out, array( 'certificate_id', 'candidate_name', 'course_name', 'duration', 'issue_date', 'grade', 'institute', 'trainer', 'standard', 'status', 'candidate_contact', 'notes' ) );
            fputcsv( $out, array( 'SNT-2025-001', 'Mohammed Tanvir Hossain', 'Barista Advance Professional & Sensory Lab', '18 Days (54 Contact Hours)', '12 October 2025', 'Distinction (Grade A+)', 'Santino Barista Academy • ISO 9001:2015', 'Master Barista Trainer, Santino Academy', 'WBC & SCA Protocols / ISO 9001:2015', 'verified', '01711223344', 'Official Gold Seal Graduate' ) );
            fputcsv( $out, array( 'BBTA-2025-042', 'Sadia Afrin Chowdhury', 'Professional Barista Intermediate & Latte Art', '7 Days (21 Contact Hours)', '24 September 2025', 'Passed with Honors (94%)', 'Bangladesh Barista Training Academy (BBTA)', 'Senior Barista Specialist, BBTA', 'BBTA Standard Calibration / ISO 9001:2015', 'verified', '01811334455', 'Latte Art Pattern Champion' ) );
            fputcsv( $out, array( 'SNT-ADV-108', 'Kamrul Islam', 'Espresso Science, Grinder Dial-In & Roastery Management', '12 Days (36 Contact Hours)', '05 August 2025', 'Distinction (Grade A)', 'Santino Barista Academy & Technical Lab', 'Authorized VA Technical Instructor', 'Victoria Arduino Commercial Standards', 'verified', '01911445566', 'Commercial Roastery Calibration' ) );
            fclose( $out );
            exit;
        }

        if ( 'export_csv' === $action ) {
            check_admin_referer( 'santino_cert_export_csv' );
            while ( ob_get_level() ) {
                ob_end_clean();
            }
            header( 'Content-Type: text/csv; charset=utf-8' );
            header( 'Content-Disposition: attachment; filename="santino-certificates-export-' . date( 'Y-m-d' ) . '.csv"' );
            header( 'Pragma: no-cache' );
            header( 'Expires: 0' );
            $out = fopen( 'php://output', 'w' );
            fprintf( $out, chr( 0xEF ) . chr( 0xBB ) . chr( 0xBF ) );
            fputcsv( $out, array( 'certificate_id', 'candidate_name', 'course_name', 'duration', 'issue_date', 'grade', 'institute', 'trainer', 'standard', 'status', 'candidate_contact', 'notes' ) );

            $posts = get_posts( array(
                'post_type'      => 'santino_certificate',
                'posts_per_page' => -1,
                'post_status'    => 'any',
                'orderby'        => 'ID',
                'order'          => 'DESC',
            ) );

            foreach ( $posts as $p ) {
                $c_id = get_post_meta( $p->ID, '_santino_cert_id', true ) ?: $p->post_title;
                fputcsv( $out, array(
                    $c_id,
                    get_post_meta( $p->ID, '_santino_candidate_name', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_course_name', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_duration', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_issue_date', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_grade', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_institute', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_trainer', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_standard', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_cert_status', true ) ?: 'verified',
                    get_post_meta( $p->ID, '_santino_candidate_contact', true ) ?: '',
                    get_post_meta( $p->ID, '_santino_cert_notes', true ) ?: '',
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
        if ( ! isset( $_POST['santino_cert_csv_action'] ) || $_POST['santino_cert_csv_action'] !== 'import' ) {
            return;
        }
        check_admin_referer( 'santino_cert_import_nonce' );

        if ( empty( $_FILES['cert_csv']['tmp_name'] ) || ! is_uploaded_file( $_FILES['cert_csv']['tmp_name'] ) ) {
            wp_safe_redirect( add_query_arg( array( 'post_type' => 'santino_certificate', 'cert_error' => 'no_file' ), admin_url( 'edit.php' ) ) );
            exit;
        }

        $file_path = $_FILES['cert_csv']['tmp_name'];
        $handle    = fopen( $file_path, 'r' );
        if ( false === $handle ) {
            wp_safe_redirect( add_query_arg( array( 'post_type' => 'santino_certificate', 'cert_error' => 'read_error' ), admin_url( 'edit.php' ) ) );
            exit;
        }

        $mode   = sanitize_text_field( $_POST['import_mode'] ?? 'append' );
        $header = fgetcsv( $handle );
        if ( ! $header ) {
            fclose( $handle );
            wp_safe_redirect( add_query_arg( array( 'post_type' => 'santino_certificate', 'cert_error' => 'empty_csv' ), admin_url( 'edit.php' ) ) );
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

            $c_id_raw = trim( $row[ $h_map['certificate_id'] ?? $h_map['cert_id'] ?? $h_map['id'] ?? 0 ] ?? '' );
            $name     = trim( $row[ $h_map['candidate_name'] ?? $h_map['name'] ?? $h_map['candidate'] ?? 1 ] ?? '' );

            if ( empty( $c_id_raw ) && empty( $name ) ) {
                $skipped++;
                continue;
            }

            $c_id = strtoupper( $c_id_raw );
            if ( empty( $c_id ) ) {
                $c_id = 'SNT-' . date( 'Y' ) . '-' . sprintf( '%04d', wp_rand( 100, 9999 ) );
            }

            $course    = trim( $row[ $h_map['course_name'] ?? $h_map['course'] ?? 2 ] ?? '' );
            $duration  = trim( $row[ $h_map['duration'] ?? 3 ] ?? '' );
            $issue_dt  = trim( $row[ $h_map['issue_date'] ?? $h_map['date'] ?? 4 ] ?? '' );
            $grade     = trim( $row[ $h_map['grade'] ?? $h_map['result'] ?? 5 ] ?? 'Distinction (Grade A+)' );
            $institute = trim( $row[ $h_map['institute'] ?? $h_map['academy'] ?? 6 ] ?? 'Santino Barista Academy • ISO 9001:2015' );
            $trainer   = trim( $row[ $h_map['trainer'] ?? $h_map['instructor'] ?? 7 ] ?? 'Master Barista Trainer, Santino Academy' );
            $standard  = trim( $row[ $h_map['standard'] ?? 8 ] ?? 'WBC & SCA Protocols / ISO 9001:2015' );
            $status    = strtolower( trim( $row[ $h_map['status'] ?? 9 ] ?? 'verified' ) );
            if ( ! in_array( $status, array( 'verified', 'pending', 'revoked' ), true ) ) {
                $status = 'verified';
            }
            $contact   = trim( $row[ $h_map['candidate_contact'] ?? $h_map['contact'] ?? $h_map['phone'] ?? 10 ] ?? '' );
            $notes     = trim( $row[ $h_map['notes'] ?? $h_map['remarks'] ?? 11 ] ?? '' );

            $existing = get_posts( array(
                'post_type'      => 'santino_certificate',
                'posts_per_page' => 1,
                'post_status'    => 'any',
                'meta_query'     => array(
                    array(
                        'key'     => '_santino_cert_id',
                        'value'   => $c_id,
                        'compare' => '=',
                    ),
                ),
            ) );

            $post_id = null;
            if ( ! empty( $existing ) ) {
                if ( 'append' === $mode ) {
                    $skipped++;
                    continue;
                }
                $post_id = $existing[0]->ID;
                $updated++;
            } else {
                $by_title = get_page_by_title( $c_id, OBJECT, 'santino_certificate' );
                if ( $by_title ) {
                    if ( 'append' === $mode ) {
                        $skipped++;
                        continue;
                    }
                    $post_id = $by_title->ID;
                    $updated++;
                } else {
                    $post_id = wp_insert_post( array(
                        'post_title'  => $c_id,
                        'post_type'   => 'santino_certificate',
                        'post_status' => 'publish',
                    ) );
                    if ( is_wp_error( $post_id ) || ! $post_id ) {
                        $skipped++;
                        continue;
                    }
                    $imported++;
                }
            }

            $hash = strtoupper( substr( md5( $c_id . 'SANTINO' ), 0, 4 ) . '-' . substr( md5( $c_id . 'REG' ), 4, 4 ) . '-' . substr( md5( $c_id . 'CERT' ), 8, 4 ) );

            update_post_meta( $post_id, '_santino_cert_id', $c_id );
            update_post_meta( $post_id, '_santino_candidate_name', sanitize_text_field( $name ) );
            update_post_meta( $post_id, '_santino_course_name', sanitize_text_field( $course ) );
            update_post_meta( $post_id, '_santino_duration', sanitize_text_field( $duration ) );
            update_post_meta( $post_id, '_santino_issue_date', sanitize_text_field( $issue_dt ) );
            update_post_meta( $post_id, '_santino_grade', sanitize_text_field( $grade ) );
            update_post_meta( $post_id, '_santino_institute', sanitize_text_field( $institute ) );
            update_post_meta( $post_id, '_santino_trainer', sanitize_text_field( $trainer ) );
            update_post_meta( $post_id, '_santino_standard', sanitize_text_field( $standard ) );
            update_post_meta( $post_id, '_santino_cert_status', sanitize_text_field( $status ) );
            update_post_meta( $post_id, '_santino_candidate_contact', sanitize_text_field( $contact ) );
            update_post_meta( $post_id, '_santino_cert_notes', sanitize_textarea_field( $notes ) );
            update_post_meta( $post_id, '_santino_cert_hash', $hash );
        }

        fclose( $handle );

        $redirect = add_query_arg( array(
            'post_type'      => 'santino_certificate',
            'imported_certs' => $imported,
            'updated_certs'  => $updated,
            'skipped_certs'  => $skipped,
        ), admin_url( 'edit.php' ) );

        wp_safe_redirect( $redirect );
        exit;
    }

    public static function render_admin_csv_ui() {
        $screen = get_current_screen();
        if ( ! $screen || $screen->id !== 'edit-santino_certificate' || $screen->post_type !== 'santino_certificate' ) {
            return;
        }

        if ( isset( $_GET['imported_certs'] ) ) {
            $imp  = intval( $_GET['imported_certs'] );
            $upd  = intval( $_GET['updated_certs'] ?? 0 );
            $skip = intval( $_GET['skipped_certs'] ?? 0 );
            ?>
            <div class="notice notice-success is-dismissible" style="border-left-color: #00625d;">
                <p><strong><?php _e( 'Certificates CSV Import Completed:', 'santino' ); ?></strong> <?php echo sprintf( __( '%d added, %d updated, %d skipped.', 'santino' ), $imp, $upd, $skip ); ?></p>
            </div>
            <?php
        }

        if ( isset( $_GET['cert_error'] ) ) {
            $err = sanitize_text_field( $_GET['cert_error'] );
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
        <div id="santino-cert-csv-panel" class="postbox" style="display: none; margin: 15px 0; padding: 15px 20px;">
            <h3 style="margin-top: 0;"><?php _e( 'Bulk CSV File Import', 'santino' ); ?></h3>
            <p class="description">
                <?php _e( 'Upload .csv with columns: certificate_id, candidate_name, course_name, duration, issue_date, grade, institute, trainer, standard, status, candidate_contact, notes', 'santino' ); ?>
            </p>
            <form method="post" enctype="multipart/form-data" action="<?php echo esc_url( admin_url( 'edit.php?post_type=santino_certificate' ) ); ?>">
                <?php wp_nonce_field( 'santino_cert_import_nonce' ); ?>
                <input type="hidden" name="santino_cert_csv_action" value="import">
                <p>
                    <input type="file" name="cert_csv" accept=".csv" required>
                </p>
                <p>
                    <label><input type="radio" name="import_mode" value="append" checked> <?php _e( 'Append to existing', 'santino' ); ?></label>
                    &nbsp;&nbsp;
                    <label><input type="radio" name="import_mode" value="update"> <?php _e( 'Replace / Update existing', 'santino' ); ?></label>
                </p>
                <p>
                    <input type="submit" class="button button-primary" value="<?php _e( 'Upload & Import CSV', 'santino' ); ?>">
                    <button type="button" class="button button-secondary" onclick="document.getElementById('santino-cert-csv-panel').style.display='none';"><?php _e( 'Cancel', 'santino' ); ?></button>
                </p>
            </form>
        </div>

        <script>
        jQuery(document).ready(function($) {
            if (!$('.santino-cert-csv-btn').length) {
                var $target = $('.wrap .page-title-action').last();
                if (!$target.length) {
                    $target = $('.wrap .wp-heading-inline');
                }
                var sampleUrl = '<?php echo esc_url( wp_nonce_url( admin_url( 'edit.php?post_type=santino_certificate&santino_cert_action=sample_csv' ), 'santino_cert_sample_csv' ) ); ?>';
                var exportUrl = '<?php echo esc_url( wp_nonce_url( admin_url( 'edit.php?post_type=santino_certificate&santino_cert_action=export_csv' ), 'santino_cert_export_csv' ) ); ?>';
                
                var buttons = '<a href="' + sampleUrl + '" class="page-title-action santino-cert-csv-btn"><?php _e( 'Download Sample CSV', 'santino' ); ?></a>' +
                              '<a href="' + exportUrl + '" class="page-title-action santino-cert-csv-btn"><?php _e( 'Export CSV', 'santino' ); ?></a>' +
                              '<a href="#import-csv" class="page-title-action santino-cert-csv-btn" onclick="var b=document.getElementById(\'santino-cert-csv-panel\'); b.style.display=(b.style.display===\'none\'||!b.style.display)?\'block\':\'none\'; return false;"><?php _e( 'Import CSV', 'santino' ); ?></a>';
                
                $target.after(buttons);
            }
        });
        </script>
        <?php
    }

    public static function maybe_seed_certificates() {
        if ( get_option( 'santino_certs_seeded_v1' ) ) {
            return;
        }

        $existing = get_posts( array(
            'post_type'      => 'santino_certificate',
            'posts_per_page' => 1,
            'post_status'    => 'any',
        ) );

        if ( ! empty( $existing ) ) {
            update_option( 'santino_certs_seeded_v1', 1 );
            return;
        }

        $seeds = array(
            array(
                'id'        => 'SNT-2025-001',
                'name'      => 'Mohammed Tanvir Hossain',
                'course'    => 'Barista Advance Professional & Sensory Lab',
                'duration'  => '18 Days (54 Contact Hours)',
                'issueDate' => '12 October 2025',
                'standard'  => 'WBC & SCA Protocols / ISO 9001:2015',
                'grade'     => 'Distinction (Grade A+)',
                'institute' => 'Santino Barista Academy • ISO 9001:2015',
                'trainer'   => 'Master Barista Trainer, Santino Academy',
                'hash'      => '9A8F-42CD-81E0',
            ),
            array(
                'id'        => 'BBTA-2025-042',
                'name'      => 'Sadia Afrin Chowdhury',
                'course'    => 'Professional Barista Intermediate & Latte Art',
                'duration'  => '7 Days (21 Contact Hours)',
                'issueDate' => '24 September 2025',
                'standard'  => 'BBTA Standard Calibration / ISO 9001:2015',
                'grade'     => 'Passed with Honors (94%)',
                'institute' => 'Bangladesh Barista Training Academy (BBTA)',
                'trainer'   => 'Senior Barista Specialist, BBTA',
                'hash'      => '3F18-BC90-117A',
            ),
            array(
                'id'        => 'SNT-ADV-108',
                'name'      => 'Kamrul Islam',
                'course'    => 'Espresso Science, Grinder Dial-In & Roastery Management',
                'duration'  => '12 Days (36 Contact Hours)',
                'issueDate' => '05 August 2025',
                'standard'  => 'Victoria Arduino Commercial Standards',
                'grade'     => 'Distinction (Grade A)',
                'institute' => 'Santino Barista Academy & Technical Lab',
                'trainer'   => 'Authorized VA Technical Instructor',
                'hash'      => '77BC-0044-8F21',
            ),
            array(
                'id'        => 'BBTA-PIZ-204',
                'name'      => 'Farhan Rahman',
                'course'    => 'Artisan Pizza & Bakery Masterclass',
                'duration'  => '1 Day Intensive (4 Hours)',
                'issueDate' => '18 January 2025',
                'standard'  => 'Professional Culinary Craft / BBTA Certified',
                'grade'     => 'Certified Participant',
                'institute' => 'BBTA Culinary Division',
                'trainer'   => 'Executive Pastry & Pizza Chef',
                'hash'      => '55C1-90E2-AA43',
            ),
        );

        foreach ( $seeds as $seed ) {
            $post_id = wp_insert_post( array(
                'post_title'  => $seed['id'],
                'post_type'   => 'santino_certificate',
                'post_status' => 'publish',
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_santino_cert_id', $seed['id'] );
                update_post_meta( $post_id, '_santino_candidate_name', $seed['name'] );
                update_post_meta( $post_id, '_santino_course_name', $seed['course'] );
                update_post_meta( $post_id, '_santino_duration', $seed['duration'] );
                update_post_meta( $post_id, '_santino_issue_date', $seed['issueDate'] );
                update_post_meta( $post_id, '_santino_standard', $seed['standard'] );
                update_post_meta( $post_id, '_santino_grade', $seed['grade'] );
                update_post_meta( $post_id, '_santino_institute', $seed['institute'] );
                update_post_meta( $post_id, '_santino_trainer', $seed['trainer'] );
                update_post_meta( $post_id, '_santino_cert_hash', $seed['hash'] );
                update_post_meta( $post_id, '_santino_cert_status', 'verified' );
            }
        }

        update_option( 'santino_certs_seeded_v1', 1 );
    }
}

Santino_Certificate_System::init();
