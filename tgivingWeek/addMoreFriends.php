<?php session_start();
if(file_exists("./formatting/redirect.php")){
    include "./formatting/redirect.php";
}
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

  

?> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>

<script src="jquery-1.4.js"></script>
<script src="formatting/iphoneToggleSwitch/jquery/iphone-style-checkboxes.js"></script>
<link rel="stylesheet" href="formatting/iphoneToggleSwitch/style.css">
  <script type="text/javascript" charset="utf-8">
    $(window).load(function() {
      
      $('.long_tiny :checkbox').iphoneStyle({ checkedLabel: 'Open', uncheckedLabel: 'Closed' });
   
    });
  </script>
<body> 
<div data-role="page">

	<div data-role="header">
		<h1>Create a Wolfpack! <img src="images/logo_icon_invert.png" height="14px"/></h1>
		<?php 
		
			if(file_exists("./formatting/logout.php")){
				include "./formatting/logout.php";
			}
		
		?> 
		<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>
	
	</div><!-- /header -->

	<div data-role="content">	
	
			
	<form action="wolfpackSummary.php" method="post">
			
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
								
						$query2 = "SELECT * FROM users WHERE userName=\"".$row["friend"]."\" AND groupNumber=0 AND hungry=1";
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
								echo "<input type=\"checkbox\" name=\"checkbox-".$button_count."\" id=\"checkbox-".$button_count."\" class=\"custom\" checked=\"checked\"/>";
							}else{
								echo "<input type=\"checkbox\" name=\"checkbox-".$button_count."\" id=\"checkbox-".$button_count."\" class=\"custom\"/>";
							}	
							echo "<input type=\"hidden\" name=\"name-".$button_count."\" value=\"".$row2["userName"]."\">";
    				echo "<label for=\"checkbox-".$button_count."\">".$row2["userName"]."</label>";	
						}
					}
					
					?>
				</fieldset>
			</div>
			
			
			
			<?php
			
			$bc = $button_count;
			//echo "Button Count pass, okay? ".$bc;
			if($bc==0){ //No friends to add.
				echo "It seems you have no more hungry friends to join your Wolfpack!";
				echo "<br>";
			}
			else{
				echo "<input type=\"hidden\" value=\"".$bc."\" name=\"buttonCount\"><input type=\"hidden\" value=\"banana\" name=\"task\"><input type=\"submit\" value=\"Send Invitations to Join the Pack!\"/></form>";
				echo "<br>";
			}
			?>

			</div><!-- /content -->

		<?php
		if(file_exists("./formatting/footer.php"))
		{
			include "./formatting/footer.php";
		}
	?>
	
	
</div><!-- /page -->
</body>
</html>