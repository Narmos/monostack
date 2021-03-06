<?php
/**
 * monostack functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package monostack
 */

if ( ! function_exists( 'monostack_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function monostack_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on monostack, use a find and replace
		 * to change 'monostack' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'monostack', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'monostack' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
			'default-color' => '282A36',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Highlight', 'monostack' ),
				'slug'  => 'highlight',
				'color' => '#363948',
			),
			array(
				'name'  => __( 'Dark Grey', 'monostack' ),
				'slug'  => 'dark-grey',
				'color' => '#282A36',
			),
			array(
				'name'  => __( 'Muted', 'monostack' ),
				'slug'  => 'muted',
				'color' => '#8492B1',
			),
			array(
				'name'  => __( 'Light Grey', 'monostack' ),
				'slug'  => 'light-grey',
				'color' => '#f7f7f7',
			),
			array(
				'name'  => __( 'Blue', 'monostack' ),
				'slug'  => 'blue',
				'color' => '#6BE5FD',
			),
			array(
				'name'  => __( 'Pink', 'monostack' ),
				'slug'  => 'pink',
				'color' => '#FF79C0',
			),
			array(
				'name'  => __( 'Green', 'monostack' ),
				'slug'  => 'green',
				'color' => '#50FA78',
			),
			array(
				'name'  => __( 'Purple', 'monostack' ),
				'slug'  => 'purple',
				'color' => '#BD93F2',
			),
		) );

		/**
		 * Register widget area.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		function monostack_widgets_init() {
			register_sidebar( array(
				'name'          => __( 'Footer Widget', 'monostack' ),
				'id'            => 'footer-sidebar',
				'description'   => __( 'Add widgets here to appear in your footer on all pages.', 'monostack' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<p class="widget-title">',
				'after_title'   => '</p>',
			) );
		}
		add_action( 'widgets_init', 'monostack_widgets_init' );
	}
endif;
add_action( 'after_setup_theme', 'monostack_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function monostack_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'monostack_content_width', 640 );
}
add_action( 'after_setup_theme', 'monostack_content_width', 0 );

/**
 * Register Google Fonts
 */
