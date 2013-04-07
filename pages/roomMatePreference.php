<?php
	include_once("./pages/config.lib.php");
	
        $hostelId = mysql_real_escape_string($_GET['hostelId']);	
	
        $hostelId = 3;
	$capacity = 0; 

	$query = "SELECT capacity FROM hostelDetails WHERE hostelId=".$hostelId;
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		$capacity = $info['capacity'];
  		break;	
	}
	$form= "Number of persons in a room : ".$capacity."<br/>";
 	for($i=1; $i<=$capacity-1; $i++){
		$form .= "<div style='float:left; margin-left: 50px;'><p style='float:left;'>RoomMate ".$i.":</p> <input style='float:left;' type='text' id='roomMate".$i."' name='name'/><button style='float:left; margin: 15px 0 0 10px;' id='roomMateSave".$i."'> Send Request </button> <br/> <span id='roomMateMessage".$i."'> </span> <br/> <br/> </div>";
}	
	echo $form;
?>
