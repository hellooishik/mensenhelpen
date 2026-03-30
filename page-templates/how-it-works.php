<?php
/**
 * Template Name: How It Works
 */

get_header();
?>

<div class="page-header bg-gradient no-bottom-margin">
	<div class="container text-center text-white">
		<h1 class="page-title">How It Works</h1>
		<p class="subtitle">Connecting the best brands with the most engaged consumers.</p>
	</div>
</div>

<div class="container section-padding split-layout">
	<!-- Left Side: For Users -->
	<div class="split-side for-users card glass-panel">
		<h2 class="text-primary text-center">For Users</h2>
		<p class="text-center">Get your hands on free samples and share what you think.</p>
		
		<ul class="steps-list">
			<li>
				<div class="step-num">1</div>
				<div class="step-txt">
					<h4>Sign up and tell us about yourself</h4>
					<p>Create a profile, select your age range, address, and product interests (e.g. Skincare, Wellness).</p>
				</div>
			</li>
			<li>
				<div class="step-num">2</div>
				<div class="step-txt">
					<h4>Get matched with available samples</h4>
					<p>Brands are looking for someone just like you. Browse available products and request them.</p>
				</div>
			</li>
			<li>
				<div class="step-num">3</div>
				<div class="step-txt">
					<h4>Receive your free sample in the mail</h4>
					<p>The product gets shipped directly to you at absolutely no cost.</p>
				</div>
			</li>
			<li>
				<div class="step-num">4</div>
				<div class="step-txt">
					<h4>Share your honest review</h4>
					<p>Come back to the platform to leave a 1-5 star review outlining your pros and cons. Your opinions matter!</p>
				</div>
			</li>
		</ul>
		<div class="text-center mt-3">
			<?php if ( ! is_user_logged_in() ) : ?>
				<a href="#register" class="btn btn-primary w-full js-open-register">Sign Up Now</a>
			<?php endif; ?>
		</div>
	</div>

	<!-- Right Side: For Brands -->
	<div class="split-side for-brands card glass-panel bg-light">
		<h2 class="text-secondary text-center">For Brands</h2>
		<p class="text-center">Get real user-generated feedback and buzz for your products.</p>
		
		<ul class="steps-list">
			<li>
				<div class="step-num">1</div>
				<div class="step-txt">
					<h4>Partner with MensenHelpen</h4>
					<p>Reach out securely to describe your product and target demographic.</p>
				</div>
			</li>
			<li>
				<div class="step-num">2</div>
				<div class="step-txt">
					<h4>Ship samples to our distribution</h4>
					<p>You send the products. We handle the fulfillment and targeting.</p>
				</div>
			</li>
			<li>
				<div class="step-num">3</div>
				<div class="step-txt">
					<h4>Reach exactly the right people</h4>
					<p>We leverage our user interests database to drop the sample into the hands of willing reviewers.</p>
				</div>
			</li>
			<li>
				<div class="step-num">4</div>
				<div class="step-txt">
					<h4>Harvest User-Generated Content</h4>
					<p>Collect high-quality authentic reviews highlighting pros and cons, which helps drive subsequent sales.</p>
				</div>
			</li>
		</ul>
		<div class="text-center mt-3">
			<a href="<?php echo esc_url( home_url( '/for-brands' ) ); ?>" class="btn btn-outline w-full">Partner Dashboard</a>
		</div>
	</div>
</div>

<?php get_footer(); ?>
