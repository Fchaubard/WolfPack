<?php session_start();
if(file_exists("./formatting/redirect.php")){
    include "./formatting/redirect.php";
}
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
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
			if($uid>1){
			echo "<img src=\"https://graph.facebook.com/".$uid."/picture\">";
			}
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