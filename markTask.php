<?php
session_start();

//logged_in

if (isset($_SESSION['logged_in']) == FALSE) {
    header("Location: login.php");
} else {
    include "includes/dbconnection.php";

    $task_id = strip_tags($_GET['task_id']);
    $checkThis = strip_tags($_GET['checkThis']);
    echo($checkThis);
    if ($checkThis=="true") {
        echo("1");
        $db->query("UPDATE tasks set isDone = 1 where task_id = '$task_id'") or die($db->error);
    }elseif($checkThis=="false"){
        echo("0");
        $db->query("UPDATE tasks set isDone = 0 where task_id = '$task_id'") or die($db->error);
    }
    header("Location: index.php");
}
