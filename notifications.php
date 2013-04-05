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

function confirmRequestApproval(roomMateId){
   $('#button'+roomMateId).css('display','none');
   console.log(roomMateId);
   $('#confirmation'+roomMateId).empty();
   $('#confirmation'+roomMateId).append("Are you sure you want to confirm? <button class='confirmationButton' onclick='requestApproval("+roomMateId+")'> Y </button> <button class='confirmationButton' onclick=rejectRequest("+roomMateId+")> N </button>");
}

function requestApproval(roomMateId){ 
  $.ajax({
       	 url : './pages/checkRoomMateApproval.php',
         type : 'POST' , 
	 data : {'approvalId' : roomMateId},
	 success : function(data){
	 if(data=="Success"){
	   $('#confirmation'+roomMateId).empty();
	   $('#button'+roomMateId).css('display', 'none');
	   $('#accept').remove();
	   $('#reject1').remove();
	   $('#approved').append("Approved!");
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
 <p style="font-size: 14px; color: #E66140; font-weight: bold;"> This is really <span style='text-decoration: underline'>IMPORTANT</span>: Once a request is approved no further alteration/cancellation is possible. Changes will be final. </p> 
<ul>
<?php
$userId = mysql_real_escape_string($_POST['userId']);
$userId = '100000';
$query = "SELECT * FROM requests WHERE roomMateRequestId = ".$userId." ORDER BY requestTime DESC";
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
  $requestTime = $info['requestTime'];
  $query1 = "SELECT * FROM userDetails WHERE userId = ".$info['userId'];
  $res1 = mysql_query($query1);
  $info1 = mysql_fetch_array($res1);
  $requestRollNo = $info1['rollNo'];
  //$requestTime = $info['requestTime'];
  if($info['accepted']!=1)
    echo "<li> <div> <div style='margin-right: 10px;float:left;'><strong>".$info1['userName']." </strong>(".$info1['rollNo'].") wants to be your room mate.".$requestTime."</div><div id='button".$info['userId']."'> <button id='accept' class='acceptButton' onclick='confirmRequestApproval(".$info['userId'].")'> Accept </button> <button id='reject' class='rejectButton'> Reject </button> </div> </div> <div style='font-size:13px; color: #04a4cc;' id='confirmation".$info['userId']."'> </div> <span id='approved'> </span> </li>";
  else
    echo "<li> <div> <div style='margin-right: 10px;float:left;'><strong>".$info1['userName']." </strong>(".$info1['rollNo'].") wants to be your room mate.".$requestTime."</div> <span id='approved'> Approved! </span> </li>";
}
?>
</ul>
</div>

</div>
</body>
</html>