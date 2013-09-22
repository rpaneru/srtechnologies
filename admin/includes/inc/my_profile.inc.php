<?php // check_user_access($_GET['do'], $_SESSION['NF_Username']); ?>
<?php
//Step 1
if ($_POST['step'] == ""){ include 'includes/forms/my_profile_form.php'; }


//Step 2 
elseif ($_POST['step'] == "1"){ 


$edit_value = array(
"mobile"=>$_POST['mobile'],
"email"=>$_POST['email'],
);
$edit_action =update_data("users",array_to_string_update($edit_value),"userid='" . $_SESSION['NF_Username'] . "'");
$edit_r=mysql_query($edit_action);

$user_type = get_val_col(users,user_type,userid,$userid);

if ($user_type == "Donor"){
$edit_value = array(
"email"=>$_POST['email'],
);

$edit_action =update_data("donor_profiles",array_to_string_update($edit_value),"userid='" . $_SESSION['NF_Username'] . "'");
$edit_r=mysql_query($edit_action);
}

if($edit_r){

$type = "announce";
$message = "<b>You have successfully modified your contact info</b>";
include ("includes/announce.inc.php");

}
}
?>