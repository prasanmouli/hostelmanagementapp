<?php
include_once "config.lib.php";
$roomNo=mysql_real_escape_string($_POST['room']);
$room=explode('-',$roomNo);
$checkQuery="SELECT hostelName,roomNo FROM finalRoomList WHERE roomNo='-".$room[1]."' AND hostelName = '".$room[0]."'";
$checkRes = mysql_query($checkQuery);
//$data="<div id='takenRoom'><ul>"
while($checkInfo=mysql_fetch_array($checkRes))
echo "Taken";

exit;
?>
