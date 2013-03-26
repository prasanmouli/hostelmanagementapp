<?php
include('config.lib.php');
$searchq = $_GET['name'];
echo $searchq;
//$searchq = "107111027";
$getname_sql = "SELECT rollNo,userName FROM userDetails WHERE userName LIKE '".$searchq."%'";

//$getName_sql = 'SELECT * FROM USER
//WHERE name LIKE "%' . $searchq .'%"
$getName = mysql_query($getname_sql);

//$total = mysql_num_rows(getTask);

while ($row = mysql_fetch_array($getName)) {
echo $row['userName'] ." ".$row['rollNo']. '<br/>';
}
?>
