<script type="text/javascript" src="javascript/ui.dropdownchecklist.js"></script>
<link rel="stylesheet" href="Styles/ui.dropdownchecklist.css">

<div id="pagecontent">
	<div style="padding: 2px;"></div>
	<div class="block-start">	
        <div class="cap-div">
            <div class="cap-left">
                <div class="cap-right">Create a New Profile</div>
            </div>
        </div>	

		<script language=JavaScript>
function ToggleParentGroup()
{
	var g = document.form1;
	if(g.profile_group_id.value == "NEW_GROUP")
	{
	document.getElementById("tr_new_profile_group_name").style.display  = "";
	document.getElementById("tr_new_group_parent_profile_group_id").style.display  = "";
	}
	else 
	{
	document.getElementById("tr_new_profile_group_name").style.display  = "none";
	document.getElementById("tr_new_group_parent_profile_group_id").style.display  = "none";
	}
}
function CheckForm()
{
	// Make sure that all of the form variables, etc are valid
	var f = document.form1;
	if(f.profile_name.value.length == 0)
	{
		alert('Please enter Profile Name');
		f.profile_name.focus();
		f.profile_name.select();
		return false;
	}
	if(f.profile_description.value.length == 0)
	{
		alert('Please enter the Profile Description');
		f.profile_description.focus();
		f.profile_description.select();
		return false;
	}
	if(f.profile_group_id.value.length == 0)
	{
		alert('Please select a Profile Group');
		return false;
	}
	if(f.profile_group_id.value == "NEW_GROUP")
	{
		if(f.new_profile_group_name.value.length == 0)
		{
			alert('Please enter the New Profile Group Name');
			f.new_profile_group_name.focus();
			f.new_profile_group_name.select();
			return false;
		}
		if(f.new_group_parent_profile_group_id.value.length == 0)
		{
			alert('Please select a Parent Group for New Profile Group');
			return false;
		}
	}
	// Everything is OK, return true
	return true;
}
</script>

		<?php get_service_groups_javascript(); ?>
    
        <script type="text/javascript">
        $(document).ready(function() {
        <?php get_service_expression_select_js(); ?>
        });
        </script>

		<form name="form1" method="POST" onSubmit="return CheckForm();">
		<table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
        	<tr>
				<th colspan="2" class="headmessage">Use the form below to create a login profile. Users associated to this login profile will see only those tabs & options you have allowed on this page. </th>
			</tr>			
            <tr>
				<td width="30%" class="row1" align="right" valign="top">Profile Name:</td>
                <td width="70%" class="row2"><input type="text" name="profile_name" id="profile_name" /></td>
			</tr>
			<tr>
				<td align="right" valign="top" class="row1">Description:</td>
				<td class="row2"><textarea name="profile_description" rows="2" cols="20" id="profile_description" style="width:175px"></textarea></td>
			</tr>
            <tr>
				<td width="30%" class="row1" align="right" valign="top">Profile Group:</td>
				<td width="70%" class="row2"><?php draw_profile_group_dropdown("profile_group_id","","-- Select a Profile Group --","Yes","No","onchange=\"ToggleParentGroup();\""); ?></td>
			</tr>
			<tr id="tr_new_profile_group_name" style="display:none">
                <td width="30%" class="row1" align="right" valign="top">New Profile Group Name:</td>
                <td width="70%" class="row2"><input type="text" name="new_profile_group_name" id="new_profile_group_name" /></td>
			</tr>
            <tr id="tr_new_group_parent_profile_group_id" style="display:none">
                <td width="30%" class="row1" align="right" valign="top">Parent Profile Group:</td>
                <td width="70%" class="row2"><?php draw_profile_group_dropdown("new_group_parent_profile_group_id","","-- Parent Profile Group --","No","Yes",""); ?></td>
            </tr>

			<?php get_service_groups_form(""); ?>

			<?php get_servicegroup_services_form(""); ?>
			
            <tr>
                <td class="cat" colspan="2" align="center"><input class="btnmain" type="submit" name="submit" value="Create Profile" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="Reset" name="reset" /></td>
            </tr>
		</table>
		<input type="hidden" value="1" name="step" />
	</form>

        <div class="block-end-left">
            <div class="block-end-right"></div>
        </div>
    </div>
    
    <div style="padding: 2px;"></div>
    <br clear="all" />
</div>