<?php
include_once "config.lib.php";
$userid = '100000';
$q= "SELECT capacity,commonName FROM hostels,userPreferences WHERE hostels.commonName = userPreferences.hostelName AND userPreferences.userId = ".$userid;
$q1=mysql_query($q);
$info1=mysql_fetch_array($q1);
echo $info1['capacity'];
?>
