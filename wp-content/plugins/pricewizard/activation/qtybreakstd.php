<?php
/*
This table = pwqtybreakstd
*/
function pw_db_qbs() {
	global $wpdb;


	$table_name = $wpdb->prefix . 'pwqtybreakstd';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		seqid bigint(20) NOT NULL AUTO_INCREMENT,
		breakcode int(11) DEFAULT '0' NOT NULL,
		breakqty int(11) DEFAULT '0' NOT NULL,
		PRIMARY KEY  (seqid)
	) $charset_collate;";

	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function pw_data_qbs() {
	global $wpdb;
	$pw_result = "";
	$table_name = $wpdb->prefix . 'pwqtybreakstd';
    $pw_result = $wpdb->get_results("SELECT * from $table_name");
    if(count($pw_result) == 0)
    {
      $pw_insert = $wpdb->query("INSERT INTO $table_name (seqid, breakcode, breakqty) VALUES
			(1, 1, 20),
			(2, 2, 50),
			(3, 3, 100),
			(4, 4, 150),
			(5, 5, 200),
			(6, 6, 250),
			(7, 7, 300),
			(8, 8, 400),
			(9, 9, 500),
			(10, 10, 600),
			(11, 11, 700),
			(12, 12, 800),
			(13, 13, 900),
			(14, 14, 1000),
			(15, 15, 1250),
			(16, 16, 1500),
			(17, 17, 2000)
			"); //end of insert
    }
}

?>