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
$plugins_url = plugins_url();


//print_r($_REQUEST);
echo '<pre>';

$field = explode("*", $_REQUEST['fld']);

print_r($field);
echo '</pre>';

if(strtolower($field[1]) == 'soft cover'){
	$binding   = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 25" );
	$coverbind = '';
	foreach ( $binding as $bind ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $bind->typeid" );
		echo $typeName->id.'-----';
		if( $typeName->id != '25'){
			//$coverbind .= '<option value="' . $bind->cost . '">' . $typeName->type_name . '</option>';

			if ( $typeName->id == '23' ) {
				$coverbind .= '<option data-img-label="'. $typeName->type_name.'" data-img-src="' . $plugins_url . '/pc/img/bokpic.png" value="' . $bind->cost . '*' . $typeName->type_name . '">' . $typeName->type_name . '</option>';
			}
			if ( $typeName->id == '24' ) {
				$coverbind .= '<option data-img-label="' . $typeName->type_name . '" data-img-src="' . $plugins_url . '/pc/img/bokpic.png" value="' . $bind->cost . '*' . $typeName->type_name . '">' . $typeName->type_name . '</option>';
			}


		}

	}

	$hardcover     = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 22" );
	$hardcoverbind = '';
	foreach ( $hardcover as $hardc ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $hardc->typeid" );
		if ( $typeName->id == '9' ) {
			//$hardcoverbind .= '<option value="' . $hardc->cost . '">' . $typeName->type_name . '</option>';
			$hardcoverbind .= $hardc->cost;
		}
	}
	$coverlam    = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 23" );
	$coverlamopt = '';
	foreach ( $coverlam as $coverla ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $coverla->typeid" );
		echo $coverla->typeid.' ###';
		$coverlamopt .= '<option value="'. $coverla->cost . '">' . $typeName->type_name . '</option>';
	}
?>

	<p>
		<lable>Binding</lable>
		<br/>

		<select id="binding" name="binding" class="image-picker show-labels show-html"
		        onchange="showfields(this.value)">
			<?php echo $coverbind; ?>
		</select>

		<!--<select id="binding" name="binding" style="width:100%"
		        onchange="">
			<option value="0">Please Select</option>
			<?php /*echo $coverbind; */?>
		</select>-->
	</p>
	<p style="display:none">
		<input type="text" id="hardmat" name="hardmat" value="<?php echo $hardcoverbind; ?>">


		<!--<select id="hardmat" name="hardmat" style="width:100%">
			<option value="0">Please Select</option>
			<?php /*echo $hardcoverbind; */?>
		</select>-->
	</p>
	<p>
		<lable>Cover Lamination</lable>
		<br/>

		<select id="coverlam" name="coverlam" class="image-picker show-labels show-html"
		        onchange="showfields(this.value)">
			<?php echo $coverlamopt; ?>
		</select>

		<!--<select id="coverlam" name="coverlam"
		        style="width:100%">
			<option value="0">Please Select</option>
			<?php /*echo $coverlamopt; */?>
		</select>-->
	</p>

<?php



}


if ( strtolower( $field[1] ) == 'hard cover' ) {

	$binding   = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 25" );
	$coverbind = '';
	foreach ( $binding as $bind ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $bind->typeid" );
		if ( $typeName->id != '23' ) {
			$coverbind .= '<option value="' . $bind->cost . '">' . $typeName->type_name . '</option>';
		}

	}

	$hardcover     = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 22" );
	$hardcoverbind = '';
	foreach ( $hardcover as $hardc ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $hardc->typeid" );
		if ( $typeName->id != '9' ) {
			$hardcoverbind .= '<option value="'. $hardc->cost . '">' . $typeName->type_name . '</option>';
		}
	}

	$coverlam    = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 23" );
	$coverlamopt = '';
	foreach ( $coverlam as $coverla ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $coverla->typeid" );
		if ( $typeName->id != '18' ) {
			$coverlamopt .= '<option value="'. $coverla->cost . '">' . $typeName->type_name . '</option>';
		}
	}
	?>

	<p>
		<lable>Binding</lable>
		<br/>
		<select id="binding" name="binding" style="width:100%"
		        onchange="">
			<option value="0">Please Select</option>
			<?php echo $coverbind; ?>
		</select>
	</p>

	<p>
		<lable>Hard Cover Material</lable>
		<br/>
		<select id="hardmat" name="hardmat" style="width:100%">
			<option value="0">Please Select</option>
			<?php echo $hardcoverbind; ?>
		</select>
	</p>

	<p>
		<lable>Cover Lamination</lable>
		<br/>
		<select id="coverlam" name="coverlam"
		        style="width:100%">
			<option value="0">Please Select</option>
			<?php echo $coverlamopt; ?>
		</select>
	</p>

<?php


}


if ( strtolower( $field[1] ) == '' ) {
	$binding   = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 25" );
	$coverbind = '';
	foreach ( $binding as $bind ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $bind->typeid" );
		$coverbind .= '<option value="' . $bind->cost . '">' . $typeName->type_name . '</option>';
	}


	$hardcover     = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 22" );
	$hardcoverbind = '';
	foreach ( $hardcover as $hardc ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $hardc->typeid" );
		$hardcoverbind .= '<option value="' . $hardc->cost . '">' . $typeName->type_name . '</option>';
	}


	$coverlam    = $wpdb->get_results( "SELECT * FROM $pcRel where catid = 23" );
	$coverlamopt = '';
	foreach ( $coverlam as $coverla ) {
		$typeName = $wpdb->get_row( "SELECT id, type_name FROM $pc_cat_type WHERE id = $coverla->typeid" );
		$coverlamopt .= '<option value="' . $coverla->cost . '">' . $typeName->type_name . '</option>';
	}

	?>

	<p>
		<lable>Binding</lable>
		<br/>
		<select id="binding" name="binding" style="width:100%"
		        onchange="">
			<option value="0">Please Select</option>
			<?php echo $coverbind; ?>
		</select>
	</p>
	<p>
		<lable>Soft Cover Material</lable>
		<br/>
		<select id="hardmat" name="hardmat" style="width:100%">
			<option value="0">Please Select</option>
			<?php echo $hardcoverbind; ?>
		</select>
	</p>
	<p>
		<lable>Cover Lamination</lable>
		<br/>
		<select id="coverlam" name="coverlam"
		        style="width:100%">
			<option value="0">Please Select</option>
			<?php echo $coverlamopt; ?>
		</select>
	</p>

<?php


}
?>


