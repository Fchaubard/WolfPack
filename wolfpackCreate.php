<?php
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

session_start();
  

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
		<h1>Create a Wolfpack!</h1>
		<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">	
	
			<?php
			if(file_exists("./formatting/availablePeopleSelect.php")){
				include "./formatting/availablePeopleSelect.php";
			}
			?> 
			<?php
			if(file_exists("./formatting/locationEntry.php")){
				include "./formatting/locationEntry.php";
			}
			?>
			
			
			
			<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
				<fieldset data-role="controlgroup" data-type="horizontal" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal">
					<div class="ui-controlgroup-controls">
						<div class="ui-radio"><input type="radio" name="radio-view" id="radio-view-a" value="list" checked=true><label for="radio-view-a" data-theme="c" class="ui-btn ui-corner-left ui-radio-off ui-btn-up-c"><span class="ui-btn-text">Open</span></label></div>
						<div class="ui-radio"><input type="radio" name="radio-view" id="radio-view-b" value="grid"><label for="radio-view-b" data-theme="c" class="ui-btn ui-btn-up-c ui-radio-off"><span class="ui-btn-inxner"><span class="ui-btn-text">By Invitation Only</span></label></div>
						<div class="ui-radio"><input type="radio" name="radio-view" id="radio-view-c" value="gallery"><label for="radio-view-c" data-theme="c" class="ui-btn ui-btn-up-c ui-radio-off"><span class="ui-btn-text">Closed</span></label></div>
					</div>
				</fieldset>
			</div>
			
			<?php
			if(file_exists("./formatting/startTimeInput.php")){
				include "./formatting/startTimeInput.php";
			}
			?> 
			
			<?php
			echo "<form action=\"wolfpackSummary.php\" method=\"post\"><input type=\"submit\" value=\"Send Invitations to Join the Pack!\"/></form>";
			?>
			
			</div><!-- /content -->

	
	
	<script type="text/javascript">
		$("#logout").click(function() {
			localStorage.removeItem('username');
			$("#form").show();
			$("#logout").hide();
		});
	</script>
</div><!-- /page -->
</body>
</html>