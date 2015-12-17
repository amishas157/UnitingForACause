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
		
$test = array();	
if(isset($_POST['submit']))
{
    if(isset($_POST['selected']))
    {
	      $parameters = ($_POST['selected']);
		  Volunteer::follow_event_type($parameters,$user);
		      echo '<script language="javascript">';
              echo 'alert("Selected event types followed")';  
              echo '</script>';
	}
    else
      {
       	      echo '<script language="javascript">';
              echo 'alert("There are no event types to follow")';  
              echo '</script>';
	  }
	


}

								    $event_types_all = array();
								$event_types_all[0] = "Agriculture";
								$event_types_all[1]	= "Animal Husbandry";
								$event_types_all[2]	= "Dairying  &  Fisheries";
								$event_types_all[3] = "Art & Culture";
								$event_types_all[4]	= "Biotechnology";
								$event_types_all[5] = "Children";
								$event_types_all[6] = "Civic Issues";
								$event_types_all[7] = "Dalit Upliftment";
								$event_types_all[8] = "Differently Abled ";
								$event_types_all[9] = "Disaster Management";
								$event_types_all[10] = "Drinking Water";
								$event_types_all[11] = "Education & Literacy";
								$event_types_all[12] = "Aged / Elderly";
								$event_types_all[13] = "Environment & Forests ";
								$event_types_all[14] = "Food Processing";
								$event_types_all[15] = "Health & Family Welfare";
								$event_types_all[16] = "HIV / AIDS";
								$event_types_all[17] = " Housing";
								$event_types_all[18] = "Human Rights";
								$event_types_all[19] = "Labour & Employment ";
								$event_types_all[20] = "Land Resources";
								$event_types_all[21] = "Legal Awareness & Aid";
								$event_types_all[22] = "Micro Finance (SHGs)";
								$event_types_all[23] = "Micro Small & Medium Enterprises";
								$event_types_all[24] = "Minority Issues";
								$event_types_all[25] = "New & Renewable Energy";
								$event_types_all[26] = "Nutrition";
								$event_types_all[27] = "Panchayati Raj";
								$event_types_all[28] = "Prisoner Issues";
								$event_types_all[29] = "Right to Information & Advocacy";
								$event_types_all[30] = "Rural Development & Poverty Alleviation Science & Technology";
								$event_types_all[31] = "Scientific & Industrial Research ";
								$event_types_all[32] = "Sports";
								$event_types_all[33] = "Tourism ";
								$event_types_all[34] = "Tribal Affairs";
								$event_types_all[35] = "Urban Development & Poverty Alleviation";
								$event_types_all[36] = "Vocational Training";
								$event_types_all[37] = "Water Resources";
								$event_types_all[38] = "Women Development & Empowerment";
								$event_types_all[39] = "Youth Affairs ";

  $unfollowed_event_types =   Volunteer::find_unfollowed_event_types($event_types_all,$user);
 
  

?>


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Search and follow event type</title>
	

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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-volunteer-search-follow-event-type.php');">
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

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-2">
			
		
			
		</div>
		
		
	</header>
	
	
	<!-- Main section starts here.. -->
	<section class="profile-feed">
		
		
<br />

<div class="panel panel-primary">

	
	

		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
					Follow Event Type
				</div>
				
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
				</div>
			</div>			

			
			
			<div class="panel-body">
				
				<form role="form" id="form" method="POST" action="ufc-volunteer-search-follow-event-type.php" class="validate">
					
					<div class="form-group">
						
						
						<div class="col-sm-7">
						<div class="form-control multi-select" >
							<select multiple="multiple" name="selected[]" type="multi-select"  size="40">
							<?php foreach($unfollowed_event_types as $event_type) { ?>
								<option style="width:400px" value="<?php echo $event_type?>" ><?php echo $event_type?></option>
						    <?php } ?>
							</select>
							</div>
						</div>
					</div><br>
					

					<br>
					<div class="col-sm-7">
						<br><br>

						<button type="submit" name="submit"  class="btn btn-success">Follow</button>
					</div>
						
				</form>
	
			</div>

	
</div>
</div>
<!-- "Add User" Ends... -->

		
		
		
	</section>
	<!-- Main section e here.. -->
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
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
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
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>
	<script src="assets/js/bootstrap-switch.min.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
</body>
</html>
