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
function AddEventHandler(){
	/*var button1 = document.getElementById("accept");
	button1.addEventListener ("click", function (){
		$.ajax({
        	url : './pages/requestApproval.php',
	        type : 'get' , 
        	data : {'name' : searchq},
	        success : function(data){
				if(data==""){
					$('#msg').empty();
				        document.getElementById('msg').innerHTML = "Type something into the input field";
				        }                                        
	            }       
			});
	}, false);	*/
}
</script>
</head>

<body onload="AddEventHandler();">
<div>

<table id="menuBar">
<tr> <td> <a href="./"> Hostel Registration </a> </td> <td> Profile </td> <td class="menuActive"> Notifications </td> </tr>
</table>

<div id="notifications">
<ul>
<?php
$userId = mysql_real_escape_string($_POST['userId']);
$userId = '100001';
$query = "SELECT * FROM requests WHERE userId = ".$userId." ORDER BY requestTime DESC";
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
  $query1 = "SELECT * FROM userDetails WHERE userId = ".$info['roomMateRequestId'];
  $res1 = mysql_query($query1);
  $info1 = mysql_fetch_array($res1);
  $requestName = $info1['userName'];
  $requestRollNo = $info1['rollNo'];
  
  echo "<li> <strong>".$requestName."</strong>(".$requestRollNo.") wants to be your room mate.".$info['requestTime']." <button id='accept'> Accept </button> <button id='rejectasd' class='reject'> Reject  </button></li>";
}                                                                                                
?>
</ul>
</div>

</div>
</body>
</html>
