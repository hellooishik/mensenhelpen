<?php
/**
 * Template Name: Categories Subscription
 */

get_header();

if ( ! is_user_logged_in() ) {
	// Redirect or show message if not logged in
	echo '<div class="container section-padding text-center">';
	echo '<h2>You must be logged in to manage your category interests.</h2>';
	echo '<a href="#register" class="btn btn-primary js-open-register">Sign Up</a> ';
	echo '<a href="#login" class="btn btn-outline js-open-login">Log In</a>';
	echo '</div>';
	get_footer();
	exit;
}

$user_id = get_current_user_id();
$preferences = get_user_meta( $user_id, 'mensenhelpen_preferences', true );
if ( ! is_array( $preferences ) ) {
	$preferences = array();
}

$message = '';
if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['mensenhelpen_update_preferences'] ) ) {
	if ( isset( $_POST['mensenhelpen_prefs_nonce'] ) && wp_verify_nonce( $_POST['mensenhelpen_prefs_nonce'], 'update_mensenhelpen_preferences' ) ) {
		$new_prefs = isset( $_POST['categories'] ) ? array_map( 'absint', $_POST['categories'] ) : array();
		update_user_meta( $user_id, 'mensenhelpen_preferences', $new_prefs );
		$preferences = $new_prefs;
		$message = '<div class="alert alert-success">Your subscription interests have been updated!</div>';
	}
}
?>

<div class="page-header bg-gradient no-bottom-margin">
	<div class="container text-center text-white">
		<h1 class="page-title">My Interests</h1>
		<p class="subtitle">Select the categories you're interested in below to receive matching free samples.</p>
	</div>
</div>

<div class="container section-padding">
	<div class="glass-panel max-w-lg mx-auto p-4">
		<?php echo $message; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		
		<form method="post" action="" class="preferences-form">
			<?php wp_nonce_field( 'update_mensenhelpen_preferences', 'mensenhelpen_prefs_nonce' ); ?>
			
			<div class="category-selection-grid">
				<?php
				$categories = get_terms( array(
					'taxonomy'   => 'product_cat',
					'hide_empty' => false,
				) );

				if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
					foreach ( $categories as $cat ) {
						$checked = in_array( $cat->term_id, $preferences ) ? 'checked' : '';
						?>
						<label class="category-checkbox-card <?php echo $checked ? 'selected' : ''; ?>">
							<input type="checkbox" name="categories[]" value="<?php echo esc_attr( $cat->term_id ); ?>" <?php echo $checked; ?> class="sr-only js-category-checkbox">
							<div class="cat-card-content">
								<h3><?php echo esc_html( $cat->name ); ?></h3>
								<span class="status-indicator"></span>
							</div>
						</label>
						<?php
					}
				} else {
					echo '<p>No categories available currently.</p>';
				}
				?>
			</div>
			
			<div class="text-center mt-4">
				<button type="submit" name="mensenhelpen_update_preferences" class="btn btn-primary btn-large w-full">Save My Interests</button>
			</div>
		</form>
	</div>
</div>

<?php get_footer(); ?>
