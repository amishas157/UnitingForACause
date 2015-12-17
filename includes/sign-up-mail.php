<?php
	require_once('includes/initialize.php');
	require_once('mail.php');
?>


<?php
class mail_send
{

public static function Send_Mail($to,$subject,$body)
{	
	$from ="unitingforacause";
	
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
public function send_activation($to){
	$activation =md5($to.time());
	$result = mysql_query("SELECT * FROM user WHERE Email_ID = '".$to."'");
	while($values = mysql_fetch_array($result))
	{
		$user = $values["Username"];
	}
	$count = mysql_query('SELECT * FROM user_otp WHERE Username ="'.$user.'"');
	if(mysql_num_rows($count)>0)
    mysql_query("UPDATE user_otp SET otp ='".$activation."' WHERE Username='".$user."'");
	else
	mysql_query('INSERT INTO user_otp VALUES ("'.$user.'", "'.$activation.'") ');
	

	$base_url='http://localhost/ufc/activation.php?passkey=';
	$subject ="Email Verification" ;
	$body ='Hi,  We need to make sure your Email is valid. Please verify your email and get started using your Website account.
			'.$base_url.$activation.'';

	mail_send::Send_Mail($to, $subject, $body);
	//echo "hello form the confirmation";

}

public function send_request_to_admin($registration_no,$ngo_name,$email)
{
$activation = md5($registration_no);
$base_url = 'http://localhost/ufc/request_admin.php?registration_no=';
$subject = "Request of approval from NGO";
$body = 'There is request for approval from NGO "'.$ngo_name.'". 
         Registration no : "'.$registration_no.'"'.
		 '"'.$base_url.$activation.'&&email-id='.$email;
		 mail_send::Send_Mail("unitingforacause@gmail.com",$subject,$body);
}

function send_confirmation($to ){
	$base_url='http://localhost/ufc/activation.php?passkey=';
	$activation =md5($to.time());
	$subject ="Email Verification" ;
	$body ='Hi,  We need to make sure your Email is valid. Please verify your email and get started using your starcontests account.
			'.$base_url.$activation.'">';

	mail_send::Send_Mail($to, $subject, $body);
	//echo "hello form the confirmation";
}
}

/*function send_notification(){
	
	$cid = $_GET['key'];
	$query="SELECT * FROM contest WHERE cid=$cid";
	$run=mysql_query($query) or die(mysql_error());
	$result=mysql_fetch_array($run);
	$to=$_SESSION['email'];
	
	$name=$result['name'];
	$organization=$result['organization'];
	$org_contact=$result['org_contact'];
	$category=$result['category'];
	$fromdate=$result['fromdate'];
	$s_time=$result['s_time'];
	$e_time=$result['e_time'];
	$todate=$result['todate'];
	$venue=$result['venue'];
	$city=$result['city'];
	$state=$result['state'];
	$pincode=$result['pincode'];
	$description=$result['description'];
	//$logo=$result['logo'];
	
	$subject = "Regarding participating in the contest ";
	
	$body='Hi
			 
		   You have participated in this contest '.$name.' .  Details of the contest are as follows
		   Contest Name '.$name.'
		   category  '.$category.'
		   Venue  '.$venue.'
		   Start Date '.$fromdate.'
		   Event Start time '.$s_time.'	
		   End date '.$todate.'
		   End time '.$e_time.'
		   City '.$city.'
		   State '.$state.'	
		   Contest Description '.$description.'										
		   		
		   Regards
		   Star Contest Team
		   Cheers 
		   			
			If you want to know further details of this event Drop a mail to the Organiser
			Email id	'.$org_contact.'';
	
			Send_Mail($to, $subject, $body);
	
}

function send_notification_as_accepted($emailid, $type, $passkey){
	
	$to =$emailid;
	$subject = "Regarding the Approval as $type";
	$link ="localhost/star/event_page.php?key=".$passkey."";
	
	
	$query="SELECT emailid,name FROM contest WHERE cid=$passkey"; // select organiser 
	$run=mysql_query($query) or die(mysql_error());
	$result=mysql_fetch_array($run); 
	$email_org=$result['emailid'];  // organiser email
	$name_org=$result['name'];     // organiser name
	
	echo $body='Hi
		   	
		   Organiser has approved your request for '.$type.' . For further details click on this link	  
		   link '.$link.'
		   Regards
		   Star Contest Team
		   Cheer
	
			If you want to Know further detail of this event Drop a mail to the Organiser with email id is
		   	Name '.$name_org.'	
			Email id	'.$email_org.'';
	
	Send_Mail($to, $subject, $body);
	
}

*/


?>
