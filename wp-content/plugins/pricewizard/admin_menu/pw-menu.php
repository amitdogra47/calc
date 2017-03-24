<?php
// create menus in the dashboard
add_action('admin_menu', 'pw_menu');

function pw_menu() {
	if (!current_user_can('activate_plugins'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	// New Settings
	if (function_exists('add_menu_page')) {
		$sd_icon = PRICEWIZARD_URL."images/sd_money.png";
		add_menu_page('Price Wizard','Price Wizard','edit_plugins','pricewizard','pw_menu_overview',$sd_icon,30); 		
	}
	if (function_exists('add_submenu_page')) {

		// first page is duplicate of add menu page
		add_submenu_page('pricewizard', 'Price Wizard','Overview','edit_plugins', 'pricewizard','pw_menu_overview');
		
		// Custom Diaries
		add_submenu_page('pricewizard', 'Custom Diaries','Update:Custom diary','edit_plugins', 'custom-diaries','pw_menu_customdiaries');		

		//Standard Diaries
		add_submenu_page('pricewizard', 'Std Diaries','Update:Std diary','edit_plugins','standard-diaries','pw_menu_standarddiaries');

		//Covers and Accessories
		add_submenu_page('pricewizard', 'Covers & Access.','Update:Cover/Access.','edit_plugins', 'covers-and-accessories','pw_menu_coversaccessories');

		//Nice Names
		add_submenu_page('pricewizard', 'Nice Names','Update: Nice names','edit_plugins', 'nice-names','pw_menu_nicenames');

		// International pricing rates
		add_submenu_page('pricewizard', 'Rate Adjust.','Update:FX rate','edit_plugins', 'fxrate-converter','pw_menu_fxrateconvert');

		//Email setting status
		add_submenu_page('pricewizard', 'Email','Update:Email settings','edit_plugins', 'email-settings','pw_menu_email_settings');
		
		// HELP - explanation for updating info 
		add_submenu_page('pricewizard', 'Help','Help','edit_plugins', 'help','pw_menu_help');
		
		// sandpit
		//add_submenu_page('pricewizard', 'Sandpit','Sandpit','edit_plugins', 'sandpit','pw_menu_sandpit');
		
	}	
}

	/**
	 * Adds content for Overview
	 *
	 */
	function pw_menu_overview() {
	
	include ('pw-menu-overview.php');
	}
	
	
	/**
	 * Adds content for Custom Diaries
	 *
	 */
	function pw_menu_customdiaries() {
	
	include ('pw-menu-customdiaries.php');
	}

	/**
	 * Adds content for Standard Diaries
	 *
	 */
	function pw_menu_standarddiaries() {
	
	include ('pw-menu-standarddiaries.php');
	}

	/**
	 * Adds content for Covers and Accessories
	 *
	 */
	function pw_menu_coversaccessories() {
	
	include ('pw-menu-options.php');
	}

		/**
	 * Adds content for Nice names
	 *
	 */
	function pw_menu_nicenames() {
	
	include ('pw-menu-nicenames.php');
	}

	/**
	 * Adds content for FX Rate Converter
	 *
	 */
	function pw_menu_fxrateconvert() {
	
	include ('pw-menu-fxrateconvert.php');
	}

	/**
	 * Adds content for Email settings
	 *
	 */
	function pw_menu_email_settings() {
	
	include ('pw-menu-email.php');
	}

	
	/**
	 * Adds content for Help
	 *
	 */
	function pw_menu_help() {
	
	include ('pw-menu-help.php');
	}

	
		/**
	 * Adds Sandpit to menu
	 *
	 */
	function pw_menu_sandpit() {
	
	include ('pw-menu-sandpit.php');
	}


	?>