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
	if (f.address1.value == "")
	{
		alert("Please enter Address");
		f.address1.focus();
		return false;
	}
	if (f.city.value == "")
	{
		alert("Please enter city name");
		f.city.focus();
		return false;
	}
	if (f.zip.value == "")
	{
		alert("Please enter zip code");
		f.zip.focus();
		return false;
	}
	// Everything is OK, return true
	return true;
}
</script>

<div id="pagecontent">
	<?php
    $query_rsnf_old = "SELECT * FROM locations WHERE location_id='" . $_GET['location_id'] . "' ";
    $rsnf_old = mysql_query($query_rsnf_old, $nfconx) or die(mysql_error());
    $row_rsnf_old = mysql_fetch_assoc($rsnf_old);
    $totalRows_rsnf = mysql_num_rows($rsnf_old);
	
    $user_address_id=get_val_col(location_address,user_address_id,location_id,$_GET['location_id']);
    
	$query_rsnf = "SELECT * FROM user_address WHERE user_address_id='" .$user_address_id. "' ";
    //echo $query_rsnf;
    $rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());
    $row_rsnf = mysql_fetch_assoc($rsnf);
	if ($totalRows_rsnf > 0) 
	{ 
	// Show if recordset not empty 
	?>
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
                    <td width="34%" align="right" class="row1">Organization: </td>
                    <td width="76%" class="row2"> <?php draw_html_control("select","major_location_id",$row_rsnf_old['major_location_id'],"locations_major","","","","major_location_name ASC","major_location_id","major_location_name,state_code","-- Select --", ""); ?>
                    </td>
                </tr>
                <tr>
					<td class="row1" align="right">Location Name: </td>
                    <td class="row2"><input value="<?php echo $row_rsnf_old['location_name'] ?>" name="location_name" type="text"></td>
                </tr>
                <tr>
                    <td class="row1" align="right">Address1: </td>
                    <td class="row2"><input value="<?php echo $row_rsnf['address1']; ?>" name="address1" type="text"/></td>
                </tr>
                <tr>
                    <td class="row1" align="right">Address2: </td>
                    <td class="row2"><input value="<?php echo $row_rsnf['address2']; ?>" name="address2" type="text"/></td>
                </tr>
                <tr>
                    <td class="row1" align="right">City: </td>
                    <td class="row2"><input value="<?php echo $row_rsnf['city']; ?>" name="city" type="text"/></td>
                </tr>
                <tr>
                    <td class="row1" align="right">State: </td>
                    <?php $state = get_val_col(user_address,state,user_address_id,$user_address_id );?>
                    <td class="row2"><?php draw_html_control("select","state",$state,"master_states_india","","","","state_name ASC","state_id","state_name","--Select--", "");?></td>
                </tr>
                <tr>
                    <td class="row1" align="right">Zip: </td>
                    <td class="row2"><input value="<?php echo $row_rsnf['zip']; ?>" name="zip" type="text"/></td>
                </tr>              
                <tr>
                    <td class="cat" colspan="2" align="center"><input class="btnmain" type="submit" name="submit" value="Edit Location" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="Reset" name="reset" /></td>
                </tr>
			</table>
            <input name="step" type="hidden" value="1" />
            <input name="location_id" type="hidden" value="<?php echo $_GET['location_id']; ?>" />
		</form>

		<div class="block-end-left">
        	<div class="block-end-right"></div>
		</div>
	</div>
	<div style="padding: 2px;"></div>
	<?php 
    } 
    // Show if recordset not empty 
    else 
    {
		$type = "warning";
		$message = "<b>Invalid Location ID</b>";
		include ("includes/announce.inc.php");
	} 
	?>
	<br clear="all" />
</div>
