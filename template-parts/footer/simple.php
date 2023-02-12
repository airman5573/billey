<div class="page-footer simple-footer" id="page-footer">
	<div class="container">
		<div class="row row-xs-center">
			<div class="col-md-12">
				<div class="footer-text">
					<?php $copyright_text = Billey::setting( 'footer_copyright_text' ); ?>
					<?php echo wp_kses( $copyright_text, 'billey-default' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
