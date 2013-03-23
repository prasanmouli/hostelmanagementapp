<?php
	include_once("config.lib.php");
	
	$hostelId = mysql_real_escape_string($_GET['hostelId']);	
	$hostelId = 1;
	$capacity = 0; 

	$query = "SELECT capacity FROM hosteldetails WHERE hostelId=".$hostelId;
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		$capacity = $info['capacity'];
  		break;	
	}
	
	$form .= "";
	for($i=1; $i<=$capacity-1; $i++){
		$form .= "<input type='text' /> <button  onclick='groupSave()'> Send Request </button>";
		}
	$form .= "";
	echo $form;
?>