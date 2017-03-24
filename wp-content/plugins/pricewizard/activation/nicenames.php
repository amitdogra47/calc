<?php
/*
This table = pwnicenames
*/
function pw_db_nn() {
	global $wpdb;


	$table_name = $wpdb->prefix . 'pwnicenames';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		seqid int(11) NOT NULL AUTO_INCREMENT,
		tech_name text NOT NULL,
		nice_name text NOT NULL,
		PRIMARY KEY  (seqid)
	) $charset_collate;";

	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function pw_data_nn() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwnicenames';
	$pw_result = "";
    $pw_result = $wpdb->get_results("SELECT * from $table_name");
    if(count($pw_result) == 0)
    {
      $pw_insert = $wpdb->query("INSERT INTO $table_name (seqid, tech_name, nice_name) VALUES
			(1, 'spiral_card', 'Spiral bound with 300gsm laminated card'),
			(2, 'spiral_pvc', 'Spiral bound with durable PVC cover'),
			(3, 'book_vinyl', 'Book bound with leatherette cover'),
			(4, 'book_printed', 'Book bound with customised full colour, printed cover')
			"); //end of insert
    }
}

?>