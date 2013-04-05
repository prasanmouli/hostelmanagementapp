<?php
include_once("config.lib.php");
//$_SESSION['userId'] = $userid;
$searchId = mysql_real_escape_string($_POST['group1']) ; 
echo $searchId."<br/>";
$prevId = "";
//$userid = '100000';

if(($searchId!=NULL)&&($searchId!="")){

$query = "SELECT roomMateRequestId, userId from requests WHERE (userId LIKE '%".$searchId."%' OR roomMateRequestId LIKE '%".$searchId."%') AND accepted = '1'";
$printtable = mysql_query($query);

while($info=mysql_fetch_array($printtable)){
  /*$k=1;
  if($k==1&&($prevId!=$info['roomMateRequestId'])){//||$prevId1!=$info['userId'])){
    echo $info['roomMateRequestId']. "<br/>";
    $k++;
  }*/
  //$prevId = $info['roomMateRequestId'];
  //$prevId1 = $info['userId'];
  if($prevId==$info['userId']&&$prevId2!=$info['roomMateRequestId'])
    echo $info['roomMateRequestId'] . "<br/>";
  else if($prevId!=$info['userId']&&$prevId2==$info['roomMateRequestId'])
         echo $info['userId'] . "<br/>";
       else
         echo $info['userId']. "<br/>". $info['roomMateRequestId']. "<br/>";
  $prevId = $info['roomMateRequestId'];
  $prevId2 = $info['userId'];
  }
}
?>