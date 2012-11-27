<div data-role="collapsible-set">

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
					echo "<div data-role=\"collapsible\" data-collapsed=\"true\">";
					echo "<h3><img src=\"".$icon."\" height=50 width=50> ".$row["friend"]."</h3>";
					
					echo "</div>";
				}
			}
				
		?>
	
</div>