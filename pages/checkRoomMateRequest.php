<?php
include_once "config.lib.php";
$userId = $_SESSION['userId'];
$userId = "100000";
      
$query = " SELECT * FROM requests WHERE userId = " . $userId ; 
$res = mysql_query($query);
$info = mysql_fetch_array($res);
if($info){
      $query_init = "SELECT rollNo FROM userDetails WHERE userId = '".$info['roomMateRequestId']."'";
      $info = mysql_fetch_array(mysql_query($query_init));

echo $info['rollNo'];
}
else
echo "0";

?>
