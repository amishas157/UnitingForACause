<?php
	require_once('includes/initialize.php');		
	$user = $_SESSION['User_Name'];
    if (isset($_POST['action']))
 {
             $output = mysql_query('SELECT Password FROM user WHERE Username = "'.$user.'"');
		 $value= mysql_fetch_array($output);
		
        if(sha1($_POST['action']) == $value["Password"])
	 	 {
			session_destroy();
			//redirect_to('ufc-login.php');
		     mysql_query("DELETE FROM user WHERE Username = '".$user."'");
			 echo "Account deleted successfully";

		 }
		 else
		 {
		   echo "Password entered is not correct";
		 }
		

}


?>