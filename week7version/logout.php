<?php session_start();
ob_start();
session_destroy();

// no redirect
$url12 = 'login.php'; 
header( "Location: $url12" );
ob_flush(); //flush the buffer
?>

