<?php
$sqlAddress = 'mysql-user-master.stanford.edu';
$sqlUser = 'ccs147rerich';
$sqlPass = 'dahdiedi';
$sqlDb = 'c_cs147_rerich';
$link = mysql_connect($sqlAddress, $sqlUser, $sqlPass);
mysql_select_db($sqlDb);
?>