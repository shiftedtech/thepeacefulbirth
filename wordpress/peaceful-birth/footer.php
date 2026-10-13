<?php
/**
 * Site footer.
 *
 * @package peaceful-birth
 */
?>
<footer class="pb-footer">
	<div class="pb-container pb-footer__inner">
		<div>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="pb-logo pb-logo--light"><span><?php bloginfo( 'name' ); ?></span></a>
			<p><?php echo esc_html( pb_option( 'tagline' ) ); ?></p>
		</div>
		<?php
		if ( has_nav_menu( 'footer' ) ) {
			wp_nav_menu( array( 'theme_location' => 'footer', 'container' => 'nav', 'depth' => 1 ) );
		} else {
			$base = is_front_page() ? '' : home_url( '/' );
			?>
			<nav>
				<a href="<?php echo esc_url( $base . '#services' ); ?>"><?php esc_html_e( 'Services', 'peaceful-birth' ); ?></a>
				<a href="<?php echo esc_url( $base . '#how' ); ?>"><?php esc_html_e( 'How it works', 'peaceful-birth' ); ?></a>
				<a href="<?php echo esc_url( $base . '#faq' ); ?>"><?php esc_html_e( 'FAQ', 'peaceful-birth' ); ?></a>
				<a href="<?php echo esc_url( pb_review_page_url() ); ?>"><?php esc_html_e( 'Leave a review', 'peaceful-birth' ); ?></a>
				<?php if ( pb_option( 'instagram' ) ) : ?>
					<a href="<?php echo esc_url( pb_option( 'instagram' ) ); ?>" target="_blank" rel="noopener">Instagram</a>
				<?php endif; ?>
			</nav>
		<?php } ?>
	</div>
	<p class="pb-container pb-footer__legal">
		&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
		<?php esc_html_e( 'Doula support is non-medical and complements care from your doctor or midwife.', 'peaceful-birth' ); ?>
	</p>
</footer>

<?php if ( pb_whatsapp_number() ) : ?>
<a class="pb-wa-float" href="#whatsapp" target="_blank" rel="noopener" aria-label="<?php esc_attr_e( 'Chat on WhatsApp', 'peaceful-birth' ); ?>">
	<svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.7.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.7-1.4.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.8 11.9 11.9 0 0 0 4.6 4c1.7.7 2.4.8 3.2.7.5-.1 1.5-.6 1.8-1.2s.2-1.1.1-1.2-.2-.1-.5-.2z"/></svg>
</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
