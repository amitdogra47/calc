<?php
/*
This table = pwoptionsaccessories
*/
function pw_db_oa() {
	global $wpdb;


	$table_name = $wpdb->prefix . 'pwoptionsaccessories';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		seqid bigint(20) NOT NULL AUTO_INCREMENT,
		binding_type text NOT NULL,
		accessory_name text NOT NULL,
		accessory_nicename text NOT NULL,
		size text NOT NULL,
		price decimal(10,3) DEFAULT '0.000' NOT NULL,
		PRIMARY KEY  (seqid)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function pw_data_oa() {
	global $wpdb;
	$pw_result = "";
	$table_name = $wpdb->prefix . 'pwoptionsaccessories';
    $pw_result = $wpdb->get_results("SELECT * from $table_name");
    if(count($pw_result) == 0)
    {
      $pw_insert = $wpdb->query("INSERT INTO $table_name (seqid, binding_type, accessory_name, accessory_nicename, size, price) VALUES
			(1, 'book', 'corner_gold', 'Metal Corners (Gold)', 'A5', 0.567),
			(2, 'book', 'corner_gold', 'Metal Corners (Gold)', 'B5', 0.567),
			(3, 'book', 'corner_silver', 'Metal Corners (Silver)', 'A5', 0.496),
			(4, 'book', 'corner_silver', 'Metal Corners (Silver)', 'B5', 0.496),
			(5, 'book', 'gild', 'Glided Edges (Silver or Gold)', 'A5', 0.620),
			(6, 'book', 'gild', 'Glided Edges (Silver or Gold)', 'B5', 0.744),
			(7, 'book', 'sleeve_p', 'Plastic Sleeve', 'A5', 0.613),
			(8, 'book', 'sleeve_p', 'Plastic Sleeve', 'B5', 0.987),
			(9, 'common', 'plastic_jacket', 'Plastic Jacket', 'A5', 2.500),
			(10, 'common', 'plastic_jacket', 'Plastic Jacket', 'B5', 3.950),
			(11, 'common', 'stickers', 'Stickers', 'A5', 0.210),
			(12, 'common', 'stickers', 'Stickers', 'B5', 0.210),
			(13, 'common', 'ref_pages', 'Reference Pages', 'A5', 0.449),
			(14, 'common', 'ref_pages', 'Reference Pages', 'B5', 0.820),
			(15, 'spiral', 'protectors', 'Cover Protectors', 'A5', 0.766),
			(16, 'spiral', 'protectors', 'Cover Protectors', 'B5', 0.855),
			(17, 'spiral', 'ruler', 'Ruler', 'A5', 0.389),
			(18, 'spiral', 'ruler', 'Ruler', 'B5', 0.602),
			(19, 'spiral', 'sleeve_e', 'Plastic Sleeve', 'A5', 0.527),
			(20, 'spiral', 'sleeve_e', 'Plastic Sleeve', 'B5', 0.948)
			"); //end of insert
    }
}

?>