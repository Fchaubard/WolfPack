<?php
    include("../config.php");
    $un = $_SESSION['userName'];
    $page = $_GET["page"];
    $user = $_GET["user"];
    echo "Page: ".$page."<br/>";
    echo "User: ".$un."<br/>";
    echo "User2: ".$user."<br/>";
    
    $query = "INSERT INTO visitedPages (user, pageName, hasVisited) VALUES (\"".$user."\",\"".$page."\",\"1\")";
    echo $query;
    
    if($user != "")
    {
        $result = mysql_query($query)or die(mysql_error());
        echo "ran.";
    }
    
    mysql_close($link);

?>