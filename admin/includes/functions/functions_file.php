<?php
if (!function_exists("file_upload")) {
function file_upload($file_fieldname,$final_filename,$file_path)
{
//$final_filename = substr(md5(uniqid("NF")),0,10);

define ("MAX_SIZE","10000000000000000000");

$extlimit = "no"; //Limit allowed extensions? (no for all extensions allowed)

//List of allowed extensions if extlimit = yes

$limitedext = array(".gif",".jpg",".jpeg",".jpeg",".bmp",".csv");		

//file -> variables

//$file_type = $_FILES[$file_fieldname]['type'];

$file_name = $_FILES[$file_fieldname]['name'];

$file_size = $_FILES[$file_fieldname]['size'];

$file_tmp = $_FILES[$file_fieldname]['tmp_name'];

//check if you have selected a file.

if(!is_uploaded_file($file_tmp)){

echo "Error: Please select a file to upload!. <br>";

exit(); //exit the script and don't process the rest of it!

}

//check the file's extension

$ext = strrchr($file_name,'.');

$ext = strtolower($ext);

//uh-oh! the file extension is not allowed!

if (($extlimit == "yes") && (!in_array($ext,$limitedext))) {

echo "Wrong file extension.";

exit();

}

//so, whats the file's extension?

$getExt = explode ('.', $file_name);

$file_ext = $getExt[count($getExt)-1];

//rename file

if ($final_filename == ""){
$final_filename = $file_name;
}

//ok copy the finished file to the directory

$uploaded_file = $file_path . "/" . $final_filename . "." . $file_ext;
move_uploaded_file ($file_tmp, $uploaded_file);
chmod($uploaded_file, 0644);
}
}


if (!function_exists("getFileExtension")) {
function getFileExtension($str) {

        $i = strrpos($str,".");
        if (!$i) { return ""; }

        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);

        return $ext;

}
}


if (!function_exists("file_upload_contacts")) {

function file_upload_contacts($filename) {
if (FALSE == empty($_FILES[$filename]['tmp_name'])) {
$row = 1;
$handle = fopen($_FILES[$filename]['tmp_name'], "r");
while (($data = fgetcsv($handle, 1000, ","))!== FALSE) {
$num = count($data);

$i = 0;
while ($i < $num) {

$enter_value = array(
"userid"=>$_SESSION['NF_Username'],
"column_id"=>$i+1,
"line_no"=>$row,
"column_value"=>trim(addslashes($data[$i])),
"session_id"=>session_id(),
);

$enter_action =insert_data("user_contact_temp",array_to_string(array_keys($enter_value)),array_to_string_value($enter_value));
$enter_r=mysql_query($enter_action);


$i++;  
}

$row++;

}
fclose($handle);

}
}
}

?>