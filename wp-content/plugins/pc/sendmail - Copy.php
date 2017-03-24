<?php
ini_set ( 'display_errors' , 1 );
$dirname = dirname ( __FILE__ );
$root    = false !== mb_strpos ( $dirname , 'wp-content' ) ? mb_substr (
	$dirname , 0 , mb_strpos ( $dirname , 'wp-content' )
) : $dirname;
require_once ( $root . "wp-config.php" );
require './mailfun/PHPMailerAutoload.php';
global $wpdb;
$pc_email = 'pc_email_setting';
$pc_verifyemail = 'pc_verifyemail'; // table to store all submited data as backup.

$myrows = $wpdb->get_row ( "SELECT * FROM " . $pc_email . " where id = 1 " );
if ( ! empty( $_REQUEST[ 'data' ] ) ) {

	$wpdb->insert (
		$pc_verifyemail , array (
			'data' => $_REQUEST[ 'data' ]
		)
	);
	$lastid = $wpdb->insert_id;
	$data = explode ( '*' , $_REQUEST[ 'data' ] );
	if ( $data[ 4 ] == 'Hard Cover' ) {
		$message
			= '<p style="text-align: left;">'.$myrows->email_content.
			  '<br>'. $myrows->optional_content .
			  '<br>' . $myrows->content_footer .'</p>
			<table border="1" cellpadding="3" cellspacing="3" width="70%">
		        <tr>
		            <td colspan=2>Printing details</td>
		        </tr>
		        <tr>
		            <td width="50%" style="text-align: left;">Quantity of Books</td>
		            <td width="50%" style="text-align: left;">' . $data[ 0 ] . '</td>
		        </tr>
			    <tr>
					<td width="50%" style="text-align: left;">Quantity of Pages</td>
					<td width="50%" style="text-align: left;">' . $data[ 1 ] . '</td>
			    </tr>
			    <tr>
					<td width="50%" style="text-align: left;">Print Quality</td>
					<td width="50%" style="text-align: left;">' . $data[ 2 ] . '</td>
			    </tr>
				<tr>
					<td width="50%" style="text-align: left;">FSC Paper Stock</td>
					<td width="50%" style="text-align: left;">' . $data[ 3 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Cover Type</td>
					<td width="50%" style="text-align: left;">' . $data[ 4 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Binding</td>
					<td width="50%" style="text-align: left;">' . $data[ 5 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Cover Material</td>
					<td width="50%" style="text-align: left;">' . $data[ 6 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">How is artwork to to be prepared</td>
					<td width="50%" style="text-align: left;">' . $data[ 7 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Add Funraiser Amount per Book</td>
					<td width="50%" style="text-align: left;">$' . $data[ 8 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Ribbon</td>
					<td width="50%" style="text-align: left;">' . $data[ 9 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Head Bands</td>
					<td width="50%" style="text-align: left;">' . $data[ 10 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">send me details about Fancy Options</td>
					<td width="50%" style="text-align: left;">' . $data[ 17 ] . '</td>
				</tr>

		    </table>
		    <table border="1" cellpadding="3" cellspacing="3" width="70%">

				<tr>
					<td colspan=2>Customer details</td>
				</tr>
				<tr>
					<td  width="50%" style="text-align: left;">Your Name</td>
					<td width="50%" style="text-align: left;">' . $data[ 11 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">School Email</td>
					<td width="50%" style="text-align: left;">' . $data[ 12 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Contact number </td>
					<td width="50%" style="text-align: left;">' . $data[ 13 ] . '</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Total Price per Book</td>
					<td width="50%" style="text-align: left;">$' . $data[ 15 ] . ' excl GST</td>
				</tr>
				<tr>
					<td width="50%" style="text-align: left;">Total Price</td>
					<td width="50%" style="text-align: left;">$' . $data[ 16 ] . ' excl GST</td>
				</tr>

		  </table>
		  <p style="text-align: left;">
		  '. $myrows->contact_address.'
		  </p>
		';
	}
	if ( $data[ 4 ] == 'Soft Cover' ) {
		$message
			= '<p style="text-align: left;">' . $myrows->email_content .
			  '<br>' . $myrows->optional_content .
			  '<br>' . $myrows->content_footer . '</p>
		<table border="1" cellpadding="3" cellspacing="3" width="70%">
			 <tr>
	            <td colspan=2>Printing details</td>
	        </tr>
			<tr>
				<td>Quantity of Books</td>
				<td width="50%" style="text-align: left;">' . $data[ 0 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">Quantity of Pages</td>
				<td width="50%" style="text-align: left;">' . $data[ 1 ] . '</td>
			</tr>
			<tr>
				<td>Print Quality</td>
				<td width="50%" style="text-align: left;">' . $data[ 2 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">FSC Paper Stock</td>
				<td width="50%" style="text-align: left;">' . $data[ 3 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">Cover Type</td>
				<td width="50%" style="text-align: left;">' . $data[ 4 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">Binding</td>
				<td width="50%" style="text-align: left;">' . $data[ 5 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">Cover Lamination</td>
				<td width="50%" style="text-align: left;">' . $data[ 6 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">How is artwork to to be prepared</td>
				<td width="50%" style="text-align: left;">' . $data[ 7 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">Add Funraiser Amount per Book</td>
				<td width="50%" style="text-align: left;">$' . $data[ 8 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">send me details about Fancy Options</td>
				<td width="50%" style="text-align: left;">' . $data[ 9 ] . '</td>
			</tr>
		</table>
		 <table border="1" cellpadding="3" cellspacing="3" width="70%">

			<tr>
				<td colspan=2>Customer details</td>
			</tr>

			<tr>
				<td width="50%" style="text-align: left;">Your Name</td>
				<td width="50%" style="text-align: left;">' . $data[ 10 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">School Email</td>
				<td width="50%" style="text-align: left;">' . $data[ 11 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">Contact number </td>
				<td width="50%" style="text-align: left;">' . $data[ 12 ] . '</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">Total Price per Book</td>
				<td width="50%" style="text-align: left;">$' . $data[ 14 ] . ' excl GST</td>
			</tr>
			<tr>
				<td width="50%" style="text-align: left;">Total Price</td>
				<td width="50%" style="text-align: left;">$' . $data[ 15 ] . ' excl GST</td>
			</tr>
		</table>
 <p style="text-align: left;">
  ' . $myrows->contact_address . '
  </p>
';
	}
	
	
echo $message;
	die();
	
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	
	//$mail->SMTPDebug = 3;   
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'hk100.arvixeshared.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'info@studentyearbooks.com.au';                 // SMTP username
	$mail->Password = 'Toyota@59B';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;    
	$mail->isHTML(true);

	
	//Set who the message is to be sent from
	$mail->setFrom('info@studentyearbooks.com.au', $myrows->from_name);
	//Set an alternative reply-to address
	$mail->addReplyTo($myrows->from_email, $myrows->from_name);
	//Set who the message is to be sent to
	$mail->addAddress($myrows->from_email, $myrows->from_name);
	
	if ( $data[ 14 ] == 'Yes' && $data[ 4 ] == 'Hard Cover' ) {
		//echo '------Hard cover send------'.$data[ 12 ];
		$mail->addBCC( $data[ 12 ]);
	}
	if ( $data[ 13 ] == 'Yes' && $data[ 4 ] == 'Soft Cover' ) {
		//echo '------soft cover send------'.$data[ 11 ];
		$mail->addBCC( $data[ 11 ]);
	}
	

	
	//Set the subject line
	$mail->Subject = $myrows->email_subject.$lastid;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($message);
	

	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Thank you for using our price calculator";
	}

	//echo '<pre>';
	//print_r ( $data );
}






?>

