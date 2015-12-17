<!DOCTYPE html>
<html lang="en">

<?php 
require_once('includes/initialize.php');
	//Load Session details...
	if (!$session->is_logged_in())
			session_start();
	
	if( ! isset($_SESSION['User_Name']) )
		redirect_to('ufc-login.php');
	
	if(isset($_GET['fn-type']))
		$fn_type = $_GET['fn-type'];
	if(isset($_GET['param']))
	{
		$param = $_GET['param'];
		if($fn_type==1) // NGO followers
		{
			$followers = ngo::view_ngo_followers($param);
		}
		elseif($fn_type==2) // event-type followers
		{	
			$followers = ngo::view_event_type_followers(str_replace('_', ' ', $param));
		}
		elseif($fn_type==3) // event followers
		{
			$followers = ngo::view_event_followers($param);
		}
		else
			echo "None of these";
	}
	$no_of_followers = count($followers);
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | NGO Follower Details</title>
	

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
	
</head>
<body class="page-body" data-url="">

<div class="main-content">
		
<div class="row">
	
	<div class="col-md-10">
		
		<?php 
		$i=1;
		echo '	<h4> Followers Details</h4>
		
		<table class="table responsive">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Contact Number</th>
				</tr>
			</thead> <tbody>';
			while($no_of_followers+1>$i)
			{
			echo '
				<tr>
					<td>'.$i.'</td>
					<td>'.$followers[$i-1][0].'</td>
					<td>'.$followers[$i-1][1].'</td>
				</tr>
			';
			$i++;
			}
			
		echo '</tbody></table>';
		?>
	</div></div>
</section>
	<!-- Main section e here.. -->
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
