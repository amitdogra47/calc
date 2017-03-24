<?php
/**
 * Personal functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package personal-lite
 */


/**
* Customizer add.
*/
require_once( get_template_directory() . '/inc/personal-customizer.php' );
require_once( trailingslashit( get_template_directory() ) . '/inc/upgrade/class-customize.php' );


/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function personal_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'personal_lite_content_width', 1104 );
}
add_action( 'after_setup_theme', 'personal_lite_content_width', 0 );



if ( ! function_exists( 'personal_lite_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function personal_lite_setup() {
	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	*/
	add_theme_support( 'title-tag' );

	/**
	* Add default support for add feed on head
	*/
	add_theme_support( 'automatic-feed-links' );

	/**
	* Add default support for thumbnails 
	*/
	add_theme_support('post-thumbnails');

	/*
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array('height'=> 120,'width'=> 350,'flex-height' => true,'header-text' => array( 'site-title', 'site-description' ),
));

	/*
	 * Enable support for custom background.
	 */
	add_theme_support( 'custom-background', array('default-color' => '#778899','default-repeat' => 'no-repeat','default-attachment' => 'fixed',) );

	/**
	* Add image size
	*/
	add_image_size('personal-index', 1140, '', true);

	/**
	* Enable navigational menu 
	* personal theme use one navigation menu
	* @link https://codex.wordpress.org/Function_Reference/register_nav_menus
	*/
	register_nav_menus(array('pagenav' => __('Top Menu', 'personal-lite')));

	/**
	* Registers an editor stylesheet for the theme.
	*/
	add_editor_style();

	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	*/
	load_theme_textdomain('personal-lite', get_template_directory() . '/languages');
}
endif;
add_action( 'after_setup_theme', 'personal_lite_setup' );



if ( ! function_exists( 'personal_lite_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 * Does nothing if the custom logo is not available.
 */
function personal_lite_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;



/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists ( 'personal_lite_enqueues' ) ) {
	function personal_lite_enqueues() {			
		// styles
		wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array());				
		wp_enqueue_style( 'font-awesome', get_template_directory_uri(). '/css/font-awesome.min.css', array());
		wp_enqueue_style( 'slick-nav', get_template_directory_uri(). '/css/slicknav.css', array());
		wp_enqueue_style( 'personal-lite-sonsie', '//fonts.googleapis.com/css?family=Sonsie+One', array());
		wp_enqueue_style( 'personal-lite-titillium', '//fonts.googleapis.com/css?family=Titillium+Web', array());
		wp_enqueue_style( 'personal-lite-style', get_stylesheet_uri());
		// Scripts
		wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array('jquery'), '1.0.7', true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.5', true );
		wp_enqueue_script( 'personal-lite-custom', get_template_directory_uri() . '/js/personal-custom.js', array('jquery'), '1.0.0', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	}
}
add_action( 'wp_enqueue_scripts', 'personal_lite_enqueues' );


/**
* Adjust excerpt length
* Default WordPress excerpt length doesn't look good with theme
* Hense adjusting upon our need
*/
function personal_lite_excerpt_length( $length ) {
	return 70;															### '70' means 70 words
}

/**
* Adjust excerpt 
* Remove read more link
*/
add_filter( 'excerpt_length', 'personal_lite_excerpt_length', 999 );
function personal_lite_excerpt_more( $more ) {								### To remove the [...] stuff at end of excerpt
	return '';														
}
add_filter('excerpt_more', 'personal_lite_excerpt_more');


/**
 * Register sidebar
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function personal_lite_sidebar() {
register_sidebar (array (
	'name' => __( 'Footer Widget One', 'personal-lite' ),
	'id' => 'footone-sidebar',
	'description' => __( 'Place your left footer widgets here.', 'personal-lite' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="wi-title clearfix"><h3 class="w-title">',
	'after_title' => '</h3></div>',
));
register_sidebar (array (
	'name' => __( 'Footer Widget two', 'personal-lite' ),
	'id' => 'foottwo-sidebar',
	'description' => __( 'Place your center footer widgets here.', 'personal-lite' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="wi-title clearfix"><h3 class="w-title">',
	'after_title' => '</h3></div>',
));
register_sidebar (array (
	'name' => __( 'Footer Widget three', 'personal-lite' ),
	'id' => 'footthree-sidebar',
	'description' => __( 'Place your right footer widgets here.', 'personal-lite' ),
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="wi-title clearfix"><h3 class="w-title">',
	'after_title' => '</h3></div>',
));
}
add_action( 'widgets_init', 'personal_lite_sidebar' );


/**
 * Comment settings
 */
function personal_lite_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	
	if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>
	
	<?php elseif (get_comment_type() == 'comment') :?>
		<li id="comment-<?php echo comment_ID();?>">
			<div <?php comment_class('comment-post'); ?>>
				<div class="comment-author">
					<?php echo get_avatar($comment, 70);?>
				</div>
				<div class="comment-content">
					<div class="comment-meta">
						<?php echo get_comment_author_link();?>						
						<p><?php comment_date();?></p>
					</div>
					<div class="comment-text">
						<?php comment_text(); ?>
					</div>
					<span class="bg-color" >
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					</span>
					<hr/>
				</div>				
			</div>				
		</li>
	<?php endif;
}

?>