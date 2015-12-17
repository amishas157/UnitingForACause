<!DOCTYPE html>
<html lang="en">
<?php 	require_once('includes/initialize.php');
require_once('includes/user.php');
require_once( 'includes/Session.php' );
	require_once('includes/functions.php');
	require_once('includes/mysqldatabase.php' );
	require_once('includes/ngo.php');

			//Load Session details...
	if (!$session->is_logged_in())
			session_start();
	
	if( ! isset($_SESSION['User_Name']) )
		redirect_to('ufc-login.php');
	else
		$username = $_SESSION['User_Name'];
		if(user::find_user_type($username) == "V")
		{
			redirect_to('../ufc/ufc-volunteer-events-suggestion.php');
		}
	
$upcoming_events_array = ngo::view_upcoming_events($username);
$no_upcoming_events = count($upcoming_events_array);
$past_events_array = ngo::view_past_events($username);
$no_past_events = count($past_events_array);

?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	

	<title>UFC | View Events</title>
	

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	
</head>
<body class="page-body" data-url="">
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
				<a href="ufc-ngo-profile.php">
					<i class="entypo-user"></i>
					<span>Edit Profile</span>
				</a>
			</li>
			<li>
				<a href="ufc-ngo-password-setting.php">
					<i class="entypo-lock"></i>
					<span>Change Password</span>
				</a>
			</li>
			<li>
				<a href="">
					<i class="entypo-layout"></i>
					<span>Manage Events</span>
				</a>
				<ul>
						<li>
							<a href="ufc-ngo-create-event.php">
								<span>Create Event</span>
							</a>
						</li>
						<li>
							<a href="ufc-ngo-view-events.php">
								<span>Update Events</span>
							</a>
						</li>
				</ul>
			</li>
			<li>
				<a href="ufc-ngo-volunteers-and-feedback.php">
					<i class="entypo-user-add"></i>
					<span>Volunteers and Feedback</span>
				</a>
			</li>
			<li>
				<a href="ufc-ngo-followers.php">
					<i class="entypo-users"></i>
					<span>Followers</span>
				</a>
			</li>
			<li>
				<a href="ngo-contact_admin.php">
					<i class="entypo-mail"></i>
					<span>Contact Admin</span>
				</a>
			</li>
			<li>
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-ngo-volunteers-and-feedback.php');">
					<script type="text/javascript">
						function newPopup(url)
						{
							popUpWindow = window.open(url, 'popupWindow', 'height=400, width=500')
						}
						</script>
					<i class="entypo-help"></i>
					<span>Know more about this page</span>
				</a>
			</li>						
		</ul>
				
	</div>	
	
	
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
							echo $username;
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


<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					View Upcoming Events
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
						
				<form role="form" class="form-horizontal form-groups-bordered">
					<?php $i=0;
					while($no_upcoming_events>$i)
					{
					$string = "window.open('http://localhost/ufc/ufc-ngo-volunteers-details.php?event-id=".$upcoming_events_array[$i][0]."','popUpWindow','height=500,width=600,left=10,top=10')";
						echo '<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">'.$upcoming_events_array[$i][1].'</label>
						<button type="submit" id="volunteers-upcoming-'.$upcoming_events_array[$i][0].'" onClick = "'.$string.'" class="btn btn-success" >List of Volunteers</button>
					</div>';
					$i++;
					}
					?>
					
				</form>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					View Past events
				</div>
	
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
	
			<div class="panel-body">
						
				<form role="form" class="form-horizontal form-groups-bordered">
					<?php $i=0;
					while($no_past_events>$i)
					{
					$volunteers = "window.open('http://localhost/ufc/ufc-ngo-volunteers-details.php?event-id=".$past_events_array[$i][0]."','popUpWindow','height=500,width=600,left=10,top=10')";
					$feedback = "window.open('http://localhost/ufc/ufc-ngo-view-feedback.php?event-id=".$past_events_array[$i][0]."','popUpWindow','height=500,width=600,left=10,top=10')";
					
						echo '<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label">'.$past_events_array[$i][1].'</label>
						<button type="submit" id="volunteers-past-'.$past_events_array[$i][0].'" class="btn btn-success" onClick = "'.$volunteers.'">List of Volunteers</button>
						<button type="submit" id="feedback-'.$past_events_array[$i][0].'" class="btn btn-success" onClick = "'.$feedback.'" >View Feedback</button>
					</div>';
					$i++;
					}
					?>
					
				</form>
			</div>
		</div>
	</div>

	








	</section>
	<hr/>
	<footer class="main">
	&copy; <strong>Uniting for a Cause</strong>
</footer>
	<!-- Main section e here.. -->
</div>
</div>



	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/bootstrap-switch.min.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>
</body>
</html>
