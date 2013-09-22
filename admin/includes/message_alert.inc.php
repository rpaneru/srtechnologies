<?php
if (($_GET['message'] <> "") && ($_GET['message_display'] == "Yes") && ($_GET['message_type'] <> ""))
{	
	$type = $_GET['message_type'];
	$message = $_GET['message'];
	include ("includes/announce.inc.php");	
}
?>