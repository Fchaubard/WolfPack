<?php session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here


if(file_exists("config.php")){
				include("config.php");
}

//select the database | Change the name of database from here
//mysql_select_db('db_ajax'); 


//get the posted values
//$user_name=htmlspecialchars($_POST['username'],ENT_QUOTES);
//$pass=md5($_POST['password']);

$user_name=$_POST['username_signup'];
$first_name=$_POST['firstName'];
$last_name=$_POST['lastName'];
$email=$_POST['email'];
$icon = "./images/defaultProfileImage.png";
$facebookID = '123';
$user_name=$_POST['username_signup'];
$pass=md5($_POST['password_signup']);
$passconfirm=md5($_POST['passwordconfirm']);

//make sure username is not taken
$sql="SELECT * FROM users WHERE userName LIKE '$user_name'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

//if username doesnt exist and pword == confirm pword
if(strcmp($pass,$passconfirm)==0 )
{
	if(mysql_num_rows($result)==0){
		//$sql="INSERT INTO users VALUES ('$user_name','$user_name','$user_name','$pass','$user_name',0,0,0,0,0,0)";
		$sql = "INSERT INTO users (`userNumber` ,`userName` ,`firstName` ,`lastName` ,`password` ,`email`, `usericon` ,`facebookID` ,`activeSession` ,`hungry` ,`startTime` ,`endTime` ,`groupNumber`) VALUES (NULL ,  '$user_name',  '$first_name',  '$last_name',  '$pass',  '$email', '$icon',  '$facebookID',  '0',  '0',  '0',  '0',  '0')";
	
		$result_insert=mysql_query($sql);
		
		
		$to = $email;
		$subject = "Welcome to the Wolfpack";
		
		$body = "Welcome to the WolfPack ".$first_name." ".$last_name."!!! \nHere is your login info: \n username = ".$user_name."\n password = ".$_POST['password_signup']." \n\nSTANFORD FOOTBALL RULES!";
		
		$headers = 'From: duran@hungrylikethewolves.com' . "\r\n" .
    		'Reply-To: duran@hungrylikethewolves.com' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $body, $headers);		
		
		
		
		
		
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