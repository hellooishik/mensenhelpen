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
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$mensenhelpen_description = get_bloginfo( 'description', 'display' );
					if ( $mensenhelpen_description || is_customize_preview() ) :
						?>
						<p class="site-description screen-reader-text"><?php echo $mensenhelpen_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif;
				}
				?>
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
