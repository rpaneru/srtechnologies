<?php 
// Disable E_ALL warnings...
ini_set("error_reporting", E_ALL & ~E_NOTICE);
ini_set ('display_errors', 1);


$NF_config['client_name'] =  "SRTechnologies";
$NF_config['app_name'] =  "SRTechnologies Core";
$NF_config['default_donor_profile_id'] =  "10";
$NF_config['default_bm_minor_profile_id'] =  "13";

// Database Settings
$NF_config['dbhost'] = "localhost";
$NF_config['dbport'] = '';
$NF_config['dbuser'] = 'root';
$NF_config['dbpwd'] = '';
$NF_config['dbname'] = 'srtechnologies';


$NF_config['inf_schema_db'] = 'information_schema';
$NF_config['tbl_type'] = 'MYISAM';

$NF_config['default_sender_email'] = 'admin@srtechnologies.com';
$NF_config['default_sender_email_pwd'] = 'mypassword';
$NF_config['email_host'] = 'smtp.gmail.com';
$NF_config['email_port'] = '465';

$NF_config['system_path'] = 'c:/xampp/htdocs/srtechnologies/admin';  
$NF_config['system_uri'] = 'http://localhost/srtechnologies/admin/'; 
$NF_config['app_uri'] = 'https://localhost/srtechnologies'; 
 
$NF_config['lib_include_path'] = $NF_config['system_path'] . '/includes/libraries';

$path = $NF_config['lib_include_path'];
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

// Database connection string
$database_nfconx = $NF_config['dbname'];
$database_schema = $NF_config['inf_schema_db'];
$nfconx = mysql_pconnect($NF_config['dbhost'], $NF_config['dbuser'], $NF_config['dbpwd']) or trigger_error(mysql_error(),E_USER_ERROR);
$nfconx_schema = mysql_pconnect($NF_config['dbhost'], $NF_config['dbuser'], $NF_config['dbpwd']) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_nfconx, $nfconx);


if (!function_exists("current_datetime")) 
{
	function current_datetime()
	{
		$zone=3600*5;
		$current_datetime = gmdate("Y-m-d H:i:s", time() - $zone);
		return $current_datetime;
	}
}

if (!function_exists("get_val_col")) 
{
	function get_val_col($table, $column, $condition, $value, $xtrasql = false)
	{
		global $database_nfconx;
		global $nfconx;
		mysql_select_db($database_nfconx, $nfconx);
		
		$column_val = "";
		$array_new = explode(",", $column);
		foreach ($array_new as $y) 
		{
			//$column .= $row_rsnf[$y] . " - ";
			$column_val .= $y . ",";
		}
		$column_val = substr($column_val,0,-1);
	
		$query_rsgetconf = "SELECT " . $column_val . " from " . $table . " WHERE " . $condition . " = '" . $value . "'" . $xtrasql;
		//echo $query_rsgetconf;
		$rsgetconf = mysql_query($query_rsgetconf, $nfconx);
		$row_rsgetconf = mysql_fetch_assoc($rsgetconf);
		//return $row_rsgetconf[$column];
		
		$column_lbl = "";
		$array_lbl = explode(",", $column);
		foreach ($array_lbl as $z) 
		{
			$column_lbl .= $row_rsgetconf[$z] . " - ";
		}
		$column_lbl = substr($column_lbl,0,-3);
		return $column_lbl;
	}
}
?>