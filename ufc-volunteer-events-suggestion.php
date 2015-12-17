<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php');
	require_once('includes/Volunteer.php');
?>

<?php
	//Load Session details...
	if (!$session->is_logged_in())
		session_start();
		
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
	
	$followed_ngos = Volunteer::view_followed_NGOs($user);
	$followed_event_types = Volunteer::view_followed_Event_types($user);
	$followed_events = Volunteer::view_followed_Events($user);
	
?>


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>UFC | Events suggestion</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<script>
	 $(document).ready(function(){
    $('.btn').click(function(){
        var clickBtnValue = $(this).prop('id');
	    document.getElementById($(this).prop('id')).value="Registered";
		document.getElementById($(this).prop('id')).disabled = "True";
        var ajaxurl = 'http://localhost/ufc/register_event.php',
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
							alert(output);
					   }
					}
				  ); 
    });

});

</script>
	
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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-volunteer-events-suggestion.php');">
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



		

<!--	Just replace this module	-->


<div class="profile-env">
		
	<section class="profile-feed">
		
		<h2>Suggestions List</h2>
		<br />
<form method="post" action="ufc-volunteer-suggestions-list.php" class="form-horizontal form-groups-bordered">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<b>Following NGOs</b>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>


	     <?php while($ngos=mysql_fetch_array($followed_ngos)) { 
		 
		 			$results1 = Volunteer::search_event_by_ngo($ngos["Username"],$user);
					if(mysql_num_rows($results1)>0)
					{
		 ?>		
					<div class="panel-heading">
						<div class="panel-title">
							<u><?php echo $ngos[4]?></u>
						</div>					
					</div>
					<?php 
					
					while($ngo_events=mysql_fetch_array($results1)) { 
					    $valid = Volunteer::event_volunteer_requirements($ngo_events[0],$ngo_events[9],$ngo_events[10],$ngo_events[11],$ngo_events[12],$ngo_events[15]);
				        if($valid == "true")
						    {
     				?>
					<div class="panel-body">
						<form role="form" class="form-horizontal form-groups-bordered">
							<div class="form-group">
					<table class="table table-bordered table-striped datatable" id="table-2">
						<tr>
							<td width="300px">
							
								<h4><div class="text-warning"><?php echo $ngo_events[1]?></div></h4>
								<h5><div class="text-warning">Venue : <?php echo $ngo_events[6].", ".$ngo_events[7].", ".$ngo_events[8]?></div></h5>
								<h5><div class="text-warning">The event starts on 
								      <?php
									  echo $ngo_events[2]." at ".$ngo_events[4]; 
									  if($ngo_events[3]!=NULL) 
									    echo " and it ends on ".$ngo_events[3]." at ".$ngo_events[5]; 
									  else if($ngo_events[5]!=NULL)
										echo "and the event ends at".$ngo_events[5]."."; ?>
										</div></h5>
								<h5><div class="text-warning">
									  <?php 
									    if(!($ngo_events[13]==NULL || $ngo_events[13]=='0')) 
										  { echo "It repeats after every ".$ngo_events[13]." days";} ?>
										  </div></h5>
							<h5><div class="text-warning">Event type :  <?php echo $ngo_events[14]?></div></h5>
							</td>

							<td width="180px">

							<div class="btn btn-success">
							<input id= "<?php echo $ngo_events[0]?>" type="button" style="background:transparent; border:none; width:60px; align:center"  value="Register" class="btn"/>
							</div>;
							
							</td>
					
							
							
						</tr>
						</table>

							</div>					
						</form>
					</div>
					<?php  } }?>

					
        <?php } } ?>
		
		</div>
	</div>
	
		<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<b>Following events</b>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
			<?php while($repeated_events = mysql_fetch_array($followed_events)) {
                $results2 = Volunteer::search_repetitive_events($repeated_events["Event_id"],$user);
				
				if(mysql_num_rows($results2)>0) {
				
				  while($repeated_event= mysql_fetch_array($results2)) {
				  	$valid = Volunteer::event_volunteer_requirements($repeated_event[0],$repeated_event[9],$repeated_event[10],$repeated_event[11],$repeated_event[12],$repeated_event[15]);
				  	   if($valid == "true")
						    {

				?>			
			<div class="panel-body">
					
				<form role="form" class="form-horizontal form-groups-bordered">

					<div class="form-group" >
					
					
					<table class="table table-bordered table-striped datatable" id="table-2">
						<tr>
							<td width="300px">
								<h4><div class="text-warning"><?php echo $repeated_event[1]?></div></h4>
								<h5><div class="text-warning">Venue : <?php echo $repeated_event[6].", ".$repeated_event[7].", ".$repeated_event[8]?></div></h5>
								<h5><div class="text-warning">The event starts on 
								      <?php
									  echo $repeated_event[2]." at ".$repeated_event[4]; 
									  if($repeated_event[3]!=NULL) 
									    echo " and it ends on ".$repeated_event[3]." at ".$repeated_event[5]; 
									  else if($repeated_event[5]!=NULL)
										echo " and the event ends at ".$repeated_event[5]."."; ?>
										</div></h5>
								<h5><div class="text-warning">
									  <?php 
									    if(!($repeated_event[13]==NULL || $repeated_event[13]=='0') )
										  { 
										  	echo "It repeats after every ".$repeated_event[13]." days";
										  } ?>
										  </div></h5>
							<h5><div class="text-warning">Event type : <?php echo $repeated_event[14]?></div></h5>
							<h5><div class="text-warning">Conducted by NGO : <?php echo $repeated_event[18]?></div></h5>
							</td>

							<td width="180px">

							<div class="btn btn-success">
							<input id= "<?php echo $repeated_event[0]?>" type="button" style="background:transparent; border:none; width:60px; align:center"  value="Register" class="btn"/>
							</div>;
							
							</td>
						</tr>
						</table>
					</div>
				</form>
				
			</div>
			<?php } } } } ?>
		</div>
	</div>

