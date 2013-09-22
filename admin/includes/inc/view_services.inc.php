<?php 

check_user_access($_GET['do'], $_SESSION['NF_Username']);

if ($_REQUEST['element'] == "")
{
	include 'includes/forms/view_services.php';
}
elseif ($_REQUEST['element'] == "create")
{
	if(isset($_REQUEST['Submit']))
	{
		$query = "select * from services where (service_group_id='".$_REQUEST['service_group_id']."' and service_name='".$_REQUEST['service_name']."') or (service_group_id='".$_REQUEST['service_group_id']."' and service_id='".$_REQUEST['service_id']."')";
		$result = mysql_query($query);
		if(mysql_num_rows($result)==0)
		{
				$enter_value = array(
				"service_group_id"=>$_REQUEST['service_group_id'],
				"service_name"=>$_REQUEST['service_name'],
				"service_id"=>$_REQUEST['service_id'],
				"service_description"=>str_replace('"',"'",$_REQUEST['service_description']),
				);
				$enter_action =insert_data("services",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
				if(mysql_query($enter_action))
				{
					$type = "announce";
					$message = '<b>Service added successfully</b>';
					include ("includes/announce.inc.php");
				}
		}
		else
		{
			$service_group_id = $_REQUEST['service_group_id'];
			$service_name = $_REQUEST['service_name'];			
			$service_description = $_REQUEST['service_description'];
			$service_id = $_REQUEST['service_id'];
			$type = "error";
			$message = '<b>Service already exist</b>';
			include ("includes/announce.inc.php");
		}

	}
		include 'includes/forms/add_new_service_form.php';
}
elseif($_REQUEST['element'] == "edit")
{
	 	$query = "select * from services where id='".$_REQUEST['id']."'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		
		$service_group_id = $row['service_group_id'];
		$service_name = $row['service_name'];			
		$service_description = $row['service_description'];
		$service_id = $row['service_id'];
		
		if(isset($_REQUEST['Submit']))
		{
			$query = "select * from services where (service_group_id='".$_REQUEST['service_group_id']."' and service_name='".$_REQUEST['service_name']."') or (service_group_id='".$_REQUEST['service_group_id']."' and service_id='".$_REQUEST['service_id']."')";
			$result = mysql_query($query);
			$row1 = mysql_fetch_array($result);
			
			if( $row1['id']==$row['id'] || mysql_num_rows($result)==0)
			{
				$service_group_id = "";
				$service_name = "";			
				$service_description = "";
				$service_id = "";
		
					$edit_value = array(
					"service_group_id"=>$_REQUEST['service_group_id'],
					"service_name"=>$_REQUEST['service_name'],
					"service_id"=>$_REQUEST['service_id'],
					"service_description"=>str_replace('"',"'",$_REQUEST['service_description']),
					);
					$edit_action =update_data("services",array_to_string_update($edit_value),"id='" . $_POST['id'] . "'");
					if($edit_r=mysql_query($edit_action))
					{
						$type = "announce";;
						$message = '<b>Service edited successfully.</b>';
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
		
		include 'includes/forms/add_new_service_form.php';
}
elseif($_REQUEST['element'] == "delete")
{
		if($_REQUEST['is_js_confirmed']==1)
		{
			$query = "delete from services where id='".$_REQUEST['id']."'";
			$result = mysql_query($query);
			
			$type = "error";
			$message = '<b>Services deleted successfully</b>';
			include ("includes/announce.inc.php");
			
			include 'includes/forms/add_new_service_form.php';
		}
}
else
{
		$type = "error";
		$message = '<b>Element not found</b>';
		include ("includes/announce.inc.php");
}
?>