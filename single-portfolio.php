<?php
/**
 * The template for displaying all single portfolio posts.
 *
 * @package Billey
 * @since   1.0
 */
$style = Billey_Helper::get_post_meta( 'portfolio_layout_style', '' );
if ( '' === $style ) {
	$style = Billey::setting( 'single_portfolio_style' );
}

if ( 'blank' === $style ) {
	get_template_part( 'template-parts/portfolio/content-single', 'blank' );
} else {
	get_template_part( 'template-parts/portfolio/content-single' );
}
