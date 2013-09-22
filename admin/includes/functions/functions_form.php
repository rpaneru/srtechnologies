<?php
if (!function_exists("ShowDbOptions")) {
function ShowDbOptions($table,$field,$field_name,$type,$data,$sort,$title,$html_attributes_string)
{
/*$conn = mysql_connect('localhost', 'user', 'pwd');
if (!$conn) {
   die('Could not connect: ' . mysql_error());
}
mysql_select_db('dbname');*/
global $database_nfconx;
//global $nfconx;

mysql_select_db($database_nfconx);
$query=mysql_query("SHOW COLUMNS FROM ".$table." LIKE
'".$field."'") or die (mysql_error());
if(mysql_num_rows($query)>0)
{
$row=mysql_fetch_row($query);

$options=explode("','",preg_replace("/(enum|set)\('(.+?)'\)/","\\2",$row[1]));
if ($sort =="yes")
sort ($options);
$ARay = explode(",",$data);
}
switch ($type)
{
case "select":
if ($field_name <> ""){
$field_name_eff = $field_name;
} else {
$field_name_eff = $field;
}

$text="\n\n<select name='". $field_name_eff ."' " . $html_attributes_string . ">\n";
if ($title > "")
$text.="<option value=\"\">" . $title . "</option>\n";
for ($i=0;$i<count($options);$i++)
{
$selected = NULL;
if ($data == $options[$i])
$selected ="SELECTED ";
$text.="<option " . $selected .
"value=\"".$options[$i]."\">".ucfirst($options[$i])."</option>\n";
}
$text.="</select>\n\n";
break;

default:
$text="\n";
for ($i=0;$i<count($options);$i++)
{
$checked=NULL;
for ($j=0;$j<count($ARay);$j++)
{
if ($ARay[$j] == $options[$i])
$checked=" CHECKED ";
}
$text.="<INPUT TYPE='checkbox'" . $checked . " NAME='" . $field."[]'
VALUE='". $options[$i] . "'> " .ucfirst($options[$i])." \n";
}
$text.="\n";
break;

case "radio":
$text="\n";
if ($title > "")
$text.="<INPUT TYPE='radio' NAME='" . $field."'
VALUE=''> ".$title." &nbsp; \n";
for ($i=0;$i<count($options);$i++)
{
$checked=NULL;
for ($j=0;$j<count($ARay);$j++)
{
if ($ARay[$j] == $options[$i])
$checked=" CHECKED ";
}
$text.="<INPUT TYPE='radio' " . $checked . " NAME='" . $field."'
VALUE='". $options[$i] . "' id='". $field. $options[$i] . "'><label for='". $field. $options[$i] . "'> ".ucfirst($options[$i])."</label> &nbsp; \n";
}
$text.="\n";
break;
}
return $text;
}
}



if (!function_exists("draw_html_control_multi")) {
function draw_html_control_multi($control_type,$field_name,$valueset,$data_source,$condition,$operator,$value,$sorting,$field_option_value,$field_option_label,$default_field_option,$html_attributes)
{
// Usage:
// $control_type: Radio, Text Area, Text Box, Select (for multiple use $html_attributes - "multiple="multiple"")
// $field_name - HTML field name
// $valueset - Default value in the control. (Multiple Default values in select is pending)
// $data_source - Database Table Name
// $condition - Supports multiple comma separated values
// $operator - Supports multiple comma separated values
// $value - Supports multiple comma separated values
// $field_option_value - Database Column Name - Value of 'select' control. 
// $field_option_label - Database Column Names - Label of 'select' control - Can be multiple comma separated
// $default_field_option - Used for 'select' control for "Select a Value"
// $html_attributes - Different css and javascript declartion can be passed through it. Also, "multiple="multiple"

global $database_nfconx;
global $nfconx;
//echo $valueset;
if ($html_attributes <> ""){ $html_attributes_string = $html_attributes; }
if ($condition <> ""){ 

$whr_clause = " WHERE 1=2 ";
$value_array = explode(",",$value);
for ( $counter = 0; $counter < (count($value_array)-1); $counter++) {
$whr_clause .= " OR " . $condition . " " . $operator . " '"  . $value_array[$counter] . "' ";
}
}



if ($sorting <> ""){ $sorting_sql = " ORDER BY  " . $sorting . " "; }

if ($data_source <> ""){
mysql_select_db($database_nfconx, $nfconx);
$query_rsnf = "SELECT * FROM " . $data_source . $whr_clause . $sorting_sql . " ";

//echo $query_rsnf;

$rsnf = mysql_query($query_rsnf, $nfconx);
$row_rsnf = mysql_fetch_assoc($rsnf);
$totalRows_rsnf = mysql_num_rows($rsnf);
}

// HTML Form Elements	
if ($control_type == "hidden"){
	echo '<input name="' . $field_name . '" type="hidden" value="' . $valueset . '" />';
}
elseif ($control_type == "text"){
	echo '<input name="' . $field_name . '" type="text" value="' . $valueset . '" ' . $html_attributes_string . ' />';
}
elseif ($control_type == "textarea"){
	echo '<textarea name="' . $field_name . '" ' . $html_attributes_string . '>' . $valueset . '</textarea>';
}
elseif ($control_type == "checkbox"){
	if ($data_source == ""){
	echo '<input name="' . $field_name . '" type="checkbox" value="' . $valueset . '" ' . $html_attributes_string . '/> ' . $field_option_label . '';
	} else {
		if ($totalRows_rsnf > 0){
	// Get multiple checkboxes from db table	
	do {
	
	echo '<input name="' . $field_name . '" type="checkbox" value="' . $row_rsnf[$field_option_value] . '" ' . $html_attributes_string . ' ';
	if (!(strcmp($row_rsnf[$field_option_value], $valueset))) {echo '  checked="checked" ';}
	echo '/> ';
	$item_label = "";
	$array_new = explode(",", $field_option_label);
	foreach ($array_new as $y) {
	$item_label .= $row_rsnf[$y] . " - ";
	}
	echo substr($item_label,0,-2);
	echo '<br>
	';
	} while ($row_rsnf = mysql_fetch_assoc($rsnf));
		}
	}
}
elseif ($control_type == "radio"){
	if ($data_source == ""){
	echo '<input name="' . $field_name . '" type="radio" value="' . $valueset . '" ' . $html_attributes_string . '/> ' . $field_option_label . '';
	} else {
		if ($totalRows_rsnf > 0){
	// Get multiple options from db table	
	do {
	
	echo '<input name="' . $field_name . '" type="radio" value="' . $row_rsnf[$field_option_value] . '" ' . $html_attributes_string . ' ';
	if (!(strcmp($row_rsnf[$field_option_value], $valueset))) {echo '  checked="checked" ';}
	echo '/> ';
	$item_label = "";
	$array_new = explode(",", $field_option_label);
	foreach ($array_new as $y) {
	$item_label .= $row_rsnf[$y] . " - ";
	}
	echo substr($item_label,0,-2);
	echo '<br>
	';
	} while ($row_rsnf = mysql_fetch_assoc($rsnf));
		}
	}
}
elseif ($control_type == "select"){
	echo '<select name="' . $field_name . '" ' . $html_attributes_string . ' >';
	if ($default_field_option <> ""){
	echo '
	<option value="">' . $default_field_option . '</option>
	';
	}
	$valueset_new = explode(",",$valueset);
	if ($data_source == ""){
		
	$array_option_new = explode(",", $field_option_value);
	foreach ($array_option_new as $x) {
	echo '<option value="' . $x . '"';
	
	if (in_array($x, $valueset_new)) { echo ' selected="selected" ';}
	//if (!(strcmp($x, $valueset))) {echo ' selected="selected" ';}
	echo '>' . $x . '</option>
	';
	}
	
	} else {
		if ($totalRows_rsnf > 0){
	// Get multiple options from db table	
	do {
	
	echo '<option value="' . $row_rsnf[$field_option_value] . '" ';
	//if (!(strcmp($row_rsnf[$field_option_value], $valueset))) {echo '  selected="selected" ';}
	if (in_array($row_rsnf[$field_option_value], $valueset_new)) { echo ' selected="selected" ';}
	echo '> ';
	$item_dropdown_label = "";
	$array_new_dropdown = explode(",", $field_option_label);
	foreach ($array_new_dropdown as $z) {
	$item_dropdown_label .= $row_rsnf[$z];
	if ($row_rsnf[$z] <> ""){
	$item_dropdown_label .=  " - ";
	}
	}
	echo substr($item_dropdown_label,0,-2);
	echo '</option>
	';
	} while ($row_rsnf = mysql_fetch_assoc($rsnf));
		}
	}
	echo '</select>';
}
}
}




if (!function_exists("draw_html_control")) 
{
	function draw_html_control($control_type,$field_name,$valueset,$data_source,$condition,$operator,$value,$sorting,$field_option_value,$field_option_label,$default_field_option,$html_attributes)
	{
		// Usage:
		// $control_type: Radio, Text Area, Text Box, Select (for multiple use $html_attributes - "multiple="multiple"")
		// $field_name - HTML field name
		// $valueset - Default value in the control. (Multiple Default values in select is pending)
		// $data_source - Database Table Name
		// $condition - Supports multiple comma separated values
		// $operator - Supports multiple comma separated values
		// $value - Supports multiple comma separated values
		// $field_option_value - Database Column Name - Value of 'select' control. 
		// $field_option_label - Database Column Names - Label of 'select' control - Can be multiple comma separated
		// $default_field_option - Used for 'select' control for "Select a Value"
		// $html_attributes - Different css and javascript declartion can be passed through it. Also, "multiple="multiple"
		
		global $database_nfconx;
		global $nfconx;
		//echo $valueset;
		if ($html_attributes <> "")
		{ 
			$html_attributes_string = $html_attributes; 
		}
		if ($condition <> "")
		{ 
			$whr_clause = " WHERE 1=1 ";
			
			$condition_array = explode(",",$condition);
			$operator_array = explode(",",$operator);
			$value_array = explode(",",$value);
			
			for ( $counter = 0; $counter < count($condition_array); $counter++) 
			{
				$whr_clause .= " AND " . $condition_array[$counter] . " " . $operator_array[$counter] ;
				//echo str_replace(' ','',trim($operator_array[$counter]));
				if(strcmp(trim(str_replace(' ','',trim($operator_array[$counter]))),"notin")==0||strcmp(trim(str_replace(' ','',trim($operator_array[$counter]))),"in")==0)
				{
					$whr_clause .=" "  . $value_array[$counter] . " ";
				}
				else
				{
					$whr_clause .="  '"  . $value_array[$counter] . "' ";
				}
			}
		}
		if ($sorting <> "")
		{ 
			$sorting_sql = " ORDER BY  " . $sorting . " "; 
		}
		if ($data_source <> "")
		{
			mysql_select_db($database_nfconx, $nfconx);
			$query_rsnf = "SELECT * FROM " . $data_source . $whr_clause . $sorting_sql . " ";
			
			//echo $query_rsnf;
			$rsnf = mysql_query($query_rsnf, $nfconx);
			$row_rsnf = mysql_fetch_assoc($rsnf);
			$totalRows_rsnf = mysql_num_rows($rsnf);
		}
		
		// HTML Form Elements	
		if ($control_type == "hidden")
		{
			echo '<input name="' . $field_name . '" type="hidden" value="' . $valueset . '" />';
		}
		elseif ($control_type == "text")
		{
			echo '<input name="' . $field_name . '" type="text" value="' . $valueset . '" ' . $html_attributes_string . ' />';
		}
		elseif ($control_type == "textarea")
		{
			echo '<textarea name="' . $field_name . '" ' . $html_attributes_string . '>' . $valueset . '</textarea>';
		}
		elseif ($control_type == "checkbox")
		{
			if ($data_source == "")
			{
				echo '<input name="' . $field_name . '" type="checkbox" value="' . $valueset . '" ' . $html_attributes_string . '/> ' . $field_option_label . '';
			} 
			else 
			{
				if ($totalRows_rsnf > 0)
				{
					// Get multiple checkboxes from db table	
					do 
					{				
						echo '<input name="' . $field_name . '" type="checkbox" value="' . $row_rsnf[$field_option_value] . '" ' . $html_attributes_string . ' ';
						if (!(strcmp($row_rsnf[$field_option_value], $valueset))) 
						{
							echo '  checked="checked" ';
						}
						echo '/> ';
						$item_label = "";
						$array_new = explode(",", $field_option_label);
						foreach ($array_new as $y) 
						{
							$item_label .= $row_rsnf[$y] . " - ";
						}
						echo substr($item_label,0,-2);
						echo '<br>
						';
					} 
					while ($row_rsnf = mysql_fetch_assoc($rsnf));
				}
			}
		}
		elseif ($control_type == "radio")
		{
			if ($data_source == "")
			{
				echo '<input name="' . $field_name . '" type="radio" value="' . $valueset . '" ' . $html_attributes_string . '/> ' . $field_option_label . '';
			} 
			else 
			{
				if ($totalRows_rsnf > 0)
				{
					// Get multiple options from db table	
					do 
					{	
						echo '<input name="' . $field_name . '" type="radio" value="' . $row_rsnf[$field_option_value] . '" ' . $html_attributes_string . ' ';
						if (!(strcmp($row_rsnf[$field_option_value], $valueset))) 
						{
							echo '  checked="checked" ';
						}
						echo '/> ';
						$item_label = "";
						$array_new = explode(",", $field_option_label);
						foreach ($array_new as $y) 
						{
							$item_label .= $row_rsnf[$y] . " - ";
						}
						echo substr($item_label,0,-2);
						echo '<br>';
					} 
					while ($row_rsnf = mysql_fetch_assoc($rsnf));
				}
			}
		}
		elseif ($control_type == "select")
		{
			echo '<select id="' . $field_name . '" name="' . $field_name . '" ' . $html_attributes_string . ' >';
			if ($default_field_option <> "")
			{
				echo '<option value="">' . $default_field_option . '</option>';
			}
			$valueset_new = explode(",",$valueset);
			if ($data_source == "")
			{		
				$array_option_new = explode(",", $field_option_value);
				foreach ($array_option_new as $x) 
				{
					echo '<option value="' . $x . '"';
					if (in_array($x, $valueset_new)) 
					{ 						
						echo ' selected="selected" ';
					}
					//if (!(strcmp($x, $valueset))) {echo ' selected="selected" ';}
					echo '>' . $x . '</option>';
				}	
			} 
			else 
			{
				if ($totalRows_rsnf > 0)
				{
					// Get multiple options from db table	
					do 
					{
						echo '<option value="' . $row_rsnf[$field_option_value] . '" ';
						if (in_array($row_rsnf[$field_option_value], $valueset_new)) 
						{ 
							echo ' selected="selected" ';
						}
						echo '> ';
						$item_dropdown_label = "";
						$array_new_dropdown = explode(",", $field_option_label);
						foreach ($array_new_dropdown as $z) 
						{
							$item_dropdown_label .= $row_rsnf[$z];
							if ($row_rsnf[$z] <> "")
							{
								$item_dropdown_label .=  " - ";
							}
						}
						echo substr($item_dropdown_label,0,-2);
						echo '</option>';
					} 
					while ($row_rsnf = mysql_fetch_assoc($rsnf));
				}
			}
			echo '</select>';
		}
	}
}
?>