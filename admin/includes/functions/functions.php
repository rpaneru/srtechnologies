<?php

include 'functions_db.php';

include 'function_number_format.php';

include 'functions_form.php';

include 'functions_file.php';

include 'functions_general.php';

include 'functions_service_profile_options.php';

include 'functions_email.php';



if (!function_exists("get_val_col")) {

function get_val_col($table, $column, $condition, $value, $xtrasql = false)

{

global $database_nfconx;

global $nfconx;

mysql_select_db($database_nfconx, $nfconx);



$column_val = "";

$array_new = explode(",", $column);

foreach ($array_new as $y) {

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

foreach ($array_lbl as $z) {

$column_lbl .= $row_rsgetconf[$z] . " - ";

}

$column_lbl = substr($column_lbl,0,-3);

return $column_lbl;

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

if (!function_exists("get_multiple_db_values")) {

function get_multiple_db_values($table, $column, $condition, $value, $distinct_flag = false, $xtrasql = false)

{

global $database_nfconx;

global $nfconx;

mysql_select_db($database_nfconx, $nfconx);

$query_rsgetconf = "SELECT ";

if ($distinct_flag == "DISTINCT"){

$query_rsgetconf .= " DISTINCT ";	

}

$query_rsgetconf .= $column . " from $table WHERE $condition = '$value' " . $xtrasql; 

//echo $query_rsgetconf;

$rsgetconf = mysql_query($query_rsgetconf, $nfconx);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

if ($row_rsgetconf > 0){

$outputstr = "";

do {

$outputstr .= $row_rsgetconf[$column] . ",";

} while ($row_rsgetconf = mysql_fetch_assoc($rsgetconf)); 

$output = substr($outputstr,0,-1);

return $output;

}

}

}


if (!function_exists("mynl2br")) {
function mynl2br($text) {

   return strtr($text, array("\r\n" => '<br />', "\r" => '<br />', "\n" => '<br />'));

} 
}


if (!function_exists("get_val_col_multiple3")) {
function get_val_col_multiple3($table, $column, $condition, $value, $condition2, $value2, $condition3, $value3)

{

global $database_nfconx;

global $nfconx;

mysql_select_db($database_nfconx, $nfconx);

$query_rsgetconf = "SELECT $column from $table WHERE $condition = '$value' AND  $condition2 = '$value2' AND  $condition3 = '$value3'";

//echo $query_rsgetconf;

$rsgetconf = mysql_query($query_rsgetconf, $nfconx);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

return $row_rsgetconf[$column];

}
}


if (!function_exists("get_val_col_multiple4")) {
function get_val_col_multiple4($table, $column, $condition, $value, $condition2, $value2, $condition3, $value3, $condition4, $value4)

{

global $database_nfconx;

global $nfconx;

mysql_select_db($database_nfconx, $nfconx);

$query_rsgetconf = "SELECT $column from $table WHERE $condition = '$value' AND  $condition2 = '$value2' AND  $condition3 = '$value3' AND  $condition4 = '$value4'";

//echo $query_rsgetconf;

$rsgetconf = mysql_query($query_rsgetconf, $nfconx);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

return $row_rsgetconf[$column];

}
}



if (!function_exists("get_val_col_multiple5")) {
function get_val_col_multiple5($table, $column, $condition, $value, $condition2, $value2, $condition3, $value3, $condition4, $value4, $condition5, $value5)

{

global $database_nfconx;

global $nfconx;

mysql_select_db($database_nfconx, $nfconx);

$query_rsgetconf = "SELECT $column from $table WHERE $condition = '$value' AND  $condition2 = '$value2' AND  $condition3 = '$value3' AND  $condition4 = '$value4' AND  $condition5 = '$value5'";

//echo $query_rsgetconf;

$rsgetconf = mysql_query($query_rsgetconf, $nfconx);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

return $row_rsgetconf[$column];
}
}




if (!function_exists("get_record_sorting")) {
function get_record_sorting($querystring,$sortby,$sort_direction)

{

if ($querystring <> ""){

parse_str($querystring,$output);



$url_sortby = $output['sortby'];

$url_sort_direction = $output['sort_direction'];

}



// check if page_url has sortby declared, if yes use the sortby from page else use one defined in the parameter



if ($url_sortby <> ""){

$new_sortby = $url_sortby;

} else {

$new_sortby = $sortby;

}



if ($url_sort_direction <> ""){

$new_sort_direction = $url_sort_direction;

} else {

$new_sort_direction = $sort_direction;

}

if (($new_sortby <> "") && ($new_sort_direction <> "")){

return  " ORDER BY " . 	$new_sortby . " " . $new_sort_direction . " ";

}

}

}




if (!function_exists("draw_record_sorter")) {
function draw_record_sorter($col_text,$col_name,$querystring,$system_root)

{

if ($querystring <> ""){

parse_str($querystring,$output);



$url_sortby = $output['sortby'];

$url_sort_direction = $output['sort_direction'];

}

if ($url_sort_direction == ""){

$url_sort_direction = "ASC";

}

// check if $col_name = url_sortby. If yes we will have sort_direction opposite of current order

if ($col_name == $url_sortby){

$new_sortby = $url_sortby;

if ($url_sort_direction == "ASC"){

$new_sort_image = "asc.gif";

$new_sort_direction = "DESC";	

} elseif ($url_sort_direction == "DESC"){

	$new_sort_image = "desc.gif";

$new_sort_direction = "ASC";

}

} else {

$new_sort_image = "sort.gif";

$new_sortby = $col_name;

$new_sort_direction = "ASC";	

}

// Head Sorter Image

$img_string = '<img src="'.	$system_root . '/images/' . $new_sort_image . '" class="headersorter" />';

// Build URL

$page_url = remove_querystring_var($querystring, sortby);

$page_url = remove_querystring_var($page_url, sort_direction);

$page_url = remove_querystring_var($page_url, page);



$html_link = $img_string . '&nbsp; &nbsp;<a href="core.php?' . $page_url . '&sortby=' . $new_sortby . '&sort_direction=' . $new_sort_direction . '&page=1">' . $col_text . '</a>';



echo  $html_link;

}

}






if (!function_exists("get_row_count")) {
function get_row_count($table, $condition, $operator, $value)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query = "SELECT COUNT(*) from " . $table . " WHERE " . $condition . $operator .  "'" . $value . "'";

$count = mysql_result(mysql_query($query),0);

return $count;
}
}



if (!function_exists("get_row_count_custom_sql")) {
function get_row_count_custom_sql($table, $sql)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);



$count = mysql_result(mysql_query("SELECT COUNT(*) from " . $table . " WHERE " . $sql . " "),0);

return $count;
}
}




if (!function_exists("get_row_count_multiple")) {
function get_row_count_multiple($table, $condition1, $operator1, $value1, $condition2, $operator2, $value2)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$count = mysql_result(mysql_query("SELECT COUNT(*) from " . $table . " WHERE " . $condition1 . $operator1 .  "'" . $value1 . "' AND " . $condition2 . $operator2 .  "'" . $value2 . "' "),0);

return $count;
}
}




if (!function_exists("get_row_count_multiple3")) {
function get_row_count_multiple3($table, $condition1, $operator1, $value1, $condition2, $operator2, $value2, $condition3, $operator3, $value3)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$count = mysql_result(mysql_query("SELECT COUNT(*) from " . $table . " WHERE " . $condition1 . $operator1 .  "'" . $value1 . "' AND " . $condition2 . $operator2 .  "'" . $value2 . "'  AND " . $condition3 . $operator3 .  "'" . $value3 . "' "),0);

return $count;
}
}



if (!function_exists("get_row_count_multiple4")) {
function get_row_count_multiple4($table, $condition1, $operator1, $value1, $condition2, $operator2, $value2, $condition3, $operator3, $value3, $condition4, $operator4, $value4)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$count = mysql_result(mysql_query("SELECT COUNT(*) from " . $table . " WHERE " . $condition1 . $operator1 .  "'" . $value1 . "' AND " . $condition2 . $operator2 .  "'" . $value2 . "'  AND " . $condition3 . $operator3 .  "'" . $value3 . "'  AND " . $condition4 . $operator4 .  "'" . $value4 . "' "),0);

return $count;
}
}



if (!function_exists("get_row_count_table")) {
function get_row_count_table($table)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$count = mysql_result(mysql_query("SELECT COUNT(*) from " . $table . ""),0);

return $count;
}
}




if (!function_exists("get_distinct_row_count")) {
function get_distinct_row_count($table, $column, $condition, $operator, $value)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsgetconf = "SELECT DISTINCT " . $column . " from " . $table . " WHERE  " . $condition . $operator .  "'" . $value . "'";

$rsgetconf = mysql_query($query_rsgetconf, $nfconx);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

$totalRows_rsgetconf = mysql_num_rows($rsgetconf);

return $totalRows_rsgetconf;
}
}


if (!function_exists("get_next_autoincrement")) {
function get_next_autoincrement($table_name)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$q = mysql_query("show table status like '" . $table_name . "'") or die(mysql_error());

$next_no = mysql_result($q, 0, 'Auto_increment'); // the next autoincrement value
return $next_no;
}
}



if (!function_exists("GetDBColumnOptions")) {
function GetDBColumnOptions($table,$field)

{

global $database_nfconx;



mysql_select_db($database_nfconx);

$query=mysql_query("SHOW COLUMNS FROM ".$table." LIKE

'".$field."'") or die (mysql_error());

if(mysql_num_rows($query)>0)

{

$row=mysql_fetch_row($query);

$options=explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2",$row[1]));

return $options;

}



}
}





if (!function_exists("mysql_fetch_fields")) {
function mysql_fetch_fields($table) {



global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);



        // LIMIT 1 means to only read rows before row 1 (0-indexed)

        $result = mysql_query("SELECT * FROM $table LIMIT 1");

        $describe = mysql_query("SHOW COLUMNS FROM $table");

        $num = mysql_num_fields($result);

        $output = array();

        for ($i = 0; $i < $num; ++$i) {

                $field = mysql_fetch_field($result, $i);

                // Analyze 'extra' field

                $field->auto_increment = (strpos(mysql_result($describe, $i, 'Extra'), 'auto_increment') === FALSE ? 0 : 1);

                // Create the column_definition

                $field->definition = mysql_result($describe, $i, 'Type');

                if ($field->not_null && !$field->primary_key) $field->definition .= ' NOT NULL';

                if ($field->def) $field->definition .= " DEFAULT '" . mysql_real_escape_string($field->def) . "'";

                if ($field->auto_increment) $field->definition .= ' AUTO_INCREMENT';

                if ($key = mysql_result($describe, $i, 'Key')) {

                        if ($field->primary_key) $field->definition .= ' PRIMARY KEY';

                        else $field->definition .= ' UNIQUE KEY';

                }

                // Create the field length

                $field->len = mysql_field_len($result, $i);

                // Store the field into the output

                $output[$field->name] = $field;

        }

        return $output;

}
}



if (!function_exists("get_month_total_days")) {
function get_month_total_days($date)

{

return date('t',strtotime($date));

}
}




if (!function_exists("get_days_difference")) {
function get_days_difference($beginDate,$endDate)

{

$beginDate = explode("-",$beginDate);

$beginDate_ts = mktime(0,0,0,$beginDate[1],$beginDate[2],$beginDate[0]);



$endDate = explode("-",$endDate);

$endDate_ts = mktime(0,0,0,$endDate[1],$endDate[2],$endDate[0]);



$diff = $endDate_ts - $beginDate_ts;

$diff = ceil($diff / (60*60*24)) ;

return $diff;
}
}



if (!function_exists("get_nth_record")) {
function get_nth_record($table, $column, $condition, $operator, $value, $position, $sorting)

{

global $database_nfconx;

global $nfconx;

$from = $position - 1;

mysql_select_db($database_nfconx, $nfconx);

$query_rsgetconf = "SELECT " . $column . " from " . $table . " WHERE  " . $condition . $operator .  "'" . $value . "' ORDER BY " . $sorting . " LIMIT $from, 1 ";

//echo $query_rsgetconf;

$rsgetconf = mysql_query($query_rsgetconf, $nfconx);

$row_rsgetconf = mysql_fetch_assoc($rsgetconf);

$totalRows_rsgetconf = mysql_num_rows($rsgetconf);

return $row_rsgetconf[$column];
}
}








if (!function_exists("format_date_local")) {
function format_date_local($date)

{

if (($date <> "") && ($date <> "0000-00-00") && ($date <> "0000-00-00 00:00:00")){

$formatted_date = date("m/d/Y", strtotime($date));

return $formatted_date; 

}
}
}



if (!function_exists("format_datetime_local")) {
function format_datetime_local($datetime)

{

if (($datetime <> "") && ($datetime <> "0000-00-00 00:00:00")){

$formatted_datetime = date("M d, Y (g:i a)", strtotime($datetime));

return $formatted_datetime; 

}
}
}




if (!function_exists("format_date_mysql")) {
function format_date_mysql($date)

{

	if ($date <> ""){

$formatted_date = date("Y-m-d", strtotime($date));

return $formatted_date; 

	}

}
}







if (!function_exists("format_date_system")) {
function format_date_system($date) //input format: m/d/yy or yyyy

{

	if ($date <> ""){

$dtmp = explode("/",$date);

$dadate = mktime(0,0,0,$dtmp[0],$dtmp[1],$dtmp[2]);

return date("Y-m-d",$dadate);

	}
}
}


if (!function_exists("get_year_from_date")) {
function get_year_from_date($date)

{

$date = substr($date,0,4);

return $date;
}
}


if (!function_exists("get_month_from_date")) {
function get_month_from_date($date)

{

$date = substr($date,5,2);

return $date;
}
}



if (!function_exists("get_day_from_date")) {
function get_day_from_date($date)

{

$date = substr($date,8,2);

return $date;
}
}



if (!function_exists("format_date_standard")) {
function format_date_standard($date)
{

if ($date <> ""){

$year = substr($date,0,4);

$month = substr($date,5,2);

$month = str_replace("-","",$month);

if (strlen($month) == 1){

$month = "0" . $month;

}

$day = substr($date,-2);

$day = str_replace("-","",$day);

if (strlen($day) == 1){

$day = "0" . $day;

}

$standard_date = $year . '-' . $month . '-' . $day;

return $standard_date;

}
}
}



if (!function_exists("format_time_standard")) {
function format_time_standard($time)

{

$formatted_time = date('h:i A', strtotime($time));

return $formatted_time; 
}
}


if (!function_exists("get_sum")) {
function get_sum($table,$column,$custom_sql = false)

{

global $database_nfconx;

global $nfconx;

$xtrasql = "";





mysql_select_db($database_nfconx, $nfconx);

$query_rsnf2 = "SELECT sum(" . $column . ") from " . $table . "  " . $custom_sql;

//echo $query_rsnf2;

$rsnf2 = mysql_query($query_rsnf2, $nfconx);

$row_rsnf2 = mysql_fetch_assoc($rsnf2);

$totalRows_rsnf2 = mysql_num_rows($rsnf2);

if ($totalRows_rsnf2 > 0){

return $row_rsnf2['sum(' . $column . ')'];

} else { return 0; }

}
}



if (!function_exists("draw_limit_dropdown")) {
function draw_limit_dropdown($dropdown_name, $start, $end, $unit, $title)

{

echo ' <select name="' . $dropdown_name . '">

';

if ($title <> ""){

echo '	    <option value="">' . $title . '</option>

	 ';	

}

$i = $start;

while ($i <= $end):



	 echo '	    <option value="' . $i . '">' . $i . '</option>

	 ';

			



$i = $i + $unit;

endwhile;

echo '</select> '; 
}
}


if (!function_exists("draw_limit_dropdown_value")) {
function draw_limit_dropdown_value($dropdown_name, $start, $end, $unit, $title, $value)

{

echo ' <select id="'.$dropdown_name.'" name="' . $dropdown_name . '">

';

if ($title <> ""){

echo '	    <option value="noValue">' . $title . '</option>

	 ';	

}

$i = $start;

while ($i <= $end):



echo '<option ';

if (!(strcmp($i, $value))) {echo " selected=\"selected\"";}

echo '	    value="' . $i . '">' . $i . '</option>

	 ';



$i = $i + $unit;

endwhile;

echo '</select> '; 

}


if (!function_exists("draw_limit_dropdown_value_dates")) {
function draw_limit_dropdown_value_dates($dropdown_name, $start, $end, $unit, $title, $value, $style_abr = false)

{

echo ' <select name="' . $dropdown_name . '" ' . $style_abr . '>

';

if ($title <> ""){

echo '	    <option value="">' . $title . '</option>

	 ';	

}

$i = $start;

while ($i <= $end):



echo '<option ';

if (!(strcmp($i, intval($value)))) {echo " selected=\"selected\"";}

echo '	    value="' . sprintf("%02d",$i) . '">' . sprintf("%02d",$i) . '</option>

	 ';



$i = $i + $unit;

endwhile;

echo '</select> '; 
}
}
}


