<?php
include_once "config.lib.php";
$data ="";
$userid="100000";
$approvalId = mysql_real_escape_string($_POST['approvalId']);
$query="SELECT * FROM requests WHERE roomMateRequestId =".$userid." AND userId = ".$approvalId;//." & accepted=''";
$res=mysql_query($query);
while($info=mysql_fetch_array($res)){
	if($info['accepted']!=1){
	  $query1="UPDATE requests SET accepted='1' WHERE roomMateRequestId =".$userid." AND userId = ".$approvalId;
	  $res1=mysql_query($query1);
	  $data="Success";
	}
	}
echo $data;
?>
