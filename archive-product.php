<?php
/**
 * The template for displaying Product Archives.
 */

get_header();
?>

<div class="page-header bg-gradient no-bottom-margin">
	<div class="container text-center text-white">
		<h1 class="page-title">Discover Free Samples</h1>
		<p class="subtitle">Browse available products from top brands. Request samples and share your honest feedback.</p>
	</div>
</div>

<div class="container section-padding product-archive-layout">
	<!-- Sidebar Filters -->
	<aside class="product-filters glass-panel">
		<h3>Filters</h3>
		
		<div class="filter-group">
			<h4>Category</h4>
			<select id="filter-category" class="w-full js-filter-select">
				<option value="0">All Categories</option>
				<?php
				$categories = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => false ) );
				if ( ! is_wp_error( $categories ) ) {
					foreach ( $categories as $cat ) {
						echo '<option value="' . esc_attr( $cat->term_id ) . '">' . esc_html( $cat->name ) . '</option>';
					}
				}
				?>
			</select>
		</div>

		<div class="filter-group">
			<h4>Brand</h4>
			<select id="filter-brand" class="w-full js-filter-select">
				<option value="0">All Brands</option>
				<?php
				$brands = get_terms( array( 'taxonomy' => 'brand', 'hide_empty' => false ) );
				if ( ! is_wp_error( $brands ) ) {
					foreach ( $brands as $brand ) {
						echo '<option value="' . esc_attr( $brand->term_id ) . '">' . esc_html( $brand->name ) . '</option>';
					}
				}
				?>
			</select>
		</div>

		<div class="filter-group">
			<h4>Sort By</h4>
			<select id="sort-products" class="w-full js-filter-select">
				<option value="latest">Latest Added</option>
				<option value="rating">Highest Rated</option>
			</select>
		</div>
		
		<button id="reset-filters" class="btn btn-outline w-full mt-3">Clear Filters</button>
	</aside>

	<!-- Product Grid Content -->
	<main id="primary" class="site-main product-content-area">
		<div class="products-grid js-ajax-products-container">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'product' );
				}
				the_posts_navigation();
			} else {
				echo '<p class="no-products-found">' . esc_html__( 'No products found.', 'mensenhelpen' ) . '</p>';
			}
			?>
		</div>
		<!-- AJAX Loader overlay (hidden by default via CSS) -->
		<div class="ajax-loader js-ajax-loader" style="display: none;">
			<div class="spinner"></div>
		</div>
	</main>
</div>

<?php get_footer(); ?>
