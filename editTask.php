<?php
session_start();

//logged_in

if (isset($_SESSION['logged_in']) == FALSE) {
    header("Location: login.php");
} else {
    include "includes/dbconnection.php";

    $task_id = strip_tags($_GET['task_id']);
    $editedTask = strip_tags($_GET['editedTask']);
    
    $db->query("UPDATE tasks set content = '$editedTask' where task_id = '$task_id'") or die($db->error);
    header("Location: index.php");
} 