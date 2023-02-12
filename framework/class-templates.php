<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom template tags for this theme.
 */
class Billey_Templates {

	public static function pre_loader() {
		if ( Billey::setting( 'pre_loader_enable' ) !== '1' ) {
			return;
		}

		// Don't render template in Elementor editor mode.
		if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			return;
		}

		$style = Billey::setting( 'pre_loader_style' );

		if ( $style === 'random' ) {
			$style = array_rand( Billey_Helper::$preloader_style );
		}
		?>

		<div id="page-preloader" class="page-loading clearfix">
			<div class="page-load-inner">
				<div class="preloader-wrap">
					<div class="wrap-2">
						<div class="inner">
							<?php get_template_part( 'template-parts/preloader/style', $style ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	public static function top_bar() {
		$type = Billey_Global::instance()->get_top_bar_type();

		if ( $type !== 'none' ) {
			get_template_part( 'template-parts/top-bar/top-bar', $type );
		}
	}

	public static function top_bar_button( $type = '01' ) {
		$button_text        = Billey::setting( "top_bar_style_{$type}_button_text" );
		$button_link        = Billey::setting( "top_bar_style_{$type}_button_link" );
		$button_link_target = Billey::setting( "top_bar_style_{$type}_button_link_target" );
		$button_classes     = 'top-bar-button';
		?>
		<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
			<a class="<?php echo esc_attr( $button_classes ); ?>"
			   href="<?php echo esc_url( $button_link ); ?>"
				<?php if ( $button_link_target === '1' ) : ?>
					target="_blank"
				<?php endif; ?>
			>
				<?php echo esc_html( $button_text ); ?>
			</a>
		<?php endif;
	}

	public static function top_bar_info() {
		$type = Billey_Global::instance()->get_top_bar_type();
		$info = Billey::setting( "top_bar_style_{$type}_info" );

		if ( ! empty( $info ) ) {
			?>
			<ul class="top-bar-info">
				<?php
				foreach ( $info as $item ) {
					$url  = isset( $item['url'] ) ? $item['url'] : '';
					$icon = isset( $item['icon_class'] ) ? $item['icon_class'] : '';
					$text = isset( $item['text'] ) ? $item['text'] : '';
					?>
					<li class="info-item">
						<?php if ( $url !== '' ) : ?>
						<a href="<?php echo esc_url( $url ); ?>" class="info-link">
							<?php endif; ?>

							<?php if ( $icon !== '' ) : ?>
								<i class="info-icon <?php echo esc_attr( $icon ); ?>"></i>
							<?php endif; ?>

							<?php echo '<span class="info-text">' . $text . '</span>'; ?>

							<?php if ( $url !== '' ) : ?>
						</a>
					<?php endif; ?>
					</li>
				<?php } ?>
			</ul>
			<?php
		}
	}

	public static function top_bar_language_switcher() {
		$type   = Billey_Global::instance()->get_top_bar_type();
		$enable = Billey::setting( "top_bar_style_{$type}_language_switcher_enable" );

		if ( $enable !== '1' ) {
			return;
		}
		?>
		<div id="switcher-language-wrapper" class="switcher-language-wrapper">
			<?php do_action( 'wpml_add_language_selector' ); ?>
		</div>
		<?php
	}

	public static function top_bar_social_networks() {
		$type   = Billey_Global::instance()->get_top_bar_type();
		$enable = Billey::setting( "top_bar_style_{$type}_social_networks_enable" );

		if ( $enable !== '1' ) {
			return;
		}
		?>
		<div class="top-bar-social-network">
			<?php Billey_Templates::social_icons( array(
				'display'        => 'icon',
				'tooltip_enable' => false,
			) ); ?>
		</div>
		<?php
	}

	public static function slider( $template_position ) {
		$slider          = Billey_Global::instance()->get_slider_alias();
		$slider_position = Billey_Global::instance()->get_slider_position();

		if ( ! function_exists( 'rev_slider_shortcode' ) || $slider === '' || $slider_position !== $template_position ) {
			return;
		}

		?>
		<div id="page-slider" class="page-slider">
			<?php echo do_shortcode( '[rev_slider ' . $slider . ']' ); ?>
		</div>
		<?php
	}

	public static function title_bar() {
		$type = Billey_Global::instance()->get_title_bar_type();

		if ( $type === 'none' ) {
			return;
		}

		get_template_part( 'template-parts/title-bar/title-bar', $type );
	}

	public static function get_title_bar_title() {
		$title = Billey_Helper::get_post_meta( 'page_title_bar_custom_heading', '' );

		if ( $title === '' ) {
			if ( Billey_Portfolio::instance()->is_archive() ) {
				$title = Billey::setting( 'title_bar_archive_portfolio_title' );
			} elseif ( is_post_type_archive() ) {
				if ( function_exists( 'is_shop' ) && is_shop() ) {
					$title = esc_html__( 'Shop', 'billey' );
				} else {
					$title = sprintf( esc_html__( 'Archives: %s', 'billey' ), post_type_archive_title( '', false ) );
				}
			} elseif ( is_home() ) {
				$title = Billey::setting( 'title_bar_home_title' ) . single_tag_title( '', false );
			} elseif ( is_tag() ) {
				$title = Billey::setting( 'title_bar_archive_tag_title' ) . single_tag_title( '', false );
			} elseif ( is_author() ) {
				$title = Billey::setting( 'title_bar_archive_author_title' ) . '<span class="vcard">' . get_the_author() . '</span>';
			} elseif ( is_year() ) {
				$title = Billey::setting( 'title_bar_archive_year_title' ) . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'billey' ) );
			} elseif ( is_month() ) {
				$title = Billey::setting( 'title_bar_archive_month_title' ) . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'billey' ) );
			} elseif ( is_day() ) {
				$title = Billey::setting( 'title_bar_archive_day_title' ) . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'billey' ) );
			} elseif ( is_search() ) {
				$title = Billey::setting( 'title_bar_search_title' ) . '"' . get_search_query() . '"';
			} elseif ( is_category() || is_tax() ) {
				$title = Billey::setting( 'title_bar_archive_category_title' ) . single_cat_title( '', false );
			} elseif ( is_singular( 'post' ) ) {
				$title = Billey::setting( 'title_bar_single_blog_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} elseif ( is_singular( 'portfolio' ) ) {
				$title = Billey::setting( 'title_bar_single_portfolio_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} elseif ( is_singular( 'product' ) ) {
				$title = Billey::setting( 'title_bar_single_product_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} else {
				$title = get_the_title();
			}
		}

		?>
		<div class="page-title-bar-heading">
			<h1 class="heading">
				<?php echo wp_kses( $title, array(
					'span' => array(
						'class' => array(),
					),
				) ); ?>
			</h1>
		</div>
		<?php
	}

	public static function paging_nav( $query = false ) {
		global $wp_query, $wp_rewrite;
		if ( $query === false ) {
			$query = $wp_query;
		}

		// Don't print empty markup if there's only one page.
		if ( $query->max_num_pages < 2 ) {
			return;
		}

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$page_num_link = html_entity_decode( get_pagenum_link() );
		$query_args    = array();
		$url_parts     = explode( '?', $page_num_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$page_num_link = esc_url( remove_query_arg( array_keys( $query_args ), $page_num_link ) );
		$page_num_link = trailingslashit( $page_num_link ) . '%_%';

		$format = '';
		if ( $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ) {
			$format = 'index.php/';
		}
		if ( $wp_rewrite->using_permalinks() ) {
			$format .= user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' );
		} else {
			$format .= '?paged=%#%';
		}

		// Set up paginated links.

		$args  = array(
			'base'      => $page_num_link,
			'format'    => $format,
			'total'     => $query->max_num_pages,
			'current'   => max( 1, $paged ),
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '<span class="fas fa-angle-left"></span>' . esc_html__( 'Prev', 'billey' ),
			'next_text' => esc_html__( 'Next', 'billey' ) . '<span class="fas fa-angle-right"></span>',
			'type'      => 'array',
		);
		$pages = paginate_links( $args );

		if ( is_array( $pages ) ) {
			echo '<ul class="page-pagination">';
			foreach ( $pages as $page ) {
				printf( '<li>%s</li>', $page );
			}
			echo '</ul>';
		}
	}

	public static function page_links() {
		wp_link_pages( array(
			'before'           => '<div class="page-links">',
			'after'            => '</div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'nextpagelink'     => esc_html__( 'Next', 'billey' ),
			'previouspagelink' => esc_html__( 'Prev', 'billey' ),
		) );
	}

	public static function comment_navigation( $args = array() ) {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			$defaults = array(
				'container_id'    => '',
				'container_class' => 'navigation comment-navigation',
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<nav id="<?php echo esc_attr( $args['container_id'] ); ?>"
			     class="<?php echo esc_attr( $args['container_class'] ); ?>">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'billey' ); ?></h2>

				<div class="comment-nav-links">
					<?php paginate_comments_links( array(
						'prev_text' => esc_html__( 'Prev', 'billey' ),
						'next_text' => esc_html__( 'Next', 'billey' ),
						'type'      => 'list',
					) ); ?>
				</div>
			</nav>
			<?php
		}
		?>
		<?php
	}

	public static function comment_template( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			<div class="comment-content">
				<div class="meta">
					<?php
					printf( '<h6 class="fn">%s</h6>', get_comment_author_link() );
					?>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-messages"><?php esc_html_e( 'Your comment is awaiting moderation.', 'billey' ) ?></em>
					<br/>
				<?php endif; ?>
				<div class="comment-text"><?php comment_text(); ?></div>

				<div class="comment-footer">
					<div class="comment-datetime">
						<?php echo get_comment_date() . ' ' . esc_html__( 'at', 'billey' ) . ' ' . get_comment_time(); ?>
					</div>

					<div class="comment-actions">
						<?php comment_reply_link( array_merge( $args, array(
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
							'reply_text' => esc_html__( 'Reply', 'billey' ),
						) ) ); ?>
						<?php edit_comment_link( '' . esc_html__( 'Edit', 'billey' ) ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function comment_form() {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = '';
		if ( $req ) {
			$aria_req = " aria-required='true'";
		}

		$fields = array(
			'author' => '<div class="row"><div class="col-sm-12 comment-form-author"><input id="author" placeholder="' . esc_attr__( 'Your Name *', 'billey' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . '/></div>',
			'email'  => '<div class="col-sm-12 comment-form-email"><input id="email" placeholder="' . esc_attr__( 'Your Email *', 'billey' ) . '" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . '/></div>',
			'url'    => '<div class="col-sm-12 comment-form-url"><input id="url" placeholder="' . esc_attr__( 'Website', 'billey' ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" ' . $aria_req . '/></div></div>',
		);

		$comment_field = '<div class="row"><div class="col-md-12 comment-form-comment"><textarea id="comment" placeholder="' . esc_attr__( 'Your Comment', 'billey' ) . '" name="comment" aria-required="true"></textarea></div></div>';

		$comments_args = array(
			'label_submit'        => esc_html__( 'Post comment', 'billey' ),
			'title_reply'         => esc_html__( 'Leave A Comment', 'billey' ),
			'comment_notes_after' => '',
			'fields'              => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'       => $comment_field,
		);
		comment_form( $comments_args );
	}

	public static function post_author() {
		?>
		<div class="entry-author">
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'email' ), '100' ); ?>
				</div>
				<div class="author-description">
					<h5 class="author-name"><?php the_author(); ?></h5>

					<div class="author-biographical-info">
						<?php the_author_meta( 'description' ); ?>
					</div>

					<?php self::post_author_socials(); ?>
				</div>
			</div>
		</div>
		<?php
	}

	public static function post_author_socials() {
		$email_address = get_the_author_meta( 'email_address' );
		$facebook      = get_the_author_meta( 'facebook' );
		$twitter       = get_the_author_meta( 'twitter' );
		$instagram     = get_the_author_meta( 'instagram' );
		$linkedin      = get_the_author_meta( 'linkedin' );
		$pinterest     = get_the_author_meta( 'pinterest' );

		$link_classes = 'hint--bounce hint--top hint--primary';
		?>
		<?php if ( $facebook || $twitter || $instagram || $linkedin || $email_address ) : ?>
			<div class="author-social-networks">
				<div class="inner">
					<?php if ( $twitter ) : ?>
						<a class="<?php echo esc_attr( $link_classes ); ?>"
						   aria-label="<?php esc_attr_e( 'Twitter', 'billey' ); ?>"
						   href="<?php echo esc_url( $twitter ); ?>" target="_blank">
							<i class="fab fa-twitter"></i>
						</a>
					<?php endif; ?>

					<?php if ( $facebook ) : ?>
						<a class="<?php echo esc_attr( $link_classes ); ?>"
						   aria-label="<?php esc_attr_e( 'Facebook', 'billey' ); ?>"
						   href="<?php echo esc_url( $facebook ); ?>" target="_blank">
							<i class="fab fa-facebook-square"></i>
						</a>
					<?php endif; ?>

					<?php if ( $instagram ) : ?>
						<a class="<?php echo esc_attr( $link_classes ); ?>"
						   aria-label="<?php esc_attr_e( 'Instagram', 'billey' ); ?>"
						   href="<?php echo esc_url( $instagram ); ?>" target="_blank">
							<i class="fab fa-instagram"></i>
						</a>
					<?php endif; ?>

					<?php if ( $linkedin ) : ?>
						<a class="<?php echo esc_attr( $link_classes ); ?>"
						   aria-label="<?php esc_attr_e( 'Linkedin', 'billey' ) ?>"
						   href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
							<i class="fab fa-linkedin"></i>
						</a>
					<?php endif; ?>

					<?php if ( $pinterest ) : ?>
						<a class="<?php echo esc_attr( $link_classes ); ?>"
						   aria-label="<?php esc_attr_e( 'Pinterest', 'billey' ); ?>"
						   href="<?php echo esc_url( $pinterest ); ?>" target="_blank">
							<i class="fab fa-pinterest"></i>
						</a>
					<?php endif; ?>

					<?php if ( $email_address ) : ?>
						<a class="<?php echo esc_attr( $link_classes ); ?>"
						   aria-label="<?php esc_attr_e( 'Email', 'billey' ); ?>"
						   href="mailto:<?php echo esc_url( $email_address ); ?>" target="_blank">
							<i class="fas fa-envelope"></i>
						</a>
					<?php endif; ?>
				</div>
			</div>
		<?php endif;
	}

	public static function get_sharing_list( $args = array() ) {
		$defaults       = array(
			'style'            => 'icons',
			'target'           => '_blank',
			'tooltip_enable'   => true,
			'tooltip_skin'     => 'primary',
			'tooltip_position' => 'top',
		);
		$args           = wp_parse_args( $args, $defaults );
		$social_sharing = Billey::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			$social_sharing_order = Billey::setting( 'social_sharing_order' );

			$link_classes = '';

			if ( $args['tooltip_enable'] === true ) {
				$link_classes .= "hint--bounce hint--{$args['tooltip_position']} hint--{$args['tooltip_skin']}";
			}

			foreach ( $social_sharing_order as $social ) {
				if ( in_array( $social, $social_sharing, true ) ) {
					if ( $social === 'facebook' ) {
						if ( ! wp_is_mobile() ) {
							$facebook_url = 'http://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;=' . rawurlencode( get_permalink() ) . '&p&#91;images&#93;&#91;0&#93;=' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) . '&p&#91;title&#93;=' . rawurlencode( get_the_title() );
						} else {
							$facebook_url = 'https://m.facebook.com/sharer.php?u=' . rawurlencode( get_permalink() );
						}
						?>
						<a class="<?php echo esc_attr( $link_classes . ' facebook' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Facebook', 'billey' ); ?>"
						   href="<?php echo esc_url( $facebook_url ); ?>">
							<?php if ( $args['style'] === 'text' ) : ?>
								<span><?php esc_html_e( 'Facebook', 'billey' ); ?></span>
							<?php else: ?>
								<i class="fab fa-facebook-square"></i>
							<?php endif; ?>
						</a>
						<?php
					} elseif ( $social === 'twitter' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' twitter' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Twitter', 'billey' ); ?>"
						   href="https://twitter.com/share?text=<?php echo rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>">
							<?php if ( $args['style'] === 'text' ) : ?>
								<span><?php esc_html_e( 'Twitter', 'billey' ); ?></span>
							<?php else: ?>
								<i class="fab fa-twitter"></i>
							<?php endif; ?>
						</a>
						<?php
					} elseif ( $social === 'tumblr' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' tumblr' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Tumblr', 'billey' ); ?>"
						   href="http://www.tumblr.com/share/link?url=<?php echo rawurlencode( get_permalink() ); ?>&amp;name=<?php echo rawurlencode( get_the_title() ); ?>">
							<?php if ( $args['style'] === 'text' ) : ?>
								<span><?php esc_html_e( 'Tumblr', 'billey' ); ?></span>
							<?php else: ?>
								<i class="fab fa-tumblr-square"></i>
							<?php endif; ?>
						</a>
						<?php

					} elseif ( $social === 'linkedin' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' linkedin' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Linkedin', 'billey' ); ?>"
						   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&amp;title=<?php echo rawurlencode( get_the_title() ); ?>">
							<?php if ( $args['style'] === 'text' ) : ?>
								<span><?php esc_html_e( 'Linkedin', 'billey' ); ?></span>
							<?php else: ?>
								<i class="fab fa-linkedin"></i>
							<?php endif; ?>
						</a>
						<?php
					} elseif ( $social === 'email' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' email' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Email', 'billey' ); ?>"
						   href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&amp;body=<?php echo rawurlencode( get_permalink() ); ?>">
							<?php if ( $args['style'] === 'text' ) : ?>
								<span><?php esc_html_e( 'Email', 'billey' ); ?></span>
							<?php else: ?>
								<i class="fas fa-envelope"></i>
							<?php endif; ?>
						</a>
						<?php
					}
				}
			}
		}
	}

	public static function social_icons( $args = array() ) {
		$defaults    = array(
			'link_classes'     => '',
			'display'          => 'icon',
			'tooltip_enable'   => true,
			'tooltip_position' => 'top',
			'tooltip_skin'     => '',
		);
		$args        = wp_parse_args( $args, $defaults );
		$social_link = Billey::setting( 'social_link' );

		if ( ! empty( $social_link ) ) {
			$social_link_target = Billey::setting( 'social_link_target' );

			$args['link_classes'] .= ' social-link';
			if ( $args['tooltip_enable'] ) {
				$args['link_classes'] .= ' hint--bounce';
				$args['link_classes'] .= " hint--{$args['tooltip_position']}";

				if ( $args['tooltip_skin'] !== '' ) {
					$args['link_classes'] .= " hint--{$args['tooltip_skin']}";
				}
			}

			foreach ( $social_link as $key => $row_values ) {
				?>
				<a class="<?php echo esc_attr( $args['link_classes'] ); ?>"
					<?php if ( $args['tooltip_enable'] ) : ?>
						aria-label="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php endif; ?>
                   href="<?php echo esc_url( $row_values['link_url'] ); ?>"
                   data-hover="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php if ( $social_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
                   rel="nofollow"
				>
					<?php if ( in_array( $args['display'], array( 'icon', 'icon_text' ), true ) ) : ?>
						<i class="social-icon <?php echo esc_attr( $row_values['icon_class'] ); ?>"></i>
					<?php endif; ?>
					<?php if ( in_array( $args['display'], array( 'text', 'icon_text' ), true ) ) : ?>
						<span class="social-text"><?php echo esc_html( $row_values['tooltip'] ); ?></span>
					<?php endif; ?>
				</a>
				<?php
			}
		}
	}

	public static function string_limit_words( $string, $word_limit ) {
		$words = explode( ' ', $string, $word_limit + 1 );
		if ( count( $words ) > $word_limit ) {
			array_pop( $words );
		}

		return implode( ' ', $words );
	}

	public static function string_limit_characters( $string, $limit ) {
		$string = substr( $string, 0, $limit );
		$string = substr( $string, 0, strripos( $string, " " ) );

		return $string;
	}

	public static function get_excerpt( $args = array() ) {
		$defaults = array(
			'post'  => null,
			'limit' => 55,
			'after' => '&hellip;',
			'type'  => 'word',
		);
		$args     = wp_parse_args( $args, $defaults );

		$excerpt = '';

		if ( $args['type'] === 'word' ) {
			$excerpt = self::string_limit_words( get_the_excerpt( $args['post'] ), $args['limit'] );
		} elseif ( $args['type'] === 'character' ) {
			$excerpt = self::string_limit_characters( get_the_excerpt( $args['post'] ), $args['limit'] );
		}

		if ( $excerpt !== '' && $excerpt !== '&nbsp;' ) {
			$excerpt = sprintf( '<p>%s %s</p>', $excerpt, $args['after'] );

			return $excerpt;
		}
	}

	public static function excerpt( $args = array() ) {
		echo self::get_excerpt( $args );
	}

	public static function render_sidebar( $template_position = 'left' ) {
		$sidebar1         = Billey_Global::instance()->get_sidebar_1();
		$sidebar2         = Billey_Global::instance()->get_sidebar_2();
		$sidebar_position = Billey_Global::instance()->get_sidebar_position();

		if ( $sidebar1 !== 'none' ) {
			$classes = 'page-sidebar';
			$classes .= ' page-sidebar-' . $template_position;
			if ( $template_position === 'left' ) {
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1, true );
				}
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			} elseif ( $template_position === 'right' ) {
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1, true );
				}
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			}
		}
	}

	public static function get_sidebar( $classes, $name, $first_sidebar = false ) {
		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
			<div class="page-sidebar-inner" itemscope="itemscope">
				<div class="page-sidebar-content">
					<?php dynamic_sidebar( $name ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * @param $name
	 * Name of dynamic sidebar
	 * Check sidebar is active then dynamic it.
	 */
	public static function generated_sidebar( $name ) {
		if ( is_active_sidebar( $name ) ) {
			dynamic_sidebar( $name );
		}
	}

	public static function image_placeholder( $width, $height ) {
		echo '<img src="http://via.placeholder.com/' . $width . 'x' . $height . '?text=' . esc_attr__( 'No+Image', 'billey' ) . '" alt="' . esc_attr__( 'Thumbnail', 'billey' ) . '"/>';
	}
}
