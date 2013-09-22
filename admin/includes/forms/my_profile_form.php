
<script language=JavaScript>
	
		function CheckForm()
		{
			// Make sure that all of the form variables, etc are valid
			var f = document.form1;
			
			if (f.email.value == "")
		{
			alert("Please enter a valid Email ID");
			f.email.select();
			f.email.focus();
			return false;
		}		
		if ((f.email.value == "" || f.email.value.indexOf('@', 0) == -1) || f.email.value.indexOf('.') == -1)
		{
			alert("Please enter a valid Email ID");
			f.email.select();
			f.email.focus();
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
      <th colspan="2" class="headmessage">Manage your Profile</th>
    </tr>
  <tr>
      <td width="40%" align="right" class="row1">Name: </td>
      <td width="60%" class="row2"><?php echo get_val_col(users, name, userid, $_SESSION['NF_Username']); ?></td>
    </tr>
    <tr>
      <td width="40%" class="row1" align="right">Mobile No.: </td>
      <td width="60%" class="row2"><input name="mobile" type="text" id="mobile" value="<?php echo get_val_col(users, mobile, userid, $_SESSION['NF_Username']); ?>"></td>
    </tr>
    <tr>
      <td width="40%" align="right" class="row1">Email Address:<span class="Required">*</span></td>
      <td width="60%" class="row2"><input name="email" type="text" id="email" value="<?php echo get_val_col(users, email, userid, $_SESSION['NF_Username']); ?>"></td>
    </tr>
	 
 <tr>
	<td class="cat" colspan="2" align="center"><input class="btnmain" type="submit" name="submit" value="Submit" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="Reset" name="reset" /></td>
</tr>
  </table>
  <input name="step" type="hidden" value="1" />
</form>



<div class="block-end-left"><div class="block-end-right"></div></div></div>

<div style="padding: 2px;"></div>
<br clear="all" />
</div>