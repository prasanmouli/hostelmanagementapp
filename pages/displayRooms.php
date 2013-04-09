<?php

include_once("config.lib.php");
$userId=$_SESSION['userId'];
$userId=100000;
$allotedList=array();
$k=0;
$hostelName = mysql_real_escape_string($_POST['hostelName']);
$query = "SELECT * FROM hostelDetails WHERE hostelName = '".$hostelName."' ORDER BY floorNo";
$data="";
$res=mysql_query($query);
$data.="<table id='rooms'>";
$query1 = "SELECT * FROM finalRoomList WHERE roomNo IS NOT NULL";
$res1 = mysql_query($query1);
while($info1=mysql_fetch_array($res1)){
	$allotedList[$k++]=$info1['hostelName'].$info1['roomNo'];
	}

while($info=mysql_fetch_array($res))
{
   $noOfFloors=$info['floorNo'];
   $data.="<tr><td>";
   if($noOfFloors!=0)
     $data.="<h2 style='width: 200px; text-align:center;'>Floor ".$noOfFloors."</h2>";
   else
     $data.="<h2 style='width: 200px; text-align:center;'>Ground Floor</h2>";

   $data.="<div align='center'>";
   
 // $rooms = $info['roomEndingNo'] - $info['roomStartingNo'] + 1;
//  echo $rooms;
  for($i=$info['roomStartingNo'];$i<=$info['roomEndingNo'];$i++){
	
	if(!in_array(($info['hostelName'].$i),$allotedList)){
	    	$data.="<div id='".$info['hostelName'].$i."' class='roomNoAvailable' onclick=addRoom('".$userId."','".$info['hostelName'].$i."')>".$i."</div>";
		
		}
	else
		 $data.="<div id='".$info['hostelName'].$i."' class='roomNoUnavailable' onclick=showRoom('".$info['hostelName'].$i."')>".$i."</div>";

	}
  $data.="</div></td></tr>";  

}
$data.="</table>";
echo $data;
exit;  
?>
