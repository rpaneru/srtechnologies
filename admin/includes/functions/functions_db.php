<?php


if (!function_exists("get_table_comments")) {
function get_table_comments($table_name)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$q = mysql_query("show table status like '" . $table_name . "'") or die(mysql_error());

$str = mysql_result($q, 0, 'Comment'); 



return $str;
}
}


if (!function_exists("get_field_comments")) {
function get_field_comments($table_name,$field_name)

{

global $database_nfconx;

global $database_schema;

global $nfconx_schema;



mysql_select_db($database_schema, $nfconx_schema);

$query_rsgetconf = "SELECT COLUMN_COMMENT from COLUMNS WHERE TABLE_SCHEMA = '" . $database_nfconx . "' AND  TABLE_NAME = '" . $table_name . "' AND  COLUMN_NAME = '" . $field_name . "'";

//echo $query_rsgetconf;

$rsgetconf = mysql_query($query_rsgetconf, $nfconx_schema);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

return $row_rsgetconf['COLUMN_COMMENT'];
}
}




if (!function_exists("fetch_db_tables_dropdown")) {
function fetch_db_tables_dropdown($dropdown_name, $default_value, $valueset,$html_attributes)

{

global $database_nfconx;

global $database_schema;

global $nfconx_schema;



mysql_select_db($database_schema, $nfconx_schema);

$query_rsgetconf = "SELECT TABLE_NAME, TABLE_COMMENT from TABLES WHERE TABLE_SCHEMA = '" . $database_nfconx . "' AND 	TABLE_TYPE='BASE TABLE' AND TABLE_COMMENT <> ''  ORDER BY TABLE_COMMENT ASC";

$rsgetconf = mysql_query($query_rsgetconf, $nfconx_schema);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

$totalRows_rsgetconf = mysql_num_rows($rsgetconf);



echo '<select name="' . $dropdown_name . '" ' . $html_attributes . '>

';

if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}

do {





echo '<option value="' . $row_rsgetconf['TABLE_NAME'] . '" ';

if (!(strcmp($row_rsgetconf['TABLE_NAME'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' .$row_rsgetconf['TABLE_COMMENT'] . ' </option>

';





} while ($row_rsgetconf = mysql_fetch_assoc($rsgetconf));



echo '

</select> ';
}
}




if (!function_exists("fetch_db_columns_dropdown")) {
function fetch_db_columns_dropdown($dropdown_name, $table, $default_value, $valueset,$html_attributes)

{

global $database_nfconx;

global $database_schema;

global $nfconx_schema;



mysql_select_db($database_schema, $nfconx_schema);

$query_rsgetconf = "SELECT COLUMN_NAME, COLUMN_COMMENT, DATA_TYPE from COLUMNS WHERE TABLE_SCHEMA = '" . $database_nfconx . "' AND 	TABLE_NAME='" . $table. "' AND COLUMN_COMMENT <> ''  ORDER BY COLUMN_COMMENT ASC";

$rsgetconf = mysql_query($query_rsgetconf, $nfconx_schema);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

$totalRows_rsgetconf = mysql_num_rows($rsgetconf);



echo '<select name="' . $dropdown_name . '" ' . $html_attributes . '>

';

if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}

if ($totalRows_rsgetconf > 0){

do {





echo '<option value="' . $row_rsgetconf['COLUMN_NAME'] . '" ';

if (!(strcmp($row_rsgetconf['COLUMN_NAME'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' .$row_rsgetconf['COLUMN_COMMENT'] . ' </option>

';





} while ($row_rsgetconf = mysql_fetch_assoc($rsgetconf));

}

echo '

</select> ';



}
}


?>