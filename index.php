<?php
/**
 * The main template file
 */

get_header();
?>

<div class="page-hero">
	<div class="container">
		<h1 class="page-title">
			<?php
			if ( is_search() ) {
				printf( esc_html__( 'Search Results for: %s', 'mensenhelpen' ), '<span>' . get_search_query() . '</span>' );
			} elseif ( is_home() ) {
				$page_for_posts_id = get_option( 'page_for_posts' );
				echo $page_for_posts_id ? get_the_title( $page_for_posts_id ) : esc_html__( 'Latest Posts', 'mensenhelpen' );
			} else {
				the_archive_title();
			}
			?>
		</h1>
		<p class="subtitle">Stay updated with the latest community news and product discovery stories.</p>
	</div>
</div>

<div id="primary" class="site-main container section-padding">

	<?php
	if ( have_posts() ) {
		echo '<div class="posts-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 40px;">';
		while ( have_posts() ) {
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'glass-panel p-0 overflow-hidden' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-card-image" style="height: 240px; overflow: hidden;">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'medium_large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
						</a>
					</div>
				<?php endif; ?>

				<div class="post-card-content" style="padding: 30px;">
					<div class="post-meta mb-2 opacity-60 font-bold" style="font-size: 0.8rem; text-transform: uppercase;">
						<?php echo get_the_date(); ?>
					</div>
					<h2 class="post-title mb-3" style="font-size: 1.5rem; font-weight: 800;">
						<a href="<?php the_permalink(); ?>" style="color: var(--text-dark); text-decoration: none;"><?php the_title(); ?></a>
					</h2>
					<div class="post-excerpt opacity-70 mb-4" style="font-size: 0.95rem; line-height: 1.6;">
						<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
					</div>
					<a href="<?php the_permalink(); ?>" class="btn-text" style="font-weight: 800; color: var(--primary-color);">Read More &rarr;</a>
				</div>
			</article>
			<?php
		}
		echo '</div>';
		
		the_posts_navigation();
	} else {
		echo '<p class="text-center">Nothing found here.</p>';
	}
	?>

</div><!-- #primary -->

<?php get_footer(); ?>
