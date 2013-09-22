<div id="pagecontent">
        <div style="padding: 2px;"></div>
        <div class="block-start">	
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
                                            <td class="genmed">Below is a list of users who access the <?php echo $NF_config['app_name']; ?>.</td>
                                        </tr>
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
    $user_type = get_val_col(users,user_type,userid,$_SESSION['NF_Username']);
    $query = "SELECT * FROM users ";
    $xtrasql = " WHERE 1=1 ";
    if ($user_type <> "Admin")
    {
        $xtrasql .= " AND parent_userid = '". $_SESSION['NF_Username'] ."' ";	
    }
    if ($_REQUEST['user_type']<> "")
    {
        $xtrasql .= " AND user_type = '" . $_REQUEST['user_type'] . "' ";	
    }
    if ($_REQUEST['profile_id']<> "")
    {
        $xtrasql .= " AND profile_id =  '" . $_REQUEST['profile_id'] . "' ";	
    }
    if ($_REQUEST['userid']<> "")
    {
        $xtrasql .= " AND userid = '" . $_REQUEST['userid'] . "' ";	
    }
    if ($_REQUEST['name']<> "")
    {
        $xtrasql .= " AND name LIKE '%" . $_REQUEST['name'] . "%' ";	
    }
    if ($_REQUEST['email']<> "")
    {
        $xtrasql .= " AND email LIKE '%" . $_REQUEST['email'] . "%' ";	
    }
    if ($_REQUEST['mobile']<> "")
    {
        $xtrasql .= " AND mobile LIKE '%" . $_REQUEST['mobile'] . "%' ";	
    }
    $query = $query . $xtrasql;
    $query_rsnf_count = $query;
    $rsnf_count = mysql_query($query_rsnf_count, $nfconx) or die(mysql_error());
    $row_rsnf_count = mysql_fetch_assoc($rsnf_count);
    $totalRows_rsnf_count = mysql_num_rows($rsnf_count);
    //Pagination & Page Sorting Logic
    $max_results = 20;
    $page_url = $_SERVER['REQUEST_URI'];
    $page_query_string = $_SERVER['QUERY_STRING'];
    $system_uri = $NF_config['system_uri'];
    $default_sort_column = "userid";
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
    <?php 
    if ($totalRows_rsnf > 0) 
    { // Show if recordset not empty 
    ?>
            <table class="tablebg genmed" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <th style="border-right-width: 0;"><?php draw_record_sorter("S.No.","id",$page_query_string,$system_uri); ?></th>
                    <th>&nbsp;<?php draw_record_sorter("User ID","userid",$page_query_string,$system_uri); ?>&nbsp;</th>
                    <th>&nbsp;<?php draw_record_sorter("Name","name",$page_query_string,$system_uri); ?>&nbsp;</th>
                    <th>&nbsp;<?php draw_record_sorter("Title","title",$page_query_string,$system_uri); ?>&nbsp;</th>
                    <th>&nbsp;<?php draw_record_sorter("Role","user_type",$page_query_string,$system_uri); ?>&nbsp;</th>
                    <th>&nbsp;Login Profile&nbsp;</th>
                    <th>Organization</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th width="20px">&nbsp;</th>
                </tr>
                <?php 
                $i = 1;
                $k = $to_from;
                do 
                {
                ?>
                    <tr>
                        <td class="row1" width="20" align="center" nowrap="nowrap"><?php echo $k;  ?></td>
                        <td class="row2"><?php echo $row_rsnf['userid']; ?></td>
                        <td class="row1" style="cursor:crosshair">
                        <span title="header=[User Details:] body=[Mobile: <?php echo $row_rsnf['mobile']; ?><br><br>Email: <?php echo $row_rsnf['email']; ?>]"><?php echo $row_rsnf['name']; ?></span>
                        </td>
                        <td class="row2"><?php echo $row_rsnf['user_title']; ?></td>
                        <td class="row2"><?php echo $row_rsnf['user_type']; ?></td>
                        <td class="row2"><?php echo get_val_col(profile_definitions,profile_name,id,$row_rsnf['profile_id']); ?></td>
                        <td class="row2">
                            <?php 
                            if (($row_rsnf['major_location_id'] <> "") && ($row_rsnf['major_location_id'] <> "0")) 
                            echo get_val_col(locations_major,major_location_name,major_location_id,$row_rsnf['major_location_id']); 
                            else 
                            echo "-"; 
                            ?>
                        </td>
                        <td class="row2">
                            <?php 
                            if (($row_rsnf['location_id'] <> "") && ($row_rsnf['location_id'] <> "0")) 
                            echo get_val_col(locations,location_name,location_id,$row_rsnf['location_id']); 
                            else 
                            echo "-"; 
                            ?>
                        </td>
                        <td class="row2" align="center">
                            <?php
                            if($row_rsnf['status'] == 1)
                            {
                                echo "Active";
                            }
                            else
                            {
                                echo "Inactive";	
                            }
                            ?>
                        </td>
                        <td class="row1 Small" align="center"><?php load_service_element($_SESSION['NF_Username'], $_GET['do'], "&id=" . $row_rsnf['id'] . "","Rows"); ?></td>
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
            <td align="left"></td>
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
    } 
    // Show if recordset not empty 
    else 
    {
        echo '<div align="right">';
        load_service_element($_SESSION['NF_Username'], $_GET['do'], "","Galley"); 
        echo '</div><br />
        <br />';
        $type = "warning";
        $message = "<b>No user found</b>";
        include ("includes/announce.inc.php");
    } 
    ?>
    <br clear="all" />
</div>