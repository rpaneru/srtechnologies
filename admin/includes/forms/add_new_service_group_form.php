<?php
$profile_id = get_val_col(users,profile_id,userid,$_SESSION['NF_Username']);
?>
<script type="text/javascript" src="javascript/ckeditor/ckeditor.js"></script>
<script language=JavaScript>
function CheckForm()
{
	var f = document.form1;
	if(f.service_group_name.value.length == 0)
	{
		alert('Please enter the service group name');
		f.service_group_name.focus();
		return false;
	}
	return true;
}
</script>
<div id="pagecontent">

<div style="padding: 2px;"></div>

<div class="block-start">	
    <div class="cap-div">
    <div class="cap-left">
    <div class="cap-right">Add New Service Group</div>
    </div>
    </div>
<form name="form1" method="POST" enctype="multipart/form-data" onSubmit="return CheckForm();" action="">
<input type="hidden" name="step" value="1" />
 <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
<table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
     <tr>
      <td align="right" class="row1">Service Group Name:</td>
      <td class="row2">
 	  <input type="text" value="<?php echo $service_group_name;?>" name="service_group_name" id="service_group_name" style="width:80%"/>
	 
      </td>
    </tr>

  <tr>
      <td align="right" class="row1">Description:</td>
      <td class="row2">
 	 <textarea name="service_group_description" id="service_group_description"  style="width:100%;  height:100px" ><?php echo $service_group_description;?></textarea>
	 <script type="text/javascript">
	  
	  
	CKEDITOR.replace('service_group_description',
	
	{   
	//filebrowserImageBrowseUrl : 'javascript/ckeditor/plugins/filemanager/browser/default/browser.html?Type=Image&Connector=http://localhost/givecentral/admin/javascript/ckeditor/plugins/filemanager/connectors/php/connector.php',
	filebrowserUploadUrl  :'javascript/ckeditor/plugins/filemanager/connectors/php/upload.php?Type=File',
	toolbar :
	[
			{  items : [ 'Bold','Italic','Underline','-','NumberedList','BulletedList','Subscript','Superscript','Image'] },
			
			
		]
                 });
	
	  </script>
	 <input type="hidden" id="hidden_service_group_description" name="hidden_service_group_description" value="<?php echo $service_group_description;?>" />
	 <?php
	 if($email_body_selected=="")
		{ 
			echo '<script>CKEDITOR.instances.email_body.setData(document.form1.hidden_service_group_description.value );</script>';
		}
	?>	
      </td>
    </tr>
   <tr>
      <td colspan="2" align="right" class="cat">
		<input type="hidden" id="element" name="element" value="<?php echo $_REQUEST['element'];?>" />
		<input type="hidden" id="servic_group_id" name="servic_group_id" value="<?php echo $_REQUEST['servic_group_id'];?>" />
        <input type="submit" name="Submit" value="Submit" class="btnmain" > &nbsp;  <input type="reset" name="Reset" value="Reset" class="btnlite" >
      </td>
    </tr>
  </table>
</form>
<div class="block-end-left"><div class="block-end-right"></div></div></div>

<div style="padding: 2px;"></div>
<br clear="all" />
</div>
