<?php
	include 'mysqldatabase.php';
	$result = mysql_query("SELECT event.Event_id, event.Repetition_details, event.Start_date
		FROM event
		WHERE (DATEDIFF(NOW(),event.Start_date) >= 30) AND event.Repetition_details = 'NULL'");
	while($values = mysql_fetch_array($result))
	{
//		echo $values["Event_id"];
		mysql_query("DELETE FROM event WHERE Event_id = '".$values["Event_id"]."'");
	}
?>
