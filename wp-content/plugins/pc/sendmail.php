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

	if($data[0] > 499){
		$betterquote = '<p style="text-align:left; padding:4px 0; font-size:16px; color:#F7941E">Please contact us in regards to this price enquiry as quantity of 500 or more often have more cost effective options available.</p>';
	}
	//print_r( $data);
	if ( $data[ 4 ] == 'Hard Cover' ) {
		$message
			= '<p style="text-align: left;">'.$myrows->email_content.
			  '<br>'. $myrows->optional_content .
			  '<br>' . $myrows->content_footer .'</p>'.$betterquote.'

			<table border="1" cellpadding="1" cellspacing="1" width="70%">
		        <tr>
		            <th colspan=2 style="text-align:center; background-color:#ffe1c0; padding:4px 0; font-size:14px;">Printing details</th>
		        </tr>
		        <tr>
		            <td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Quantity of Books</td>
		            <td width="70%" style="text-align: left;  font-size: 14px;">' . $data[ 0 ] . '</td>
		        </tr>
			    <tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Quantity of Pages</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 1 ] . '</td>
			    </tr>
			    <tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Print Quality</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 2 ] . '</td>
			    </tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">FSC Paper Stock</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 3 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Cover Type</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 4 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Binding</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 5 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Cover Material</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 6 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">How is artwork to to be prepared</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 7 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Add Funraiser Amount per Book</td>
					<td  style="text-align: left;  font-size: 14px;">$' . $data[ 8 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Ribbon</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 9 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Head Bands</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 10 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">send me details about Fancy Options</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 17 ] . '</td>
				</tr>

		    </table>
		    <table border="1" cellpadding="1" cellspacing="1" width="70%">

				<tr>
					 <th colspan=2 style="text-align:center; background-color:#ffe1c0; padding:4px 0; font-size:14px;">Customer details</th>
				</tr>
				<tr>
					 <td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Your Name</td>
					<td width="70%" style="text-align: left;">' . $data[ 11 ] . '</td>
				</tr>
				<tr>
					 <td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">School Name</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 18 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">School Email</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 12 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Contact number </td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 13 ] . '</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Total Price per Book</td>
					<td  style="text-align: left;  font-size: 14px;">$' . $data[ 15 ] . ' excl GST</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Total Price</td>
					<td  style="text-align: left;  font-size: 14px;">$' . $data[ 16 ] . ' excl GST</td>
				</tr>
				<tr>
					<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Email me the quote</td>
					<td  style="text-align: left;  font-size: 14px;">' . $data[ 14 ] . '</td>
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
			  '<br>' . $myrows->content_footer . '</p>' . $betterquote . '
		<table border="1" cellpadding="1" cellspacing="1" width="70%">
			 <tr>
	            <th colspan=2 style="text-align:center; background-color:#ffe1c0; padding:4px 0; font-size:14px;">Printing details</td>
	        </tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Quantity of Books</td>
				<td width="70%" style="text-align: left;  font-size: 14px;">' . $data[ 0 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Quantity of Pages</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 1 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Print Quality</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 2 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">FSC Paper Stock</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 3 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Cover Type</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 4 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Binding</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 5 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Cover Lamination</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 6 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">How is artwork to to be prepared</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 7 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Add Funraiser Amount per Book</td>
				<td  style="text-align: left;  font-size: 14px;">$' . $data[ 8 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">send me details about Fancy Options</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 9 ] . '</td>
			</tr>
		</table>
		 <table border="1" cellpadding="1" cellspacing="1" width="70%">

			<tr>
				<th colspan=2 style="text-align:center; background-color:#ffe1c0; padding:4px 0; font-size:14px;">Customer details</th>
			</tr>

			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Your Name</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 10 ] . '</td>
			</tr>
			<tr>
				 <td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">School Name</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 16 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">School Email</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 11 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Contact number </td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 12 ] . '</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Total Price per Book</td>
				<td  style="text-align: left;  font-size: 14px;">$' . $data[ 14 ] . ' excl GST</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Total Price</td>
				<td  style="text-align: left;  font-size: 14px;">$' . $data[ 15 ] . ' excl GST</td>
			</tr>
			<tr>
				<td width="30%" style="text-align: left; font-size: 14px; background-color:#f5f5f5; font-weight:600;">Email me the quote</td>
				<td  style="text-align: left;  font-size: 14px;">' . $data[ 13 ] . '</td>
			</tr>
		</table>
 <p style="text-align: left;">
  ' . $myrows->contact_address . '
  </p>
';
	}
	
	
/*echo $message;
	die();*/
	
	
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
		echo '<p>
				<span  style="font-weight: bold">Thank you for using our price calculator</span>
			</p>';
		if ($data[0] > 499 ) {
			echo '<p>
					<span  style="font-weight: bold">Your enquiry is for more than 500 yearbooks for which there are usually more
							cost effective options than those generated by our online calculator.
							Accordingly we will be in touch to discuss your needs and time schedules with the aim of providing a more
							competitive quote.
					</span>
				</p>';

		}


	}

	//echo '<pre>';
	//print_r ( $data );
}






?>

