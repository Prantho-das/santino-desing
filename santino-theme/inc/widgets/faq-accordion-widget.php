<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Santino_FAQ_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'santino_faq';
    }

    public function get_title() {
        return esc_html__( 'Santino FAQ Accordion', 'santino' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return array( 'santino-category' );
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'FAQ Header & Items', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__( 'Badge Text', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'FREQUENTLY ASKED QUESTIONS',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Title', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Frequently Asked Questions',
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Everything you need to know about Santino equipment & roastery',
            )
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            array(
                'label'   => esc_html__( 'Question', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Why choose Santino Coffee?',
            )
        );

        $repeater->add_control(
            'answer',
            array(
                'label'   => esc_html__( 'Answer', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Santino Coffee bridges heritage and innovation to empower coffee businesses across Asia.',
            )
        );

        $this->add_control(
            'faqs_list',
            array(
                'label'       => esc_html__( 'FAQs', 'santino' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'question' => 'Why choose Santino Coffee?',
                        'answer'   => 'Santino Coffee bridges heritage and innovation to empower coffee businesses across Asia. With decades of roasting experience, FSSC22000 certification, and authorized distribution of Victoria Arduino and Nuova Simonelli, we provide complete, reliable coffee solutions.',
                    ),
                    array(
                        'question' => 'What coffee equipment and solutions do you provide?',
                        'answer'   => 'We supply commercial espresso machines, superautomatics, CAYE Bionic Barista robots, precision grinders, 3TEMP batch brewers, Rainforest Alliance certified coffee beans, OEM private label roasting, and full café setup consulting.',
                    ),
                    array(
                        'question' => 'Do you offer barista academy certification and competition coaching?',
                        'answer'   => 'Yes, our certified trainers lead foundational espresso workshops, advanced latte art masterclasses, and WBC (World Barista Championship) & WBrC competition mentorship.',
                    ),
                    array(
                        'question' => 'What after-sales service and preventive maintenance is available?',
                        'answer'   => 'We provide dedicated technical support, scheduled preventive maintenance contracts, on-site diagnostics, and genuine OEM parts to ensure uninterrupted beverage service.',
                    ),
                ),
                'title_field' => '{{{ question }}}',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $faqs = ! empty( $settings['faqs_list'] ) ? $settings['faqs_list'] : array();
        ?>
        <section class="faq-section" id="faqs">
            <div class="container">
                <div class="sec-heading-center">
                    <?php if ( ! empty( $settings['badge'] ) ) : ?>
                        <div class="sec-pill-badge-wrap mb-2">
                            <span class="sec-pill-line"></span>
                            <span class="sec-pill-badge"><i class="bi bi-question-circle-fill me-1"></i> <?php echo esc_html( $settings['badge'] ); ?></span>
                            <span class="sec-pill-line"></span>
                        </div>
                    <?php endif; ?>
                    <h2 class="sec-title"><?php echo esc_html( $settings['title'] ); ?></h2>
                    <?php if ( ! empty( $settings['subtitle'] ) ) : ?>
                        <div class="sec-subtitle"><?php echo esc_html( $settings['subtitle'] ); ?></div>
                    <?php endif; ?>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="accordion" id="faqAccordion-<?php echo esc_attr( $widget_id ); ?>">
                            <?php foreach ( $faqs as $index => $item ) : 
                                $collapse_id = 'faqK-' . $widget_id . '-' . $index;
                                $is_open = $index === 0;
                            ?>
                                <div class="accordion-item mb-3 border rounded-3 overflow-hidden shadow-sm">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button <?php echo $is_open ? '' : 'collapsed'; ?> fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>">
                                            <?php echo esc_html( $item['question'] ); ?>
                                        </button>
                                    </h2>
                                    <div id="<?php echo esc_attr( $collapse_id ); ?>" class="accordion-collapse collapse <?php echo $is_open ? 'show' : ''; ?>" data-bs-parent="#faqAccordion-<?php echo esc_attr( $widget_id ); ?>">
                                        <div class="accordion-body text-muted">
                                            <?php echo wp_kses_post( $item['answer'] ); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
