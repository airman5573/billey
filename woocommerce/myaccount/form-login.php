<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$registration_enable = get_option( 'woocommerce_enable_myaccount_registration' );
?>

<div class="row my-account-layout">
	<div class="col-md-6">
		<div class="my-account-left-background"></div>
	</div>
	<div class="col-md-6">
		<div class="my-account-form">
			<div id="customer_login" class="inner">
				<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

				<h2 class="form-title form-login-title"><?php esc_html_e( 'Log In, action !', 'billey' ); ?></h2>

				<?php if ( 'yes' === $registration_enable ) : ?>
					<h2 class="form-title form-register-title"><?php esc_html_e( 'Register', 'billey' ); ?></h2>

					<div class="form-tabs">
						<a href="#woocommerce-form-login-wrapper"
						   class="active" data-action="login"><?php esc_html_e( 'Sign In', 'billey' ); ?></a>
						<a href="#woocommerce-form-register-wrapper"
						   data-action="register"><?php esc_html_e( 'Sign Up', 'billey' ); ?></a>
					</div>
				<?php endif; ?>

				<form class="woocommerce-form woocommerce-form-login login" method="post">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="username"><?php esc_html_e( 'Username or email address', 'billey' ); ?><span
								class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
						       name="username"
						       id="username" autocomplete="username"
						       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
					</div>
					<div
						class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide woocommerce-form-row-password">

						<div class="form-row-label-wrap">
							<label for="password"><?php esc_html_e( 'Password', 'billey' ); ?>
								<span class="required">*</span>
							</label>

							<a class="woocommerce-LostPassword lost_password"
							   href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot password?', 'billey' ); ?></a>
						</div>

						<input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
						       name="password"
						       id="password" autocomplete="current-password"/>
					</div>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<div class="form-row">
						<label
							class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox"
							       name="rememberme"
							       type="checkbox" id="rememberme" value="forever"/>
							<span><?php esc_html_e( 'Remember me', 'billey' ); ?></span>
						</label>
						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
						<button type="submit" class="woocommerce-button button woocommerce-form-login__submit"
						        name="login"
						        value="<?php esc_attr_e( 'Log in', 'billey' ); ?>"><?php esc_html_e( 'Log in', 'billey' ); ?></button>
					</div>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>

				<?php if ( 'yes' === $registration_enable ) : ?>
					<form method="post"
					      class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_username"><?php esc_html_e( 'Username', 'billey' ); ?><span
										class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
								       name="username"
								       id="reg_username" autocomplete="username"
								       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
							</p>

						<?php endif; ?>

						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_email"><?php esc_html_e( 'Email address', 'billey' ); ?><span
									class="required">*</span></label>
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text"
							       name="email"
							       id="reg_email" autocomplete="email"
							       value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
						</p>

						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_password"><?php esc_html_e( 'Password', 'billey' ); ?><span
										class="required">*</span></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
								       name="password"
								       id="reg_password" autocomplete="new-password"/>
							</p>

						<?php else : ?>

							<p><?php esc_html_e( 'A password will be sent to your email address.', 'billey' ); ?></p>

						<?php endif; ?>

						<?php do_action( 'woocommerce_register_form' ); ?>

						<p class="woocommerce-form-row form-row">
							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button type="submit"
							        class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit"
							        name="register"
							        value="<?php esc_attr_e( 'Register', 'billey' ); ?>"><?php esc_html_e( 'Register', 'billey' ); ?></button>
						</p>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>
				<?php endif; ?>

				<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
			</div>
		</div>
	</div>
</div>
