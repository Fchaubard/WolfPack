<?php session_start();


if(file_exists("config.php")){
				include("config.php");
}

// Facebook Stuff
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '210452582423240',
  'secret' => 'e6c1416257d02ed499a5cdbdc31f4a13',
));

// Get User ID
$uid = $facebook->getUser();
if (isset($_SESSION['userName'])) {
	session_destroy();
	$uid = null;
}

// if user is not empty then try adding user info to 
// the database, set the session, and redirect it to iAmHungry.php.
if(!empty($uid)) { 
    # Active session, let's try getting the user id (getUser()) and user info (api->('/me'))  
    try{  
        //$uid = $facebook->getUser();  
        //$user_profile = $facebook->api('/me');
        
        $user_profile = $facebook->api('/me','GET');
        
        // try pulling this User from MySQL
        
		$sql="SELECT * FROM users WHERE facebookID LIKE '$uid'";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		
		// check if we have that user already
		if(mysql_num_rows($result)>0)
		{
			//set Session username
			$_SESSION['userName']=$row['userName'];
			$_SESSION['groupNumber']=$row['groupNumber'];
			//redirect to 
			
		}else{
			$userName =$user_profile['first_name'].$user_profile['last_name'];
			$firstName =$user_profile['first_name'];
			$lastName =$user_profile['last_name'];
			$password = md5($user_profile['last_name']);
			$pass = $user_profile['last_name'];
			$email =$user_profile['email'];
			$facebookID = $user_profile['id'];
			$userIcon = "http://graph.facebook.com/".$user_profile['id']."/picture";
			
			//sign this person up!
			$sql = "INSERT INTO users (`userNumber` ,`userName` ,`firstName` ,`lastName` ,`password` ,`email` ,`facebookID`  ,`usericon`,  `activeSession` ,`hungry` ,`startTime` ,`endTime` ,`groupNumber`) VALUES (NULL ,'$userName',  '$firstName',  '$lastName',  '$password',  '$email',  '$facebookID', '$userIcon',  '0',  '0',  '0',  '0',  '0')";
	
			$result_insert=mysql_query($sql);
			
			
			
			$to = $email;
			$subject = "Welcome to the Wolfpack";
			
			$body = "Welcome to the WolfPack ".$firstName." ".$lastName."!!! \nHere is your login info: \n username = ".$userName."\n password = ".$pass." \n\nSTANFORD FOOTBALL RULES!";
			
			$headers = 'From: duran@hungrylikethewolves.com' . "\r\n" .
    		'Reply-To: duran@hungrylikethewolves.com' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();

			mail($to, $subject, $body, $headers);
				
			
			if($result_insert){
				
				//now set the session from here if needed
				$_SESSION['userName']=$userName; 
				// save the image off
				//$img = file_get_contents('https://graph.facebook.com/'.$fid.'/picture');
				//$file = dirname(__file__).'/images/'.$fid.'.jpg';
				//$file = '/images/'.$fid.'.jpg';
				//file_put_contents($file, $img);
				
			}
			else{
				echo $sql;
				echo $result_insert;
				die("There was an error submitting."); 
				//echo $result_insert;
			}
		
			
		}
		
        header("Location: http://hungrylikethewolves.com/iAmHungryPage.php");  
    } catch (Exception $e){
    	//die("There was an error here.".$e); 
    	# There's no active session, let's generate one  
    	$user_profile = null;
    	$uid = null;
    	$perms = array('scope' => 'email');
    	$login_url_no_active_session = $facebook->getLoginUrl($perms);  
       	}  
     
} 
else {  
    # There's no active session, let's generate one  
    $login_url_no_active_session = $facebook->getLoginUrl(array(
		'redirect_uri'	=> 'http://hungrylikethewolves.com/login.php' // URL to redirect the user to once the login/authorization process is complete.
		)); 
     
}  
 
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}
?>
<style type="text/css">
  body.connected #login { display: none; }
  body.connected #logout { display: block; }
  body.not_connected #login { display: block; }
  body.not_connected #logout { display: none; }
      
h1 {color: white}
.buttondiv {
margin-top: 10px;
}
.messagebox{
	border:1px solid #c93;
	background:#ffc;
	padding:3px;
}
.messageboxok{
	border:1px solid #349534;
	background:#C9FFCA;
	padding:3px;
	font-weight:bold;
	color:#008000;
	
}
.messageboxerror{
	border:1px solid #CC0000;
	background:#F7CBCA;
	padding:3px;
	font-weight:bold;
	color:#CC0000;
}

</style>
<body> 

<div data-role="page">

<script src="jquery/jquery.js" type="text/javascript" language="javascript"></script>

<script language="javascript" type="text/javascript">
//  Developed by Roshan Bhattarai
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

