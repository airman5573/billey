<?php
$number_post = Billey::setting( 'single_post_related_number' );
$results     = Billey_Post::instance()->get_related_posts( array(
	'post_id'      => get_the_ID(),
	'number_posts' => $number_post,
) );

if ( $results !== false && $results->have_posts() ) : ?>
	<div class="related-posts billey-blog billey-animation-zoom-in billey-blog-caption-style-03 billey-blog-overlay-style-float">
		<h3 class="related-title">
			<?php esc_html_e( 'Related Posts', 'billey' ); ?>
		</h3>
		<div class="tm-swiper tm-slider"
		     data-lg-items="2"
		     data-lg-gutter="30"
		     data-sm-items="1"
		     data-nav="1"
		     data-auto-height="1"
		     data-slides-per-group="inherit"
		>
			<div class="swiper-inner">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php while ( $results->have_posts() ) : $results->the_post(); ?>
							<div class="swiper-slide">
								<div <?php post_class( 'related-post-item' ); ?>>

									<div class="post-wrapper billey-box">

										<?php if ( has_post_thumbnail() ) { ?>
											<div class="post-feature post-thumbnail billey-image">
												<a href="<?php the_permalink(); ?>">
													<?php Billey_Image::the_post_thumbnail( array( 'size' => '480x320' ) ); ?>
												</a>

												<div class="post-overlay-background"></div>
												<div class="post-overlay-content">

													<?php Billey_Post::instance()->the_category( array(
														'classes' => 'post-overlay-categories',
													) ); ?>

												</div>

											</div>
										<?php } ?>

										<div class="post-caption">
											<h3 class="post-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>

											<div class="post-meta">
												<div class="post-date"><?php echo get_the_date(); ?></div>

												<div class="post-author">
													<?php esc_html_e( 'by', 'billey' ); ?>
													<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
														<?php the_author(); ?>
													</a>
												</div>
											</div>

											<div class="post-excerpt">
												<?php Billey_Templates::excerpt( array(
													'limit' => 18,
													'type'  => 'word',
												) ); ?>
											</div>

											<div class="post-read-more">
												<a href="<?php the_permalink(); ?>"
												   class="tm-button style-text tm-button-nm">
													<span class="button-text">
														<?php esc_html_e( 'Read More', 'billey' ); ?>
													</span>
												</a>
											</div>
										</div>

									</div>

								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif;
wp_reset_postdata();
