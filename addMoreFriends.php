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
		<?php 
		
			if(file_exists("./formatting/logout.php")){
				include "./formatting/logout.php";
			}
		
		?> 
		<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>
	
	</div><!-- /header -->

	<div data-role="content">	
	
			

			
			<?php
			$bc=0;
			if(file_exists("./formatting/availablePeopleSelect.php")){
				include "./formatting/availablePeopleSelect.php";
				$bc=$button_count;
				echo "Button Count: ".$bc;
			}
			?>
			
			
			
			<?php
			echo "<br>";
			echo "Button Count pass, okay? ".$bc;
			echo "<form action=\"wolfpackSummary.php\" method=\"post\"><input type=\"hidden\" value=\"".$bc."\" name=\"buttonCount\"><input type=\"hidden\" value=\"banana\" name=\"task\"><input type=\"submit\" value=\"Send Invitations to Join the Pack!\"/></form>";
			?>

			</div><!-- /content -->

	
	
	
</div><!-- /page -->
</body>
</html>