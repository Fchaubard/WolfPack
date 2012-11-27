<div data-role="collapsible-set" id="groupFriends" class="groupFriends">
</div>
<script type="text/javascript">
		$(".groupFriends").html("Hello World!");
		var groupId2 = <?php echo $groupId ?>;
		var userName = <?php echo "\"".$_SESSION["userName"]."\""; ?>;
		//console.log(userName);
		var eventURL2 = "./formatting/master_push.php?group="+groupId2+"&userName="+userName;
		//console.log(eventURL);
		//functions here
		if(typeof(EventSource)!=="undefined")
		{
		    //create an object, passing it the name and location of the server side script
		    var eSource2 = new EventSource(eventURL2);
		    //detect message receipt
		    eSource2.addEventListener('groupFriends', function(event)
		    {
			//write the received data to the page
			console.log(event.data);
			$(".groupFriends").html(event.data);
			$(".groupFriends" ).collapsibleset( "refresh" );
		    });
		    eSource2.addEventListener('notInGroup', function(event)
		    {
			console.log(event.data);
			//write the received data to the page
			$(".friendsNotInGroup").html(event.data);
			$(".friendsNotInGroup").collapsibleset("refresh");
	           });
		}
		else
		{
		    $(".groupFriends").html("Whoops! Your browser doesn't receive server-sent events.");
		}
</script>