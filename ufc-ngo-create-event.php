<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php');

?>

<?php

	
	if( ! isset($_SESSION['User_Name']) )
		redirect_to('../login.php?msg=Please Log-in first.');

	$user = $_SESSION['User_Name'];
			if(user::find_user_type($user) == "V")
			{
				redirect_to('../ufc/ufc-volunteer-events-suggestion.php');
			}
			else if(user::find_user_type($user) == "X")
			{
				redirect_to('../ufc/ufc-login.php');
			}
	 if(isset($_POST['create']))
	 {
	 	$location = $_POST["location"];
	 	$tokens = split ("\,", $location);
		$size = sizeof($tokens);
		 
		 if($size < 4)
		  {
		     echo '<script language="javascript">';
             echo 'alert("Please enter area, city and state in event venue field. ")';  
             echo '</script>';
		  }
		  else
		  {
			$count = 0;
			$area = "";
			$city = "";

		while($count< $size-3)
		  {
	  	   $area .= $tokens[$count];		   
		   $count++;
		   if($count != ($size -3))
		   $area .=", ";
		  }

		  
		$tokens2 = split ("\ ", $tokens[$size-3]);
		if(sizeof($tokens2)>1)
		$city = $tokens2[1];
		else
		$city= $tokens[$size-3];

		$tokens3 = split ("\ ", $tokens[$size-2]);
		if(sizeof($tokens3)>1)
		$state= $tokens3[1];
		else
		$state= $tokens[$size-2];
		  


				
				
				
		$HQ_Area = $area; $HQ_City = $city; $HQ_State = $state;
	 
	 
		$end_date = null;
		$end_time = null;
		$gender = null;
		$repeat = null;
	 	$name = $_POST["name_of_event"];
	 	$type = $_POST["event_type"];
	 	$date_time = $_POST["date_time"];
		$token_date_time = split (" - ", $date_time);
		$start = split(" ",$token_date_time[0]);
		$end = split(" ",$token_date_time[1]);
		$start_date = $start[0];
		$s_t = $start[1]." ".$start[2];
		$end_date = $end[0];
		$e_t = $end[1]." ".$end[2];
		$start_time = date("H:i", strtotime($s_t)); 
		$end_time = date("H:i", strtotime($e_t));
		if($_POST["max_vol_cap"] != "")
	 	$max_vol_cap = $_POST["max_vol_cap"];
		else
		$max_vol_cap = "Null";
		if($_POST["min_age"] != "")
	 	$min_age=$_POST["min_age"];
		else $min_age = "NULL";
		
		if($_POST["max_age"] != "")
	 	$max_age=$_POST["max_age"];
		else
		$max_age = "NULL";
		
		if(isset($_POST['my-select1']))
		$profession = ($_POST['my-select1']);
		else
		$profession = null;
		$gender = $_POST['gender'];
		if($gender == "Male")
		$gender = "M";
		else if($gender == "Female")
		$gender = "F";
		
		if($_POST["repeat"] != "")
	 	$repeat=$_POST["repeat"];
		else $repeat = "NULL";
   	
		$output = ngo::create_event($name, $type, $user, $start_date,  $start_time, $area, $city, $state, $end_date, $end_time, $repeat, $max_vol_cap, $gender, $max_age, $min_age, $profession);
echo '<script language="javascript">';
              echo 'alert("'.$output.'")';  
              echo '</script>';
		 }
		 }

		 						 $professions = array();
								$professions[0] = " professor";
								$professions[1]	= "teacher";
								$professions[2]	= "dentist";
								$professions[3] = "midwives";
								$professions[4]	= "nurses";
								$professions[5] = "therapist";
								$professions[6] = "pathologist";
								$professions[7] = "pharmacists";
								$professions[8] = "physicians";
								$professions[9] = "psychologists";
								$professions[10] = "surgeons";
								$professions[11] = "veterinarians";
								$professions[12] = "accountants";
								$professions[13] = "agriculturists";
								$professions[14] = "architects";
								$professions[15] = "economists";
								$professions[16] = "lawyers";
								$professions[17] = "engineers";
								$professions[18] = "librarians";
								$professions[19] = "military officer";
								$professions[20] = "police officer";
								$professions[21] = "social worker";
								$professions[22] = "chemist";


?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Create Event</title>
	

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
	
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
	   <script>
	   function suggest()
	   {
      var input = /** @type {HTMLInputElement} */(
      document.getElementById('location'));
	   var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));
	   }
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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-ngo-create-event.php');">
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

	
	<!-- Main section starts here.. -->
	<section class="profile-feed">
		
		<h2>Create Event</h2>
<br />

