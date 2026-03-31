<?php
/**
 * The template for displaying Product Archives.
 */

get_header();
?>

<div class="page-hero">
	<div class="container">
		<h1 class="page-title">Discover Free Samples</h1>
		<p class="subtitle">Join thousands of members testing the latest beauty, tech, and lifestyle products daily.</p>
	</div>
</div>

<div class="container section-padding">
	<!-- Horizontal Toolbar -->
	<header class="archive-toolbar">
		<div class="filter-item">
			<label for="filter-category">Category</label>
			<select id="filter-category" class="filter-select js-filter-select">
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

		<div class="filter-item">
			<label for="filter-brand">Brand</label>
			<select id="filter-brand" class="filter-select js-filter-select">
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

		<div class="filter-item">
			<label for="sort-products">Sort By</label>
			<select id="sort-products" class="filter-select js-filter-select">
				<option value="latest">Latest Added</option>
				<option value="rating">Highest Rated</option>
			</select>
		</div>
		
		<div class="ml-auto">
			<button id="reset-filters" class="btn-text" style="font-weight: 700; color: var(--primary-color);">Clear All Filters</button>
		</div>
	</header>

	<!-- Product Grid Content -->

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
