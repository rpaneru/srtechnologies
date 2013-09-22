<?php


if (!function_exists("check_email_address")) {
function check_email_address($email) {

   // First, we check that there's one @ symbol, and that the lengths are right

   if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {

   // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.

   return false;

   }

   // Split it into sections to make life easier

   $email_array = explode("@", $email);

   $local_array = explode(".", $email_array[0]);

   for ($i = 0; $i < sizeof($local_array); $i++) {

   if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {

   return false;

   }

   }

   if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name

   $domain_array = explode(".", $email_array[1]);

   if (sizeof($domain_array) < 2) {

   return false; // Not enough parts to domain

   }

   for ($i = 0; $i < sizeof($domain_array); $i++) {

   if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {

   return false;

   }

   }

   }

   return true;


}
}






if (!function_exists("send_email")) {
function send_email($from, $to, $subject, $email_body)

{require("includes/libraries/class.phpmailer.php");

 $mail = new PHPMailer();

 $mail->SetLanguage('en','admin/includes/libraries/language/'); 

//$mail->IsSMTP();    

//$mail->SMTPAuth      = true;                  // enable SMTP authentication

//$mail->SMTPKeepAlive = true;          

$mail->Host = "relay-hosting.secureserver.net";  

$mail->Port = 25;  

$mail->Username = "";  

$mail->Password = ""; 



$mail->From = "beta-testing@givecentral.com";

$mail->FromName = $from;

//$mail->AddReplyTo($from_mail,$from);

$mail->IsHTML(true); 

$mail->Subject = $subject;

$mail->AddAddress($to);

$mail->Body = $email_body;

if($mail->Send())

{

  $result=1;

}

$mail->ClearAddresses();

return $result;

}
}








if (!function_exists("send_bulk_mail")) {

function send_bulk_mail($from,$subject,$from_mail,$message,$rsnf)

{

require("includes/libraries/class.phpmailer.php");

$mail = new PHPMailer();

$mail->SetLanguage('en','admin/includes/libraries/language/'); 

//$mail->IsSMTP();    

//$mail->SMTPAuth      = true;                  // enable SMTP authentication

//$mail->SMTPKeepAlive = true;          

$mail->Host = "smtp.gmail.com";  

$mail->Port = 465;  

$mail->Username = "admin@givecentral.org";  

$mail->Password = "Admin123"; 



$mail->From = "admin@givecentral.org";

$mail->FromName = $from;

$mail->AddReplyTo($from_mail,$from);

$mail->IsHTML(true); 

$mail->Subject = $subject;

while($row_rsnf = mysql_fetch_assoc($rsnf))

{$mail->AddAddress($row_rsnf['email']);

$mail->Body = $message;

$mail->AltBody = strip_tags($message);

//echo $row_rsnf['email'];

if($mail->Send())

{

  $result=1;

}

else

{

} 

$mail->ClearAddresses();



}

return $result;

}
}






if (!function_exists("send_smtp_email")) {

function send_smtp_email($from, $to, $subject, $email_body, $attachment)

{

	

require("includes/libraries/class.phpmailer.php");



$mail = new PHPMailer(true);

try

{

$mail->IsSMTP();    

$mail->SMTPDebug  = 2;            

$mail->Host = "ssl://smtp.gmail.com";  

$mail->Port = 465;  

$mail->SMTPAuth = true;  

$mail->Username = "givecentral@myworkforce.org";  

$mail->Password = "newuserGC"; 



$mail->From = "beta-testing@givecentral.com";

$mail->FromName = $from;

$mail->AddAddress($to);

$mail->AddReplyTo("info@givecentral.com", "Give central");

if ($attachment <> ""){

if (is_array($attachment)){

for($i=0; $i < count($attachment);$i++)

        {

$mail->AddAttachment($attachment[$i]); 		



		}

} else {

$mail->AddAttachment($attachment); 

}

}

$mail->IsHTML(true); 



$mail->Subject = $subject;

$mail->Body    = $email_body;

$mail->AltBody = strip_tags($email_body);



$mail->Send();

echo "Message Sent OK\n";

}

catch (phpmailerException $e) 

{

echo $e->errorMessage(); //Pretty error messages from PHPMailer

}

catch (Exception $e)

{

echo $e->getMessage(); //Boring error messages from anything else!

}

}
}




if (!function_exists("send_smtp_email_new")) {
function send_smtp_email_new($username, $password, $host, $port, $from_name, $from_email, $to, $subject, $email_body, $attachment, $reply_to = false)

{



include_once("class.phpmailer.php");



$mail = new PHPMailer();



$mail->IsSMTP();            

$mail->Host = $host;  

$mail->Port = $port;  

$mail->SMTPAuth = true;    

$mail->SMTPSecure = "ssl";

$mail->Username = $username;  

$mail->Password = $password; 



$mail->From = $from_email;

$mail->FromName = $from_name;

if (is_array($to)){

for($i=0; $i < count($to);$i++)

{

$mail->AddAddress($to[$i]);

}

} else {

$mail->AddAddress($to);

}

if ($reply_to <> ""){

$mail->AddReplyTo($reply_to, "GiveCentral.org");

}

if ($attachment <> ""){

if (is_array($attachment)){

for($i=0; $i < count($attachment);$i++)

        {

$mail->AddAttachment($attachment[$i]); 		



		}

} else {

$mail->AddAttachment($attachment); 

}

}

$mail->IsHTML(true); 



$mail->Subject = stripslashes($subject);

$mail->Body    = stripslashes($email_body);

$mail->AltBody = strip_tags($email_body);



if(!$mail->Send())

{

  return $mail->ErrorInfo;

} else {

	return "1";

}

}



}

?>