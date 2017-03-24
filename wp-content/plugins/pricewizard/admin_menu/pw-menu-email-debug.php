<?php
/*
The code on this page is largely based on the WordPress plugin called WP From Email (Vn 1.1) by  Skullbit.com at http://skullbit.com/wordpress-plugin/wp-from-email/
The code has been adapted to enable a user to tailor an email issued to new useers
*/

if( !class_exists('wizard_emaildebug') ){
	class wizard_emaildebug{
		function wizard_emaildebug() 
		{ 
			//constructor

			#Update Settings on Save
			$post_action = ( isset( $_POST[ 'action' ] ) ? $_POST[ 'action' ] : false );
			
			if( $post_action == 'wizard_debug_update' )
				$this->savesettings();

			#Open form
			$this->emaildebug();
		} 
		// end of constructor function
		
		function savesettings()
		{
			check_admin_referer('wizard-update-debug');
			$update = get_option( 'pw-settings' );
			$errors = 0;
			$errors_notice="ERROR:";
				//DEBUG
				//if (isset($_POST['debug_override_adminto'])) {
					//echo "admin override isset";
				//}
			
			if (isset($_POST['debug_override_prospectto']) ) {
				if ($_POST['debug_prospect_toemail'] != "") {
				$debug_override_prospectto = 1;
				}
				else
				{
					$errors=1;
					$errors_notice .= "Prospect Override<br/>You tried to override the Prospect email address. But you didn't enter an alternative address.<br/>Please try again";
				}
			}
			else
			{
				$debug_override_prospectto = 0;
			}
			
			if (isset($_POST['debug_override_adminto'])) {
				if ($_POST['debug_admin_toemail'] != "")  {
					$debug_override_adminto = 1;
				}
				else
				{
					$errors=1;
					$errors_notice .= "Admin Override:You tried to override the Admin email address. But you didn't enter an alternative address.<br/>Please try again";
				}			
			}
			else
			{
				$debug_override_adminto = 0;
			}
			
			if ($errors===0) {

				$update["debug_prospect_toemail"] = $_POST['debug_prospect_toemail'];
				$update["debug_admin_toemail"] = $_POST['debug_admin_toemail'];
				$update["debug_override_prospectto"] = $debug_override_prospectto;
				$update["debug_override_adminto"] = $debug_override_adminto;
				update_option( 'pw-settings', $update );
				$_POST['notice'] = 'Debug settings saved';
			}
			else
			{
				$_POST['notice'] = $errors_notice;
			}
		}
		
		function emaildebug()
		{
			$defrom = get_option( 'pw-settings' );
			$post_notice = ( isset( $_POST[ 'notice' ] ) ? $_POST[ 'notice' ] : false );
			if( $post_notice ){
				echo '<div id="message" class="updated fade"><p><strong>' . $_POST['notice'] . '.</strong></p></div>';
			}
			
			if($defrom['debug_override_prospectto'] == 1) 
			{
				$prospecttochecked  = "checked";
			} else
			{
				$prospecttochecked = ""; 
			}

			if($defrom['debug_override_adminto'] == 1) 
			{
				$admintochecked  = "checked";
			} else
			{
				$admintochecked = ""; 
			}
			?>
			<div class="wrap">
				<!-- <h3>On this page: Email debug settings</h3> -->
<?php				
//$no_exists_value = get_option( 'pw-settings' );
//var_dump( $no_exists_value ); /* outputs false */
//echo "<p>this was the option list</p>";
?>

				<form method="post" action="">
					<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field( 'wizard-update-debug'); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row" colspan=2><strong>TESTING/DEBUGGING OVERRIDE</strong><br/><span style="font-size:12px;">Note: The settings on this page are used for testing and debugging email in this plugin.<br/> They allow you to override the normal Prospect email address and/or the Admin email address. By overriding the email address, you can send email to a substitute email address.</span></th>
						</tr>
						<tr valign="top">
							<td><strong>Prospect "To" email address</strong></td>
							<td><input type="checkbox" name="debug_override_prospectto" value = "<?php echo $defrom['debug_override_prospectto']; ?>" <?php echo $prospecttochecked; ?> />&nbsp;&nbsp;&nbsp;Enable test address? (overrides usual setting)&nbsp;<br/>
							<input type="text" name="debug_prospect_toemail" size="70" value="<?php echo $defrom['debug_prospect_toemail']; ?>" /></td>
						</tr>
						<tr valign="top">
							<td><strong>Admin "To" email address</strong></td>
							<td><input type="checkbox" name="debug_override_adminto" value = "<?php echo $defrom['debug_override_adminto']; ?>" <?php echo $admintochecked; ?> />&nbsp;&nbsp;&nbsp;Enable test address? (overrides usual setting)&nbsp;<br/>
							<input type="text" name="debug_admin_toemail" size="70" value="<?php echo $defrom['debug_admin_toemail']; ?>" />
							</td>
						</tr>
					</table>
			

					<p class="submit"><input name="Submit" value="<?php _e('Save Changes') ?>" type="submit" />
						<input name="action" value="wizard_debug_update" type="hidden" />
					</p>

				</form>
			</div>
			<?php
		} // end of function
		
	}
} //END Class WPFromEmail

if( class_exists('wizard_emaildebug') )
	$wizard_emaildebug = new wizard_emaildebug();
?>