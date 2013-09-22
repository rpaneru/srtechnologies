<div align="center">
	<div class="block-start" style="width:500px">
    	<div class="cap-div">
        	<div class="cap-left">
            	<div class="cap-right">Alert!</div>
			</div>
		</div>
        
        <table class="tablebg alertdiv" width="100%" cellspacing="0">
			<tr>
				<td style="padding:10px" align="center">
				<?php
				if ($type == "error")
				{
					echo "<img class='notify' src='images/errormessage.gif' align='absmiddle'> &nbsp; $message";
				}
				elseif ($type == "announce")
				{
					echo "<img class='notify' src='images/tick.gif' align='absmiddle'> &nbsp; $message";
				}
				elseif ($type == "warning")
				{
					echo "<img class='notify' src='images/warning.gif' align='absmiddle'> &nbsp; $message";
				}
				if ($notifier == "MySQL")
				{
					echo "<img class='notify' src='images/errormessage.gif' align='absmiddle'> &nbsp; <strong>Error!</strong> MySQL said: $cath_errror";
				}
				?>
                </td>
            </tr>
        </table>
        <div class="block-end-left">
            <div class="block-end-right">
            </div>
        </div>
	</div>
	<br /><br /><br /><br /><br />
</div>