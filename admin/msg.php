<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script>
function close_self()
{
	window.location.href="index.php";
}
</script>
</head>

<body>

<div style="float:right">
<a href="#" onclick="close_self()"><img src="images/closelabel.gif" onclick="close_self" border="0" /></a>
</div>

<br />
<div align="center">
<?php
if($_REQUEST['msg']=="add_dependent")
{
?>
	<span>Dependent added successfully.</span>
<?php
}
elseif($_REQUEST['msg']=="edit_donor")
{
?>
	<span>Donor information edited  Successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="edit_donor")
{
?>
	<span>Donor information edited  Successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="del_dependent")
{
?>
	<span>Dependent Deleted  Successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="del_assoc")
{
?>
	<span>Association Deleted  Successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="edit_pay_mth")
{
?>
	<span>Payment method edited successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="del_pay_mth")
{
?>
	<span>Payment method deleted successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="rep_pay_mth")
{
?>
	<span>Payment method replaced successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="add_pay_mth")
{
?>
	<span>Payment method added successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="pay_yes")
{
?>
	<span>Payment scheduled successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="edit_event")
{
?>
	<span>Event edited successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="del_event")
{
?>
	<span>Event deleted successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="add_assoc")
{
?>
	<span>Association added successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="event_reg")
{
?>
	<span>Event registered added successfully.</span>
<?php	
}
elseif($_REQUEST['msg']=="event_not_reg")
{
?>
	<span>Event not registered.</span>
<?php	
}
?>
</div>

</body>
</html>

