<?php

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    
    
    $oldFriendString = "";
    $oldGroupString = "";
    $oldInviteString = "";
    include("../config.php");
    mysql_close($link);
    function groupInvite()
    {
        $userName = $_GET['userName'];
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
            $acceptButton = "<form name=\"acceptInvite\" action=\"wolfpackSummary.php\" method=\"post\"><input type=\"hidden\" value=\"".$groupNumber."\" name=\"groupId\"><input type=\"hidden\" value=\"acceptInvitation\" name=\"task\"/><input type=\"submit\" onclick=\"eSource.close();\" class=\"inviteButton\" data-role=\"button\" data-theme=\"a\" onclick=\"document.ontouchmove = function(e){ return true; }\" value=\"Accept Invitation\"/></form>";
            
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
                        $icon2 = "obama.jpeg";
                }
                else
                {
                        $icon2 = $row2["usericon"];
                }
                $icon = "./images/".$icon2;
                $one = "<li class=\"friend heightForCell\" data-icon=\"false\">";
                $two = "<a href=\"./wolfpackCreate.php?friend=".$row2["userName"]."\" onclick=\"eSource.close()\" class=\"friend heightForCell\" data-icon=\"arrow-r\" data-iconpos=\"right\">";
                $three = "<img height=\"60\" width=\"60\" src=\"".$icon."\" >";
                $four = "<h3 class=\"friendName\">".$row["friend"]."</h3>";

                
                $six =  "<p class=\"friendName\">Distance from you: 3 mi</p></a></li>";
                $resultString = $resultString.$one.$two.$three.$four.$six;
                $count++;
            }
        }
        if($count == 0)
        {
            $resultString = "<p> &nbsp; &nbsp; &nbsp;$userName You have no hungry friends! Aroo. <img width=\"50px\" src=\"./images/nixon.png\" /></p>";
        }
	return $resultString;
    }
	
	function groupsList()
	{
		$query = "SELECT * FROM groups";
		$result = mysql_query($query)or die(mysql_error());
		$resultString = "";
		while($row = mysql_fetch_array($result)){
			if($row["open"]==2) //&& $row["owner"]!=$_SESSION['userName'])
			{
				$one = "<div data-role=\"collapsible\" class=\"groupElement\" data-collapsed=\"true\"><h3>".$row["name"]."</h3><p>Group Owner: ".$row["owner"]."</p><p>Location: ".$row["location"]."</p>";
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
				
				$three = "<form action=\"wolfpackSummary.php\" method=\"post\"><input type=\"hidden\" value=".$row["id"]." name=\"groupId\"><input type=\"hidden\" value=\"join\" name=\"task\"><input onclick=\"eSource.close();\" type=\"submit\" class=\"joinbutton\" value=\"Join ".$row["name"]."!\"/></form></div>";
				$resultString = $resultString.$one.$two.$three;
			}			
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
	$resultString = groupsList();
        if($oldGroupString <> $resultString)
        {
            $resultStringEncode = $resultString;
            echo "event: groupsList\n";
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
        mysql_close($link);
        sleep(3);
    }
    
?>