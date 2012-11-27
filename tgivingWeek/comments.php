
<h2> Testing the comments entry box! </h2>
<br>
<p> Text entry box for a new comment </p>
<br>
<p> Table for existing comments for the group</p>
<br>
<?php

		$date = date('Y-m-d*H:i:s'); //Be careful with the time zone thing…
		echo "Current Date :".$date;
		echo "<p></p>";
	include("config.php");
	
		
		
		?>
		<div id="wrapper">
		<form name="message" action="">  
		        <input name="usermsg" type="text" id="usermsg" size="63" />  
		        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />  
		    </form> 		
	    <div id="menu">  
	           
	        <div style="clear:both"></div>  
	    </div>  
	    <div id="chatbox"></div> 
	    <?php
	    $query = "SELECT * FROM chat WHERE groupId=\"1\" order by id desc";
		$result = mysql_query($query)or die(mysql_error());
		while($row = mysql_fetch_array($result)){
			//$_SESSION['groupId'] = $row['id'];
			?>
			<ui class="friend heightForCell" data-icon="false">
			<?php
			$sender = $row['sender'];
			$message = $row['text'];
			$date = $row['dateSent'];
			list($day, $time) = explode('*', $date);
			echo "<p><strong>(".$time.") ".$sender.": </strong>".$message."</p>";
		?>
		</ui>
	    <?php
			}
			
	
		?>
		  
		    
		</div>  
<br>
<p> Need to make sure to purge this occasionally…</p>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		console.log(clientmsg);
		$.post("commentsPost.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	
	
	
});
</script>
