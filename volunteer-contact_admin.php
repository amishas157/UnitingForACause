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
		$user = $_SESSION['User_Name'];
		if(user::find_user_type($user) == "N")
		{
			redirect_to('../ufc/ufc-ngo-view-events.php');
		}
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Contact Admin</title>

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

<?php
	    if(isset($_POST['submit']))
			{	
			    $message = $_POST['comment'];
	 			mail_send::Send_Mail("unitingforacause@gmail.com", "Message from ".$user, $message);     			
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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=volunteer-contact_admin.php');">
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
						<a href="" data-animate="1" data-collapse-sidebar="1">
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
		
		<h2>Contact Admin</h2>
		<br />
		<?php echo '<form role="form" action="volunteer-contact_admin.php" method="post">'?>
		<table>
				<tr><td colspan="5"><textarea name="comment" rows="10" cols="100" required></textarea></td></tr>
				<tr><td colspan="4"><input type="submit" name="submit" class="btn btn-success" value="Send"></td></tr>
		</table>

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