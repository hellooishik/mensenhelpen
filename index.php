<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header();
?>

<div class="container site-content-padding">
	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<?php
			if ( is_search() ) {
				printf( '<h1 class="page-title">%s</h1>', sprintf( esc_html__( 'Search Results for: %s', 'mensenhelpen' ), '<span>' . get_search_query() . '</span>' ) );
			} else {
				$page_for_posts_id = get_option( 'page_for_posts' );
				if ( $page_for_posts_id ) {
					echo '<h1 class="page-title">' . get_the_title( $page_for_posts_id ) . '</h1>';
				} else {
					echo '<h1 class="page-title">' . esc_html__( 'Latest Posts', 'mensenhelpen' ) . '</h1>';
				}
			}
			?>
		</header><!-- .page-header -->

		<div class="posts-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item format-standard' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="post-content">
						<header class="entry-header">
							<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
							<div class="entry-meta">
								<?php echo esc_html( get_the_date() ); ?>
							</div>
						</header>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php
			endwhile;
			?>
		</div>

		<?php
		the_posts_navigation(
			array(
				'prev_text' => __( 'Older posts', 'mensenhelpen' ),
				'next_text' => __( 'Newer posts', 'mensenhelpen' ),
			)
		);
		?>

	<?php else : ?>
		
		<section class="no-results not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'mensenhelpen' ); ?></h1>
			</header>
			<div class="page-content">
				<?php if ( is_search() ) : ?>
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mensenhelpen' ); ?></p>
					<?php get_search_form(); ?>
				<?php else : ?>
					<p><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'mensenhelpen' ); ?></p>
					<?php get_search_form(); ?>
				<?php endif; ?>
			</div>
		</section>

	<?php endif; ?>
</div>

<?php get_footer(); ?>
