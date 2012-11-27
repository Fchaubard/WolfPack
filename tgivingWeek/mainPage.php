<?php session_start();
if(file_exists("./formatting/redirect.php")){
    include "./formatting/redirect.php";
}
if(file_exists("./formatting/header.php")){
	include "./formatting/header.php";
}
?> 

<body> 

<div data-role="page">

	<div data-role="header">
		<h1>So You're Hungry? <img src="images/logo_icon_invert.png" height="14px"/></h1>
		<?php 
		
			if(file_exists("./formatting/logout.php")){
				include "./formatting/logout.php";
			}
		
		?> 
		<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>
	</div><!-- /header -->

	<div data-role="content">	
		 <script type="text/javascript">
		 	$(".logingout").click(function() {
				
				document.location = "login.php";
			});
			
			$("#test").click(function() {			
				var mylist = $('#friendsList');
				var listitems = mylist.children('li').get();
				
				listitems.sort(function(a, b) {
				return $(a).text().toUpperCase().localeCompare($(b).text().toUpperCase());
				})
				$.each(listitems, function(idx, itm) { mylist.append(itm); });
			});
		</script>
		<?php 

			
		$task = $_POST["task"];
		if($task=="leave"){
			$groupId = $_POST["groupId"];
			include("config.php");
			$queryString = "UPDATE users SET groupNumber=\"0\", status=\"0\" WHERE userName=\"".$_SESSION['userName']."\"";
			$query = $queryString;
			$result = mysql_query($query)or die(mysql_error());
		}
		if($task=="justHungry"){
			$_SESSION['startTime']=$_POST["startTime"];
			$_SESSION['stopTime']=$_POST["stopTime"];
			include("config.php");
			//$start = 
			//$stop = 
			$queryString = "UPDATE users SET startTime=\"".$_SESSION['startTime']."\", endTime=\"".$_SESSION['stopTime']."\", hungry=\"1\" WHERE userName=\"".$_SESSION['userName']."\"";
			//echo $queryString;
			$result = mysql_query($queryString)or die(mysql_error());
		}
			echo "<p>Hey <strong>".$_SESSION['userName']."</strong>. You're a wolf.. but you have no Wolf Pack!</p>";
			//echo "<p> Start Time: ".$_SESSION['startTime']." Stop Time: ".$_SESSION['stopTime']."<p>";
			?>
			<h2>Hungry Friends:</h2>
			<!--<input type="button" id="test" value="Sort List (click again to reverse)"/>-->
			<br/>
			<?php
			if(file_exists("./formatting/availablePeopleList.php")){
				include "./formatting/availablePeopleList.php";
			}
			?> 
			
			<?php
			echo "<!--<br /><form action=\"mainPage.php\" method=\"post\"><input type=\"submit\" onclick=\"eSource.close();\" value=\"Refresh!\"/></form>-->";
			echo "<br /><form action=\"editFriends.php\" method=\"post\"><input type=\"submit\" onclick=\"eSource.close();\" value=\"Add / Remove Friends\"/></form>";
			?>
			
			<?php
			if(file_exists("./formatting/openGroupsList.php")){
				include "./formatting/openGroupsList.php";
			}
			?> 
			
			<?php
			echo "<form action=\"wolfpackCreate.php\" method=\"post\"><input type=\"submit\" onclick=\"eSource.close();\" value=\"Start a Wolfpack!\"/></form>";
		 	echo "<form action=\"iAmHungryPage.php\" method=\"post\"><input type=\"hidden\" value=\"notHungry\" name=\"task\"><input type=\"submit\" onclick=\"eSource.close();\" value=\"I'm Not Hungry Anymore!\"/></form>";
		 	?>
		 	
		 	
		
	
	</div><!-- /content -->
	<?php
		if(file_exists("./formatting/footer.php"))
		{
			include "./formatting/footer.php";
		}
		if(file_exists("./formatting/thebestcode.php"))
		{
			include "./formatting/thebestcode.php";
		}
	?>
	
</div><!-- /page -->
</body>
</html>