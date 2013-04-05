<?php
include_once "config.lib.php";
$x=0;
$userId = $_SESSION['userId'];
$userId="100000";
$query="SELECT * FROM requests WHERE roomMateRequestId =".$userId." AND accepted IS NULL";
$res=mysql_query($query);

while($info=mysql_fetch_array($res)){
    
        $x=1;
	echo $x;
	break;	
	}
if($x==0)
echo 0;
exit;
?>
