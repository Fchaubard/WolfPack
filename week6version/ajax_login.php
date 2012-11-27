<?php session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here

$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147rerich', 'dahdiedi');
mysql_select_db('c_cs147_rerich');
/*
if(isset($_SESSION['userName']){

	session_destroy();
	session_start();
}
*/
//select the database | Change the name of database from here
//mysql_select_db('db_ajax'); 


//get the posted values
//$user_name=htmlspecialchars($_POST['username'],ENT_QUOTES);
//$pass=md5($_POST['password']);

$user_name=$_POST['username'];
$pass=$_POST['password'];

//now validating the username and password
$sql="SELECT * FROM users WHERE userName LIKE '$user_name'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

//if username exists
if(mysql_num_rows($result)>0)
{
	//compare the password
	if(strcmp($row['password'],$pass)==0)
	{
		echo "yes";
		//now set the session from here if needed
		$_SESSION['userName']=$user_name; 
	}
	else
		echo "no"; 
}
else
	echo "no"; //Invalid Login


?>