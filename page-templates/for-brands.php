<?php
/**
 * Template Name: For Brands
 */

get_header();
?>

<div class="page-header bg-gradient no-bottom-margin">
	<div class="container text-center text-white">
		<h1 class="page-title">Grow Your Brand With Authentic Experiences</h1>
		<p class="subtitle">Reach highly targeted consumers and receive powerful User-Generated Content (UGC) and detailed feedback.</p>
	</div>
</div>

<div class="container section-padding brand-benefits">
	<div class="split-layout align-center">
		<div class="split-side">
			<h2 class="text-primary">Why partner with MensenHelpen?</h2>
			<ul class="benefits-list">
				<li>
					<strong>Targeted Sampling</strong>
					<p>Don't just hand out samples randomly. We distribute your product specifically to users who declared interest in your niche.</p>
				</li>
				<li>
					<strong>Guaranteed Feedback Loop</strong>
					<p>Our reviewers agree to provide honest feedback, outlining specific pros and cons to help your R&D and marketing.</p>
				</li>
				<li>
					<strong>Boost Visibility</strong>
					<p>Great samples spread like wildfire. Increase product awareness entirely through cost-effective sampling.</p>
				</li>
			</ul>
		</div>
		<div class="split-side">
			<div class="glass-panel contact-form-wrapper">
				<h3>Start Your Campaign</h3>
				<form id="brand-inquiry-form" class="mensenhelpen-form" method="post">
					<div class="form-group">
						<label for="brand_company">Company Name <span class="required">*</span></label>
						<input type="text" id="brand_company" name="brand_company" required>
					</div>
					<div class="form-group">
						<label for="brand_name">Your Name <span class="required">*</span></label>
						<input type="text" id="brand_name" name="brand_name" required>
					</div>
					<div class="form-group">
						<label for="brand_email">Work Email <span class="required">*</span></label>
						<input type="email" id="brand_email" name="brand_email" required>
					</div>
					<div class="form-group">
						<label for="brand_message">Tell us about your product</label>
						<textarea id="brand_message" name="brand_message" rows="4"></textarea>
					</div>
					<div class="form-message js-form-message"></div>
					<button type="submit" class="btn btn-primary w-full js-submit-inquiry">Send Inquiry</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
