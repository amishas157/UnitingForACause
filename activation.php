<?php
 

	require_once('includes/initialize.php');


	


$passkey=$_GET['passkey'];

$query="SELECT * FROM user_otp WHERE otp='".$passkey."'";
$result  = mysql_query($query);
$cols = mysql_fetch_array($result);
$user = $cols['Username'];

	$result1 = mysql_query("SELECT * FROM user WHERE Username = '".$user."'");
	$rows = mysql_fetch_array($result1);

	$val=$rows['Validate'];
	if ($val == "0" )
	{
		$vals = "1";
		$sqlupdate = "UPDATE user SET Validate='".$vals."' WHERE Username='".$user."'"; // update the status
		mysql_query($sqlupdate);
		echo "your account has been fully activated";
	}
	else{
		echo "your email is already verified";
	}



?>