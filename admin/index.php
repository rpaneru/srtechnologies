<?php 
include 'session.php';
include 'includes/functions/function_access_control.php';

if(get_val_col(users,profile_id,userid,$_SESSION['NF_Username'])==10)
{
	$redirect= "http://localhost/srtechnologies";
	header("Location:$redirect");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Index - <?php echo $NF_config['app_name']; ?> - <?php echo $NF_config['client_name']; ?></title>
        <meta name="description" content="<?php echo $NF_config['client_name']; ?>" />
        <meta name="keywords" content="<?php echo $NF_config['client_name']; ?>" />
        <link rel="SHORTCUT ICON" href="images/favicon.ico" />
        <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="Styles/ie.css" />
        <![endif]-->
        <link rel="stylesheet" href="Styles/blue/theme/stylesheet.css" type="text/css" />
        <script type="text/javascript" src="javascript/js.js"></script>
        <script type="text/javascript" src="javascript/menudrop.js"></script>
        <script type="text/javascript" src="javascript/general.js"></script>
    </head>
    <body class="ltr">
        <a name="top"></a>
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/menu.inc.php'; ?>
        <div id="content" style="clear:left;">
            <table border="0" cellspacing="0" cellpadding="0" width="100%" id="maintable" align="center">
                <tr>
                    <td id="contentrow">
                        <div style="min-height:380px">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td align="center" valign="middle">
                                        <?php 
										echo $_SESSION['NF_Username'];
                                        if (get_val_col(users,user_type,userid,$_SESSION['NF_Username']) == "Admin")
                                        {
                                            //include 'includes/forms/homepage_superadmin.php';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php 
                        include 'includes/footer.inc.php'; 
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
