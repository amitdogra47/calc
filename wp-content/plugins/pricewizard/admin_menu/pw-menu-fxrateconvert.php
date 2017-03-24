<?php
/*
The code on this page is largely based on the WordPress plugin called WP From Email (Vn 1.1) by  Skullbit.com at http://skullbit.com/wordpress-plugin/wp-from-email/
The code has been adapted to enable a user to tailor an email issued to new users
*/

if( !class_exists('wizard_rate_conversion') ){
	class wizard_rate_conversion{
		function wizard_rate_conversion() 
		{ 
			//constructor
	
			#Update Settings on Save
			$post_action = ( isset( $_POST[ 'action' ] ) ? $_POST[ 'action' ] : false );
			
			if( $post_action == 'wizard_settings_update' )
				$this->savesettings();

			#Open form
			$this->ratesettings();
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

				$update["wizard_int_rate"] = $_POST['answer'];
				$update["wizard_fx_adjust"] = $_POST['fx_adjust'];
				$update["wizard_discount_adjust"] = $_POST['discount_adjust'];
				$update["wizard_other_adjust"] = $_POST['other_adjust'];
				$update["wizard_int_notes"] = $_POST['wizard_int_notes'];
				update_option( 'pw-settings', $update );
				$_POST['notice'] = 'Settings Saved';
			}
			else
			{
				$_POST['notice'] = $errors_notice;
			}
		}
		
		function ratesettings()
		{
			$defrom = get_option( 'pw-settings' );
			$post_notice = ( isset( $_POST[ 'notice' ] ) ? $_POST[ 'notice' ] : false );
			if( $post_notice ){
				echo '<div id="message" class="updated fade"><p><strong>' . $_POST['notice'] . '</strong></p></div>';
			}
			?>
			<div class="wrap">
				<h3>Rate Adjustment</h3>
				The database rates need to change from time to time. However, rather than change every price in every table, we can change them at a global level.<br/>
				1 - You can't edit the rate adjustment directly.<br/>
				2 - Instead, enter the amounts for each adjustment field.<br/>
				3 - Click the "Calculate" button. This will multiply each of the adjustment amounts, rounded to 3 decimal places. So you can see the adjustment before you update it.<br/>
				4 - You can enter any notes or comments in the "Assumptions" field.<br/>
				5 - To save a rate change, click the "Save Changes" button".<br/>
<?php				
//$no_exists_value = get_option( 'pw-settings' );
//var_dump( $no_exists_value ); /* outputs false */
//echo "<p>this was the option list</p>";

?>
				<form name="calculateForm" id="calculateForm" method="post" action="">
					<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field( 'wizard-update-options'); ?>
<table>
	<tr>
		<td>
			<strong>Rate adjustment: </strong>
		</td>
		<td>
			<input type="text" id="wizard_int_rate" name="wizard_int_rate" size="10" value="<?php echo $defrom['wizard_int_rate']; ?>" readonly />
			
		</td>
		<td></td>
	</tr>
	<tr valign="top">
		<td>
			<strong>FX adjustment: </strong>
		</td>
		<td><input type="text" id="fx_adjust" name="fx_adjust" size="10" value="<?php echo $defrom['wizard_fx_adjust']; ?>" /></td>
		<td>
			Prices in the database are expressed in $A. So quotes for NZ customers need to be adjusted for an exchange rate difference (rounded to three decimal places).<br/>
			<strong>Here's how:</strong><br/>
			For the <strong><u>SDAU</u></strong> website, the foreign currency adjustment is 1.0<br/>
			For the <strong><u>SDNZ</u></strong> website, the foreign currency adjustment is equal to the NZ$ / $A exchnage rate.<br/>
			For example, if NZ$1 buys $A0.93, then the foreign exchange adjustment = 0.93; if NZ$1 buys A$1.05, then the foreign exchange adjustment = 1.05<hr/>
		</td>
	</tr>
	<tr valign="top">
		<td>
			<strong>Discount adjustment: </strong>
		</td>
		<td>
			<input type="text" id = "discount_adjust" name="discount_adjust" size="10" value="<?php echo $defrom['wizard_discount_adjust']; ?>" />
		</td>
		<td>
			Prices in the database are <strong>net</strong> of discount.<br/>
			For example, if full price is $100, and discount = 15%, then the database price is $85 ($100 * 0.15).<br/>
			BUT once the discount period is over, the Pricing Wizard must charge the full price. We do this by adjusting the value of this cell.<br/>
			<strong>Here's how:</strong><br/>
			<strong><u>During</u></strong> the discounted price period, the adjustment rate = 1.0<br/>
			<strong><u>Outside</u></strong> the discounted price period: the adjustment rate = 1/(1-discount rate). Round to three decimal places</br>
			For example, say the discount is 15%. Then the adjustment is: 1/(1-.15) => 1/.85 => 1.176471 => 1.177<hr/>
		</td>
	</tr>
		<tr>
		<td>
			<strong>Other adjustment: </strong>
		</td>
		<td>	<input type="text" id = "other_adjust" name="other_adjust" size="10" value="<?php echo $defrom['wizard_other_adjust']; ?>" />
		</td>
		<td>
		
			
		</td>
		<td></td>
	</tr>
	<tr>
		<td>
			<strong>Calculated adjustment: </strong>
		</td>
		<td>
			<input type="text" id = "answer" name="answer" size="10" />

			
		</td>
		<td><input type="button" value="Calculate" onclick="calculate();" /></td>
	</tr>
	
	<tr>
		<td>				
			<strong>Assumptions:</strong>
		</td>
		<td colspan=2>
			<input type="text" name="wizard_int_notes" size="100" value="<?php echo $defrom['wizard_int_notes']; ?>" />
		</td>

	</tr>
	<tr>
		<td>
		</td>
		<td>
			<p class="submit"><input name="Submit" value="<?php _e('Save Changes') ?>" type="submit" />
				<input name="action" value="wizard_settings_update" type="hidden" /><input name="action_button[999999999]" value="Cancel" type="submit" />
			</p>		
			
			
		</td>
		<td></td>
	</tr>
</table>
				</form>
<script language="JavaScript" type="text/javascript">

function N(num, places) 
  { return +(Math.round(num + "e+" + places)  + "e-" + places);
  }
function calculate()
{
// temporary place to store the result
         var result = 0;
				  // convert the values in the boxes into integers
				 var x = Number(document.calculateForm.fx_adjust.value);
				 var y = Number(document.calculateForm.discount_adjust.value);
				 var z = Number(document.calculateForm.other_adjust.value);
				 
				 // calculate formula
				 result = Math.round(x * y * z*1000)/1000
				 //var lvs =  "" ;
				 //lvs += +N(result_test,3) ;
		//var result=Math.round(8.111111*1000)/1000  //returns 8.111
				 // load the answer back into the form
				 document.calculateForm.answer.value = result;
				 

}
</script>			
	<p>The adjustment is a calculated field. It is a combination of up to three factors:<br>
	<ul style="list-style-type:circle;">
		<li style="margin-left:20px;">a foreign currency variation $AU => $NZ ($AU value=1)</li>
		<li style="margin-left:20px;">a discount (if/when/where applicable).</li>
		<li style="margin-left:20px;">an 'other' adjustment that might be required from time to time.</li>
	</ul>
	is normally a combination of two elements: Exchange rates and Discounted prices</p>

	<p><strong>EXCHANGE RATE ADJUSTMENT</strong></p>
	<p>Prices in the database are for Australian customers. However the same tables are used in the New Zealand website, so NZ prices need to be adjusted.</p>
	<p>Australian customers: the exchange rate adjustment is 1.000.
		<br/>New Zealand customers: the exchange rate adjustment is the exchange rate (actual or forecast) for $NZ1 to the Australian dollar.
		<br/>For example: if the exchange rate is $NZ1=$AU1.18, then the NZ rate adjustment => 1.18.
	</p>

	<p><strong>DISCOUNTED PRICE ADJUSTMENT</strong></p>
	<p>Prices in the database are net of discount. For example, if the database price is $85 and the full price is $100, then the discount is 15%. When the discount period is over, the Pricing Wizard should use the full price.</p>
	<p>Discounted price adjustment-during discount period: 1.0</br>
	Discounted price adjustment-after discount period: 1/(1-discount rate) (round the result to three decimal places)
		<br/>For example if the discount is 15% then the calculation is: 1/(1-.15) => 1/.85 => 1.176471 (or 1.177)
	</p>

	<p><strong>COMBINING THE ADJUSTMENTS</strong></p>
	<p>Multiply the two elements and use the product as the rate adjustment (round to three decimal points)</p>
	<p>For example:<br/>
		<strong>Australia:</strong> the exchange rate=1, discount adjustment = 1.177 then rate adjustment => 1*1.177 => 1.177.<br/>
		<strong>New Zealand:</strong> the exchange rate=1.15, discount adjustment = 1.177 then rate adjustment => 1.15*1.177 => 1.354.
	</p>
<hr>
	<p>This code is based on <strong>WP From Email</strong> - for more information refer: <a href="http://skullbit.com/wordpress-plugin/wp-from-email/">http://skullbit.com/wordpress-plugin/wp-from-email/</a></p>
</div>
			<?php
		} // end of function
		
	}
} //END Class WPFromEmail

if( class_exists('wizard_rate_conversion') )
	$wizard_rate_conversion = new wizard_rate_conversion();
?>