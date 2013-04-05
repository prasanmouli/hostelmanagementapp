<?php
include_once 'config.lib.php';
$userId = $_SESSION['userId'];
$userId = "100000";
$query = "SELECT year FROM userDetails WHERE userId = ".$userId;
$info = mysql_fetch_array(mysql_query($query));

$searchq = mysql_real_escape_string($_GET['name']);
echo $searchq;

if($searchq!=NULL&&$searchq!=""){
$getname_sql = "SELECT rollNo,userName FROM userDetails WHERE userName LIKE '".$searchq."%' AND year = ".$info['year'];
$getname1_sql = "SELECT rollNo,userName FROM userDetails WHERE rollNo LIKE '".$searchq."%' AND year = ".$info['year'];
$getName = mysql_query($getname_sql);
while ($row = mysql_fetch_array($getName)) {
echo $row['userName'] ." <span style='font-size: 13px;'>(".$row['rollNo']. ")</span><br/>";
}

$getName1 = mysql_query($getname1_sql);
while ($row1 = mysql_fetch_array($getName1)) {
echo $row1['userName'] ." <span style='font-size: 13px;'>(".$row1['rollNo']. ")</span><br/>";
}
}
?>
