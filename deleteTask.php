<?php
session_start();

//logged_in

if (isset($_SESSION['logged_in']) == FALSE) {
    header("Location: login.php");
} else {
    include "includes/dbconnection.php";

    $task_id = $_GET['task_id'];
    $db->query("DELETE FROM tasks where task_id = '$task_id'") or die($db->error);
    header("Location: index.php");
}