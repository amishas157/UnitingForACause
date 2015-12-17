<?php

   //Change these constants as per operating system and the deployed server
	defined('DS') ? null : define('DS' , DIRECTORY_SEPARATOR );
	
	defined('SITE_ROOT') ? null :
		define('SITE_ROOT' , 'C:' . DS . DS.'xampp' . DS . 'htdocs' . DS . 'ufc');
	
	defined('LIB_PATH') ? null :
		define('LIB_PATH' , SITE_ROOT.DS.'includes' );
	
	defined('SITE_NAME') ? null :
		define('SITE_NAME' , 'UFC' );
		
	defined('FOOTER') ? null :
		define('FOOTER' , '&copy 2015. Uniting for a cause' );
	
	
	require_once( LIB_PATH.DS.'mysqldatabase.php' );
	require_once( LIB_PATH.DS.'user.php' );
	require_once( LIB_PATH.DS.'Volunteer.php' );
	require_once( LIB_PATH.DS.'Session.php' );
	require_once( LIB_PATH.DS.'functions.php' );
	require_once( LIB_PATH.DS.'sign-up-mail.php');

	
	


	/*
	// Not to display Generic Error/Warnigs...
	// Do NOT uncomment this before hosting...
	
	error_reporting(E_ALL); 
	ini_set('log_errors','1'); 
	ini_set('display_errors','0'); 
	*/
	


?>
