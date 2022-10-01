<?php
// Cars

function cptui_register_my_cpts() {

	/**
	 * Post Type: Cars.
	 */

	$labels = [
		"name" => esc_html__( "Cars", "bootstrap-basic" ),
		"singular_name" => esc_html__( "Car", "bootstrap-basic" ),
	];

	$args = [
		"label" => esc_html__( "Cars", "bootstrap-basic" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => false,
		"rewrite" => [ "slug" => "car", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-car",
		"supports" => [ "title", "editor", "thumbnail" ],
		"show_in_graphql" => false,
	];

	register_post_type( "car", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Makes.
	 */

	$labels = [
		"name" => esc_html__( "Makes", "bootstrap-basic" ),
		"singular_name" => esc_html__( "Make", "bootstrap-basic" ),
	];

	
	$args = [
		"label" => esc_html__( "Makes", "bootstrap-basic" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'make', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "make",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "make", [ "car" ], $args );

	/**
	 * Taxonomy: Models.
	 */

	$labels = [
		"name" => esc_html__( "Models", "bootstrap-basic" ),
		"singular_name" => esc_html__( "Model", "bootstrap-basic" ),
	];

	
	$args = [
		"label" => esc_html__( "Models", "bootstrap-basic" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'model', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "model",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "model", [ "car" ], $args );

	/**
	 * Taxonomy: Years.
	 */

	$labels = [
		"name" => esc_html__( "Years", "bootstrap-basic" ),
		"singular_name" => esc_html__( "Year", "bootstrap-basic" ),
	];

	
	$args = [
		"label" => esc_html__( "Years", "bootstrap-basic" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'car_years', 'with_front' => true,  'hierarchical' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "car_years",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "car_years", [ "car" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );

// Set the archive post as front page
function prefix_downloads_front_page( $query ) {
    // Only filter the main query on the front-end
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }
    global $wp;
    $front = false;
  // If the latest posts are showing on the home page
    if ( ( is_home() && empty( $wp->query_string ) ) ) {
        $front = true;
    }
  // If a static page is set as the home page
  
    if ( ( $query->get( 'page_id' ) == get_option( 'page_on_front' ) && get_option( 'page_on_front' ) ) || empty( $wp->query_string ) ) {
        $front = true;  
    }
    if ( $front ) :
  
        $query->set( 'post_type', 'car' );
        $query->set( 'page_id', '' );
        // Set properties to match an archive
        $query->is_page = 0;
        $query->is_singular = 0;
        $query->is_post_type_archive = 1;
        $query->is_archive = 1;
    endif;
  
  //Fix pagination
  if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
  } elseif ( get_query_var('page') ) {
        $paged = get_query_var('page');
  } else {
        $paged = 1;
  }
  $query->set( 'paged', $paged );
}
add_action( 'pre_get_posts', 'prefix_downloads_front_page' );





//End





/**
 * Bootstrap Basic theme
 * 
 * @package bootstrap-basic
 */


/**
 * Required WordPress variable.
 */
if (!isset($content_width)) {
    $content_width = 1170;
}


/**
 * The Bootstrap Basic main class.
 */
require_once get_template_directory() . '/inc/BootstrapBasic.php';


/**
 * Register commonly use scripts and styles.
 */
$BootstrapBasic = new \BootstrapBasic();
unset($BootstrapBasic);


if (!function_exists('bootstrapBasicSetup')) {
    /**
     * Setup theme and register support wp features.
     */
    function bootstrapBasicSetup() 
    {
        /**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         * 
         * copy from underscores theme
         */
        load_theme_textdomain('bootstrap-basic', get_template_directory() . '/languages');

        // add theme support title-tag
        add_theme_support('title-tag');

        // add theme support post and comment automatic feed links
        add_theme_support('automatic-feed-links');

        // enable support for post thumbnail or feature image on posts and pages
        add_theme_support('post-thumbnails');

        // allow the use of html5 markup
        // @link https://codex.wordpress.org/Theme_Markup
        add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

        // add support menu
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'bootstrap-basic'),
        ));

        // add post formats support
        add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

        // add support custom background
        add_theme_support(
            'custom-background', 
            apply_filters(
                'bootstrap_basic_custom_background_args', 
                array(
                    'default-color' => 'ffffff', 
                    'default-image' => ''
                )
            )
        );

        // @since 1.1 or WordPress 5.0+
        // make gutenberg support. --------------------------------------------------------------------------------------
        // @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/ reference.
        // add wide alignment ( https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#wide-alignment )
        add_theme_support('align-wide');
        // support default block styles for front-end ( https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#default-block-styles )
        add_theme_support('wp-block-styles');
        // support editor styles ( https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#editor-styles )
        // this one make appearance in editor more close to Bootstrap 3.
        add_theme_support('editor-styles');
        // support responsive embeds for front-end ( https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#responsive-embedded-content )
        add_theme_support('responsive-embeds');
        // end make gutenberg support. ---------------------------------------------------------------------------------
    }// bootstrapBasicSetup
}
add_action('after_setup_theme', 'bootstrapBasicSetup');


if (!function_exists('bootstrapBasicWidgetsInit')) {
    /**
     * Register widget areas
     */
    function bootstrapBasicWidgetsInit() 
    {
        register_sidebar(array(
            'name' => __('Sidebar right', 'bootstrap-basic'),
            'id' => 'sidebar-right',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Sidebar left', 'bootstrap-basic'),
            'id' => 'sidebar-left',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Header right', 'bootstrap-basic'),
            'id' => 'header-right',
            'description' => __('Header widget area on the right side next to site title.', 'bootstrap-basic'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Navigation bar right', 'bootstrap-basic'),
            'id' => 'navbar-right',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => '',
        ));

        register_sidebar(array(
            'name' => __('Footer left', 'bootstrap-basic'),
            'id' => 'footer-left',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));

        register_sidebar(array(
            'name' => __('Footer right', 'bootstrap-basic'),
            'id' => 'footer-right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h1 class="widget-title">',
            'after_title' => '</h1>',
        ));
    }// bootstrapBasicWidgetsInit
}
add_action('widgets_init', 'bootstrapBasicWidgetsInit');


if (!function_exists('bootstrapBasicEnqueueScripts')) {
    /**
     * Enqueue scripts & styles
     * 
     * @global \WP_Scripts $wp_scripts
     */
    function bootstrapBasicEnqueueScripts() 
    {
        global $wp_scripts;
        $Theme = wp_get_theme();
        $themeVersion = $Theme->get('Version');
        unset($Theme);

        wp_enqueue_style('bootstrap-style');
        wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), '3.4.1');
        wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');
        wp_enqueue_style('main-style', get_template_directory_uri() . '/css/main.css', array(), $themeVersion);

        // check if there are any calendar widget block.
        if (bootstrapBasicHasWidgetBlock('calendar') === true) {
            // if theme using widget blocks.
            // enqueue css to fix calendar widget block to render as non widget block.
            // if you would like it to be render as new widget block, please dequeue this handle.
            wp_enqueue_style('bootstrapbasic-widgetblocks-calendar', get_template_directory_uri() . '/css/widget-blocks/calendar.css', array(), $themeVersion);
        }

        // js that is useful for development.
        wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js', array(), '3.6.0-20190314', true);
        // js that is useful for old browsers.
        wp_register_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '1.4.2', true);
        $wp_scripts->add_data('respond-script', 'conditional', 'lt IE 9');
        wp_enqueue_script('respond-script');
        wp_register_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '3.7.3', true);
        $wp_scripts->add_data('html5-shiv-script', 'conditional', 'lte IE 9');
        wp_enqueue_script('html5-shiv-script');
        
        if (is_singular() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        wp_enqueue_script('bootstrap-script');
        wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), $themeVersion, true);
        wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri(), array(), $themeVersion);

        // move jquery to bottom ( https://wordpress.stackexchange.com/a/225936/41315 )
        $wp_scripts->add_data('jquery', 'group', 1);
        $wp_scripts->add_data('jquery-core', 'group', 1);
        $wp_scripts->add_data('jquery-migrate', 'group', 1);
    }// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');


/**
 * admin page displaying help.
 */
if (is_admin()) {
    require get_template_directory() . '/inc/BootstrapBasicAdminHelp.php';
    $bbsc_adminhelp = new BootstrapBasicAdminHelp();
    add_action('admin_menu', array($bbsc_adminhelp, 'themeHelpMenu'));
    unset($bbsc_adminhelp);
}


/**
 * Make WordPress 5 (Gutenberg) editor support Bootstrap CSS.
 */
require_once get_template_directory() . '/inc/BootstrapBasicWp5.php';
$BbWp5 = new BootstrapBasicWp5();
unset($BbWp5);


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';


/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicAutoRegisterWidgets.php';
$BootstrapBasicAutoRegisterWidgets = new BootstrapBasicAutoRegisterWidgets();
$BootstrapBasicAutoRegisterWidgets->registerAll();
unset($BootstrapBasicAutoRegisterWidgets);
require get_template_directory() . '/inc/template-widgets-hook.php';

