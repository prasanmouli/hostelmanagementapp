<?php
include_once "config.lib.php";
$data="";
$userId=$_SESSION['userId'];
$userId="100000";
$query = "SELECT commonName FROM hostels,userDetails WHERE userId='".$userId."' AND (userDetails.year = hostels.year)";
$res=mysql_query($query);
$info = mysql_fetch_array($res);
$query1 = "SELECT hostelName FROM hostels WHERE commonName='".$info['commonName']."'";
$res1=mysql_query($query1);
while($info1=mysql_fetch_array($res1)){
	$data.=$info1['hostelName'].";";
}  
echo $data;
exit;
?>
