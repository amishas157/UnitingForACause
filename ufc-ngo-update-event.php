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
		redirect_to('ufc-login.php');
	else
		$username = $_SESSION['User_Name'];
			if(user::find_user_type($username) == "V")
			{
				redirect_to('../ufc/ufc-volunteer-events-suggestion.php');
			}
			else if(user::find_user_type($username) == "X")
			{
				redirect_to('../ufc/ufc-login.php');
			}

	if(isset($_GET['event-id']) )
		{
		  $event_id = $_GET['event-id'];
		}
	else $event_id = "";
	
?>

<?php
	
	$result1 = mysql_query('SELECT * FROM event WHERE Event_id = "'.$event_id.'" and NGO_Username ="'.$username.'"');
	$values1 =  mysql_fetch_array($result1);

	$area = $values1["Location_area"];
	$city = $values1["Location_city"];
	$state = $values1["Location_state"];
	$initial_start_time = date("g:i a", strtotime($values1["Start_time"]));
	if(( $values1["End_time"] != null))
	$initial_end_time = date("g:i a", strtotime($values1["End_time"]));
	else
	$initial_end_time = "";

	$volunteer= $values1["Volunteer_Capacity"]; 
	if($volunteer == "NULL")
	$volunteer = "";
	$repetition= $values1["Repetition_details"]; 
	if($repetition == "NULL")
	$repetition = "";
	$location = $area.", ".$city.", ".$state.", India";

	

?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Update Event</title>
	

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

<?php
			if(isset($_POST["submit"]))
			{
				$s_t = $_POST["start_time"];
				$e_t = $_POST["end_time"]; 
				$start_time = date("H:i", strtotime($s_t)); 
				$end_time = date("H:i", strtotime($e_t));
				$event_id = $_GET["event-id"];
				$result = ngo::if_one_day_event($event_id);
				
				if($end_time < $start_time && $result == "1" )
				{
				echo '<script language="javascript">';
              echo 'alert("Start time should be less than end time.")';  
              echo '</script>';
				}
				else
				{
				$result = mysql_query('SELECT Location_city,Location_state FROM event WHERE Event_id = "'.$event_id.'"');
				$value = mysql_fetch_array($result);
				if($_POST["volunteers"] == "")
				$volunteer = "NULL";
				else
				$volunteer = $_POST["volunteers"];
				$repetition = $_POST["repetition"];
				$location = trim($_POST["location"]);
                $tokens = split ("\,", $location);
				$size = sizeof($tokens);
				$place ="";
				
				if($repetition == "")
				$repetition ="NULL";
				
				if($size > 3)
				{
						$tokens1 = split ("\ ", $tokens[$size-2]);
		if(sizeof($tokens1)>1)
		$place1= $tokens1[1];
		else
		$place1= $tokens[$size-2];

		$tokens2 = split ("\ ", $tokens[$size-3]);
		if(sizeof($tokens2)>1)
		$place2= $tokens2[1];
		else
		$place2= $tokens[$size-3];
				
				 if(($place1 == $value["Location_state"] ) && ( $place2 == $value["Location_city"]))
				  {
				 $count = 0;
				while($size!=3)
				    {
		              $place .=	$tokens[$count];
                      $count++;
                      $size--;					  
				    }

					Ngo::update_event($event_id,$start_time,$end_time, $place,$repetition, $volunteer);
			  echo '<script language="javascript">';
              echo 'alert("Event updated successfully.")';  
              echo '</script>';
				  }
				  else
				   {
			 echo '<script language="javascript">';
              echo 'alert("The city and state of event cannot be changed.")';  
              echo '</script>';   
				   }
				}
				else
				 {
			  echo '<script language="javascript">';
              echo 'alert("Please enter area , city and state in event venue.")';  
              echo '</script>';
				 }
			}
			    
			}


	if(isset($_POST["delete"]))
	{
		ngo::delete_event($event_id);
		redirect_to('ufc-ngo-view-events.php');
	}
?>
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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-ngo-update-event.php');">
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


<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-2">
			
		
			
		</div>
		
		
	</header>
	
	
	<!-- Main section starts here.. -->
	<section class="profile-feed">
		
		<h2>Update Event</h2>
<br />

<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">Enter Event Details</div>
		
	</div>
	
	<div class="panel-body">
	
		<form role="form" id="form1" method="post" class="validate">
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Location :</label>
				<br />
				<div class="col-sm-5">
					<input type="text" class="form-control typehead" name="location" value = "<?php echo $location;?>" id="location" onclick="suggest()" placeholder="Location" required/>
				</div>
			</div><br><br><br>


			<div class="form-group">
						<label class="col-sm-3 control-label">Time of event</label>
						
						<div class="col-sm-2">
							<input type="text" class="form-control timepicker" name = "start_time" value ="<?php echo $initial_start_time;?>" use24hrs="true"  data-minute-step="5" />
						</div>
						
						<div class="col-sm-2">
							<input type="text" class="form-control timepicker" name = "end_time" value ="<?php if($initial_end_time != "") echo $initial_end_time;?>" use24hrs="true" data-minute-step="5" />
						</div>
					</div><br><br><br>
 

			<div class="form-group">
						<label class="col-sm-3 control-label">Maximum number of volunteers required: </label>
							<div class="col-sm-5">
								<div class="input-spinner">
									<button type="button" class="btn btn-default">-</button>
									<input type="text" name = "volunteers" value="<?php echo $volunteer;?>" min="1"  class="form-control size-1" value="1" />
									<button type="button" class="btn btn-default">+</button>
								</div>
							</div>
			</div><br><br><br>

			
			<div class="form-group">
						<label class="col-sm-3 control-label">Repetition details: </label>
							<div class="col-sm-5">
								<div class="input-spinner">
									<button type="button" class="btn btn-default">-</button>
									<input type="text" name = "repetition" value="<?php echo $repetition;?>" max="364" min="3" class="form-control size-1" value="1" />
									<button type="button" class="btn btn-default">+</button>
								</div>
							</div>
			</div><br><br><br>
		
					
		
			<br>
			<div class="form-group">
					<button type="submit" name="submit" class="btn btn-success">Update Event</button>
			</div>
			<br>
			<div class="form-group">
					<button type="submit" name="delete" class="btn btn-success">Delete Event</button>
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
