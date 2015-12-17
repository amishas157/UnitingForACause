<?php
	class Session
	{
		private $logged_in = false;
		public $User_Name;
		
		function __construct()
		{
			session_start();
			$this->check_login();
			
			if( $this->logged_in )
			{
				//echo '<br />Already logged in... <be />';
			}
			else
			{
				//echo '<br />NOT already logged in... <be />';
			}
		}
		
		public function is_logged_in()
		{
			return $this->logged_in;
		}
		
		public function login( $username )
		{

				$_SESSION['User_Name'] = (string)$username;
				$this->User_Name =  $_SESSION['User_Name'];
				$this->logged_in = true;
				$date = date("Y-m-d");
				mysql_query('UPDATE user set Last_access_date = "'.$date.'" WHERE Username = "'.$this->User_Name.'"');
			
		}
		
		public function logout()
		{
			unset ( $_SESSION['User_Name'] );
			unset ( $this->user_id );
			$this->logged_in = false;
		}
		
		private function check_login()
		{
			if( isset( $_SESSION['User_Name'] ) )
			{
				$this->User_Name = $_SESSION['User_Name'];
				$this->logged_in = true;
			}
			else
			{
				unset( $this->User_Name  );
				$this->logged_in = false;
			}
		}
		
	}

	$session = new Session();
	
?>