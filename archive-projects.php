<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="archive-wrapper">

  <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

    <div class="row">

      <main class="site-main col-md-12" id="main">
        <div class="row">
          <?php if (have_posts()): while (have_posts()): the_post();
        $image = get_field('project_image');
        ?>

          <div class="col-md-6">
            <a href="<?php the_permalink()?>">
              <img src="<?php echo $image['url'] ?>" alt="<?php the_title()?>">
              <div class="overlay">
                <span><?php the_title()?></span>
              </div>
            </a>
          </div>

          <?php endwhile;?>

          <?php else: ?>

          <?php get_template_part('loop-templates/content', 'none');?>

          <?php endif;?>
        </div>
      </main><!-- #main -->

    </div> <!-- .row -->

  </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php get_footer();?>