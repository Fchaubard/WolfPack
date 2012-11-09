<?php session_start();

if (isset($_SESSION['userName'])) {
	session_destroy();
}

if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 
<style type="text/css">
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
	
	$(".login_form").submit(function()
	{
		
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ajax_login.php",{ username:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Logging in.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='iAmHungryPage.php';
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
			  $(this).html('No soup for you').addClass('messageboxerror').fadeTo(5,1);
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
	
	<a href="signup.php" data-role="button"> Sign Up for a Wolfpack Account</a>
		
	
	
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