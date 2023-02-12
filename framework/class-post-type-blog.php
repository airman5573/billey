<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Billey_Post' ) ) {
	class Billey_Post extends Billey_Post_Type {

		protected static $instance  = null;
		protected static $post_type = 'post';

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			add_action( 'wp_ajax_post_infinite_load', array( $this, 'infinite_load' ) );
			add_action( 'wp_ajax_nopriv_post_infinite_load', array( $this, 'infinite_load' ) );

			add_filter( 'post_class', array( $this, 'post_class' ) );
		}

		function post_class( $classes ) {
			if ( ! has_post_thumbnail() ) {
				$classes[] = 'post-no-thumbnail';
			}

			return $classes;
		}

		function infinite_load() {
			$source     = isset( $_POST['source'] ) ? $_POST['source'] : '';
			$query_vars = $_POST['query_vars'];

			if ( 'custom_query' === $source ) {
				$query_vars = $this->build_extra_terms_query( $query_vars, $query_vars['extra_tax_query'] );
			}

			$billey_query = new WP_Query( $query_vars );

			$settings = isset( $_POST['settings'] ) ? $_POST['settings'] : array();

			$response = array(
				'max_num_pages' => $billey_query->max_num_pages,
				'found_posts'   => $billey_query->found_posts,
				'count'         => $billey_query->post_count,
			);

			ob_start();

			if ( $billey_query->have_posts() ) :
				set_query_var( 'billey_query', $billey_query );
				set_query_var( 'settings', $settings );

				get_template_part( 'loop/widgets/blog/style', $settings['layout'] );

				wp_reset_postdata();
			endif;

			$template = ob_get_contents();
			ob_clean();

			$response['template'] = $template;

			echo json_encode( $response );

			wp_die();
		}

		function get_related_posts( $args ) {
			$defaults = array(
				'post_id'      => '',
				'number_posts' => 3,
			);
			$args     = wp_parse_args( $args, $defaults );
			if ( $args['number_posts'] <= 0 || $args['post_id'] === '' ) {
				return false;
			}

			$categories = get_the_category( $args['post_id'] );

			if ( ! $categories ) {
				return false;
			}

			foreach ( $categories as $category ) {
				if ( $category->parent === 0 ) {
					$term_ids[] = $category->term_id;
				} else {
					$term_ids[] = $category->parent;
					$term_ids[] = $category->term_id;
				}
			}

			// Remove duplicate values from the array.
			$unique_array = array_unique( $term_ids );

			$query_args = array(
				'post_type'      => self::$post_type,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'posts_per_page' => $args['number_posts'],
				'post__not_in'   => array( $args['post_id'] ),
				'no_found_rows'  => true,
				'tax_query'      => array(
					array(
						'taxonomy'         => 'category',
						'terms'            => $unique_array,
						'include_children' => false,
					),
				),
			);

			$query = new WP_Query( $query_args );

			wp_reset_postdata();

			return $query;
		}

		function get_the_post_meta( $name = '', $default = '' ) {
			$post_meta = get_post_meta( get_the_ID(), 'insight_post_options', true );

			if ( ! empty( $post_meta ) ) {
				$post_options = maybe_unserialize( $post_meta );

				if ( $post_options !== false && isset( $post_options[ $name ] ) ) {
					return $post_options[ $name ];
				}
			}

			return $default;
		}

		function get_the_post_format() {
			$format = '';
			if ( get_post_format() !== false ) {
				$format = get_post_format();
			}

			return $format;
		}

		function the_categories( $args = array() ) {
			if ( ! has_category() ) {
				return;
			}

			$defaults = array(
				'classes'    => 'post-categories',
				'separator'  => ', ',
				'show_links' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<div class="<?php echo esc_attr( $args['classes'] ); ?>">

				<?php if ( $args['show_links'] ) : ?>
					<?php the_category( $args['separator'] ); ?>
				<?php else: ?>
					<?php
					$categories = get_the_category();
					$loop_count = 0;
					foreach ( $categories as $category ) {
						if ( $loop_count > 0 ) {
							echo "{$args['separator']}<span>{$category->name}</span>";
						} else {
							echo "<span>{$category->name}</span>";
						}

						$loop_count++;
					}
					?>

				<?php endif; ?>
			</div>
			<?php
		}

		/**
		 * @param array $args
		 *
		 * Render first category template of the post.
		 */
		function the_category( $args = array() ) {
			if ( ! has_category() ) {
				return;
			}

			$defaults = array(
				'classes'    => 'post-categories',
				'show_links' => true,
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<div class="<?php echo esc_attr( $args['classes'] ); ?>">
				<?php
				$categories = get_the_category();
				$category   = $categories[0];

				if ( $args['show_links'] ) {
					$link = get_term_link( $category );
					printf( '<a href="%1$s" rel="category tag"><span>%2$s</span></a>', $link, $category->name );
				} else {
					echo "<span>{$category->name}</span>";
				}
				?>
			</div>
			<?php
		}

		function nav_page_links() {
			$args = array(
				'prev_text'          => '%title',
				'next_text'          => '%title',
				'in_same_term'       => false,
				'excluded_terms'     => '',
				'taxonomy'           => 'category',
				'screen_reader_text' => esc_html__( 'Post navigation', 'billey' ),
			);

			$previous = get_previous_post_link( '%link', $args['prev_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy'] );
			$previous = str_replace( 'rel="prev">', 'rel="prev">' . '<div><span class="fa fa-arrow-left"></span>' . esc_html__( 'Prev', 'billey' ) . '</div>', $previous );

			$next = get_next_post_link( '%link', $args['next_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy'] );
			$next = str_replace( 'rel="next">', 'rel="next">' . '<div>' . esc_html__( 'Next', 'billey' ) . '<span class="fa fa-arrow-right"></span></div>', $next );

			// Only add markup if there's somewhere to navigate to.
			if ( $previous || $next ) { ?>

				<nav class="navigation post-navigation" role="navigation">
					<?php echo '<h2 class="screen-reader-text">' . $args['screen_reader_text'] . '</h2>'; ?>

					<div class="nav-links">
						<?php echo '<div class="previous nav-item">' . $previous . '</div>'; ?>

						<?php echo '<div class="next nav-item">' . $next . '</div>'; ?>
					</div>
				</nav>
				<?php
			}
		}

		function view_count() {
			if ( function_exists( 'the_views' ) ) : ?>
				<div class="post-view">
					<i class="meta-icon far fa-eye"></i>
					<?php the_views(); ?>
				</div>
			<?php
			endif;
		}

		function entry_feature() {
			if ( '1' !== Billey::setting( 'single_post_feature_enable' ) ) {
				return;
			}

			$post_format    = $this->get_the_post_format();
			$thumbnail_size = '770x510';

			$style = Billey_Helper::get_post_meta( 'single_post_style', '' );

			if ( empty( $style ) ) {
				$style = Billey::setting( 'single_post_style' );
			}

			$sidebar = Billey_Global::instance()->get_sidebar_status();

			if ( 'none' === $sidebar && 'modern' === $style ) {
				$thumbnail_size = '1170x600';
			}

			switch ( $post_format ) {
				case 'gallery':
					$this->entry_feature_gallery( $thumbnail_size );
					break;
				case 'audio':
					$this->entry_feature_audio();
					break;
				case 'video':
					$this->entry_feature_video( $thumbnail_size );
					break;
				case 'quote':
					$this->entry_feature_quote();
					break;
				case 'link':
					$this->entry_feature_link();
					break;
				default:
					$this->entry_feature_standard( $thumbnail_size );
					break;
			}
		}

		private function entry_feature_standard( $size ) {
			if ( ! has_post_thumbnail() ) {
				return;
			}
			?>
			<div class="entry-post-feature post-thumbnail">
				<?php Billey_Image::the_post_thumbnail( [ 'size' => $size, ] ); ?>
			</div>
			<?php
		}

		private function entry_feature_gallery( $size ) {
			$gallery = $this->get_the_post_meta( 'post_gallery' );
			if ( empty( $gallery ) ) {
				return;
			}
			?>
			<div class="entry-post-feature post-gallery tm-swiper tm-slider" data-nav="1" data-loop="1"
			     data-lg-gutter="30">
				<div class="swiper-inner">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php foreach ( $gallery as $image ) { ?>
								<div class="swiper-slide">
									<?php Billey_Image::the_attachment_by_id( array(
										'id'   => $image['id'],
										'size' => $size,
									) ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		private function entry_feature_audio() {
			$audio = Billey_Post::instance()->get_the_post_meta( 'post_audio' );
			if ( empty( $audio ) ) {
				return;
			}

			if ( strrpos( $audio, '.mp3' ) !== false ) {
				echo do_shortcode( '[audio mp3="' . $audio . '"][/audio]' );
			} else {
				?>
				<div class="entry-post-feature post-audio">
					<?php if ( wp_oembed_get( $audio ) ) { ?>
						<?php echo Billey_Helper::w3c_iframe( wp_oembed_get( $audio ) ); ?>
					<?php } ?>
				</div>
				<?php
			}
		}

		private function entry_feature_video( $size ) {
			$video = $this->get_the_post_meta( 'post_video' );
			if ( empty( $video ) ) {
				return;
			}
			?>
			<div class="entry-post-feature post-video tm-popup-video type-poster billey-animation-zoom-in">
				<a href="<?php echo esc_url( $video ); ?>" class="video-link billey-box link-secret">
					<div class="video-poster">
						<div class="billey-image">
							<?php if ( has_post_thumbnail() ) { ?>
								<?php Billey_Image::the_post_thumbnail( [ 'size' => $size, ] ); ?>
							<?php } ?>
						</div>
						<div class="video-overlay"></div>

						<div class="video-button">
							<div class="video-play video-play-icon">
								<span class="icon"></span>
							</div>
						</div>
					</div>
				</a>
			</div>
			<?php
		}

		private function entry_feature_quote() {
			$text = $this->get_the_post_meta( 'post_quote_text' );
			if ( empty( $text ) ) {
				return;
			}
			$name = $this->get_the_post_meta( 'post_quote_name' );
			$url  = $this->get_the_post_meta( 'post_quote_url' );
			?>
			<div class="entry-post-feature post-quote">
				<div class="post-quote-content">
					<span class="quote-icon fas fa-quote-right"></span>
					<h3 class="post-quote-text"><?php echo esc_html( '&ldquo;' . $text . '&rdquo;' ); ?></h3>
					<?php if ( ! empty( $name ) ) { ?>
						<?php $name = "- $name"; ?>
						<h6 class="post-quote-name">
							<?php if ( ! empty( $url ) ) { ?>
								<a href="<?php echo esc_url( $url ); ?>"
								   target="_blank"><?php echo esc_html( $name ); ?></a>
							<?php } else { ?>
								<?php echo esc_html( $name ); ?>
							<?php } ?>
						</h6>
					<?php } ?>
				</div>
			</div>
			<?php
		}

		private function entry_feature_link() {
			$link = $this->get_the_post_meta( 'post_link' );
			if ( empty( $link ) ) {
				return;
			}
			?>
			<div class="entry-post-feature post-link">
				<a href="<?php echo esc_url( $link ); ?>" target="_blank"><?php echo esc_html( $link ); ?></a>
			</div>
			<?php
		}

		function entry_share( $args = array() ) {
			$social_sharing = Billey::setting( 'social_sharing_item_enable' );
			if ( empty( $social_sharing ) ) {
				return;
			}
			?>
			<div class="entry-post-share post-share">
				<h6 class="share-label">
					<?php esc_html_e( 'Share:', 'billey' ); ?>
				</h6>
				<div class="share-list">
					<div class="inner">
						<?php Billey_Templates::get_sharing_list( $args ); ?>
					</div>
				</div>
			</div>
			<?php
		}

		function entry_nav_next_link() {
			next_post_link(
				'%link',
				'<div class="nav-desc">' . esc_html__( 'Next', 'billey' ) . '</div>
			<div class="nav-post-title">%title</div>
			<span class="nav-icon fa fa-arrow-right"></span>'
			);
		}
	}

	Billey_Post::instance()->initialize();
}
