<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php');
?>

<?php
		
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
		 $places = "'Ahmedabad, Gujarat'";
?>
<?php


	    $followed = array();
		$unfollowed = array();
	if( isset( $_POST['search_ngo'] ) )
	{
		$ngo = trim( $_POST['ngo_name'] );
		$category = trim( $_POST['category_name'] );
		$location = trim( $_POST['location_name'] );
        $tokens = split ("\,", $location);
		if(sizeof($tokens)> 2)
		{
		$place= $tokens[sizeof($tokens)-3];
		$tokens1 = split ("\ ", $place);
		if(sizeof($tokens1)>1)
		$place1= $tokens1[1];
		else
		$place1= $place;
		}
		else
		$place1=null;
		$places ="";

		
		
		
		$op_arrays = Volunteer::search_by_ngo_queries($user,$ngo,$category,$place1);
		if($op_arrays != "error")
		{
		$followed = $op_arrays[0];
		$unfollowed = $op_arrays[1];
		$i=0;
		
		if($followed!=NULL)
		{
			while($i<sizeof($followed))
			{
				$places .= "'";
				$places .= $followed[$i][3].','.$followed[$i][4];
				$places .= "'";
				$places .=  ",";
				$i = $i+1;
			}	
		}

		$i=0;
		if($unfollowed!=NULL)
		{
			while($i<sizeof($unfollowed))
			{
				$places .= "'";
				$places .= $unfollowed[$i][3].','.$unfollowed[$i][4];
				$places .= "'";
				$places .=  ",";
				$i = $i+1;
			}	
		}
		}
		else
				{echo '<script language="javascript">';
              echo 'alert("City is required to search for NGO")';  
              echo '</script>';}

	}
	
?>


<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title>UFC | Search and follow NGO</title>
	

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	   <style>
      #map-canvas {
        width: 1000px;
        height: 300px;
		background-color: #CCC;
      }
    </style>
	<script>
	 $(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).prop('id');
	    document.getElementById($(this).prop('id')).value="Followed";
		document.getElementById($(this).prop('id')).disabled = "True";
        var ajaxurl = 'http://localhost/ufc/follow_ngo.php',
        data =  {'action': clickBtnValue};

		
					$.ajax( 
					{
					   url: ajaxurl,
					   type: 'POST',
					   data : {
						action : clickBtnValue
						},
					   success: function(output) 
					   {
							
					   }
					}
				  ); 
    });

});

