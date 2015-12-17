<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php');
?>

<?php
		
	if( ! isset($_SESSION['User_Name']) )
		redirect_to('../ufc/ufc-login.php?msg=Please Log-in first.');
		$user = $_SESSION['User_Name'];
		if(user::find_user_type($user) == "N")
		 {
		 redirect_to('../ufc/ufc-ngo-view-events.php');
		 }
		 else if(user::find_user_type($user) == "X")
		 {
		 redirect_to('../ufc/ufc-login.php');
		 }
?>

<?php
  $past_events = Volunteer::view_past_registered_events($user);
  $upcoming_events = Volunteer::view_upcoming_registered_events($user);
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Registered events</title>
	

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
	<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
function initialize()
{
	var $ = jQuery,
		map_canvas = $("#sample-checkin");
	
	var location = new google.maps.LatLng(36.738888, -119.783013),
		map = new google.maps.Map(map_canvas[0], {
		center: location,
		zoom: 14,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false
	});
	
	var marker = new google.maps.Marker({
		position: location,
		map: map
	});
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
	
		<script>
	 $(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).prop('id');
        var ajaxurl = 'http://localhost/ufc/deregister_event.php',
        data =  {'action': clickBtnValue};

		
					$.ajax( 
					{
					   url: ajaxurl,
					   type: 'POST',
					   data : {
						action : clickBtnValue
						},
					   success: function(output) 
					   {
						
					   }
					}
				  ); 
    });

});

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
						<a href="ufc-volunteer-password-setting.php">
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
			<li>
				<a href="volunteer-contact_admin.php">
					<i class="entypo-mail"></i>
					<span>Contact Admin</span>
				</a>
			</li>
			<li>
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-volunteer-registered-events.php');">
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
					<?php   
        					while($values =  mysql_fetch_array($past_events))
	                           {
$feedback = "window.open('http://localhost/ufc/ufc-volunteer-view-feedback.php?event-id=".$values["Event_id"]."','popUpWindow','height=300,width=400,left=10,top=10')";

	                ?>
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo $values["Name"]?></label>
						<?php $string = "window.open('http://localhost/ufc/feedback.php?id=".$values["Event_id"]."','popUpWindow','height=300,width=400,left=10,top=10')";?>
							<button  name="submit" class="btn btn-success" onclick=<?php echo $string; ?>>Provide Feedback</button>
						<?php $result = volunteer::view_feedback_accessibility($values["NGO_Username"]); 
						 if($result == "1") { 
						?>	
							<button type="submit" name="submit" class="btn btn-success"  onClick = "<?php echo $feedback ?>">View Feedback</button>
						<?php } ?>
					</div>
					<?php } ?>
								
					
				</form>
			</div>
		</div>
	</div>

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
					<?php   
        					while($values1 =  mysql_fetch_array($upcoming_events))
	                           {
							    
	                ?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo $values1["Name"]?></label>
							<!--<button type="submit" name="submit" lass="col-sm-3 control-label">Deregister</button>-->
							<div class="btn btn-success">
							<input type="submit" id="<?php echo $values1["Event_id"] ?>" action="ufc-volunteer-registered-events.php" type="button" style="background:transparent; border:none; width:80px; align:center"  value="Deregister" class="button"/>
							</div>
					</div>
					
					<?php } ?>

				</form>
			</div>
		</div>
	</div>


<hr />

<footer class="main">
	&copy; <strong>Uniting for a Cause</strong>
</footer>

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
