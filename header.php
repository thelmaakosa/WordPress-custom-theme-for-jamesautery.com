<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );
$front_page = is_front_page() ? 'front-page' : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class($front_page); ?>>
  <?php do_action( 'wp_body_open' ); ?>
  <div class="site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <div id="wrapper-navbar" itemscope itemtype="https://schema.org/WebSite">

      <a class="skip-link sr-only sr-only-focusable"
        href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

      <nav class="navbar navbar-expand-md navbar-dark bg-primary">

        <?php if ( 'container' == $container ) : ?>
        <div class="container">
          <?php endif; ?>

          <!-- Your site title as branding in the menu -->
          <?php if ( ! has_custom_logo() ) { ?>

          <?php if ( is_front_page() && is_home() ) : ?>

          <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
              title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
              itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

          <?php else : ?>

          <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
            title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
            itemprop="url"><?php bloginfo( 'name' ); ?></a>

          <?php endif; ?>


          <?php } else {
						the_custom_logo();
					} ?>
          <!-- end custom logo -->

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div id="navbarNavDropdown" class="collapse navbar-collapse">
            <!-- The WordPress Menu goes here -->
            <?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'ml-auto',
						'container_id'    => '',
						'menu_class'      => 'navbar-nav ',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?>
            <div class="social-menu">
              <?php if ( get_theme_mod('understrap_instagram') ) : ?>
              <a href="<?php echo get_theme_mod('understrap_instagram') ?>" class="mr-2" target="_blank"><span class="fa fa-instagram"></span></a>
              <?php endif; ?>
				<?php if ( get_theme_mod('understrap_vimeo') ) : ?>
              <a href="<?php echo get_theme_mod('understrap_vimeo') ?>" target="_blank"><span class="fa fa-vimeo"></span></a>
              <?php endif; ?>
            </div>
          </div>
          <?php if ( 'container' == $container ) : ?>
        </div><!-- .container -->
        <?php endif; ?>

      </nav><!-- .site-navigation -->

    </div><!-- #wrapper-navbar end -->