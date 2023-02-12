<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section
 *
 * @link     https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package  Billey
 * @since    1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php html_class(); ?>>
<head>
	<?php Billey_THA::instance()->head_top(); ?>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset', 'display' ) ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url', 'display' ) ); ?>">
	<?php endif; ?>
	<?php Billey_THA::instance()->head_bottom(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php Billey::body_attributes(); ?>>

<?php Billey_Templates::pre_loader(); ?>

<?php Billey_THA::instance()->body_top(); ?>

<div id="page" class="site">
	<div class="content-wrapper">
		<?php Billey_Templates::slider( 'above' ); ?>
		<?php Billey_Templates::top_bar(); ?>

		<?php get_template_part( 'template-parts/header/entry' ); ?>

		<?php Billey_Templates::slider( 'below' ); ?>
		<?php Billey_Templates::title_bar(); ?>
