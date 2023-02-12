<?php
/**
 * Define constant
 */
$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
	$theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
	define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'BILLEY_THEME_NAME', $theme['Name'] );
define( 'BILLEY_THEME_VERSION', $theme['Version'] );
define( 'BILLEY_THEME_DIR', get_template_directory() );
define( 'BILLEY_THEME_URI', get_template_directory_uri() );
define( 'BILLEY_THEME_ASSETS_URI', get_template_directory_uri() . '/assets' );
define( 'BILLEY_THEME_IMAGE_URI', BILLEY_THEME_ASSETS_URI . '/images' );
define( 'BILLEY_FRAMEWORK_DIR', get_template_directory() . DS . 'framework' );
define( 'BILLEY_CUSTOMIZER_DIR', BILLEY_THEME_DIR . DS . 'customizer' );
define( 'BILLEY_PROTOCOL', is_ssl() ? 'https' : 'http' );

define( 'BILLEY_ELEMENTOR_DIR', get_template_directory() . DS . 'elementor' );
define( 'BILLEY_ELEMENTOR_URI', get_template_directory_uri() . '/elementor' );
define( 'BILLEY_ELEMENTOR_ASSETS', get_template_directory_uri() . '/elementor/assets' );

/**
 * Load Framework.
 */
require_once BILLEY_FRAMEWORK_DIR . '/class-debug.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-aqua-resizer.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-performance.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-kses-allowed-html.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-static.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-init.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-helper.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-functions.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-global.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-actions-filters.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-notices.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-admin.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-compatible.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-customize.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-nav-menu.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-enqueue.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-image.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-minify.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-color.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-import.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-kirki.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-metabox.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-plugins.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-custom-css.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-templates.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-walker-nav-menu.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-widgets.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-header.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-footer.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-post-type.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-post-type-blog.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-post-type-portfolio.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-woo.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-booking-search-box.php';
require_once BILLEY_FRAMEWORK_DIR . '/tgm-plugin-activation.php';
require_once BILLEY_FRAMEWORK_DIR . '/tgm-plugin-registration.php';
require_once BILLEY_FRAMEWORK_DIR . '/class-tha.php';

require_once BILLEY_ELEMENTOR_DIR . '/class-entry.php';

/**
 * Init the theme
 */
Billey_Init::instance()->initialize();
