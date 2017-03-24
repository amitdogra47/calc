<?php
/*
This table = pwdateentries
*/
function pw_db_de() {
	global $wpdb;


	$table_name = $wpdb->prefix . 'pwdateentries';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		seqid bigint(20) NOT NULL AUTO_INCREMENT,
		breakcode int(11) DEFAULT '0' NOT NULL,
		size text NOT NULL,
		date_price decimal(10,3) DEFAULT '0.000' NOT NULL,
		PRIMARY KEY  (seqid)
	) $charset_collate;";

	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

function pw_data_de() {
	global $wpdb;
	$pw_result = "";
	$table_name = $wpdb->prefix . 'pwdateentries';
    $pw_result = $wpdb->get_results("SELECT * from $table_name");
    if(count($pw_result) == 0)
    {
      $pw_insert = $wpdb->query("INSERT INTO $table_name (seqid, breakcode, size, date_price) VALUES
			(1, 1, 'A5', 26.680),
(2, 2, 'A5', 10.672),
(3, 3, 'A5', 5.336),
(4, 4, 'A5', 3.557),
(5, 5, 'A5', 2.668),
(6, 6, 'A5', 2.134),
(7, 7, 'A5', 1.779),
(8, 8, 'A5', 1.334),
(9, 9, 'A5', 1.067),
(10, 10, 'A5', 0.889),
(11, 11, 'A5', 0.763),
(12, 12, 'A5', 0.667),
(13, 13, 'A5', 0.593),
(14, 14, 'A5', 0.534),
(15, 15, 'A5', 0.427),
(16, 16, 'A5', 0.356),
(17, 17, 'A5', 0.267),
(18, 1, 'B5', 53.361),
(19, 2, 'B5', 21.344),
(20, 3, 'B5', 10.672),
(21, 4, 'B5', 7.114),
(22, 5, 'B5', 5.336),
(23, 6, 'B5', 4.269),
(24, 7, 'B5', 3.557),
(25, 8, 'B5', 2.668),
(26, 9, 'B5', 2.134),
(27, 10, 'B5', 1.779),
(28, 11, 'B5', 1.525),
(29, 12, 'B5', 1.334),
(30, 13, 'B5', 1.185),
(31, 14, 'B5', 1.067),
(32, 15, 'B5', 0.854),
(33, 16, 'B5', 0.711),
(34, 17, 'B5', 0.534),
(35, 1, 'A4', 53.361),
(36, 2, 'A4', 21.344),
(37, 3, 'A4', 10.672),
(38, 4, 'A4', 7.114),
(39, 5, 'A4', 5.336),
(40, 6, 'A4', 4.269),
(41, 7, 'A4', 3.557),
(42, 8, 'A4', 2.668),
(43, 9, 'A4', 2.134),
(44, 10, 'A4', 1.779),
(45, 11, 'A4', 1.525),
(46, 12, 'A4', 1.334),
(47, 13, 'A4', 1.185),
(48, 14, 'A4', 1.067),
(49, 15, 'A4', 0.854),
(50, 16, 'A4', 0.711),
(51, 17, 'A4', 0.534)
			"); //end of insert
    }
}

?>