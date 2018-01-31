<?php 
session_start();
$name= $_SESSION['sess_name'];
$password= $_SESSION['sess_pwdd'];
session_destroy('$name');
$_SESSION = array();
header('Location: login.php');
exit;
?>