if (!function_exists("draw_dropdown")) {
function draw_dropdown($dbtbl, $col1, $col2, $sorting, $condition, $operator, $value, $dropdown_name, $default_value, $valueset, $javascript)

{

global $database_nfconx;

global $nfconx;



if ($condition <> ""){ $whr_clause = " WHERE " . $condition . $operator . "'" . $value . "'"; }



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf2 = "SELECT * FROM $dbtbl $whr_clause ORDER BY $sorting";

//echo $query_rsnf2;

$rsnf2 = mysql_query($query_rsnf2, $nfconx);

$row_rsnf2 = mysql_fetch_assoc($rsnf2);

$totalRows_rsnf2 = mysql_num_rows($rsnf2);



echo '<select name="' . $dropdown_name . '" ';

if ($javascript <> ""){

	echo $javascript;

}

echo '>

';

if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}

do {

$dropdown_label = "";

if ($totalRows_rsnf2 > 0) {

echo '<option value="' . $row_rsnf2[$col1] . '"';



if (!(strcmp($row_rsnf2[$col1], $valueset))) {echo " selected=\"selected\"";}

echo  '>';

//if col2 has many words separated by comma, split into arrays



$array_new = explode(",", $col2);

foreach ($array_new as $y) {

$dropdown_label .= $row_rsnf2[$y] . " - ";

}



echo substr($dropdown_label,0,-2);



echo '</option>

';



}

} while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

echo '</select>';
}
}




if (!function_exists("get_month_string")) {
function get_month_string($month)

{

if ($month == "10"){ $month_var = "Oct"; }

elseif ($month == "11"){ $month_var = "Nov"; }

elseif ($month == "12"){ $month_var = "Dec"; }

elseif ($month == "01"){ $month_var = "Jan"; }

elseif ($month == "02"){ $month_var = "Feb"; }

elseif ($month == "03"){ $month_var = "Mar"; }

elseif ($month == "04"){ $month_var = "Apr"; }

elseif ($month == "05"){ $month_var = "May"; }

elseif ($month == "06"){ $month_var = "Jun"; }

elseif ($month == "07"){ $month_var = "Jul"; }

elseif ($month == "08"){ $month_var = "Aug"; }

elseif ($month == "09"){ $month_var = "Sep"; }



return $month_var;
}
}




if (!function_exists("remove_querystring_var")) {
function remove_querystring_var($url, $key) {

$url = preg_replace('/(.*)(\?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');

$url = substr($url, 0, -1);

return ($url);
}
}




if (!function_exists("draw_pagination")) {
function draw_pagination($currentpage, $recordperpage, $totalrecords, $page_url)

{

//$page = remove_querystring_var($page_url, element);

$page = $page_url;

$page = remove_querystring_var($page, page);

$totalRows_rsnf = $totalrecords;

$total_pages = ceil($totalRows_rsnf / $recordperpage); 



$totallinkpage = 10;

if ($total_pages < 10){

$totallinkpage = $total_pages;

}





$linkpage_from = $currentpage;



$linkpage_to = ($linkpage_from + $totallinkpage) - 1;



if ($total_pages < $linkpage_to){

$linkpage_to = $total_pages;

}

if ($linkpage_from > 5){

//$linkpage_from = $currentpage - 5; 

}



$i=$linkpage_from;

if ($total_pages > 10){

$pageto = 10;

}

else {

$pageto = $total_pages;

}

if ($total_pages > 1){

echo '<strong>Page:</strong>  &nbsp; ';

if ($currentpage <> 1){

  $prevpage = $currentpage - 1;

   echo '<a href="' . $page. '&page=1" class="pagelink" alt="First" title="First"> &laquo; First </a>';

   echo '<a href="' . $page. '&page=' . $prevpage . '" class="pagelink" alt="' . $prevpage . '" title="' . $prevpage . '"> &laquo; Previous </a>';

}

while($i<=$linkpage_to)

  {

  if ($i == $linkpage_from){ echo '<span class="current">' . $i . '</span>'; }

  else {   echo '<a href="' . $page. '&page=' . $i . '" class="pagelink" alt="' . $i . '" title="' . $i . '">' . $i . '</a>';

}

  $i++;

  }

  if ($currentpage <> $total_pages){

  $nextpage = $currentpage + 1;

   echo '<a href="' . $page. '&page=' . $nextpage . '" class="pagelink" alt="' . $nextpage . '" title="' . $nextpage . '"> Next &raquo;</a>';

    echo '<a href="' . $page. '&page=' . $total_pages . '" class="pagelink" alt="Last" title="Last"> Last &raquo;</a>';

  }

} 
}
}


if (!function_exists("get_max_results_per_page")) {
function get_max_results_per_page($NF_MAX_RESULTS)

{

if ($NF_MAX_RESULTS > 0){

return $NF_MAX_RESULTS;

} else {

return 20;

}
}
}




if (!function_exists("draw_max_result_dropdown")) {
function draw_max_result_dropdown($dropdown_name, $default_value, $valueset, $javascript)

{



echo '<select name="' . $dropdown_name . '" ';

if ($javascript <> ""){

	echo $javascript;

}

echo '>

';

if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}



echo '<option value="20"';

if (!(strcmp("20", $valueset))) {echo " selected=\"selected\"";}

echo  '>20</option>

';

echo '<option value="50"';

if (!(strcmp("50", $valueset))) {echo " selected=\"selected\"";}

echo  '>50</option>

';

echo '<option value="100"';

if (!(strcmp("100", $valueset))) {echo " selected=\"selected\"";}

echo  '>100</option>

';

echo '<option value="500"';

if (!(strcmp("500", $valueset))) {echo " selected=\"selected\"";}

echo  '>500</option>

';

echo '<option value="9999999999"';

if (!(strcmp("9999999999", $valueset))) {echo " selected=\"selected\"";}

echo  '>All</option>

';

echo '</select>';
}
}












if (!function_exists("get_service_groups_javascript")) {
function get_service_groups_javascript()

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select * from services_group ORDER BY service_group_name ASC";

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

echo '<script language=JavaScript>

';

$i = 1;

do {

echo 'function ToggleServiceTable' . $row_rsnf1['id'] . '(Which)

		{

			if(Which == 0){

				document.getElementById("table_service' . $row_rsnf1['id'] . '").style.display  = "none";

					

			

			}else{

				document.getElementById("table_service' . $row_rsnf1['id'] . '").style.display  = "";

				

				

				}

		}

		';

		$i++;

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));



echo '</script>

';
}
}




if (!function_exists("get_service_expression_select_js")) {
function get_service_expression_select_js()

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select * from services_custom_expression WHERE multiple_select = 'Yes' ORDER BY id ASC";

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);



do {

echo ' $("#custom_expression' . $row_rsnf1['id'] . '").dropdownchecklist({ width: 100 });

';





} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));




}
}




if (!function_exists("get_service_groups_form")) {
function get_service_groups_form($profile_id,$master_profile_id = false)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

if ($master_profile_id == ""){

$query_rsnf1 = "select * from services_group ORDER BY service_group_name ASC";

} else {

$query_rsnf1 = "SELECT sg.id, sg.service_group_name, psg.profile_id

FROM services_group sg, profile_service_groups psg

WHERE psg.service_group_id = sg.id

AND psg.profile_id ='" . $master_profile_id . "' ORDER BY sg.service_group_name ASC";

}

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

$i = 1; 

$k = 1;

?>

 <tr>

        <th colspan="2">Access Settings:<input name="total_service_groups" type="hidden" value="<?php echo $totalRows_rsnf1; ?>" /></th>

      </tr>

 <tr>

        <td width="30%" rowspan="<?php echo $totalRows_rsnf1 + 1; ?>" align="right" style="padding:0px; margin:0px">

        

        <table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:0px; border:0px">

            <tr>

              <td width="80%"  class="row1" style="border-right:0px; padding:5px" align="right"><strong>Yes</strong></td>

              <td width="20%" class="row2" style="border-left:0px;  padding:5px"><strong>No</strong></td>

            </tr>

            <?php 

			do {

				$$k = $row_rsnf1['service_group_name'];

				if ($profile_id <> ""){

					if (get_val_col_multiple(profile_service_groups, service_group_id, profile_id, $profile_id, service_group_id, $row_rsnf1['id']) <> ""){

					$yes_option_check_status = ' checked="checked" ';

					$no_option_check_status = '';

					} else {

					$yes_option_check_status = '';

					$no_option_check_status = ' checked="checked" ';

					}

				} else {

					$yes_option_check_status = '';

					$no_option_check_status = ' checked="checked" ';

				}

				?>

            <tr>

              <td  class="row1" style="border-right:0px; text-align:right; padding:5px">&nbsp;<input name="service_group<?php echo $i; ?>" type="radio" value="<?php echo $row_rsnf1['id']; ?>" <?php echo $yes_option_check_status; ?> onclick="ToggleServiceTable<?php echo $row_rsnf1['id']; ?>(1);window.location.href='#ServiceTable<?php echo $row_rsnf1['id']; ?>';" /></td>

              <td class="row2" style="border-left:0px; text-align:left; padding:5px"><input name="service_group<?php echo $i; ?>" type="radio" value="" <?php echo $no_option_check_status; ?> onclick="ToggleServiceTable<?php echo $row_rsnf1['id']; ?>(0);"/></td>

            </tr>

            <?php 

			$i++;

			$k++;

			} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1)); ?>

            <tr>

           

        </table>

        

        </td>

        <td class="row2"><strong>Tab Name</strong></td>

      </tr>

    <?php

      $j = 1;

do { ?>

 

 <tr>

        <td width="70%" class="row2"><?php echo $$j; ?></td>

      </tr>

 <?php 

 $j++;

 } while ($j <= $totalRows_rsnf1);

?>   

      



<?php

$i++; 


}
}




if (!function_exists("get_servicegroup_services_form")) {
function get_servicegroup_services_form($profile_id,$master_profile_id = false)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);



if ($master_profile_id == ""){

$query_rsnf1 = "select * from services_group ORDER BY service_group_name ASC";

} else {

$query_rsnf1 = "SELECT sg.id, sg.service_group_name, psg.profile_id

FROM services_group sg, profile_service_groups psg

WHERE psg.service_group_id = sg.id

AND psg.profile_id ='" . $master_profile_id . "' ORDER BY sg.service_group_name ASC";

}



$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

$i = 1;	

do {

echo '

<tr><td colspan="2" style="padding:0px">

<a name="ServiceTable' . $row_rsnf1['id'] . '"></a>

<table id="table_service' . $row_rsnf1['id'] . '"';

if ($profile_id == ""){

	echo ' style="display:none;" ';

} else {



if (get_val_col_multiple(profile_service_groups,service_group_id,profile_id,$profile_id,service_group_id,$row_rsnf1['id']) == "" ){

	echo ' style="display:none;" ';

} else {

echo '';	

}

}



echo '>

<tr>

      <th colspan="2">' . $row_rsnf1['service_group_name'] .  ' <input name="service_group_' . $i . '_service_count" type="hidden" value="' . get_row_count(services, service_group_id, "=", $row_rsnf1['id']) . '" />

	  </th>

      </tr>

	  ';

	  

get_services_form($row_rsnf1['id'],$profile_id,$master_profile_id);

echo "</tr>

</table>

</td></tr>";

$i++;

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1)); 	

}
}



if (!function_exists("get_services_form")) {
function get_services_form($service_group_id,$profile_id,$master_profile_id = false)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);



if ($master_profile_id == ""){

$query_rsnf1 = "select * from services WHERE service_group_id = '" . $service_group_id . "' ORDER BY service_name ASC";

} else {

$query_rsnf1 = "SELECT s . *

FROM services s, profile_services ps

WHERE s.service_group_id = '" . $service_group_id . "'

AND s.service_id = ps.service_id

AND ps.profile_id ='" . $master_profile_id . "'

ORDER BY s.service_name ASC ";



}









$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

$i = 1;	



if ($totalRows_rsnf1 > 0){

do {

echo '

<tr>

        <td width="30%" class="row1" align="right" valign="top">&nbsp;</td>

        <td width="70%" class="row2">

        <input name="service' . $service_group_id . '_' . $i . '" id="service' . $service_group_id . '_' . $i . '_' . $row_rsnf1['service_id'] . '" type="checkbox" onclick="showMe(\'div_options_' . $row_rsnf1['service_id'] . '\', this)" value="' . $row_rsnf1['service_id'] . '"';

		if ($profile_id <> ""){

			if (get_val_col_multiple(profile_services,service_id,service_id,$row_rsnf1['service_id'],profile_id,$profile_id)<> ""){

				$current_status = "show";

			echo ' checked="checked" ';	

			} else {

				$current_status = "hide";

			}

		} else {

			$current_status = "hide";

		}

		

echo '> <label for="service' . $service_group_id . '_' . $i . '_' . $row_rsnf1['service_id'] . '">' . $row_rsnf1['service_name'] . '</label>

';

echo '<div id="div_options_' . $row_rsnf1['service_id'] . '"';

if ($current_status == "hide"){

	echo ' style="display:none"';

} else {

	echo ' style="display:block"';

}

echo '>';

get_services_custom_expression($row_rsnf1['service_id'],$profile_id);	

	  

get_service_elements_form($service_group_id,$row_rsnf1['service_id'],$i,$profile_id,$master_profile_id);		

		

echo '</div>

</td>

</tr>



';



$i++;

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1)); 	

}

}
}


if (!function_exists("get_service_elements_form")) {
function get_service_elements_form($service_group_id,$service_id,$service_counter,$profile_id,$master_profile_id = false)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);





if ($master_profile_id == ""){

$query_rsnf1 = "select * from service_elements WHERE service_id = '" . $service_id . "' AND service_element_type = 'Internal' ORDER BY id ASC";

} else {

$query_rsnf1 = "SELECT se . *

FROM service_elements se, profile_service_elements pse

WHERE se.service_id = '" . $service_id . "'  AND service_element_type = 'Internal' 

AND se.service_id = pse.service_id AND se.service_element_value = pse.service_element_value

AND pse.profile_id ='" . $master_profile_id . "'

 ORDER BY se.id ASC ";



}





$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);





echo '<input name="service_elements_' . $service_id . '_count" type="hidden" value="' . $totalRows_rsnf1 . '" />';

if ($totalRows_rsnf1 > 0){

	echo '

<!--Service Elements Starts-->    

<br><br />';

echo '

<div style="padding-left:28px" class="Small">';



$i = 1;	

do {



echo '

<input name="element' . $service_group_id . '_' . $service_counter . '_' . $i . '" id="element' . $service_group_id . '_service' . $service_id . '_' . $i . '_' . $row_rsnf1['service_element_value'] . '" type="checkbox" value="' . $row_rsnf1['service_element_value'] . '"';

if ($profile_id <> ""){

			if (get_val_col_multiple3(profile_service_elements,service_element_value,service_id,$service_id,profile_id,$profile_id,service_element_value,$row_rsnf1['service_element_value'])<> ""){

			echo ' checked="checked" ';	

			}

		} 



echo '> <label for="element' . $service_group_id . '_service' . $service_id . '_' . $i . '_' . $row_rsnf1['service_element_value'] . '">' . $row_rsnf1['service_element_label'];

if ($row_rsnf1['service_element_description'] <> ""){

echo ' - ';

}

echo  $row_rsnf1['service_element_description'] . '</label>

<br /><br />';



$i++;

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));



echo '

</div>';

}

echo '

<!--Service Elements Ends--> ';


}
}


if (!function_exists("get_services_custom_expression")) {
function get_services_custom_expression($service_id,$profile_id)

{

global $database_nfconx;

global $nfconx;





mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from services_custom_expression where service_id = '" . $service_id . "' AND visible_in_profile = 1 ORDER by id ASC";

//echo $query_rsnf1;



$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

$j = 1;

if ($totalRows_rsnf1 > 0){

echo '<div style="float:right; text-align:right; verticle-align:top" class="Small">';

do {	

echo $row_rsnf1['db_column_label'] . " ";



$condition_display_function = explode("~", $row_rsnf1['condition_display_function']);

$value_display_function = explode("~", $row_rsnf1['value_display_function']);





if ($profile_id <> ""){



$query_rsnf = "select *  from profile_service_custom_expression where profile_id = '" . $profile_id . "' AND service_expression_id = '" . $row_rsnf1['id'] . "' ORDER by id ASC";



$rsnf = mysql_query($query_rsnf, $nfconx);

$row_rsnf = mysql_fetch_assoc($rsnf);

$totalRows_rsnf = mysql_num_rows($rsnf);

$condition_display_function_str = "";

if ($totalRows_rsnf > 0){

do {

$condition_display_function_str .= $row_rsnf['expression_value'].",";

} while ($row_rsnf = mysql_fetch_assoc($rsnf));

$condition_display_function_str = substr($condition_display_function_str,0,-1);



$value_display_function_new = array();

array_push($value_display_function_new,$value_display_function[0],$value_display_function[1],$condition_display_function_str,$value_display_function[3],$value_display_function[4],$value_display_function[5],$value_display_function[6],$value_display_function[7],$value_display_function[8],$value_display_function[9],$value_display_function[10],$value_display_function[11]);



$value_display_function = "";

$value_display_function = $value_display_function_new;



}



}









call_user_func_array(draw_html_control,$condition_display_function);

echo " &nbsp; ";

call_user_func_array(draw_html_control,$value_display_function);

echo ' &nbsp; <span title="header=[' . $row_rsnf1['db_column_label'] . '] body=[' . $row_rsnf1['expression_description'] . ']"><img src="images/info.gif" /></span>';

echo "<br><br>";



$j++;

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));



echo '</div>';



}
}


}











