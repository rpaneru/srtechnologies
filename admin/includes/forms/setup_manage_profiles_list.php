<div id="pagecontent">
	<?php
	$xtrasql = "";
	if ($_GET['profile_name'] <> "")
	{
		$xtrasql .= " AND pd.profile_name LIKE  '%" . $_GET['profile_name'] . "%' ";
	}
	if ($_GET['service_group_id'] <> "")
	{
		$i = 0;
		while ($i < count($_GET['service_group_id'])):
			$xtrasql .= " AND psg.service_group_id = '" . $_GET['service_group_id'][$i] . "'";
			$i++;
		endwhile;	   
	}
	$query = "SELECT pd.*, psg.profile_id, psg.service_group_id FROM profile_definitions pd, profile_service_groups psg WHERE pd.id = psg.profile_id AND profile_type = 'System' " . $xtrasql . " GROUP BY pd.id ";
	//echo $query;
	$query_rsnf_count = $query;
	$rsnf_count = mysql_query($query_rsnf_count, $nfconx) or die(mysql_error());
	$row_rsnf_count = mysql_fetch_assoc($rsnf_count);
	$totalRows_rsnf_count = mysql_num_rows($rsnf_count);
	//Pagination & Page Sorting Logic
	$max_results = 20;
	$page_url = $_SERVER['REQUEST_URI'];
	$page_query_string = $_SERVER['QUERY_STRING'];
	$system_uri = $NF_config['system_uri'];
	$default_sort_column = "pd.profile_name";
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
                                    <td class="nav" valign="middle" nowrap="nowrap" align="right"><?php load_service_element($_SESSION['NF_Username'], $_GET['do'], "","Galley"); ?></td>
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
    <table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <th style="border-right-width: 0;"><?php draw_record_sorter("S. No.","p.id",$page_query_string,$system_uri); ?></th>
            <th>&nbsp;<?php draw_record_sorter("Profile Name","p.profile_name",$page_query_string,$system_uri); ?>&nbsp;</th>
            <th>&nbsp;Profile Description&nbsp;</th>
            <th>&nbsp;Total Users&nbsp;</th>
            <th width="20px">&nbsp;</th>
        </tr>
        <?php 
        $i = 1;
        $k = $to_from;
        do 
        {
        ?>
            <tr>
                <td class="row1" width="15" align="center" nowrap="nowrap"><?php echo $k;  ?></td>
                <td class="row1"><?php echo $row_rsnf['profile_name']; ?></td>
                <td class="row1" align="center"><?php echo $row_rsnf['profile_description']; ?></td>
                <td class="row1" align="center"><?php echo get_row_count(users,profile_id,"=",$row_rsnf['id']); ?></td>
                <td class="row1 Small" align="center" nowrap="nowrap" style="vertical-align:middle">
                <a href="core.php?do=setup_manage_users&amp;element=search&amp;step=1&amp;profile_id=<?php echo $row_rsnf['id']; ?>" class="rowlink">View Users</a>            
                <?php load_service_element($_SESSION['NF_Username'], $_GET['do'], "&id=" . $row_rsnf['id'] . "","Rows"); ?>            
                </td>
            </tr>
        <?php 
            $i++; 
            $k++; 
        }
        while ($row_rsnf = mysql_fetch_assoc($rsnf)); 
        ?>	
    </table>
        <div class="block-end-left">
            <div class="block-end-right"></div>
        </div>
    </div>
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
            <div align="right" style="float:right">Showing <strong><?php echo $to_from . ' - ' . $to_show; ?></strong> of <strong><?php echo $totalRows_rsnf_count; ?></strong> Records</div><br />
            </td>
        </tr>
    </table>
    <?php 
    } // Show if recordset not empty 
    else 
    {
        $type = "warning";
        $message = "<b>No record found</b>";
        include ("includes/announce.inc.php");
    } 
    ?>
    <br clear="all" />
</div>