<script language=JavaScript>
function CheckForm()
{
	// Make sure that all of the form variables, etc are valid
	var f = document.form1;
	if (f.state_code.value == "")
	{
		alert("Please select a state.");
		f.state_code.focus();
		return false;
	}	
	if (f.major_location_name.value == "")
	{
		alert("Please enter major location name");
		f.major_location_name.focus();
		return false;
	}
	// Everything is OK, return true
	return true;
}
</script>

<div id="pagecontent">
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
                    <td width="34%" align="right" class="row1">State: </td>
                    <td width="76%" class="row2"> 
                    <?php draw_html_control("select","state_id","","master_states_india","","","","state_name ASC","state_id","state_name","-- Select --", ""); ?>
                    </td>
                </tr>
                <tr>
                    <td class="row1" align="right">Organization Name: </td>
                    <td class="row2"><input value="<?php echo $_POST['major_location_name']; ?>" name="major_location_name" type="text">
                    </td>
                </tr>
                <tr>
                    <td class="cat" colspan="2" align="center">
                    <input class="btnmain" type="submit" name="submit" value="Create Location" />&nbsp;&nbsp;
                    <input class="btnlite" type="reset" value="Reset" name="reset" />
                    </td>
				</tr>
			</table>
		<input name="step" type="hidden" value="1" />
		</form>

        <div class="block-end-left">
	        <div class="block-end-right"></div>
        </div>
	</div>
	<div style="padding: 2px;"></div
	><br clear="all" />
</div>