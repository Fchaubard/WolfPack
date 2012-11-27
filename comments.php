<h2> Testing the comments entry box! </h2>
<br>
<p> Text entry box for a new comment </p>
<br>
<p> Table for existing comments for the group</p>
<br>

<div data-role="collapsible-set" id="commentsContainer" class="commentsContainer">
</div>
<script type="text/javascript">
		$(".commentsContainer").html("Hello World!");
		var groupId2 = 1;//<?php echo $groupId ?>;
		var userName = "\"bill\"";//<?php echo "\"".$_SESSION["userName"]."\""; ?>;
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
			$(".commentsContainer" ).collapsibleset( "refresh" );
		    });
		   
		}
		else
		{
		    $(".commentsContainer").html("Whoops! Your browser doesn't receive server-sent events.");
		}
</script>