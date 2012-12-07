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

	<div data-role="header" data-position="fixed">
	<!--<a href="#" data-rel="back" data-icon="arrow-l" id="back" data-transition="slide"  data-direction="reverse" data-role="button" class="ui-btn-left">Back</a>-->
		<h1>Edit Friends! <img src="images/logo_icon_invert.png" height="14px"/></h1>
		<?php 

			if(file_exists("./formatting/logout.php")){
				include "./formatting/logout.php";
			}
		
		?> 
		
	</div><!-- /header -->
	<style type="text/css">
	
	.friend {
		padding-left: 0px;
		padding-right: 15px;
		padding-top: 0px;
		padding-bottom: 3px;
	}
	
	.heightForCell {
		height:60px;
	}
	
	.friendName {
		margin-left: -10px;
		margin-top: -7px;
	}
	
	
	</style>
	
	<script language="javascript" type="text/javascript">
	
	$(document).bind('pageinit', function(){
	    addRemoveFriend = function(friendName, friendUn)
	    {
		$.post("./formatting/friend.php",{ "friendName":friendName,"option":friendUn,rand:Math.random() } ,function(data)
		{
		    result = eval('(' + data + ')');
		    if(result["success"]) //if correct login detail
		    {
			$('.userListContainer').load('./formatting/userListReload.php', function(){$('ul').listview(); $('ul').listview('refresh').trigger('create'); $(".friendButton").button(); $(".friendButton").button('refresh'); $('.friendsListContainer').children('a').buttonMarkup();});
			    //$(".friendButton").button(); $(".friendButton").button('refresh'); $('ul').listview('refresh'); $('.friendsListContainer').page('refresh')};});
		    }
		    else 
		    {
			//didnt add or remove friend	
			console.log("Result: " + data);
		    }
		});
	     }
	});
	</script>
	<div data-role="content" class="userListContainer">
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