<?php
/**
 * Functions and definitions for the child theme.
 */

add_action('after_setup_theme', function () {
    // Remove support for block styles, editor and custom background.
    remove_theme_support('wp-block-styles');
    remove_theme_support('editor-styles');
    remove_theme_support('editor-color-palette');
	remove_theme_support('custom-background');
}, 20);

/**
 * Disable parent theme styles.
 */
function child_theme_dequeue_parent_styles() {
    wp_dequeue_style('university-hub-google-fonts'); // Parent theme font.
	wp_dequeue_style('university-hub-font-awesome'); // Parent theme icon font.
    wp_dequeue_style('university-hub-block-style'); // Block styles.
    wp_dequeue_style('university-hub-editor-style'); // Editor styles.
}
add_action('wp_enqueue_scripts', 'child_theme_dequeue_parent_styles', 20);
add_action('enqueue_block_editor_assets', 'child_theme_dequeue_parent_styles', 20);

/**
 * Connect child theme styles and scripts.
 */
function child_theme_enqueue_styles() {
    wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/css/blocks.css', array(), '1.0.0');
    wp_enqueue_style('child-theme-google-fonts', 'https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap',);
	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0');
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles');

/**
 * Adding child theme block editor settings.
 */
function child_theme_block_editor_styles() {
    wp_enqueue_style('child-theme-editor-style', get_stylesheet_directory_uri() . '/css/editor-blocks.css', array(), '1.0.0');
}
add_action('enqueue_block_editor_assets', 'child_theme_block_editor_styles');

/**
 * Override color palette and font sizes in the editor.
 */
function child_theme_setup_editor_features() {
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Black', 'university-hub' ),
				'slug'  => 'black',
				'color' => '#2a2a2a', // #000 => #2a2a2a
			),
			array(
				'name'  => __( 'White', 'university-hub' ),
				'slug'  => 'white',
				'color' => '#fcfcfc', // #ffffff =>  #fcfcfc
			),
			array(
				'name'  => __( 'Gray', 'university-hub' ),
				'slug'  => 'gray',
				'color' => '#6c6c6c', // #727272 => #6c6c6c
			),
			array(
				'name'  => __( 'Blue', 'university-hub' ),
				'slug'  => 'blue',
				'color' => '#3eb1c8', // #179bd7 => #3eb1c8
			),
			array(
				'name'  => __( 'Navy Blue', 'university-hub' ),
				'slug'  => 'navy-blue',
				'color' => '#328895', // #253b80 => #328895
			),
			array(
				'name'  => __( 'Light Blue', 'university-hub' ),
				'slug'  => 'light-blue',
				'color' => '#e2f8fc', // #f7fcfe => #e2f8fc
			),
			array(
				'name'  => __( 'Orange', 'university-hub' ),
				'slug'  => 'orange',
				'color' => '#f96605', // #ff6000 => #f96605
			),
			array(
				'name'  => __( 'Green', 'university-hub' ),
				'slug'  => 'green',
				'color' => '#00a085', // #77a464 => #00a085
			),
			array(
				'name'  => __( 'Red', 'university-hub' ),
				'slug'  => 'red',
				'color' => '#a0001b', // #e4572e => #a0001b
			),
			array(
				'name'  => __( 'Yellow', 'university-hub' ),
				'slug'  => 'yellow',
				'color' => '#fbb800', // #f4a024 => #fbb800
			),
		)
	);
}
add_action('after_setup_theme', 'child_theme_setup_editor_features', 20);

// Change http links to https when inserting files
add_filter( 'media_send_to_editor', 'force_protocol_relative');
function force_protocol_relative($content) {

  $content = str_replace( 'http://', 'https://', $content );

  return $content;
}