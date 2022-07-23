<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );
$video = get_field('front_page_video');
?>

<div class="wrapper" id="page-wrapper">

  <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

    <div class="row justify-content-center">

      <main class="site-main col-md-11" id="main">

        <?php while ( have_posts() ) : the_post(); ?>

        <iframe
          src="https://player.vimeo.com/video/<?php the_field('front_page_video') ?>?autoplay=1&loop=1&autopause=0&background=1"
          frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>



        <?php endwhile; // end of the loop. ?>

      </main><!-- #main -->

    </div><!-- .row -->

  </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php get_footer(); ?>