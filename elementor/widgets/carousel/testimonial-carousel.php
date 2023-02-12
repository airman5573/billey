<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined('ABSPATH') || exit;

class Widget_Testimonial_Carousel extends Static_Carousel
{

	private $slider_looped_slides = 4;

	public function get_name()
	{
		return 'tm-testimonial';
	}

	public function get_title()
	{
		return esc_html__('Testimonial Carousel', 'billey');
	}

	public function get_icon_part()
	{
		return 'eicon-testimonial-carousel';
	}

	public function get_keywords()
	{
		return ['testimonial', 'carousel'];
	}

	protected function register_controls()
	{
		$this->add_layout_section();

		$this->add_box_style_section();

		$this->add_content_style_section();

		$this->add_image_style_section();

		parent::register_controls();

		$this->update_controls();
	}

	private function update_controls()
	{
		$this->update_responsive_control('swiper_items', [
				'default' => '1',
				'tablet_default' => '1',
				'mobile_default' => '1',
		]);

		$this->update_responsive_control('swiper_gutter', [
				'default' => 30,
		]);

		$this->update_control('slides', [
				'title_field' => '{{{ name }}}',
		]);
	}

	private function add_layout_section()
	{
		$this->start_controls_section('layout_section', [
				'label' => esc_html__('Layout', 'billey'),
		]);

		$this->add_control('style', [
				'label' => esc_html__('Style', 'billey'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
						'' => esc_html__('None', 'billey'),
						'01' => esc_html__('01', 'billey'),
						'02' => esc_html__('02', 'billey'),
						'03' => esc_html__('03', 'billey'),
						'rtl' => esc_html__('rtl', 'billey'),
				],
				'render_type' => 'template',
				'prefix_class' => 'billey-testimonial-style-',
		]);

		$this->add_control('layout', [
				'label' => esc_html__('Layout', 'billey'),
				'type' => Controls_Manager::SELECT,
				'default' => 'image-stacked',
				'options' => [
						'image-inline' => esc_html__('Image Inline', 'billey'),
						'image-stacked' => esc_html__('Image Stacked', 'billey'),
						'image-top' => esc_html__('Image Top', 'billey'),
						'image-above' => esc_html__('Image Thumbs Above', 'billey'),
						'image-below' => esc_html__('Image Thumbs Below', 'billey'),

				],
				'render_type' => 'template',
				'prefix_class' => 'layout-',
		]);

		$this->add_control('image_pagination', [
				'label' => esc_html__('Image Pagination', 'billey'),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
						'layout' => ['image-below', 'image-above']
				],
				'prefix_class' => 'billey-swiper-linked-',
		]);

		$this->add_control('image_position', [
				'label' => esc_html__('Image Position', 'billey'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'below',
				'options' => [
						'above' => [
								'title' => esc_html__('Above', 'billey'),
								'icon' => 'eicon-v-align-top',
						],
						'below' => [
								'title' => esc_html__('Below', 'billey'),
								'icon' => 'eicon-v-align-bottom',
						],
						'bottom' => [
								'title' => esc_html__('Bottom', 'billey'),
								'icon' => 'eicon-v-align-stretch',
						],
				],
				'render_type' => 'template',
				'prefix_class' => 'image-position-',
				'condition' => [
						'layout' => [
								'image-inline',
								'image-stacked',
						],
				],
		]);

		$this->end_controls_section();
	}

