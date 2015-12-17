<!DOCTYPE html>
<html lang="en">
<?php
	require_once('includes/initialize.php');
	require_once('includes/ngo.php');
	require_once('includes/user.php');
?>

<?php

	if( ! isset($_SESSION['User_Name']) )
		redirect_to('ufc-login.php');

			$username = $_SESSION['User_Name'];	
			if(user::find_user_type($username) == "V")
			{
				redirect_to('../ufc/ufc-volunteer-events-suggestion.php');
			}
			else if(user::find_user_type($username) == "X")
			{
				redirect_to('../ufc/ufc-login.php');
			}
							
								    $event_types_all = array();
								$event_types_all[0] = "Agriculture";
								$event_types_all[1]	= "Animal Husbandry";
								$event_types_all[2]	= "Dairying & Fisheries";
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
								$event_type_array = ngo::get_event_types($username);
								if($event_type_array != null)
								 $diff_array = array_diff($event_types_all, $event_type_array);
								 else
								 $diff_array = $event_types_all;

		
	
	
	
if(isset($_POST['submit']))
	 {
	 	// DO THE SPLITTING HERE ............
		$contact_no = $_POST["Contact_no"];
		$location = trim($_POST["Headquarter_Location"]);
		$tokens = split ("\,", $location);
		$size = sizeof($tokens);
		 
		 if($size < 4)
		  {
		     echo '<script language="javascript">';
             echo 'alert("Please enter area, city and state in headquarter address.")';  
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
	 	$website_url = $_POST["Website_URL"];
	 	$contact_no = $_POST["Contact_no"];
	 	$description = $_POST["Description"];
	 	$head = $_POST["NGO_Head"];
		$email_id = $_POST["Email-ID"];
		
		if(isset($_POST["is_enabled"]))
		$feedback_accessibility_status = "1";
		else 
		$feedback_accessibility_status = "0";
		
		if(isset($_POST['my-select']))
		$parameters = ($_POST['my-select']);
		else
		$parameters = null;
		
		
		$output = ngo::edit_details($username, $HQ_State, $HQ_City, $HQ_Area, $head, $website_url, $feedback_accessibility_status, $description);
		if($output == "Profile updated successfully.")
		{
        $output1 = user::edit_details($username,$contact_no);
		if($output1 == "Profile updated successfully")
		{
		 $event_type_array = ngo::get_event_types($username);
		 if($parameters != null)
		 {
			 if($event_type_array != null)
			 {
		 $diff_array = array_diff($event_type_array,$parameters);
		 ngo::set_event_types($username,$diff_array,$parameters);
			 }
			 else
			 {
				 ngo::set_event_types($username,null,$parameters);
			 }
		}
		 }	
		 else
		 {
			   ngo::delete_all_event_types($username);
		 }
		 
		 	  echo '<script language="javascript">';
              echo 'alert("'.$output1.'")';  
              echo '</script>';
		 }
		 else
		 {
		 	  echo '<script language="javascript">';
              echo 'alert("'.$output.'")';  
              echo '</script>';
		 }
			}
		
	 }
?>

