<?php
/**
 * The template for displaying the front page.
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
	<div class="container hero-content">
		<div class="hero-text">
			<h1 class="hero-title">How Do I Get Free Samples?</h1>
			<p class="hero-subtitle">MensenHelpen connects brands with real people. Try amazing products for free, share your honest feedback, and help shape the future of your favorite categories.</p>
			
			<div class="hero-cta-group">
				<?php if ( ! is_user_logged_in() ) : ?>
					<a href="#register" class="btn btn-primary btn-large js-open-register">Get Free Samples</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/categories' ) ); ?>" class="btn btn-primary btn-large">Update Subscriptions</a>
				<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/for-brands' ) ); ?>" class="btn btn-outline btn-large">For Brands</a>
			</div>
		</div>
		<div class="hero-image glass-panel">
			<!-- We will use CSS/images for a premium mock or dynamic element -->
			<div class="hero-mockup-badge">📦 Free shipping</div>
			<div class="hero-mockup-badge badge-2">⭐ Real reviews</div>
		</div>
	</div>
</section>

<!-- How It Works (3-Step Flow) -->
<section class="how-it-works-summary section-padding">
	<div class="container">
		<h2 class="section-title text-center">It’s as easy as 1-2-3</h2>
		<div class="step-grid">
			<div class="step-card">
				<div class="step-icon">1</div>
				<h3>Sign Up</h3>
				<p>Create your free account in seconds and tell us a bit about yourself.</p>
			</div>
			<div class="step-card">
				<div class="step-icon">2</div>
				<h3>Choose Categories</h3>
				<p>Select your interests (Skincare, Wellness, etc.) to get matched with relevant samples.</p>
			</div>
			<div class="step-card">
				<div class="step-icon">3</div>
				<h3>Receive & Review</h3>
				<p>Get free samples delivered to your door. Try them out, and share an honest review.</p>
			</div>
		</div>
	</div>
</section>

<!-- Featured Categories -->
<section class="featured-categories bg-light section-padding">
	<div class="container">
		<h2 class="section-title">Discover Our Categories</h2>
		<div class="category-grid">
			<?php
			$categories = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
				'number'     => 6,
			) );

			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
				foreach ( $categories as $cat ) {
					$term_link = get_term_link( $cat );
					echo '<a href="' . esc_url( $term_link ) . '" class="category-card glass-panel">';
					echo '<h3>' . esc_html( $cat->name ) . '</h3>';
					echo '<span class="cat-count">' . esc_html( $cat->count ) . ' products</span>';
					echo '</a>';
				}
			} else {
				echo '<p>Categories coming soon.</p>';
			}
			?>
		</div>
		<div class="text-center mt-4">
			<a href="<?php echo esc_url( home_url( '/categories' ) ); ?>" class="btn btn-outline">Browse All Categories</a>
		</div>
	</div>
</section>

<!-- Latest Products & Reviews -->
<section class="latest-products section-padding">
	<div class="container">
		<div class="section-header flex-between">
			<h2 class="section-title">Latest Samples Available</h2>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>" class="link-arrow">View All Products</a>
		</div>
		<div class="products-grid">
			<?php
			$products_query = new WP_Query( array(
				'post_type'      => 'product',
				'posts_per_page' => 4,
			) );

			if ( $products_query->have_posts() ) {
				while ( $products_query->have_posts() ) {
					$products_query->the_post();
					get_template_part( 'template-parts/content', 'product' );
				}
				wp_reset_postdata();
			} else {
				echo '<p>New products will be listed here soon.</p>';
			}
			?>
		</div>
	</div>
</section>

<!-- Trust Elements & Testimonials -->
<section class="trust-section bg-dark text-white section-padding">
	<div class="container">
		<h2 class="section-title text-center">Loved by Users, Trusted by Brands</h2>
		
		<div class="testimonials-slider">
			<?php
			$testimonials = new WP_Query( array(
				'post_type'      => 'testimonial',
				'posts_per_page' => 3,
			) );

			if ( $testimonials->have_posts() ) {
				while ( $testimonials->have_posts() ) {
					$testimonials->the_post();
					?>
					<div class="testimonial-card">
						<?php if ( has_post_thumbnail() ) {
							echo '<div class="testimonial-avatar">';
							the_post_thumbnail( 'thumbnail' );
							echo '</div>';
						} ?>
						<div class="testimonial-content">
							"<?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?>"
						</div>
						<div class="testimonial-author">- <?php the_title(); ?></div>
					</div>
					<?php
				}
				wp_reset_postdata();
			} else {
				echo '<p class="text-center">"I love getting to try new skincare routines before committing!" - Sarah K.</p>';
			}
			?>
		</div>
		<div class="brand-logos">
			<!-- Placeholder for brand logos -->
			<div class="brand-logo-item">Brand 1</div>
			<div class="brand-logo-item">Brand 2</div>
			<div class="brand-logo-item">Brand 3</div>
			<div class="brand-logo-item">Brand 4</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
