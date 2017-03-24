<?php

global $wpdb;

echo '<div class="wrap">';
echo '<div id="icon-tools" class="icon32"></div>';
echo "<h3>Database tables</h3>";
?>
<p>The plugin uses 11 custom database tables:</p>
	<table class="widefat" border="1" style="width:700px;">
		<tr>
				<th align=left><strong>Table Name</strong></th>
				<th align=left><strong>Related activity</strong></th>

		</tr>
		<tr>
			<td>wp_pwcustompages</td><td><strong>Std Diaries - Custom Pages</strong></td>
		</tr>
		<tr>	
			<td>wp_pwdateentries</td><td><strong>Std Diaries - Date Entries</strong></td>
		</tr>
		<tr>
			<td>wp_pwnicenames</td><td><strong>Nice Names - Style/Bindings</strong></td>
		</tr>
		<tr>
			<td>wp_pwoptionsaccessories</td><td><strong>Covers/Accessories - Accessories</strong></td>
		</tr>
		<tr>
			<td>wp_pwoptionscovers</td><td><strong>Covers/Accessories - Cover Options</strong></td>
		</tr>
		<tr>
			<td>wp_pwpricescustom</td><td><strong>Custom Diaries - Prices</strong></td>
		</tr>
			<td>wp_pwpricesstandard</td><td><strong>Std Diaries - Prices</strong></td>
		</tr>
		<tr>
		<tr>			
			<td>wp_pwqtybreakcustom</td><td><strong>Custom Diaries - Breaks</strong></td>
		</tr>
		<tr>			
			<td>wp_pwqtybreakstd</td><td><strong>Std Diaries - Breaks</strong></td>
		</tr>
		<tr>
			<td>wp_pwstampingcustom</td><td><strong>Custom Diaries - Stamping</strong></td>
		</tr>
		<tr>
			<td>wp_pwquotes</td><td>contains quote details - automatically saved; not manually updated</td>
		</tr>




	</table>
	</div>
<?php
?>