<?php
/*
The code on this page is largely based on the WordPress plugin called WP From Email (Vn 1.1) by  Skullbit.com at http://skullbit.com/wordpress-plugin/wp-from-email/
The code has been adapted to enable a user to tailor an email issued to new useers
*/

if( !class_exists('wizard_emaildomain') ){
	class wizard_emaildomain{
		function wizard_emaildomain() 
		{ 
			//constructor

			#Update Settings on Save
			$post_action = ( isset( $_POST[ 'action' ] ) ? $_POST[ 'action' ] : false );
			
			if( $post_action == 'wizard_domain_update' )
				$this->savesettings();

			#Open form
			$this->emaildomain();
		} 
		// end of constructor function
		
		function savesettings()
		{
			check_admin_referer('wizard-update-domain');
			$update = get_option( 'pw-settings' );
			$errors = 0;
			$errors_notice="ERROR:";
				//DEBUG
				//if (isset($_POST['debug_override_adminto'])) {
					//echo "admin override isset";
				//}
			
			
			if ($errors===0) {

				$update["wizard_email_countryvalidation"] = $_POST['wizard_email_countryvalidation'];
				update_option( 'pw-settings', $update );
				$_POST['notice'] = 'Domain settings settings saved';
			}
			else
			{
				$_POST['notice'] = $errors_notice;
			}
		}
		
		function emaildomain()
		{
			$auchecked = "";
			$nzchecked = "";
			$defrom = get_option( 'pw-settings' );
			$post_notice = ( isset( $_POST[ 'notice' ] ) ? $_POST[ 'notice' ] : false );
			if( $post_notice ){
				echo '<div id="message" class="updated fade"><p><strong>' . $_POST['notice'] . '.</strong></p></div>';
			}

			if($defrom['wizard_email_countryvalidation'] === "AU") 
			{
				$auchecked = "checked";
				$nzchecked = "";
			} else
			{
				$nzchecked = "checked";
				$auchecked = ""; 
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
					<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field( 'wizard-update-domain'); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row" colspan=2><strong>Email domain check</strong><br/>
							<span style="font-size:12px;">Users of the price wizard must supply an email address for a valid domain.<br/>
							For Australia, valid domains are "edu.au or gov.au or ntschools.net".<br/>
							For New Zealand, valid domains are "govt.nz or school.nz or ac.nz".<br/>
							A javascript formhandler validates the email address accordingly but we need a way to "tell" it which country rules to apply. That is the purpose of this checkbox..</span><br/>							
							</th>
						</tr>
<table>
						<tr>
	<td>
		Australia
	</td>
	<td style="padding-left:10px;">
		<input type="radio" name="wizard_email_countryvalidation" value="AU" <?php echo $auchecked; ?> />
	</td>
</tr>
<tr>
	<td>
		New Zealand
	</td>
	<td style="padding-left:10px;">
		<input type="radio" name="wizard_email_countryvalidation" value="NZ" <?php echo $nzchecked; ?>/>
	</td>
</tr>
</table>
					</table>
			

					<p class="submit"><input name="Submit" value="<?php _e('Save Changes') ?>" type="submit" />
						<input name="action" value="wizard_domain_update" type="hidden" />
					</p>

				</form>
			</div>
			<?php
		} // end of function
		
	}
} //END Class WPFromEmail

if( class_exists('wizard_emaildomain') )
	$wizard_emaildomain = new wizard_emaildomain();
?>