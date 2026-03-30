</main><!-- #primary -->

	<footer id="colophon" class="site-footer">
		<div class="container footer-widgets">
			<div class="footer-widget-area">
				<h3 class="widget-title">MensenHelpen</h3>
				<p>The leading platform for product discovery and real user feedback. We help you try the best brands for free while providing honest reviews to the community.</p>
			</div>
			
			<div class="footer-widget-area">
				<h3 class="widget-title">Quick Links</h3>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'container'      => false,
						'fallback_cb'    => false,
					)
				);
				?>
			</div>
			
			<div class="footer-widget-area">
				<h3 class="widget-title">For Brands</h3>
				<p>Want to reach targeted consumers and get honest UGC and reviews? Partner with us.</p>
				<a href="<?php echo esc_url( home_url( '/for-brands' ) ); ?>" class="btn btn-outline footer-btn">Partner With Us</a>
			</div>
			
			<div class="footer-widget-area">
				<h3 class="widget-title">Legal</h3>
				<ul class="footer-links">
					<li><a href="<?php echo esc_url( home_url( '/terms-conditions' ) ); ?>">Terms & Conditions</a></li>
					<li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">Privacy Policy</a></li>
				</ul>
			</div>
		</div>
		
		<div class="site-info container">
			<p>&copy; <?php echo date( 'Y' ); ?> MensenHelpen. All rights reserved. Your voice, your impact.</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<!-- Login Modal -->
<div class="modal overlay js-modal" id="login-modal" aria-hidden="true">
	<div class="modal-dialog">
		<button class="modal-close js-modal-close" aria-label="Close modal">&times;</button>
		<div class="modal-header text-center mb-4">
			<h2>Welcome Back</h2>
			<p>Sign in to your account</p>
		</div>
		<?php wp_login_form(); ?>
		<div class="text-center mt-3">
			<p>Don't have an account? <a href="#register" class="js-open-register">Sign Up Free</a></p>
		</div>
	</div>
</div>

<!-- Register Modal -->
<div class="modal overlay js-modal" id="register-modal" aria-hidden="true">
	<div class="modal-dialog">
		<button class="modal-close js-modal-close" aria-label="Close modal">&times;</button>
		<div class="modal-header text-center mb-4">
			<h2>Join MensenHelpen</h2>
			<p>Start receiving free samples today</p>
		</div>
		
		<form id="register-form" class="mensenhelpen-form">
			<div class="form-group">
				<label for="reg_name">Full Name <span class="required">*</span></label>
				<input type="text" id="reg_name" required>
			</div>
			<div class="form-group">
				<label for="reg_email">Email Address <span class="required">*</span></label>
				<input type="email" id="reg_email" required>
			</div>
			<div class="form-group">
				<label for="reg_password">Password <span class="required">*</span></label>
				<input type="password" id="reg_password" required>
			</div>
			<div class="form-group">
				<label for="reg_address">Shipping Address <span class="required">*</span></label>
				<textarea id="reg_address" rows="2" required placeholder="Where should we send your samples?"></textarea>
			</div>
			<div class="form-group">
				<label for="reg_age">Age Range</label>
				<select id="reg_age">
					<option value="">Select...</option>
					<option value="18-24">18-24</option>
					<option value="25-34">25-34</option>
					<option value="35-44">35-44</option>
					<option value="45-54">45-54</option>
					<option value="55+">55+</option>
				</select>
			</div>
			
			<div class="form-group checkbox-group">
				<label>
					<input type="checkbox" required>
					<span>I agree to provide honest feedback for samples received.</span>
				</label>
			</div>
			
			<div class="form-message js-form-message"></div>
			<button type="submit" class="btn btn-primary w-full">Sign Up Free</button>
		</form>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
