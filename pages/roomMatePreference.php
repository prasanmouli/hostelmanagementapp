<?php
	include_once("./pages/config.lib.php");
	
        $hostelId = mysql_real_escape_string($_GET['hostelId']);	
	
        $hostelId = 1;
	$capacity = 0; 

	$query = "SELECT capacity FROM hostelDetails WHERE hostelId=".$hostelId;
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		$capacity = $info['capacity'];
  		break;	
	}
	
	for($i=1; $i<=$capacity-1; $i++){
		$form .= "<form style='float:left;'> <input type='text' id='roomMate".$i."' name='name'/> </form> <button style='margin-top: 15px;' id='roomMateSave".$i."'> Send Request </button> <br/> <span id='roomMateMessage".$i."'> </span>";
		}
	echo $form;
?>