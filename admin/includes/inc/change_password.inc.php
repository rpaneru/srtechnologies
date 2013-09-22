<?php // check_user_access($_GET['do'], $_SESSION['NF_Username']); ?>
<?php
//Step 1
if ($_POST['step'] == ""){ include 'includes/forms/change_pwd_form.php'; }


//Step 2 
elseif ($_POST['step'] == "1"){ 

if ((md5($_POST['cur_pwd']) <> get_val_col(users, password, userid, $_SESSION['NF_Username'])) ){

$olderror = "yes";
$type = "error";
$message = "<b> Your current Password is invalid</b>";
include ("includes/announce.inc.php");
include 'includes/forms/change_pwd_form.php';

}

elseif ($_POST['new_pwd'] <> $_POST['conf_pwd']){
$newerror = "yes";
$type = "error";
$message = "<b> You have not confirmed the new password</b>";
include ("includes/announce.inc.php");
include 'includes/forms/change_pwd_form.php';

}



else {
// Password modification

$edit_value = array(
"password"=> md5($_POST['new_pwd'])
);
$edit_action =update_data("users",array_to_string_update($edit_value),"userid='" . $_SESSION['NF_Username'] . "'");
	$edit_r=mysql_query($edit_action);
	if($edit_r){

$type = "announce";
$message = "<b>Password modified successfully.<a href='index.php' >Click here</a> to return to  your home.</b>";
include ("includes/announce.inc.php");
}

}
 }

?>