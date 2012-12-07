<div data-role="collapsible-set">

		<?php
			include("config.php");
			$query = "SELECT * FROM groups";
			$result = mysql_query($query)or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				if($row["open"]==2 && $row["owner"]!=$_SESSION['userName']){
				echo "<div data-role=\"collapsible\" data-collapsed=\"true\">";
				echo "<h3>".$row["name"]."</h3>";
				
				echo "<p>Group Owner: ".$row["owner"]."</p>";
				echo "<p>Location: ".$row["location"]."</p>";
				$timeOfDay = "AM";
						$hour = $stopTime/100;
						if($hour>=12 && $hour<24){
							$timeOfDay="PM";
						}
						if($hour>13){
							$hour=$hour%12;
						}
						$minutes = $stopTime%100;
						if($minutes==0){
							$minutes = "00";
						}
				$startTimeString=$hour.":".$minutes.$timeOfDay;
				echo "<p>Time: ".$startTimeString."</p>";
				
				echo "<form action=\"wolfpackSummary.php\" method=\"post\"><input type=\"hidden\" value=".$row["id"]." name=\"groupId\"><input type=\"hidden\" value=\"join\" name=\"task\"><input type=\"submit\" value=\"Join ".$row["name"]."!\"/></form>";
				
				echo "</div>";
				}
				
			}
				
		?>
	
</div>