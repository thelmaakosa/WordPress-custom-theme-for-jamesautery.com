<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

  <header class="entry-header">

    <?php
		$target = get_field('new_tab') ? 'target="_blank" rel="noopener"' : 'rel="bookmark"';
		the_title(
			sprintf( '<h2 class="entry-title"><a href="%s" ' . $target . '>', esc_url( get_field('custom_url') ? get_field('custom_url') : get_permalink() ) ),
			'</a></h2>'
		);
		?>

    <?php if ( 'post' == get_post_type() ) : 
			$auth = get_the_author();
			$authLink = get_the_author_link();
			$cat = get_the_category()[0];
			$com = get_comments_number();
		?>

    <small class="entry-meta">
      <?php echo "By: <a href='/author/" . $authLink . "'>" . $auth . "</a> | Posted: " . get_the_date() . " | Category: <a href='/category/" . $cat->slug . "'>" . $cat->name . "</a> | Comments: $com"; ?>
    </small><!-- .entry-meta -->

    <?php endif; ?>

  </header><!-- .entry-header -->

  <div class="entry-content">
    <a href="<?php get_field('custom_url') ? the_field('custom_url') : the_permalink() ?>"
      <?php echo $target ?>>Continue
      Reading
      →</a>
  </div><!-- .entry-content -->

  <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

  <?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

  <hr>

</article><!-- #post-## -->