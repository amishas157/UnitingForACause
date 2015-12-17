<?php
 	require_once('includes/initialize.php');


$registration_no= $_GET['registration_no'];
$email = $_GET['email-id'];

$query="SELECT * FROM ngo";
$result  = mysql_query($query);
while($value = mysql_fetch_array($result))
{
$no = $value["Registration_no"];
if(md5($no) == $registration_no)
  {
     $val = "1";
     mysql_query("UPDATE ngo SET Verified ='".$val."' WHERE Username='".$value["Username"]."'");
	 echo "Thanks for verifying the NGO";
  }
}

$subject = "Approval from admin";
$body = "Your NGO has been verified by Admin.Now you will be able to access your account.
      
	     Uniting for a cause";
		 
   mail_send::Send_Mail($email,$subject,$body);
?>