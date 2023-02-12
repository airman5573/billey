<?php
/**
 * The template for displaying the footer.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Billey
 * @since   1.0
 */

?>
</div><!-- /.content-wrapper -->

<?php Billey_THA::instance()->footer_before(); ?>

<?php get_template_part( 'template-parts/footer/entry' ); ?>

<?php Billey_THA::instance()->footer_after(); ?>

</div><!-- /.site -->

<?php Billey_THA::instance()->body_bottom(); ?>

<?php wp_footer(); ?>
</body>
</html>
