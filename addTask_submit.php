<?php
session_start();

//logged_in

if (isset($_SESSION['logged_in']) == FALSE) {
    header("Location: login.php");
} else {
    include "includes/dbconnection.php";
    if(!empty($_POST['task'])){
        $task = strip_tags($_POST['task']);
        $db->query("INSERT INTO tasks (content) VALUES('$task')") or die($db->error);
        header("Location: index.php");
    }else{
        echo "<script>alert('You need to write something!'); location.href='login.php'</script>";
    }
   
}