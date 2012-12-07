<div>
<ul data-role="listview" id="friendsList" data-filter="true">

<style type="text/css">

.friend {
	padding-left: 0px;
	padding-right: 15px;
	padding-top: 0px;
	padding-bottom: 3px;
}

.heightForCell {
	height:60px;
}

.friendName {
	margin-left: -10px;
	margin-top: -7px;
}


</style>
			<?php
			//need to figure out what to do with the friendName thing if this has not been called...
			
			include("config.php");
			$modifier = $_POST["friendName"];
			//echo "Modifier: ".$modifier;
			//echo "<br>";
			$value = "false";
			if($modifier!=null && $modifier!=""){
				$value = "true";
			}
			$op = $_POST["option"];
			//echo "Option: ".$op;
			//echo "<br>";
			if($modifier!=null && $modifier!=""){
				if($op=="uf"){
					$query = "DELETE FROM friends WHERE user=\"".$_SESSION['userName']."\" AND friend=\"".$modifier."\"";
					//echo $query;
					//echo "<br>";
					$result = mysql_query($query)or die(mysql_error());
					$query = "DELETE FROM friends WHERE friend=\"".$_SESSION['userName']."\" AND user=\"".$modifier."\"";
					//echo $query;
					//echo "<br>";
					$result = mysql_query($query)or die(mysql_error());
				}
				if($op=="f"){
					$query = "INSERT INTO friends (user, friend) VALUES(\"".$_SESSION['userName']."\",\"".$modifier."\")";
					//echo $query;
					//echo "<br>";
					$result = mysql_query($query)or die(mysql_error());
					$query = "INSERT INTO friends (user, friend) VALUES(\"".$modifier."\",\"".$_SESSION['userName']."\")";
					//echo $query;
					$result = mysql_query($query)or die(mysql_error());
				}
			}
			$query = "SELECT * FROM users WHERE userName!=\"".$_SESSION['userName']."\"";
			//echo $query;
			$result = mysql_query($query)or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				$currentPerson = $row["userName"];
				$query2 ="SELECT 1 FROM friends WHERE user = \"".$_SESSION['userName']."\" AND friend =\"".$currentPerson."\"";
				$result2 = mysql_query($query2);
				$friend = 0;
				if(mysql_num_rows($result2)){
   					//exists
   					$friend = 1;
				}
				if($row["usericon"] == "")
					{
						$icon2 = "./images/obama.jpeg";
					}
					else
					{
						$icon2 = $row["usericon"];
					}
					$icon = $icon2;
					?>
					<li class="friend heightForCell" data-icon="false">
									<?php
   					echo "<img height=\"60\" width=\"70\" src=\"".$icon."\" >";
   					?>
   					<?php
					echo "<h3 class=\"friendName\">".$currentPerson."</h3>";
					//WHY DOESN'T THIS WORK HERE?????
					//if($friend==1){
						
						//echo "<form action=\"editFriends.php\" method=\"post\"><input type=\"hidden\" value=".$friend." name=\"friendName\"><input type=\"hidden\" value=\"uf\" name=\"option\"><input type=\"submit\" value=\"Unfriend ".$currentPerson."!\"/></form>";

						
					//}
					//else{
					//	echo "<form action=\"editFriends.php\" method=\"post\"><input type=\"hidden\" value=".$friend." name=\"friendName\"><input type=\"hidden\" value=\"f\" name=\"option\"><input type=\"submit\" value=\"Friend ".$currentPerson."!\"/></form>";

					//}
	

		
					?>
							
						 <?php
						 //echo "Friend: ".$friend;
						 if($friend==1){
						 	//echo "Gets to Unfriend";
						 echo "<form action=\"editFriends.php\" method=\"post\"><input type=\"hidden\" value=".$currentPerson." name=\"friendName\"><input type=\"hidden\" value=\"uf\" name=\"option\"><input type=\"submit\" value=\"Unfriend!\"/></form>";
						 }
						 else{
						 	//echo "Gets to Friend";
						 	echo "<form action=\"editFriends.php\" method=\"post\"><input type=\"hidden\" value=".$currentPerson." name=\"friendName\"><input type=\"hidden\" value=\"f\" name=\"option\"><input type=\"submit\" value=\"Friend!\"/></form>";
						 }
						 ?></li>
					<?php
				
			}
			//echo "<br /><form action=\"mainPage.php\" method=\"post\"><input type=\"submit\" value=\"Done\"/></form>";
			echo "<br /><a href=\"mainPage.php\" data-role=\"button\" data-direction=\"reverse\">Done</a>";
		?>
	</ul>
</div>