if (!function_exists("draw_profile_group_dropdown")) {

function draw_profile_group_dropdown($dropdown_name,$valueset,$default_value,$new_group,$parent_null,$html_attributes_string)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from profile_groups where profile_parent_group_id = '0' ORDER by profile_group_name ASC";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

echo '<select name="' . $dropdown_name . '" ' . $html_attributes_string . '>

';



if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}

if ($parent_null == "Yes"){

echo '<option value="0"> [Top] </option>

	';

	}	

	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '<option value="' . $row_rsnf1['id'] . '" ';

if (!(strcmp($row_rsnf1['id'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' . $row_rsnf1['profile_group_name'] . ' </option>

';

get_profile_group_dropdown_options($row_rsnf1['id'],$valueset);

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}

if ($new_group == "Yes"){

echo '<option value="NEW_GROUP"> [New Group] </option>

	';

	}

echo '

</select> ';


}
}




if (!function_exists("get_profile_group_dropdown_options")) {
function get_profile_group_dropdown_options($parent_group_id,$valueset)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from profile_groups where profile_parent_group_id = '" . $parent_group_id . "' ORDER by profile_group_name ASC";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);



	

if ($totalRows_rsnf1 > 0){



do {	

echo '<option value="' . $row_rsnf1['id'] . '" ';

if (!(strcmp($row_rsnf1['id'], $valueset))) {echo " selected=\"selected\"";}

echo '>';

$profile_group_parent_count = profile_group_parent_count($row_rsnf1['id']);

$i = 1;

do {

echo " &nbsp; &nbsp; ";

$i++;

} while ($i <= $profile_group_parent_count);



echo " &raquo; " . $row_rsnf1['profile_group_name'] . ' </option>

';

get_profile_group_dropdown_options($row_rsnf1['id'],$valueset);

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}




}
}




if (!function_exists("profile_group_parent_count")) {
function profile_group_parent_count($profile_group_id)

{



$profile_group_parent_id = get_val_col(profile_groups,profile_parent_group_id,id,$profile_group_id);



if ($profile_group_parent_id <> "0"){



$counter = array();

do {

$profile_group_parent_id = get_val_col(profile_groups,profile_parent_group_id,id,$profile_group_parent_id);

array_push($counter, $profile_group_parent_id);

if ($profile_group_parent_id == 0) {

break;

}



} while (100);



$total_parents = count($counter);

return $total_parents;



} else {

return 0;

}
}
}










if (!function_exists("draw_profile_group_tree")) {
function draw_profile_group_tree($profile_parent_group_id)

{

global $database_nfconx;

global $nfconx;





mysql_select_db($database_nfconx, $nfconx);

$query_rsnf2 = "SELECT * FROM profile_groups WHERE profile_parent_group_id = '" . $profile_parent_group_id . "'  ORDER BY profile_group_name ASC ";

//echo $query_rsnf2;

$rsnf2 = mysql_query($query_rsnf2, $nfconx);

$row_rsnf2 = mysql_fetch_assoc($rsnf2);

$totalRows_rsnf2 = mysql_num_rows($rsnf2);



if ($totalRows_rsnf2 > 0){

echo "

<ul>

";

do {



echo "<li style=\"list-style:none\">

";

$profile_count = get_row_count(profile_definitions, profile_group_id, "=", $row_rsnf2['id']);

if ($profile_count > 0){

echo '<a rel="facebox" href="popup.php?do=setup_manage_profiles&amp;profile_group_id=' . $row_rsnf2['id'] . '">';

}

echo  $row_rsnf2['profile_group_name'];

if ($profile_count > 0){

echo "</a> <span class='Small'>(" . $profile_count . ")</span>";

}









draw_profile_group_tree($row_rsnf2['id']);



echo "</li>

";



} while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

echo "</ul>

";

}




}
}








if (!function_exists("draw_roles_tree")) {
function draw_roles_tree($parent_role_id)

{

global $database_nfconx;

global $nfconx;





mysql_select_db($database_nfconx, $nfconx);

$query_rsnf2 = "SELECT * FROM roles WHERE parent_role_id = '" . $parent_role_id . "'  ORDER BY role_name ASC ";



$rsnf2 = mysql_query($query_rsnf2, $nfconx);

$row_rsnf2 = mysql_fetch_assoc($rsnf2);

$totalRows_rsnf2 = mysql_num_rows($rsnf2);



if ($totalRows_rsnf2 > 0){

echo "

<ul>

";

do {



echo "<li style=\"list-style:none\">

";

$user_count = get_row_count(users, role_id, "=", $row_rsnf2['id']);

if ($user_count > 0){

echo '<a href="core.php?do=setup_manage_users&element=search&step=1&role_id=' . $row_rsnf2['id'] . '">';

}

echo  $row_rsnf2['role_name'];

if ($user_count > 0){

echo "</a> <span class='Small'>(" . $user_count . ")</span>";

}



echo ' &nbsp; <span class="Small"><a href="core.php?do=setup_manage_roles&element=edit&id=' . $row_rsnf2['id'] . '">Edit</a>';

// check if this role is assigned to a user

$role_user_count = get_row_count(users,role_id,"=",$row_rsnf2['id']);



// check if this role has other roles in the downline

$childstring = get_roles_child($row_rsnf2['id']);



if ((count($childstring) == 0) && ($role_user_count == 0)){

echo ' | <a href="core.php?do=setup_manage_roles&element=delete&id=' . $row_rsnf2['id'] . '"  onclick="return confirmLink(this, \'delete this role? \')">Delete</a>';

}

echo '</span>';









draw_roles_tree($row_rsnf2['id']);



echo "</li>

";



} while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

echo "</ul>

";

}




}
}






if (!function_exists("draw_roles_dropdown")) {
function draw_roles_dropdown($dropdown_name,$valueset,$default_value,$parent_null,$html_attributes_string)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from roles where parent_role_id = '0' ORDER by role_name ASC";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

echo '<select name="' . $dropdown_name . '" ' . $html_attributes_string . '>

';



if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}

if ($parent_null == "Yes"){

echo '<option value="0"> [None] </option>

	';

	}	

	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '<option value="' . $row_rsnf1['id'] . '" ';

if (!(strcmp($row_rsnf1['id'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' . $row_rsnf1['role_name'] . ' </option>

';

get_roles_dropdown_options($row_rsnf1['id'],$valueset);

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}



echo '

</select> ';


}
}






if (!function_exists("get_roles_dropdown_options")) {
function get_roles_dropdown_options($parent_role_id,$valueset)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from roles where parent_role_id = '" . $parent_role_id . "' ORDER by role_name ASC";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);



	

if ($totalRows_rsnf1 > 0){



do {	

echo '<option value="' . $row_rsnf1['id'] . '" ';

if (!(strcmp($row_rsnf1['id'], $valueset))) {echo " selected=\"selected\"";}

echo '>';

$roles_parent_role_count = roles_parent_role_count($row_rsnf1['id']);

$i = 1;

do {

echo " &nbsp; &nbsp; ";

$i++;

} while ($i <= $roles_parent_role_count);



echo " &raquo; " . $row_rsnf1['role_name'] . ' </option>

';

get_roles_dropdown_options($row_rsnf1['id'],$valueset);

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}



}

}




if (!function_exists("roles_parent_role_count")) {
function roles_parent_role_count($role_id)

{



$parent_role_id = get_val_col(roles,parent_role_id,id,$role_id);



if ($parent_role_id <> "0"){



$counter = array();

do {

$parent_role_id = get_val_col(roles,parent_role_id,id,$parent_role_id);

array_push($counter, $parent_role_id);

if ($parent_role_id == 0) {

break;

}



} while (100);



$total_parents = count($counter);

return $total_parents;



} else {

return 0;

}

}
}


$NF_cur_parent = array();



if (!function_exists("get_roles_child")) {
function get_roles_child($role_id)

{

global $database_nfconx;

global $nfconx;

global $NF_cur_parent;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from roles where parent_role_id = '" . $role_id . "' ORDER by role_name ASC";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);



	

if ($totalRows_rsnf1 > 0){



do {

array_push($NF_cur_parent, $row_rsnf1['id']);

get_roles_child($row_rsnf1['id']);



} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));



return array_unique($NF_cur_parent);

}

}



}






if (!function_exists("get_services_dropdown")) {
function get_services_dropdown($dropdown_name,$valueset,$default_value,$html_attributes_string)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from services_group ORDER BY service_group_name ASC";

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

echo '<select name="' . $dropdown_name . '" ' . $html_attributes_string . '>

';



if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}



	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '

<optgroup label="' . $row_rsnf1['service_group_name'] . '">

';

get_services_dropdown_options($row_rsnf1['id'],$valueset);

echo ' </optgroup>

';

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}



echo '

</select> ';


}
}





if (!function_exists("get_services_dropdown_options")) {
function get_services_dropdown_options($service_group_id,$valueset)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "SELECT * FROM services  WHERE service_group_id = '" . $service_group_id . "' AND system_service <> '1' ORDER BY sort_order,service_name ASC";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);



	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '<option value="' . $row_rsnf1['service_id'] . '" ';

if (!(strcmp($row_rsnf1['service_id'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' . $row_rsnf1['service_name'] . ' </option>

';



} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}
}

}



if (!function_exists("get_profile_services_dropdown")) {
function get_profile_services_dropdown($profile_id,$dropdown_name,$valueset,$html_attributes_string)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select sg.id, sg.service_group_name FROM profile_service_groups psg, services_group sg WHERE sg.id = psg.service_group_id AND psg.profile_id = '" . $profile_id . "' ORDER BY sg.service_group_name";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

echo '<select name="' . $dropdown_name . '" ' . $html_attributes_string . '>

';





if ($totalRows_rsnf1 > 0){

	

do {	

echo '<optgroup label="' . $row_rsnf1['service_group_name'] . '">

';

// Get select options (SELECT s.service_id, s.service_name FROM services s, profile_services ps WHERE s.service_id = ps.service_id AND ps.profile_id = xxx AND s.service_group_id = xxx ORDER BY s.service_name)

get_profile_services_dropdown_options($profile_id,$row_rsnf1['id']);

echo ' </optgroup>

';



} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}



echo '

</select> ';


}
}






if (!function_exists("get_profile_services_dropdown_options")) {
function get_profile_services_dropdown_options($profile_id,$service_group_id)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "SELECT s.service_id, s.service_name FROM services s, profile_services ps WHERE s.service_id = ps.service_id AND ps.profile_id = '" . $profile_id . "' AND s.service_group_id = '" . $service_group_id . "' ORDER BY s.service_name ASC";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);



	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '<option value="' . $row_rsnf1['service_id'] . '" ';

//if (!(strcmp($row_rsnf1['service_id'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' . $row_rsnf1['service_name'] . ' </option>

';



} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}





}

}






if (!function_exists("get_user_contact_dropdown")) {
function get_user_contact_dropdown($userid,$usage,$dropdown_name,$default_value,$valueset,$html_attributes_string)

{



echo '<select name="' . $dropdown_name . '" ' . $html_attributes_string . '>

';

if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}

echo '<optgroup label="My Contacts">

';

get_user_contact_own_contacts($userid,$usage,$valueset);

echo ' </optgroup>

';

echo '<optgroup label="Shared Contacts">

';

get_user_contact_shared_contacts($userid,$usage,$valueset);

echo ' </optgroup>

';



echo '

</select> ';
}
}






if (!function_exists("get_user_contact_own_contacts")) {
function get_user_contact_own_contacts($userid,$usage,$valueset)

{

global $database_nfconx;

global $nfconx;

if ($usage <> ""){

$xtrasql = " AND group_primary_usage LIKE  '%" . $usage . "%' ";

}

mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "SELECT * from user_contact_groups WHERE userid = '" . $userid . "' " . $xtrasql . " ORDER BY group_name ASC";

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '<option value="' . $row_rsnf1['contact_group_id'] . '" ';

if (!(strcmp($row_rsnf1['contact_group_id'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' . $row_rsnf1['group_name'] . ' (';

echo get_group_contact_count($row_rsnf1['contact_group_id'],$usage);

echo ')</option>

';

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));



}
}


}


if (!function_exists("get_user_contact_shared_contacts")) {
function get_user_contact_shared_contacts($userid,$usage,$valueset)

{

global $database_nfconx;

global $nfconx;

if ($usage <> ""){

$xtrasql = " AND group_primary_usage LIKE  '%" . $usage . "%' ";

}

mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "SELECT * from user_contact_groups WHERE userid <> '" . $userid . "' " . $xtrasql . " AND group_sharing = 'Public' ORDER BY group_name ASC";

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '<option value="' . $row_rsnf1['contact_group_id'] . '" ';

if (!(strcmp($row_rsnf1['contact_group_id'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' . $row_rsnf1['group_name'] . ' (';

echo get_group_contact_count($row_rsnf1['contact_group_id'],$usage);

echo ') - ' . get_val_col(users, name, userid, $row_rsnf1['userid']) . ' </option>

';

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));



}

}

}


if (!function_exists("get_group_contact_count")) {
function get_group_contact_count($contact_group_id,$usage)

{

global $database_nfconx;

global $nfconx;

if ($usage <> ""){

if ($usage == "SMS"){

$xtrasql = " AND mobile <> '' ";

}

elseif ($usage == "Email"){

$xtrasql = " AND email <> '' ";

}

} else {

$xtrasql = "";

}

mysql_select_db($database_nfconx, $nfconx);

$count = mysql_result(mysql_query("SELECT COUNT(*) from user_contacts WHERE contact_group_id = '" . $contact_group_id . "' " . $xtrasql . ""),0);

return $count;
}
}






if (!function_exists("draw_contact_group_dropdown")) {
function draw_contact_group_dropdown($dropdown_name,$valueset,$default_value,$new_group,$userid,$html_attributes_string)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from user_contact_groups where userid = '". $userid . "' ORDER by group_name ASC";

//echo $query_rsnf2;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

echo '<select name="' . $dropdown_name . '" ' . $html_attributes_string . '>

';



if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}



	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '<option value="' . $row_rsnf1['contact_group_id'] . '" ';

if (!(strcmp($row_rsnf1['contact_group_id'], $valueset))) {echo " selected=\"selected\"";}

echo '> ' . $row_rsnf1['group_name'] . ' </option>

';



} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}

if ($new_group == "Yes"){

echo '<option value="NEW_GROUP"> [New Group] </option>

	';

	}

echo '

</select> ';
}


}




if (!function_exists("get_val_col")) {
function array_push_associative(&$arr) {

   $args = func_get_args();

   foreach ($args as $arg) {

       if (is_array($arg)) {

           foreach ($arg as $key => $value) {

               $arr[$key] = $value;

               $ret++;

           }

       }else{

           $arr[$arg] = "";

       }

   }

   return $ret;
}
}




if (!function_exists("getMondaysAndSundays")) {
function getMondaysAndSundays($offset=false)

{



if(!$offset) $offset = strtotime(date('Y-m-d'));

else $offset = strtotime($offset);



// this week

if(date('w',$offset) == 1)

{

$mas['monday'] = date('Y-m-d',$offset);

}

else

{

$mas['monday'] = date('Y-m-d',strtotime("last Monday",$offset));

}



if(date('w',$offset) == 6)

{

$mas['sunday'] = date('Y-m-d',$offset);

}

else

{

$mas['sunday'] = date('Y-m-d',strtotime("next Sunday",$offset));

}



// last week

if(date('w',$offset) == 1)

{

$mas['lastmonday'] =  date('Y-m-d',strtotime('-1 week',$offset));

}

else

{

$mas['lastmonday'] = date('Y-m-d',strtotime('-1 week', strtotime(date('Y-m-d',strtotime("last Monday",$offset)))));

}



if(date('w') == 6)

{

$mas['lastsunday'] = date('Y-m-d',strtotime('-1 week',$offset));

}

else

{

$mas['lastsunday'] = date('Y-m-d',strtotime("last Sunday",$offset));

}



return $mas;
}
}






if (!function_exists("get_event_collection_total")) {
function get_event_collection_total($event_id,$date_from,$date_end)

{

$total_amount = get_sum(event_payments,amount," WHERE event_id='" . $event_id . "' AND payment_date between '" . $date_from . "' AND '" . $date_end . "' AND payment_status = 'Successful'");

if ($total_amount > 0){

return $total_amount;

} else { return "0.00"; }

}
}





if (!function_exists("get_event_donor_count")) {
function get_event_donor_count($event_id,$date_from,$date_end)

{

return get_row_count_custom_sql(event_payments, " event_id='" . $event_id . "' AND payment_date between '" . $date_from . "' AND '" . $date_end . "' AND payment_status = 'Successful'");

}

}



if (!function_exists("return_masked_cc_no")) {
function return_masked_cc_no($cc_no)

{

	if ($cc_no <> ""){

$card_no = substr($cc_no,-4);

return "xxx" . $card_no;	

	}

}
}


