<div id="pagecontent">
<?php

$xtrasql = " WHERE 1=1 ";

if ($_GET['id'] <> ""){
$xtrasql .= " AND  id  = '" . $_GET['service_id'] . "' ";
}
if ($_GET['name'] <> ""){
$xtrasql .= " AND service_name LIKE '%" . $_GET['service_name'] . "%' ";
}


$xtrasql .= $xtraquery;
$query = "SELECT services.*,services_group.service_group_name from services left join services_group on services.service_group_id=services_group.id" . $xtrasql . " ";

//echo $query;
$query_rsnf_count = $query;
$rsnf_count = mysql_query($query_rsnf_count, $nfconx) or die(mysql_error());
$row_rsnf_count = mysql_fetch_assoc($rsnf_count);
$totalRows_rsnf_count = mysql_num_rows($rsnf_count);


//Pagination & Page Sorting Logic

$max_results = get_max_results_per_page($_SESSION['NF_MAX_RESULTS']);

$page_url = $_SERVER['REQUEST_URI'];
$page_query_string = $_SERVER['QUERY_STRING'];
$system_uri = $NF_config['system_uri'];
$default_sort_column = "id";
$default_sort_direction = "Desc";

if(!isset($_GET['page'])){ 
    $page = 1; 
} else { 
    $page = $_GET['page']; 
} 


// Figure out the limit for the query based 
// on the current page number. 
$from = (($page * $max_results) - $max_results); 

$to_show = $from + $max_results;
if ($to_show > $totalRows_rsnf_count){ $to_show = $totalRows_rsnf_count; }
$to_from = $from + 1;

$query_rsnf = $query .  get_record_sorting($page_query_string,$default_sort_column,$default_sort_direction) . " LIMIT $from,$max_results";
//echo $query_rsnf;
$rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());
$row_rsnf = mysql_fetch_assoc($rsnf);
$totalRows_rsnf = mysql_num_rows($rsnf);
?>
<?php if ($totalRows_rsnf > 0) { // Show if recordset not empty ?>
<div style="padding: 2px;"></div>
	<div class="block-start popwide">	
    <div class="cap-div">
    <div class="cap-left">
    <div class="cap-right"><?php echo page_characters($_GET['do'], "page_title"); ?></div>
    </div>
    </div>	
  
<table class="tablebg" width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td class="row1">

<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
		<td align="left">

	<table width="100%" cellspacing="1">
  
		<tr>
		<td class="nav" valign="middle" nowrap="nowrap" align="right">
       				<table width="100%" cellspacing="1">	  
					<tbody><tr>
					<td valign="middle" nowrap="nowrap" align="right" class="nav">
					<a class="galleylink" href="core.php?do=view_services&element=create"><span>Add a New Service</span></a>        </td>
			
					 </tr>
				</tbody></table>
	    </td>

         </tr>
	</table>
</td>
	</tr>
</table>
	</td>
</tr>
</table>
<table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr>
		<th style="border-right-width: 0;"><?php draw_record_sorter("S. No.","id",$page_query_string,$system_uri); ?></th>
        <th>&nbsp;<?php draw_record_sorter("service Name","service_name",$page_query_string,$system_uri); ?>&nbsp;</th>
		<th>&nbsp;<?php draw_record_sorter("service Group Name","service_group_name",$page_query_string,$system_uri); ?>&nbsp;</th>
 		<th>&nbsp;<?php draw_record_sorter("Description","service_description",$page_query_string,$system_uri); ?>&nbsp;</th>
		<th width="40px">&nbsp;</th>
	</tr>
 <?php 
	$i = 1;
	$k = $to_from;

	do {
			if($row_rsnf['service_name']!="Service")
			{
	  ?>
			<tr>
			<td class="row1" width="15" align="center" nowrap="nowrap">
             <?php echo $k;  ?>
             </td>
			 <td class="row2" align="left">
          <?php echo stripslashes($row_rsnf['service_name']); ?>
            </td>
			<td class="row2" align="left">
          <?php echo stripslashes($row_rsnf['service_group_name']); ?>
            </td>
            <td class="row2" align="left">
            <?php echo $row_rsnf['service_description']; ?>
            </td>
         
           
			<td class="row1 Small" align="center"  nowrap="nowrap" style="vertical-align:middle">
                <a class="btnlite" href="core.php?do=view_services&element=edit&id=<?php echo $row_rsnf['id'];?>">Edit </a>
<a class="btnlite" href="core.php?do=view_services&element=delete&id=<?php echo $row_rsnf['id'];?>" onclick="return confirmLink(this, 'delete this service group?')">Delete </a>
		</tr>
		 <?php 
	  $i++; 
	$k++; 
		}
	  } while ($row_rsnf = mysql_fetch_assoc($rsnf)); ?>	


</table>


<div class="block-end-left"><div class="block-end-right"></div></div></div>

<div style="padding: 2px;"></div>
    	


		<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td align="left">	</td>
			<td align="right" nowrap="nowrap">


<?php
 
// Show the page No.
echo '<div id="pagenav" class="pageNav" style="padding-bottom:5px;padding-top:5px;">';
draw_pagination($page, $max_results, $totalRows_rsnf_count, $page_url);
echo '&nbsp;</div>';

?>
<div align="right" style="float:right">Showing <strong><?php echo $to_from . ' - ' . $to_show; ?></strong> of <strong><?php echo $totalRows_rsnf_count; ?></strong> Records <br /><br />
Show <?php draw_max_result_dropdown("max_results", "", get_max_results_per_page($_SESSION['NF_MAX_RESULTS']), " onchange=\"location.href='rootbase.php?do=set_max_results&script_request=" . urlencode($page_query_string) . "&max_results='+this[this.selectedIndex].value;\""); ?> Records per Page</div><br />
							</td>
		</tr>
		</table>


<?php } // Show if recordset not empty 
else {
  
$type = "warning";
$message = "<b>No template found</b>";
include ("includes/announce.inc.php");
 } 
 
?>

<br clear="all" />

</div>