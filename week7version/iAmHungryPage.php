<?php session_start();

if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 
<body> 
<div data-role="page">

	<div data-role="header">
		<h1>Welcome!</h1>
		<a href="#" data-icon="check" id="logout" data-transition="slide" data-direction="reverse" data-role="button" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">	
		
		
		<?php
			$task = $_POST["task"];
			if($task=="notHungry"){
				include("config.php");
				$query = "UPDATE users SET hungry=\"0\", groupNumber=\"0\", status=\"0\" WHERE userName=\"".$_SESSION['userName']."\"";
				//echo $query;
				$result = mysql_query($query)or die(mysql_error());
				
			}
		?>
		
		<?php
		/*
			$name = 0;
			include("config.php");
			$un_name = $_POST["username"];
			$query = "SELECT * FROM users WHERE userName LIKE '$un_name'";
			$result = mysql_query($query)or die(mysql_error());
			$row = mysql_fetch_array($result);
			if($row["password"] == $_POST["password"]){
				$name=1;
				$firstName = $row["firstName"];
				$lastName = $row["lastName"];
			}
				
				*/
						?>
		
		<?php
		// This is a hack. You should connect to a database here.
		if (!isset($_SESSION['userName'])) {
			
			echo "<p> GOSH! Login like a normal person! Like seriously. </p> <a href=\"#\" class=\"logout\" class=\"roll-link\">login</a>";
		}
		else{
			
			?>
			<script type="text/javascript">
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
		 	
		}  
			

		?>
	</div><!-- /content -->

	
	
	<script type="text/javascript">
		$(".logout").click(function() {
			document.location = "login.php";
		});
		$("#logout").click(function() {
			document.location = "login.php";
		});
	</script>
</div><!-- /page -->

</body>
</html>