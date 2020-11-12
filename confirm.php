<?php

include 'includes/dbconnection.php';

$vcode = $_GET['vercode'];

$db->query("UPDATE accounts set is_verified = 1 where verification_code = '$vcode' ") or die($db->error);
header("Location: login.php");