if (!function_exists("get_user_payment_methods")) {
function get_user_payment_methods($userid, $dropdown_name, $default_value, $valueset, $javascript, $event_id = false, $xtrasql = false)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf2 = "SELECT * FROM donor_payment_methods WHERE userid = '" . $userid . "' " . $xtrasql . " and active_state='active' ORDER BY payment_method_type ASC";

//echo $query_rsnf2;

$rsnf2 = mysql_query($query_rsnf2, $nfconx);

$row_rsnf2 = mysql_fetch_assoc($rsnf2);

$totalRows_rsnf2 = mysql_num_rows($rsnf2);



echo '<select  id="'.$dropdown_name.'" name="' . $dropdown_name . '" id="' . $dropdown_name . '"';

if ($javascript <> ""){

	echo $javascript;

}

echo '>

';

if ($default_value <> ""){

	echo '		  <option value="noValue">' . $default_value . '</option>

	';

	}

do {	

	

if ($row_rsnf2['payment_method_type'] == "Credit Card"){

	if ((get_val_col(events,cc_accounts_merchant_id_id,event_id,$event_id) <> "0") && (get_val_col(events,cc_accounts_merchant_id_id,event_id,$event_id) <> "")){

echo '<option value="' . $row_rsnf2['donor_payment_method_id'] . '"';

if (!(strcmp($row_rsnf2['donor_payment_method_id'], $valueset))) {echo " selected=\"selected\"";}

echo  '>';	



	echo get_val_col(master_credit_card_types,credit_card_name,credit_card_type_id,$row_rsnf2['credit_card_type_id']) . " - " . return_masked_cc_no($row_rsnf2['cc_card_no']) . " ";

echo '</option>

';	

	}  else {

if (get_row_count_custom_sql("donor_payment_methods"," userid='" . $userid . "' AND payment_method_type = 'Credit Card'")>0){		

echo '<optgroup label="Credit Card Not Accepted">

</optgroup>

';

}

}

	  

} elseif ($row_rsnf2['payment_method_type'] == "Electronic Check") {

if ((get_val_col(events,ec_accounts_merchant_id_id,event_id,$event_id) <> "0") && (get_val_col(events,ec_accounts_merchant_id_id,event_id,$event_id) <> "")){	

echo '<option value="' . $row_rsnf2['donor_payment_method_id'] . '"';

if (!(strcmp($row_rsnf2['donor_payment_method_id'], $valueset))) {echo " selected=\"selected\"";}

echo  '>';



	echo $row_rsnf2['ec_bank_name'] . " - " . return_masked_cc_no($row_rsnf2['ec_account_no']);

	

	echo '</option>

';	

} else {

if (get_row_count_custom_sql("donor_payment_methods"," userid='" . $userid . "' AND payment_method_type = 'Electronic Check'")>0){		

echo '<optgroup label="E-Check Not Accepted">

</optgroup>

';

}

}

}







} while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

echo '</select>';

}
}



if (!function_exists("get_next_reference_no")) {
function get_next_reference_no()

{

$next_no = get_next_autoincrement('event_payments');

return $next_no;

}
}


if (!function_exists("get_child_location_sql_str")) {
function get_child_location_sql_str($column_name,$table_identifier,$userid)

{

global $database_nfconx;

global $nfconx;



$major_location_id = get_val_col(users,major_location_id,userid,$userid);



if ($major_location_id <> ""){

mysql_select_db($database_nfconx, $nfconx);

$query_rsnf2 = "SELECT * FROM locations WHERE major_location_id = '" . $major_location_id . "' ORDER BY location_id ASC";

$rsnf2 = mysql_query($query_rsnf2, $nfconx);

$row_rsnf2 = mysql_fetch_assoc($rsnf2);

$totalRows_rsnf2 = mysql_num_rows($rsnf2);	



if ($totalRows_rsnf2 > 0){

$sql_string = array();

do {

array_push($sql_string,$row_rsnf2['location_id']);

} while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

if ($table_identifier <> ""){

$dbcol = $table_identifier . "." . $column_name . " = ";

} else{

$dbcol = $column_name . " = ";	

}

$sql_str = $dbcol . " " . implode(" OR " . $dbcol,$sql_string);

}

}

return $sql_str;

}
}



if (!function_exists("get_event_payment_frequeny_dropdown")) {
function get_event_payment_frequeny_dropdown($event_id,$dropdown_name, $default_value, $valueset, $javascript)

{

	

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf2 = "SELECT DISTINCT payment_frequency FROM event_amounts WHERE event_id ='" . $event_id . "' 

ORDER BY payment_frequency ASC";

//echo $query_rsnf2;

$rsnf2 = mysql_query($query_rsnf2, $nfconx);

$row_rsnf2 = mysql_fetch_assoc($rsnf2);

$totalRows_rsnf2 = mysql_num_rows($rsnf2);

//echo $valueset;

echo '<select id="'.$dropdown_name.'" name="' . $dropdown_name . '" ';

if ($javascript <> ""){

	echo $javascript;

}

echo ' style="width:80px;" >

';

if ($default_value <> ""){

	echo '		  <option value="noValue">' . $default_value . '</option>

	';

	}

do {



if ($totalRows_rsnf2 > 0) {

echo '<option value="' . $row_rsnf2['payment_frequency'] . '"';



if (!(strcmp($row_rsnf2['payment_frequency'], $valueset))) {echo " selected=\"selected\"";}

echo  '>';

echo $row_rsnf2['payment_frequency'];



echo '</option>

';



}

} while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

echo '</select>';
}
}




if (!function_exists("get_donor_billing_address")) {
function get_donor_billing_address($userid,$dropdown_name, $default_value, $valueset, $javascript)

{

	

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf2 = "SELECT * FROM donor_billing_address WHERE userid ='" . $userid . "' 

ORDER BY donor_billing_address_id ASC";

//echo $query_rsnf2;

$rsnf2 = mysql_query($query_rsnf2, $nfconx);

$row_rsnf2 = mysql_fetch_assoc($rsnf2);

$totalRows_rsnf2 = mysql_num_rows($rsnf2);

//echo $valueset;

echo '<select name="' . $dropdown_name . '" ';

if ($javascript <> ""){

	echo $javascript;

}

echo '>

';

if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}

do {



if ($totalRows_rsnf2 > 0) {

echo '<option value="' . $row_rsnf2['donor_billing_address_id'] . '"';



if (!(strcmp($row_rsnf2['donor_billing_address_id'], $valueset))) {echo " selected=\"selected\"";}

echo  '>';

echo $row_rsnf2['address1'] . ", " . $row_rsnf2['address2'] . ", " . $row_rsnf2['donor_city'] . ", " . $row_rsnf2['donor_state'] . " " . $row_rsnf2['zip'];



echo '</option>

';



}

} while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

echo '</select>';
}
}







if (!function_exists("secret_question_status")) {

function secret_question_status($userid)

{

// GET user_type of the usre

$user_type = get_val_col(users,user_type,userid,$userid);



$password_reset_user_answers_count = get_row_count(password_reset_user_answers,userid,"=",$userid);



if (($user_type == "Location Administrator") && ($password_reset_user_answers_count < "2")){

	

$ref = "core.php?do=setup_password_reset_answers";

header("Location: ". $ref); 

exit;



}

}

}




if (!function_exists("initiate_payment_method_wizard")) {
function initiate_payment_method_wizard($userid)

{

// GET user_type of the usre

$user_type = get_val_col(users,user_type,userid,$userid);



$donor_events_active = get_row_count_custom_sql(donor_events," is_archive='0' AND userid = '" . $userid . "' ");

$donor_payment_methods = get_row_count_custom_sql(donor_payment_methods," active_state='active' and userid = '" . $userid . "' ");



if (($user_type == "Donor") && ($donor_events_active > "0") && ($donor_payment_methods == "0")){

	

$ref = "core.php?do=payment_method_wizard";

header("Location: ". $ref); 

exit;



}

}

}








if (!function_exists("draw_merchant_id_dropdown")) {
function draw_merchant_id_dropdown($dropdown_name,$custom_sql,$valueset,$default_value,$html_attributes_string)

{

global $database_nfconx;

global $nfconx;



mysql_select_db($database_nfconx, $nfconx);

$query_rsnf1 = "select *  from accounts_merchant_id " . $custom_sql . " ORDER BY merchant_id_display_name ASC";

//echo $query_rsnf1;

$rsnf1 = mysql_query($query_rsnf1, $nfconx);

$row_rsnf1 = mysql_fetch_assoc($rsnf1);

$totalRows_rsnf1 = mysql_num_rows($rsnf1);

echo '<select name="' . $dropdown_name . '" ' . $html_attributes_string . '>

';



if ($default_value <> ""){

	echo '		  <option value="">' . $default_value . '</option>

	';

	}



	

if ($totalRows_rsnf1 > 0){

	

do {	

echo '<option value="' . $row_rsnf1['accounts_merchant_id_id'] . '"';



if (!(strcmp($row_rsnf1['accounts_merchant_id_id'], $valueset))) {echo " selected=\"selected\"";}

echo  '>';

echo $row_rsnf1['merchant_id_display_name'];

echo '</option>

';

} while ($row_rsnf1 = mysql_fetch_assoc($rsnf1));





}



echo '

<option value="0" ';

if ($valueset == "0") {echo " selected=\"selected\"";}

echo '>Not Applicable</option>

</select> ';



}
}

if (!function_exists("get_daysdates")) {
function get_daysdates($string, $date_from,$date_to)

{

$dates = array();

$date_start = strtotime($date_from);

$date_end = strtotime($date_to);



$next_str_date = strtotime($string,$date_start);



$datetime_diff = $next_str_date - $date_start;





do {

$dates[] = 	date('Y-m-d',$date_start);

$date_start += $datetime_diff;



} while ( $date_start <= $date_end );

return $dates;	


}
}



if (!function_exists("get_daysdates_limited")) {
function get_daysdates_limited($string, $date_from,$total_dates)

{

$dates = array();

$date_start = strtotime($date_from);

$next_str_date = strtotime($string,$date_start);



$datetime_diff = $next_str_date - $date_start;



$j = 1;

while ($j <= $total_dates):

$dates[] = 	date('Y-m-d',$date_start);

$date_start = strtotime($string,$date_start);



//$date_start += $datetime_diff;



$j++;

endwhile;;

return $dates;	

}

}




if (!function_exists("get_monthdates")) {
function get_monthdates($date_from,$date_to)

{

$dates = array();

$date_start = strtotime($date_from);

$date_end = strtotime($date_to);



do {

$cur_date = date('Y-m-d',$date_start);

$dates[] = $cur_date;	

$next_date = get_next_month_date($cur_date);

$datetime_diff = strtotime($next_date) - strtotime($cur_date);

$date_start += $datetime_diff;



} while ( $date_start <= $date_end );

return $dates;	


}
}




if (!function_exists("get_next_month_date")) {
function get_next_month_date($date)

{

$date=explode("-",$date);

	$month=$date[1];

	$day=$date[2];

	$year=$date[0];

	

	

	if($month=='01')

	{			

		if($year%4==0)

		{

			

			if($day>29)

			{

			$day=29;

			}			

		}

		else

		{

			if($day>28)

			{

			$day=28;

			}			

		}

		$month=$month+1;

	}

	else if($month=='02'||$month=='04' ||$month=='06'||$month=='07'||$month=='09'||$month=='11')

	{		

		$month=$month+1;

	}

	else if($month=='03'||$month=='05'||$month=='08'||$month=='10')

	{

		if($day>30)

		{

		$day='30';

		}		

		$month=$month+1;

	}

	else if ($month=='12')

	{		

		$month='1';

		$year=$year+1;

	}

	

	if($day<10)

	{

		$day='0'.(int)$day;

	}

	if($month<10)

	{

		$month='0'.(int)$month;

	}	

	return $year."-".$month."-".$day;
}
}






if (!function_exists("get_events_payment_dates_general")) {
function get_events_payment_dates_general($payment_frequency,$payment_start_date,$payment_end_date)

{

	

if ($payment_frequency== "Weekly"){

$dates = get_daysdates("+1 week",$payment_start_date,$payment_end_date);

}elseif ($payment_frequency== "Bi-Weekly"){

$dates = get_daysdates("+2 Weeks",$payment_start_date,$payment_end_date);

} elseif ($payment_frequency== "Monthly"){

//$dates = get_daysdates("+1 Month",$payment_start_date,$payment_end_date);	

$dates = get_monthdates($payment_start_date,$payment_end_date);	

} elseif ($payment_frequency== "Quarterly"){

$dates = get_daysdates("+3 Months",$payment_start_date,$payment_end_date);	

} elseif ($payment_frequency== "Semi-Annually"){

$dates = get_daysdates("+6 Months",$payment_start_date,$payment_end_date);	

} elseif ($payment_frequency== "Annually"){

$dates = get_daysdates("+1 Year",$payment_start_date,$payment_end_date);	

}

return $dates;
}
}



if (!function_exists("get_events_payment_dates_high_value")) {
function get_events_payment_dates_high_value($payment_frequency,$payment_start_date,$no_of_installments)

{

	

if ($payment_frequency == "Weekly"){

$dates = get_daysdates_limited("+1 week",$payment_start_date,$no_of_installments);

}elseif ($payment_frequency == "Bi-Weekly"){

$dates = get_daysdates_limited("+2 Weeks",$payment_start_date,$no_of_installments);

} elseif ($payment_frequency == "Monthly"){

$dates = get_daysdates_limited("+1 Month",$payment_start_date,$no_of_installments);

} elseif ($payment_frequency == "Quarterly"){

$dates = get_daysdates_limited("+3 Months",$payment_start_date,$no_of_installments);

} elseif ($payment_frequency == "Semi-Annually"){

$dates = get_daysdates_limited("+6 Months",$payment_start_date,$no_of_installments);

} elseif ($payment_frequency == "Annually"){

$dates = get_daysdates_limited("+1 Year",$payment_start_date,$no_of_installments);

}

return $dates;
}
}


if (!function_exists("get_MondaysThursdays")) {
function get_MondaysThursdays($date_from,$date_to)

{

$dates = array();

$date_from = strtotime($date_from);

$date_to = strtotime($date_to);

	

do {

$dates[] = date('Y-m-d',strtotime("next Monday",$date_from));		

$dates[] = date('Y-m-d',strtotime("next Thursday",$date_from));	

$date_from += 86400 * 7;



} while ( $date_from <= $date_to );

return $dates;	

}

}




