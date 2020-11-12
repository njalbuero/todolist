<?php
    include "includes/dbconnection.php";
    $db->query("UPDATE accounts set isLoggedIn = 0 where isLoggedIn = 1 ") or die($db->error);
    session_start();
    session_destroy();
    
    header("Location: login.php");
