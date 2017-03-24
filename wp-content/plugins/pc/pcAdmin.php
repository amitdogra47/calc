<?php
/*
Plugin Name: Price Calculator
Plugin URI: http://localhost.net
Description: Calculate the price on the basis of selected material
Author: Amit Dogra
Version: 1.0
Author URI: http://localhost
*/


/*  Add Category functions*/

function pc_admin() {
	include( 'pc_admin_form.php' );
}


function pc_admin_actions() {
	add_options_page(
		"Price Calculator Add Cat", "Price Calculator Add Cat", 1,
		"Price Calculator Add Cat", "pc_admin"
	);
}

add_action( 'admin_menu', 'pc_admin_actions' );


/*  Add type functions*/
function pcType_admin() {
	include( 'pcType_admin_form.php' );
}


function pcType_admin_actions() {
	add_options_page(
		"Price Calculator Add Type", "Price Calculator Add Type", 1,
		"Price Calculator Add Type", "pcType_admin"
	);
}

add_action( 'admin_menu', 'pcType_admin_actions' );


/*  Relation functions*/
function pcRel_admin() {
	include( 'pcRel_admin_page.php' );
}


function pcRel_admin_actions() {
	add_options_page(
		"Price Calculator Relation", "Price Calculator Relation", 1,
		"Price Calculator Relation", "pcRel_admin"
	);
}

add_action( 'admin_menu', 'pcRel_admin_actions' );


/*  Config Email*/
function pcemail_admin () {
	include ( 'pcemail_admin_page.php' );
}


function pcemail_admin_actions () {
	add_options_page (
		"Price Calculator Email Setting" , "Price Calculator Email Setting" , 1 ,
		"Price Calculator Email Setting" , "pcemail_admin"
	);
}

add_action ( 'admin_menu' , 'pcemail_admin_actions' );




// adding short code for wp pages
/*wp_register_script(
    'make-a-new-map', get_template_directory_uri() . '/js/new-map.js',
    array('jquery'), '0.1', true
);*/

function pc_front_page() {
	$plugins_url = plugins_url();
	//wp_enqueue_script('make-a-new-map');
	wp_register_style( 'stylesheetpc', plugins_url( '/css/pcStyle.css', __FILE__ ));
	wp_register_style( 'imagepac', plugins_url( '/css/pcStyle.css', __FILE__ ) );
	wp_register_style( 'imagepicker', plugins_url( '/css/image-picker.css', __FILE__ ) );
	wp_register_style ( 'errorstyle' , plugins_url ( '/css/error.css' , __FILE__ ) );


	wp_register_script( 'bootminjs', plugins_url( '/js/bootstrap.min.js', __FILE__ ) );
	wp_register_script( 'fontpc', 'https://use.fontawesome.com/5e954231c9.js' );
	wp_register_script( 'imagepacjs', plugins_url( '/js/image-picker.js', __FILE__ ) );
	wp_register_script ( 'recaptch' , 'https://www.google.com/recaptcha/api.js' );
	wp_register_script ( 'jscodejs' , plugins_url ( '/js/jscode.js' , __FILE__ ) );


	//wp_register_script( 'imagepacminjs', plugins_url( '/js/image-picker.min.js', __FILE__ ) );

	wp_enqueue_style( 'stylesheetpc' );
	wp_enqueue_style( 'imagepicker' );
	wp_enqueue_style ( 'errorstyle' );

	wp_enqueue_script( 'bootminjs' );
	wp_enqueue_script( 'fontpc' );
	wp_enqueue_script( 'imagepacjs' );
	wp_enqueue_script( 'recaptch' );
	wp_enqueue_script ( 'jscodejs' );



	//include( 'pc_front_page.php' );
	include( 'pc_front_page2.php' );
}

add_shortcode( 'pricecalc', 'pc_front_page' );







/*add_action ( 'admin_menu' , 'my_admin_menu' );

function my_admin_menu () {
	add_menu_page ( 'Price Calc' , 'Price Calc' , 'manage_options' , 'myplugin/myplugin-admin-page.php' , 'pc_admin_actions' , 'dashicons-tickets' , 6 );
	add_submenu_page ( 'myplugin/myplugin-admin-page.php' , 'My Sub Level Menu Example' , 'Sub Level Menu' , 'manage_options' , 'myplugin/myplugin-admin-sub-page.php' , 'myplguin_admin_sub_page' );
}*/

?>