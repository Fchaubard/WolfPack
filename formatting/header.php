<!DOCTYPE html> 
<html>

<head>
	<script src="//cdn.optimizely.com/js/141814641.js"></script>
	<title>Wolfpack!</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="pink">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery/jquery.mobile-1.2.0.css" />
	<link rel="stylesheet" href="formatting/style.css" />
	<link rel="apple-touch-icon" href="images/wolfPackBackground.jpg" />
	<link rel="apple-touch-startup-image" href="images/fullBackground2.png"/>
	
	<script src="jquery/jquery-1.8.2.min.js"></script>
	<script src="jquery/jquery.mobile-1.2.0.js"></script>
	<script src="popover/jquery.popover-1.1.2.js"></script>
	<link rel="stylesheet" href="popover/popover.css" type="text/css" media="screen" />
	<script type="text/javascript">
	document.ontouchmove = function(e){ return true; }
	 $(document).ready(function() {
  		// disable ajax nav
		//$.mobile.ajaxLinksEnabled = false;
		$.mobile.pageLoadErrorMessage = 'Loadingg';
		$.mobile.defaultPageTransition = "slide";
 		 
	 });
	 
	 console.log(window.location.pathname);
	 if(window.location.pathname != "/login.php"){
	 	console.log("are we at login? better hope not");
		 <?php echo 'localStorage.setItem(\'userName\', \''. $_SESSION['userName'].'\');';?>
		 <?php echo 'localStorage.setItem(\'groupNumber\', \''. $_SESSION['groupNumber'].'\');';?>	
		 localStorage.setItem('url_name',window.location.protocol + "//" + window.location.host + window.location.pathname + "?userName="+localStorage.getItem('userName'));
	 }
	  
	 $(document).bind('mobileinit',function(){
			$.mobile.pageLoadErrorMessage = 'Logging Out';
			$.mobile.defaultPageTransition = "slide";
	 })
	//we will override here
	
	function popupManager(popupID, popupMessage)
	{
		var userName = <?php echo "\"".$_SESSION["userName"]."\""; ?>;
		<?php
			$res = array();
			include("./config.php");
			$query = "SELECT * FROM visitedPages WHERE user='".$_SESSION["userName"]."'";
			$result = mysql_query($query)or die(mysql_error());
			while($row = mysql_fetch_assoc($result))
			{
				$res[] = $row['pageName'];
				//echo $row;
			}
			mysql_close($link);


			$fres = json_encode($res);
			
			//$fres = $res;
		?>
		var pagesDataRaw = <?php echo "'".$fres."'"; ?>;
		var visitedPagesData = JSON.parse(pagesDataRaw);
		console.log(popupID + visitedPagesData);
		var triggerPopup = $.inArray(popupID, visitedPagesData);
		if(triggerPopup == -1)
		{
			var popupURL = "./formatting/seenPage.php?"+"user=" + userName + "&page=" + popupID;
			
			$(popupID).html("<table width=\"100%\"><td>" + popupMessage + "</td><td align=\"right\"><img src=\"./images/close.png\"/></td></table>");
			$(popupID).bind('click',function(event) {
			$(popupID).hide("300", function(){document.onclick = function(e){ return true; }}); //  toggles the visibility/display of the element.
				document.onclick = function(e){ e.preventDefault(); }
				$.get(popupURL,function(data,status){console.log("Data: " + data + "\nStatus: " + status);});
			});	
		}
		else
		{
			$(popupID).hide();
		}
		
	}
	</script>

	
</head> 