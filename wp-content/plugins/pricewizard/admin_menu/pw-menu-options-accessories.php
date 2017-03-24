<?php
/*
The code on this page is largely based on the WordPress plugin called WP From Email (Vn 1.1) by  Skullbit.com at http://skullbit.com/wordpress-plugin/wp-from-email/
The code has been adapted to enable a user to tailor an email issued to new useers
*/

//** edit table name
// Table management = wp_pwoptionsaccessories

//echo "step1";
//** edit class name and function name and variable name (at end of page)
if( !class_exists('std_prices_accessories') ){
	class std_prices_accessories{
		function std_prices_accessories() { //constructor
			if(!isset($_POST['action_button']))
			{
			//echo "<br/>step1.1 Action is not set so we will load edit page.";
			//unset ($_POST['notice']);
			$_POST['notice'] = "";
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
					$v1 = $_POST['sd_diary_var1'];$v2 = $_POST['sd_diary_var2'];$v3 = $_POST['sd_diary_var3'];$v4 = $_POST['sd_diary_var4'];
					$v5 = round($_POST['sd_diary_var5'], 3);
					//echo "<br/>step1.3 You clicked Update and you want to change id = ".$id ." to ".$var;
					unset ($_POST['notice']);
					$this->updatetable($id,$v1,$v2,$v3,$v4,$v5);
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
		function updatetable($d,$v1,$v2,$v3,$v4,$v5){
			global $wpdb;
			//echo "<br/>step3.1 Table update about to take place for id = $d adjusted to var $v1";
//** edit query string
			$updates = $wpdb->update( 'wp_pwoptionsaccessories', array( 'binding_type' => $v1, 'accessory_name' => $v2,'accessory_nicename' => $v3, 'size' => $v4, 'price' => $v5), array( 'seqid' => $d ) );
			//$wpdb->show_errors();
			//$wpdb->print_error();
			if ($updates === false){
				$_POST['notice'] = "ERROR - Database update was NOT successful - check error log.";
			}
			else{
				$_POST['notice'] = "Update completed";
			}
		} // end function updatetable

		// this function displays details for a a specific item so that the user can chnage the price and either click Update or Cancel.
		function updatepage($d) {
			global $wpdb;
			$sd_sql= "SELECT * FROM wp_pwoptionsaccessories WHERE seqid = $d";
			//echo "<br/>sql is $sd_sql<br/>";
			$sd_result = $wpdb->get_row($sd_sql,ARRAY_N);
			$t0 = $sd_result[0]; $t1 = $sd_result[1]; $t2 = $sd_result[2]; $t3 = $sd_result[3]; $t4 = $sd_result[4]; $t5 = $sd_result[5]; 
?>		
			<div class="wrap">
<!-- edit heading -->
				<h3>Accessory prices - by binding type and size</h3>
				<form id="updatevar" method="post" action="">
					<table>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">ID</th>
							<td><?php echo $t0; ?></td>
						</tr>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">Binding Type</th>
							<td><input type="text" name="sd_diary_var1" size="20" value="<?php echo $t1; ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">Code name</th>
							<td><input type="text" name="sd_diary_var2" size="20" value="<?php echo $t2; ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">Nice name</th>
							<td><input type="text" name="sd_diary_var3" size="20" value="<?php echo $t3; ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">Size</th>
							<td><input type="text" name="sd_diary_var4" size="10" value="<?php echo $t4; ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row" width="120" style="text-align:left">Price</th>
							<td><input type="text" name="sd_diary_var5" size="10" value="<?php echo $t5; ?>" /></td>
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
			<h3>Accessory prices - by binding type and size</h3>
			<form id="editvalues" method="post" action="">
			<?php if( function_exists( 'wp_nonce_field' )) wp_nonce_field('sd-diary-var'); ?>
<!-- edit table columns as necessary	 -->
				<table class="widefat" style="width:650px;"><tr>
					<th width="30px" align=left>ID</th>
					<th width="100px" align=left>Binding Type</th>
					<th width="100px" align=left>Code Name</th>
					<th width="250px" align=left>Nice Name</th>
					<th width="100px" align=left>Size</th>
					<th width="100px" align=left>Price</th>

					
					
					<th width="40px" align=left>Edit?</th>
				</tr>
				<!-- get_item details -->
<?php 			$editsql= "SELECT * FROM wp_pwoptionsaccessories ORDER BY seqid";
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
						<td><?php echo $edit_result[$i][3]; ?></td>
						<td><?php echo $edit_result[$i][4]; ?></td>
						<td><?php echo $edit_result[$i][5]; ?></td>
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
	} //END Class std_prices_accessories
}  // end if class not exists
if( class_exists('std_prices_accessories') )
	$diaryprices = new std_prices_accessories();
?>