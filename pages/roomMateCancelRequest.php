<?php
    include_once("config.lib.php");
 
    $userId = $_SESSION['userId'];
    $userId = 100001;
    $checkId = mysql_real_escape_string($_POST['roomMate1']);
    if($checkId){
      $query_init = "SELECT userId FROM userDetails WHERE rollNo = '".$checkId."'";
      $info = mysql_fetch_array(mysql_query($query_init));
      if($info){
        $query = "UPDATE userPreferences SET roommateId = 'NULL' WHERE userId = ".$userId;
        mysql_query($query);
        //date_default_timezone_set('Asia/Calcutta');
        //$mysqltime = date ("Y-m-d H:i:s");
        $query = "UPDATE requests SET requestTime = 'NULL' WHERE userId = ".$userId;
        mysql_query($query);
        //echo date("l jS of F g:i A.", time());   
      }
      else
        echo "Invalid"; 
    }
    else
      echo "Invalid";
?>