<?php
include_once("config.lib.php");
$groupId = 1; 
$capacity;                    
$noOfRoomsPerFloor=10;
$noOfFloors=3;          
$queryHostelPref = "SELECT preference FROM finalRoomList WHERE groupId =".$groupId;
$res = mysql_query($queryHostelPref);
while($info = mysql_fetch_array($res)){
  $pref = $info['preference'];
  break;
}
$capacity = "SELECT capacity FROM finalRoomList WHERE groupId =".$groupId;
$capref =  mysql_query($capacity);
$capacityNumber = mysql_fetch_array($capref);
$array1[]= $capacityNumber;

for($i=1;$i<=60;$i++)
  $array1[$i] = $i;
$rand_arr=array_rand($array1,1);
//print_r($rand_arr);
unset($array1[$rand_arr]);
if(ctype_alpha($pref)) {
  $floorNo = floor($rand_arr / $noOfRoomsPerFloor);
  echo $floorNo;
$qur1 = "UPDATE finalRoomList SET roomNo=".$rand_arr
." WHERE groupId = ".$groupId;
$vacancy="INSERT INTO vacancies VALUES  (hostelName.finalRoomList , preference.finalRoomList , roomNo.finalRoomList ,".$floorNo." , 1)";  
mysql_query($qur1)


;
mysql_query($vacancy);



}


else {
  $l=($pref+1)*$noOfRoomsPerFloor;
  //echo $l.".";
  $const=$l-$noOfRoomsPerFloor;
  
  for($k=$l;$k>$const;$k--)
    $array2[$k] = $k;
     
  $rand_arr1=array_rand($array2,1);
  print_r($rand_arr1);
  unset($array2[$rand_arr1]);
$qur2 = "UPDATE finalRoomList SET roomNo=".$rand_arr1
  ." WHERE groupId = ".$groupId;
//$vacancy="INSERT INTO vacancies VALUES hostelName.finalRoomList , prefe";
mysql_query($qur2);

}

?>
