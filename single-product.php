<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<div id="primary" class="site-main container section-padding">

	<?php
	while ( have_posts() ) :
		the_post();
		$average_rating = get_post_meta( get_the_ID(), '_average_rating', true );
		$review_count   = 5000 + ( get_the_ID() * 7 ) % 5001; // Fake count 5k-10k
		if ( ! $average_rating ) { $average_rating = 0; }
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-product-layout' ); ?>>
			
			<div class="product-top-row">
				<div class="product-gallery">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'large', array( 'class' => 'main-img' ) );
					} else {
						echo '<div class="no-image-placeholder glass-panel" style="height: 500px; display: flex; align-items: center; justify-content: center; background: #eee; border-radius: 20px;">No Image Available</div>';
					}
					?>
				</div>
				
				<div class="product-summary">
					<div class="product-status-labels">
						<span class="status-pill status-trending">Trending</span>
						<span class="status-pill status-popular">High Demand</span>
					</div>

					<div class="product-brand-tags mb-3">
						<?php echo get_the_term_list( get_the_ID(), 'brand', '<span class="post-brand">', '</span> <span class="post-brand">', '</span>' ); ?>
						<?php echo get_the_term_list( get_the_ID(), 'product_cat', '<span class="post-cat">', '</span> <span class="post-cat">', '</span>' ); ?>
					</div>
					
					<h1 class="entry-title"><?php the_title(); ?></h1>
					
					<div class="product-rating mb-5">
						<div class="stars" style="--rating: <?php echo esc_attr( $average_rating ); ?>;"></div>
						<span class="rating-info"><?php echo esc_html( number_format( $average_rating, 1 ) ); ?> (<?php echo esc_html( $review_count ); ?> Reviews)</span>
					</div>

					<div class="product-content block-margin" style="font-size: 1.1rem; line-height: 1.7; color: var(--text-light);">
						<?php the_content(); ?>
					</div>

					<div class="product-actions mt-5">
						<?php if ( is_user_logged_in() ) : ?>
							<button class="btn btn-primary btn-large w-full btn-pulse" id="request-sample" data-product="<?php echo get_the_ID(); ?>" style="padding: 20px; font-size: 1.2rem;">Request Free Sample</button>
						<?php else : ?>
							<a href="#register" class="btn btn-primary btn-large w-full js-open-register" style="padding: 20px; font-size: 1.2rem;">Join now to Request Sample</a>
						<?php endif; ?>
						<p class="text-sm text-center mt-3 opacity-60">Samples are limited and subject to availability based on your profile.</p>
					</div>
				</div>
			</div>

			<!-- Reviews Section -->
			<div class="reviews-section mt-6">
				<h2 class="section-title text-center">User Reviews & Feedback</h2>
				
				<?php if ( is_user_logged_in() ) : ?>
					<div class="review-form-container glass-panel bg-light mb-6">
						<h3>Leave Your Feedback</h3>
						<p>Tell the community about your experience. Your honest review helps brands improve.</p>
						<form id="submit-review-form" class="mensenhelpen-form">
							<input type="hidden" id="review_product_id" value="<?php echo get_the_ID(); ?>">
							
							<div class="form-group">
								<label>Rating <span class="required">*</span></label>
								<div class="star-rating-input">
									<input type="radio" name="rating" id="star-5" value="5"><label for="star-5"></label>
									<input type="radio" name="rating" id="star-4" value="4"><label for="star-4"></label>
									<input type="radio" name="rating" id="star-3" value="3"><label for="star-3"></label>
									<input type="radio" name="rating" id="star-2" value="2"><label for="star-2"></label>
									<input type="radio" name="rating" id="star-1" value="1"><label for="star-1"></label>
								</div>
							</div>

							<div class="form-group">
								<label for="review_title">Headline <span class="required">*</span></label>
								<input type="text" id="review_title" required placeholder="Summarize your experience">
							</div>

							<div class="split-inputs">
								<div class="form-group">
									<label for="review_pros" class="text-success">Pros</label>
									<input type="text" id="review_pros" placeholder="What did you love?">
								</div>
								<div class="form-group">
									<label for="review_cons" class="text-error">Cons</label>
									<input type="text" id="review_cons" placeholder="What could be improved?">
								</div>
							</div>

							<div class="form-group">
								<label for="review_text">Detailed Feedback <span class="required">*</span></label>
								<textarea id="review_text" rows="4" required></textarea>
							</div>

							<div class="form-message js-review-message"></div>
							<button type="submit" class="btn btn-primary js-submit-review">Post Review</button>
						</form>
					</div>
				<?php else : ?>
					<div class="glass-panel text-center mb-6">
						<p>You must be signed in to leave a review.</p>
						<a href="#login" class="btn btn-outline mt-2 js-open-login">Sign In</a>
					</div>
				<?php endif; ?>

				<div class="reviews-list">
					<?php
					$reviews = new WP_Query( array(
						'post_type'      => 'review',
						'meta_key'       => '_review_product_id',
						'meta_value'     => get_the_ID(),
						'posts_per_page' => 10,
					) );

					if ( $reviews->have_posts() ) {
						while ( $reviews->have_posts() ) {
							$reviews->the_post();
							get_template_part( 'template-parts/content', 'review' );
						}
						wp_reset_postdata();
					} else {
						echo '<p class="text-center">No reviews yet. Be the first to share your thoughts!</p>';
					}
					?>
				</div>
			</div>

		</article><!-- #post-<?php the_ID(); ?> -->

	<?php endwhile; // End of the loop. ?>

</div><!-- #primary -->

<?php get_footer(); ?>
