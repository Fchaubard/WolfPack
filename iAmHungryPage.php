<?php
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 
<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Welcome!</h1>
		<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">	
		
		<?php
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
				
						?>
		
		<?php
		// This is a hack. You should connect to a database here.
		if ($name==1) {
			?>
			<script type="text/javascript">
				// Save the username in local storage. That way you
				// can access it later even if the user closes the app.
				localStorage.setItem('username', '<?=$_POST["username"]?>');
			</script>
			<?php
			echo "<p>Welcome <strong>".$firstName."</strong>!</p>";
			?>
			
			<?php
			if(file_exists("./formatting/timeInputs.php")){
				include "./formatting/timeInputs.php";
			}

			?> 
			
			<?php
		 	echo "<form action=\"mainPage.php\" method=\"post\"><input type=\"submit\" value=\"Join the Hungry!\"/></form>";
		 	
		} else {
			echo "<p>There seems to have been an error.</p>";
		}
			

		?>
	</div><!-- /content -->

	
	
	<script type="text/javascript">
		$("#logout").click(function() {
			localStorage.removeItem('username');
			$("#form").show();
			$("#logout").hide();
		});
	</script>
</div><!-- /page -->

</body>
</html>