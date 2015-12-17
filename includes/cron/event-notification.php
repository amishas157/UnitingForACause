<?php 
   include 'mysqldatabase.php';
   include 'send_mail.php';
   
   $result = mysql_query( "SELECT event.Event_id, event.Start_date, event.Name, volunteers_registered_for_events.Volunteer_Username, user.Email_ID, volunteer.Email_notification_control, event.Start_time, event.Location_area, event.Location_city
	FROM event JOIN volunteers_registered_for_events JOIN user JOIN volunteer
		WHERE ((DATEDIFF(event.Start_date, NOW()) = 3) AND event.Event_id = volunteers_registered_for_events.Event_id AND user.Username = volunteers_registered_for_events.Volunteer_Username AND  user.Username = volunteer.Username AND volunteer.Email_notification_control = '1')");

				while($values =  mysql_fetch_array($result))
				{				
			//	echo $values["Volunteer_Username"];
			    $recipient = $values["Email_ID"];
			//    echo $recipient;
				$subject = "Event notification"; 
				$comment = "Hi " .$values["Volunteer_Username"]. "\n You have registered for event ".$values["Name"]." scheduled on ".$values["Start_date"].", ".$values["Start_time"]." at ".$values["Location_area"].", ".$values["Location_city"]." .\n Regards \n Uniting for a cause"; 
				Send_Mail($recipient, $subject, $comment);
				}
				
?>
			