<div data-role="collapsible-set">

		<?php
			include("config.php");
			$query = "SELECT * FROM friends WHERE user=\"".$_SESSION['userName']."\"";
			$result = mysql_query($query)or die(mysql_error());
			while($row = mysql_fetch_array($result)){
				echo "<div data-role=\"collapsible\" data-collapsed=\"true\">";
				echo "<h3><img src=\"./images/obama.jpeg\" height=50 width=50> ".$row["friend"]."</h3>";
				
				echo "<p>blah, blah, blah...</p>";
				echo "</div>";
			}
				
		?>
	
</div>