
<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<fieldset data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-vertical"><div role="heading" class="ui-controlgroup-label">Choose the hungry friends you want to eat with:</div><div class="ui-controlgroup-controls">
			 	
			 	
			 	<?php
					include("config.php");
					$query = "SELECT * FROM friends WHERE user=\"".$_SESSION['userName']."\"";
					$result = mysql_query($query)or die(mysql_error());
					$button_count = 0;
					while($row = mysql_fetch_array($result))
					{
								$button_count++;
								echo "<div class=\"ui-checkbox\"><input type=\"checkbox\" name=\"checkbox-1a\" id=\"checkbox-$button_count\" class=\"custom\"><label for=\"checkbox-$button_count\" data-theme=\"c\" class=\"ui-btn ui-btn-icon-left ui-corner-top ui-checkbox-off ui-btn-up-c\"><span class=\"ui-btn-inner ui-corner-top\"><img src=\"./images/obama.jpeg\" height=50 width=50><span class=\"ui-btn-text\">  ".$row["friend"]."</span><span class=\"ui-icon ui-icon-shadow ui-icon-checkbox-off\"></span></span></label></div>\n";
					}
					?>

					
					
					
					

										
			    </div></fieldset>
			</div>