<?php
/**
 * Template part for displaying a single product card in a grid.
 */

$average_rating = get_post_meta( get_the_ID(), '_average_rating', true );
$review_count   = get_post_meta( get_the_ID(), '_review_count', true );
if ( ! $average_rating ) { $average_rating = 0; }
if ( ! $review_count ) { $review_count = 0; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'product-card glass-panel' ); ?>>
	<div class="product-card-image">
		<a href="<?php the_permalink(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'medium', array( 'class' => 'img-cover' ) );
			} else {
				echo '<div class="no-image-placeholder-small">No Image</div>';
			}
			?>
		</a>
		<div class="product-badges">
			<?php echo get_the_term_list( get_the_ID(), 'product_cat', '<span class="badge badge-light">', '</span>', '</span>' ); ?>
		</div>
	</div>

	<div class="product-card-content">
		<div class="product-brand mb-1">
			<?php echo get_the_term_list( get_the_ID(), 'brand', '', ', ', '' ); ?>
		</div>
		
		<h3 class="product-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		
		<div class="product-rating">
			<div class="stars" style="--rating: <?php echo esc_attr( $average_rating ); ?>;"></div>
			<span class="rating-text">(<?php echo esc_html( $review_count ); ?>)</span>
		</div>
		
		<div class="product-card-footer mt-auto pt-3 border-t border-light mt-3">
			<a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm w-full">View Details</a>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
