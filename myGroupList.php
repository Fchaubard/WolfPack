<h2>My Group: <?php echo $groupName; ?></h2>
<p></p>
<?php
			if(file_exists("./formatting/groupFriends.php")){
				include "./formatting/groupFriends.php";
			}
			?> 


<h2>More Available Friends!</h2>
<p> </p>

			<?php
			if(file_exists("./formatting/friendsNotInGroup.php")){
				include "./formatting/friendsNotInGroup.php";
			}
			
			//if(file_exists("./formatting/availablePeopleList.php")){
			//	include "./formatting/availablePeopleList.php";
			//}
			
			?> 
