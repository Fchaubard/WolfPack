<?php session_start();

if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 
<body> 
<div data-role="page">

	<div data-role="header">
		<h1>Welcome!</h1>
		<a href="#" data-icon="check" id="logout" data-transition="slide" data-direction="reverse" data-role="button" class="ui-btn-right">Logout</a>

	</div><!-- /header -->

	<div data-role="content">	
		
		<h1> FUCK THIS!!! </h1>
		
	</div><!-- /content -->

	
	
	<script type="text/javascript">
		$(".logout").click(function() {
			document.location = "login.php";
		});
		$("#logout").click(function() {
			document.location = "login.php";
		});
	</script>
</div><!-- /page -->

</body>
</html>