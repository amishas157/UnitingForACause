<!DOCTYPE html>
<html lang="en">
<?php 	require_once('includes/initialize.php');
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
	
if(isset($_GET['event-id']))
	$event_id = $_GET['event-id'];
$feedback_array = ngo::view_feedback_for_event($event_id);
$feedback_count = count($feedback_array);
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>UFC | View Feedback</title>

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
		
<hr />


<div class="row">

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