<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					<b>Following event-type</b>
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
     <?php while($event_type_events = mysql_fetch_array($followed_event_types)) { 
	       $results3 = Volunteer::search_event_by_event_type($event_type_events["Event_type_name"],$user);
		   		if(mysql_num_rows($results3)>0)
					{
	  
	  ?>	
			        <div class="panel-heading">
						<div class="panel-title">
							<u><?php echo $event_type_events["Event_type_name"]?></u>
						</div>					
					</div>
					<?php while($event_type_event = mysql_fetch_array($results3)) {
						$valid = Volunteer::event_volunteer_requirements($event_type_event[0],$event_type_event[9],$event_type_event[10],$event_type_event[11],$event_type_event[12],$event_type_event[15]);
				        if($valid == "true")
						    {
					?>
					<div class="panel-body">
						<form role="form" class="form-horizontal form-groups-bordered">
							<div class="form-group">
					<table class="table table-bordered table-striped datatable" id="table-2">
						<tr>
							<td width="300px">
								<h4><div class="text-warning"><?php echo $event_type_event[1]?></div></h4>
								<h5><div class="text-warning">Venue : <?php echo $event_type_event[6].", ".$event_type_event[7].", ".$event_type_event[8]?></div></h5>
								<h5><div class="text-warning">The event starts on 
								      <?php
									  echo $event_type_event[2]." at ".$event_type_event[4]; 
									  if($event_type_event[3]!=NULL) 
									    echo " and it ends on ".$event_type_event[3]." at ".$event_type_event[5]; 
									  else if($event_type_event[5]!=NULL)
										echo " and the event ends at ".$event_type_event[5]."."; ?>
										</div></h5>
								<h5><div class="text-warning">
									  <?php 
									    if(!($event_type_event[13]==NULL || $event_type_event[13]=='0')) 
										  { echo "It repeats after every ".$event_type_event[13]." days";} ?>
										  </div></h5>
								<h5><div class="text-warning">Conducted by NGO : <?php echo $event_type_event[18]?></div></h5>
							
							</td>

							<td width="180px">

							<div class="btn btn-success">
							<input id= "<?php echo $event_type_event[0]?>" type="button" style="background:transparent; border:none; width:60px; align:center"  value="Register" class="btn"/>
							</div>;
							
							</td>
					
							
							
						</tr>
						</table>
							</div>					
						</form>
					</div>
	<?php }}}}?>

       </div>
	</div>

</form>

	</section>
	<!-- Main section e here.. -->
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