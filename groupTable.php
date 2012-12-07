<?php session_start();

	include("./config.php");
	
	function groupListFunction()
	{
		$query = "SELECT * FROM groups";
		$result = mysql_query($query)or die(mysql_error());
		$resultString = "";
		
		while($row = mysql_fetch_array($result)){
			if($row["open"]==2) //&& $row["owner"]!=$_SESSION['userName'])
			{
				$ownerInfo = "SELECT 1 FROM users WHERE userName LIKE \"".$row['owner']."\"";
				$ownerInfoResult = mysql_query($ownerInfo)or die(mysql_error());
				if($ownerInfoResult["usericon"] == "")
				{
					$icon2 = "defaultProfileImage.png";
				}
				else
				{
					$icon2 = $ownerInfoResult["usericon"];
				}
				$icon = "./images/".$icon2;
				
				$one = "<li class=\"group heightForGroupCell\" data-icon=\"false\"><img height=\"60\" width=\"70\" src=\"".$icon."\" class=\"ui-li-thumb\"><h3 class=\"groupName\">".$row["name"]."</h3><p>Group Owner: ".$row["owner"]."</p><p>Location: ".$row["location"]."</p>";
				
				$timeOfDay = "AM";
						$hour = $stopTime/100;
						if($hour>=12 && $hour<24){
							$timeOfDay="PM";
						}
						if($hour==0){
							$hour=12;
						}
						if($hour>=13){
							$hour=$hour-12;
						}
						$minutes = $stopTime%100;
						if($minutes==0){
							$minutes = "00";
						}
				$startTimeString=$hour.":".$minutes.$timeOfDay;
				$two = "<p>Time: ".$startTimeString."</p>";
				
				$three = "<form action=\"wolfpackSummary.php\" method=\"post\"><input type=\"hidden\" value=".$row["id"]." name=\"groupId\"><input type=\"hidden\" value=\"join\" name=\"task\"><input onclick=\"eSource.close();\" type=\"submit\" class=\"joinButton\" value=\"Join ".$row["name"]."!\"/></form></li>";
				
				$resultString = $resultString.$one.$two.$three;
			}			
		}
		return $resultString;
	}

?>
<ul data-role="listview" id="groupList" data-filter="true" class="ui-listview">
<?php
	$string = groupListFunction();
	echo $string;
?>
</ul>