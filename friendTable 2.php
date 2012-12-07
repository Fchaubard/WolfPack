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
			include("config.php");
			$query = "SELECT * FROM friends WHERE user=\"".$_SESSION['userName']."\"";
			$result = mysql_query($query)or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				$query2 = "SELECT * FROM users WHERE userName=\"".$row["friend"]."\" AND hungry=1 AND groupNumber=0";
				$result2 = mysql_query($query2)or die(mysql_error());
				while($row2 = mysql_fetch_array($result2)){
					if($row2["usericon"] == "")
					{
						$icon2 = "obama.jpeg";
					}
					else
					{
						$icon2 = $row2["usericon"];
					}
					$icon = "./images/".$icon2;
					
					
					//echo "<div data-role=\"collapsible\" data-collapsed=\"true\">";
					//echo "<h3><img src=\"".$icon."\" height=50 width=50> ".$row["friend"]."</h3>";
					
					
					?>
						
				<li class="friend heightForCell" data-icon="false">
								<?php
							    echo "<a href=\"./wolfpackCreate.php?friend=".$row2["userName"]."\" class=\"friend heightForCell\" data-icon=\"arrow-r\" data-iconpos=\"right\">";
								echo "<img height=\"60\" width=\"70\" src=\"".$icon."\" >";
								echo "<h3 class=\"friendName\">".$row["friend"]."</h3>";
								
				

					
					$startTime = $row2["startTime"];
					$stopTime = $row2["endTime"];
						$timeOfDay = "AM";
						$hour = $startTime/100;
						if($hour>=12 && $hour<24){
							$timeOfDay="PM";
						}
						if($hour==0){
							$hour=12;
						}
						if($hour>=13){
							$hour=$hour-12;
						}
						$minutes = $startTime%100;
						if($minutes==0){
							$minutes = "00";
						}
					$startTimeString=$hour.":".$minutes.$timeOfDay;
						$timeOfDay = "AM";
						$hour = $stopTime/100;
						if($hour>=12 && $hour<24){
							$timeOfDay="PM";
						}
						if($hour==0){
							$hour=12;
						}
						if($hour>=13){
							$hour=$hour-12;
						}
						$minutes = $stopTime%100;
						if($minutes==0){
							$minutes = "00";
						}
					$stopTimeString = $hour.":".$minutes.$timeOfDay;
					
					echo "<p class=\"friendName\">Hungry from: ".$startTimeString." - ".$stopTimeString."</p>";
					echo "<p class=\"friendName\">Distance from you: 3 mi</p>";
					
													?>
						 </a></li>
					
					<?php
				}
			}
				
		?>
	</ul>
</div>