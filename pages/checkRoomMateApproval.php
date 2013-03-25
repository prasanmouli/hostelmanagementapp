<?php
include_once "config.lib.php";
$data ="";
$userid = mysql_real_escape_string($_SESSION['userId']);
$userid=100000;
$query="SELECT * FROM requests WHERE userId=".$userid." & accepted!='2'";
$res=$mysql_query($query);
while($info=mysql_fetch_array($res)){
	if($info['accepted']!=1)
		$query1="SELECT * FROM userDetails WHERE userId=".$info['roommateRequestId'];
		$res1=mysql_query($query1);
		$info1=mysql_fetch_array($res1);
		$data=$info1['rollNo'];
	else
		$data="0";
	}
echo $data;
?>
