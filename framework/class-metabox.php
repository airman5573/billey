<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Billey_Metabox' ) ) {
	class Billey_Metabox {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			add_filter( 'insight_core_meta_boxes', array( $this, 'register_meta_boxes' ) );
		}

		/**
		 * Register Metabox
		 *
		 * @param $meta_boxes
		 *
		 * @return array
		 */
		public function register_meta_boxes( $meta_boxes ) {
			$page_registered_sidebars = Billey_Helper::get_registered_sidebars( true );

			$general_options = array(
				array(
					'title'  => esc_attr__( 'Layout', 'billey' ),
					'fields' => array(
						array(
							'id'      => 'site_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'billey' ),
							'desc'    => esc_html__( 'Controls the layout of this page.', 'billey' ),
							'options' => array(
								''      => esc_attr__( 'Default', 'billey' ),
								'boxed' => esc_attr__( 'Boxed', 'billey' ),
								'wide'  => esc_attr__( 'Wide', 'billey' ),
							),
							'default' => '',
						),
						array(
							'id'    => 'site_width',
							'type'  => 'text',
							'title' => esc_html__( 'Site Width', 'billey' ),
							'desc'  => esc_html__( 'Controls the site width for this page. Enter value including any valid CSS unit. For e.g: 1200px. Leave blank to use global setting.', 'billey' ),
						),
						array(
							'id'    => 'site_top_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Site Top Spacing', 'billey' ),
							'desc'  => esc_html__( 'Controls the top spacing of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'billey' ),
						),
						array(
							'id'    => 'site_bottom_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Site Bottom Spacing', 'billey' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'billey' ),
						),
						array(
							'id'    => 'site_class',
							'type'  => 'text',
							'title' => esc_html__( 'Body Class', 'billey' ),
							'desc'  => esc_html__( 'Add a class name to body then refer to it in custom CSS.', 'billey' ),
						),
					),
				),
				array(
					'title'  => esc_attr__( 'Background', 'billey' ),
					'fields' => array(
						array(
							'id'      => 'site_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'billey' ),
							'message' => esc_html__( 'These options controls the background on boxed mode.', 'billey' ),
						),
						array(
							'id'    => 'site_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'billey' ),
							'desc'  => esc_html__( 'Controls the background color of the outer background area in boxed mode of this page.', 'billey' ),
						),
						array(
							'id'    => 'site_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'billey' ),
							'desc'  => esc_html__( 'Controls the background image of the outer background area in boxed mode of this page.', 'billey' ),
						),
						array(
							'id'      => 'site_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'billey' ),
							'desc'    => esc_html__( 'Controls the background repeat of the outer background area in boxed mode of this page.', 'billey' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'billey' ),
								'repeat'    => esc_attr__( 'Repeat', 'billey' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'billey' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'billey' ),
							),
						),
						array(
							'id'      => 'site_background_attachment',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Attachment', 'billey' ),
							'desc'    => esc_html__( 'Controls the background attachment of the outer background area in boxed mode of this page.', 'billey' ),
							'options' => array(
								''       => esc_attr__( 'Default', 'billey' ),
								'fixed'  => esc_attr__( 'Fixed', 'billey' ),
								'scroll' => esc_attr__( 'Scroll', 'billey' ),
							),
						),
						array(
							'id'    => 'site_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'billey' ),
							'desc'  => esc_html__( 'Controls the background position of the outer background area in boxed mode of this page.', 'billey' ),
						),
						array(
							'id'    => 'site_background_size',
							'type'  => 'text',
							'title' => esc_html__( 'Background Size', 'billey' ),
							'desc'  => esc_html__( 'Controls the background size of the outer background area in boxed mode of this page.', 'billey' ),
						),
						array(
							'id'      => 'content_background_message',
							'type'    => 'message',
							'title'   => esc_html__( 'Info', 'billey' ),
							'message' => esc_html__( 'These options controls the background of main content on this page.', 'billey' ),
						),
						array(
							'id'    => 'content_background_color',
							'type'  => 'color',
							'title' => esc_html__( 'Background Color', 'billey' ),
							'desc'  => esc_html__( 'Controls the background color of main content on this page.', 'billey' ),
						),
						array(
							'id'    => 'content_background_image',
							'type'  => 'media',
							'title' => esc_html__( 'Background Image', 'billey' ),
							'desc'  => esc_html__( 'Controls the background image of main content on this page.', 'billey' ),
						),
						array(
							'id'      => 'content_background_repeat',
							'type'    => 'select',
							'title'   => esc_html__( 'Background Repeat', 'billey' ),
							'desc'    => esc_html__( 'Controls the background repeat of main content on this page.', 'billey' ),
							'options' => array(
								'no-repeat' => esc_attr__( 'No repeat', 'billey' ),
								'repeat'    => esc_attr__( 'Repeat', 'billey' ),
								'repeat-x'  => esc_attr__( 'Repeat X', 'billey' ),
								'repeat-y'  => esc_attr__( 'Repeat Y', 'billey' ),
							),
						),
						array(
							'id'    => 'content_background_position',
							'type'  => 'text',
							'title' => esc_html__( 'Background Position', 'billey' ),
							'desc'  => esc_html__( 'Controls the background position of main content on this page.', 'billey' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Header', 'billey' ),
					'fields' => array(
						array(
							'id'      => 'top_bar_type',
							'type'    => 'select',
							'title'   => esc_html__( 'Top Bar Type', 'billey' ),
							'desc'    => esc_html__( 'Select top bar type that displays on this page.', 'billey' ),
							'default' => '',
							'options' => Billey_Helper::get_top_bar_list( true ),
						),
						array(
							'id'      => 'header_type',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Type', 'billey' ),
							'desc'    => wp_kses(
								sprintf(
									__( 'Select header type that displays on this page. When you choose Default, the value in %s will be used.', 'billey' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=header' ) . '">Customize</a>'
								), 'billey-a' ),
							'default' => '',
							'options' => Billey_Header::instance()->get_list( true ),
						),
						array(
							'id'      => 'header_overlay',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Overlay', 'billey' ),
							'default' => '',
							'options' => array(
								''  => esc_html__( 'Default', 'billey' ),
								'0' => esc_html__( 'No', 'billey' ),
								'1' => esc_html__( 'Yes', 'billey' ),
							),
						),
						array(
							'id'      => 'header_skin',
							'type'    => 'select',
							'title'   => esc_attr__( 'Header Skin', 'billey' ),
							'default' => '',
							'options' => array(
								''      => esc_html__( 'Default', 'billey' ),
								'dark'  => esc_html__( 'Dark', 'billey' ),
								'light' => esc_html__( 'Light', 'billey' ),
							),
						),
						array(
							'id'      => 'menu_display',
							'type'    => 'select',
							'title'   => esc_html__( 'Primary menu', 'billey' ),
							'desc'    => esc_html__( 'Select which menu displays on this page.', 'billey' ),
							'default' => '',
							'options' => Billey_Nav_Menu::get_all_menus(),
						),
						array(
							'id'      => 'menu_one_page',
							'type'    => 'switch',
							'title'   => esc_attr__( 'One Page Menu', 'billey' ),
							'default' => '0',
							'options' => array(
								'0' => esc_attr__( 'Disable', 'billey' ),
								'1' => esc_attr__( 'Enable', 'billey' ),
							),
						),
						array(
							'id'      => 'custom_dark_logo',
							'type'    => 'media',
							'title'   => esc_html__( 'Custom Dark Logo', 'billey' ),
							'desc'    => esc_html__( 'Select custom dark logo for this page.', 'billey' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_light_logo',
							'type'    => 'media',
							'title'   => esc_html__( 'Custom Light Logo', 'billey' ),
							'desc'    => esc_html__( 'Select custom light logo for this page.', 'billey' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Logo Width', 'billey' ),
							'desc'    => esc_html__( 'Controls the width of logo. For e.g: 150px', 'billey' ),
							'default' => '',
						),
						array(
							'id'      => 'custom_sticky_logo_width',
							'type'    => 'text',
							'title'   => esc_html__( 'Custom Sticky Logo Width', 'billey' ),
							'desc'    => esc_html__( 'Controls the width of sticky logo. For e.g: 150px', 'billey' ),
							'default' => '',
						),
					),
				),
				array(
					'title'  => esc_html__( 'Page Title Bar', 'billey' ),
					'fields' => array(
						array(
							'id'      => 'page_title_bar_layout',
							'type'    => 'select',
							'title'   => esc_html__( 'Layout', 'billey' ),
							'default' => '',
							'options' => Billey_Helper::get_title_bar_list( true ),
						),
						array(
							'id'    => 'page_title_bar_bottom_spacing',
							'type'  => 'text',
							'title' => esc_html__( 'Spacing', 'billey' ),
							'desc'  => esc_html__( 'Controls the bottom spacing of title bar of this page. Enter value including any valid CSS unit. For e.g: 50px. Leave blank to use global setting.', 'billey' ),
						),
						array(
							'id'      => 'page_title_bar_background_color',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Color', 'billey' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background',
							'type'    => 'media',
							'title'   => esc_html__( 'Background Image', 'billey' ),
							'default' => '',
						),
						array(
							'id'      => 'page_title_bar_background_overlay',
							'type'    => 'color',
							'title'   => esc_html__( 'Background Overlay', 'billey' ),
							'default' => '',
						),
						array(
							'id'    => 'page_title_bar_custom_heading',
							'type'  => 'text',
							'title' => esc_html__( 'Custom Heading Text', 'billey' ),
							'desc'  => esc_html__( 'Insert custom heading for the page title bar. Leave blank to use default.', 'billey' ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sidebars', 'billey' ),
					'fields' => array(
						array(
							'id'      => 'page_sidebar_1',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 1', 'billey' ),
							'desc'    => esc_html__( 'Select sidebar 1 that will display on this page.', 'billey' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_2',
							'type'    => 'select',
							'title'   => esc_html__( 'Sidebar 2', 'billey' ),
							'desc'    => esc_html__( 'Select sidebar 2 that will display on this page.', 'billey' ),
							'default' => 'default',
							'options' => $page_registered_sidebars,
						),
						array(
							'id'      => 'page_sidebar_position',
							'type'    => 'switch',
							'title'   => esc_html__( 'Sidebar Position', 'billey' ),
							'desc'    => wp_kses(
								sprintf(
									__( 'Select position of Sidebar 1 for this page. If sidebar 2 is selected, it will display on the opposite side. If you set as "Default" then the value in %s will be used.', 'billey' ),
									'<a href="' . admin_url( '/customize.php?autofocus[section]=sidebars' ) . '">Customize -> Sidebar</a>'
								), 'billey-a' ),
							'default' => 'default',
							'options' => Billey_Helper::get_list_sidebar_positions( true ),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Sliders', 'billey' ),
					'fields' => array(
						array(
							'id'      => 'revolution_slider',
							'type'    => 'select',
							'title'   => esc_html__( 'Revolution Slider', 'billey' ),
							'desc'    => esc_html__( 'Select the unique name of the slider.', 'billey' ),
							'options' => Billey_Helper::get_list_revslider(),
						),
						array(
							'id'      => 'slider_position',
							'type'    => 'select',
							'title'   => esc_html__( 'Slider Position', 'billey' ),
							'default' => 'below',
							'options' => array(
								'above' => esc_attr__( 'Above Header', 'billey' ),
								'below' => esc_attr__( 'Below Header', 'billey' ),
							),
						),
					),
				),
				array(
					'title'  => esc_html__( 'Footer', 'billey' ),
					'fields' => array(
						array(
							'id'      => 'footer_enable',
							'type'    => 'select',
							'title'   => esc_html__( 'Footer Enable', 'billey' ),
							'default' => '',
							'options' => array(
								''     => esc_html__( 'Yes', 'billey' ),
								'none' => esc_html__( 'No', 'billey' ),
							),
						),
					),
				),
			);

			// Page
			$meta_boxes[] = array(
				'id'         => 'insight_elementor_library_options',
				'title'      => esc_html__( 'Page Options', 'billey' ),
				'post_types' => array( 'elementor_library' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			// Page
			$meta_boxes[] = array(
				'id'         => 'insight_page_options',
				'title'      => esc_html__( 'Page Options', 'billey' ),
				'post_types' => array( 'page' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => $general_options,
					),
				),
			);

			// Post
			$meta_boxes[] = array(
				'id'         => 'insight_post_options',
				'title'      => esc_html__( 'Page Options', 'billey' ),
				'post_types' => array( 'post' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Post', 'billey' ),
								'fields' => array(
									array(
										'id'      => 'single_post_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Single Blog Style', 'billey' ),
										'desc'    => esc_html__( 'Select layout for details page of this post.', 'billey' ),
										'options' => array(
											''         => esc_attr__( 'Default', 'billey' ),
											'standard' => esc_attr__( 'Standard', 'billey' ),
											'modern'   => esc_attr__( 'Modern', 'billey' ),
										),
										'default' => '',
									),
									array(
										'id'    => 'post_gallery',
										'type'  => 'gallery',
										'title' => esc_html__( 'Gallery Format', 'billey' ),
									),
									array(
										'id'    => 'post_video',
										'type'  => 'text',
										'title' => esc_html__( 'Video URL', 'billey' ),
										'desc'  => esc_html__( 'Input the url of video vimeo or youtube. For e.g: https://www.youtube.com/watch?v=9No-FiEInLA', 'billey' ),
									),
									array(
										'id'    => 'post_audio',
										'type'  => 'textarea',
										'title' => esc_html__( 'Audio Format', 'billey' ),
									),
									array(
										'id'    => 'post_quote_text',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Text', 'billey' ),
									),
									array(
										'id'    => 'post_quote_name',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Name', 'billey' ),
									),
									array(
										'id'    => 'post_quote_url',
										'type'  => 'text',
										'title' => esc_html__( 'Quote Format - Source Url', 'billey' ),
									),
									array(
										'id'    => 'post_link',
										'type'  => 'text',
										'title' => esc_html__( 'Link Format', 'billey' ),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			// Product
			$meta_boxes[] = array(
				'id'         => 'insight_product_options',
				'title'      => esc_html__( 'Page Options', 'billey' ),
				'post_types' => array( 'product' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Product', 'billey' ),
								'fields' => array(
									array(
										'id'      => 'single_product_layout_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Single Product Style', 'billey' ),
										'desc'    => esc_html__( 'Select style of this single product page.', 'billey' ),
										'default' => '',
										'options' => array(
											''       => esc_html__( 'Default', 'billey' ),
											'list'   => esc_html__( 'List', 'billey' ),
											'slider' => esc_html__( 'Slider', 'billey' ),
										),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			// Portfolio
			$meta_boxes[] = array(
				'id'         => 'insight_portfolio_options',
				'title'      => esc_html__( 'Page Options', 'billey' ),
				'post_types' => array( 'portfolio' ),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields'     => array(
					array(
						'type'  => 'tabpanel',
						'items' => array_merge( array(
							array(
								'title'  => esc_html__( 'Portfolio', 'billey' ),
								'fields' => array(
									array(
										'id'      => 'portfolio_site_skin',
										'type'    => 'select',
										'title'   => esc_html__( 'Site Skin', 'billey' ),
										'desc'    => esc_html__( 'Select skin of this single portfolio page.', 'billey' ),
										'default' => '',
										'options' => array(
											''      => esc_html__( 'Default', 'billey' ),
											'dark'  => esc_html__( 'Dark', 'billey' ),
											'light' => esc_html__( 'Light', 'billey' ),
										),
									),
									array(
										'id'      => 'portfolio_layout_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Single Portfolio Style', 'billey' ),
										'desc'    => esc_html__( 'Select style of this single portfolio page.', 'billey' ),
										'default' => '',
										'options' => array(
											''                => esc_html__( 'Default', 'billey' ),
											'blank'           => esc_html__( 'Blank (Build with Elementor)', 'billey' ),
											'image-list'      => esc_html__( 'Image List', 'billey' ),
											'image-list-wide' => esc_html__( 'Image List - Wide', 'billey' ),
										),
									),
									array(
										'id'      => 'portfolio_pagination_style',
										'type'    => 'select',
										'title'   => esc_html__( 'Pagination Style', 'billey' ),
										'desc'    => esc_html__( 'Select style of pagination for this single portfolio page.', 'billey' ),
										'default' => '',
										'options' => array(
											''     => esc_html__( 'Default', 'billey' ),
											'none' => esc_html__( 'None', 'billey' ),
											'01'   => esc_html__( '01', 'billey' ),
											'02'   => esc_html__( '02', 'billey' ),
											'03'   => esc_html__( '03', 'billey' ),
										),
									),
									array(
										'id'    => 'portfolio_gallery',
										'type'  => 'gallery',
										'title' => esc_html__( 'Gallery', 'billey' ),
									),
									array(
										'id'    => 'portfolio_video_url',
										'type'  => 'text',
										'title' => esc_html__( 'Video URL', 'billey' ),
										'desc'  => esc_html__( 'Input the url of video vimeo or youtube. For e.g: https://www.youtube.com/watch?v=9No-FiEInLA', 'billey' ),
									),
									array(
										'id'    => 'portfolio_client',
										'type'  => 'text',
										'title' => esc_html__( 'Client', 'billey' ),
									),
									array(
										'id'    => 'portfolio_date',
										'type'  => 'text',
										'title' => esc_html__( 'Date', 'billey' ),
									),
									array(
										'id'    => 'portfolio_url',
										'type'  => 'text',
										'title' => esc_html__( 'Url', 'billey' ),
									),
									array(
										'id'      => 'portfolio_overlay_colored_faded_message',
										'type'    => 'message',
										'title'   => esc_html__( 'Info', 'billey' ),
										'message' => esc_html__( 'These settings for Overlay Colored Faded Style.', 'billey' ),
									),
									array(
										'id'    => 'portfolio_overlay_colored_faded_background',
										'type'  => 'color',
										'title' => esc_html__( 'Background Color', 'billey' ),
										'desc'  => esc_html__( 'Controls the background color of overlay colored faded style.', 'billey' ),
									),
									array(
										'id'      => 'portfolio_overlay_colored_faded_text_skin',
										'type'    => 'select',
										'title'   => esc_html__( 'Text Skin', 'billey' ),
										'desc'    => esc_html__( 'Controls the text skin of overlay colored faded style.', 'billey' ),
										'default' => 'light',
										'options' => array(
											'dark'  => esc_html__( 'Dark', 'billey' ),
											'light' => esc_html__( 'Light', 'billey' ),
										),
									),
								),
							),
						), $general_options ),
					),
				),
			);

			return $meta_boxes;
		}

	}

	Billey_Metabox::instance()->initialize();
}
