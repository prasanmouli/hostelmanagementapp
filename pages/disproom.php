<?php
include_once("config.lib.php");
//$_SESSION['userId'] = $userid;
$searchId = mysql_real_escape_string($_GET['name']) ; 
//echo $searchId."<br/>";
$prevId = "";
$x=0;
$grpsDisplayed = array();
//$userid = '100000';

if(($searchId!=NULL)&&($searchId!="")){

  $query = "SELECT * from finalRoomList WHERE (roomMate1 LIKE '%".$searchId."%' OR roomMate2 LIKE '%".$searchId."%' OR roomMate3 LIKE '%".$searchId."%')";
  $res = mysql_query($query);

  while($info=mysql_fetch_array($res)){
    echo "Group ID : ".$info['groupId']."<br/>";
    for($i=1; $i<=3; $i++){
      $query2 = "SELECT * from userDetails WHERE userId=".$info[$i];
      $res2 = mysql_query($query2);
      $info2 = mysql_fetch_array($res2);
      echo $info2['userName']."(".$info2['rollNo'].")"."<br/>";
    $x=1;
	}
  }
}
if(!$searchId)
$x=2;
if($x!=1)
echo $x;
exit;
?>
