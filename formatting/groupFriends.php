<div data-role="collapsible-set" id="groupFriends">
</div>
<script type="text/javascript">
		document.getElementById("groupFriends").innerHTML = "Hello World!";
		var groupId = <?php echo $groupId ?>;
		var eventURL = "./formatting/pack_push.php?group="+groupId;
		console.log(eventURL);
		//functions here
		if(typeof(EventSource)!=="undefined")
		{
		    //create an object, passing it the name and location of the server side script
		    var eSource = new EventSource(eventURL);
		    //detect message receipt
		    eSource.addEventListener('groupFriends', function(event)
		    {
			//write the received data to the page
			document.getElementById("groupFriends").innerHTML = event.data;
			$( "#groupFriends" ).collapsibleset( "refresh" );
		    });
		}
		else
		{
		    document.getElementById("groupFriends").innerHTML="Whoops! Your browser doesn't receive server-sent events.";
		}
</script>