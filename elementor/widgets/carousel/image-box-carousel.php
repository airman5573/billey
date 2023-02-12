<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

defined('ABSPATH') || exit;

class Widget_Image_Box_Carousel extends Carousel_Base
{

	public function get_name()
	{
		return 'tm-image-box-carousel';
	}

	public function get_title()
	{
		return esc_html__('Image Box Carousel', 'billey');
	}

	public function get_icon_part()
	{
		return 'eicon-post-slider';
	}

	public function get_keywords()
	{
		return ['carousel', 'slider', 'image-box', 'image carousel'];
	}

	protected function _register_controls()
	{
		$this->add_content_section();

		parent::_register_controls();

		$this->update_controls();
	}

	private function update_controls()
	{
		$this->update_responsive_control('swiper_items', [
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
		]);

		$this->update_responsive_control('swiper_gutter', [
				'default' => 30,
		]);
	}

	protected function update_slider_settings($settings, $slider_settings)
	{
		// Enable layer transition.
		if ('yes' === $settings['layers_animation']) {
			$slider_settings['class'][] = 'slide-layer-transition';
			$slider_settings['data-layer-transition'] = '1';
			$slider_settings['data-fade-effect'] = 'custom';
		}

		return $slider_settings;
	}

	private function add_content_section()
	{
		$this->start_controls_section('content_section', [
				'label' => esc_html__('Content', 'billey'),
		]);

		$this->add_control('style', [
				'label' => esc_html__('Style', 'billey'),
				'type' => Controls_Manager::SELECT,
				'options' => [
						'style-01' => '01',
						'style-02' => '02',
				],
				'default' => 'style-01',
		]);

		$this->add_control('show_slide_count', [
				'label' => esc_html__('Show Slide Count', 'billey'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
		]);

		$this->add_group_control(Group_Control_Image_Size::get_type(), [
				'label' => esc_html__('Image Size', 'billey'),
				'name' => 'image',
				'default' => 'full',
				'separator' => 'before',
		]);
		$this->add_responsive_control('height', [
				'label' => esc_html__('Height', 'billey'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
						'size' => 700,
						'unit' => 'px',
				],
				'tablet_default' => [
						'unit' => 'px',
				],
				'mobile_default' => [
						'unit' => 'px',
				],
				'size_units' => ['px', '%', 'vh'],
				'range' => [
						'%' => [
								'min' => 1,
								'max' => 100,
						],
						'px' => [
								'min' => 1,
								'max' => 1600,
						],
						'vh' => [
								'min' => 1,
								'max' => 100,
						],
				],
				'selectors' => [
						'{{WRAPPER}} .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template',
		]);

		$this->add_control('layers_animation', [
				'label' => esc_html__('Layers Animation', 'billey'),
				'type' => Controls_Manager::SWITCHER,
		]);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('slide_tabs');

		$repeater->start_controls_tab('slide_content_tab', [
				'label' => esc_html__('Content', 'billey'),
		]);

		$repeater->add_control('image', [
				'label' => esc_html__('Image', 'billey'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
						'url' => Utils::get_placeholder_image_src(),
				],
		]);

		$repeater->add_control('title_heading', [
				'label' => esc_html__('Title', 'billey'),
				'type' => Controls_Manager::HEADING,
		]);

		$repeater->add_control('title', [
				'label' => esc_html__('Text', 'billey'),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
						'active' => true,
				],
				'placeholder' => esc_html__('Enter your title', 'billey'),
				'default' => esc_html__('Add Your Heading Text Here', 'billey'),
		]);

		$repeater->add_control('title_link', [
				'label' => esc_html__('Link', 'billey'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
						'active' => true,
				],
				'placeholder' => esc_html__('https://your-link.com', 'billey'),
				'show_external' => true,
				'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
				],
		]);

		$repeater->add_control('description_heading', [
				'label' => esc_html__('Description', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$repeater->add_control('description', [
				'label' => esc_html__('Description', 'billey'),
				'show_label' => false,
				'type' => Controls_Manager::TEXTAREA,
		]);

		$repeater->add_control('second_description_heading', [
				'label' => esc_html__('Secondary Description', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$repeater->add_control('second_description', [
				'label' => esc_html__('Secondary Description', 'billey'),
				'show_label' => false,
				'type' => Controls_Manager::TEXTAREA,
		]);

		$repeater->add_control('button_heading', [
				'label' => esc_html__('Button', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$repeater->add_control('button_style', [
				'label' => esc_html__('Style', 'billey'),
				'type' => Controls_Manager::SELECT,
				'default' => 'flat',
				'options' => Widget_Utils::get_button_style(),
		]);

		$repeater->add_control('button_text', [
				'label' => esc_html__('Text', 'billey'),
				'type' => Controls_Manager::TEXT,
		]);

		$repeater->add_control('button_link', [
				'label' => esc_html__('Link', 'billey'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
						'active' => true,
				],
				'placeholder' => esc_html__('https://your-link.com', 'billey'),
				'show_external' => true,
				'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
				],
		]);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('slide_background_tab', [
				'label' => esc_html__('Background', 'billey'),
		]);

		$repeater->add_control('background_animation', [
				'label' => esc_html__('Background Animation', 'billey'),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
						'' => esc_html__('None', 'billey'),
						'ken-burns' => esc_html__('Ken Burns', 'billey'),
				],
		]);

		$repeater->add_group_control(Group_Control_Background::get_type(), [
				'name' => 'background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .slide-bg',
				'separator' => 'before',
		]);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('slide_style_tab', [
				'label' => esc_html__('Style', 'billey'),
		]);

		$repeater->add_control('slide_wrapper_heading', [
				'label' => esc_html__('Wrapper', 'billey'),
				'type' => Controls_Manager::HEADING,
		]);

		$repeater->add_responsive_control('content_horizontal_align', [
				'label' => esc_html__('Horizontal Align', 'billey'),
				'label_block' => true,
				'type' => Controls_Manager::CHOOSE,
				'options' => Widget_Utils::get_control_options_horizontal_alignment(),
				'selectors_dictionary' => [
						'left' => 'flex-start',
						'right' => 'flex-end',
				],
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slide-content' => 'justify-content: {{VALUE}}',
				],
		]);

		$repeater->add_responsive_control('content_vertical_alignment', [
				'label' => esc_html__('Vertical Alignment', 'billey'),
				'label_block' => true,
				'type' => Controls_Manager::CHOOSE,
				'options' => Widget_Utils::get_control_options_vertical_alignment(),
				'selectors_dictionary' => [
						'top' => 'flex-start',
						'middle' => 'center',
						'bottom' => 'flex-end',
				],
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slide-content' => 'align-items: {{VALUE}};',
				],
		]);

		$repeater->add_responsive_control('text_align', [
				'label' => esc_html__('Text Align', 'billey'),
				'label_block' => true,
				'type' => Controls_Manager::CHOOSE,
				'options' => Widget_Utils::get_control_options_text_align(),
				'default' => '',
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slide-content' => 'text-align: {{VALUE}};',
				],
		]);

		$repeater->add_responsive_control('slide_wrapper_max_width', [
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
						'{{WRAPPER}} {{CURRENT_ITEM}} .slide-layers' => 'max-width: {{SIZE}}{{UNIT}};',
				],
		]);

		$repeater->add_responsive_control('slide_wrapper_padding', [
				'label' => esc_html__('Padding', 'billey'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slide-layers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		]);

		$repeater->add_control('title_style_heading', [
				'label' => esc_html__('Title', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$repeater->add_control('title_margin', [
				'label' => esc_html__('Margin', 'billey'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		]);

		$repeater->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'billey'),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .title',
		]);

		$repeater->add_control('title_color', [
				'label' => esc_html__('Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .title' => 'color: {{VALUE}};',
				],
		]);

		$repeater->add_control('title_hover_color', [
				'label' => esc_html__('Hover Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .title:hover' => 'color: {{VALUE}};',
				],
		]);

		$repeater->add_control('description_style_heading', [
				'label' => esc_html__('Description', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$repeater->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'description_typography',
				'label' => esc_html__('Typography', 'billey'),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .description',
		]);

		$repeater->add_control('description_color', [
				'label' => esc_html__('Text Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .description' => 'color: {{VALUE}};',
				],
		]);

		$repeater->add_control('second_desc_style_heading', [
				'label' => esc_html__('Secondary Description', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$repeater->add_group_control(Group_Control_Typography::get_type(), [
				'name' => 'second_desc_typography',
				'label' => esc_html__('Typography', 'billey'),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .second-desc',
		]);

		$repeater->add_control('second_description_color', [
				'label' => esc_html__('Text Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .second-desc' => 'color: {{VALUE}};',
				],
		]);

		$repeater->add_control('button_style_heading', [
				'label' => esc_html__('Button', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$repeater->add_control('button_margin', [
				'label' => esc_html__('Margin', 'billey'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .button-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		]);

		$repeater->add_control('button_text_color', [
				'label' => esc_html__('Text Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .tm-button' => 'color: {{VALUE}};',
				],
		]);

		$repeater->add_control('button_text_border_color', [
				'label' => esc_html__('Line Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .tm-button.style-text .button-text:before' => 'background: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}} .tm-button.style-text-left-line .button-text:before' => 'background: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}} .tm-button.style-border .button-border' => 'border-color:  {{VALUE}};',
				],
				'condition' => [
						'button_style' => ['text', 'text-left-line','border'],
				],
		]);

		$repeater->add_group_control(Group_Control_Background::get_type(), [
				'name' => 'button_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .tm-button:before',
		]);

		$repeater->add_control('button_hover_style_heading', [
				'label' => esc_html__('Button Hover', 'billey'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
		]);

		$repeater->add_control('button_hover_text_color', [
				'label' => esc_html__('Text Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .tm-button:hover .button-text' => 'color: {{VALUE}};',
				],
		]);

		$repeater->add_control('button_hover_text_border_color', [
				'label' => esc_html__('Line Color', 'billey'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .tm-button.style-text .button-text:after' => 'background: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}} .tm-button.style-text-text-left-line .button-text:after' => 'background: {{VALUE}};',
				],
				'condition' => [
						'button_style' => ['text', 'text-left-line'],
				],
		]);

		$repeater->add_group_control(Group_Control_Background::get_type(), [
				'name' => 'button_hover_background',
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .tm-button:after',
		]);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control('slides', [
				'label' => esc_html__('Slides', 'billey'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
						[
								'title' => 'Billey Studio',
								'description' => 'So. Morning. Seas shall he darkness moving without. Kind, living, great were whose from behold you’ll sea. And seas.',
						],
						[
								'title' => 'Billey Studio',
								'description' => 'So. Morning. Seas shall he darkness moving without. Kind, living, great were whose from behold you’ll sea. And seas.',
						],
				],
				'title_field' => '{{{ title }}}',
		]);

		$this->end_controls_section();
	}

	protected function before_render_slider_wrapper()
	{
		$this->add_render_attribute($this->get_slider_wrapper_key(), 'class', 'tm-image-box-carousel');
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute($this->get_slider_wrapper_key(), 'class', $settings['style']);

	}

	protected function print_slides(array $settings)
	{
		foreach ($settings['slides'] as $slide) :
			$slide_id = $slide['_id'];
			$item_key = 'item_' . $slide_id;
			$item_title_link_key = 'title_link_' . $slide_id;
			$item_button_key = 'button_' . $slide_id;

			$this->add_render_attribute($item_key, 'class', [
					'swiper-slide',
					'elementor-repeater-item-' . $slide_id,
					'billey-slide-bg-animation-' . $slide['background_animation'],
			]);

			if (!empty($slide['title_link']['url'])) {
				$this->add_render_attribute($item_title_link_key, 'class', 'link-secret');
				$this->add_link_attributes($item_title_link_key, $slide['title_link']);
			}

			$this->add_render_attribute($item_button_key, 'class', [
					'tm-button',
					'style-' . $slide['button_style'],
			]);

			if (!empty($slide['button_link']['url'])) {
				$this->add_link_attributes($item_button_key, $slide['button_link']);
			}
			?>
			<div <?php $this->print_render_attribute_string($item_key); ?>>
				<div class="slide-bg-wrap">
					<div class="slide-bg"></div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="slide-content">
								<div class="slide-image billey-image">
									<?php echo \Billey_Image::get_elementor_attachment([
											'settings' => $slide,
											'size_settings' => $settings,
									]); ?>
								</div>
								<div class="slide-layers">
									<?php if ('' !== $slide['title']) : ?>

										<div class="slide-layer-wrap title-wrap">
											<div class="slide-layer">

												<?php if (!empty($slide['title_link']['url'])) : ?>
												<a <?php $this->print_render_attribute_string($item_title_link_key); ?>>
													<?php endif; ?>

													<h3 class="title"><?php echo wp_kses($slide['title'], 'billey-default'); ?></h3>

													<?php if (!empty($slide['title_link']['url'])) : ?>
												</a>
											<?php endif; ?>

											</div>
										</div>

									<?php endif; ?>

									<?php if (!empty($slide['description'])) : ?>
										<div class="slide-layer-wrap description-wrap">
											<div class="slide-layer">
												<div class="description"><?php echo esc_html($slide['description']); ?></div>

												<?php if (!empty($slide['description'])) : ?>
													<?php printf( '<%1$s %2$s>%3$s</%1$s>','div', 'class="secondary-desc"', $slide['second_description'] ); ?>
												<?php endif; ?>
											</div>
										</div>
									<?php endif; ?>

									<?php if (!empty($slide['button_text']) && !empty($slide['button_link']['url'])) : ?>
										<div class="slide-layer-wrap button-wrap">
											<div class="slide-layer">
												<div class="tm-button-wrapper">
													<a <?php $this->print_render_attribute_string($item_button_key); ?>>
														<div class="button-content-wrapper">
															<span class="button-text">
																<?php echo esc_html($slide['button_text']); ?>
															</span>
														</div>
													</a>
												</div>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach;
	}
}
