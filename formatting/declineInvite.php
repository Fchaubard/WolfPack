<?php
//Goal is to just update the database to have:
// groupNumber=0
// status=0
$userName = $_GET["user"];
echo "User Name: ".$userName;

include("../config.php");
$queryString = "UPDATE users SET groupNumber=0, status=0 WHERE userName=\"".$userName."\"";
echo "Query String: ".$queryString;
$result = mysql_query($queryString)or die(mysql_error());

echo "Im done!";
mysql_close($link);
?>