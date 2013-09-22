<div id="logo-row">
	<div id="logo-left">
		<div id="logo-right">

			<div class="textlinks">
				<div class="MenuTextContainer">
                	<a class="MenuText" href="index.php">Home</a> | 
					<a href="#" id="SettingsMenuButton" class="PopDownMenu MenuText">Settings<img src="Styles/blue/theme/images/arrow_down_whitea.gif" border="0"></a>

                    <div id="SettingsMenu" style="height: 107px; position: absolute; top: 23px; left: 348px; display: none;" class="DropShadowContainer PopDownMenuContainer">		
                    	<div class="Shadow1">
                        	<div class="Shadow2">
                            	<div class="Shadow3">
                                	<div class="ItemContainer">
                                    	<div id="" class="DropDownMenu" style="width: 140px; position: static;">
                                        	<ul>
                                            	<li>
                                                	<a href="core.php?do=change_password" class="MenuTextDrop" title="Change Password">Change Password</a>
                                                </li>
												<li>
                                                	<a href="core.php?do=my_profile" class="MenuTextDrop" title="My Profile">My Profile</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> 
                    
                    | <a class="MenuText" href="<?php echo $logoutAction ?>">Log Out</a></div>

                <div class="loggedinas">
                    <span>Welcome <strong><?php $user_type = get_val_col(users,user_type,userid,$_SESSION['NF_Username']);
                            $profile_id = get_val_col("users", "profile_id", "userid", $_SESSION['NF_Username']);
                            echo get_val_col("users", "name", "userid", $_SESSION['NF_Username']); ?></strong>
                    </span> | 
                    <span> You are currently logged in as <?php echo $user_type; ?>
                    <?php 
                    if ($user_type == "Location Administrator")
                    {
                        echo " of <b>" . get_val_col(locations,location_name,location_id,get_val_col(users,location_id,userid,$_SESSION['NF_Username'])) . "</b>";
                    } 
                    elseif ($user_type == "Organizational Administrator")
                    {
                        echo " of <b>" . get_val_col(locations_major,major_location_name,major_location_id,get_val_col(users,major_location_id,userid,$_SESSION['NF_Username'])) . "</b>";
                    }
                    ?>
                    </span>&nbsp;&nbsp;		
                </div>
			</div>
			<a href="index.php"><img src="Styles/blue/imageset/site_logo.gif" alt="" title="" /></a>
			<div id="logo-clear"></div>
		</div>
	</div>
</div>