<?php
include_once "config.lib.php";
$userId = $_SESSION['userId'];
$userId = "100000";
 $data = "";    
$query = " SELECT * FROM requests WHERE userId = " . $userId ; 
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
      $query_init = "SELECT rollNo FROM userDetails WHERE userId = '".$info['roomMateRequestId']."'";
      $info1 = mysql_fetch_array(mysql_query($query_init));

$data.=$info1['rollNo'].";";
}

echo $data;
exit;
?>
