<?php session_start();
if(file_exists("./formatting/redirect.php")){
    include "./formatting/redirect.php";
}
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 
<body> 
<div data-role="page">
	<div id="testHeader" data-role="header" data-position="fixed">
	<!--<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>-->
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
				//echo $query;
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
			
			include("config.php");
			$queryForAdd = "SELECT * FROM users WHERE userName=\"".$_SESSION['userName']."\"";
		 	$result = mysql_query($queryForAdd)or die(mysql_error());
		 	while($row = mysql_fetch_array($result)){
        		$icon = $row['usericon'];
    		}
    		
			echo "<img src=\"".$icon."\">";
			
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

		<?php
		if(file_exists("./formatting/footer.php"))
		{
			include "./formatting/footer.php";
		}
	?>
	
</div><!-- /page -->

</body>
</html>