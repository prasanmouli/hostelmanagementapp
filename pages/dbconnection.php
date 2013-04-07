<?php
include_once 'config.lib.php';
$userId = $_SESSION['userId'];
$userId = "100000";
$query = "SELECT year FROM userDetails WHERE userId = ".$userId;
$info = mysql_fetch_array(mysql_query($query));
$x=0;
$searchq = mysql_real_escape_string($_GET['name']);
if(!$searchq)
$x=2;
if($searchq!=NULL&&$searchq!=""){
$getname_sql = "SELECT rollNo,userName FROM userDetails WHERE userName LIKE '".$searchq."%' AND year = ".$info['year'];
$getname1_sql = "SELECT rollNo,userName FROM userDetails WHERE rollNo LIKE '".$searchq."%' AND year = ".$info['year'];
$getName = mysql_query($getname_sql);
while ($row = mysql_fetch_array($getName)) {
echo $row['userName'] ." <span style='font-size: 13px;'>(".$row['rollNo']. ")</span><br/>";
$x=1;
}

$getName1 = mysql_query($getname1_sql);
while ($row1 = mysql_fetch_array($getName1)) {
echo "<div style='border-bottom: 1px solid blue;'>".$row1['userName'] ."<br/><span style='font-size: 13px;'>(".$row1['rollNo']. ")</span></div>";
$x=1;
}
}
if($x!=1)
echo $x;
?>
