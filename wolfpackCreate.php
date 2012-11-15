<?php session_start();
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

  

?> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>

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
		<script type="text/javascript">
		//$( document ).bind( 'pageshow', function( event ){
			$(".logingout").click(function() {
				
				document.location = "login.php";
			});
			
		
			$(".group1").click(function() {
				$("#msgbox").text('This group is open for the public to join.').fadeIn(1000).fadeTo(1000,1);	
			});
			$(".group2").click(function() {
				$("#msgbox").text('Your invited friends can also invite others.').fadeIn(1000).fadeTo(1000,0.75);	
			});
			$(".group3").click(function() {
				$("#msgbox").text('Only you can invite more people.').fadeIn(1000).fadeTo(1000,0.5);	
			});
		 
	</script>
			
			<?php

			
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
			
			
			
				<div data-role="controlgroup" data-type="horizontal" id="grouper">
						<div class="ui-radio"><input type="radio" name="radio-view" id="radio-view-a" value="open" checked=true><label for="radio-view-a" data-theme="c" class="ui-btn ui-corner-left ui-radio-off ui-btn-up-c group1"><span class="ui-btn-text" style="font-size:12px;">Open</span></label></div>
						<div class="ui-radio group2"><input type="radio" name="radio-view" id="radio-view-b" value="invite"><label for="radio-view-b" data-theme="c" class="ui-btn ui-btn-up-c ui-radio-off group2"><span class="ui-btn-inxner"><span class="ui-btn-text" style="font-size:12px;">Invitation Only</span></label></div>
						<div class="ui-radio"><input type="radio" name="radio-view" id="radio-view-c" value="closed"><label for="radio-view-c" data-theme="c" class="ui-btn ui-btn-up-c ui-radio-off group3"><span class="ui-btn-text" style="font-size:12px;">Closed</span></label></div>
				</div>
				<span id="msgbox">This group is open for the public to join.</span>
					
			<?php
			
			if(file_exists("./formatting/startTimeInput.php")){
				include "./formatting/startTimeInput.php";
			}
			
			
			echo "<input type=\"hidden\" value=\"create\" name=\"task\">";
			echo "<input type=\"submit\" value=\"Send Invitations to Join the Pack!\"/></form>";
			?>


			</div><!-- /content -->

	
	
	
</div><!-- /page -->


</body>
</html>