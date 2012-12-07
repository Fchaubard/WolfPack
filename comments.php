<h2>WolfChat:</h2>
<div id="commentsContainer" class="commentsContainer">
</div>
<br/>
<form class="chatBox" method="get">
<input class="chatText" type="text" name="text">
<input type="hidden" value=<?php echo $groupId?> name="gid">
<button type="button" class="chatButton" onclick="sendChat(); return false;">Send</button>
</form>

<script type="text/javascript">
		$(".chatBox").bind("keypress", function(e) {
             if (e.keyCode == 13) {
                 sendChat();
                 return false;
				 }
				});
		sendChat = function()
		{
			var chatURL = "./addChat.php?"+$('.chatBox').serialize();
			$.get(chatURL,function(data,status){console.log("Data: " + data + "\nStatus: " + status);});
			console.log(chatURL);
			$(".chatText").val("");
		}
		$(".commentsContainer").html("Hello World!");
		var groupId2 = <?php echo $groupId ?>;
		var userName = <?php echo "\"".$_SESSION["userName"]."\""; ?>;
		console.log(userName);
		var eventURL2 = "./formatting/master_push.php?group="+groupId2+"&userName="+userName;
		console.log(eventURL2);
		//functions here
		if(typeof(EventSource)!="undefined")
		{
		    //create an object, passing it the name and location of the server side script
		    var eSourceBeta = new EventSource(eventURL2);
		    //detect message receipt
		    eSourceBeta.addEventListener('chatLoad', function(event)
		    {
			//write the received data to the page
			console.log(event.data);
			$(".commentsContainer").html(event.data);
		    });
		   
		}
		else
		{
		    $(".commentsContainer").html("Whoops! Your browser doesn't receive server-sent events.");
		}
</script>