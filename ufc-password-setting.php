<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php');
?>

<?php
	//Load Session details...
	if (!$session->is_logged_in())
		session_start();
		
	if( ! isset($_SESSION['User_Name']) )
		redirect_to('../ufc/ufc-login.php?msg=Please Log-in first.');
		$user = $_SESSION['User_Name'];
?>

<?php if( isset( $_POST['change'] ) )
	{
		$current_password = trim( $_POST['current_password'] );
		$new_password = trim( $_POST['new_password'] );
		$confirm_new_password = trim( $_POST['confirm_new_password'] );

			
		$result = user::authenticate( $user , $current_password );

		if($result)
		{  
		    if($new_password==$confirm_new_password)
			{ 
				 if(strlen($new_password) <=8 || strlen(password.length) >=14)
				  {
				       echo '<script> alert("Password length must be 8-14 characters");</script>';
				  }
				  else
				  {
			
			user::change_password($user, $new_password);
			echo "<script>alert('Password changed successfully');</script>";}
			}
			else
		    echo "<script>alert('Password do not match');</script>";
		}
        else
		echo "<script>alert('You have entered your current password incorrectly');</script>";
			
		//If not redirected yet, the user has entered incorrect credentials...		

	}
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>Uniting for a cause | Change password</title>
	

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>


	</script>

<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>
<script>
		function change_password()
		{       
			var current_password = CryptoJS.SHA1(document.getElementById("current_password").value);
			document.getElementById("current_password").value = current_password;
						
			var new_password = CryptoJS.SHA1(document.getElementById("new_password").value);
			document.getElementById("new_password").value = new_password;
			
			var confirm_new_password = CryptoJS.SHA1(document.getElementById("confirm_new_password").value);
			document.getElementById("confirm_new_password").value = confirm_new_password;
		}
</script>
</head>


<body class="page-body" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	
	<div class="sidebar-menu">
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="">
					<img src="assets/images/final-logo.png" width="120" alt="" />
				</a>
			</div>
			
			<!-- logo collapse icon -->
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
					
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
				
		<ul id="main-menu" class="">
			<li>
				<a href="">
					<i class="entypo-user"></i>
					<span>Profile</span>
				</a>
				<ul>
					<li>
						<a href="ufc-volunteer-profile.php">
							<span>Edit Profile</span>
						</a>
					</li>
					<li>
						<a href="ufc-volunteer-account-settings.php">
							<span>Account Settings</span>
						</a>
					</li>
					<li>
						<a href="ufc-password-setting.php">
							<span>Password Settings</span>
						</a>
					</li>
				</ul>
			<li>
				<a href="">
					<i class="entypo-search"></i>
					<span>Search and Follow</span>
				</a>
				<ul>
					<li>
						<a href="ufc-volunteer-search-follow-event.php">
							<span>Event</span>
						</a>
					</li>
					<li>
						<a href="ufc-volunteer-search-follow-event-type.php">
							<span>Event Type</span>
						</a>
					</li>
					<li>
						<a href="ufc-volunteer-search-follow-ngo.php">
							<span>NGO</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="ufc-volunteer-registered-events.php">
					<i class="entypo-layout"></i>
					<span>Registered Events</span>
				</a>
			</li>
			<li>
				<a href="ufc-volunteer-events-suggestion.php">
					<i class="entypo-list"></i>
					<span>Event Suggestion</span>
				</a>
			</li>
		</ul>
				
	</div>	

	
	<!-- Sidebar ends... -->
	
	
	<div class="main-content">
		<div class="row">
			<div class="col-md-6 col-sm-8 clearfix">
			</div>
	
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">
				<ul class="list-inline links-list pull-right">
					<li class="sep"></li>
					<li>
						<a href="#" data-animate="1" data-collapse-sidebar="1">
						<i class="entypo-user"></i>
						<?php
							echo $user;
						?>
						</a>
					</li>
					<li class="sep"></li>
					<li>
						<a href="ufc-login.php?action=logout">
						Log Out <i class="entypo-logout right"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
     <hr />
		
		



<div class="profile-env">
	

	
	<!-- Main section starts here.. -->
	<section class="profile-feed">
		
		<h2>Change password</h2>
    <br />

<div class="panel panel-primary">

	<div class="panel-body">
	
		<form role="form" name="form" id="form" method="post" class="validate">
			<input type="hidden" name="myForm">
			<div class="form-group" >
				<label for="field-1" class="control-label">Enter Current Password :</label>
				<br>
				<div class="col-sm-5">
				<input type="password" class="form-control"  name="current_password" id="current_password" required  autocomplete="off" placeholder="current_password" />
				</div>
			</div><br><br>
		
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Enter New Password :</label>
				<br>
				<div class="col-sm-5">
				<input type="password" class="form-control"  name="new_password" id="new_password" autocomplete="off" placeholder="enter_new_password" required />  
				</div>
			</div><br><br>
		
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Re-enter New Password :</label>
				<br>
				<div class="col-sm-5">
				<input type="password" class="form-control"  name="confirm_new_password" id="confirm_new_password" autocomplete="off" placeholder="re_enter_new_password" required />  
				</div>
			</div><br><br>
			
			
			<div class="form-group">
				<!--	<button type="submit" name="submit" onclick="check()" class="btn btn-success">Change password</button>	-->
					<input type="submit" id="change" name="change" onClick="return change_password();" value="Change password" class="btn btn-success">
					<input type="reset" value="Reset" class="btn btn-success">
			</div>
						
		</form>
	
	</div>

	
</div>





		
<!-- Footer -->
	</div>

<hr />
<footer class="main">
	&copy; <strong>Uniting for a Cause</strong>
</footer>	
</div>
</div>


	<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="assets/js/select2/select2.css">
	<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">
	<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
	<link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">


	<!-- Bottom Scripts -->
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/select2/select2.min.js"></script>
	<script src="assets/js/bootstrap-tagsinput.min.js"></script>
	<script src="assets/js/typeahead.min.js"></script>
	<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/js/daterangepicker/moment.min.js"></script>
	<script src="assets/js/daterangepicker/daterangepicker.js"></script>
	<script src="assets/js/jquery.multi-select.js"></script>
	<script src="assets/js/icheck/icheck.min.js"></script>
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>
</body>
</html>
