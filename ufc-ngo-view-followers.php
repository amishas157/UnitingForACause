<!DOCTYPE html>
<html lang="en">

<?php 	require_once('includes/initialize.php');
require_once('includes/user.php');

	$user = $_SESSION['User_Name'];
	if(user::find_user_type($user) == "V")
	{
		redirect_to('../ufc/ufc-volunteer-events-suggestion.php');
	}
	
	$followed_ngos = Volunteer::view_followed_NGOs($user);
	$followed_event_types = Volunteer::view_followed_Event_types($user);
	$followed_events = Volunteer::view_followed_Events($user);
	Volunteer::search_event_by_ngo("AJ999",$user);

?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>UFC | View followers</title>
	

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
<body class="page-body" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	
	<div class="sidebar-menu">
		
			
		<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="index.html">
					<img src="assets/images/logo@2x.png" width="120" alt="" />
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
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
			
			<!-- Search Bar -->
			
				
			<li class="active opened active">
				
			<li class="active">
				<a href="#">
					<i class="entypo-mail"></i>
					<span>Profile</span>
					<span class="badge badge-secondary"></span>
				</a>
			</li>
			
			<li>
				<a href="#">
					<i class="entypo-gauge"></i>
					<span>Search and follow</span>
				</a>
            	<ul>
					<li>
						<a href="#">
							<span>Events</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>Event type</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
					<li>
						<a href="#">
							<span>NGO</span>
							<span class="badge badge-secondary badge-roundless"></span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="add-user">
					<i class="entypo-user-add"></i>
					<span>Registered Events</span>
				</a>
			</li>
			<li>
				<a href="team-lls">
					<i class="entypo-users"></i>
					<span>Following</span>
				</a>
			</li>
		</li>
				
	</div>	
	<!-- Sidebar ends... -->
	
	
	<div class="main-content">
		
<div class="row">
	
	<!-- Profile Info and Notifications -->
	<div class="col-md-6 col-sm-8 clearfix">
		
		<ul class="user-info pull-left pull-none-xsm">
		
						<!-- Profile Info -->
			<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
				
			
				
				<ul class="dropdown-menu">
					
					<!-- Reverse Caret -->
					<li class="caret"></li>
					
					<!-- Profile sub-links -->
					<li>
						<a href="edit-profile">
							<i class="entypo-user"></i>
							Edit Profile
						</a>
					</li>
					
					<li>
						<a href="edit-password">
							<i class="entypo-lock"></i>
							Edit Password
						</a>
					</li>
					
					<li>
						<a href="upload-pic">
							<i class="entypo-user"></i>
							Edit Picture
						</a>
					</li>
					
					
				</ul>
			</li>
		
		</ul>
				
		
		
	</div>
	
		<div class="col-md-6 col-sm-4 clearfix hidden-xs">
			<ul class="list-inline links-list pull-right">
					
			<li class="sep"></li>
			<li>
				<a>User Name</a>
			</li>
			
			<li>
	              <a href="login.php?action=logout">Log Out </a> <i class="entypo-logout right"></i>
			</li>
		</ul>
		
	</div>
	
</div>

<hr />

<div class="profile-env">
		
	<section class="profile-feed">
		
		<h2>Suggestions list</h2>
		<br />



	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<h3>Following NGOs</h3>
				</div>
				<?php
					 while($ngos=mysql_fetch_array($followed_ngos)) { 	
				echo '<div class="panel-title">
								<label for="field-1" class="col-sm-3 control-label"> </label>
								<button type="submit" class="btn btn-success" onClick= "'.$string.'">View list of followers</button>
							</div>'; // add action= part here- to the view-list-of-volunteers page... after accordingly changing functions in that file
						}
						?>
			</div>
		</div>
	</div>





<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<h3>Event-type followers</h3>
				</div>
				<?php if($no_event_types>0) {echo '<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>';} ?>
			</div>
				
			<?php if($no_event_types>0) 
			{
				echo' <div class="panel-body"> <form role="form" class="form-horizontal form-groups-bordered">';
				$i=0; 
				while($no_event_types>$i)
				{
					$event_type = $event_types_array[$i]; 
					$string = "window.open('http://localhost/ufc/ufc-ngo-followers-details.php?fn-type=2&param=".str_replace(' ', '_', $event_type)."', 'popUpWindow','height=300,width=400,left=10,top=10')";
					echo '<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label">'.$event_type.'</label>			
								
								<button type="submit" class="btn btn-success" onClick= "'.$string.'" > View list of followers </button>
							</div>'; 
							// <a href="'.$string.'"> 
							
						$i++;					
				}
				echo '</form> </div>';
			}
			?>
	</div>
</div>

<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<h3>Event followers</h3>
				</div>
				<?php if($no_events>0) {echo '<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>';} ?>
			</div>
				
			<?php if($no_events>0) 
			{
				echo' <div class="panel-body"> <form role="form" class="form-horizontal form-groups-bordered">';
				$i=0; 
				while($no_events>$i)
				{
					$current_event = $events_array[$i][0];
					$string = "window.open('http://localhost/ufc/ufc-ngo-followers-details.php?fn-type=3&param=".$current_event."', 'popUpWindow','height=300,width=400,left=10,top=10')";
					echo '<div class="form-group">
								<label for="field-1" class="col-sm-3 control-label">'.$events_array[$i][1].'</label>
								<button type="submit" name="submit" class="btn btn-success" onClick="'.$string.'">View list of followers</button>
							</div>'; 
						$i++;					
				}
				echo '</form> </div>';
			}
			?>
	</div>
</div>





	</section>
	<!-- Main section e here.. -->
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