<?php
	$user_data = user::find_user_data($username);
	$name = $user_data[0];
	$email_id = $user_data[1];
	$contact = $user_data[2];
	
	$ngo_data= ngo::get_ngo_data($username);
	
	 $area =  $ngo_data[1];
	 $city = $ngo_data[2];
	 $state = $ngo_data[3];
	 $registration_no = $ngo_data[5];
	 $head = $ngo_data[6];
	 $url = $ngo_data[4];
	 $description = $ngo_data[7];
	 $feedback = $ngo_data[8];
	 
	 $location = $area.', '.$city.' ,'.$state.', India' ;	 
	 
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | NGO Profile</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
	   <script>
	   function suggest()
	   {
      var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-ngo-profile.php');">
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





	<!-- Main section starts here.. -->
	<section class="profile-feed">
		
		<h2>Edit your profile</h2>
<br />

<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">Enter Details</div>
		
	</div>
	
	<div class="panel-body">
	
		<form action="ufc-ngo-profile.php" method="post">
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Name :</label>
				<br />
				<div class="col-sm-5">
					<input type="text" maxlength="40" class="form-control"  name="Name" value = "<?php echo $name; ?>" readonly />
				</div>
			</div><br><br><br>
		
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Username :</label>
				<br />
				<div class="col-sm-5">
				<input type="text" class="form-control" maxlength="30"  name="Username" value = "<?php echo $username; ?>"readonly />  
				</div>
			</div><br><br><br>
		
			
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Email-ID :</label>
				<br />
				<div class="col-sm-5">
					<input type="email" class="form-control" maxlength="50" name="Email-ID" value = "<?php echo $email_id; ?>" readonly />
				</div>
			</div><br><br><br>
		
		<div class="form-group" >
				<label for="field-1" class="control-label">Registration Number :</label>
				<br />
				<div class="col-sm-5">
					<input type="text" class="form-control" maxlength="30" id = "Registration_no" value = "<?php echo $registration_no; ?>" readonly />
				</div>
			</div><br><br><br>
				
			<div class="form-group" >
				<label for="field-1" class="control-label">Headquarter Location :</label>
				<br />
				<div class="col-sm-5">
				<input type="text" id="pac-input" maxlength="300" class="form-control typehead" name="Headquarter_Location" value = "<?php echo $location; ?>" onclick="suggest()" data-validate="required" data-message-required="This field is required" required />
				</div>
			</div><br><br><br>
			
			<div class="form-group" >
				<label for="field-1" class="control-label">NGO Head :</label>
				<br />
				<div class="col-sm-5">
				<input type="text" class="form-control" maxlength="40" name="NGO_Head" value = "<?php echo $head; ?>" data-validate="required" data-message-required="This field is required." required />
				</div>
			</div><br><br><br>
		
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Contact_no :</label>
				<br />
				<div class="col-sm-5">
				<input type="text" class="form-control" maxlength="10" onblur="contact_check()" id="Contact_no" name="Contact_no" value = "<?php echo $contact; ?>" data-validate="required" data-message-required="This field is required" required />
				</div>
			</div><br><br><br>
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Website URL :</label>
				<br />
				<div class="col-sm-5">
				<input type="url" class="form-control" maxlength="100" name ="Website_URL" value = "<?php echo $url; ?>"/>
				</div>
			</div><br><br><br>
			
				
			<div class="form-group" >
				<label for="field-1" class="control-label">Description :</label>
				<br>
				<div class="col-sm-5">
				<input type="text" class="form-control" maxlength="150" name="Description" value = "<?php echo $description; ?>" data-validate="required" data-message-required="This field is required." required />
				</div>
			</div><br><br><br>
			
		
			<div class="form-group">
				<label for="field-1" name ="Feedback_accessibility_status" class="control-label">Feedback accessibility status :</label>
				

			
				<div id="label-switch" class="make-switch" data-on-label="Public" data-off-label="Private" align="center">
							<input type="checkbox" name="is_enabled" <?php if($feedback == 1) echo 'checked'?> />
						</div>

						
			</div><br><br>
		
			

			<div class="panel-heading">
				<div class="panel-title">
					List of event types
				</div>
			</div>
			
			<div class="panel-body">
							
					<div class="form-group">
						<label class="col-sm-3 control-label">Select the list of event types</label>
						
						<div class="col-sm-7">
							<select multiple="multiple" name="my-select[]" class="form-control multi-select" size="40">
						
							<?php foreach($diff_array as $event_type) { ?>
								<option style="width:400px" value="<?php echo $event_type?>" ><?php echo $event_type?></option>
						    <?php }  if($event_type_array != null) {
							     foreach($event_type_array as $event_type) { ?>
								<option style="width:400px" value="<?php echo $event_type?>" selected ><?php echo $event_type?></option>
							<?php } } ?>
							</select>
						</div>
					</div>
					
			</div>

	
			<br>
			<div class="form-group">
					<button type="submit"  name="submit" class="btn btn-success">Save</button>
			</div>
			<div class="form-group">
			<button type="submit" name="submit1" onClick = "return submitDelete();"  class="btn btn-success">Delete Account</button>
			</div>
					
		</form>
	
	</div>

	
</div>
<!-- "Add User" Ends... -->


		
		
	</section>
	<!-- Main section e here.. -->
	<hr />
<footer class="main">
	&copy; <strong>Uniting for a Cause</strong>
</footer>	</div>
</div>


	    <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>
     <script>

		function contact_check()
		{       
			var contact_no = document.getElementById("Contact_no").value;	
			var isnum = /^\d+$/.test(contact_no);
			
			if(contact_no.length<10)
			    {
				    alert("Please enter 10 digit contact number.");
				    document.getElementById("Contact_no").value = "";
			    }	
			if(!isnum)
				{
					alert("Only digits are allowed in contact number field.");
					document.getElementById("Contact_no").value = "";
				}
		}

		function submitDelete()
		{
		   var password = prompt("Please enter your password", "");
		   if(password != null)
		   {
        var ajaxurl = 'http://localhost/ufc/delete_account.php',
        data =  {'action': password};

		
					$.ajax( 
					{
					   url: ajaxurl,
					   type: 'POST',
					   data : {
						action : password
						},
					   success: function(output) 
					   {
					        
					   }
					}
				  ); 
          }
		}
     </script>
     </script>


	
	<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">
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