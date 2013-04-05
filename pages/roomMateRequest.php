<?php
include_once("config.lib.php");

$userId = $_SESSION['userId'];
$userId = '100000';
$checkId = mysql_real_escape_string($_POST['roomMate']);
if($checkId){
$query_init = "SELECT userId FROM userDetails WHERE rollNo = '".$checkId."'";
$info = mysql_fetch_array(mysql_query($query_init));
if($info['userId'] != $userId){

date_default_timezone_set('Asia/Calcutta');
$mysqltime = date("Y-m-d H:i:s");

$query = "INSERT INTO requests (userId,roomMateRequestId) VALUES (".$userId."," . $info['userId'].")";
$res = mysql_query($query);
$query = "UPDATE requests SET requestTime = '".$mysqltime."' WHERE userId = ".$userId;
mysql_query($query);
//echo date("l jS of F g:i A.", time());
}
else
  echo "Invalid";
}
else
  echo "Invalid"; 
?>
