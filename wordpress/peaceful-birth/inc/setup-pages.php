<?php
/**
 * On first activation, create the Home and Review pages with the default
 * content and set Home as the front page. Runs once; existing pages are kept.
 *
 * @package peaceful-birth
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_switch_theme', 'pb_create_default_pages' );

function pb_create_default_pages() {
	if ( get_option( 'pb_pages_created' ) ) {
		return;
	}

	$home_id = wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => __( 'Home', 'peaceful-birth' ),
		'post_name'    => 'home',
		'post_content' => pb_home_content(),
	) );

	$review_id = wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => __( 'Leave a Review', 'peaceful-birth' ),
		'post_name'    => 'review',
		'post_content' => pb_review_content(),
	) );

	if ( $review_id && ! is_wp_error( $review_id ) ) {
		update_post_meta( $review_id, '_wp_page_template', 'page-review.php' );
		update_option( 'pb_review_page_id', $review_id );
	}

	if ( $home_id && ! is_wp_error( $home_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}

	update_option( 'pb_pages_created', 1 );
}

/** URL of the review page (the page using the Review template). */
function pb_review_page_url() {
	$id = (int) get_option( 'pb_review_page_id' );
	if ( $id && 'publish' === get_post_status( $id ) ) {
		return get_permalink( $id );
	}
	$pages = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'page-review.php', 'number' => 1 ) );
	return $pages ? get_permalink( $pages[0] ) : home_url( '/' );
}
