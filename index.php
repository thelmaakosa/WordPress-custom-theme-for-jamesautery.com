<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">

  <div class="container" id="content" tabindex="-1">

    <h1 class="mt-3 mb-5"><?php single_post_title(); ?></h1>

    <div class="row justify-content-center">

      <main class="site-main col-md-10" id="main">

        <?php if ( have_posts() ) : ?>

        <?php /* Start the Loop */ ?>

        <?php while ( have_posts() ) : the_post(); ?>

        <?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', get_post_format() );
						?>

        <?php endwhile; ?>

        <?php else : ?>

        <?php get_template_part( 'loop-templates/content', 'none' ); ?>

        <?php endif; ?>

      </main><!-- #main -->

      <!-- The pagination component -->
      <div class="col-md-12">
        <?php understrap_pagination(); ?>
      </div>

      <!-- Do the right sidebar check -->
      <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

    </div><!-- .row -->

  </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer(); ?>