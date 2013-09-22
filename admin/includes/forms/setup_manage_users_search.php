<div id="pagecontent">

<div style="padding: 2px;"></div>

<div class="block-start">	
    <div class="cap-div">
    <div class="cap-left">
    <div class="cap-right">User Search</div>
    </div>
    </div>	
<form name="form1" method="GET">
<input name="do" type="hidden" value="setup_manage_users" />
<input name="element" type="hidden" value="search" />
<input name="step" type="hidden" value="1" />

<table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
  
<?php /*?><!-- <tr>
      <td width="24%" align="right" class="row1">Role: </td>
      <td width="76%" class="row2"><?php echo ShowDbOptions(users, user_type,"", "select", $_REQUEST['user_type'], yes, "-- All --", ""); ?></td>
    </tr>--><?php */?>
    <tr>
      <td width="24%" align="right" class="row1">Profile: </td>
      <td width="76%" class="row2"><?php draw_dropdown(profile_definitions, id, profile_name, "profile_name ASC", "", "", "", profile_id, "-- All --", $_REQUEST['profile_id'], ""); ?></td>
    </tr>
    
    <tr>
      <td width="24%" align="right" class="row1">User ID: </td>
      <td width="76%" class="row2"><input name="userid" type="text" value="" /></td>
    </tr>
    <tr>
      <td width="24%" align="right" class="row1">Name: </td>
      <td width="76%" class="row2"><input name="name" type="text" value="" /></td>
    </tr>
     <tr>
      <td width="24%" align="right" class="row1">Email: </td>
      <td width="76%" class="row2"><input name="email" type="text" value="" /></td>
    </tr>
     <tr>
      <td width="24%" align="right" class="row1">Mobile: </td>
      <td width="76%" class="row2"><input name="mobile" type="text" value="" /></td>
    </tr>
  <tr>
	<td class="cat" colspan="2" align="center"><input class="btnmain" type="submit" name="submit" value="Search" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="Reset" name="reset" /></td>
</tr>
  </table>
</form>



<div class="block-end-left"><div class="block-end-right"></div></div></div>

<div style="padding: 2px;"></div>
<br clear="all" />
</div>