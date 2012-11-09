
<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
<h2>Select Available Friends to Join Your Group:</h2>
				<fieldset data-role="controlgroup">

			 	
			 	
			 	<?php
					include("config.php");
					$query = "SELECT * FROM friends WHERE user=\"".$_SESSION['userName']."\"";
					$result = mysql_query($query)or die(mysql_error());
					$button_count = 0;
					while($row = mysql_fetch_array($result))
					{
								
						$query2 = "SELECT * FROM users WHERE userName=\"".$row["friend"]."\" AND groupNumber=0";
						$result2 = mysql_query($query2)or die(mysql_error());
						while($row2 = mysql_fetch_array($result2)){
							$button_count++;
							if($row2["usericon"] == "")
							{
								$icon2 = "obama.jpeg";
							}
							else
							{
								$icon2 = $row2["usericon"];
							}
							$icon = "./images/".$icon2;
							if(strcmp($row2['userName'],$_GET['friend'])==0){
							//checked="checked"
								echo "<input type=\"checkbox\" name=\"checkbox-".$button_count."\" id=\"checkbox-".$button_count."\" class=\"custom\" checked=\"checked\"/>";
							}else{
								echo "<input type=\"checkbox\" name=\"checkbox-".$button_count."\" id=\"checkbox-".$button_count."\" class=\"custom\" />";
							}
					
					echo "<input type=\"hidden\" name=\"name-".$button_count."\" value=\"".$row2["userName"]."\">";
    				echo "<label for=\"checkbox-".$button_count."\">".$row2["userName"]."</label>";								
						}
					}
					
					
					
					?>
					
					
					
					

				</fieldset>
			</div>