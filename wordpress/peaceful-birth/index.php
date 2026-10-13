<?php
/**
 * Default template for pages, posts, archives and search results.
 *
 * @package peaceful-birth
 */

get_header();
?>
<main id="content" class="pb-page">
	<div class="pb-container pb-page__inner">
		<?php if ( is_search() ) : ?>
			<header class="pb-page__header">
				<p class="pb-eyebrow"><?php esc_html_e( 'Search', 'peaceful-birth' ); ?></p>
				<h1><?php printf( esc_html__( 'Results for “%s”', 'peaceful-birth' ), esc_html( get_search_query() ) ); ?></h1>
			</header>
		<?php elseif ( is_home() || is_archive() ) : ?>
			<header class="pb-page__header">
				<p class="pb-eyebrow"><?php esc_html_e( 'Journal', 'peaceful-birth' ); ?></p>
				<h1><?php echo is_archive() ? wp_kses_post( get_the_archive_title() ) : esc_html__( 'Birth tips & stories', 'peaceful-birth' ); ?></h1>
			</header>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<?php if ( is_singular() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( 'pb-article' ); ?>>
						<h1 class="pb-article__title"><?php the_title(); ?></h1>
						<?php if ( is_single() ) : ?>
							<p class="pb-article__meta"><?php echo esc_html( get_the_date() ); ?></p>
						<?php endif; ?>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="pb-article__image"><?php the_post_thumbnail( 'large' ); ?></div>
						<?php endif; ?>
						<div class="pb-article__content"><?php the_content(); ?></div>
					</article>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="pb-posts">
					<?php while ( have_posts() ) : the_post(); ?>
						<article <?php post_class( 'pb-post-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>" class="pb-post-card__image"><?php the_post_thumbnail( 'medium_large' ); ?></a>
							<?php endif; ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
							<a class="pb-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more →', 'peaceful-birth' ); ?></a>
						</article>
					<?php endwhile; ?>
				</div>
				<div class="pb-pagination"><?php the_posts_pagination(); ?></div>
			<?php endif; ?>
		<?php else : ?>
			<div class="pb-empty">
				<h1><?php esc_html_e( 'Nothing found', 'peaceful-birth' ); ?></h1>
				<p><?php esc_html_e( 'Try another search, or go back to the home page.', 'peaceful-birth' ); ?></p>
				<a class="pb-btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'peaceful-birth' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
