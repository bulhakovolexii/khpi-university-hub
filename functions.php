<?php
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package University_Hub
 */

if ( ! function_exists( 'university_hub_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function university_hub_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'university-hub', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'university-hub-thumb', 400, 300 );

		// Register nav menu locations.
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary Menu', 'university-hub' ),
			'top'      => esc_html__( 'Top Menu', 'university-hub' ),
			'footer'   => esc_html__( 'Footer Menu', 'university-hub' ),
			'social'   => esc_html__( 'Social Menu', 'university-hub' ),
			'notfound' => esc_html__( '404 Menu', 'university-hub' ),
		) );

		/*
		 * Switch default core markup to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature. // ! disabled
		// add_theme_support( 'custom-background', apply_filters( 'university_hub_custom_background_args', array(
		// 	'default-color' => 'f7fcfe',
		// ) ) );

		// Enable support for selective refresh of widgets in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable support for custom logo.
		add_theme_support( 'custom-logo' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Supports.
		require_once get_template_directory() . '/inc/support.php';

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'university-hub' ),
					'shortName' => __( 'S', 'university-hub' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'university-hub' ),
					'shortName' => __( 'M', 'university-hub' ),
					'size'      => 14,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'university-hub' ),
					'shortName' => __( 'L', 'university-hub' ),
					'size'      => 30,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'university-hub' ),
					'shortName' => __( 'XL', 'university-hub' ),
					'size'      => 36,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name' => __('Red', 'university-hub'),
            		'slug' => 'red',
            		'color' => '#a0001b', // #e4572e => #a0001b
				),
				array(
					'name' => __('Yellow', 'university-hub'),
					'slug' => 'yellow',
					'color' => '#fbb800', // #f4a024 => #fbb800
				),
				array(
					'name' => __('Black', 'university-hub'),
					'slug' => 'black',
					'color' => '#2a2a2a', // #000 => #2a2a2a
				),
				array(
					'name' => __('White', 'university-hub'),
					'slug' => 'white',
					'color' => '#fcfcfc', // #ffffff =>  #fcfcfc
				),
				array(
					'name' => __('Gray', 'university-hub'),
					'slug' => 'gray',
					'color' => '#6c6c6c', // #727272 => #6c6c6c
				),
				array(
					'name' => __('Blue', 'university-hub'),
					'slug' => 'blue',
					'color' => '#3eb1c8', // #179bd7 => #3eb1c8
				),
				array(
					'name' => __('Navy Blue', 'university-hub'),
					'slug' => 'navy-blue',
					'color' => '#328895', // #253b80 => #328895
				),
				array(
					'name' => __('Light Blue', 'university-hub'),
					'slug' => 'light-blue',
					'color' => '#e2f8fc', // #f7fcfe => #e2f8fc
				),
				array(
					'name' => __('Orange', 'university-hub'),
					'slug' => 'orange',
					'color' => '#f96605', // #ff6000 => #f96605
				),
				array(
					'name' => __('Green', 'university-hub'),
					'slug' => 'green',
					'color' => '#00a085', // #77a464 => #00a085
				),
			)
		);
	}
endif;

add_action( 'after_setup_theme', 'university_hub_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function university_hub_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'university_hub_content_width', 771 );
}
add_action( 'after_setup_theme', 'university_hub_content_width', 0 );

/**
 * Register widget area.
 */
function university_hub_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'university-hub' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', 'university-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'university-hub' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your Secondary Sidebar.', 'university-hub' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'university_hub_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function university_hub_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// updated Font Awesome
	// wp_enqueue_style( 'university-hub-font-awesome', get_template_directory_uri() . '/third-party/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );
	wp_enqueue_style( 'university-hub-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], '6.5.0' );

	$fonts_url = university_hub_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'university-hub-google-fonts', $fonts_url, array(), null );
	}

	// Theme stylesheet.
	wp_enqueue_style( 'university-hub-style', get_stylesheet_uri(), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

	// Theme block stylesheet.
	wp_enqueue_style( 'university-hub-block-style', get_theme_file_uri( '/css/blocks.css' ), array( 'university-hub-style' ), '20211006' );

	wp_enqueue_script( 'university-hub-navigation', get_template_directory_uri() . '/js/navigation' . $min . '.js', array( 'jquery' ), '20200713', true );

	wp_localize_script( 'university-hub-navigation', 'universityHubOptions', array(
		'screenReaderText' => array(
			'expand'   => esc_html__( 'expand child menu', 'university-hub' ),
			'collapse' => esc_html__( 'collapse child menu', 'university-hub' ),
		),
	) );

	wp_enqueue_script( 'university-hub-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2' . $min . '.js', array( 'jquery' ), '2.1.6', true );

	wp_enqueue_script( 'jquery-easy-ticker', get_template_directory_uri() . '/third-party/ticker/jquery.easy-ticker' . $min . '.js', array( 'jquery' ), '2.0', true );

	wp_enqueue_script( 'university-hub-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery' ), '1.0.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'university_hub_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since University Hub
 */
function university_hub_block_editor_styles() {
	// Theme block stylesheet.
	wp_enqueue_style( 'university-hub-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20101208' );

	$fonts_url = university_hub_fonts_url();
	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'university-hub-google-fonts', $fonts_url, array(), null );
	}
}
add_action( 'enqueue_block_editor_assets', 'university_hub_block_editor_styles' );

/**
 * Enqueue admin scripts and styles.
 */
function university_hub_admin_scripts( $hook ) {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_style( 'university-hub-metabox', get_template_directory_uri() . '/css/metabox' . $min . '.css', '', '1.0.1' );
		wp_enqueue_script( 'university-hub-metabox', get_template_directory_uri() . '/js/metabox' . $min . '.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ), '1.0.1', true );
	}

	if ( 'widgets.php' === $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'wp-color-picker' );
	    wp_enqueue_media();
		wp_enqueue_style( 'university-hub-widgets', get_template_directory_uri() . '/css/widgets' . $min . '.css', array(), '1.0.0' );
		wp_enqueue_script( 'university-hub-widgets', get_template_directory_uri() . '/js/widgets' . $min . '.js', array( 'jquery' ), '1.0.1', true );
	}

}
add_action( 'admin_enqueue_scripts', 'university_hub_admin_scripts' );

/**
 * Load init.
 */
require_once get_template_directory() . '/inc/init.php';

/**
 * NEW FUNCTIONS
 * Adding a color palette switcher
 */
// add customizer options
function university_hub_palette_switcher($wp_customize)
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
add_action('customize_register', 'university_hub_palette_switcher');

// add class to body tag
function university_hub_palette_class($classes)
{
    $theme_palette = get_theme_mod('theme_palette', 'default');

    if ($theme_palette !== 'default') {
        $classes[] = 'theme-' . $theme_palette;
    }

    return $classes;
}
add_filter('body_class', 'university_hub_palette_class');

/**
 * Enables theme color inheritance for qubely
 */
function university_hub_qubely_hook()
{
    do_action('qubely_active_theme_preset');
}
add_action('after_switch_theme', 'university_hub_qubely_hook');

/**
 * Change http links to https when inserting files
 */
function university_hub_force_protocol_relative($content)
{
	$content = str_replace('http://', 'https://', $content);
    return $content;
}
add_filter('media_send_to_editor', 'university_hub_force_protocol_relative');

/**
 * Dashicons connection
 */
function university_hub_load_dashicons()
{
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'university_hub_load_dashicons');

/**
 * Choosing between calendars and thumbnails in News and Events
 * And another customizer options
 * TODO reafactor to separated functions
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

// TODO It is necessary to implement functions in the regular places of the theme

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