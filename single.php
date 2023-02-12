<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Billey
 * @since   1.0
 */
get_header();

get_template_part( 'template-parts/content-rich-snippet' );

if ( is_singular( 'post' ) ):

	$single_blog_style = Billey_Helper::get_post_meta( 'single_post_style', '' );

	if ( empty( $single_blog_style ) ) {
		$single_blog_style = Billey::setting( 'single_post_style' );
	}

	get_template_part( 'template-parts/blog-single/content-single', $single_blog_style );
else:
	get_template_part( 'template-parts/content', 'single' );
endif;

get_footer();
