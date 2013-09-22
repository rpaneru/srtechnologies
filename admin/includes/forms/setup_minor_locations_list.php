<div id="pagecontent">
	<?php
    $xtrasql = " WHERE 1=1 ";
	if ($_GET['major_location_id'] <> "")
	{
	$xtrasql .= " AND  major_location_id = '" . $_GET['major_location_id'] . "' ";
	}
	if ($_GET['location_name'] <> "")
	{
		$xtrasql .= " AND location_name LIKE '%" . $_GET['location_name'] . "%' ";
	}
	if ($_GET['location_id'] <> "")
	{
	$xtrasql .= " AND location_id = '" . $_GET['location_id'] . "' ";
	}
	$xtrasql .= $xtraquery;
	$query = "SELECT * from locations " . $xtrasql . " ";
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
	$default_sort_column = "location_id";
	$default_sort_direction = "ASC";
	
    if(!isset($_GET['page']))
    { 
        $page = 1; 
    } 
    else 
    { 
        $page = $_GET['page']; 
    } 
    // Figure out the limit for the query based 
    // on the current page number. 
    $from = (($page * $max_results) - $max_results); 
    $to_show = $from + $max_results;
    if ($to_show > $totalRows_rsnf_count)
    { 
        $to_show = $totalRows_rsnf_count; 
    }
    $to_from = $from + 1;
    $query_rsnf = $query .  get_record_sorting($page_query_string,$default_sort_column,$default_sort_direction) . " LIMIT $from,$max_results";
    //echo $query_rsnf;
    $rsnf = mysql_query($query_rsnf, $nfconx) or die(mysql_error());
    $row_rsnf = mysql_fetch_assoc($rsnf);
    $totalRows_rsnf = mysql_num_rows($rsnf);
    ?>

	<div style="padding: 2px;"></div>

	<div class="cap-div">
		<div class="cap-left">
        	<div class="cap-right">
				<?php echo page_characters($_GET['do'], "page_title"); ?>
			</div>
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
										<?php 
                                        load_service_element($_SESSION['NF_Username'], $_GET['do'], "","Galley"); 
                                        ?>        
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>    
    
	<?php
    if ($totalRows_rsnf > 0) 
    {
	    // Show if recordset not empty 
    ?>
    <div class="block-start popwide">
    	<table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
	    <tr>
            <th style="border-right-width: 0;"><?php draw_record_sorter("S. No.","major_location_id",$page_query_string,$system_uri); ?></th>
            <th>&nbsp;<?php draw_record_sorter("Location Name","location_name",$page_query_string,$system_uri); ?>&nbsp;</th>
            <th>&nbsp;Organization&nbsp;</th>
            <th width="40px">&nbsp;</th>
	    </tr>
		<?php 
        $i = 1;
        $k = $to_from;
        do 
        {
        ?>
        <tr>
	        <td class="row1" width="15" align="center" nowrap="nowrap">
				<?php echo $k;  ?>
            </td>
            <td class="row2" align="left">
    	        <?php echo stripslashes($row_rsnf['location_name']); ?>
				
            </td>
            
            <td class="row2" align="left">
	            <?php echo get_val_col(locations_major,major_location_name,major_location_id,$row_rsnf['major_location_id']); ?>
            </td>
            
            <td class="row1 Small" align="center"  nowrap="nowrap" style="vertical-align:middle">
            <?php load_service_element($_SESSION['NF_Username'], $_GET['do'], "&location_id=" . $row_rsnf['location_id'] . "","Rows","&location_id=" . $row_rsnf['location_id'] . ""); ?>  
            
            <?php
            $status = get_val_col('locations_major','status','major_location_id', $row_rsnf['major_location_id']);			
			if( $status == 0)
			{
				$status = 1;
				$show_status = "Make Aactive";
			}
			elseif( $status == 1)
			{
				$status = 0;
				$show_status = "Make Inactive";
			}			
			?>
            <a href="core.php?do=setup_major_locations&amp;element=change_status&amp;major_location_id=<?php echo $row_rsnf['major_location_id'];?>&amp;status=<?php echo $status;?>" class="btnlite"><span><?php echo $show_status;?></span></a>                               
            </td>
    </tr>
    <?php 
		$i++; 
		$k++; 
    } 
    while ($row_rsnf = mysql_fetch_assoc($rsnf)); 
    ?>	
    </table>
	</div>
    
    <div class="block-end-left">
        <div class="block-end-right"></div>
    </div>

	<div style="padding: 2px;"></div>

	<table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
        <td align="left"></td>
        <td align="right" nowrap="nowrap">
            <?php
                // Show the page No.
                echo '<div id="pagenav" class="pageNav" style="padding-bottom:5px;padding-top:5px;">';
                draw_pagination($page, $max_results, $totalRows_rsnf_count, $page_url);
                echo '&nbsp;</div>';
                ?>
                <div align="right" style="float:right">
                Showing <strong><?php echo $to_from . ' - ' . $to_show; ?></strong> of <strong><?php echo $totalRows_rsnf_count; ?></strong> Records <br /><br />
                Show <?php draw_max_result_dropdown("max_results", "", get_max_results_per_page($_SESSION['NF_MAX_RESULTS']), " onchange=\"location.href='rootbase.php?do=set_max_results&script_request=" . urlencode($page_query_string) . "&max_results='+this[this.selectedIndex].value;\""); 
            ?> Records per Page
        </div><br />
        </td>
	</tr>
</table>
	<?php 
    }
    // Show if recordset not empty 
    else 
    {
		echo '<div style="padding: 5px;"></div>';
        $type = "warning";
        $message = "<b>No Branch found</b>";
        include ("includes/announce.inc.php");
    } 
    ?>
<br clear="all" />
</div>