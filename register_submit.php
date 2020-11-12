<?php
include 'includes/dbconnection.php';
include 'register_email.php';

$verfication_code =  uniqid(rand());

$fullname = strip_tags($_POST['fName']);
$email = strip_tags($_POST['email']);
$username = strip_tags($_POST['uName']);
$password = strip_tags($_POST['pass']);
if (!empty($fullname) || !empty($email) || !empty($username) || !empty($password)) {
   $mail->Subject = "REGISTRATION";
   $mail->Body = "<p>Hello $fullname, Click the link below to verify your account</p>"
      . "<br/> <a href='localhost/php/project/confirm.php?vercode=$verfication_code'> VERIFY</a> "; //Content of Message : to set the content of email message
   $mail->AddAddress($email);

   if ($mail->Send() == FALSE) {
      echo "Mailer Error: " . $mail->ErrorInfo;
   } else {
      $db->query("INSERT INTO accounts (username,password,fullname,email_address,verification_code) VALUES ('$username','$password','$fullname','$email','$verfication_code')") or die($db->error);
      header("Location: login.php");
   }
}else{
   echo "<script> alert('Missing fields!'); location.href='login.php' </script>";
}
