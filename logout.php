<?php


session_start();

$_SESSION['uid'];
$_SESSION['username'];
$_SESSION['fname'];
$_SESSION['lname'];
$_SESSION['email'];
$_SESSION['phone'];


session_destroy();


header('Location: login.php');
?>