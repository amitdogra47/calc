<?php
$dirname = dirname( __FILE__ );
$root    = false !== mb_strpos( $dirname, 'wp-content' ) ? mb_substr(
	$dirname, 0, mb_strpos( $dirname, 'wp-content' )
) : $dirname;

require_once( $root . "wp-config.php" );
global $wpdb;

$pc_cat_type = 'pc_cat_type';
$pc_cat      = 'pc_cat';
$pcRel       = 'pc_rel';
?>

<h3 class="form-heading"><span>6</span> Your Details</h3>

<p>
	<lable>Your Name</lable>
	<input type="text" id="yname" name="yname" value=""/>
</p>

<p>
	<lable>School Email</lable>
	<input type="text" id="schoolName" name="schoolName" value=""  onblur="sendemail(this.value)"/>
	<span id="response"></span>
</p>

<p>
	<lable>OTP</lable>
	<input type="text" id="otp" name="otp" value="" onblur="verifyemail(this.value)"/>
	<span id="response2"></span>
</p>

<p>
	<lable>Contact number (optional)</lable>
	<input type="text" id="cnumber" name="cnumber" value=""/>
</p>