
<script language=JavaScript>
	
		function CheckForm()
		{
			// Make sure that all of the form variables, etc are valid
			var f = document.form1;
			
			if(f.cur_pwd.value.length == 0)
			{
				alert('Please enter Current Password');
				f.cur_pwd.focus();
				f.cur_pwd.select();
				return false;
			}
if(f.new_pwd.value.length == 0)
			{
				alert('Please enter the new Password');
				f.new_pwd.focus();
				f.new_pwd.select();
				return false;
			}
			if(f.conf_pwd.value.length == 0)
			{
				alert('Please confirm the new Password');
				f.conf_pwd.focus();
				f.conf_pwd.select();
				return false;
			}
			
			// Everything is OK, return true
			return true;
		}
		
</script>
<?php
$userid = $_SESSION['NF_Username'];
$profileid=get_val_col(users,profile_id,userid,$userid);
//echo $profileid;
?>
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
      <td width="37%" align="right" class="row1">Enter Current Password: </td>
      <td width="63%" class="row2"><input name="cur_pwd" type="password" id="cur_pwd"></td>
    </tr>
    <tr>
      <td width="37%"  class="row1" align="right">Enter New Password: </td>
      <td width="63%" class="row2"><input name="new_pwd" type="password" id="new_pwd"></td>
    </tr>
	 <tr>
      <td width="37%" class="row1" align="right">Confirm Password: </td>
      <td width="63%" class="row2"><input name="conf_pwd" type="password" id="conf_pwd"></td>
    </tr>
   <tr  <?php if($profileid<>"13")
   { echo "style='display:none'";} ?>>
      <td width="37%" class="row1" align="right">&nbsp; </td>
      <td width="63%" class="row2"><a href="core.php?do=setup_password_reset_answers">Change your password retrieval settings</a></td>
    </tr>


<tr>
	<td class="cat" colspan="2" align="center"><input class="btnmain" type="submit" name="submit" value="Submit" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="Reset" name="reset" /> 
	 </td>
</tr>
  </table>
  <input name="step" type="hidden" value="1" />

</form>



<div class="block-end-left"><div class="block-end-right"></div></div></div>

<div style="padding: 2px;"></div>
<br clear="all" />
</div>
