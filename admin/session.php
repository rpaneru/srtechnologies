<?php
session_start();
if(!isset($_SESSION['My_Session_ID']))
{
	$_SESSION['My_Session_ID'] = uniqid("INF");
}
include "../config.php";
include "includes/functions/functions.php";
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != ""))
{
	$logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
{
	//to fully log out a visitor we need to clear the session varialbles
	unset($_SESSION['NF_Username']);
	unset($_SESSION['NF_UserGroup']);
	unset($_SESSION['My_Session_ID']);
	unset($_SESSION['donor_major_location']);
	
	$logoutGoTo = "../login.php?case=login";
	if ($logoutGoTo) 
	{
		//Log Out
		$logout_datetime = current_datetime();
		$session_id = session_id();
		$updateSQL = "UPDATE user_login_history SET logout_datetime = '$logout_datetime' WHERE session_id = '$session_id'";

		mysql_select_db($database_nfconx, $nfconx);
		$Result1 = mysql_query($updateSQL, $nfconx);
		session_regenerate_id();
		header("Location: $logoutGoTo");
		exit;
	}
}
if(!isset($_SESSION))
{
	session_start();
}
$NF_authorizedUsers = "";
$NF_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
$NF_restrictGoTo = "login.php?case=login";
if (!(isset($_SESSION['NF_Username']))) 
{   
	$NF_qsChar = "?";
	$NF_referrer = $_SERVER['REQUEST_URI'];
	if (strpos($NF_restrictGoTo, "?")) $NF_qsChar = "&";
	if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
	$NF_referrer .= "?" . $QUERY_STRING;
	$NF_restrictGoTo = $NF_restrictGoTo. $NF_qsChar . "accesscheck=" . urlencode($NF_referrer);
	header("Location: ". $NF_restrictGoTo); 
	exit;
}
?>