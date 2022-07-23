<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod('understrap_container_type');
$album = get_field('project_album');
?>

<div class="wrapper" id="single-wrapper">

  <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

    <div class="row">

      <main class="site-main col-md-12" id="main">
        <div id="project-carousel" class="slider">
          <?php while (have_posts()): the_post();

    foreach ($album as $key => $item):
        if ($item['media']) {
            $params = $item['controls'] ? '' : '?autoplay=1&loop=1&autopause=0&background=1';
            ?>
          <iframe src="https://player.vimeo.com/video/<?php echo $item['video'] . $params ?>" frameborder="0"
            allow="autoplay; fullscreen" allowfullscreen></iframe>

          <?php } else {?>
			<div class="has-image">
				<img src="<?php echo $item['image']['url'] ?>" alt="<?php echo $item['image']['alt'] ?>" />
			</div>
          <?php }?>
          <?php endforeach;?>
          <?php understrap_post_nav();?>

          <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()):
        comments_template();
    endif;
    ?>

          <?php endwhile; // end of the loop. ?>
        </div>
        <button class="carousel-control-prev">
          <img src="<?php echo get_template_directory_uri() . '/images/left-arrow.svg' ?>" alt="Next" />
          <span class="sr-only">Previous</span>
          <div class="carousel-tracker">
            <p class="current"></p>
            <p class="total"></p>
          </div>
        </button>
        <button class="carousel-control-next">
          <div class="carousel-tracker">
            <p class="current"></p>
            <p class="total"></p>
          </div>
          <img src="<?php echo get_template_directory_uri() . '/images/right-arrow.svg' ?>" alt="Next" />
          <span class="sr-only">Next</span>
        </button>

      </main><!-- #main -->

    </div><!-- .row -->

  </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer();?>