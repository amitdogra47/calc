<?php

global $wpdb;

echo '<div class="wrap">';
echo '<div id="icon-tools" class="icon32"></div>';
echo "<h3>Settings</h3>";
?>
<p>The plugin uses wp_options for email settings and FX rate adjustment settings. Plugin settings under "pw-settings".</p>
	<table class="widefat" border="1" style="width:700px;">
		<tr>
			<th align=left><strong>Adjustment</strong></th>
			<th align=left><strong>Settings</strong></th>
		</tr>
		<tr>
			<td>Email - Prospect</td>
			<td>prospect_subject => Email subject<br/>
				prospect_fromname => The "From" name for the email,<br/>
				prospect_fromemail => The "From" email address for the email,<br/>
				prospect_content  => The message in the email,<br/>
				prospect_optional  => An optional content line for the message,<br/>
				footer_address  => The footer address that appears in the email.
			</td>
		</tr>
		<tr>
			<td>Email - Admin</td>
			<td>
				admin_subject => Email subject,<br/>
				admin_fromname =>  Email 'from' name,<br/>
				admin_fromemail =>  Email 'from' address,<br/>
				admin_toname =>  Email 'to' name,<br/>
				admin_toemail =>  Email 'to' address,<br/>

			</td>
		</tr>
		<tr>
			<td>Email-debug/test</td>
			<td>wizard_int_rate => Overall adjustment rate,<br/>
				wizard_fx_adjust => Component for FX rate adjustment,<br/>
				wizard_discount_adjust => Component for Discount adjustment,<br/>
				wizard_other_adjust => Component for any other adjustment,<br/>
				wizard_int_notes  => Comments and notes
			</td>
		</tr>
		<tr>
			<td>FX Rate</td>
			<td>wizard_int_rate => Overall adjustment rate,<br/>
				wizard_fx_adjust => Component for FX rate adjustment,<br/>
				wizard_discount_adjust => Component for Discount adjustment,<br/>
				wizard_other_adjust => Component for any other adjustment,<br/>
				wizard_int_notes  => Comments and notes
			</td>
		</tr>
	</table>
	</div>
<?php
?>