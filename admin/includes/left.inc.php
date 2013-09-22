<!-- Start Left -->
<?php
$current_page_service_group_id = get_val_col(services, service_group_id, service_id, $_GET['do']);
?>
<div class="block-start"><div class="cap-div"><div class="cap-left"><div class="cap-right"><?php echo get_val_col(services_group,service_group_name,id,$current_page_service_group_id); ?>&nbsp;</div></div></div><table class="tablebg" width="100%" cellspacing="0">
			<?php include 'includes/boxes/leftnav_boxes.inc.php'; ?>
</table>
<div class="block-end-left"><div class="block-end-right"></div></div></div>
<!-- Close left -->