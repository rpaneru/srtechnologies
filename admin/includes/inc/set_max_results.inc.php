<?php
$ref = "core.php?" . $_GET['script_request'];
if ($ref == "")
{
	$ref = $NF_config['system_uri'] . "index.php";
}
unset($_SESSION['NF_MAX_RESULTS']);
$_SESSION['NF_MAX_RESULTS'] = get_max_results_per_page($_GET['max_results']);
header("Location: ". $ref); 
exit;
?>