<?php
$dirname = dirname( __FILE__ );
$root    = false !== mb_strpos( $dirname, 'wp-content' ) ? mb_substr(
	$dirname, 0, mb_strpos( $dirname, 'wp-content' )
) : $dirname;

require_once( $root . "wp-config.php" );
global $wpdb;
$table_name = 'pc_cat';

if ( $_POST['pc_hidden'] == 'Y' ) {
	$catname = $_POST['pc_cat'];
	$myrows  = $wpdb->get_results( "SELECT * FROM " . $table_name . " where cat_name LIKE '%" . $catname . "%'" );
	if ( empty( $myrows ) ) {
		$wpdb->insert(
			$table_name, array(
				'cat_name' => $catname,
				'status'   => 1
			)
		);

		?>
		<div class="updated">
			<p><strong><?php _e( 'Category saved.' ); ?></strong></p>
		</div>
	<?php
	} else {
		?>
		<div class="error">
			<p><strong><?php _e( 'Category already exist.' ); ?></strong></p>
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
		<p><strong><?php _e( 'Category Deleted.' ); ?></strong></p>
	</div>
<?php
}
// Delete code End here

?>


<div class="wrap">
	<?php echo "<h2>" . __( 'Year Book Add category' ) . "</h2>"; ?>
	<form name="pc_cat_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">
		<input type="hidden" name="pc_hidden" value="Y">

		<p>
			<?php _e( "category(What) " ); ?>
			<input type="text" name="pc_cat" value="" size="20"><?php _e( " ex: Pages, Freight, Artwork" ); ?>
		</p>

		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e( 'Update Options', 'oscimp_trdom' ) ?>"/>
		</p>
	</form>
</div>


<table id="catList" class="catList" width="100%" border="1" cellspacing="0" cellpadding="0">
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
        <td>' . $fivesdraft->cat_name . '</td>
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
