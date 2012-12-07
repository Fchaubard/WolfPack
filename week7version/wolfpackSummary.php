<?php session_start();
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 

<body> 
<div data-role="page">

	<div data-role="header">
		<h1>Wolfpack Summary! <img src="images/logo_icon_invert.png" height="14px"/></h1>
		<a href="./login.php" data-icon="check" id="logout" data-transition="slide" data-direction="reverse" data-role="button" class="ui-btn-right logout">Logout</a>
		<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>
	
	</div><!-- /header -->

	<div data-role="content">	
	
	<?php	
			// This is a hack. You should connect to a database here.
		if (!isset($_SESSION['userName'])) {
			
			echo "<p> GOSH! Login like a normal person! Like seriously. </p> <a href=\"#\" class=\"logout\" class=\"roll-link\">login</a>";
		}
		else{
	$task = $_POST["task"];
	if($task=="join"){
		$groupId = $_POST["groupId"];
		include("config.php");
		$queryString = "UPDATE users SET groupNumber=".$groupId.", status=1 WHERE userName=\"".$_SESSION['userName']."\"";
		$query = $queryString;
		$result = mysql_query($query)or die(mysql_error());
	}
	if($task=="create"){
		$gn=$_POST["groupName"];
		//echo "Group Name: ".$_POST["groupName"];
		//		echo "<br>";
		$buttonCount = $_POST["buttonCount"];
		//echo $buttonCount;
		//echo "Button Count: ".$buttonCount;
				echo "<br>";
		//echo "Friends Selected:";
		//echo "<br>";
		for($i=1;$i<=$buttonCount;$i++){
			$name = $_POST["name-".$i];
			$value = $_POST["checkbox-".$i];
			if($value=="on"){
				//echo "Name: ".$name;
				//echo "<br>";
			}
		}
				//echo "<br>";
		$loc = $_POST["location"];
		//echo "Location: ".$_POST["location"];
		//		echo "<br>";
		$privacy = 0;
		$input = $_POST["radio-view"];
		if($input=="invite"){
			$privacy = 1;
		}
		if($input=="open"){
			$privacy = 2;
		}
		//echo "O/BIO/C: ";
		//		echo "<br>";
	//			echo $_POST["radio-view"];
//				echo "<br>";
		$time = $_POST["startTime"];
//		echo "Start Time: ".$_POST["startTime"];
		
		//Create the new group:
		include("config.php");
		$un=$_SESSION['userName'];
		$queryString = "INSERT INTO groups (name,location,owner,timeStart,open) VALUES ('".$gn."','".$loc."','".$un."',".$time.",".$privacy.")";
		//echo "<br>";
		//echo $queryString;
		$query = $queryString;
		$result = mysql_query($query)or die(mysql_error());

		
		//Find the current group number:
		$query2 = "SELECT MAX(id) AS id FROM groups";	
		$result = mysql_query($query2)or die(mysql_error());
		while($row = mysql_fetch_array($result)){
			$groupId = $row['id'];
		}	
		
		//Add group number and status of group owner to current session user:
		$query3 = "UPDATE users SET groupNumber=".$groupId.", status=3 WHERE userName=\"".$un."\"";
		$result = mysql_query($query3)or die(mysql_error());
		
		
		//Add group number to the friends  and set status to pending (2):
		for($i=1;$i<=$buttonCount;$i++){
			$name = $_POST["name-".$i];
			$value = $_POST["checkbox-".$i];
			if($value=="on"){
				$friendGroupQuery = "UPDATE users SET groupNumber=".$groupId.", status=2 WHERE userName=\"".$name."\"";
				$result = mysql_query($friendGroupQuery)or die(mysql_error());

			}
		}
		
	}
	?>
	
	<?php
			$query = "SELECT * FROM groups WHERE id=\"".$groupId."\"";
			$result = mysql_query($query)or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				$groupName = $row['name'];
			}
			if(file_exists("./formatting/myGroupList.php")){
				include "./formatting/myGroupList.php";
			}
			?>
			
			<?php
			echo "<form action=\"addPeople.php\" method=\"post\"><input type=\"submit\" value=\"Invite More People!\"/></form>";
		 	echo "<form action=\"mainPage.php\" method=\"post\"><input type=\"hidden\" value=\"leave\" name=\"task\"><input type=\"submit\" value=\"Leave Group!\"/></form>";
			echo "<form action=\"iAmHungryPage.php\" method=\"post\"><input type=\"hidden\" value=\"notHungry\" name=\"task\"><input type=\"submit\" value=\"I'm Not Hungry Anymore!\"/></form>";
		 	?>
 <script type="text/javascript">
		
		$(".logout").click(function() {
			document.location = "login.php";
		});
		$("#logout").click(function() {
			document.location = "login.php";
		});
	</script>
	<?php
		}//close if else
	?>

</div><!-- /content -->

	
	
	
</div><!-- /page -->
</body>
</html>