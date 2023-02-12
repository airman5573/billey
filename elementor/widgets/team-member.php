<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || exit;

class Widget_Team_Member extends Base {

	public function get_name() {
		return 'tm-team-member';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-person';
	}

	public function get_keywords() {
		return [ 'team', 'member', 'avatar' ];
	}

	protected function _register_controls() {
		$this->add_content_section();

		$this->add_box_overlay_style_section();

		$this->add_content_style_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Content', 'billey' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => '01',
			'options'      => [
				'01' => esc_html__( '01', 'billey' ),
				'02' => esc_html__( '02', 'billey' ),
				'03' => esc_html__( '03', 'billey' ),
				'04' => esc_html__( '04', 'billey' ),
				'05' => esc_html__( '05', 'billey' ),
			],
			'render_type'  => 'template',
			'prefix_class' => 'billey-team-member-style-',
		] );

		$this->add_control( 'hover_effect', [
			'label'        => esc_html__( 'Hover Effect', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''         => esc_html__( 'None', 'billey' ),
				'zoom-in'  => esc_html__( 'Zoom In', 'billey' ),
				'zoom-out' => esc_html__( 'Zoom Out', 'billey' ),
			],
			'default'      => '',
			'prefix_class' => 'billey-animation-',
			'condition'    => [
				'style' => [
					'01',
					'02',
					'03',
				],
			],
		] );

		$this->add_control( 'name', [
			'label'   => esc_html__( 'Name', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'John Doe', 'billey' ),
		] );

		$this->add_control( 'content', [
			'label' => esc_html__( 'Content', 'billey' ),
			'type'  => Controls_Manager::TEXTAREA,
		] );

		$this->add_control( 'image', [
			'label' => esc_html__( 'Image', 'billey' ),
			'type'  => Controls_Manager::MEDIA,
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'    => 'image',
			'default' => 'full',
		] );

		$this->add_control( 'position', [
			'label'   => esc_html__( 'Position', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'default' => esc_html__( 'CEO', 'billey' ),
		] );

		$this->add_control( 'profile', [
			'label'         => esc_html__( 'Profile', 'billey' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => esc_html__( 'https://your-link.com', 'billey' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => true,
				'nofollow'    => true,
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
				'value'   => 'fab fa-facebook',
				'library' => 'fa-brands',
			],
			'recommended' => Widget_Utils::get_recommended_social_icons(),
		] );

		$this->add_control( 'social_networks', [
			'label'         => esc_html__( 'Social Networks', 'billey' ),
			'type'          => Controls_Manager::REPEATER,
			'fields'        => $repeater->get_controls(),
			'default'       => [
				[
					'title' => esc_html__( 'Facebook', 'billey' ),
					'link'  => [
						'url'         => '#',
						'is_external' => true,
						'nofollow'    => true,
					],
					'icon'  => [
						'value'   => 'fab fa-facebook-f',
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
			],
			'title_field'   => '{{{ title }}}',
			'separator'     => 'before',
			'prevent_empty' => false,
		] );

		$this->end_controls_section();
	}

	private function add_box_overlay_style_section() {
		$this->start_controls_section( 'box_style_section', [
			'label' => esc_html__( 'Overlay', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'box',
			'selector' => '{{WRAPPER}} .overlay',
		] );

		$this->end_controls_section();
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'        => esc_html__( 'Text Align', 'billey' ),
			'type'         => Controls_Manager::CHOOSE,
			'options'      => Widget_Utils::get_control_options_text_align_full(),
			'prefix_class' => 'elementor%s-align-',
			'default'      => '',
		] );

		$this->add_control( 'text_heading', [
			'label'     => esc_html__( 'Text', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'text_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .description' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'text_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .description',
		] );

		$this->add_control( 'name_heading', [
			'label'     => esc_html__( 'Name', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'name_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .name' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .name',
		] );

		$this->add_control( 'position_heading', [
			'label'     => esc_html__( 'Position', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'position_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .position' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .position',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'tm-team-member billey-box' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<div class="item">
				<?php if ( $settings['image']['url'] ) : ?>
					<?php if ( in_array( $settings['style'], array( '04' ) ) ) : ?>
						<div class="team-member-shapes">
							<div class="shape shape-01">
								<img src="<?php echo BILLEY_ELEMENTOR_ASSETS . '/images/team-member-shape-01.png'; ?>"
								     alt="<?php echo esc_attr__( 'Shape 01', 'billey' ); ?>"/>
							</div>
							<div class="shape shape-02">
								<img src="<?php echo BILLEY_ELEMENTOR_ASSETS . '/images/team-member-shape-02.png'; ?>"
								     alt="<?php echo esc_attr__( 'Shape 02', 'billey' ); ?>"/>
							</div>
							<div class="shape shape-03">
								<img src="<?php echo BILLEY_ELEMENTOR_ASSETS . '/images/team-member-shape-03.png'; ?>"
								     alt="<?php echo esc_attr__( 'Shape 03', 'billey' ); ?>"/>
							</div>
						</div>
					<?php endif; ?>

					<div class="photo billey-image">
						<?php echo \Billey_Image::get_elementor_attachment( [
							'settings' => $settings,
						] ); ?>

						<div class="overlay"></div>

						<?php if ( in_array( $settings['style'], array( '01', '02', '03' ) ) ) : ?>
							<?php $this->print_social_networks( $settings ); ?>
						<?php endif; ?>
					</div>

					<div class="info">
						<?php if ( in_array( $settings['style'], array( '04' ) ) ) : ?>
							<?php $this->print_social_networks( $settings ); ?>
						<?php endif; ?>

						<?php if ( in_array( $settings['style'], array( '03', '04' ) ) ) : ?>
							<?php if ( ! empty( $settings['position'] ) ) : ?>
								<div class="position"><?php echo esc_html( $settings['position'] ); ?></div>
							<?php endif; ?>

							<?php $this->print_name( $settings ); ?>
						<?php else: ?>
							<?php $this->print_name( $settings ); ?>

							<?php if ( ! empty( $settings['position'] ) ) : ?>
								<div class="position"><?php echo esc_html( $settings['position'] ); ?></div>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( $settings['content'] !== '' ) : ?>
							<div class="description">
								<?php echo wp_kses( $settings['content'], 'billey-default' ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	private function print_name( array $settings ) {
		if ( empty( $settings['name'] ) ) {
			return;
		}

		if ( ! empty( $settings['profile']['url'] ) ) {
			$this->add_link_attributes( 'profile', $settings['profile'] );
		}
		?>
		<div class="name-wrap">
			<h3 class="name">
				<?php
				if ( $settings['profile']['url'] !== '' ) {
					echo '<a ' . $this->get_render_attribute_string( 'profile' ) . '>';
					echo esc_html( $settings['name'] );
					echo '</a>';
				} else {
					echo esc_html( $settings['name'] );
				}
				?>
			</h3>
		</div>
		<?php
	}

	private function print_social_networks( $settings ) {
		if ( empty( $settings['social_networks'] ) ) {
			return;
		}
		?>
		<div class="social-networks">
			<div class="inner">
				<?php
				foreach ( $settings['social_networks'] as $item ) {
					$repeater_id = $item['_id'];
					$link_key    = 'link_' . $repeater_id;

					$this->add_render_attribute( $link_key, 'aria-label', $item['title'] );

					if ( ! empty( $item['link']['url'] ) ) {
						$this->add_link_attributes( $link_key, $item['link'] );
					}
					?>
					<a <?php $this->print_render_attribute_string( $link_key ); ?>>
						<?php Icons_Manager::render_icon( $item['icon'], [ 'class' => 'link-icon' ], 'span' ) ?>
					</a>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}
