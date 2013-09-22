<?php check_user_access($_GET['do'], $_SESSION['NF_Username']); ?>
<?php
//List Views
if ($_REQUEST['element'] == "")
{
	include 'includes/forms/setup_major_locations_list.php';
} 
elseif ($_REQUEST['element'] == "create_new")
{
	if ($_POST['step'] == "")
	{
		include 'includes/forms/setup_major_locations_form.php';
	} 
	elseif ($_POST['step'] == "1") 
	{
		// Insert into database
		$enter_value = array(
		"major_location_name"=>$_POST['major_location_name'],
		"state_id"=>$_POST['state_id'],
		"created_datetime"=>current_datetime(),
		"created_by"=>$_SESSION['NF_Username'],
		"session_id"=>$_SESSION['My_Session_ID']
		);
		$enter_action =insert_data("locations_major",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
		$enter_r=mysql_query($enter_action);
		if ($enter_r)
		{
			$type = "announce";
			$message = '<b>Organization successfylly added.</b>';
			include ("includes/announce.inc.php");
			include 'includes/forms/setup_major_locations_list.php';
		} 
		else 
		{
			$type = "error";
			$message = '<b>Orgaziation could not be added.</b><br><br>MySQL Error: ' . mysql_error() . ' ';
			include ("includes/announce.inc.php");
			include 'includes/forms/setup_major_locations_form.php';	
		}
	}
} 
elseif ($_REQUEST['element'] == "edit")
{
	if ($_POST['step'] == "")
	{
		include 'includes/forms/setup_major_locations_edit.php';
	} 
	elseif($_POST['step'] == "1") 
	{
		$edit_value = array(
		"major_location_name"=>$_POST['major_location_name'],
		"state_id"=>$_POST['state_id'],
		);
		$edit_action =update_data("locations_major",array_to_string_update($edit_value),"major_location_id='" . $_POST['major_location_id'] . "'");
		$edit_r=mysql_query($edit_action);
		if ($edit_r)
		{	
			$type = "announce";
			$message = "<b>Organization successfully modified.</b>";
			include ("includes/announce.inc.php");	
			include 'includes/forms/setup_major_locations_list.php';
		} 
		else 
		{
			$type = "error";
			$message = '<b>Organization could not be modified.</b><br><br>MySQL Error: ' . mysql_error() . ' ';
			include ("includes/announce.inc.php");
			include 'includes/forms/setup_major_locations_list.php';
		}
	}
} 
elseif ($_REQUEST['element'] == "change_status")
{
	if ($_GET['major_location_id'] <> "")
	{
		$status = $_REQUEST['status'];			
			
		$deleteSQL = "Update locations_major set status = '".$status."' where major_location_id = '" . $_GET['major_location_id'] . "'";
		$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
		$type = "announce";
		$message = "<b>Organization status successfully change.</b>";
		include ("includes/announce.inc.php");	
		include 'includes/forms/setup_major_locations_list.php';
	} 
}
?>