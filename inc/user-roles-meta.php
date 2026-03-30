<?php
/**
 * User Roles and Meta Management
 * Handles custom meta fields for users (product interests, address, etc.)
 */

// Add custom fields to user profile page in admin
function mensenhelpen_add_user_meta_fields( $user ) {
	$preferences = get_user_meta( $user->ID, 'mensenhelpen_preferences', true );
	if ( ! is_array( $preferences ) ) {
		$preferences = array();
	}
	$address = get_user_meta( $user->ID, 'mensenhelpen_address', true );
	$age     = get_user_meta( $user->ID, 'mensenhelpen_age_range', true );

	// Get all product categories
	$categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	) );
	?>
	<h3><?php esc_html_e( 'MensenHelpen User Data', 'mensenhelpen' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="mensenhelpen_address"><?php esc_html_e( 'Shipping Address', 'mensenhelpen' ); ?></label></th>
			<td>
				<textarea id="mensenhelpen_address" name="mensenhelpen_address" rows="3" class="regular-text"><?php echo esc_textarea( $address ); ?></textarea>
			</td>
		</tr>
		<tr>
			<th><label for="mensenhelpen_age_range"><?php esc_html_e( 'Age Range', 'mensenhelpen' ); ?></label></th>
			<td>
				<select id="mensenhelpen_age_range" name="mensenhelpen_age_range">
					<option value=""><?php esc_html_e( 'Select...', 'mensenhelpen' ); ?></option>
					<option value="18-24" <?php selected( $age, '18-24' ); ?>>18-24</option>
					<option value="25-34" <?php selected( $age, '25-34' ); ?>>25-34</option>
					<option value="35-44" <?php selected( $age, '35-44' ); ?>>35-44</option>
					<option value="45-54" <?php selected( $age, '45-54' ); ?>>45-54</option>
					<option value="55+" <?php selected( $age, '55+' ); ?>>55+</option>
				</select>
			</td>
		</tr>
		<tr>
			<th><label><?php esc_html_e( 'Category Interests', 'mensenhelpen' ); ?></label></th>
			<td>
				<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
					<fieldset>
						<?php foreach ( $categories as $cat ) : ?>
							<label>
								<input type="checkbox" name="mensenhelpen_preferences[]" value="<?php echo esc_attr( $cat->term_id ); ?>" <?php checked( in_array( $cat->term_id, $preferences ) ); ?> />
								<?php echo esc_html( $cat->name ); ?>
							</label><br>
						<?php endforeach; ?>
					</fieldset>
				<?php else: ?>
					<p><?php esc_html_e( 'No categories found.', 'mensenhelpen' ); ?></p>
				<?php endif; ?>
			</td>
		</tr>
	</table>
	<?php
}
add_action( 'show_user_profile', 'mensenhelpen_add_user_meta_fields' );
add_action( 'edit_user_profile', 'mensenhelpen_add_user_meta_fields' );

// Save custom fields from user profile page in admin
function mensenhelpen_save_user_meta_fields( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if ( isset( $_POST['mensenhelpen_address'] ) ) {
		update_user_meta( $user_id, 'mensenhelpen_address', sanitize_textarea_field( $_POST['mensenhelpen_address'] ) );
	}
	if ( isset( $_POST['mensenhelpen_age_range'] ) ) {
		update_user_meta( $user_id, 'mensenhelpen_age_range', sanitize_text_field( $_POST['mensenhelpen_age_range'] ) );
	}
	
	if ( isset( $_POST['mensenhelpen_preferences'] ) && is_array( $_POST['mensenhelpen_preferences'] ) ) {
		$prefs = array_map( 'absint', $_POST['mensenhelpen_preferences'] );
		update_user_meta( $user_id, 'mensenhelpen_preferences', $prefs );
	} else {
		update_user_meta( $user_id, 'mensenhelpen_preferences', array() );
	}
}
add_action( 'personal_options_update', 'mensenhelpen_save_user_meta_fields' );
add_action( 'edit_user_profile_update', 'mensenhelpen_save_user_meta_fields' );

/**
 * Handle Frontend Registration (AJAX or Standard POST)
 * We will use AJAX via inc/ajax.php, this file is just for user meta structures currently.
 */
