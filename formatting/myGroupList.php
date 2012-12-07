<h2>My Group: <?php echo $groupName; ?></h2>
<p></p>
<?php
			if(file_exists("./formatting/groupFriends.php")){
				include "./formatting/groupFriends.php";
			}
			?> 


<h2>More Available Friends!</h2>
<div class="availableFriendsPack" data-role="content" data-theme="a"></div>
	<script type="text/javascript">
		popupManager(".availableFriendsPack", "These are your friends who are currently available to eat, but not in your group. Invite them by tapping!");
	</script>
<p> </p>

			<?php
			if(file_exists("./formatting/friendsNotInGroup.php")){
				include "./formatting/friendsNotInGroup.php";
			}
			
			//if(file_exists("./formatting/availablePeopleList.php")){
			//	include "./formatting/availablePeopleList.php";
			//}
			
			?> 
