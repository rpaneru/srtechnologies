<?php
ini_set("error_reporting", E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);
include "config.php";
include 'admin/includes/functions/functions.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/960.css" rel="stylesheet" type="text/css"/>
<title>Login - <?php echo $NF_config['client_name']; ?></title>
<base href="<?php echo str_replace("admin/","",$NF_config['system_uri']); ?>"/>
<script type="text/javascript">
<!--
var viewportwidth;
var viewportheight;
// the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
if (typeof window.innerWidth != 'undefined')
{
	viewportwidth = window.innerWidth,
	viewportheight = window.innerHeight
}
// IE6 in standards compliant mode (i.e. with a valid doctype as the first line in the document)
else if (typeof document.documentElement != 'undefined' && typeof document.documentElement.clientWidth != 'undefined' && document.documentElement.clientWidth != 0)
{
	viewportwidth = document.documentElement.clientWidth,
	viewportheight = document.documentElement.clientHeight
}
// older versions of IE
else
{
	viewportwidth = document.getElementsByTagName('body')[0].clientWidth,
	viewportheight = document.getElementsByTagName('body')[0].clientHeight
}

function getScreenRes(width,height)
{
	var screen_res = width+'x'+height;
	return screen_res;
}
//-->
function CheckForm(frm)
{
	if(frm.loginID.value == "")
	{
		alert("Please enter your User ID.");
		frm.loginID.focus();
		return false;
	}
	if(frm.loginPassword.value == "")
	{
		alert("Please enter your password.");
		frm.loginPassword.focus();
		return false;
	}
	return true;
}
</script>

<?php
$os = '';
$full = '';
// change these two to match your include path/and file name you give the script
include('admin/includes/browser_detection.php');
$browser_info = browser_detection('full');
$browser_info[] = browser_detection('moz_version');
switch ($browser_info[5])
{
	case 'win':
		$os .= 'Windows ';
	break;
	case 'nt':
		$os .= 'Windows NT ';
	break;
	case 'lin':
		$os .= 'Linux  ';
	break;
	case 'mac':
		$os .= 'Mac ';
	break;
	case 'unix':
		$os .= 'Unix Version: ';
	break;
	default:
		$os .= $browser_info[5];
}
if ( $browser_info[5] == 'nt' )
{
	if ($browser_info[6] == 5)
	{
		$os .= '5.0 (Windows 2000)';
	}
	elseif ($browser_info[6] == 5.1)
	{
		$os .= '5.1 (Windows XP)';
	}
	elseif ($browser_info[6] == 5.2)
	{
		$os .= '5.2 (Windows XP x64 Edition or Windows Server 2003)';
	}
	elseif ($browser_info[6] == 6.0)
	{
		$os .= '6.0 (Windows Vista)';
	}
	elseif ($browser_info[6] == 6.1)
	{
		$os .= '6.1 (Windows 7)';
	}
}
elseif ( ( $browser_info[5] == 'mac' ) &&  ( $browser_info[6] >= 10 ) )
{
	$os .=  'OS X';
}
elseif ( $browser_info[5] == 'lin' )
{
	$os .= ( $browser_info[6] != '' ) ? 'Distro: ' . ucfirst ($browser_info[6] ) : 'Smart Move!!!';
}
elseif ( $browser_info[6] == '' )
{
	$os .=  ' (version unknown)';
}
else
{
	$os .=  strtoupper( $browser_info[6] );
}
if ($browser_info[0] == 'moz' )
{
	$a_temp = $browser_info[count( $browser_info ) - 1];// use the last item in array, the moz array
	$full .= ($a_temp[0] != 'mozilla') ? 'Mozilla ' . ucfirst($a_temp[0]) . ' ' : ucfirst($a_temp[0]) . ' ';
	$full .= $a_temp[1];
}
elseif ($browser_info[0] == 'ns' )
{
	$full .= 'Browser: Netscape<br />';
	$full .= 'Full Version Info: ' . $browser_info[1];
}
elseif ( $browser_info[0] == 'webkit' )
{
	//$full .= 'User Agent: ';
	$full .= ucwords($browser_info[7]);
}
else
{
	$full .= ($browser_info[0] == 'ie') ? strtoupper($browser_info[7]) : ucwords($browser_info[7]);
	$full .= ' ' . $browser_info[1];
}
?>

</head>

<body>	
    <form id="frmLogin" action="login_user.php" method="post" onSubmit="return CheckForm(this)" name="frmLogin">
        <label class="push_1" for="username">Username:</label>
        <input class="push_1" type="text" value="<?php echo $_REQUEST['userid'];?>" name="username" id="loginID"/>
        <br/>
        <label class="push_1" for="password">Password:</label>
        <input type="password" name="pwd" id="loginPassword" class="push_1 Field150"/>
        <br/> 
        <p style="font-size: 12px;color:#284F71" class="grid_5 push_2">Please enter your username and password to begin<br/></p>
        <input name="screen_resolution" type="hidden" value="" />
        <input name="screen_size" type="hidden" value="" />
        <input name="accesscheck" type="hidden" value="<?php echo strip_tags(urldecode($_GET['accesscheck'])); ?>" />
        <input name="os" type="hidden" value="<?php echo $os; ?>" />
        <input name="browser" type="hidden" value="<?php echo $full; ?>" />
        <input name="ip_address" type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
        <input name="through" id="through" type="hidden" value="<?php echo $_REQUEST['through']; ?>" />
        <input type="image" src="images/login-button.png" id="SubmitButton" name="SubmitButton" style="width:140px;height:50px;border:none"  />
    </form>                    
</body>

</html>
