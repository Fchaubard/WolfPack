<?php
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 

<body> 
<div data-role="page">

	<div data-role="header">
		<h1>Wolfpack Summary!</h1>
		<a href="#" data-icon="check" id="logout" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">	
	
	<?php
			if(file_exists("./formatting/myGroupList.php")){
				include "./formatting/myGroupList.php";
			}
			?>
			
			<?php
			echo "<form action=\"addPeople.php\" method=\"post\"><input type=\"submit\" value=\"Invite More People!\"/></form>";
		 	echo "<form action=\"mainPage.php\" method=\"post\"><input type=\"submit\" value=\"Leave Group!\"/></form>";
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