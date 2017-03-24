<?php
/*
The class code on this page is largely based on the WordPress plugin called WP From Email (Vn 1.1) by  Skullbit.com at http://skullbit.com/wordpress-plugin/wp-from-email/
The code has been adapted to enable a user to tailor an email issued to new users
*/

if( !class_exists('wizard_emailprospect') ){
	class wizard_emailprospect{
		function wizard_emailprospect() 
		{ 
			//constructor

			#Update Settings on Save
			$post_action = ( isset( $_POST[ 'action' ] ) ? $_POST[ 'action' ] : false );
			
			if( $post_action == 'wizard_details_update' )
				$this->savesettings();

			#Open form
			$this->emaildetails();
		} 
		// end of constructor function


		function savesettings()
		{
			check_admin_referer('wizard-update-details');
			$update = get_option( 'pw-settings' );
			$errors = 0;
			$errors_notice="ERROR:";

			if ($errors===0) {

				$update["prospect_subject"] = $_POST['prospect_subject'];
				$update["prospect_fromname"] = $_POST['prospect_fromname'];
				$update["prospect_fromemail"] = $_POST['prospect_fromemail'];
				$update["prospect_content"] = $_POST['prospect_content'];
				$update["prospect_optional"] = $_POST['prospect_optional'];
				$update["footer_address"] = $_POST['footer_address'];
				update_option( 'pw-settings', $update );
				$_POST['notice'] = 'Prospect settings saved';
			}
			else
			{
				$_POST['notice'] = $errors_notice;
			}
		}
		
		function emaildetails()
		{
			$defrom = get_option( 'pw-settings' );
			$post_notice = ( isset( $_POST[ 'notice' ] ) ? $_POST[ 'notice' ] : false );
			if( $post_notice ){
				echo '<div id="message" class="updated fade"><p><strong>' . $_POST['notice'] . '.</strong></p></div>';
			}
			
			?>
			<div class="wrap">
				<h3>On this page: <u>Prospect email</u> || <u>Email Content</u> || <u>Email Footer</u></h3>
<?php				
//$no_exists_value = get_option( 'pw-settings' );
//var_dump( $no_exists_value ); /* outputs false */
//echo "<p>this was the option list</p>";
?>

				<form method="post" action="">
					<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field( 'wizard-update-details'); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row" colspan=2><strong>PROSPECT EMAIL</strong></td>
						</tr>
					<tr valign="top">
							<td style="padding-bottom:0;padding-top:0;"><strong>Email Subject</strong></td>
							<td style="padding-bottom:0;padding-top:0;"><input type="text" name="prospect_subject" size="100" value="<?php echo $defrom['prospect_subject']; ?>" /></td>
							</tr>
							<tr><td colspan=2 style="padding-top:0;"><span style="font-size:12px;">Assume that the Quote ID is appended to the end of the Subject Line. For example "Student Diaries - Pricing Wizard Quote#1234"</span></td>
						</tr>
					<tr valign="top">
							<td style="padding-top:0;"><strong>"From:" Name</strong><br/><span style="font-size:10px;">For example "Student Diaries"</span></td>
							<td style="padding-top:0;"><input type="text" name="prospect_fromname" size="100" value="<?php echo $defrom['prospect_fromname']; ?>" /></td>
						</tr>
					<tr valign="top">
							<td style="padding-top:0;"><strong>"From:" Email address</strong><br/><span style="font-size:10px;">Only ONE email address</span></td>
							<td style="padding-top:0;"><input type="text" name="prospect_fromemail" size="100" value="<?php echo $defrom['prospect_fromemail']; ?>" /></td>
					</tr>
					<tr>
							<td colspan=2 style="padding-top:0;padding-bottom:0;"><hr/ style="border-color:blue;border-width: 2px;border-style: solid;"></td>
					</tr>
					<tr valign="top">
							<th scope="row" colspan=2>EMAIL Content<br/><span style="font-size:12px;">Note#1: Enter as HTML, including line breaks and/or paragraphs<br/>Note#2: The full quote (in table form) is automatically inserted below this content. The Email Footer (refer below) will be inserted below the quote.</span></td>
						</tr>
						<tr valign="top">
							<td style="padding-bottom:0;padding-top:0; vertical-align:top;"><strong>Content</strong></td>
							<td style="padding-bottom:0;padding-top:0;"><textarea name="prospect_content" rows="6" cols="100"><?php echo $defrom['prospect_content']; ?></textarea></td>
						</tr>
						<tr valign="top">
							<td style="padding-bottom:0;padding-top:0; vertical-align:top;"><strong>Optional line</strong><br/><span style="font-size:10px;">(after Content)</span></td>
							<td style="padding-bottom:0;padding-top:0;"><textarea name="prospect_optional" rows="2" cols="100"><?php echo $defrom['prospect_optional']; ?></textarea><br/><span style="font-size:10px;">Such as &lt;p&gt;&lt;em&gt; As this quote is after 30 September, unfortunately it does not include our 15% Early Bird Discount sorry :( &lt;/em&gt;&lt;/p&gt;</span></td>
						</tr>
											<tr>
							<td colspan=2 style="padding-top:0;padding-bottom:0;"><hr/ style="border-color:blue;border-width: 2px;border-style: solid;"></td>
					</tr>
					</tr>
						<tr valign="top">
							<th scope="row" colspan=2>EMAIL FOOTER<br/><span style="font-size:12px;">Note: Enter as HTML, including line breaks and/or paragraphs.</span></td>
						</tr>
						<tr valign="top">
							<td><strong>Contact Address</strong></td>
							<td><textarea name="footer_address" rows="5" cols="100"><?php echo $defrom['footer_address']; ?></textarea></td>
						</tr>
					</table>
			

					<p class="submit"><input name="Submit" value="<?php _e('Save Changes') ?>" type="submit" />
						<input name="action" value="wizard_details_update" type="hidden" />
					</p>

				</form>
			
			</div>
			<?php
		} // end of function
		
	}
} //END Class WPFromEmail

if( class_exists('wizard_emailprospect') )
	$wizard_emailprospect = new wizard_emailprospect();
?>