<?php
/**
 * The template for displaying the front page.
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg');">
	<div class="hero-overlay"></div>
	<div class="container">
		<div class="hero-content">
			<h1 class="hero-title">discover. review. reward.</h1>
			<p class="hero-subtitle">Join a lively community sharing honest reviews on beauty, tech, food, and lifestyle.</p>
			<a href="#register" class="btn btn-primary btn-large js-open-register">Join now</a>
		</div>
	</div>
</section>

<!-- Welcome Section -->
<section class="welcome-section section-padding">
	<div class="container">
		<div class="welcome-grid">
			<div class="welcome-card">
				<h2 class="section-title mb-4">Welcome to MENSENHELPEN</h2>
				<h3>Connect Easily</h3>
				<p>A vibrant community where young adults share honest reviews on beauty, lifestyle, food, and tech products.</p>
			</div>
			<div class="welcome-card">
				<div style="height: 38px;"></div> <!-- Spacer -->
				<h3>Get Rewards</h3>
				<p>Join, review your favorite products, and earn cool rewards that inspire you to keep exploring what you love.</p>
			</div>
		</div>
		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/welcome-people.jpg" alt="People using phones" class="welcome-image-large">
	</div>
</section>

<!-- Featured Categories -->
<section class="featured-categories section-padding bg-light">
	<div class="container">
		<h2 class="section-title text-center mb-5">Discover Our Categories</h2>
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
					$cat_image = mensenhelpen_get_category_image( $cat->name );
					?>
					<a href="<?php echo esc_url( $term_link ); ?>" class="category-card-pro" style="background-image: url('<?php echo esc_url( $cat_image ); ?>');">
						<div class="category-overlay-pro"></div>
						<div class="category-content-pro">
							<h3><?php echo esc_html( $cat->name ); ?></h3>
							<span class="cat-count"><?php echo esc_html( $cat->count ); ?> items</span>
						</div>
					</a>
					<?php
				}
			}
			?>
		</div>
	</div>
</section>

<!-- How it works -->
<section class="how-it-works-section">
	<div class="container">
		<div class="how-grid">
			<div class="phone-mockup-wrapper">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/phone-mockup.png" alt="Phone Mockup" class="phone-mockup-img">
			</div>
			<div class="how-content">
				<h2 class="section-title mb-2">How it works</h2>
				<p class="mb-5">Simple steps to join, review, and earn rewards.</p>
				
				<div class="how-steps">
					<div class="how-step-item">
						<h3>Earn Rewards</h3>
						<p>Get points and unlock exclusive freebies.</p>
					</div>
					<div class="how-step-item">
						<h3>Sign up</h3>
						<p>Create your free MensenHelpen account quickly.</p>
					</div>
					<div class="how-step-item">
						<h3>Write Reviews</h3>
						<p>Share your honest opinions on products.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Latest Products -->
<section class="latest-products section-padding">
	<div class="container">
		<div class="section-header flex-between mb-5">
			<h2 class="section-title">Latest Samples Available</h2>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>" class="btn-text">View All <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-left: 5px;"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></a>
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
			}
			?>
		</div>
	</div>
</section>

<!-- Stay in the loop -->
<section class="loop-section">
	<div class="container">
		<h2 class="loop-title">Stay in the loop</h2>
		<p class="loop-subtitle">Get the latest reviews and product drops</p>
		
		<form class="newsletter-form-inline">
			<input type="email" placeholder="Your email" class="form-input" required>
			<button type="submit" class="btn btn-primary">Join now</button>
		</form>
	</div>
</section>

<!-- Gallery -->
<section class="gallery-section">
	<div class="container text-center">
		<h2 class="section-title">Gallery</h2>
		<p class="text-light">Snapshots from our community's latest product discoveries and reviews.</p>
		
		<div class="gallery-grid">
			<div class="gallery-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/gallery-1.jpg" alt="Gallery 1">
			</div>
			<div class="gallery-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/gallery-2.jpg" alt="Gallery 2">
			</div>
			<div class="gallery-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/gallery-3.jpg" alt="Gallery 3">
			</div>
			<div class="gallery-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/gallery-4.jpg" alt="Gallery 4">
			</div>
		</div>
	</div>
</section>

<!-- Testimonials -->
<section class="testimonials-section section-padding">
	<div class="container">
		<div class="testimonial-row" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/testimonial-bg.jpg');">
			<div class="testimonial-box">
				<div class="stars-row">★★★★★</div>
				<p class="testimonial-text">"MensenHelpen helped me find skincare yet I never knew I needed!"</p>
				<div class="author-meta">
					<img src="https://i.pravatar.cc/100?u=sarah" alt="Sarah">
					<div class="author-name">Sarah K.</div>
				</div>
			</div>
			<div class="testimonial-box">
				<div class="stars-row">★★★★★</div>
				<p class="testimonial-text">"Love how easy it is to find honest reviews and connect with others."</p>
				<div class="author-meta">
					<img src="https://i.pravatar.cc/100?u=alex" alt="Alex">
					<div class="author-name">Alex R.</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
