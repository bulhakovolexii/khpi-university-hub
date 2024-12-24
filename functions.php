<?php
/**
 * Functions and definitions for the child theme.
 */
add_action(
    'after_setup_theme',
    function () {
        // Remove support for block styles, editor and custom background.
        remove_theme_support('wp-block-styles');
        remove_theme_support('editor-styles');
        remove_theme_support('editor-color-palette');
        remove_theme_support('custom-background');
    },
    20
);

/**
 * Disable parent theme styles.
 */
function child_theme_dequeue_parent_styles()
{
    wp_dequeue_style('university-hub-google-fonts'); // Parent theme font.
    wp_dequeue_style('university-hub-font-awesome'); // Parent theme icon font.
    wp_dequeue_style('university-hub-block-style'); // Block styles.
    wp_dequeue_style('university-hub-editor-style'); // Editor styles.
}
add_action('wp_enqueue_scripts', 'child_theme_dequeue_parent_styles', 20);
add_action(
    'enqueue_block_editor_assets',
    'child_theme_dequeue_parent_styles',
    20
);

/**
 * Connect child theme styles and scripts.
 */
function child_theme_enqueue_styles()
{
    wp_enqueue_style(
        'child-theme-style',
        get_stylesheet_directory_uri() . '/css/blocks.css',
        [],
        '1.0.0'
    );
    wp_enqueue_style(
        'child-theme-google-fonts',
        'https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap'
    );
    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        '6.5.0'
    );
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles');

/**
 * Adding child theme block editor settings.
 */
function child_theme_block_editor_styles()
{
    wp_enqueue_style(
        'child-theme-editor-style',
        get_stylesheet_directory_uri() . '/css/editor-blocks.css',
        [],
        '1.0.0'
    );
}
add_action('enqueue_block_editor_assets', 'child_theme_block_editor_styles');

/**
 * Override color palette and font sizes in the editor.
 */
function child_theme_setup_editor_features()
{
    add_theme_support('editor-color-palette', [
        [
            'name' => __('Red', 'university-hub'),
            'slug' => 'red',
            'color' => '#a0001b', // #e4572e => #a0001b
        ],
        [
            'name' => __('Yellow', 'university-hub'),
            'slug' => 'yellow',
            'color' => '#fbb800', // #f4a024 => #fbb800
        ],
        [
            'name' => __('Black', 'university-hub'),
            'slug' => 'black',
            'color' => '#2a2a2a', // #000 => #2a2a2a
        ],
        [
            'name' => __('White', 'university-hub'),
            'slug' => 'white',
            'color' => '#fcfcfc', // #ffffff =>  #fcfcfc
        ],
        [
            'name' => __('Gray', 'university-hub'),
            'slug' => 'gray',
            'color' => '#6c6c6c', // #727272 => #6c6c6c
        ],
        [
            'name' => __('Blue', 'university-hub'),
            'slug' => 'blue',
            'color' => '#3eb1c8', // #179bd7 => #3eb1c8
        ],
        [
            'name' => __('Navy Blue', 'university-hub'),
            'slug' => 'navy-blue',
            'color' => '#328895', // #253b80 => #328895
        ],
        [
            'name' => __('Light Blue', 'university-hub'),
            'slug' => 'light-blue',
            'color' => '#e2f8fc', // #f7fcfe => #e2f8fc
        ],
        [
            'name' => __('Orange', 'university-hub'),
            'slug' => 'orange',
            'color' => '#f96605', // #ff6000 => #f96605
        ],
        [
            'name' => __('Green', 'university-hub'),
            'slug' => 'green',
            'color' => '#00a085', // #77a464 => #00a085
        ],
    ]);
}
add_action('after_setup_theme', 'child_theme_setup_editor_features', 20);

/**
 * Enables theme color inheritance for qubely
 */
function active_theme_preset()
{
    do_action('qubely_active_theme_preset');
}
add_action('after_switch_theme', 'active_theme_preset');

/**
 * Change http links to https when inserting files
 */
add_filter('media_send_to_editor', 'force_protocol_relative');
function force_protocol_relative($content)
{
    $content = str_replace('http://', 'https://', $content);
    return $content;
}

/**
 * Dashicons connections
 */
function load_dashicons()
{
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'load_dashicons');

/**
 * Custom js connections
 */
function enqueue_child_theme_scripts()
{
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/js/custom.js',
        [], // Dependencies (e.g. jQuery)
        null, // Version (null for automatic)
        true // Include in footer (true) or head (false)
    );
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_scripts');

if (!function_exists('khpi_university_hub_custom_content_width')):
    /**
     * Custom content width.
     *
     * @since 1.0.0
     */
    function khpi_university_hub_custom_content_width()
    {
        global $post, $wp_query, $content_width;

        $global_layout = university_hub_get_option('global_layout');
        $global_layout = apply_filters(
            'university_hub_filter_theme_global_layout',
            $global_layout
        );

        // Check if single.
        if ($post && is_singular()) {
            $post_options = get_post_meta(
                $post->ID,
                'university_hub_theme_settings',
                true
            );
            if (
                isset($post_options['post_layout']) &&
                !empty($post_options['post_layout'])
            ) {
                $global_layout = esc_attr($post_options['post_layout']);
            }
        }
        switch ($global_layout) {
            case 'no-sidebar':
                $content_width = 1200;
                break;

            case 'three-columns':
                $content_width = 585;
                break;

            case 'left-sidebar':
            case 'right-sidebar':
                $content_width = 831;
                break;

            default:
                break;
        }
    }
endif;

add_filter('template_redirect', 'khpi_university_hub_custom_content_width', 20);
