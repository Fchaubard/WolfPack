<?php session_start();
if(file_exists("./formatting/redirect.php")){
    include "./formatting/redirect.php";
}
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

  

?> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>

<body> 
<div data-role="page">

		<div data-role="header" data-position="fixed">
	<!--<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>-->
		<h1>Create! <img src="images/logo_icon_invert.png" height="14px"/></h1>
		<?php 
		
			if(file_exists("./formatting/logout.php")){
				include "./formatting/logout.php";
			}
		
		?> 

		

	
	</div><!-- /header -->

	<div data-role="content">	
		<script type="text/javascript">
			
		 	$(".logingout").click(function() {
				localStorage.clear();
				FB.logout(function() { window.location='account/logout' });
				document.location = "login.php";
			});
			$('.group1').live('click',function(){
				
					$(".msgbox").text('This group is open for the public to join.').fadeIn(1000).fadeTo(1000,1);
			
			});
			$('.group2').live('click',function(){
				
					$(".msgbox").text('Your invited friends can also invite others.').fadeIn(1000).fadeTo(1000,0.75);
			
			});
			$('.group3').live('click',function(){
				
					$(".msgbox").text('Only you can invite more people.').fadeIn(1000).fadeTo(1000,0.5);
			
			});	
			
			$(".logingout").click(function() {
				
				document.location = "login.php";
			});
			
		
			$(".group1").click(function() {
				$(".msgbox").text('This group is open for the public to join.').fadeIn(1000).fadeTo(1000,1);	
			});
			$(".group2").click(function() {
				$(".msgbox").text('Your invited friends can also invite others.').fadeIn(1000).fadeTo(1000,0.75);	
			});
			$(".group3").click(function() {
				$(".msgbox").text('Only you can invite more people.').fadeIn(1000).fadeTo(1000,0.5);	
			});
		 
	</script>
			
			<?php

			
			echo "<form action=\"wolfpackSummary.php\" method=\"post\">";
			?>
			
			<div class="wolfpackCreateInfo" data-role="content" data-theme="a"></div>
			<script type="text/javascript">
				popupManager(".wolfpackCreateInfo", "Let's create a Wolfpack!  To get started, decide what you want to name your meal group:");
			</script>
			
			<?php
			if(file_exists("./formatting/groupNameEntry.php")){
				include "./formatting/groupNameEntry.php";
			}
			?>
			<div class="wolfpackCreateFriendSelect" data-role="content" data-theme="a"></div>
			<script type="text/javascript">
				popupManager(".wolfpackCreateFriendSelect", "Now that we know what to call your group, select which of your available friends you want to invite:");
			</script>
			<?php
			if(file_exists("./formatting/availablePeopleSelect.php")){
				include "./formatting/availablePeopleSelect.php";
			//echo "Button Count: ".$button_count;
			echo "<input type=\"hidden\" value=\"".$button_count."\" name=\"buttonCount\">";
			}
			?>
			
			<div class="wolfpackCreateLocation" data-role="content" data-theme="a"></div>
			<script type="text/javascript">
				popupManager(".wolfpackCreateLocation", "Enter where you want to eat and set the privacy settings for your group:");
			</script>
			<?php
			if(file_exists("./formatting/locationEntry.php")){
				include "./formatting/locationEntry.php";
			}
			?>
			
			
			
			
				<div data-role="controlgroup" data-type="horizontal" id="grouper">
						<div class="ui-radio group1"><input type="radio" name="radio-view" id="radio-view-a" value="open" checked=true><label for="radio-view-a" data-theme="c" class="ui-btn ui-corner-left ui-radio-off ui-btn-up-c group1"><span class="ui-btn-text" style="font-size:12px;">Open</span></label></div>
						<div class="ui-radio group2"><input type="radio" name="radio-view" id="radio-view-b" value="invite"><label for="radio-view-b" data-theme="c" class="ui-btn ui-btn-up-c ui-radio-off group2"><span class="ui-btn-inxner"><span class="ui-btn-text" style="font-size:12px;">Invitation Only</span></label></div>
						<div class="ui-radio group3"><input type="radio" name="radio-view" id="radio-view-c" value="closed"><label for="radio-view-c" data-theme="c" class="ui-btn ui-btn-up-c ui-radio-off group3"><span class="ui-btn-text" style="font-size:12px;">Closed</span></label></div>
				</div>
				<span class="msgbox" id="msgbox">This group is open for the public to join.</span>
				
				<p></p>
				<div class="wolfpackCreateStartTime" data-role="content" data-theme="a"></div>
				<script type="text/javascript">
					popupManager(".wolfpackCreateStartTime", "Finally, select the time that you want your group to eat:");
				</script>
			<?php
			
			if(file_exists("./formatting/startTimeInput.php")){
				include "./formatting/startTimeInput.php";
			}
			
			
			echo "<input type=\"hidden\" value=\"create\" name=\"task\">";
			echo "<input type=\"submit\" value=\"Send Invitations to Join the Pack!\"/></form>";
			echo "<form action=\"mainPage.php\" method=\"post\">";
			echo "<input type=\"submit\" value=\"Cancel\"/></form>";
			?>


			</div><!-- /content -->

		<?php
		if(file_exists("./formatting/footer.php"))
		{
			include "./formatting/footer.php";
		}
	?>
	<script type="text/javascript">
		
				$(".group1").click(function() {
					
					$(".msgbox").text('This group is open for the public to join.').fadeIn(1000).fadeTo(1000,1);	
				});
				$(".group2").click(function() {
					$(".msgbox").text('Your invited friends can also invite others.').fadeIn(1000).fadeTo(1000,0.75);	
				});
				$(".group3").click(function() {
					$(".msgbox").text('Only you can invite more people.').fadeIn(1000).fadeTo(1000,0.5);	
				});
			
			</script>
</div><!-- /page -->


</body>
</html>