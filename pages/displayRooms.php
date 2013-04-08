<?php

include_once("config.lib.php");
$userId=$_SESSION['userId'];
$userId=100000;
$hostelName = mysql_real_escape_string($_POST['hostelName']);
$query1 = "SELECT * FROM hostelDetails WHERE hostelName = '".$hostelName."' ORDER BY floorNo";
$data="";
$query=mysql_query($query1);
$data.="<table id='rooms'>";
while($info=mysql_fetch_array($query))
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
  for($i=$info['roomStartingNo'];$i<=$info['roomEndingNo'];$i++)
    $data.="<div id='".$info['hostelName'].$i."' class='roomNo' onclick=addRoom('".$userId."','".$info['hostelName'].$i."')>".$i."</div>";
  $data.="</div></td></tr>";  

}
$data.="</table>";
echo $data;
exit;  
?>
