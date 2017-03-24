<?php
/*
This table = pwstampingcustom
*/
function pw_db_sc() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'pwstampingcustom';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		seqid bigint(20) NOT NULL AUTO_INCREMENT,
		breakcode int(11) DEFAULT '0' NOT NULL,
		price decimal(10,3) DEFAULT '0.000' NOT NULL,
		PRIMARY KEY  (seqid)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function pw_data_sc() {
	global $wpdb;
	$pw_result = "";
	$table_name = $wpdb->prefix . 'pwstampingcustom';
    $pw_result = $wpdb->get_results("SELECT * from $table_name");
    if(count($pw_result) == 0)
    {
      $pw_insert = $wpdb->query("INSERT INTO $table_name (seqid, breakcode, price) VALUES
			(1, 20, 5.801),
			(2, 50, 2.321),
			(3, 100, 1.160),
			(4, 150, 0.773),
			(5, 200, 0.580),
			(6, 250, 0.464),
			(7, 300, 0.387),
			(8, 400, 0.387),
			(9, 500, 0.387),
			(10, 600, 0.387),
			(11, 700, 0.387),
			(12, 800, 0.387),
			(13, 900, 0.387),
			(14, 1000, 0.387),
			(15, 1250, 0.348),
			(16, 1500, 0.348),
			(17, 2000, 0.348)
			"); //end of insert
    }
}

?>