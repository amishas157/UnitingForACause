<!DOCTYPE html>
<html lang="en">
<?php
	require_once('includes/initialize.php');
?>

<?php
		
	if( isset($_SESSION['User_Name']) ) // check this: have the login page turn up with something else
		user::redirection(user::find_user_type($_SESSION['User_Name'])); // check that the index is actually user_id
?>

<?php 
if( isset( $_POST['submit'] ) )
	{
	    $password_hash = $_POST['password'];
		$name = $_POST['name'];
		$user = $_POST['username'];
		$email = $_POST['email-id'];
		$gender = $_POST['gender'];
		$dob = $_POST['date_of_birth'];
		$profession = $_POST['typeahead_local'];
		$mobile = $_POST['contact_number'];

		$output = volunteer::signup($name, $user, $email, $password_hash, $dob, $gender, $profession, $mobile);
		if($output == "1")
		 {
			 mail_send::send_activation($email);
			$output = "Your account is successfully registered. A confirmation link has been sent to email account. Please click on that link to access your account.";
		 }
	    echo '<script language="javascript">';
        echo 'alert("'.$output.'")';  
        echo '</script>';
}
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Volunteer-Sign-up</title>
	

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
			
			<a href="" class="logo">
				<img src="assets/images/final-logo.png" width="200" alt="" />
			</a>
			
			
		</div>
		
	</div>
	
	
	<div class="login-form">
		
		<div class="login-content">
			
			<form method="post" role="form" name="form" id="form" class="validate">
				
				<div class="form-group">
                	<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
							<input type="text" class="form-control" maxlength="40" name="name" id="name" placeholder="Name" autocomplete="off" required/>
					</div>
				</div>
				
				<div class="form-group">
                	<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
							<input type="text" class="form-control" maxlength="30" name="username" id="username" placeholder="Username" autocomplete="off" required />
					</div>
				</div>
				
				<div class="form-group">
                	<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-mail"></i>
						</div>
							<input type="email" class="form-control" maxlength="50" name="email-id" id="email-id" placeholder="Email-ID" autocomplete="off" required />
					</div>
				</div>
				
				<input type="hidden" name="myForm">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-lock"></i>
						</div>
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required />
					</div>
				</div>
				

				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-lock"></i>
						</div>
							<input type="password" class="form-control" name="re_password" id="re_password" onblur="password_check()" placeholder="Re-enter Password" autocomplete="off" required/>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group">
							<i class="entypo-user"></i><t>
							<label class="control-label">Gender</label>
						<div class="btn-group">
						<select type="button" name = "gender" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							Gender <span class="caret"></span>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
						</select>
						</div>
					</div>
				</div>


					
					
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-calendar"></i>
							<label class="control-label">Date of birth</label>
						</div>
								<input type="date" class="form-control" name="date_of_birth" id="date_of_birth" onblur="age_check()" placeholder="Date of birth" autocomplete="off" required/>
					</div>
				</div>

				
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-graduation-cap"></i>
						</div>
							<input type="text" placeholder="Profession" name="typeahead_local" class="form-control typeahead" data-local="professor,teacher,dentist,midwives,nurses,therapist,pathologist,
								pharmacists,physicians,psychologists,surgeons,veterinarians,
									accountants,agriculturists,architects,economists,lawyers,
									engineers,librarians,militaryofficer,policeofficer,socialworker,chemist" required/>
					</div>
				</div>

				
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-mobile"></i>
						</div>
							<input type="text" class="form-control" maxlength="10" name="contact_number" onblur="contact_check()" id="contact_number" placeholder="Contact number" autocomplete="off" required/>
					</div>
				</div>
				
                             
                <div class="form-group">
				  <button type="submit" name ="submit" onClick = "return sign_up();" class="btn btn-primary btn-block btn-login">
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
		function sign_up()
		{
			var password_hash = CryptoJS.SHA1(document.getElementById("password").value);
			document.getElementById("password").value = password_hash;
			document.getElementById("re_password").value = password_hash;

		}
		function age_check()
		{
			var dob = document.getElementById("date_of_birth").value;
		    var dob1 = new Date(dob);
			var cur = new Date();
            var diff = cur-dob1; // This is the difference in milliseconds
            var age = (diff/31536000000);
			if(age<12)
			{
			    alert("Minimum age to register to portal is 12.");
			    document.getElementById("date_of_birth").value = "";
			}
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
	<script src="assets/js/typeahead.min.js"></script>
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-login.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>


</body>
</html>