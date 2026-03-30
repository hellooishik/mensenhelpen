<?php
/**
 * Template part for displaying a single review.
 */

$rating = get_post_meta( get_the_ID(), '_review_rating', true );
$pros   = get_post_meta( get_the_ID(), '_review_pros', true );
$cons   = get_post_meta( get_the_ID(), '_review_cons', true );
$author = get_the_author();
?>

<div class="review-card glass-panel mb-4">
	<div class="review-header flex-between mb-2">
		<div class="review-author-info flex-align-center">
			<div class="avatar-circle">
				<?php echo substr( esc_html( $author ), 0, 1 ); ?>
			</div>
			<div>
				<strong><?php echo esc_html( $author ); ?></strong>
				<div class="review-date text-sm opacity-70"><?php echo get_the_date(); ?></div>
			</div>
		</div>
		<div class="review-stars stars" style="--rating: <?php echo esc_attr( $rating ); ?>;"></div>
	</div>
	
	<h4 class="review-title mb-2"><?php the_title(); ?></h4>
	
	<div class="review-text mb-3">
		<?php the_content(); ?>
	</div>
	
	<?php if ( ! empty( $pros ) || ! empty( $cons ) ) : ?>
		<div class="review-pros-cons bg-light border-radius p-3 mt-3">
			<?php if ( ! empty( $pros ) ) : ?>
				<div class="pro-item text-success mb-1">
					<strong>+ Pros:</strong> <?php echo esc_html( $pros ); ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $cons ) ) : ?>
				<div class="con-item text-error">
					<strong>- Cons:</strong> <?php echo esc_html( $cons ); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
