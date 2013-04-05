<?php
include_once "config.lib.php";
$data ="";
$userid="100000";
$rejectId = mysql_real_escape_string($_POST['rejectId']);
$query="SELECT * FROM requests WHERE roomMateRequestId =".$userid." AND userId = ".$rejectId;//." & accepted=''";                        
$res=mysql_query($query);
while($info=mysql_fetch_array($res)){
    $query1="UPDATE requests SET accepted=0 WHERE (roomMateRequestId =".$userid." AND userId = ".$rejectId.")";
    $res1=mysql_query($query1);
    /*$query2="UPDATE userPreferences SET roomMateId1=".$approvalId." WHERE userId=".$userid;
    $res2=mysql_query($query2);
    $query3="UPDATE userPreferences SET roomMateId1=".$userid." WHERE userId=".$approvalId;
    $res3=mysql_query($query3);*/
    $data="Success";
}
echo $data;
?>