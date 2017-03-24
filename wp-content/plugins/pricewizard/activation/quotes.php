<?php
/*
This table = pwquotes
*/
function pw_db_quotes() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'pwquotes';
	
	$charset_collate = $wpdb->get_charset_collate();
	$charset_collate = $charset_collate." AUTO_INCREMENT=916";
	
	$sql = "CREATE TABLE $table_name (
		id bigint(20) NOT NULL AUTO_INCREMENT,
		submission_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		visitorip varchar(15) DEFAULT NULL,
		name varchar(50) NOT NULL,
		school varchar(50) NOT NULL,
		email varchar(50) NOT NULL,
		phone varchar(50) NOT NULL,
		message varchar(4000) DEFAULT NULL,
		mail_status varchar(10) NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

?>