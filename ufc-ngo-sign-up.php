<!DOCTYPE html>

<html lang="en">

<?php
	require_once('includes/initialize.php');
	require_once('includes/user.php');
?>

<?php

	if( isset($_SESSION['User_Name']) ) // check this: have the login page turn up with something else
		user::redirection(user::find_user_type($_SESSION['User_Name'])); // check that the index is actually user_id
?>

<?php

    if(isset($_POST['sign_up']))
	{	
		
		$password_hash = $_POST['password']; 
		$name = $_POST['name'];
		$username = $_POST['username']; 
		$website_url = $_POST['website_url'];
		$email_id = $_POST['email_id'];
		$ngo_head = $_POST['ngo_head'];
		$description = $_POST['description'];
		$website_url = $_POST['website_url'];
		$registration_no = $_POST['registration_number'];
		$location = $_POST['headquarter_address'];
		$contact_no = $_POST['contact_number'];
		$tokens = split(",",$location);

		if(sizeof($tokens)<4)

		  {
		     echo '<script language="javascript">';
             echo 'alert("Please enter area, city and state in headquarter address.")';  
             echo '</script>';
		  }
		else
		{
			$size = sizeof($tokens);
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

				
		$output = ngo::signup($name, $username, $email_id, $password_hash, $registration_no, $website_url, $ngo_head, $area, $city, $state, $contact_no, $description);
						
		if($output == "Your account is successfully registered.A confirmation link has been sent to email account.Please click on that link to verify your account.The link will expire in 7 days.You will get a message from admin as an approval of account, after which you will be able to access the account.")
		     {
		mail_send::send_activation($email_id);
		mail_send::send_request_to_admin($registration_no , $name, $email_id);
		     }
	          echo '<script language="javascript">';
              echo 'alert("'.$output.'")';  
              echo '</script>';
		}
		 

	}

	
?>
<script> var count = 500; </script>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>UFC | NGO-Sign-up</title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.min.js"></script>
	
	<script src="assets/js/jquery-1.11.0.min.js"></script>

	 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
	   <script>
	   function suggest()
	   {
      var input = /** @type {HTMLInputElement} */(
      	document.getElementById('headquarter_address'));
	   var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));
	}
	   </script>
	  	
</head>
<body class="page-body login-page login-form-fall" data-url="">


<!-- This is needed when you send requests via Ajax --><script type="text/javascript">
var baseurl = '';
</script>

<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="index.html" class="logo">
				<img src="assets/images/final-logo.png" width="200" alt="" />
			</a>
			
			
			<!-- progress bar indicator -->
		
		</div>
		
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<form method="POST">
				
				<div class="form-group">
                	<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
							<input type="text" maxlength="40" class="form-control" name="name" id="name" placeholder="Name" autocomplete="off" required />
					</div>
				</div>
				
				<div class="form-group">
                	<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
							<input type="text" maxlength="30" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" required />
					</div>
				</div>
				
				<div class="form-group">
                	<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-mail"></i>
						</div>
							<input type="email" maxlength="50" class="form-control" name="email_id" id="email_id" placeholder="Email-ID" autocomplete="off" required />
					</div>
				</div>
				
				<input type="hidden" name="myForm">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-lock"></i>
						</div>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required/>
					</div>
				</div>
				

				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-lock"></i>
						</div>
							<input type="password" class="form-control" name="re_password" id="re_password" placeholder="Re-enter Password" onblur="password_check()" autocomplete="off" required/>
					</div>
				</div>
				

				
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-progress-3"></i>
						</div>
							<input type="text" class="form-control" maxlength="30" name="registration_number" id="registration_number" placeholder="Registration Number" autocomplete="off" required/>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-network"></i>
						</div>
							<input type="url" class="form-control" maxlength="100" name="website_url" id="website_url" placeholder="Website URL (Optional)" autocomplete="off"/>
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
							<input type="text" class="form-control" maxlength="40" name="ngo_head" id="ngo_head" placeholder="NGO head" autocomplete="off" required />
					</div>
				</div>
				
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-comment"></i>
						</div>
							<input type="text" class="form-control" name="description" maxlength="150" id="description" placeholder="Description" autocomplete="off" required />
					</div>
				</div>
				
	
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-address"></i>
						</div>
							<input type="text" class="form-control typeahead" onclick="suggest()"  name="headquarter_address" id="headquarter_address" placeholder="Headquarter address (Area, city, state)" autocomplete="off" required/>
					</div>
				</div>


				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-phone"></i>
						</div>
							<input type="text" class="form-control" name="contact_number" onblur="contact_check()" maxlength= "10" id="contact_number" placeholder="Contact number" autocomplete="off" required />
					</div>
				</div>

                <div class="form-group">
				  <button  name = "sign_up" type = "submit" onclick="hash_password()" class="btn btn-primary btn-block btn-login" > 
						<i class="entypo-login"></i>
						Sign-up
					</button>
				</div>
				

				<!-- Implemented in v1.1.4 -->

				<div class="form-group"></div>
				
			</form>
			
			
			<div class="login-bottom-links">
				
				<a href="ufc-login.php" class="link">
					<i class="entypo-lock"></i>
					Return to Login Page
				</a>
				
				<br />
				
								
			</div>
			
		</div>
		
	</div>
	
</div>

     <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha1.js"></script>
     <script>
		function password_check()
		{
	 	    var password = document.getElementById("password").value;
			var confirm_password = document.getElementById("re_password").value;
		
			if(password != confirm_password)
			  {
			      alert("Password do not match");
				  document.getElementById("password").value = "";
				  document.getElementById("re_password").value = "";
		      }
			else if(password == confirm_password)
			  {
			    if(password.length<8 || password.length>14)
				  {
				        alert("Password length must be 8-14 characters");
						document.getElementById("password").value = "";
						document.getElementById("re_password").value = "";
				  }

			  }

		}
		function contact_check()
		{     
			var contact_no = document.getElementById("contact_number").value;
			var isnum = /^\d+$/.test(contact_no);
		
			  if(contact_no.length<10)
			    {
				    alert("Please enter 10 digit contact number.");
				    document.getElementById("contact_number").value = "";
			    }		
				if(!isnum)
				{
					alert("Only digits are allowed in contact number field.");
					document.getElementById("contact_number").value = "";
				}
				
		}
		function hash_password()
		{
			var password_hash = CryptoJS.SHA1(document.getElementById("password").value);
			document.getElementById("password").value = password_hash;
			document.getElementById("re_password").value = password_hash;

		}
     </script>


	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>

</body>
</html>