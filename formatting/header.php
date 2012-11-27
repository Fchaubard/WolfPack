<!DOCTYPE html> 
<html>

<head>
	<script src="//cdn.optimizely.com/js/141814641.js"></script>
	<title>Wolfpack!</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="pink">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="viewport" content="initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<meta property="og:title" content="Hello world" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="Hello World" />
	<meta property="og:description" content="Hello World!  This is my mobile web sample app." />
	<meta property="og:image" content="http://www.facebookmobileweb.com/hackbook/img/facebook_icon_large.png"/>
	
	<link rel="stylesheet" href="jquery/jquery.mobile-1.2.0.css" />
	<link rel="stylesheet" href="formatting/style.css" />
	<link rel="apple-touch-icon" href="images/wolfPackBackground.jpg" />
	<link rel="apple-touch-startup-image" href="images/fullBackground2.png"/>
	
	<script src="jquery/jquery-1.8.2.min.js"></script>
	<script src="jquery/jquery.mobile-1.2.0.js"></script>
	<script type="text/javascript">
	document.ontouchmove = function(e){ return true; }
	 $(document).ready(function() {
  		// disable ajax nav
		//$.mobile.ajaxLinksEnabled = false;
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