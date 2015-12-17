<?php
	require_once('includes/initialize.php');
	
	if( !isset($_GET['status']) )
		return;
		
	if( $_GET['status'] == 'true' )
		enable_survey( $_POST['id'] );
	
	if( $_GET['status'] == 'false')
		disable_survey( $_POST['id'] );


	function enable_survey( $user )
	{ 
		
	$query1=mysql_query("UPDATE volunteer SET Email_notification_control = 1 WHERE Username = '".$user."'");

		echo "Email notifications are set ON...";
	}
	
	
	function disable_survey( $user )
	{
	
	$query1=mysql_query("UPDATE volunteer SET Email_notification_control = 0 WHERE Username = '".$user."'");
	
		echo "Email notifications are set OFF...";
	}

?>