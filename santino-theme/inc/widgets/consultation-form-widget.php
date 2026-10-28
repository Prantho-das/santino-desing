<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Consultation_Form_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_consultation_form';
    }

    public function get_title() {
        return esc_html__( 'Santino Speak to Coffee Specialist Form', 'santino' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_left_pane',
            array(
                'label' => esc_html__( 'Destination Pane (Left)', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'VIP CONSULTATION',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Let\'s Build Your',
            )
        );

        $this->add_control(
            'title_italic',
            array(
                'label'   => esc_html__( 'Italic Accent Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Coffee Destination',
            )
        );

        $this->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Whether setting up a luxury café, upgrading hotel espresso stations, or ordering custom roasted bean blends — our master roasters and technical engineers are here to support your success.',
            )
        );

        $this->add_control(
            'cup_img',
            array(
                'label'   => esc_html__( 'Coffee Cup Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'santino_cup_specialist.jpg' ) : '',
                ),
            )
        );

        $this->add_control(
            'cup_badge_text',
            array(
                'label'   => esc_html__( 'Cup Badge Label', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Certified Roasters',
            )
        );

        $this->add_control(
            'phone',
            array(
                'label'   => esc_html__( 'Direct Hotline', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '+880 1613-334514',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__( 'Icon Class', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'bi bi-headset',
            )
        );

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Perk Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Free Commercial Consultation',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Perk Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Custom workflow design & machine sizing.',
            )
        );

        $this->add_control(
            'perks',
            array(
                'label'       => esc_html__( 'VIP Perks', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'icon'  => 'bi bi-headset',
                        'title' => 'Free Commercial Consultation',
                        'desc'  => 'Custom workflow design & machine sizing.',
                    ),
                    array(
                        'icon'  => 'bi bi-award',
                        'title' => 'Direct Roastery Wholesale Pricing',
                        'desc'  => 'FSSC22000 certified beans & custom blends.',
                    ),
                    array(
                        'icon'  => 'bi bi-tools',
                        'title' => '24/7 Technical Support & Training',
                        'desc'  => 'Full installation, warranty & barista coaching.',
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_right_pane',
            array(
                'label' => esc_html__( 'Form Pane (Right)', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'form_pill',
            array(
                'label'   => esc_html__( 'Form Tag Pill', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'PARTNER WITH SANTINO',
            )
        );

        $this->add_control(
            'form_title',
            array(
                'label'   => esc_html__( 'Form Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Speak to a Coffee Specialist',
            )
        );

        $this->add_control(
            'form_subtitle',
            array(
                'label'   => esc_html__( 'Form Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Fill in your details below and our team will get back to you promptly with a tailored proposal.',
            )
        );

        $this->add_control(
            'submit_btn_text',
            array(
                'label'   => esc_html__( 'Submit Button Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SUBMIT INQUIRY & GET QUOTE',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $perks = ! empty( $settings['perks'] ) ? $settings['perks'] : array();
        $cup_img = ! empty( $settings['cup_img']['url'] ) ? esc_url( $settings['cup_img']['url'] ) : ( function_exists('santino_img') ? santino_img( 'santino_cup_specialist.jpg' ) : '' );
        $phone = ! empty( $settings['phone'] ) ? esc_html( $settings['phone'] ) : '+880 1613-334514';
        ?>
        <section class="specialist-section-v2" id="contact">
            <div class="container">
                <div class="specialist-luxury-card">
                    <div class="row g-0">
                        <div class="col-lg-6 specialist-dark-pane">
                            <div class="specialist-top-header mb-3">
                                <?php if ( ! empty( $settings['badge'] ) ) : ?>
                                    <div class="sec-pill-badge-wrap start light mb-2">
                                        <span class="sec-pill-line"></span>
                                        <span class="sec-pill-badge"><i class="bi bi-cup-hot-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                                        <span class="sec-pill-line"></span>
                                    </div>
                                <?php endif; ?>
                                <h3 class="specialist-pane-title">
                                    <?php echo esc_html( $settings['title'] ); ?> 
                                    <?php if ( ! empty( $settings['title_italic'] ) ) : ?>
                                        <em><?php echo esc_html( $settings['title_italic'] ); ?></em>
                                    <?php endif; ?>
                                </h3>
                                <?php if ( ! empty( $settings['desc'] ) ) : ?>
                                    <p class="specialist-pane-desc mb-0"><?php echo esc_html( $settings['desc'] ); ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="specialist-mid-layout">
                                <div class="specialist-cup-wrap d-none d-md-block">
                                    <img src="<?php echo $cup_img; ?>" alt="Santino Speciality Coffee Cup" class="specialist-cup-img" loading="lazy">
                                    <?php if ( ! empty( $settings['cup_badge_text'] ) ) : ?>
                                        <div class="specialist-cup-badge">
                                            <i class="bi bi-patch-check-fill text-warning"></i> <?php echo esc_html( $settings['cup_badge_text'] ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="specialist-perks-list">
                                    <?php foreach ( $perks as $p ) : ?>
                                        <div class="specialist-perk-row">
                                            <div class="perk-icon-box">
                                                <i class="<?php echo esc_attr( $p['icon'] ); ?>"></i>
                                            </div>
                                            <div>
                                                <h4 class="perk-item-title"><?php echo esc_html( $p['title'] ); ?></h4>
                                                <p class="perk-item-desc"><?php echo esc_html( $p['desc'] ); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="specialist-trust-tags my-2">
                                <span class="trust-tag-item"><i class="bi bi-shield-check text-success"></i> Official Importer</span>
                                <span class="trust-tag-item"><i class="bi bi-clock-history text-info"></i> 4-Hr SLA Response</span>
                                <span class="trust-tag-item"><i class="bi bi-gem text-warning"></i> 100% Genuine Parts</span>
                            </div>

                            <div class="specialist-hotline-bar mt-2">
                                <div class="hotline-phone-wrap">
                                    <div class="hotline-circle-icon"><i class="bi bi-telephone-fill"></i></div>
                                    <div>
                                        <span class="hotline-sub">DIRECT HOTLINE</span>
                                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="hotline-main-num"><?php echo $phone; ?></a>
                                    </div>
                                </div>
                                <div class="hotline-v-sep"></div>
                                <div class="hotline-time-wrap">
                                    <div class="hotline-clock-icon"><i class="bi bi-clock"></i></div>
                                    <div>
                                        <span class="hotline-time-title">Response in &lt;2 Hours</span>
                                        <span class="hotline-time-desc">Our team is always here for you.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 specialist-form-pane">
                            <div class="mb-3">
                                <?php if ( ! empty( $settings['form_pill'] ) ) : ?>
                                    <span class="specialist-partner-pill">
                                        <i class="bi bi-people-fill me-1"></i> <?php echo esc_html( $settings['form_pill'] ); ?>
                                    </span>
                                <?php endif; ?>
                                <h3 class="specialist-form-title"><?php echo esc_html( $settings['form_title'] ); ?></h3>
                                <?php if ( ! empty( $settings['form_subtitle'] ) ) : ?>
                                    <p class="specialist-form-subtitle"><?php echo esc_html( $settings['form_subtitle'] ); ?></p>
                                <?php endif; ?>
                            </div>

                            <form onsubmit="alert('Thank you! Your inquiry has been received. Our specialist will contact you shortly.'); return false;">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="specialist-input-group">
                                            <label class="specialist-input-label">FULL NAME <span class="req-star">*</span></label>
                                            <div class="specialist-input-box">
                                                <i class="bi bi-person specialist-field-icon"></i>
                                                <input type="text" class="specialist-form-input" placeholder="e.g. Tanvir Ahmed" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="specialist-input-group">
                                            <label class="specialist-input-label">BUSINESS EMAIL <span class="req-star">*</span></label>
                                            <div class="specialist-input-box">
                                                <i class="bi bi-envelope specialist-field-icon"></i>
                                                <input type="email" class="specialist-form-input" placeholder="e.g. tanvir@company.com" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="specialist-input-group">
                                            <label class="specialist-input-label">PHONE / WHATSAPP NUMBER <span class="req-star">*</span></label>
                                            <div class="specialist-input-box">
                                                <i class="bi bi-whatsapp specialist-field-icon"></i>
                                                <input type="tel" class="specialist-form-input" placeholder="+880 17XX-XXXXXX" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="specialist-input-group">
                                            <label class="specialist-input-label">BUSINESS TYPE</label>
                                            <div class="specialist-input-box">
                                                <i class="bi bi-shop specialist-field-icon"></i>
                                                <select class="specialist-form-input specialist-form-select">
                                                    <option value="cafe">Café / Coffee Shop</option>
                                                    <option value="restaurant">Restaurant / Hotel</option>
                                                    <option value="office">Corporate Office</option>
                                                    <option value="retail">Supermarket / Retail Resale</option>
                                                    <option value="academy">Barista Academy / Training</option>
                                                    <option value="other">Other Inquiries</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="specialist-input-group">
                                            <label class="specialist-input-label">YOUR REQUIREMENTS &amp; QUESTIONS <span class="req-star">*</span></label>
                                            <div class="specialist-input-box specialist-input-box-textarea">
                                                <i class="bi bi-chat-left-text specialist-field-icon-textarea"></i>
                                                <textarea class="specialist-form-textarea" rows="3" placeholder="Tell us about your machine models of interest, monthly bean volume, or cafe launch timeline..." required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn-specialist-cta">
                                            <span><?php echo esc_html( $settings['submit_btn_text'] ); ?></span>
                                            <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </div>

                                    <div class="col-12">
                                        <div class="specialist-trust-footer">
                                            <span><i class="bi bi-shield-check"></i> Zero Annual Fees</span>
                                            <span class="dot-sep">•</span>
                                            <span>No Credit Card Required</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
