<?php
include_once "config.lib.php";
$userId = $_SESSION['userId'];
$userId = "100000";
$roomMateNo = mysql_real_escape_string($_POST['roomMateNo']);
$data ="";
$query = " SELECT * FROM userPreferences WHERE userId = " . $userId ;
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
$data.=$info['roomMateId'.$roomMateNo];
break;
}
echo $data;
exit;
?>
