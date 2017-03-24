<?php
$dirname = dirname( __FILE__ );
$root    = false !== mb_strpos( $dirname, 'wp-content' ) ? mb_substr(
	$dirname, 0, mb_strpos( $dirname, 'wp-content' )
) : $dirname;

require_once( $root . "wp-config.php" );
global $wpdb;

$pc_email = 'pc_email_setting';



// save form data
if ( $_POST['pc_hidden'] == 'Y' ) {
	/*echo '<pre>';
	*print_r($_POST);
		die();*/
	$subject  = $_POST['prospect_subject'];
	$fromname = $_POST['prospect_fromname'];
	$fromemail  = $_POST['prospect_fromemail'];
	$content = $_POST['prospect_content'];
	$optional   = $_POST['prospect_optional'];
	$optional_footer = $_POST[ 'optional_footer' ];
	$footer_address = $_POST[ 'footer_address' ];

	//$myrows   = $wpdb->get_results( "SELECT * FROM " . $pc_email . " where email_subject LIKE '%" . $subject . "%' AND from_name LIKE '%" . $fromname . "%' " );

	//echo  "SELECT * FROM " . $pc_email . " where email_subject LIKE '%" . $subject . "%' AND from_name LIKE = '%" . $fromname . "%' ";


		$wpdb->update (
			$pc_email ,
			array (
				'email_subject'    => $subject ,
				'from_name'        => $fromname ,
				'from_email'       => $fromemail ,
				'email_content'    => stripslashes ($content) ,
				'optional_content' => stripslashes($optional) ,
				'content_footer'   => stripslashes($optional_footer) ,
				'contact_address'  => stripslashes($footer_address)
			) ,
			array ( 'id' => 1 )
		);

		?>
		<div class="updated">
			<p><strong><?php _e( 'Configuration saved.' ); ?></strong></p>
		</div>



<?php
} else {
	//Normal page display
}

$myrows = $wpdb->get_row( "SELECT * FROM " . $pc_email . " where id = 1 " );
?>


<div class="wrap">

	<form name="pc_cat_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">

		<table cellpadding="5" cellspacing="5" border="0">
			<tr>
				<td colspan="2">
						<?php echo "<h2>" . __ ( 'Email configuration' ) . "</h2>"; ?>
						<input type="hidden" name="pc_hidden" value="Y">
				</td>
			</tr>
			<tr>
				<td>
					<?php _e ( "Email Subject" ); ?>
				</td>
				<td>
					<input type="text" name="prospect_subject" size="100" value="<?php echo $myrows->email_subject  ?>">
					<br>
					<span style="font-size:10px;">
						Student Diaries - Pricing Wizard Quote
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e ( '"From:" Name' ); ?>
				</td>
				<td>
					<input type="text" name="prospect_fromname" size="100" value="<?php echo $myrows->from_name ?>">
					<br>
					<span style="font-size:10px;">
						For example "Student Diaries"
					</span>

				</td>
			</tr>
			<tr>
				<td>
					<?php _e ( '"From:" Email address' ); ?>
				</td>
				<td>
					<input type="text" name="prospect_fromemail" size="100" value="<?php echo $myrows->from_email ?>">
				</td>
			</tr>
			<tr>
				<td>
					<?php _e ( "Content" ); ?>
				</td>
				<td>
					<textarea name="prospect_content" rows="6" cols="100"><?php echo $myrows->email_content ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e ( "Optional line" ); ?>
				</td>
				<td>
					<textarea name="prospect_optional" rows="2" cols="100"><?php echo $myrows->optional_content ?></textarea>
					<br>
					<span style="font-size:10px;">Such as &lt;p&gt;&lt;em&gt; As this quote is after 30 September, unfortunately it does not include our 15% Early Bird Discount sorry :( &lt;/em&gt;&lt;/p&gt;</span>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e ( "Optional Footer" ); ?>
				</td>
				<td>
					<textarea name="optional_footer" rows="5" cols="100"><?php echo $myrows->content_footer ?></textarea>
					<br>
					<span style="font-size:10px;">
						Best regards<br>
						Andrew and the team at Student Diaries<br>
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<?php _e ( "Contact Address" ); ?>
				</td>
				<td>
					<textarea name="footer_address" rows="5" cols="100"><?php echo $myrows->contact_address ?></textarea>
				</td>
			</tr>

			<tr>
				<td>
				</td>
				<td>
					<input type="submit" name="Submit" value="<?php _e ( 'Submit' , 'oscimp_trdom' ) ?>"/>
				</td>
			</tr>

		</table>
	</form>
</div>


