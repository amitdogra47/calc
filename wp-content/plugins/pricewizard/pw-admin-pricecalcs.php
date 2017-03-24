<?php

// CALCULATE COST OF ONE STAMPING FOR STD-> BOOK-> VINYL
function calc_bookstamping($q){
	global $wpdb;
	$result=array();
	$mystampingprice=0;
	$orderstep = pricebreakstd($q);
	$sql = $wpdb->prepare( "SELECT price FROM wp_pwstampingcustom WHERE breakcode = %d ORDER BY price ASC ",$q );
		//DEBUG
		//echo "sql is $sql";
	$result = $wpdb->get_results($sql,ARRAY_N);
	
		//DEBUG
		//print_r($result);	
	$mystampingprice = $result[0][0];
	return $mystampingprice;
}

// CALCULATE FRONT COVER PRICE
function calc_coveroptions($o,$s,$bt,$q){
	global $wpdb;
	$result=array();
	$optionname = $o;
	$myoptionprice="";
	$orderstep = pricebreakstd($q);
		//DEBUG
		//echo "sql is $sql";
	$sql = $wpdb->prepare( "SELECT price FROM wp_pwoptionscovers WHERE cover_type = %s AND cover_option = %s AND size = %s AND breakcode = %d ORDER BY price ASC ",array($bt, $optionname,$s,$orderstep));
	$result = $wpdb->get_results($sql,ARRAY_N);
		//DEBUG
		//print_r($result);	
	$myoptionprice = $result[0][0];
	return $myoptionprice;
}

// CALCULATE DIARY PRICE FOR STYLE = STANDARD
function calc_base_price_std($covertype,$size){
	global $wpdb;
	$sql = "";
	$mybaseprice = "";
	$sql = $wpdb->prepare( "SELECT price FROM wp_pwpricesstandard WHERE type LIKE %s AND size LIKE %s",array($covertype,$size));
	$result = $wpdb->get_results($sql,ARRAY_N);	
	$mybaseprice = $result[0][0];
	return $mybaseprice;
}

// PRICEBREAK CALCULATOR
function pricebreakstd($q){
	global $wpdb;
	// get minimum and maximum order quantities
	$sql = "";
	$sql = $wpdb->prepare("(SELECT breakqty FROM wp_pwqtybreakstd WHERE breakqty >= %d ORDER BY breakqty ASC LIMIT 1) union (SELECT breakqty FROM wp_pwqtybreakstd WHERE breakqty <= %d ORDER BY breakqty DESC LIMIT 1) ORDER BY breakqty ASC LIMIT 1",array($q,$q));

//DEBUG
//echo" the pricebreakstd sql is $sql \r\n";

	$maxbreak = $wpdb->get_results($sql,ARRAY_N);
//DEBUG
//print_r($maxbreak);

	$maxcode = $maxbreak[0][0];
	return $maxcode;

}

// DETERMINE THE PRICEBREAK FOR A CUSTOM DIARY
function pricebreakcustom($q){
	global $wpdb;
	$sql = "";
	$sql = $wpdb->prepare("(SELECT breakqty FROM wp_pwqtybreakcustom WHERE breakqty >= %d ORDER BY breakqty ASC LIMIT 1) union (SELECT breakqty FROM wp_pwqtybreakcustom WHERE breakqty <= %d ORDER BY breakqty DESC LIMIT 1) ORDER BY breakqty ASC LIMIT 1",array($q,$q));
	//DEBUG
	//echo" the pricebreakstd sql is $sql \r\n";
	$maxbreak = $wpdb->get_results($sql,ARRAY_N);
	//DEBUG
	//print_r($maxbreak);
	$maxcode = $maxbreak[0][0];
	return $maxcode;

}

// CALCULATE THE PRICE OF DATE ENTRIES
function calc_date_price($s,$q){
	global $wpdb;
	// get prices for date pages
	$sql = "";$mydateprice = "";
	$orderstep = pricebreak($q);
	$sql = $wpdb->prepare( "SELECT date_price FROM wp_pwdateentries WHERE breakcode = %d AND size = %s ",array($orderstep,$s) );
	$result = $wpdb->get_results($sql,ARRAY_N);
		//DEBUG
		//print_r ($result);
	$mydateprice = $result[0][0];
	return $mydateprice;
}

