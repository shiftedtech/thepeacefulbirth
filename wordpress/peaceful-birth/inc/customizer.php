<?php
/**
 * Appearance → Customize → Peaceful Birth settings.
 *
 * @package peaceful-birth
 */

defined( 'ABSPATH' ) || exit;

function pb_defaults() {
	return array(
		'whatsapp'   => '60123456789',
		'email'      => 'hello@thepeacefulbirth.com',
		'instagram'  => 'https://www.instagram.com/thepeacefulbirth/',
		'review_url' => '',
		'wa_message' => "Hi! I found your website and would like to know more about your doula services.",
		'tagline'    => 'Doula support & birth classes for a positive birth experience.',
	);
}

function pb_option( $key ) {
	$defaults = pb_defaults();
	return get_theme_mod( 'pb_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {
	$wp_customize->add_section( 'pb_settings', array(
		'title'       => __( 'Peaceful Birth settings', 'peaceful-birth' ),
		'description' => __( 'Contact links used across the website. Buttons in your pages that link to #whatsapp, #instagram or #review use these.', 'peaceful-birth' ),
		'priority'    => 30,
	) );

	$fields = array(
		'whatsapp'   => array( __( 'WhatsApp number', 'peaceful-birth' ), __( 'With country code, e.g. 60123456789', 'peaceful-birth' ), 'text', 'sanitize_text_field' ),
		'wa_message' => array( __( 'WhatsApp greeting message', 'peaceful-birth' ), '', 'textarea', 'sanitize_textarea_field' ),
		'email'      => array( __( 'Email', 'peaceful-birth' ), '', 'email', 'sanitize_email' ),
		'instagram'  => array( __( 'Instagram link', 'peaceful-birth' ), '', 'url', 'esc_url_raw' ),
		'review_url' => array( __( 'Google review link', 'peaceful-birth' ), __( 'Google Business Profile → Ask for reviews → copy link (https://g.page/r/…/review)', 'peaceful-birth' ), 'url', 'esc_url_raw' ),
		'tagline'    => array( __( 'Footer tagline', 'peaceful-birth' ), '', 'text', 'sanitize_text_field' ),
	);

	$defaults = pb_defaults();
	foreach ( $fields as $key => $field ) {
		$wp_customize->add_setting( 'pb_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => $field[3],
		) );
		$wp_customize->add_control( 'pb_' . $key, array(
			'label'       => $field[0],
			'description' => $field[1],
			'section'     => 'pb_settings',
			'type'        => $field[2],
		) );
	}
} );
