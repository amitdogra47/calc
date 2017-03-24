<?php

echo '<div class="wrap">';
echo '<div id="icon-tools" class="icon32"></div>';
echo "<h2>test Sandpit</h2>";
global $wpdb;

require(PRICEWIZARD_DIR."/activation/settings.php");

echo "<p>Testing get options and update options</p>";
//echo "<h3>START-Testing deletions</h3>";
//			$update = get_option( 'pw-settings' );
//					$update["wizard_testdata"] = 1;
//				update_option( 'pw-settings', $update );
//$dresult = delete_option('pw-settings');
//echo "<p>dresult is  ".$dresult." </p>";
//echo "<h3>END-Testing deletions</h3>";

//echo "<h3>START-Testing deletions</h3>";

$notice_data="";
$notice_data =   get_option('pw-settings');  
$notice_data = maybe_unserialize($notice_data);
$notice_data_email = $notice_data['wizard_testdata'];
echo "the testdata value   is ".$notice_data_email."<br/>";

$optionname = 'wizard_email_countryvalidation';
//get option into variable
$forum_subscr = get_option('pw-settings');
$chkb_val ="";
//check if user is in subscription array
$fs_is = isset($forum_subscr[$optionname]);
//depending on that setup variable for input value 
if (!$fs_is){
$chkb_val = "fail";
}
else {
$chkb_val = "pass";
}
//$chkb_val = ( $fs_is === "NZ" ? 'false' : 'true' );
echo "echo the check result is ".$chkb_val." and the value is ".$fs_is."<br/>";
echo "<hr/>";
echo "this is the admin url for ajax <br/>";
echo admin_url('admin-ajax.php');
echo "<hr/>";
//var_dump($notice_data);
function delete_uber_option($option_name, $key) {
echo "<p>the option name = ".$option_name." and the key = ".$key." </p>";
	$options = get_option( $option_name );
foreach( $options as $key => $val ){
					echo "<strong>".$key."</strong> || ".$val."<br/>";
					}
	if ( $options ) {
	echo "<p>options exists</p>";
	echo "options key = ".$options['wizard_email_countryvalidation']."<br/>";
		unset($options[$key]);
		update_option( $option_name, $options );
	}
}
$duresult = delete_uber_option ("pw-settings","wizard_email_countryvalidation");
echo "<p>deresult is ".$duresult."</p>";
echo "<h3>END-Testing deletions</h3>";
echo "<hr/>";

echo "<h3>this is a test for wizard_testdata</h3>";
$pwdefaults = pw_default_options();
//print_r($pwdefaults);
echo "the default value of testdata setting is ". $pwdefaults['wizard_testdata'];

 #Set Defaults if new value does not exist
				$dbsettings = "";
				$dbsettings = get_option('pw-settings');
				$dbsettings = maybe_unserialize($dbsettings);
				echo "the database value of testdata setting is ".$dbsettings["wizard_testdata"];
//				echo "defrom key 1 = ";

//				echo "<hr/>";
				foreach( $pwdefaults as $key => $val ){
					echo "<strong>".$key."</strong> || ".$val;
					$defromkey = "'".$key."'";
					echo " ||- defrom key=".$defrom[defromkey];
					if( !$defrom[defromkey] )
					{
						$defrom[$key] = $val;
						$new = true;
						echo " = new<br/>";
					}
					{
					echo " = not new<br/>";
					}
				}
				if( $new )
				{
					update_option( 'pw-settings', $defrom );
					echo "updated existing defaults<br/>";
				}
if( !$new )
				{
					echo "no settings to update<br/>";
				}
				
echo "<hr/>";
echo "<h3>list db settings</h3>";
$pwdefaults = pw_default_options();



 #Set Defaults if new value does not exist
				$defrom = get_option( 'pw-settings' );
				$ctrykey = $defrom['wizard_email_countryvalidation'];
				echo "the DB country key is ". $ctrykey."<br/>";
				$result = delete_option($ctrykey);
				
				echo "<p> the result is ".$result."</p>";
				echo "the default country key is ". $pwdefaults['wizard_email_countryvalidation']."<br/>";
				
//				echo "<hr/>";
				foreach( $defrom as $key => $val ){
					echo "<strong>".$key."</strong> || ".$val."<br/>";
					//echo " ||- defrom key=".$defrom[$key];
					//if( !$defrom[$key] )
					//{
					//	$defrom[$key] = $val;
					//	$new = true;
					//	echo " = new<br/>";
					//}
					//{
					//echo " = not new<br/>";
					//}
				}
				//if( $new )
				//{
				//	update_option( 'pw-settings', $defrom );
				//	echo "updated existing defaults<br/>";
				//}
				//	if( !$new )
				//{
				//	echo "no settings to update<br/>";
				//}
				


echo '</div>';
?>