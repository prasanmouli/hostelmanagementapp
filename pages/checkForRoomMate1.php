<?php
include_once "config.lib.php";
$userId = $_SESSION['userId'];
$userId = "100000";
$data ="";
$query = " SELECT * FROM userPreferences WHERE userId = " . $userId ;
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
$data.=$info['roommateId1'];
break;
}
echo $data;
exit;
?>
