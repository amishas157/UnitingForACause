<?php
	include 'mysqldatabase.php';
	include 'send_mail.php';
	
	$result = mysql_query("SELECT event.Event_id, event.Repetition_details, event.Start_date, event.End_date, event.Name
		FROM event
		WHERE ((curdate() = event.Start_date) AND Repetition_details > 0)");
		while ($values = mysql_fetch_array($result)) {
			# code...
			$id = $values["Event_id"];
			$name = $values["Name"];
			$start_date = $values["Start_date"];
			$end_date = $values["End_date"];
			$frequency = $values["Repetition_details"];

			$startdate=explode('-',$start_date);
			$new_start_date=Date("Y-m-d", mktime(0,0,0,$startdate[1], $startdate[2]+$frequency, $startdate[0]))."<br>";
	//		echo $new_start_date;

			if(!($end_date == NULL))
			{
				$diff = abs(strtotime($end_date) - strtotime($start_date));
				$days = floor($diff / (60*60*24));
	//			printf("%d days\n", $days);
				$newstartdate=explode('-',$new_start_date);
				$new_end_date=Date("Y-m-d", mktime(0,0,0,$newstartdate[1], $newstartdate[2]+$days, $newstartdate[0]))."<br>";
	//			echo $new_end_date;
			}
			else
			{
				$new_end_date = NULL;
			}
			$query = "UPDATE event SET event.Start_date='".$new_start_date."' , event.End_date='".$new_end_date."' WHERE event.Event_id='".$values["Event_id"]."'";
		//	echo $query;
			mysql_query($query);
		/*	while ($values1 = mysql_fetch_array($sql)) {
				echo $new_start_date;
				echo $new_end_date;
			}*/


		$result1 = mysql_query("SELECT *
		FROM volunteers_following_events JOIN volunteer JOIN user JOIN event
		WHERE volunteers_following_events.Event_id = '".$values["Event_id"]."' AND event.Event_id = '".$values["Event_id"]."' AND volunteer.Username = volunteers_following_events.Volunteer_Username AND user.Username = volunteer.Username AND volunteer.Email_notification_control = '1'");
		while($values1 = mysql_fetch_array($result1))
			{
				$user = $values1["Email_ID"];
				//echo $user;
				$subject = "Event update notification";
           		$comment = "Hi \n The new event '".$values1["Name"]."' is organised by '".$values1["NGO_Username"]."' NGO and scheduled on '".$values1["Start_date"]."', '".$values1["Start_time"]."' at '".$values1["Location_area"]."', '".$values1["Location_city"]."' .\n Regards \n Uniting for a cause"; 
           		Send_Mail($user, $subject, $comment);
			}	
		}

?>