$(document).ready(function()
{
	console.log(localStorage.getItem('url_name'));
	console.log(localStorage.getItem('userName'));
	
	if(localStorage.getItem('userName')!=null)
	{
		//alert(localStorage.getItem('url_name'));
		document.location = localStorage.getItem('url_name');
	}
	
	$(".login_form").submit(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ajax_login.php",{ username:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='yes1' || data=='yes2') //if correct login detail
		  {
		  	
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Logging in.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	
			  	if(data=='yes1'){
			  		document.location='wolfpackSummary.php';
			  	}else{
			  	
				 	document.location='iAmHungryPage.php'; //need to modify this to transition correctly if already hungry...
			  	}
				 //$.mobile.changePage( "iAmHungryPage.php", {
				//					    type: "post",
				//					    data: $("form#login_form1").serialize()
				//					});
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('No soup for you. Remember its cap sensitive!').addClass('messageboxerror').fadeTo(5,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
	});
	//now call the ajax also focus move from 
	/*$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});
	*/
});

     
</script>


	<div data-role="header">
	<h1>Wolfpack! <img src="images/logo_icon_invert.png" height="14px"/></h1>
	<meta name="viewport" content="initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
	</div><!-- /header -->

	<div data-role="content">
	
		<!--<center><!--<img width=100% src="images/fbicon.png"></center>-->
	<center><img src="images/logo_welcome.png" width=100%></center>
	
	<form action="" method="post" class="login_form" id="login_form1">
	<label for="foo">Username:</label>
	<input type="text" name="username" id="username">
	<label for="bar">Password:</label>
	<input type="password" name="password" id="password">
	<div id="info">
	<span id="msgbox" style="display:none"></span>
	<!--<p>Thank you for logging. You should be able to see all sorts of user information here.</p>-->
	</div>	
    <input type="submit" id="submit" value="Login">
    
	</form>
	<div id="fb-root"></div>
	<div id="user-info"></div>
	<script>
	
//facebook crap

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '210452582423240', // App ID
      //channelUrl : 'http://stanford.edu/~rerich/cgi-bin/CS147/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true,  // parse XFBML
        oauth: true
    });

    FB.Event.subscribe('auth.statusChange', handleStatusChange);
  };

function handleStatusChange(response) {
      //document.body.className = response.authResponse ? 'connected' : 'not_connected';
      if (response.authResponse) {
        console.log(response);

        updateUserInfo(response);
      }
    }
  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   
   
 	function loginUser() {    
     	FB.login(function(response) { }, {scope:'email'});     
    }
     

	(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=210452582423240";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		
		function handleResponseChange(response) {
		   alert(response);
		   
		   if (response.authResponse) {
		     console.log(response);
		      updateUserInfo(response);
		   }
		 }
		 
		 function updateUserInfo(response) {
		 	
		     FB.api('/me', function(response) {
		       document.getElementById('user-info').innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
		     });
		   }
	</script>
	<?php
	if(isset($login_url_no_active_session)){
		echo "<div id=\"login\">";
	   		
	   	//echo	"<div class=\"fb-login-button\" data-show-faces=\"true\" registration-url=\"http://stanford.edu/~rerich/cgi-bin/CS147/iAmHungryPage.php\" data-width=\"300\" size=\"xlarge\" data-max-rows=\"1\"></div>";
	   	
	   	//echo	"<div class=\"fb-login-button\" data-show-faces=\"true\" data-width=\"300\" size=\"xlarge\" data-max-rows=\"1\"></div>";
	   	//echo    "<p><button onClick=\"loginUser();\">Login with FB</button></p>";
	   	echo 'Or <a href="' . $login_url_no_active_session . '">Login with Facebook.</a>';
		echo	"</div>";
		
	}else{
		
		echo "<div id=\"logout\">";
	   	echo "<p><button  onClick=\"FB.logout();\">Logout</button></p>";
		echo "</div>";
	
	}
	?>
	<h3> What is WolfPack?</h3>
	<p> No one likes eating alone. So stop! And join or create a Wolfpack with friends! With WolfPack you can set your status to "Hungry" and wait for a friend to add you to their "WolfPack" to go eat. Or if you are extra hungry you can create your own WolfPack and invite your friends!</p>
	
	<a href="signup.php" data-role="button"> Sign Up for a Wolfpack Account</a>
	
	</div>	
	<div data-role="fieldcontain">
		
	</div>	
		
	
	
	<div data-role="fieldcontain">
		
	</div>	
	
		

	</div><!-- /content -->

	<!-- No Footer
	-->
	
	<script type="text/javascript">
	$("#logout").hide();
	$("#info").hide();
	var retrievedObject = localStorage.getItem('username');
	if (retrievedObject == "test") {
		$("#form").hide();	
		$("#logout").show();
		$("#info").show();
	}
	$("#logout").click(function() {
		localStorage.removeItem('username');
		$("#form").show();
		$("#logout").hide();
		$("#info").hide();
	});
	</script>
</div><!-- /page -->

</body>
</html>