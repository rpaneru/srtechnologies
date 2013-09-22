<div id="pagecontent">
<?php


$query_rsnf = "SELECT * FROM users WHERE id='" . $_GET['id'] . "' ";
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
    <div class="cap-right">Modify a User</div>
    </div>
    </div>

<script language=JavaScript>


		function CheckForm()
		{
			// Make sure that all of the form variables, etc are valid
			var f = document.form1;
	if(f.profile_id.value.length == 0)
			{
				alert('Please select the Profile');
				return false;
			}		
			
if(f.userid.value.length == 0)
			{
				alert('Please enter the User ID');
				return false;
			}
			if(f.password1.value.length > 0)
			{
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
			}
			
			if(f.name.value.length == 0)
			{
				alert('Please enter the Name of the User');
				f.name.focus();
				f.name.select();
				return false;
			}
			
			
			// Everything is OK, return true
			return true;
		}
		
</script>
<form name="form1" method="POST" onSubmit="return CheckForm();">
<input name="step" type="hidden" value="1" />
<table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">


    <tr>
      <td width="24%" align="right" class="row1">User Type: </td>
      <td width="76%" class="row2"><?php echo $row_rsnf['user_type']; ?></td>
    </tr>
   
    <?php /*?> <tr>
      <td width="24%" class="row1" align="right">Profile:<span class="Required">*</span></td>
      <td width="76%" class="row2"><?php draw_dropdown(profile_definitions, id, profile_name, "profile_name ASC", "", "", "", profile_id, "-- Select a Profile --", $row_rsnf['profile_id'], ""); ?></td>
    </tr>
  <?php */?>
  <tr>
      <td width="24%" class="row1" align="right">User ID:</td>
      <td width="76%" class="row2"><strong><?php echo $row_rsnf['userid']; ?></strong></td>
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
      <td width="76%" class="row2"><input name="name" type="text" id="name" value="<?php echo $row_rsnf['name']; ?>"></td>
    </tr>
     <tr>
      <td width="24%" align="right" class="row1">Title:</td>
      <td width="76%" class="row2"><input name="user_title" type="text" id="user_title" value="<?php echo $row_rsnf['user_title']; ?>"></td>
    </tr>

 <tr>
      <td width="24%" align="right" class="row1">Type:</td>
      <td width="76%" class="row2"><?php echo ShowDbOptions(users, user_employment_status,user_employment_status, "radio", $row_rsnf['user_employment_status'], yes, "", ""); ?></td>
    </tr>
     <tr>
      <td width="24%" class="row1" align="right">Email Address:</td>
      <td width="76%" class="row2"><input name="email" type="text" id="email" value="<?php echo $row_rsnf['email']; ?>"></td>
    </tr>
    <tr>
      <td width="24%" class="row1" align="right">Mobile:</td>
      <td width="76%" class="row2"><input name="mobile" type="text" id="mobile" value="<?php echo $row_rsnf['mobile']; ?>"></td>
    </tr>
<tr>
	<td class="cat" colspan="2" align="center"><input class="btnmain" type="submit" name="submit" value="Modify User" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="Reset" name="reset" /></td>
</tr>
</table>
<input type="hidden" value="1" name="step" />
<input type="hidden" value="<?php echo $row_rsnf['userid']; ?>" name="userid" />
</form>
<div class="block-end-left"><div class="block-end-right"></div></div></div>

<div style="padding: 2px;"></div>

<?php } // Show if recordset not empty 
else {
  
$type = "warning";
$message = "<b>Invalid User ID</b>";
include ("includes/announce.inc.php");
include 'includes/forms/setup_manage_users_list.php';
 } 
 
?>
<br clear="all" />
</div>