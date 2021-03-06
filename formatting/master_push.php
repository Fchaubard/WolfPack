<?php

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    
    
    $oldFriendString = "";
    $oldChatString = "";
    $oldGroupString = "";
    $oldInviteString = "";
    $oldGroupFriendString = "";
    $oldGroupFriendsNotString = "";
    include("../config.php");
    mysql_close($link);
    
    function chatLoad()
    {
        $groupId = $_GET["group"];
        if(!$groupId)
        {
            return "";
        }
        $resultString = "";
        $count =0;
        $query = "SELECT * FROM chat WHERE groupId=".$groupId." ORDER BY id desc LIMIT 10";
        //$query = "SELECT * FROM chat WHERE groupId=\"".$groupId."\" order by id desc";
        $result = mysql_query($query)or die(mysql_error());
        while($row = mysql_fetch_array($result)){
                if(1) //$row["userName"]!=$_SESSION['userName']
                {
                		$sender = $row['sender'];
						$message = $row['text'];
						$date = $row['dateSent'];
						list($day, $time) = explode('*', $date);
			
                        
                        if(($count % 2) == 0)
                        {
                            $stylecomm = "style=\"padding-left:4px; background-color:#DFDFDF; padding-top:1px; padding-bottom:1px;\"";
                        }
                        else
                        {
                            $stylecomm = "style=\"padding-left:4px; padding-top:1px; padding-bottom:1px;\"";
                        }
                        $one = "<div ".$stylecomm." data-role=\"collapsible\" data-collapsed=\"true\">";
                        
                        $two = "<p><strong>(".$time.") ".$sender.": </strong>".$message."</p>";
                        
                        $five = "</div>";
                        
                        $resultString = $one.$two.$five.$resultString;
                        $count = $count+1;
                }
        }
        if($count==0){
                $resultString = "<p>It seems no one is chatting yet! Start the chat!</p>";
        }
        return $resultString;
    }
    
    function groupFriends()
    {
        $groupId = $_GET["group"];
        if(!$groupId)
        {
            return "";
        }
        $resultString = "";
        $count =0;
        $query = "SELECT * FROM users WHERE groupNumber=\"".$groupId."\"";
        $result = mysql_query($query)or die(mysql_error());
        while($row = mysql_fetch_array($result)){
                if(1) //$row["userName"]!=$_SESSION['userName']
                {
                        if($row["usericon"] == "")
                        {
                                $icon2 = "./images/obama.jpeg";
                        }
                        else
                        {
                                $icon2 = $row["usericon"];
                        }
                        //$icon = "./images/".$icon2;
                        $icon = $icon2;
                        
                        $one = "<div data-role=\"collapsible\" data-collapsed=\"true\">";
                        $two =  "<h3><img src=\"".$icon."\" height=\"60\" width=\"60\"> ".$row["userName"]."</h3>";
                        
                        $startTime = $row["startTime"];
						$timeOfDay = "AM";
						$hour = $startTime/100;
						if($hour>=12 && $hour<24){
							$timeOfDay="PM";
						}
						if($hour==0){
							$hour=12;
						}
						if($hour>=13){
							$hour=$hour-12;
						}
						$minutes = $startTime%100;
						if($minutes==0){
							$minutes = "00";
						}
						$startTimeString=$hour.":".$minutes.$timeOfDay;
                        
                        
                        
                        $three = "<p>Time Available: ".$startTimeString."</p>";
                        $statusNumber = $row["status"];
                        if($statusNumber==0){
                                $status="Not Attending";
                        }
                        else if ($statusNumber==1){
                                $status = "Attending";
                        }
                        else if ($statusNumber==2){
                                $status = "Pending Response";
                        }
                        else if ($statusNumber==3){
                                $status = "Group Owner";
                        }
                        else{
                                $status = "Status Message Error";
                        }
                        $four = "<p>Status: ".$status." </p>";
                        $five = "</div>";
                        
                        $resultString = $resultString.$one.$two.$three.$four.$five;
                        $count = $count+1;
                }
        }
        if($count==0){
                $resultString = "<p>It seems no one is in your group! Invite some friends!</p>";
        }
        return $resultString;
    }
    function groupInvite()
    {
        $userName = $_GET['userName'];
        if(!$userName)
        {
            return "null invite";
        }
        $resultString = "";
        $query = "SELECT * FROM users WHERE userName=\"".$userName."\"";
        $result = mysql_query($query)or die(mysql_error());
        
        while($row = mysql_fetch_array($result))
        {
            $groupNumber = $row["groupNumber"];
            $groupStatus = $row["status"];
            if(($groupNumber <> 0) && ($groupStatus == 2))
            {
                $query2 = "SELECT * FROM groups WHERE id=\"".$groupNumber."\"";
                $result2 = mysql_query($query2)or die(mysql_error());
                while($row2 = mysql_fetch_array($result2))
                {
                    $groupInfo = $row2;
                }
                
            }
        }
        if ($groupStatus == 2)
        {
            $groupName = $groupInfo["name"];
            $owner = $groupInfo["owner"];
            $groupLoc = $groupInfo["location"];
            $timeStart = $groupInfo["timeStart"];
            
            $invitationMessage = "<div id=\"invite\">You have been invited to the group $groupName, created by $owner. $groupName is meeting at $groupLoc at $timeStart.</div>";
            $acceptButton = "<form name=\"acceptInvite\" action=\"wolfpackSummary.php\" method=\"post\"><input type=\"hidden\" value=\"".$groupNumber."\" name=\"groupId\"><input type=\"hidden\" value=\"acceptInvitation\" name=\"task\"/><input type=\"submit\" onclick=\"eSource.close(); document.ontouchmove = function(e){ return true; };\" class=\"inviteButton\" data-role=\"button\" data-theme=\"a\" value=\"Accept Invitation\"/></form>";
            
            return $invitationMessage.$acceptButton;
        }
        else
        {
            return "null invite";
        }
    }
    
    function friendsList()
    {
	$userName = $_GET['userName'];
        if(!$userName)
        {
            return "no name.";
        }
	//friends List result string.
        $resultString = "";
        $count = 0;
        $query = "SELECT * FROM friends WHERE user=\"".$userName."\"";
        $result = mysql_query($query)or die(mysql_error());
        while($row = mysql_fetch_array($result)){
            $query2 = "SELECT * FROM users WHERE userName=\"".$row["friend"]."\" AND hungry=1 AND groupNumber=0";
            $result2 = mysql_query($query2)or die(mysql_error());
            while($row2 = mysql_fetch_array($result2)){
                if($row2["usericon"] == "")
                {
                        $icon2 = "./images/obama.jpeg";
                }
                else
                {
                        $icon2 = $row2["usericon"];
                }
                $icon = $icon2;
                $one = "<li class=\"friend heightForCell\" data-icon=\"false\">";
                $two = "<a href=\"./wolfpackCreate.php?friend=".$row2["userName"]."\" onclick=\"eSource.close()\" class=\"friend heightForCell\" data-icon=\"arrow-r\" data-iconpos=\"right\">";
                $three = "<img height=\"60\" width=\"60\" src=\"".$icon."\" >";
                $four = "<h3 class=\"friendName\">".$row["friend"]."</h3>";

                $startTime = $row2["startTime"];
                $stopTime = $row2["endTime"];

                $timeOfDay = "AM";
                $hour = $startTime/100;
                if($hour>=12 && $hour<24){
                        $timeOfDay="PM";
                }
                if($hour==0){
                        $hour=12;
                }
                if($hour>=13){
                        $hour=$hour-12;
                }
                $minutes = $startTime%100;
                if($minutes==0){
                        $minutes = "00";
                }
                $startTimeString=$hour.":".$minutes.$timeOfDay;
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
                $stopTimeString = $hour.":".$minutes.$timeOfDay;
                
                $five =  "<p class=\"friendName\">Hungry from: ".$startTimeString." - ".$stopTimeString."</p>";
                $six =  "<p class=\"friendName\">Distance from you: 3 mi</p></a></li>";
                $resultString = $resultString.$one.$two.$three.$four.$five.$six;
                $count++;
            }
        }
        if($count == 0)
        {
            $resultString = "<p> &nbsp; &nbsp; &nbsp;$userName You have no hungry friends! Aroo. <img width=\"50px\" src=\"./images/nixon.png\" /></p>";
        }
	return $resultString;
    }
	
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
					$icon2 = "./images/defaultProfileImage.png";
				}
				else
				{
					$icon2 = $ownerInfoResult["usericon"];
				}
				$icon = $icon2;
				
				$one = "<li class=\"group heightForCell\" data-icon=\"false\"><img height=\"60\" width=\"70\" src=\"".$icon."\" class=\"ui-li-thumb\"><h3 class=\"groupName\">".$row["name"]."</h3><p>Group Owner: ".$row["owner"]."</p><p>Location: ".$row["location"]."</p>";
				
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
				
				$three = "<form action=\"wolfpackSummary.php\" method=\"post\"><input type=\"hidden\" value=".$row["id"]." name=\"groupId\"><input type=\"hidden\" value=\"join\" name=\"task\"><input onclick=\"eSource.close();\" type=\"submit\" class=\"joinbutton\" value=\"Join ".$row["name"]."!\"/></form></li>";
				
				$resultString = $resultString.$one.$two.$three;
			}			
		}
		return $resultString;
	}
        function notInGroup()
        {
            $resultString = "";
            $userName = $_GET['userName'];
            if(!$userName)
            {
                return "no name.";
            }
            $query = "SELECT * FROM friends WHERE user=\"".$userName."\"";
            $result = mysql_query($query)or die(mysql_error());
            while($row = mysql_fetch_array($result)){
                    $query2 = "SELECT * FROM users WHERE userName=\"".$row["friend"]."\" AND hungry=1 AND groupNumber=0";
                    $result2 = mysql_query($query2)or die(mysql_error());
                    while($row2 = mysql_fetch_array($result2)){
                            if($row2["usericon"] == "")
                            {
                                    $icon2 = "./images/obama.jpeg";
                            }
                            else
                            {
                                    $icon2 = $row2["usericon"];
                            }
                            $icon = $icon2;
                            $one = "<div data-role=\"collapsible\" data-collapsed=\"true\">";
                            $two = "<h3><img src=\"".$icon."\" height=50 width=50> ".$row["friend"]."</h3>";
                            $startTime = $row2["startTime"];
                            $stopTime = $row2["endTime"];
                                    $timeOfDay = "AM";
                                    $hour = $startTime/100;
                                    if($hour>=12 && $hour<24){
                                            $timeOfDay="PM";
                                    }
                                    if($hour>=13){
                                            $hour=$hour%12;
                                    }
                                    $minutes = $startTime%100;
                                    if($minutes==0){
                                            $minutes = "00";
                                    }
                            $startTimeString=$hour.":".$minutes.$timeOfDay;
                                    $timeOfDay = "AM";
                                    $hour = $stopTime/100;
                                    if($hour>=12 && $hour<24){
                                            $timeOfDay="PM";
                                    }
                                    if($hour>13){
                                            $hour=$hour%12;
                                    }
                                    $minutes = $stopTime%100;
                                    if($minutes==0){
                                            $minutes = "00";
                                    }
                            $stopTimeString = $hour.":".$minutes.$timeOfDay;
                            $three = "<p>Available from: ".$startTimeString." - ".$stopTimeString."</p>";
                            $four = "</div>";
                            $resultString = $resultString.$one.$two.$three.$four;
                    }
            }
            if($resultString==""){
            	return "<p>It seems you have no more hungry friends that you can invite!</p>";
            }
            return $resultString;
        }
    while(true)
    {
	$link = mysql_connect($sqlAddress, $sqlUser, $sqlPass);
        mysql_select_db($sqlDb);
        $resultString = friendsList();
        if($oldFriendString <> $resultString)
        {
            $resultStringEncode = $resultString;
            echo "event: friendsList\n";
            echo "data: $resultStringEncode \n\n";
            flush();
            $oldFriendString = $resultString;
        }
	$resultString = chatLoad();
        if($oldChatString <> $resultString)
        {
            $resultStringEncode = $resultString;
            echo "event: chatLoad\n";
            echo "data: $resultStringEncode \n\n";
            flush();
            $oldChatString = $resultString;
        }
	$resultString = groupListFunction();
        if($oldGroupString <> $resultString)
        {
            $resultStringEncode = $resultString;
            echo "event: groupListFunction\n";
            echo "data: $resultStringEncode \n\n";
            flush();
            $oldGroupString = $resultString;
        }
        $resultString = groupInvite();
        if($oldInviteString <> $resultString)
        {
            $resultStringEncode = $resultString;
            echo "event: inviteData\n";
            echo "data: $resultStringEncode\n\n";
            flush();
            $oldInviteString = $resultString;
        }
        $resultString = groupFriends();
        if($oldGroupFriendString <> $resultString)
        {
            $resultStringEncode = $resultString;
            echo "event: groupFriends\n";
            echo "data: $resultStringEncode \n\n";
            flush();
            $oldGroupFriendString = $resultString;
        }
        $resultString = notInGroup();
        if($oldGroupFriendsNotString <> $resultString)
        {
            $resultStringEncode = $resultString;
            echo "event: notInGroup\n";
            echo "data: $resultStringEncode \n\n";
            flush();
            $oldGroupFriendsNotString = $resultString;
        }
        
        mysql_close($link);
        sleep(3);
    }
    
    
    
    
?>