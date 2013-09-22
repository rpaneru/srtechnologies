<?php 
include 'config.php';
include 'admin/includes/functions/functions.php';
// *** Validate request to login to this site.
session_start();
$loginFormAction = $_SERVER['PHP_SELF'];
if ((isset($_POST['accesscheck'])) && ($_POST['accesscheck'] <> ""))
{
	$_SESSION['PrevUrl'] = $_POST['accesscheck'];
}
if (isset($_POST['username'])) 
{
	$loginUsername=strtoupper($_POST['username']);
	$password=$_POST['pwd'];
	
	$NF_fldUserAuthorization = "";
	
	$NF_redirectLoginFailed = "login.php?case=relogin";
	$NF_redirecttoReferrer = false;
	$password = md5($passpwd);
	
	echo $LoginRS__query=sprintf("SELECT userid, password FROM users WHERE userid='%s' AND password='$password' AND status = 1",
	get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
	
	$LoginRS = mysql_query($LoginRS__query, $nfconx) or die(mysql_error());
	$loginFoundUser = mysql_num_rows($LoginRS);
	if ($loginFoundUser) 
	{
		$login_datetime = current_datetime();
		$session_id = session_id();
		// Add to User Login History
		$insertSQL = "INSERT INTO user_login_history (userid, login_datetime, session_id, ip_address, browser, os, screen_resolution, screen_size) VALUES ('$loginUsername', '$login_datetime',  '$session_id', '$_POST[ip_address]', '$_POST[browser]', '$_POST[os]', '$_POST[screen_resolution]', '$_POST[screen_size]')";
		//echo $insertSQL;
		$Result1 = mysql_query($insertSQL, $nfconx);
		$loginStrGroup = "";
		//declare two session variables and assign them
		$GLOBALS['NF_Username'] = $loginUsername;
		//register the session variables
		$_SESSION['NF_Username'] = $loginUsername;

		if($_REQUEST['through']!="registration")
		{
			if ((isset($_SESSION['PrevUrl']) && ($_SESSION['PrevUrl'] <> ""))) 
			{
				$NF_redirectLoginSuccess = $_SESSION['PrevUrl'];	
			}
			else
			{
				$NF_redirectLoginSuccess = 'admin/index.php';
			}
		}
		
		
		header("Location: " . $NF_redirectLoginSuccess );
	}
	else 
	{
		if($_REQUEST['through']!="registration")
		{
			//header("Location: ". $NF_redirectLoginFailed );
		}
		else
		{
			//header("Location: login.php?through=registration&userid=".$_REQUEST['username']);
		}	
	}
} 
else 
{
	header("Location: ". $NF_redirectLoginFailed );	
}
?>