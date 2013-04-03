<?php
include_once("config.lib.php");
//$_SESSION['userId'] = $userid;
$searchId = mysql_real_escape_string($_POST['group1']) ; 

$userid = '100002';
$query = "SELECT * from requests WHERE userId = ".$searchId." AND accepted = '1'";
$printtable = mysql_query($query);

while($info=mysql_fetch_array($printtable))
  echo $info['roomMateRequestId'];

?>