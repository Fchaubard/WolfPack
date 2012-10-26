
<?php
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 

<body> 

<div data-role="page">

	<div data-role="header">
	<h1>Log in</h1>
	<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">
	<center><img width=100% src="images/fbicon.png"></center>
	
	<form action="iAmHungryPage.php" method="post">
	<label for="foo">Username:</label>
	<input type="text" name="username" id="foo">
	<label for="bar">Password:</label>
	<input type="password" name="password" id="bar">
        <input type="submit" value="Login">
	</form>
		
	<form action="signup.php" method="get">
		<input type="submit" value="Sign Up for a WolfPack Account">
		
	</form>
	
		<div data-role="fieldcontain">
			
		</div>	
	
		
	<div id="info">
		<p>Thank you for logging. You should be able to see all sorts of user information here.</p>
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