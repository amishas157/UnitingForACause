<?php
require_once('includes/initialize.php');

	class Email_notification
	{
	   public static function mail_on_create_event($ngo_username, $event_type)
	    {
		
		$ngo_followers = ngo::view_ngo_followers($ngo_username);
		$count1 = count($ngo_followers);
		$i = 0;
		while($i<$count1)
		{
   			$result1 = mysql_query("SELECT volunteer.Email_notification_control, event.Name, event.Start_date, event.Start_time, event.Location_city, event.Location_area
				FROM volunteer JOIN event
				WHERE Email_notification_control = '1' AND Username = '".$ngo_followers[$i][2]."'");
   			$value1 = mysql_fetch_array($result1);
   			$control1 = $value1["Email_notification_control"];
   			if($control1 == "1")
   			{
   					$user1 = $ngo_followers[$i][2];
				//	echo $user1;
           			$email1 = $ngo_followers[$i][3];	
           		//	echo $email1;
           			$subject = "Event notification";
           			$comment = "Hi \n The new event '".$value1["Name"]."' is  scheduled on '".$value1["Start_date"]."', '".$value1["Start_time"]."' at '".$value1["Location_area"]."', '".$value1["Location_city"]."' \n Regards \n Uniting for a cause"; 
           			mail_send::Send_Mail($email1, $subject, $comment);
     		}
     		$i++;
           	
		}

		$event_type_followers = ngo::view_event_type_followers($event_type);
		$count2 = count($event_type_followers);
		$j = 0;
		while($j<$count2)
		{
			$result2 = mysql_query("SELECT volunteer.Email_notification_control, event.Name, event.Start_date, event.Start_time, event.Location_city, event.Location_area
				FROM volunteer JOIN event
				WHERE Email_notification_control = '1' AND Username = '".$event_type_followers[$j][2]."'");
			$value2 = mysql_fetch_array($result2);
			$control2 = $value2["Email_notification_control"];
			if($control2 == "1")
			{
					$user2 = $event_type_followers[$j][2];
				//	echo $user2;
					$email2 = $event_type_followers[$j][3];
				//	echo $email2;
					$subject = "Event notification";
           			$comment = "Hi \n The new event '".$value2["Name"]."' is scheduled on '".$value2["Start_date"]."', '".$value2["Start_time"]."' at '".$value2["Location_area"]."', '".$value2["Location_city"]."' .\n Regards \n Uniting for a cause"; 
           			mail_send::Send_Mail($email2, $subject, $comment);
			}
			$j++;
		}

 }
 
 	public static function  mail_on_update_event($event_id)
	{
	$result2 = mysql_query("SELECT * FROM volunteers_registered_for_events, volunteer, user, event
		WHERE volunteers_registered_for_events.Event_id='".$event_id."' AND event.Event_id = '".$event_id."' AND volunteers_registered_for_events.Volunteer_Username = volunteer.Username AND user.Username = volunteer.Username AND volunteer.Email_notification_control = '1'");
	while($values2 = mysql_fetch_array($result2))
	{
			$user = $values2["Email_ID"];
			//echo $user;
			$subject = "Event update notification";
           	$comment = "Hi \n The event '".$values2["Event_id"]."' has been re-scheduled to '".$values2["Start_time"]."' on '".$values2["Start_date"]."', at '".$values2["Location_area"]."', '".$values2["Location_city"]."' \n Regards \n Uniting for a cause"; 
           	mail_send::Send_Mail($user, $subject, $comment);
	}
    }
	
	 public static function mail_on_delete_event($event_id)
	{
	$result2 = mysql_query("SELECT *
		FROM volunteers_registered_for_events, volunteer, user, event
		WHERE volunteers_registered_for_events.Event_id='".$event_id."' AND event.Event_id = '".$event_id."' AND volunteers_registered_for_events.Volunteer_Username = volunteer.Username AND user.Username = volunteer.Username AND volunteer.Email_notification_control = '1'");
	while($values2 = mysql_fetch_array($result2))
	{
			$user = $values2["Email_ID"];
			//echo $user;
			$subject = "Event delete notification";
           	$comment = "Hi \n The event '".$values2["Event_id"]."' has been cancelled. Sorry for the inconvenience caused. \n Regards \n Uniting for a cause"; 
           	mail_send::Send_Mail($user, $subject, $comment);
	}
	}
	
 
 }

?>