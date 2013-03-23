<?php
	include_once("config.lib.php");

	$hostelId = mysql_real_escape_string($_GET['hostelId']);	
	$hostelId = 1; 
	$floorNum = 0;
	$floorTabs = "";
	$query = "SELECT floorNo FROM hostelDetails WHERE hostelId='".$hostelId."' ORDER BY floorNo DESC";
	$res = mysql_query($query);
	while($info = mysql_fetch_array($res)){
		$floorNum = $info['floorNo'];
  		break;	
	}
	$floorTabs .= "";
	for($i=0; $i<=$floorNum; $i++){
		if($i==0)
			$floorTabs .= "<ul class='ui-state-default'> <li> Ground Floor </li> </ul>";
		else
			$floorTabs .= "<ul class='ui-state-default'> <li> Floor ".$i." </li> </ul>";
		}
	$floorTabs .= "";
	echo $floorTabs;		
?>