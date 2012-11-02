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
     <table>
		<tr class="long_tiny">
	      <td>
	        <input type="checkbox" id="long_tiny" />
	      </td>
	    </tr>
    </table>
			
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