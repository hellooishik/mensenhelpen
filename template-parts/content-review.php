<?php
/**
 * Template part for displaying a single review.
 */

$rating = get_post_meta( get_the_ID(), '_review_rating', true );
$pros   = get_post_meta( get_the_ID(), '_review_pros', true );
$cons   = get_post_meta( get_the_ID(), '_review_cons', true );
$author = get_the_author();
?>

<div class="review-card glass-panel mb-5">
	<div class="review-header flex-between mb-4">
		<div class="review-author-info flex-align-center">
			<div class="avatar-circle">
				<?php echo substr( esc_html( $author ), 0, 1 ); ?>
			</div>
			<div>
				<div style="font-weight: 800; font-size: 1.1rem; color: var(--text-dark);"><?php echo esc_html( $author ); ?></div>
				<div class="review-date text-sm opacity-60"><?php echo get_the_date(); ?></div>
			</div>
		</div>
		<div class="review-stars stars" style="--rating: <?php echo esc_attr( $rating ); ?>; font-size: 1.2rem;"></div>
	</div>
	
	<h3 class="review-title mb-3" style="font-size: 1.4rem; font-weight: 800;"><?php the_title(); ?></h3>
	
	<div class="review-text mb-4" style="line-height: 1.6; color: var(--text-light);">
		<?php the_content(); ?>
	</div>
	
	<?php if ( ! empty( $pros ) || ! empty( $cons ) ) : ?>
		<div class="review-pros-cons">
			<div class="pro-box">
				<h5><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><path d="M20 6 9 17l-5-5"/></svg> Pros</h5>
				<p style="font-size: 0.95rem; font-weight: 600; color: #166534;"><?php echo esc_html( $pros ? $pros : 'None mentioned' ); ?></p>
			</div>
			<div class="con-box">
				<h5><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg> Cons</h5>
				<p style="font-size: 0.95rem; font-weight: 600; color: #991b1b;"><?php echo esc_html( $cons ? $cons : 'None mentioned' ); ?></p>
			</div>
		</div>
	<?php endif; ?>
</div>