if (!function_exists("donor_payment_schedule_populate")) {
function donor_payment_schedule_populate($payment_frequency,$payment_start_date,$payment_end_date,$donor_events_id,$event_id,$amount,$donor_payment_method_id,$userid,$session_id,$pledge_amount = false)

{

global $database_nfconx;

global $nfconx;



$event_type = get_val_col(events, event_type, event_id,$event_id);

$donor_id = get_val_col(donor_profiles, donor_id, userid,$userid);



if($event_type=="General")

	{

	if ($payment_frequency == "One-Time")

		{

			$enter_value = array(

			"userid"=>$userid,

			"donor_id"=>$donor_id,

			"session_id"=>$session_id,

			"date_payment"=>$payment_start_date,

			"donor_events_id"=>$donor_events_id,

			"event_id"=>$event_id,

			"amount"=>$amount,

			"created_datetime"=>current_datetime(),

			"donor_payment_method_id"=>$donor_payment_method_id,

			"createdby"=>$_SESSION['NF_Username']

			);

			$enter_action =insert_data("donor_payment_schedule",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

			$enter_r=mysql_query($enter_action);	

		} 

	else 

		{	

		

		$dates = get_events_payment_dates_general($payment_frequency,$payment_start_date,$payment_end_date);



		for ($j = 0; $j < count($dates); $j++) 

			{   

				$enter_value = array(

				"userid"=>$userid,

				"donor_id"=>$donor_id,

				"session_id"=>$session_id,

				"date_payment"=>$dates[$j],

				"donor_events_id"=>$donor_events_id,

				"event_id"=>$event_id,

				"amount"=>$amount,

				"created_datetime"=>current_datetime(),

				"donor_payment_method_id"=>$donor_payment_method_id,

				"createdby"=>$_SESSION['NF_Username']

				);

				$enter_action =insert_data("donor_payment_schedule",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

				$enter_r=mysql_query($enter_action);

			}

	}

}

else if ($event_type=="High Value")

{

			//echo  "wriite bulding event code here ";

	if ($payment_frequency == "One-Time")

		{

				$enter_value = array(

				"userid"=>$userid,

				"donor_id"=>$donor_id,

				"session_id"=>$session_id,

				"date_payment"=>$payment_start_date,

				"donor_events_id"=>$donor_events_id,

				"event_id"=>$event_id,

				"amount"=>$amount,

				"created_datetime"=>current_datetime(),

				"donor_payment_method_id"=>$donor_payment_method_id,

				"createdby"=>$_SESSION['NF_Username']

				);

				$enter_action =insert_data("donor_payment_schedule",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

				$enter_r=mysql_query($enter_action);	

				$high_value_end_date = $payment_start_date;

		} else {



$no_of_installments=ceil($pledge_amount/$amount);

$dates = get_events_payment_dates_high_value($payment_frequency,$payment_start_date,$no_of_installments);



$net_amount = 0;

for ($j = 0; $j < count($dates); $j++)

{  

if ($j < ($no_of_installments - 1)){

$eff_amount = $amount;

$net_amount = $eff_amount + $net_amount;

} else {

$eff_amount = $pledge_amount - $net_amount;	

}

$enter_value = array(

"userid"=>$userid,

"donor_id"=>$donor_id,

"session_id"=>$session_id,

"date_payment"=>$dates[$j],

"donor_events_id"=>$donor_events_id,

"event_id"=>$event_id,

"amount"=>$eff_amount,

"created_datetime"=>current_datetime(),

"donor_payment_method_id"=>$donor_payment_method_id,

"createdby"=>$_SESSION['NF_Username']

);

$enter_action =insert_data("donor_payment_schedule",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

$enter_r=mysql_query($enter_action);

}

$high_value_end_date = $dates[count($dates)-1];



}

	

$edit_value = array(

"payment_end_date"=>$high_value_end_date,

);



$edit_action =update_data("donor_events",array_to_string_update($edit_value),"donor_events_id='" . $donor_events_id . "'");

//echo $edit_action;

$edit_r=mysql_query($edit_action);

}

}

}






if (!function_exists("donor_payment_schedule_and_process_payment")) {
function donor_payment_schedule_and_process_payment($payment_frequency,$payment_start_date,$payment_end_date,$donor_events_id,$event_id,$amount,$donor_payment_method_id,$userid)

{

global $database_nfconx;

global $nfconx;



if(get_val_col(events, event_type, event_id,$event_id)=="General")

	{

	if ($payment_frequency == "One-Time")

		{

			$enter_value = array(

			"userid"=>$userid,

			"session_id"=>$_SESSION['My_Session_ID'],

			"date_payment"=>$payment_start_date,

			"donor_events_id"=>$donor_events_id,

			"event_id"=>$event_id,

			"amount"=>$amount,

			"created_datetime"=>current_datetime(),

			"donor_payment_method_id"=>$donor_payment_method_id

			);

			$enter_action =insert_data("donor_payment_schedule",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

			//echo $enter_action;

			$enter_r=mysql_query($enter_action);	

		} 

	else 

		{	

		    if ($payment_frequency == "Weekly")

			{

			$dates = get_daysdates("+1 week",$payment_start_date,$payment_end_date);	

			} elseif ($payment_frequency == "Bi-Weekly"){

			$dates = get_MondaysThursdays($payment_start_date,$payment_end_date);

			} elseif ($payment_frequency == "Monthly"){

			$dates = get_daysdates("+1 Month",$payment_start_date,$payment_end_date);	

			} elseif ($payment_frequency == "Quarterly"){

			$dates = get_daysdates("+3 Months",$payment_start_date,$payment_end_date);	

			} elseif ($payment_frequency == "Semi-Annually"){

			$dates = get_daysdates("+6 Months",$payment_start_date,$payment_end_date);	

			} elseif ($payment_frequency == "Annually"){

			$dates = get_daysdates("+1 Year",$payment_start_date,$payment_end_date);	

			}

	

	

		for ($j = 0; $j < count($dates); $j++) 

			{   

				$enter_value = array(

				"userid"=>$userid,

				"session_id"=>$_SESSION['My_Session_ID'],

				"date_payment"=>$dates[$j],

				"donor_events_id"=>$donor_events_id,

				"event_id"=>$event_id,

				"amount"=>$amount,

				"created_datetime"=>current_datetime(),

				"donor_payment_method_id"=>$donor_payment_method_id

				);

				$enter_action =insert_data("donor_payment_schedule",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

				$enter_r=mysql_query($enter_action);

			}

	}

}

else if (get_val_col(events, event_type, event_id,$event_id)=="High Value")

{

			//echo  "wriite bulding event code here ";

	if ($payment_frequency == "One-Time")

		{

				$enter_value = array(

				"userid"=>$userid,

				"session_id"=>$_SESSION['My_Session_ID'],

				"date_payment"=>$payment_start_date,

				"donor_events_id"=>$donor_events_id,

				"event_id"=>$event_id,

				"amount"=>$amount,

				"created_datetime"=>current_datetime(),

				"donor_payment_method_id"=>$donor_payment_method_id

				);

				$enter_action =insert_data("donor_payment_schedule",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

				//echo $enter_action;

				$enter_r=mysql_query($enter_action);	

		} 

		

		$pledge_amount=get_val_col(donor_events, pledge_amount, donor_events_id,$donor_events_id);

	$no_of_installments=round($pledge_amount/$amount,0)-2;

						$start_date_time=strtotime($payment_start_date);	

	if ($payment_frequency == "Weekly")

					{ 

					$no_of_days=7*$no_of_installments;

					//echo "P start date--".$payment_start_date."<br/>";

					$payment_end_date=date('Y-m-d',strtotime("+".$no_of_days." day",$start_date_time));

					//echo $payment_end_date."--".$no_of_days;

					$dates = get_daysdates("+1 week",$payment_start_date,$payment_end_date);

					}elseif ($payment_frequency == "Bi-Weekly"){

					$no_of_days=15*$no_of_installments;

					$payment_end_date=date('Y-m-d',strtotime("+".$no_of_days." day",$start_date_time));

					//echo $payment_end_date;

					$dates = get_daysdates("+2 week",$payment_start_date,$payment_end_date);

					} elseif ($payment_frequency == "Monthly"){

					$no_of_days=31*$no_of_installments;

					$payment_end_date=date('Y-m-d',strtotime("+".$no_of_days." day",$start_date_time));

					//echo $payment_end_date;

					$dates = get_daysdates("+1 Month",$payment_start_date,$payment_end_date);	

					} elseif ($payment_frequency == "Quarterly"){

					$no_of_days=92*$no_of_installments;

					$payment_end_date=date('Y-m-d',strtotime("+".$no_of_days." day",$start_date_time));

					//echo $payment_end_date;

					$dates = get_daysdates("+3 Months",$payment_start_date,$payment_end_date);	

					} elseif ($payment_frequency == "Semi-Annually"){

					$no_of_days=183*$no_of_installments;

					$payment_end_date=date('Y-m-d',strtotime("+".$no_of_days." day",$start_date_time));

					//echo $payment_end_date;

					$dates = get_daysdates("+6 Months",$payment_start_date,$payment_end_date);	

					} elseif ($payment_frequency == "Annually"){

					$no_of_days=365*$no_of_installments;

					$payment_end_date=date('Y-m-d',strtotime("+".$no_of_days." day",$start_date_time));

					//echo $payment_end_date;

					$dates = get_daysdates("+1 Year",$payment_start_date,$payment_end_date);	

					}



					//update payment end date 

					//echo "p end date--".$payment_end_date;

					$edit_value = array(

					"payment_end_date"=>$payment_end_date,

					);

					$edit_action =update_data("donor_events",array_to_string_update($edit_value),"donor_events_id='".$donor_events_id."'");

					$edit_r=mysql_query($edit_action);

					//

				for ($j = 0; $j < count($dates); $j++)

				{   

					$enter_value = array(

					"userid"=>$userid,

					"session_id"=>$_SESSION['My_Session_ID'],

					"date_payment"=>$dates[$j],

					"donor_events_id"=>$donor_events_id,

					"event_id"=>$event_id,

					"amount"=>$amount,

					"created_datetime"=>current_datetime(),

					"donor_payment_method_id"=>$donor_payment_method_id

					);

					//echo $dates[$j];

					$enter_action =insert_data("donor_payment_schedule",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

					$enter_r=mysql_query($enter_action);





				}

				



	



}

 	

	

	//----------------------------------------------------------------------------------------------------------------------------------------------------

	// check if any one-time payments to be made for current date

	$query_rsnf = "SELECT * from donor_payment_schedule WHERE session_id = '" . $_SESSION['My_Session_ID'] . "' AND date_payment = '" . current_date() . "' and is_success<>1";



	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	$totalRows_rsnf = mysql_num_rows($rsnf);

		//echo $query_rsnf . "<br />" . $totalRows_rsnf;

	if ($totalRows_rsnf > 0)

	{

		do 

		{		

			$billing_address_id = 	get_val_col(donor_payment_methods,billing_address_id,"donor_payment_method_id",$row_rsnf['donor_payment_method_id']);			

				$donor_id = get_val_col(donor_profiles,donor_id,"session_id",$_SESSION['My_Session_ID']);			

			$i = 1;	

			//send to goeprocessor

			if( get_val_col(donor_payment_methods,payment_method_type,donor_payment_method_id,$row_rsnf['donor_payment_method_id'])=="Credit Card")

			{

			$uid=uniqid("CCDEBIT");

			//echo $row_rsnf['donor_payment_method_id']."--".$row_rsnf['amount']."--".get_val_col(donor_payment_methods,payment_method_type,donor_payment_method_id,$row_rsnf['donor_payment_method_id']);

			$value=cccimtransaction(get_val_col(donor_payment_methods,cimid,donor_payment_method_id,$row_rsnf['donor_payment_method_id']),$row_rsnf['amount'],"Visa",$uid);

			}

			else

			{

			$uid=uniqid("ACHDEBIT");

			$value=eccimtransaction(get_val_col(donor_payment_methods,cimid,donor_payment_method_id,$row_rsnf['donor_payment_method_id']),$row_rsnf['amount'],"Visa",$uid);

			}	

			$enter_value = array(

			"userid"=>$userid,

			"amount"=>$row_rsnf['amount'],

			"Response_Status"=>$value[0]." ".$value[2],

			"gc_id"=>$uid,

			"Status"=>$value[1],

			"session_id"=>$_SESSION['My_Session_ID'],

			"event_id"=>$row_rsnf['event_id'],

			"createdby"=>$_SESSION['NF_Username'],

			"payment_method_id"=>$row_rsnf['donor_payment_method_id']

			);

			$enter_action =insert_data("transaction_status",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

			$enter_r=mysql_query($enter_action);

			$i++; 

			if($value[1]=="success")

			{

				$enter_value = array(

				"donor_payment_schedule_id"=>$row_rsnf['donor_payment_schedule_id'],

				"transaction_datetime"=>current_datetime(),

				"is_processed"=>1,

				"is_success"=>1,

				"pg_dump"=>" ",

				);

				

				//$enter_action =insert_data("donor_payment_transactions",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));

				//$enter_r=mysql_query($enter_action);

				

				

				$edit_value = array(

				"is_processed"=>1,

				"is_success"=>1,

				);

				$edit_action =update_data("donor_payment_schedule",array_to_string_update($edit_value),"donor_payment_schedule_id='" . $row_rsnf['donor_payment_schedule_id'] . "'");

				$edit_r=mysql_query($edit_action);

			}

			

	 } while ($row_rsnf = mysql_fetch_assoc($rsnf)); 

	

	}
}
}




if (!function_exists("add_payment_method")) {
function add_payment_method($paymet_mode,$cc_name_on_card,$address1,$address2,$donor_city,$donor_state,$zip,$ec_account_name,$cimid)

{

	///send to goemerchant-------

	if ($paymet_mode == "Credit Card")

	{		

		$value=insertcim($cc_name_on_card,$cimid,$address1,$address2,$donor_city,$donor_state,$zip,"","","");	

	}

	else

		{		

		$value=insertcim($ec_account_name,$cimid,$address1,$address2,$donor_city,$donor_state,$zip,"","","");

		}		

		return $value;

}
}





if (!function_exists("edit_payment_method")) {
function edit_payment_method($paymet_mode,$cc_name_on_card,$address1,$address2,$donor_city,$donor_state,$zip,$ec_account_name,$cimid)

{

	///send to goemerchant-------

	if ($paymet_mode == "Credit Card")

	{		

		$value=editcim($cc_name_on_card,$cimid,$address1,$address2,$donor_city,$donor_state,$zip,"","","","cc");	

	}

	else

		{		

		$value=editcim($ec_account_name,$cimid,$address1,$address2,$donor_city,$donor_state,$zip,"","","","ec");

		}		

		return $value;
}
}



if (!function_exists("get_user_location_dropdown")) {
function get_user_location_dropdown($user_id,$dropdown_name,$default_value, $javascript)

{	    global $database_nfconx;

		global $nfconx;		

		mysql_select_db($database_nfconx, $nfconx);

		$query_rsnf2 = "SELECT distinct b.location_id, location_name FROM donor_events a join locations b on b.location_id=a.location_id  WHERE a.userid ='" . $user_id . "' ";		

		//echo $query_rsnf2;

		$rsnf2 = mysql_query($query_rsnf2, $nfconx);

		

		

		

		$i=0;

		while($row_raj = mysql_fetch_array($rsnf2))

		{

			if($i == 0)

			{

				$str = "'". $row_raj['location_id']. "'";

			}

			else

			{

				$str.=" , '". $row_raj['location_id']."'";

			}

			$i++;

		}

		

		

		$query_rsnf2 = "SELECT distinct b.location_id, location_name FROM donor_events a join locations b on b.location_id=a.location_id  WHERE a.userid ='" . $user_id . "' ";		

		//echo $query_rsnf2;

		$rsnf2 = mysql_query($query_rsnf2, $nfconx);

		$row_rsnf2 = mysql_fetch_assoc($rsnf2);

		$totalRows_rsnf2 = mysql_num_rows($rsnf2);

		//echo $valueset;

		echo '<select name="' . $dropdown_name . '" ';

		if ($javascript <> "")

		{

			echo $javascript;

		}

		echo '>';

		if ($default_value <> "")

		{

			echo '		  <option value="'.$str.'">' . $default_value . '</option>

			';

		}

		do 

		{		

			if ($totalRows_rsnf2 > 0) 

			{

			echo '<option value="' . $row_rsnf2['location_id'] . '"';

			

			//if (!(strcmp($row_rsnf2['payment_frequency'], $valueset))) {echo " selected=\"selected\"";}

			echo  '>';

			echo $row_rsnf2['location_name'];

			

			echo '</option>';

			

			}

		} 

		while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

		echo '</select>';
}
}



if (!function_exists("get_user_location_dropdown_dph")) {
function get_user_location_dropdown_dph($user_id,$dropdown_name,$default_value, $javascript)

{	    global $database_nfconx;

		global $nfconx;		

		mysql_select_db($database_nfconx, $nfconx);

		

		

		$query_rsnf2 = "SELECT distinct b.location_id, location_name FROM donor_events a join locations b on b.location_id=a.location_id  WHERE a.userid ='" . $user_id . "' ";		

		//echo $query_rsnf2;

		$rsnf2 = mysql_query($query_rsnf2, $nfconx);

		$row_rsnf2 = mysql_fetch_assoc($rsnf2);

		$totalRows_rsnf2 = mysql_num_rows($rsnf2);

		//echo $valueset;

		echo '<select name="' . $dropdown_name . '" ';

		if ($javascript <> "")

		{

			echo $javascript;

		}

		echo '>';

		if ($default_value <> "")

		{

			echo '		  <option value="">' . $default_value . '</option>

			';

		}

		do 

		{		

			if ($totalRows_rsnf2 > 0) 

			{

			echo '<option value="' . $row_rsnf2['location_id'] . '"';

			

			//if (!(strcmp($row_rsnf2['payment_frequency'], $valueset))) {echo " selected=\"selected\"";}

			echo  '>';

			echo $row_rsnf2['location_name'];

			

			echo '</option>';

			

			}

		} 

		while ($row_rsnf2 = mysql_fetch_assoc($rsnf2));

		echo '</select>';
}
}




if (!function_exists("get_location_dropdown")) {
function get_location_dropdown($user_id,$query,$option_value,$field1,$field2,$dropdown_name,$default_value, $javascript)

{  	global $database_nfconx;

	global $nfconx;		

	mysql_select_db($database_nfconx, $nfconx);

	$rsnf = mysql_query($query, $nfconx);

	$row_rsnf = mysql_fetch_assoc($rsnf);

	$totalRows_rsnf = mysql_num_rows($rsnf);

	echo '<select name="' . $dropdown_name . '" ';

	if ($javascript <> ""){

		echo $javascript;

	}

	echo '>

	';

	if ($default_value <> ""){

		echo '		  <option value="">' . $default_value . '</option>

		';

			}

	do {

	

	if ($totalRows_rsnf > 0) {

		echo '<option value="' . $row_rsnf["$option_value"]. '"';

		

		//if (!(strcmp($row_rsnf2['payment_frequency'], $valueset))) {echo " selected=\"selected\"";}

		echo  '>';

		echo $row_rsnf["$field1"] ;

		if($field2<>"")

		{

		echo  " --- " . $row_rsnf["$field2"] ;

		}

		echo '</option>

		';

		

		}

		} while ($row_rsnf = mysql_fetch_assoc($rsnf));

		echo '</select>';   
}
}




if (!function_exists("send_email_one_time_payment")) {
function  send_email_one_time_payment($userid,$event_id,$amount,$payment_method_id,$dependant_id,$processed_by)

{

	$event_title=get_val_col(events,event_title,event_id,$event_id);

	$loc_id=get_val_col(events,location_id,event_id,$event_id);

	$loc_name=get_val_col(locations,location_name,location_id,$loc_id);

	global $database_nfconx;

	global $nfconx;

	//echo 'i was here';

	mysql_select_db($database_nfconx, $nfconx);

        $query_rsnf1="Select * from donor_dependants g WHERE g.userid='".$userid."' and g.donor_dependant_id='".$dependant_id."'";

	$rsnf1 = mysql_query($query_rsnf1, $nfconx) or die(mysql_error());

	$row_rsnf1 = mysql_fetch_assoc($rsnf1);

	$dependant_name=$row_rsnf1["dependant_name"];

	

	$query_rsnf="select * from users where userid='".$userid."'";

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	           

	$username=$row_rsnf["name"];

	$user_email=$row_rsnf["email"];;

	

	$query_rsnf = "SELECT *  FROM donor_payment_methods dpm

	JOIN master_credit_card_types mcc on mcc.credit_card_type_id=dpm.credit_card_type_id

	WHERE  dpm.userid ='".$userid."' and dpm.donor_payment_method_id='".$payment_method_id."'";

	

	// echo $query_rsnf;

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	$html="<br/><div style='font-size:12px;border-bottom-style:ridge; border-left-style:ridge; border-right-style:ridge; border-top-style:ridge;'> <br/> You have made one time payment for the following event of ".$loc_name.". Your payment details are defined below :<br/><br/><table id='MyTable'border='1' style='font-size:12px'  width='100%' cellspacing='0' cellpadding='0'>";

	$header="<th>EVENT</th><th>PAYMENT METHOD</th><th>AMOUNT(in USD)</th><th>DEPENDENT</th><th>PAYMENT PROCESSED BY</th>";

	$htmlcontent="";

	if($row_rsnf["payment_method_type"]=="Credit Card")		

			

			{	

	

	$htmlcontent=$htmlcontent."<tr style='font-size:12px'><td align='center'>".$event_title."</td><td align='center'>".$row_rsnf["credit_card_type"]."--".$row_rsnf["cc_card_no"]."</td><td align='center'>".$amount."</td><td align='center'>".$dependant_name."</td><td align='center'>".$processed_by."</td></tr>";

			

			} 

	else

	

	{$htmlcontent=$htmlcontent."<tr style='font-size:12px'><td align='center'>".$event_title."</td><td align='center'>".$row_rsnf["ec_bank_name"]."-".$row_rsnf["ec_account_no"]."</td><td align='center'>".$amount."</td><td align='center'>".$dependant_name."</td><td align='center'>".$processed_by."</td></tr>";

	}

	

	

	$html=$html.$header.$htmlcontent."</table> </div>";



	$pic_id=get_val_col(gc_location_logos,pic_id,location_id,$loc_id);

if($pic_id=='')

{

$header_image ="<img src='https://givecentral.org/images/logo.png' alt='give central'><br/>";

}

else 

{

$header_image ="<img src='https://givecentral.org/admin/images/location_logos/".$pic_id.".jpg' alt='give central'><br/>";



}

	

	$welcome="Dear ".$username.",

Thank you for your pledge payment to the ".$loc_name.". Your following payment

has been successfully processed:";

	$body=$header_image.$welcome.$html."<br/><br/>Regards,<br/> Givecentral team.";

	

	return $body;
}
}


if (!function_exists("send_email_one_time_payment_new")) {
function  send_email_one_time_payment_new($userid,$event_id,$amount,$payment_method_id,$dependant_id,$processed_by,$email)
{
	global $database_nfconx;
	global $nfconx;
	mysql_select_db($database_nfconx, $nfconx);	
	
	$event_title=get_val_col(events,event_title,event_id,$event_id);
	$loc_id=get_val_col(events,location_id,event_id,$event_id);
	$loc_name=get_val_col(locations,location_name,location_id,$loc_id);
	

	$query_rsnf="select * from users where userid='".$userid."'";
	$rsnf = mysql_query($query_rsnf, $nfconx);
	$row_rsnf = mysql_fetch_assoc($rsnf);
	           
	$username=$row_rsnf["name"];
	$user_email=$row_rsnf["email"];
    
	$query_rsnf1="Select * from donor_dependants g WHERE g.userid='".$userid."' and g.donor_dependant_id='".$dependant_id."'";
	$rsnf1 = mysql_query($query_rsnf1, $nfconx);
	$row_rsnf1 = mysql_fetch_assoc($rsnf1);
	$dependant_name=$row_rsnf1["dependant_name"];

	
	if(get_val_col(donor_payment_methods , payment_method_type, donor_payment_method_id, $payment_method_id) == 'Credit Card')
	{
		$query_rsnf = "SELECT *  FROM donor_payment_methods dpm
	JOIN master_credit_card_types mcc on mcc.credit_card_type_id=dpm.credit_card_type_id
	WHERE  dpm.userid ='".$userid."' and dpm.donor_payment_method_id='".$payment_method_id."'";
	}
	else
	{
		$query_rsnf = "SELECT *  FROM donor_payment_methods dpm	WHERE  dpm.userid ='".$userid."' and dpm.donor_payment_method_id='".$payment_method_id."'";
	}
	$rsnf = mysql_query($query_rsnf, $nfconx);
	$row_rsnf = mysql_fetch_assoc($rsnf);
	
	
	$location_id = get_val_col('events','location_id','event_id', $event_id);
	
	$query = "SELECT * FROM location_banner WHERE location_id = '".$location_id."'";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	
	
	
	$body = '<html>	
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Thank You from GiveCentral!</title>
	</head>        
    <body bgcolor="#ffffe3">
		<table bgcolor="#ffffe3" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0;padding:0;color:#fdf5a8;font-size:12px;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;line-height:18px;">
			<tbody>
            	<tr>
					<td>
                    	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
							<tbody>
                            	<tr>
									<td valign="bottom" width="250" align="center" style="padding:0 0 20px 0;">';
									
									if($num == 1)
									{												
										$body.='<a href="https://www.givecentral.org/new/"><img src="https://www.givecentral.org/beta/images/location_banners/'.$row['banner'].'" width="600" height="137" ></a>';
									}
									else
									{
										$body.='<a href="https://www.givecentral.org/new/"><img src="https://www.givecentral.org/beta/images/TitleBannerBlue.jpg" width="600" height="137" alt="GiveCentral" border="0"></a>';
									}
									
                                    	
                                    $body.='</td>
								</tr>
								<tr>
								<td colspan="5" style="background:#dfebff;">
                                
                                <h3 style=" clear:both;line-height:36px; margin:0;padding:10px 0px 10px 0px;color:#274d6f;font-size:24px;font-weight:bold;text-align:center;background-color:#ffffff;">Thank You for Your Payment</h3>
                                
								<p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Dear '.$username.',</p>
                                
								<p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Thank you for making your payment through GiveCentral. Your transaction has been successfully processed as follows:</p>
                                
								<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;"><img src="https://www.givecentral.org/beta/images/acornLeaves.jpg" width="173" height="111" style=" background-color:#ffffff; border:#274d6f solid 4px; margin:0px 30px 5px 40px;" align="right" alt="GiveCentral">
                                    Event name: <strong>'.$event_title.'</strong><br>
                                    Amount (USD): <strong>'.$amount.'</strong><br>
                                    Payment method: <strong>';
									
									if($row_rsnf["payment_method_type"]=="Credit Card")		
									{	
										$body.=$row_rsnf["credit_card_type"]."--".$row_rsnf["cc_card_no"];
									} 
									else
									{
										$body.=$row_rsnf["ec_bank_name"]."--".$row_rsnf["ec_account_no"];
									}
										
									
									$body.='</strong><br>';
									
									if($dependant_name != '')
									{									
										$body.='Dependent name: <strong>'.$dependant_name.'</strong><br>';
									}
									$body.='PAYMENT PROCESSED BY: <strong>'.$processed_by.'</strong>  
                                </p>';
                                
								
								$query_admin = "select * from users where userid = '".$_SESSION['NF_Username']."' and profile_id = '13' and user_type = 'Location Administrator'";
								$result_admin = mysql_query($query_admin);
								$row_admin = mysql_fetch_array($result_admin);
								
								if(mysql_num_rows($result_admin) > 0)
								{
								
								$body.='<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">If you have questions, please contact '.$row_admin['name'];
								if($row_admin['mobile'] != '')
								{
									$body.=' at '.$row_admin['mobile'];
								}
								if($row_admin['email'] != '')
								{
									if($row_admin['mobile'] != '')
									{
										$body.=' or';
									}
									else
									{
										$body.=' at';
									}
									$body.=' '.$row_admin['email'];
								}
								
								$body.='. Please e-mail GiveCentral at <a href="mailto:info@givecentral.org" style="color:#274d6f">info@givecentral.org</a> if you experience a processing error.</p>';
								}
															
							
                            	$body.='</td>
							</tr>
							<tr>
								<td bgcolor="#ffffff">
                                	<table width="600" border="0" cellspacing="0" cellpadding="0">
										<tbody>
                                        	<tr>
												<td colspan="5">&nbsp;</td>
											</tr>           
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td  align="center" style="background:#dfebff; padding:15px 0 15px 0;">
								If you want to unsubscribe, please <a style="color:#274d6f" href="http://givecentral.org/beta/unsubscription.php?email='.$email.'">Click Here</a>.
								</td>
							</tr> 
							<tr>
								<td valign="top" align="center" bgcolor="#acd4fc" style="padding:15px 0 15px 0;">
                                	<a href="https://twitter.com/GiveCentral"><img src="https://www.givecentral.org/beta/images/twitter.png" width="52" height="52" alt="Follow GiveCentral on Twitter" border="0"></a><a href="https://www.facebook.com/givecentral" style="margin:0 100px 0 100px;"><img src="https://www.givecentral.org/beta/images/facebook.png" width="52" height="52" alt="Like GiveCentral on Facebook" border="0"></a><a href="mailto:info@givecentral.org"><img src="https://www.givecentral.org/beta/images/mail.png" width="52" height="52" alt="email GiveCentral" border="0"></a>
                                </td>
							</tr>
							<tr>
								<td valign="top">&nbsp;</td>
							</tr>
							<tr>
								<td valign="top" align="center" style="padding:5px 0 20px 0;color:#274d6f;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;font-weight:bold;font-size:12px;line-height:normal;">
                                <a href="https://www.givecentral.org/new/" style="color:#274d6f">GiveCentral</a> | 233 South Wacker Drive, Suite 3430, Chicago, IL 60606<br>
<a href="https://twitter.com/GiveCentral" style="color:#274d6f;text-decoration:none;">@GiveCentral</a> | <a href="mailto:info@givecentral.org" style="color:#274d6f;text-decoration:none;">info@givecentral.org</a>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
    
    </body>
</html>';
return $body;
}
}




if (!function_exists("send_email_for_tickevent_success")) {
function  send_email_for_tickevent_success($user_name,$session_id,$location_id)

{	

	$loc_name = get_val_col(locations,location_name,location_id,$location_id);

	

	$html="<div style='font-size:12px;border-bottom-style:ridge; border-left-style:ridge; border-right-style:ridge; border-top-style:ridge;'><br/> You have made one time payment for the following event of ".$loc_name.". Your payment details are defined below :<br/><br/><table id='MyTable'border='1' style='font-size:12px'  width='100%' cellspacing='0' cellpadding='0'>";

	$html.="<th align='center'>EVENT</th><th align='center'>AMOUNT(in USD)</th align='center'><th>No Of Tickets</th>";	



	

	$sql1 = "select event_id,amount,no_of_tickets from ticket_events where session_id = '".$session_id."'";



	$result1 = mysql_query($sql1)or die(mysql_error());

	while($row1 = mysql_fetch_array($result1))

	{

		$event_title  = get_val_col(events,event_title,event_id,$row1['event_id']);

		

		$html.="<tr style='font-size:12px'><td align='center'>".$event_title."</td><td align='center'>".$row1['amount']."</td><td align='center'>".$row1['no_of_tickets']."</td></tr>";

	}



	$html.="</table> </div>";



	$welcome="<img src='http://localhost/givecentral/images/logo.png'><br/>Thanks for being with us, ".$user_name."! ";

	$body=$welcome.$html."<br/><br/>Regards,<br/> Givecentral team.";

	

	return $body;
}
}





if (!function_exists("send_email_add_paymentmethod")) {
function send_email_add_paymentmethod($payment_method_id,$tpye)
{
	global $database_nfconx;

	global $nfconx;

	//echo 'i was here';

	mysql_select_db($database_nfconx, $nfconx);

	$query_rsnf = "SELECT *,dpm.userid as user

	FROM donor_payment_methods dpm

	left outer JOIN users us ON us.userid = dpm.userid

	left outer JOIN donor_billing_address dba ON dba.donor_billing_address_id = dpm.billing_address_id

	left outer JOIN master_credit_card_types cct ON cct.credit_card_type_id = dpm.credit_card_type_id

	WHERE 

	cimid =  '".$payment_method_id."' ";
	
	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);


	$subject = "Give Central-- Payment method added notfification.";
	

	$body='<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"><title>GiveCentral Notice: Your Payment Method Has Been Modified</title>
</head><body bgcolor="#ffffe3">
<table bgcolor="#ffffe3" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0;padding:0;color:#fdf5a8;font-size:12px;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;line-height:18px;">
  <tbody><tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tbody><tr>
          <td valign="bottom" width="250" align="center" style="padding:0 0 20px 0;"><a href="https://www.givecentral.org/new/"><img src="http://resourcerenewalproject.com/givecentralemails/images/TitleBannerBlue.jpg" width="600" height="137" alt="GiveCentral" border="0"></a></td>
        </tr>
        <tr>
                <td colspan="5" style="background:#dfebff;"><h3 style=" clear:both;line-height:36px; margin:0;padding:10px 0px 10px 0px;color:#274d6f;font-size:24px;font-weight:bold;text-align:center;background-color:#ffffff;">Your Payment Method Has Been Added</h3>
        <p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Dear '.$row_rsnf["name"].',</p>
<p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Thank you for adding your payment method through GiveCentral. It has been added as follows:</p>
<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;"><img src="http://resourcerenewalproject.com/givecentralemails/images/creditcardcloseup.jpg" width="173" height="113" style=" background-color:#ffffff; border:#274d6f solid 4px; margin:0px 30px 5px 40px;" align="right" alt="GiveCentral">';
	
	if($tpye=="Credit Card")
	{
		$body.='Name as it appears on card: <strong>'.$row_rsnf["cc_name_on_card"].'</strong><br>
			  	Credit card number: <strong>'.$row_rsnf["credit_card_type"].'--'.$row_rsnf["cc_card_no"].'</strong><br>
			  	Expiration date: <strong>'.$row_rsnf["cc_card_expiry_date"].'</strong>  <br>  
				Billing address:';
		
		if($row_rsnf["address1"] != '')
		{
			$body.= '<strong>'.$row_rsnf["address1"].'</strong><br>';
		}
		if($row_rsnf["address2"] != '')
		{
			$body.= '<strong>'.$row_rsnf["address2"].'</strong><br>';
		}
		if($row_rsnf["donor_city"] != '')
		{
			$body.= '<strong>'.$row_rsnf["donor_city"].'</strong><br>';
		}
		if($row_rsnf["donor_state"] != '')
		{
			$body.= '<strong>'.get_val_col(master_states_us,state_name,state_code,$row_rsnf["donor_state"]).'</strong><br>';
		}
		if($row_rsnf["zip"] != '')
		{
			$body.= '<strong>'.$row_rsnf["zip"].'</strong><br>';
		}
		$body.= '</p>
			<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">';
	}
	else 
	{
		$body.='Name on account: <strong>'.$row_rsnf["ec_account_name"].'</strong><br>
			  	Bank Name: <strong>'.$row_rsnf["ec_bank_name"].'</strong><br>
				Account Number: <strong>'.$row_rsnf["ec_account_no"].'</strong><br>
			  	Account Type: <strong>'.$row_rsnf["ec_account_type"].'</strong>  <br>  
				Billing address:';
		
		if($row_rsnf["address1"] != '')
		{
			$body.= '<strong>'.$row_rsnf["address1"].'</strong><br>';
		}
		if($row_rsnf["address2"] != '')
		{
			$body.= '<strong>'.$row_rsnf["address2"].'</strong><br>';
		}
		if($row_rsnf["donor_city"] != '')
		{
			$body.= '<strong>'.$row_rsnf["donor_city"].'</strong><br>';
		}
		if($row_rsnf["donor_state"] != '')
		{
			$body.= '<strong>'.get_val_col(master_states_us,state_name,state_code,$row_rsnf["donor_state"]).'</strong><br>';
		}
		if($row_rsnf["zip"] != '')
		{
			$body.= '<strong>'.$row_rsnf["zip"].'</strong><br>';
		}
		$body.= '</p>
			<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">';
	}
	
	
$userid = get_val_col(donor_payment_methods,userid,cimid,$payment_method_id);
$primary_location_id = get_val_col(donor_profiles,primary_location_id,userid,$userid);
$query_admin = "select name,mobile,email from users where user_type='Location Administrator' and location_id = '".$primary_location_id."' and status = '1'";
$result_admin = mysql_query($query_admin);
$row_admin = mysql_fetch_array($result_admin);	
	
	
	
	$body.='If you have questions, please contact '.$row_admin['name'];
	
	if($row_admin['mobile'] != '')
	{
		$body.=' at '.$row_admin['mobile'].' or ';
	}
	if($row_admin['email'] != '')
	{
		$body.=$row_admin['email'];
	}
		
	$body.='. Please e-mail GiveCentral at <a href="mailto:info@givecentral.org" style="color:#274d6f">info@givecentral.org</a> if you experience a processing error.</p>

<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif; border-bottom:#ffffe3 double 4px;">&nbsp;</p>
</td>
        </tr>
        <tr>
          <td bgcolor="#ffffff"><table width="600" border="0" cellspacing="0" cellpadding="0">
<tbody><tr>
	<td colspan="5">&nbsp;</td>
</tr>           
            </tbody></table></td>
        </tr>
        <tr>
          <td valign="top" align="center" bgcolor="#acd4fc" style="padding:15px 0 15px 0;"><a href="https://twitter.com/GiveCentral"><img src="http://resourcerenewalproject.com/givecentralemails/images/twitter.png" width="52" height="52" alt="Follow GiveCentral on Twitter" border="0"></a><a href="https://www.facebook.com/givecentral" style="margin:0 100px 0 100px;"><img src="http://resourcerenewalproject.com/givecentralemails/images/facebook.png" width="52" height="52" alt="Like GiveCentral on Facebook" border="0"></a><a href="mailto:info@givecentral.org"><img src="http://resourcerenewalproject.com/givecentralemails/images/mail.png" width="52" height="52" alt="email GiveCentral" border="0"></a></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" align="center" style="padding:5px 0 20px 0;color:#274d6f;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;font-weight:bold;font-size:12px;line-height:normal;"><a href="https://www.givecentral.org/new/" style="color:#274d6f">GiveCentral</a> | 233 South Wacker Drive, Suite 3430, Chicago, IL 60606<br>
           <a href="https://twitter.com/GiveCentral" style="color:#274d6f;text-decoration:none;">@GiveCentral</a> | <a href="mailto:info@givecentral.org" style="color:#274d6f;text-decoration:none;">info@givecentral.org</a></td>
        </tr>
      </tbody></table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</tbody></table>


</body></html>';
		
	return $body;
}
}





if (!function_exists("send_email_edit_paymentmethod")) {
function send_email_edit_paymentmethod($payment_method_id,$tpye)

{

	global $database_nfconx;

	global $nfconx;

	//echo 'i was here';

	mysql_select_db($database_nfconx, $nfconx);

		$query_rsnf = "SELECT *,dpm.userid as user

		FROM donor_payment_methods dpm

		JOIN users us ON us.userid = dpm.userid

		JOIN donor_billing_address dba ON dba.donor_billing_address_id = dpm.billing_address_id

		JOIN master_credit_card_types cct ON cct.credit_card_type_id = dpm.credit_card_type_id

		WHERE 

		donor_payment_method_id =  '".$payment_method_id."' ";

		// echo $query_rsnf;

		$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

		$row_rsnf = mysql_fetch_assoc($rsnf);

		//echo $row_rsnf['email'];

		$subject = "Give Central-- Payment method edited notfification..";
		
		$body='<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"><title>GiveCentral Notice: Your Payment Method Has Been Modified</title>
</head><body bgcolor="#ffffe3">
<table bgcolor="#ffffe3" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0;padding:0;color:#fdf5a8;font-size:12px;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;line-height:18px;">
  <tbody><tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tbody><tr>
          <td valign="bottom" width="250" align="center" style="padding:0 0 20px 0;"><a href="https://www.givecentral.org/new/"><img src="http://resourcerenewalproject.com/givecentralemails/images/TitleBannerBlue.jpg" width="600" height="137" alt="GiveCentral" border="0"></a></td>
        </tr>
        <tr>
                <td colspan="5" style="background:#dfebff;"><h3 style=" clear:both;line-height:36px; margin:0;padding:10px 0px 10px 0px;color:#274d6f;font-size:24px;font-weight:bold;text-align:center;background-color:#ffffff;">Your Payment Method Has Been Updated</h3>
        <p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Dear '.$row_rsnf["name"].',</p>
<p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Thank you for changing your payment method through GiveCentral. It has been updated as follows:</p>
<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;"><img src="http://resourcerenewalproject.com/givecentralemails/images/creditcardcloseup.jpg" width="173" height="113" style=" background-color:#ffffff; border:#274d6f solid 4px; margin:0px 30px 5px 40px;" align="right" alt="GiveCentral">';
	
	if($tpye=="Credit Card")
	{
		$body.='Name as it appears on card: <strong>'.$row_rsnf["cc_name_on_card"].'</strong><br>
			  	Credit card number: <strong>'.$row_rsnf["credit_card_type"].'--'.$row_rsnf["cc_card_no"].'</strong><br>
			  	Expiration date: <strong>'.$row_rsnf["cc_card_expiry_date"].'</strong>  <br>  
				Billing address:';
		
		if($row_rsnf["address1"] != '')
		{
			$body.= '<strong>'.$row_rsnf["address1"].'</strong><br>';
		}
		if($row_rsnf["address2"] != '')
		{
			$body.= '<strong>'.$row_rsnf["address2"].'</strong><br>';
		}
		if($row_rsnf["donor_city"] != '')
		{
			$body.= '<strong>'.$row_rsnf["donor_city"].'</strong><br>';
		}
		if($row_rsnf["donor_state"] != '')
		{
			$body.= '<strong>'.get_val_col(master_states_us,state_name,state_code,$row_rsnf["donor_state"]).'</strong><br>';
		}
		if($row_rsnf["zip"] != '')
		{
			$body.= '<strong>'.$row_rsnf["zip"].'</strong><br>';
		}
		$body.= '</p>
			<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">';
	}
	else 
	{
		$body.='Name on account: <strong>'.$row_rsnf["ec_account_name"].'</strong><br>
			  	Bank Name: <strong>'.$row_rsnf["ec_bank_name"].'</strong><br>
				Account Number: <strong>'.$row_rsnf["ec_account_no"].'</strong><br>
			  	Account Type: <strong>'.$row_rsnf["ec_account_type"].'</strong>  <br>  
				Billing address:';
		
		if($row_rsnf["address1"] != '')
		{
			$body.= '<strong>'.$row_rsnf["address1"].'</strong><br>';
		}
		if($row_rsnf["address2"] != '')
		{
			$body.= '<strong>'.$row_rsnf["address2"].'</strong><br>';
		}
		if($row_rsnf["donor_city"] != '')
		{
			$body.= '<strong>'.$row_rsnf["donor_city"].'</strong><br>';
		}
		if($row_rsnf["donor_state"] != '')
		{
			$body.= '<strong>'.get_val_col(master_states_us,state_name,state_code,$row_rsnf["donor_state"]).'</strong><br>';
		}
		if($row_rsnf["zip"] != '')
		{
			$body.= '<strong>'.$row_rsnf["zip"].'</strong><br>';
		}
		$body.= '</p>
			<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">';
	}
	
	
$userid = get_val_col(donor_payment_methods,userid,cimid,$payment_method_id);
$primary_location_id = get_val_col(donor_profiles,primary_location_id,userid,$userid);
$query_admin = "select name,mobile,email from users where user_type='Location Administrator' and location_id = '".$primary_location_id."' and status = '1'";
$result_admin = mysql_query($query_admin);
$row_admin = mysql_fetch_array($result_admin);	
	
	
	
	$body.='If you have questions, please contact '.$row_admin['name'];
	
	if($row_admin['mobile'] != '')
	{
		$body.=' at '.$row_admin['mobile'].' or ';
	}
	if($row_admin['email'] != '')
	{
		$body.=$row_admin['email'];
	}
		
	$body.='. Please e-mail GiveCentral at <a href="mailto:info@givecentral.org" style="color:#274d6f">info@givecentral.org</a> if you experience a processing error.</p>

<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif; border-bottom:#ffffe3 double 4px;">&nbsp;</p>
</td>
        </tr>
        <tr>
          <td bgcolor="#ffffff"><table width="600" border="0" cellspacing="0" cellpadding="0">
<tbody><tr>
	<td colspan="5">&nbsp;</td>
</tr>           
            </tbody></table></td>
        </tr>
        <tr>
          <td valign="top" align="center" bgcolor="#acd4fc" style="padding:15px 0 15px 0;"><a href="https://twitter.com/GiveCentral"><img src="http://resourcerenewalproject.com/givecentralemails/images/twitter.png" width="52" height="52" alt="Follow GiveCentral on Twitter" border="0"></a><a href="https://www.facebook.com/givecentral" style="margin:0 100px 0 100px;"><img src="http://resourcerenewalproject.com/givecentralemails/images/facebook.png" width="52" height="52" alt="Like GiveCentral on Facebook" border="0"></a><a href="mailto:info@givecentral.org"><img src="http://resourcerenewalproject.com/givecentralemails/images/mail.png" width="52" height="52" alt="email GiveCentral" border="0"></a></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" align="center" style="padding:5px 0 20px 0;color:#274d6f;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;font-weight:bold;font-size:12px;line-height:normal;"><a href="https://www.givecentral.org/new/" style="color:#274d6f">GiveCentral</a> | 233 South Wacker Drive, Suite 3430, Chicago, IL 60606<br>
           <a href="https://twitter.com/GiveCentral" style="color:#274d6f;text-decoration:none;">@GiveCentral</a> | <a href="mailto:info@givecentral.org" style="color:#274d6f;text-decoration:none;">info@givecentral.org</a></td>
        </tr>
      </tbody></table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</tbody></table>


</body></html>';
		
		return $body;

}
}
/////////////////////////////////////////////////////////////////////////////////////


if (!function_exists("send_email_enroll_event")) {
function send_email_enroll_event($userid)

{

	

	global $database_nfconx;

	global $nfconx;

	//echo 'i was here';

	mysql_select_db($database_nfconx, $nfconx);

	

	$query_rsnf="select * from users where userid='".$userid."'";

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	

	$username=$row_rsnf["name"];

	$user_email=$row_rsnf["email"];;

	

	$query_rsnf = "SELECT  distinct *  FROM donor_events a join events b on b.event_id=a.event_id 

	join locations c on c.location_id=b.location_id join donor_events_payment_info d on (d.donor_events_id=a.donor_events_id)

	 join donor_payment_methods e on e.donor_payment_method_id=d.donor_payment_method_id  

	 join master_credit_card_types f on f.credit_card_type_id=e.credit_card_type_id  WHERE  a.is_archive=0 and  a.userid ='".$userid."' and a.session_id='".$_SESSION['My_Session_ID']."'";

	// echo $query_rsnf;

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	$totalRows_rsnf = mysql_num_rows($rsnf);

	$html="<br/><div style='font-size:12px;border-bottom-style:ridge; border-left-style:ridge; border-right-style:ridge; border-top-style:ridge;'> <br/> You have enrolled for the following events. The payments shall be processed as per the scheduled defined below :<br/><br/><table id='MyTable'border='1' style='font-size:12px'  width='100%' cellspacing='0' cellpadding='0'>";

	$header="<th>LOCATION</th><th>EVENT</th><th>PAYMENT FREQUENCY</th><th>START DATE</th><th>END DATE</th><th>AMOUNT(in USD)</th><th>CARD NO.</th>";

				$htmlcontent="";

	if ($totalRows_rsnf > 0) 

	{

			

			do

			{			

			 $htmlcontent= $htmlcontent."<tr style='font-size:12px'><td align='center'>".$row_rsnf["location_name"]."</td><td align='center'>".$row_rsnf["event_title"]."</td><td align='center'>".$row_rsnf["payment_frequency"]."</td><td align='center'>".$row_rsnf["payment_start_date"]."</td><td align='center'>".$row_rsnf["payment_end_date"]."</td><td align='center'>$".$row_rsnf["amount"]."</td>"."</td><td align='center'>".$row_rsnf["credit_card_type"]."-".$row_rsnf["cc_card_no"].$row_rsnf["ec_account_no"]."</td></tr>";

			

			} while ($row_rsnf = mysql_fetch_assoc($rsnf));

	}

	$html=$html.$header.$htmlcontent."</table> </div>";



	

	$logo="<img src='http://givecentral.org/new/images/logo.png' alt='give central'><br/>";

	$welcome="Thanks for your contribution, ".$username."!  <br/><br/><div style='font-size:12px;border-bottom-style:ridge; border-left-style:ridge; border-right-style:ridge; border-top-style:ridge;'>You can manage your account, sign up for new events and view your giving history online at <a href='http://givecentral.org' >www.givecentral.org</a>. Your username is <b>".$userid."</b>.  </div><br/>";

	$body=$logo.$welcome.$html."<br/><br/>Regards,<br/> Givecentral team.";

	

	$subject="Give Central--Event Subscription Notification...";

	return $body;

}
}


if (!function_exists("send_email_enroll_single_event")) {
function send_email_enroll_single_event($eventid,$userid,$donor_payment_method_id)
{
	
	
	global $database_nfconx;
	global $nfconx;
	//echo 'i was here';
	mysql_select_db($database_nfconx, $nfconx);
	
	$query_rsnf="select * from users where userid='".$userid."'";
	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());
	$row_rsnf = mysql_fetch_assoc($rsnf);
	
	$username=$row_rsnf["name"];
	$user_email=$row_rsnf["email"];;
	
	$query_rsnf = "SELECT distinct *  FROM donor_events a join events b on b.event_id=a.event_id 
	join locations c on c.location_id=b.location_id join donor_events_payment_info d on (d.donor_events_id=a.donor_events_id)
	 join donor_payment_methods e on e.donor_payment_method_id=d.donor_payment_method_id  
	left outer  join master_credit_card_types f on f.credit_card_type_id=e.credit_card_type_id  WHERE  a.is_archive=0 and  a.userid ='".$userid."' and a.event_id='".$eventid."'";
	// echo $query_rsnf;
	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());
	$row_rsnf = mysql_fetch_assoc($rsnf);
	$totalRows_rsnf = mysql_num_rows($rsnf);

	
	
	$body='<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"><title>GiveCentral Notice: New Event Has Been Successfully Addeed</title>
</head><body bgcolor="#ffffe3">
<table bgcolor="#ffffe3" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0;padding:0;color:#fdf5a8;font-size:12px;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;line-height:18px;">
  <tbody><tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
        <tbody><tr>
          <td valign="bottom" width="250" align="center" style="padding:0 0 20px 0;"><a href="https://www.givecentral.org/new/"><img src="http://resourcerenewalproject.com/givecentralemails/images/TitleBannerBlue.jpg" width="600" height="137" alt="GiveCentral" border="0"></a></td>
        </tr>
        <tr>
                <td colspan="5" style="background:#dfebff;"><h3 style=" clear:both;line-height:36px; margin:0;padding:10px 0px 10px 0px;color:#274d6f;font-size:24px;font-weight:bold;text-align:center;background-color:#ffffff;">Event Has Been Updated.</h3>
        <p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Dear '.$username.',</p>
<p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Thank you for updating event. Event details are as follows:</p>';
	
	
 				
	if ($totalRows_rsnf > 0) 
	{
		$body.='<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;"><img src="http://resourcerenewalproject.com/givecentralemails/images/giftSmall.jpg" width="173" height="111" style=" background-color:#ffffff; border:#274d6f solid 4px; margin:0px 30px 5px 40px;" align="right" alt="GiveCentral">';	
			
		do
		{
			$body.='Event name: <strong>'.$row_rsnf["event_title"].'</strong><br>
			Donation frequency: <strong>'.$row_rsnf["payment_frequency"].'</strong><br>
			Start date: <strong>'.$row_rsnf["payment_start_date"].'</strong><br>';
			
			if($row_rsnf["payment_start_date"] != $row_rsnf["payment_end_date"])
			{
				$body.='End date: <strong>'.$row_rsnf["payment_end_date"].'</strong> <br>';
			}
			
			$body.='Amount (USD): <strong>'.$row_rsnf["amount"].'</strong><br>';
					
			if ($row_rsnf["payment_method_type"]=="Credit Card")
			{
				$body.='Payment method: <strong>'.$row_rsnf["credit_card_type"].' '.$row_rsnf["cc_card_no"].'</strong></p>';							 
			}
			else
			{
				$body.='Payment method: <strong>'.$row_rsnf["ec_bank_name"].' '.$row_rsnf["ec_account_no"].'</strong></p>';			
			}
		
		} 
		while ($row_rsnf = mysql_fetch_assoc($rsnf));
	}
	
	$primary_location_id = get_val_col(donor_profiles,primary_location_id,userid,$userid);				
	$query_admin = "select name,mobile,email from users where user_type='Location Administrator' and location_id = '".$primary_location_id."' and status = '1'";
	$result_admin = mysql_query($query_admin);
	$row_admin = mysql_fetch_array($result_admin);
	
	
	$body.='<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">If you have questions, please contact '.$row_admin['name'];
	
	if($row_admin['mobile'] != '')
	{
		$body.=' at '.$row_admin['mobile'].' or ';
	}
	if($row_admin['email'] != '')
	{
		$body.=$row_admin['email'];
	}
	
	$body.='. Please e-mail GiveCentral at <a href="mailto:info@givecentral.org" style="color:#274d6f">info@givecentral.org</a> if you experience a processing error.</p>
</td>
        </tr>
        <tr>
          <td bgcolor="#ffffff"><table width="600" border="0" cellspacing="0" cellpadding="0">
<tbody><tr>
	<td colspan="5">&nbsp;</td>
</tr>           
            </tbody></table></td>
        </tr>
        <tr>
          <td valign="top" align="center" bgcolor="#acd4fc" style="padding:15px 0 15px 0;"><a href="https://twitter.com/GiveCentral"><img src="http://resourcerenewalproject.com/givecentralemails/images/twitter.png" width="52" height="52" alt="Follow GiveCentral on Twitter" border="0"></a><a href="https://www.facebook.com/givecentral" style="margin:0 100px 0 100px;"><img src="http://resourcerenewalproject.com/givecentralemails/images/facebook.png" width="52" height="52" alt="Like GiveCentral on Facebook" border="0"></a><a href="mailto:info@givecentral.org"><img src="http://resourcerenewalproject.com/givecentralemails/images/mail.png" width="52" height="52" alt="email GiveCentral" border="0"></a></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" align="center" style="padding:5px 0 20px 0;color:#274d6f;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;font-weight:bold;font-size:12px;line-height:normal;"><a href="https://www.givecentral.org/new/" style="color:#274d6f">GiveCentral</a> | 233 South Wacker Drive, Suite 3430, Chicago, IL 60606<br>
           <a href="https://twitter.com/GiveCentral" style="color:#274d6f;text-decoration:none;">@GiveCentral</a> | <a href="mailto:info@givecentral.org" style="color:#274d6f;text-decoration:none;">info@givecentral.org</a></td>
        </tr>
      </tbody></table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</tbody></table>
</body></html>';
	
	return $body;
}
}



if (!function_exists("send_email_edit_single_event")) {
function send_email_edit_single_event($eventid,$userid,$donor_payment_method_id)

{

  global $database_nfconx;

	global $nfconx;

	//echo 'i was here';

	mysql_select_db($database_nfconx, $nfconx);

	

	$query_rsnf="select * from users where userid='".$userid."'";

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	

	$username=$row_rsnf["name"];

	$user_email=$row_rsnf["email"];;

	

	$query_rsnf = "SELECT distinct *  FROM donor_events a join events b on b.event_id=a.event_id 

	join locations c on c.location_id=b.location_id join donor_events_payment_info d on (d.donor_events_id=a.donor_events_id)

	 join donor_payment_methods e on e.donor_payment_method_id=d.donor_payment_method_id  

	left outer  join master_credit_card_types f on f.credit_card_type_id=e.credit_card_type_id  WHERE  a.is_archive=0 and  a.userid ='".$userid."' and a.event_id='".$eventid."'";

	// echo $query_rsnf;

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	$totalRows_rsnf = mysql_num_rows($rsnf);

	$html="<br/><div style='font-size:12px;border-bottom-style:ridge; border-left-style:ridge; border-right-style:ridge; border-top-style:ridge;'><br/><table id='MyTable'border='1' style='font-size:12px'  width='100%' cellspacing='0' cellpadding='0'>";

	$header="<th>LOCATION</th><th>EVENT</th><th>PAYMENT FREQUENCY</th><th>START DATE</th><th>END DATE</th><th>AMOUNT(in USD)</th><th>CARD NO.</th>";

	$pic_id=get_val_col(gc_location_logos,pic_id,location_id,$row_rsnf['location_id']);

if($pic_id=='')

{

$header_image ="<img src='http://givecentral.org/new/images/logo.png' alt='give central'><br/>";

}

else 

{

$header_image ="<img src='http://givecentral.org/admin/images/location_logos/".$pic_id.".jpg' alt='give central'><br/>";



}

 $bm_phone_number = get_val_col_multiple(users, mobile, location_id, $row_rsnf["location_id"], profile_id, '13');

	 if($bm_phone_number=='')

	 {

	 $bm_phone_number='Phone number Not Available';

	 }

$location_name=get_val_col(locations,location_name,location_id,$row_rsnf['location_id']);

$welcome=" Dear ".$username." , <br/>Per your request, the donation schedule for the ".$location_name." has been modified.  From this point forward donations will be processed per the schedule below.

<br/>";

				$htmlcontent="";

				

				

	if ($totalRows_rsnf > 0) 

	{

			

			do

			{			

			if ($row_rsnf["payment_method_type"]=="Credit Card")

			{

			 $htmlcontent= $htmlcontent."<tr style='font-size:12px'><td align='center'>".$row_rsnf["location_name"]."</td><td align='center'>".$row_rsnf["event_title"]."</td><td align='center'>".$row_rsnf["payment_frequency"]."</td><td align='center'>".$row_rsnf["payment_start_date"]."</td><td align='center'>".$row_rsnf["payment_end_date"]."</td><td align='center'>$".$row_rsnf["amount"]."</td>"."</td><td align='center'>".$row_rsnf["credit_card_type"]."-".$row_rsnf["cc_card_no"]."</td></tr>";

			 }

			 else

			 {

			 $htmlcontent= $htmlcontent."<tr style='font-size:12px'><td align='center'>".$row_rsnf["location_name"]."</td><td align='center'>".$row_rsnf["event_title"]."</td><td align='center'>".$row_rsnf["payment_frequency"]."</td><td align='center'>".$row_rsnf["payment_start_date"]."</td><td align='center'>".$row_rsnf["payment_end_date"]."</td><td align='center'>$".$row_rsnf["amount"]."</td>"."</td><td align='center'>".$row_rsnf["ec_bank_name"]."-".$row_rsnf["ec_account_no"]."</td></tr>";



			 }

			

			} while ($row_rsnf = mysql_fetch_assoc($rsnf));

	}

	$html=$html.$header.$htmlcontent."</table> </div>";



	

	$end_text = "If you have any questions regarding your donation, please call the ".$location_name. " at (".$bm_phone_number.") or email the GiveCentral team at info@givecentral.org.";

	

	$body=$header_image.$welcome.$html.$end_text."<br/><br/>Regards,<br/> Givecentral team.";

	

	$subject="Give Central--Event Subscription Notification...";

	return $body;

}
}



if (!function_exists("send_email_delete_payment_method")) {
function send_email_delete_payment_method($donor_payment_method_id,$paymet_mode)
{
	global $database_nfconx;
	global $nfconx;
	
	mysql_select_db($database_nfconx, $nfconx);
	
	$query_rsnf = "SELECT *,dpm.userid as user 
	FROM donor_payment_methods dpm 
	left outer JOIN users us ON us.userid = dpm.userid  
	left outer JOIN donor_billing_address dba ON dba.donor_billing_address_id = dpm.billing_address_id 
	left outer JOIN master_credit_card_types cct ON cct.credit_card_type_id = dpm.credit_card_type_id 
	WHERE  
	donor_payment_method_id =  '".$donor_payment_method_id."' ";

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());
	$row_rsnf = mysql_fetch_assoc($rsnf);
	
	$body = '<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
					<title>GiveCentral Notice: Your Payment Method Has Been Deleted</title>
				</head>
				
				<body bgcolor="#ffffe3">
					<table bgcolor="#ffffe3" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0;padding:0;color:#fdf5a8;font-size:12px;font-family:Georgia;Times New Roman;line-height:18px;">
						<tbody>
							<tr>
								<td>
									<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
										<tbody>
											<tr>
												<td valign="bottom" width="250" align="center" style="padding:0 0 20px 0;"><a href="https://www.givecentral.org/new/"><img src="https://www.givecentral.org/beta/images/TitleBannerBlue.jpg" width="600" height="137" alt="GiveCentral" border="0"></a></td>
											</tr>
											
											<tr>
												<td colspan="5" style="background:#dfebff;">
												<h3 style=" clear:both;line-height:36px; margin:0;padding:10px 0px 10px 0px;color:#274d6f;font-size:24px;font-weight:bold;text-align:center;background-color:#ffffff;">Your Payment Method Has Been deleted</h3>
												<p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">Dear '.get_val_col(users,name,userid,$_SESSION['NF_Username']).',</p>
			
												<p style="padding: 0px 40px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;">You have deleted the following payment method from your Give Central account.</p>
			
												<p style="padding: 0px 20px 0px 40px;font-size: 14px;line-height:18px;color:#000;font-family:Arial, Helvetica, sans-serif;"><img src="https://www.givecentral.org/beta/images/creditcardcloseup.jpg" width="173" height="113" style=" background-color:#ffffff; border:#274d6f solid 4px; margin:0px 30px 5px 40px;" align="right" alt="GiveCentral">';
			
												if($paymet_mode=="Credit Card")
												{
													$body.='Name as it appears on card: <strong>'.$row_rsnf["cc_name_on_card"].'</strong><br>
													Credit card number: <strong>'.$row_rsnf["credit_card_type"].' '.$row_rsnf["cc_card_no"].' </strong><br>
													Expiration date: <strong>'.$row_rsnf["cc_card_expiry_year"].'-'.$row_rsnf["cc_card_expiry_month"].'</strong>  <br>';											
												}
												else 
												{
													$body.='Account number: <strong>'.$row_rsnf["ec_account_no"].'</strong><br>
													Bank name: <strong>'.$row_rsnf["ec_bank_name"].'</strong><br>';
												}
			
												$body.='Billing address: <strong>'.$row_rsnf['address1'].'</strong><br>';
												
												if($row_rsnf['address2']!='')
												{												
													$body.='<strong>'.$row_rsnf['address2'].'</strong><br>';
												}
												$body.='<strong>'.$row_rsnf['donor_city'].'</strong> 
												<strong>'. get_val_col(master_states_us,state_name,state_code,$row_rsnf['donor_state']).'</strong> 
												<strong>'.$row_rsnf['zip'].'</strong>
												</p>
												</td>
											</tr>
											
											<tr>
												<td bgcolor="#ffffff">
													<table width="600" border="0" cellspacing="0" cellpadding="0">
														<tbody>
															<tr>
																<td colspan="5">&nbsp;</td>
															</tr>           
														</tbody>
													</table>
												</td>
											</tr>
											
											<tr>
												<td valign="top" align="center" bgcolor="#acd4fc" style="padding:15px 0 15px 0;"><a href="https://twitter.com/GiveCentral"><img src="https://www.givecentral.org/beta/images/twitter.png" width="52" height="52" alt="Follow GiveCentral on Twitter" border="0"></a><a href="https://www.facebook.com/givecentral" style="margin:0 100px 0 100px;"><img src="https://www.givecentral.org/beta/images/facebook.png" width="52" height="52" alt="Like GiveCentral on Facebook" border="0"></a><a href="mailto:info@givecentral.org"><img src="https://www.givecentral.org/beta/images/mail.png" width="52" height="52" alt="email GiveCentral" border="0"></a>
												</td>
											</tr>
											<tr>
												<td valign="top">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top" align="center" style="padding:5px 0 20px 0;color:#274d6f;font-family:Georgia, &#39;Times New Roman&#39;, Times, serif;font-weight:bold;font-size:12px;line-height:normal;"><a href="https://www.givecentral.org/new/" style="color:#274d6f">GiveCentral</a> | 233 South Wacker Drive, Suite 3430, Chicago, IL 60606<br>
			<a href="https://twitter.com/GiveCentral" style="color:#274d6f;text-decoration:none;">@GiveCentral</a> | <a href="mailto:info@givecentral.org" style="color:#274d6f;text-decoration:none;">info@givecentral.org</a></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>	
						</tbody>
					</table>
				</body>
			</html>';

	return $body;
}
}


if (!function_exists("get_location_authorization")) {

function get_location_authorization($userid,$location_id)

{

$total_auth = get_row_count_custom_sql(donor_events_payment_info,"userid='" . $userid . "' AND location_id ='" . $location_id . "' AND business_manager_authorization = 'Yes'");

	if ($total_auth > 0){

		return "1";

	} else {

		return "0";

	}

}
}



if (!function_exists("validate_xml_document")) {
function validate_xml_document($xml)

{

$xml = trim($xml);

$xml = substr($xml,0,1);

if ($xml == "<"){

	return "1";

} else {

	return "0";

}

}
}



if (!function_exists("get_next_month")) {
function get_next_month($date) {

	$date = str_replace("/", "-", $date); 

	$year=date("Y",strtotime($date));

	$month=date("n",strtotime($date)) + 1;

	if ($month == 13) {

		$month = 1;

		$year = $year + 1;

	}

	$day = date("t", mktime(0, 0, 0, $month, 1, $year));

	return date("Y/m/d", mktime(0, 0, 0, $month, $day, $year));

}
}



if (!function_exists("get_relay")) {
function get_relay()

{

	//echo 'relay';

	global $database_nfconx;

	global $nfconx;	

	$query_rsnf = "SELECT * from mailer_relayers where relayer_flag=1";

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	$totalRows_rsnf = mysql_num_rows($rsnf);			

	$current_row=$row_rsnf["id"];

	$next_row=$current_row+1;

	$insert_id="";

	if ($totalRows_rsnf > 0)

	{	

		//set the previos relayer 0

		

			$edit_value = array(				

						"relayer_flag"=>"0",								

						);

						$edit_action =update_data("mailer_relayers",array_to_string_update($edit_value),"id='" .$current_row. "'");

						$edit_r=mysql_query($edit_action);					

		//

		$query_rsnf = "SELECT * from mailer_relayers where id='".$next_row."'";

		$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

		$row_rsnf = mysql_fetch_assoc($rsnf);

		$totalRows_rsnf = mysql_num_rows($rsnf);		

			if($totalRows_rsnf==0)

				{

					$query_rsnf = "SELECT * from mailer_relayers limit 0,1";

					$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

					$row_rsnf = mysql_fetch_assoc($rsnf);

					$totalRows_rsnf = mysql_num_rows($rsnf);		

										//set the current relayer to 1

					$edit_value = array(				

						"relayer_flag"=>"1",								

						);

						$edit_action =update_data("mailer_relayers",array_to_string_update($edit_value),"id='" .$row_rsnf["id"]. "'");

						$edit_r=mysql_query($edit_action);					

				}

				else

				{

						$edit_value = array(				

						"relayer_flag"=>"1",								

						);

						$edit_action =update_data("mailer_relayers",array_to_string_update($edit_value),"id='" .$row_rsnf["id"]. "'");

						$edit_r=mysql_query($edit_action);

				}

	}

	else

	{

					$query_rsnf = "SELECT * from mailer_relayers limit 0,1";

					$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

					$row_rsnf = mysql_fetch_assoc($rsnf);

					$totalRows_rsnf = mysql_num_rows($rsnf);		

					$edit_value = array(				

						"relayer_flag"=>"1",								

						);

						$edit_action =update_data("mailer_relayers",array_to_string_update($edit_value),"id='" .$row_rsnf["id"]. "'");

						$edit_r=mysql_query($edit_action);	

	}

			

			

			$smtp_username=$row_rsnf['smtp_username'];

			$smtp_password=$row_rsnf['smtp_password'];

			$smtp_port=$row_rsnf['smtp_port'];

			$smtp_relayer_name=$row_rsnf['smtp_relayer_name'];

			$smtp_hostname=$row_rsnf['smtp_hostname'];

			$relayer=array($smtp_hostname,$smtp_username,$smtp_password,$smtp_port,$smtp_relayer_name);			

			return $relayer;

}
}



if (!function_exists("remove_xml_escape_characters")) {
function remove_xml_escape_characters($string)

{	

		// chek for "   &quot;  '  &apos; <   &lt; >   &gt; &   &amp; 

			$string=str_replace("\"","&quot;",$string);

			$string=str_replace("'","&apos;",$string);

			$string=str_replace("<","&lt;",$string);

			$string=str_replace(">","&gt;",$string);

			$string=str_replace("&","&amp;",$string);

			return $string;


}
}






if (!function_exists("event_date_choser")) {
function event_date_choser($event_id)

{	

	global $database_nfconx;

	global $nfconx;

	

	$query_rsnf = "SELECT * from events where event_id = '" . $event_id . "' ";

	$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());

	$row_rsnf = mysql_fetch_assoc($rsnf);

	$totalRows_rsnf = mysql_num_rows($rsnf);

	

	if (($row_rsnf['default_date'] <> "") && ($row_rsnf['default_date'] <> "0000-00-00")){

	$start_date_choser = "default_date";	

	} else {

	$start_date_choser = "event_start_date";	

	}

	return $start_date_choser;
}
}





if (!function_exists("generate_content_refund")) {
function generate_content_refund($id)

{

global $database_nfconx;

global $nfconx;

mysql_select_db($database_nfconx, $nfconx);	



$query_rsnf = "SELECT * from transaction_status  WHERE id = '" .$id . "'";

$rsnf = mysql_query($query_rsnf, $nfconx);

$row_rsnf = mysql_fetch_assoc($rsnf);

$totalRows_rsnf = mysql_num_rows($rsnf);





$email_content = 'Dear ' . get_val_col(users,name,userid,$row_rsnf['userid']) . ',<br />

<br />

A refund for $'.$row_rsnf['amount'].' has been intiated againt your transaction id <b>'.$row_rsnf['gc_id'].'<b/> . The refund might take 2-3 buisness days to complete. 

<br/> 



You can manage your account, sign up for new events and view your giving history online <a href="http://www.givecentral.org">Give Central</a> and update your payment profile with a new credit card.<br />

<br />

<br/>Regards,<br/> GiveCentral Team';



return $email_content;

}
}




if (!function_exists("getDaysInBetween")) {
function getDaysInBetween($start, $end) { 

// Vars 

$day = 86400; // Day in seconds 

$format = 'Y-m-d'; // Output format (see PHP date funciton) 

$sTime = strtotime($start); // Start as time 

$eTime = strtotime($end); // End as time 

$numDays = round(($eTime - $sTime) / $day) + 1; 

$days = array(); 



// Get days 

for ($d = 0; $d < $numDays; $d++) { 

$days[] = date($format, ($sTime + ($d * $day))); 

} 



// Return days 

return $days; 
}
} 




if (!function_exists("get_reason_from_xml")) {
function get_reason_from_xml($result,$key)

{

		if (($result <> "")&&(validate_xml_document($result) == "1"))

		{

				 $xml = simplexml_load_string($result);

				//parse output

				$auth_response="";

				$status="";

				$referenceno="";

			 foreach ($xml->FIELDS[0]->FIELD as $success)

			  {

				 switch((string) $success['KEY'])

				  { 

					 // Get attributes as element indices

					 case $key:

				   	$auth_response= $success;

					 break;    

				 }

		  	  }

		 }

		 else

		 {

		 $auth_response=$result;

		 }	 

		 

	return $auth_response;		  


}
}



?>