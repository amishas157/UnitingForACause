<?php	
 	require_once('includes/initialize.php');
	class User
	{
		protected static $class_name = 'user';
		protected static $table_name = 'users';
		
		// Do NOT change the order...
		//protected static $db_fields = array( 'Username' , 'Email_ID' , 'Name' , 'Password' , 'Last_access_date');
		public $Username; 
		public $Email_ID; 
		public $Name;
		public $Password;
		public $Last_access_date;
		
		// log-in, log-out session code- use the username of the user from that code 
		public static function delete_account($username ,$password) {}

		public static function forgot_password($email_id) {
			$new_password = user::random_password();
			$hash = sha1($new_password);
			$query = 'UPDATE user SET password= "'.$hash.'" WHERE Email_ID = "'.$email_id.'"';
			$op = mysql_query($query); 
			$subject = "Password details";
            $body = "
			Your new password is ".$new_password."
			
			Uniting for a cause";			
			mail_send::Send_Mail($email_id,$subject,$body);
			return $op;

		}
		
		public static function redirection($user_type)
		{
			if($user_type=="V")
				redirect_to('ufc-volunteer-events-suggestion.php'); 
			else
				redirect_to('ufc-ngo-view-events.php'); 
		}
		
		private static function random_password() {
			$length = 10;
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$";
$password = substr( str_shuffle( $chars ), 0, $length );
return $password;
        }

		public static function forgot_username($email_ID) {}	
		public static function authenticate($username , $password_hash)
		{
			$query = 'SELECT * FROM user where Username="'.$username.'" and Password ="'.$password_hash.'"';
			$res_id1 = mysql_query($query);
			$user_exists = mysql_fetch_array($res_id1);
			if($user_exists)		
				{
 				  $type = user::find_user_type($username);
				     if($type == "V")
				      {
					    $result = $user_exists["Validate"];
						if($result == "1")
						   return $type;
					  }
					  else if($type == "N")
					  {
					    $result = $user_exists["Validate"];
						$query1 = mysql_query('SELECT Verified from ngo WHERE Username ="'.$username.'"');
						$result1 = mysql_fetch_array($query1);
						if($result == "1" && $result1["Verified"] =="1" )
						   return $type;
					  }
				   
				 }
			else
				return false;
		}
		
		public static function edit_details($username,$contact_no)
		{
			$user_update = ('UPDATE  user SET Mobile_no = "'.$contact_no.'"  where Username = "'.$username.'" '); 
			if(!mysql_query($user_update))
			return "Please enter unique Contact number";
			else
			return "Profile updated successfully";
		}
				
		public static function find_user_data($username)
		{
			$query = 'SELECT Name, Email_ID,Mobile_no FROM user WHERE Username = "'.$username.'"'; 
			$res_id = mysql_query($query);
			return mysql_fetch_row($res_id);
			
		}
		
		public static function check_email_existence($email)
		{
		    $query = 'SELECT * FROM user WHERE Email_ID = "'.$email.'"';
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0)
			  return "yes";
			else return "no";
		}
		
		public static function find_user_type($username)
		{
			$res_id2 = mysql_query("SELECT * FROM volunteer where Username='".$username."'");
				if(mysql_fetch_array($res_id2))
					return "V";
			$res_id3 = mysql_query("SELECT * FROM ngo where Username='".$username."'");
				if(mysql_fetch_array($res_id3))
					return "N";
			return "X";
		}
		public static function change_password($username , $password)
		{
			$result = mysql_query('UPDATE user SET Password = "'.$password.'" WHERE Username = "'.$username.'" ');
		}
		
	}
	
?>