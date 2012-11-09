<?php session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here




$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147rerich', 'dahdiedi');
mysql_select_db('c_cs147_rerich');


//select the database | Change the name of database from here
//mysql_select_db('db_ajax'); 


//get the posted values
//$user_name=htmlspecialchars($_POST['username'],ENT_QUOTES);
//$pass=md5($_POST['password']);

$user_name=$_POST['username'];
$pass=$_POST['password'];
$passconfirm=$_POST['passwordconfirm'];

//make sure username is not taken
$sql="SELECT * FROM users WHERE userName LIKE '$user_name'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

//if username doesnt exist and pword == confirm pword
if(strcmp($pass,$passconfirm)==0 )
{
	if(mysql_num_rows($result)==0){
		//$sql="INSERT INTO users VALUES ('$user_name','$user_name','$user_name','$pass','$user_name',0,0,0,0,0,0)";
		$sql = "INSERT INTO users (`userNumber` ,`userName` ,`firstName` ,`lastName` ,`password` ,`email` ,`facebookID` ,`activeSession` ,`hungry` ,`startTime` ,`endTime` ,`groupNumber`) VALUES (NULL ,  '$user_name',  '$user_name',  '$user_name',  '$pass',  '$user_name',  '12345',  '0',  '0',  '0',  '0',  '0')";
	
		$result_insert=mysql_query($sql);
		if($result_insert){
			
			echo "yes";
			
			//now set the session from here if needed
			$_SESSION['userName']=$user_name; 
		}
		else{
			echo "Error submitting to db";
			//echo $result_insert;
		}
	}
	else{
		echo "Already a user with username ".$user_name;
	}

}
else{
	echo "password and confirm password do not match"; //Invalid Login
}

?>