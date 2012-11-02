<?php
ob_start();
session_start();
session_destroy();

// no redirect
$url = 'login.php'; 
header( "Location: $url" );
ob_flush(); //flush the buffer
?>