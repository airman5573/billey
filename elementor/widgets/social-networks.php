<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

defined( 'ABSPATH' ) || exit;

class Widget_Social_Networks extends Base {

	public function get_name() {
		return 'tm-social-networks';
	}

	public function get_title() {
		return esc_html__( 'Social Networks', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-social-icons';
	}

	public function get_keywords() {
		return [ 'social', 'networks' ];
	}

	protected function _register_controls() {
		$this->add_content_section();

		$this->add_style_section();

		$this->add_icon_style_section();

		$this->add_text_style_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'billey' ),
		] );

		$this->add_control( 'view', [
			'label'   => esc_html__( 'View', 'billey' ),
			'type'    => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		] );

		$this->add_control( 'style', [
			'label'   => esc_html__( 'Style', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'icons'              => esc_html__( 'Icons', 'billey' ),
				'large-icons'        => esc_html__( 'Large Icons', 'billey' ),
				'flat-rounded-icon'  => esc_html__( 'Flat Rounded Icon', 'billey' ),
				'solid-rounded-icon' => esc_html__( 'Solid Rounded Icon', 'billey' ),
				'icon-title'         => esc_html__( 'Icon + Title', 'billey' ),
				'title'              => esc_html__( 'Title', 'billey' ),
			],
			'default' => 'icons',
		] );

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'inline'      => esc_html__( 'Inline', 'billey' ),
				'list'        => esc_html__( 'List', 'billey' ),
				'two-columns' => esc_html__( '2 Columns', 'billey' ),
			],
			'default' => 'inline',
		] );

		$this->add_control( 'tooltip_enable', [
			'label'        => esc_html__( 'Show tooltip as item title.', 'billey' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'billey' ),
			'label_off'    => esc_html__( 'No', 'billey' ),
			'return_value' => '1',
		] );

		$this->add_control( 'tooltip_skin', [
			'label'     => esc_html__( 'Tooltip Skin', 'billey' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				''      => esc_html__( 'Black', 'billey' ),
				'white' => esc_html__( 'White', 'billey' ),
			],
			'default'   => '',
			'condition' => [
				'tooltip_enable' => '1',
			],
		] );

		$this->add_control(
			'tooltip_position', [
			'label'     => esc_html__( 'Tooltip Position', 'billey' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'top'          => esc_html__( 'Top', 'billey' ),
				'right'        => esc_html__( 'Right', 'billey' ),
				'bottom'       => esc_html__( 'Bottom', 'billey' ),
				'left'         => esc_html__( 'Left', 'billey' ),
				'top-left'     => esc_html__( 'Top Left', 'billey' ),
				'top-right'    => esc_html__( 'Top Right', 'billey' ),
				'bottom-left'  => esc_html__( 'Bottom Left', 'billey' ),
				'bottom-right' => esc_html__( 'Bottom Right', 'billey' ),
			],
			'default'   => 'top',
			'condition' => [
				'tooltip_enable' => '1',
			],
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Title', 'billey' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'link', [
			'label'         => esc_html__( 'Link', 'billey' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => esc_html__( 'https://your-link.com', 'billey' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => true,
				'nofollow'    => true,
			],
		] );

		$repeater->add_control( 'icon', [
			'label'       => esc_html__( 'Icon', 'billey' ),
			'type'        => Controls_Manager::ICONS,
			'default'     => [
				'value'   => 'fab fa-facebook-square',
				'library' => 'fa-brands',
			],
			'recommended' => Widget_Utils::get_recommended_social_icons(),
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'billey' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title' => esc_html__( 'Facebook', 'billey' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-facebook-square',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Twitter', 'billey' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-twitter',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Instagram', 'billey' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-instagram',
						'library' => 'fa-brands',
					],
				],
				[
					'title' => esc_html__( 'Linkedin', 'billey' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-linkedin',
						'library' => 'fa-brands',
					],
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->end_controls_section();
	}

	private function add_style_section() {
		$this->start_controls_section( 'style_section', [
			'label' => esc_html__( 'Style', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'items_vertical_spacing', [
			'label'      => esc_html__( 'Items Vertical Spacing', 'billey' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px' ],
			'range'      => [
				'px' => [
					'max'  => 200,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .layout-list .item + .item'                     => 'margin-top: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .layout-two-columns .item:nth-child(2) ~ .item' => 'margin-top: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'alignment', [
			'label'     => esc_html__( 'Alignment', 'billey' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align(),
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};',
			],
		] );

		$this->start_controls_tabs( 'style_tabs' );

		$this->start_controls_tab( 'style_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_control( 'color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'background_color', [
			'label'     => esc_html__( 'Background Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .link' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'border_color', [
			'label'     => esc_html__( 'Border Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .link' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'style_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_control( 'hover_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'background_hover_color', [
			'label'     => esc_html__( 'Background Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .link:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_control( 'border_hover_color', [
			'label'     => esc_html__( 'Border Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .link:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_icon_style_section() {
		$this->start_controls_section( 'icon_style_section', [
			'label' => esc_html__( 'Icon', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'icon_font_size', [
			'label'     => esc_html__( 'Font Size', 'billey' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 8,
					'max' => 30,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .link-icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'icon_style_tabs' );

		$this->start_controls_tab( 'icon_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_control( 'icon_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link-icon' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'icon_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_control( 'icon_hover_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link:hover .link-icon' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function add_text_style_section() {
		$this->start_controls_section( 'text_style_section', [
			'label'     => esc_html__( 'Text', 'billey' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'style' => [
					'icon-title',
					'title',
				],
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title',
			'selector' => '{{WRAPPER}} .link-text',
		] );

		$this->start_controls_tabs( 'title_style_tabs' );

		$this->start_controls_tab( 'title_style_normal_tab', [
			'label' => esc_html__( 'Normal', 'billey' ),
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link-text' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'title_style_hover_tab', [
			'label' => esc_html__( 'Hover', 'billey' ),
		] );

		$this->add_control( 'title_hover_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .link:hover .link-text' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( $settings );

		$this->add_render_attribute( 'wrapper', 'class', 'tm-social-networks' );

		if ( ! empty( $settings['style'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'style-' . $settings['style'] );
		}

		if ( ! empty( $settings['layout'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'layout-' . $settings['layout'] );
		}

		$link_classes = 'link';

		if ( $settings['tooltip_enable'] === '1' ) {
			$link_classes .= " hint--bounce hint--{$settings['tooltip_position']}";

			if ( $settings['tooltip_skin'] !== '' ) {
				$link_classes .= " hint--{$settings['tooltip_skin']}";
			}
		}

		if ( $settings['items'] && count( $settings['items'] ) > 0 ) {
			ob_start();
			foreach ( $settings['items'] as $key => $item ) {
				$item_link_key = 'item_link_' . $item['_id'];
				$_icon         = $link_content = '';

				if ( isset( $item['icon'] ) ) {
					$_icon = $this->get_icons_html( $item['icon'], [ 'class' => 'link-icon' ] );
				}

				if ( in_array( $settings['style'], array(
					'icons',
					'large-icons',
					'icon-title',
					'flat-rounded-icon',
					'solid-rounded-icon',
				) ) ) {
					$link_content .= $_icon;
				}

				if ( in_array( $settings['style'], array( 'icon-title', 'title' ) ) ) {
					$link_content .= '<span class="link-text">' . $item['title'] . '</span>';
				}

				$this->add_render_attribute( $item_link_key, 'class', $link_classes );

				if ( ! empty( $item['title'] ) ) {
					$this->add_render_attribute( $item_link_key, 'aria-label', $item['title'] );
				}

				if ( ! empty( $item['link']['url'] ) ) {
					$this->add_link_attributes( $item_link_key, $item['link'] );
				}
				?>
				<li class="item">
					<a <?php $this->print_render_attribute_string( $item_link_key ); ?>>
						<?php echo "{$link_content}"; ?>
					</a>
				</li>
				<?php
			}
			$template = ob_get_clean();
		}
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php echo '<ul class="list">' . $template . '</ul>'; ?>
		</div>
		<?php
	}

	protected function _content_template() {
		// @formatter:off
		?>
		<div class="tm-social-networks style-{{ settings.style }} layout-{{ settings.layout }}">
			<ul class="<?php echo 'list'; ?>">
				<#
				var iconsHTML = {};
				var linkClass = '<?php echo 'link'; ?>';

				if ( settings.tooltip_enable == '1' ) {
					linkClass += ' hint--bounce hint--' + settings.tooltip_position;

					if ( settings.tooltip_skin !== '' ) {
						linkClass = linkClass + ' hint--' + settings.tooltip_skin;
					}
				}

				if ( settings.items ) {
					_.each( settings.items, function( item, index ) {
				#>
				<li class="item">
					<# if ( item.link && item.link.url ) { #>
					<a href="{{{ item.link.url }}}" class="{{{ linkClass }}}" aria-label="{{{ item.title }}}">

						<#
						var iconStyles = ["icons", "large-icons", "icon-title", "flat-rounded-icon", "solid-rounded-icon"];
						var textStyles = ["title", "icon-title"];
						#>

						<# if ( item.icon && iconStyles.indexOf( settings.style ) >= 0 ) { #>
							<# iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.icon, {'class' : 'link-icon'}, 'i', 'object' ); #>
							{{{ iconsHTML[ index ].value }}}
						<# } #>

						<# if ( textStyles.indexOf( settings.style ) >= 0 ) { #>
							<span class="link-text">{{{ item.title }}}</span>
						<# } #>

					</a>
					<# } #>
				</li>
				<#
				} );
				}
				#>
			</ul>
		</div>
		<?php
		// @formatter:off
	}
}
