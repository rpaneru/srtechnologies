<?php 

check_user_access($_GET['do'], $_SESSION['NF_Username']);

if ($_REQUEST['element'] == "")
{
	include 'includes/forms/view_service_groups.php';
}
elseif ($_REQUEST['element'] == "create")
{
	if(isset($_REQUEST['Submit']))
	{
		$query = "select * from services_group where service_group_name='".$_REQUEST['service_group_name']."'";
		$result = mysql_query($query);
		if(mysql_num_rows($result)==0)
		{
				$enter_value = array(
				"service_group_name"=>$_REQUEST['service_group_name'],
				"service_group_description"=>str_replace('"',"'",$_REQUEST['service_group_description']),
				);
				$enter_action =insert_data("services_group",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
				if(mysql_query($enter_action))
				{
					$type = "announce";
					$message = '<b>Service Group added successfully</b>';
					include ("includes/announce.inc.php");
				}
		}
		else
		{
			$service_group_name = $_REQUEST['service_group_name'];
			$service_group_description = $_REQUEST['service_group_description'];
			$type = "error";
			$message = '<b>Service Group already exist</b>';
			include ("includes/announce.inc.php");
		}

	}
		include 'includes/forms/add_new_service_group_form.php';
}
elseif($_REQUEST['element'] == "edit")
{
	 	$query = "select * from services_group where id='".$_REQUEST['service_group_id']."'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$service_group_name = $row['service_group_name'];
		$service_group_description = $row['service_group_description'];
		
		if(isset($_REQUEST['Submit']))
		{
			$query = "select * from services_group where service_group_name='".$_REQUEST['service_group_name']."'";
			$result = mysql_query($query);
			
			if($_REQUEST['name']==$name || mysql_num_rows($result)==0)
			{
				$service_group_name = "";
				$service_group_description = "";
					$enter_value = array(
					"service_group_name"=>$_REQUEST['service_group_name'],
					"service_group_description"=>str_replace('"',"'",$_REQUEST['service_group_description']),
					);
					$edit_action ="update services_group set service_group_name='".$_REQUEST['service_group_name']."', service_group_description='".$_REQUEST['service_group_description']."'  where id='".$_REQUEST['service_group_id']."'";
					if($edit_r=mysql_query($edit_action))
					{
						$type = "announce";;
						$message = '<b>Service Group edited successfully.</b>';
						include ("includes/announce.inc.php");
					}
			}
			else
			{
				$service_group_name = $_REQUEST['service_group_name'];
				$service_group_description = $_REQUEST['service_group_description'];
				$type = "error";
				$message = '<b>Service Group already exist</b>';
				include ("includes/announce.inc.php");
			}
	
		}
		
		include 'includes/forms/add_new_service_group_form.php';
}
elseif($_REQUEST['element'] == "delete")
{
		if($_REQUEST['is_js_confirmed']==1)
		{
			$query = "delete from services_group where id='".$_REQUEST['service_group_id']."'";
			$result = mysql_query($query);
			
			$query = "delete from services where service_group_id='".$_REQUEST['service_group_id']."'";
			$result = mysql_query($query);
			
			$type = "error";
			$message = '<b>Services Group deleted successfully</b>';
			include ("includes/announce.inc.php");
			
			include 'includes/forms/add_new_service_group_form.php';
		}
}
else
{
		$type = "error";
		$message = '<b>Element not found</b>';
		include ("includes/announce.inc.php");
}
?>