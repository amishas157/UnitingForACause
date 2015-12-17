<?php
	include 'mysqldatabase.php';
	include 'send_mail.php';
	$result = mysql_query("SELECT user.Username, user.Last_access_date, user.Email_ID, user.Name
		FROM user
		WHERE (DATEDIFF(NOW(),user.Last_access_date) = 365)");
			while($values = mysql_fetch_array($result))
			{
				$recipient = $values["Email_ID"];
			//	echo $recipient;
				$subject = "Warning : Account deletion"+ $values["Name"]; 
				$comment = "Hi " .$values["Username"] . "\n You haven't accessed your account since one year. So please visit or else your account will be deleted. \n Regards \n Uniting for a cause"; 
				Send_Mail($recipient, $subject, $comment);
			}

	$result1 = mysql_query("SELECT user.Username, user.Last_access_date
		FROM user
		WHERE (DATEDIFF(NOW(),user.Last_access_date) > 365)");
			while($values = mysql_fetch_array($result1))
			{
				//echo $values["Username"];
				mysql_query("DELETE FROM user WHERE Username = '".$values["Username"]."'");
			}
?>