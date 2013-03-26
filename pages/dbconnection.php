<?php
include_once 'config.lib.php';
$searchq = mysql_real_escape_string($_GET['name']);
echo $searchq;
if($searchq!=NULL&&$searchq!=""){
$getname_sql = "SELECT rollNo,userName FROM userDetails WHERE userName LIKE '".$searchq."%'";
$getname1_sql = "SELECT rollNo,userName FROM userDetails WHERE rollNo LIKE '".$searchq."%'";
$getName = mysql_query($getname_sql);
while ($row = mysql_fetch_array($getName)) {
echo $row['userName'] ." ".$row['rollNo']. '<br/>';
}

$getName1 = mysql_query($getname1_sql);
while ($row1 = mysql_fetch_array($getName1)) {
echo $row1['userName'] ." ".$row1['rollNo']. '<br/>';
}
}
?>