<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">Enter Event Details</div>
		
	</div>
	
	<div class="panel-body">
	
		<form id="form1" action="ufc-ngo-create-event.php" method="post">
			
			<div class="form-group" >
				<label for="field-1" class="control-label"> Name of event :</label>
				<br />
				<div class="col-sm-5">
					<input type="text" class="form-control"  name="name_of_event" id="name_of_event" placeholder="Name of event" required/>
				</div>
			</div><br><br><br>
		
		<?php $event_type_list = ngo::get_event_types($user); ?>	
			<div class="form-group" >
				<label for="field-1" class="control-label">Event type :</label>
				<br />
				<div class="col-md-3">
							<select class="form-control" onblur="myfunction3()" id="type" name = "event_type" placeholder="Select event type">
							<option>Select Category</option>
							<?php foreach($event_type_list as $event_type) { ?>
							<option><?php echo $event_type; ?></option>
							<?php }?>
							</select>
				</div>
			</div><br><br>
			<script>
	function myfunction3()
				{
					var type = document.getElementById("type").value;
					if(type == "Select Category")
					alert("Please select category of event type");
				}
				
			</script>
		
			
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Location :</label>
				<br />
				<div class="col-sm-5">
					<input type="text" class="form-control typehead" name="location" id="location" onclick="suggest()" placeholder="Location" required/>
				</div>
			</div><br><br><br>
		
				
			<div class="form-group">
						<label class="col-sm-3 control-label">Date and Time for event :</label>
							<div class="col-sm-5">
								<input type="text" class="form-control daterange" name = "date_time" data-time-picker="true" data-time-picker-increment="5" data-format="YYYY/MM/DD h:mm A"  required />
							</div>
			</div><br><br><br>


			<div class="form-group">
						<label class="col-sm-3 control-label">Maximum number of volunteers required :</label>
							<div class="col-sm-5">
								<div class="input-spinner">
									<button type="button" class="btn btn-default">-</button>
									<input type="number" name = "max_vol_cap" class="form-control size-1"  min = "1" onblur = "myfunction2()" />
									<button type="button" class="btn btn-default">+</button>
								</div>
							</div>
			</div><br><br><br>
			
			<script>
	function myfunction2()
				{
					var value = document.getElementByName("max_vol_cap").value;
					if(value == "")
						value="NULL";
				}
				
			</script>
			

			


			<div class="form-group" >
				<label for="field-1" class="control-label">Volunteer minimum age :</label>
				<br />
				<div class="col-sm-5">
					<input type="number" class="form-control" name="min_age" id="min_age" min="12" onblur = "myfunction()" placeholder="Volunteer minimum age" />
				</div>
			</div><br><br>
			<script>
				function myfunction()
				{
					var min = document.getElementById("min_age").value;
					document.getElementById("max_age").value = min;
				}

			</script>
		
		
			<div class="form-group" >
				<label for="field-1" class="control-label">Volunteer maximum age :</label>
				<br />
				<div class="col-sm-5">
					<input type="number" class="form-control" name="max_age" id="max_age" max="100" onblur = "myfunction1()" placeholder="Volunteer maximum age" />
				</div>
			</div><br><br><br>	

<script>
	function myfunction1()
				{
					var max = document.getElementById("max_age").value;
					var min = document.getElementById("min_age").value;
					if(max<min)
					{
					    alert("Max age cannot be less than Min age");
						document.getElementById("max_age").value = min;
					}
				}
				
			</script>

				<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-title">
					Profession
				</div>
				
		
			<div class="panel-body">
					<div class="form-group">
				
						<div class="col-sm-7">
							<select multiple="multiple" name="my-select1[]" class="form-control multi-select" size="25"> 
							<?php foreach($professions as $profession) { ?>
								<option style="width:400px" value="<?php echo $profession?>" ><?php echo $profession?></option>
						    <?php } ?>
							</select>
						</div>
					</div>
			</div>
		</div>
	<br>



		
		
			<div class="form-group" >
				<label for="field-1" class="control-label">Gender Requirement :</label>
				<br />
				<div class="col-md-2">
							<select class="form-control" name = "gender" placeholder="Select event type">
							<option>Both</option>
							<option>Male</option>
							<option>Female</option>
							</select>
				</div>
			</div>
		<br><br>


			<div class="form-group">
						<label class="control-label">Repetition Details :</label><br>
						<div class="col-md-2">	
								<div class="input-spinner">
									<button type="button" class="btn btn-default">-</button>
									<input type="number" name = "repeat" class="form-control size-1" max="364" min="3" />
									<button type="button" class="btn btn-default">+</button>
								</div>
						</div>	
			</div><br>
	
		
			
		
			<br>
			<div class="form-group">
					<button type="submit" name="create" class="btn btn-success">Create Event </button>
			</div>
					
		</form>
	
	</div>

	
</div>
<!-- "Add User" Ends... -->

		
		
		
	</section>
	<hr/>
	<footer class="main">
	&copy; <strong>Uniting for a Cause</strong>
</footer>
	<!-- Main section e here.. -->
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
