<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('understrap_scripts')) {
    /**
     * Load theme's JavaScript and CSS sources.
     */
    function understrap_scripts()
    {
        // Get the theme data.
        $the_theme = wp_get_theme();
        $theme_version = $the_theme->get('Version');
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Rufina:300,400&display=swap', false);

        $css_version = $theme_version . '.' . filemtime(get_template_directory() . '/css/theme.min.css');
        wp_enqueue_style('understrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version);

        wp_enqueue_script('jquery');

        $js_version = $theme_version . '.' . filemtime(get_template_directory() . '/js/theme.min.js');
        wp_enqueue_script('understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true);
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        if (is_singular('projects')) {
            // There are some bugs in the slick.min.js file, so the unminified version should be used.
            wp_enqueue_script('slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.8.1', true);
            wp_enqueue_script('single-project', get_template_directory_uri() . '/js/single-project.js', array('jquery'), $js_version, true);
        }
        if (is_singular('post')) {
            wp_enqueue_script('swipebox-js', get_template_directory_uri() . '/js/jquery.swipebox.min.js', array('jquery'), $js_version, true);
            wp_enqueue_script('single-post', get_template_directory_uri() . '/js/single-post.js', array('jquery', 'swipebox-js'), $js_version, true);
        }
    }
} // endif function_exists( 'understrap_scripts' ).

add_action('wp_enqueue_scripts', 'understrap_scripts');