function monostack_fonts_url() {
	$fonts_url = '';

	/*
	 *Translators: If there are characters in your language that are not
	 * supported by Noto Serif, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$notoserif = esc_html_x( 'on', 'Noto Serif font: on or off', 'monostack' );

	if ( 'off' !== $notoserif ) {
		$font_families = array();
		$font_families[] = 'Noto Serif:400,400italic,700,700italic';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;

}

/**
 * Enqueue scripts and styles.
 */
function monostack_scripts() {
	wp_enqueue_style( 'gutenbergbase-style', get_stylesheet_uri() );

	wp_enqueue_style( 'monostackblocks-style', get_template_directory_uri() . '/css/blocks.css' );

	wp_enqueue_style( 'monostack-fonts', monostack_fonts_url() );

	wp_enqueue_script( 'monostack-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	
	if ( !is_404() ) {
		wp_enqueue_script( 'monostack-syntax-highlighting', get_template_directory_uri() . '/js/syntax-highlighting.js', array(), '20180816', true );
		
		wp_localize_script( 'monostack-syntax-highlighting', 'monostack_pronouns', array(
			__( 'I', 'monostack' ),
			__( 'we', 'monostack' ),
			__( 'me', 'monostack' ),
			__( 'us', 'monostack' ),
			__( 'you', 'monostack' ),
			__( 'she', 'monostack' ),
			__( 'he', 'monostack' ),
			__( 'her', 'monostack' ),
			__( 'him', 'monostack' ),
			__( 'they', 'monostack' ),
			__( 'them', 'monostack' ),
			__( 'it', 'monostack' ),
			__( 'that', 'monostack' ),
			__( 'which', 'monostack' ),
			__( 'who', 'monostack' ),
			__( 'whom', 'monostack' ),
			__( 'whose', 'monostack' ),
			__( 'whichever', 'monostack' ),
			__( 'whoever', 'monostack' ),
			__( 'whomever', 'monostack' ),
			__( 'this', 'monostack' ),
			__( 'these', 'monostack' ),
			__( 'that', 'monostack' ),
			__( 'those', 'monostack' ),
			__( 'anybody', 'monostack' ),
			__( 'anyone', 'monostack' ),
			__( 'anything', 'monostack' ),
			__( 'each', 'monostack' ),
			__( 'either', 'monostack' ),
			__( 'everyone', 'monostack' ),
			__( 'everybody', 'monostack' ),
			__( 'everything', 'monostack' ),
			__( 'nobody', 'monostack' ),
			__( 'neither', 'monostack' ),
			__( 'no one', 'monostack' ),
			__( 'nothing', 'monostack' ),
			__( 'somebody', 'monostack' ),
			__( 'one', 'monostack' ),
			__( 'someone', 'monostack' ),
			__( 'something', 'monostack' ),
			__( 'few', 'monostack' ),
			__( 'many', 'monostack' ),
			__( 'both', 'monostack' ),
			__( 'several', 'monostack' ),
			__( 'any', 'monostack' ),
			__( 'all', 'monostack' ),
			__( 'some', 'monostack' ),
			__( 'most', 'monostack' ),
			__( 'none', 'monostack' ),
			__( 'myself', 'monostack' ),
			__( 'yourself', 'monostack' ),
			__( 'ourselves', 'monostack' ),
			__( 'yourselves', 'monostack' ),
			__( 'herself', 'monostack' ),
			__( 'himself', 'monostack' ),
			__( 'themselves', 'monostack' ),
			__( 'itself', 'monostack' ),
			__( 'who', 'monostack' ),
			__( 'what', 'monostack' ),
			__( 'which', 'monostack' ),
			__( 'whose', 'monostack' ),
			__( 'whom', 'monostack' ),
		) );
		
		wp_localize_script( 'monostack-syntax-highlighting', 'monostack_conjunctions', array(
			__( 'for', 'monostack' ),
			__( 'and', 'monostack' ),
			__( 'nor', 'monostack' ),
			__( 'but', 'monostack' ),
			__( 'or', 'monostack' ),
			__( 'yet', 'monostack' ),
			__( 'so', 'monostack' ),
			__( 'either', 'monostack' ),
			__( 'neither', 'monostack' ),
			__( 'not only', 'monostack' ),
			__( 'but also', 'monostack' ),
			__( 'both', 'monostack' ),
			__( 'whether', 'monostack' ),
			__( 'although', 'monostack' ),
			__( 'though', 'monostack' ),
			__( 'even though', 'monostack' ),
			__( 'as much as', 'monostack' ),
			__( 'as long as', 'monostack' ),
			__( 'as soon as', 'monostack' ),
			__( 'because', 'monostack' ),
			__( 'since', 'monostack' ),
			__( 'so that', 'monostack' ),
			__( 'in order that', 'monostack' ),
			__( 'if', 'monostack' ),
			__( 'les', 'monostack' ),
			__( 'est', 'monostack' ),
			__( 'even if', 'monostack' ),
			__( 'that', 'monostack' ),
			__( 'unless', 'monostack' ),
			__( 'until', 'monostack' ),
			__( 'when', 'monostack' ),
			__( 'where', 'monostack' ),
		) );

		wp_localize_script( 'monostack-syntax-highlighting', 'monostack_prepositions', array(
			__( 'about', 'monostack' ),
			__( 'beside', 'monostack' ),
			__( 'near', 'monostack' ),
			__( 'to', 'monostack' ),
			__( 'above', 'monostack' ),
			__( 'between', 'monostack' ),
			__( 'of', 'monostack' ),
			__( 'towards', 'monostack' ),
			__( 'across', 'monostack' ),
			__( 'beyond', 'monostack' ),
			__( 'off', 'monostack' ),
			__( 'under', 'monostack' ),
			__( 'after', 'monostack' ),
			__( 'by', 'monostack' ),
			__( 'on', 'monostack' ),
			__( 'underneath', 'monostack' ),
			__( 'against', 'monostack' ),
			__( 'despite', 'monostack' ),
			__( 'onto', 'monostack' ),
			__( 'unlike', 'monostack' ),
			__( 'along', 'monostack' ),
			__( 'down', 'monostack' ),
			__( 'opposite', 'monostack' ),
			__( 'until', 'monostack' ),
			__( 'among', 'monostack' ),
			__( 'during', 'monostack' ),
			__( 'out', 'monostack' ),
			__( 'up', 'monostack' ),
			__( 'around', 'monostack' ),
			__( 'except', 'monostack' ),
			__( 'outside', 'monostack' ),
			__( 'upon', 'monostack' ),
			__( 'as', 'monostack' ),
			__( 'for', 'monostack' ),
			__( 'over', 'monostack' ),
			__( 'via', 'monostack' ),
			__( 'at', 'monostack' ),
			__( 'from', 'monostack' ),
			__( 'past', 'monostack' ),
			__( 'with', 'monostack' ),
			__( 'before', 'monostack' ),
			__( 'in', 'monostack' ),
			__( 'round', 'monostack' ),
			__( 'within', 'monostack' ),
			__( 'behind', 'monostack' ),
			__( 'inside', 'monostack' ),
			__( 'since', 'monostack' ),
			__( 'without', 'monostack' ),
			__( 'below', 'monostack' ),
			__( 'into', 'monostack' ),
			__( 'than', 'monostack' ),
			__( 'beneath', 'monostack' ),
			__( 'like', 'monostack' ),
			__( 'through', 'monostack' ),
		) );
	}

	wp_enqueue_script( 'monostack-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'monostack_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
