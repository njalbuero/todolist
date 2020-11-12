<?php
include "phpmailer/PHPMailerAutoload.php";

$gmailUsername = "onsitevanessa@gmail.com";
$gmailPassword = "vanessa8497";


//////////////////////////////////////
$mail = new PHPMailer(); 
$mail->IsSMTP(); 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'ssl'; // 
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587 26
$mail->IsHTML(true);
$mail->Username = $gmailUsername;
$mail->Password = $gmailPassword;
/////////////////////////////////////



$mail->SetFrom($gmailUsername,"TodoList");


 
 
?>
