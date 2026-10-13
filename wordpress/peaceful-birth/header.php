<?php
/**
 * Site header.
 *
 * @package peaceful-birth
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'peaceful-birth' ); ?></a>

<header class="pb-nav" id="pb-nav">
	<div class="pb-container pb-nav__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="pb-logo" rel="home">
			<?php
			if ( has_custom_logo() ) {
				echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'thumbnail', false, array( 'class' => 'pb-logo__img', 'alt' => '' ) );
			} else {
				echo pb_logo_svg(); // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG.
			}
			?>
			<span><?php bloginfo( 'name' ); ?></span>
		</a>

		<form class="pb-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-pb-search>
			<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'peaceful-birth' ); ?>" aria-label="<?php esc_attr_e( 'Search', 'peaceful-birth' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
			<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'peaceful-birth' ); ?>"><svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="6.5"/><path d="m20 20-4-4"/></svg></button>
		</form>

		<button class="pb-nav__toggle" aria-label="<?php esc_attr_e( 'Open menu', 'peaceful-birth' ); ?>" aria-expanded="false" aria-controls="pb-nav-links"><span></span><span></span></button>

		<nav class="pb-nav__links" id="pb-nav-links" aria-label="<?php esc_attr_e( 'Main menu', 'peaceful-birth' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'pb-menu',
				'depth'          => 1,
				'fallback_cb'    => 'pb_default_menu',
			) );
			?>
			<a href="<?php echo esc_url( ( is_front_page() ? '' : home_url( '/' ) ) . '#contact' ); ?>" class="pb-btn pb-btn--sm"><?php esc_html_e( 'Book a chat', 'peaceful-birth' ); ?></a>
		</nav>
	</div>
</header>
