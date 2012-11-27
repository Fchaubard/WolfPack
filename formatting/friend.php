<?php session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here

include("../config.php");
$modifier = $_POST["friendName"];
$op = $_POST["option"];
$value = "false";
if($modifier!=null && $modifier!=""){
	$value = "true";
	
}
if($modifier!=null && $modifier!=""){
	if($op=="uf"){
		$query = "DELETE FROM friends WHERE user=\"".$_SESSION['userName']."\" AND friend=\"".$modifier."\"";
		//echo $query;
		//echo "<br>";
		$result = mysql_query($query)or die(mysql_error());
		$query = "DELETE FROM friends WHERE friend=\"".$_SESSION['userName']."\" AND user=\"".$modifier."\"";
		//echo $query;
		//echo "<br>";
		$result = mysql_query($query)or die(mysql_error());
	}
	if($op=="f"){
		$query = "INSERT INTO friends (user, friend) VALUES(\"".$_SESSION['userName']."\",\"".$modifier."\")";
		//echo $query;
		//echo "<br>";
		$result = mysql_query($query)or die(mysql_error());
		$query = "INSERT INTO friends (user, friend) VALUES(\"".$modifier."\",\"".$_SESSION['userName']."\")";
		//echo $query;
		$result = mysql_query($query)or die(mysql_error());
	}
}

$result = array(
	"user_name" => $_SESSION['userName'],
	"friend_name" => $modifier,
	"task" => $op,
	"success" => mysql_affected_rows(),
);
echo json_encode($result);
mysql_close($link);

?>