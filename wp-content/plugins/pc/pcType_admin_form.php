<?php
$dirname = dirname( __FILE__ );
$root    = false !== mb_strpos( $dirname, 'wp-content' ) ? mb_substr(
	$dirname, 0, mb_strpos( $dirname, 'wp-content' )
) : $dirname;

require_once( $root . "wp-config.php" );
global $wpdb;
$table_name = 'pc_cat_type';

if ( $_POST['pc_hidden'] == 'Y' ) {

	$catname = $_POST['pc_cat'];
	$myrows  = $wpdb->get_results(
		"SELECT * FROM " . $table_name . " where type_name LIKE '%" . $catname
		. "%'"
	);
	if ( empty( $myrows ) ) {
		$wpdb->insert(
			$table_name, array(
				'type_name' => $catname,
				'status'    => 1
			)
		);

		//echo $record_id = $wpdb->insert_id;

		?>
		<div class="updated">
			<p><strong><?php _e( 'Type saved.' ); ?></strong></p>
		</div>
	<?php
	} else {
		?>
		<div class="error">
			<p><strong><?php _e( 'Type already exist.' ); ?></strong></p>
		</div>
	<?php
	}


	?>


<?php
} else {
	//Normal page display
}


// Delete code start here
if ( $_REQUEST['action'] == 'del' && ! empty( $_REQUEST['cid'] ) ) {
	$cid = $_REQUEST['cid'];
	$wpdb->delete( $table_name, array( 'id' => $cid ) );
	?>
	<div class="updated">
		<p><strong><?php _e( 'Type Deleted.' ); ?></strong></p>
	</div>
<?php
}
// Delete code End here

?>


<div class="wrap">
	<?php echo "<h2>" . __( 'Year Book Add Type' ) . "</h2>"; ?>
	<form name="pc_type_form" method="post" action="<?php echo str_replace(
		'%7E', '~', $_SERVER['REQUEST_URI']
	); ?>">
		<input type="hidden" name="pc_hidden" value="Y">

		<p>
			<?php _e( "Type" ); ?>
			<input type="text" name="pc_cat" value="" size="20"><?php _e(
				" ex: Inkjet, Toner, ElectroInk"
			); ?>
		</p>

		<p class="submit">
			<input type="submit" name="Submit"
			       value="<?php _e( 'Update Options', 'oscimp_trdom' ) ?>"/>
		</p>
	</form>
</div>


<table id="catList" class="catList" width="100%" border="1" cellspacing="0"
       cellpadding="0">
	<tr>
		<th>Id</th>
		<th>Category Name</th>
		<th>Status</th>
		<th>Action</th>
	</tr>

	<?php

	$fivesdrafts = $wpdb->get_results(
		"SELECT *
	FROM $table_name"
	);


	foreach ( $fivesdrafts as $fivesdraft ) {
		echo '<tr>
        <td>' . $fivesdraft->id . '</td>
        <td>' . $fivesdraft->type_name . '</td>
        <td>' . $fivesdraft->status . '</td>
        <td>

            <a href="' . str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] )
		     . '&action=del&cid=' . $fivesdraft->id . '">Delete</a>
        </td>
    </tr>';

	}

	// <a href="'. str_replace('%7E', '~', $_SERVER['REQUEST_URI']).'&action=edit&cid='.$fivesdraft->id.'">Edit</a>&nbsp&nbsp|&nbsp&nbsp


	?>
</table>
