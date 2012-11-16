<?php session_start();
if (!isset($_SESSION['userName'])) {
			
			header('Location: http://stanford.edu/~rerich/cgi-bin/CS147/login.php');
}
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}

?> 
<body> 
<div data-role="page">

	<div data-role="header">
		<h1>Edit Friends! <img src="images/logo_icon_invert.png" height="14px"/></h1>
		<?php 

			if(file_exists("./formatting/logout.php")){
				include "./formatting/logout.php";
			}
		
		?> 
	</div><!-- /header -->

	<div data-role="content">	
	<?php
			if(file_exists("./formatting/fullUserList.php")){
				include "./formatting/fullUserList.php";
			}
			//echo "<br /><a href=\"mainPage.php\" data-role=\"button\">Done</a>";

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