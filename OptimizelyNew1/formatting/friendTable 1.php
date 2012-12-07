<div data-role="collapsible-set">
<ul data-role="listview" class="ui-listview">
			<?php
			include("config.php");
			$query = "SELECT * FROM friends WHERE user=\"".$_SESSION['userName']."\"";
			$result = mysql_query($query)or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				$query2 = "SELECT * FROM users WHERE userName=\"".$row["friend"]."\" AND hungry=1";
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
						
				<li data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-li-has-thumb ui-btn-up-c">
					<div class="ui-btn-inner ui-li">
						<div class="ui-btn-text">
							<a href="index.html" class="ui-link-inherit">
								<?php
								
								echo "<img src=\"./images/".$icon."\" class=\"ui-li-thumb\">";
								echo "<h3 class=\"ui-li-heading\">".$row["friend"]."</h3>";
								echo "<p class=\"ui-li-desc\">".$row["friend"]."</p>";
				
								?>
								</a>
							</div>
						<span class="ui-icon ui-icon-arrow-r ui-icon-shadow">&nbsp;</span>
					</div>
				</li>
					
					<?php
					
					$startTime = $row2["startTime"];
					$stopTime = $row2["endTime"];
						$timeOfDay = "AM";
						$hour = $startTime/100;
						if($hour>=12 && $hour<24){
							$timeOfDay="PM";
						}
						if($hour>=13){
							$hour=$hour%12;
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
						if($hour>13){
							$hour=$hour%12;
						}
						$minutes = $stopTime%100;
						if($minutes==0){
							$minutes = "00";
						}
					$stopTimeString = $hour.":".$minutes.$timeOfDay;
					
					
					echo "<p>Available from: ".$startTimeString." - ".$stopTimeString."</p>";
					echo "</div>";
				}
			}
				
		?>
	</ul>
</div>