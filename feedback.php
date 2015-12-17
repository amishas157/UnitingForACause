<!DOCTYPE html>
<html lang="en">

<?php
	require_once('includes/initialize.php');

?>

	<head>
  		<title>Provide Feedback</title>
	</head>
	
	<?php
	$user = $_SESSION['User_Name'];

          if(isset($_GET['id']))
	      {$id= $_GET['id'];
}


          if(isset($_POST['send']))
{	

     $event_id= $_GET['id'];
	 $feedback = $_POST['feedback'];
      Volunteer::insert_feedback($user,$feedback,$event_id);
} ?>	

	<body>
   		<p>Provide Feedback :</p>
		<?php echo '<form role="form" action="http://localhost/ufc/feedback.php?id='.$id.'" method="post">'?>
 			<table>
				<tr><td colspan="5"><textarea name="feedback" rows="10" cols="50"></textarea></td></tr>
				<tr><td colspan="5"><label  name="event_id" value="<?php echo $id ?>"></label></td></tr>
				<tr><td colspan="2"><input type="submit"  value="Provide feedback" name="send" ></td></tr>
			</table>
	    </form>

  
	</body>

</html>
