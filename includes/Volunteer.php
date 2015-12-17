<?php
	include 'mysqldatabase.php';
	
	class volunteer
	{
		protected static $class_name = 'volunteer';
		protected static $table_name = 'volunteer';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'Username' , 'Gender' , 'DOB' , 'Profession' , 'Email_notification_control');
		public $Username; 
		public $Gender; 
		public $DOB;
		public $Profession;
		public $Email_notification_control;
		
		
		//output of following NGOs
		public static function view_followed_NGOs($volunteer_name)
		{
			$view_followed = 'select * from volunteers_following_ngos inner join user where Volunteer_Username = "'.$volunteer_name.'" and NGO_Username= user.Username';
			
			$result=mysql_query($view_followed);
			
            return $result;
		}
		
		public static function view_profession_required($events)
		{
		     $view_followed="";
		     foreach($events as $event)
			 $view_followed = mysql_query("select * from event_profession where event_profession.Event_id = ".$event[0]);
			
			$event_profession = array();
			 while($values = mysql_fetch_array($view_followed))
			  array_push($event_profession,$values);
			
			return $event_profession;
		}
		
		//output of following events
		public static function view_followed_Events($volunteer_name)
		{
		$query= ('select * from volunteers_following_events inner join event where Volunteer_Username="'.$volunteer_name.'" and volunteers_following_events.Event_id= event.Event_id' );

			$result=mysql_query($query);
			             
		   return $result;
			
		}
		
		
		public static function view_past_registered_events($volunteer)
		{
		
		    $date = date("Y-m-d");
		
			$result=mysql_query("select * from volunteers_registered_for_events ,event where Volunteer_Username= '". $volunteer."' and volunteers_registered_for_events.Event_id= event.Event_id and DATEDIFF(event.Start_date,'".$date."') < 0 and DATEDIFF(event.Start_date,'".$date."') > -15;" );
             return $result;

			
		}
		public static function view_feedback_accessibility($ngo_username)
		{
		$result = mysql_query('SELECT Feedback_accessibility_status from ngo where Username = "'.$ngo_username.'"');
		$value = mysql_fetch_array($result);
		return $value["Feedback_accessibility_status"];
		}
		
	public static function view_upcoming_registered_events($volunteer)
		{
		
		    $date = date("Y-m-d");
	$query = ("select Name,volunteers_registered_for_events.Event_id from volunteers_registered_for_events join event where Volunteer_Username= '". $volunteer."' and volunteers_registered_for_events.Event_id= event.Event_id and DATEDIFF(event.Start_date,'".$date."') >= 0;" );	
		
		$result=mysql_query($query);
			
       
            			

		   return $result;

			
		}
		
		public static function view_followed_Event_types($volunteer_name)
		{
			$result=mysql_query('select * from volunteers_following_event_types where Volunteer_Username="'.$volunteer_name.'" ');
	
	        return $result;
		}
		
		//output of search NGOs
		/*public static function search_by_ngo_followed($username,$name, $event_type_name, $city)
		{
		    $where_clause = " HQ_city LIKE '" . $city. "'";
			if($name!= NULL)
				$where_clause .= " AND user.Name ='".$name."'";
			if($event_type_name!= "Select Category")
				$where_clause .= " AND Event_type_name ='".$event_type_name."' AND ngo_event_type_name.NGO_Username = ngo.Username";
			
			$ngo_array = array();
			
		    $ngo = mysql_query("SELECT Name,Description,Website_url,HQ_Area,HQ_City,HQ_State,ngo.Username FROM ngo,user,ngo_event_type_name,volunteers_following_ngos where ".$where_clause." AND user.Username = ngo.Username AND volunteers_following_ngos.Volunteer_Username ='".$username."' AND volunteers_following_ngos.NGO_Username=ngo.Username ");
			
			while($values =  mysql_fetch_array($ngo))
			array_push($ngo_array,$values);
		
			return $ngo_array;												
		}*/
		
		public static function search_by_ngo_queries($username,$name, $event_type_name, $city)
		{
		    if($city == null)
			return "error";
			
            $name_where_clause="";
			if($name!= NULL)
				$name_where_clause = ' and Name = "'.$name.'"';
			$query1 = 'SELECT Name,Description,Website_url,HQ_Area,HQ_City,HQ_State,ngo.Username FROM ngo JOIN user USING (Username) WHERE HQ_City LIKE "'.$city.'"'.$name_where_clause;
			
			if($event_type_name!= "Select Category")
				$query1 = 'SELECT n.* FROM ngo_event_type_name as ne JOIN ('.$query1.') as n ON ne.NGO_Username = n.Username WHERE ne.Event_type_name = "'.$event_type_name.'"';
			
		
			$followed_query = 'SELECT t.* FROM volunteers_following_ngos as vn JOIN ('.$query1.') as t on t.Username=vn.NGO_Username WHERE vn.Volunteer_Username = "'.$username.'"';
			$followed_usernames = 'and Username NOT IN(SELECT t.Username FROM volunteers_following_ngos as vn JOIN ('.$query1.') as t on t.Username=vn.NGO_Username WHERE vn.Volunteer_Username = "'.$username.'")';
			$unfollowed_query = $query1.$followed_usernames;
			$followed_output = static::exec_query($followed_query);
			$unfollowed_output = static::exec_query($unfollowed_query);
	
			return array($followed_output, $unfollowed_output);												
		}
		
		public static function find_unfollowed_event_types($event_types,$username)
		{
		  $output = mysql_query("SELECT Event_type_name FROM volunteers_following_event_types where Volunteer_Username='".$username."'");
		  $output_array = array();
		  $i=0;
		  while($values = mysql_fetch_array($output))
			{$output_array[$i] = $values[0];
			$i++;}

		  $diff= array_diff($event_types,$output_array);
		  
		 return $diff;
		
		}
		
		
		public static function exec_query($query)
		{
			$output_array = array();
			$res_id = mysql_query($query);
			if($res_id!=false)
			{
			while($values = mysql_fetch_array($res_id, MYSQL_NUM))
				array_push($output_array,$values);
			}
			return $output_array;
		}
		
		public static function search_event_by_ngo($NGO_Name,$user)
		{
		$date = date("Y-m-d");
		$events_query = 'SELECT * FROM event where NGO_Username="'.$NGO_Name.'" AND DATEDIFF(Start_date,"'.$date.'") > 0 AND Event_id NOT IN(SELECT Event_id FROM volunteers_registered_for_events WHERE Volunteer_Username= "'.$user.'")'  ;
		$result = mysql_query($events_query);
		return $result;
		}
		
		public static function event_volunteer_requirements($event_id,$capacity,$max_age,$min_age,$gender,$username)
		{
        
		$flag = 1;
		

		//user details
		 $result = mysql_query('SELECT * FROM volunteer WHERE Username = "'.$username.'"');
		 $volunteer = mysql_fetch_array($result);

		 $event_details = mysql_query('SELECT * FROM event where Event_id ="'.$event_id.'" and Start_date = curdate()');
		 $event = mysql_fetch_array($event_details);
		
		
		//capacity count
		if($capacity != null)
		{
		$result = mysql_query('SELECT count(*) as count FROM volunteers_registered_for_events WHERE Event_id = "'.$event_id.'"' );
		$values = mysql_fetch_array($result);
		$count = $values["count"];
		if($count >= $capacity )
		  $flag = 0;
		}
		
		//time check 
		if(mysql_num_rows($event_details)>0)
		{
		$result = mysql_query('SELECT TIMEDIFF("'.$event[4].'",curtime()) as difference');
		$time_result = mysql_fetch_array($result);

		if($time_result["difference"] < 1)
			$flag = 0;
	}

		//age check
		$result = mysql_query('SELECT get_age("'.$volunteer["DOB"].'", NOW()) as age');
		$age_value = mysql_fetch_array($result);
		$age = $age_value["age"];
		if($max_age != null && $min_age != null)
		{
		if($age> $max_age || $age < $min_age)
          $flag = 0;
		}
		else if($max_age != null)
		{
		 if($age > $max_age)
		  $flag =0;
		}
		else if($min_age != null)
		{
		   if($age < $min_age)
		     $flag = 0;
		}
		
			$result = mysql_query('SELECT Profession FROM event_profession WHERE Event_id ="'.$event_id.'"');
		    $profession = array();
		    while($values =  mysql_fetch_array($result))
			array_push($profession,$values["Profession"]);
			
	    //profession check
		if($profession != null)
		   {
			if (!(in_array($volunteer["Profession"], $profession)) )
              $flag = 0;
			 
           }
		   
		   //gender check
		if(!($gender == null || $gender == "B"))
		   {
		     if($gender != $volunteer["Gender"])
			  $flag =0;
			
		   }
		   
		   if($flag == 0)
		      return "false";
			else 
			   return "true";

		}
		
		public static function search_event_by_event_type($event_type_name,$user)
		{
		$date = date("Y-m-d");
		$events_query = 'SELECT * FROM event inner join user  on event.NGO_Username = user.Username where Event_type_name ="'.$event_type_name.'" AND DATEDIFF(Start_date,"'.$date.'") > 0 AND Event_id NOT IN(SELECT Event_id FROM volunteers_registered_for_events WHERE Volunteer_Username= "'.$user.'")'  ;
		$result = mysql_query($events_query);
		return $result;
		}
		
		public static function search_repetitive_events($event_id,$user)
		{
		$date = date("Y-m-d");
		$events_query = 'SELECT * FROM event inner join user on event.NGO_Username = user.Username where Event_id = "'.$event_id.'" AND DATEDIFF(Start_date,"'.$date.'") > 0 AND Event_id NOT IN(SELECT Event_id FROM volunteers_registered_for_events WHERE Volunteer_Username= "'.$user.'")'  ;
		$result = mysql_query($events_query);
		return $result;
		}

		public static function search_by_events($name, $event_type_name, $NGO_Name, $city,$date,$user)
		{
		    
			if($event_type_name == null || $city == null)
			return "error";
			
			$where_clause = ' Event_type_name ="'.$event_type_name.'" and Location_city ="'.$city.'"';
			if($name!= NULL)
				$where_clause .= " AND Name ='".$name."'";
			if($date!= NULL)
				$where_clause .= " AND Start_date ='".$date."'";
			else {
			  $date = date("Y-m-d");
			 $where_clause .= "AND DATEDIFF(Start_date,'".$date."') > 0";
			 }
			if($NGO_Name!= NULL)
				$where_clause .= " AND NGO_Name ='".$NGO_Name."'";
				
			//$where_Clause .= "AND Start_time ='".."'";//time condition
			
			$event_array = array();
			$events = mysql_query('SELECT * FROM event where '.$where_clause);
			while($values =  mysql_fetch_array($events))
			array_push($event_array,$values);
			
			
			$events_query = 'SELECT * FROM event where '.$where_clause;
			//echo $events_query;
			
			$repetitive_events = $events_query.' AND repetition_details > 0'; 
            $registered_events = 'SELECT v.Event_id as Event_id FROM ('.$events_query.') as e JOIN volunteers_registered_for_events as v using (Event_id) where Volunteer_Username = "'.$user.'"';
            $followed_events = 'SELECT u.Event_id FROM volunteers_following_events as v JOIN (SELECT e1.Event_id FROM ('.$repetitive_events.') as e1) as u USING (Event_id) WHERE Volunteer_Username = "'.$user.'"'; 
			$followed_event_types = 'SELECT u.Event_id FROM volunteers_following_event_types as v JOIN (SELECT e1.Event_id, e1.Event_type_name as Event_type_name FROM ('.$events_query.') as e1) as u USING (Event_type_name) WHERE Volunteer_Username = "'.$user.'"'; 
			$followed_ngos = 'SELECT u.Event_id FROM volunteers_following_ngos as v JOIN (SELECT e1.Event_id, e1.NGO_Username as NGO_Username FROM ('.$events_query.') as e1) as u USING (NGO_Username) WHERE Volunteer_Username =  "'.$user.'"';
			
			$registered_output = mysql_query($registered_events);
			

			
	        $followed_output   = mysql_query($followed_events);
	        $followed_event_types_output   = mysql_query($followed_event_types);
	        $followed_ngos_output   = mysql_query($followed_ngos);
			$repetitive_output = mysql_query($repetitive_events);
			
			$registered_array = array();
			$followed_array = array();
			$followed_event_types_array = array();
			$followed_ngos_array = array();	
            $repetitive_array = array();				
			
		    $i=0;
		    while($values = mysql_fetch_array($registered_output))
			{$registered_array[$i] = $values["Event_id"];
			$i++;}
			$i=0;
		     while($values = mysql_fetch_array($followed_output))
			{$followed_array[$i] = $values["Event_id"];
			$i++;}
			$i=0;
		     while($values = mysql_fetch_array($followed_event_types_output))
			{$followed_event_types_array[$i] = $values["Event_id"];
			$i++;}
			$i=0;
		     while($values = mysql_fetch_array($followed_ngos_output))
			{$followed_ngos_array[$i] = $values["Event_id"];
			$i++;}
			 $i=0;
		     while($values = mysql_fetch_array($repetitive_output))
			{$repetitive_array[$i] = $values["Event_id"];
			$i++;}
		    
			
			return array($event_array,$registered_array, $followed_array, $followed_event_types_array,$followed_ngos_array,$repetitive_array);			
			
			}
		
		
		/*public static function search_by_event_type($event_type)
		{
		
	
			mysql_query('select * from event where event_type_name = '.$event_type_name.'');
		
		
		}*/
		public static function register_for_event($event_id, $volunteer_username)
		{
		
        $result1 = mysql_query('SELECT * FROM event natural join volunteers_registered_for_events WHERE Volunteer_Username = "'.$volunteer_username.'"');		
		$result2 = mysql_query('SELECT * FROM event where Event_id = "'.$event_id.'"');	
		$value2 = mysql_fetch_array($result2);
		while($value1 = mysql_fetch_array($result1))
		  {
		    $flag = 1;
			if(($value2["Start_date"] == $value1["Start_date"]) && ($value2["Start_time"] == $value1["Start_time"]))
			$flag = 0;
			
			if($value1["End_date"]!= null)
			{
				   if(($value2["Start_date"] >= $value1["Start_date"]) && ($value2["Start_date"]<= $value1["End_date"]))
				   $flag = 0;
		    }
				if($flag == 0)
                  {
				    echo "You have registered for an  event '".$value1["Name"]."' which will be conducted at the same time. To register for this event , You need to deregister from the former event first.";
					return 0;
                  }				  
				 
		   }
		 
		$result=mysql_query("INSERT INTO volunteers_registered_for_events(`Volunteer_Username`, `Event_id`, `Feedback`) VALUES ('".$volunteer_username."','".$event_id."','')"); 									
		
		}
		
		public static function insert_feedback($user,$feedback,$event_id)
		{
		$query= "UPDATE volunteers_registered_for_events SET Feedback ='".$feedback."' WHERE Event_id ='".$event_id."' AND Volunteer_Username = '".$user."'";
		mysql_query($query);
		}
		
		public static function deregister_for_event($event_id, $volunteer_username)
		{
			$query = ('DELETE FROM volunteers_registered_for_events where Volunteer_Username ="'.$volunteer_username.'" and Event_id ="'.$event_id.'"');  											
			$result=mysql_query($query);
		
		}
		public static function follow_event($event_id, $volunteer_username)
		{
			$query = ("INSERT INTO `volunteers_following_events`(`Volunteer_Username`, `Event_id`) VALUES ('".$volunteer_username."','".$event_id."')"); 									
			
			$result = mysql_query($query);
		
			
		}
		public static function unfollow_event($event_id, $volunteer_username)
		{
		
			
			mysql_query('DELETE FROM volunteers_following_events where Event_id = "'.$event_id.'" and Volunteer_Username = "'.$volunteer_username.'"'); 									
		
		}
		public static function follow_event_type($event_type_names, $volunteer_username)
		{
			
			foreach($event_type_names as $event_type_name)
		{	$query = ("INSERT INTO volunteers_following_event_types(`Volunteer_Username`, `Event_type_name`) VALUES ('".$volunteer_username."','".$event_type_name."')"); 									
		    mysql_query($query);}
		}
		public static function unfollow_event_type($event_type_name, $volunteer_username)
		{
			mysql_query('DELETE FROM volunteers_following_event_types where event_type_name = "'.$event_type_name.'" and Volunteer_Username = "'.$volunteer_username.'"'); 									
		
		}
		public static function follow_NGO($ngo_username, $volunteer_username)
		{
			
			mysql_query("INSERT INTO `volunteers_following_ngos`(Volunteer_Username, NGO_Username) VALUES ('".$volunteer_username."','".$ngo_username."')"); 									
		
		}
		public static function unfollow_NGO($ngo_username, $volunteer_username)
		{
			
			mysql_query('DELETE FROM volunteers_following_ngos where NGO_Username = "'.$ngo_username.'" and Volunteer_Username = "'.$volunteer_username.'"'); 									
		
		}



		public static function signup($name, $username, $email_id, $password_hash, $DOB, $Gender, $Profession, $contact_no)
		{
		
		$user_insert = 'INSERT INTO user VALUES ("'.$username.'", "'.$email_id.'", "'.$name.'", "'.$password_hash.'", curdate(), '.$contact_no.',"0")';

				if(!mysql_query($user_insert))
				return "Sorry, we could not register you to the site. Please try again with a different username , Email-ID and Contact no.";
			else // inserting to other tables
			{
				$volunteer_insert = 'INSERT INTO Volunteer VALUES ("'.$username.'", "'.$Gender.'", "'.$DOB.'", "'.$Profession.'", "1")';
				if(!mysql_query($volunteer_insert))
				{
					mysql_query('DELETE FROM user WHERE Username = "'.$username.'"'); // erroneous entry to the users db
					return "Sorry, we could not register you to the site. Please try again with a different username, Email-ID and Contact no. ";
				}
				
				return "1";
			}
			
		}



	}
	