<?php
include_once "config.lib.php";
$userId=mysql_real_escape_string($_POST['userId']);
$roomNo=mysql_real_escape_string($_POST['room']);
$roomNoArray = array();
$i=0;
$checkQuery="SELECT hostelName,roomNo FROM finalRoomList WHERE roomNo IS NOT NULL";
$checkRes = mysql_query($checkQuery);
while($checkInfo=mysql_fetch_array($checkRes)){
	$roomNoArray[$i++]=$checkInfo['hostelName'].$checkInfo['roomNo'];	
	
	}
$query = "SELECT * FROM finalRoomList WHERE roomMate1='".$userId."' OR roomMate2='".$userId."' OR roomMate3='".$userId."'";
$res=mysql_query($query);
while($info=mysql_fetch_array($res)){	
	
	if(!in_array($roomNo,$roomNoArray)){
		if(gettype($info['roomNo'])=='NULL'){
			$updateQuery="UPDATE finalRoomList SET roomNo ='".str_replace($info['hostelName'],"",$roomNo)."' WHERE roomMate1='".$userId."' OR roomMate2='".$userId."' OR roomMate3='".$userId."'";
			$updteRes=mysql_query($updateQuery);
			$data=$roomNo;
			}
		}
	else{
		$data="Taken";
		}
	}
echo $data;
exit;
?>
