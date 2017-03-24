<?php
/*
This table = pwpricesstandard
*/
function pw_db_ps() {
	global $wpdb;


	$table_name = $wpdb->prefix . 'pwpricesstandard';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		seqid bigint(20) NOT NULL AUTO_INCREMENT,
		size text NOT NULL,
		type text NOT NULL,
		nice_name text NOT NULL,
		price decimal(10,3) DEFAULT '0.000' NOT NULL,
		PRIMARY KEY  (seqid)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function pw_data_ps() {
	global $wpdb;
	$pw_result = "";
	$table_name = $wpdb->prefix . 'pwpricesstandard';
    $pw_result = $wpdb->get_results("SELECT * from $table_name");
    if(count($pw_result) == 0)
    {
      $pw_insert = $wpdb->query("INSERT INTO $table_name (seqid, size, type, nice_name, price) VALUES
			(1, 'A5', 'spiral', 'Spiral', 3.555),
			(2, 'B5', 'spiral', 'Spiral', 4.856),
			(3, 'A5', 'book', 'Book', 5.631),
			(4, 'B5', 'book', 'Book', 7.890)
			"); //end of insert
    }
}

?>