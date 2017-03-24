<?php
/*
This table = pwqtybreakcustom
*/
function pw_db_qbc() {
	global $wpdb;


	$table_name = $wpdb->prefix . 'pwqtybreakcustom';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		breakcode int(11) DEFAULT '0' NOT NULL,
		breakqty int(11) DEFAULT '0' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function pw_data_qbc() {
	global $wpdb;
	$pw_result = "";
	$table_name = $wpdb->prefix . 'pwqtybreakcustom';
    $pw_result = $wpdb->get_results("SELECT * from $table_name");
    if(count($pw_result) == 0)
    {
      $pw_insert = $wpdb->query("INSERT INTO $table_name (id, breakcode, breakqty) VALUES
			(1, 1, 250),
			(2, 2, 500),
			(3, 3, 750),
			(4, 4, 1000),
			(5, 5, 1250),
			(6, 6, 1500)
			"); //end of insert
    }
}

?>