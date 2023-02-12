<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Billey
 * @since   1.0
 */

get_header( 'blank' );

$image = Billey::setting( 'error404_page_image' );
$title = Billey::setting( 'error404_page_title' );
$text  = Billey::setting( 'error404_page_text' );
?>
	<div class="page-404-content">
		<div class="container">
			<div class="row row-xs-center full-height">
				<div class="col-md-12">

					<?php if ( $image !== '' ): ?>
						<div class="error-image">
							<img src="<?php echo esc_url( $image ); ?>"
							     alt="<?php esc_attr_e( 'Not Found Image', 'billey' ); ?>"/>
						</div>
					<?php endif; ?>

					<?php if ( $title !== '' ): ?>
						<h3 class="error-404-title">
							<?php echo wp_kses( $title, 'billey-default' ); ?>
						</h3>
					<?php endif; ?>

					<?php if ( $text !== '' ): ?>
						<div class="error-404-text">
							<?php echo wp_kses( $text, 'billey-default' ); ?>
						</div>
					<?php endif; ?>

					<div class="error-buttons">
						<div class="tm-button-wrapper">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							   class="tm-button style-flat tm-button-nm icon-left"
							   id="btn-go-back"
							>
								<div class="button-content-wrapper">
									<span class="button-text"><?php esc_html_e( 'Go back', 'billey' ); ?></span>
								</div>
							</a>
						</div>

						<div class="tm-button-wrapper">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
							   class="tm-button style-border tm-button-nm icon-left"
							   id="btn-return-home"
							>
								<div class="button-content-wrapper">
									<span class="button-text"><?php esc_html_e( 'Homepage', 'billey' ); ?></span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer( 'blank' );
