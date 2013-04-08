<?php
include_once("config.lib.php");
//$_SESSION['userId'] = $userid;
$searchId = mysql_real_escape_string($_GET['name']) ; 
//echo $searchId."<br/>";
$prevId = "";
$x=0;
$j=0;
$grpsDisplayed = array();
//$userid = '100000';
$nameList = array();
$numberList = array();

if(($searchId!=NULL)&&($searchId!="")){
$query = "SELECT userId from userDetails WHERE userName LIKE '".$searchId."%'";
$res = mysql_query($query);
$query1 = "SELECT userId from userDetails WHERE rollNo LIKE '".$searchId."%'";
$res1 = mysql_query($query1);

while($info1=mysql_fetch_array($res1)){
$numberList[$j++]=$info1['userId'];
}
$numberMatches = implode(',',$numberList);
$query2 = "SELECT * from finalRoomList WHERE (roomMate1 IN (".$numberMatches.") OR roomMate2 IN (".$numberMatches.") OR roomMate3 IN (".$numberMatches."))";
$res2 = mysql_query($query2);


while($info=mysql_fetch_array($res)){
$nameList[$j++]=$info['userId'];
}

$nameMatches = implode(',',$nameList);
  $query3 = "SELECT * from finalRoomList WHERE (roomMate1 IN (".$nameMatches.") OR roomMate2 IN (".$nameMatches.") OR roomMate3 IN (".$nameMatches."))";
$res3=mysql_query($query3);
while($info3=mysql_fetch_array($res3)){
    echo "Group ID : ".$info3['groupId']."<br/>";
    echo "<div style='border-bottom: 1px solid blue;'>";
    for($i=1; $i<=3; $i++){
      $query4 = "SELECT * from userDetails WHERE userId=".$info3[$i];
      $res4 = mysql_query($query4);
      $info4 = mysql_fetch_array($res4);
      if($info4['rollNo']!="")
       echo $info4['userName']."<br/><span style='font-size: 13px;'>(".$info4['rollNo'].")</span><br/>";
      /*     if($info4['rollNo']!="")	
      echo $info4['userName']."(".$info4['rollNo'].")"."<br/>";*/
      $x=1;
        }
    echo "</div>";
  }

}
 
  while($info2=mysql_fetch_array($res2)){
    echo "Group ID : ".$info2['groupId']."<br/>";
    echo "<div style='border-bottom: 1px solid blue;'>";
    for($i=1; $i<=3; $i++){
      $query4 = "SELECT * from userDetails WHERE userId=".$info2[$i];
      $res4 = mysql_query($query4);
      $info4 = mysql_fetch_array($res4);
      if($info4['rollNo']!="")
       echo $info4['userName']."<br/><span style='font-size: 13px;'>(".$info4['rollNo'].")</span><br/>";
      /* if($info4['rollNo']!="")
	 echo $info4['userName']."(".$info4['rollNo'].")"."<br/>";*/
      $x=1;
	}
    echo "</div>";
  }

if(!$searchId)
$x=2;
if($x!=1)
echo $x;
exit;
?>
