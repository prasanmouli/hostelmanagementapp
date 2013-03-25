<?php
include("config.lib.php");

$userId = mysql_real_escape_string($_POST['userId']);
$userId = 100001;
$query = "SELECT * FROM requests WHERE userId = ".$userId." ORDER BY requestTime DESC";

while($info = mysql_fetch_array($query))
  if()
?>

