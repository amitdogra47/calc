<?php
defined( 'ABSPATH' ) OR exit;
/*
Plugin Name: Student Diaries Pricing Wizard
Plugin URI:  http://www.studentdiaries.com.au
Description: A purpose built Pricing Wizard for student diaries using the Smart Wizard multi-page jQuery form from http://www.techlaboratory.net.
Version: Version : 2.0
Author: Ted Bell
Author URI: http://www.tedbell.com.au
License: GPL2
*/
?>
<?php

/**
* AU
 * the filesystem path to Price Guide
 */
define( 'PRICEWIZARD_DIR', WP_PLUGIN_DIR . '/' . basename(dirname( $plugin )) );
/**
 * the URL path to Price Guide
 */
define( 'PRICEWIZARD_URL', plugin_dir_url( $plugin ) );


/**
** Initialise the plugin - enqueue scripts
*/
add_action('init', 'register_pw_scripts');

function register_pw_scripts(){

	if (!is_admin()) {
		// enqueue styles for the pricing wizard
		wp_register_style( 'smartwizard-style', PRICEWIZARD_URL. 'smartwizard/styles/smart_wizard_vertical.css' );
		wp_enqueue_style( 'smartwizard-style' );
		wp_register_style( 'pricewizard-style', PRICEWIZARD_URL. 'form-layout/pricewizard.css' );
		wp_enqueue_style( 'pricewizard-style' );

	//IMPORTANT: Refer to http://www.electrictoolbox.com/php-parse-str/ for an excellent explanation of parsing the JQuery form data file.
		//wp_deregister_script('jquery');
		wp_enqueue_script('jquery');
		// embed the javascript file that makes the AJAX request
		wp_enqueue_script('jquery-form');
		wp_enqueue_script('json2');
		wp_register_script('smartwizard',  PRICEWIZARD_URL . 'smartwizard/js/jquery.smartWizard-2.0.min.js', array( 'jquery', 'jquery-form','json2' ) );
		wp_enqueue_script('smartwizard');
		wp_register_script('pw-form-rules',  PRICEWIZARD_URL . 'js/pw-form-rules.js', array( 'jquery', 'jquery-form','json2','smartwizard' ));	
		wp_enqueue_script('pw-form-rules');
		wp_register_script('pw-form-validator',  PRICEWIZARD_URL . 'validation/jquery.validate.min.js', array( 'jquery', 'jquery-form','json2','pw-form-rules' ),NULL,true );
		wp_enqueue_script('pw-form-validator');
		wp_register_script('pw-ajax-request',  PRICEWIZARD_URL . 'js/pw-form-handler.js', array( 'jquery', 'jquery-form','json2' ),NULL,true );	
		wp_enqueue_script('pw-ajax-request');

		// for reference: in JavaScript, object properties are accessed as MyAjax.ajaxurl, MyAjax.syscontrol
		wp_localize_script( 'pw-ajax-request', 'MyAjax', array(	'ajaxurl' => admin_url( 'admin-ajax.php' ),'syscontrol' => wp_create_nonce( 'studentdiaries' )));	
		
	}
	
	if (is_admin()) {
		// the functions that will call the action handlers for visitors logged in and not.
		$post_action = "";
		$post_action = ( isset( $_POST[ 'action' ] ) ? $_POST[ 'action' ] : false );
		$req_action = "";
		$req_action = ( isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : false );
		do_action( 'wp_ajax_nopriv_' .$req_action );
		do_action( 'wp_ajax_' . $post_action );
		add_action('wp_ajax_sd_priceguide_action', 'sd_priceguide_callback');	
		add_action('wp_ajax_nopriv_sd_priceguide_action', 'sd_priceguide_callback');
	}
}

// plugin activation - custom database tables
require("pw-activation.php");
register_activation_hook (__FILE__, 'activate_tablesanddata');
register_activation_hook (__FILE__, 'activate_customsettings');

// load sundry admin functions
require("pw-admin.php");

// diary calculation functions
require("pw-admin-pricecalcs.php");

// create menus in the dashboard
require("admin_menu/pw-menu.php");

// grab the callback on form submit
require("pw-form-callback.php");

// email functions
require("pw-admin-email.php");

// insert the pricing form into the template
function forminsert_wizard(){
	include("form-layout/pw-form-layout.php");
}
?>