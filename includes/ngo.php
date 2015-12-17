<?php 
require_once('includes/initialize.php');

	class ngo extends user
	{
		protected static $class_name = 'ngo';
		protected static $table_name = 'ngo';
		
		// Do NOT change the order...
		protected static $db_fields = array( 'Username' , 'HQ_Area' , 'HQ_City' , 'HQ_State' , 'Websit_url' , 'Regisration_no' , 'NGO_Head' , 'Description' , 'Feedback_accessibility_status');
		public $Username;
		public $HQ_Area;
		public $HQ_City;
		public $HQ_State;
		public $Website_url; 
		public $Regisration_no;
		public $NGO_Head;
		public $Description;
		
		public $Feedback_accessibility_status;

		// LOOK HERE- compute the hash of the  password from the calling page... DON'T PASS THE PASSWORD OVER IN PLAINTEXT IN ANY GET/POST MESSAGES...
		//		and validate the registration_number
		// call these PHP functions to validate email_id and url from the calling page : filter_var($email_id, FILTER_VALIDATE_EMAIL))  and filter_var($url, FILTER_VALIDATE_URL)...
		// add the branch address part... 

		public static function signup($name, $username, $email_id, $password_hash, $registration_no, $website_url, $ngo_head, $area, $city, $state, $mobile_no, $description)
        {
		
			// Mandatory fields: Name, Username, Email-ID, Password, Registration Number, NGO Head, Head Quarter Area, City, State, Contact_no 
			// Non-mandatory: Description 
			
			// inserting to user
			$user_insert = 'INSERT INTO user VALUES ("'.$username.'", "'.$email_id.'", "'.$name.'", "'.$password_hash.'", curdate(), '.$mobile_no.',"0")';
			//echo $user_insert;
			
			if(!mysql_query($user_insert))
				return "Sorry, we could not register you to the site. Please try again with a different username , Email-ID and Contact no.";
			else // inserting to other tables
			{
				$ngo_insert = 'INSERT INTO ngo VALUES ("'.$username.'", "'.$area.'", "'.$city.'", "'.$state.'", "'.$website_url.'", "'.$registration_no.'", "'.$ngo_head.'", "'.$description.'", '.'1 , 0)';
				if(!mysql_query($ngo_insert))
				{
					mysql_query('DELETE FROM user WHERE Username = "'.$username.'"'); // erroneous entry to the users db
					return "Sorry, we could not register you to the site. Please try again with a unique registration number and a unique website URL.";
				}
				
				return "Your account is successfully registered.A confirmation link has been sent to email account.Please click on that link to verify your account.The link will expire in 7 days.You will get a message from admin as an approval of account, after which you will be able to access the account.";
			}		
        }
		
		// will need to plug in username as additional input- not directly from the user
        // DO THESE mobile_no from user_mobile, branch office from ngo_branch_office table
		public static function edit_details($username,$HQ_State, $HQ_City, $HQ_Area, $NGO_Head, $website_url, $feedback_accessibility_status, $description)
        {
			 $where_clause='';
			  if($HQ_Area!= null)
			  $where_clause = 'HQ_Area = "'.$HQ_Area.'", HQ_State= "'.$HQ_State.'", HQ_City = "'.$HQ_City.'" ,';
			  if($website_url != null)
			  {
			  $query = 'SELECT Website_url from ngo where Website_url = "'.$website_url.'" and Username != "'.$username.'"';
			  $result = mysql_query($query);
			  if(mysql_num_rows($result) > 0 )
			  {
			    return "Please enter unique Website URL.";
			  }
			  }
			  

            $ngo_query = ' UPDATE ngo SET '.$where_clause.' Description = "'.$description.'" ,Feedback_accessibility_status = "'.$feedback_accessibility_status.'", NGO_Head = "'.$NGO_Head.'",Website_url = "'.$website_url.'" WHERE Username = "'. $username.'"';
			
			if(!(mysql_query($ngo_query) ))
				return "Sorry, we couldn't update your details.Website url should be unique"; 
			else return "Profile updated successfully.";
        }

		// need to supply $ngo_username indirectly- without user input
		// need to check before, that its not creating another event at the same time....
        public static function create_event($name, $event_type_name, $ngo_username, $start_date,  $start_time, $area, $city, $state, $end_date, $end_time, $repetition_frequency_in_days, $volunteer_capacity, $gender_requirements, $max_age, $min_age, $professions_array)
        {
			$event_insert = 'INSERT INTO event ';
			$event_insert .= 'VALUES (NULL,"'.$name.'", "'.$start_date.'", "'.$end_date.'", "'.$start_time.'", "'.$end_time.'", "'.$area.'", "'.$city.'", "'.$state.'", '.$volunteer_capacity.', '.$max_age.', '.$min_age.', "'.$gender_requirements.'", '.$repetition_frequency_in_days.', "'.$event_type_name.'", "'.$ngo_username.'")';

			if($start_date > date("Y/m/d"))
			{
			if(!mysql_query($event_insert))
			return "Sorry, we couldn't create the event.";
			$result = mysql_query('SELECT MAX(Event_id) as id FROM event');
			$values = mysql_fetch_array($result);
			$event_id = $values["id"];
			email_notification::mail_on_create_event($ngo_username, $event_type_name);
			if($event_id!=NULL)
			{
				// event_profession array
				if($professions_array!=NULL)
				{
					foreach($professions_array as $value)
					{
						$query = 'INSERT INTO event_profession VALUES ('.$event_id.', "'.$value.'")';
						
						mysql_query($query);
					}
				}
				return "Event created successfully";
			}
			else
				return "Sorry, we couldn't create the event.";
			}
			else
				return "You cannot select past dates for events";
        }
		
		public static function get_ngo_data($ngo_username)
		{
			$query = 'SELECT * FROM ngo WHERE Username = "'.$ngo_username.'"'; 
			$res_id =mysql_query($query);
			return mysql_fetch_row($res_id);
		}
		
		// need to add code in the function below to send email-notifications...
        public static function delete_event($event_id)
        {
			$query = 'DELETE from event where Event_id= '.$event_id;
			email_notification::mail_on_delete_event($event_id);
			if(!mysql_query($query))
				return "Sorry, we couldn't delete this event.";
			else
			{
				// add code to send email-notifications here, using query results for volunteer details
			}
        }

		// in the front-end, have code that compares the new values of the dates and times to their old values, TO ENSURE THAT THEY LIE WITHIN THE ONE-DAY LIMITS..
		// need to pass $event_id indirectly
   		// need to add code in the function below to send email-notifications...
		public static function update_event($event_id,$start_time,$end_time, $area, $repetition_frequency_in_days, $volunteer_capacity)
        {
		     $where_clause='';
			 if($area!= null)
			  $where_clause = 'Location_area = "'.$area.'" ,';
			$query = 'UPDATE event SET '.$where_clause.'Start_time = "'.$start_time.'", End_time = "'.$end_time.'",Repetition_details = '.$repetition_frequency_in_days.' , Volunteer_Capacity = '.$volunteer_capacity.' WHERE Event_id = '.$event_id;
			email_notification::mail_on_update_event($event_id);
			if(!mysql_query($query))
				return "Sorry, we couldn't update this event.";
			else // code to send emails to volunteers 
			{
				
				return true;
			}
		}

		public static function view_event_followers($event_id)
        {
			$query = 'SELECT Name, Mobile_no from volunteers_following_events as v join user on v.Volunteer_Username = user.Username and Event_id = "'.$event_id.'"';
			$array = static::exec_view_query($query); 
			$i=0; 
			if($array!=NULL)
			{foreach($array as $value)
			{
				$new_array[$i][0] = $value[0]; $new_array[$i][1] = $value[1]; $i++;
			} 
			return $new_array;}
			else
				return NULL;
		}
		
		
	    public static function get_event_types($ngo_username)
		{
			$new_array = array();
			$query = 'SELECT Event_type_name FROM ngo_event_type_name WHERE NGO_Username = "'.$ngo_username.'"';
			$array = static::exec_view_query($query); 
			$i=0; 
			if($array!=NULL)
			{foreach($array as $value)
			{
				$new_array[$i] = $value[0]; $i++;
			} 
			return $new_array;}
			else
				return null;
		}

		public static function set_event_types($ngo_username, $drop_array, $add_array) 
		{
			$delete_count = count($drop_array); 
			$add_count = count($add_array); 
			if($delete_count>0)
			{
			foreach($drop_array as $drop)
			{
				$query = 'DELETE FROM ngo_event_type_name WHERE NGO_Username = "'.$ngo_username.'" and Event_type_name = "'.$drop.'"';
				mysql_query($query);
			}
			}
			
			if($add_count > 0)
			{
			foreach($add_array as $add)
			{
				$query = 'INSERT INTO ngo_event_type_name VALUES("'.$ngo_username.'", "'.$add.'")';
				mysql_query($query);
			}
			}
			
		}
		
		public static function delete_all_event_types($ngo_username)
		{
				$query = 'DELETE FROM ngo_event_type_name WHERE NGO_Username = "'.$ngo_username.'" ';
				mysql_query($query);	
		}
		
		public static function view_ngo_followers($ngo_username)
        {
			$query = 'SELECT Name, Mobile_no, Username, Email_ID FROM volunteers_following_ngos as v JOIN user ON v.Volunteer_Username = user.Username where NGO_Username = "'.$ngo_username.'"';
			$array = static::exec_view_query($query); 
			$i=0; 
			if($array!=NULL)
			{
				foreach($array as $value)
			{
				$new_array[$i][0] = $value[0]; $new_array[$i][1] = $value[1]; 
				$new_array[$i][2] = $value[2]; $new_array[$i][3] = $value[3];
				$i++;
			} 
			return $new_array;}
			else
				return NULL;
		}

		public static function view_event_type_followers($event_type_name)
        {
			$query = 'SELECT Name, Mobile_no, Username, Email_ID FROM volunteers_following_event_types as v JOIN user on v.Volunteer_Username = user.Username where Event_type_name = "'.$event_type_name.'"';
			$array = static::exec_view_query($query); 
			$i=0; 
			if($array!=NULL)
			{foreach($array as $value)
			{
				$new_array[$i][0] = $value[0]; $new_array[$i][1] = $value[1];
				$new_array[$i][2] = $value[2]; $new_array[$i][3] = $value[3]; $i++;
			} 
			return $new_array;}
			else
				return NULL;
		}		
		
		public static function view_event_types($ngo_username)
		{
			$query = 'SELECT DISTINCT Event_type_name FROM volunteers_following_event_types as v JOIN event using(Event_type_name)where NGO_Username = "'.$ngo_username.'"';
			$array = static::exec_view_query($query); 
			$i=0; 
			if($array!=NULL)
			{foreach($array as $value)
			{
				$new_array[$i] = $value[0]; $i++;
			} 
			return $new_array;}
			else
				return NULL;
		}
		
		public static function if_one_day_event($event_id)
		{
			$query = 'SELECT * FROM event where Event_id = "'.$event_id.'" AND Start_date = End_date';
			$result = mysql_query($query);
			if(mysql_num_rows($result)>0)
			return "1";
			else 
			return "0";
			}
		
		public static function view_events($ngo_username)
		{
			$query = 'SELECT DISTINCT v.Event_id, Name FROM volunteers_following_events as v JOIN event using(Event_id)where NGO_Username = "'.$ngo_username.'"';
			$array = static::exec_view_query($query); 
			$i=0; 
			if($array!=NULL)
			{foreach($array as $value)
			{
				$new_array[$i][0] = $value[0]; $new_array[$i][1] = $value[1]; $i++;
			} 
			return $new_array;}
			else
				return NULL;
		}
		
		public static function view_upcoming_events($ngo_username)
		{
			$query = 'SELECT Event_id, Name from event where NGO_Username = "'.$ngo_username.'" and Start_date >= curdate()';
			$array = static::exec_view_query($query); 
			$i=0; 
			
			foreach($array as $value)
			{
				$new_array[$i][0] = $value[0]; $new_array[$i][1] = $value[1]; $i++;
			}
			return $array==NULL ? $array : $new_array;		
		}
		
		public static function view_past_events($ngo_username)
		{
			$query = 'SELECT Event_id, Name from event where NGO_Username = "'.$ngo_username.'" and Start_date < curdate()';
			$array = static::exec_view_query($query); 
			$i=0;
			foreach($array as $value)
			{
				$new_array[$i][0] = $value[0]; $new_array[$i][1] = $value[1]; $i++;
			}
			return $array==NULL ? $array : $new_array;		
		}
		
        public static function view_registered_volunteers_for_event($event_id)
        {
			$query = 'SELECT Name, Mobile_no from volunteers_registered_for_events as v join user on user.Username = v.Volunteer_Username where Event_id = "'.$event_id.'"';
			$array = static::exec_view_query($query); 
			$i=0; 
			
			foreach($array as $value)
			{
				$new_array[$i][0] = $value[0]; $new_array[$i][1] = $value[1]; $i++;
			} 
			return $array == NULL ? $array : $new_array;
			
			
			
        }
		
		public static function view_feedback_for_event($event_id)
        {
			$query = 'SELECT DISTINCT Feedback from volunteers_registered_for_events as v where Event_id = "'.$event_id.'" and not isnull(Feedback)';
			$array = static::exec_view_query($query); 
			$i=0;
			foreach($array as $value)
			{
				$new_array[$i] = $value[0]; $i++;
			}
			return $array == NULL ? $array : $new_array;
			
		}
        
		
		public static function view_upcoming_events_table($ngo_username)
		{
			$query = 'SELECT e.*, user.Name, user.Mobile_no, v.Feedback FROM (SELECT Event_id, Name as Event_name from event where NGO_Username = "'.$ngo_username.'" and Start_date >= curdate()) as e join volunteers_registered_for_events as v JOIN user ON user.Username = v.Volunteer_Username and v.Event_id = e.Event_id';
			$op_array = static::exec_view_query($query);
			return $op_array;
		}
		
		public static function exec_view_query($query)
		{
			$output_array = array();
			$res_id = mysql_query($query);
			if($res_id!=false)
			{
				while($values = mysql_fetch_array($res_id, MYSQL_NUM))
					array_push($output_array, $values);
			}
			return $output_array;
		}
	
}
?>