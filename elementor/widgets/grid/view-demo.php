<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;

defined( 'ABSPATH' ) || exit;

class Widget_View_Demo extends Static_Grid {

	public function get_name() {
		return 'tm-view-demo';
	}

	public function get_title() {
		return esc_html__( 'View Demo', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-gallery-grid';
	}

	public function get_keywords() {
		return [ 'demo' ];
	}

	protected function _register_controls() {
		parent::_register_controls();

		$this->add_content_style_section();

		$this->update_controls();
	}

	private function update_controls() {
		$this->update_control( 'items', [
			'title_field' => '{{{ text }}}',
		] );
	}

	private function add_content_style_section() {
		$this->start_controls_section( 'content_style_section', [
			'label' => esc_html__( 'Content', 'billey' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'text_align', [
			'label'     => esc_html__( 'Text Align', 'billey' ),
			'type'      => Controls_Manager::CHOOSE,
			'options'   => Widget_Utils::get_control_options_text_align_full(),
			'selectors' => [
				'{{WRAPPER}} .billey-box' => 'text-align: {{VALUE}};',
			],
		] );

		$this->add_control( 'title_heading', [
			'label'     => esc_html__( 'Title', 'billey' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );

		$this->add_control( 'title_color', [
			'label'     => esc_html__( 'Color', 'billey' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .heading' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => esc_html__( 'Typography', 'billey' ),
			'selector' => '{{WRAPPER}} .heading',
		] );

		$this->end_controls_section();
	}

	protected function add_repeater_controls( Repeater $repeater ) {
		$repeater->add_control( 'image', [
			'label'   => esc_html__( 'Image', 'billey' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$repeater->add_control( 'text', [
			'label'   => esc_html__( 'Text', 'billey' ),
			'type'    => Controls_Manager::TEXT,
			'dynamic' => [
				'active' => true,
			],
		] );

		$repeater->add_control( 'link', [
			'label'         => esc_html__( 'Link', 'billey' ),
			'type'          => Controls_Manager::URL,
			'placeholder'   => esc_html__( 'https://your-link.com', 'billey' ),
			'show_external' => true,
			'default'       => [
				'url'         => '',
				'is_external' => false,
				'nofollow'    => false,
			],
		] );

		$repeater->add_control( 'badge', [
			'label'   => esc_html__( 'Badge', 'billey' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				''       => esc_html__( 'None', 'billey' ),
				'new'    => esc_html__( 'New', 'billey' ),
				'coming' => esc_html__( 'Coming Soon', 'billey' ),
			],
		] );
	}

	protected function get_repeater_defaults() {
		$placeholder_image_src = Utils::get_placeholder_image_src();

		return [
			[
				'image' => [ 'url' => $placeholder_image_src ],
			],
			[
				'image' => [ 'url' => $placeholder_image_src ],
			],
		];
	}

	protected function print_grid_item() {
		$item     = $this->get_current_item();
		$item_key = $this->get_current_item_key();

		$box_tag = 'div';
		$box_key = $item_key . '_box';

		$this->add_render_attribute( $box_key, 'class', 'billey-box' );

		if ( ! empty( $item['link']['url'] ) ) {
			$box_tag = 'a';

			$this->add_render_attribute( $box_key, 'class', 'link-secret' );
			$this->add_link_attributes( $box_key, $item['link'] );
		}
		?>
		<div class="item">
			<?php printf( '<%1$s %2$s>', $box_tag, $this->get_render_attribute_string( $box_key ) ); ?>

			<div class="billey-image image">
				<?php echo \Billey_Image::get_elementor_attachment( [
					'settings' => $item,
				] ); ?>
			</div>

			<?php if ( ! empty( $item['badge'] ) ) : ?>
				<?php if ( 'coming' === $item['badge'] ) { ?>
					<div class="badge coming">
						<img
							src="<?php echo esc_url( BILLEY_THEME_IMAGE_URI . '/soon-badge.png' ); ?>"
							alt="<?php esc_attr_e( 'Coming Soon', 'billey' ); ?>"/>
					</div>
				<?php } elseif ( $item['badge'] === 'new' ) { ?>
					<div class="badge new">
						<img
							src="<?php echo esc_url( BILLEY_THEME_IMAGE_URI . '/new-badge.png' ); ?>"
							alt="<?php esc_attr_e( 'New', 'billey' ); ?>"/>
					</div>
				<?php } ?>
			<?php endif; ?>

			<?php if ( ! empty( $item['text'] ) ): ?>
				<div class="info">
					<h3 class="heading">
						<?php echo esc_html( $item['text'] ); ?>
					</h3>
				</div>
			<?php endif; ?>

			<?php printf( '</%1$s>', $box_tag ); ?>
		</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrapper', 'class', 'tm-view-demo billey-animation-zoom-in' );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php $this->print_grid( $settings ); ?>
		</div>
		<?php
	}
}
