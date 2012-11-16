<?php
    //THIS FILE IS RETIRED. DO NOT. I REPEAT. DO NOT. UPDATE. IT. PLEASE LOOK AT MASTER_PUSH.PHP FOR THE CURRENT CODE.
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    
    $groupId = $_GET["group"];
    $oldResultString = "";
    include("../config.php");
    mysql_close($link);
    while(true)
    {
        $link = mysql_connect($sqlAddress, $sqlUser, $sqlPass);
        mysql_select_db($sqlDb);
        $resultString = "";
        $count =0;
        $query = "SELECT * FROM users WHERE groupNumber=\"".$groupId."\"";
        $result = mysql_query($query)or die(mysql_error());
        while($row = mysql_fetch_array($result)){
                if(1) //$row["userName"]!=$_SESSION['userName']
                {
                        if($row["usericon"] == "")
                        {
                                $icon2 = "obama.jpeg";
                        }
                        else
                        {
                                $icon2 = $row["usericon"];
                        }
                        $icon = "./images/".$icon2;
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
        if($oldResultString <> $resultString)
        {
            $resultStringEncode = $resultString;
            echo "event: groupFriends\n";
            echo "data: $resultStringEncode \n\n";
            flush();
            $oldResultString = $resultString;
        }
        mysql_close($link);
        sleep(3);
    }
    
?>