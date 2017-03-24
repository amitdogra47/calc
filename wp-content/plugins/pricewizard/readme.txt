=== Student Diaries - Price Wizard ===
Requires at least: 4.2.2
Tested up to: 4.2.2

Create an on-line real-time quotation for a diary. The quote can be viewed on-screen and/or it can be emailed to prospect. A notification email is sent to Student Diaries for every quote.

== Description ==
A plugin to create an on-line real-time quotation for Student Diaries.

The plugin creates 11 custom tables and also creates some custom settings. Eleven tables contain product and pricing information, and the contents of these can be edited. The remaining table contains a copy of the quote. The custom settings are for email details as well as global price rate variations. Details of the tables and settings are explained under the "Help" option of the Price Wizard" menu.

A prerequisite for the plugin is the WordPress plugin, "prettyPhoto Media" which is used to display certain diary layout options. The plugin doies not access images via the WordPress Media lIbrary. Furttyher details are availbale under FAQ.

The plugin is supplied "in working order", complete with images used in 2014.

== Installation ==
1. Obtain the plugin. This should be a zip archive called pricewizard.zip.
2. Extract the plugin folder to your desktop. It should create a folder called "pricewizard"; this contins the plugin files and sub-folders.
3. Using your FTP program, upload the Plugin folder to the wp-content/plugins folder in your online WordPress directory.
4. Delete the desktop folder. A folder of the same name is created in the next step.
5. Obtain the plugin images archive called "pricewizardimages.zip". 
6. Extract the plugin folder to your desktop. It should create a folder called "pricewizard"; this contains the plugin images.
7. Using your FTP program, upload the Images folder to the wp-content/uploads folder in your online WordPress directory.
8. Obtain the plugin images archive called "prettyphotoimages.zip". 
9. Extract the plugin folder to your desktop. It should create a folder called "prettyphoto"; this contins the images used with prettyPhoto.
10. Using your FTP program, upload the Plugin folder to the wp-content/uploads folder in your online WordPress directory.
11. Go to "Plugins" screen in WordPres and find the newly uploaded Plugin in the list.
12. Click "Activate Plugin" to activate it.
13. A new menu called "Price Wizard" is automatically created in the Admin menu. Select "Price Wizard" and follow the instructions on the "Read-me-first" tab.
14. The plugin assumes that the plugin is enabled on a page. Insert the function call "forminsert_wizard();" in the page.

== Frequently Asked Questions ==

=  How do we call the wizard? =

use the function 

= prettyphoto Media isn't 'on the WordPress plugin registry. Is it safe to use? =

You're right, that plugin isn't on the WordPress registry, but I think it is safe to use.

We selected it in 2013 - at that time it was VERY popular and highly rated. For reasons unknown, the plugin isn't in the registry.

That said, it is a very simple implemenation of prettyPhoto and there is little or no scope for danger. In addition, in 2015 the theme for the website was changed and possibly the features rendered by prettyPhoto can/will be delivered by a new plugin. That's why I chose to stick with prettyPhoto Media even though it is not on the registry.

= What happens to custom tables on deactivation/reactivation? =

Nothing. You can activate and reactivate without risk of deleting content of custom tables or customised settings.

On deactivation. none of the tables or settings is deleted. 
Code to drop the tables on deactivation has been written ("pw-deactivation_unused.php" and "/activation/deactivatetables_unused.php") but not enabled in the plugin. It was thought better to allow the network adminsitrator the discretion to delete the custom table manually. Code to drop the settings has not been written.

On reactivation, the code checks whether the custom setting (pw-settings) already exists; if it is, then it remains intact, if not then it is created from the default. 

= Where are the settings stored? =

Settings are stored in wp-options with option name = "pw-settings". Refer to the Price Wizard "Help" menu for a full list of the settings.


= What are the custom tables? =

Refer to the "Help" menu for details of custom tables.


= How does the plugin use and access images = 

The Price Wizard is built in a form. The plugin file "form-layout/pw-form-layout.php" contains the details layout for the form.

As presently built, the plugin does not use the WordPress Media Library ().
The form uses images in two ways:
1 - display of images in the body of the form generally. Thes images could use the - these images are saved in folder = /uploads/pricewizard/
Images & image storage. The plugin does not use the Media Library.The plugin uses images in two ways. 
1 - display of images in the body of the form generally - these images are saved in folder = /uploads/pricewizard/
2 - images used with prettyPhoto - these images are saved in folder = /uploads/prettyphoto/

You must manually create both of these folders.

= How do I stop the plugin script and styles from loading on every page? = 

Copy-paste the following php into your functions.php. 
Edit the value for "is_page" to the value of your page.

// start
// dequeue Price Wizard scripts unless page = Wizard
add_action( 'wp_print_scripts', 'pw_deregister_js', 100 );
function pw_deregister_js() {
	if ( !is_page('Wizard') ) {
		wp_dequeue_script( 'smartwizard' );
		wp_dequeue_script( 'jquery-form' );
		wp_dequeue_script( 'json2' );
		wp_dequeue_script( 'pw-form-rules' );
		wp_dequeue_script( 'pw-form-validator' );
		wp_dequeue_script( 'pw-ajax-request' );
	}
}

// deregister Price Wizard styles unless page = Wizard
add_action('wp_print_styles', 'pw_deregister_styles', 100);
function pw_deregister_styles() {
	if ( !is_page('Wizard') ) {
		wp_deregister_style( 'pricewizard-style' );
	}
}
// degister prettyPhoto Media scripts and styles unless page = Wizard
add_action( 'wp_print_scripts', 'ppm_deregister_js', 100 );
function ppm_deregister_js() {
	if ( !is_page('Wizard') ) {
		$handle = "prettyphoto";
		wp_dequeue_script($handle);
	}
}

// deregister prettyPhoto Media styles unless page = Wizard
add_action('wp_print_styles', 'ppm_deregister_styles', 100);
function ppm_deregister_styles() {
	if ( !is_page('Wizard') ) {
		$handle = "prettyphoto";
		wp_deregister_style( $handle );
	}
}

// end

= Where did the css come from?  =

There was a small css component relating the the form (pricewizard.css). I took this plus the SmartWizard vertical css (smart_wizard_vertical.css) and ran it through a CSS compressor. The result saved 2.1kb and reduced the number of requests by one. I left the compressed css in the SmartWizard folder because SmartWizard calls for certain images that are also part of SmartWizard.