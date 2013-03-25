<?php
include('config.lib.php');
$searchq = $_GET['name'];
echo $searchq;
//$searchq = "107111027";
$getname_sql = 'SELECT userName FROM userDetails WHERE rollNo LIKE ".$searchq."%" ;

//$getName_sql = 'SELECT * FROM USER
//WHERE name LIKE "%' . $searchq .'%"
$getName = mysql_query($getname_sql);

//$total = mysql_num_rows(getTask);

while ($row = mysql_fetch_array($getName)) {
echo $row['userName'] . '<br/>';
}
?>
