<?php
	require_once('includes/initialize.php');

	$user = $_SESSION['User_Name'];
	

if (isset($_POST['action'])) {
        echo "hello";
       $result = User::authenticate($user,$_POST['action']);
	   /*if($result != null)
	   {
	    user::change_password($user,$_POST['new_p']);
		echo "Password changed successfully";
	   }
	   else
	   echo "You have entered your current password incorrectly";*/
}
else
echo "hi";


?>