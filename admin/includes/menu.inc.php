<div id="Menu">
    <ul>
	    <li class="First"><a href="index.php">Home</a></li>    
		<?php 
		$profile_id = get_val_col(users,profile_id,userid,$_SESSION['NF_Username']);
        draw_nav_menu_main($profile_id); 
        ?>    
    </ul>
</div>