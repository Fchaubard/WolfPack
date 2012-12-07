<div data-role="collapsible-set">

		<?php
			include("config.php");
			$query = "SELECT * FROM groups";
			$result = mysql_query($query)or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				if($row["open"]==1){
				echo "<div data-role=\"collapsible\" data-collapsed=\"true\">";
				echo "<h3>".$row["name"]."</h3>";
				
				echo "<p>Group Owner: ".$row["owner"]."</p>";
				echo "<p>Location: ".$row["location"]."</p>";
				
				echo "<form action=\"mainPage.php\" method=\"post\"><input type=\"hidden\" value=".$row["id"]."><input type=\"submit\" value=\"Join ".$row["name"]."!\"/></form>";
				
				echo "</div>";
				}
				
			}
				
		?>
	
</div>