	private function add_box_style_section()
	{
		$this->start_controls_section('box_style_section', [
				'label' => esc_html__('Box', 'billey'),
				'tab' => Controls_Manager::TAB_STYLE,
		]);

		$this->add_responsive_control('box_alignment', [
				'label' => esc_html__('Alignment', 'billey'),
				'type' => Controls_Manager::CHOOSE,
				'options' => Widget_Utils::get_control_options_text_align(),
				'selectors' => [
						'{{WRAPPER}} .swiper-slide' => 'text-align: {{VALUE}}',
				],
		]);

		$this->add_responsive_control('box_max_width', [
				'label' => esc_html__('Max Width', 'billey'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
						'unit' => 'px',
				],
				'size_units' => ['px', '%'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .testimonial-item' => 'width: {{SIZE}}{{UNIT}};',
				],
		]);

		$this->add_responsive_control('box_padding', [
				'label' => esc_html__('Padding', 'billey'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
						'{{WRAPPER}} .testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		]);

		$this->add_group_control(Group_Control_Background::get_type(), [
				'name' => 'box',
				'selector' => '{{WRAPPER}} .testimonial-item',
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
				'name' => 'box',
				'selector' => '{{WRAPPER}} .testimonial-item',
		]);

		$this->end_controls_section();
	}

	private function add_content_style_section()
	{
		$this->start_controls_section('content_style_section', [
				'label' => esc_html__('Content', 'billey'),
				'tab' => Controls_Manager::TAB_STYLE,
		]);

		$this->add_responsive_control('content_max_width', [
				'label' => esc_html__('Max Width', 'billey'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
						'unit' => 'px',
				],
				'size_units' => ['px', '%'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .content-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
		]);

		$this->add_responsive_control('content_alignment', [
				'label' => esc_html__('Alignment', 'billey'),
				'type' => Controls_Manager::CHOOSE,
				'options' => Widget_Utils::get_control_options_horizontal_alignment(),
				'selectors_dictionary' => [
						'left' => 'flex-start',
						'right' => 'flex-end',
				],
				'selectors' => [
						'{{WRAPPER}} .testimonial-main-content' => 'justify-content: {{VALUE}}',
				],
		]);

		$this->add_control('content_text_align', [
				'label' => esc_html__('Text Align', 'billey'),
				'label_block' => false,
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => Widget_Utils::get_control_options_text_align(),
				'prefix_class' => 'align-',
			//'render_type'  => 'template',
				'selectors' => [
						'{{WRAPPER}} .content-wrap' => 'text-align: {{VALUE}};',
				],
		]);

		$this->add_control('title_heading', [
				'label' => esc_html__('Title', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$this->add_control('title_color', [
				'label' => esc_html__('Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .title' => 'color: {{VALUE}};',
				],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'billey'),
				'selector' => '{{WRAPPER}} .title',
		]);

		$this->add_responsive_control('title_margin', [
				'label' => esc_html__('Margin', 'billey'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
						'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		]);

		$this->add_control('text_heading', [
				'label' => esc_html__('Text', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$this->add_control('text_color', [
				'label' => esc_html__('Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .text' => 'color: {{VALUE}};',
				],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'text_typography',
				'label' => esc_html__('Typography', 'billey'),
				'selector' => '{{WRAPPER}} .text',
		]);

		$this->add_control('name_heading', [
				'label' => esc_html__('Name', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$this->add_group_control(Group_Control_Text_Gradient::get_type(), [
				'name' => 'name_color',
				'selector' => '{{WRAPPER}} .name',
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'name_typography',
				'label' => esc_html__('Typography', 'billey'),
				'selector' => '{{WRAPPER}} .name',
		]);

		$this->add_control('position_heading', [
				'label' => esc_html__('Position', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$this->add_control('position_color', [
				'label' => esc_html__('Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} .position' => 'color: {{VALUE}};',
				],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'position_typography',
				'label' => esc_html__('Typography', 'billey'),
				'selector' => '{{WRAPPER}} .position',
		]);

		$this->end_controls_section();
	}

	private function add_image_style_section()
	{
		$this->start_controls_section('image_style_section', [
				'label' => esc_html__('Image', 'billey'),
				'tab' => Controls_Manager::TAB_STYLE,
		]);

		$this->add_responsive_control('image_margin', [
				'label' => esc_html__('Margin', 'billey'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
						'{{WRAPPER}} .image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		]);

		$this->add_responsive_control('image_size', [
						'label' => esc_html__('Size', 'billey'),
						'type' => Controls_Manager::SLIDER,
						'range' => [
								'px' => [
										'min' => 30,
										'max' => 200,
								],
						],
						'selectors' => [
								'{{WRAPPER}} .image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
						],
				]
		);

		$this->end_controls_section();
	}

	protected function add_repeater_controls(Repeater $repeater)
	{
		$repeater->add_control('title', [
				'label' => esc_html__('Title', 'billey'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
		]);

		$repeater->add_control('content', [
				'label' => esc_html__('Content', 'billey'),
				'type' => Controls_Manager::TEXTAREA,
		]);

		$repeater->add_control('image', [
				'label' => esc_html__('Avatar', 'billey'),
				'type' => Controls_Manager::MEDIA,
		]);

		$repeater->add_control('name', [
				'label' => esc_html__('Name', 'billey'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('John Doe', 'billey'),
		]);

		$repeater->add_control('position', [
				'label' => esc_html__('Position', 'billey'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('CEO', 'billey'),
		]);

		$repeater->add_control('rating', [
				'label' => esc_html__('Rating', 'billey'),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5,
				'step' => 0.1,
		]);
	}

	protected function get_repeater_defaults()
	{
		$placeholder_image_src = Utils::get_placeholder_image_src();

		return [
				[
						'content' => esc_html__('I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'billey'),
						'name' => esc_html__('Frankie Kao', 'billey'),
						'position' => esc_html__('CEO', 'billey'),
						'image' => ['url' => $placeholder_image_src],
				],
				[
						'content' => esc_html__('I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'billey'),
						'name' => esc_html__('Frankie Kao', 'billey'),
						'position' => esc_html__('CEO', 'billey'),
						'image' => ['url' => $placeholder_image_src],
				],
				[
						'content' => esc_html__('I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'billey'),
						'name' => esc_html__('Frankie Kao', 'billey'),
						'position' => esc_html__('CEO', 'billey'),
						'image' => ['url' => $placeholder_image_src],
				],
		];
	}

	protected function update_slider_settings($settings, $slider_settings)
	{
		if ('yes' === $settings['image_pagination']) {
			$slider_settings['class'][] = 'billey-main-swiper';
			$slider_settings['data-looped-slides'] = $this->slider_looped_slides;
		}

		return $slider_settings;
	}

	private function print_testimonial_rating($rating = 5)
	{
		$full_stars = intval($rating);
		$template = '';

		$template .= str_repeat('<span class="fa fa-star"></span>', $full_stars);

		$half_star = floatval($rating) - $full_stars;

		if ($half_star != 0) {
			$template .= '<span class="fa fa-star-half-alt"></span>';
		}

		$empty_stars = intval(5 - $rating);
		$template .= str_repeat('<span class="far fa-star"></span>', $empty_stars);

		echo '<div class="testimonial-rating">' . $template . '</div>';
	}

	private function print_testimonial_cite()
	{
		$slide = $this->get_current_slide();

		if (empty($slide['name']) && empty($slide['position'])) {
			return;
		}

		$html = '<div class="cite">';
		if (!empty($slide['name'])) {
			$html .= '<h6 class="name">' . $slide['name'] . '</h6>';
		}
		if (!empty($slide['position'])) {
			$html .= '<span class="position">' . $slide['position'] . '</span>';
		}
		$html .= '</div>';

		echo '' . $html;
	}

	private function print_testimonial_avatar()
	{
		$slide = $this->get_current_slide();
		$settings = $this->get_settings_for_display();

		if (empty($slide['image']['url'])) {
			return;
		}
		?>
		<div class="image">
			<?php echo \Billey_Image::get_elementor_attachment([
					'settings' => $slide,
					'image_size_key' => 'image_size',
					'size_settings' => $settings,
			]); ?>
		</div>
		<?php
	}

	private function print_testimonial_info()
	{
		$settings = $this->get_settings_for_display();
		?>
		<div class="info">
			<?php if (!in_array($settings['layout'], ['image-top'], true)) : ?>
				<?php $this->print_testimonial_avatar(); ?>
			<?php endif; ?>

			<?php $this->print_testimonial_cite(); ?>
		</div>
		<?php
	}

	private function print_testimonial_main_content()
	{
		$settings = $this->get_settings_for_display();
		?>
		<div class="testimonial-main-content">
			<div class="content-wrap">
				<?php if (('image-above' === $settings['layout']) || ('image-below' === $settings['layout'])) : ?>
					<?php $this->print_layout_image_above(); ?>
				<?php else: ?>
					<?php $this->print_layout(); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	protected function print_slide()
	{
		$item_key = $this->get_current_slide_key();
		$this->add_render_attribute($item_key . '-testimonial', [
				'class' => 'testimonial-item',
		]);
		?>
		<div <?php $this->print_render_attribute_string($item_key . '-testimonial'); ?>>
			<?php $this->print_testimonial_main_content(); ?>
		</div>
		<?php
	}

	private function print_layout_image_above()
	{
		$slide = $this->get_current_slide();
		$settings = $this->get_settings_for_display();
		?>
		<?php if ($slide['content']) : ?>
		<div class="content">
			<?php if (!empty($slide['title'])): ?>
				<div class="title"><?php echo esc_html($slide['title']); ?></div>
			<?php endif; ?>
			<div class="text">
				<?php echo wp_kses($slide['content'], 'billey-default'); ?>
			</div>
		</div>
	<?php endif; ?>

		<?php if (('image-above' === $settings['layout']) || ('image-below' === $settings['layout'])) : ?>
		<?php $this->print_testimonial_cite(); ?>
	<?php endif; ?>

		<?php
	}

	private function print_layout()
	{
		$slide = $this->get_current_slide();
		$settings = $this->get_settings_for_display();
		?>
		<?php if ('above' === $settings['image_position']) {
		$this->print_testimonial_info();
	} ?>

		<?php if ('image-top' === $settings['layout']) : ?>
		<?php $this->print_testimonial_avatar(); ?>
	<?php endif; ?>

		<?php if ($slide['content']) : ?>
		<div class="content">
			<?php if (!empty($slide['title'])): ?>
				<h4 class="title"><?php echo esc_html($slide['title']); ?></h4>
			<?php endif; ?>

			<?php if (!empty($slide['rating'])): ?>
				<?php $this->print_testimonial_rating($slide['rating']); ?>
			<?php endif; ?>

			<div class="text">
				<?php echo wp_kses($slide['content'], 'billey-default'); ?>
			</div>
		</div>
	<?php endif; ?>

		<?php
		if ((in_array($settings['layout'], [
								'image-inline',
								'image-stacked',
						], true) && in_array($settings['image_position'], ['below', 'bottom'], true))
				|| in_array($settings['layout'], ['image-top'], true)
		) : ?>
			<?php $this->print_testimonial_info(); ?>
		<?php endif; ?>
		<?php
	}

	/**
	 * Print Pagination Avatar Thumbs Slider
	 */
	protected function before_render_slider()
	{
		$settings = $this->get_active_settings();

		if (('yes' !== $settings['image_pagination']) || ('image-above' !== $settings['layout'])) {
			return;
		}

		$testimonial_thumbs_template = '';

		foreach ($settings['slides'] as $slide) :
			if ($slide['image']['url']) :
				$testimonial_thumbs_template .= '<div class="swiper-slide"><div class="post-thumbnail"><div class="image">' . \Billey_Image::get_elementor_attachment([
								'settings' => $slide,
								'image_size_key' => 'image_size',
						]) . '</div></div></div>';
			endif;
		endforeach;

		?>
		<div class="tm-swiper tm-slider-widget billey-testimonial-pagination style-01 billey-thumbs-swiper"
			 data-lg-items="3"
			 data-lg-gutter="30"
			 data-slide-to-clicked-slide="1"
			 data-centered="1"
			 data-loop="1"
			 data-looped-slides="<?php echo esc_attr($this->slider_looped_slides); ?>"
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php echo '' . $testimonial_thumbs_template; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function after_render_slider()
	{
		$settings = $this->get_active_settings();

		if (('yes' !== $settings['image_pagination']) || ('image-below' !== $settings['layout'])) {
			return;
		}

		$testimonial_thumbs_template = '';

		foreach ($settings['slides'] as $slide) :
			if ($slide['image']['url']) :
				$testimonial_thumbs_template .= '<div class="swiper-slide"><div class="post-thumbnail"><div class="image">' . \Billey_Image::get_elementor_attachment([
								'settings' => $slide,
								'image_size_key' => 'image_size',
						]) . '</div></div></div>';
			endif;
		endforeach;

		?>
		<div class="tm-swiper tm-slider-widget billey-testimonial-pagination style-01 billey-thumbs-swiper"
			 data-lg-items="3"
			 data-lg-gutter="30"
			 data-slide-to-clicked-slide="1"
			 data-centered="1"
			 data-loop="1"
			 data-looped-slides="<?php echo esc_attr($this->slider_looped_slides); ?>"
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php echo '' . $testimonial_thumbs_template; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
