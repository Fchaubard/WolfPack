<?php
	console.log("Comments Post Reached");
	$text = $_POST['text'];
	include("config.php");
	$sender = $_SESSION['userName'];
	$groupId = $_SESSION["groupId'];
	$date = date('Y-m-d*H:i:s');
	$query = "INSERT INTO chat (sender, groupId, text, dateSent) VALUES (\"".$sender."\",".$groupId.",\"".$text."\",\"".$date."\")";
	$result = mysql_query($query)or die(mysql_error());
	myql_close($link); //Close DB connection

?>