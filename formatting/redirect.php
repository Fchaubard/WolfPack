<?php session_start();


if(file_exists("config.php")){
				include("config.php");
}
$user_name = $_GET['userName'];

if($user_name!=null){
	
	//now validating the username and password
	$sql="SELECT * FROM users WHERE userName LIKE '$user_name'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	
	//if username exists
	if(mysql_num_rows($result)>0)
	{
		$_SESSION['userName']=$user_name;
		$_SESSION['groupNumber']=$row['groupNumber'];
	}else{
			header('Location: http://hungrylikethewolves.com/login.php');
	}
}
if (!isset($_SESSION['userName'])) {
				
				header('Location: http://hungrylikethewolves.com/login.php');
}
?>

