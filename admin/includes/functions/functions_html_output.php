<?php
//Define page_name, page_link, page_title, page_description and other page options
function page_characters($page_name, $requested_value)
{
	// Search if requested modules have been defined
	if (get_val_col(services, id, service_id, $page_name) <> "")
	{
		$page_title=get_val_col(services, service_name, service_id, $page_name);
		$default_include_file="includes/inc/" . $page_name. ".inc.php";
	}
	elseif( $page_name == 'set_max_results')
	{
		$default_include_file="includes/inc/" . $page_name. ".inc.php";
	}
	elseif( $page_name == 'load_minor_locations')
	{
		$default_include_file="includes/inc/" . $page_name. ".inc.php";
	}	
	else 
	{
		// Load default values
		$page_title="Error!";
		$default_include_file="includes/inc/error.inc.php";
	}
	return $$requested_value;
}



function header_html()

{

    echo '<a href="index.php">

            <div id="logo" class="grid_1">

            </div>

            </a>

<div id="lang" class="grid_3 push_6">

     <p> <!--English | Español-->&nbsp; </p>

</div>   

<div style="margin-left:158px;float-right;" id="menu" class="grid_6 omega">

         <img src="images/menu-bg.png" width="540" height="50" usemap="#menumap" border="0"/>

         

        <map name="menumap">

            <area shape="rect" coords="60,0,130,48" alt="Home" href="index.php" />

            <area shape="rect" coords="190,0,300,48" alt="Learn More" href="#" />

            <area shape="rect" coords="380,0,480,48" alt="Contact" href="contact.php"/>

        </map>

</div>';

}





function admin_header_html()

{

    $admin_html= '<a href="index.php">

            <div id="logo" class="grid_1">

            </div>

            </a>

 



        

<div style="margin-left:160px" id="menu" class="grid_6 omega">

    

         <ul id="map">

        <li><a class="home" href="index.php"></a></li>

        <li><a class="reports" href="core.php?do=donor_reports_payment_history"></a></li>

        

        <li><a class="help" href="core.php?do=help"></a></li>

        

        </ul>

</div>

<div class="clear"></div>

<div style="font-size :12px;color:#284F71" class="status-bar push_4 grid_9">

           Welcome <strong>';	

                        

   $admin_html.= get_val_col("users", "name", "userid", $_SESSION['NF_Username']).'!</strong>  

			<span> You are currently logged in as <b>';

                        

  $admin_html.=  get_val_col("users","user_type","userid",$_SESSION['NF_Username']).'</b>';

  

  $admin_html.= ' |<img src="images/DateButtonRound.png"/> <a href="'.$NF_config['system_uri'].'/new/admin/index.php#myevents">My Events</a> |<a href="index.php?doLogout=true"><img src="images/icon4.png" > Log out</a></div>';

                    

echo $admin_html;

}



function banner_html($banner_class)

{

    echo '<div class="clear"></div>

          <div class="'.$banner_class.' grid_12">

          </div>

          <div class="clear"></div>';

}



function bottom_text_login()

{

    echo '<div class="clear"></div>

            <div class="help-text grid_12 ">

                

<p style="color:#564B4B;font-size:12px" class="grid_6 push_3">

    <img src="images/small_gift.png" height="20px" width="20px"/>'.' ';

    echo $plaintext;

    

    echo '<a href="help/NEW GiveCentral Registration Step-by-Step Guide.pdf" target="_blank" style="color:#4F7096;font-size: 12px">Need help getting started? Click here for a walkthrough</a></p></div>';

}





function bottom_text_html($plaintext,$linkedtext)

{

    echo '<div class="clear"></div>

            <div class="help-text grid_12 ">

                

<p style="color:#564B4B;font-size:12px" class="grid_6 push_3">

    <img src="images/small_gift.png" height="20px" width="20px"/>'.' ';

    echo $plaintext;

    

    echo '<a href="#" style="color:#4F7096;font-size: 12px">';

    

    echo $linkedtext;

    

    echo '</a></p></div>';

}



function footer_html()

{

   echo '<div id="footer">

        <a href="https://www.securitymetrics.com/site_certificate.adp?s=67%2e208%2e39%2e206&amp;i=822334" target="_blank" >

        <div id="footer-img1" class="grid_1 push_1">

        </div>

        </a>

        <div class="grid_6 push_2">

            <a href="../acceptance_use_policy.html" target="_blank">Acceptable use policy </a> ©2012 GiveCentral.org <a href="../privacy_policy.html" target="blank" >Privacy Policy</a>

            

        </div>

        <a href="https://www.securitymetrics.com/site_certificate.adp?s=67%2e208%2e39%2e206&amp;i=822334" target="_blank" >

        <div id="footer-img2" class="grid_1 push_2">

        </div>

        </a>

        </div>';

}

function month_drop_down($drop_name,$mont,$mon)

{

	$mon=array(01=>'Jan',02=>'Feb',03=>'Mar',04=>'Apr',05=>'May',06=>'Jun',07=>'Jul',08=>'Aug',09=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');

	 $month = '<li style="display: inline;"><select id="'.$drop_name.'" name="'.$drop_name.'">';

					foreach($mon as $mon_val => $mon_name )

					{

						

						$mon_val = (string)$mon_val;

						

						if($mont == $mon_val)

						{

							$sel='selected="selected"';

						}

						else

						{

							$sel='';

						}

						

						$month.='<option value="'.$mon_val.'" '.$sel.'>'.$mon_name.'</option>';

					}

				$month.='</select><span class="arrow"></span></li>';

	return $month;

}



function year_drop_down($drop_name,$yr)

{

	 $year = '<li style="display: inline;"><select id="'.$drop_name.'" name="'.$drop_name.'">';

				for($i=1930; $i<=2012; $i2012)

				{

					$year.='<option ';

					

					if($yr==$i)

					{

						$year.='selected="selected"';

					}

					

					$year.='>'.$i.'</option>';

				}

				$year.='</select><span class="arrow"></span></li>';

	return $year;

}



function date_drop_down($drop_name,$date)

{

	 $dates = '<li style="display: inline;"><select id="'.$drop_name.'" name='.$drop_name.'>';

			

			$i=1;

			while($i<=31)

			{

				if($i<10)

				{

					$i='0'.$i;

				}

					

				if($date==$i)

				{

					$sel = 'selected="selected"';

				}

				else

				{

					$sel = '';

				}

				

				$dates.='<option '.$sel.'>'.$i.'</option>';

				$i++;

			}	

				

				$dates.='</select><span class="arrow"></span></li>';

	return $dates;		

}

?>