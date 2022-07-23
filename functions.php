<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

/**
 * Create custom post type for albums
 */
function create_albums() {
	register_post_type( 'projects',
	// CPT Options
	array(
		'labels' => array(
			'name'                => _x( 'Projects', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Projects', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Project:', 'text_domain' ),
			'all_items'           => __( 'All Project', 'text_domain' ),
			'view_item'           => __( 'View Project', 'text_domain' ),
			'add_new_item'        => __( 'Add New Project', 'text_domain' ),
			'add_new'             => __( 'Add New', 'text_domain' ),
			'edit_item'           => __( 'Edit Project', 'text_domain' ),
			'update_item'         => __( 'Update Project', 'text_domain' ),
			'search_items'        => __( 'Search Project', 'text_domain' ),
		),
		'public' => true,
		'has_archive' => true,
		'show_in_nav_menus' => true,
		'menu_icon' => 'dashicons-images-alt2',
		'show_in_rest' => true,
		'menu_position' => 20
	 )
	);
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'create_albums' );

	/**
	 * Remove pagination from archive pages
	 */
	function no_nopaging($query) {
		if (is_post_type_archive()) {
			$query->set('nopaging', 1);
		}
	}
	add_action('parse_query', 'no_nopaging');

	/**
	 * Add settings for Advanced Custom Fields
	 */
	if( function_exists('acf_add_local_field_group') ):

		acf_add_local_field_group(array(
			'key' => 'group_5d04d81320363',
			'title' => 'Front Page',
			'fields' => array(
				array(
					'key' => 'field_5d04d81a50a18',
					'label' => 'Video',
					'name' => 'front_page_video',
					'type' => 'text',
					'instructions' => 'Enter the ID for the video you\'d like to display on the front page. This can be found at the end of the Vimeo URL. e.g. https://vimeo.com/XXXXXXX',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_type',
						'operator' => '==',
						'value' => 'front_page',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5d12218879ba2',
			'title' => 'News',
			'fields' => array(
				array(
					'key' => 'field_5d12218e83c02',
					'label' => 'Custom URL',
					'name' => 'custom_url',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array(
					'key' => 'field_5d12246ff1871',
					'label' => 'Open in new tab?',
					'name' => 'new_tab',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => '',
					'default_value' => 0,
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'post',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		));
		
		acf_add_local_field_group(array(
			'key' => 'group_5d04e1302a4fe',
			'title' => 'Project',
			'fields' => array(
				array(
					'key' => 'field_5d04e53bae1c2',
					'label' => 'Project Image',
					'name' => 'project_image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'preview_size' => 'medium',
					'library' => 'all',
					'min_width' => '',
					'min_height' => '',
					'min_size' => '',
					'max_width' => '',
					'max_height' => '',
					'max_size' => '',
					'mime_types' => '',
				),
				array(
					'key' => 'field_5d04e133cd69a',
					'label' => 'Project Album',
					'name' => 'project_album',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'block',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_5d1587f29ec47',
							'label' => 'Media',
							'name' => 'media',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => 'Video',
							'ui_off_text' => 'Image',
						),
						array(
							'key' => 'field_5d0b7a20acab7',
							'label' => 'Controls?',
							'name' => 'controls',
							'type' => 'true_false',
							'instructions' => 'Select whether the video should show controls or not.',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5d1587f29ec47',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'message' => '',
							'default_value' => 0,
							'ui' => 0,
							'ui_on_text' => '',
							'ui_off_text' => '',
						),
						array(
							'key' => 'field_5d0b7ac4acab8',
							'label' => 'Video ID',
							'name' => 'video',
							'type' => 'text',
							'instructions' => 'Enter the ID for the video you\'d like to display. This can be found in the Vimeo URL.',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5d1587f29ec47',
										'operator' => '==',
										'value' => '1',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_5d1588469ec48',
							'label' => 'Image',
							'name' => 'image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => array(
								array(
									array(
										'field' => 'field_5d1587f29ec47',
										'operator' => '!=',
										'value' => '1',
									),
								),
							),
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'array',
							'preview_size' => 'medium',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'projects',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => array(
				0 => 'the_content',
			),
			'active' => true,
			'description' => '',
		));
		
		endif;