<?php 

session_start();
session_unset();
setcookie("PHPSESSID", 'any', time() - 3600, '/');
session_destroy();
header("location:login.php");
exit;