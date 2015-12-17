<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php');
?>

<?php
	//Load Session details...
		
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

	if(isset($_POST['submit']))
	 {
	 $contact_no = $_POST["contact_no"];
		$username = $_POST["Username"];
		$output = user::edit_details($username,$contact_no);
			  echo '<script language="javascript">';
              echo 'alert("'.$output.'")';  
              echo '</script>';
	 }
	
	$result1 = mysql_query("SELECT * FROM user WHERE Username = '$user' ");
	while($values1 =  mysql_fetch_array($result1))
	{
	$Name = $values1["Name"];
	$Email_ID = $values1["Email_ID"];
	$Contact_no = $values1["Mobile_no"];
	}
	
$result3 = mysql_query("SELECT * FROM volunteer WHERE Username = '$user' ");
	while($values3 =  mysql_fetch_array($result3))
	{
	 $Profession =  $values3["Profession"];
	$Gender =  $values3["Gender"];
	$DOB =  $values3["DOB"];
	$Email_notif = $values3["Email_notification_control"];
	
	}

?>


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>UFC | Profile</title>
	

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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-volunteer-profile.php');">
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

<div class="profile-env">
	<header class="row">
		<div class="col-sm-2">
		</div>
	</header>
		
	<!-- Main section starts here.. -->
	<section class="profile-feed">
		
		<h2>Edit your profile</h2>
<br />

<div class="panel panel-primary">

	<div class="panel-heading">
		<div class="panel-title">Enter Details</div>
		
	</div>
	
	<div class="panel-body">
	
		<form  method="post" >
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Name :</label>
				<br />
				<div class="col-sm-5">
				<input type="text" class="form-control"  name="Name" value = "<?php echo $Name; ?>" readonly />
				</div>
			</div><br><br>
		
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Username :</label>
				<br />
				<div class="col-sm-5">
				<input type="text" class="form-control" value= "<?php echo $user; ?>" name="Username" readonly />  
				</div>
			</div><br><br>
		
			
			
			<div class="form-group" >
				<label for="field-1" class="control-label">Email_ID :</label>
				<br />
				<div class="col-sm-5">
				<input type="email" class="form-control" value= "<?php echo $Email_ID; ?>" name="Email_ID" readonly />  
				</div>
			</div><br><br>
		
			
			
			<div class="form-group" >
				<label for="field-1" class="control-label">DOB:</label>
				<br />
				<div class="col-sm-5">
				<input type="date" class="form-control" name="DOB" value= "<?php echo $DOB;?>" readonly />
				</div>
			</div><br><br>
		
					
	
			<div class="form-group" >
				<label for="field-1" class="control-label">Profession :</label>
				<br>
				<div class="col-sm-5">
				<input type="text" class="form-control" value= "<?php echo $Profession; ?>" name="Profession" readonly />
				</div>
			</div><br><br>
			   <div class="form-group" >
				<label for="field-1" class="control-label">Contact_no :</label>
				<br />
				<div class="col-sm-5">
				<input type="text" class="form-control" maxlength="10" id="contact_no" onblur="contact_check()" name="contact_no" value = "<?php echo $Contact_no; ?>"  required />
				</div>
			</div>
			<br><br>
			<div class="form-group">
				<label for="field-1" class="control-label">Gender :</label>
	<?php 
		if($Gender = 'M')
			{
			
				echo'<div id="label-switch" class="make-switch" data-on-label="Female" data-off-label="male" align="center">
					<input type="checkbox" name="is_enabled" readonly />
						</div>';
			
				}
			else
			{
	
				echo'<div id="label-switch" class="make-switch" data-on-label="Male" data-off-label="Female" align="center">
					<input type="checkbox" name="is_enabled" readonly />
						</div>';
			
			}
						
		?>				
			</div><br>

			<div class="form-group">
					<button type="submit"  name="submit"  class="btn btn-success">Save</button>
			</div>
			<div class="form-group">
			<button  type="submit" name="submit1" onClick = "return submitDelete();" class="btn btn-success">Delete Account</button>
			</div>
		</form>
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

     <script>
		function contact_check()
		{       
			var contact_no = document.getElementById("contact_no").value;
			var isnum = /^\d+$/.test(contact_no);			
			if(contact_no.length<10)
			    {
				    alert("Please enter 10 digit contact number.");
				    document.getElementById("contact_no").value = "";
			    }	
				if(!isnum)
				{
					alert("Only digits are allowed in contact number field.");
					document.getElementById("contact_no").value = "";
				}
		}
		function submitDelete()
		{
		   var password = prompt('Please enter your password', '');
		   if(password != null && password !='')
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
					        alert(output);
					   }
					}
				  ); 
          }
		}
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
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
	<script src="assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>
	<script src="assets/js/bootstrap-switch.min.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
</body>
</html>
