<div class="friendsListContainer" id="friendsListContainer">

			<?php
			echo "<a href=\"mainPage.php\" class=\"friendButtonDone\" data-role=\"button\" data-direction=\"reverse\">Done</a>";
			echo "<br/>";
			?>
			
<ul data-role="listview" id="friendsList" data-filter="true">
			<?php
			//need to figure out what to do with the friendName thing if this has not been called...
			if(file_exists("config.php")){
				include("config.php");
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
						$icon2 = "./images/defaultProfileImage.png";
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
						 echo "<button class=\"friendButton\" onclick=\"addRemoveFriend('$currentPerson', 'uf')\">Unfriend</button>";
						 }
						 else{
						 	//echo "Gets to Friend";
						 	echo "<button class=\"friendButton\" onclick=\"addRemoveFriend('$currentPerson', 'f')\">Friend</button>";
						 }
						 ?></li>
					<?php
				
			}
			mysql_close($link);
		?>
	</ul>
</div>