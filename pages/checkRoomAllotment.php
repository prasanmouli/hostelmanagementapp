<?php
include_once "config.lib.php";
$userId=$_SESSION['userId'];
$userId=100000;
$query = "SELECT * FROM finalRoomList WHERE roomMate1='".$userId."' OR roomMate2='".$userId."' OR roomMate3='".$userId."' AND roomNo IS NOT NULL";
$res=mysql_query($query);
$info = mysql_fetch_array($res);
if(gettype($info['roomNo'])!='NULL'){
	$data= $info['hostelName'].$info['roomNo'];
	echo $data;
	}
exit;
?>
