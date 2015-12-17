<!DOCTYPE html>
<html lang="en">
<?php 	require_once('includes/initialize.php');

if(isset(_POST['event_id']))
	$event_id = _POST['event_id'];
$event_id = '1'; ///////////// COMMENT THIS LINE WHEN INTEGRATED //////////////
$feedback_array = ngo::view_feedback_for_event($event_id);
$feedback_count = count($feedback_array);
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>Uniting for a Cause | </title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
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
				<a href="ufc-password-setting.php">
					<i class="entypo-lock"></i>
					<span>Edit Password</span>
				</a>
			</li>
			<li>
				<a href="">
					<i class="entypo-layout"></i>
					<span>Events</span>
				</a>
				<ul>
					<li>
						<a href="">
							<span>Manage Events</span>
						</a>
					<ul>
						<li>
							<a href="ufc-create-event.php">
								<span>Create Events</span>
							</a>
						</li>
						<li>
							<a href="ufc-update-events.php">
								<span>Update Events</span>
							</a>
						</li>
					</ul>
					<li>
						<a href="ufc-view-events.php">
							<span>View Events</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="ufc-view-followers.php">
					<i class="entypo-users"></i>
					<span>View Followers</span>
				</a>
			</li>
		</ul>
				
	</div>	
	<div class="main-content">
		
<div class="row">
	
	<div class="col-md-6 col-sm-8 clearfix">
	</div>
	
	</div>
<hr />




<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Feedbacks
				</div>
	
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>

			<div class="panel-body">
	
				<form role="form" id="form1" method="post" class="validate">
			
					<div class="form-group" >
<?php 
		$i=0;
		echo '
		
		<table class="table responsive">
			<tbody>';
			while($feedback_count>$i)
			{
			echo '
				<tr>
					<td>'.$feedback_array[$i].'</td>
				</tr>
			';
			$i++;
			}
			
		echo '</tbody></table>';

		
		?>					</div>
				</div>
		</div>
	</div>
		





</div>
</div>
<hr /><!-- Footer -->
<footer class="main">
	&copy; <strong>Uniting for a Cause</strong>
</footer>	</div>
	
	<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">

	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
	<script src="assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>