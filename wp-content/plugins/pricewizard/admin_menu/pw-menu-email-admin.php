<?php
/*
The code on this page is largely based on the WordPress plugin called WP From Email (Vn 1.1) by  Skullbit.com at http://skullbit.com/wordpress-plugin/wp-from-email/
The code has been adapted to enable a user to tailor an email issued to new useers
*/

if( !class_exists('wizard_emailsettings') ){
	class wizard_emailsettings{
		function wizard_emailsettings() 
		{ 
			//constructor

			#Update Settings on Save
			$post_action = ( isset( $_POST[ 'action' ] ) ? $_POST[ 'action' ] : false );
			
			if( $post_action == 'wizard_settings_update' )
				$this->savesettings();

			#Open form
			$this->emailsettings();
		} 
		// end of constructor function

	
		function savesettings()
		{
			check_admin_referer('wizard-update-options');
			$update = get_option( 'pw-settings' );
			$errors = 0;
			$errors_notice="ERROR:";
				//DEBUG
				//if (isset($_POST['debug_override_adminto'])) {
					//echo "admin override isset";
				//}
			
			
			if ($errors===0) {
				$update["admin_subject"] = $_POST['admin_subject'];
				$update["admin_subject"] = $_POST['admin_subject'];
				$update["admin_fromname"] = $_POST['admin_fromname'];
				$update["admin_fromemail"] = $_POST['admin_fromemail'];
				$update["admin_toname"] = $_POST['admin_toname'];
				$update["admin_toemail"] = $_POST['admin_toemail'];
				update_option( 'pw-settings', $update );
				$_POST['notice'] = 'Admin settings saved';
			}
			else
			{
				$_POST['notice'] = $errors_notice;
			}
		}
		
		function emailsettings()
		{
			$defrom = get_option( 'pw-settings' );
			$post_notice = ( isset( $_POST[ 'notice' ] ) ? $_POST[ 'notice' ] : false );
			if( $post_notice ){
				echo '<div id="message" class="updated fade"><p><strong>' . $_POST['notice'] . '.</strong></p></div>';
			}
			
			?>
			<div class="wrap">
				<h3>On this page: Admin email</h3>
<?php				
//$no_exists_value = get_option( 'pw-settings' );
//var_dump( $no_exists_value ); /* outputs false */
//echo "<p>this was the option list</p>";
?>

				<form method="post" action="">
					<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field( 'wizard-update-options'); ?>
					<table class="form-table">


						<tr valign="top">
							<th scope="row" colspan=2><strong>ADMIN EMAIL</strong></td>
						</tr>
						<tr valign="top">
							<td style="padding-bottom:0;padding-top:0;"><strong>Email Subject</strong></td>
							<td style="padding-bottom:0;padding-top:0;"><input type="text" name="admin_subject" size="100" value="<?php echo $defrom['admin_subject']; ?>" /></td>
						</tr>
						<tr><td colspan=2 style="padding-top:0;"><span style="font-size:12px;">Assume that the Quote ID is appended to the end of the Subject Line. For example "Student Diaries - Pricing Wizard Quote#1234"</span></td>
						</tr>
					<tr valign="top">
							<td><strong>"From:" Name</strong><br/><span style="font-size:10px;">For example "Student Diaries"</span></td>
							<td><input type="text" name="admin_fromname" size="100" value="<?php echo $defrom['admin_fromname']; ?>" /></td>
						</tr>
						<tr valign="top">
							<td style="padding-top:0;"><strong>"From:" email address</strong><br/><span style="font-size:10px;">Only ONE email address</span></td>
							<td style="padding-top:0;"><input type="text" name="admin_fromemail" size="100" value="<?php echo $defrom['admin_fromemail']; ?>" /></td>
						</tr>
						<tr valign="top">
							<td style="padding-top:0;"><strong>"To:" Name"</strong></td>
							<td style="padding-top:0;"><input type="text" name="admin_toname" size="100" value="<?php echo $defrom['admin_toname']; ?>" /></td>
						</tr>
						<tr valign="top">
							<td style="padding-top:0;"><strong>"To:" email address"</strong><br/><span style="font-size:10px;">Separate addresses with commas</span></td>
							<td style="padding-top:0;"><input type="text" name="admin_toemail" size="100" value="<?php echo $defrom['admin_toemail']; ?>" /></td>
						</tr>
					</table>
			

					<p class="submit"><input name="Submit" value="<?php _e('Save Changes') ?>" type="submit" />
						<input name="action" value="wizard_settings_update" type="hidden" />
					</p>

				</form>
			<p>This code is based on <strong>WP From Email</strong> - for more information refer: <a href="http://skullbit.com/wordpress-plugin/wp-from-email/">http://skullbit.com/wordpress-plugin/wp-from-email/</a></p>
			</div>
			<?php
		} // end of function
		
	}
} //END Class WPFromEmail

if( class_exists('wizard_emailsettings') )
	$wizard_emailsettings = new wizard_emailsettings();
?>