<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Widget_Case_Study_Carousel extends Static_Carousel {

	public function get_name() {
		return 'tm-case-study-carousel';
	}

	public function get_title() {
		return esc_html__( 'Case Study Carousel', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-posts-carousel';
	}

	public function get_keywords() {
		return [ 'case study', 'carousel' ];
	}

	protected function register_controls() {
		$this->add_content_section();

		$this->add_style_section();

		parent::register_controls();

		$this->update_controls();
	}

	private function update_controls() {
		$this->update_responsive_control( 'swiper_items', [
			'default'        => 'auto',
			'tablet_default' => 'auto',
			'mobile_default' => 'auto',
		] );

		$this->update_responsive_control( 'swiper_gutter', [
			'default'        => 100,
			'tablet_default' => 50,
			'mobile_default' => 30,
		] );

		$this->update_control( 'slides', [
			'title_field' => '{{{ title }}}',
		] );
	}

	protected function add_repeater_controls( Repeater $repeater ) {
		$repeater->add_control( 'image', [
			'label'   => esc_html__( 'Image', 'billey' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'billey' ),
			'type'        => Controls_Manager::TEXTAREA,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'Enter your title', 'billey' ),
			'default'     => esc_html__( 'Add Your Heading Text Here', 'billey' ),
		] );

		$repeater->add_control( 'tags', [
			'label'       => esc_html__( 'Tags', 'billey' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => esc_html__( 'One tag per line', 'billey' ),
		] );

		$repeater->add_control( 'link', [
			'label'       => esc_html__( 'Link', 'billey' ),
			'type'        => Controls_Manager::URL,
			'dynamic'     => [
				'active' => true,
			],
			'placeholder' => esc_html__( 'https://your-link.com', 'billey' ),
		] );
	}

	protected function get_repeater_defaults() {
		return [
			[
				'title' => 'Automatic Updates',
				'tags'  => 'Design',
				'link'  => [
					'url' => '#',
				],
			],
			[
				'title' => 'Flexible Options',
				'tags'  => 'Strategy',
				'link'  => [
					'url' => '#',
				],
			],
			[
				'title' => 'Lifetime Use',
				'tags'  => 'Testing',
				'link'  => [
					'url' => '#',
				],
			],
		];
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'billey' ),
		] );

		$this->add_control( 'style', [
				'label'   => esc_html__( 'Style', 'billey' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
						'style-default' => 'default',
						'style-rtl' => 'RTL',

				],
				'default' => 'style-default',
		] );

		$this->add_control( 'show_slide_count', [
			'label'   => esc_html__( 'Show Slide Count', 'billey' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'label'     => esc_html__( 'Image Size', 'billey' ),
			'name'      => 'image',
			'default'   => 'full',
			'separator' => 'before',
		] );

		$this->end_controls_section();
	}

	private function add_style_section() {
		$this->start_controls_section( 'style_section', [
			'label' => esc_html__( 'Style', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'slide_wrapper_heading', [
			'label' => esc_html__( 'Wrapper', 'billey' ),
			'type'  => Controls_Manager::HEADING,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'       => esc_html__( 'Text Align', 'billey' ),
			'label_block' => true,
			'type'        => Controls_Manager::CHOOSE,
			'options'     => Widget_Utils::get_control_options_text_align(),
			'default'     => '',
			'selectors'   => [
				'{{WRAPPER}} .slide-content' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'slide_wrapper_padding', [
			'label'      => esc_html__( 'Padding', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .slide-layers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'title_style_heading', [
			'label'     => esc_html__( 'Title', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'title_margin', [
			'label'      => esc_html__( 'Margin', 'billey' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .title',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'title_hover_color', [
			'label'     => esc_html__( 'Hover Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .title:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_section();
	}

	protected function before_render_slider_wrapper()
	{
		$settings = $this->get_settings_for_display();
		if ( $settings['style'] =='style-rtl' ){
		$this->add_render_attribute($this->get_slider_wrapper_key(), 'dir', 'rtl ');}
			$this->add_render_attribute($this->get_slider_wrapper_key(), 'class', 'billey-case-study-carousel ');
			$this->add_render_attribute($this->get_slider_wrapper_key(), 'class', $settings['style']);

	}

	protected function print_slide() {
		$settings  = $this->get_settings_for_display();
		$slide     = $this->get_current_slide();
		$slide_key = $this->get_current_slide_key();

		$box_key  = 'box_' . $slide_key;
		$link_key = 'link_' . $slide_key;

		$this->add_render_attribute( $box_key, 'class', 'billey-box slide-wrapper' );

		if ( ! empty( $slide['link']['url'] ) ) {
			$this->add_render_attribute( $link_key, 'class', 'tm-button style-text' );
			$this->add_link_attributes( $link_key, $slide['link'] );
		}

		$number_template = '';

		if ( ! empty( $settings['show_slide_count'] ) && 'yes' === $settings['show_slide_count'] ) {
			$index           = $this->get_current_slide_index();
			$numbered        = str_pad( $index, 2, '0', STR_PAD_LEFT );
			$number_template = '<h6 class="slide-numbered">' . $numbered . '.</h6>';
		}
		?>
		<div <?php $this->print_render_attribute_string( $box_key ); ?>>

			<div class="slide-image billey-image">
				<?php echo \Billey_Image::get_elementor_attachment( [
					'settings'      => $slide,
					'size_settings' => $settings,
				] ); ?>
			</div>

			<div class="slide-content">
				<div class="slide-layers">

					<?php if ( ! empty( $slide['tags'] ) ) : ?>
						<?php
						$tags = explode( "\n", str_replace( "\r", "", $slide['tags'] ) );
						?>
						<div class="slide-tags">
							<?php foreach ( $tags as $tag ) : ?>
								<span class="slide-tag"><?php echo esc_html( $tag ); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $number_template ) ) : ?>
						<?php
						echo wp_kses( $number_template, [
							'h6' => [
								'class' => [],
							],
						] );
						?>
					<?php endif; ?>

					<?php if ( ! empty( $slide['title'] ) ) : ?>
						<div class="slide-layer-wrap title-wrap">
							<div class="slide-layer">
								<h3 class="title"><?php echo wp_kses( $slide['title'], 'billey-default' ); ?></h3>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $slide['link']['url'] ) ) { ?>
						<div class="slide-layer-wrap tm-button-wrapper">
							<a <?php $this->print_render_attribute_string( $link_key ); ?>>
								<div class="button-content-wrapper">
									<?php if ( $settings['style'] !=='style-rtl' ) : ?>
									<span class="button-text"><?php esc_html_e( 'Learn More', 'billey' ); ?></span>
									<?php endif; ?>

									<?php if ( $settings['style'] =='style-rtl' ) : ?>
										<span class="button-text"><?php esc_html_e( 'تعمل الميزة', 'billey' ); ?></span>
									<?php endif; ?>
								</div>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>

		</div>
		<?php
	}
}
