<?php session_start();
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
		<a href="#" data-icon="check" id="logout" data-transition="slide" data-direction="reverse" data-role="button" class="ui-btn-right logout">Logout</a>
		<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>
	
	</div><!-- /header -->

	<div data-role="content">	
	
			
			<?php
		// This is a hack. You should connect to a database here.
		if (!isset($_SESSION['userName'])) {
			
			echo "<p> GOSH! Login like a normal person! Like seriously. </p> <a href=\"#\" class=\"logout\" class=\"roll-link\">login</a>";
		}
		else{
			
			
			echo "<form action=\"wolfpackSummary.php\" method=\"post\">";
			?>
			
			<?php
			if(file_exists("./formatting/groupNameEntry.php")){
				include "./formatting/groupNameEntry.php";
			}
			?>
	
			<?php
			if(file_exists("./formatting/availablePeopleSelect.php")){
				include "./formatting/availablePeopleSelect.php";
			echo "Button Count: ".$button_count;
			echo "<input type=\"hidden\" value=\"".$button_count."\" name=\"buttonCount\">";
			}
			?>
			
			
			<?php
			if(file_exists("./formatting/locationEntry.php")){
				include "./formatting/locationEntry.php";
			}
			?>
			
			
			
				<div data-role="controlgroup" data-type="horizontal">
						<div class="ui-radio"><input type="radio" name="radio-view" id="radio-view-a" value="open" checked=true><label for="radio-view-a" data-theme="c" class="ui-btn ui-corner-left ui-radio-off ui-btn-up-c"><span class="ui-btn-text" style="font-size:12px;">Open</span></label></div>
						<div class="ui-radio"><input type="radio" name="radio-view" id="radio-view-b" value="invite"><label for="radio-view-b" data-theme="c" class="ui-btn ui-btn-up-c ui-radio-off"><span class="ui-btn-inxner"><span class="ui-btn-text" style="font-size:12px;">Invitation Only</span></label></div>
						<div class="ui-radio"><input type="radio" name="radio-view" id="radio-view-c" value="closed"><label for="radio-view-c" data-theme="c" class="ui-btn ui-btn-up-c ui-radio-off"><span class="ui-btn-text" style="font-size:12px;">Closed</span></label></div>
				</div>

			
			
			
			
			
			<?php
			
			if(file_exists("./formatting/startTimeInput.php")){
				include "./formatting/startTimeInput.php";
			}
			
			echo "<input type=\"hidden\" value=\"create\" name=\"task\">";
			echo "<input type=\"submit\" value=\"Send Invitations to Join the Pack!\"/></form>";
			?>
			<script type="text/javascript">
		
		$(".logout").click(function() {
			document.location = "login.php";
		});
		$("#logout").click(function() {
			document.location = "login.php";
		});
	</script>
	<?php
		}//close if else
	?>
			</div><!-- /content -->

	
	
	
</div><!-- /page -->
</body>
</html>