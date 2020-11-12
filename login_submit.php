<?php
session_start();
include "includes/dbconnection.php";


$username = strip_tags($_POST['uName']);
$password = strip_tags($_POST['pass']);

$query = $db->query("SELECT * from accounts where username = '$username' AND password = '$password' ") or die($db->error);
if(!empty($username) || !empty($password)){
    if ($query->num_rows > 0) {

        $userinfo = $query->fetch_assoc();
    
        if ($userinfo['is_verified'] == 0) {
            echo "<script> alert('Your account is not yet verified! Check your email.'); location.href='login.php' </script>";
        } else {
            $db->query("UPDATE accounts set isLoggedIn = 1 where username = '$username' AND password = '$password' ") or die($db->error);
            $_SESSION['logged_in'] = TRUE;
    
            header("Location: index.php");
        }
    } else {
        echo "<script> alert('Incorrect Username / Password!'); location.href='login.php' </script>";
    }
}else{
    echo "<script> alert('You need to enter username and password!'); location.href='login.php' </script>";
}
