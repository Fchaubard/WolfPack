<?php session_start();
if(file_exists("fullUserList.php")){
    include("../config.php");
    include "fullUserList.php";
}
?>