</main><!-- #primary -->

	<footer id="colophon" class="site-footer">
		<div class="container footer-grid">
			<div class="footer-column">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">MENSENHELPEN</a>
				<p>Mensenhelpen connects you with honest product reviews.</p>
				<div class="footer-socials">
					<a href="#" aria-label="Facebook"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
					<a href="#" aria-label="Instagram"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
					<a href="#" aria-label="TikTok"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.89-.6-4.13-1.47V18c0 3.31-2.69 6-6 6s-6-2.69-6-6 2.69-6 6-6c.3 0 .61.02.91.06v4.06c-.3-.04-.6-.06-.91-.06-1.1 0-2 1.34-2 2s.9 2 2 2 2-1.34 2-2V.02z"/></svg></a>
					<a href="#" aria-label="X"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
				</div>
			</div>
			
			<div class="footer-column">
				<h3>CONTACT</h3>
				<p>+44 700 283304</p>
				<p>info@mensenhelpen.co.uk</p>
			</div>
			
			<div class="footer-column">
				<h3>LEGAL</h3>
				<form id="footer-subscribe" class="mb-4">
					<label for="footer_email" class="screen-reader-text">Your email</label>
					<input type="email" id="footer_email" placeholder="Your email" class="form-input mb-2" style="width: 100%; border-color: rgba(255,255,255,0.2); background: rgba(255,255,255,0.05); color: white;">
					<button type="submit" class="btn btn-primary w-full" style="padding: 12px;">Subscribe</button>
				</form>
				<div class="footer-links-row">
					<a href="<?php echo esc_url( home_url( '/terms-conditions' ) ); ?>" class="btn-text" style="color: rgba(255,255,255,0.6); font-size: 0.8rem; margin-right: 15px;">Terms</a>
					<a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" class="btn-text" style="color: rgba(255,255,255,0.6); font-size: 0.8rem;">Privacy</a>
				</div>
			</div>
		</div>
		
		<div class="container footer-bottom">
			<p>© 2025. All rights reserved.</p>
		</div>
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
