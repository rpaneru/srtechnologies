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


function get_access_level(){

$access_level = get_val_col("users", "access_level", "userid", $_SESSION['NF_Username']);

return $access_level;

}

if (!function_exists("current_datetime")) {
function current_datetime(){

$zone=3600*5;
$current_datetime = gmdate("Y-m-d H:i:s", time() - $zone);

return $current_datetime;
}
}

function current_date(){

$zone=3600*5;

$current_date = gmdate("Y-m-d", time() - $zone);
	
return $current_date;
}


function current_cal_date(){

$zone=3600*5;
$current_cal_date = gmdate("D M d Y", time() - $zone);
return $current_cal_date;
}


function current_date_value($value){

$zone=3600*5;
$current_date = gmdate($value, time() - $zone);
	
return $current_date;
}

?>