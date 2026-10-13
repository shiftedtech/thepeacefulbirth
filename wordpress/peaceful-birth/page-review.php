<?php
/**
 * Template Name: Google review page
 *
 * The page's own content (heading + text) is shown in the card; the stars,
 * Google button, writing prompts and QR code are added by this template.
 * The review link comes from Appearance → Customize → Peaceful Birth settings.
 *
 * @package peaceful-birth
 */

$pb_review_url = pb_option( 'review_url' );
$pb_target     = $pb_review_url ? $pb_review_url : 'https://www.google.com/search?q=' . rawurlencode( get_bloginfo( 'name' ) . ' reviews' );

get_header();
?>
<main id="content" class="pb-review">
	<section class="pb-review__card">
		<div class="pb-review__avatar" aria-hidden="true">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'thumbnail' );
			} else {
				echo '<span>🤍</span>';
			}
			?>
		</div>

		<?php if ( ! $pb_review_url && current_user_can( 'edit_theme_options' ) ) : ?>
			<p class="pb-review__notice">
				<?php esc_html_e( 'Only admins see this: add the Google review link in Appearance → Customize → Peaceful Birth settings.', 'peaceful-birth' ); ?>
			</p>
		<?php endif; ?>

		<div class="pb-review__content">
			<?php
			while ( have_posts() ) {
				the_post();
				the_content();
			}
			?>
		</div>

		<div class="pb-stars" aria-label="<?php esc_attr_e( 'Rate your experience', 'peaceful-birth' ); ?>">
			<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
				<a href="<?php echo esc_url( $pb_target ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( sprintf( _n( '%d star', '%d stars', $i, 'peaceful-birth' ), $i ) ); ?>">★</a>
			<?php endfor; ?>
		</div>
		<p class="pb-stars__hint"><?php esc_html_e( 'Tap the stars to open Google reviews', 'peaceful-birth' ); ?></p>

		<a href="<?php echo esc_url( $pb_target ); ?>" class="pb-btn pb-btn--block pb-btn--google" target="_blank" rel="noopener">
			<svg viewBox="0 0 48 48" aria-hidden="true"><path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9.1 3.6l6.8-6.8C35.8 2.4 30.3 0 24 0 14.6 0 6.6 5.4 2.7 13.2l7.9 6.2C12.5 13.6 17.8 9.5 24 9.5z"/><path fill="#4285F4" d="M46.1 24.5c0-1.6-.1-3.1-.4-4.5H24v9h12.4c-.5 2.9-2.2 5.3-4.6 6.9l7.4 5.8c4.3-4 6.9-9.9 6.9-17.2z"/><path fill="#FBBC05" d="M10.6 28.6A14.5 14.5 0 0 1 9.5 24c0-1.6.3-3.2.8-4.6l-7.9-6.2A24 24 0 0 0 0 24c0 3.9.9 7.5 2.7 10.8l7.9-6.2z"/><path fill="#34A853" d="M24 48c6.5 0 11.9-2.1 15.9-5.8l-7.4-5.8c-2.1 1.4-4.8 2.3-8.5 2.3-6.2 0-11.5-4.1-13.4-9.9l-7.9 6.2C6.6 42.6 14.6 48 24 48z"/></svg>
			<?php esc_html_e( 'Write a Google review', 'peaceful-birth' ); ?>
		</a>
		<p class="pb-review__time"><?php esc_html_e( "Takes about 1 minute · You'll need a Google account", 'peaceful-birth' ); ?></p>
	</section>

	<section class="pb-prompts">
		<h2><?php esc_html_e( 'Not sure what to write?', 'peaceful-birth' ); ?></h2>
		<p><?php esc_html_e( 'Here are a few ideas — a sentence or two is perfect.', 'peaceful-birth' ); ?></p>
		<ul>
			<li><span>1</span><?php esc_html_e( 'How did you feel before and after working with me?', 'peaceful-birth' ); ?></li>
			<li><span>2</span><?php esc_html_e( 'Which support helped most — classes, labour support, or after birth?', 'peaceful-birth' ); ?></li>
			<li><span>3</span><?php esc_html_e( 'How was the experience for your husband or partner?', 'peaceful-birth' ); ?></li>
			<li><span>4</span><?php esc_html_e( 'Would you recommend a doula to a friend? Why?', 'peaceful-birth' ); ?></li>
		</ul>
	</section>

	<section class="pb-share">
		<div class="pb-share__qr" data-pb-qr="<?php echo esc_attr( $pb_review_url ? $pb_review_url : get_permalink() ); ?>" aria-label="<?php esc_attr_e( 'QR code for leaving a review', 'peaceful-birth' ); ?>"></div>
		<div>
			<h2><?php esc_html_e( 'Scan to leave a review', 'peaceful-birth' ); ?></h2>
			<p><?php esc_html_e( 'Share this page with a client, or print the QR code for thank-you cards.', 'peaceful-birth' ); ?></p>
			<div class="pb-share__actions">
				<button class="pb-btn pb-btn--sm" type="button" data-pb-copy="<?php echo esc_attr( get_permalink() ); ?>"><?php esc_html_e( 'Copy link', 'peaceful-birth' ); ?></button>
				<a class="pb-btn pb-btn--sm pb-btn--ghost" target="_blank" rel="noopener" href="<?php echo esc_url( 'https://wa.me/?text=' . rawurlencode( __( "Hi! Thank you for letting me be part of your birth journey 🤍 If you have a minute, I'd be so grateful for a short Google review: ", 'peaceful-birth' ) . get_permalink() ) ); ?>"><?php esc_html_e( 'Send on WhatsApp', 'peaceful-birth' ); ?></a>
				<button class="pb-btn pb-btn--sm pb-btn--ghost" type="button" onclick="window.print()"><?php esc_html_e( 'Print QR', 'peaceful-birth' ); ?></button>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
