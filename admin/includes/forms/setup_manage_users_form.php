<script language=JavaScript>
function ShowRegistrationOptions()
{
	var g = document.form1;
	if(g.user_type.value == "Branch Manager")
	{
		document.getElementById("tr_bm_major").style.display  = "";
		document.getElementById("tr_bm_minor").style.display  = "";
	} 
	else if(g.user_type.value == "Location Administrator") 
	{
		document.getElementById("tr_bm_major").style.display  = "";
		document.getElementById("tr_bm_minor").style.display  = "";
	} 
	else if(g.user_type.value == "Admin") 
	{
		document.getElementById("tr_bm_major").style.display  = "none";
		document.getElementById("tr_bm_minor").style.display  = "none";
	} 
	else 
	{
		document.getElementById("tr_bm_major").style.display  = "none";
		document.getElementById("tr_bm_minor").style.display  = "none";
	}
}


function LoadMinorLocations(item)
{ 
	major_location_id = item.options[item.selectedIndex].value;
	var url="rootbase.php?do=load_minor_locations&sid=" + Math.random() + "&major_location_id="+major_location_id + "&";
	xmlHttp=GetXmlHttpObject(stateChanged)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
} 
function stateChanged() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		document.getElementById("area_minor_location").innerHTML=xmlHttp.responseText 
	} 
}


function CheckUserID(userid)
{ 
var url="rootbase.php?do=check_userid_availability&sid=" + Math.random() + "&userid="+userid + "&";
xmlHttp=GetXmlHttpObject(stateChanged2)
xmlHttp.open("GET", url , true)
xmlHttp.send(null)
} 
function stateChanged2() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
{ 
document.getElementById("area_userid_availability_message").innerHTML=xmlHttp.responseText 
} 
}
function CheckForm()
{
// Make sure that all of the form variables, etc are valid
var f = document.form1;
if(f.user_type.value.length == 0)
{
alert('Please select a User Type');
f.user_type.focus();
return false;
}
if(f.user_type.value == "Donor")
{
alert('Donors cannot be registered using this interface. Please use My Locations tabs');
return false;
}
if(f.user_type.value == "Organizational Administrator")
{
if(f.major_location_id.value.length == 0)
{
alert('Please select an Organization');
f.major_location_id.focus();
return false;
}
}
if(f.user_type.value == "Location Administrator")
{
if(f.major_location_id.value.length == 0)
{
alert('Please select an Organization');
f.major_location_id.focus();
return false;
}
if(f.location_id.value.length == 0)
{
alert('Please select a Location');
return false;
}
}
if(f.profile_id.value.length == 0)
{
alert('Please select a Profile');
f.profile_id.focus();
return false;
}	
if(f.userid.value.length == 0)
{
alert('Please enter the User ID');
f.userid.focus();
f.userid.select();
return false;
}
if(f.password1.value.length == 0)
{
alert('Please enter the Password');
f.password1.focus();
f.password1.select();
return false;
}
if(f.password1.value.length < 6)
{
alert('Password must be atleast 6 characters long');
f.password1.focus();
f.password1.select();
return false;
}
if(f.password1.value != f.password2.value)
{
alert('Passwords are not same');
return false;
}
if(f.password2.value.length == 0)
{
alert('Please confirm the Password');
f.password2.focus();
f.password2.select();
return false;
}
if(f.name.value.length == 0)
{
alert('Please enter the Name of the User');
f.name.focus();
f.name.select();
return false;
}
if(f.email.value.length == 0)
{
alert('Please enter the email');
f.email.focus();
f.email.select();
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
				<div class="cap-right">Create a New User</div>
			</div>
		</div>
        
		<form name="form1" method="POST" onSubmit="return CheckForm();">
            <input name="step" type="hidden" value="1" />
            <table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td width="24%" align="right" class="row1">User Role:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><?php echo ShowDbOptions(users, user_type,"", "select", "", yes, "-- Select --", " onchange=\"ShowRegistrationOptions();\""); ?></td>
                </tr>
                <tr id="tr_bm_major" style="display:none">
                    <td width="24%" align="right" class="row1">Select an Organization:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><?php draw_html_control("select","major_location_id","","locations_major","","","","major_location_name ASC","major_location_id","major_location_name,state_code","-- Select --", " onchange=\"LoadMinorLocations(this);\""); ?></td>
                </tr>
                <tr id="tr_bm_minor" style="display:none">
                    <td width="24%" align="right" class="row1">Select Branch:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><span id="area_minor_location"><input type="hidden" name="location_id" value="" /><em class="Small">-- Select an Organization --</em></span></td>
                </tr>
                <tr>
                    <td width="24%" class="row1" align="right">Profile:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><?php draw_dropdown(profile_definitions, id, profile_name, "profile_name ASC", "profile_type", "<>", "Custom", profile_id, "-- Select a Profile --", "", ""); ?></td>
                </tr>
                <tr>
                    <td width="24%" class="row1" align="right">User ID:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><input name="userid" type="text" id="userid" style="width:118px"> <a class="btnlite" onclick="CheckUserID(document.form1.userid.value);">Check Availability</a>
                    <span id="area_userid_availability_message"><br /></span></td>
                </tr>
                <tr>
                    <td width="24%" class="row1" align="right">Password:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><input name="password1" type="password" id="password1"></td>
                </tr>
                <tr>
                    <td width="24%" class="row1" align="right">Confirm Password:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><input name="password2" type="password" id="password2"></td>
                </tr>
                <tr>
                    <td width="24%" class="row1" align="right">Name:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><input name="name" type="text" id="name"></td>
                </tr>
                <tr>
                    <td width="24%" align="right" class="row1">Title:</td>
                    <td width="76%" class="row2"><input name="user_title" type="text" id="name"></td>
                </tr>
                <tr>
                    <td width="24%" class="row1" align="right">Email Address:<span class="Required">*</span></td>
                    <td width="76%" class="row2"><input name="email" type="text" id="email"></td>
                </tr>
                <tr>
                    <td width="24%" class="row1" align="right">Mobile:</td>
                    <td width="76%" class="row2"><input name="mobile" type="text" id="mobile"></td>
                </tr>
                <tr>
                    <td class="cat" colspan="2" align="center"><input class="btnmain" type="submit" name="submit" value="Create User" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="Reset" name="reset" /></td>
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