<?php
/**
 * Elementor FAQ Accordion Widget
 *
 * @package Santino
 */

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
                'label' => esc_html__( 'FAQ Items', 'santino' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            array(
                'label'   => esc_html__( 'Question', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'default' => 'Do you provide official manufacturer warranty in Bangladesh?',
            )
        );

        $repeater->add_control(
            'answer',
            array(
                'label'   => esc_html__( 'Answer', 'santino' ),
                'type'    => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Yes, as the authorized distributor for Nuova Simonelli, Victoria Arduino, and CREM, all our machines come with official 1-year manufacturer warranty and free AMC visits.',
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
                        'question' => 'Do you provide official manufacturer warranty in Bangladesh?',
                        'answer'   => 'Yes, as the authorized distributor, all our commercial espresso machines come with official manufacturer warranty and free quarterly preventive maintenance visits.',
                    ),
                    array(
                        'question' => 'How quickly does your AMC support respond to machine breakdown?',
                        'answer'   => 'In Dhaka metropolitan area, our emergency technical team responds within 2-4 hours. We carry OEM spare parts to fix on the spot or provide a temporary backup machine.',
                    ),
                    array(
                        'question' => 'Can I customize coffee bean roast profiles for my cafe chain?',
                        'answer'   => 'Absolutely. Our head roaster collaborates directly with you to craft custom signature blends and roast profiles tailored to your menu, cup size, and customer taste.',
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
        ?>
        <section class="faq-section py-5 bg-white">
            <div class="container-fluid px-lg-5" style="max-width: 900px;">
                <div class="text-center mb-5">
                    <h2 class="display-6 fw-bold font-heading text-dark"><?php echo esc_html( $settings['title'] ); ?></h2>
                </div>

                <div class="accordion" id="faqAccordion-<?php echo esc_attr( $widget_id ); ?>">
                    <?php foreach ( $settings['faqs_list'] as $index => $item ) : ?>
                        <?php $collapse_id = 'collapse-' . $widget_id . '-' . $index; ?>
                        <div class="accordion-item border rounded-4 mb-3 overflow-hidden shadow-sm">
                            <h2 class="accordion-header">
                                <button class="accordion-button <?php echo $index === 0 ? '' : 'collapsed'; ?> fw-bold font-heading text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>">
                                    <?php echo esc_html( $item['question'] ); ?>
                                </button>
                            </h2>
                            <div id="<?php echo esc_attr( $collapse_id ); ?>" class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" data-bs-parent="#faqAccordion-<?php echo esc_attr( $widget_id ); ?>">
                                <div class="accordion-body text-muted">
                                    <?php echo wp_kses_post( $item['answer'] ); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
