<?php
defined( 'ABSPATH' ) || exit;

class Billey {

	const PRIMARY_FONT     = 'Satoshi, sans-serif';
	const SECONDARY_FONT   = 'Futura, sans-serif';
	const PRIMARY_COLOR    = '#5758e0';
	const SECONDARY_COLOR  = '#f77991';
	const GRADIENT_COLOR_1 = '#5758df';
	const GRADIENT_COLOR_2 = '#f77991';
	const HEADING_COLOR    = '#111';
	const TEXT_COLOR       = '#888';

	public static function is_tablet() {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return false;
		}

		return Mobile_Detect::instance()->isTablet();
	}

	public static function is_mobile() {
		if ( ! class_exists( 'Mobile_Detect' ) ) {
			return false;
		}

		if ( self::is_tablet() ) {
			return false;
		}

		return Mobile_Detect::instance()->isMobile();
	}

	public static function is_handheld() {
		return ( self::is_mobile() || self::is_tablet() );
	}

	public static function is_desktop() {
		return ! self::is_handheld();
	}

	/**
	 * Get settings for Kirki
	 *
	 * @param string $option_name
	 * @param string $default
	 *
	 * @return mixed
	 */
	public static function setting( $option_name = '', $default = '' ) {
		$value = Billey_Kirki::get_option( 'theme', $option_name );

		$value = $value === null ? $default : $value;

		return $value;
	}

	/**
	 * Primary Menu
	 */
	public static function menu_primary( $args = array() ) {
		$defaults = array(
			'theme_location' => 'primary',
			'container'      => 'ul',
			'menu_class'     => 'menu__container sm sm-simple',
			'menu_id'        => 'menu-primary',
		);
		$args     = wp_parse_args( $args, $defaults );

		if ( has_nav_menu( 'primary' ) && class_exists( 'Billey_Walker_Nav_Menu' ) ) {
			$args['walker'] = new Billey_Walker_Nav_Menu;
		}

		$menu = Billey_Helper::get_post_meta( 'menu_display', '' );

		if ( $menu !== '' ) {
			$args['menu'] = $menu;
		}

		global $billey_primary_menu;

		ob_start();

		wp_nav_menu( $args );

		$billey_primary_menu = ob_get_clean();

		echo '' . $billey_primary_menu;
	}

	/**
	 * Off Canvas Menu
	 */
	public static function off_canvas_menu_primary() {
		self::menu_primary( array(
			'menu_class' => 'menu__container',
			'menu_id'    => 'off-canvas-menu-primary',
		) );
	}

	/**
	 * Mobile Menu
	 */
	public static function menu_mobile_primary() {
		global $billey_primary_menu;

		$mobile_menu = str_replace( '<ul id="menu-primary" class="menu__container sm sm-simple">', '<ul id="mobile-menu-primary" class="menu__container">', $billey_primary_menu );
		$mobile_menu = str_replace( '<ul id="off-canvas-menu-primary" class="menu__container">', '<ul id="mobile-menu-primary" class="menu__container">', $mobile_menu );

		echo '' . $mobile_menu;
		unset( $GLOBALS['billey_primary_menu'] );
	}

	/**
	 * Logo
	 */
	public static function branding_logo() {
		$logo_dark_url  = Billey_Helper::get_post_meta( 'custom_dark_logo', '' );
		$logo_light_url = Billey_Helper::get_post_meta( 'custom_light_logo', '' );

		$logo_width  = Billey::setting( 'logo_width' );
		$sticky_logo = Billey::setting( 'header_sticky_logo' );
		$header_logo = Billey_Global::instance()->get_header_skin();

		if ( '' === $logo_dark_url ) {
			$logo_dark = Billey::setting( 'logo_dark' );

			if ( isset( $logo_dark['id'] ) ) {
				$logo_dark_url = Billey_Image::get_attachment_url_by_id( array(
					'id'   => $logo_dark['id'],
					'size' => "{$logo_width}x9999",
					'crop' => false,
				) );
			} else {
				$logo_dark_url = $logo_dark['url'];
			}
		}

		if ( '' === $logo_light_url ) {
			$logo_light = Billey::setting( 'logo_light' );

			if ( isset( $logo_light['id'] ) ) {
				$logo_light_url = Billey_Image::get_attachment_url_by_id( array(
					'id'   => $logo_light['id'],
					'size' => "{$logo_width}x9999",
					'crop' => false,
				) );
			} else {
				$logo_light_url = $logo_light['url'];
			}
		}

		$has_both_logo = true;

		$alt = get_bloginfo( 'name', 'display' );
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( $has_both_logo === false && $header_logo === $sticky_logo ) : ?>
				<?php if ( $header_logo === 'dark' ): ?>
					<img src="<?php echo esc_url( $logo_dark_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>"
					     class="dark-logo">
				<?php else: ?>
					<img src="<?php echo esc_url( $logo_light_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>"
					     class="light-logo">
				<?php endif; ?>
			<?php else: ?>
				<img src="<?php echo esc_url( $logo_light_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>"
				     class="light-logo">
				<img src="<?php echo esc_url( $logo_dark_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>"
				     class="dark-logo">
			<?php endif; ?>
		</a>
		<?php
	}

	/**
	 * Adds custom attributes to the body tag.
	 */
	public static function body_attributes() {
		$attrs = apply_filters( 'billey_body_attributes', array() );

		$attrs_string = '';
		if ( ! empty( $attrs ) ) {
			foreach ( $attrs as $attr => $value ) {
				$attrs_string .= " {$attr}=" . '"' . esc_attr( $value ) . '"';
			}
		}

		echo '' . $attrs_string;
	}

	/**
	 * Adds custom classes to the header.
	 *
	 * @param string $class extra class
	 */
	public static function top_bar_class( $class = '' ) {
		$classes = array( 'page-top-bar' );

		$type = Billey_Global::instance()->get_top_bar_type();

		$classes[] = "top-bar-{$type}";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'billey_top_bar_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the header.
	 */
	public static function title_bar_class( $class = '' ) {
		$classes = array( 'page-title-bar' );

		$type = Billey_Global::instance()->get_title_bar_type();

		$classes[] = "page-title-bar-{$type}";

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'billey_title_bar_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the branding.
	 */
	public static function branding_class( $class = '' ) {
		$classes = array( 'branding' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'billey_branding_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the navigation.
	 */
	public static function navigation_class( $class = '' ) {
		$classes = array( 'navigation page-navigation' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'billey_navigation_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}
}
