<?php session_start();
ob_start();
session_destroy();

// no redirect
$url12 = 'http://stanford.edu/~rerich/cgi-bin/CS147/login.php'; 
header( "Location: $url12" );
ob_flush(); //flush the buffer
?>

