<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>UFC | Know more about this page</title>
</head>

<?php 
if(isset($_GET["page_id"]))
{
		//echo "hey";
	if($_GET["page_id"] == "volunteer-contact_admin.php" )
	{
		echo " <br> This panel allows the Volunteer to contact Admin by sending a message stating the problem or doubt. ";
	}
	else if($_GET["page_id"] == "ngo-contact_admin.php" )
	{
		echo " <br> This panel allows the NGO to contact Admin by sending a message stating the problem or doubt. ";
	}
	else if($_GET["page_id"] == "ufc-volunteer-search-follow-event.php" )
	{
		echo "This panel allows the volunteer to search for an event and also to register events and follow the Repetitive Events and view its Feedback. The events can be registered till one hour prior to the start time of the event.<br>
			Mandatory Fields -
			<ul style='list-style-type:square'>
			<li> Event Type - User has to select the event-type for the event from a pre-defined drop down list. </li>
			<li> Location - The user has to enter the city in which he/she is searching for the event. After typing the first few characters, a suggestion list appears to select the event location.</li>
			</ul>
			The results of above filters is shown in the Google Map which will display marks / pointers on the map for the location of events occurring and also a list of events is displayed
			which has the option to register events, follow and view feedbacks of repetitive events.";
	}
	else if($_GET["page_id"] == "ufc-volunteer-search-follow-event-type.php" )
	{
		echo "<br> This panel allows the volunteer to follow many Event Types.";
	}
	else if($_GET["page_id"] == "ufc-volunteer-search-follow-ngo.php")
	{
		echo "This panel allows the volunteer to search and follow the NGOs. <br>
			Mandatory Field -
			<ul style='list-style-type:square'>
			<li> Location - The User has to enter the city in which he/she is searching for the NGO. After typing the first few characters, a suggestion list appears to select the NGO location. </li></ul>
			 The result of above filters is shown in Google Map which will display marks / pointers on map for the NGO's location and also a list of searched NGOs is displayed
			 which has the option to follow the NGO. On following the NGO, the notifications of the events organised by that NGO is sent to the registered Email-ID.";
	}
	else if($_GET["page_id"] == "ufc-volunteer-profile.php")
	{
		echo "This panel allows the volunteer to edit the profile page. <br>
				Editable Field -
				<ul style='list-style-type:square'>
				<li> Contact Number </li></ul>
				Non Editable Fields -
				<ul style='list-style-type:square'>
				<li> Name </li>
				<li> Username </li>
				<li> Email ID </li>
				<li> DOB i.e., Date of Birth </li>
				<li> Profession </li>
				<li> Gender </li></ul>
				When all the changes are done, press Save button to save the edited fields.<br>
				The volunteer can also delete the account by clicking on the Delete Account button present below the Save button. ";
	}
	else if($_GET["page_id"] == "ufc-volunteer-account-settings.php")
	{
			echo "This panel allows the volunteer to change the account settings :
			<ul style='list-style-type:square'>
				<li> Enabling/Disabling the email notifications : This email notification facility helps user to get notified about the occurence of the events. The notifications are sent regarding the followed NGO, its organised events and the followed event-type.</li>
				<li> Unfollow the Events/Event-types/NGO's already followed by clicking the Unfollow button. So only the followed ones would be displayed on the panel.";
	}
	else if($_GET["page_id"] == "ufc-volunteer-password-setting.php")
	{
		echo "This panel allows the volunteer to change the account password. Volunteer needs to provide :
			<ul style='list-style-type:square'>
			<li> the existing / current password </li>
			<li> the new password </li>
			<li> re-enter the new password (to confirm the password) </li></ul>
			If in-case any field is left empty or user has entered a wrong value, pop-up error message appears and all fields are to be entered again by the user. <br>
			User can also use the Reset button to enter all the fields again if any mistakes are made.";
	}
		else if($_GET["page_id"] == "ufc-ngo-password-setting.php")
	{
		echo "This panel allows the NGO to change the account password. The NGO needs to provide :
			<ul style='list-style-type:square'>
			<li> the existing / current password </li>
			<li> the new password </li>
			<li> re-enter the new password (to confirm the password) </li></ul>
			If in-case any field is left empty or user has entered a wrong value, pop-up error message appears and all fields are to be entered again by the user. <br>
			User can also use the Reset button to enter all the fields again if any mistakes are made.";
	}
	else if($_GET["page_id"] == "ufc-volunteer-registered-events.php")
	{
		echo "This panel shows the list of past and upcoming registered events.
				<ul style='list-style-type:square'>
		 		<li> In past registered events list, the user can provide feedback of the event if that event has occured in the last 15 days.
				If the NGO which has organised that event has allowed the users to view the feedbacks of that event, then the user can also view the feedbacks for that event.</li>
				<li> The upcoming events list shows the list of events registered by the user. The user can also de-register from that event by clicking on the Deregister button.</li></ul>";
	}
	else if($_GET["page_id"] == "ufc-volunteer-events-suggestion.php")
	{
		echo "This is the homepage of the volunteer. It shows the list of NGOs, Events and Event-types followed by the volunteer. 
			<ul style='list-style-type:square'>
				<li> In list of following NGOs, the list of NGOs and its events organised are displayed with a register button alongside. </li>
		 		<li> In list of following events, the list of followed events is displayed with register button alongside. </li>
		 		<li> In the list of following event-type, list of followed event-type and its corresponding events are displayed with register button alongside. </li></ul>";
	}
	else if($_GET["page_id"] == "ufc-ngo-profile.php")
	{
		echo "This panel allows the NGO to edit the personal details. <br>
				Editable Fields -
				<ul style='list-style-type:square'>
				<li> Head-Quarter Location </li>
				<li> NGO Head </li>
				<li> Contact Number </li>
				<li> Website URL </li>
				<li> Description </li>
				<li> Feedback accessibility - User can make the feedback visibility to be public or private, i.e., providing access to the volunteers to view the feedbacks of the events conducted by the NGO. </li>
				<li> Event type - User can also select different event types from the pre-defined list depending on which category their organised events falls. </li></ul>
			
				Non Editable Fields - 
				<ul style='list-style-type:square'>
				<li> Name </li>
				<li> Username </li>
				<li> Email-ID </li>
				<li> Registration number.</li></ul>
				This panel also allows the NGO to delete its account by clicking on the Delete Account button";
	}
	else if($_GET["page_id"] == "ufc-ngo-create-event.php")
	{
		echo " This panel allows the NGO to create an Event. <br>
				Mandatory Fields -
				<ul style='list-style-type:square'>
				<li> Name of the event </li>
				<li> Event type using the drop-down menu provided, the user can select the type of event from a predefined set of event-types.</li>
				<li> Location - The NGO has to enter the area, city and state in which it is going to organise the event. After typing the first few characters, a suggestion list appears to select the event location. </li>
				<li> Date and time for event - The user must provide a start date and time for the event. </li>
				</ul>
				Non Mandatory Fields -
				<ul style='list-style-type:square'>
				<li> Maximum Number of Volunteers Required </li>
				<li> Volunteer maximum age </li>
				<li> Volunteer minimum age </li>
				<li> Profession </li>
				<li> Gender requirement</li>
				<li> Repetition Details : This is the number of days after which the event will re-occur. The minimum and maximum value can be 3 and 365 days respectively.</li></ul>";
	}
	else if($_GET["page_id"] == "ufc-ngo-view-events.php")
	{
		echo " <br>This panel allows the NGO to update the event details of the upcoming event.";
	}
	else if($_GET["page_id"] == "ufc-ngo-update-event.php")
	{
		echo " This panel allows the NGO to update the event details of the upcoming event.
				<ul style='list-style-type:square'>
				<li> Location : The NGO can edit the area where the event is going to be held; they cannot edit the city and the state. </li>
				<li> Start time and End time : The NGO can update the time of the event.</li>
				<li> Maximum Number of Volunteers required : The NGO can change the number of volunteers required for the event. </li>
				<li> Repetition Details : This is the number of days after which the event will re-occur. The minimum and maximum value can be 3 and 365 days respectively.</li>
				</ul>
				Editing any of these details will send a notification for the same to the volunteers registered for that event. <br>
				Below update event button, there is a delete button which allows the NGO to delete the event.";
	}
	else if($_GET["page_id"] == "ufc-ngo-volunteers-and-feedback.php")
	{
		echo " This panel displays the list of all volunteers for the upcoming as well as past events. The NGO can also view the feedbacks for the past events given by the registered volunteers.";
	}
	else if($_GET["page_id"] == "ufc-ngo-followers.php")
	{
		echo " This panel shows the list of followers of the NGO, its organised event-type and events.";
	}
	
}
?>



</html>
