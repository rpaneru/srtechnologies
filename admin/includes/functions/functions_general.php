<?php

if (!function_exists("addslashes_array")) {

function addslashes_array(&$val,$key)

{

   if (is_array($val)) array_walk($val,'addslashes_array',$new);

   else {

      $val = reslash($val);

   }

}
}



if (!function_exists("reslash")) {
function reslash($string)

{

   if (!get_magic_quotes_gpc())$string = addslashes($string);

   return $string;

}
}



if (!function_exists("array_to_string")) {
function array_to_string($array_key){



		return implode(' , ',$array_key);


}
}



if (!function_exists("array_to_string_value")) {
function array_to_string_value($array_key){

array_walk($array_key, 'addslashes_array');

		$value_addition = array();

		foreach ($array_key as $key=>$value){

		

			$value_point = "'".$value."'";

			array_push($value_addition,$value_point);

		

		}

		

		return implode(' ,',$value_addition);

}
}


if (!function_exists("array_to_string_update")) {
function array_to_string_update($array_key){



array_walk($array_key, 'addslashes_array');

		$value_addition = array();

		foreach ($array_key as $key=>$value){

		

			$value_point = $key." = "."'".$value."'";

			array_push($value_addition,$value_point);

		

		}

		

		return implode(', ',$value_addition);
}
}



if (!function_exists("month_int_to_char")) {
function month_int_to_char($int){

$date = array();

$i = $int-1;

$date = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

return $date[$i];

}
}


//--------------- INSERT Function ---------------------------


if (!function_exists("insert_data")) {
function insert_data($table_name, $table_col_name, $table_col_value){



		$basics = "INSERT INTO <<TABLENAME>> (<<KEYSARRAY>>) VALUES (<<VALUESARRAY>>)";

		$output = $basics;

		$output = str_replace("<<TABLENAME>>",$table_name, $output);

		$output = str_replace("<<KEYSARRAY>>",$table_col_name, $output);

		$output = str_replace("<<VALUESARRAY>>",$table_col_value, $output);

		return $output;	

}
}


//------------ UPDATE Function -----------------------------------


if (!function_exists("update_data")) {
function update_data($table_name, $table_update_value, $condition){



		$basics = "UPDATE <<TABLENAME>> SET    <<KEYSARRAY>> WHERE  <<VALUESARRAY>>";

		$output = $basics;

		$output = str_replace("<<TABLENAME>>",$table_name, $output);

		$output = str_replace("<<KEYSARRAY>>",$table_update_value, $output);

		$output = str_replace("<<VALUESARRAY>>",$condition, $output);

		return $output;	
}
}

//------------- Delete Function ---------------------------


if (!function_exists("delete_action")) {
function delete_action($table_name,$condition){

		$basics = "DELETE  FROM  <<TABLENAME>>  WHERE  <<VALUESARRAY>>";

		$output = $basics;

		$output = str_replace("<<TABLENAME>>",$table_name, $output);

		$output = str_replace("<<VALUESARRAY>>",$condition, $output);

		return $output;	
}
}


if (!function_exists("mysql_fetch_full_result_array")) {
function mysql_fetch_full_result_array($result)

{

    $table_result=array();

    $r=0;

    while($row = mysql_fetch_assoc($result)){

        $arr_row=array();

        $c=0;

        while ($c < mysql_num_fields($result)) {       

            $col = mysql_fetch_field($result, $c);   

            $arr_row[$col -> name] = $row[$col -> name];           

            $c++;

        }   

        $table_result[$r] = $arr_row;

        $r++;

    }   

    return $table_result;

}
}


?>