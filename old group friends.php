<div data-role="collapsible-set" id="groupFriends" class="groupFriends">
</div>
<script type="text/javascript">
		$(".groupFriends").html("Hello World!");
		var groupId2 = <?php echo $groupId ?>;
		var eventURL2 = "./formatting/master_push.php?group="+groupId2;
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
			$(".groupFriends").html(event.data);
			$(".groupFriends" ).collapsibleset( "refresh" );
		    });
		}
		else
		{
		    $(".groupFriends").html("Whoops! Your browser doesn't receive server-sent events.");
		}
</script>