<?php

	// template for tabs in an admin submenu
	// Instructions
	// Step#1: update the directory address
	// Step#2: update the page description
	// Step#3: update the array for the tab names and the pages containing their content


	// get the page name variable for linking later
	if (isset( $_GET['page'] ))
	{
	$mypage =  $_GET['page'] ;
	}

	// This is Step#1: confirm the directory address
	//$wizard_dir = "C:\data\server\htdocs\svn_test\wp-content\plugins\priceguide";
	$wizard_dir = dirname(__FILE__);

	// This is step#2: enter a page description
	//Heading the core page
	$pageheading = "Price Wizard - Overview";

	//This is Step3: enter the details for this tab
	// be sure to make the default tab the first in the list
	$headings=array(
		"Read me first"=>"pw-menu-overview-readme.php",
		"Sub Menus"=>"pw-menu-overview-submenus.php", 
		"Test data"=>"pw-menu-overview-testdata.php", 
		
	);

	//set the default tab to the first items in the array
	$defaulttab=key($headings);

	// set up the tabs and content
	$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : $defaulttab;
	echo '<div class="wrap">';
	$current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : $defaulttab;
	echo '<div id="icon-tools" class="icon32"></div>';
	echo "<h2>".$pageheading."</h2>";
	echo '<h2 class="nav-tab-wrapper">';
	foreach ( $headings as $tab_key => $tab_caption ) {
		$active = $current_tab == $tab_key ? 'nav-tab-active' : '';
		echo '<a class="nav-tab ' . $active . '" href="?page='.$mypage.'&tab=' . $tab_key . '">' . $tab_key . '</a>';	
	}
	echo '</h2>';
	// insert content here
	$page = $headings[$tab];
	$filename = $wizard_dir.'/'.$page;
	include_once($filename);
	// insert content here
	echo '</div>';

?>