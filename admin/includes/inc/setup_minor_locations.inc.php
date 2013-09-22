<?php check_user_access($_GET['do'], $_SESSION['NF_Username']); ?>
<?php
//List Views
if ($_REQUEST['element'] == "")
{
	include 'includes/forms/setup_minor_locations_list.php';
} 
elseif ($_REQUEST['element'] == "create_new")
{
	if ($_POST['step'] == "")
	{
		include 'includes/forms/setup_minor_locations_form.php';
	} 
	elseif ($_POST['step'] == "1") 
	{
		// Insert into database
		$enter_value = array(
		"major_location_id"=>$_POST['major_location_id'],
		"location_name"=>$_POST['location_name'],		
		"created_datetime"=>current_datetime(),
		"created_by"=>$_SESSION['NF_Username'],
		"session_id"=>$_SESSION['My_Session_ID']
		);
		$enter_action =insert_data("locations",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
		$enter_r=mysql_query($enter_action);
		$location_id=mysql_insert_id();
		//echo "location_id = ".$location_id;
	
		if($location_id != "" && $location_id != 0)
		{
			$enter_add = array(
			"userid"=>$_SESSION['NF_Username'],
			"address1"=>$_POST['address1'],
			"address2"=>$_POST['address2'],
			"city"=>$_POST['city'],
			"state"=>$_POST['state'],
			"zip"=>$_POST['zip'],			
			"created_datetime"=>current_datetime(),
			"created_by"=>$_SESSION['NF_Username'],
			"session_id"=>$_SESSION['My_Session_ID']
			);
			$enter_add =insert_data("user_address",array_to_string(array_keys($enter_add)),array_to_string_value($enter_add));
			$enter_a=mysql_query($enter_add);
			$user_address_id=mysql_insert_id();

			if($user_address_id != ''  &&  $user_address_id != '0')  
			{
				$enter_add = array(
				"location_id"=>$location_id,
				"user_address_id"=>$user_address_id,
				);
				$enter_add =insert_data("location_address",array_to_string(array_keys($enter_add)),array_to_string_value($enter_add));
				$enter_a=mysql_query($enter_add);
				if ($enter_r & $enter_a)
				{
					$type = "announce";
					$message = '<b>Branch successfylly added.</b>';
					include ("includes/announce.inc.php");
					include 'includes/forms/setup_minor_locations_list.php';
				}
			}
		}		
		else 
		{
			$type = "error";
			$message = '<b>Branch could not be added.</b><br><br>MySQL Error: ' . mysql_error() . ' ';
			include ("includes/announce.inc.php");
			include 'includes/forms/setup_minor_locations_form.php';	
		}
	}
} 
elseif ($_REQUEST['element'] == "edit")
{
	if ($_POST['step'] == "")
	{
		include 'includes/forms/setup_minor_locations_edit.php';
	} 
	elseif($_POST['step'] == "1") 
	{
		$edit_value = array(
		"location_name"=>$_POST['location_name'],
		"major_location_id"=>$_POST['major_location_id'],		
		);		
		$edit_action =update_data("locations",array_to_string_update($edit_value),"location_id='" . $_POST['location_id'] . "'");
		if( mysql_query($edit_action) )				
		{
			$edit_value = array(
			"userid"=>$_SESSION['NF_Username'],
			"address1"=>$_POST['address1'],
			"address2"=>$_POST['address2'],
			"city"=>$_POST['city'],
			"state"=>$_POST['state'],
			"zip"=>$_POST['zip'],
			);
			$edit_action =update_data("user_address",array_to_string_update($edit_value),"user_address_id='" . get_val_col('location_address', 'user_address_id', 'location_id', $_POST['location_id']). "'");
			mysql_query($edit_action);
			
			$type = "announce";
			$message = "<b>Branch successfully modified.</b>";
			include ("includes/announce.inc.php");	
			include 'includes/forms/setup_minor_locations_list.php';				
		} 
		else 
		{
			$type = "error";
			$message = '<b>Branch could not be modified.</b><br><br>MySQL Error: ' . mysql_error() . ' ';
			include ("includes/announce.inc.php");
			include 'includes/forms/setup_minor_locations_list.php';
		}
	}
} 
elseif ($_REQUEST['element'] == "delete")
{
	if ($_GET['location_id'] <> "")
	{
		$deleteSQL = "DELETE FROM locations WHERE location_id = '" . $_GET['location_id'] . "'";
		$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
		$deleteSQL1 = "DELETE FROM location_arch WHERE location_id = '" . $_GET['location_id'] . "'";
		$Result1 = mysql_query($deleteSQL1, $nfconx) or die(mysql_error());
		$type = "announce";
		$message = "<b>Location successfully deleted.</b>";
		include ("includes/announce.inc.php");	
	} 
}
?>