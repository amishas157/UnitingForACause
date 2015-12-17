<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php')
?>

<?php
	//If user requested Log-out... 
	if( (!empty( $_GET['action'] )) && $_GET['action']=='logout' )
	{		
		$session->logout();
		session_destroy();
		redirect_to('ufc-login.php');
	}
?>

<?php
	//If session has already started...
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	
	if( isset($_SESSION['User_Name']) ) // check this: have the login page turn up with something else
		user::redirection(user::find_user_type($_SESSION['User_Name'])); // check that the index is actually user_id
?>


<?php
	$isError = false;

	if( isset( $_POST['sign_in'] ) )
	{
		$username = trim( $_POST['username'] );
		$password_hash = trim( $_POST['password'] );
       
		$found_user = user::authenticate( $username , $password_hash );

		if($found_user)
		{  
			$session->login( $username );
			user::redirection($found_user);
		}
			
		//If not redirected yet, the user has entered incorrect credentials...		
		$isError = true;
	}	
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Login</title>
	

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
<body class="page-body login-page login-form-fall" data-url="">


<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var baseurl = '';
</script>

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			
				<img src="assets/images/final-logo.png" width="200" alt="" />
			
			
		</div>
		
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
            <?php 
				if( $isError )
				{
					?>
					<div class="">
						<h3>Invalid login</h3>
						<p>Make sure you have entered correct credentials.</p>
					</div>
					<?php
				}
			?>
			
			<form method="post" >
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" required />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" name="sign_in" id = "sign_in" class="btn btn-primary btn-block btn-login" onClick = "return submitLogin();">
						<i class="entypo-login"></i>
						Login In
					</button>
				</div>
								
			</form>
				<div class="form-group">
					<a href="http://localhost/ufc/ufc-volunteer-sign-up.php">
					<button name="sign_up_volunteer" class="btn btn-primary btn-block btn-login">
						<i class="entypo-user-add"></i>
						Sign up as a volunteer
					</button></a>
				</div>
				
					<div class="form-group">
					<a href="http://localhost/ufc/ufc-ngo-sign-up.php">	<button name="sign_up_ngo" class="btn btn-primary btn-block btn-login">
						<i class="entypo-user-add"></i>
					Sign up as an NGO
					</button></a>
				</div>
			
			<div class="login-bottom-links">
				
				<a href="ufc-user-forgot-password.php" class="link">Forgot your password ?</a>
				
				<br />
				
				
				
			</div>
			
		</div>
		
	</div>
</div>

<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>
<script>
		function submitLogin()
		{       
			var password_hash = CryptoJS.SHA1(document.getElementById("password").value);
			if(document.getElementById("password").value.length > 0)
			document.getElementById("password").value = password_hash;
		}
</script>

<link rel="stylesheet" href="assets/js/jvectormap/jquery-jvectormap-1.2.2.css">

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
	
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
</body>
</html>