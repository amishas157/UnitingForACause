<?php
	include 'mysqldatabase.php';
	$result = mysql_query("SELECT user.Username, user.Last_access_date, user.Last_access_date
		FROM user
		WHERE (DATEDIFF(NOW(), user.Last_access_date) = 7) AND user.Validate = '0'");
	while($values = mysql_fetch_array($result))
	{
		mysql_query("DELETE FROM user WHERE Username = '".$values["Username"]."'");
		mysql_query("DELETE FROM volunteer WHERE Username = '".$values["Username"]."'");
		mysql_query("DELETE FROM ngo WHERE Username = '".$values["Username"]."'");
	}
?>