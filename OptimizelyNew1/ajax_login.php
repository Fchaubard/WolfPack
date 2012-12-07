<?php session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here


if(file_exists("config.php")){
				include("config.php");
}
/*if(strcmp($_SESSION['userName'],null)==0){

	echo "fish";
	session_destroy();
	session_start();
}*/

//select the database | Change the name of database from here
//mysql_select_db('db_ajax'); 


//get the posted values
//$user_name=htmlspecialchars($_POST['username'],ENT_QUOTES);
//$pass=md5($_POST['password']);

$user_name=$_POST['username'];
$pass=md5($_POST['password']);

//now validating the username and password
$sql="SELECT * FROM users WHERE userName LIKE '$user_name'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

//if username exists
if(mysql_num_rows($result)>0)
{
	//compare the password
	if($row['password']==$pass)
	{
		echo "yes";
		
		$_SESSION['userName']=$user_name; 
		$_SESSION['groupNumber']=$row['groupNumber'];
		//now set the session from here if needed
		if($_SESSION['groupNumber']!=0 && $row['status']!=2){
			$sql="UPDATE users SET hungry='1' WHERE userName LIKE '$user_name'";
			$result=mysql_query($sql);
			echo "1";
		}else{
			$_SESSION['groupNumber']=0;
			echo "2";
		}
			
		
	}
	else{
		
		echo "no"; 
	}
}
else{
	echo "no"; //Invalid Login
}


?>