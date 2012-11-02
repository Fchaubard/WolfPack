<?php
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

session_start();
?> 

<body> 

<div data-role="page">

	<div data-role="header">
		<h1>So You're Hungry?</h1>
		<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">	
		
		
		
			<?php
			echo "<p>Hey <strong>".$_SESSION['userName']."</strong>. You're a wolf.. but you have no Wolf Pack!</p>";
			?>
			
			<?php
			if(file_exists("./formatting/availablePeopleList.php")){
				include "./formatting/availablePeopleList.php";
			}
			?> 
			
			<?php
			echo "<form action=\"mainPage.php\" method=\"post\"><input type=\"submit\" value=\"Refresh!\"/></form>";
			?>
			
			<?php
			if(file_exists("./formatting/openGroupsList.php")){
				include "./formatting/openGroupsList.php";
			}
			?> 
			
			<?php
			echo "<form action=\"wolfpackCreate.php\" method=\"post\"><input type=\"submit\" value=\"Start a Wolfpack!\"/></form>";
		 	echo "<form action=\"iAmHungryPage.php\" method=\"post\"><input type=\"submit\" value=\"I'm Not Hungry Anymore!\"/></form>";
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