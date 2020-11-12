<?php
session_start();

//logged_in

if (isset($_SESSION['logged_in']) == FALSE) {
    header("Location: login.php");
} else {
    include "includes/dbconnection.php";

    $userid = $_GET['userid'];
    $allowedTypes = ['jpeg', 'jpg', 'png', 'gif'];

    
    $tmp = explode('.', $_FILES['image']['name']);
    $file_extension = end($tmp);
    if (in_array($file_extension, $allowedTypes)) {

        $destination = "img_uploads/";
        $file_name = time() . $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($temp_name, $destination . $file_name);

        $db->query("UPDATE accounts set avatar = '$file_name' where user_id = '$userid'") or die($db->error);

        header("Location: index.php");
    } else {
        echo "<script> alert('No file submitted or not an image!'); location.href='login.php' </script>";
    }
}
