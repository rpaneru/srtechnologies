<?php
if (!function_exists("load_service_element_options")) 
{
	function load_service_element_options($profile_id, $service_id, $querystring, $element_placement)
	{
		global $database_nfconx;
		global $nfconx;
		mysql_select_db($database_nfconx, $nfconx);
		
		$query_rsnf2 = "select pse.service_element_value,se.* from profile_service_elements pse, service_elements se WHERE se.service_id=pse.service_id AND se.service_element_value=pse.service_element_value AND se.element_placement='" . $element_placement . "' AND pse.profile_id = '" . $profile_id . "' AND se.service_element_type = 'Internal' AND pse.service_id='" . $service_id . "' ORDER BY se.id ASC";
//echo $query_rsnf2;
		$rsnf2 = mysql_query($query_rsnf2, $nfconx);
		$row_rsnf2 = mysql_fetch_assoc($rsnf2);
		$totalRows_rsnf2 = mysql_num_rows($rsnf2);

		if ($totalRows_rsnf2 > 0)
		{
			do 
			{
				echo '<a href="core.php?do=' . $service_id . '&element=' . $row_rsnf2['service_element_value'] . $querystring . '"';
				$css_class = get_element_property(css_class, $row_rsnf2['service_element_value'],$service_id,$element_placement);
				if ($css_class <> "")
				{
					echo ' class="' . $css_class . '" ';
				}
				$javascript = get_element_property(javascript, $row_rsnf2['service_element_value'],$service_id,$element_placement);
				echo  stripslashes($javascript) . '><span>' . get_element_property(service_element_label, $row_rsnf2['service_element_value'],$service_id,$element_placement) . '</span></a>';
			} 
			while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));
		}
	}
}



if (!function_exists("load_service_element_options_external")) 
{
	function load_service_element_options_external($profile_id, $service_id, $external_uri, $element_placement)
	{
		global $database_nfconx;
		global $nfconx;
		mysql_select_db($database_nfconx, $nfconx);

		$query_rsnf2 = "select pse.service_id,se.* from profile_services pse, service_elements se WHERE se.external_service_id=pse.service_id AND se.element_placement='" . $element_placement . "' AND pse.profile_id = '" . $profile_id . "' AND se.service_element_type = 'External' AND se.service_id='" . $service_id . "' ORDER BY se.id ASC";
		//echo $query_rsnf2;
		$rsnf2 = mysql_query($query_rsnf2, $nfconx);
		$row_rsnf2 = mysql_fetch_assoc($rsnf2);
		$totalRows_rsnf2 = mysql_num_rows($rsnf2);
		if ($totalRows_rsnf2 > 0)
		{
			do 
			{
				echo '<a href="' . $row_rsnf2['external_service_uri'] . $external_uri . '"';
				$css_class = get_element_property(css_class, $row_rsnf2['service_element_value'],$service_id,$element_placement);
				if ($css_class <> "")
				{
					echo ' class="' . $css_class . '" ';
				}
				$javascript = get_element_property(javascript, $row_rsnf2['service_element_value'],$service_id,$element_placement);
				echo  stripslashes($javascript) . '><span>' . get_element_property(service_element_label, $row_rsnf2['service_element_value'],$service_id,$element_placement) . '</span></a>';
			} 
			while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));
		}
	}
}




if (!function_exists("load_service_element")) 
{
	function load_service_element($userid, $service_id,  $querystring, $element_placement, $external_uri=null)
	{
		if (basename($_SERVER["SCRIPT_NAME"]) == "core.php")
		{
			// get profile_id from userid
			$profile_id = get_val_col(users, profile_id, userid, $userid);
			if ($profile_id <> "")
			{
				// get all service_elements for service_id where service_element_type = External
				load_service_element_options_external($profile_id, $service_id, $external_uri, $element_placement);
				// get all service_elements for service_id where service_element_type = Internal
				load_service_element_options($profile_id, $service_id, $querystring, $element_placement);
			}
		}
	}
}




if (!function_exists("get_element_property")) 
{
	function get_element_property($column, $service_element_value, $service_id, $element_placement)
	{
		global $database_nfconx;
		global $nfconx;
		mysql_select_db($database_nfconx, $nfconx);

		if ($element_placement <> "")
		{
			$xtrasql = " AND element_placement = '" . $element_placement . "'";
		}
	
		$query_rsnf2 = "select " . $column . " from service_elements where service_id = '" . $service_id. "'  AND service_element_value = '" . $service_element_value . "'" . $xtrasql;
		//echo $query_rsnf2;
		$rsnf2 = mysql_query($query_rsnf2, $nfconx);
		$row_rsnf2 = mysql_fetch_assoc($rsnf2);
		$totalRows_rsnf2 = mysql_num_rows($rsnf2);
		if ($totalRows_rsnf2 > 0)
		{
			return $row_rsnf2[$column];
		} 
		else 
		{
			return $service_element_value;	
		}
	}
}
?>