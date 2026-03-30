<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<!-- Google Fonts: Inter -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'mensenhelpen' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container site-header-wrapper">
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo-group" rel="home">
					<div class="header-logo-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
					</div>
					<span>MensenHelpen</span>
				</a>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'mensenhelpen' ); ?></span>
					<span class="hamburger-icon"></span>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'fallback_cb'    => false, // Don't list pages if no menu
					)
				);
				?>
				<div class="header-actions">
					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>" class="btn btn-outline">My Account</a>
						<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="btn btn-text">Log Out</a>
					<?php else : ?>
						<!-- We will use a custom login/register later, linking to default for now -->
						<a href="#register" class="btn btn-primary js-open-register">Sign Up Free</a>
						<a href="#login" class="btn btn-outline js-open-login">Log In</a>
					<?php endif; ?>
				</div>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<main id="primary" class="site-main">
