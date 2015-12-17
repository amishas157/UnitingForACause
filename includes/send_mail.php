<?php
include 'Mail.php';

	
function Send_Mail($to,$subject,$body)
{
	$from ="unitingforacause@gmail.com";

	$headers = array(
			'From' => $from,
			'To' => $to,
			'Subject' => $subject
	);
	
	$smtp = Mail::factory('smtp', array(
			'host' => 'ssl://smtp.gmail.com',
			'port' => '465',
			'auth' => true,
			'username' => 'unitingforacause@gmail.com',
			'password' => 'sengineers'
	));
	
	$mail = $smtp->send($to, $headers, $body);
	
	if (PEAR::isError($mail)) {
		echo('<p>' . $mail->getMessage() . '</p>');
		return 0;
	} else {
		//echo('<p>Message successfully sent!</p>');
		return 1;
	}		
}

?>