<?php
/**
 * Home page: shows the content of the page set as "Homepage" — every
 * section is a block, so the owner edits it in the normal page editor.
 *
 * @package peaceful-birth
 */

if ( 'page' !== get_option( 'show_on_front' ) ) {
	get_template_part( 'index' );
	return;
}

get_header();
?>
<main id="content" class="pb-front">
	<?php
	while ( have_posts() ) {
		the_post();
		the_content();
	}
	?>
</main>
<?php
get_footer();
