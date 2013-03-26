<?php
include_once "config.lib.php";
$userId = $_SESSION['userId'];
$userId = "100000";
$query = " SELECT * FROM requests WHERE userId = " . $userId ; 
$res = mysql_query($query);
$info = mysql_fetch_array($res);
if($info){
echo $info['roomMateRequestId'];
}
else
echo "0";

?>
