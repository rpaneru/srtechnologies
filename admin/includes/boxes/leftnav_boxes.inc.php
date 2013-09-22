<?php 
if ($current_page_service_group_id == "")
{
	$current_page_service_group_id = page_characters($_GET['do'], "inherit_group_id");
}
$profile_id = get_val_col(users,profile_id,userid,$_SESSION['NF_Username']);
draw_side_box($current_page_service_group_id, $profile_id, $_GET['do']); 
?>