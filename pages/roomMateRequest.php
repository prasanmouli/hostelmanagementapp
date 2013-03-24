<?php
$checkId = mysql_real_escape_string($_POST['roomMate1']);
if($checkId){
$query = "UPDATE userPreferences SET roommateId = ".$checkId;
mysql_query($query);
date_default_timezone_set('Asia/Calcutta');
  echo date("l jS of F g:i A.", time());   

  }

?>