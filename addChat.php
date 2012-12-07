<?php session_start();
if(file_exists("./formatting/redirect.php")){
    include "./formatting/redirect.php";
}

if(file_exists("./formatting/header.php")){
    include "./formatting/header.php";
}

?>



<?php
//^^Not sure if above stuff needs to be there...

include("config.php");
$text = $_GET["text"];
$gid = $_GET["gid"];
$date = date('Y-m-d*H:i:s');
$un = $_SESSION['userName'];

echo "Text: ".$text."<br/>";
echo "Group: ".$gid."<br/>";
echo "User: ".$un."<br/>";

$query = "INSERT INTO chat (sender, groupId, text, dateSent) VALUES (\"".$un."\",".$gid.",\"".$text."\",\"".$date."\")";
$result = mysql_query($query)or die(mysql_error());
mysql_close($link); //Close DB connection

?>