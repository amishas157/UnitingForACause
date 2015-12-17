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

	$result4 = mysql_query("SELECT * FROM volunteer WHERE Username = '".$user."' ");
	while($values4 =  mysql_fetch_array($result4))
     {
		$Email_notif_cnt = $values4["Email_notification_control"];
	 }
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Account Settings</title>
	

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
		function updateEmailnotification(id, user)
		{
			var url_to_update = "http://localhost/ufc/account-settings-ajax.php?status=";
			
			//If new state is 'Enabled'...
			if( $(id).prop('checked') === true )
				url_to_update = url_to_update + "true";
			else	//New state is 'Disabled'...
				url_to_update = url_to_update + "false";
				
			$.ajax( 
					{
					   url: url_to_update,
					   type: 'POST',
					   data : {
						id : user
						},
					   success: function(output) 
					   {
						alert(output);
					   }
					}
				  ); 
		}
	</script>
	
	</script>
	
		<script>
	 $(document).ready(function(){
    $('.btn_ngo').click(function(){
        var clickBtnValue = $(this).prop('id');
        var ajaxurl = 'http://localhost/ufc/unfollow_ngo.php',
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

</script>
	
		<script>
	 $(document).ready(function(){
    $('.btn_event_type').click(function(){
        var clickBtnValue = $(this).prop('id');
        var ajaxurl = 'http://localhost/ufc/unfollow_event_type.php',
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

</script>
	
		<script>
	 $(document).ready(function(){
    $('.btn_event').click(function(){

        var clickBtnValue = $(this).prop('id');
        var ajaxurl = 'http://localhost/ufc/unfollow_event.php',
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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-volunteer-account-settings.php');">
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
				
	</div>	<!-- Sidebar ends... -->
	
	
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
		
	<section class="profile-feed">
		
		<h2>Change account settings</h2>
		<br />

		<div class="panel-body">
			<div class="form-group" >
				<label for="field-1" class="control-label">Email_notification_control :</label>

				        <div id="label-switch" class="make-switch" data-on-label="On" data-off-label="Off" align="center">
							
											<input 
											
												type="checkbox" 
												name="is_enabled" 
												<?php echo ($Email_notif_cnt == '1') ?  'checked=""' : null ?>
												onChange="javascript:updateEmailnotification(this,'<?php echo $user?>')"
												
										    />
						</div>
			
				
						
		
						
			</div>
			<br />
		</div>



	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					List of followed NGOs
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
						
				<form role="form" class="form-horizontal form-groups-bordered">
					
	<?php			
		$result5=mysql_query("select * from volunteers_following_ngos inner join user where Volunteer_Username = '".$user."' and NGO_Username= user.Username");
			while($values = mysql_fetch_array($result5))
			{?>
			         <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo $values["Name"]?></label>
							<div class="btn btn-success">
							<input type="submit" id="<?php echo $values["Username"] ?>" action="ufc-volunteer-account-settings.php" type="button" style="background:transparent; border:none; width:80px; align:center"  value="Unfollow" class="btn_ngo"/>
							</div>
					</div>
			<?php 		 
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
					List of followed events
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
						
				<form role="form" class="form-horizontal form-groups-bordered">
				
				<?php			
		$result7=mysql_query("select * from volunteers_following_events inner join event where Volunteer_Username='".$user."' and volunteers_following_events.Event_id= event.Event_id ");
		
		while($values7 =  mysql_fetch_array($result7))
				{	
                    ?>
			        <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo $values7["Name"]?></label>

							<div class="btn btn-success">
							<input type="submit" id="<?php echo $values7["Event_id"] ?>" action="ufc-volunteer-account-settings.php" type="button" style="background:transparent; border:none; width:80px; align:center"  value="Unfollow" class="btn_event"/>
							</div>
					</div>
					<?php 
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
					List of followed event-type
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
						
				<form role="form" class="form-horizontal form-groups-bordered">
					
					
				<?php			
		$result6=mysql_query("select * from volunteers_following_event_types where Volunteer_Username='".$user."' ");
	while($values6 =  mysql_fetch_array($result6))
	{	
	             ?>
		            <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo $values6["Event_type_name"] ?></label>
							<div class="btn btn-success">
							<input type="submit" id="<?php echo $values6["Event_type_name"] ?>" action="ufc-volunteer-account-settings.php" type="button" style="background:transparent; border:none; width:80px; align:center"  value="Unfollow" class="btn_event_type"/>
							</div>
					</div>
					<?php 
	
	}
	?>				
					
				</form>
			</div>
		</div>
	</div>







	</section>
	<!-- Main section e here.. -->
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
