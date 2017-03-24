<?php
/*
/ The file contains the functions for sending an email to the prospect 
/ and for sending an email to sales admin
*/

// the propspect email - send email to prospect and to Andrew-
// id=quote ID, quotetext= the quote in table form , prospect_email = prospect email address
function prospect_email($id,$quotetext,$prospect_email){

	global $wpdb;
	//$to=$prospect_email;
				
	$pw_email=get_option( 'pw-settings' );
	$pw_email_subject = $pw_email['prospect_subject'];
	$pw_email_fromname = $pw_email['prospect_fromname'];
	$pw_email_fromemail = $pw_email['prospect_fromemail'];
	$pw_email_content = $pw_email['prospect_content'];
	$pw_email_optional = $pw_email['prospect_optional'];
	$pw_email_footer = $pw_email['footer_address'];
	$debugpto = $pw_email['debug_override_prospectto'];
	$debugptoemail = $pw_email['debug_prospect_toemail'];
	
	// evaluate To address override
	if (($debugpto===0)) {
		$to=$prospect_email;
	}
	else
	{
		$to = $debugptoemail;
	}

	$email_subject = $pw_email_subject."".$id;
	$email_content = $pw_email_content.$pw_email_optional.$quotetext;
	$email_footer = $pw_email_footer;
	$email_message = "<html>".$email_content."<p></p>".$email_footer."</html>";

	$html_headers = "";
	$html_headers .= 'MIME-Version: 1.0' . "\r\n";
	$html_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$html_headers .= "From: ".$pw_email_fromname."<".$pw_email_fromemail.">\r\n";

	@mail( $to, $email_subject,$email_message,$html_headers);
	
}


// send an email to Andrew
// Send admin mail regardless of whether user wants email or not
// $id = quote id, $qn - propect name, $qs = propect school, $prospect_email = prospect email address,
// $cp = prospect phone number, $quotetext = the actual quote, 
// $r = whether or not prospect requested an email

function admin_email($id,$qn,$qs,$prospect_email,$cp, $quotetext,$r){
	global $wpdb;
	//if($es=="Failure"){$email_response=" but it could NOT be delivered";} else {$email_response="";}	
	
	if($r=="yes"){$response="The user requested an email";}	
	else {$response="The user did NOT request an email";}
	
	$pw_adminemail=get_option( 'pw-settings' );
	$asubject = $pw_adminemail['admin_subject'];
	$afromname = $pw_adminemail['admin_fromname'];
	$afromemail = $pw_adminemail['admin_fromemail'];
	$atoname = $pw_adminemail['admin_toname'];
	$atoemail = $pw_adminemail['admin_toemail'];
	$debugato = $pw_adminemail['debug_override_adminto'];
	$debugatoemail = $pw_adminemail['debug_admin_toemail'];
	
	
	// evaluate To address override
	if (($debugato===0)) {
		$to=$atoemail;
	}
	else
	{
		$to = $debugatoemail;
	}

$email_content = "<p>Online price enquiry<br/>
Requested by: ".$qn." of ".$qs."<br/>
Contact email: ".$prospect_email." and Contact phone number: ".$cp."<br/>".$response."</p>
Full quote details are set out below:<br/>";

$email_message = "<html>".$email_content."<p></p>".$quotetext."</html>";

$email_subject = $asubject."".$id;

$html_headers = "";
$html_headers .= 'MIME-Version: 1.0' . "\r\n";
$html_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$html_headers .= "From: ".$afromname."<".$afromemail.">\r\n";
$html_headers .= "Reply-To: ". $prospect_email . "\r\n";
@mail( $to, $email_subject,$email_message,$html_headers);
}
?>