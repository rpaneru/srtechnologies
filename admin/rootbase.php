<?php 
include 'session.php';

include 'includes/functions/functions_html_output.php';
include 'includes/functions/functions_user.php'; 
include('includes/functions/function_access_control.php');
include('includes/functions/functions_cybersource.php');
include page_characters($_GET['do'], "default_include_file");
?>