// CALCULATE PRICE BREAK FOR STANDARD DIARIES
function pricebreak($q){
global $wpdb;
// get minimum and maximum order quantities
$sql = "";
$sql = "SELECT MAX(breakcode) FROM wp_pwqtybreakstd";
$maxbreak = $wpdb->get_results($sql,ARRAY_N);
$maxcode = $maxbreak[0][0];
//echo "The biggest break is ". $maxcode;
$sql = "SELECT MIN(breakcode)  FROM wp_pwqtybreakstd";
$minbreak = $wpdb->get_results($sql,ARRAY_N);
$mincode = $minbreak[0][0];
//echo "The smallest break is ". $mincode. "<br/>";
$sql = "SELECT *  FROM wp_pwqtybreakstd ORDER BY breakcode ASC ";
$result = $wpdb->get_results($sql,ARRAY_N);
$resultcount = count($result);
//echo "breakcode count is $resultcount";
//print_r ($result);
for ($row = 0; $row < $resultcount; $row++)
{$currentbreakcode = $result[$row][1];$currentqty = $result[$row][2];if ($currentbreakcode == $mincode){$minqty = $currentqty;}if ($currentbreakcode == $maxcode){$maxqty = $currentqty;}}

 // get quantity price breaks and eject if order quantity is less than minimum and more than maximum
$query = "SELECT *  FROM wp_pwqtybreakstd ORDER BY breakqty ASC ";
$result = $wpdb->get_results($sql,ARRAY_N);
$resultcount = count($result);
for ($row = 0; $row < $resultcount; $row++)
{
	$currentbreakcode = $result[$row][1];$currentqty = $result[$row][2];
	if ($currentqty == $minqty)
	{	if ($q < $currentqty)
		{
			$orderstep = $currentbreakcode;
			//echo "Order quantity is less than minimum, so pricebreak is for minimum quantity<br/>";
		}
		if ($q == $minqty)
		{
			$orderstep = $currentbreakcode;
			//echo "Order quantity is equal to minimum, so pricebreak is for minimum quantity<br/>";
		}
	//echo "order step is $orderstep<br/>";
	}
	if ($currentqty == $maxqty)
	{
		if ($q > $currentqty)
		{
			$orderstep = $currentbreakcode;
			//echo "Order quantity is greater than maximum, so pricebreak is for maximum quantity<br/>";
		}
		if ($q == $currentqty)
		{
			$orderstep = $currentbreakcode;
			//echo "pricebreak is for maximum quantity<br/>";
		}
	//echo "order step is $orderstep<br/>";
	}
	if ($q >= $currentqty)
	{
			$orderstep = $currentbreakcode;
			//echo "order step is $orderstep<br/>";
	}
}
//echo "For an order quantity of ". $q . " the qty breakcode is ". $orderstep ."<br/>";
return $orderstep;
}

//calculate accessory price $b=diarybinding,$a=accessname,$s=diarysize
function calc_accessory_price($b,$a,$s){// cover protectors
global $wpdb;
$result=array();
$myaccessoryprice=0;
//	$accesssql = 'SELECT offered FROM iq_accessories WHERE type = "'.$t.'"  and name = "'.$accessname.'"'; 
//	$accessoffered = $wpdb->get_results($accesssql,ARRAY_N);
//	$myoffered = $accessoffered[0][0];
//	if ($myoffered == 1){// accessory is available
		$sql = 'SELECT price  FROM wp_pwoptionsaccessories WHERE binding_type = "'.$b.'" AND accessory_name = "'.$a.'" AND size = "'.$s.'"';
//		$sql = $wpdb->prepare( "SELECT price FROM wp_pwoptionsaccessories WHERE binding_type = %s AND accessory_name = %d AND size = %s.",array($b,$a,$s) );
			//DEBUG
			//echo "the sql is $sql";
		$result = $wpdb->get_results($sql,ARRAY_N);
			//DEBUG
			//print_r($result);
		//$mypcornersprice = $result[0][0] * $q;
		$myaccessoryprice = $result[0][0];
//	}
//	else {$myprotectorprice = 0;}
	return $myaccessoryprice;
}

