<?php
$dirname = dirname( __FILE__ );
$root    = false !== mb_strpos( $dirname, 'wp-content' ) ? mb_substr(
	$dirname, 0, mb_strpos( $dirname, 'wp-content' )
) : $dirname;

require_once( $root . "wp-config.php" );
global $wpdb;

$pc_cat_type = 'pc_cat_type';
$pc_cat      = 'pc_cat';
$pcRel       = 'pc_rel';


// save form data
if ( $_POST['pc_hidden'] == 'Y' ) {
	$catname  = $_POST['catname'];
	$typename = $_POST['typename'];
	$priceis  = $_POST['price'];
	$costtype = $_POST['costtype'];
	$notes    = $_POST['notes'];
	$myrows   = $wpdb->get_results( "SELECT * FROM " . $pcRel . " where catid LIKE '%" . $catname . "%' AND typeid = '%" . $typename . "%' " );

	/*echo "SELECT * FROM " . $pcRel . " where catid LIKE '%" . $catname
		. "%' AND typeid = '%"
		. $typename . "%' ";*/

	if ( empty( $myrows ) ) {
		$wpdb->insert(
			$pcRel, array(
				'catid'    => $catname,
				'typeid'   => $typename,
				'cost'     => $priceis,
				'notes'    => $notes,
				'costtype' => $costtype,
				'status'   => 1
			)
		);

		?>
		<div class="updated">
			<p><strong><?php _e( 'Relation saved.' ); ?></strong></p>
		</div>
	<?php
	} else {
		?>
		<div class="error">
			<p><strong><?php _e( 'Relation already exist.' ); ?></strong></p>
		</div>
	<?php
	}


	?>


<?php
} else {
	//Normal page display
}


// Code to list option
$typeList = $wpdb->get_results( "SELECT * FROM $pc_cat_type where status = 1" );

$type = '';
foreach ( $typeList as $tList ) {
	$type .= '<option value="' . $tList->id . '">' . $tList->type_name . '</option>';
}


$catList = $wpdb->get_results( "SELECT * FROM $pc_cat where status = 1" );

$cat = '';
foreach ( $catList as $cList ) {
	$cat .= '<option value="' . $cList->id . '">' . $cList->cat_name . '</option>';
}


// Delete code start here
if ( $_REQUEST['action'] == 'del' && ! empty( $_REQUEST['cid'] ) ) {
	$cid = $_REQUEST['cid'];
	$wpdb->delete( $pcRel, array( 'id' => $cid ) );
	?>
	<div class="updated">
		<p><strong><?php _e( 'Relation Deleted.' ); ?></strong></p>
	</div>
<?php
}
// Delete code End here

?>
<div class="wrap">
	<?php echo "<h2>" . __( 'Category and Type Relation' ) . "</h2>"; ?>
	<form name="pc_cat_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">
		<input type="hidden" name="pc_hidden" value="Y">

		<p>
			<?php _e( "Select Category" ); ?>
			<select id="catname" name="catname">
				<option value="">Please Select</option>
				<?php echo $cat ?>
			</select>
		</p>

		<p>
			<?php _e( "Select Type" ); ?>
			<select id="typename" name="typename">
				<option value="">Please Select</option>
				<?php echo $type ?>
			</select>
		</p>

		<p>
			<?php _e( "Set cost " ); ?>
			<input type="text" name="price" value="" size="20">
		</p>

		<p>
			<?php _e( "cost Type" ); ?>
			<select id="costtype" name="costtype">
				<option value="cur">Currency</option>
				<option value="per">%</option>
			</select>
		</p>

		<p>
			<?php _e( "Notes" ); ?>
			<select id="notes" name="notes">
				<option value="page">Per Page</option>
				<option value="book">Per Book</option>
				<option value="job">Per Job</option>
			</select>
		</p>

		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e( 'Make Relation', 'oscimp_trdom' ) ?>"/>
		</p>
	</form>
</div>


<!--   Listing data -->
<table id="relList" class="relList" width="100%" border="1" cellspacing="0"
       cellpadding="0">
	<tr>
		<th>Id</th>
		<th>catName</th>
		<th>typeName</th>
		<th>cost</th>
		<th>cost Type</th>
		<th>Notes</th>
		<th>Action</th>
	</tr>

	<?php

	$relDataSet = $wpdb->get_results(
		"SELECT *
	FROM $pcRel"
	);


	foreach ( $relDataSet as $relData ) {


		$catName  = $wpdb->get_row( "SELECT cat_name FROM $pc_cat WHERE id = $relData->catid" );
		$typeName = $wpdb->get_row( "SELECT type_name FROM $pc_cat_type WHERE id = $relData->typeid" );


		echo '<tr>
        <td>' . $relData->id . '</td>
        <td>' . $catName->cat_name . '(' . $relData->catid . ')</td>
        <td>' . $typeName->type_name . '(' . $relData->typeid . ')</td>
        <td>' . $relData->cost . '</td>
         <td>' . $relData->costtype . '</td>
          <td>Per ' . $relData->notes . '</td>
        <td><a href="' . str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] )
		     . '&action=del&cid=' . $relData->id . '">Delete</a>
        </td>
    </tr>';

	}

	// <a href="'. str_replace('%7E', '~', $_SERVER['REQUEST_URI']).'&action=edit&cid='.$fivesdraft->id.'">Edit</a>&nbsp&nbsp|&nbsp&nbsp


	?>
</table>