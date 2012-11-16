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
<h1>Wolfpack Summary! <img src="images/logo_icon_invert.png" height="14px"/></h1>
<?php 

	if(file_exists("./formatting/logout.php")){
		include "./formatting/logout.php";
	}

?> 
<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>

</div><!-- /header -->

<div data-role="content">


		<?php
        include("config.php");
        if (isset($_POST["task"])){
			$task = $_POST["task"];
			$groupId = $_POST["groupId"];
		}else{
			$task = 1;
			$groupId = $_SESSION["groupNumber"];
		
		}
        
		if($task=="join"){ //Joining an existing open group:
			//$groupId = $_POST["groupId"];
			
			try{
			$queryString = "UPDATE users SET groupNumber=".$groupId.", status=1 WHERE userName=\"".$_SESSION['userName']."\"";
			$result = mysql_query($queryString)or die(mysql_error());
			}catch(Exception $e){
				echo 'Message: ' .$e->getMessage();
			}
		}
		if($task=="acceptInvitation"){
			$queryString = "UPDATE users SET groupNumber=".$groupId.", status=1 WHERE userName=\"".$_SESSION['userName']."\"";
			$result = mysql_query($queryString)or die(mysql_error());			
		}
		if($task=="create"){ //Creating a new group:
			$gn=$_POST["groupName"];
			$buttonCount = $_POST["buttonCount"];
			$loc = $_POST["location"];
			$privacy = 0;
			$input = $_POST["radio-view"];
			$time = $_POST["startTimeWPCreate"];
			
			//Create the new group:
				$un=$_SESSION['userName'];
				$queryString = "INSERT INTO groups (name,location,owner,timeStart,open) VALUES ('".$gn."','".$loc."','".$un."',".$time.",".$privacy.")";
				$query = $queryString;
				$result = mysql_query($query)or die(mysql_error());
            
			
			//Find the current group number:
				$query2 = "SELECT MAX(id) AS id FROM groups";
				$result = mysql_query($query2)or die(mysql_error());
				while($row = mysql_fetch_array($result)){
					$groupId = $row['id'];
				}
	
			
			//Add group number and status of group owner to current session user:
				$query3 = "UPDATE users SET groupNumber=".$groupId.", status=3 WHERE userName=\"".$un."\"";		$result = mysql_query($query3)or die(mysql_error());
			
			
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
		if($task=="banana"){ //Add more to group:
			$queryForAdd = "SELECT * FROM users WHERE userName=\"".$_SESSION['userName']."\"";
		 	$result = mysql_query($queryForAdd)or die(mysql_error());
		 	while($row = mysql_fetch_array($result)){
        		$groupId = $row['groupNumber'];
    		}
    		//echo "Group Id: ".$groupId;
    		//echo "<br>";
			$buttonCount = $_POST["buttonCount"];
    		//echo "Button Count: ".$buttonCount;
    		//echo "<br>";
    		for($i=1;$i<=$buttonCount;$i++){
    			//echo "Here we are again…";
    			//echo "<br>";
    			//echo "Value: ".$value;
    			//echo "<br>";
				$name = $_POST["name-".$i];
				//echo "Name: ".$name;
				//echo "<br>";
				$value = $_POST["checkbox-".$i];
				//echo "Value: ".$value;
				//echo "<br>";
				if($value=="on"){
					$friendGroupQuery = "UPDATE users SET groupNumber=".$groupId.", status=2 WHERE userName=\"".$name."\"";
					//echo "Friend Group Query: ".$friendGroupQuery;
					//echo "<br>";
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
    echo "<form action=\"addMoreFriends.php\" method=\"post\"><input type=\"submit\" onclick=\"eSource2.close();\" value=\"Invite More People!\"/></form>";
    echo "<form action=\"mainPage.php\" method=\"post\"><input type=\"hidden\" value=\"leave\" name=\"task\"><input type=\"submit\" onclick=\"eSource2.close();\" value=\"Leave Group!\"/></form>";
    echo "<form action=\"iAmHungryPage.php\" method=\"post\"><input type=\"hidden\" value=\"notHungry\" name=\"task\"><input type=\"submit\" onclick=\"eSource2.close();\" value=\"I'm Not Hungry Anymore!\"/></form>";
    ?>
<script type="text/javascript">

$(".logout").click(function() {
                   document.location = "login.php";
                   });
$("#logout").click(function() {
                   document.location = "login.php";
                   });
</script>


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