</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYiSPEaZ6Owt7X74guL9a1R7iWE76glTI"></script>
	    <script>
		var geocoder;
		var map;
		var address;
		var initial_center = new google.maps.LatLng(23.0300, 72.5800);
        var get = [<?php echo $places?>];
		   
		function initialize(address) {
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng(23.0300, 72.5800);
			var mapOptions = {
			zoom: 8,
			center: latlng
		}
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		loop();
				}
		
		 function loop()
		   {
		     var j;
				for(j=0;j<get.length;j++)
				{
					plot(get[j]);
				}
			}

			function plot(address)
			{
			geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
			map: map,
			position: results[0].geometry.location
			});
			
			var infowindow = new google.maps.InfoWindow({
			content:address
			});	
			
			google.maps.event.addListener(marker,'click',function() {
			map.setZoom(14);
			map.setCenter(marker.getPosition());
			infowindow.setContent(address);
			infowindow.open(map,marker);
			});
					 // close info window when map is clicked
            google.maps.event.addListener(map, 'click', function(event) {
                if (infowindow) {
                    infowindow.close(); }
            });
		
		}
		else if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) { 
        wait = true;
        setTimeout("wait = true", 2000);
        //alert("OQL: " + status);
        }
		
		else {
			alert('Geocode was not successful for the following reason: ' + status);
			}
		});
		}
	
	
		
      google.maps.event.addDomListener(window, 'load', initialize);
	  
    </script>

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
<body class="page-body" data-url="http://neon.dev">

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
				<a href="JavaScript:newPopup('http://localhost/ufc/ufc-popup.php?page_id=ufc-volunteer-search-follow-ngo.php');">
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
	<!-- Sidebar ends... -->
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
		
		
		
		
<!-- Main content starts here... -->
		<div class="panel-body">
				
				<form method="post" action="ufc-volunteer-search-follow-ngo.php"  class="form-horizontal form-groups-bordered">
				
					<div class="form-group">
						<div class="row">		

						<div class="col-md-3">
						
						<?php
 
		                 $ngo_array = mysql_query("SELECT user.Name FROM user,ngo WHERE ngo.Username = user.Username  " );
                        
						?>
							<div class="input-group">
								<input type="text"  placeholder="NGO name" id= "ngo_name" name="ngo_name" class="form-control typeahead"  data-local=" <?php while($value = mysql_fetch_array($ngo_array)) echo $value['Name'].','; ?>" />
							</div>
							
						</div>
									
						<div class="col-md-3">
							<select class="form-control" name="category_name" placeholder="Select event type">
							<option>Select Category</option>
							<option>Agriculture</option>
							<option>Animal Husbandry</option>
							<option> Dairying  &  Fisheries </option>
							<option>Art & Culture </option>
							<option>Biotechnology</option>
							<option>Children</option>
							<option>Civic Issues</option>
							<option> Dalit Upliftment</option>
							<option>Differently Abled </option>
							<option>Disaster Management</option>
							<option>Drinking Water</option>
							<option>Education & Literacy</option>
							<option> Aged/Elderly </option>
							<option>Environment & Forests </option>
							<option>Food Processing</option>
							<option>Health & Family Welfare</option>
							<option>HIV/AIDS</option>
							<option> Housing</option>
							<option>Human Rights</option>
							<option>Labour & Employment </option>
							<option>Land Resources</option>
							<option>Legal Awareness & Aid</option>
							<option>Micro Finance (SHGs)</option>
							<option>Micro Small & Medium Enterprises</option>
							<option>Minority Issues</option>
							<option>New & Renewable Energy</option>
							<option>Nutrition</option>
							<option>Panchayati Raj</option>
							<option>Prisoner Issues</option>
							<option>Right to Information & Advocacy</option>
							<option>Rural Development & Poverty Alleviation Science & Technology</option>
							<option>Scientific & Industrial Research </option>
							<option>Sports</option>
							<option>Tourism </option>
							<option>Tribal Affairs</option>
							<option>Urban Development & Poverty Alleviation</option>
							<option>Vocational Training</option>
							<option>Water Resources</option>
							<option>Women Development & Empowerment</option>
							<option>Youth Affairs </option>

							</select>
						</div>
						
	
						
						<div class="col-md-3">
							
							<div class="input-group">
								<input type="text" id="pac-input" onclick="suggest()" placeholder="Location" name ="location_name" class="form-control typeahead" />
							</div>
						</div>
												
						<div class="col-sm-3">
							<td>
							<button type="submit" name="search_ngo" style="width:100px" class="btn btn-success">Search</button>
							</td>
						</div>
						

						
									
	
						
					    </div>
						<div class="row">
						</br>
						</br>
						<div id="map-canvas"></div>
						</div>
						</br>
						</br>
						<table align="center" class="table table-hover" style="width:700px" id="table-2" >
						<?php foreach($followed as $ngo)
						{
						?>
						<tr>

							<td width="600px">

	<button class="btn btn-primary popover-primary" style="width:500px" data-toggle="popover" data-trigger="hover" data-placement="top" data-content=" Headquarters : <?php echo $ngo[3].', '.$ngo[4].', '.$ngo[5].'  '; echo $ngo[2] ; echo $ngo[1];?>" data-original-title="<?php echo $ngo[0]; ?>"><?php echo $ngo[0]; ?></button></td>
							</td>
							<td>
							
							<input disabled type="submit" id="<?php echo $ngo[6]; ?>" style="width:80px;"  value="Followed" class="btn btn-blue"  />
							</td>
							
							
							
						</tr> <?php } ?>
						
						<?php foreach($unfollowed as $ngo)
						{
						?>
						<tr>

							<td width="600px">
	<button class="btn btn-primary popover-primary" style="width:500px" data-toggle="popover" data-trigger="hover" data-placement="top" data-content=" Headquarters : <?php $string= $ngo[3].', '.$ngo[4].', '.$ngo[5].'"\n"';   echo $string; echo $ngo[2] ; echo $ngo[1];?>" data-original-title="<?php echo $ngo[0]; ?>"><?php echo $ngo[0]; ?></button></td>
							</td>
							<td>
							<div class="btn btn-blue">
							<input id="<?php echo $ngo[6]; ?>" type="button" style="background:transparent; border:none; width:100px; align:center"  value="Follow" class="button"/>
							</div>
							</td>
							
							
							
						</tr> <?php } ?>

						</table>
				    </div>
					
				</form>
		</div>
<br />



<hr />		
<!-- Main content ends here... -->
    <footer class="main">
	&copy; <strong>Uniting for a Cause</strong>
    </footer>

    </div>
<hr />

		
<!-- Footer -->
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
	<script src="assets/js/neon-chat.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>
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

</body>
</html>
