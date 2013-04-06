<?php
include_once "config.lib.php";
$data ="";

$q= " SELECT capacity FROM hostels,userPreferences WHERE hostels.commonName = userPreferences.hostelName ";
$q1=mysql_query($q);
$info1=mysql_fetch_array($q1);
$capacity=$info1['capacity'];
$userid="100000";
$x=0;
$no;
$approvalId = mysql_real_escape_string($_POST['approvalId']);
if($capacity==2){
$query="SELECT * FROM requests WHERE roomMateRequestId =".$userid." AND userId = ".$approvalId;//." & accepted=''";
$res=mysql_query($query);
while($info=mysql_fetch_array($res)){
	if($info['accepted']!=1){
	  $query1="UPDATE requests SET accepted='1' WHERE (roomMateRequestId =".$userid." AND userId = ".$approvalId.")";
	  $res1=mysql_query($query1);
	  for($i=1;$i<=$capacity;$i++){
	    $checkQuery="SELECT * FROM userPreferences WHERE userId =".$userId;
	    $checkRes=mysql_query($checkQuery);
	    $checkInfo = mysql_fetch_array($checkRes);
	    if($checkInfo['roomMateId'.$i]!=NULL){
	  $query2="UPDATE userPreferences SET roomMateId".$i."=".$approvalId." WHERE userId=".$userid;
          $res2=mysql_query($query2);
	  $x++;
	    }
	    $checkQuery1="SELECT * FROM userPreferences WHERE userId =".$approvalId;
            $checkRes1=mysql_query($checkQuery1);
            $checkInfo1 = mysql_fetch_array($checkRes1);
            if($checkInfo1['roomMateId'.$i]!=NULL){

	  $query3="UPDATE userPreferences SET roomMateId".$i."=".$userid." WHERE userId=".$approvalId;
          $res3=mysql_query($query3);
	  $x++;
	    }
		$checkReq = "SELECT * FROM finalRoomList WHERE (";
		for($i=1;$i<=$capacity;$i++){
		$checkReq.="roomMateId".$i." = ".$userid." OR roomMateId".$i." = ".$approvalId." OR ";
		}
		$checkReq.="1=0)";
		$checkDet = mysql_fetch_array(mysql_query($checkReq));
	  	for($i=1;$i<$capacity;$i++){
		  if($checkDet['roomMateId'.$i]!=NULL){
		$no=$i;
		}
		}
		if($no!=0&&$no<$capacity)
		$query4="UPDATE INTO finalRoomList (roomMateId".($no+1).") VALUES ('".$userid."')";
		else if($capacity==$no)
		$data = "Bigerror";
		else
		$query4="INSERT INTO finalRoomList (roomMateId1,roomMateId2) values ('".$userid."' , '".$approvalId.")";
	  $res4=mysql_query($query4);
	  $data="Success";
	  if($x==2)
	    break;
	  }

	  if($x==0)
	    {

	      $data = "Error";
}
	  	  }

	}

}

echo $data;
?>
