<?php
$image = Billey::setting( 'pre_loader_image' );
?>
<div>
	<?php if ( $image !== '' ): ?>
		<img src="<?php echo esc_url( $image ); ?>"
		     alt="<?php esc_attr_e( 'Billey Preloader', 'billey' ); ?>">
	<?php endif; ?>
</div>
