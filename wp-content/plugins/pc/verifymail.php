<?php
$dirname = dirname( __FILE__ );
$root    = false !== mb_strpos( $dirname, 'wp-content' ) ? mb_substr(
	$dirname, 0, mb_strpos( $dirname, 'wp-content' )
) : $dirname;
require_once( $root . "wp-config.php" );
global $wpdb;
$table_name = pc_verifyemail;
if(!empty( $_REQUEST['data'])){
	$data = explode('*', $_REQUEST['data']);
	$toemail = $data[0];
	$tootp = $data[1];
	if(!empty( $toemail) && ! empty( $tootp)) {
		//echo "SELECT * FROM " . $table_name . " where email LIKE '%" . $toemail . "%' AND otp LIKE '%" . $tootp . "%' ";
		$myrows = $wpdb->get_results( "SELECT * FROM " . $table_name . " where email LIKE '%" . $toemail . "%' AND otp LIKE '%" . $tootp . "%' " );
		if ( empty( $myrows ) ) {
			$msg =  'Invalid OTP';
		} else {
			$msg = 'Email Verified';
		}
	}else{
		$msg =  'Please Enter OTP';
	}

}

echo $msg;
?>
