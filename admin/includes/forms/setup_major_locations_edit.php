<script language=JavaScript>
function CheckForm()
{
// Make sure that all of the form variables, etc are valid
var f = document.form1;
if (f.major_location_id.value == "")
{
alert("Please select major location.");
f.major_location_id.focus();
return false;
}	
if (f.location_name.value == "")
{
alert("Please enter location name");
f.location_name.focus();
return false;
}
// Everything is OK, return true
return true;
}
</script>
<div id="pagecontent">
<?php
$query_rsnf = "SELECT * FROM locations_major WHERE major_location_id='" . $_GET['major_location_id'] . "' ";
//echo $query_rsnf;
$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());
$row_rsnf = mysql_fetch_assoc($rsnf);
$totalRows_rsnf = mysql_num_rows($rsnf);
?>
<?php if ($totalRows_rsnf > 0) { // Show if recordset not empty ?>
<div style="padding: 2px;"></div>
<div class="block-start">	
<div class="cap-div">
<div class="cap-left">
<div class="cap-right"><?php echo page_characters($_GET['do'], "page_title"); ?></div>
</div>
</div>
<form name="form1" method="POST" onSubmit="return CheckForm();">
<table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="34%" align="right" class="row1">State Code: </td>
<td width="76%" class="row2">
<?php draw_html_control("select","state_id",$row_rsnf['state_id'],"master_states_india","","","","state_name ASC","state_id","state_name","-- Select --", ""); ?>
</td>
</tr>
<tr>
<td class="row1" align="right">Organization Name: </td>
<td class="row2"><input value="<?php echo $row_rsnf['major_location_name']; ?>" name="major_location_name" type="text">
</td>
</tr>
<tr>
<td class="cat" colspan="2" align="center"><input class="btnmain" type="submit" name="submit" value="Edit Location" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="Reset" name="reset" /></td>
</tr>
</table>
<input name="step" type="hidden" value="1" />
<input name="major_location_id" type="hidden" value="<?php echo $row_rsnf['major_location_id']; ?>" />
</form>
<div class="block-end-left"><div class="block-end-right"></div></div></div>
<div style="padding: 2px;"></div>
<?php } // Show if recordset not empty 
else {
$type = "warning";
$message = "<b>Invalid Location ID</b>";
include ("includes/announce.inc.php");
} 
?>
<br clear="all" />
</div>