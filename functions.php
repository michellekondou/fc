<?php
/**
 * felios functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package felios
 */

if ( ! function_exists( 'felios_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function felios_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on felios, use a find and replace
		 * to change 'felios' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'felios', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'felios' ),
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
		add_theme_support( 'custom-background', apply_filters( 'felios_custom_background_args', array(
			'default-color' => 'ffffff',
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
	}
endif;
add_action( 'after_setup_theme', 'felios_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function felios_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'felios_content_width', 640 );
}
add_action( 'after_setup_theme', 'felios_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function felios_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'felios' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'felios' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'felios_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function felios_scripts() {
	wp_enqueue_style( 'felios-style', get_stylesheet_uri() );

	wp_enqueue_script( 'felios-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'felios-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'felios_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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





add_action( 'init', 'create_post_type');

function create_post_type() {
	/**
	 * Post Type: Έργα.
	 */

	$labels = array(
		'name'               => _x( 'Έργα', 'general name of the post type' ),
		'singular_name'      => _x( 'Έργο', 'name for one object of this post type' ),
		'add_new'            => _x( 'Προσθήκη Νέου', 'collection' ),
		'add_new_item'       => __( 'Προσθήκη νέου έργου' ),
		'edit_item'          => __( 'Επεξεργασία Έργου' ),
		'new_item'           => __( 'Νέο Έργο' ),
		'all_items'          => __( 'Όλα τα έργα' ),
		'view_item'          => __( 'Εμφάνιση Έργου' ),
		'search_items'       => __( 'Αναζήτηση Έργου' ),
	);

	$args = array(
		"labels" => $labels,
		"public" => true,
		'supports' =>  array( 'title', 'editor', 'thumbnail' ), // Adds support for comments, revesions, etc
     	'has_archive' =>  true, //Enables the custom post type archive at http://mysite.com/post-type/
     	'hierarchical' =>  true, //Enables the custom post type to have a hierarchy
		'rewrite' => array( 'slug' =>  _x('collection', 'URL slug')), //To be able to translate the custom post slug using WPML
	);

	register_post_type( "collection", $args );

	/**
	 * Post Type: Καλλιτέχνες.
	 */

	$labels = array(
		'name'               => _x( 'Καλλιτέχνες', 'general name of the post type' ),
		'singular_name'      => _x( 'Καλλιτέχνης', 'name for one object of this post type' ),
		'add_new'            => _x( 'Προσθήκη Νέου', 'artist' ),
		'add_new_item'       => __( 'Προσθήκη νέου καλλιτέχνη' ),
		'edit_item'          => __( 'Επεξεργασία Καλλιτέχνη' ),
		'new_item'           => __( 'Νέος Καλλιτέχνης' ),
		'all_items'          => __( 'Όλοι οι καλλιτέχνες' ),
		'view_item'          => __( 'Εμφάνιση Καλλιτέχνη' ),
		'search_items'       => __( 'Αναζήτηση Καλλιτέχνη' ),
	);

	$args = array(
		"labels" => $labels,
		"public" => true,
		'supports' =>  array( 'title', 'editor', 'thumbnail' ), // Adds support for comments, revesions, etc
     	'has_archive' =>  true, //Enables the custom post type archive at http://mysite.com/post-type/
     	'hierarchical' =>  true, //Enables the custom post type to have a hierarchy
		'rewrite' => array( 'slug' =>  _x('artists', 'URL slug'), "with_front" => false), //To be able to translate the custom post slug using WPML
	);

	register_post_type( "artists", $args );

	/**
	 * Post Type: Εκδηλώσεις.
	 */

	$labels = array(
		'name'               => _x( 'Εκδηλώσεις', 'general name of the post type' ),
		'singular_name'      => _x( 'Εκδήλωση', 'name for one object of this post type' ),
		'add_new'            => _x( 'Προσθήκη Νέας', 'events' ),
		'add_new_item'       => __( 'Προσθήκη νέας εκδήλωσης' ),
		'edit_item'          => __( 'Επεξεργασία Εκδήλωσης' ),
		'new_item'           => __( 'Νέα Εκδήλωση' ),
		'all_items'          => __( 'Όλες οι εκδηλώσεις' ),
		'view_item'          => __( 'Εμφάνιση Εκδηλώσεων' ),
		'search_items'       => __( 'Αναζήτηση Εκδήλωσης' ),
	);

	$args = array(
		"labels" => $labels,
		"public" => true,
		'supports' =>  array( 'title', 'editor', 'thumbnail' ), // Adds support for comments, revesions, etc
     	'has_archive' =>  true, //Enables the custom post type archive at http://mysite.com/post-type/
     	'hierarchical' =>  true, //Enables the custom post type to have a hierarchy
		'rewrite' => array( 'slug' =>  _x('events', 'URL slug')), //To be able to translate the custom post slug using WPML
	);

	register_post_type( "events", $args );

	/**
	 * Post Type: Εκθέσεις.
	 */

	$labels = array(
		'name'               => _x( 'Εκθέσεις', 'general name of the post type' ),
		'singular_name'      => _x( 'Εκθεση', 'name for one object of this post type' ),
		'add_new'            => _x( 'Προσθήκη Νέας', 'exhibitions' ),
		'add_new_item'       => __( 'Προσθήκη νέας έκθεσης' ),
		'edit_item'          => __( 'Επεξεργασία Έκθεσης' ),
		'new_item'           => __( 'Νέα Εκθεση' ),
		'all_items'          => __( 'Όλες οι εκθέσεις' ),
		'view_item'          => __( 'Εμφάνιση Εκθέσεων' ),
		'search_items'       => __( 'Αναζήτηση Έκθεσης' ),
	);

	$args = array(
		"labels" => $labels,
		"public" => true,
		'supports' =>  array( 'title', 'editor', 'thumbnail' ), // Adds support for comments, revesions, etc
     	'has_archive' =>  true, //Enables the custom post type archive at http://mysite.com/post-type/
     	'hierarchical' =>  true, //Enables the custom post type to have a hierarchy
		'rewrite' => array( 'slug' =>  _x('exhibitions', 'URL slug')), //To be able to translate the custom post slug using WPML
	);

	register_post_type( "exhibitions", $args );
}

add_action( 'init', 'create_taxonomies', 0 );

flush_rewrite_rules( true );

function create_taxonomies() {

	/**
	 * Taxonomy: Kind.
	 */
	$labels = array(
		'name'              			=> _x( 'Είδη', 'taxonomy general name', 'textdomain' ),
		'singular_name'     			=> _x( 'Είδος', 'taxonomy singular name', 'textdomain' ),
		'search_items'      			=> __( 'Αναζήτηση Είδους', 'textdomain' ),
		'popular_items'     			=> __( 'Δημοφιλή Είδη', 'textdomain' ),
		'all_items'         			=> __( 'Όλα τα Είδη', 'textdomain' ),
		'parent_item'       			=> __( 'Γονικό Είδος', 'textdomain' ),
		'parent_item_colon' 			=> __( 'Γονικό Είδος:', 'textdomain' ),
		'edit_item'        				=> __( 'Επεξεργασία Είδους', 'textdomain' ),
		'update_item'       			=> __( 'Ανανέωση Είδους', 'textdomain' ),
		'add_new_item'      			=> __( 'Προσθήκη νέου Είδους', 'textdomain' ),
		'new_item_name'     			=> __( 'Όνομα νέου Είδους', 'textdomain' ),
		"separate_items_with_commas" 	=> __( 'Πολλαπλά Είδη χωρισμένα με κόμμα', 'textdomain' ),
		"add_or_remove_items" 			=> __( 'Προσθαφαίρεση Ειδών', 'textdomain' ),
		"choose_from_most_used" 		=> __( "Επιλέξτε από τα πιο δημοφιλή", 'textdomain' ),
		'not_found'                  	=> __( 'Δεν βρέθηκαν είδη.', 'textdomain' ),
		'menu_name'        				=> __( 'Είδος', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'        	 	=> true,
		'rewrite'           	=> array( 'slug' => 'kind' ),
	);

	register_taxonomy( 'kind', array( 'collection' ), $args );

	/**
	 * Taxonomy: Colors.
	 */	
	$labels = array(
		'name'              			=> _x( 'Χρώματα', 'taxonomy general name', 'textdomain' ),
		'singular_name'     			=> _x( 'Χρώμα', 'taxonomy singular name', 'textdomain' ),
		'search_items'      			=> __( 'Αναζήτηση Χρώματος', 'textdomain' ),
		'popular_items'     			=> __( 'Δημοφιλή Χρώματα', 'textdomain' ),
		'all_items'         			=> __( 'Όλα τα Χρώματα', 'textdomain' ),
		'parent_item'       			=> __( 'Γονικό Χρώμα', 'textdomain' ),
		'parent_item_colon' 			=> __( 'Γονικό Χρώμα:', 'textdomain' ),
		'edit_item'        				=> __( 'Επεξεργασία Χρώματος', 'textdomain' ),
		'update_item'       			=> __( 'Ανανέωση Χρώματος', 'textdomain' ),
		'add_new_item'      			=> __( 'Προσθήκη νέου Χρώματος', 'textdomain' ),
		'new_item_name'     			=> __( 'Όνομα νέου Χρώματος', 'textdomain' ),
		"separate_items_with_commas" 	=> __( 'Πολλαπλά Χρώματα χωρισμένα με κόμμα', 'textdomain' ),
		"add_or_remove_items" 			=> __( 'Προσθαφαίρεση Χρωμάτων', 'textdomain' ),
		"choose_from_most_used" 		=> __( "Επιλέξτε από τα πιο δημοφιλή", 'textdomain' ),
		'not_found'                  	=> __( 'Δεν βρέθηκαν χρώματα.', 'textdomain' ),
		'menu_name'        				=> __( 'Χρώμα', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'        	 	=> true,
		'rewrite'               => array( 'slug' => 'writer' ),
	);

	register_taxonomy( 'color', array( 'collection' ), $args );

	/**
	 * Taxonomy: itags.
	 */	
	$labels = array(
		'name'              			=> _x( 'Ετικέτες', 'taxonomy general name', 'textdomain' ),
		'singular_name'     			=> _x( 'Ετικέτα', 'taxonomy singular name', 'textdomain' ),
		'search_items'      			=> __( 'Αναζήτηση Ετικέτας', 'textdomain' ),
		'popular_items'     			=> __( 'Δημοφιλείς Ετικέτες', 'textdomain' ),
		'all_items'         			=> __( 'Όλα οι Ετικέτες', 'textdomain' ),
		'parent_item'       			=> __( 'Γονική Ετικέτα', 'textdomain' ),
		'parent_item_colon' 			=> __( 'Γονική Ετικέτα:', 'textdomain' ),
		'edit_item'        				=> __( 'Επεξεργασία Ετικέτας', 'textdomain' ),
		'update_item'       			=> __( 'Ανανέωση Ετικέτας', 'textdomain' ),
		'add_new_item'      			=> __( 'Προσθήκη νέας Ετικέτας', 'textdomain' ),
		'new_item_name'     			=> __( 'Όνομα νέας Ετικέτας', 'textdomain' ),
		"separate_items_with_commas" 	=> __( 'Πολλαπλές Ετικέτες χωρισμένες με κόμμα', 'textdomain' ),
		"add_or_remove_items" 			=> __( 'Προσθαφαίρεση Ετικετών', 'textdomain' ),
		"choose_from_most_used" 		=> __( "Επιλέξτε από τα πιο δημοφιλή", 'textdomain' ),
		'not_found'                  	=> __( 'Δεν βρέθηκαν ετικέτες.', 'textdomain' ),
		'menu_name'        				=> __( 'Ετικέτα', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'        	 	=> true,
		'rewrite'               => array( 'slug' => 'itag' ),
	);

	register_taxonomy( 'itag', array( 'collection' ), $args );

	/**
	 * Taxonomy: Themes.
	 */	
	$labels = array(
		'name'              			=> _x( 'Θέματα', 'taxonomy general name', 'textdomain' ),
		'singular_name'     			=> _x( 'Θέμα', 'taxonomy singular name', 'textdomain' ),
		'search_items'      			=> __( 'Αναζήτηση Θέματος', 'textdomain' ),
		'popular_items'     			=> __( 'Δημοφιλή Θέματα', 'textdomain' ),
		'all_items'         			=> __( 'Όλα τα Θέματα', 'textdomain' ),
		'parent_item'       			=> __( 'Γονικό Θέμα', 'textdomain' ),
		'parent_item_colon' 			=> __( 'Γονικό Θέμα:', 'textdomain' ),
		'edit_item'        				=> __( 'Επεξεργασία Θέματος', 'textdomain' ),
		'update_item'       			=> __( 'Ανανέωση Θέματος', 'textdomain' ),
		'add_new_item'      			=> __( 'Προσθήκη νέου Θέματος', 'textdomain' ),
		'new_item_name'     			=> __( 'Όνομα νέου Θέματος', 'textdomain' ),
		"separate_items_with_commas" 	=> __( 'Πολλαπλά Θέματα χωρισμένα με κόμμα', 'textdomain' ),
		"add_or_remove_items" 			=> __( 'Προσθαφαίρεση Θεμάτων', 'textdomain' ),
		"choose_from_most_used" 		=> __( "Επιλέξτε από τα πιο δημοφιλή", 'textdomain' ),
		'not_found'                  	=> __( 'Δεν βρέθηκαν θέματα.', 'textdomain' ),
		'menu_name'        				=> __( 'Θέμα', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'        	 	=> true,
		'rewrite'               => array( 'slug' => 'theme' ),
	);

	register_taxonomy( 'theme', array( 'collection' ), $args );

	/**
	 * Taxonomy: Categories.
	 */	
	$labels = array(
		'name'              			=> _x( 'Κατηγορίες', 'taxonomy general name', 'textdomain' ),
		'singular_name'     			=> _x( 'Κατηγορία', 'taxonomy singular name', 'textdomain' ),
		'search_items'      			=> __( 'Αναζήτηση Κατηγορίας', 'textdomain' ),
		'popular_items'     			=> __( 'Δημοφιλείς Κατηγορίες', 'textdomain' ),
		'all_items'         			=> __( 'Όλες οι Κατηγορίες', 'textdomain' ),
		'parent_item'       			=> __( 'Γονική Κατηγορία', 'textdomain' ),
		'parent_item_colon' 			=> __( 'Γονική Κατηγορία:', 'textdomain' ),
		'edit_item'        				=> __( 'Επεξεργασία Κατηγορίας', 'textdomain' ),
		'update_item'       			=> __( 'Ανανέωση Κατηγορίας', 'textdomain' ),
		'add_new_item'      			=> __( 'Προσθήκη νέας Κατηγορίας', 'textdomain' ),
		'new_item_name'     			=> __( 'Όνομα νέας Κατηγορίας', 'textdomain' ),
		"separate_items_with_commas" 	=> __( 'Πολλαπλές Κατηγορίες χωρισμένες με κόμμα', 'textdomain' ),
		"add_or_remove_items" 			=> __( 'Προσθαφαίρεση Κατηγοριών', 'textdomain' ),
		"choose_from_most_used" 		=> __( "Επιλέξτε από τα πιο δημοφιλή", 'textdomain' ),
		'not_found'                  	=> __( 'Δεν βρέθηκαν κατηγορίες.', 'textdomain' ),
		'menu_name'        				=> __( 'Κατηγορία', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_ui'				=> true,
		'show_admin_column'		=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'        	 	=> true,
		'rewrite'               => array( 'slug' => 'eventcat' ),
	);

	register_taxonomy( 'eventscats', array( 'events' ), $args );
}

//archive title
add_filter('get_the_archive_title', function ($title) {
	if ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives' );
    }
    return $title;
});

//archive pagination
function artists_posts_per_page( $query ) {
	if ( is_post_type_archive() ) {
		if ( $query->query_vars['post_type'] == 'artists' ) $query->query_vars['posts_per_page'] = -1;
		return $query;
	}
}
add_filter( 'pre_get_posts', 'artists_posts_per_page' );

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

function acf_load_select_material_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();
    
    
    // get the textarea value from options page without any formatting
    $choices = get_field('material_options_en', 'option', false);

    
    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);

    
    // remove any unwanted white space
    $choices = array_map('trim', $choices);

    
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        
        foreach( $choices as $choice ) {
            
            $field['choices'][ $choice ] = $choice;
            
        }
        
    }
    

    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=select_material', 'acf_load_select_material_field_choices');

function acf_load_select_material_el_field_choices( $field ) {
    
    // reset choices
    $field['choices'] = array();
    
    
    // get the textarea value from options page without any formatting
    $choices = get_field('material_options_el', 'option', false);

    
    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);

    
    // remove any unwanted white space
    $choices = array_map('trim', $choices);

    
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        
        foreach( $choices as $choice ) {
            
            $field['choices'][ $choice ] = $choice;
            
        }
        
    }
    

    // return the field
    return $field;
    
}

add_filter('acf/load_field/name=select_material_el', 'acf_load_select_material_el_field_choices');

function remove_custom_taxonomy() {
	if(ICL_LANGUAGE_CODE == 'el') {
		
		$custom_taxonomy_slug = ['kind', 'color', 'itag', 'theme'];
		$custom_post_type = 'collection';

		// loop through array and add to field 'choices'
		if( is_array($custom_taxonomy_slug) ) {
			
			foreach( $custom_taxonomy_slug as $choice ) {
				
				remove_meta_box( $choice.'div', $custom_post_type, 'side' );
				
			}
			
		}

	}
        // $custom_taxonomy_slug is the slug of your taxonomy, e.g. 'genre' )
        // $custom_post_type is the "slug" of your post type, e.g. 'movies' )
}
add_action( 'admin_menu', 'remove_custom_taxonomy' );

