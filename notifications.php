<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once("./pages/config.lib.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hostel Management</title>

<link href="./styles/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./scripts/jquery.min.js"></script>
<script type="text/javascript">

function confirmRequestApproval(roomMateId, roomMateName){
   roomMateName = roomMateName.replace(".", " ");
   $('#button'+roomMateId).css('display','none');
   $('#confirmation'+roomMateId).empty();
   $('#confirmation'+roomMateId).append("Are you sure you want to have <strong>"+roomMateName+"</strong> as your room mate? <button class='confirmationButton' onclick='requestApproval("+roomMateId+")'> Y </button> <button class='confirmationButton' onclick='sayNo("+roomMateId+")'> N </button>");
}

function sayNo(roomMateId){
  $('#button'+roomMateId).css('display','block');
  $('#confirmation'+roomMateId).empty();
}

function requestApproval(roomMateId){ 
  $.ajax({
       	 url : './pages/acceptRoomMateRequest.php',
         type : 'POST' , 
	 data : {'approvalId' : roomMateId},
	 success : function(data){
	console.log(data);
	 if(data=="Success"){
	   listOfRequests = "";
	   
	   for(var i=0; i<$('.primaryButtons').length; i++)
	     listOfRequests += ($('.primaryButtons').map(function() {return this.id;}).toArray()[i]).split("button").pop() + ";";


	   $('#confirmation'+roomMateId).empty();
	   $('#button'+roomMateId).css('display', 'none');
	   $('#accept').remove();
	   $('#reject1').remove();
	   //$('#newNotification'+roomMateId).css("bakcground": "white");
	   $('#approved'+roomMateId).append("Approved!");
	 }
	else if(data=="You.Cannot.accept.any.more.requests"){
		 $('#confirmation'+roomMateId).empty();
           $('#button'+roomMateId).css('display', 'none');
           $('#accept').remove();
           $('#reject1').remove();
           //$('#newNotification'+roomMateId).css("bakcground": "white");
           $('#approved'+roomMateId).append("You cannot accept any more requests!");

		}
		                                        
	 }       
  });
}

function confirmRejectRequest(roomMateId){
  $('#button'+roomMateId).css('display','none');
  $('#confirmation'+roomMateId).empty();
  $('#confirmation'+roomMateId).append("Are you sure you want to reject this offer? <button class='confirmationButton' onclick='requestReject("+roomMateId+")'> Y </button> <button class='confirmationButton' onclick='sayNo("+roomMateId+")'> N </button>");
}

function requestReject(roomMateId){
  $.ajax({
    url : './pages/rejectRoomMateRequest.php',
	type : 'POST' ,
	data : {'rejectId' : roomMateId},
	success : function(data){
	if(data=="Success"){
	  $('#confirmation'+roomMateId).empty();
	  $('#button'+roomMateId).css('display', 'none');
	  $('#accept').remove();
	  $('#reject1').remove();
	  //$('#newNotification'+roomMateId).css("bakcground": "white");                                                                  
	  $('#approved'+roomMateId).append("Rejected!");
	}
      }
    });
}


</script>
</head>

<body>
<div>

<table id="menuBar">
<tr> <td> <a href="./"> Hostel Registration </a> </td> <td> Profile </td> <td class="menuActive"> Notifications </td> </tr>
</table>

<div id="notifications">
  <p style="font-size: 14px; color: #E66140; font-weight: bold;"> This is really <span style='text-decoration: underline'>IMPORTANT</span>: Once a request is <span style='text-decoration: underline;'>approved</span>, no further alteration/cancellation is possible. Changes will be final. </p> 
<ul>
<?php
  $d=1;
$userId = mysql_real_escape_string($_POST['userId']);
$userId = '100000';
$query = "SELECT * FROM requests WHERE roomMateRequestId = ".$userId." OR userId = ".$userId." ORDER BY requestTime DESC";
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
  $d=0;
  $requestTime = $info['requestTime'];
  $query1 = "SELECT * FROM userDetails WHERE userId = ".$info['userId'];
  $res1 = mysql_query($query1);
  $info1 = mysql_fetch_array($res1);
  
  $query2 = "SELECT * FROM userDetails WHERE userId = ".$info['roomMateRequestId'];
  $res2 = mysql_query($query2);
  $info2 = mysql_fetch_array($res2);

  $requestRollNo = $info1['rollNo'];
  //$requestTime = $info['requestTime'];
  if($info['roomMateRequestId']==$userId){
  if($info['accepted']=='1')
    echo "<li> <div> <div style='margin-right: 10px;float:left;'><strong>".$info1['userName']." </strong> <span style='font-size: 11px'>(".$info1['rollNo'].")</span> wanted to be your room mate.".$requestTime."</div> <span class='approved' id='approved".$info['userId']."'> Approved! </span> </li>";
  else if($info['accepted']=='0')
         echo "<li> <div> <div style='margin-right: 10px;float:left;'><strong>".$info1['userName']." </strong> <span style='font-size: 11px'>(".$info1['rollNo'].")</span> wanted to be your room mate.".$requestTime."</div> <span class='approved' id='approved".$info['userId']."'> Rejected! </span> </li>";
       else{
	   $name = str_replace(" ", ".", $info1['userName']);
           echo "<li class='newNotification'> <div> <div style='margin-right: 10px;float:left;'><strong>".$info1['userName']." </strong> <span style='font-size: 11px'>(".$info1['rollNo'].")</span> wants to be your room mate.".$requestTime."</div><div id='button".$info['userId']."' class='primaryButtons'><button id='accept' class='acceptButton' onclick=confirmRequestApproval(".$info['userId'].",'".$name."')> Accept </button> <button id='reject' class='rejectButton' onclick=confirmRejectRequest(".$info['userId'].")> Reject </button> </div> </div> <div style='font-size:13px; color: #04a4cc;' id='confirmation".$info['userId']."'> </div> <span class='approved' id='approved".$info['userId']."'> </span> </li>";
       }
  }
  else if($info['userId']==$userId){
    if($info['accepted']=='1')
      echo "<li> <strong>".$info2['userName']." </strong> <span style='font-size: 11px'>(".$info2['rollNo'].")</span> has accepted your request.".$requestTime." </li>";
    else if($info['accepted']=='0')
      echo "<li> <strong>".$info2['userName']." </strong> <span style='font-size: 11px'>(".$info2['rollNo'].")</span> has rejected your request.".$requestTime."</li>";
  }
}

if($d==1)
  echo "<br/>You have no notifications.";

?>
</ul>
</div>

</div>
</body>
</html>