//find accessory nice name
function calc_accessory_name($b,$a,$s){// cover protectors
global $wpdb;
$result=array();
$myaccessoryname="";
//	$accesssql = 'SELECT offered FROM iq_accessories WHERE type = "'.$t.'"  and name = "'.$accessname.'"'; 
//	$accessoffered = $wpdb->get_results($accesssql,ARRAY_N);
//	$myoffered = $accessoffered[0][0];
//	if ($myoffered == 1){// accessory is available
		$sql = 'SELECT accessory_nicename  FROM wp_pwoptionsaccessories WHERE binding_type = "'.$b.'" AND accessory_name = "'.$a.'" AND size = "'.$s.'"';
			//DEBUG
			//echo "the sql is $sql";
		$result = $wpdb->get_results($sql,ARRAY_N);
			//DEBUG
			//print_r($result);
		//$mypcornersprice = $result[0][0] * $q;
		$myaccessoryname = $result[0][0];
//	}
//	else {$myprotectorprice = 0;}
	return $myaccessoryname;
}

// CALCULATE COST OF CUSTOM PAGES FOR STANDARD DIARY
function calc_custom_pages_std($p,$s,$q){
	if ($p>0){
		global $wpdb;
		$result=array();
	//		$sql = "SELECT price  FROM wp_pwoptionscovers WHERE cover_type  = '$bt' AND cover_option = '$optionname' AND size = '$s' AND breakcode = $orderstep ORDER BY size ASC ";
		$orderstep = pricebreakstd($q);
		$sql = "SELECT price FROM wp_pwcustompages WHERE customqty = $p AND size = '$s' AND breakcode = $orderstep";
			//DEBUG
			//echo "sql is $sql";
		$result = $wpdb->get_results($sql,ARRAY_N);
			//DEBUG
			//print_r($result);
		$mycustomprice = $result[0][0];
	}else{
		// no custom pages chosen
		$mycustomprice = 0;
	}
	return $mycustomprice;
}

// CALCULATE COST OF CUSTOM PAGES FOR CUSTOM DIARY
function calc_custom_pages_custom($t,$s,$q,$p,$c){
//$diarycovertype,$diarysize,$diaryqty,$diarypagescustom,$colours	

		global $wpdb;
		$result=array();
	//		$sql = "SELECT price  FROM wp_pwoptionscovers WHERE cover_type  = '$bt' AND cover_option = '$optionname' AND size = '$s' AND breakcode = $orderstep ORDER BY size ASC ";
		$orderstep = pricebreakcustom($q);
		$sql = "SELECT price FROM wp_pwpricescustom WHERE cover_type = '$t' AND colour = '$c' AND customqty = $p AND size = '$s' AND breakcode = $orderstep";
			//DEBUG
			//echo "sql is $sql";
		$result = $wpdb->get_results($sql,ARRAY_N);
			//DEBUG
			//print_r($result);
		$mycustomprice = $result[0][0];
	return $mycustomprice;
}

// GET NICE COVER NAME FOR QUOTE SUMMARY
function getnicecovername($c){
	global $wpdb;
	$result=array();
	//$result = $wpdb->get_results($wpdb->prepare( "SELECT nice_name  FROM wp_pwnicenames WHERE tech_name = %s" , $c ),ARRAY_N);
	$sql = "SELECT nice_name  FROM wp_pwnicenames WHERE tech_name = '$c'";
			//DEBUG
			//echo "sql is $sql";
	$result = $wpdb->get_results($sql,ARRAY_N);
			//DEBUG
			//print_r($result);
	$mynicecovername = $result[0][0];
	return $mynicecovername;
}
?>