<?php
/*
The code on this page is largely based on the WordPress plugin called WP From Email (Vn 1.1) by  Skullbit.com at http://skullbit.com/wordpress-plugin/wp-from-email/
The code has been adapted to enable a user to tailor an email issued to new useers
*/

if( !class_exists('wizard_testdata') ){
	class wizard_testdata{
		function wizard_testdata() 
		{ 
			//constructor

			#Update Settings on Save
			$post_action = ( isset( $_POST[ 'action' ] ) ? $_POST[ 'action' ] : false );
			
			if( $post_action == 'wizard_testdata_update' )
				$this->savesettings();

			#Open form
			$this->testdataform();
		} 
		// end of constructor function
		
		function savesettings()
		{
			check_admin_referer('wizard-update-testdata');
			$update = get_option( 'pw-settings' );
			$errors = 0;
			$errors_notice="ERROR:";
				//DEBUG
				//if (isset($_POST['wizard_testdata'])) {
				//	echo "wizard_testdata isset. it equals ".$_POST['wizard_testdata'] ;
				//}
				
			if (isset($_POST['wizard_testdata']) ) {
				$pw_testdata = 1;
			}
			else
			{
				$pw_testdata = 0;
			}				
			
			if ($errors===0) {
				$update["wizard_testdata"] = $pw_testdata;
				update_option( 'pw-settings', $update );
				$_POST['notice'] = 'Settings saved';
			}
			else
			{
				$_POST['notice'] = $errors_notice;
			}
		}
		
		function testdataform()
		{
			$testdata ="";
			$testdata = get_option( 'pw-settings' );
			$post_notice = ( isset( $_POST[ 'notice' ] ) ? $_POST[ 'notice' ] : false );
			if( $post_notice ){
				echo '<div id="message" class="updated fade"><p><strong>' . $_POST['notice'] . '.</strong></p></div>';
			}

			if($testdata['wizard_testdata'] == 1) 
			{
				$testdatachecked  = "checked";
			} else
			{
				$testdatachecked = ""; 
			}
			
			
			?>
			<div class="wrap">
	
				<form method="post" action="">
					<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field( 'wizard-update-testdata'); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row" colspan=2><strong>Test data</strong><br/>
							<span style="font-size:12px;">Testing and debugging requires the fields for school name, user name and user password to be completed.<br/>It's much easier if this doesn't have to be inserted manually<br/>
							The plugin has a js file called "pw-form-test-data.js". If you check the box below, that script will be included and the form will include a link to trigger the script.<br/>							
							</th>
						</tr>

						<tr>
<table>						
						<td><strong>Enable test data?</strong></td>
							<td><input type="checkbox" name="wizard_testdata" value = "<?php echo $testdata['wizard_testdata']; ?>" <?php echo $testdatachecked; ?> />
							</td>
</table>
						</tr>


					</table>
			

					<p class="submit"><input name="Submit" value="<?php _e('Save Changes') ?>" type="submit" />
						<input name="action" value="wizard_testdata_update" type="hidden" />
					</p>

				</form>
			</div>
			<?php
		} // end of function
		
	}
} //END Class WPFromEmail

if( class_exists('wizard_testdata') )
	$wizard_testdata = new wizard_testdata();
?>