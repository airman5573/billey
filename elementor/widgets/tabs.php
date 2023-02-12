<?php

namespace Billey_Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Core\Base\Document;
use ElementorPro\Modules\QueryControl\Module as QueryControlModule;
use ElementorPro\Plugin;

defined( 'ABSPATH' ) || exit;

class Widget_Tabs extends Base {

	public function get_name() {
		return 'tm-tabs';
	}

	public function get_title() {
		return esc_html__( 'Advanced Tabs', 'billey' );
	}

	public function get_icon_part() {
		return 'eicon-tabs';
	}

	public function get_keywords() {
		return [ 'advanced', 'modern', 'tabs' ];
	}

	public function get_script_depends() {
		return [ 'billey-widget-tabs' ];
	}

	public function is_reload_preview_required() {
		return false;
	}

	protected function _register_controls() {
		$this->add_content_section();
	}

	private function add_content_section() {
		$this->start_controls_section( 'content_section', [
			'label' => esc_html__( 'Items', 'billey' ),
		] );

		$this->add_control( 'style', [
			'label'        => esc_html__( 'Style', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => '01',
			'options'      => [
				'01' => '01',
			],
			'prefix_class' => 'billey-tabs-style-',
		] );

		$repeater = new Repeater();

		$repeater->add_control( 'title', [
			'label'       => esc_html__( 'Title', 'billey' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => esc_html__( 'Tab Title', 'billey' ),
			'label_block' => true,
			'dynamic'     => [
				'active' => true,
			],
		] );

		$repeater->add_control( 'content_type', [
			'label'       => esc_html__( 'Content Type', 'billey' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'toggle'      => false,
			'render_type' => 'template',
			'default'     => 'content',
			'options'     => [
				'content'  => [
					'title' => esc_html__( 'Content', 'billey' ),
					'icon'  => 'eicon-edit',
				],
				'template' => [
					'title' => esc_html__( 'Saved Template', 'billey' ),
					'icon'  => 'eicon-library-open',
				],
			],
		] );

		$repeater->add_control( 'content', [
			'label'     => esc_html__( 'Content', 'billey' ),
			'type'      => Controls_Manager::WYSIWYG,
			'condition' => [
				'content_type' => 'content',
			],
		] );

		$document_types = Plugin::elementor()->documents->get_document_types( [
			'show_in_library' => true,
		] );

		$repeater->add_control( 'template_id', [
			'label'        => esc_html__( 'Choose Template', 'billey' ),
			'type'         => QueryControlModule::QUERY_CONTROL_ID,
			'label_block'  => true,
			'autocomplete' => [
				'object' => QueryControlModule::QUERY_OBJECT_LIBRARY_TEMPLATE,
				'query'  => [
					'meta_query' => [
						[
							'key'     => Document::TYPE_META_KEY,
							'value'   => array_keys( $document_types ),
							'compare' => 'IN',
						],
					],
				],
			],
			'condition'    => [
				'content_type' => 'template',
			],
		] );

		$this->add_control( 'items', [
			'label'       => esc_html__( 'Items', 'billey' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'title'   => esc_html__( 'Tab Title #1', 'billey' ),
					'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'billey' ),
				],
				[
					'title'   => esc_html__( 'Tab Title #2', 'billey' ),
					'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'billey' ),
				],
				[
					'title'   => esc_html__( 'Tab Title #3', 'billey' ),
					'content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'billey' ),
				],
			],
			'title_field' => '{{{ title }}}',
		] );

		$this->add_control( 'view', [
			'label'   => esc_html__( 'View', 'billey' ),
			'type'    => Controls_Manager::HIDDEN,
			'default' => 'traditional',
		] );

		$this->add_control( 'type', [
			'label'        => esc_html__( 'Type', 'billey' ),
			'type'         => Controls_Manager::SELECT,
			'default'      => 'horizontal',
			'options'      => [
				'horizontal' => esc_html__( 'Horizontal', 'billey' ),
				'vertical'   => esc_html__( 'Vertical', 'billey' ),
			],
			'prefix_class' => 'billey-tabs-view-',
			'separator'    => 'before',
		] );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Do nothing if there is not any items.
		if ( empty( $settings['items'] ) || count( $settings['items'] ) <= 0 ) {
			return;
		}

		$tabs = $settings['items'];
		$this->add_render_attribute( 'wrapper', 'class', 'billey-tabs' );
		$this->add_render_attribute( 'wrapper', 'role', 'tablist' );
		$id_int = substr( $this->get_id_int(), 0, 3 );
		?>
		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<div class="billey-tabs-wrapper">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;

					$tab_title_setting_key = $this->get_repeater_setting_key( 'title', 'items', $index );

					$this->add_render_attribute( $tab_title_setting_key, [
						'id'            => 'billey-tab-title-' . $id_int . $tab_count,
						'class'         => [ 'billey-tab-title', 'billey-tab-desktop-title' ],
						'data-tab'      => $tab_count,
						'role'          => 'tab',
						'aria-controls' => 'billey-tab-content-' . $id_int . $tab_count,
					] );
					?>
					<div <?php $this->print_render_attribute_string( $tab_title_setting_key ); ?>><a
							href=""><?php echo esc_html( $item['title'] ); ?></a></div>
				<?php endforeach; ?>
			</div>

			<div class="billey-tabs-content-wrapper">
				<?php
				foreach ( $tabs as $index => $item ) :
					$tab_count = $index + 1;

					$tab_content_setting_key = $this->get_repeater_setting_key( 'content', 'items', $index );

					$tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'title_mobile', 'items', $tab_count );

					$this->add_render_attribute( $tab_content_setting_key, [
						'id'              => 'billey-tab-content-' . $id_int . $tab_count,
						'class'           => [ 'billey-tab-content', 'billey-clearfix' ],
						'data-tab'        => $tab_count,
						'role'            => 'tabpanel',
						'aria-labelledby' => 'billey-tab-title-' . $id_int . $tab_count,
					] );

					$this->add_render_attribute( $tab_title_mobile_setting_key, [
						'class'    => [ 'billey-tab-title', 'billey-tab-mobile-title' ],
						'data-tab' => $tab_count,
						'role'     => 'tab',
					] );

					if ( 'content' === $item['content_type'] ) {
						$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
					}
					?>
					<div <?php $this->print_render_attribute_string( $tab_title_mobile_setting_key ); ?>><?php echo esc_html( $item['title'] ); ?></div>

					<div <?php $this->print_render_attribute_string( $tab_content_setting_key ); ?>>
						<?php if ( 'template' === $item['content_type'] ): ?>
							<?php
							if ( ! empty( $item['template_id'] ) ) {
								echo \ElementorPro\Plugin::elementor()->frontend->get_builder_content_for_display( $item['template_id'] );
							}
							?>
						<?php else: ?>
							<?php echo '' . $this->parse_text_editor( $item['content'] ); ?>
						<?php endif; ?>
					</div>

				<?php endforeach; ?>
			</div>

		</div>
		<?php
	}
}
