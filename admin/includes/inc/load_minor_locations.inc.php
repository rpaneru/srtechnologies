<?php
if ($_GET['major_location_id'] <> "")
{
	draw_html_control("select","location_id","","locations","major_location_id","=",$_GET['major_location_id'],"location_name ASC","location_id","location_name","-- Select --","");
} 
else 
{
	echo '<em class="Small">-- Select an Organization --</em><input type="hidden" value="" name="location_id" />';
}
?>