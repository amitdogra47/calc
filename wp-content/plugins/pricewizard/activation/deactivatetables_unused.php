<?php
/*
This file has a series of functions, each to delete tables on decativation
The tables are
cp = pwcustompages
de = pwdateentries
nn = pwnicenames
oa = pwoptionsaccessories
oc = pwoptionscovers
pc = pwpricescustom
ps = pwpricesstandard
qbc = pwqtybreakcustom
qbs = pwqtybreakstd
pwquotes = pwquotes
sc = pwstampingcustom

*/
function pw_deactivate_cp() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwcustompages';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_de() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwdateentries';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_nn() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwnicenames';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_oa() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwoptionsaccessories';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_oc() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwoptionscovers';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_pc() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwpricescustom';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_ps() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwpricesstandard';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_qbc() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwqtybreakcustom';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_qbs() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwqtybreakstd';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

function pw_deactivate_pwquotes() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwquotes';
	$pw_result = "";
	
	
  $pw_result = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");
  if (!is_null($pw_result)){
		$wpdb->query("DROP TABLE IF EXISTS $table_name");
	}
	
}

function pw_deactivate_sc() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'pwstampingcustom';
	$pw_result = "";
  $pw_result = $wpdb->get_results("SELECT * from $table_name");
  if(count($pw_result) <> 0)
    {$wpdb->query("DROP TABLE IF EXISTS $table_name");
		}
}

?>