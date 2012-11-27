<?php

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    
    $groupId = $_GET["group"];
    $oldResultString = "";
    include("../config.php");
    while(true)
    {
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
                        $two =  "<h3><img src=\"".$icon."\" height=50 width=50> ".$row["userName"]."</h3>";
                        
                        
                        
                        $three = "<p>Time Available: </p>";
                        $statusNumber = $row["status"];
                        if($statusNumber==0){
                                $status="No";
                        }
                        else if ($statusNumber==1){
                                $status = "Yes";
                        }
                        else if ($statusNumber==2){
                                $status = "Pending Response…";
                        }
                        else if ($statusNumber==3){
                                $status = "Group Owner";
                        }
                        else{
                                $status = "Status Message Error…";
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
            echo "data: $resultStringEncode \n\n";
            flush();
            $oldResultString = $resultString;
        }
        sleep(3);
    }
    
?>