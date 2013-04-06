<?php
include_once "config.lib.php";
$data ="";
$userid = $_SESSION['userId'];
$userid="100000";
$x=0;
$l=0;
$finalList = array();
$index=-1;
$done=0;
$no=0;
$approvalId = mysql_real_escape_string($_POST['approvalId']);
$q= " SELECT capacity,commonName FROM hostels,userPreferences WHERE hostels.commonName = userPreferences.hostelName AND userPreferences.userId = ".$userid;
$q1=mysql_query($q);
$info1=mysql_fetch_array($q1);
$capacity=$info1['capacity'];
$query = "SELECT count(*) FROM requests WHERE (roomMateRequestId=".$userid." OR userId =".$userid.")AND accepted ='1'";
$res=mysql_query($query);
$info=mysql_fetch_array($res);
$count = $info[0];


			if($count<$capacity-1){
	  		for($i=1;$i<$capacity;$i++){
		    			$checkQuery="SELECT * FROM userPreferences WHERE userId =".$userid; 
					$checkRes=mysql_query($checkQuery);
				    $checkInfo = mysql_fetch_array($checkRes);
			
					if(gettype($checkInfo['roomMateId'.$i])=='NULL'){
		
						  $query2="UPDATE userPreferences SET roomMateId".$i."=".$approvalId." WHERE userId=".$userid;
         
							$res2=mysql_query($query2);
							  $x++;
							$done++;
							break;
								     }
							}
			for($i=1;$i<$capacity;$i++){

						    $checkQuery1="SELECT * FROM userPreferences WHERE userId =".$approvalId;
					            $checkRes1=mysql_query($checkQuery1);
					            $checkInfo1 = mysql_fetch_array($checkRes1);
					            if(gettype($checkInfo1['roomMateId'.$i])=='NULL'&&$done==1){

							  $query3="UPDATE userPreferences SET roomMateId".$i."=".$userid." WHERE userId=".$approvalId;
         
							$res3=mysql_query($query3);
							  $x++;
							break;

	    }
		}
        	 $checkReq = "SELECT * FROM finalRoomList WHERE (";
		$checkReq1 = "SELECT * FROM finalRoomList WHERE (";
		for($k=1;$k<$capacity;$k++){
		$checkReq.="roomMate".$k." = ".$userid." OR ";
		       $checkReq1.="roomMate".$k." = ".$approvalId." OR ";

		}
		$checkReq.="'1'='0')";
		$checkReq1.="'1'='0')";

	$checkDet = mysql_fetch_array(mysql_query($checkReq));
        $checkDet1 = mysql_fetch_array(mysql_query($checkReq1));

	  	for($k=1;$k<$capacity;$k++){
		
		  if(gettype($checkDet['roomMate'.$k])!='NULL'){
				$no=$k;
				$index=0;
		}
		  if(gettype($checkDet1['roomMate'.$k])!='NULL'){
		                                $no=$k;
                		 	       $index=1;
                }

		}
		
		
		if($no!=0&&$no<$capacity){
				if($index=0)
				$query4="UPDATE finalRoomList SET roomMate".($no+1)."= '".$userid."' WHERE (roomMate1='".$approvalId."' OR roomMate2='".$approvalId."')";
				else if($index=1)
                                $query4="UPDATE finalRoomList SET roomMate".($no+1)."= '".$approvalId."' WHERE (roomMate1='".$userid."' OR roomMate2='".$userid."')";

				$query5="UPDATE requests SET accepted ='1' WHERE (roomMateRequestId = '".$userid."' AND userId = '".$approvalId."')";
$res5=mysql_query($query5);
				
				}
		else if($capacity==$no+1){
				$data = "Bigerror";
			
				}
		else{
				$query4="INSERT INTO finalRoomList (roomMate1,roomMate2,hostelName) VALUES ('".$userid."','".$approvalId."','".$info1['commonName']."')";

$query5="UPDATE requests SET accepted ='1' WHERE (roomMateRequestId ='".$userid."' AND userId = '".$approvalId."')";
$res5=mysql_query($query5);

	}
		$res4=mysql_query($query4);
	 				
	  if($x==0)
	    {
		 $data = "Error";
			}
	 else{
		$data="Success"; 		
		 
		if($count==$capacity-2){
		
			$query6="SELECT userId from requests WHERE roomMateRequestId='".$userid."' AND accepted=1";
		
			$res6=mysql_query($query6);
			while($info6=mysql_fetch_array($res6)){
			 $userIds[$l++]=$info6['userId'];
				}
			$userList = implode(',',$userIds);
		   $query7="UPDATE requests SET accepted =0 WHERE (roomMateRequestId = '".$userid."' AND userId NOT IN(".$userList."))";
                   $res7=mysql_query($query7);
			$query8 = "SELECT * FROM userPreference WHERE userId = '".$userid."'";
			$res8=mysql_query($query8);
			while($info8=mysql_fetch_array($res8)){
					for($m=1;$m<$capacity;$m++){
						$finalList[$m-1]=$info8['roomMateId'.$m];
					}
		echo $finalList[0];
				}
			if($capacity==3){
				$query9="UPDATE userPreferences SET roomMateId2='".$finalList[1]."' WHERE userId = '".$finalList[0]."'";
				$res9 = mysql_query($query9); 	
				     $query0="UPDATE userPreferences SET roomMateId2='".$finalList[0]."' WHERE userId = '".$finalList[1]."'";
                                $res0 = mysql_query($query0);

		}
		
			}
		}
	}
	else{
	    $data ="You.Cannot.accept.any.more.requests";

	}
		


echo $data;
?>
