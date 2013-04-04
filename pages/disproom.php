<?php
include_once("config.lib.php");
//$_SESSION['userId'] = $userid;
$searchId = mysql_real_escape_string($_POST['group1']) ; 
echo $searchId."<br/>";
//$userid = '100000';

if(($searchId!=NULL)&&($searchId!="")){

$query = "SELECT roomMateRequestId,userId from requests WHERE (userId LIKE '%".$searchId."%' OR roomMateRequestId LIKE '%".$searchId."%') AND accepted = '1'";
$printtable = mysql_query($query);
//echo $printtable;
//if($searchId!=NULL&&$searchId!=""){

while($info=mysql_fetch_array($printtable))
  echo $info['roomMateRequestId'] ."<br/>". $info['userId'];
echo "<br/>";
}
?>