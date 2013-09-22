<?php check_user_access($_GET['do'], $_SESSION['NF_Username']); ?>
<?php
//List View
if ($_REQUEST['element'] == "")
{
	if ($_GET['profile_group_id'] <> "")
	{
		include 'includes/forms/setup_manage_profiles_list.php';
	} 
	else 
	{
		include 'includes/forms/setup_manage_profiles_list.php';
	}
}
//New Record
elseif ($_REQUEST['element'] == "create_new")
{
	if ($_POST['step'] == "")
	{
		include 'includes/forms/setup_manage_profiles_form.php';
	} 
	elseif($_POST['step'] == "1") 
	{
		// Create Profile Group if a new Group has been selected
		if ($_POST['profile_group_id'] == "NEW_GROUP")
		{
			// create a new group and fetch the group ID
			$enter_value = array(
			"profile_group_name"=>$_POST['new_profile_group_name'],
			"profile_parent_group_id"=>$_POST['new_group_parent_profile_group_id'],
			);
			$enter_action =insert_data("profile_groups",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
			$enter_r=mysql_query($enter_action);
			$profile_group_id = mysql_insert_id();
		}
		else 
		{
			$profile_group_id = $_POST['profile_group_id'];
		}
		// CREATE PROFILE
		// Check if Profile Name entered exists
		if (get_val_col(profile_definitions,profile_name,profile_name,$_POST['profile_name'])=="")
		{
			// Insert into profile_definitions
			$enter_value = array(
			"profile_name"=>$_POST['profile_name'],
			"profile_description"=>$_POST['profile_description'],
			"profile_group_id"=>$profile_group_id,
			);
			$enter_action =insert_data("profile_definitions",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
			$enter_r=mysql_query($enter_action);
			$profile_id = mysql_insert_id();
			
			// Insert into profile_service_groups
		
			$i = 1;
			do 
			{
				if ($_POST['service_group' . $i] <> "")
				{
					$enter_value = array(
					"profile_id"=>$profile_id,
					"service_group_id"=>$_POST['service_group' . $i],
					);				
					$enter_action =insert_data("profile_service_groups",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));				
					$enter_r=mysql_query($enter_action);
				}
	
				// Insert into profile_services
				$service_group_id_for_pos = $_POST['service_group' . $i];	
	
				if ($service_group_id_for_pos <> "")
				{
					$j = 1;
					do 
					{
						$service_id = $_POST['service' . $service_group_id_for_pos . '_' . $j];
						
						if ($service_id <> "")
						{
							$enter_value = array(
							"profile_id"=>$profile_id,
							"service_id"=>$service_id,
							);
							$enter_action =insert_data("profile_services",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
							$enter_r=mysql_query($enter_action);
							// Add to profile_service_elements
							$k = 1;
							do 
							{
								$service_element_value = $_POST['element' . $service_group_id_for_pos . '_' . $j . '_' . $k];
								if ($service_element_value <> "")
								{
									$enter_value = array(
									"profile_id"=>$profile_id,
									"service_id"=>$service_id,
									"service_element_value"=>$service_element_value,
									);
									$enter_action =insert_data("profile_service_elements",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
									$enter_r=mysql_query($enter_action);
								}
								$k++;
							} 
							while ($k <= $_POST['service_elements_' . $service_id . '_count']);
						}
						$j++;
					} 
					while ($j <= $_POST['service_group_' . $i . '_service_count']);
				}
				$i++;
			} 
			while ($i <= $_POST['total_service_groups']);
	
			// Insert data into profile_service_custom_expression
			mysql_select_db($database_nfconx, $nfconx);
			$query_rsnf1 = "select *  from services_custom_expression where visible_in_profile = 1 ORDER by id ASC";
			$rsnf1 = mysql_query($query_rsnf1, $nfconx);
			$row_rsnf1 = mysql_fetch_assoc($rsnf1);
			$totalRows_rsnf1 = mysql_num_rows($rsnf1);
			if ($totalRows_rsnf1 > 0)
			{
				do 
				{
					$x_value_field_name = 'x_value' . $row_rsnf1['id'];	
					$x_condition_field_name = 'x_condition' . $row_rsnf1['id'];
			
					if (($_POST[$x_value_field_name] <> "") && ($_POST[$x_condition_field_name] <> ""))
					{
						if ($row_rsnf1['multiple_select'] == "Yes")
						{
							$x_value_multiple_values=$_POST[$x_value_field_name];
							if ($x_value_multiple_values)
							{
								foreach ($x_value_multiple_values as $t)
								{
									// Insert into profile_service_custom_expression
									$enter_value = array(
									"service_expression_id"=>$row_rsnf1['id'],			 
									"profile_id"=>$profile_id,
									"service_id"=>$row_rsnf1['service_id'],
									"condition_value"=>$_POST[$x_condition_field_name],
									"expression_value"=>$t,
									);
									$enter_action =insert_data("profile_service_custom_expression",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
									$enter_r=mysql_query($enter_action);
								}
							}
						} 
						else 
						{
							// Insert into profile_service_custom_expression
							$enter_value = array(
							"service_expression_id"=>$row_rsnf1['id'],			 
							"profile_id"=>$profile_id,
							"service_id"=>$row_rsnf1['service_id'],
							"condition_value"=>$_POST[$x_condition_field_name],
							"expression_value"=>$_POST[$x_value_field_name],
							);
			
							$enter_action =insert_data("profile_service_custom_expression",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
							$enter_r=mysql_query($enter_action);
						}
					}
				} 
				while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));	
			}
	
			$type = "announce";
			$message = "<b>Login profile - '" . $_POST['profile_name'] . "' successfully created.</b>";
			include ("includes/announce.inc.php");	
			include 'includes/forms/setup_manage_profiles_list.php';
		} 
		else 
		{
			$type = "error";
			$message = "Profile with this name already exists! Please use a different name";
			include ("includes/announce.inc.php");	
			include 'includes/forms/setup_manage_profiles_form.php';	
		}
	}
}


//Search Form View
elseif ($_REQUEST['element'] == "edit")
{
	if ($_POST['step'] == "")
	{
		include 'includes/forms/setup_manage_profiles_edit.php';	
	} 
	elseif($_POST['step'] == "1") 
	{
		// edit the profile
		// Check if Profile Name entered exists
		if (($_POST['profile_name']<>"")&&($_POST['profile_id']<>""))
		{
			// Create Profile Group if a new Group has been selected
			if ($_POST['profile_group_id'] == "NEW_GROUP")
			{
				// create a new group and fetch the group ID
				$enter_value = array(
				"profile_group_name"=>$_POST['new_profile_group_name'],
				"profile_parent_group_id"=>$_POST['new_group_parent_profile_group_id'],
				);
				$enter_action =insert_data("profile_groups",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
				$enter_r=mysql_query($enter_action);
				$profile_group_id = mysql_insert_id();
			}
			else 
			{
				$profile_group_id = $_POST['profile_group_id'];
			}

			// update profile_definitions
			$edit_value = array(
			"profile_name"=>$_POST['profile_name'],
			"profile_description"=>$_POST['profile_description'],
			"profile_group_id"=>$profile_group_id,
			);
			$edit_action =update_data("profile_definitions",array_to_string_update($edit_value),"id='" . $_POST['profile_id'] . "'");
			$edit_r=mysql_query($edit_action);

			$profile_id = $_POST['profile_id'];

			if($edit_r)
			{
				mysql_select_db($database_nfconx, $nfconx);
				$deleteSQL = "DELETE FROM profile_service_groups WHERE profile_id = '" . $profile_id . "'";
				$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
				
				$deleteSQL = "DELETE FROM profile_services WHERE profile_id = '" . $profile_id . "'";
				$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
				
				$deleteSQL = "DELETE FROM profile_service_elements WHERE profile_id = '" . $profile_id . "'";
				$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
				
				$deleteSQL = "DELETE FROM profile_service_custom_expression WHERE profile_id = '" . $profile_id . "'";
				$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
				
				// Insert into profile_service_groups
				
				$i = 1;
				do 
				{
					if ($_POST['service_group' . $i] <> "")
					{
						$enter_value = array(
						"profile_id"=>$profile_id,
						"service_group_id"=>$_POST['service_group' . $i],
						);
						$enter_action =insert_data("profile_service_groups",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
						$enter_r=mysql_query($enter_action);
					}
			
					// Insert into profile_services
					$service_group_id_for_pos = $_POST['service_group' . $i];	
			
					if ($service_group_id_for_pos <> "")
					{
						$j = 1;
						do 
						{
							$service_id = $_POST['service' . $service_group_id_for_pos . '_' . $j];
					
							if ($service_id <> "")
							{
								$enter_value = array(
								"profile_id"=>$profile_id,
								"service_id"=>$service_id,
								);
								$enter_action =insert_data("profile_services",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
								$enter_r=mysql_query($enter_action);
								// Add to profile_service_elements
							
								$k = 1;
								do 
								{
									$service_element_value = $_POST['element' . $service_group_id_for_pos . '_' . $j . '_' . $k];
									if ($service_element_value <> "")
									{
										$enter_value = array(
										"profile_id"=>$profile_id,
										"service_id"=>$service_id,
										"service_element_value"=>$service_element_value,
										);
										$enter_action =insert_data("profile_service_elements",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
										$enter_r=mysql_query($enter_action);
									}
									$k++;
								} 
								while ($k <= $_POST['service_elements_' . $service_id . '_count']);
							}
							$j++;
						} 
						while ($j <= $_POST['service_group_' . $i . '_service_count']);
					}
					$i++;
				} 
				while ($i <= $_POST['total_service_groups']);
			
				// Insert data into profile_service_custom_expression
				mysql_select_db($database_nfconx, $nfconx);
				$query_rsnf1 = "select *  from services_custom_expression where visible_in_profile = 1 ORDER by id ASC";
				$rsnf1 = mysql_query($query_rsnf1, $nfconx);
				$row_rsnf1 = mysql_fetch_assoc($rsnf1);
				$totalRows_rsnf1 = mysql_num_rows($rsnf1);
				if ($totalRows_rsnf1 > 0)
				{
					do 
					{
						$x_value_field_name = 'x_value' . $row_rsnf1['id'];	
						$x_condition_field_name = 'x_condition' . $row_rsnf1['id'];
						
						if (($_POST[$x_value_field_name] <> "") && ($_POST[$x_condition_field_name] <> ""))
						{
							if ($row_rsnf1['multiple_select'] == "Yes")
							{
								$x_value_multiple_values=$_POST[$x_value_field_name];
							
								if ($x_value_multiple_values)
								{
									foreach ($x_value_multiple_values as $t)
									{
										// Insert into profile_service_custom_expression
										$enter_value = array(
										"service_expression_id"=>$row_rsnf1['id'],			 
										"profile_id"=>$profile_id,
										"service_id"=>$row_rsnf1['service_id'],
										"condition_value"=>$_POST[$x_condition_field_name],
										"expression_value"=>$t,
										);
										$enter_action =insert_data("profile_service_custom_expression",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
										$enter_r=mysql_query($enter_action);
									}
								}
							} 
							else 
							{
								// Insert into profile_service_custom_expression
								$enter_value = array(
								"service_expression_id"=>$row_rsnf1['id'],			 
								"profile_id"=>$profile_id,
								"service_id"=>$row_rsnf1['service_id'],
								"condition_value"=>$_POST[$x_condition_field_name],
								"expression_value"=>$_POST[$x_value_field_name],
								);
								$enter_action =insert_data("profile_service_custom_expression",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
								$enter_r=mysql_query($enter_action);
							}
						}
					} 
					while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));	
				}
				$type = "announce";
				$message = "<b>Login profile - '" . $_POST['profile_name'] . "' successfully updated.</b>";
				include ("includes/announce.inc.php");	
				include 'includes/forms/setup_manage_profiles_list.php';
						}
		} 
		else 
		{
			$type = "error";
			$message = "Fatal Error!";
			include ("includes/announce.inc.php");	
			include 'includes/forms/setup_manage_profiles_list.php';
		}
	}
}

elseif ($_REQUEST['element'] == "delete")
{
	if ($_GET['id'] <> "")
	{
		$profile_user_count =  get_row_count(users,profile_id,"=",$_GET['id']);	
		if ($profile_user_count == 0)
		{	
			mysql_select_db($database_nfconx, $nfconx);
			$deleteSQL = "DELETE FROM profile_definitions WHERE id = '" . $_GET['id'] . "'";
			$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
			
			$deleteSQL = "DELETE FROM profile_service_groups WHERE profile_id = '" . $_GET['id'] . "'";
			$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
			
			$deleteSQL = "DELETE FROM profile_services WHERE profile_id = '" . $_GET['id'] . "'";
			$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
			
			$deleteSQL = "DELETE FROM profile_service_elements WHERE profile_id = '" . $_GET['id'] . "'";
			$Result = mysql_query($deleteSQL, $nfconx) or die(mysql_error());
			
			$type = "announce";
			$message = "Profile successfully deleted.";
			include ("includes/announce.inc.php");	
			include 'includes/forms/setup_manage_profiles_list.php';
		} 
		else 
		{
			$type = "error";
			$message = "Cannot delete this profile as there are " . $profile_user_count . " users associated to this profile.";
			include ("includes/announce.inc.php");	
			include 'includes/forms/setup_manage_profiles_list.php';	
		}
	}
}

elseif ($_REQUEST['element'] == "search")
{
	if ($_REQUEST['step'] <> 1)
	{
		include 'includes/forms/setup_manage_profiles_search.php';
	} 
	else 
	{
		include 'includes/forms/setup_manage_profiles_list.php';
	}
}
?>

