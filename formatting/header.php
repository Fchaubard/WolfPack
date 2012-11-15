<!DOCTYPE html> 
<html>

<head>
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
	<script type="text/javascript">
	
	 $(document).ready(function() {
  		// disable ajax nav
		$.mobile.ajaxLinksEnabled = false;
		$.mobile.pageLoadErrorMessage = 'Loadingg';
		$.mobile.defaultPageTransition = "slide";
 		 
	 });
	 
	 $(document).bind('mobileinit',function(){
			$.mobile.pageLoadErrorMessage = 'Logging Out';
			$.mobile.defaultPageTransition = "slide";
	 })
	//we will override here
	</script>

	
</head> 