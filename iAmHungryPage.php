<?php session_start();
if (!isset($_SESSION['userName'])) {
			
			header('Location: http://stanford.edu/~rerich/cgi-bin/CS147/login.php');
}
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 
<body> 
<div data-role="page">

	<div data-role="header">
		<h1>Welcome!</h1>
		<?php 
		
			if(file_exists("./formatting/logout.php")){
				include "./formatting/logout.php";
			}
		
		?> 
	</div><!-- /header -->

	<div data-role="content">	
		
		
		<?php
			$task = $_POST["task"];
			if($task=="notHungry"){
				include("config.php");
				$query = "UPDATE users SET hungry=\"0\", groupNumber=\"0\", status=\"0\" WHERE userName=\"".$_SESSION['userName']."\"";
				echo $query;
				$result = mysql_query($query)or die(mysql_error());
				
			}
		?>
		
		
	
			<script type="text/javascript"> //this isn't doing ANYTHING!!!
				// Save the username in local storage. That way you
				// can access it later even if the user closes the app.
				localStorage.setItem('username', '<?=$_POST["username"]?>');
			</script>
			<?php
			
			echo "<p>Welcome <strong>".$_SESSION['userName']."</strong>!</p>";
			echo "<form action=\"mainPage.php\" method=\"post\">";
			?>
			
			<?php
			if(file_exists("./formatting/timeInputs.php")){
				include "./formatting/timeInputs.php";
			}

			?> 
			
			<?php
		 	echo "<input type=\"hidden\" value=\"justHungry\" name=\"task\"><input type=\"submit\" value=\"Join the Hungry!\"/></form>";
		 	
		 
			

		?>
	</div><!-- /content -->

	
	
</div><!-- /page -->

</body>
</html>