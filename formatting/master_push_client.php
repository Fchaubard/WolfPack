<script type="text/javascript">
	$(".friendsList").html("Hello World!");
	var userName = <?php echo "\"".$_SESSION["userName"]."\""; ?>;
	var eventURL = "./formatting/master_push.php?userName="+userName;
	//console.log(eventURL);
	$(".inviteDecline").click(function(){
		$.get("./formatting/declineInvite.php?user="+userName,function(data,status){console.log("Data: " + data + "\nStatus: " + status);});
		document.ontouchmove = function(e){ return true; }
		console.log("decline");
	});
	if(typeof(EventSource)!=="undefined")
	{
	    //create an object, passing it the name and location of the server side script
	    var eSource = new EventSource(eventURL);
	    //detect message receipt for friends
	    eSource.addEventListener('friendsList', function(event)
	    {
			//console.log(event.data);
			//write the received data to the page
			$(".friendsList").html(event.data);
			$(".friendNames").collapsible("refresh");
			try{
				$('ul').listview('refresh');
			} 
			catch (e) 
			{
				console.log("refresh failed!");
			}
	    });
		
		//detect message receipt for groups
	    eSource.addEventListener('groupsList', function(event)
	    {
			//console.log(event.data);
			//write the received data to the page
			$(".groupsTable").html(event.data);
			$(".groupElement").collapsible();
			$( ".groupsTable" ).collapsibleset( "refresh" );
			$(".joinbutton").button();
			$(".joinbutton").button('refresh');
	    });
	    
	    eSource.addEventListener('inviteData', function(event)
	    {
			console.log(event.data);
			if(event.data != "null invite")
			{
				$( ".popupPanel" ).popup( "open" );
				$(".popupButton").button('refresh');
				
				//$(".inviteButton").button();
				//$(".inviteButton").button('refresh');
				$(".groupInviteInfo").html(event.data);
				$('[type="submit"]').button();
				$('[type="submit"]').button('refresh');
				document.ontouchmove = function(e){ e.preventDefault(); }
			}
			//write the received data to the page
			
	    });
	    
	}
	else
	{
	    $(".groupsTable").html("Whoops! Your browser doesn't receive server-sent events.");
	}
</script>