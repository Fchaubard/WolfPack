<?php
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 

<script src="jquery/jquery.js" type="text/javascript" language="javascript"></script>
<script language="javascript">
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

$(document).ready(function()
{
	$("#signup_form").submit(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("ajax_signup.php",{ username:$('#username').val(),password:$('#password').val(),passwordconfirm:$('#passwordconfirm').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Signing up.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='iAmHungryPage.php';
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html(data).addClass('messageboxerror').fadeTo(5,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
	});
	//now call the ajax also focus move from 
	/*$("#passwordconfirm").blur(function()
	{
		$("#signup_form").trigger('submit');
	});*/
});
</script>
<style type="text/css">

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

	<div data-role="header">
	<h1>Log in</h1>
	<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">
	
	<form action="" method="post" id="signup_form">
	<label for="foo">Username:</label>
	<input type="text" name="username" id="username">
	<label for="bar">Password:</label>
	<input type="password" name="password" id="password">
    <label for="bar">Confirm Password:</label>
	<input type="password" name="passwordconfirm" id="passwordconfirm">
	<div id="info">
	<span id="msgbox" style="display:none"></span>
	</div>	
    <input type="submit" id="submit" value="Sign Up">
	</form>
	<div data-role="fieldcontain">
		
	</div>	
	
		
	
	</div><!-- /content -->

	<!-- No Footer
		<?php include("footer_menu.php") ?>
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