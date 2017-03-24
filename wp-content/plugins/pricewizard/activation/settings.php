<?php
/**
* Set plugin options.
*
* @uses get_option() function
*/
function pw_settings_setup() {
	
	// create options
	$pw_settings = get_option( 'pw-settings' );
	if ( !$pw_settings ) {
	$pw_settings = pw_default_options();
	}
	update_option( 'pw-settings', $pw_settings );

}


function pw_default_options() {
	$admin_subject = "Student Diaries - Pricing Wizard Ref#";
	$admin_fromname  = "Student Diaries";
	$admin_fromemail = "info@studentdiaries.com.au";
	$admin_toname = "Student Diaries";
	$admin_toemail = "info@studentdiaries.com.au";
	$prospect_subject = "Student Diaries - Pricing Wizard Quote#";
	$prospect_fromname = "Student Diaries";
	$prospect_fromemail = "info@studentdiaries.com.au";
	$prospectcontent = "Greetings from Student Diaries<br/>
<p>Thanks for getting an on-line quote for your diaries. The full details of your quote are set out below.</p>
<p>If you would like more information, or perhaps a sample diary, or if we can assist you in any other way, please feel free contact us.</p>
<p>Best regards<br/>
<p>Andrew and the team at Student Diaries</p>";
	$prospectoptional = "<p> </p>";
	$footeraddress = "<b>STUDENT DIARIES</b><br/>
<b>PHONE:</b> 1-800-880-341 (Australia-wide)   02 9213 3740 (Local)<br/>
<b>MAIL</b> GPO Box 1950, Sydney NSW 2001<br/>
<b>FAX:</b> 02 9213 3799";
	$debug_override_prospectto = "0";
	$debug_prospect_toemail = "";
	$debug_override_adminto = "0";
	$debug_admin_toemail = "";
	$wizard_int_rate = 1;
	$wizard_fx_adjust = 1;
	$wizard_discount_adjust = 1;
	$wizard_other_adjust = 1;
	$wizard_int_notes = "";
	$wizard_email_countryvalidation = "AU";
	$wizard_testdata = "0";

	$options = array(
		'admin_subject' => $admin_subject,
		'admin_fromname' => $admin_fromname,
		'admin_fromemail' => $admin_fromemail,
		'admin_toname' => $admin_toname,
		'admin_toemail' => $admin_toemail,
		'prospect_subject' => $prospect_subject,								
		'prospect_fromname' => $prospect_fromname,
		'prospect_fromemail' => $prospect_fromemail,
		'prospect_content' => $prospectcontent,
		'prospect_optional' => $prospectoptional,
		'footer_address' => $footeraddress,
		'debug_override_prospectto' => $debug_override_prospectto,
		'debug_prospect_toemail' => $debug_prospect_toemail,
		'debug_override_adminto' => $debug_override_adminto,
		'debug_admin_toemail' => $debug_admin_toemail,
		'wizard_int_rate' => $wizard_int_rate,	
		'wizard_fx_adjust' => $wizard_fx_adjust,	
		'wizard_discount_adjust' => $wizard_discount_adjust,	
		'wizard_other_adjust' => $wizard_other_adjust,	
		'wizard_int_notes'  => $wizard_int_notes,	
		'wizard_email_countryvalidation'  => $wizard_email_countryvalidation,	
		'wizard_testdata'  => $wizard_testdata,	
	);
return $options;
}

?>