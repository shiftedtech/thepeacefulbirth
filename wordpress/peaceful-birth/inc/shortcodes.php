<?php
/**
 * [peaceful_birth_form] — consultation form that opens WhatsApp.
 * [peaceful_birth_contact_links] — WhatsApp / Instagram / email list.
 *
 * @package peaceful-birth
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'peaceful_birth_form', function () {
	ob_start();
	?>
	<form class="pb-form" data-pb-form>
		<div class="pb-form__row">
			<label><?php esc_html_e( 'Your name', 'peaceful-birth' ); ?><input name="name" required autocomplete="name" /></label>
			<label><?php esc_html_e( 'Phone', 'peaceful-birth' ); ?><input name="phone" type="tel" autocomplete="tel" /></label>
		</div>
		<div class="pb-form__row">
			<label><?php esc_html_e( 'Due date', 'peaceful-birth' ); ?><input name="due" type="date" /></label>
			<label><?php esc_html_e( "I'm interested in", 'peaceful-birth' ); ?>
				<select name="service">
					<option><?php esc_html_e( 'Doula Support', 'peaceful-birth' ); ?></option>
					<option><?php esc_html_e( 'Birth Classes', 'peaceful-birth' ); ?></option>
					<option><?php esc_html_e( 'Consultation', 'peaceful-birth' ); ?></option>
					<option><?php esc_html_e( 'Not sure yet', 'peaceful-birth' ); ?></option>
				</select>
			</label>
		</div>
		<label><?php esc_html_e( 'Message', 'peaceful-birth' ); ?><textarea name="message" rows="4" placeholder="<?php esc_attr_e( 'First baby? Any hopes or worries for your birth?', 'peaceful-birth' ); ?>"></textarea></label>
		<button class="pb-btn pb-btn--block" type="submit"><?php esc_html_e( 'Send via WhatsApp', 'peaceful-birth' ); ?></button>
		<p class="pb-form__note"><?php esc_html_e( 'Opens WhatsApp with your details filled in.', 'peaceful-birth' ); ?></p>
	</form>
	<?php
	return ob_get_clean();
} );

add_shortcode( 'peaceful_birth_contact_links', function () {
	$instagram = pb_option( 'instagram' );
	$email     = pb_option( 'email' );
	$handle    = $instagram ? '@' . trim( (string) wp_parse_url( $instagram, PHP_URL_PATH ), '/' ) : '';
	ob_start();
	?>
	<ul class="pb-contact-links">
		<li><span>💬</span><a href="#whatsapp" target="_blank" rel="noopener"><?php esc_html_e( 'WhatsApp me', 'peaceful-birth' ); ?></a></li>
		<?php if ( $instagram ) : ?>
			<li><span>📸</span><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $handle ); ?></a></li>
		<?php endif; ?>
		<?php if ( $email ) : ?>
			<li><span>✉️</span><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
		<?php endif; ?>
	</ul>
	<?php
	return ob_get_clean();
} );
