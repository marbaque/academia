<?php

/**
 * academia functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package academia
 */

if (!defined('academia_version')) {
	// Replace the version number of the theme on each release.
	define('academia_version', '1.3.4');
}

if (!function_exists('academia_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function academia_setup()
	{
		/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on academia, use a find and replace
	 * to change 'academia' to the name of your theme in all the template files.
	 */
		load_theme_textdomain('academia', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
		add_theme_support('title-tag');

		/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
		add_theme_support('post-thumbnails');
		add_image_size('academia-full-bleed', 2000, 800, true);
		add_image_size('academia-index-img', 1000, 550, true);
		add_image_size('recurso-portada', 800, 600, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => esc_html__('Header', 'academia'),
			'social' => esc_html__('Social Media Menu', 'academia'),
			'info' => esc_html__('Info del sitio', 'academia'),
		));

		/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('academia_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for Custom Logo
		add_theme_support('custom-logo', array(
			'width' => 311,
			'height' => 56,
			'flex-width' => true,
		));

		// Add theme support for responsive videos in Gutenberg
		add_theme_support('responsive-embeds');

		/* Editor styles */
		add_editor_style(array('inc/editor-styles.css', academia_fonts_url()));
	}
endif;
add_action('after_setup_theme', 'academia_setup');

/**
 * Register custom fonts.
 */
function academia_fonts_url()
{
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Roboto and Roboto+Slab, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$sansSerif = _x('on', 'Roboto font: on or off', 'academia');
	$slab = _x('on', 'Roboto+Slab: on or off', 'academia');

	$font_families = array();

	if ('off' !== $sansSerif) {
		$font_families[] = 'Roboto:400,400i,700,700i';
	}

	if ('off' !== $slab) {
		$font_families[] = 'Roboto+Slab:400,700';
	}


	if (in_array('on', array($sansSerif))) {

		$query_args = array(
			'family' => urlencode(implode('|', $font_families)),
			'subset' => urlencode('latin,latin-ext'),
		);

		$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
	}

	return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function academia_resource_hints($urls, $relation_type)
{
	if (wp_style_is('academia-fonts', 'queue') && 'preconnect' === $relation_type) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter('wp_resource_hints', 'academia_resource_hints', 10, 2);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function academia_content_width()
{
	$GLOBALS['content_width'] = apply_filters('academia_content_width', 640);
}
add_action('after_setup_theme', 'academia_content_width', 0);


/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function academia_content_image_sizes_attr($sizes, $size)
{
	$width = $size[0];

	if (900 <= $width) {
		$sizes = '(min-width: 900px) 800px, 900px';
	}

	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'academia_content_image_sizes_attr', 10, 2);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function academia_post_thumbnail_sizes_attr($attr, $attachment, $size)
{

	if (!is_singular()) {
		if (is_active_sidebar('sidebar-1')) {
			$attr['sizes'] = '(max-width: 900px) 90vw, 800px';
		} else {
			$attr['sizes'] = '(max-width: 1000px) 90vw, 1000px';
		}
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'academia_post_thumbnail_sizes_attr', 10, 3);




/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function academia_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Barra lateral del blog', 'academia'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Agregue widgets al blog.', 'academia'),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Barra lateral de páginas', 'academia'),
		'id'            => 'sidebar-2',
		'description'   => esc_html__('Agregue widgets solo a las páginas.', 'academia'),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Barra lateral de cursos', 'academia'),
		'id'            => 'sidebar-3',
		'description'   => esc_html__('Agregue widgets para mostrar solo en las páginas de cursos.', 'academia'),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Barra lateral de recursos', 'academia'),
		'id'            => 'sidebar-4',
		'description'   => esc_html__('Agregue widgets para mostrar solo en el archivo de recursos y en recursos.', 'academia'),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => esc_html__('Barra inferior', 'academia'),
		'id'            => 'footer-1',
		'description'   => esc_html__('Agregue widgets al footer.', 'academia'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'academia_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function academia_scripts()
{
	// Enqueue Typekit Fonts: Futura and Expo Serif Pro
	wp_enqueue_style('academia-fonts', academia_fonts_url());

	wp_enqueue_style('academia-style', get_stylesheet_uri(), array(), academia_version);
	wp_style_add_data('academia-style', 'rtl', 'replace');

	wp_enqueue_script('academia-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), academia_version, true);

	wp_localize_script('academia-navigation', 'academiaScreenReaderText', array(
		'expand' => __('Expandir menu anidado', 'academia'),
		'collapse' => __('Colapsar menu anidado', 'academia'),
	));

	wp_enqueue_script('academia-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), academia_version, true);

	wp_enqueue_script('academia-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), academia_version, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'academia_scripts');

// Add backend styles for Gutenberg.
add_action('enqueue_block_editor_assets', 'academia_add_gutenberg_assets');

/**
 * Load Gutenberg stylesheet.
 */
function academia_add_gutenberg_assets()
{
	// Load the theme styles within Gutenberg.
	wp_enqueue_style('academia-gutenberg', get_theme_file_uri('/inc/editor-styles.css'), false);
}

// To override a template in the theme
add_filter('learn-press/override-templates', function () {
	return true;
});

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load SVG icon functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Load snapshots function.
 */
require get_template_directory() . '/inc/mshots.php';


require 'assets/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/marbaque/academia',
	__FILE__, //Full path to the main plugin file or functions.php.
	'academia'
);
$myUpdateChecker->setBranch('main');
