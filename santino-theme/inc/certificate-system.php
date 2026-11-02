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
