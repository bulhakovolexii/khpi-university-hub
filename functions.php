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
    20,
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
add_action('enqueue_block_editor_assets', 'child_theme_dequeue_parent_styles', 20);

/**
 * Connect child theme styles and scripts.
 */
function child_theme_enqueue_styles()
{
    wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/css/blocks.css', [], '1.0.0');
    wp_enqueue_style('child-theme-google-fonts', 'https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], '6.5.0');
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles', 20);

/**
 * Adding child theme block editor settings.
 */
function child_theme_block_editor_styles()
{
    wp_enqueue_style('child-theme-editor-style', get_stylesheet_directory_uri() . '/css/editor-blocks.css', [], '1.0.0');
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
 * Adding a color palette switcher
 */
function register_theme_customizer($wp_customize)
{
    $wp_customize->add_setting('theme_palette', [
        'default' => 'Dark',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_section('theme_options', [
        'title' => 'Кольорова палітра',
        'priority' => 30,
    ]);

    $wp_customize->add_control('theme_palette_control', [
        'label' => 'Оберіть кольорову палітру',
        'section' => 'theme_options',
        'settings' => 'theme_palette',
        'type' => 'radio',
        'choices' => [
            'dark' => 'Dark',
            'light' => 'Light',
            'light-alternative' => 'Light Alternative',
        ],
    ]);
}
add_action('customize_register', 'register_theme_customizer');

function add_theme_body_class($classes)
{
    $theme_palette = get_theme_mod('theme_palette', 'default');

    if ($theme_palette !== 'default') {
        $classes[] = 'theme-' . $theme_palette;
    }

    return $classes;
}
add_filter('body_class', 'add_theme_body_class');

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
        true, // Include in footer (true) or head (false)
    );
}
add_action('wp_enqueue_scripts', 'enqueue_child_theme_scripts');

/**
 * Custom content width.
 */
if (!function_exists('khpi_university_hub_custom_content_width')):
    function khpi_university_hub_custom_content_width()
    {
        global $post, $wp_query, $content_width;

        $global_layout = university_hub_get_option('global_layout');
        $global_layout = apply_filters('university_hub_filter_theme_global_layout', $global_layout);

        // Check if single.
        if ($post && is_singular()) {
            $post_options = get_post_meta($post->ID, 'university_hub_theme_settings', true);
            if (isset($post_options['post_layout']) && !empty($post_options['post_layout'])) {
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

/**
 * New footer hook
 */
require_once get_theme_file_path('inc/new-footer.php');

/**
 * Choosing between calendars and thumbnails in News and Events
 * And another customizer options
 */
function khpi_university_hub_customize_register($wp_customize)
{
    // Adding a display selection setting to an existing section
    $wp_customize->add_setting('home_news_display_style', [
        'default' => 'calendar', // Default value
        'sanitize_callback' => 'sanitize_text_field', // Data verificationх
    ]);

    // Adding a control to the section_home_news_and_events section
    $wp_customize->add_control('home_news_display_style', [
        'label' => __('Стиль мініатюр подій', 'university-hub'),
        'section' => 'section_home_news_and_events', // Specifying an existing section
        'type' => 'radio',
        'choices' => [
            'calendar' => __('Дата', 'university-hub'),
            'thumbnail' => __('Мініатюра', 'university-hub'),
        ],
    ]);

    // Setting news_and_events_image_size.
    $wp_customize->add_setting('theme_options[news_and_events_image_size]', [
        'default' => 'university-hub-thumb', // Default value
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'university_hub_sanitize_select',
    ]);

    $wp_customize->add_control('theme_options[news_and_events_image_size]', [
        'label' => __('Розмір зображення новин', 'university-hub'),
        'section' => 'section_home_news_and_events',
        'type' => 'select',
        'priority' => 100,
        'choices' => university_hub_get_image_sizes_options(false),
    ]);

    $wp_customize->add_section('share_buttons_section', [
        'title' => __('Кнопки "Поділитись"', 'khpi-university-hub'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('enable_share_buttons', [
        'default' => '1',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('enable_share_buttons_control', [
        'label' => __('Увімкнути кнопки "Поділитись"', 'khpi-university-hub'),
        'section' => 'share_buttons_section',
        'settings' => 'enable_share_buttons',
        'type' => 'checkbox',
    ]);

    $wp_customize->add_section('custom_search_settings', [
        'title' => __('Налаштування пошуку', 'university-hub'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('google_cse_id', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('google_cse_id', [
        'label' => __('Google CSE ID', 'university-hub'),
        'section' => 'custom_search_settings',
        'type' => 'text',
    ]);
}
add_action('customize_register', 'khpi_university_hub_customize_register');

/**
 * Custom thumb sizes
 */
add_action(
    'after_setup_theme',
    function () {
        // Change old size
        remove_image_size('university-hub-thumb');
        add_image_size('university-hub-thumb', 400, 300, true); // Crop enabled

        // Register new size
        add_image_size('university-hub-thumb-3-2', 450, 300, true); // 3:2
        add_image_size('university-hub-thumb-1-1', 400, 400, true); // 1:1
    },
    20,
);

add_filter('image_size_names_choose', function ($sizes) {
    return array_merge($sizes, [
        'university-hub-thumb-3-2' => __('3:2 Thumbnail', 'university-hub'),
        'university-hub-thumb-1-1' => __('1:1 Thumbnail', 'university-hub'),
    ]);
});

add_filter('university_hub_get_image_sizes_options', function ($sizes) {
    $sizes['university-hub-thumb-3-2'] = __('3:2 Thumbnail', 'university-hub');
    $sizes['university-hub-thumb-1-1'] = __('1:1 Thumbnail', 'university-hub');

    return $sizes;
});

/**
 * Add child theme translations
 */
function childtheme_load_textdomain()
{
    load_child_theme_textdomain('khpi-university-hub', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'childtheme_load_textdomain', 20);

function childtheme_override_translation($translated_text, $text, $domain)
{
    if ($domain === 'university-hub' && $text === 'Top Menu') {
        $translated_text = __('Language Menu', 'khpi-university-hub');
    }

    return $translated_text;
}
add_filter('gettext', 'childtheme_override_translation', 10, 3);

/**
 * Change "|" symbol in site title to tag <br>
 */
add_filter(
    'bloginfo',
    function ($output, $show) {
        if ($show === 'name') {
            $output = str_replace('|', '<br>', $output);
        }
        return $output;
    },
    10,
    2,
);

/**
 * Enable polylang settings in customizer
 */
add_action('after_setup_theme', function () {
    if (!function_exists('is_plugin_active')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    if (!is_plugin_active('add-polylang-support-for-customizer/apsfc.php')) {
        require_once get_theme_file_path('/customizer-polylang.php');
    }
});

/**
 * Total disabling comments
 */
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit();
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});
