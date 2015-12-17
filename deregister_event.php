
<?php
	require_once('includes/initialize.php');

	//Load Session details...
	if (!$session->is_logged_in())
		session_start();
		
		
		
	
	if( ! isset($_SESSION['User_Name']) )
		redirect_to('../login.php?msg=Please Log-in first.');
		//$user=User::find_by_id($_SESSION['User_Name']);
		//echo 

	$user = $_SESSION['User_Name'];
	


if (isset($_POST['action'])) {

       Volunteer::deregister_for_event($_POST['action'],$user);

}


?>