<?php
/**
 * "Getting started" box on the WordPress dashboard.
 *
 * @package peaceful-birth
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_dashboard_setup', function () {
	if ( ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	wp_add_dashboard_widget( 'pb_getting_started', __( 'The Peaceful Birth — getting started', 'peaceful-birth' ), 'pb_dashboard_widget' );
} );

function pb_dashboard_widget() {
	$home_id = (int) get_option( 'page_on_front' );
	$links   = array();

	if ( $home_id ) {
		$links[] = array( get_edit_post_link( $home_id ), __( 'Edit the home page text & photos', 'peaceful-birth' ) );
	}
	$links[] = array( pb_review_page_url(), __( 'View the Google review page (send this link to clients)', 'peaceful-birth' ) );

	if ( current_user_can( 'edit_theme_options' ) ) {
		$links[] = array( admin_url( 'customize.php?autofocus[section]=pb_settings' ), __( 'Set WhatsApp, email, Instagram & Google review link', 'peaceful-birth' ) );
	}
	if ( current_user_can( 'create_users' ) ) {
		$links[] = array( admin_url( 'user-new.php' ), __( 'Add the business owner as an Editor (with her Gmail)', 'peaceful-birth' ) );
	}
	if ( current_user_can( 'install_plugins' ) ) {
		$links[] = array( admin_url( 'plugin-install.php?s=site+kit+by+google&tab=search&type=term' ), __( 'Install Site Kit by Google (visitor stats)', 'peaceful-birth' ) );
		$links[] = array( admin_url( 'plugin-install.php?s=nextend+social+login&tab=search&type=term' ), __( 'Install a "Sign in with Google" plugin', 'peaceful-birth' ) );
	}

	echo '<ol style="margin:0 0 0 18px">';
	foreach ( $links as $l ) {
		printf( '<li style="margin:6px 0"><a href="%s">%s</a></li>', esc_url( $l[0] ), esc_html( $l[1] ) );
	}
	echo '</ol>';

	if ( ! pb_option( 'review_url' ) ) {
		echo '<p style="margin-top:12px;color:#8e4a2a"><strong>' . esc_html__( 'Reminder:', 'peaceful-birth' ) . '</strong> ' . esc_html__( 'the Google review link is not set yet.', 'peaceful-birth' ) . '</p>';
	}
}
