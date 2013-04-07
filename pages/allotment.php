<?php
include_once("config.lib.php");
$groupId = 1; 
$capacity;                    
$counter=0;                         
          
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
print_r($rand_arr);
unset($array1[$rand_arr]);
if(ctype_alpha($pref)) {

$qur1 = "UPDATE finalRoomList SET roomNo=".$rand_arr
." WHERE groupId = ".$groupId;
  mysql_query($qur1);

}


 else {

   // echo $pref;
}

?>
