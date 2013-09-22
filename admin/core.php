<?php 
include 'session.php';
include 'includes/functions/functions.php';
include 'includes/functions/functions_html_output.php';
include 'includes/functions/function_access_control.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo page_characters($_GET['do'], "page_title"); ?> - <?php echo $NF_config['app_name']; ?> - <?php echo $NF_config['client_name']; ?></title>
<meta name="description" content="<?php echo $NF_config['client_name']; ?>" />
<meta name="keywords" content="<?php echo $NF_config['client_name']; ?>" />
<link rel="SHORTCUT ICON" href="images/favicon.ico" />

<link type="text/css" href="lib/jquery-ui-1.7.2/css/custom-theme/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
<script type="text/javascript" src="javascript/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="lib/jquery-ui-1.7.2/js/jquery-ui-1.7.2.custom.min.js"></script>
<link rel="stylesheet" href="Styles/blue/theme/stylesheet.css" type="text/css" />
<!--[if IE]>
	  <link rel="stylesheet" type="text/css" href="Styles/ie.css" />
	<![endif]-->
<script type="text/javascript" src="javascript/js.js"></script>
<script type="text/javascript" src="javascript/vtip-min.js"></script>
<link rel="stylesheet" href="Styles/vtip.css" type="text/css" media="print"/>
<script type="text/javascript" src="javascript/menudrop.js"></script>
<script type="text/javascript" src="javascript/general.js"></script>
<script type="text/javascript" src="javascript/lib.js"></script>
<script type="text/javascript" src="javascript/ui.core.js"></script>
<script type="text/javascript" src="javascript/tooltip.js"></script>
<link rel="stylesheet" href="Styles/print.css" type="text/css" media="print"/>
<script type="text/javascript" src="Styles/blue/template/ca_scripts.js"></script>
<script src="javascript/tbl_change.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" src="javascript/jquery.form.js"></script> 
</head>
<body class="ltr">

<a name="top"></a>

<?php include 'includes/header.inc.php';
	  include 'includes/menu.inc.php'; 
?>
<div id="content" style="clear:left;">

<table border="0" cellspacing="0" cellpadding="0" width="100%" id="maintable" align="center">
<tr>
	<td id="contentrow">
<div style="min-height:380px">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="20%" valign="top" id="ucp-left">
<?php include 'includes/left.inc.php'; ?>
</td>
<td><img src="images/spacer.gif" width="4" alt="" /></td>
<td width="80%" valign="top">
<?php include 'includes/message_alert.inc.php'; ?>
<?php include 'includes/notice.inc.php'; ?>
<?php include page_characters($_GET['do'], "default_include_file"); ?>
</td>
</tr>
</table>
</div>
<?php include 'includes/footer.inc.php'; ?>
</td>
</tr>
</table>
</div>
</body>
</html>
<?php

?>