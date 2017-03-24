<?php
/*
The code on this page is largely based on the WordPress plugin called WP From Email (Vn 1.1) by  Skullbit.com at http://skullbit.com/wordpress-plugin/wp-from-email/
The code has been adapted to enable a user to tailor an email issued to new useers
*/

//** edit table name
// Table management = wp_pwnicenames

//echo "step1";
//** edit class name and function name and variable name (at end of page)
if( !class_exists('diary_bulkpriceupdate') ){
	class diary_bulkpriceupdate{
		function diary_bulkpriceupdate() { //constructor
			
			add_action( 'admin_footer', 'my_action_javascript' );

			function my_action_javascript() {
			?>
				<script type="text/javascript" >
				jQuery(document).ready(function($) {
					var data = {
						action: 'my_action',
						whatever: 1234
					};

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
					$.post(ajaxurl, data, function(response) {
						alert('Got this from the server: ' + response);
					});
				});
				</script>
				<?php
			}
			
			
			
			add_action('wp_ajax_my_action', 'my_action_callback');

			function my_action_callback() {
				global $wpdb; // this is how you get access to the database
				$whatever = intval( $_POST['whatever'] );
				$whatever += 10;
				echo $whatever;
				die(); // this is required to return a proper result
			}
			if(!isset($_POST['action_button']))
			{
			//echo "<br/>step1.1 Action is not set so we will load edit page.";
			unset ($_POST['notice']);
			$this->editpage();
			}
			else
			{	
				// action_button must be set, so get action
				//echo "<br/>step1.1 Action was set and is equal to ";
				$submitted_array = array_keys($_POST['action_button']);
				$id = intval($submitted_array[0]);
				$action = $_POST['action_button'][$submitted_array[0]];
				//echo "<br/>step1.2 the  id = $id and the action is $action";
				if ($action =="Edit")	// the action button can be either Edit , Update or Cancel	//Test for edit; id will have been supplied
				{
					//echo "<br/>step1.3 You clicked Edit and you want to change  id = ".$id ;
					unset ($_POST['notice']);
					$this->updatepage($id);
				}
				elseif ($action =="Update")	// the action button can be either Edit , Update or Cancel//Test for Update; id will have been supplied
				{
//** check rounding requirement
					$v1 = $_POST['sd_diary_var1'];$v2 = $_POST['sd_diary_var2'];
					//echo "<br/>step1.3 You clicked Update and you want to change id = ".$id ." to ".$var;
					unset ($_POST['notice']);
					$this->updatetable($id,$v1,$v2);
					// then load edit form
					$this->editpage();
				}
				elseif ($action =="Cancel")// the action button can be either Edit , Update or Cancel//Test for Cancel; id will have been supplied
				{
					//echo "<br/>step1.3 You clicked Cancel 
					$_POST['notice']= "Update cancelled";
					$this->editpage();
				}	
				else // values should only be Edit, Update and cancel, so if it gets past here we are in trouble.
				{
					$_POST['notice'] = "Response could not be evaluated - Problem in the code for this page. Call Ted";
					$this->editpage();
				}
			}
		}	

		// this function will perform an update on the table
		function updatetable($d,$v1,$v2){
			global $wpdb;
			//echo "<br/>step3.1 Table update about to take place for id = $d adjusted to var $v1";
//** edit query string
			$updates = $wpdb->update( 'wp_pwnicenames', array( 'tech_name' => $v1, 'nice_name' => $v2), array( 'seqid' => $d ) );
			//$wpdb->show_errors();
			//$wpdb->print_error();
			$_POST['notice'] = "Update completed";
		} // end function updatetable

		// this function displays details for a a specific item so that the user can chnage the price and either click Update or Cancel.
		function updatepage($d) {
			global $wpdb;
			$sd_sql= "SELECT * FROM wp_pwnicenames WHERE seqid = $d";
			//echo "<br/>sql is $sd_sql<br/>";
			$sd_result = $wpdb->get_row($sd_sql,ARRAY_N);
			$t0 = $sd_result[0]; $t1 = $sd_result[1]; $t2 = $sd_result[2]; 
?>		
			<div class="wrap">
<!-- edit heading -->
				<h2>DIARY NICE NAMES - Edit Details</h2>
				<form id="updatevar" method="post" action="">
					<table>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">ID</th>
							<td><?php echo $t0; ?></td>
						</tr>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">Code Name</th>
							<td><input type="text" name="sd_diary_var1" size="20" value="<?php echo $t1; ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">Nice name</th>
							<td><input type="text" name="sd_diary_var2" size="60" value="<?php echo $t2; ?>" /></td>
						</tr>
					</table>
					<p class="submit">
						<input name="Submit" value="<?php _e('Save Changes') ?>" type="submit" />
						<input name="action_button[999999999]" value="Cancel" type="submit" />
						<input name="action_button[<?php echo $t0; ?>]" value="Update" type="hidden" />
					</p>
				</form>
			</div>
<?php	
		}	//end of function diary_updatepage
		
		// this function will display a page of item values to select for edit
		function editpage() {
			global $wpdb;
			//echo "<br/>step2.1 Start edit page.";
			if( $_POST['notice'] ){
				echo '<div id="message" class="updated fade"><p><strong>' . $_POST['notice'] . '.</strong></p></div>';
			}?>
			<div class="wrap">
<!-- edit heading	-->
			<h2>Bulk Price Update</h2>
			<form id="editvalues" method="post" action="">
			<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field('sd-diary-var'); ?>
			
<!-- edit table columns as necessary	 -->
<table>
<tr>
	<td><p><strong>Step #1: Choose a table to update.</strong></p>
	</td>
	<td>
		<select name="tableelist">
			<option value="wp_pwpricescustom" selected>Custom Diaries</option>
			<option value="wp_pwstampingcustom">Custom Diaries-Stamping</option>
			<option value="wp_pwpricesstandard">Standard Diaries</option>
			<option value="wp_pwcustompages">Std Diaries-Custom Pages</option>
			<option value="wp_pwdateentries">Std. Diaries-Date Entries</option>
			<option value="wp_pwoptionscovers">Common:Cover Options</option>
			<option value="wp_pwoptionsaccessories">Common:Accessories</option>
		</select>
	</td>
</tr>
<tr>
	<td><p><strong>Step #2: Enter a percentage to update the prices. DO NOT the percentage sign; e.g.: enter 6.5 to increase prices by 6.5%.</strong></p>
	</td>
	<td><input id="update" class="myupdate" type="text" name="your_percent">%
	</td>
</tr>

<p>Step #2: Choose a percentage to update the prices.</p>
</table>
				<table class="widefat" style="width:650px;"><tr>
					<th width="30px" align=left>ID</th>
					<th width="100px" align=left>Code Name</th>
					<th width="250px" align=left>Nice Name</th>					
					<th width="40px" align=left>Edit?</th>
				</tr>
				<!-- get_item details -->
<?php 			// $editsql= "SELECT * FROM wp_pwnicenames ORDER BY seqid";
				//echo "sql is $editsql<br/>";
				$edit_result = $wpdb->get_results($editsql,ARRAY_N);
				//print_r($editresult);
				$i=0;
				foreach ($edit_result as $z1) 
				{
					// list the contents for each row
//** edit cells to match columns - Edit button will always = ID#				
?>
					<tr>
						<td><?php echo $edit_result[$i][0]; ?></td>
						<td><?php echo $edit_result[$i][1]; ?></td>
						<td><?php echo $edit_result[$i][2]; ?></td>	
						<td><input type="submit" value="Edit" name="action_button[<?php echo $edit_result[$i][0]; ?>]"/></td>
					<!-- 	next i -->

<?php				$i++;
				}
?>				
			<!-- close table -->
			</table>
			</form>
			</div>
<?php			
		}//end of function editpage
	} //END Class diary_bulkpriceupdate
}  // end if class not exists
if( class_exists('diary_bulkpriceupdate') )
	$diaryprices = new diary_bulkpriceupdate();
?>