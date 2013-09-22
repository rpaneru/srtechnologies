<?php



if (!function_exists("get_val_col")) {

function get_val_col($table, $column, $condition, $value)

{

global $database_nfconx;

global $nfconx;

mysql_select_db($database_nfconx, $nfconx);

$query_rsgetconf = "SELECT ".$column." from  ".$table."  WHERE  ".$condition." = '".$value."'";

$rsgetconf = mysql_query($query_rsgetconf);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

return $row_rsgetconf[$column];



}

}



if (!function_exists("get_val_col_multiple")) {

function get_val_col_multiple($table, $column, $condition, $value, $condition2, $value2)

{

global $database_nfconx;

global $nfconx;

mysql_select_db($database_nfconx, $nfconx);

$query_rsgetconf = "SELECT $column from $table WHERE $condition = '$value' AND  $condition2 = '$value2'";

//echo $query_rsgetconf;

$rsgetconf = mysql_query($query_rsgetconf, $nfconx);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

return $row_rsgetconf[$column];

}

}



if (!function_exists("draw_nav_menu")) {
function draw_nav_menu($service_group_id, $profile_id)

{



global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);



$query_rsnf = "SELECT * from profile_services ps, services s  WHERE s.service_id = ps.service_id AND ps.profile_id = '" . $profile_id . "' AND s.service_group_id = " . $service_group_id . " ORDER BY s.sort_order ASC";

//echo $query_rsnf;

$rsnf = mysql_query($query_rsnf, $nfconx);

$row_rsnf = mysql_fetch_assoc($rsnf);

$totalRows_rsnf = mysql_num_rows($rsnf);

if($totalRows_rsnf > 0){





do {

$string .= '<li><a href="core.php?do=' . $row_rsnf['service_id'] . '" title="' . $row_rsnf['service_description'] . '" alt="' . $row_rsnf['service_description'] . '">&raquo; ' . $row_rsnf['service_name'] . '</a></li>

';



} while ($row_rsnf = mysql_fetch_assoc($rsnf));







	

}

return $string;

}
}



if (!function_exists("draw_nav_menu_main")) {
function draw_nav_menu_main($profile_id)

{



global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);



$query_rsnf = "SELECT * from  profile_service_groups psg, services_group sg  WHERE psg.profile_id = '" . $profile_id . "' AND psg.service_group_id = sg.id ORDER BY sg.sort_order ASC";

//echo $query_rsnf;

$rsnf = mysql_query($query_rsnf, $nfconx);

$row_rsnf = mysql_fetch_assoc($rsnf);

$totalRows_rsnf = mysql_num_rows($rsnf);

$string = "";

if($totalRows_rsnf > 0){

	do {

	$string .=  '<li class="HasSubMenu"><a href="#" onclick="return false;" alt="' . $row_rsnf['service_group_description']. '" title="' . $row_rsnf['service_group_description']. '">' . $row_rsnf['service_group_name']. '</a>';

	$string .=	'<ul>

					';

	

	$string .= draw_nav_menu($row_rsnf['service_group_id'], $profile_id);

	

	$string .=  '

</ul>';

	$string .= '

	</li>

	';

	} while ($row_rsnf = mysql_fetch_assoc($rsnf));

	

	

	echo 	$string;

	

	

	}
}

}




if (!function_exists("draw_side_box")) {
function draw_side_box($service_group_id, $profile_id, $do)

{



global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);



$query_rsnf = "SELECT ps.service_id, s.* from profile_services ps, services s WHERE ps.profile_id='" . $profile_id . "' AND ps.service_id = s.service_id AND s.service_group_id = '" . $service_group_id . "' ORDER BY s.sort_order ASC";

//echo $query_rsnf;

$rsnf = mysql_query($query_rsnf, $nfconx);

$row_rsnf = mysql_fetch_assoc($rsnf);

$totalRows_rsnf = mysql_num_rows($rsnf);



if($totalRows_rsnf > 0){

//echo '<ul>';

do {



echo '

<tr>

<td class="left_nav_link';

if (!(strcmp($row_rsnf['service_id'], $do))) {echo " Selected";} 

echo '"';

echo '><a class="Nav" href="core.php?do=' . $row_rsnf['service_id'] . '">' . $row_rsnf['service_name'] . '</a></td>

</tr>';



} while ($row_rsnf = mysql_fetch_assoc($rsnf));

}

//echo '</ul>';		

}

}




if (!function_exists("check_user_access")) {
function check_user_access($service_id, $userid)

{

$profile_id = $profile_id = get_val_col(users,profile_id,userid,$userid);



if (get_val_col_multiple(profile_services, service_id, service_id, $service_id, profile_id, $profile_id) == ""){

$type = "error";

$message = "<b>You are not authorised to view this page</b>";

include ("includes/announce.inc.php");

exit();

} 


}
}



?>