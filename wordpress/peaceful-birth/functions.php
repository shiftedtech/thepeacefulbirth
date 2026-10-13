<?php
/**
 * The Peaceful Birth theme setup.
 *
 * @package peaceful-birth
 */

defined( 'ABSPATH' ) || exit;

define( 'PB_VERSION', '1.0.0' );

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/default-content.php';
require get_template_directory() . '/inc/setup-pages.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/dashboard.php';

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'peaceful-birth', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 80, 'flex-width' => true, 'flex-height' => true ) );
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'assets/css/theme.css', pb_fonts_url() ) );

	register_nav_menus( array(
		'primary' => __( 'Main menu', 'peaceful-birth' ),
		'footer'  => __( 'Footer menu', 'peaceful-birth' ),
	) );
} );

function pb_fonts_url() {
	return 'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Nunito+Sans:wght@400;600;700&display=swap';
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'peaceful-birth-fonts', pb_fonts_url(), array(), null );
	wp_enqueue_style( 'peaceful-birth', get_template_directory_uri() . '/assets/css/theme.css', array(), PB_VERSION );
	wp_enqueue_script( 'peaceful-birth', get_template_directory_uri() . '/assets/js/main.js', array(), PB_VERSION, true );
	wp_localize_script( 'peaceful-birth', 'PB', array(
		'whatsapp'  => pb_whatsapp_number(),
		'instagram' => pb_option( 'instagram' ),
		'email'     => pb_option( 'email' ),
		'reviewUrl' => pb_option( 'review_url' ),
		'waMessage' => pb_option( 'wa_message' ),
		'reviewPage' => pb_review_page_url(),
	) );

	if ( is_page_template( 'page-review.php' ) ) {
		wp_enqueue_script( 'qrcodejs', 'https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js', array(), '1.0.0', true );
	}
} );

/**
 * Links in page content can point to #whatsapp, #instagram or #review —
 * they are swapped for the real links from the Customizer (see main.js).
 */
function pb_whatsapp_number() {
	return preg_replace( '/\D+/', '', (string) pb_option( 'whatsapp' ) );
}

/** Menu fallback when no menu has been built yet: anchor links to the home page sections. */
function pb_default_menu() {
	$base  = is_front_page() ? '' : home_url( '/' );
	$items = array(
		'#why'      => __( 'Why a doula', 'peaceful-birth' ),
		'#services' => __( 'Services', 'peaceful-birth' ),
		'#how'      => __( 'How it works', 'peaceful-birth' ),
		'#stories'  => __( 'Stories', 'peaceful-birth' ),
		'#faq'      => __( 'FAQ', 'peaceful-birth' ),
	);
	echo '<ul class="pb-menu">';
	foreach ( $items as $hash => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $base . $hash ), esc_html( $label ) );
	}
	echo '</ul>';
}

function pb_logo_svg() {
	return '<svg class="pb-logo__mark" viewBox="0 0 40 40" aria-hidden="true"><circle cx="20" cy="20" r="19" class="pb-logo__ring"/><path d="M6 28c5-6 9-6 14-2s9 4 14-2" class="pb-logo__hill"/><path d="M8 32c5-4 9-4 12-2s8 3 12-1" class="pb-logo__hill pb-logo__hill--2"/><circle cx="26" cy="14" r="4" class="pb-logo__sun"/></svg>';
}
