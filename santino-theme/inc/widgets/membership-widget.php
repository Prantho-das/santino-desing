<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_Membership_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_membership';
    }

    public function get_title() {
        return esc_html__( 'Santino Privilege Club & Registration', 'santino' );
    }

    public function get_icon() {
        return 'eicon-star';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Header & Card', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'SANTINO PRIVILEGE CLUB',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Join Bangladesh\'s Premier<br>Coffee Community',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Become a Santino Club member to unlock exclusive roastery allocations, VIP wholesale pricing on beans, priority technician dispatch, and private barista workshops.',
            )
        );

        $this->add_control(
            'support_phone',
            array(
                'label'   => esc_html__( 'Support Phone Number', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '+880 1613-334514',
            )
        );

        $this->add_control(
            'media_img',
            array(
                'label'   => esc_html__( 'Benefits Side Image', 'santino' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists( 'santino_img' ) ? santino_img( 'imgi_23_santino_-_250522-07495.jpg' ) : '',
                ),
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Benefit Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => '15% VIP Bean Discount',
            )
        );

        $repeater->add_control(
            'desc',
            array(
                'label'   => esc_html__( 'Benefit Description', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Special roastery pricing applied automatically on all orders.',
            )
        );

        $repeater->add_control(
            'icon_type',
            array(
                'label'   => esc_html__( 'Icon Style', 'santino' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'percent' => 'Percent Symbol (%)',
                    'cup'     => 'Coffee Cup Icon',
                    'wrench'  => 'Wrench Icon',
                    'custom'  => 'Custom Bootstrap Icon',
                ),
                'default' => 'percent',
            )
        );

        $repeater->add_control(
            'custom_icon',
            array(
                'label'     => esc_html__( 'Custom Icon Class', 'santino' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => 'bi bi-gem',
                'condition' => array(
                    'icon_type' => 'custom',
                ),
            )
        );

        $this->add_control(
            'benefits',
            array(
                'label'       => esc_html__( 'Member Benefits', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'title'     => '15% VIP Bean Discount',
                        'desc'      => 'Special roastery pricing applied automatically on all orders.',
                        'icon_type' => 'percent',
                    ),
                    array(
                        'title'     => 'Exclusive Micro-Lot Tastings',
                        'desc'      => 'Complimentary seasonal cupping sessions at Santino Academy.',
                        'icon_type' => 'cup',
                    ),
                    array(
                        'title'     => 'Priority Machine Maintenance',
                        'desc'      => 'Fast-track 24/7 technical hotline and emergency site dispatch.',
                        'icon_type' => 'wrench',
                    ),
                ),
                'title_field' => '{{{ title }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $benefits = ! empty( $settings['benefits'] ) ? $settings['benefits'] : array();
        $media_url = ! empty( $settings['media_img']['url'] ) ? esc_url( $settings['media_img']['url'] ) : '';
        $phone = ! empty( $settings['support_phone'] ) ? esc_html( $settings['support_phone'] ) : '+880 1613-334514';
        ?>
        <section class="santino-club-section" id="membership-registration">
            <div class="club-corner-deco club-deco-top-right" aria-hidden="true">
                <svg width="220" height="200" viewBox="0 0 220 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(110, -20) rotate(25)" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.15))">
                        <path d="M0,0 C35,15 70,55 80,105 C45,95 20,65 0,0 Z" fill="#1b4d3e"/>
                        <path d="M0,0 C35,15 70,55 80,105" stroke="#2d6e5a" stroke-width="2"/>
                        <path d="M80,105 C55,100 25,80 0,0 C15,35 30,70 80,105 Z" fill="#2d6e5a" opacity="0.85"/>
                    </g>
                    <g transform="translate(140, 20) rotate(55)" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.15))">
                        <path d="M0,0 C30,12 60,45 70,90 C40,80 15,55 0,0 Z" fill="#235c4b"/>
                        <path d="M0,0 C30,12 60,45 70,90" stroke="#36806a" stroke-width="1.5"/>
                    </g>
                    <g transform="translate(170, 75) rotate(-15)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
                        <ellipse cx="12" cy="18" rx="10" ry="15" fill="#3b2219"/>
                        <path d="M12,4 C14,11 9,18 13,25 C15,29 11,32 12,32" stroke="#1f120c" stroke-width="2" stroke-linecap="round"/>
                        <ellipse cx="9" cy="12" rx="3" ry="6" fill="#543325" opacity="0.6"/>
                    </g>
                    <g transform="translate(185, 120) rotate(35)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
                        <ellipse cx="10" cy="15" rx="8" ry="12" fill="#4a2c1f"/>
                        <path d="M10,4 C11,9 8,15 11,20 C12,23 9,26 10,26" stroke="#26160e" stroke-width="1.8" stroke-linecap="round"/>
                    </g>
                    <g transform="translate(145, 145) rotate(70)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
                        <ellipse cx="10" cy="14" rx="7" ry="11" fill="#3b2219"/>
                        <path d="M10,4 C11,9 8,14 11,19" stroke="#1a0c07" stroke-width="1.5"/>
                    </g>
                    <g transform="translate(130, 95) rotate(-45)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
                        <ellipse cx="9" cy="12" rx="6" ry="9" fill="#2c170f"/>
                        <path d="M9,3 C10,7 8,11 10,15" stroke="#120804" stroke-width="1.5"/>
                    </g>
                </svg>
            </div>

            <div class="club-corner-deco club-deco-bottom-left" aria-hidden="true">
                <svg width="220" height="200" viewBox="0 0 220 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(30, 190) rotate(-145)" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.15))">
                        <path d="M0,0 C35,15 70,55 80,105 C45,95 20,65 0,0 Z" fill="#1b4d3e"/>
                        <path d="M0,0 C35,15 70,55 80,105" stroke="#2d6e5a" stroke-width="2"/>
                        <path d="M80,105 C55,100 25,80 0,0 C15,35 30,70 80,105 Z" fill="#2d6e5a" opacity="0.85"/>
                    </g>
                    <g transform="translate(10, 150) rotate(-110)" filter="drop-shadow(0 6px 12px rgba(0,0,0,0.15))">
                        <path d="M0,0 C30,12 60,45 70,90 C40,80 15,55 0,0 Z" fill="#235c4b"/>
                        <path d="M0,0 C30,12 60,45 70,90" stroke="#36806a" stroke-width="1.5"/>
                    </g>
                    <g transform="translate(15, 75) rotate(20)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
                        <ellipse cx="12" cy="18" rx="10" ry="15" fill="#3b2219"/>
                        <path d="M12,4 C14,11 9,18 13,25 C15,29 11,32 12,32" stroke="#1f120c" stroke-width="2" stroke-linecap="round"/>
                        <ellipse cx="9" cy="12" rx="3" ry="6" fill="#543325" opacity="0.6"/>
                    </g>
                    <g transform="translate(35, 45) rotate(-30)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
                        <ellipse cx="10" cy="15" rx="8" ry="12" fill="#4a2c1f"/>
                        <path d="M10,4 C11,9 8,15 11,20 C12,23 9,26 10,26" stroke="#26160e" stroke-width="1.8" stroke-linecap="round"/>
                    </g>
                    <g transform="translate(70, 105) rotate(60)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
                        <ellipse cx="10" cy="14" rx="7" ry="11" fill="#3b2219"/>
                        <path d="M10,4 C11,9 8,14 11,19" stroke="#1a0c07" stroke-width="1.5"/>
                    </g>
                    <g transform="translate(20, 120) rotate(-65)" filter="drop-shadow(0 4px 6px rgba(0,0,0,0.3))">
                        <ellipse cx="9" cy="12" rx="6" ry="9" fill="#2c170f"/>
                        <path d="M9,3 C10,7 8,11 10,15" stroke="#120804" stroke-width="1.5"/>
                    </g>
                </svg>
            </div>

            <div class="container position-relative" style="z-index: 2;">
                <div class="text-center mb-4">
                    <?php if ( ! empty( $settings['badge'] ) ) : ?>
                        <div class="sec-pill-badge-wrap light mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-people-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="club-sec-title">
                        <?php echo wp_kses_post( $settings['title'] ); ?>
                    </h2>
                    <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                        <p class="club-sec-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></p>
                    <?php endif; ?>
                    <div class="club-divider-accent">
                        <span></span>
                        <i class="bi bi-gem"></i>
                        <span></span>
                    </div>
                </div>

                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-6">
                        <div class="club-benefits-card">
                            <div class="benefits-card-content">
                                <div class="benefits-label-header">
                                    <span>MEMBER BENEFITS</span>
                                    <hr>
                                </div>

                                <div class="benefits-split-row">
                                    <div class="benefits-list-col">
                                        <?php foreach ( $benefits as $idx => $b ) : ?>
                                            <?php if ( $idx > 0 ) : ?>
                                                <div class="benefit-divider"></div>
                                            <?php endif; ?>
                                            <div class="benefit-item">
                                                <div class="benefit-icon-round">
                                                    <?php if ( $b['icon_type'] === 'percent' ) : ?>
                                                        %
                                                    <?php elseif ( $b['icon_type'] === 'cup' ) : ?>
                                                        <i class="bi bi-cup-hot-fill"></i>
                                                    <?php elseif ( $b['icon_type'] === 'wrench' ) : ?>
                                                        <i class="bi bi-wrench"></i>
                                                    <?php else : ?>
                                                        <i class="<?php echo esc_attr( ! empty( $b['custom_icon'] ) ? $b['custom_icon'] : 'bi bi-gem' ); ?>"></i>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="benefit-text">
                                                    <h6 class="benefit-title"><?php echo esc_html( $b['title'] ); ?></h6>
                                                    <p class="benefit-desc"><?php echo esc_html( $b['desc'] ); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="benefit-media-col">
                                        <img src="<?php echo $media_url; ?>" alt="Santino Coffee Cup & Beans" class="benefit-media-img" loading="lazy">
                                    </div>
                                </div>
                            </div>

                            <div class="club-support-bar">
                                <div class="support-left">
                                    <div class="support-icon">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>
                                    <div>
                                        <div class="support-sub">MEMBERSHIP SUPPORT</div>
                                        <div class="support-phone"><?php echo $phone; ?></div>
                                    </div>
                                </div>
                                <div class="support-divider"></div>
                                <div class="support-right">
                                    <div class="support-clock-icon">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div>
                                        <div class="support-sub">Response in &lt; 2 Hours</div>
                                        <div class="support-note">Our team is always here for you.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="club-register-card">
                            <div class="benefits-label-header mb-2">
                                <i class="bi bi-person-plus-fill me-1"></i>
                                <span>QUICK REGISTRATION</span>
                                <hr>
                            </div>

                            <h3 class="club-form-title">Become a Santino Club Member</h3>
                            <p class="club-form-subtitle">Get exclusive access, special pricing, and premium support — all in one place.</p>

                            <form class="santino-inquiry-form">
                                <input type="hidden" name="inquiry_type" value="home_club_registration">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="club-input-group">
                                            <label class="club-input-label">FULL NAME <span class="text-danger">*</span></label>
                                            <div class="club-input-box">
                                                <i class="bi bi-person club-input-icon"></i>
                                                <input type="text" name="name" class="club-form-input" placeholder="e.g. Tanvir Ahmed" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="club-input-group">
                                            <label class="club-input-label">PHONE / WHATSAPP NUMBER <span class="text-danger">*</span></label>
                                            <div class="club-input-box">
                                                <i class="bi bi-whatsapp club-input-icon"></i>
                                                <input type="tel" name="phone" class="club-form-input" placeholder="+880 17XX-XXXXXX" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="club-input-group">
                                            <label class="club-input-label">EMAIL ADDRESS <span class="text-danger">*</span></label>
                                            <div class="club-input-box">
                                                <i class="bi bi-envelope club-input-icon"></i>
                                                <input type="email" name="email" class="club-form-input" placeholder="e.g. tanvir@company.com" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="club-input-group">
                                            <label class="club-input-label">BUSINESS TYPE</label>
                                            <div class="club-input-box">
                                                <i class="bi bi-shop club-input-icon"></i>
                                                <select name="business_type" class="club-form-select">
                                                    <option value="Café / Coffee Shop">Café / Coffee Shop</option>
                                                    <option value="Restaurant / Hotel">Restaurant / Hotel</option>
                                                    <option value="Corporate Office">Corporate Office</option>
                                                    <option value="Home Barista / Individual">Home Barista / Individual</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="club-input-group">
                                            <label class="club-input-label">YOUR REQUIREMENTS &amp; QUESTIONS</label>
                                            <div class="club-input-box club-input-box-textarea">
                                                <i class="bi bi-chat-left-text club-input-icon-textarea"></i>
                                                <textarea name="message" class="club-form-textarea" placeholder="Tell us about your machine models of interest, monthly bean volume, or cafe launch timeline..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn-register-club">
                                    REGISTER MEMBERSHIP <i class="bi bi-arrow-right-circle-fill ms-1"></i>
                                </button>

                                <div class="club-trust-note mt-3">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Zero Annual Fees • No Credit Card Required</span>
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
