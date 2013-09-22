<?php check_user_access($_GET['do'], $_SESSION['NF_Username']); ?>

<?php
include 'includes/functions/functions_user.php';

$user_type = get_val_col(users,user_type,userid,$_SESSION['NF_Username']);
//List View
if ($_REQUEST['element'] == "")
{
	include 'includes/forms/setup_manage_users_list.php';
}

elseif ($_REQUEST['element'] == "search")
{
	if ($_REQUEST['step'] == "")
	{
		include 'includes/forms/setup_manage_users_search.php';
	} 
	elseif($_REQUEST['step'] == "1") 
	{
		include 'includes/forms/setup_manage_users_list.php';	
	}
}

//New Record
elseif ($_REQUEST['element'] == "create_new")
{
	if ($_REQUEST['step'] == "")
	{
		if ($user_type <> "Admin")
		{
		include 'includes/forms/setup_manage_users_non_admin_form.php';	
		} 
		elseif ($user_type == "Admin") 
		{
			include 'includes/forms/setup_manage_users_form.php';
		}
	} 
	elseif($_REQUEST['step'] == "1") 
	{
		// Enter user to database
		if (($_REQUEST['userid'] <> "") && ($_REQUEST['name'] <> "") && ($_REQUEST['password1'] <> "")) 
		{
			// Check if user already exists
			if (get_val_col(users, id, userid, $_REQUEST['userid']) <> "")
			{
				$type = "error";
				$message = "<b> Error! " . $_REQUEST['userid'] . " already exists!</b>";
				include ("includes/announce.inc.php");
				include 'includes/forms/setup_manage_users_form.php';
			} 
			else 
			{
				if ($_POST['user_creation_process'] == "Custom")
				{
					// check if the profile needs to be created
					if ($_POST['profile_selection'] == "default")
					{
						$profile_id = 	$_POST['profile_id'];
					} 
					elseif ($_POST['profile_selection'] == "new")
					{
						// Create the profile using the option selected
						// insert into profiles and get the profile_id	
						include 'includes/inc/setup_manage_profiles_custom.php';
					}
				} 
				else 
				{
					$profile_id = $_POST['profile_id'];
				}
	
				if ($_POST['user_type'] == "Branch Manager")
				{
					$major_location_id = $_POST['major_location_id'];
					$location_id = $_POST['location_id'];
				} 
				elseif ($_POST['user_type'] == "Organizational Administrator")
				{
					$major_location_id = $_POST['major_location_id'];
					$location_id = "";
				} 
				else 
				{
					$major_location_id = "";
					$location_id = "";
				}
				$enter_value = array(
				"userid"=>strtoupper($_POST['userid']),
				"parent_userid"=>$_SESSION['NF_Username'],
				"profile_id"=>$profile_id,
				"location_id"=>$location_id,
				"major_location_id"=>$major_location_id,
				"password"=>md5($_POST['password1']),
				"name"=>$_POST['name'],
				"mobile"=>$_POST['mobile'],
				"email"=>$_POST['email'],				
				"registration_date"=>current_date(),
				"user_title"=>$_POST['user_title'],
				"status"=>"1",
				"user_type"=>$_POST['user_type'],				
				);
				$enter_action =insert_data("users",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
				$enter_r=mysql_query($enter_action);
				$type = "announce";
				$message = "<b>User Successfully created</b>";
				include ("includes/announce.inc.php");
				include 'includes/forms/setup_manage_users_list.php';
			}
		} 
		else 
		{
			$type = "error";
			$message = "<b> Error! Please enter all required fields.</b>";
			include ("includes/announce.inc.php");
			include 'includes/forms/setup_manage_users_form.php';
		}
	}
}

//Edit View
elseif ($_REQUEST['element'] == "edit")
{
	if ($_REQUEST['step'] == "")
	{
		if ($user_type <> "Admin")
		{
			include 'includes/forms/setup_manage_users_edit_non_admin.php';
		} 
		elseif ($user_type == "Admin") 
		{
			include 'includes/forms/setup_manage_users_edit.php';
		}
	} 
	elseif($_REQUEST['step'] == "1") 
	{
		if ($_POST['user_creation_process'] == "Custom")
		{
			include 'includes/inc/setup_manage_profiles_edit.php';
		}
		//Modify the user	
		if ($_REQUEST['password1'] <> "")
		{
			$password = md5($_REQUEST['password1']);
		}
		else 
		{
			$password = get_val_col(users, password, userid, $_REQUEST['userid']);
		}
		
		$edit_value = array(
		"name"=>$_REQUEST['name'],		
		"email"=>$_REQUEST['email'],
		"mobile"=>$_REQUEST['mobile'],
		"password"=>$password,
		"user_title"=>$_POST['user_title'],
		);
		$edit_action =update_data("users",array_to_string_update($edit_value),"userid='" . $_REQUEST['userid'] . "'");
		$edit_r=mysql_query($edit_action);
		if($edit_r)
		{	
			$type = "announce";
			$message = "<b>" . $_REQUEST['userid'] . " successfully modified</b>";
			include ("includes/announce.inc.php");
			include 'includes/forms/setup_manage_users_list.php';
		}
	}
}

elseif ($_REQUEST['element'] == "terminate")
{
	if ($_GET['id'] <> "")
	{
		$parent_user_id =  get_val_col(users,parent_userid,"id",$_GET['id']);	
		$user_id =  get_val_col(users,userid,"id",$_GET['id']);	
		
		if (($parent_user_id == $_SESSION['NF_Username']) || ($user_type == "Admin"))
		{	
			mysql_select_db($database_nfconx, $nfconx);
			$deleteSQL = "update users set status=0 WHERE id = '" . $_GET['id'] . "'";
			$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
			if($user_type=="Donor")
			{
				$deleteSQL = "update donor_events set is_archive=1 WHERE userid = '" .$user_id. "'";
				$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());

				$deleteSQL = "update donor_payment_schedule set is_disabled=1 WHERE userid = '" .$user_id. "'";
				$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
				
				$deleteSQL = "update donor_payment_methods set active_state='inactive' WHERE userid = '" .$user_id. "'";
				$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
			}
			$type = "announce";
			$message = "You have successfully terminated the user account.";
			include ("includes/announce.inc.php");	
		} 
		else 
		{
			$type = "error";
			$message = "You are not authorized to terminate this account.";
			include ("includes/announce.inc.php");	
			include 'includes/forms/setup_manage_users_list.php';
		}
	}
}
?>